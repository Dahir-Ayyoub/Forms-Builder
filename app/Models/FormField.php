<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'form_id',
        'label',
        'type',
        'options',
        'is_required',
        'order',
        'multiple'

    ] ;

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
