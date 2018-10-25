@extends('layouts.app')

@section('content')
<div id="home">
<div class="container-fluid">`
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin:20px";>        
                <div class="panel-heading"><center><h3>{{Auth::user()->name}} your encoded image:</h3></center></div>
                <div class="panel-body">
                <center><img width="60%" height="60%"  src="storage/{{Auth::user()->image}}"></center>
                <br/>
                <center><a href="/storage/{{Auth::user()->image}}" download><button type="button" 
                class="btn btn-success btn-lg">Download</button></a>
                <a href="/home"><button class="btn btn-primary btn-lg" primary>Back</button></a></center>
                </div>
            <div>
        </div>
    </div>        
</div>               
</div>

@endsection