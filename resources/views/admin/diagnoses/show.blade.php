@extends('layouts.admin')
@push('styles')
    <style>
        /* اضبط كامل الصفحة لـ RTL */
        html, body {
            direction: rtl !important;
            text-align: right !important;
        }

        /* ضبط الجدول */
        .diagnosis-table {
            width: 100%;
            border-collapse: collapse;
            direction: rtl;
            text-align: right;
            table-layout: fixed; /* هذا يعطي توزيع ثابت للخلايا */
        }

        .diagnosis-table th {
            min-width: 180px; /* أقل عرض لخلية العنوان */
            background-color: #f8f9fa;
            font-weight: 600;
            color: #333;
            padding: 10px 15px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .diagnosis-table td {
            padding: 10px 15px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            white-space: pre-line;
            color: #555;
            font-size: 0.95rem;
            word-break: break-word; /* يفيد النصوص الطويلة */
        }

        .icon-label {
            margin-right: 8px;
            color: #6c757d;
            display: inline-block; /* تأكد من ظهور الأيقونة بشكل جيد */
        }

        .section-header {
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 1.2rem;
            font-weight: 700;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 6px;
            color: #2c3e50;
            text-align: right;
        }

        /* زر الرجوع */
        .btn-back {
            margin-bottom: 20px;
        }
    </style>
@endpush


@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.diagnosis.title_singular') }}
        </div>

        <div class="card-body">

            <a class="btn btn-secondary btn-sm btn-back" href="{{ route('admin.diagnoses.index') }}">
                <i class="fas fa-arrow-left"></i> {{ trans('global.back_to_list') }}
            </a>
            <div class="table-responsive">
            <table class="table diagnosis-table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>
                        <i class="fas fa-user-injured icon-label"></i>
                        {{ trans('cruds.diagnosis.fields.patient') }}
                    </th>
                    <td>{{ $diagnosis->patient->fullname ?? '-' }}</td>
                </tr>

                @php
                    $fields = [
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
                        'notes' => 'fas fa-clipboard',
                    ];
                @endphp

                @foreach($fields as $field => $icon)
                    <tr>
                        <th>
                            <i class="{{ $icon }} icon-label"></i>
                            {{ trans("cruds.diagnosis.fields.$field") }}
                        </th>
                        <td>{{ $diagnosis->$field ?? '-' }}</td>
                    </tr>
                @endforeach

                @php
                    $shortFields = [
                        'sat' => 'fas fa-lungs',
                        'rr' => 'fas fa-wind',
                        'hr' => 'fas fa-heartbeat',
                        'bp' => 'fas fa-tachometer-alt',
                    ];
                @endphp

                <tr>
                    <th colspan="2" class="section-header">
                        {{ __('المؤشرات الحيوية (Vital Signs)') }}
                    </th>
                </tr>
                @foreach($shortFields as $field => $icon)
                    <tr>
                        <th>
                            <i class="{{ $icon }} icon-label"></i>
                            {{ trans("cruds.diagnosis.fields.$field") }}
                        </th>
                        <td>{{ $diagnosis->$field ?? '-' }}</td>
                    </tr>
                @endforeach

                <tr>
                    <th>
                        <i class="fas fa-calendar-alt icon-label"></i>
                        {{ trans('cruds.diagnosis.fields.created_at') }}
                    </th>
                    <td>{{ $diagnosis->created_at ? $diagnosis->created_at->format('Y-m-d H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>
                        <i class="fas fa-calendar-alt icon-label"></i>
                        {{ trans('cruds.diagnosis.fields.updated_at') }}
                    </th>
                    <td>{{ $diagnosis->updated_at ? $diagnosis->updated_at->format('Y-m-d H:i') : '-' }}</td>
                </tr>
                </tbody>
            </table>
            </div>

            <a class="btn btn-secondary btn-sm mt-3" href="{{ route('admin.diagnoses.index') }}">
                <i class="fas fa-arrow-left"></i> {{ trans('global.back_to_list') }}
            </a>

        </div>
    </div>
@endsection
