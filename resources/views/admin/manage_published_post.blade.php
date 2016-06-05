@extends('admin_template_with_data_tables')
@section('content')

<div style="margin-top: 50px">
    @if(Session::has('message'))

    <li class="text-success">{{Session::get("message")}}</li>
    @endif
    <!--form action="../admin/publish" method="post">
        <input type="checkbox" id="bulkSelect" name="publish_id"/>Toggle Select

        <input type="hidden" id="selected" name="publish_ids">
        <table class="table table-bordered">
            <tr>
                <button id="PublishTrigger" class="btn btn-success" type="submit">Publish Selected</button>
            </tr>
        </table>
        <input name="_token" type="hidden" value="{{csrf_token()}}">


    </form-->
    <table class="table table-bordered" id="PendingPost">
        <thead>
        <tr>
            <th>Select</th>
            <th>Title</th>
            <th>category</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Edit Post</th>

        </tr>
        </thead>
    </table>
    <!-- Modal -->
    <div class="col-lg-8 col-lg-offset-2 modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: #cccccc">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
        $('#PendingPost').DataTable({
            ajax: 'published_data',
            columns: [
                {data: 'select'},
                {data: 'feed_title'},
                {data: 'feed_category'},
                {data: 'feed_description'},
                {data: 'created_at'},
                {data: 'edit'}
            ]


        });

        $("#bulkSelect").on('click', function () { // bulk checked
            var status = this.checked;
            $(".selectRow").each(function () {
                $(this).prop("checked", status);
            });
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