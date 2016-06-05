@extends('homepage')
@section('content')

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;

        }
    </style>
    <div class="content col-md-offset-3" >
        <h3>Sorry, the page you are looking for could not be found.</h3>
        <div class="title">Error (404)</div>

    </div>
@stop