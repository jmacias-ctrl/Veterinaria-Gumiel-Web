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
            <input type="radio" id="interval${iRadio}" name="sheduled_time" value="${intervalo.start}" class="custom-control-input" value="${text}" required>
            <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
            </div>`
}
