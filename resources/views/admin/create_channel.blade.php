@extends('admin_template')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach


</ul>


<div style="padding-top: 50px">
    @if(Session::has('message'))

    <li class="text-success">{{Session::get("message")}}</li>
    @endif

    <h3>Create Channel</h3>
<form action="create_channel" method="post" class="form-group">
<label for="name">Title</label>
            <input type="text" name="title" id="name" class="form-control" value="{{ old('title') }}"><br/>
            <label for="url">Url</label>
            <input type="url" name="url" id="url" class="form-control" value="{{ old('title') }}"><br/>

        <input name="_token" type="hidden" value="{{csrf_token()}}">
        <br>
        <input type="submit" value="Create Channel" class="btn btn-primary center-block">


    </form>
</div>
@stop
