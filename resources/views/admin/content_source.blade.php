@extends('admin_template')
@section('content')
<div style="margin-top: 50px">
    <ul>
        @foreach($errors->all() as $error)
        <li class="text-danger">{{$error}}</li>
        @endforeach
    </ul>
    @if(Session::has('message'))

    <li class="text-success">{{Session::get("message")}}</li>
    @endif
    @if(isset($sources))
    <form method="post" action="{{url('/admin/manage-sources')}}">

        <div class="">

            <span>Select Categories</span>
            <select name="source">
                @foreach($sources as $categori)
                <option value="{{$categori->id}}">{{$categori->title}}</option>
                @endforeach
            </select>

        </div>
        <input name="_token" type="hidden" value="{{csrf_token()}}">
        <br>

        <div>
            <input type="submit" class="btn btn-primary">
        </div>
        <br class="clr"/>
    </form>
    @endif
    @if(isset($source))
    <form method="post" action="{{url('/admin/manage-source')}}" class="form-group">
        <div class="col-md-4">
            <label>Title</label>
            <input class="form-control" name="title" value="{{$source->title}}">
        </div>
        <input name="source_id" value="{{$source->id}}" type="hidden">
        <div class="col-md-4">
            <label>Title Parameters</label>
            <textarea name="title_param" class="form-control">{{$source->title_param}}</textarea>
        </div>
        <div class="col-md-4">
            <label>Cateories Parameters</label>
            <textarea name="categories_param" class="form-control">{{$source->categories_param}}</textarea>
        </div>
        <input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="col-md-4">
            <select name="status">
                <option value="0">Not Available</option>
                <option value="1">Available</option>
            </select>
        </div>
        <div>
            <input type="submit" class="btn btn-primary">
        </div>
        <br class="clr"/>
    </form>
    @endif
</div>
@stop