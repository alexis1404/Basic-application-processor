@extends('main_layout')

@section('header')
    <div class="header">
        <div class="container">
            <h1 align="center" class="main-text"> Test application</h1>
        </div>
    </div>
@endsection

@section('menu')
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">Home</a>
            <a class="navbar-brand" href="{{route('registerPage')}}">Register page</a>
            <a class="navbar-brand" href="{{route('loginPage')}}">Login page</a>
            @if(Auth::check())
            <a class="navbar-brand" href="{{route('logout')}}">Logout</a>
                <a class="navbar-brand" href="{{route('userPage')}}">Contact form</a>
            @endif
            @if(Auth::check() && Auth::user()->role->id == 2)
                <a class="navbar-brand" href="{{route('managerPage')}}">Manager room</a>
            @endif
        </div>
    </nav>
@endsection

@section('content')
    <div class="container">
        @yield('reg_form')
        @yield('login_form')
        @yield('manager_list')
        @yield('user_contact_form')
        @if (session('message'))
            <div class="alert alert-success" style="margin-top: 20%">
                {{ session('message') }}
            </div>
        @endif
    </div>
    @endsection
