@extends('admin_template_with_data_tables')
@section('content')

<div style="margin-top: 50px">
@if(Session::has('message'))

<li class="text-success">{{Session::get("message")}}</li>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="table-responsive">
<form id="frm-example" action="{{url('/admin/publish')}}" method="POST">
    <table class="table table-responsive table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th><input name="select_all" value="1" type="checkbox"></th>
            <th>Title</th>
            <th>category</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Edit Post</th>
            <th>PUBLISH</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pending as $pend)

        <tr class="gradeA">
            <td>{{$pend->id}}</td>
            <td>{{$pend->feed_title}}</td>
            <td class="center">{{$pend->feed_category}}</td>
            <td class="center">{{$pend->feed_description}}</td>
            <td class="center">{{date_format($pend->created_at,'d M Y H:i')}}</td>
            <td><a href="{{url('admin/edit_pending_post/')}}{{'/'.$pend->id}}" class="btn btn-xs btn-primary">
                    <iclass
                    ="glyphicon glyphicon-edit"></i> Edit</a>
            </td>
            <td>
                <form action="{{url('admin/publish')}}" method="post">

                    <input type="hidden" id="selected" name="publish_ids" value="{{$pend->id}}">
                    <button id="PublishTrigger" class="btn btn-success" type="submit">Publish</button>
                    <input name="_token" type="hidden" value="{{csrf_token()}}">
                </form>
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
    <input name="_token" type="hidden" value="{{csrf_token()}}">
    <button type="submit" class="btn btn-primary" name="submit">PUBLISH</button>
</form>
<!-- Modal -->
<div class="col-lg-8 col-lg-offset-2 modal fade" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: #cccccc">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>

            </div>
            <div class="modal-body">
                <div class="te"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@stop

@push('scripts')
<script>
    function updateDataTableSelectAllCtrl(table) {
        var $table = table.table().node();
        var $chkbox_all = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

        // If none of the checkboxes are checked
        if ($chkbox_checked.length === 0) {
            chkbox_select_all.checked = false;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length) {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = true;
            }
        }
    }

    $(document).ready(function () {
        // Array holding selected row IDs
        var rows_selected = [];
        var table = $('#dataTables-example').DataTable({
            //'ajax': 'https://api.myjson.com/bins/1us28',
            'columnDefs': [
                {
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'width': '1%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox">';
                    }
                }
            ],
            'order': [1, 'asc'],
            'rowCallback': function (row, data, dataIndex) {
                // Get row ID
                var rowId = data[0];

                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });

        // Handle click on checkbox
        $('#dataTables-example tbody').on('click', 'input[type="checkbox"]', function (e) {
            var $row = $(this).closest('tr');

            // Get row data
            var data = table.row($row).data();

            // Get row ID
            var rowId = data[0];

            // Determine whether row ID is in the list of selected row IDs
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle click on table cells with checkboxes
        $('#dataTables-example').on('click', 'tbody td, thead th:first-child', function (e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
            if (this.checked) {
                $('#dataTables-example tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#dataTables-example tbody input[type="checkbox"]:checked').trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        table.on('draw', function () {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
        });

        // Handle form submission event
        $('#frm-example').on('submit', function (e) {
            var form = this;

            // Iterate over all selected checkboxes
            $.each(rows_selected, function (index, rowId) {
                // Create a hidden element
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });

        });
    });
</script>
@endpush