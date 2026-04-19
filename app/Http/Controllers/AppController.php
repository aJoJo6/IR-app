<?php

namespace App\Http\Controllers;

use App\Models\Revolution;
use App\Models\Criterion;
use App\Models\Evaluation;
use App\Models\GlossaryTerm;
use Illuminate\Http\Request;

class AppController extends Controller
{
    // shared data for page views
    private function base(): array
    {
        return [
            'appName' => 'Industrial Revolutions Explorer',
            'categories' => config('ir.categories'),
        ];
    }

    // show home page
    public function home()
    {
        return view('pages.home', [
            ...$this->base(),
            'title' => 'Home',
        ]);
    }

    // show all revolutions
    public function explore()
    {
        return view('pages.explore', [
            ...$this->base(),
            'title' => 'Explore Revolutions',
            'revolutions' => Revolution::orderBy('id')->get(),
        ]);
    }

    // show one revolution overview
    public function revolution(string $id)
    {
        $revolution = Revolution::with('sections')
            ->where('slug', $id)
            ->firstOrFail();

        // build section menu
        $categories = $revolution->sections
            ->pluck('section_title', 'section_key')
            ->toArray();

        // build section content map
        $content = $revolution->sections
            ->pluck('body', 'section_key')
            ->toArray();

        // prepare revolution data
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

    // show one revolution section
    public function revolutionSection(string $id, string $section)
    {
        $revolution = Revolution::with(['sections.images'])
            ->where('slug', $id)
            ->firstOrFail();

        // find selected section
        $sectionRecord = $revolution->sections->firstWhere('section_key', $section);

        abort_unless($sectionRecord, 404);

        // build section menu
        $categories = $revolution->sections
            ->pluck('section_title', 'section_key')
            ->toArray();

        // prepare revolution data
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

    // show comparison page
    public function compare(Request $request)
    {
        $revolutions = Revolution::with('sections')->orderBy('id')->get();

        // get selected revolutions
        $leftId = $request->query('left', 'ir1');
        $rightId = $request->query('right', 'ir4');

        $left = $revolutions->firstWhere('slug', $leftId) ?? $revolutions->first();
        $right = $revolutions->firstWhere('slug', $rightId) ?? $revolutions->skip(1)->first() ?? $left;

        // avoid comparing the same revolution
        if ($left->slug === $right->slug) {
            $right = $revolutions->firstWhere('slug', 'ir4') ?? $revolutions->skip(1)->first() ?? $left;
        }

        // prepare left panel data
        $leftData = [
            'id' => $left->slug,
            'label' => $left->label,
            'title' => $left->title,
            'years' => $left->years,
            'summary' => $left->summary,
            'content' => $left->sections->pluck('body', 'section_key')->toArray(),
        ];

        // prepare right panel data
        $rightData = [
            'id' => $right->slug,
            'label' => $right->label,
            'title' => $right->title,
            'years' => $right->years,
            'summary' => $right->summary,
            'content' => $right->sections->pluck('body', 'section_key')->toArray(),
        ];

        // use left revolution sections as categories
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

    // show criteria page
    public function criteria()
    {
        return view('pages.criteria', [
            ...$this->base(),
            'title' => 'Criteria',
            'criteriaBlocks' => Criterion::orderBy('id')->get(),
        ]);
    }

    // show evaluation page
    public function evaluation()
    {
        $criteria = Criterion::orderBy('id')->get();

        $evaluations = Evaluation::orderBy('revolution')->orderBy('id')->get();

        // map evaluations by criterion and revolution
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

    // show glossary page
    public function glossary()
    {
        return view('pages.glossary', [
            ...$this->base(),
            'title' => 'Glossary',
            'terms' => GlossaryTerm::orderBy('term')->get(),
        ]);
    }
}