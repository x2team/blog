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
                {!! Form::open(['style' => 'display: inline-block;', 'method' => 'PUT', 'route' => ['backend.blog.restore', $post->id]]) !!}
                    <button title="Restore" class="btn btn-xs btn-default">
                        <i class="fas fa-undo-alt"></i>
                    </button>
                {!! Form::close() !!}

                {!! Form::open(['style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => ['backend.blog.force-destroy', $post->id]]) !!}
                    <button onclick="return confirm('Are you sure?')" title="Delete Permanent" type="submit" class="btn btn-xs btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                {!! Form::close() !!}
            </td>

            <td>{{ $post->title }}</td>
            <td>{{ $post->author->name }}</td>
            <td>{{ $post->category->title}}</td>
            <td>
                <abbr title="{{ $post->dateFormatted(true)}}">{{ $post->dateFormatted() }}</abbr>
                
            </td>
        </tr>
        @endforeach
    </tbody>

</table>