@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <td>
                            {{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.patient_number') }}
                        </th>
                        <td>
                            {{ $patient->patient_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.fullname') }}
                        </th>
                        <td>
                            {{ $patient->fullname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.father') }}
                        </th>
                        <td>
                            {{ $patient->father }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.mother') }}
                        </th>
                        <td>
                            {{ $patient->mother }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.birthdate') }}
                        </th>
                        <td>
                            {{ $patient->birthdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.gender') }}
                        </th>
                        <td>
                            {{ $patient->gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.marital_status') }}
                        </th>
                        <td>
                            {{ $patient->marital_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.phone') }}
                        </th>
                        <td>
                            {{ $patient->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.mobile') }}
                        </th>
                        <td>
                            {{ $patient->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.workplace') }}
                        </th>
                        <td>
                            {{ $patient->workplace }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.national_id') }}
                        </th>
                        <td>
                            {{ $patient->national_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.medical_history') }}
                        </th>
                        <td>
                            {{ $patient->medical_history }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.photo') }}
                        </th>
                        <td>
                            @if($patient->photo)
                                <a href="{{ $patient->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $patient->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="table-responsive">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ trans('cruds.diagnosis.title_singular') }}</span>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.diagnoses.create', ['patient_id' => $patient->id]) }}">
                        {{ trans('global.add') }} {{ trans('cruds.diagnosis.title_singular') }}
                    </a>
                </div>
                <div class="card-body">
                    @if($patient->diagnoses->count())
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ trans('cruds.diagnosis.fields.id') }}</th>
                                <th>{{ trans('cruds.diagnosis.fields.chief_complaint') }}</th>
                                <th>{{ trans('cruds.diagnosis.fields.diagnosis') }}</th>
                                <th>{{ trans('cruds.diagnosis.fields.treatment') }}</th>
                                <th>{{ trans('cruds.diagnosis.fields.follow_up') }}</th>
                                <th>{{ trans('cruds.diagnosis.fields.clinical_examination') }}</th>
                                <th>{{ trans('global.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($patient->diagnoses as $diagnosis)
                                <tr>
                                    <td>{{ $diagnosis->id }}</td>
                                    <td>{{ Str::limit($diagnosis->chief_complaint, 30) }}</td>
                                    <td>{{ Str::limit($diagnosis->diagnosis, 50) }}</td>
                                    <td>{{ Str::limit($diagnosis->treatment, 50) }}</td>
                                    <td>{{ Str::limit($diagnosis->follow_up, 30) }}</td>
                                    <td>{{ Str::limit($diagnosis->clinical_examination, 30) }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.diagnoses.show', $diagnosis->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.diagnoses.edit', $diagnosis->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                        <form action="{{ route('admin.diagnoses.destroy', $diagnosis->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف هذا التشخيص؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                {{ trans('global.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                    @else
                        <p>{{ trans('cruds.diagnosis.no_records')  }}</p>
                    @endif
                </div>
            </div>

            <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
