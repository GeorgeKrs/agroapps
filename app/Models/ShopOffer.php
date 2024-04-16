<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ShopOffer extends Model
{
    use LogsActivity, SoftDeletes, HasFactory;

    protected $guarded = [];
    protected $table = 'shop_offers';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }

    /*
     *
     *
     * Relationships
     *
     *
     */

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, "shop_id");
    }
}
