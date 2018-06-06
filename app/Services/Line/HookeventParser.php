<?php

namespace App\Services\Line;

use App\Eloquents\Line\Hookevent;
use Illuminate\Support\Collection;

class HookeventParser
{
    /**
     * @var Collection
     */
    private $hookevents;

    /**
     * @param array $events
     *
     * @return Collection
     */
    public function parse(array $events): Collection
    {
        $this->hookevents = collect([]);

        foreach ($events as $event) {
            $this->hookevents->push(new Hookevent([
                'original_data' => $event,
                'reply_token' => $event['replyToken'],
                'type' => $event['type'],
                'timestamp' => $event['timestamp'],
                'source' => $event['source'],
                'message' => $event['message'] ?? null,
            ]));
        }

        return $this->hookevents;
    }
}
