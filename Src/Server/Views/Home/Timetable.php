<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
<!--<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>-->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>

<!--<div class="d-flex justify-content-between">-->
<!---->
<!--</div>-->
<script>
    const optionHandler = (event) => {
        location.href = `/Home/Timetable/${event.target.value}`
    }
</script>
<?php
//print_r($data["DSMH"]);

?>

<div class="mt-4 mb-4 d-flex justify-content-between">
    <h5>
        <?php
        //        print_r($_SESSION);
        echo "{$_SESSION["user"]["MSSV"]} - {$_SESSION['user']['HO_TEN']}";
        ?>
    </h5>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/Home/TimetableList" type="button" class="btn btn-outline-secondary">Danh sách</a>
        <a href="/Home/Timetable" type="button" class="btn btn-secondary">TKB</a>
    </div>
    <div>
        <select class="form-select " onchange="optionHandler(event)">
            <?php
            foreach ($data["HK"] as $index => $datum) {
                echo <<<HUH
                    <option value="{$datum['NAM']}/{$datum["HK"]}">HK {$datum["HK"]} - Năm {$datum["NAM"]}</option>
                HUH;

            }
            ?>
        </select>
    </div>
</div>

<div id='calendar'></div>


<script>
    <?php
    $val = json_encode($data["DSMH"]);
    echo "const data = JSON.parse('{$val}')"
    ?>


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
            year: '2-digit',
            month: 'numeric',
            day: 'numeric'
        },
        allDaySlot: false,
        initialDate: `${data[0]["NGAY_BAT_DAU"]}`,
        timeZone: 'UTC',
    });

    class FullCalendarTimetable {
        constructor(data) {
            this.data = data
            this.timeTableStart = {
                1 : "07:00:00",
                2 : "07:50:00",
                3 : "09:00:00",
                4 : "09:50:00",
                5 : "10:40:00",
                6 : "13:00:00",
                7 : "13:50:00",
                8 : "15:00:00",
                9 : "15:50:00",
                10 : "16:40:00",
                11 : "17:40:00",
                12 : "18:40:00",
                13 : "19:20:00",
            }
            this.timeTableEnd = {
                1 : "07:50:00",
                2 : "08:40:00",
                3 : "09:50:00",
                4 : "10:40:00",
                5 : "11:30:00",
                6 : "13:50:00",
                7 : "14:40:00",
                8 : "15:50:00",
                9 : "16:40:00",
                10 : "17:30:00",
                11 : "18:30:00",
                12 : "19:20:00",
                13 : "20:10:00",
            }
            this.timeOffSet = {
                "2" : 0,
                "3" : 1,
                "4": 2,
                "5": 3,
                "6": 4,
                "7": 5,
                "8": 6
            }

            this.startDate = data[0]["NGAY_BAT_DAU"]
        }


        toDate(initialDate, offset=0, week=0) {
            const dateOffset = Number(week)*7 + Number(offset);
            const date = new Date(initialDate);
            date.setDate(date.getDate() + dateOffset)
            return date
        }

        addToCalendar(){
            for (const datum of this.data) {
                console.log(datum["TUANHOC"].length)
                for (let i = 0; i < datum["TUANHOC"].length; i++) {
                    const value = datum["TUANHOC"][i]
                    if (value === "-") {
                        continue
                    }
                    const offset = this.timeOffSet[datum["THU"]]
                    const offsetDate = this.toDate(this.startDate, offset, i)
                    console.log(offsetDate)
                    calendar.addEvent({
                        title: `${datum["TENMH"]} - ${datum["LOP"]}`, // a property!
                        start: `${offsetDate.toISOString().split("T")[0]}T${this.timeTableStart[datum["TIET_BAT_DAU"]]}Z`, // a property!
                        end: `${offsetDate.toISOString().split("T")[0]}T${this.timeTableEnd[datum["TIET_KET_THUC"]]}Z`, // a property!
                        // endTime: `${this.timeTableEnd[datum["TIET_KET_THUC"]]}`
                    })

                }
            }
        }


    }
    const timeTable = new FullCalendarTimetable(data);
    timeTable.addToCalendar()

    calendar.render();
</script>
