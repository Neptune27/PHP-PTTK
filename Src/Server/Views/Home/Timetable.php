<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
<!--<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>-->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap5',
            locale: "vi",
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                center: 'dayGridMonth,timeGridWeek,listWeek',
                end: 'today prev,next'
            },
            buttonText: {
                today:    'Hôm nay',
                month:    'Tháng',
                week:     'Tuần',
                day:      'Ngày',
                list:     'Sự kiện'
            },
            titleFormat: {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            },
            allDaySlot: false
        });
        calendar.render();
    });
</script>
<!--<div class="d-flex justify-content-between">-->
<!---->
<!--</div>-->

<div class="mt-4 mb-4 d-flex justify-content-between">
    <h5>
        <?php
        //        print_r($_SESSION);
        echo "{$_SESSION["user"]["MSSV"]} - {$_SESSION['user']['HO_TEN']}";
        ?>
    </h5>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="TimetableList" type="button" class="btn btn-outline-secondary">Danh sách</a>
        <a href="Timetable" type="button" class="btn btn-secondary">TKB</a>
    </div>
    <div>
        <select class="form-select " aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
</div>

<div id='calendar'></div>



