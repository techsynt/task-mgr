/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import $ from 'jquery';
import "bootstrap";
import "./styles/app.css";

require('bootstrap-datepicker/dist/css/bootstrap-datepicker.css')
require('bootstrap-datepicker/dist/js/bootstrap-datepicker')
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.ru')
$(document).ready(function () {
    $('.js-datepicker').datepicker({
        format: 'dd-mm-yyyy',
        startDate: new Date(),
        language: 'ru',
        todayBtn: 'linked',
        todayHighlight: 'true',
    });
    $('#datepicker').on('changeDate', function() {
        $('#task_createdAt').val(
            $('#datepicker').datepicker('getFormattedDate')
        );
    });
});

