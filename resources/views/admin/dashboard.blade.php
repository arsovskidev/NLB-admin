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
                    <div class="nav_list">
                        <a data-target="users" class="scroll-to-link nav_link">
                            <i class="bx bx-user nav_icon"></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a data-target="banks" class="scroll-to-link nav_link">
                            <i class="bx bxs-bank nav_icon"></i>
                            <span class="nav_name">Banks</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div>
            <section class="content-section my-5" id="users">
                <div class="container-fluid">
                    <h1 class="fw-normal">Users</h1>
                    <div class="container">
                        <div class="mt-5">
                            <table class="table table-sm table-hover table-bordered">
                                <thead class="table-purple">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Surname</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th>{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {!! $users->links() !!}
                            </div>
                        </div>
                    </div>
            </section>
            <section class="content-section my-5" id="banks">
                <div class="container-fluid">
                    <h1 class="fw-normal">Banks</h1>
                    <div class="container">
                        <div class="mt-5">

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
