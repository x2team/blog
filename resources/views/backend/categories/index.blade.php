@extends('layouts.backend.main')

@section('title', 'My Blog | Categories Index')



@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Categories
                    <small>Display all categories</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active">All Categories</li>
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
                        <a href="{{ route('backend.categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                    </div>

                    <div class="float-right" style="padding: 7px 0;">                            
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @include('backend.shared._message')

                    @include('backend.categories._table')
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script type="text/javascript">
        $("#category").DataTable({
            "lengthMenu": [10, 25, 50, "All"],
            // "order": [[ 4, "desc" ]],
        });
    </script>
@endsection