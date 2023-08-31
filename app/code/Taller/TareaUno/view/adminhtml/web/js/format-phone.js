require(['jquery', 'jquery/ui'], function ($) {
    $(document).ready(function () {
        // Replace #your_form_id with the actual ID of your form
        $('taller_tareauno_nuevo input.validate-phone').on('input', function () {
            var inputValue = $(this).val().replace(/\D/g, '');
            var formattedValue = '';
            
            if (inputValue.length >= 6) {
                formattedValue = inputValue.substring(0, 3) + '-' + inputValue.substring(3, 6);
            } else {
                formattedValue = inputValue;
            }
            
            $(this).val(formattedValue);
        });
    });
});