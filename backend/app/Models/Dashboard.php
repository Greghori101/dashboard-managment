<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'current_version_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    public function currentVersion()
    {
        return $this->belongsTo(Version::class, 'current_version_id');
    }
}
