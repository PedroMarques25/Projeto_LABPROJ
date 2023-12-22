@extends('layouts.app_profile')

@section('title', Session::get('user_name'))
@section('user_name', Session::get('user_name'))

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" style="margin-top: 5%">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success" style="margin-top: 7%">
            {{ Session::get('success') }}
        </div>
    @endif
    @include('sections.edit_profile_page')
    @if(Auth::user()->isGuide())
        @include('sections.edit_profile_guide')
    @endif
@endsection
