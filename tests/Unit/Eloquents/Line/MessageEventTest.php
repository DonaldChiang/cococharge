<?php

namespace Tests\Unit\Eloquents\Line;

use App\Eloquents\Line\LineAccount;
use App\Eloquents\Line\MessageEvent;
use App\Eloquents\Line\Messages\LineSticker;
use App\Eloquents\Line\Messages\LineText;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageEventTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $events = factory(MessageEvent::class, 5)->create();

        $this->assertEquals($events->count(), 5);
    }

    public function testOriginDataCast()
    {
        $event = factory(MessageEvent::class)->create();

        $jsonArray = ['a' => 'test', 'b' => 1];

        $event->origin_data = $jsonArray;

        $this->assertEquals('test', $event->origin_data->a);
        $this->assertEquals(1, $event->origin_data->b);
    }

    public function testTimestampDate()
    {
        $event = factory(MessageEvent::class)->create();
        $event->timestamp = 1528383950;

        $this->assertInstanceOf(Carbon::class, $event->timestamp);
    }

    public function testHasOneLineText()
    {
        $event = factory(MessageEvent::class)->create();
        $text = factory(LineText::class)->make();

        $event->lineText()->save($text);

        $this->assertEquals($text->id, $event->lineText->id);
    }

    public function testHasOneLineSticker()
    {
        $event = factory(MessageEvent::class)->create();
        $sticker = factory(LineSticker::class)->make();

        $event->lineSticker()->save($sticker);

        $this->assertEquals($sticker->id, $event->lineSticker->id);
    }

    public function testBelongsToLineAccount()
    {
        $event = factory(MessageEvent::class)->create();
        $account = factory(LineAccount::class)->create();

        $event->lineAccount()->associate($account)->save();

        $this->assertEquals($account->id, $event->lineAccount->id);
    }
}
