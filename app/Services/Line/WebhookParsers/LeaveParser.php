<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\WebhookEvent;
use App\Contracts\Line\WebhookParser;
use App\Eloquents\Line\LeaveEvent;

class LeaveParser implements WebhookParser
{
    /**
     * @param array $event
     * @param bool $isAutoSave
     *
     * @return WebhookEvent
     */
    public function parse(array $event, bool $isAutoSave = false): WebhookEvent
    {
        $sourceType = array_get($event, 'source.type');
        $sourceId = array_get($event, "source.{$sourceType}Id");
        $leaveEvent = new LeaveEvent([
            'type' => array_get($event, 'type'),
            'timestamp' => intval(array_get($event, 'timestamp') / 1000),
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'origin_data' => $event,
        ]);

        if ($isAutoSave) {
            $leaveEvent->save();
        }

        return $leaveEvent;
    }
}
