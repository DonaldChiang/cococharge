<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\WebhookEvent;
use App\Eloquents\Eloquent;
use App\Traits\Line\WebhookEventEloquent;

class UnfollowEvent extends Eloquent implements WebhookEvent
{
    use WebhookEventEloquent;

    protected $table = 'line_unfollow_events';

    protected $fillable = [
        'line_account_id',
        'type',
        'timestamp',
        'source_type',
        'source_id',
        'origin_data',
    ];

    protected $dates = [
        'timestamp',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'origin_data' => 'object',
    ];
}
