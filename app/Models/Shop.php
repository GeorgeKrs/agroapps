<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Shop extends Model
{
    use LogsActivity, SoftDeletes, HasFactory;

    protected $guarded = [];
    protected $table = 'shops';

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

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class, "category_id");
    }

    public function offers(): HasMany
    {
        return $this->hasMany(ShopOffer::class, "shop_id");
    }
}
