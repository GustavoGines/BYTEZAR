
$(document).ready(function () {
    // Validar fuerza de contraseña
    $('#password').on('input', function () {
        var password = $(this).val();
        var strength = 0;

        if (password.length >= 8) strength += 1;
        if (password.match(/[A-Z]/)) strength += 1;
        if (password.match(/[0-9]/)) strength += 1;
        if (password.match(/[^A-Za-z0-9]/)) strength += 1;

        $('.strength-bar').css('width', (strength * 25) + '%')
            .removeClass('weak medium strong')
            .addClass(
                strength < 2 ? 'weak' :
                strength < 4 ? 'medium' : 'strong'
            );
    });

    // Validar coincidencia de contraseña al escribir
    $('#confirm-password').on('input', function () {
        const password = $('#password').val();
        const confirmPassword = $(this).val();

        if (password !== confirmPassword) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // Validar coincidencia de contraseña al enviar
    $('#registration-form').on('submit', function (e) {
        const password = $('#password').val();
        const confirmPassword = $('#confirm-password').val();

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
            $('#confirm-password').focus();
        }
    });
});
