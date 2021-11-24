@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
    <script>
        hljs.highlightAll();
    </script>
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
                    <a href="{{ route('home.index') }}" class="nav_logo">
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
                <a href="{{ route('user.index') }}" class="nav_link">
                    <i class="bx bx-cog nav_icon"></i>
                    <span class="nav_name">Dashboard</span>
                </a>
            </nav>
        </div>
        <div>
            <section class="content-section" id="api-documentation">
                <div class="container-fluid">
                    <h1 class="fw-normal">API Documentation</h1>
                    <h4 class="fw-light">
                        <div>Version: <span class="text-purple">1.0.9</span></div>
                        <div>API Status: <span class="text-green">UP</span></div>
                    </h4>

                    <div class="mt-5">
                        <h1 class="fw-normal fs-3">GET</h1>
                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="fw-light">
                                        <pre><code class="language-plaintext" style="color: #2a027e;">Check API Status</code></pre>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="fw-light">
                                        <pre><code class="language-bash text-dark">https://api.nlb.astennu.com/api/v1/status</code></pre>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fw-light">
                                        <pre><code class="language-bash" style="color: white; background: #2a027e;">curl --request GET --url https://api.nlb.astennu.com/api/v1/status --header 'Accept: application/json'</code></pre>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content-section" id="stats">
                <div class="container-fluid">
                    <h1 class="fw-normal">Stats</h1>
                </div>
            </section>
        </div>
    </body>
@endsection
