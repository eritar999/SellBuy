<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ImageUpload;
 
class ImageUploadController extends Controller
{
    public function index()
    {
        return view('MultipleimageUpload.add');
    }
 
    public function List()
    {
        return view('MultipleimageUpload.list');
    }
 
    public function ImageStore(Request $request)
    {
    #Handle File  images
       $this->validate($request, ['business_imgs' => 'required', 'business_imgs.*' => 'required|image|max:1999']);
 
        if($request->hasfile('business_imgs'))
             {
                foreach($request->file('business_imgs') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/Img/MultipleImg/';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
             }
 
             else
             {
                 $banner_data = 'noimg';
             }
        $Data = new ImageUpload();
        $Data->business_name = $request->business_name;
        $Data->business_imgs = json_encode($Imgdata);
        $Data->save();
        return redirect()->route('image.list');
 
    }
}
