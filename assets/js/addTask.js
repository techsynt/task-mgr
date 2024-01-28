require('bootstrap-datepicker/dist/css/bootstrap-datepicker.css')
require('bootstrap-datepicker/dist/js/bootstrap-datepicker')
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.ru')

import $ from 'jquery';

$(document).ready(function () {
  $(".js-datepicker").datepicker({
    startDate: new Date(),
    format: 'yyyy-mm-dd',
    language: 'ru',
    todayBtn: 'linked',
  });

  $("#datepicker").on("changeDate", function () {
    $("#task_createdAt").val($("#datepicker").datepicker("getFormattedDate"));
  });
});
