<?php

namespace Botble\{Module}\Listeners;

use Botble\Base\Events\DeletedContentEvent;
use Exception;
use Botble\{Module}\Services\Store{Name}Service;

class DeletedContentListener
{

    /**
     * Handle the event.
     *
     * @param DeletedContentEvent $event
     * @return void
     */
    public function handle(DeletedContentEvent $event)
    {
        try {
            if ($event->data && in_array(get_class($event->data),
                config('plugins.{-module}.general.supported', []))) {
                app(Store{Name}Service::class)->deleteFile($event->request, $event->data);
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
