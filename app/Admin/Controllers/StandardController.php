<?php

namespace App\Admin\Controllers;

use App\Formulario;
use App\Project;
use App\Standard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StandardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Funciones';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Standard());

        $grid->disableExport();

        $grid->column('name', __('Nombre'));
        $grid->column('description', __('Descripción'));

        $grid->standard('Función superior')->display(function ($standard) {
            if ($standard) {
                return "<span>{$standard['name']}</span>";
            }
        });

        $grid->formulario('Formulario')->display(function ($formulario) {
            if ($formulario) {
                return "<span>{$formulario['name']}</span>";
            }
        });

        $grid->column('next_screen_title', __('Título de la próxima pantalla'));

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
        $show = new Show(Standard::findOrFail($id));

        $show->field('name', __('Título'));
        $show->field('description', __('Descripción'));
        $show->field('next_screen_title', __('Título de la próxima pantalla'));
        $show->field('created_at', __('Creado'));
        $show->field('updated_at', __('Modificado'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Standard());

        $form->text('name', 'Título')
            ->required()
            ->creationRules(['required', "unique:standards"])
            ->updateRules(['required', "unique:standards,name,{{id}}"]);

        $form->textarea('description', 'Descripción');

        $form->text('type')->value('FORM')->readonly();

        $standards = Standard::all()->pluck('name', 'id')->toArray();
        $form->select('standard_id', 'Función superior')->options($standards);

        $projects = Project::all()->pluck('name', 'id')->toArray();
        $form->multipleSelect('projects', 'Proyectos')->options($projects);

        $forms = Formulario::all()->pluck('name', 'id')->toArray();
        $form->select('formulario_id', 'Formulario')->options($forms);

        $form->text('next_screen_title', __('Título de la próxima pantalla'));

        return $form;
    }
}
