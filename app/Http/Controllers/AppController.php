<?php

namespace App\Http\Controllers;

use App\Models\Revolution;
use App\Models\Criterion;
use App\Models\Evaluation;
use App\Models\GlossaryTerm;
use Illuminate\Http\Request;

class AppController extends Controller
{
    private function base(): array
    {
        return [
            'appName' => 'Industrial Revolutions Explorer',
            'categories' => config('ir.categories'),
        ];
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
            'revolutions' => Revolution::orderBy('id')->get(),
        ]);
    }

    public function revolution(string $id)
    {
        $revolution = Revolution::with('sections')
            ->where('slug', $id)
            ->firstOrFail();

        $categories = $revolution->sections
            ->pluck('section_title', 'section_key')
            ->toArray();

        $content = $revolution->sections
            ->pluck('body', 'section_key')
            ->toArray();

        $revolutionData = [
            'id' => $revolution->slug,
            'label' => $revolution->label,
            'title' => $revolution->title,
            'years' => $revolution->years,
            'summary' => $revolution->summary,
            'hero_image' => $revolution->hero_image,
            'content' => $content,
        ];

        return view('pages.revolution', [
            ...$this->base(),
            'title' => $revolution->title,
            'revolution' => $revolutionData,
            'categories' => $categories,
        ]);
    }

    public function revolutionSection(string $id, string $section)
    {
        $revolution = Revolution::with(['sections.images'])
            ->where('slug', $id)
            ->firstOrFail();

        $sectionRecord = $revolution->sections->firstWhere('section_key', $section);

        abort_unless($sectionRecord, 404);

        $categories = $revolution->sections
            ->pluck('section_title', 'section_key')
            ->toArray();

        $revolutionData = [
            'id' => $revolution->slug,
            'label' => $revolution->label,
            'title' => $revolution->title,
            'years' => $revolution->years,
            'summary' => $revolution->summary,
            'hero_image' => $revolution->hero_image,
        ];

        return view('pages.revolution-section', [
            ...$this->base(),
            'title' => $revolution->label . ' - ' . $sectionRecord->section_title,
            'revolution' => $revolutionData,
            'categories' => $categories,
            'sectionKey' => $sectionRecord->section_key,
            'sectionTitle' => $sectionRecord->section_title,
            'sectionContent' => $sectionRecord->body,
            'sectionImages' => $sectionRecord->images,
        ]);
    }

    public function compare(Request $request)
    {
        $revolutions = Revolution::with('sections')->orderBy('id')->get();

        $leftId = $request->query('left', 'ir1');
        $rightId = $request->query('right', 'ir4');

        $left = $revolutions->firstWhere('slug', $leftId) ?? $revolutions->first();
        $right = $revolutions->firstWhere('slug', $rightId) ?? $revolutions->skip(1)->first() ?? $left;

        if ($left->slug === $right->slug) {
            $right = $revolutions->firstWhere('slug', 'ir4') ?? $revolutions->skip(1)->first() ?? $left;
        }

        $leftData = [
            'id' => $left->slug,
            'label' => $left->label,
            'title' => $left->title,
            'years' => $left->years,
            'summary' => $left->summary,
            'content' => $left->sections->pluck('body', 'section_key')->toArray(),
        ];

        $rightData = [
            'id' => $right->slug,
            'label' => $right->label,
            'title' => $right->title,
            'years' => $right->years,
            'summary' => $right->summary,
            'content' => $right->sections->pluck('body', 'section_key')->toArray(),
        ];

        $categories = $left->sections->pluck('section_title', 'section_key')->toArray();

        return view('pages.compare', [
            ...$this->base(),
            'title' => 'Compare Revolutions',
            'revolutions' => $revolutions->mapWithKeys(fn ($r) => [
                $r->slug => [
                    'id' => $r->slug,
                    'label' => $r->label,
                    'title' => $r->title,
                ]
            ])->toArray(),
            'categories' => $categories,
            'left' => $leftData,
            'right' => $rightData,
        ]);
    }

    public function criteria()
    {
        return view('pages.criteria', [
            ...$this->base(),
            'title' => 'Criteria',
            'criteriaBlocks' => Criterion::orderBy('id')->get(),
        ]);
    }

    public function evaluation()
    {
        $criteria = Criterion::orderBy('id')->get();

        $evaluations = Evaluation::orderBy('revolution')->orderBy('id')->get();

        $evaluationMap = $evaluations->keyBy(function ($item) {
            return strtolower(trim($item->criterion)) . '|' . strtolower(trim($item->revolution));
        });

        return view('pages.evaluation', [
            ...$this->base(),
            'title' => 'Evaluation',
            'criteria' => $criteria,
            'evaluationMap' => $evaluationMap,
        ]);
    }

    public function glossary()
    {
        return view('pages.glossary', [
            ...$this->base(),
            'title' => 'Glossary',
            'terms' => GlossaryTerm::orderBy('term')->get(),
        ]);
    }
}