@extends('layouts.backend.main')

@section('title', 'My Blog | Blog Index')



@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blog
                    <small>Display all post</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.blog.index') }}">Blog</a></li>
                    <li class="breadcrumb-item active">All Posts</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <a href="{{ route('backend.blog.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hi!</strong> {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table id="post" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="80">Action</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th width="170">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>
                                    <a href="{{ route('backend.blog.edit', $post->id) }}" class="btn btn-xs btn-default">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('backend.blog.destroy', $post->id) }}" class="btn btn-xs btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                </td>
                               
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->author->name }}</td>
                                <td>{{ $post->category->title}}</td>
                                <td>
                                    <abbr title="{{ $post->dateFormatted(true)}}">{{ $post->dateFormatted() }}</abbr>
                                    {!! $post->publicActionLabel() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
@endsection

{{-- @section('script')
    <script>
        $("footer.main-footer").addClass("pagination-sm");
    </script>
@endsection --}}