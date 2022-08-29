<?php

use CugMail\CugMail;

require 'vendor/autoload.php';

if(!request()::isPost())
{
    return response()->json(202, "Bad request");
}

$email = request()->post('email');
$name = request()->post('name');
$body = request()->post('message');
$phone = request()->post('phone');
$subject = request()->post('subject');

$message = "
<h3> Dear Sir/Madam, you got a message from Nakimuli Foundation website</h3>
<h4> Sender Information </h4>
<p><b>Email:</b> {$email} </p>
<p><b>Full Name:</b> {$name}</p>
<p><b>Phone Number:</b> {$phone}</p>
<p><b>Subject:</b> {$subject}</p>
<p><b> <u> Body </u> </b></p>
<p> {$body} </p>
<p> Best Regards,</p>
<small> <b> Nakimuli Foundation Email Service. </b> </small>
";

CugMail::init()
->from()
->to('luzindamaria2@gmail.com', "Luzinda Mariyah")
->subject("Message Nakimuli Foundation Website")
->html($message)
->send();