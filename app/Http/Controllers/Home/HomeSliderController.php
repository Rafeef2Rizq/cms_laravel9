<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    public function homeSlider()
    {
        $homeSlider = HomeSlider::find(1);
        return view('admin.home_slide.home_slider', ['homeSlider' => $homeSlider]);
    }
    public function updateSlider(Request $request)
    {
        $slide_id = $request->id; 
        $slider = HomeSlider::findOrFail($slide_id);
        
        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image_path = 'upload/frontend_images/' . $image_name;
            
            // Resize, orientate, and save the new image
            Image::make($image)->resize(600, 800)->orientate()->save($image_path);
    
            // Delete the old image if it exists
            if ($slider->home_slide && File::exists($slider->home_slide)) {
                File::delete($slider->home_slide);
            }
            
            $slider->home_slide = $image_path;
        }
        
        $slider->title = $request->title;
        $slider->short_title = $request->short_title;
        $slider->video_url = $request->video_url;
        $slider->save();
        
        $notification = [
            'message' => 'Home slider updated successfully',
            'alert-type' => 'success'
        ];
        
        return redirect()->back()->with($notification);
    }
    
}
