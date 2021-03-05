<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Page not found | 404</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
<div style="height: 100vh;">
    <div class="content h-100 pt-5 px-5 pb-0">
        <div class="jumbotron jumbotron-fluid h-100 bg-light shadow-lg">
            <div class="container">
                <h1 class="display-4">Page not found | 404</h1>
                <hr>
                <p class="lead">Oops! It seems like you reached the wrong place.</p>
                <a href="{{url('/')}}" class="btn btn-lg btn-block btn-primary mt-5">Go back to home</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

