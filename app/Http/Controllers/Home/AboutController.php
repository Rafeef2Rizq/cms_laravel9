<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function aboutpage()
    {
        
        $aboutPage = About::find(1);
        return view('admin.about_page.about_page_all', ['aboutPage' => $aboutPage]);
    }
    public function updateAbout(Request $request)
    {
        $slide_id = $request->id; 
        $slider = About::findOrFail($slide_id);
        
        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_path = 'upload/about_images/' . $image_name;
            
            // Resize, orientate, and save the new image
            Image::make($image)->resize(523, 605)->orientate()->save($image_path);
    
            // Delete the old image if it exists
            if ($slider->about_image && File::exists($slider->about_image)) {
                File::delete($slider->about_image);
            }
            
            $slider->about_image = $image_path;
        }
        
        $slider->title = $request->title;
        $slider->short_title = $request->short_title;
        $slider->short_description = $request->short_description;
        $slider->long_description = $request->long_description;
        $slider->save();
        
        $notification = [
            'message' => 'about page updated successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }
    public function homeAbout(){
        $about=About::find(1);
        return view('frontend/about',['about'=>$about]);
    }
}
