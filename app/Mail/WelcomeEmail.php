<?php
// app/Mail/WelcomeEmail.php

namespace App\Mail;

use App\Models\Empresa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $empresa;
    public $contrasena;

    public function __construct(Empresa $empresa, string $contrasena)
    {
        $this->empresa = $empresa;
        $this->contrasena = $contrasena;
    }

    public function build()
    {
        return $this->from('no-reply@tu-dominio.com')
                    ->subject('Bienvenido a nuestra plataforma')
                    ->view('emails.welcome')
                    ->with([
                        'empresa' => $this->empresa,
                        'contrasena' => $this->contrasena
                    ]);
    }
}
