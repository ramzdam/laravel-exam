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

	public function sendMail($toEmailAddress, $welcomeMessage)
    {
        try {
            $response = Mail::to($toEmailAddress)->send(new WelcomeMail($welcomeMessage));
            // dd($response);
        } catch(Exception $e) {

        }
    }
}
