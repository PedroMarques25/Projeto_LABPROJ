@extends(('layouts.app_profile'))

@section('title', Session::get('user_name'))
@section('user_name', Session::get('user_name'))
@section('user_bio', Session::get('user_bio'))
@section('user_city', Session::get('user_city'))

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

    @if(Auth::user()->isGuide())
            <?php \App\Models\Guide::rating(); ?>
        @include('sections.profile_page_guide')

    @else
        @include('sections.profile_page')
    @endif
    @include('includes.countries_where_we_are')
@endsection
