<table id="category" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="80">Action</th>
            <th>Category Name</th>
            <th>Post Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['backend.categories.destroy', $category->id]]) !!}
                    <a href="{{ route('backend.categories.edit', $category->id) }}" class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if($category->id == config('cms.default_category_id'))
                        <button onclick="return false" type="submit" class="btn btn-xs btn-warning disabled">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    @else
                        <button onclick="return confirm('Are you sure?');" type="submit" class="btn btn-xs btn-warning">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    @endif
                {!! Form::close() !!}
            </td>

            <td>{{ $category->title }}</td>
            <td>{{ $category->posts->count() }}</td>
        </tr>
        @endforeach
    </tbody>

</table>

