@extends('layouts.app_profile')

@section('title', Session::get('user_name'))
@section('user_name', Session::get('user_name'))

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" style="margin-top: 5%">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('sections.add_new_attraction_page')
@endsection
