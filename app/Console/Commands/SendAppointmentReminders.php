<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use AppointmentReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-appointment-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $upcomingAppointments = Appointment::where('date', '>=', now())
        ->where('date', '<=', now()->addDays(1))
        ->get();

        foreach ($upcomingAppointments as $appointment) {

            $message = '';
            // Send SMS reminder using your notification class.
            Notification::send($appointment->patient, new AppointmentReminder($message));
        }
    }
}
