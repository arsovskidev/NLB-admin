@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}" />
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
                    <h1 class="fw-normal">Admin Login</h1>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card my-5">
                                <form action="{{ route('admin.login') }}" method="POST" class="card-form">
                                    @csrf
                                    <div class="input">
                                        <input type="text" id="email" name="email" class="input-field" required />
                                        <label class="input-label">Email</label>
                                        {!! $errors->first('email', '<p class="help-block text-red">:message</p>') !!}
                                    </div>
                                    <div class="input">
                                        <input type="password" id="password" name="password" class="input-field"
                                            required />
                                        <label class="input-label">Password</label>
                                        {!! $errors->first('password', '<p class="help-block text-red">:message</p>') !!}
                                    </div>
                                    <div class="action">
                                        <button class="action-button py-2">Log In</button>
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
