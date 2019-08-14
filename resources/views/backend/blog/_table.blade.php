<table id="post" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="80">Action</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th width="170">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['backend.blog.destroy', $post->id]]) !!}
                @if(check_user_permissions(request(), 'Blog@edit', $post->id))
                    <a href="{{ route('backend.blog.edit', $post->id) }}" class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                @else
                    <a href="#" class="btn btn-xs btn-default disabled">
                        <i class="fa fa-edit"></i>
                    </a>
                @endif
                
                @if(check_user_permissions(request(), 'Blog@destroy', $post->id))
                    <button type="submit" class="btn btn-xs btn-warning">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                @else
                    <button type="button" onclick="return false;" class="btn btn-xs btn-warning disabled">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                @endif
                {!! Form::close() !!}
            </td>

            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title}}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true)}}">{{ $post->dateFormatted() }}</abbr>
                {!! $post->publicActionLabel() !!}
            </td>
        </tr>
        @endforeach
    </tbody>

</table>