<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Version extends Model
{
    use HasFactory;

    protected $fillable = [
        'dashboard_id',
        'number',
    ];

    // Relationships
    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class);
    }

    public function widgets()
    {
        return $this->hasMany(Widget::class);
    }
}
