@extends('admin.admin_master')
@section('admin')
 

    <div class="page-content">
        <div class="container-fluid">
     
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">ُEdit home slider page</h4>
                           <form method="POST" action="{{route('update.slider')}}"  enctype="multipart/form-data">
                            @csrf  
                            <input type="hidden" name="id" value="{{$homeSlider->id}}">
                            {{-- another way to emter into database insted of put parameter for store method--}}
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" value="{{$homeSlider->title}}" type="text"  id="title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">description of title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="short_title" value="{{$homeSlider->short_title}}" type="text"  id="short_title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="video_url" class="col-sm-2 col-form-label">video url</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="video_url" value="{{$homeSlider->video_url}}" type="url"  id="video_url">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="home_slide" class="col-sm-2 col-form-label">Home slider Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="home_slide"  type="file"  id="image">
                                </div>
                              
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label"></label>

                                <div class="col-sm-10">

                                    <img class="rounded avatar-lg" id="showImage" src="{{(!empty($homeSlider->home_slide))?
                                        url('upload/frontend_images/'.$homeSlider->home_slide):url('upload/no_image.jpg')}}"
                                         alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Home slider">
                        </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
    </div>
               
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
    
    
    
    
    
    
    


@endsection