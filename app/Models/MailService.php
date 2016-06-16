<?php namespace App\Models;

use App\Models\Entities\MailRequest;
use Mail;

class MailService {
  public function sendEmail(MailRequest $mail_request) {
    if(empty($mail_request->view_name)) {
      $mail_request->view_name = 'email-template';
    }

    $mail_request = (array)$mail_request;
    Mail::send($mail_request["view_name"], $mail_request["data"], function ($message) use ($mail_request) {
      $message->from($mail_request["from_email"], $mail_request["from_name"])
        ->to($mail_request["to_email"])
        ->subject($mail_request['subject']);
    });
  }
}