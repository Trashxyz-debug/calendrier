<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Fullcalendar Get Event By Id Using Jquery Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css"/>
</head>
<style type="text/css">
    #calendar {
        width:60%;
        margin: 20px auto;
    }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js"></script>
<script src="https://fullcalendar.io/assets/demo-to-codepen.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        eventClick: function(info) {
        var eventObj = info.event;
            if (eventObj.id) {
                alert('Clicked Event Id = ' + eventObj.id);
                console.log('Clicked Event Id = ' + eventObj.id);
            }
        },
        events: [
            {
                id:  1,
                title: 'simple event',
                start: '2022-07-02',
                color: 'red',

            },
            {
                id:  2,
                title: 'New Event',
                start: '2022-07-03'
            },
            {
                id:  12,
                title: 'Coming Event',
                start: '2022-07-22'
            }
        ]
    });
    calendar.render();

    var evenement = calendar.getEventById(12); // an event object!
    evenement.backgroundColor = "#ff0000"; // a property (a Date object)
});
</script>
</html>
