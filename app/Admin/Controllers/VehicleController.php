<?php

namespace App\Admin\Controllers;

use App\BombaAbastecimiento;
use App\EstadoMedicion;
use App\Automovil;
use App\Project;
use App\SistemaAmortiguacion;
use App\Standard;
use App\User;
use App\Vehicle;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VehicleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Vehículos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Vehicle());

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });

        $grid->disableCreateButton();

        $grid->disableExport();

        $grid->user('Usuario')->display(function ($user) {
            if ($user) {
                return "<span>{$user['name']}</span>";
            }
        });

        $grid->project('Proyecto')->display(function ($project) {
            if ($project) {
                return "<span>{$project['name']}</span>";
            }
        });

        $grid->standard('Función')->display(function ($standard) {
            if ($standard) {
                return "<span>{$standard['name']}</span>";
            }
        });

        $grid->automovil('Número de placa')->display(function ($noPlaca) {
            if ($noPlaca) {
                return "<span>{$noPlaca['name']}</span>";
            }
        });

        $grid->column('recorrido_inicial', 'Recorrido inicial');
        $grid->column('recorrido_final', 'Recorrido final');
        $grid->column('galones_comprados', 'Galones comprados');

        $grid->bombaabastecimiento('Bomba de abastecimiento')->display(function ($bombaAbastecimiento) {
            if ($bombaAbastecimiento) {
                return "<span>{$bombaAbastecimiento['name']}</span>";
            }
        });

        $grid->sistemaamortiguacion('Sistemas de amortiguación')->display(function ($sistemaAmortiguacion) {
            if ($sistemaAmortiguacion) {
                return "<span>{$sistemaAmortiguacion['name']}</span>";
            }
        });

        $grid->estadomedicion('Estado de medición')->display(function ($estadoMedicion) {
            if ($estadoMedicion) {
                return "<span>{$estadoMedicion['name']}</span>";
            }
        });

        $grid->column('presion_neumaticos', 'Presión de neumáticos');

        $grid->model()->orderBy('id', 'asc');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Vehicle::findOrFail($id));

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });;

        $show->field('user_id', 'Usuario')->as(function ($id) {
            $item = User::find($id);
            return $item->username;
        });

        $show->field('project_id', 'Proyecto')->as(function ($id) {
            $item = Project::find($id);
            return $item->name;
        });

        $show->field('standard_id', 'Función')->as(function ($id) {
            $item = Standard::find($id);
            return $item->name;
        });

        $show->field('automovil_id', 'Número de placa')->as(function ($id) {
            $item = Automovil::find($id);
            return $item->name;
        });

        $show->field('recorrido_inicial', 'Recorrido inicial');
        $show->field('recorrido_inicial_image', 'Recorrido inicial imagen')->image();
        $show->field('recorrido_final', 'Recorrido final');
        $show->field('recorrido_final_image', 'Recorrido final imagen')->image();
        $show->field('galones_comprados', 'Galones comprados');
        $show->field('galones_comprados_image', 'Galones comprados imagen')->image();
        $show->field('bomba_abastecimiento_id', 'Bomba de abastecimiento')->as(function ($id) {
            $item = BombaAbastecimiento::find($id);
            return $item->name;
        });

        $show->field('sistema_amortiguacion_id', 'Sistema amortiguación')->as(function ($id) {
            $item = SistemaAmortiguacion::find($id);
            return $item->name;
        });

        $show->field('explicacion_capacitacion', 'Explicación capacitación');
        $show->field('estado_medicion_id', 'Estado de medición')->as(function ($id) {
            $item = EstadoMedicion::find($id);
            return $item->name;
        });

        $show->field('presion_neumaticos', 'Presión neumáticos');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Vehicle());

        $users = User::where('id', '>', 2)->pluck('name', 'id')->toArray();
        $form->select('user_id', 'Usuario')->options($users);

        $projects = Project::all()->pluck('name', 'id')->toArray();
        $form->select('project_id', 'Proyecto')->options($projects);

        $standards = Standard::all()->pluck('name', 'id')->toArray();
        $form->select('standard_id', 'Función')->options($standards);

        $noPlacas = Automovil::all()->pluck('name', 'id')->toArray();
        $form->select('automovil_id', 'Número de Placa')->options($noPlacas);

        $form->text('recorrido_inicial', 'Recorrido inicial')->pattern('[0-9]+')->placeholder('Km/h');

        $form->image('recorrido_inicial_image', 'Imagen del Recorrido inicial');

        $form->text('recorrido_final', 'Recorrido final')->pattern('[0-9]+')->placeholder('Km/h');

        $form->image('recorrido_final_image', 'Imagen del Recorrido final');

        $form->text('galones_comprados', 'Galones comprados')->pattern('[0-9]+')->placeholder('Cant');

        $form->image('galones_comprados_image', 'Imagen de los Galones comprados');

        $bombasAbastecimiento = BombaAbastecimiento::all()->pluck('name', 'id')->toArray();
        $form->select('bomba_abastecimiento_id', 'Bomba de abastecimiento')->options($bombasAbastecimiento);

        $sistemasAmortiguacion = SistemaAmortiguacion::all()->pluck('name', 'id')->toArray();
        $form->select('sistema_amortiguacion_id', 'Sistema de amortiguación')->options($sistemasAmortiguacion);

        $form->textarea('explicacion_capacitacion', 'Breve explicación de la capacitación de buenas prácticas de hoy')->rows(10)->placeholder('Escriba');

        $estadosMedicion = EstadoMedicion::all()->pluck('name', 'id')->toArray();
        $form->select('estado_medicion_id', 'Estado de Medición del Vehículo')->options($estadosMedicion);

        $form->text('presion_neumaticos', 'Presión de los neumáticos')->pattern('[0-9]+')->placeholder('Psi');

        return $form;
    }
}
