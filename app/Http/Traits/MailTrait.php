<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
/**
 * Trait PlayerTrait
 *
 * This trait is responsible for handling all validation and conditions
 * that will be used as parameter to retrieve data in a repository
 */
trait MailTrait
{
    /**
     * Send mail using Mail Service
     * @param $toEmailAddress - Contains the email address on where to send the mail
     * @param $welcomeMessage - Contains the message to send
     * @return json|array
     */
	public function sendMail($toEmailAddress, $welcomeMessage)
    {
        try {
            $response = Mail::to($toEmailAddress)->send(new WelcomeMail($welcomeMessage));

            return response()->json(['message' => 'Mail successfully sent!'], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Failed to send mail. ' . $e->getMessage()], 500);
        }
    }
}
