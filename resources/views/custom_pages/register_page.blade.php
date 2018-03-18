@extends('custom_pages.home')

@section('reg_form')

    <h1 align="center" class="custom_forms">Please, register now</h1>
    <hr>
    @include('errors.errors')
    <form action="{{route('regForm')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter name" required>
            <small class="form-text text-muted">Input your name:</small>
        </div>
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter email" required>
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary" id="reg_submit">Register</button>
    </form>

    @endsection