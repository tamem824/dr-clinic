@extends('layouts.admin')
@section('content')
    <div class="content py-4">
        <div class="container">

            <div class="row g-4 justify-content-center mb-4">
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.patients.create') }}" class="btn btn-primary btn-lg w-100 py-4">
                        <i class="fa-solid fa-user-plus me-2"></i>
                        {{ trans('cruds.buttons.add_patient') }}
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.diagnoses.create') }}" class="btn btn-success btn-lg w-100 py-4">
                        <i class="fa-solid fa-stethoscope me-2"></i>
                        {{ trans('cruds.buttons.add_diagnosis') }}
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-info btn-lg w-100 py-4">
                        <i class="fa-solid fa-users me-2"></i>
                        {{ trans('cruds.buttons.list_patients') }}
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('admin.diagnoses.index') }}" class="btn btn-warning btn-lg w-100 py-4">
                        <i class="fa-solid fa-notes-medical me-2"></i>
                        {{ trans('cruds.buttons.list_diagnoses') }}
                    </a>
                </div>
            </div>


            {{-- بحث المرضى --}}
            <form method="GET" action="{{ route('admin.home') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('Search Patients...') }}">
                    <button type="submit" class="btn btn-outline-secondary">{{ trans('global.search') }}</button>
                </div>
            </form>

            {{-- جدول المرضى --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-Patient">
                        <thead>
                        <tr>
                            <th width="10">
                            </th>
                            <th>
                                {{ trans('cruds.patient.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.patient.fields.patient_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.patient.fields.fullname') }}
                            </th>
                            <th>
                                {{ trans('cruds.patient.fields.gender') }}
                            </th>
                            <th>
                                {{ trans('cruds.patient.fields.mobile') }}
                            </th>
                            <th>
                                {{ trans('cruds.patient.fields.national_id') }}
                            </th>
                            <th>
                                {{ trans('cruds.patient.fields.photo') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $key => $patient)
                            <tr data-entry-id="{{ $patient->id }}">
                                <td>
                                </td>
                                <td>
                                    {{ $patient->id ?? '' }}
                                </td>
                                <td>
                                    {{ $patient->patient_number ?? '' }}
                                </td>
                                <td>
                                    {{ $patient->fullname ?? '' }}
                                </td>
                                <td>
                                    {{ $patient->gender ?? '' }}
                                </td>
                                <td>
                                    {{ $patient->phone ?? '' }}
                                </td>
                                <td>
                                    {{ $patient->national_id ?? '' }}
                                </td>
                                <td>
                                    @if($patient->photo)
                                        <a href="{{ $patient->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $patient->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('patient_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.patients.show', $patient->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan


                                    <a href="{{ route('admin.diagnoses.create', ['patient_id' => $patient->id]) }}" class="btn btn-sm btn-success">
                                        {{trans('cruds.buttons.add_diagnosis') }}
                                    </a>


                                    @can('patient_delete')
                                        <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- عرض أزرار الصفحات لو كان هناك pagination --}}
            {{ $patients->withQueryString()->links() }}

        </div>
    </div>
@endsection
