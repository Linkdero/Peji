<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com'; // Cambia esto
            $mail->SMTPAuth = true;
            $mail->Username = 'desarrollo@webslopez.com';
            $mail->Password = 'Andy&zelda1'; // Usa una variable de entorno aquí
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('desarrollo@webslopez.com', 'Weblopez');
            $mail->addAddress('desarrollo@webslopez.com');

            $mail->isHTML(true);
            $mail->Subject = 'Nuevo mensaje de contacto de ' . e($request->name);

            $mail->Body = "
            <h2>Nuevo mensaje de contacto</h2>
            <p><strong>Nombre:</strong> " . e($request->name) . "</p>
            <p><strong>Email:</strong> " . e($request->email) . "</p>
            <p><strong>Teléfono:</strong> " . e($request->phone) . "</p>
            <p><strong>Categoría:</strong> " . e($request->subject) . "</p>
            <p><strong>Mensaje:</strong> " . nl2br(e($request->message)) . "</p>
        ";

            $mail->send();

            return response()->json(['success' => true, 'message' => 'Mensaje enviado con éxito']);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el mensaje: ' . $mail->ErrorInfo
            ], 500);
        }
    }

    private function getCategoryName($categoryId)
    {
        // Aquí deberías obtener el nombre de la categoría basado en el ID
        // Esto es un ejemplo, ajusta según tu modelo de categorías
        $category = \App\Models\Categoria::find($categoryId);
        return $category ? $category->categoria_detalle : 'Desconocido';
    }
}
