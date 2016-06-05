@extends('admin_template')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>
<div class="wrapper clearfix">


    <h3>Add Categories</h3>

    <div class="form-group">
        <form action="create_category" method="post" class="form-group">
            <div class="">
                <label for="name">Enter New Categories(Separate by Comma)</label>
                <input type="text" name="category" id="category" class="form-control"
                       value="{{ old('category') }}"><br/>
            </div>
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <input type="submit" value="Add" class="btn btn-primary">

        </form>
    </div>
</div>


@stop