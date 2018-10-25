@extends('layouts.app')

@section('content')
<div id="home" style="padding:20px;">
<div class="container-fluid" >`
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin:20px padding:20px;";> 
              <div class="panel-heading"><h1>Encode your message here </h1></div>
                <div class="panel-body">
                <form method="post" action="/encode-image" >
                {{csrf_field()}}
                <div class="form-group">
                <label for="key">Enter your key:</label>
                <input type="password" class="form-control" id="key" name="key" auto-complete="off" maxlength="{{$max_char}}" required autofocus>
                </div>
                <div class="form-group">
                <label for="comment">Message</label>
                <p> Write your secret message to hide within an uploaded image.</p>
                <textarea class="form-control" rows="5" id="comment" name="message"></textarea>
                <p>{{$max_char}} characters can be encoded.</p> 
              </div>
              <center><p><button class="btn btn-primary btn-lg">Encode</button></p></center>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection