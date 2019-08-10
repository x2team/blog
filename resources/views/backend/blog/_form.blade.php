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
                
                

            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Published</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('published_at', 'Publish Date:') }}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        {{ Form::text('published_at', null, ['class' => 'form-control ' . ($errors->has('published_at') ? 'is-invalid' : ''), 'placeholder' => 'Y-m-d H:i:s']) }}
                        @error('published_at')
                            <span class="invalid-feedback">{{ $errors->first('published_at') }}</span>
                        @enderror
                    </div>
                    
                </div>
            </div>
            <div class="card-footer">
                <div class="float-left">
                    <a href="#" id="draft-btn" class="btn btn-outline-secondary">Save draft</a>
                </div>
                <div class="float-right">
                    {!! Form::submit('Create new post', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>

        <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::select('category_id', App\Category::pluck('title', 'id'), null, ['class' => 'form-control ' . ($errors->has('category_id') ? 'is-invalid' : '')]) }}
                        @error('category_id')
                        <span class="invalid-feedback">{{ $errors->first('category_id') }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Feature Image</h3>
            </div>
            <div class="card-body text-center">
                <div class="form-group">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                            <img src="{{ ($post->image_thumb_url) ? $post->image_thumb_url : 'https://place-hold.it/200x150?text=No+Image' }}" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;">
                        </div>
                        <div>
                            <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span
                                    class="fileinput-exists">Change</span>
                                {{ Form::file('image', ['class' => 'form-control ' . ($errors->has('image') ? 'is-invalid' : '')]) }}
                            </span>
                            <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    @error('image')
                    <span class="invalid-feedback">{{ $errors->first('image') }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>