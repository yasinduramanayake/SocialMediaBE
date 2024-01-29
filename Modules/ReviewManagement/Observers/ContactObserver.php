<?php

namespace Modules\ReviewManagement\Observers;

use Modules\ReviewManagement\Entities\contacts;
use Illuminate\Support\Facades\Notification;
use App\Notifications\mailNotifications;

class ContactObserver
{
    /**
     * Handle the contacts "created" event.
     *
     * @param  \App\Models\contacts  $contacts
     * @return void
     */
    public function creating(contacts $contacts)
    {
        $data = [
            'subject' => 'Inquiry Creation Notification',
            'greeting' => 'Hello!',
            'line1' => $contacts->first_name . ' Has Been Submit a Inquiry Reguarding The ' . $contacts->subject,
            'line2' => 'This Is His Message : ' . $contacts->message,
            'line3' => 'Try To Connect Him/Her Via ' . $contacts->email,
            'line4' => '',
            'line5' => ''
        ];
        Notification::route('mail', 'httpteen@ifolo.co')->notify(new mailNotifications($data));
    }
    /**
     * Handle the contacts "created" event.
     *
     * @param  \App\Models\contacts  $contacts
     * @return void
     */
    public function created(contacts $contacts)
    {
    }
    /**
     * Handle the contacts "updated" event.
     *
     * @param  \App\Models\contacts  $contacts
     * @return void
     */
    public function updated(contacts $contacts)
    {
    }
    /**
     * Handle the contacts "deleted" event.
     *
     * @param  \App\Models\contacts  $contacts
     * @return void
     */
    public function deleted(contacts $contacts)
    {
    }
    /**
     * Handle the contacts "restored" event.
     *
     * @param  \App\Models\contacts  $contacts
     * @return void
     */
    public function restored(contacts $contacts)
    {
    }
    /**
     * Handle the contacts "force deleted" event.
     *
     * @param  \App\Models\contacts  $contacts
     * @return void
     */
    public function forceDeleted(contacts $contacts)
    {
    }
}
