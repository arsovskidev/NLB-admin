@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
@endsection
@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection

@section('title', 'NLB Admin Dashboard')

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
                    <a href="{{ route('admin.logout') }}" class="nav_link ">
                        <i class="bx bx-log-out nav_icon"></i>
                        <span class="nav_name">Logout</span>
                    </a>
                </div>
            </nav>
        </div>
        <div>
            <section class="content-section">
                <div class="container-fluid">
                    <h1 class="fw-normal">Welcome Admin!</h1>
                </div>
            </section>
        </div>
    </body>
    @if (\Session::has('login_success'))
        <script>
            iziToast.success({
                message: '{{ \Session::get('login_success') }}'
            });
        </script>
    @endif
@endsection
