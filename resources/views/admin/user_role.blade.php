@extends('admin_template')
@section('content')

<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>
@if(Session::has('message'))

<li class="text-success">{{Session::get("message")}}</li>
@endif
<div class="wrapper clearfix">
    <div class="col-md-6">

        <h3 class="text-center">Add New Role</h3>

<div class="form-group">
    <form action="add_user_role" method="post" class="form-group">
        <div class="">
            <label for="name">Role</label>
            <input type="text" name="role" id="role" class="form-control" value="{{ old('role') }}"><br/>
        </div>
        <input name="_token" type="hidden" value="{{csrf_token()}}">

        <div class="text-center">
            <input type="submit" value="Add" class="btn btn-primary">
        </div>
    </form>
</div>
    </div>
    </div>
@stop