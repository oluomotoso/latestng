@extends('template')
@section('content')
<div class="wrapper clearfix">
<div class="col-md-6 col-md-offset-3">
    <ul>

        @foreach($errors->all() as $error)
        <li class="text-danger">{{$error}}</li>
        @endforeach
    </ul>
    <div class="panel panel-primary">
        <div class="panel-heading">Secure Login Area</div>
        <div class="panel-body">
            <form class="form-group" method="post" action="login">
                {!! csrf_field() !!}
                <label for="email">Email</label>
                <input id="email" class="form-control" placeholder="Email" name="email" type="text" value="{{ old('email') }}">
                <br>
                <label for="password">Password</label>
                <input id="password" class="form-control" placeholder="Password" name="password" type="password">
                <br>

                <button type="submit" class="btn btn-primary center-block">Login</button>
            </form>

        </div>
    </div>
</div>
    </div>
@stop