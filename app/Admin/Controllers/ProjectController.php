<?php

namespace App\Admin\Controllers;

use App\Project;
use App\Standard;
use App\StateEnum;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Proyectos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Project());

        $grid->disableExport();

        $grid->column('name', 'Nombre');

        $grid->column('state', 'Estado');

        $grid->column('description', 'Descripción');

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', 'name');
        });

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
        $show = new Show(Project::findOrFail($id));

        $show->field('name', __('Título'));
        $show->field('state', __('Estado'));
        $show->field('description', __('Descripción'));
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
        $form = new Form(new Project());

        $form->text('name', 'Título')
            ->required()
            ->creationRules(['required', "unique:projects"])
            ->updateRules(['required', "unique:projects,name,{{id}}"]);
        $form->select('state', 'Estado')->options([
            StateEnum::ACTIVE => StateEnum::ACTIVE,
            StateEnum::FINISHED => StateEnum::FINISHED,
            StateEnum::SUSPENDED => StateEnum::SUSPENDED,
        ])->required();
        $form->textarea('description', 'Descripción');
        $standards = Standard::where('standard_id', null)->pluck('name', 'id')->toArray();
        $form->multipleSelect('standards', 'Normas')->options($standards);


        return $form;
    }
}
