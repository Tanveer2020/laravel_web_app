@extends('admin.layouts.app')
@section('content')

            <!-- Content Wrapper. Contains page content -->
            
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Blogs / Edit</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content  h-100">
                    <div class="container-fluid  h-100">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
							<div class="col-md-12">

                                <form action="" method="post" name="editBlog" id="editBlog
                                " enctype="multipart/form-data">

                                @csrf
                               
                                <div class="card">

							    <div class="card-header">
                                 
                                 <a href="{{route('blogList')}}" class="btn btn-primary">Back</a>
							     </div>								

                                 <div class = "card-body">
                                   <div class="form-group">
                                   	<label for="name">Name</label>
                                   	<input type="text" value="{{$blog->name}}" name="name" id = "name" class="form-control">
                                    <p class="error name-error"></p>
                                   </div>
                                   <div class="form-group">
                                   	<label for="name">Description</label>
                                    <textarea name="description" id="description" class="summernote">{{$blog->description}}</textarea> 
                                   </div> 
                                   <div class="row">
                                   	 <div class="col-md-6">
                                        <input type="hidden" name="image_id" id = "image_id" value="">
                                   	 	<label for="Image">Image</label>
                                   	 	<div id="image" class="dropzone dz-clickable">
                                   	     <div class="dz-message needsclick">
                                   	     	<br>Drop files here or click to upload.
                                   	     	<br><br>
                                   	     </div>		
                                   	 		
                                   	 	</div>

                                         @if(!empty($blog->image))
                                             <img class="img-thumbnail my-4" src="{{asset('uploads/blogs/thumb/small/'.$blog->image)}}" width="300">
                                             @endif

                                   	 	
                                   	 </div>
                                   <div class="col-md-6">
                                   	 <label for="">Short Description</label> 
                                   	 <textarea name="short_description" id = "short_description" cols = "30" rows = "6" class="form-control">{{$blog->short_desc}}</textarea>
                                   </div>
                                   </div>
                                   <div class="form-group mt-4">
                                       <label for="status">Status</label>
                                       <select name="status" id = "status" class="form-control ">
                                          <option value="1" {{($blog->status == 1) ? 'selected' : ''}}>Active</option>  
                                          <option value="0" {{($blog->status == 0) ? 'selected' : ''}}>Block</option>  


                                       </select>
                                   </div>
                                     <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                
                                 </div>
             </div>
                             </form>
							</div>                            
                        </div>
                        <!-- /.row -->
                        <!-- /.row (main row) -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
                        <!-- /.content-wrapper -->
@endsection

@section('extraJs')

<script type="text/javascript">
 
 Dropzone.autoDiscover = false;
 const dropzone = $("#image").dropzone({
   init:function() {
   	this.on('addedfile', function(file) {
       if(this.files.length > 1) {
       	this.removeFile(this.files[0]);
       }
   	});
   },

   url: "{{route('tempUpload')}}",
   maxFiles:1,
   addRemoveLinks:true,
   acceptedFiles: "image/jpeg,image/png,image/gif",
   headers: {
   	 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
      success: function(file,response){
       $("#image_id").val(response.id);

      }
 });
   
   $("#editBlog").submit(function(event){
        
        event.preventDefault();
        $("button[type = 'submit']").prop('disabled',true);

        $.ajax({

            url: '{{ route("blog.update",$blog->id)}}',
            type: 'POST',
            dataType: 'json',
            data: $("#editBlog").serializeArray(),
            success: function(response) {
                 $("button[type = 'submit']").prop('disabled',false);
                if(response.status == 200) {

                    // no error

                    window.location.href = '{{route("blogList")}}';
                }

                else {
                    // Here we will show errors
                    $('.name-error').html(response.errors.name);
                }

            }
        });
     
   });

</script>
@endsection