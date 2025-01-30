<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormView extends Model
{
    protected $guarded = [];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}