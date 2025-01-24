<script type="module">
    $('#create-user-form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            middle_name: {
                minlength: 3,
                maxlength: 50
            },
            last_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            email: {
                required: true,
                email: true,
                minlength: 3,
                maxlength: 50,
                remote: {
                    url: "{{ route('admin.users.check-email') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: function() {
                            return $('#email').val();
                        },
                        id: function() {
                            return $('#id').val();
                        }
                    }
                }
            },
            mobile_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            gender: {
                required: true
            },
            role_id: {
                required: true
            },
            date_of_birth: {
                required: true
            },
            address: {
                required: true,
                minlength: 3,
                maxlength: 255
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.first_name')]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('module.user.first_name'), 'min' => 3]) }}",
                maxlength: "{{ __('validation.max.string', ['attribute' => __('module.user.first_name'), 'max' => 50]) }}"
            },
            middle_name: {
                minlength: "{{ __('validation.min.string', ['attribute' => __('module.user.middle_name'), 'min' => 3]) }}",
                maxlength: "{{ __('validation.max.string', ['attribute' => __('module.user.middle_name'), 'max' => 50]) }}"
            },
            last_name: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.last_name')]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('module.user.last_name'), 'min' => 3]) }}",
                maxlength: "{{ __('validation.max.string', ['attribute' => __('module.user.last_name'), 'max' => 50]) }}"
            },
            email: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.email')]) }}",
                email: "{{ __('validation.email', ['attribute' => __('module.user.email')]) }}",
                remote: "{{ __('validation.unique', ['attribute' => __('module.user.email')]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('module.user.email'), 'min' => 3]) }}",
                maxlength: "{{ __('validation.max.string', ['attribute' => __('module.user.email'), 'max' => 50]) }}"
            },
            mobile_number: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.mobile_number')]) }}",
                digits: "{{ __('validation.digits', ['attribute' => __('module.user.mobile_number'), 'digits' => 10]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('module.user.mobile_number'), 'min' => 10]) }}",
                maxlength: "{{ __('validation.max.string', ['attribute' => __('module.user.mobile_number'), 'max' => 10]) }}"
            },
            gender: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.gender')]) }}"
            },
            role_id: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.role')]) }}"
            },
            date_of_birth: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.date_of_birth')]) }}"
            },
            address: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.address')]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('module.user.address'), 'min' => 3]) }}",
                maxlength: "{{ __('validation.max.string', ['attribute' => __('module.user.address'), 'max' => 255]) }}"
            },
            state_id: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.state')]) }}"
            },
            city_id: {
                required: "{{ __('validation.required', ['attribute' => __('module.user.city')]) }}"
            }
        },
    });
</script>