@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">{{ __('endoscopy.add_new') }}</h3>

    <div class="row">
        {{-- Main Form Column --}}
        <div class="col-md-8">
            <form action="{{ route('admin.endoscopies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- General Fields --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="patient_id" class="text-primary">{{ __('endoscopy.patient') }}</label>
                        <select class="form-control select2 {{ $errors->has('patient_id') ? 'is-invalid' : '' }}"
                                name="patient_id" id="patient_id" required>
                            @if(!isset($patientId))
                                <option value="" selected></option>
                            @endif

                            @foreach($patients as $value)
                                <option value="{{ $value->id }}"
                                        data-fullname="{{ $value->fullname }}"
                                        data-age="{{ $value->age }}"
                                        data-gender="{{ $value->gender }}"
                                        data-phone="{{ $value->phone }}"
                                        data-address="{{ $value->address }}"
                                    {{ old('patient_id') == $value->id || (isset($patientId) && $patientId == $value->id) ? 'selected' : '' }}
                                >
                                    {{ $value->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="performed_at" class="text-primary">{{ __('endoscopy.performed_at') }}</label>
                        <input type="date" id="performed_at" name="performed_at" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="notes" class="text-primary">{{ __('endoscopy.notes') }}</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3"
                                  placeholder="{{ __('endoscopy.notes_placeholder') }}"></textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="attachment" class="text-primary">{{ __('endoscopy.attachment') }}</label>
                    <input type="file" class="form-control" name="attachment">
                </div>

                <input type="hidden" name="type" id="endoscopyType" value="">

                {{-- Tabs --}}
                <ul class="nav nav-tabs mb-3" id="sectionTabs" role="tablist">
                    @foreach($templates as $type => $sections)
                        @php
                            $tabClass = $type === 'upper' ? 'bg-primary text-white' : ($type === 'lower' ? 'bg-success text-white' : '');
                        @endphp
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }} {{ $tabClass }}"
                                    id="{{ $type }}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $type }}"
                                    type="button" role="tab" aria-controls="tab-{{ $type }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ __('endoscopy.' . $type) }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach($templates as $type => $sections)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $type }}"
                             role="tabpanel" aria-labelledby="{{ $type }}-tab">
                            @foreach($sections as $section)
                                <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3 text-info">
                                            <i class="bi bi-diagram-3 me-1"></i>{{ $section->section_name }}
                                        </h5>
                                        <input type="hidden" name="sections[{{ $section->id }}][template_id]"
                                               value="{{ $section->id }}">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="text-secondary small">{{ __('endoscopy.status') }}</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-heart-pulse"></i></span>
                                                    <input type="text" name="sections[{{ $section->id }}][status]"
                                                           class="form-control"
                                                           placeholder="{{ __('endoscopy.status_placeholder') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label
                                                    class="text-secondary small">{{ __('endoscopy.description') }}</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-card-text"></i></span>
                                                    <textarea name="sections[{{ $section->id }}][description]"
                                                              class="form-control" rows="1"
                                                              placeholder="{{ __('endoscopy.description_placeholder') }}"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                {{-- Submit Buttons --}}
                <button type="submit" name="type" value="upper" class="btn btn-primary me-2">Save Upper</button>
                <button type="submit" name="type" value="lower" class="btn btn-success">Save Lower</button>
            </form>
        </div>

        {{-- Patient Info --}}
        <div class="col-md-4" id="patient_sidebar">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-person-vcard me-1"></i> {{ __('endoscopy.patient_info') }}
                </div>
                <div class="card-body" id="patient-info">
                    <p class="text-muted">{{ __('endoscopy.select_patient_to_view_info') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>

        window.patients = @json($patients);
        console.log(window.patients);


        $(document).ready(function () {
            $('#patient_id').select2();

            window.patients = @json($patients->keyBy('id'));

            const select = document.getElementById('patient_id');
            const infoBox = document.getElementById('patient-info');

            function updatePatientInfo() {
                const selectedId = select.value;
                const patient = window.patients[selectedId];

                if (!patient) {
                    infoBox.innerHTML = '<p class="text-muted">{{ __("endoscopy.select_patient_to_view_info") }}</p>';
                    return;
                }

                // تعويض بيانات التنظير، مع التحقق من وجودها
                const endoscopy = patient.latest_endoscopy; // لاحظ اسم المفتاح من الـ JSON

                infoBox.innerHTML = `
        <ul class="list-group list-group-flush small shadow-sm rounded">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-user"></i> الاسم:</strong> <span>${patient.fullname}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-calendar"></i> العمر:</strong> <span>${patient.age}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-phone"></i> الهاتف:</strong> <span>${patient.phone}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
    <strong><i class="fa fa-stethoscope"></i> آخر تنظير:</strong>
   <span>
  ${
                    endoscopy && endoscopy.notes
                        ? `<a href="/admin/endoscopies/${endoscopy.id}" class="btn btn-sm btn-primary" target="_blank" rel="noopener noreferrer">${endoscopy.notes}</a>`
                        : 'لا توجد تفاصيل'
                }
</span>

</li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong><i class="fa fa-calendar-alt"></i> تاريخ التنظير:</strong>
                <span>${endoscopy && endoscopy.created_at ? new Date(endoscopy.created_at).toLocaleDateString('ar-EG') : 'لا توجد بيانات'}</span>
            </li>
        </ul>
        `;
            }

            $('#patient_id').on('change', updatePatientInfo);

            updatePatientInfo();
        });


    </script>
@endsection



