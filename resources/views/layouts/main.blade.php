<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link href="{{ asset('assets/css/main.css') }}" rel='stylesheet' />
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          dateClick: function(info) {
            alert('Clicked on: ' + info.dateStr);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('Current view: ' + info.view.type);
            // change the day's background color just for fun
            info.dayEl.style.backgroundColor = 'red';
          },
          select: function(info) {
            alert('selected ' + info.startStr + ' to ' + info.endStr + ' on resource ' + info.resource.id);
          }
        });


        calendar.render();
      });

    </script> --}}
    <script>
        $(document).ready(function () {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                editable: true,
                editable: true,
                //events: SITEURL + "/calendar-event",
                displayEventTime: true,
                // eventRender: function (event, element, view) {
                //     if (event.allDay === 'true') {
                //         event.allDay = true;
                //     } else {
                //         event.allDay = false;
                //     }
                // },
                selectable: true,
                selectHelper: true,
                // select: function (event_start, event_end, allDay) {
                //     var event_name = prompt('Event Name:');
                //     if (event_name) {
                //         var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                //         var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                //         $.ajax({
                //             url: SITEURL + "/calendar-crud-ajax",
                //             data: {
                //                 event_name: event_name,
                //                 event_start: event_start,
                //                 event_end: event_end,
                //                 type: 'create'
                //             },
                //             type: "POST",
                //             success: function (data) {
                //                 displayMessage("Event created.");
                //                 calendar.fullCalendar('renderEvent', {
                //                     id: data.id,
                //                     title: event_name,
                //                     start: event_start,
                //                     end: event_end,
                //                     allDay: allDay
                //                 }, true);
                //                 calendar.fullCalendar('unselect');
                //             }
                //         });
                //     }
                // },
                // eventDrop: function (event, delta) {
                //     var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                //     var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                //     $.ajax({
                //         url: SITEURL + '/calendar-crud-ajax',
                //         data: {
                //             title: event.event_name,
                //             start: event_start,
                //             end: event_end,
                //             id: event.id,
                //             type: 'edit'
                //         },
                //         type: "POST",
                //         success: function (response) {
                //             displayMessage("Event updated");
                //         }
                //     });
                // },
                select: function (event) {
                    // var eventDelete = confirm("Are you sure?");
                    var event_name = prompt('Event Name:');
                    $.ajax({
                                url: "http://127.0.0.1:8000/create",
                                data: {
                                    event_name: event_name,
                                    event_start: event.start,
                                    event_end: event.end,
                                    // type: 'create'
                                },
                                type: "POST",
                                success: function (data) {
                                    displayMessage("Event created.");
                                    // calendar.fullCalendar('renderEvent', {
                                    //     id: data.id,
                                    //     title: event_name,
                                    //     start: event_start,
                                    //     end: event_end,
                                    //     allDay: allDay
                                    // }, true);
                                    calendar.fullCalendar('unselect');
                                },
                                error: function(xhr, status, err) {
                                  console.log(xhr, status, err);
                                }
                            });
                    }

            });

            calendar.render();
        });
        function displayMessage(message) {
            toastr.success(message, 'Event');
        }



    </script>
    <style>

        html, body {
          margin: 0;
          padding: 0;
          font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
          font-size: 14px;
        }

        #calendar {
          max-width: 1100px;
          margin: 40px auto;
        }

      </style>
  </head>
  <body>

    @yield('content')

  </body>
</html>
