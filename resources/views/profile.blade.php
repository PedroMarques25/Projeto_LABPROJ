@extends(('layouts.app_profile'))

@section('title', Session::get('user_name'))
@section('user_name', Session::get('user_name'))
@section('user_bio', Session::get('user_bio'))

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success" style="margin-top: 7%">
            {{ Session::get('success') }}
        </div>
    @endif
    @include('sections.profile_page')
@endsection
