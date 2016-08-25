@extends('admin_template_with_data_tables')
@section('content')

    <div style="margin-top: 50px">
        @if(Session::has('message'))

            <li class="text-success">{{Session::get("message")}}</li>
        @endif

        <a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i>Create Edge</a>

        <form action="../admin/create_facebook_edge" method="post">
            <table class="table table-bordered">

            </table>
            <input name="_token" type="hidden" value="{{csrf_token()}}">


        </form>
        <div class="table-responsive">

            <form id="frm-example" action="{{url('/admin/delete_edge')}}" method="POST">

                <table class="table table-responsive table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th><input name="select_all" value="1" type="checkbox"></th>
                        <th>Name</th>
                        <th>Facebook ID</th>
                        <th>Response</th>
                        <th>Last Updated At</th>
                        <th>Facebook Owner</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($facebook_edges as $edge)

                        <tr class="gradeA">
                            <td>{{$edge->id}}</td>
                            <td>{{$edge->name}}</td>
                            <td class="center">{{$edge->facebook_id}}</td>
                            <td class="center">{{$edge->response}}</td>
                            <td class="center">{{date_format($edge->updated_at,'d M Y H:i')}}</td>
                            <td>
                                {{$edge->facebook_account->name}}
                                <a href="/admin/edit_facebook_edge/{{$edge->id}}" class="btn btn-xs btn-primary"><i
                                            class="glyphicon glyphicon-edit"></i> Manage</a>
                                <form action="{{url('approve_facebook_user')}}" method="post">

                                    {{csrf_field()}}
                                    <input name="account" type="hidden" value="{{$edge->facebook_account->id}}">

                                    <button class="btn btn-default" type="submit">Status</button>
                                </form>
                                <form action="{{url('admin/delete_edge')}}" method="post">

                                    {{csrf_field()}}
                                    <input name="edge_id" type="hidden" value="{{$edge->id}}">

                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input name="_token" type="hidden" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-danger" name="submit">DELETE</button>
            </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--post modal-->
        <div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        CREATE FACEBOOK EDGE
                    </div>
                    <form class="form center-block" action="create_facebook_edge" method="post">
                        <div class="form-group">
                            <span>Name</span>
                            <input id="" class="form-control" name="edge_name">
                            <span>Facebook Id</span>
                            <input class="form-control" name="facebook_id">
                            <span>Edge Account</span>
                            <select name="edge_account">
                                @foreach($facebook_accounts as $facebook)
                                    <option name="account_id" value="{{$facebook->id}}">{{$facebook->name}}</option>
                                @endforeach
                            </select>
                            <span>Edge Type</span>
                            <select name="edge_type">
                                <option value="group">Group</option>
                                <option value="page">Page</option>
                            </select>
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <input class="btn btn-primary" type="submit">
                        </div>
                    </form>

                </div>
            </div>
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
                    'order': [4, 'desc'],
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