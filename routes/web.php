<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Admincontroller;
use App\Http\Controllers\admin\Dashboardcontroller;
use App\Http\Controllers\admin\BlogController as AdminBlogController;
use App\Http\Controllers\admin\FaqController as AdminFaqcontroller;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\TempImageController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class,'index']);

Route::get('/about-us',[HomeController::class,'about'])->name('about');
Route::get('/terms',[HomeController::class,'terms'])->name('terms');
Route::get('/privacy',[HomeController::class,'privacy'])->name('privacy');
Route::get('/services',[ServicesController::class,'index']);
Route::get('/services/detail/{id}',[ServicesController::class,'detail']);
Route::get('/contact',[ContactController::class,'index']);
Route::post('/send-email',[ContactController::class,'sendEmail'])->name('sendContactEmail');
Route::get('/faq',[FaqController::class,'index']);
Route::get('/blog',[BlogController::class,'index'])->name('blog.front');
Route::get('/blog/{id}',[BlogController::class,'detail'])->name('blog-detail');
Route::post('/save-comment',[BlogController::class,'saveComment'])->name('save.blog');






Route::group(['prefix' => 'admin'], function(){
  
   Route::group(['middleware' => 'admin.guest'], function() {
        // here we will define guest route
     Route::get('/login',[Admincontroller::class,'index'])->name('admin.login');
     Route::post('/login',[Admincontroller::class, 'authenticate'])->name('admin.auth');
   });

  Route::group(['middleware' => 'admin.auth'], function() {
           // here we will define password protected routes
   
       Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard'); 
       Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
       Route::get('/services/create',[ServiceController::class,'create'])->name('service.create.form');
       Route::post('/services/create',[ServiceController::class,'save'])->name('service.create');

       Route::post('/temp/upload',[TempImageController::class,'upload'])->name('tempUpload'); 

       Route::get('/services',[ServiceController::class,'index'])->name('serviceList');

        Route::get('/services/edit/{id}',[ServiceController::class,'edit'])->name('service.edit');
        Route::post('/services/edit/{id}',[ServiceController::class,'update'])->name('service.edit.update');
        Route::post('/services/delete/{id}',[ServiceController::class,'delete'])->name('service.delete');

        
        // Blog Routes

        Route::get('/blog/create',[AdminBlogController::class,'create'])->name('blog.create.form');  
        Route::post('/blog/create',[AdminBlogController::class,'save'])->name('blog.save');  
        Route::get('/blog',[AdminBlogController::class,'index'])->name('blogList');
        Route::get('/blog/edit/{id}',[AdminBlogController::class,'edit'])->name('blog.edit');
        Route::post('/blog/edit/{id}',[AdminBlogController::class,'update'])->name('blog.update');
        Route::post('/blog/delete/{id}',[AdminBlogController::class,'delete'])->name('blog.delete');

        // Faq Route

        Route::get('/faq',[AdminFaqcontroller::class,'index'])->name('faqList');
        Route::get('/faq/create',[AdminFaqcontroller::class,'create'])->name('faq.create.form');
        Route::post('/faq/create',[AdminFaqcontroller::class,'save'])->name('faq.save');
        Route::get('/faq/edit/{id}',[AdminFaqController::class,'edit'])->name('faq.edit');
        Route::post('/faq/edit/{id}',[AdminFaqController::class,'update'])->name('faq.update');
        Route::post('/faq/delete/{id}',[AdminFaqController::class,'delete'])->name('faq.delete');
  

       // Page Routes


        Route::get('/page/create',[PageController::class,'create'])->name('page.create.form');
        Route::post('/page/create',[PageController::class,'save'])->name('page.save');
        Route::get('/pages',[PageController::class,'index'])->name('pageList');
        Route::get('/page/edit/{id}',[PageController::class,'edit'])->name('page.edit');
        Route::post('/page/edit/{id}',[PageController::class,'update'])->name('page.update');
        Route::post('/page/delete/{id}',[PageController::class,'delete'])->name('page.delete');

        Route::post('/page/deleteImage',[PageController::class,'deleteImage'])->name('page.deleteImage');


      // Setting Routes

        Route::get('/settings',[SettingsController::class,'index'])->name('settings.index');
        Route::post('/settings',[SettingsController::class,'save'])->name('settings.save');


  });   

});