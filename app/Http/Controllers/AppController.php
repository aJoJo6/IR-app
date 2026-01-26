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

    public function home()
    {
        return view('pages.home', $this->base());
    }

    public function explore()
    {
        return view('pages.explore', $this->base());
    }

    public function revolution(string $id)
    {
        $data = $this->base();
        abort_unless(isset($data['revolutions'][$id]), 404);

        return view('pages.revolution', [
            ...$data,
            'revolution' => $data['revolutions'][$id],
        ]);
    }

    public function compare(Request $request)
    {
        $data = $this->base();

        $leftId = $request->query('left', 'ir1');
        $rightId = $request->query('right', 'ir4');

        if (!isset($data['revolutions'][$leftId])) $leftId = array_key_first($data['revolutions']);
        if (!isset($data['revolutions'][$rightId])) $rightId = array_key_first($data['revolutions']);

        if ($leftId === $rightId) {
            $keys = array_keys($data['revolutions']);
            $rightId = $keys[1] ?? $leftId;
        }

        return view('pages.compare', [
            ...$data,
            'left' => $data['revolutions'][$leftId],
            'right' => $data['revolutions'][$rightId],
        ]);
    }

    public function criteria()
    {
        return view('pages.criteria', [
            'criteriaBlocks' => config('criteria.blocks'),
        ]);
    }

    public function evaluation()
    {
        return view('pages.evaluation', [
            'criteria' => config('evaluation.criteria'),
            'ir4' => config('evaluation.ir4'),
            'ir5' => config('evaluation.ir5'),
            'legend' => config('evaluation.legend'),
        ]);
    }

    public function glossary()
    {
        return view('pages.glossary', [
            'terms' => config('glossary.terms'),
        ]);
    }
}
