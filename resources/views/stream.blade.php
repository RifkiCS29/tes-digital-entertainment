@extends('layouts.app')
@section('content')
 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Streaming</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 style="text-align: center; margin: 40px; ">Streaming</h1>
            <div class="row">
                <div class="col-xl-12">
                    <form action="{{ route('stream.index') }}" method="get">
                        <div class="input-group mb-3 col-md-3 float-right">
                            <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">Cari</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Play</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($video as $row)
                                <tr>
                                    <td>
                                        {{ $row->title }}
                                    </td>
                                    <td>
                                        {!! $row->description !!}
                                    </td>
                                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                    
                                    <td>
                                        <strong><a href="{{ url('/stream/'. $row->slug) }}">Play</a></strong>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {!! $video->links() !!}
                </div>
            </div>

        </div>
    </body>

</html>

@endsection