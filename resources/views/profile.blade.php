@extends(('layouts.app_profile'))

@section('title', userName())
@section('user_name', userName())
@section('user_bio', userBio())
@section('user_city', userCity())

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success" style="margin-top: 7%">
            {{ Session::get('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('includes.profile_page_user_and_guide')
    @if(isGuide())
        @include('sections.profile_page_guide')
    @else
        @include('sections.profile_page')
    @endif
    @if(isAdmin())
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Go to Admin Page</a>
    @endif
    @include('includes.countries_where_we_are')
@endsection
