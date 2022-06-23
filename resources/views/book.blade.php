<!doctype html>
<html>
<head>
    <title>Réservation</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <link href='https://bootswatch.com/4/lux/bootstrap.min.css' rel='stylesheet' />
</head>
<body>
    <div class="container">
        <div class="row m-3">
            <div class="col-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="{{ asset('assets/js/fr.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            // pass _token in all ajax
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // initialize calendar in all events
            var calendar = $('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: ''
                  },
                defaultView:'agendaWeek',
                locale: 'fr',
                buttonIcons: true, // show the prev/next text
                weekNumbers: true, // Affiche le numéro de semaine
                navLinks: false, // can click day/week names to navigate views
                editable: false, //
                firstDay: 1, // Lundi : premier jour de la semaine
                dayMaxEvents: true, // allow "more" link when too many events
                events: "{{ route('book.index') }}",
                displayEventTime: true,
                minTime: '08:00:00',
                maxTime: '20:00:00',
                weekends: false,
                eventLimit: true,
                displayEventTime: true,
                timeFormat: 'H:mm',
                // event.allDay: true,
                selectable: false,
                selectHelper: false,
                allDaySlot: false,
                eventClick: function (event) {
                    var eventConfirm = confirm('Etes-vous sûr de vouloir réserver cet évènement ?');
                  //var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                    //var end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");

                    if (eventConfirm) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('book.create') }}",
                            data: {
                                event_id: event.id,
                                // title: event.title,
                                // start: start,
                                // end: end
                            },
                            success: function (response) {
                                iziToast.success({
                                    position: 'topRight',
                                    message: 'Evenement supprimé.',
                                });
                            }
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>
