@extends('layouts.admin')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            direction: rtl;
            text-align: right;
        }
        .form-group label {
            font-weight: bold;
        }
        textarea.form-control {
            resize: vertical;
            min-height: 50px;
            max-height: 90px;
            line-height: 1.2;
            font-size: 0.9rem;
        }
        input.form-control, select.form-control {
            height: 35px;
            font-size: 0.9rem;
        }
        /* تعديل لتوجيه أيقونات input-group في RTL */
        .input-group-prepend {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        .input-group-text {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.diagnosis.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.diagnoses.update', [$diagnosis->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label class="required" for="patient_id">{{ trans('cruds.diagnosis.fields.patient') }}</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control select2 {{ $errors->has('patient_id') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                            @foreach($patients as $id => $entry)
                                <option value="{{ $id }}" {{ (old('patient_id') ?? $diagnosis->patient_id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                        </div>
                    </div>
                    @if($errors->has('patient_id'))
                        <div class="invalid-feedback">{{ $errors->first('patient_id') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.diagnosis.fields.patient_helper') }}</span>
                </div>

                <div class="row">
                    @php
                        $textareas = [
                            'chief_complaint', 'medical_history', 'clinical_examination', 'abdominal_examination',
                            'abdominal_ultrasound', 'laboratory_tests', 'upper_endoscopy', 'lower_endoscopy',
                            'ercp', 'further_investigations', 'diagnosis', 'treatment', 'follow_up', 'notes'
                        ];

                        $icons = [
                            'chief_complaint' => 'fas fa-notes-medical',
                            'medical_history' => 'fas fa-file-medical-alt',
                            'clinical_examination' => 'fas fa-stethoscope',
                            'abdominal_examination' => 'fas fa-procedures',
                            'abdominal_ultrasound' => 'fas fa-ultrasound',
                            'laboratory_tests' => 'fas fa-vials',
                            'upper_endoscopy' => 'fas fa-video',
                            'lower_endoscopy' => 'fas fa-video',
                            'ercp' => 'fas fa-x-ray',
                            'further_investigations' => 'fas fa-search',
                            'diagnosis' => 'fas fa-diagnoses',
                            'treatment' => 'fas fa-pills',
                            'follow_up' => 'fas fa-calendar-check',
                            'notes' => 'fas fa-clipboard'
                        ];
                    @endphp

                    @foreach($textareas as $field)
                        <div class="form-group col-md-6">
                            <label for="{{ $field }}">{{ trans("cruds.diagnosis.fields.$field") }}</label>
                            <div class="input-group input-group-sm">
                                <textarea class="form-control {{ $errors->has($field) ? 'is-invalid' : '' }}"
                                          name="{{ $field }}" id="{{ $field }}" rows="3">{{ old($field, $diagnosis->$field) }}</textarea>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="{{ $icons[$field] ?? 'fas fa-file-alt' }}"></i></span>
                                </div>
                            </div>
                            @if($errors->has($field))
                                <div class="invalid-feedback">{{ $errors->first($field) }}</div>
                            @endif
                            <span class="help-block">{{ trans("cruds.diagnosis.fields.{$field}_helper") }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    @php
                        $shortFields = ['sat', 'rr', 'hr', 'bp'];
                        $shortIcons = [
                            'sat' => 'fas fa-lungs',
                            'rr' => 'fas fa-wind',
                            'hr' => 'fas fa-heartbeat',
                            'bp' => 'fas fa-tachometer-alt'
                        ];
                    @endphp
                    @foreach($shortFields as $field)
                        <div class="form-group col-md-3">
                            <label for="{{ $field }}">{{ trans("cruds.diagnosis.fields.$field") }}</label>
                            <div class="input-group input-group-sm">
                                <input class="form-control {{ $errors->has($field) ? 'is-invalid' : '' }}"
                                       type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $diagnosis->$field) }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="{{ $shortIcons[$field] }}"></i></span>
                                </div>
                            </div>
                            @if($errors->has($field))
                                <div class="invalid-feedback">{{ $errors->first($field) }}</div>
                            @endif
                            <span class="help-block">{{ trans("cruds.diagnosis.fields.{$field}_helper") }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="form-group mt-3">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.update') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
