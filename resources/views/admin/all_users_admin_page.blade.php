@extends('layouts.app_admin')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('admin.side_bar_page')
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <h1 style="margin-top: 2%; margin-left: 3%">All guides registered</h1>
                <div class="row" style="margin-left: 2%; margin-right: 2%">
                    @foreach($users as $user)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                @if(empty($user->image_path))
                                    <img class="card-img-top rounded-circle" src="{{ asset('profile_default-removebg.png') }}" alt="Default Image">
                                @else
                                    <img class="card-img-top rounded-circle" src="{{ $user->image_path }}" alt="User Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="card-text">Bio: {{ $user->bio }}</p>
                                    <p class="card-text">Email: {{ $user->email }}</p>
                                    <p class="card-text">Join date: {{ $user->created_at }}</p>
                                    @if($user->hasGuide)
                                        <p><i class="fas fa-check-circle"></i> Guide</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@section('title')
    All users
@endsection



