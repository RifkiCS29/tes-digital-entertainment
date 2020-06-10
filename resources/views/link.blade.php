@extends('layouts.app')
@section('content')
 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Shorten</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 style="text-align: center; margin: 40px; ">Shorten Url</h1>
            @if ($errors->any())
                <div class="alert alert-danger col-6">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <div class="row text-center">
                <div class="col-xl-12">
                    <form method="post" action="{{ route('shorten') }}" >
                        @csrf
                        <div class="form-group" >
                            <input type="url" class="form-control" placeholder="Enter your url" name="original_link">
                        </div>
                        <div class="form-group" >
                            <input type="submit" value="Generate" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if (session('short_link'))
                    <div class="col-xl-12">
                        <div class="alert alert-success">
                            <a href="{{ session('short_link') }}" target="_blank">{{ session('short_link') }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </body>

</html>

@endsection