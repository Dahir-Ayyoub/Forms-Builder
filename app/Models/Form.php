<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = [];


    protected $fillable = [
        'user_id',
        'title',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function views()
    {
        return $this->hasMany(FormView::class);
    }

    public function scopeWithAnalytics($query)
    {
        return $query->withCount(['submissions', 'views']);
    }
}
