@extends('layouts.admin')
@section('content')

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.endoscopies.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.endoscopy.title_singular') }}
                </a>
            </div>
        </div>


    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('cruds.endoscopy.title_singular') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Endoscopy">
                    <thead>
                    <tr>
                        <th width="10"></th>
                        <th>id</th>
                        <th>{{ trans('cruds.endoscopy.fields.patient') }}</th>
                        <th>{{ trans('cruds.endoscopy.fields.type') }}</th>
                        <th>{{ trans('cruds.endoscopy.fields.performed_at') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($endoscopies as $key => $endoscopy)
                        <tr data-entry-id="{{ $endoscopy->id }}">
                            <td></td>
                            <td width="10">{{ $endoscopy->id ?? '' }}</td>
                            <td>{{ $endoscopy->patient->fullname ?? '' }}</td>
                            <td>{{ trans('endoscopy.' . $endoscopy->type) ?? $endoscopy->type }}</td>
                            <td>{{ $endoscopy->performed_at ? $endoscopy->performed_at : '' }}</td>
                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.endoscopies.show', $endoscopy->id) }}">
                                        {{ trans('global.view') }}
                                    </a>


                                    <a class="btn btn-xs btn-info" href="{{ route('admin.endoscopies.edit', $endoscopy->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>


                                    <form action="{{ route('admin.endoscopies.destroy', $endoscopy->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.endoscopies.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': '{{ csrf_token() }}'},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }
                        })
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)


            let table = $('.datatable-Endoscopy:not(.ajaxTable)').DataTable({
                buttons: dtButtons,
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                columnDefs: [
                    {
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                    {
                        orderable: false,
                        searchable: false,
                        targets: -1
                    }
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            })

            $('#select-all').on('click', function () {
                if (this.checked) {
                    table.rows().select();
                } else {
                    table.rows().deselect();
                }
            })

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
