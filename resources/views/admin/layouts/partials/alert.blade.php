@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show custom-alert-icon shadow-sm" role="alert">
        <svg class="svg-success" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem"
            fill="#000000">
            <path d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
            </path>
        </svg>
        {{ Str::title(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show custom-alert-icon shadow-sm" role="alert">
        <svg class="svg-warning" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem"
            fill="#000000">
            <path d="M0 0h24v24H0z" fill="none"></path>
            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"></path>
        </svg>
        {{ Str::title(session('warning')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm" role="alert">
        <svg class="svg-danger" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem"
            fill="#000000">
            <path d="M0 0h24v24H0z" fill="none"></path>
            <path
                d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM12 17.3c-.72 0-1.3-.58-1.3-1.3 0-.72.58-1.3 1.3-1.3.72 0 1.3.58 1.3 1.3 0 .72-.58 1.3-1.3 1.3zm1-4.3h-2V7h2v6z">
            </path>
        </svg>
        {{ Str::title(session('error')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif
