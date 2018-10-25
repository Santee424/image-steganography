<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use DB;
use Auth;
use View;


class codecontroller extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }     

public function count()
    {
        $name = Auth::user()->name;
        $src = "storage/".$name.".png";
        list($width, $height) = getimagesize($src);
        $char = ($width-1)*$height*3/8;
        $max_char = floor( $char );
        return view('pages.encode',compact('max_char'));
        //return View::make("pages.encode")->with(array('max_char'=>$max_char));
    }
    
    
 public function encodeImage(Request $request)
    {   
        //bin function
        function toBin($str){
            $str = (string)$str;
            $l = strlen($str);;
            $result = '';
            while($l--){
              $result = str_pad(decbin(ord($str[$l])),8,"0",STR_PAD_LEFT).$result;
            }
            return $result;
        }

        function toString($binary){
            return pack('H*',base_convert($binary,2,16));
            
        }

       //encryption function
        ini_set('max_execution_time', 1800);
        $name = Auth::user()->name;
        $message = $request->message;
        $src = "storage/".$name.".png";
        
        //$src=public_path('storage/my_images/'. auth()->user()->name.".png");
        //$src = "public/storage/".auth()->user()->name.".png";
        //$src="{{Auth::user()->my_image}}";

        $im = imagecreatefrompng($src);
        //for key
        $key = $request->key;
        $key_to_hide = $key;
        $binary_key = toBin($key_to_hide);
        $key_length = strlen($binary_key);//48
        $key_length_bin = decbin($key_length);//110000
        $key_length_bl = strlen($key_length_bin);//6
        list($width, $height) = getimagesize($src);

        //for encoding key
        //$u=0;
        if($key_length <= 192){
            $vaca = 9 - $key_length_bl;//3
            $uu = -1;
            $newR = $newG = $newB = 0;
            $ee=0;
                for($ff=8;$ff<11;$ff++){
                    $rgb = imagecolorat($im,$ee,$ff);
                    $r = ($rgb >>16) & 0xFF;
                    $g = ($rgb >>8) & 0xFF;
                    $b = $rgb & 0xFF;
                    echo " r= ".decbin($r)."...";
                    echo " g= ".$g."...";
                    echo " b= ".$b."...";

                    $uu+=1;
                    if ($uu<$vaca){
                        $newR = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                        $newR[strlen($newR)-1] = 0;
                        //echo " kr= ".$newR[strlen($newR)-1]."..."; 
                        $newR = bindec($newR);
                        
                        
                    }
                    else break;
                    $uu+=1;
                    if ($uu<$vaca){
                        $newG = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                        $newG[strlen($newG)-1] = 0;
                        //echo " kg= ".$newG[strlen($newG)-1]."...";
                        $newG = bindec($newG);
                        
                        
                    }
                    else break;
                    $uu+=1;
                    if ($uu<$vaca){
                        $newB = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                        $newB[strlen($newB)-1] = 0;
                        //echo " kb= ".$newB[strlen($newB)-1]."...";
                        $newB = bindec($newB);
                        
                        
                    }
                    else  break;

                    $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                    imagesetpixel($im,$ee,$ff,$new_color);
                }
        
        
            $zz = $key_length_bl;
            $ii=0;
                for($jj=10;$jj>7;$jj--){
                    $rgb = imagecolorat($im,$ii,$jj);
                    $r = ($rgb >>16) & 0xFF;
                    $g = ($rgb >>8) & 0xFF;
                    $b = $rgb & 0xFF;
                    echo " r= ".decbin($r)."...";
                    echo " g= ".$g."...";
                    echo " b= ".$b."...";
                    $newR = 0;
                    $newG = 0;
                    $newB = 0;

                    if($key_length_bl < 9){
                        $zz-=1;
                        if ($zz>-1){
                            $newB = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                            $newB[strlen($newB)-1] = $key_length_bin[$zz];
                            //echo " kb= ".$newB[strlen($newB)-1]."...";
                            $newB = bindec($newB);
                            $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                            imagesetpixel($im,$ii,$jj,$new_color);
                            
                        }
                        else break;
                        $zz-=1;
                        if ($zz>-1){
                            $newG = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                            $newG[strlen($newG)-1] = $key_length_bin[$zz];
                            //echo " kg= ".$newG[strlen($newG)-1]."...";
                            $newG = bindec($newG);
                            $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                            imagesetpixel($im,$ii,$jj,$new_color);
                            
                        }
                        else  break;
                        $zz-=1;
                        if ($zz>-1){
                            $newR = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                            $newR[strlen($newR)-1] = $key_length_bin[$zz];
                            //echo " kr= ".$newR[strlen($newR)-1]."...";
                            $newR = bindec($newR);
                            $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                            imagesetpixel($im,$ii,$jj,$new_color);
                            
                        }
                        else  break;

                    }
                    else{
                        return'The message is too long';
                    }
                    
                }

                $xx=-1;
                $pp=0;
                $count = 0;
                $newR = $newG = $newB = 0;
                    for($qq=11;$qq<75;$qq++){
                    
                        $rgb = imagecolorat($im,$pp,$qq);
                        $r = ($rgb >>16) & 0xFF;
                        $g = ($rgb >>8) & 0xFF;
                        $b = $rgb & 0xFF;
                        echo " r= ".decbin($r)."...";
                        echo " g= ".$g."...";
                        echo " b= ".$b."...";

                        $xx+=1;
                        if ($xx<$key_length){
                            $newR = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                            $newR[strlen($newR)-1] = $binary_key[$xx];
                            $newR = bindec($newR);
                            $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                            imagesetpixel($im,$pp,$qq,$new_color);
                            
                        }
                        else break;
                        $xx+=1;
                        if ($xx<$key_length){
                            $newG = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                            $newG[strlen($newG)-1] = $binary_key[$xx];
                            $newG = bindec($newG);
                            $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                            imagesetpixel($im,$pp,$qq,$new_color);
                            
                        }
                        else break;
                        $xx+=1;
                        if ($xx<$key_length){
                            $newB = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                            $newB[strlen($newB)-1] = $binary_key[$xx];
                            $newB = bindec($newB);
                            $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                            imagesetpixel($im,$pp,$qq,$new_color);
                            
                        }
                        else break;
                    }
        }
        else{
            return'The key is too long.';
        }


        //for encoding message length
        $message_to_hide = $message;
        $binary_message = toBin($message_to_hide);
        $message_length = strlen($binary_message);//240
        //echo "msnlen".$message_length."...";
        $message_length_bin = decbin($message_length);//11110000
        $message_length_bl = strlen($message_length_bin);//8
        if($message_length_bl <= 24){
            $vac = 24 - $message_length_bl;//16
            $u = -1;
            $newR = $newG = $newB = 0;            
            $e=0;
                for($f=0;$f<8;$f++){
                    $rgb = imagecolorat($im,$e,$f);
                    $r = ($rgb >>16) & 0xFF;
                    $g = ($rgb >>8) & 0xFF;
                    $b = $rgb & 0xFF;
                    //echo "r= ".$r;
                    $u+=1;
                    if ($u<$vac){
                        $newR = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                        $newR[strlen($newR)-1] = 0;
                        $newR = bindec($newR);
                        $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                        imagesetpixel($im,$e,$f,$new_color);
                        
                    }
                    else{ 
                        break;
                    }
                    $u+=1;
                    if ($u<$vac){
                        $newG = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                        $newG[strlen($newG)-1] = 0;
                        $newG = bindec($newG);
                        $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                        imagesetpixel($im,$e,$f,$new_color);
                        
                    }
                    else { 
                        break;
                    }
                    $u+=1;
                    if ($u<$vac){
                        $newB = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                        $newB[strlen($newB)-1] = 0;
                        $newB = bindec($newB);
                        $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                        imagesetpixel($im,$e,$f,$new_color);
                        
                    }
                    else { 
                        break;
                    }

                    
                }
        }
        else{
            return'The message is too long.';
        }
        
        $z = $message_length_bl;
        $i=0;
            for($j=7;$j>-1;$j--){
                $rgb = imagecolorat($im,$i,$j);
                $r = ($rgb >>16) & 0xFF;
                $g = ($rgb >>8) & 0xFF;
                $b = $rgb & 0xFF;
                $newR = $newG = $newB = 0;

                if($message_length < 16777208){
                    $z-=1;
                    if ($z>-1){
                        $newB = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                        $newB[strlen($newB)-1] = $message_length_bin[$z];
                        $newB = bindec($newB);
                        $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                        imagesetpixel($im,$i,$j,$new_color);
                        
                    }
                    else { break;}
                    $z-=1;
                    if ($z>-1){
                        $newG = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                        $newG[strlen($newG)-1] = $message_length_bin[$z];
                        $newG = bindec($newG);
                        $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                        imagesetpixel($im,$i,$j,$new_color);
                        
                    }
                    else  { break;}
                    
                    $z-=1;
                    if ($z>-1){
                        $newR = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                        $newR[strlen($newR)-1] = $message_length_bin[$z];
                        $newR = bindec($newR);
                        $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                        imagesetpixel($im,$i,$j,$new_color);
                        
                    }
                    else  { break;}

                    

                }
                else{
                    return'The message is too long';
                }
                
            }

        //for endcoding message
        $count = 0;
        $x=-1;
        for($p=1;$p<$width;$p++){
            for($q=0;$q<$height;$q++){
            
                $rgb = imagecolorat($im,$p,$q);
                $r = ($rgb >>16) & 0xFF;
                $g = ($rgb >>8) & 0xFF;
                $b = $rgb & 0xFF;
                $x+=1;
                if ($x<$message_length){
                    $newR = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                    $newR[strlen($newR)-1] = $binary_message[$x];
                    $newR = bindec($newR);
                    $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                    imagesetpixel($im,$p,$q,$new_color);
                    $count+=1;
                    
                    
                }
                else { break 2;}
                $x+=1;
                if ($x<$message_length){
                    $newG = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                    $newG[strlen($newG)-1] = $binary_message[$x];
                    $newG = bindec($newG);
                    $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                    imagesetpixel($im,$p,$q,$new_color);
                    $count+=1;;
                    
                }
                else{ break 2;}
                $x+=1;
                if ($x<$message_length){
                    $newB = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                    $newB[strlen($newB)-1] = $binary_message[$x];
                    $newB = bindec($newB);
                    $new_color = imagecolorallocate($im,$newR,$newG,$newB);
                    imagesetpixel($im,$p,$q,$new_color);
                    $count+=1;
                    
                }
                else { break 2;}

                
            }
        }

        echo $x;
        //imagepng($im,Auth::user()->image);
        imagepng($im, "storage/".$name.".png");
        imagedestroy($im);
        
        return redirect('/encodedimage')->with('success', 'Image Encoded successfully');
       //return "Encrypting message $message to image $imageFile";
        //echo "message_length".$message_length."...";
        //echo "count..".$count."..";
        //imagepng($im, 'simple.png');
        //imagedestroy($im);
        //$img_final = "simple.png";
        //return View::make("pages.encodedimage")->with(array('img_final' => $img_final));
    }













    //decode function
    public function decode(Request $request)
    {   
        ini_set('max_execution_time', 1800);
        $max_execution_time = 
        $key = $request->keys;
        $keys = $key;
        function toBin($str){
            $str = (string)$str;
            $l = strlen($str);
            $result = '';
            while($l--){
              $result = str_pad(decbin(ord($str[$l])),8,"0",STR_PAD_LEFT).$result;
            }
            return $result;
          }

        function toString($binary){
            return pack('H*',base_convert($binary,2,16));
        }
        
        //decryption function
        $name = Auth::user()->name;
        $src = "storage/".$name.".png";
        $im = imagecreatefrompng($src);
        list($width, $height) = getimagesize($src);
        $decode_key_l = '';

        //for extracting key
        $mm=0;
            for($nn=8;$nn<11;$nn++){

                $rgb = imagecolorat($im, $mm, $nn);
                $r = ($rgb >>16) & 0xFF;
                $g = ($rgb >>8) & 0xFF;
                $b = $rgb & 0xFF;

                    $red = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                    $decode_key_l = $decode_key_l.$red[strlen($red)-1];
                
                    $green = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                    $decode_key_l = $decode_key_l.$green[strlen($green)-1];
                
                    $blue = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                    $decode_key_l = $decode_key_l.$blue[strlen($blue)-1];
                
            }
            $decode_key_dec = bindec($decode_key_l);

            $yy = -1;
            $real_key = '';
            $vv=0;
                for($ww=11;$ww<75;$ww++){
    
                    $rgb = imagecolorat($im, $vv, $ww);
                    $r = ($rgb >>16) & 0xFF;
                    $g = ($rgb >>8) & 0xFF;
                    $b = $rgb & 0xFF;
                    
                    $yy+=1;
                    if($yy<$decode_key_dec){
                        $red = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                        $real_key = $real_key.$red[strlen($red)-1];
                    }
                    else{
                        break;
                    }
                    $yy+=1;
                    if($yy<$decode_key_dec){
                        $green = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                        $real_key = $real_key.$green[strlen($green)-1];
                    }
                    else{
                        break;
                    }
                    $yy+=1;
                    if($yy<$decode_key_dec){
                        $blue = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                        $real_key = $real_key.$blue[strlen($blue)-1];
                    }
                    else{
                        break;
                    }
                }
            $real_key_final = '';
            for($rr=0;$rr<$decode_key_dec/8;$rr++){
                
                $slice_first = substr($real_key, 0, 8);
                $real_key = substr($real_key, 8);
                
                $real_key_final .= toString($slice_first);
            }

        if($keys == $real_key_final){
            //for extracting message length
            $msg_len = '';
            $m=0;
            for($n=0;$n<8;$n++){
                                    
                $rgb = imagecolorat($im, $m, $n);
                $r = ($rgb >>16) & 0xFF;
                $g = ($rgb >>8) & 0xFF;
                $b = $rgb & 0xFF;
                    
                $red = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                $msg_len .= $red[strlen($red)-1];
                //echo " red= ".$red."...";
                $green = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                $msg_len .= $green[strlen($green)-1];
                //echo " green= ".$green."...";

                $blue = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                $msg_len .= $blue[strlen($blue)-1];
                //echo " blue= ".$blue."...";
            }
            $msg_len_b = bindec($msg_len);
            $letters =  $msg_len_b/8;
            //echo $no_of_characters;
            
            //for extracting message
            $y = -1;
            $real_message = '';
            for($v=1;$v<$width;$v++){
                for($w=0;$w<$height;$w++){

                    $rgb = imagecolorat($im, $v, $w);
                    $r = ($rgb >>16) & 0xFF;
                    $g = ($rgb >>8) & 0xFF;
                    $b = $rgb & 0xFF;
                        
                    $y+=1;
                    if($y<$msg_len_b){
                        $red = str_pad((decbin($r)),8,"0",STR_PAD_LEFT);
                        $real_message = $real_message.$red[strlen($red)-1];
                    }
                    else{
                        break 2;
                    }
                    $y+=1;
                    if($y<$msg_len_b){
                        $green = str_pad((decbin($g)),8,"0",STR_PAD_LEFT);
                         $real_message = $real_message.$green[strlen($green)-1];
                    }
                    else{
                        break 2;
                    }
                    $y+=1;
                    if($y<$msg_len_b){
                        $blue = str_pad((decbin($b)),8,"0",STR_PAD_LEFT);
                        $real_message = $real_message.$blue[strlen($blue)-1];
                    }
                    else{
                        break 2;
                    }
                }
            }
            $real_message_final = '';
            for($r=0;$r<$msg_len_b/8;$r++){
                    
                $slice_first = substr($real_message, 0, 8);
                $real_message = substr($real_message, 8);
                $real_message_final .= toString($slice_first);
            }
            //echo $real_message_final;
            return view('pages.decode',compact('real_message_final'));
            die;
        }
        else{
            //return "Invalid Key";
            return redirect('/display')->with('message', 'Invalid key');
            
            //return redirect()->back()->with('message', 'invalid key');
        
              
              
        }

    }
    
}                                                                                   