@extends('layouts.backend.main')

@section('title', 'My Blog | Add New post')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blog
                    <small>Add new post</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.blog.index') }}">Blog</a></li>
                    <li class="breadcrumb-item active">Add new</li>
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
                        
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    {{ Form::model($post, [
                        'method' => 'POST',
                        'route' => 'backend.blog.store',
                        'files' => TRUE,
                    ]) }}

                        
                    
                    <div class="form-group">
                        {{ Form::label('title') }}
                        {{ Form::text('title', null, ['class' => 'form-control ' . ($errors->has('title') ? 'is-invalid' : '')]) }}
                        @error('title')
                            <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('slug') }}
                        {{ Form::text('slug', null, ['class' => 'form-control ' . ($errors->has('slug') ? 'is-invalid' : '')]) }}
                        @error('title')
                            <span class="invalid-feedback">{{ $errors->first('slug') }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('excerpt') }}
                        {{ Form::textarea('excerpt', null, ['class' => 'form-control ' . ($errors->has('excerpt') ? 'is-invalid' : '')]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('body') }}
                        {{ Form::textarea('body', null, ['class' => 'form-control ' . ($errors->has('body') ? 'is-invalid' : '')]) }}
                        @error('body')
                            <span class="invalid-feedback">{{ $errors->first('body') }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('published_at', 'Publish Date') }}
                        {{ Form::text('published_at', null, ['class' => 'form-control ' . ($errors->has('published_at') ? 'is-invalid' : ''), 'placeholder' => 'Y-m-d H:i:s']) }}
                        @error('published_at')
                            <span class="invalid-feedback">{{ $errors->first('published_at') }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('category_id', 'Category') }}
                        {{ Form::select('category_id', App\Category::pluck('title', 'id'), null, ['class' => 'form-control ' . ($errors->has('category_id') ? 'is-invalid' : '')]) }}
                        @error('category_id')
                            <span class="invalid-feedback">{{ $errors->first('category_id') }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                            {{ Form::label('image', 'Feature Image') }}
                            {{ Form::file('image', ['class' => 'form-control ' . ($errors->has('image') ? 'is-invalid' : '')]) }}
                            @error('image')
                                <span class="invalid-feedback">{{ $errors->first('image') }}</span>
                            @enderror
                        </div>
                    
                    {!! Form::submit('Create new post', ['class' => 'btn btn-primary']) !!}

                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Multiple</label>
                            <select class="select2" multiple 
                                    data-placeholder="Select a State" style="width: 100%;">
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div> --}}
                    

                    {{ Form::close() }}

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