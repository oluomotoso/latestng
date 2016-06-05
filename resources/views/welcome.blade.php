@extends('template')
@section('content')
<!-- content -->


    <!-- main col right -->
{!!$content!!}
    <!-- main col left -->
    <!--div class="col-sm-2 visible-lg visible-md visible-sm">
        <div class="affix">
            <div class="panel panel-default">
                <div class="panel-heading">MOST READ</div>
                <div class="panel-body">
                    @foreach($most_read as $mostread)
                    <a href="/{!!$mostread->id!!}/{!!$mostread->perm_url!!}">{!!$mostread->feed_title!!}</a><br>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div-->
<!--/row-->
@stop
