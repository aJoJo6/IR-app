<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\Evaluation;
use App\Models\GlossaryTerm;
use App\Models\Revolution;
use App\Models\RevolutionSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// admin controller
class AdminController extends Controller
{
    // login form
    public function loginForm()
    {
        return view('admin.login', [
            'title' => 'Admin Login',
        ]);
    }

    // login action
    public function login(Request $request)
    {
        if ($request->input('password') === config('admin.password')) {
            session(['is_admin' => true]);

            return redirect()->route('admin.index');
        }

        return back()->with('error', 'Invalid password');
    }

    // logout action
    public function logout()
    {
        session()->forget('is_admin');

        return redirect()->route('home');
    }

    // admin dashboard
    public function index()
    {
        return view('admin.index', [
            'title' => 'Admin',
            'revolutions' => Revolution::with('sections')->orderBy('id')->get(),
        ]);
    }

    // criteria list page
    public function criteria()
    {
        return view('admin.criteria', [
            'title' => 'Edit Criteria',
            'criteria' => Criterion::orderBy('id')->get(),
        ]);
    }

    // evaluation list page
    public function evaluation()
    {
        return view('admin.evaluation', [
            'title' => 'Edit Evaluation',
            'evaluations' => Evaluation::orderBy('revolution')->orderBy('id')->get(),
        ]);
    }

    // glossary list page
    public function glossary()
    {
        return view('admin.glossary', [
            'title' => 'Edit Glossary',
            'terms' => GlossaryTerm::orderBy('term')->get(),
        ]);
    }

    // edit revolution page
    public function editRevolution(Revolution $revolution)
    {
        return view('admin.edit-revolution', [
            'title' => 'Edit Revolution',
            'revolution' => $revolution,
        ]);
    }

    // update revolution
    public function updateRevolution(Request $request, Revolution $revolution)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'years' => 'required|string|max:255',
            'summary' => 'required|string',
            'hero_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($revolution->hero_image) {
                Storage::disk('public')->delete($revolution->hero_image); // remove old image
            }

            $validated['hero_image'] = $request->file('hero_image')->store('revolutions', 'public'); // store image
        }

        $revolution->update($validated);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Revolution updated successfully.');
    }

    // edit section page
    public function editSection(RevolutionSection $section)
    {
        return view('admin.edit-section', [
            'title' => 'Edit Section',
            'section' => $section->load('revolution'),
        ]);
    }

    // update section
    public function updateSection(Request $request, RevolutionSection $section)
    {
        $validated = $request->validate([
            'section_title' => 'required|string|max:255',
            'body' => 'required|string',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($section->image_path) {
                Storage::disk('public')->delete($section->image_path); // remove old image
            }

            $validated['image_path'] = $request->file('image_path')->store('sections', 'public'); // store image
        }

        $section->update($validated);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Section updated successfully.');
    }

    // edit criterion page
    public function editCriterion(Criterion $criterion)
    {
        return view('admin.edit-criterion', [
            'title' => 'Edit Criterion',
            'criterion' => $criterion,
        ]);
    }

    // update criterion
    public function updateCriterion(Request $request, Criterion $criterion)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $criterion->update($validated);

        return redirect()
            ->route('admin.criteria')
            ->with('success', 'Criterion updated successfully.');
    }

    // edit glossary page
    public function editGlossary(GlossaryTerm $term)
    {
        return view('admin.edit-glossary', [
            'title' => 'Edit Glossary Term',
            'term' => $term,
        ]);
    }

    // update glossary
    public function updateGlossary(Request $request, GlossaryTerm $term)
    {
        $validated = $request->validate([
            'term' => 'required|string|max:255',
            'definition' => 'required|string',
        ]);

        $term->update($validated);

        return redirect()
            ->route('admin.glossary')
            ->with('success', 'Glossary term updated successfully.');
    }

    // edit evaluation page
    public function editEvaluation(Evaluation $evaluation)
    {
        return view('admin.edit-evaluation', [
            'title' => 'Edit Evaluation',
            'evaluation' => $evaluation,
        ]);
    }

    // update evaluation
    public function updateEvaluation(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'revolution' => 'required|string|max:255',
            'criterion' => 'required|string|max:255',
            'value' => 'required|string',
        ]);

        $evaluation->update($validated);

        return redirect()
            ->route('admin.evaluation')
            ->with('success', 'Evaluation updated successfully.');
    }
        // create criterion page
    public function createCriterion()
    {
        return view('admin.create-criterion', [
            'title' => 'Add Criterion',
        ]);
    }

    // store criterion
    public function storeCriterion(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Criterion::create($validated);

        return redirect()
            ->route('admin.criteria')
            ->with('success', 'Criterion added successfully.');
    }

    // create glossary page
    public function createGlossary()
    {
        return view('admin.create-glossary', [
            'title' => 'Add Glossary Term',
        ]);
    }

    // store glossary term
    public function storeGlossary(Request $request)
    {
        $validated = $request->validate([
            'term' => 'required|string|max:255',
            'definition' => 'required|string',
        ]);

        GlossaryTerm::create($validated);

        return redirect()
            ->route('admin.glossary')
            ->with('success', 'Glossary term added successfully.');
    }
}