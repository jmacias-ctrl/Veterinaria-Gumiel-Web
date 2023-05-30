<?php namespace App\Services;

use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Models\HorarioFuncionarios;
use App\Models\ReservarCitas;
use Carbon\Carbon;

class HorarioFuncionarioService implements HorarioFuncionarioServiceInterface {

    private function getDayFromDate($date){
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i == 0 ? 6 : $i-1);
        return $day;
    }

    public function isAvailableInterval($date, $funcionarioId, Carbon $start){
        $exists = ReservarCitas::where('funcionario_id', $funcionarioId)
                ->where('scheduled_date', $date )
                ->where('sheduled_time', $start->format('H:i:s'))
                ->exists();
            return !$exists;
    }

    public function getAvailableIntervals($date, $funcionarioId){
        $horario = HorarioFuncionarios::where('active', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('user_id', $funcionarioId)
            ->first([
                'morning_start', 'morning_end',
                'afternoon_start', 'afternoon_end',
            ]);
        
        if(!$horario){
            return [];
        }

        $morningIntervalos = $this->getIntervalos(
            $horario->morning_start, $horario->morning_end, $funcionarioId, $date);
        $afternoonIntervalos = $this->getIntervalos(
            $horario->afternoon_start, $horario->afternoon_end, $funcionarioId, $date);

        $data = [];
        $data['morning'] = $morningIntervalos;
        $data['afternoon'] = $afternoonIntervalos;
        return $data;
    }

    private function getIntervalos($start, $end, $funcionarioId, $date)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervalos = [];
        while ($start < $end) {
            $intervalo = [];
            $intervalo['start'] = $start->format('H:i');

            $available = $this->isAvailableInterval($date, $funcionarioId, $start);

            $start->addMinutes(15);
            $intervalo['end'] = $start->format('H:i');

            if($available){
                $intervalos[] = $intervalo;
            }
            
        }

        return $intervalos;
    }
}