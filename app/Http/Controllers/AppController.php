<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    private function base(): array
    {
        return [
            'appName' => 'Industrial Revolutions Explorer',
            'revolutions' => config('ir.items'),
            'categories' => config('ir.categories'),
        ];
    }

    private function buildComparisonSummary(array $left, array $right, array $categories): array
    {
        $summary = [];

        foreach ($categories as $catKey => $catLabel) {
            $leftText = trim((string)($left['content'][$catKey] ?? ''));
            $rightText = trim((string)($right['content'][$catKey] ?? ''));

            if ($leftText === '' && $rightText === '') {
                continue;
            }

            if ($leftText !== $rightText) {
                $summary[] = [
                    'label' => $catLabel,
                    'left' => $left['title'],
                    'right' => $right['title'],
                ];
            }
        }

        return $summary;
    }

    public function home()
    {
        return view('pages.home', [
            ...$this->base(),
            'title' => 'Home',
        ]);
    }

    public function explore()
    {
        return view('pages.explore', [
            ...$this->base(),
            'title' => 'Explore Revolutions',
        ]);
    }

    public function revolution(string $id)
    {
        $data = $this->base();
        abort_unless(isset($data['revolutions'][$id]), 404);

        return view('pages.revolution', [
            ...$data,
            'title' => $data['revolutions'][$id]['title'],
            'revolution' => $data['revolutions'][$id],
        ]);
    }

    public function compare(Request $request)
    {
        $data = $this->base();

        $leftId = $request->query('left', 'ir1');
        $rightId = $request->query('right', 'ir4');
        $diff = $request->boolean('diff');

        if (!isset($data['revolutions'][$leftId])) {
            $leftId = array_key_first($data['revolutions']);
        }

        if (!isset($data['revolutions'][$rightId])) {
            $rightId = array_key_first($data['revolutions']);
        }

        if ($leftId === $rightId) {
            $keys = array_keys($data['revolutions']);
            $rightId = $keys[1] ?? $leftId;
        }

        $left = $data['revolutions'][$leftId];
        $right = $data['revolutions'][$rightId];

        $summary = $this->buildComparisonSummary($left, $right, $data['categories']);

        return view('pages.compare', [
            ...$data,
            'title' => 'Compare Revolutions',
            'left' => $left,
            'right' => $right,
            'diff' => $diff,
            'summary' => $summary,
        ]);
    }

    public function criteria()
    {
        return view('pages.criteria', [
            'title' => 'Criteria',
            'criteriaBlocks' => config('criteria.blocks'),
        ]);
    }

    public function evaluation()
    {
        return view('pages.evaluation', [
            'title' => 'Evaluation',
            'criteria' => config('evaluation.criteria'),
            'ir4' => config('evaluation.ir4'),
            'ir5' => config('evaluation.ir5'),
            'legend' => config('evaluation.legend'),
        ]);
    }

    public function glossary()
    {
        return view('pages.glossary', [
            'title' => 'Glossary',
            'terms' => config('glossary.terms'),
        ]);
    }
}