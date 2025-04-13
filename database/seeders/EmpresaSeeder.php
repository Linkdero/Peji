<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empresa;
use App\Models\EmpresaCorreo;
use App\Models\EmpresaDireccion;
use App\Models\EmpresaTelefono;
use App\Models\EmpresaRedSocial;
use App\Models\EmpresaHorario;
class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear empresa principal
        $empresa = Empresa::create([
            'empresa_nombre' => 'D’Ventu',
            'empresa_detalle' => 'Somos una empresa con más de 15 años de experiencia, enfocada en Brindarle a cada no de nuestros clientes, la tranquilidad y confianza de Contar con un aliado en la planificación, organización y decoración de Sus eventos; en donde la ética, la responsabilidad y el compromiso son Cruciales para el éxito de esos momentos importantes tanto a nivel Personal como empresarial. Nuestro enfoque nos permite ajustarnos al Gusto y presupuesto de nuestros clientes sin sacrificar el gusto y la Experiencia del evento.',
            'empresa_logo' => 'logo.webp',
        ]);

        // Teléfonos
        EmpresaTelefono::create([
            'id_empresa' => $empresa->id_empresa,
            'telefono_detalle' => '+(502) 2363-6470',
        ]);

        // Direcciones
        EmpresaDireccion::create([
            'id_empresa' => $empresa->id_empresa,
            'direccion_detalle' => '5a. Avenida 18-96 Zona 14.',
            'iframe_mapa' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.4001430366866!2d-90.52344652405934!3d14.576260577670373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8589a3fb5426273f%3A0x99cfa6ce442a4147!2s5%20Avenida%201896%2C%20Cdad.%20de%20Guatemala!5e0!3m2!1ses-419!2sgt!4v1744563912614!5m2!1ses-419!2sgt" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);

        // Correos
        EmpresaCorreo::create([
            'id_empresa' => $empresa->id_empresa,
            'correo_detalle' => 'info@carlosdubon.com',
        ]);

        // Horarios (ejemplo para todos los días)
        $dias = range(1, 7); // IDs de días del 1 al 7
        foreach ($dias as $dia) {
            EmpresaHorario::create([
                'id_empresa' => $empresa->id_empresa,
                'id_dia' => $dia,
                'hora_inicio' => '09:00:00',
                'hora_final' => '18:00:00',
            ]);
        }

        // Redes sociales (ejemplo con algunas redes)
        $redes = [1, 2, 6]; // IDs de redes sociales
        foreach ($redes as $red) {
            EmpresaRedSocial::create([
                'id_empresa' => $empresa->id_empresa,
                'id_red_social' => $red,
                'link' => "https://www.instagram.com/dventusgt",
            ]);
        }
    }
}
