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
                    <div class="float-left">
                        <a href="{{ route('backend.blog.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                    </div>

                    <div class="float-right" style="padding: 7px 0;">
                        @foreach($statusList as $key => $value)
                            @if($value)
                                <?php $selected = Request::get('status') == $key ? 'selected-status' : '' ?>
                                <?php $links[] = "<a class='{$selected}' href='?status={$key}'>" . ucwords($key) . "({$value})<a/>" ?>
                            @endif
                        @endforeach
                        
                        {!! implode(' | ', $links) !!}            

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @include('backend.shared._message')

                    @if($onlyTrashed) 
                        @include('backend.blog._table-trash')
                    @else
                        @include('backend.blog._table')
                    @endif
                    

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
@endsection

@include('backend.blog._script')