<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];
    
    protected $fillable = [
        'form_id',
        'data',
        
    ] ;
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
