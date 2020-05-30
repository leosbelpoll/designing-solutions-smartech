<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;

class Formulario extends Model
{
    protected $table = 'formularios';

    protected $fillable = [
        'name', 'description', 'keep_submitting'
    ];

    public function setKeepSubmittingAttribute($keepSubmitting) {
        $this->attributes['keep_submitting'] = count($keepSubmitting) ? true : null;
    }

    public function getKeepSubmittingAttribute($keepSubmitting) {
        return $keepSubmitting != null ?  ['si' => true] : ['si' => false];
    }

    public function standards()
    {
        return $this->belongsTo(Standard::class);
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
