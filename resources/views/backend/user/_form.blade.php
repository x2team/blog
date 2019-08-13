<div class="col-9">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Add new</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                {{ Form::label('name') }}
                {{ Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '')]) }}
                @error('name')
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                @enderror
            </div>

            {{-- <div class="form-group">
                {{ Form::label('slug') }}
                {{ Form::text('slug', null, ['class' => 'form-control ' . ($errors->has('slug') ? 'is-invalid' : '')]) }}
                @error('slug')
                <span class="invalid-feedback">{{ $errors->first('slug') }}</span>
                @enderror
            </div> --}}

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" id="slug" name="slug" placeholder="Enter slug">
                @error('slug')
                    <span class="invalid-feedback">{{ $errors->first('slug') }}</span>
                @enderror
            </div>

            <div class="form-group">
                {{ Form::label('email') }}
                {{ Form::text('email', null, ['class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : '')]) }}
                @error('email')
                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                @enderror
            </div>
            <div class="form-group">
                {{ Form::label('password') }}
                {{ Form::password('password', ['class' => 'form-control ' . ($errors->has('password') ? 'is-invalid' : '')]) }}
                @error('password')
                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                @enderror
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control ' . ($errors->has('password_confirmation') ? 'is-invalid' : '')]) }}
                @error('password_confirmation')
                <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                @enderror
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ $user->exists ? 'Update' : 'Save'}}</button>
            <a href="{{ route('backend.categories.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

