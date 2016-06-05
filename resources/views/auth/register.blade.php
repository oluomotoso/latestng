@extends('admin_template')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>


<div style="padding-top: 50px">
    <h3>Add New User</h3>

    <form action="add_user" method="post" class="form-group">

            <label for="name">Username</label>
            <input type="text" name="username" id="name" class="form-control" value="{{ old('name') }}"><br/>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"><br/>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control"><br/>
            <label for="country">Select Role</label>
            <select class="form-control" name="role">
                @foreach($role as $roles)
                <option value="{{$roles->id}}">{{$roles->role}}</option>
                @endforeach
            </select>

            <input name="_token" type="hidden" value="{{csrf_token()}}">
        <br>
        <input type="submit" value="add User" class="btn btn-primary center-block">


    </form>
</div>
@stop
