@extends('layouts.app')

@section('content')
    <section class="hero-small">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('{{ asset('assets/images/banner1.jpg') }}') ;">
                    <div class="hero-small-background-overlay"></div>
                    <div class="container  h-100">
                        <div class="row align-items-center d-flex h-100">
                            <div class="col-md-12">
                                <div class="block">
                                    <span class="text-uppercase text-sm letter-spacing"></span>
                                    <h1 class="mb-3 mt-3 text-center">{{ $details->name }}</h1>
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
                <div class="col-md-12 text-center">
                    <div class="image-red-background">
                        <img src="{{ asset('./uploads/blog/thumb/small/' . $details->image) }}" alt=""
                            class="w-100">
                    </div>
                </div>
                <div class="col-md-12 align-items-center d-flex mt-4">
                    <div class="about-block">
                        <h1 class="title-color mb-3">{{ $details->name }}</h1>
                        <p>{!! $details->description !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <h3>Comments</h3>
                @if (Session::get('type'))
                    <div class="alert alert-{{ Session::get('type') }}">
                        <strong>{{ Session::get('message') }}</strong>
                    </div>
                @endif
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-dark" style="font-weight: 800">
                                Fill Below Form
                            </div>
                            <div class="card-body">
                                <form action="{{ route('comment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $details->id }}">
                                    <div class="form-group">
                                        <label for="" class="text-dark"><b>Full Name</b></label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        @error('name')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="" class="text-dark"><b>Comment</b></label>
                                        <textarea name="comment" id="" cols="30" rows="10" class="form-control"></textarea>
                                        @error('comment')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3 text-center">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-3">
                        @if (count($comments) > 0)
                            @foreach ($comments as $comment)
                                <div class="card mb-3">
                                    <div class="card-header text-dark" style="font-weight: 800">
                                        {{ $comment->name }} <div style="float: right;">{{ $comment->created_at }}</div>
                                    </div>
                                    <div class="card-body text-dark" style="text-align: justify; font-weight: 400">
                                        <p>{{ $comment->comment }}</p>
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
                <p class="card-text mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi ipsum, odit
                    velit exercitationem praesentium error id iusto dolorem expedita nostrum eius atque? Aliquam ab
                    reprehenderit animi sapiente quasi, voluptate dolorum?</p>
                <a href="#" class="btn btn-primary mt-3">Call Us Now <i class="fa-solid fa-angle-right"></i></a>
            </div>
        </div>
    </section>

    <section class="section-3 py-5">
        <div class="container">
            <div class="divider mb-3"></div>
            <h2 class="title-color mb-4 h1">Blog & News</h2>
            <div class="cards">
                <div class="services-slider">
                    <div class="card border-0 ">
                        <img src="{{ asset('assets/images/logo-design.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body p-3">
                            <h1 class="card-title mt-2"><a href="#">Logo Design</a></h1>
                            <div class="content pt-2">
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                                    ipsum, odit velit exercitationem praesentium error id iusto dolorem expedita nostrum
                                    eius atque? Aliquam ab reprehenderit animi sapiente quasi, voluptate dolorum?</p>
                            </div>
                            <a href="#" class="btn btn-primary mt-4">Details <i
                                    class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="card border-0">
                        <img src="{{ asset('assets/images/digital-marketing.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body p-3">
                            <h1 class="card-title mt-2"><a href="#">Digital Marketing</a></h1>
                            <div class="content pt-2">
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                                    ipsum, odit velit exercitationem praesentium error id iusto dolorem expedita nostrum
                                    eius atque? Aliquam ab reprehenderit animi sapiente quasi, voluptate dolorum?</p>
                            </div>
                            <a href="#" class="btn btn-primary mt-4">Details <i
                                    class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="card border-0">
                        <img src="{{ asset('assets/images/t-shirt-design.jpg') }}" class="card-img-top" alt="">
                        <div class="card-body p-3">
                            <h1 class="card-title mt-2"><a href="#">T-shirt Design</a></h1>
                            <div class="content pt-2">
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                                    ipsum, odit velit exercitationem praesentium error id iusto dolorem expedita nostrum
                                    eius atque? Aliquam ab reprehenderit animi sapiente quasi, voluptate dolorum?</p>
                            </div>
                            <a href="#" class="btn btn-primary mt-4">Details <i
                                    class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>

                    <div class="card border-0">
                        <img src="{{ asset('assets/images/book-cover-design.jpg') }}" class="card-img-top"
                            alt="">
                        <div class="card-body p-3">
                            <h1 class="card-title mt-2"><a href="#">Book Cover Design</a></h1>
                            <div class="content pt-2">
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
                                    ipsum, odit velit exercitationem praesentium error id iusto dolorem expedita nostrum
                                    eius atque? Aliquam ab reprehenderit animi sapiente quasi, voluptate dolorum?</p>
                            </div>
                            <a href="#" class="btn btn-primary mt-4">Details <i
                                    class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
