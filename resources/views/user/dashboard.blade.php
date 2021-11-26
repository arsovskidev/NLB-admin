@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}" />
@endsection
@section('js')
    <script src="{{ asset('js/script.js') }}"></script>
@endsection

@section('title', 'NLB Dashboard')

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
                    <a href="{{ route('user.logout') }}" class="nav_link ">
                        <i class="bx bx-log-out nav_icon"></i>
                        <span class="nav_name">Logout</span>
                    </a>
                    <div class="nav_list">
                        <a data-target="statistics" class="scroll-to-link nav_link">
                            <i class="bx bx-stats nav_icon"></i>
                            <span class="nav_name">Statistics</span>
                        </a>
                        <a data-target="tokens" class="scroll-to-link nav_link">
                            <i class="bx bxs-key nav_icon"></i>
                            <span class="nav_name">Tokens</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div>
            <section class="content-section" id="statistics">
                <div class="container-fluid">
                    <h1 class="fw-normal">Welcome {{ Auth::user()->name }}!</h1>
                    <h5 class="fw-normal">How are you today?</h5>
                </div>
            </section>
            <section class="content-section my-5" id="tokens">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="fw-normal">API Tokens</h1>
                            <div class="mt-5">
                                <ul>
                                    @foreach (Auth::user()->widget_tokens as $widget_token)
                                        <li>
                                            <pre><code class="fw-light fs-5 text-break" style="color: #2a027e;">{{ $widget_token->access_token }}</code></pre>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h1 class="fw-normal">Widget Tokens</h1>
                            <div class="mt-5">
                                <ul>
                                    @foreach (Auth::user()->widget_tokens as $widget_token)
                                        <li>
                                            <pre><code class="fw-light fs-5 text-break" style="color: #2a027e;">{{ $widget_token->access_token }}</code></pre>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

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
