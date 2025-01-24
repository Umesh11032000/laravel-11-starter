<script type="module">
    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "{{ __('validation.required', ['attribute' => __('module.auth.email')]) }}",
                email: "{{ __('validation.email', ['attribute' => __('module.auth.email')]) }}"
            },
            password: {
                required: "{{ __('validation.required', ['attribute' => __('module.auth.password')]) }}",
                remote: "{{ __('validation.strong_password', ['attribute' => __('module.auth.password')]) }}"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            // for password with eye icon
            if (element.attr("name") == "password") {
                error.insertAfter($(element).parent());
            } else {
                error.insertAfter(element);
            }

            error.addClass('text-danger');
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
</script>