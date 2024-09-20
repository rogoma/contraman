<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendMail()
    {
        $data = [
            'title' =>'Correo de prueba',
            'body' => 'Este es un correo enviado desde una aplicación Laravel utilizando Gmail.'
        ];

        //Se crea una variable donde se coloca la dirección de mail
        $dir_mail = 'rogoma700@gmail.com';
        $dir_mail2 = ['rogoma700@gmail.com', 'senasa2023@gmail.com'];

        Mail::send('emails.test', $data, function($message) use ($dir_mail){
            $message->to($dir_mail)
                    ->subject('Correo de prueba Laravel');
        });

        return "Correo enviado exitosamente";
    }
}

