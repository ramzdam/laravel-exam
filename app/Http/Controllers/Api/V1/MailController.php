<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\MailTrait;

class MailController extends Controller
{
    use MailTrait;
}
