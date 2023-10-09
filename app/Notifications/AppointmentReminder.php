<?php 
use App\Http\Controllers\SmsController;
use App\Models\Appointment;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;

class AppointmentReminder extends Notification
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function toSms($notifiable)
    {
        // Call the sendSms function from your SmsController
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'recipient' => $notifiable->phone_number, // Replace with the recipient's phone number
            'message' => $this->message,
        ]);

        $smsController = new SmsController();
        return $smsController->sendSms($request);
    }
}