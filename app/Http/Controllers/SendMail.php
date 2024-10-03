<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMail extends Controller
{
    public function sendMail()
    {
        try {
            $data = [
                'header' => 'Merhaba, Kullanıcı!',
                'message' => 'Bu, doğrudan HTML içeriği ile gönderilen bir e-posta mesajıdır.'
            ];
    
            $content = "<html><body>
                            <h1>{$data['header']}</h1>
                            <p>{$data['message']}</p>
                        </body></html>";
    
            Mail::html($content, function ($message) {
                $message->to('louisee0357@gmail.com')
                        ->subject('Örnek Konu');
            });
    
            return 'E-posta gönderildi!';
        } catch (\Exception $e) {
            return 'E-posta gönderilirken bir hata oluştu: ' . $e->getMessage();
        }
    }
    
}
