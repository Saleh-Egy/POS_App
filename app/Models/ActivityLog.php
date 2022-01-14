<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
     /**
     * {@inheritdoc}
     */
    protected $table = 'activity_logs';

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'body' => 'json',
    ];

    /**
     * {@inheritdoc}
     */
    protected $guarded = [];
}
