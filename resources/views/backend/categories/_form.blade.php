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
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ $category->exists ? 'Update' : 'Save'}}</button>
            <a href="{{ route('backend.categories.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>

