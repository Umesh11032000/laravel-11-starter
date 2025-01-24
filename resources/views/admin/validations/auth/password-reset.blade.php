
<script type="module">
    $('#resetPasswordForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            email: {
                required: "{{ __('validation.required', ['attribute' => __('module.auth.email')]) }}",
                email: "{{ __('validation.email', ['attribute' => __('module.auth.email')]) }}"
            },
            password: {
                required: "{{ __('validation.required', ['attribute' => __('module.auth.password')]) }}",
            },
            password_confirmation: {
                required: "{{ __('validation.required', ['attribute' => __('module.auth.confirm_password')]) }}",
                equalTo: "{{ __('validation.same', ['attribute' => __('module.auth.password')]) }}"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.attr("name") == "password" || element.attr("name") == "password_confirmation") {
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
