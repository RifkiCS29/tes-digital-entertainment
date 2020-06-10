@extends('layouts.admin')

@section('title')
    <title>Edit Video</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Video</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Edit Video</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- TAMBAHKAN ENCTYPE="" KETIKA MENGIRIMKAN FILE PADA FORM -->
            <form action="{{ route('videos.update', $video->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Video</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Nama Video</label>
                                    <input type="text" name="title" class="form-control" value="{{ $video->title }}" required>
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" class="form-control">{{ $video->description }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="file">Video</label>
                                    <br>
                                        <iframe class="embed-responsive-item" src="{{ asset('storage/uploads/' . $video->file) }}" allowfullscreen></iframe>
                                    <hr>
                                    <input type="file" name="file" class="form-control">
                                    <p><strong>Biarkan kosong jika tidak ingin mengganti Video</strong></p>
                                    <p class="text-danger">{{ $errors->first('file') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary float-right">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('js')
    <!-- LOAD CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection