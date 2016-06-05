@extends('admin_template')
@section('content')
<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true

    });
</script>
<div style="margin-top: 50px">
    <ul>
        @foreach($errors->all() as $error)
        <li class="text-danger">{{$error}}</li>
        @endforeach
    </ul>
    @if(Session::has('message'))

    <li class="text-success">{{Session::get("message")}}</li>
    @endif
    <div>
        <form class="form-group" method="post" action="edit_html">
            <div class="col-md-4">
                <input name="_token" type="hidden" value="{{csrf_token()}}">
                <input name="url" class="form-control">
            </div>
            <div class="col-md-2">
                <input type="submit">
            </div>
        </form>
    </div>
    <br>
    &nbsp;
    <br>

    <form method="post" action="create_post">


        <div>
            <span>Feed Title</span>
            <input type="text" name="feed_title" id="title" class="form-control">
        </div>
        <div>
        @if(Session::has('data'))
        <textarea name="feed_content" style="width:100%">{{Session::get("data")}}</textarea>
        @endif
            </div>
        <div class="">

            <span>Select Categories</span>
            @foreach($category as $categori)
            <input type="checkbox" name="category[]" value="{{$categori->id}}"><label>{{$categori->category}}</label>
            @endforeach
        </div>
        <input name="_token" type="hidden" value="{{csrf_token()}}">

        <div><input type="submit" class="btn btn-primary center-block">
        </div>
        <br class="clr"/>
    </form>
</div>
@stop