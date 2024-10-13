<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymTestimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'gym_id',
        'name',
        'occupation',
        'photo',
        'message',
    ];

    public function gym(): BelongsTo {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
}
