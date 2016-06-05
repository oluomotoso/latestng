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
    <table class="table table-bordered table-responsive" id="PendingPost">
        <thead>
        <tr>
            <th>Select</th>
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
            <td><input class="selectRow" type="checkbox" id="bulkSelect" name="bulkSelect" value="{{$pend->id}}"/>
                {{$pend->id}}
            </td>
            <td>{{$pend->feed_title}}</td>
            <td class="center">{{$pend->feed_category}}</td>
            <td class="center">{{$pend->feed_description}}</td>
            <td class="center">{{date_format($pend->created_at,'d M Y H:i')}}</td>
            <td><a href="/admin/edit_pending_post/{{$pend->id}}" class="btn btn-xs btn-primary"><i
                        class="glyphicon glyphicon-edit"></i> Edit</a>
            </td>
            <td>
                <form action="../admin/publish" method="post">

                    <input type="hidden" id="selected" name="publish_ids" value="{{$pend->id}}">
                    <button id="PublishTrigger" class="btn btn-success" type="submit">Publish</button>
                    <input name="_token" type="hidden" value="{{csrf_token()}}">
                </form>
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
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
        $(document).ready(function () {
            var table = $('#PendingPost').DataTable({
                lengthChange: true,
                "order": [
                    [4, 'desc']
                ]

            });
    </script>
    <script>
        $('#PublishTrigger').on("click", function (event) { // triggering delete one by one
            if ($('.selectRow:checked').length > 0) {  // at-least one checkbox checked
                var ids = [];
                $('.selectRow').each(function () {
                    if ($(this).is(':checked')) {
                        ids.push($(this).val());
                    }
                });

                var ids_string = ids.toString();  // array to string conversion
                var selected = document.getElementById("selected");
                selected.value = ids_string;
                console.log(ids_string);
            }
        })
    </script>
    @endpush