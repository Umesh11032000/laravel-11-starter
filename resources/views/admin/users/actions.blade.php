<div class="hstack gap-2 fs-15">
    @if (auth()->user()->hasPermissionTo('create-update-user'))
        <a href="{{ route('admin.users.edit', $user->id) }}"
            class="btn btn-icon btn-sm btn-success-transparent rounded-pill">
            <i class="ri-edit-line"></i>
        </a>
    @endif
    @if (auth()->user()->hasPermissionTo('delete-user'))
        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"
            onclick="return confirm('Are you sure?') && $('#delete-user-form').attr('action', '{{ route('admin.users.destroy', $user->id) }}').submit()">
            <i class="ri-delete-bin-line"></i>

            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" id="delete-user-form">
                @csrf
                @method('DELETE')
            </form>
        </a>
    @endif

</div>
