<?php namespace App\Interfaces;

use Carbon\Carbon;

interface HorarioFuncionarioServiceInterface {
    public function isAvailableInterval($date, $funcionarioId, Carbon $start);
    public function getAvailableIntervals($date, $funcionarioId);
}