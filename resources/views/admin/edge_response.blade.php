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

    <table class="table table-bordered" id="PendingPost">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Account ID</th>
            <th>Facebook ID</th>
            <th>Response</th>
            <th>Last Updated At</th>
            <th>Facebook Owner</th>
        </tr>
        </thead>
    </table>
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
        $('#PendingPost').DataTable({
            ajax: 'response_data',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'facebook_account_owner'},
                {data: 'facebook_id'},
                {data: 'response'},
                {data: 'updated_at'},
                {data: 'account_name'}
            ]


        });


    </script>

    @endpush