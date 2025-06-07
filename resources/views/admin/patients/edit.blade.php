@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.patient.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.patients.update', [$patient->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="required" for="fullname">{{ trans('cruds.patient.fields.fullname') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="form-control form-control-sm {{ $errors->has('fullname') ? 'is-invalid' : '' }}" type="text" name="fullname" id="fullname" value="{{ old('fullname', $patient->fullname) }}" required>
                        </div>
                        @if($errors->has('fullname'))
                            <span class="text-danger">{{ $errors->first('fullname') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.fullname_helper') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="father">{{ trans('cruds.patient.fields.father') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            </div>
                            <input class="form-control form-control-sm {{ $errors->has('father') ? 'is-invalid' : '' }}" type="text" name="father" id="father" value="{{ old('father', $patient->father) }}">
                        </div>
                        @if($errors->has('father'))
                            <span class="text-danger">{{ $errors->first('father') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.father_helper') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="mother">{{ trans('cruds.patient.fields.mother') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>
                            <input class="form-control form-control-sm {{ $errors->has('mother') ? 'is-invalid' : '' }}" type="text" name="mother" id="mother" value="{{ old('mother', $patient->mother) }}">
                        </div>
                        @if($errors->has('mother'))
                            <span class="text-danger">{{ $errors->first('mother') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.mother_helper') }}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="birthdate">{{ trans('cruds.patient.fields.birthdate') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input class="form-control form-control-sm date {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="text" name="birthdate" id="birthdate" value="{{ old('birthdate', $patient->birthdate) }}">
                        </div>
                        @if($errors->has('birthdate'))
                            <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.birthdate_helper') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="gender">{{ trans('cruds.patient.fields.gender') }}</label>
                        <select class="form-control form-control-sm {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                            <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $key => $label)
                                <option value="{{ $key }}" {{ old('gender', $patient->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.gender_helper') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="marital_status">{{ trans('cruds.patient.fields.marital_status') }}</label>
                        <select class="form-control form-control-sm {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status">
                            <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(['single' => 'Single', 'married' => 'Married', 'divorced' => 'Divorced', 'widowed' => 'Widowed'] as $key => $label)
                                <option value="{{ $key }}" {{ old('marital_status', $patient->marital_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('marital_status'))
                            <span class="text-danger">{{ $errors->first('marital_status') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.marital_status_helper') }}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="phone">{{ trans('cruds.patient.fields.phone') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input class="form-control form-control-sm {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}">
                        </div>
                        @if($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.phone_helper') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="mobile">{{ trans('cruds.patient.fields.mobile') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            </div>
                            <input class="form-control form-control-sm {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $patient->mobile) }}">
                        </div>
                        @if($errors->has('mobile'))
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.mobile_helper') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="workplace">{{ trans('cruds.patient.fields.workplace') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                            </div>
                            <input class="form-control form-control-sm {{ $errors->has('workplace') ? 'is-invalid' : '' }}" type="text" name="workplace" id="workplace" value="{{ old('workplace', $patient->workplace) }}">
                        </div>
                        @if($errors->has('workplace'))
                            <span class="text-danger">{{ $errors->first('workplace') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.workplace_helper') }}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="national_id">{{ trans('cruds.patient.fields.national_id') }}</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input class="form-control form-control-sm {{ $errors->has('national_id') ? 'is-invalid' : '' }}" type="text" name="national_id" id="national_id" value="{{ old('national_id', $patient->national_id) }}">
                        </div>
                        @if($errors->has('national_id'))
                            <span class="text-danger">{{ $errors->first('national_id') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.national_id_helper') }}</small>
                    </div>

                    <div class="form-group col-md-8">
                        <label for="medical_history">{{ trans('cruds.patient.fields.medical_history') }}</label>
                        <textarea class="form-control form-control-sm {{ $errors->has('medical_history') ? 'is-invalid' : '' }}" name="medical_history" id="medical_history" rows="3">{{ old('medical_history', $patient->medical_history) }}</textarea>
                        @if($errors->has('medical_history'))
                            <span class="text-danger">{{ $errors->first('medical_history') }}</span>
                        @endif
                        <small class="form-text text-muted">{{ trans('cruds.patient.fields.medical_history_helper') }}</small>
                    </div>
                </div>

                <button class="btn btn-danger btn-sm" type="submit">
                    {{ trans('global.save') }}
                </button>
            </form>
        </div>
    </div>

@endsection
