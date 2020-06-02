<?php

namespace App\Http\Controllers;

use App\Formulario;
use Illuminate\Http\Request;

class FormularioController extends Controller
{

    public function getAll(){
        return Formulario::all();
    }

    public function get($id){
        $form =  Formulario::with('fields')->with('permissions')->with('roles')->find($id);
        if (!$form) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $form;
    }
}
