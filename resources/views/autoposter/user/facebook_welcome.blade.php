@extends('autoposter/layouts/dashboard')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>
<div>
    <span>Welcome {{$facebook->name}}</span><br>
    CLICK <b><a href="">HERE</a></b> to continue
</div>


@stop