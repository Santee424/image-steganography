@extends('layouts.app')

@section('content')
<div id="home">
<div class="container-fluid">`
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin:20px";> 
            <div class="panel-heading"><h1>{{auth::user()->name}} your uploaded Image :</h1></div>
            <div class="panel-body">
            <center><img src="storage/{{Auth::user()->image}}" width="200px"></center>
            <p>Click on encode to hide a message in the image</p>

            <form method="post" action="/counter">
                {{csrf_field()}}
                    <div class="form-group">
                         <center><p><button class="btn btn-primary btn-lg">Encode</button></p></center>
                    </div>
            </form>
            
            <hr/>
             @if(session()->has('message'))
                        <div class="alert alert-warning">
                            {{ session()->get('message') }}
                            </div>
                    @endif
            <p>Enter the key and click on decode to view the message hidden in the image.</p>
                <form method="post" action="/decode" >
                    {{csrf_field()}}
                    <div class="form-group">
                    <label for="keys" >Enter Key to Decode Image</label>
                    <input type="password" width="250px" class="form-control" id="key" name="keys" auto-complete="off" maxlength="24" required autofocus>
                    </div>
                     
                    <center><p><button class="btn btn-success btn-lg">Decode</button></p></center>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--            
    <div class="container-fluid">
        <center><h3>{{Auth::user()->name}} your uploaded image:</h3></center>
            <br>
            <div id="row">
                <div class="col-lg-3 col-md-3">
                </div>
                <div class="col-lg-6 col-md-6">
                    <center> <img width="60%" height="60%" src="storage/{{Auth::user()->image}}"></center>
                <br>
                </div>
                <div class="col-lg-3 col-md-3">
                </div>            
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4"></div>
                <div class="col-lg-6 col-md-6">         
                            <p>Click on encode to hide a message in the image</p>
                            <p><a class="btn btn-primary btn-lg" href="/encode" role="button">Encode</a>
                            <hr/>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6">
                    <p>Enter the key and click on decode to view the message hidden in the image.</p>
                <div>
                <div class="col-lg-3 col-md-3"></div>
                
            </div>
            <div>
                <form method="post" action="/decode" >
                {{csrf_field()}}
                <div class="form-group">
                <label for="keys" >Enter Key to Decode Image</label>
                <input type="text" class="form-control" id="key" name="keys" auto-complete="off" maxlength="24" required autofocus>
                </div>
                <center><p><button class="btn btn-success btn-lg">Decode</button></p></center>
                </form>
            </div>
        </div>


<div id="row">
    <div class="col-lg-8 col-md-8">
<form method="post" action="" id="form1">
 <input type="text" name="text1"/>
  <input type="submit" name="Encode" value="Encode" onclick="this.form.action='/encode'"/>
  <input type="submit" name="Decode" value="Decode" onclick="this.form.action='/decodeImage'"/>
</form>
</div>

</div>
</div>
</div>
</div>


<script>
  function changeAction(a)
   {
      var formEle=document.getElementById('#form1');
      if(a.value=="Encode")
          formEle.setAttribute("action","/encode");
      else
          formEle.setAttribute("action","/decode");
   }
</script>
-->
@endsection