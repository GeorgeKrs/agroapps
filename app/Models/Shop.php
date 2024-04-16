<?php

namespace App\Models;

use App\Repositories\ShopRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Shop extends Model
{
    use LogsActivity, SoftDeletes, HasFactory;

    protected $guarded = [];
    protected $table = 'shops';

    protected $casts = [
        'open_hours' => 'json',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }

    public function repository(): ShopRepository
    {
        return new ShopRepository($this);
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

    /*
     *
     *
     * Query Scopes
     *
     *
     */

    public function scopeFilter(Builder $builder): Builder
    {
        return $builder
            ->when(request("owner_ids") ?? null, function ($builder, $ownerIds) {
                $builder->ownersFilter($ownerIds);
            })
            ->when(request("category_ids") ?? null, function ($builder, $categoryIds) {
                $builder->categoriesFilter($categoryIds);
            })
            ->when(request("term") ?? null, function ($builder, $term) {
                $builder->citiesFilter($term);
            });
    }

    public function scopeOwnersFilter(Builder $builder, ?array $ownerIds = []): Builder
    {
        return $builder->whereIn("owner_id", $ownerIds);
    }

    public function scopeCategoriesFilter(Builder $builder, ?array $categoryIds = []): Builder
    {
        return $builder->whereIn("category_id", $categoryIds);
    }

    public function scopeCitiesFilter(Builder $builder, ?string $term = null): Builder
    {
        if ($term) {
            return $builder->where('city', 'like', '%' . Str::lower($term) . '%');
        }

        return $builder;
    }
}
