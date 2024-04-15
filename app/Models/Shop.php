<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Shop extends Model
{
    use LogsActivity, SoftDeletes;

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


    /*
     *
     *
     * Query Scopes
     *
     *
     */
}
