<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Models\HorarioFuncionarios;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    
    public function hours(Request $request, HorarioFuncionarioServiceInterface $horarioFuncionarioServiceInterface)
    {
        $rules = [
            'date' => 'required|date_format:"Y-m-d"',
            'funcionario_id' => 'required|exists:users,id',
        ];
        $this->validate($request, $rules);

        $date = $request->input('date');
        
        $funcionarioId = $request->input('funcionario_id');

        return $horarioFuncionarioServiceInterface->getAvailableIntervals($date, $funcionarioId);
    }

    
}
