@extends('layouts.app')

@section('content')
<div id="home">
<div class="container-fluid">`
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin:20px";> 
              <div class="panel-heading"><h2>{{Auth::user()->name}} your image: </h2>
            
              </div>
              <div class="panel-body">
                 <center><img src="storage/{{Auth::user()->image}}" width="200px"><br/></center>
                  <h1>Your secret message is: </h1>
  
                  <form>
                  <div class="form-group">
                  <label for="comment">Message</label>
                  
                    <div class="well well-lg">
                    {{$real_message_final}}
</div>
                  </div>
                  </form>
                  <center> <a href="/home" class="btn btn-default">GO back</a></center>
            </div>
          </div>
        </div>
      </div>
    <div>
  </div>
</div>  
@endsection

