@extends('admin.admin_master')
@section('admin')
 

    <div class="page-content">
        <div class="container-fluid">
     
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit about  page</h4>
                           <form method="POST" action="{{route('update.about')}}"  enctype="multipart/form-data">
                            @csrf  
                            <input type="hidden" name="id" value="{{$aboutPage->id}}">
                            {{-- another way to emter into database insted of put parameter for store method--}}
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="title" value="{{$aboutPage->title}}" type="text"  id="title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">short  title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="short_title" value="{{$aboutPage->short_title}}" type="text"  id="short_title">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">short description</label>
                                <div class="col-sm-10">
                                        <textarea name="short_title" value="{{$aboutPage->short_description}}" class="form-control"  id="short_title" cols="20" rows="5">{{$aboutPage->short_description}}    </textarea>                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">Long description</label>
                                <div class="col-sm-10">
                                        <textarea class="form-control" name="long_description" id="elm1"  cols="25" rows="8"> {!!$aboutPage->long_description!!} </textarea>                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="home_slide" class="col-sm-2 col-form-label">About Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="about_image"  type="file"  id="image">
                                </div>
                              
                            </div>
                            <div class="row mb-3">
                                <label  class="col-sm-2 col-form-label"></label>

                                <div class="col-sm-10">

                                    <img class="rounded avatar-lg" id="showImage" src="{{(!empty($aboutPage->home_slide))?
                                        url('upload/frontend_images/'.$aboutPage->home_slide):url('upload/no_image.jpg')}}"
                                         alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update About page">
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