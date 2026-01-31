<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendWhatsappMessage()
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsappNumber = env('TWILIO_WHATSAPP_NUMBER');

        $to = 'whatsapp:+919581735231';
        $message = 'Hello Professor';

        try {
            $twilio = new Client($twilioSid, $twilioToken);

           $twilio->messages->create(
                "whatsapp:+919581735231",
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => "Hello Professor"
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'WhatsApp message sent successfully',
            ]);
        }


         catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
                }
            }
            public function webhook(Request $request)
            {
                $from = $request->input('From');
                $body = $request->input('Body');

                $twilio = new Client(
                    env('TWILIO_SID'),
                    env('TWILIO_AUTH_TOKEN')
                );

                $twilio->messages->create($from, [
                    'from' => env('TWILIO_WHATSAPP_NUMBER'),
                    'body' => "You said: $body",
                ]);

                return response('OK', 200);
            }
}
