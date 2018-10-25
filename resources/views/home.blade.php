@extends('layouts.app')

@section('content')
<div id="home">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin:20px";>
                <div class="panel-heading"> <h3><b>Welcome {{Auth::user()->name}}!</b></h3></div>

                <div class="panel-body">
                    @if(session()->has('message'))
                        <div class="alert alert-warning">
                            {{ session()->get('message') }}
                            </div>
                    @endif
                    <div>
                        Image steganography is the art of hiding messages in an image.
                        This is a great way to send a secret message to a friend without drawing attention to it. Compare this method to simply sending someone an encrypted piece of text. No matter 
                        how strong the encryption method is, If someone is monitoring the communication, they'll find it highly suspicious.
                    
                    <ul>
                    <li>To encode a message into an image, choose the cover image you want to use.</li>
                     <li>enter key and text then hit the Encode button.</li> 
                    <li>Save the encoded image, it will contain your hidden message. </li>
                    <li>if you want to decode,upload the encoded image,provide the same key and then decode.</li>
                    <li>for detail information go to <a href='/howto'>howto</a>. 
                    </ul>
                    Remember, the more text you want to hide, the larger the image has to be and longer the time it will take to encode.
                    Neither the image nor the message hidden will be transmitted over the web, all the magic happens within browser.
                    </div>
                    <hr>
                    <div>
                      <h2>  upload your cover image </h2>
                      <br>
                    </div>
                <!--   {!! Form::open(['action' =>'imageController@store', 'method' => 'POST',
                        'enctype' =>'multipart/form-data','id' => 'upload' ]) !!}
                        <div class="form-group">
                            {{Form::file('image')}}
                        </div>
                    {{Form::submit('Upload Photo',['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                      -->     
                <form action="/store" method="POST" enctype ='multipart/form-data'>
                     {{csrf_field()}}
                    <input type="file"  id="image" name="image" accept="image/*" onchange="loadFile(event)" id="image">
                    <img id="output" height="50%" width="50%"/><br>
                    <p><button class="btn btn-primary btn-lg">upload photo</button>
                </form>
                                
                
                </div>
            </div> 
        </div>
    </div> 
</div>
</div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>    
@endsection
