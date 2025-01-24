$(document).ready(function () {
    $('.form-select2').select2()
})

function togglePassword (id, element) {
    const password = document.getElementById(id)
    if (password.type === 'password') {
        password.type = 'text'
        element.innerHTML = '<i class="bi bi-eye-fill"></i>'
    } else {
        password.type = 'password'
        element.innerHTML = '<i class="bi bi-eye-slash-fill"></i>'
    }
}

// Attach to global scope
window.togglePassword = togglePassword

function checkIsNumber (evt) {
    let charCode = evt.which || evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false
    } else {
        return true
    }
}

// Hide alert after 3 seconds
setTimeout(() => {
    $('.alert').fadeOut('slow')
}, 3000)

// Common maxsize jquery validation for file upload
$.validator.addMethod(
    'maxsize',
    function (value, element, param) {
        return this.optional(element) || element.files[0].size / 1024 <= param
    },
    'File size must be less than {0} MB.'
)

// errorPlacement for jquery validation
$.validator.setDefaults({
    errorElement: 'span',
    errorClass: 'invalid-feedback',
    errorPlacement: function (error, element) {
        $(element).siblings('.invalid-feedback').remove()

        console.log(element)

        if (
            element.parent('.input-group').length ||
            element.prop('type') === 'checkbox' ||
            element.hasClass('editor')
        ) {
            if (element.parent('.input-group').length) {
                // If error is exist then remove it
                if (element.parent().next('.invalid-feedback').length) {
                    element.parent().next('.invalid-feedback').remove()
                }
                error.insertAfter(element.parent())
            } else {
                error.insertAfter(element.parent())
            }
        } else if (element.parent().children('.select2').length) {
            error.insertAfter(element.parent().children('.select2'))
        } else if (element.hasClass('select2')) {
            error.insertAfter($(element).next('span'))
        } else if (element.attr('name').includes('option')) {
            error.insertAfter($(element).parent())
        } else if (element.prop('name') === 'photo') {
            error.insertAfter($(element).closest('.avatar'))
        } else if (element.prop('type') === 'radio') {
            error.insertAfter($(element).parent().parent())
        } else {
            error.insertAfter(element)
        }
        error.addClass('invalid-feedback')
    },
    highlight: function (element) {
        if ($(element).hasClass('select2')) {
            $(element).next('span').addClass('is-invalid')
            $(element).next('.select2-container').addClass('is-invalid')
        } else {
            $(element).addClass('is-invalid')
        }
    },
    unhighlight: function (element) {
        if ($(element).hasClass('select2')) {
            $(element).next('span').removeClass('is-invalid')
            $(element).next('.select2-container').removeClass('is-invalid')
        } else {
            $(element).removeClass('is-invalid')
        }
    }
})

$(function () {
    if (typeof formValidaor !== 'undefined') {
        if ($('.form-select2').length > 0) {
            $(document).on('change', '.form-select2', function () {
                formValidaor.element($(this))
            })
        }

        // for all input fields
        $(document).on('keyup', 'input', function () {
            formValidaor.element($(this))
        })

        // On ctrl + backspace clear the field
        $(document).on('keydown', 'input', function (e) {
            if (e.ctrlKey && e.keyCode === 8) {
                $(this).val('')
                formValidaor.element($(this))
            }
        })
    }

    $('.form-select2')
        .on('select2:select', function (e) {
            let select = $(this)
            let allowClear = $(
                '<span class="select2-selection__clear">×</span>'
            )
            $(this).next().find('.select2-search__field').focus()
            $(this)
                .next()
                .find('.select2-selection__rendered')
                .prepend(allowClear)
            allowClear.on('click', function () {
                select.val([]).change()
            })
        })
        .on('select2:unselect', function (e) {
            let select = $(this)
            console.log(select.val())
            let allowClear = $(
                '<span class="select2-selection__clear">×</span>'
            )

            if (select.val().length) {
                $(this)
                    .next()
                    .find('.select2-selection__rendered')
                    .prepend(allowClear)
                allowClear.on('click', function () {
                    select.val([]).change()
                })
            }
        })
})
