@extends('layouts.app')

@section('content')
<div id="index">
  <div class="container">
    <div class="jumbotron text-center" style="margin:20px">
             <div class="wow zoomIn" id="title">
                  <h1>{{$title}}</h1>
              </div>
              
            <p>This is the home page of Steganography Website.</p>
            Steganography is the practice of concealing a file, message,
             image, or video within another file, message, image, or video.
             <b>Image Steganography</b> is the process of hiding a secret message within a <b>Image</b> in such a way that someone can not know the presence or contents of the hidden message. 
             The purpose of Steganography is to maintain secret communication between two parties.
             <p>
This online steganography service lets you hide a secret message inside a cover image. </p>
            <p><a href="{{ route('login') }}"> <button type="button" class="btn btn-primary btn-lg" id="myBtn">Login</button> </a>  
            <a href="{{ route('register') }}"> <button type="button" class="btn btn-success btn-lg" id="myBtn">Register</button></a></p> 
    </div>
</div>
</div>
</div>
@endsection