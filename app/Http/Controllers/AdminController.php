<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\Evaluation;
use App\Models\GlossaryTerm;
use App\Models\Revolution;
use App\Models\RevolutionSection;
use App\Models\SectionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // show admin login page
    public function loginForm()
    {
        return view('admin.login', [
            'title' => 'Admin Login',
        ]);
    }

    // handle admin login
    public function login(Request $request)
    {
        if ($request->input('password') === config('admin.password')) {
            session(['is_admin' => true]);

            return redirect()->route('admin.index');
        }

        return back()->with('error', 'Invalid password');
    }

    // log admin out
    public function logout()
    {
        session()->forget('is_admin');

        return redirect()->route('home');
    }

    // show admin dashboard
    public function index()
    {
        return view('admin.index', [
            'title' => 'Admin',
            'revolutions' => Revolution::with('sections')->orderBy('id')->get(),
        ]);
    }

    // show criteria list
    public function criteria()
    {
        return view('admin.criteria', [
            'title' => 'Edit Criteria',
            'criteria' => Criterion::orderBy('id')->get(),
        ]);
    }

    // show evaluation matrix
    public function evaluation()
    {
        $criteria = Criterion::orderBy('id')->get();

        $evaluations = Evaluation::orderBy('revolution')->orderBy('id')->get();

        // map evaluations by criterion and revolution
        $evaluationMap = $evaluations->keyBy(function ($item) {
            return strtolower(trim($item->criterion)) . '|' . strtolower(trim($item->revolution));
        });

        return view('admin.evaluation', [
            'title' => 'Edit Evaluation',
            'criteria' => $criteria,
            'evaluationMap' => $evaluationMap,
        ]);
    }

    // show glossary list
    public function glossary()
    {
        return view('admin.glossary', [
            'title' => 'Edit Glossary',
            'terms' => GlossaryTerm::orderBy('term')->get(),
        ]);
    }

    // show revolution edit page
    public function editRevolution(Revolution $revolution)
    {
        return view('admin.edit-revolution', [
            'title' => 'Edit Revolution',
            'revolution' => $revolution,
        ]);
    }

    // update revolution details
    public function updateRevolution(Request $request, Revolution $revolution)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'years' => 'required|string|max:255',
            'summary' => 'required|string',
            'hero_image' => 'nullable|image|max:2048',
        ]);

        // replace hero image if uploaded
        if ($request->hasFile('hero_image')) {
            if ($revolution->hero_image) {
                Storage::disk('public')->delete($revolution->hero_image);
            }

            $validated['hero_image'] = $request->file('hero_image')->store('revolutions', 'public');
        }

        $revolution->update($validated);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Revolution updated successfully.');
    }

    // show section edit page
    public function editSection(RevolutionSection $section)
    {
        return view('admin.edit-section', [
            'title' => 'Edit Section',
            'section' => $section->load(['revolution', 'images']),
        ]);
    }

    // update section content
    public function updateSection(Request $request, RevolutionSection $section)
    {
        $validated = $request->validate([
            'section_title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $section->update($validated);

        return redirect()
            ->route('admin.sections.edit', $section)
            ->with('success', 'Section updated successfully.');
    }

    // add images to section gallery
    public function addSectionImages(Request $request, RevolutionSection $section)
    {
        $validated = $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:4096',
        ]);

        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('section-gallery', 'public');

            SectionImage::create([
                'revolution_section_id' => $section->id,
                'image_path' => $path,
                'caption' => null,
                'sort_order' => $index,
            ]);
        }

        return redirect()
            ->route('admin.sections.edit', $section)
            ->with('success', 'Images added successfully.');
    }

    // delete section image
    public function deleteSectionImage(SectionImage $image)
    {
        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }

        $section = $image->section;
        $image->delete();

        return redirect()
            ->route('admin.sections.edit', $section)
            ->with('success', 'Image deleted successfully.');
    }

    // show criterion edit page
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

        $oldTitle = $criterion->title;

        $criterion->update($validated);

        // keep linked evaluations in sync
        if ($oldTitle !== $validated['title']) {
            Evaluation::where('criterion', $oldTitle)->update([
                'criterion' => $validated['title'],
            ]);
        }

        return redirect()
            ->route('admin.criteria')
            ->with('success', 'Criterion updated successfully.');
    }

    // show glossary term edit page
    public function editGlossary(GlossaryTerm $term)
    {
        return view('admin.edit-glossary', [
            'title' => 'Edit Glossary Term',
            'term' => $term,
        ]);
    }

    // update glossary term
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

    // show evaluation edit page
    public function editEvaluation(Evaluation $evaluation)
    {
        return view('admin.edit-evaluation', [
            'title' => 'Edit Evaluation',
            'evaluation' => $evaluation,
        ]);
    }

    // update full evaluation
    public function updateEvaluation(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'revolution' => 'required|in:ir4,ir5',
            'criterion' => 'required|string|max:255',
            'value' => 'required|in:Meets,Partial,Unclear,Does Not Meet',
        ]);

        $evaluation->update($validated);

        return redirect()
            ->route('admin.evaluation')
            ->with('success', 'Evaluation updated successfully.');
    }

    // update only evaluation value
    public function updateEvaluationValue(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'value' => 'required|in:Meets,Partial,Unclear,Does Not Meet',
        ]);

        $evaluation->update([
            'value' => $validated['value'],
        ]);

        return redirect()
            ->route('admin.evaluation')
            ->with('success', 'Evaluation value updated successfully.');
    }

    // save evaluation for one criterion
    public function storeEvaluationCriterion(Request $request)
    {
        $validated = $request->validate([
            'criterion_id' => 'required|exists:criteria,id',
            'revolution' => 'required|in:ir4,ir5',
            'value' => 'required|in:Meets,Partial,Unclear,Does Not Meet',
        ]);

        $criterion = Criterion::findOrFail($validated['criterion_id']);

        Evaluation::updateOrCreate(
            [
                'criterion' => $criterion->title,
                'revolution' => $validated['revolution'],
            ],
            [
                'value' => $validated['value'],
            ]
        );

        return redirect()
            ->route('admin.evaluation')
            ->with('success', 'Evaluation value saved successfully.');
    }

    // update evaluation matrix
    public function updateEvaluationMatrix(Request $request)
    {
        $validated = $request->validate([
            'rows' => 'required|array',
            'rows.*.criterion_id' => 'required|exists:criteria,id',
            'rows.*.ir4' => 'nullable|in:Meets,Partial,Unclear,Does Not Meet',
            'rows.*.ir5' => 'nullable|in:Meets,Partial,Unclear,Does Not Meet',
        ]);

        foreach ($validated['rows'] as $row) {
            $criterion = Criterion::find($row['criterion_id']);

            if (!$criterion) {
                continue;
            }

            if (!empty($row['ir4'])) {
                Evaluation::updateOrCreate(
                    [
                        'criterion' => $criterion->title,
                        'revolution' => 'ir4',
                    ],
                    [
                        'value' => $row['ir4'],
                    ]
                );
            }

            if (!empty($row['ir5'])) {
                Evaluation::updateOrCreate(
                    [
                        'criterion' => $criterion->title,
                        'revolution' => 'ir5',
                    ],
                    [
                        'value' => $row['ir5'],
                    ]
                );
            }
        }

        return redirect()
            ->route('admin.evaluation')
            ->with('success', 'Evaluation matrix updated successfully.');
    }

    // show create criterion page
    public function createCriterion()
    {
        return view('admin.create-criterion', [
            'title' => 'Add Criterion',
        ]);
    }

    // store new criterion
    public function storeCriterion(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:criteria,title',
            'description' => 'required|string',
        ]);

        Criterion::create($validated);

        return redirect()
            ->route('admin.evaluation')
            ->with('success', 'Criterion added successfully.');
    }

    // show create glossary page
    public function createGlossary()
    {
        return view('admin.create-glossary', [
            'title' => 'Add Glossary Term',
        ]);
    }

    // store new glossary term
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

    // delete criterion and linked evaluations
    public function destroyEvaluationCriterion(Criterion $criterion)
    {
        Evaluation::where('criterion', $criterion->title)->delete();
        $criterion->delete();

        return redirect()
            ->route('admin.evaluation')
            ->with('success', 'Criterion deleted successfully.');
    }
}