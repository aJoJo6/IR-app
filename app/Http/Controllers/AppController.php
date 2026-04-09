<?php

namespace App\Http\Controllers;

use App\Models\Revolution;
use App\Models\Criterion;
use App\Models\Evaluation;
use App\Models\GlossaryTerm;
use Illuminate\Http\Request;

// app controller
class AppController extends Controller
{
    // shared app data
    private function base(): array
    {
        return [
            'appName' => 'Industrial Revolutions Explorer', // app name
            'categories' => config('ir.categories'), // fallback categories
        ];
    }

    // home page
    public function home()
    {
        return view('pages.home', [
            ...$this->base(),
            'title' => 'Home', // page title
        ]);
    }

    // explore page
    public function explore()
    {
        return view('pages.explore', [
            ...$this->base(),
            'title' => 'Explore Revolutions', // page title
            'revolutions' => Revolution::orderBy('id')->get(), // all revolutions
        ]);
    }

    // single revolution page
    public function revolution(string $id)
    {
        $revolution = Revolution::with('sections')
            ->where('slug', $id)
            ->firstOrFail(); // selected revolution

        $categories = $revolution->sections
            ->pluck('section_title', 'section_key')
            ->toArray(); // section list

        $content = $revolution->sections
            ->pluck('body', 'section_key')
            ->toArray(); // section content

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
            'title' => $revolution->title, // page title
            'revolution' => $revolutionData, // page data
            'categories' => $categories, // section labels
        ]);
    }

    // single revolution section page
    public function revolutionSection(string $id, string $section)
    {
        $revolution = Revolution::with('sections')
            ->where('slug', $id)
            ->firstOrFail(); // selected revolution

        $sectionRecord = $revolution->sections
            ->firstWhere('section_key', $section); // selected section

        abort_unless($sectionRecord, 404); // valid section

        $categories = $revolution->sections
            ->pluck('section_title', 'section_key')
            ->toArray(); // section list

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
            'title' => $revolution->label . ' - ' . $sectionRecord->section_title, // page title
            'revolution' => $revolutionData, // page data
            'categories' => $categories, // section labels
            'sectionKey' => $sectionRecord->section_key, // section key
            'sectionTitle' => $sectionRecord->section_title, // section title
            'sectionContent' => $sectionRecord->body, // section body
            'sectionImage' => $sectionRecord->image_path, // section image
        ]);
    }

    // compare page
    public function compare(Request $request)
    {
        $revolutions = Revolution::with('sections')->orderBy('id')->get(); // all revolutions

        $leftId = $request->query('left', 'ir1'); // left selection
        $rightId = $request->query('right', 'ir4'); // right selection

        $left = $revolutions->firstWhere('slug', $leftId) ?? $revolutions->first(); // left revolution
        $right = $revolutions->firstWhere('slug', $rightId) ?? $revolutions->skip(1)->first() ?? $left; // right revolution

        if ($left->slug === $right->slug) {
            $right = $revolutions->firstWhere('slug', 'ir4') ?? $revolutions->skip(1)->first() ?? $left; // avoid duplicate
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

        $categories = $left->sections->pluck('section_title', 'section_key')->toArray(); // compare labels

        return view('pages.compare', [
            ...$this->base(),
            'title' => 'Compare Revolutions', // page title
            'revolutions' => $revolutions->mapWithKeys(fn ($r) => [
                $r->slug => [
                    'id' => $r->slug,
                    'label' => $r->label,
                    'title' => $r->title,
                ]
            ])->toArray(), // selector data
            'categories' => $categories, // compare categories
            'left' => $leftData, // left side
            'right' => $rightData, // right side
        ]);
    }

    // criteria page
    public function criteria()
    {
        return view('pages.criteria', [
            'title' => 'Criteria',
            'criteriaBlocks' => Criterion::all(),
        ]);
    }

    // evaluation page
    public function evaluation()
    {
        return view('pages.evaluation', [
            'title' => 'Evaluation',
            'data' => Evaluation::all(),
        ]);
    }

    // glossary page
    public function glossary()
    {
        return view('pages.glossary', [
            'title' => 'Glossary',
            'terms' => GlossaryTerm::all(),
        ]);
    }
}