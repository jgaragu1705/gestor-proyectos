<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Crear o actualizar usuarios de prueba
        $ana = User::updateOrCreate(
            ['email' => 'ana@example.com'],
            [
                'name' => 'Ana',
                'password' => 'password',
            ]
        );

        $carlos = User::updateOrCreate(
            ['email' => 'carlos@example.com'],
            [
                'name' => 'Carlos',
                'password' => 'password',
            ]
        );

        $laura = User::updateOrCreate(
            ['email' => 'laura@example.com'],
            [
                'name' => 'Laura',
                'password' => 'password',
            ]
        );

        $diego = User::updateOrCreate(
            ['email' => 'diego@example.com'],
            [
                'name' => 'Diego',
                'password' => 'password',
            ]
        );

        // Crear o actualizar proyectos
        $proyecto1 = Project::updateOrCreate(
            [
                'title' => 'Aplicación web',
                'user_id' => $ana->id,
            ],
            [
                'description' => 'Desarrollo de una aplicación web',
                'deadline' => today()->addDays(15),
                'status' => 'en progreso',
            ]
        );

        $proyecto2 = Project::updateOrCreate(
            [
                'title' => 'Tienda online',
                'user_id' => $carlos->id,
            ],
            [
                'description' => 'Creación de una tienda online',
                'deadline' => today()->addDays(30),
                'status' => 'pendiente',
            ]
        );

        $proyecto3 = Project::updateOrCreate(
            [
                'title' => 'Gestión de tareas',
                'user_id' => $laura->id,
            ],
            [
                'description' => 'Aplicación para gestionar tareas',
                'deadline' => today()->subDays(10),
                'status' => 'finalizado',
            ]
        );

        $proyecto4 = Project::updateOrCreate(
            [
                'title' => 'Rediseño de plataforma',
                'user_id' => $ana->id,
            ],
            [
                'description' => 'Actualización del diseño y la experiencia de usuario de la plataforma',
                'deadline' => today()->subDay(),
                'status' => 'pendiente',
            ]
        );

        $proyecto5 = Project::updateOrCreate(
            [
                'title' => 'Documentación interna',
                'user_id' => $carlos->id,
            ],
            [
                'description' => null,
                'deadline' => today()->addDays(45),
                'status' => 'pendiente',
            ]
        );

        // Asignar participantes y sus contribuciones
        $proyecto1->members()->sync([
            $carlos->id => [
                'role' => 'Tester',
                'contribution_hours' => 10,
            ],
            $laura->id => [
                'role' => 'Desarrollador',
                'contribution_hours' => 20,
            ],
        ]);

        $proyecto2->members()->sync([
            $ana->id => [
                'role' => 'Diseñador',
                'contribution_hours' => 15,
            ],
        ]);

        $proyecto3->members()->sync([
            $ana->id => [
                'role' => 'Tester',
                'contribution_hours' => 8,
            ],
        ]);

        $proyecto4->members()->sync([
            $carlos->id => [
                'role' => 'Diseñador',
                'contribution_hours' => 12.5,
            ],
            $laura->id => [
                'role' => 'Tester',
                'contribution_hours' => 6,
            ],
        ]);

        // El proyecto 5 no tiene participantes.
        $proyecto5->members()->sync([]);

        // Diego se mantiene sin proyectos ni participaciones.
    }
}
