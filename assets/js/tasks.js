// Import necessary Bootstrap Datepicker files
require("bootstrap-datepicker/dist/css/bootstrap-datepicker.css");
require("bootstrap-datepicker/dist/js/bootstrap-datepicker");
require("bootstrap-datepicker/js/locales/bootstrap-datepicker.ru");

import $ from "jquery";

$(document).ready(function () {
  // Initialize the eventDates array
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
    $(".js-datepicker").datepicker({
      todayBtn: "linked",
      language: "ru",
      beforeShowDay: function (calendarDay) {
        if (jQuery.inArray(calendarDay.getTime(), eventDates) !== -1) {
          // Return an array with the CSS class and an optional tooltip
          return {
            classes: "highlighted-cal-dates",
          };
        }
      },
    });
    $(".js-datepicker").on("changeDate", function () {
      console.log($(".js-datepicker").datepicker("getDate"));
    });
  }
});
