@extends('layouts.app')

@section('content')



  <section class="hero-small">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url('{{asset('assets/images/banner1.jpg')}}') ;">
                        <div class="hero-small-background-overlay"></div>
                        <div class="container  h-100">
                            <div class="row align-items-center d-flex h-100">
                                <div class="col-md-12">
                                    <div class="block text-center">
                                        <span class="text-uppercase text-sm letter-spacing"></span>
                                        <h1 class="mb-3 mt-3 text-center">FAQ</h1>        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>                                                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </section>

        <section class="section-2  py-5">
            <div class="container py-2">
                <div class="row">

                    @if(!empty($faq))
                    @foreach($faq as $key => $faqRow)
                    <div class="col-md-12 py-4">
                        <div class="accordion" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-{{$key}}" aria-expanded="false" aria-controls="flush-{{$key}}">
                                      {{$faqRow->question}}
                                    </button>
                                </h2>
                                <div id="flush-{{$key}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">{!! $faqRow->answer !!}</div>
                                </div>
                            </div>

                          @endforeach
                          @endif  

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
                    <a href="#" class="btn btn-primary mt-3">Call Us Now <i class="fa-solid fa-angle-right"></i></a>
               </div>
            </div>
        </section>
 
 @include('common.latest-blog')

@endsection