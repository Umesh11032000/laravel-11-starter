<div class="hstack gap-2 fs-15">
    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-icon btn-sm btn-success-transparent rounded-pill">
        <i class="ri-edit-line"></i>
    </a>
    <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"
        onclick="return confirm('Are you sure?') && $('#delete-user-form').attr('action', '{{ route('admin.roles.destroy', $role->id) }}').submit()">
        <i class="ri-delete-bin-line"></i>

        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" id="delete-user-form">
            @csrf
            @method('DELETE')
        </form>
    </a>

</div>
