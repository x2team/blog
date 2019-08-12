@extends('layouts.backend.main')

@section('title', 'My Blog | Add New post')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories
                    <small>Add new category</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.categories.index') }}">Category</a></li>
                    <li class="breadcrumb-item active">Add new</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            {{ Form::model($category, [
                'method' => 'POST',
                'route' => 'backend.categories.store',
                'files' => TRUE,
                'id' => 'category-form',
                'style' => 'width: 100%'
            ]) }}
            
            @include('backend.categories._form')
            
            {{ Form::close() }}
        </div>
    </div>
</section>
@endsection

@include('backend.categories._script')
