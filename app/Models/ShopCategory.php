<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ShopCategory extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $guarded = [];
    protected $table = 'shop_categories';

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

    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class, "category_id");
    }
}
