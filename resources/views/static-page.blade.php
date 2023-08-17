@extends('layouts.app')

@section('content')

<section class="hero-small">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url('{{asset('assetsimages/banner1.jpg')}}') ;">
                        <div class="hero-small-background-overlay"></div>
                        <div class="container  h-100">
                            <div class="row align-items-center d-flex h-100">
                                <div class="col-md-12">
                                    <div class="block">
                                        <span class="text-uppercase text-sm letter-spacing"></span>
                                        <h1 class="mb-3 mt-3 text-center">{{$page->name}}</h1>                                                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </section>

        
        <section class="section-4 py-5 text-center">
            <div class="hero-background-overlay"></div>
            <div class="container">
               <div class="help-container">
                    <h1 class="title">Do you need help?</h1>
                    <p class="card-text mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi ipsum, odit velit exercitationem praesentium error id iusto dolorem expedita nostrum eius atque? Aliquam ab reprehenderit animi sapiente quasi, voluptate dolorum?</p>
                    <a href="{{url('/contact')}}" class="btn btn-primary mt-3">Call Us Now <i class="fa-solid fa-angle-right"></i></a>
               </div>
            </div>
        </section>

        @include('common.latest-blog')
@endsection
