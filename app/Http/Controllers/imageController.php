<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use Image;
use DB;



class imageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {  
         $this->validate($request,[
            'my_image'=> 'image|nullable|max:1999'
        ]);
        
        
        
            
            //$file_name=auth()->user()->name.'.' . "jpg";
            //$location = $request->file('image')->storeAs('storage',$file_name);
            //$users=auth()->user(); 
            //$users->image=$file_name;//this is how you save image in the database
                         

        if($request->hasFile('image')){
            $file = $request->file('image');
            list($width, $height, $bits) = getimagesize($file);
            $info = getimagesize($file);
            if($height<100 && $width<100){
                return "Use an image with height and width of atleast 100px";
            }
            else{
                $extension = image_type_to_extension($info[2]);
                //$extension = $image->getClientOriginalExtension();
                //echo $extension; 
                $name = auth()->user()->name;
                if($extension == ".jpg" || $extension == ".jpeg"){
                    
        
                    
                    //$location = $request->file('image')->storeAs('storage',$file_name);
                    //return $location;
                  
                    $image = imagecreatefromjpeg($file);
                    imagepng($image, "storage/".$name.".png");
                    $file_name = $name.".png";
                    //move_uploaded_file($file_name, "storage/".$file_name);
                    //$file->move("storage/",$file_name);   
                    //return View::make("pages/display")->with(array('file_name'=>$file_name));        
                    $users=auth()->user();
                    $users->image=$file_name;
                }
                elseif($extension == ".png"){
                    $file->move("storage/",$name.".png");
                    $file_name = $name.".png";
                    //move_uploaded_file($file_name, "storage/".$file_name);
                    //$file->move("storage/",$file_name);   
                    //return View::make("pictures/show")->with(array('file_name'=>$file_name));
                    $users=auth()->user();
                    $users->image=$file_name; 
                    }
                else{
                    //return "Invalid image type.";
                    return redirect()->back()->with('message', 'invalid image type');        
                    
                }
            }  
        } 
    else
        {
            //return 'No file selected';
            return redirect()->back()->with('message', 'no file selected');
        }
        $users=auth()->user();
        $users->image=$file_name; 
        $users->save();
        return redirect('/display')->with('success', 'Image Uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

     return  view('pages.display'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     public function destroy($id)
    {
        //
    }
}
