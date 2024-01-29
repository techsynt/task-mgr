require("bootstrap-datepicker/dist/css/bootstrap-datepicker.css");
require("bootstrap-datepicker/dist/js/bootstrap-datepicker");
require("bootstrap-datepicker/js/locales/bootstrap-datepicker.ru");

import $ from "jquery";

function getDates() {
  let eventDates = [];

  // Fetch dates from the server
  $.get("/dates", function (data) {
    // Success callback
    data.forEach(function (dateObject) {
      eventDates.push(new Date(dateObject.date).getTime());
    });
    initializeDatepicker(eventDates);
  }).fail(function (jqXHR, textStatus, errorThrown) {
    // Error callback
    console.error("Error:", textStatus, errorThrown);
  });

  // Function to initialize the datepicker
  function initializeDatepicker(eventDates) {
    $(".js-datepicker").datepicker("destroy"); // Destroy the existing datepicker

    $(".js-datepicker").datepicker({
      todayBtn: "linked",
      language: "ru",
      beforeShowDay: function (calendarDay) {
        var highlighted =
          jQuery.inArray(calendarDay.getTime(), eventDates) !== -1;
        return {
          classes: highlighted ? "highlighted-cal-dates" : "",
        };
      },
    });
  }
}

$(document).ready(function () {
  getDates();

  $(".js-datepicker").on("changeDate", function () {
    $(".append_tasks").empty();
    let chosen_date = $(".js-datepicker").datepicker("getFormattedDate");
    $.post("/get_tasks", { date: chosen_date }, function (response) {
      response.forEach(function (object, index) {
        var $newCard = $(
          '<div class="card" style="width: 18rem;">\n' +
            '  <div class="card-body">\n' +
            '    <h5 class="card-title">' +
            object.title +
            "</h5>\n" +
            '    <p class="card-text">' +
            object.content +
            "</p>\n" +
            "    <a href='#' class='btn btn-danger btn-sm delete-link' data-task-id='" +
            object.id +
            "'>Удалить</a>" +
            "  </div>\n" +
            "</div>",
        );

        $(".append_tasks").append($newCard);

        $newCard.find(".delete-link").click(function (e) {
          // Make an AJAX request to delete the task
          var taskId = $(this).data("task-id");
          $.post("/delete/task" + taskId, function (response) {
            $newCard.remove();
            getDates();
          });
        });
      });
    });
  });
});
