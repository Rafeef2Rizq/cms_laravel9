<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
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
        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(636, 852)->save('upload/frontend_images' . $image_name);
            $save_url = 'upload/frontend_images' . $image_name;

            HomeSlider::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'home_slide' => $save_url,
                'video_url' => $request->video_url,

            ]);


            $notification = [
                'message' => 'Home slider update with image  successfully',
                'alert-type' => 'success'
            ];
        } else {
            HomeSlider::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,

                'video_url' => $request->video_url,

            ]);


            $notification = [
                'message' => 'Home slider update without image  successfully',
                'alert-type' => 'success'
            ];
        }
        return redirect()->back()->with($notification);
    }
}
