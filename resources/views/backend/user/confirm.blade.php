@extends('layouts.backend.main')

@section('title', 'My Blog | Add New user')




@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users
                    <small>Delete Confirmation</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">User</a></li>
                    <li class="breadcrumb-item active">Delete Confirmation</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            {{ Form::model($user, [
                'method' => 'DELETE',
                'route' => ['backend.user.destroy', $user->id],
                'files' => TRUE,
                'id' => 'user-form',
                'style' => 'width: 100%'
            ]) }}
            
            <div class="col-9">
                <div class="card card-default">
                    <div class="card-header">
                        <p>You have specified this user for deletion</p>
                        <p>ID #{{ $user->id }} : {{ $user->name }}</p>
                        <p>What should be done with content own by this user?</p>
                        <p>
                            <input type="radio" name="delete_option" value="delete" checked>Delete all content
                        </p>
                        <p>
                            <input type="radio" name="delete_option" value="attribute">Attribute content to:
                            {!! Form::select('selected_user', $users, null) !!}
                        </p>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                        <a href="{{ route('backend.user.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
            
            {{ Form::close() }}
        </div>
    </div>
</section>
@endsection

@include('backend.user._script')
