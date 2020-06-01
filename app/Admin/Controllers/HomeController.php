<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use App\Standard;
use App\Value;
use App\Vehicle;
use Carbon\Carbon;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Content $content, Request $request)
    {
        $content->row(function (Row $row) use ($request) {
            $projectsCounter = Project::count();
            $standardsCounter = Standard::where('standard_id', null)->count();
            $vehiclesCounter = Vehicle::count();
            $formulariosCounter = Value::select('unique_group')->groupBy('unique_group')->count();
            $formulariosTodayCounter = Value::whereDate('created_at', Carbon::today())->select('unique_group')->groupBy('unique_group')->count();

            $projectsWidget = view('dashboard.projects-widget', ['count' => $projectsCounter])->render();
            $standardsWidget = view('dashboard.standards-widget', ['count' => $standardsCounter])->render();
            $vehiclesWidget = view('dashboard.vehicles-widget', ['count' => $vehiclesCounter])->render();
            $formulariosWidget = view('dashboard.formularios-widget', ['count' => $formulariosCounter])->render();
            $formulariosTodayWidget = view('dashboard.formularios-today-widget', ['count' => $formulariosTodayCounter])->render();

            if($notification = $request->input('notification')) {
                $noti = view('admin.parts.alert', ['notification' => $notification])->render();
                $row->column(12, $noti);
            }

            $row->column(4, $projectsWidget);
            $row->column(4, $standardsWidget);
            $row->column(4, $vehiclesWidget);
            $row->column(4, $formulariosWidget);
            $row->column(4, $formulariosTodayWidget);
        });

        return $content;
    }
}
