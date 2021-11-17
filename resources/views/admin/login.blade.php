@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
@endsection
@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection

@section('title', 'NLB Admin')

@section('body')

    <body id="body-base">
        <header class="header" id="header">
            <div class="header_toggle">
                <i class="bx bx-menu" id="header-toggle"></i>
            </div>
            <img src="{{ asset('images/nlb.png') }}" alt="NLB" height="32" />
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="{{ route('home.index') }}" class="nav_link ">
                        <i class="bx bx-arrow-back nav_icon"></i>
                        <span class="nav_name">Back</span>
                    </a>
                </div>
            </nav>
        </div>
        <div>
            <section class="content-section">
                <div class="container-fluid">
                    <h1 class="fw-normal">Login</h1>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card my-5">
                                <div class="card-body">
                                    <form action="">
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-italic" for="email">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter your email address">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="mb-2" for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter your password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-purple w-50">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        </div>
    </body>
@endsection
