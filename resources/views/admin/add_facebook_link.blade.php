@extends('admin_template')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>
<div class="wrapper clearfix">


    <h3>Add Facebook Link</h3>

    <div class="form-group">
        <form action="add_facebook_link" method="post" class="form-group">
            <div class="">
                <label for="name">link</label>

                <input type="text" name="link"  class="form-control"
                       value="{{ old('link') }}"><br/>
            </div>
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <input type="submit" value="Add" class="btn btn-primary">

        </form>
    </div>
</div>


@stop