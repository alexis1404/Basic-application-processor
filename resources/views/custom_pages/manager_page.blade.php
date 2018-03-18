@extends('custom_pages.home')

@section('manager_list')

    @foreach($all_applications as $application)
        <div class="card custom-card" style="width: 22rem;margin-top: 5%;float: left;margin-left: 20px;margin-bottom: 20px;">
            <div class="card-body">
                <h5 class="card-title">{{$application->theme}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">ID application: <b>{{$application->id}}</b></h6>
                <p class="card-text">Theme: <b>{{$application->theme}}</b></p>
                <p class="card-text">Application text: <b>{{$application->message}}</b></p>
                <p class="card-text">Send by: <b>{{$application->user->name}}</b></p>
                <p class="card-text">User email: <b>{{$application->user->email}}</b></p>
                <p class="card-text">Created at: <b>{{$application->created_at}}</b></p>
                @if($application->attachment)
                <a href="{{asset('storage/' . $application->attachment)}}" class="btn btn-primary">Attachment</a>
                    @endif
            </div>
        </div>
    @endforeach

    {{$all_applications->links()}}

 @endsection


