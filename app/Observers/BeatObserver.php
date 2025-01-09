<?php

namespace App\Observers;

use App\Models\Beat;

class BeatObserver
{
    /**
     * Handle the Beat "created" event.
     */
    public function created(Beat $beat): void
    {
        //
    }

    /**
     * Handle the Beat "updated" event.
     */
    public function updated(Beat $beat): void
    {
        //
    }

    /**
     * Handle the Beat "deleted" event.
     */
    public function deleted(Beat $beat): void
    {
        //
    }

    /**
     * Handle the Beat "restored" event.
     */
    public function restored(Beat $beat): void
    {
        //
    }

    /**
     * Handle the Beat "force deleted" event.
     */
    public function forceDeleted(Beat $beat): void
    {
        //
    }
}
