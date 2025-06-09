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
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }
        /* Textarea styling */
        textarea.form-control {
            font-size: 0.9rem;
            resize: vertical;
            min-height: 50px;
            max-height: 90px;
            line-height: 1.2;
        }
        /* Inputs height */
        input.form-control, select.form-control {
            height: 35px;
            font-size: 0.9rem;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.diagnosis.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.diagnoses.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="required" for="patient_id">{{ trans('cruds.diagnosis.fields.patient') }}</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('patient_id') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                            @if(!isset($patientId))
                                <option value="" selected></option>
                            @endif

                            @foreach($patients as $id => $fullname)
                                <option value="{{ $id }}"
                                @if(old('patient_id'))
                                    @selected(old('patient_id') == $id)
                                    @elseif(isset($patientId))
                                    @selected($patientId == $id)
                                    @endif
                                >
                                    {{ $fullname }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    @error('patient_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(trans('cruds.diagnosis.fields.patient_helper') != 'cruds.diagnosis.fields.patient_helper')
                        <span class="help-block">{{ trans('cruds.diagnosis.fields.patient_helper') }}</span>
                    @endif
                </div>

                {{-- Textareas arranged 2 per row --}}
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
                            <label for="{{ $field }}">
                                <i class="{{ $icons[$field] ?? 'fas fa-file-alt' }}"></i>
                                {{ trans("cruds.diagnosis.fields.$field") }}
                            </label>
                            <textarea class="form-control {{ $errors->has($field) ? 'is-invalid' : '' }}"
                                      name="{{ $field }}" id="{{ $field }}" rows="3">{{ old($field) }}</textarea>
                            @if($errors->has($field))
                                <div class="invalid-feedback">{{ $errors->first($field) }}</div>
                            @endif
                            <span class="help-block">{{ trans("cruds.diagnosis.fields.{$field}_helper") }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Short Fields in one row --}}
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
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="{{ $shortIcons[$field] }}"></i></span>
                                </div>
                                <input class="form-control form-control-sm {{ $errors->has($field) ? 'is-invalid' : '' }}"
                                       type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, '') }}">
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
                        {{ trans('global.save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
