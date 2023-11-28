@extends('layouts.app')

@section('title', 'INDEX')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @include('sections.main_page')
    @include('sections.project_social_media')

@endsection
