<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\EventDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Event"s time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $events = Event::all();
        $event_details = EventDetail::all();
        foreach ($events as $event) {
            if (strtotime($event->event_end) - strtotime($today) <= 0) {
                $event->update([
                    'event_status' => 0,
                ]);

                $productEvents = $event->products;

                foreach ($productEvents as $productEvent) {
                    if ($productEvent->event->event_status == 0) {
                        // Log::channel('laravel')->info($productEvent->event_id);
                        $productEvent->event_id = 0;
                        $productEvent->event_detail_id = 0;
                        $productEvent->save();
                    }
                }

                $eventDetails = $event->event_details;

                foreach ($eventDetails as $eventDetail) {
                    if ($eventDetail->event->event_status == 0) {
                        $eventDetail->even_detail_status = 0;
                        $eventDetail->save();
                    }
                }
            }
        }

        foreach ($event_details as $event_detail) {
            if (strtotime($event_detail->event_detail_end) - strtotime($today) <= 0) {
                $event_detail->update([
                    'event_detail_status' => 0,
                ]);

                $productEventDetails = $event_detail->products;
                foreach ($productEventDetails as $productEventDetail) {
                    if ($productEventDetail->event_detail->event_detail_status == 0) {
                        // Log::channel('laravel')->info($productEvent->event_id);
                        $productEventDetail->event_id = 0;
                        $productEventDetail->event_detail_id = 0;
                        $productEventDetail->save();
                    }
                }
            }
        }
        return Command::SUCCESS;
    }
}
