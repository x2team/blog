@extends('layouts.backend.main')

@section('title', 'My Categories | Edit Account')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Account
                    <small>Edit account</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Account</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @include('backend.shared._message')
            {{ Form::model($user, [
                'method' => 'PUT',
                'route' => ['account.edit'],
                'id' => 'user-form',
                'style' => 'width: 100%',
            ]) }}

            @include('backend.user._form', ['hideRoleDropdown' => true])

            {{ Form::close() }}
            
        </div>
    </div>
</section>

@endsection

@include('backend.user._script')

