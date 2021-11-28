@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('cdn/widget-style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alfg/ping.js@0.2.2/dist/ping.min.js" type="text/javascript"></script>
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
                        <a data-target="widget" class="scroll-to-link nav_link">
                            <i class="bx bxs-widget nav_icon"></i>
                            <span class="nav_name">Widget</span>
                        </a>
                        <a data-target="statistics" class="scroll-to-link nav_link">
                            <i class="bx bx-stats nav_icon"></i>
                            <span class="nav_name">Stats</span>
                        </a>
                    </div>
                </div>
                <a href="{{ route('user.index') }}" class="nav_link">
                    <i class="bx bx-log-in nav_icon"></i>
                    <span class="nav_name">Dashboard</span>
                </a>
            </nav>
        </div>
        <div>
            <section class="content-section" id="api-documentation">
                <div class="container-fluid">
                    <h1 class="fw-normal">API Documentation</h1>
                    <h4 class="fw-light">
                        <div>Version: <span class="text-purple">{{ env('APP_VERSION') }}</span></div>
                        <div id="api-status"></div>
                    </h4>
                    <div class="mt-5">
                        <h1 class="fw-normal fs-3">GET</h1>
                        <hr class="mb-0" style="height: 2px;">
                        <div class="container">
                            <div class="row py-3">
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
                            <hr class="m-0">
                        </div>
                    </div>
                    <div class="mt-5">
                        <h1 class="fw-normal fs-3">POST - <span class="text-danger">Auth Required!</span></h1>
                        <hr class="mb-0" style="height: 2px;">
                        <div class="container">
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <div class="fw-light">
                                        <pre><code class="language-plaintext" style="color: #2a027e;">Validate Widget Key</code></pre>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="fw-light">
                                        <pre><code class="language-bash text-dark">https://api.nlb.astennu.com/api/v1/widget/validate</code></pre>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fw-light">
                                        <pre><code class="language-bash" style="color: white; background: #2a027e;">curl --request POST --url https://api.nlb.astennu.com/api/v1/widget/validate --header 'Accept: application/json' --header 'X-Authorization: WIDGET_KEY'</code></pre>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                        </div>
                    </div>
                </div>
            </section>
            <section class="content-section my-5" id="widget">
                <div class="container-fluid">
                    <h1 class="fw-normal">Widget</h1>
                    <div class="mt-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <div class="card">
                                        <div id="widget-open-finance" style="height: 900px"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <div class="card">
                                        <img src="{{ asset('images/widget-screenshot.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <section class="content-section my-5" id="statistics">
                <div class="container-fluid">
                    <h1 class="fw-normal">Statistics</h1>
                    <div class="mt-5">
                        <h1 class="fw-normal fs-3">Banks</h1>
                        <hr style="height: 2px;">
                        <div class="container">
                            <div class="row">
                                @foreach ($banks as $bank)
                                    <div class="col-md-3 mt-4">
                                        <div class="card text-center">
                                            <img style="width: 200px; height: 80px;" class="mx-auto"
                                                src="{{ $bank->bankImage() }}" alt="{{ $bank->bankName() }}" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </section>
        </div>
        <script>
            $.ajax({
                url: "/api/v1/status",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#api-status").html(res.data.message + ` [${res.data.ping}ms]`)
                    $("#api-status").addClass("text-" + res.data.color)
                }
            });
        </script>
        <script>
            let nlb_widget_key = "{{ env('WIDGET_TEST_KEY', false) }}";
        </script>
        <script src="{{ asset('cdn/widget.js') }}"></script>
    </body>
@endsection
