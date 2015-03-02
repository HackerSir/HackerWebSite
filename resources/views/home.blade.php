@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    Hello, world.<br />
                    安安，世界。<br />
                    @for($i=0;$i<50;$i++)
                        {{ $i }}<br />
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
