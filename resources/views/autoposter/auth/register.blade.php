@extends('autoposter/layouts/template2')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
</ul>


<div style="padding-top: 50px" class="col-md-offset-3 col-md-6">
    @if (count($errors) > 0)
    <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
            <span>{{ $error }}</span><br/>
            @endforeach

    </div>
    @endif
    <div class="panel panel-default">

        <div class="panel-heading">
            Registration
        </div>
        <div class="panel-body">
            <form action="{{url('/register')}}" method="post" class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">

                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">

                </div>
                <div>
                    <label for="password">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password" class="form-control">

                </div>
                <input name="role" value="2" type="hidden">
                <input name="_token" type="hidden" value="{{csrf_token()}}">
                <br>
                <input type="submit" class="btn btn-primary center-block">


            </form>
        </div>

    </div>

</div>
@stop
