<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Calendrier</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/auth/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/css/auth/font-awesome.min.css') }}" rel="stylesheet">
    <!-- FullCalendar -->
    <link href="{{ asset('assets/css/auth/fullcalendar.css') }}" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="{{ asset('assets/css/auth/custom.min.css') }}" rel="stylesheet">
    <!-- IziToast  -->
    <link href="{{ asset('assets/css/auth/iziToast.min.css') }}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Calendrier</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-table"></i>Calendrier</a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="images/img.jpg" alt="">John Doe
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                    <a class="dropdown-item"  href="javascript:;">Help</a>
                      <a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>

                  <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-green">6</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <div class="text-center">
                          <a class="dropdown-item">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('calendrier')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Calendrier propulsé par DaddyClic
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/auth/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/auth/bootstrap.bundle.min.js') }}"></script>
    <!-- FullCalendar -->
    <script src="{{ asset('assets/js/auth/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/auth/fullcalendar.min.js') }}"></script>
    <!-- IziToast  -->
    <script src="{{ asset('assets/js/auth/iziToast.min.js') }}"></script>
    <!-- Langue française -->
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
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay,listWeek'
                  },
                defaultView:'agendaWeek',
                locale: 'fr',
                buttonIcons: true, // show the prev/next text
                weekNumbers: false, // Affiche le numéro de semaine
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
                allDaySlot: false,
                height: 665,
                eventTextColor: 'white',
                //contentHeight: 650,
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
