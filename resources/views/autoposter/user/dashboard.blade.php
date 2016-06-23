@extends('autoposter/layouts/dashboard')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>
<div class="wrapper clearfix">
    <div class="col-md-offset-2 col-md-8">
        <h2>GUIDELINES</h2>
        <i class="text-center text-info">Please read and follow the information below:</i>
        <br>&nbsp;<br>
        <ul>
            <li>Click <a href="">HERE</a> to commence the linking process.</li>
            <li>Follow the instructions on the page.</li>
            <li>Wait till you get a mail from us that your account have been approved successfully.</li>
            <li>Login to the facebook account you want to link to approve a request from autopost.latestng.com</li>
            <li>Click <a href="{{url('/add-facebook')}}">HERE</a> to link the account to Facebook</li>
            <li>Go to <a href="{{url('/user/settings')}}">SETTINGS</a> to manage your account preferences</li>
        </ul>

        <h3>OPTIONAL GUIDE</h3>
        <span>By default, we publish your post to the first 15 groups that your account is a member of on facebook (You can change this in <a href="{{url('/user/settings')}}">settings.</a>)</span>
        <span>However, you can enter select groups that you want us publish to <a href="{{url('/user/select-facebook-group')}}">HERE</a></span>

    </div>
</div>


@stop