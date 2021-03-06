@extends('layouts.backend.main')

@section('title', 'My Categories | Edit category')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User
                    <small>Edit user</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">User</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            {{ Form::model($user, [
                'method' => 'PUT',
                'route' => ['backend.user.update', $user->id],
                'files' => TRUE,
                'id' => 'user-form',
                'style' => 'width: 100%',
            ]) }}

            @include('backend.user._form')

            {{ Form::close() }}
            
        </div>
    </div>
</section>

@endsection

@include('backend.user._script')

