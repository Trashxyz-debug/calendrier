<!DOCTYPE html>
<html lang="fr">
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
    {{-- <link href="{{ asset('assets/css/auth/fullcalendar5.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/auth/material-dashboard.min.css') }}" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="{{ asset('assets/css/auth/custom.min.css') }}" rel="stylesheet">
    <!-- IziToast  -->
    <link href="{{ asset('assets/css/auth/iziToast.min.css') }}" rel="stylesheet">


    <style>
    .profile_pic {
      padding: 5px 20px 10px;
    }
    .profile_info {
      padding: 0px 10px 10px;
    }
    .avatar {
                            /* Center the content */
                            display: inline-block;
                            vertical-align: middle;

                            /* Used to position the content */
                            position: relative;

                            /* Colors */
                            background-color: pink;
                            color: #000;
                            font-weight : bold;
                            font-size: 15px;

                            /* Rounded border */
                            border-radius: 50%;
                            height: 48px;
                            width: 48px;
                        }

                        .avatar__letters {
                            /* Center the content */
                            left: 50%;
                            position: absolute;
                            top: 50%;
                            transform: translate(-50%, -50%);
                        }
    </style>
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
              {{-- <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div> --}}
              <div class="profile_pic">
                  <div class="avatar">
                    <div class="avatar__letters">
                      {{ $initiale ?? '' }}
                    </div>
                  </div>
              </div>
              <div class="profile_info">
                <span>{{ __('Welcome Back!') }}</span>
                <h2>{{ $prenom ?? '' }}</h2>
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
                  @auth
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf

                          <x-dropdown-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </x-dropdown-link>
                      </form>
                      {{-- <a href="{{ route('logout') }}" class="user-profile">{{ __('Logout') }}</a> --}}
                    </li>
                  @else
                    <li class="nav-item dropdown open" >
                      <form method="GET" action="{{ route('register') }}">
                          @csrf

                          <x-dropdown-link :href="route('register')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Register') }}
                          </x-dropdown-link>
                      </form>
                      {{-- <a href="{{ route('register') }}" class="user-profile">{{ __('Register') }}</a> --}}
                    </li>
                    <li class="nav-item dropdown open" >
                      <form method="GET" action="{{ route('login') }}">
                          @csrf

                          <x-dropdown-link :href="route('login')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Login') }}
                          </x-dropdown-link>
                      </form>
                    </li>
                  @endauth
                  </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('calendrier5')
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
    <script src="{{ asset('assets/js/auth/moment.js') }}"></script>
    <script src="{{ asset('assets/js/auth/moment-with-locales.js') }}"></script>
    <script src="{{ asset('assets/js/auth/fullcalendar5.min.js') }}"></script>
    <!-- IziToast  -->
    <script src="{{ asset('assets/js/auth/iziToast.min.js') }}"></script>
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{ asset('assets/js/auth/calendar.js') }}"></script> --}}
    <!-- Custom pour fermer la partie de droite -->
    <script src="{{ asset('assets/js/auth/custom.js') }}"></script>
    <!-- Langue française -->
    {{-- <script src="{{ asset('assets/js/fr.js') }}"></script> --}}
    <script>
      // $(document).ready(function() {

          window.mobilecheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
          };


          // pass _token in all ajax
           $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
              contentHeight: "auto",
              locales: 'fr',
                      //initialView: window.mobilecheck() ? 'timeGridWeek' : 'dayGridMonth',
              initialView: 'timeGridWeek',
              hiddenDays: '0',
              slotMinTime: '8:00',
              slotMaxTime: '20:00',
              allDaySlot: false,
              // dayHeaderContent: (args) => {
              //   moment.locale('fr');
              //   let string = moment(args.date).format('ddd');
              //   return string[0].toUpperCase() + string.slice(1) + ' ' + moment(args.date).format('D') ;
              // },
              headerToolbar: {
                  start: "title", // will normally be on the left. if RTL, will be on the right
                  center: "",
                  end: "today prev,next", // will normally be on the right. if RTL, will be on the left
              },
              selectable: true,
              // editable: true,
              events: 'http://127.0.0.1:8000/',
              // events: 'http://127.0.0.1:8000',
              // initialDate: "2020-12-01",
              // events: [
              //     {
              //         title: "All day conference",
              //         start: "2020-11-30 10:00",
              //         end: "2020-11-30 12:00",
              //         className: "bg-gradient-success",
              //     },
              //
              //     {
              //         title: "Meeting with Mary",
              //         start: "2020-12-01 10:00",
              //         end: "2020-12-01 12:00",
              //         className: "bg-gradient-info",
              //     },
              //
              //     {
              //         title: "Winter Hackaton",
              //         start: "2020-12-03 16:00",
              //         end: "2020-12-03 17:00",
              //         className: "bg-gradient-danger",
              //     },
              //
              //     {
              //         title: "Cyber Week",
              //         start: "2020-12-02 08:00",
              //         end: "2020-12-02 17:00",
              //         className: "bg-gradient-warning",
              //     },
              // ],
              views: {
                  month: {
                      titleFormat: {
                          month: "long",
                          year: "numeric",
                      },
                  },
                  agendaWeek: {
                      titleFormat: {
                          month: "long",
                          year: "numeric",
                          day: "numeric",
                      },
                  },
                  agendaDay: {
                      titleFormat: {
                          month: "short",
                          year: "numeric",
                          day: "numeric",
                      },
                  },
              },
          });

          calendar.render();
        // });
    </script>
    {{-- @auth
      @if($verified == 0)
        <script type="text/javascript">
            $(document).ready(function() {
              Swal.fire({
                title: 'Plus qu\'une étape...',
                text: "Cliquez sur le mail qui vous a été envoyé lors votre inscription!",
                icon: 'info',
                showCloseButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Renvoyer le mail de vérification'
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                      type: "POST",
                      url: "{{ route('verification.send') }}",
                      error: function(xhr, status, err) {
                        handleErrors(xhr);
                      }
                  });
                }
              });
            });

        </script>
      @endif
    @endauth
    @auth
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
                    right: ''
                    },
                  defaultView:'agendaWeek',
                  locale: 'fr',
                  buttonIcons: true, // show the prev/next text
                  navLinks: false, // can click day/week names to navigate views
                  editable: false, //
                  firstDay: 1, // Lundi : premier jour de la semaine
                  hiddenDays:[0],
                  dayMaxEvents: true, // allow "more" link when too many events
                  events: "{{ route('book.index') }}",
                  displayEventTime: true,
                  minTime: '08:00:00',
                  maxTime: '20:00:00',
                  eventLimit: true,
                  displayEventTime: true,
                  timeFormat: 'H:mm',
                  selectable: false,
                  selectHelper: false,
                  allDaySlot: false,
                  height: 665,
                  eventTextColor: 'white',
                  eventClick: function (event) {
                      // var eventConfirm = confirm('Etes-vous sûr de vouloir réserver cet évènement ?');
                      var jour = $.fullCalendar.formatDate(event.start, "DD MMM YYYY");
                      var start = $.fullCalendar.formatDate(event.start, "HH:mm");
                      var end = $.fullCalendar.formatDate(event.end, "HH:mm");
                      Swal.fire({
                        icon: 'question',
                        title: 'Réservez ce créneau ?',
                        html: event.title+' - le '+jour+'<p><p>de '+start+' à '+end,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Réserver',
                        cancelButtonText: 'Annuler',
                      }).then((result) => {
                        if (result.isConfirmed) {
                          $.ajax({
                              type: "post",
                              url: "{{ route('book.create') }}",
                              data: {
                                  id: event.id,
                              },
                              success: function (response) {
                                  iziToast.success({
                                      position: 'topRight',
                                      message: 'Evenement réservé.'
                                  });
                                  window.location="{{ route('book.index') }}";
                                  // $('#loginModal').modal('show');
                              },
                              error: function(xhr, status, err) {
                                handleErrors(xhr);
                              }
                          });
                      }
                    })
                  }
              });
          });
      </script>
    @else
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
                    left: 'prev,next',
                    center: 'title',
                    right: 'today'
                    },
                  defaultView:'agendaWeek',
                  locale: 'fr',
                  buttonIcons: true, // show the prev/next text
                  navLinks: false, // can click day/week names to navigate views
                  editable: false, //
                  firstDay: 1, // Lundi : premier jour de la semaine
                  dayMaxEvents: true, // allow "more" link when too many events
                  events: "{{ route('book.index') }}",
                  displayEventTime: true,
                  minTime: '08:00:00',
                  maxTime: '20:00:00',
                  // weekends: false,
                  hiddenDays:[0],
                  eventLimit: true,
                  displayEventTime: true,
                  timeFormat: 'H:mm',
                  // event.allDay: true,
                  selectable: false,
                  selectHelper: false,
                  allDaySlot: false,
                  height: 665,
                  eventTextColor: 'white',
                  eventClick: function (event) {
                    Swal.fire({
                      title: 'Vous devez vous connecter',
                      icon: 'info',
                      showCloseButton: true,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Connection'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location="{{ route('login') }}";
                      }
                    });
                  }
              });
          });
      </script>
    @endauth --}}
      <script type="text/javascript">
        function handleErrors(xhr) {
          switch(xhr.status) {
            case 422:
            let errorString = '';
              $.each(xhr.responseJSON.errors, function(key, value){
                errorString += '<p>'+value+'</p>';
              });
              Swal.fire({
                icon: 'error',
                title: 'Erreur',
                html: errorString
              })
              break;
              case 404:
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Non trouvé'
                })
                break;
              case 403:
                Swal.fire({
                  title: 'Plus qu\'une étape...',
                  text: "Veuillez cliquer sur le mail qui vous a été envoyé lors votre inscription!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Renvoyez'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('verification.send') }}",
                        success: function (response) {

                        },
                        error: function(xhr, status, err) {
                          console.log('Mail envoyé')
                        }
                    });
                  }
                })
                // Swal.fire({
                //   title: "Plus qu'une étape...",
                //   html: 'Veuillez cliquer sur le mail qui vous a été envoyé lors votre inscription'
                // })
                break;
              case 404:
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Non trouvé'
                })
                break;
              case 419:
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Jeton de sécurité non valide. Veuillez recharger la page.'
                }).then((result) => {
                  if(result.value){
                    window.locatin.reload(true);
                  }
                })
                break;
              default:
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Veuillez recharger la page.'
                }).then((result) => {
                  if(result.value){
                    window.locatin.reload(true);
                  }
                })
                break;
          }
        }
      </script>
  </body>
</html>
