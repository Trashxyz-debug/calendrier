<!doctype html>
<html>
<head>
    <title>Calendrier</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" /> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}
    <link href="{{ asset('assets/css/main.css') }}" rel='stylesheet' />
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/fr.js') }}"></script>

    <style>
      #calendar {
        max-width: 900px;
        margin: 40px auto;
      }
    </style>

    <script type="text/javascript">

    var events = [{id:1, title:'rzareazer', start:'2022-06-20', end:'2022-06-21'}];

$(function() {
      var calendarEl = document.getElementById('calendar');

      // pass _token in all ajax
      //  $.ajaxSetup({
      //     headers: {
      //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //     }
      // });



      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: "{{ route('calendrier.index') }}",
        locale: 'fr',
        buttonIcons: true, // show the prev/next text
        weekNumbers: true, // Affiche le numéro de semaine
        navLinks: true, // can click day/week names to navigate views
        editable: true, //
        firstDay: 1, // Lundi : premier jour de la semaine
        dayMaxEvents: true, // allow "more" link when too many events
        // eventRender: function (event, element, view) {
        //     if (event.allDay === 'true') {
        //         event.allDay = true;
        //     } else {
        //         event.allDay = false;
        //     }
        // }
      });

      calendar.render();

      // pass _token in all ajax
      //  $.ajaxSetup({
      //     headers: {
      //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //     }
      // });

            // initialize calendar in all events
            // var calendar = $('#calendar').fullCalendar({
                // defaultView: 'agendaWeek',
                //editable: true,
                // events: "{ route('calendar.index') }}",
                // displayEventTime: true,
                // eventRender: function (event, element, view) {
                //     if (event.allDay === 'true') {
                //             event.allDay = true;
                //     } else {
                //             event.allDay = false;
                //     }
                // },
                // selectable: true,
                // selectHelper: true,
                // select: function (start, end, allDay) {
                //     var event_name = prompt('Event Name:');
                //     if (event_name) {
                //         var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                //         var end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
                //         $.ajax({
                //             url: "{ route('calendar.create') }}",
                //             data: {
                //                 title: event_name,
                //                 start: start,
                //                 end: end
                //             },
                //             type: 'post',
                //             success: function (data) {
                //                iziToast.success({
                //                     position: 'topRight',
                //                     message: 'Event created successfully.',
                //                 });
                //
                //                 calendar.fullCalendar('renderEvent', {
                //                     id: data.id,
                //                     title: event_name,
                //                     start: start,
                //                     end: end,
                //                     allDay: allDay
                //                 }, true);
                //                 calendar.fullCalendar('unselect');
                //             }
                //         });
                //     }
                // },
                // eventDrop: function (event, delta) {
                //     var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                //     var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");
                //
                //     $.ajax({
                //         url: "{ route('calendar.edit') }}",
                //         data: {
                //             title: event.event_name,
                //             start: start,
                //             end: end,
                //             id: event.id,
                //         },
                //         type: "POST",
                //         success: function (response) {
                //             iziToast.success({
                //                 position: 'topRight',
                //                 message: 'Event updated successfully.',
                //             });
                //         }
                //     });
                // },
                // eventClick: function (event) {
                //     var eventDelete = confirm('Are you sure to remove event?');
                //     if (eventDelete) {
                //         $.ajax({
                //             type: "post",
                //             url: "{route('calendar.destroy') }}",
                //             data: {
                //                 id: event.id,
                //                 _method: 'delete',
                //             },
                //             success: function (response) {
                //                 calendar.fullCalendar('removeEvents', event.id);
                //                 iziToast.success({
                //                     position: 'topRight',
                //                     message: 'Event removed successfully.',
                //                 });
                //             }
                //         });
                //     }
                // }
            });

    </script>
</head>
<body>

    <div id='calendar'></div>

</body>
</html>
