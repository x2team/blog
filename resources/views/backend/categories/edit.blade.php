@extends('layouts.backend.main')

@section('title', 'My Categories | Edit category')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category
                    <small>Edit category</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.categories.index') }}">Category</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            {{ Form::model($category, [
                'method' => 'PUT',
                'route' => ['backend.categories.update', $category->id],
                'files' => TRUE,
                'id' => 'category-form',
                'style' => 'width: 100%',
            ]) }}

            @include('backend.categories._form')

            {{ Form::close() }}
            
        </div>
    </div>
</section>

@endsection

