  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('horarios');
    var calendar = new FullCalendar.Calendar(calendarEl, {

      initialView: 'timeGridWeek',
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
        slotDuration: '00:30:00',
        allDaySlot: false,
       
        slotLabelInterval : '00:30:00',

        slotLabelFormat: function (date){
          return date.date.hour.toString().padStart(2, '0') +':'+ date.date.minute.toString().padStart(2,'0');
        },

        dateClick:function(info){
          $("#exampleModal").modal("show");
        },
        
        

       events:"http://127.0.0.1:8000/admin/horario/show"
    }); 
    
    calendar.setOption('locale','Es')
    calendar.render();
  
  });

