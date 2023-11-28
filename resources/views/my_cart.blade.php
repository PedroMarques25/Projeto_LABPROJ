@extends(('layouts.app_profile'))

@section('title', Session::get('user_name'))

<div class="row" style="margin-top: 10%">
    <div class="col-md-6">
        @include('sections.my_cart_page')
    </div>
    <div class="col-md-6" style="margin-top: 4%">
        @if(Session::has('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ Session::get('error') }}
            </div>
        @elseif(Session::has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>
</div>

