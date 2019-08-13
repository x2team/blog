{{-- <!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Authorization Error</title>
</head>
<body>
 <h1>You cannot delete default category!</h1>
 <a href="javascript:window.history.back();">Go back</a>
    
</body>
</html> --}}

@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 page-not-found">
                <h2> 404 Page Not Found</h2>
                <p>
                    Sorry, the page you're looking for couldn't be found
                </p>

                @include('backend.shared._message')
            </div>
        </div>
    </div>

@endsection