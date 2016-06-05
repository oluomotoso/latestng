@extends('admin_template')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>
<div class="wrapper clearfix" style="margin-top: 50px">
    <label>Manage the edge with categories</label>

    <form class="form center-block" style="background-color: #CCCCCC" method="post" action="{{url('admin/edit_facebook_edge')}}">
        <div class="form-group">
            <span>Name</span>
            <input class="form-control" name="edge_name" value="{{$edge->name}}">
            <span>Facebook Id</span>
            <input class="form-control" name="facebook_id" value="{{$edge->facebook_id}}">
            <span>Edge Account</span>
            <select name="edge_account">
                @foreach($facebook_accounts as $facebook)
                <option value="{{$facebook->id}}">{{$facebook->name}}</option>
                @endforeach
            </select>
            <span>Edge Type</span>
            <select name="edge_type">
                <option value="group">Group</option>
                <option value="page">Page</option>
            </select>
            <input type="hidden" value="{{$edge->id}}" name="edge_id">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <input class="btn btn-primary" type="submit">
        </div>
    </form>
    @stop