<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
    </style>
</head>
<body>
<h1>Invoice</h1>
<p>Date: {{ $date }}</p>
<p>Title: {{ $title }}</p>
<p>Title_: {{ $title_ }}</p>
<p>Hi, {{ $user_name }}</p>

<p>This is your invoice of your purchase of the following packages in our website</p>

<h2>Routes in Cart</h2>
@foreach ($routeDetails as $route)
    <div>
        <h3>{{ $route['name'] }}</h3>
        <p>About: {{ $route['about'] }}</p>
        <p>Total Price: {{ $route['total_price'] }}</p>
        <p>Duration: {{ $route['duration'] }}</p>
        <p>Attractions: {{ $route['attractions'] }}</p>
    </div>
@endforeach
</body>
</html>
