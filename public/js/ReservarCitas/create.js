let $funcionario ,$date, $tiposervicio, iRadio;
let $hoursMorning, $hoursAfternoon, $titleMorning, $titleAfternoon;

const titleMorning = `
    En la mañana
`;

const titleAfternoon = `
    En la tarde
`;

const noHours = `<h5 class="text-danger"> No hay horas disponibles</h5>`

$(function(){
   $tiposervicio = $('#tiposervicio');
   $funcionario = $('#funcionario');
   $date = $('#date');

   $titleMorning = $('#titleMorning');
   $hoursMorning = $('#hoursMorning');
   $titleAfternoon = $('#titleAfternoon');
   $hoursAfternoon = $('#hoursAfternoon');


   $tiposervicio.change(()=>{
        const tiposervicioId = $tiposervicio.val();
        const url = `/obtener-usuarios/${tiposervicioId}/funcionarios`;
        $.getJSON(url, onFuncionariosLoaded);
   });

   $funcionario.change(loadHours);
   $date.change(loadHours);

});

function onFuncionariosLoaded(funcionarios){
    let htmlOptions = '';
    funcionarios.forEach(funcionario => {
        htmlOptions += `<option value="${funcionario.id}">${funcionario.name}</option>`;
    });
    $funcionario.html(htmlOptions);
    loadHours();

    const tipoServicioNombre = $tiposervicio.find('option:selected').text();
    if (tipoServicioNombre === 'Atención medica') {
        $('#tipoConsulta').show();
        $('#tamMascota').hide();
    } else if (tipoServicioNombre === 'Peluquería') {
        $('#tipoConsulta').hide();
        $('#tamMascota').show();
    } else {
        $('#tipoConsulta').hide();
        $('#tamMascota').hide();
    }
}  

function loadHours(){
    const selectedDate = $date.val();
    const funcionarioId = $funcionario.val();
    const url =`/horariofuncionarios/horas?date=${selectedDate}&funcionario_id=${funcionarioId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data){
    let htmlHoursM = '';
    let hltmHoursA = '';

    iRadio= 0;

    if(data.morning){
        const morning_intervalos = data.morning;
        morning_intervalos.forEach(intervalo =>{
            htmlHoursM += getRadioIntervaloHTML(intervalo);
        });
    }

    if(!htmlHoursM != ""){
        htmlHoursM += noHours;
    }

    if(data.afternoon){
        const afternoon_intervalos = data.afternoon;
        afternoon_intervalos.forEach(intervalo =>{
            hltmHoursA += getRadioIntervaloHTML(intervalo);
        });
    }

    if(!hltmHoursA != ""){
        hltmHoursA += noHours;
    }

    $hoursMorning.html(htmlHoursM);
    $hoursAfternoon.html(hltmHoursA);
    $titleMorning.html(titleMorning);
    $titleAfternoon.html(titleAfternoon);
}


function getRadioIntervaloHTML(intervalo){
    const text = `${intervalo.start}-${intervalo.end}`;
    return `<div class="custom-control custom-radio mb-3">
            <input type="radio" id="interval${iRadio}" name="sheduled_time" value="${intervalo.start}" class="custom-control-input" required>
            <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
            </div>`;
}

function deleteStorage(){
    localStorage.clear();
}

function GuardarInputs() {
    localStorage.clear();

    let tiposervicio = $('#tiposervicio').val();
    localStorage.setItem('tiposervicio', tiposervicio);

    let funcionario = $('#funcionario').val();
    localStorage.setItem('funcionario', funcionario);

    let date = $('#date').val();
    localStorage.setItem('date', date);

    let sheduled_time = $('input[name="sheduled_time"]:checked').val();
    localStorage.setItem('sheduled_time', sheduled_time);

    let type = $('input[name="type"]:checked').val();
    localStorage.setItem('type', type);

    let description = $('#description').val();
    localStorage.setItem('description', description);

    console.log(tiposervicio + ' ' + funcionario + ' ' + date + ' ' + sheduled_time + ' ' + type + ' ' +
        description);
}

$(document).ready(function () {
    let tiposervicio = localStorage.getItem('tiposervicio');
    if (tiposervicio.length !=0) {
        $('#tiposervicio').val(tiposervicio);
        const url = `/obtener-usuarios/${tiposervicio}/funcionarios`;
        $.getJSON(url, onFuncionariosLoaded);
    }

    let funcionario = localStorage.getItem('funcionario');
    if (funcionario.length !=0) {
        $('#funcionario').val(funcionario);
    }

    let date = localStorage.getItem('date');
    if (date.length != 0) {
        $('#date').val(date);
    }

    let sheduled_time = localStorage.getItem('sheduled_time');
    if (sheduled_time.length != 0) {
        setTimeout(() => {
            $('input[name="sheduled_time"]').val([sheduled_time]);
            console.log("Delayed for 1 second.");
          }, 3000);
    }

    let type = localStorage.getItem('type');
    if (type.length != 0) {
        setTimeout(() => {
            $('input[name="type"]').val([type]);
            console.log("Delayed for 1 second.");
          }, 2000);
    }

    let description = localStorage.getItem('description');
    if (description.length != 0) {
        console.log(' dsds');
        $('#description').val(description);
    }


    console.log(tiposervicio + ' ' + funcionario + ' ' + date + ' ' + sheduled_time + ' ' + type + ' ' +
        description);
});