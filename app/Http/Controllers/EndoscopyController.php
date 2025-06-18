<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyEndoscopyRequest;
use App\Models\Endoscopy;
use App\Models\EndoscopySection;
use App\Models\Patient;
use App\Models\EndoscopyTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EndoscopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $endoscopies = Endoscopy::with('patient')->latest()->paginate(20);
        return view('admin.endoscopies.index', compact('endoscopies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::with('latestEndoscopy')->get();

        $templates = EndoscopyTemplate::orderBy('order')->get()->groupBy('type');
        return view('admin.endoscopies.create', compact('patients', 'templates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:upper,lower',
            'patient_id' => 'required|exists:patients,id',
            'performed_at' => 'required|date',
            'sections' => 'required|array',
            'sections.*.template_id' => 'required|exists:endoscopy_templates,id',
        ]);

        $endoscopy = Endoscopy::create([
            'patient_id' => $request->patient_id,
            'type' => $request->type,
            'performed_at' => $request->performed_at,
            'notes' => $request->notes,
        ]);

        foreach ($request->sections as $section) {
            $endoscopy->sections()->create([
                'template_id' => $section['template_id'],
                'status' => $section['status'] ?? null,
                'description' => $section['description'] ?? null,
            ]);
        }


        return redirect()->route('admin.endoscopies.index')->with('success', __('endoscopy.saved_successfully'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $endoscopy = Endoscopy::with('patient', 'sections')->findOrFail($id);
        return view('admin.endoscopies.show', compact('endoscopy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $endoscopy = Endoscopy::with('sections')->findOrFail($id);
        $patients = Patient::all();
        $templates = EndoscopyTemplate::orderBy('order')->get()->groupBy('type');

        return view('admin.endoscopies.edit', compact('endoscopy', 'patients', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $endoscopy = Endoscopy::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'type' => 'required|in:upper,lower',
            'performed_at' => 'required|date',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sections' => 'nullable|array',
            'sections.*.template_id' => 'required|exists:endoscopy_templates,id',
            'sections.*.status' => 'nullable|string',
            'sections.*.description' => 'nullable|string',
        ]);

        // التعامل مع رفع الملف وإزالة القديم إن وجد
        if ($request->hasFile('attachment')) {
            if ($endoscopy->attachment && Storage::disk('public')->exists($endoscopy->attachment)) {
                Storage::disk('public')->delete($endoscopy->attachment);
            }
            $validated['attachment'] = $request->file('attachment')->store('attachments/endoscopies', 'public');
        }

        // تحديث بيانات التقرير الرئيسية
        $endoscopy->update([
            'patient_id' => $validated['patient_id'],
            'type' => $validated['type'],
            'performed_at' => $validated['performed_at'],
            'notes' => $validated['notes'] ?? null,
            'attachment' => $validated['attachment'] ?? $endoscopy->attachment,
        ]);

        // حذف الأقسام القديمة
        $endoscopy->sections()->delete();

        // إعادة إدخال الأقسام الجديدة
        if (!empty($validated['sections'])) {
            foreach ($validated['sections'] as $section) {
                $endoscopy->sections()->create([
                    'template_id' => $section['template_id'],
                    'status' => $section['status'] ?? null,
                    'description' => $section['description'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.endoscopies.index')
            ->with('success', 'تم تعديل تقرير التنظير بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $endoscopy = Endoscopy::findOrFail($id);

        if ($endoscopy->attachment) {
            Storage::disk('public')->delete($endoscopy->attachment);
        }

        $endoscopy->delete();

        return redirect()->back()->with('success', 'تم حذف تقرير التنظير');
    }
    public function massDestroy(MassDestroyEndoscopyRequest $request)
    {

        $endoscopies = Endoscopy::find(request('ids'));

        foreach ($endoscopies as $endoscopy) {
            $endoscopy->delete();
            Log::warning('Endoscopy mass deleted: ' . $endoscopy->id);
        }

        return response(null, ResponseAlias::HTTP_NO_CONTENT);
    }
    public function info($id)
    {
        $patient = Patient::with('latestEndoscopy')->find($id);

        if (!$patient) {
            return response()->json(['error' => 'المريض غير موجود'], 404);
        }

        return response()->json([
           $patient
        ]);
    }


}
