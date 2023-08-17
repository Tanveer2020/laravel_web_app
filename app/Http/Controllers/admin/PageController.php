<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempFile;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
class PageController extends Controller
{
   
    public function index(Request $request)
    {
        $pages = Page::orderBy('created_at','DESC');

        if(!empty($request->keyword)) {
            $pages = $pages->where('name','like', '%'.$request->keyword. '%');
        }

        // $pages = $pages->paginate(20);

        $data['pages'] = $pages->paginate(20);

        return view('admin.pages.list',$data);
    }

    public function create()
    {
        return view('admin.pages.create');
    }
     
     // This method will save a page in DB
    public function save(Request $request)
    {
          $validator =   Validator::make($request->all(),[
         
            'name' => 'required',
          

            ]);

          if($validator->passes()){
           
           $page = new Page;
           $page->name    = $request->name;
           $page->content = $request->content;
           $page->status  = $request->status;
           $page->save();

            if($request->image_id > 0) {

    $tempImage = TempFile::where('id', $request->image_id)->first();

    $tempFileName = $tempImage->name;
    $imageArray = explode('.',$tempFileName);
    $ext = end($imageArray);

    $newFileName = 'page-' .$page->id. '.' .$ext;

    $sourcePath = './uploads/temp/'.$tempFileName;

    // Generate Small Thumbnail

    // $dPath = './uploads/pages/thumb/small/' .$newFileName;
    // $img   = Image::make($sourcePath);
    // $img->fit(360,220);
    // $img->save($dPath);

        // Generate Large Thumbnail

    $dPath = './uploads/pages/thumb/large/' .$newFileName;
    $img   = Image::make($sourcePath);
    $img->resize(1150,null, function ($constraint) {
      $constraint->aspectRatio();
    });
    $img->save($dPath);
      
      // This will update image in DB
     $page->image = $newFileName;
     $page->save(); 

     File::delete($sourcePath);  


$request->session()->flash('success','Page Created Successfully');

     return response()->json([

       'status' => 200,
       'message'=> 'Page created Successfully'   
    
     ]);

         }

         else {

            return response()->json([
 
             'status' => 0,
             'errors' => $validator->errors()
            ]);
         }
    }

}

public function edit($id, Request $request) {

    $page = Page::where('id',$id)->first();

    if($page == null) {

        return redirect()->route('pageList');
    }
    
    
    $data['page'] = $page;

    return view('admin.pages.edit',$data);

}


public function update($id, Request $request) {


  $validator =   Validator::make($request->all(),[
         
            'name' => 'required',
          

            ]);

          if($validator->passes()){
           
           $page = Page::find($id);
           $page->name    = $request->name;
           $page->content = $request->content;
           $page->status  = $request->status;
           $page->save();

           
    if($request->image_id > 0) {

    $tempImage = TempFile::where('id', $request->image_id)->first();

    $tempFileName = $tempImage->name;
    $imageArray = explode('.',$tempFileName);
    $ext = end($imageArray);

    $newFileName = 'page-' .$page->id. '.' .$ext;

    $sourcePath = './uploads/temp/'.$tempFileName;

    // Generate Small Thumbnail

    // $dPath = './uploads/pages/thumb/small/' .$newFileName;
    // $img   = Image::make($sourcePath);
    // $img->fit(360,220);
    // $img->save($dPath);

        // Generate Large Thumbnail

    $dPath = './uploads/pages/thumb/large/' .$newFileName;
    $img   = Image::make($sourcePath);
    $img->resize(1150,null, function ($constraint) {
      $constraint->aspectRatio();
    });
    $img->save($dPath);
      
      // This will update image in DB
     $page->image = $newFileName;
     $page->save(); 

     File::delete($sourcePath);  

 }

$request->session()->flash('success','Page Updated Successfully');
      return response()->json([

       'status' => 200,
       'message'=> 'Page Updated Successfully'   

     ]);


         }

         else {

            return response()->json([
 
             'status' => 0,
             'errors' => $validator->errors()
            ]);
         }
     } 



public function delete($id, Request $request){

    $page = Page::where('id',$id)->first();

    File::delete('./uploads/pages/thumb/large/'.$page->image);
    $page->delete();
    $request->session()->flash('success','Page deleted successfully');
    return response()->json([
   
     'status' =>200,
    ]);

}

public function deleteImage(Request $request) {

    $page = Page::find($request->id);
    $oldImage = $page->image;
    
    $page->image = '';
    $page->save();
   
    File::delete('./uploads/pages/thumb/large/'.$oldImage);

    return response()->json([

           'status' => 200,  
    ]);
}

}


