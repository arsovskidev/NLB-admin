@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
@endsection
@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection

@section('title', 'NLB Open Finance')

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
                    <a href="/" class="nav_logo">
                        <i class="bx bx-layer nav_logo-icon"></i>
                        <span class="nav_logo-name">NLB Open Finance</span>
                    </a>
                    <div class="nav_list">
                        <a data-target="api-documentation" class="scroll-to-link nav_link active">
                            <i class="bx bx-code-alt nav_icon"></i>
                            <span class="nav_name">API Documentation</span>
                        </a>
                        <a data-target="stats" class="scroll-to-link nav_link">
                            <i class="bx bx-stats nav_icon"></i>
                            <span class="nav_name">Stats</span>
                        </a>
                    </div>
                </div>
                <a class="nav_link">
                    <i class="bx bx-cog nav_icon"></i>
                    <span class="nav_name">Admin</span>
                </a>
            </nav>
        </div>
        <div class="height-100 bg-light">
            <section class="content-section" id="api-documentation">
                <h1 class="fw-normal">API Documentation</h1>
                <h4 class="fw-light">
                    <div>Version: <span class="text-purple">1.0.0</span></div>
                    <div>API Status: <span class="text-green">UP</span></div>
        </div>
        </section>
        <section class="content-section" id="stats">
            <h1 class="fw-normal">Stats</h1>
        </section>
        </div>
    </body>
@endsection
