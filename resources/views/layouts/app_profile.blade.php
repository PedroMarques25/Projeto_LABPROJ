<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('purchase_style.css')}}" rel="stylesheet" />
    <link href="{{asset('profile_style.css')}}" rel="stylesheet" />
    <link href="{{asset('my_css.css')}}" rel="stylesheet" />
    <link rel="icon" href="{{asset('heart.png')}}" type="image/x-icon">

    <title>This is my City | @yield('title', 'Default Title')</title>
</head>
@include('includes.profile_header')
<main class="container mt-4">
    @yield('content', '')
</main>
<!-- Footer-->
@include('includes.footer')
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
</html>
