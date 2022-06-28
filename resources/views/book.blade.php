<!doctype html>
<html>
<head>
    <title>Réservation</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <link href='https://bootswatch.com/4/lux/bootstrap.min.css' rel='stylesheet' />
</head>
<body>

  {{-- <div class="modal" id="infos">
    <div class="modal-dialog">
      <div class="modal-content">
        Contenu de la fenêtre modale
      </div>
    </div>
  </div> --}}
  @if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
  @else
    <div class="top-right links">
      Non Connecté
    </div>
  @endif

  @include('partials.login')
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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

                    if (eventConfirm) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('book.create') }}",
                            data: {
                                id: event.id,
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                iziToast.success({
                                    position: 'topRight',
                                    message: 'Evenement supprimé.'
                                });
                                $('#loginModal').modal('show');

                            }
                        });
                    }
                }
            });
        });
    </script>

</body>
</html>
