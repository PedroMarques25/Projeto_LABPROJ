<body id="page-top" >
<!-- Header-->
<header class="masthead text-center text-white" style="margin-top: 6%">
    <div class="masthead-content" >
        <div class="container px-5">
            <div class="d-flex align-items-center justify-content-center mb-5">
                <div class="col-lg-3 order-lg-1">
                    <div class="p-5">
                        @if(empty(Auth::user()->image_path))
                            <img class="img-fluid rounded-circle" src="{{ asset('profile_default-removebg.png') }}" alt="Default Image" />
                        @else
                            <img class="rounded-circle custom-img" src="{{ Auth::user()->image_path }}" alt="User Image" />
                        @endif
                        <form action="{{ route('update-profile-image') }}" method="POST" enctype="multipart/form-data" class="edit-option position-relative top-50 start-50 translate-middle">
                            @csrf <!-- CSRF protection -->
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="profile_image" class="btn btn-primary btn-xs rounded-pill w-150">
                                        Upload
                                        <input type="file" id="profile_image" name="profile_image" style="display: none;">
                                    </label>
                                </div>
                                <div class="col-md-6 mt-md-0 mt-2">
                                    <button type="submit" class="btn btn-primary btn-xs rounded-pill w-100">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                        <ul class="list-unstyled mt-5 mb-0 custom-ul" >
                            <strong>About me:</strong> @yield('user_bio', 'Bio')<br>
                            <strong>City:</strong> @yield('user_city', 'City')
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 order-lg-2">
                    <h1 class="masthead-heading mb-0" id="hello">Hello, @yield('user_name', 'User')</h1>
                    <h2 class="masthead-subheading mb-0" id="where_to_go">Where to go?</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="{{route('search.routes')}}">Search</a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
</header>
