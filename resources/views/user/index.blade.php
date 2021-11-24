@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
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
                    <div class="nav_list">
                        <a data-target="login" class="scroll-to-link nav_link active">
                            <i class="bx bx-log-in nav_icon"></i>
                            <span class="nav_name">Login</span>
                        </a>
                        <a data-target="register" class="scroll-to-link nav_link">
                            <i class="bx bx-user-plus nav_icon"></i>
                            <span class="nav_name">Register</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div>
            <section class="content-section" id="login">
                <div class="container-fluid">
                    <h1 class="fw-normal">Login</h1>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card my-5">
                                <form action="{{ route('user.login') }}" method="POST" class="card-form">
                                    @csrf
                                    <div class="input">
                                        <input type="text" id="login_email" name="login_email" class="input-field"
                                            required />
                                        <label class="input-label">Email</label>
                                    </div>
                                    {!! $errors->first('login_email', '<p class="help-block text-red">:message</p>') !!}
                                    <div class="input">
                                        <input type="password" id="login_password" name="login_password"
                                            class="input-field" required />
                                        <label class="input-label">Password</label>
                                    </div>
                                    {!! $errors->first('login_password', '<p class="help-block text-red">:message</p>') !!}
                                    <div class="action">
                                        <button class="action-button py-2">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content-section" id="register">
                <div class="container-fluid">
                    <h1 class="fw-normal">Register</h1>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card my-5">
                                <form action="{{ route('user.register') }}" method="POST" class="card-form">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="input">
                                                <input type="text" id="name" name="name" class="input-field" required />
                                                <label class="input-label">Name</label>
                                            </div>
                                            {!! $errors->first('name', '<p class="help-block text-red">:message</p>') !!}
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input">
                                                <input type="text" id="surname" name="surname" class="input-field"
                                                    required />
                                                <label class="input-label">Surname</label>
                                            </div>
                                            {!! $errors->first('surname', '<p class="help-block text-red">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="input mb-3">
                                        <input type="text" id="email" name="email" class="input-field" required />
                                        <label class="input-label">Email</label>
                                    </div>
                                    {!! $errors->first('email', '<p class="help-block text-red">:message</p>') !!}
                                    <div class="input">
                                        <input type="password" id="password" name="password" class="input-field"
                                            required />
                                        <label class="input-label">Password</label>
                                    </div>
                                    {!! $errors->first('password', '<p class="help-block text-red">:message</p>') !!}
                                    <div class="input">
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="input-field" required />
                                        <label class="input-label">Confirm Password</label>
                                    </div>
                                    {!! $errors->first('confirm_password', '<p class="help-block text-red">:message</p>') !!}
                                    @if (Session::has('invalid_password'))
                                        <p class="help-block text-red">{{ Session::get('invalid_password') }}</p>
                                    @endif
                                    <div class="action">
                                        <button class="action-button py-2">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
    @if (\Session::has('invalid_credentials'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ \Session::get('invalid_credentials') }}'
            });
        </script>
    @endif
@endsection
