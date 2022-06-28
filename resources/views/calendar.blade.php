<!doctype html>
<html>
<head>
    <title>Agenda</title>
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

    <script src="{{ mix('js/app.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
                  right: 'month,agendaWeek,agendaDay,listWeek'
                  },
                defaultView:'agendaWeek',
                locale: 'fr',
                buttonIcons: true, // show the prev/next text
                weekNumbers: true, // Affiche le numéro de semaine
                navLinks: true, // can click day/week names to navigate views
                editable: true, //
                firstDay: 1, // Lundi : premier jour de la semaine
                dayMaxEvents: true, // allow "more" link when too many events
                events: "{{ route('calendar.index') }}",
                displayEventTime: true,
                minTime: '08:00:00',
                maxTime: '20:00:00',
                weekends: false,
                eventLimit: true,
                displayEventTime: true,
                timeFormat: 'H:mm',
                // showNonCurrentDates: true,
                // eventRender: function (event, element, view) {
                //     if (event.allDay === 'true') {
                //             event.allDay = true;
                //     } else {
                //             event.allDay = false;
                //     }
                // },
                // event.allDay: true,
                selectable: true,
                selectHelper: false,
                select: function (start, end) {
                    var event_name = prompt('Ajouter un titre : ');
                    if (event_name) {
                        var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");

                        $.ajax({
                            url: "{{ route('calendar.create') }}",
                            data: {
                                title: event_name,
                                start: start,
                                end: end
                            },
                            type: 'post',
                            success: function (data) {
                               iziToast.success({
                                    position: 'topRight',
                                    message: 'Evenement ajouté.',
                                });

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: event_name,
                                    start: start,
                                    end: end
                                }, true);
                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");

                    $.ajax({
                        url: "{{ route('calendar.edit') }}",
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id
                        },
                        dataType: 'json',
                        type: "put",
                        success: function (response) {
                            iziToast.success({
                                position: 'topRight',
                                message: 'Evenement mis à jour.',
                            });
                        },
                        error: function (xhr, status, err) {
                            iziToast.error({
                                position: 'topRight',
                                message: 'Problème de mise à jour.',
                            });
                        }
                    });
                },
                eventClick: function (event) {
                    var eventDelete = confirm('Etes-vous sûr de vouloir supprimer cet évènement ?');
                    if (eventDelete) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('calendar.destroy') }}",
                            data: {
                                id: event.id,
                                _method: 'delete',
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
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
