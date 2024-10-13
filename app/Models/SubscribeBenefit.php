<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribeBenefit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'subcribe_package_id',
    ];

    public function subscribePackage(): BelongsTo {
        return $this->belongsTo(SubscribePackage::class, 'subcribe_package_id');
    }
}
