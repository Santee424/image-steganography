@extends('layouts.app')

@section('content')
<div class="container" id="howto" >
    <div class="col-md-11 col-lg-11 content centered"
        style="margin:50px; margin-right:50px;">
        <p><b><h2>Our online image steganography service works in this way:</h2></b></p>
        <div style="border-style: dotted solid; border width:5px;">
<div class="row">
<div class="col-md-6" >       
<ul>
<u><h3><b>Encrypt:</h3></b></u> 
<li>if you don't have account register else login.
<li>Hide a secret message inside a cover image.
<li>Upload a cover image where a secret message  will be hidden in.
<li>The cover image can be any of the following filetypes (max file size = 4Mb): 
.jpeg, .jpg, .png.
<li>To avoid detection please use a cover image with plenty of fine details.
 A cloudless blue sky and a car in front of a red painted wall is not good. 
 Animals in a forrest on a rainy day is much better.
 Also less information hidden inside the cover image is better.
<li>Enter a password/key if you need additional security.
<li>Enter a secret message.
<li>The secret message will be embedded inside the cover image.
<li>The maximum size of the secret message is two lakhs characters.
<li>If a password is entered, the same password is required to unhide the secret message or secret file from the cover image.
<li>Press the "Encode" button.
<li>An encrypted image is created (always a .png file) where the secret message is hidden inside.</li>
</ul>
</div>
<div class= "col-lg-6">
<br>
<br>
<img src="images/mona.jpg" height="400px" width="400px"/>
</div>
</div>
<div class="row">
<div class="col-lg-8">
<ul>
<h3><u><b>Decrypt:</b></u></h3> 
<li>Unhide the secret message or the secret file from the encrypted image.
<li>There are two ways to unhide the secret message or the secret file:
<li>Upload an encrypted image where the secret message is hidden inside.
<li>The encrypted image must be a .png file (max file size = 4 MB).
<li>If a password is specified during the encryption process, the same password is required here.
<li>Press the "Decode" button.
<li>If a secret message is found it will be displayed in the text area.
</ul>
</div>
<div>  
  </div>
  </div>
</div>
</div>
</div>

@endsection