<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pageController extends Controller
{
    
    public function index(){
        $title = 'WELCOME';
        //return view('pages.index', compact('title'));
        return view('pages.index')-> with('title', $title);
    }
    
    public function contact(){
        $title = 'contact';
        return view('pages.contact')-> with('title', $title);
    }

    public function about(){
        $title = 'about';
        return view('pages.about')-> with('title', $title);
    }

    public function howto(){
        $title = 'howto';
        return view('pages.howto')-> with('title', $title);
    }
     
     
    public function encode(){
        $title = 'encode';
        return view('pages.encode')-> with('title', $title);
    }

     public function encodedimage(){
        $title = 'encodedimage';
        return view('pages.encodedimage')-> with('title', $title);
    }
}
