<div class="col-md-3 col-xs-12 col-sm-12">
    <div class="card custom-card hrm-main-card {{ $bgColor }}">
        <div class="card-body">
            <div class="d-flex align-items-top">
                <div class="me-3">
                    <span class="avatar bg-{{ $bgColor }}">
                        <i class="{{ $icon }} fs-18"></i>
                    </span>
                </div>
                <div class="flex-fill">
                    <span class="fw-semibold text-muted d-block mb-2">
                        {{ $title }}
                    </span>
                    <h5 class="fw-semibold mb-2">
                        {{ $value }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
