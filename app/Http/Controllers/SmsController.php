<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        $twilioSid = config('services.twilio.sid');
        $twilioAuthToken = config('services.twilio.auth_token');
        $twilioPhoneNumber = config('services.twilio.phone_number');

        $client = new Client($twilioSid, $twilioAuthToken);

        $recipientPhoneNumber = $request->input('recipient');
        $message = $request->input('message');

        // Send the SMS
        $client->messages->create(
            $recipientPhoneNumber,
            [
                'from' => $twilioPhoneNumber,
                'body' => $message,
            ]
        );

        return "SMS sent successfully!";
    }
}
