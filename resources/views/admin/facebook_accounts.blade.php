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
            <table class="table table-responsive table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Facebook ID</th>
                    <th>Approve</th>
                    <th>Disable</th>
                    <th>Delete</th>
                    <th>Manage edges</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)

                    <tr class="gradeA">
                        <td>{{$account->name}}</td>
                        <td>{{$account->facebook_id}}</td>

                        <td class="center">
                            <form method="post" action="{{url('/admin/manage_facebook_accounts')}}">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$account->id}}" name="account_id">
                                <button type="submit" name="approve" class="btn btn-success">APPROVE</button>
                            </form>
                        </td>
                        <td class="center">
                            <form method="post" action="{{url('/admin/manage_facebook_accounts')}}">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$account->id}}" name="account_id">
                                <button type="submit" name="disable" class="btn btn-warning">DISABLE</button>
                            </form>
                        </td>
                        <td class="center">
                            <form method="post" action="{{url('/admin/manage_facebook_accounts')}}">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$account->id}}" name="account_id">
                                <button type="submit" name="delete" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                        <td><a href="{{url('/admin/manage_account_edges')}}"><button class="btn btn-primary">Manage Edge</button></a></td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @stop

        @push('scripts')
        <script>
            $(document).ready(function () {
                // Array holding selected row IDs
                var table = $('#dataTables-example').DataTable({
                    //'ajax': 'https://api.myjson.com/bins/1us28',
                });
            });
        </script>
        @endpush
