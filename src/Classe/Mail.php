<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '39dc6194a8371e429bca84488a6f18fe';
    private $api_key_secret = '4b846720c9a7afd58aab3b93d09208be';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1'] );

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "vinagre.carine@gmail.com",
                        'Name' => "La boutique Marque 42"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3286177,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && ($response->getData());
    }
}
