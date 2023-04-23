document.addEventListener('DOMContentLoaded', function() {
    let formulario = document.querySelector("form");
    var calendarEl = document.getElementById('horarios');
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'timeGridWeek,timeGridDay'
      },
      
      slotDuration:"00:30:00",
        minTime:"09:30:00",
        maxTime:"20:00:00",
        allDaySlot: false,
        slotLabelInterval : '00:30:00',
        slotLabelFormat: function (date){
          return date.date.hour.toString().padStart(2, '0') +':'+ date.date.minute.toString().padStart(2,'0');
        },
    });
  });

