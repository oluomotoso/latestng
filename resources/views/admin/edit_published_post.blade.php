<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Latestng.com-Breaking News in Nigeria, News Headlines in Nigeria, Africa and Worldwide</title>
    <meta property="fb:app_id" content="1397993927197661"/>
    <meta name="alexaVerifyID" content="0Ov3m5G5QodDMKNME8LjDX0N7Bs"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title"
          content="Latestng.com-Breaking News in Nigeria, News Headlines in Nigeria, Africa and Worldwide"/>
    <meta property="og:description"
          content="LATESTNG.COM is the ➨ TOP Nigerian News Aggregation portal, providing comprehensive up-to-date NEWS coverage ➨ Breaking news ➨ Top news headlines from Nigeria, Africa and worldwide."/>
    <meta property="og:site_name" content="LATESTNG.COM"/>
    <meta name="keywords"
          content="latest.com, latestng.com,latestng,latest, Punch, punchng, naij,Nigeria, Lagos, Abuja, Port Harcourt, breaking news in Nigeria, Boko Haram, PDP, ACN,Buhari, Goodluck Jonathan, Ebola, Quarantine, Adadevoh, Sawyer, First consultant, Shekau, Boko Haram, Chibok, Kunduga, Sambisa"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
</head>
<body class="col-md-6 col-md-offset-3">
<div class="modal-header">
    <h4 class="modal-title">Edit Post</h4>

</div>
<div class="modal-body">
    <ul>
        @foreach($errors->all() as $error)
        <li class="text-danger">{{$error}}</li>
        @endforeach
    </ul>
    <form method="post" action="edit_published_post" class="form center-block">
        <span class="modal-title">Feed Title</span>
        <input type="text" name="feed_title" id="title" class="form-control" value="{!!$data->feed_title!!}">

        <div class="text-visible">
            <span>Select Categories</span>
            @foreach($category as $categori)
            <input type="checkbox" name="category[]" value="{{$categori->category}}"><label>{{$categori->category}}</label>
            @endforeach
        </div>
        <span>New Content</span>
        <textarea name="feed_content" style="width:100%; height: 400px"
                  id="feed_content">{!!$data->feed_content!!}</textarea>
        <input name="_token" type="hidden" value="{{csrf_token()}}">
        <input name="feed_id" type="hidden" value="{{$data->id}}">

        <div class="modal-footer">
            <span>Publish</span>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

</div>

</form>
<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>

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
    })

</script>
</body>
</html>