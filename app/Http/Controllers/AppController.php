<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    // shared app data
    private function base(): array
    {
        return [
            'appName' => 'Industrial Revolutions Explorer', // app name
            'revolutions' => config('ir.items'),            // revolution records
            'categories' => config('ir.categories'),        // shared categories
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
        ]);
    }

    // single revolution page
    public function revolution(string $id)
    {
        $data = $this->base(); // shared data

        abort_unless(isset($data['revolutions'][$id]), 404); // valid revolution id

        return view('pages.revolution', [
            ...$data,
            'title' => $data['revolutions'][$id]['title'],     // page title
            'revolution' => $data['revolutions'][$id],         // selected revolution
        ]);
    }

    // compare page
    public function compare(Request $request)
    {
        $data = $this->base(); // shared data

        $leftId = $request->query('left', 'ir1');   // left selection
        $rightId = $request->query('right', 'ir4'); // right selection

        if (!isset($data['revolutions'][$leftId])) {
            $leftId = array_key_first($data['revolutions']); // fallback left id
        }

        if (!isset($data['revolutions'][$rightId])) {
            $rightId = array_key_first($data['revolutions']); // fallback right id
        }

        if ($leftId === $rightId) {
            $keys = array_keys($data['revolutions']); // available ids
            $rightId = $keys[1] ?? $leftId;           // avoid duplicate selection
        }

        return view('pages.compare', [
            ...$data,
            'title' => 'Compare Revolutions',            // page title
            'left' => $data['revolutions'][$leftId],     // left revolution
            'right' => $data['revolutions'][$rightId],   // right revolution
        ]);
    }

    // criteria page
    public function criteria()
    {
        return view('pages.criteria', [
            'title' => 'Criteria',                      // page title
            'criteriaBlocks' => config('criteria.blocks'), // criteria content
        ]);
    }

    // evaluation page
    public function evaluation()
    {
        return view('pages.evaluation', [
            'title' => 'Evaluation',                    // page title
            'criteria' => config('evaluation.criteria'), // evaluation criteria
            'ir4' => config('evaluation.ir4'),          // ir4 results
            'ir5' => config('evaluation.ir5'),          // ir5 results
            'legend' => config('evaluation.legend'),    // legend text
        ]);
    }

    // glossary page
    public function glossary()
    {
        return view('pages.glossary', [
            'title' => 'Glossary',                   // page title
            'terms' => config('glossary.terms'),    // glossary terms
        ]);
    }
}