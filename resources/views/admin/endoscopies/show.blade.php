@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="mb-4">
            <h2 class="text-primary">
                <i class="fas fa-procedures"></i> @lang('endoscopy.details')
            </h2>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong><i class="fas fa-user"></i> @lang('endoscopy.patient'):</strong>
                        <div>{{ $endoscopy->patient->fullname }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong><i class="fas fa-stethoscope"></i> @lang('endoscopy.type'):</strong>
                        <div>@lang('endoscopy.' . $endoscopy->type)</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong><i class="fas fa-calendar-alt"></i> @lang('endoscopy.performed_at'):</strong>
                        <div>{{ $endoscopy->performed_at }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong><i class="fas fa-pen"></i> @lang('endoscopy.notes'):</strong>
                        <div>{{ $endoscopy->notes }}</div>
                    </div>

                    @if($endoscopy->attachment)
                        <div class="col-md-6 mb-3">
                            <strong><i class="fas fa-paperclip"></i> @lang('endoscopy.file'):</strong>
                            <div>
                                <a href="{{ asset('storage/' . $endoscopy->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> @lang('endoscopy.view')
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-microscope"></i> @lang('endoscopy.section_results')</h5>
            </div>
            <div class="card-body">
                @if($endoscopy->sections->count())
                    <div class="row">
                        @foreach($endoscopy->sections as $section)
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-3 h-100 bg-light">
                                    <strong>{{ $section->template->section_name }}</strong>
                                    <div>
                            <span class="badge bg-secondary">
                                {{ $section->status ?? __('endoscopy.no_status') }}
                            </span>
                                    </div>
                                    <div class="text-muted small mt-2">{{ $section->description }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">@lang('endoscopy.no_sections_found')</p>
                @endif
            </div>

        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.endoscopies.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> @lang('global.back_to_list')
            </a>

            <div>
                <a href="{{ route('admin.endoscopies.edit', $endoscopy->id) }}" class="btn btn-info">
                    <i class="fas fa-edit"></i> @lang('global.edit')
                </a>

                <a href="{{ route('admin.endoscopies.create', ['endoscopy_id' => $endoscopy->id]) }}" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> @lang('endoscopy.add_new')
                </a>
            </div>
        </div>

    </div>
@endsection
