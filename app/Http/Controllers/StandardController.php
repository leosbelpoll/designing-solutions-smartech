<?php

namespace App\Http\Controllers;

use App\Formulario;
use App\Project;
use App\Standard;
use App\User;
use App\WeekDaysEnum;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StandardController extends Controller
{

    public function getAll(Request $request)
    {
        $standards = null;

        if ($request->get('parent')) {
            $standards =  Standard::where()->where('standard_id', $request->get('parent'))->get();
        } else if ($idProject = $request->get('project')) {
            $standards =  Standard::whereHas('projects', function ($p) use ($idProject) {
                $p->where('project_id', $idProject);
            })->where('formulario_id', '!=', null)->orWhereHas('standards', function ($s) {
                $s->where('standard_id', '!=', null);
            })->get();
        } else {
            $standards =  Standard::where('standard_id', null)->get();
        }

        $user = Auth::user();
        $standardsWithPermissions = [];

        for ($i = 0; $i < count($standards); $i++) {
            if ($standards[$i]->formulario) {
                if ($this->hasUserPermissionToFormulario($user, $standards[$i]->formulario)) {
                    array_push($standardsWithPermissions, $standards[$i]);
                }
            } else {
                array_push($standardsWithPermissions, $standards[$i]);
            }
        }

        if ($idProject = $request->get('project')) {
            return response()->json([
                'project' => Project::find($idProject),
                'standards' => $standardsWithPermissions
            ], 200);
        }

        return $standardsWithPermissions;
    }


    public function get($id)
    {
        $standard =  Standard::with('standards')->find($id);
        if (!$standard) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        $user = Auth::user();
        $standardsWithPermissions = [];

        if ($standard->standards) {
            for ($i = 0; $i < count($standard->standards); $i++) {
                if ($standard->standards[$i]->formulario) {

                    if ($this->hasUserPermissionToFormulario($user, $standard->standards[$i]->formulario)) {
                        array_push($standardsWithPermissions, $standard->standards[$i]);
                    }
                } else {
                    array_push($standardsWithPermissions, $standard->standards[$i]);
                }
            }

            $standard->standards = [];
        }

        $weekDay = new WeekDaysEnum();
        $standard->formulario = Formulario::with(['fields' => function ($query) use ($weekDay) {
            $query->where('visible_on_days', null)->orWhere('visible_on_days', '=', $weekDay->getWeekDay());
        }])->with('permissions')->with('roles')->find($standard->formulario_id);

        if ($standard->formulario) {
            if (!$this->hasUserPermissionToFormulario($user, $standard->formulario)) {
                return response()->json([
                    'error' => 'No tiene permisos en este formulario'
                ], 401);
            }
        }

        return response()->json([
            'id' => $standard->id,
            'name' => $standard->name,
            'description' => $standard->description,
            'next_screen_title' => $standard->next_screen_title,
            'type' => $standard->type,
            'standards' => $standardsWithPermissions,
            'formulario' => $standard->formulario
        ], 200);;
    }


    private function hasUserPermissionToFormulario($user, $formulario)
    {
        try {
            if ($formulario->permissions) {
                $formulario->permissions->each(function ($permission) use ($user) {
                    if (!in_array($permission->name, $user->permissions->pluck('name')->toArray())) {
                        throw new Exception('No tiene permisos.');
                    }
                });
            }

            if ($formulario->roles) {
                $formulario->roles->each(function ($role) use ($user) {
                    if (!in_array($role->name, $user->roles->pluck('name')->toArray())) {
                        throw new Exception('No tiene permisos.');
                    }
                });
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
