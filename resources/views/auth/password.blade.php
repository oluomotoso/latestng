@extends('template')


@section('content')
<article>
    <div>
        <ul>
            @foreach($errors->all() as $error)
            <li class="text-danger">{{$error}}</li>
            @endforeach
        </ul>

        <form method="POST" action="password">
            {!! csrf_field() !!}

            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>
<br>
            <div>
                <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
                </button>
            </div>
        </form>

</div>
@stop