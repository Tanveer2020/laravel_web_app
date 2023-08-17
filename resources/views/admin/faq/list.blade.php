@extends('admin.layouts.app')
@section('content')

            <!-- Content Wrapper. Contains page content -->
            
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Blogs / List</h1>
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
                             

                              @if(Session::has('error'))
                              <div class="alert alert-danger">
                                {{Session::get('error')}}
                            </div>
                             @endif

                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                
                                {{ Session::get('success') }}
                            </div>						
                               @endif
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <a href="{{route('faq.create.form')}}" class="btn btn-primary">Create</a>
                                    </div>
                                    <div class="card-tools">
                                       <form action="" method="get">
                                           <div class="input-group mb-0 mt-0" style="width:250px;">
                                              <input value = "{{(!empty(Request::get('keyword'))) ? Request::get('keyword') : ''}}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                                              <div class="input-group-append">
                                                <button type="submit" class="btn btn-default" >
                                                    <i class="fas fa-search"></i>
                                                </button>
                                              </div>
                                           </div>
                                       </form>  

                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                 <table class="table">
                                     <tr>
                                         <th width="50">Id</th>
                                         <th width="80">Question</th>
                                         <th width="100">Created</th>
                                         <th width="100">Status</th>
                                         <th width="100">Action</th>
                                         

                                     </tr>

                                     @if(!empty($faq))
                                     @foreach($faq as $faqRow)
                                     <tr>
                                         <td>{{$faqRow->id}}</td>
                                         <td>
                                           {{$faqRow->question}}
                                         </td>
                                         <td>{{date('d/m/Y',strtotime($faqRow->created_at))}}</td>
                                         <td>
                                             @if($faqRow->status == 1)
                                             <span class="badge bg-success">Active</span>
                                             @else
                                               <span class="badge bg-success">Block</span>
                                             @endif
                                         </td>
                                         <td><a href="{{route('faq.edit',$faqRow->id)}}" class="">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/> </svg>
                                         </a>
                                     
                                      &nbsp;   
                                     <a href="javascript:void(0)" class="" onclick="deleteFaq({{$faqRow->id}});">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
</svg>
                                         </a>
                                         </td>

                                     </tr>

                                     @endforeach
                                        
                                      @else
                                       <tr>
                                           <td colspan="6">Records Not Found</td>
                                       </tr> 
                                     
                                     @endif
                                 </table>      

                                </div>
                            </div> 
							</div>                            
                        </div>
                        <!-- /.row -->
                       
                       <div class="row">
                        @if(!empty($faq))
                           {{ $faq->links('pagination::bootstrap-4') }}
                          @endif 
                       </div>


                        <!-- /.row (main row) -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
                        <!-- /.content-wrapper -->
@endsection

@section('extraJs')

<script type="text/javascript">
    
    function deleteFaq(id){

        if(confirm("Are you sure you want to delete?")) {

      $.ajax({

            url: '{{ url("/admin/faq/delete")}}/'+id,
            type: 'POST',
            dataType: 'json',
            data: {},
            success: function(response) {
              window.location.href = "{{ route('faqList') }}";
            }
        });
     
   
        }
    }             
</script>

@endsections