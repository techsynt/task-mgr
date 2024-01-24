require('bootstrap-datepicker/dist/css/bootstrap-datepicker.css')
require('bootstrap-datepicker/dist/js/bootstrap-datepicker')
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.ru')
$(document).ready(function () {
    $('.js-datepicker').datepicker(
        {
            format: 'dd-mm-yyyy',
            language: 'ru',
            todayBtn: 'linked',
            todayHighlight: 'true',
        }
    );
});