<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuarios
        $ana = User::create([
            'name' => 'Ana',
            'email' => 'ana@gmail.com',
            'password' => 'password'
        ]);

        $carlos = User::create([
            'name' => 'Carlos',
            'email' => 'carlos@gmail.com',
            'password' => 'password'
        ]);

        $laura = User::create([
            'name' => 'Laura',
            'email' => 'laura@gmail.com',
            'password' => 'password'
        ]);


        // Crear proyectos
        $proyecto1 = Project::create([
            'title' => 'Aplicación web',
            'description' => 'Desarrollo de una aplicación web',
            'deadline' => '2026-12-15',
            'status' => 'en progreso',
            'user_id' => $ana->id
        ]);

        $proyecto2 = Project::create([
            'title' => 'Tienda online',
            'description' => 'Creación de una tienda online',
            'deadline' => '2027-01-20',
            'status' => 'pendiente',
            'user_id' => $carlos->id
        ]);

        $proyecto3 = Project::create([
            'title' => 'Gestión de tareas',
            'description' => 'Aplicación para gestionar tareas',
            'deadline' => '2027-02-10',
            'status' => 'finalizado',
            'user_id' => $laura->id
        ]);


        // Añadir participantes
        $proyecto1->members()->attach($carlos->id, [
            'role' => 'Tester',
            'contribution_hours' => 10
        ]);

        $proyecto1->members()->attach($laura->id, [
            'role' => 'Desarrollador',
            'contribution_hours' => 20
        ]);

        $proyecto2->members()->attach($ana->id, [
            'role' => 'Diseñador',
            'contribution_hours' => 15
        ]);

        $proyecto3->members()->attach($ana->id, [
            'role' => 'Tester',
            'contribution_hours' => 8
        ]);
    }
}
