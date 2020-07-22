<?php

namespace App\Admin\Controllers;

use App\BombaAbastecimiento;
use App\EstadoMedicion;
use App\FieldTypeEnum;
use App\GeneradorGasolina;
use App\Automovil;
use App\SelectorEnum;
use App\SistemaAmortiguacion;
use App\Value;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ValueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Valores de formularios';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Value());

        $grid->disableActions();

        $grid->disableCreateButton();

        $grid->disableExport();

        $grid->model()->select('user_id', 'project_id', 'standard_id', 'formulario_id', 'unique_group', 'created_at')->groupBy('user_id', 'project_id', 'standard_id', 'formulario_id', 'unique_group', 'created_at')->orderBy('created_at', 'desc');

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

        $grid->formulario('Formulario')->display(function ($formulario) {
            if ($formulario) {
                return "<span>{$formulario['name']}</span>";
            }
        });

        $grid->column('unique_group', ' ')->display(function ($formulario) {
            if ($formulario) {
                return "Detalles";
            }
        })->link(function ($item) {
            return '/admin/api/values/' . $item->unique_group;
        }, null);

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->where(function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('name', 'like', "%{$this->input}%");
                });
            }, 'Usuario');

            $filter->where(function ($query) {
                $query->whereHas('project', function ($query) {
                    $query->where('name', 'like', "%{$this->input}%");
                });
            }, 'Proyecto');

            $filter->where(function ($query) {
                $query->whereHas('standard', function ($query) {
                    $query->where('name', 'like', "%{$this->input}%");
                });
            }, 'Función');

            $filter->where(function ($query) {
                $query->whereHas('formulario', function ($query) {
                    $query->where('name', 'like', "%{$this->input}%");
                });
            }, 'Formulario');
        });



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($unique_group)
    {
        $show = new Show(Value::where('unique_group', $unique_group)->first());

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        $results = Value::where('unique_group', $unique_group)->get();
        $results->each(function ($value, $index) use ($show) {
            if ($value->field->type == FieldTypeEnum::IMAGE) {
                $show->field('field_' . $index, __($value->field->name))->as(function () use ($value) {
                    return $value->value;
                })->image();
            } else if ($value->field->type == FieldTypeEnum::SELECTOR_NOMENCLADOR) {
                $name = null;

                switch ($value->field->selector) {
                    case SelectorEnum::AUTOMOVIL:
                        $name = Automovil::find($value->value)->name;
                        break;
                    case SelectorEnum::BOMBA_ABASTECIMIENTO:
                        $name = BombaAbastecimiento::find($value->value)->name;
                        break;
                    case SelectorEnum::SISTEMA_AMORTIGUACION:
                        $name = SistemaAmortiguacion::find($value->value)->name;
                        break;
                    case SelectorEnum::ESTADO_MEDICION:
                        $name = EstadoMedicion::find($value->value)->name;
                        break;
                    case SelectorEnum::GENERADOR_GASOLINA:
                        $name = GeneradorGasolina::find($value->value)->name;
                        break;
                    default:
                        $name = 'Selector no definido';
                        break;
                }

                $show->field('field_' . $index, __($value->field->name))->as(function () use ($name) {
                    return $name;
                });
            } else {
                $show->field('field_' . $index, __($value->field->name))->as(function () use ($value) {
                    return $value->value;
                });
            }
        });





        $show->field('created_at', __('Creado'));
        $show->field('updated_at', __('Actualizado'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Value());

        $form->textarea('value', __('Value'));
        $form->textarea('unique_group', __('Unique group'));
        $form->number('user_id', __('User id'));
        $form->number('project_id', __('Project id'));
        $form->number('standard_id', __('Standard id'));
        $form->number('formulario_id', __('Formulario id'));
        $form->number('field_id', __('Field id'));

        return $form;
    }
}
