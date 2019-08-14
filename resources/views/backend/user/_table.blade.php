<table id="user" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="80">Action</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php $currentUser = auth()->user(); ?>
        @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('backend.user.edit', $user->id) }}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @if($user->id == config('cms.default_user_id') || $user->id == $currentUser->id)
                    <button onclick="return false" type="submit" class="btn btn-xs btn-warning disabled">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                @else
                    <a href="{{ route('backend.user.confirm', $user->id) }}" class="btn btn-xs btn-warning">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                @endif
                
            </td>

            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roles->first()->display_name }}</td>
        </tr>
        @endforeach
    </tbody>

</table>

