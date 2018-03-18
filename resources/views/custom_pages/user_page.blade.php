@extends('custom_pages.home')

@section('user_contact_form')

    <h1 align="center" class="custom_forms">Send your application</h1>
    <hr>
    @include('errors.errors')
    <form action="{{route('userForm')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputName">Theme</label>
            <input type="text" class="form-control" id="inputName" name="theme"  placeholder="Theme your application" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputText">Text application</label>
            <textarea rows="7" class="form-control" id="inputText" name="message" placeholder="Text your application" required></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="attachment">
        </div>
        <button type="submit" id="auth_submit" class="btn btn-primary">Send</button>
    </form>

    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

@endsection