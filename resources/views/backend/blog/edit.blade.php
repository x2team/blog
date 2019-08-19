@extends('layouts.backend.main')

@section('title', 'My Blog | Edit post')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blog
                    <small>Edit post</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.blog.index') }}">Blog</a></li>
                    <li class="breadcrumb-item active">Edit Post</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
{{ Form::model($post, [
    'method' => 'PUT',
    'route' => ['backend.blog.update', $post->id],
    'files' => TRUE,
    'id' => 'post-form'
]) }}
<section class="content">
    <div class="container-fluid">
        <div class="row">

            @include('backend.blog._form', ['btnText' => 'Edit post'])
            
        </div>
    </div>
</section>
{{ Form::close() }}
@endsection

@include('backend.blog._script')

