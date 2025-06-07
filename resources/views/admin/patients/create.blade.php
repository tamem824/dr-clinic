@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}</span>
            <button class="btn btn-danger" type="submit" form="patient-form">
                <i class="fa fa-save"></i> {{ trans('global.save') }}
            </button>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.patients.store") }}" enctype="multipart/form-data" id="patient-form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="required" for="fullname">
                            <i class="fa fa-user mr-1 text-primary"></i> {{ trans('cruds.patient.fields.fullname') }}
                        </label>
                        <input class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" type="text" name="fullname" id="fullname" value="{{ old('fullname', '') }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="father">
                            <i class="fa fa-male mr-1 text-primary"></i> {{ trans('cruds.patient.fields.father') }}
                        </label>
                        <input class="form-control" type="text" name="father" id="father" value="{{ old('father', '') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="mother">
                            <i class="fa fa-female mr-1 text-primary"></i> {{ trans('cruds.patient.fields.mother') }}
                        </label>
                        <input class="form-control" type="text" name="mother" id="mother" value="{{ old('mother', '') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="birthdate">
                            <i class="fa fa-calendar-alt mr-1 text-primary"></i> {{ trans('cruds.patient.fields.birthdate') }}
                        </label>
                        <input class="form-control date" type="text" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gender">
                            <i class="fa fa-venus-mars mr-1 text-primary"></i> {{ trans('cruds.patient.fields.gender') }}
                        </label>
                        <select class="form-control" name="gender" id="gender">
                            <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $key => $label)
                                <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="marital_status">
                            <i class="fa fa-heart mr-1 text-primary"></i> {{ trans('cruds.patient.fields.marital_status') }}
                        </label>
                        <select class="form-control" name="marital_status" id="marital_status">
                            <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(['single' => 'Single', 'married' => 'Married', 'divorced' => 'Divorced', 'widowed' => 'Widowed'] as $key => $label)
                                <option value="{{ $key }}" {{ old('marital_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone">
                            <i class="fa fa-phone mr-1 text-primary"></i> {{ trans('cruds.patient.fields.phone') }}
                        </label>
                        <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="mobile">
                            <i class="fa fa-mobile-alt mr-1 text-primary"></i> {{ trans('cruds.patient.fields.mobile') }}
                        </label>
                        <input class="form-control" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="workplace">
                            <i class="fa fa-building mr-1 text-primary"></i> {{ trans('cruds.patient.fields.workplace') }}
                        </label>
                        <input class="form-control" type="text" name="workplace" id="workplace" value="{{ old('workplace', '') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="national_id">
                            <i class="fa fa-id-card mr-1 text-primary"></i> {{ trans('cruds.patient.fields.national_id') }}
                        </label>
                        <input class="form-control" type="text" name="national_id" id="national_id" value="{{ old('national_id', '') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="medical_history">
                            <i class="fa fa-notes-medical mr-1 text-primary"></i> {{ trans('cruds.patient.fields.medical_history') }}
                        </label>
                        <textarea class="form-control" name="medical_history" id="medical_history">{{ old('medical_history') }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="photo">
                            <i class="fa fa-image mr-1 text-primary"></i> {{ trans('cruds.patient.fields.photo') }}
                        </label>
                        <div class="needsclick dropzone" id="photo-dropzone"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.patients.storeMedia') }}',
            maxFilesize: 2,
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            params: { size: 2, width: 4096, height: 4096 },
            success: function (file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($patient) && $patient->photo)
                var file = {!! json_encode($patient->photo) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                var message = $.type(response) === 'string' ? response : response.errors.file
                file.previewElement.classList.add('dz-error')
                var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                var _results = []
                for (var _i = 0, _len = _ref.length; _i < _len; _i++) {
                    var node = _ref[_i]
                    _results.push(node.textContent = message)
                }
                return _results
            }
        }
    </script>
@endsection
