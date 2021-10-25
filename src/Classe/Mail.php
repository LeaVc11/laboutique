<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '53afb2e2ca0256880f70df7b9a59cbf7';
    private $api_key_secret = '25d4f03843baa60353ac1ccdcbc19c66';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "laboutiquetest42@gmail.com",
                        'Name' => "La boutique test 42"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3288656,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    "Variables"=>
                    [
                        'content'=>$content,

                    ]

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() /*&& dd($response->getData())*/;
    }
}
