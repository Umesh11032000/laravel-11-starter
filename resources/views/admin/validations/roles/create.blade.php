<script type="module">
    $('#create-role-form').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
        },
        messages: {
            name: {
                required: "{{ __('validation.required', ['attribute' => __('module.role.name')]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('module.role.name'), 'min' => 3]) }}",
                maxlength: "{{ __('validation.max.string', ['attribute' => __('module.role.name'), 'max' => 50]) }}"
            },
        },
    });
</script>