<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::select('id', 'patient_number', 'fullname', 'gender', 'mobile', 'national_id')->get();


        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patients.create');
    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());

        if (!$patient) {
            return back()->withErrors(['error' => 'Failed to save patient.']);
        }

        Log::info('New patient created: ' . $patient->id);

        if ($request->input('photo', false)) {
            $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $patient->id]);
        }

        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient)
    {
        abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->load('diagnoses');

        return view('admin.patients.edit', compact('diagnoses'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $success = $patient->update($request->all());

        if (!$success) {
            return back()->withErrors(['error' => 'Failed to update patient.']);
        }

        Log::info('Patient updated: ' . $patient->id);

        if ($request->input('photo', false)) {
            if (! $patient->photo || $request->input('photo') !== $patient->photo->file_name) {
                if ($patient->photo) {
                    $patient->photo->delete();
                }
                $patient->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($patient->photo) {
            $patient->photo->delete();
        }

        return redirect()->route('admin.patients.index');
    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->load('diagnoses');


        return view('admin.patients.show', compact('patient'));
    }

    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        Log::warning('Patient deleted: ' . $patient->id);

        return back();
    }

    public function massDestroy(MassDestroyPatientRequest $request)
    {
        $patients = Patient::find(request('ids'));

        foreach ($patients as $patient) {
            $patient->delete();
            Log::warning('Patient mass deleted: ' . $patient->id);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('patient_create') && Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Patient();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
