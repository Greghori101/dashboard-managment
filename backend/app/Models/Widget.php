<?php

namespace App\Models;

use App\Enums\WidgetTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'version_id',
        'type',
        'data',
        'sort',
    ];

    protected $casts = [
        'data' => 'array',
        'type' => WidgetTypes::class,
    ];

    // Relationships
    public function version()
    {
        return $this->belongsTo(Version::class);
    }
}
