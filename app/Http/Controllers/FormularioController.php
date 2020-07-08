<?php

namespace App\Http\Controllers;

use App\Formulario;
use App\WeekDaysEnum;
use Illuminate\Http\Request;

class FormularioController extends Controller
{

    public function getAll()
    {
        return Formulario::all();
    }

    public function get($id)
    {
        $weekDay = new WeekDaysEnum();
        $form =  Formulario::with(['fields' => function ($query) use ($weekDay) {
            $query->where('visible_on_days', null)->orWhere('visible_on_days', '=', $weekDay->getWeekDay());
        }])->with('permissions')->with('roles')->find($id);
        if (!$form) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $form;
    }
}
