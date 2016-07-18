@extends('autoposter/layouts/dashboard')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>
<div>
    <br>
    <span>Welcome {{$facebook[0]->name}}</span><br>
    CLICK <b><a href="https://developers.facebook.com/requests/" target="_blank">HERE</a></b>on a new tab to accept the Autoposter request
    <br>
    <span>CLICK <a href="{{url('/add-facebook2')}}">HERE</a> TO FINISH</span>
</div>


@stop