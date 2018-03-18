@extends('custom_pages.home')

@section('login_form')

    <h1 align="center" class="custom_forms">Please, enter your email and password</h1>
    <hr>
    @include('errors.errors')
    <form action="{{route('loginForm')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
        </div>
        <button type="submit" id="auth_submit" class="btn btn-primary">Login</button>
    </form>

    @if (session('message'))
        <div class="alert alert-danger" style="margin-top: 20%">
            {{ session('message') }}
        </div>
    @endif

    @endsection