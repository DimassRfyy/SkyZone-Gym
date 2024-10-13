<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribePackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'icon',
        'duration',
    ];

    public function subscribeBenefits(): HasMany {
        return $this->hasMany(SubscribeBenefit::class);
    }

    public function subcribeTransactions(): HasMany {
        return $this->hasMany(SubscribeTransaction::class);
    }
}
