<?php

namespace App\Services;

use App\Entity\EmailModel;
use App\Entity\User;
use Mailjet\Client;
use Mailjet\Resources;

class EmailService 
{
    public function sendEmailByMailJet(User $user, EmailModel $emailModel)
    {
        $mj = new Client($_ENV['MJ_APIKEY_PUBLIC'],$_ENV['MJ_APIKEY_SECRET'],true,['version' => 'v3.1']);
        $body = [
          'Messages' => [
            [
              'From' => [
                'Email' => "tooky972mada@gmail.com",
                'Name' => "mYboutique"
              ],
              'To' => [
                [
                  'Email' => $user->getEmail(),
                  'Name' => "passenger 1"
                ]
              ],
              'TemplateID' => 3887242,
              'TemplateLanguage' => true,
              'Subject' => $emailModel->getSubject(),
              'Variables' => [
          "title" => $emailModel->getTitle(),
          "message" => $emailModel->getMessage()
        ],
            ]
          ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}
