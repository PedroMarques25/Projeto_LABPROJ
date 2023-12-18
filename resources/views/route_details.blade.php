@extends(('layouts.app_profile'))

@section('title', Session::get('user_name'))

@section('content')
    <div style="margin-top: 10%">
        @include('sections.route_details_page')
    </div>
@endsection
