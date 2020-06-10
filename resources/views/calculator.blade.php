@extends('layouts.app')
@section('content')
 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Calculator</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="container text-center">
            <h1>Calculator</h1>
            <br>
            <div class="col-md-12">
                <div class="row">
                    @if(session('info'))
                        <div class="alert alert-info col-md-12">
                            {{ session('info') }}
                        </div>
                    @endif
                </div>
                <form action="{{route('calculate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                <input type="number" class="form-control" name="first_number" placeholder="Enter number" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <select id="operator" name="operator" class="form-control" required>
                                        <option> </option>
                                        <option value="plus"> + </option>
                                        <option value="minus"> - </option>
                                        <option value="multiply"> * </option>
                                        <option value="divide"> / </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <input class="form-control" type="number" name="second_number" placeholder="Enter number" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Result</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="container">
            <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th><b>No.</b></th>
                    <th>First Number</th>
                    <th>Operator</th>
                    <th>Second Number</th>
                    <th>Result</th>
                </tr>
            </thead>
                @forelse ($results as $result) 
                    <tr>
                        <td><b>{{$result->id}}.<b></td>
                        <td>{{$result->first_number}}</td>
                        <td>{{$result->operator}}</td>
                        <td>{{$result->second_number}}</td>
                        <td>{{$result->result}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Data Not Found</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </body>
</html>

@endsection