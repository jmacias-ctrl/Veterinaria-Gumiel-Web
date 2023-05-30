  document.addEventListener('DOMContentLoaded', function() {
    let formulario = document.querySelector("form");
    var calendarEl = document.getElementById('horarios');
    var calendar = new FullCalendar.Calendar(calendarEl, {

      initialView: 'timeGridWeek',
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
        minTime: "09:00",
        slotDuration: '00:15:00',
        allDaySlot: false,
        slotLabelInterval : '00:15:00',

        slotLabelFormat: function (date){
          return date.date.hour.toString().padStart(2, '0') +':'+ date.date.minute.toString().padStart(2,'0');
        },

        eventClick:function(info){
          var horarios = info.event;
          console.log(horarios);
          axios.post(baseURL+"/admin/horario/edit/"+info.event.id).
          then(
            (respuesta)=>{
              formulario.id.value = respuesta.data.id;
              formulario.title.value = respuesta.data.title;
              formulario.id_usuario.value = respuesta.data.id_usuario;
              formulario.start.value = respuesta.data.start;
              formulario.end.value = respuesta.data.end;
              $("#exampleModal").modal("show");

            }
          ).catch(
            error=>{
              if(error.response){
                console.log(error.response.data)
              }
            }
          )
        },
        
 

       events:baseURL+"/admin/horario/show"
    }); 
    
    calendar.setOption('locale','Es')
    calendar.render();
  
    document.getElementById("btnEliminar").addEventListener("click",function(){
      enviarDatos("/admin/horario/delete/"+formulario.id.value);
    });
    document.getElementById("btnModificar").addEventListener("click",function(){
      enviarDatos("/admin/horario/actualizar/"+formulario.id.value);
    });

    function enviarDatos(url){
      const datos = new FormData(formulario);
      const nuevaURL = baseURL+url;
      axios.post(nuevaURL, datos).
          then(
            (respuesta)=>{
              calendar.refetchEvents();
              $("#exampleModal").modal("hide");

            }
          ).catch(
            error=>{if(error.response){ console.log(error.response.data);}
            }
          )
    }
  });

