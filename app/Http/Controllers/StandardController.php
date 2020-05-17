<?php

namespace App\Http\Controllers;

use App\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{

    public function getAll(Request $request){
        if($request->get('parent')) {
            return Standard::where('standard_id', $request->get('parent'))->get();
        } else if ($idProject = $request->get('project')) {
            return Standard::whereHas('projects', function($p) use ($idProject) {
                $p->where('project_id', $idProject);
            })->get();
        } else {
            return Standard::where('standard_id', null)->get();
        }

    }

    public function get($id){
        $standard =  Standard::find($id);
        if (!$standard) {
            return response()->json([
                'error' => 'Not found'
            ], 404);
        }

        return $standard;
    }
}
