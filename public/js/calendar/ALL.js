document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        eventInteractive: true,
        locale: "de",
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            {
                id: 'a',
                title: 'my event',
                start: '2024-08-08'
            }
        ],
        eventDragStop(e) {
            console.log(e);
        },
        dateClick(){
            console.log("asd1");
        },
        eventClick(){
            console.log("asd2");
        }
    });
    calendar.render();
});