@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>




    <div class="page-content">
        <div class="container-fluid">
     
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">ُEdit Password page</h4><br><br>
                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            @endif
                
                           <form method="POST" action="{{route('update.password')}}"  enctype="multipart/form-data">
                            @csrf  
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Old password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="oldpassword" value="" type="password"  id="oldpassword">
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">New password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="newpassword" value="" type="password"  id="newpassword">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Confirm password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="confirmpassword" value="" type="password"  id="confirmpassword">
                                </div>
                            </div>
                    
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Password">
                        </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
    </div>
               

  
    
    
    
    
    
    


@endsection