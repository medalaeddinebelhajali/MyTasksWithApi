<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Task::count() > 0) {
            return;
        }

        $initialTasks = [
            [
                'title' => 'Préparer la présentation',
                'description' => 'Réaliser les diapositives pour la présentation du projet.',
                'priority' => 'Élevée',
                'status' => 'À faire',
                'created_at' => Carbon::createFromFormat('d/m/Y', '12/04/2025'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', '12/04/2025'),
            ],
            [
                'title' => 'Répondre aux emails',
                'description' => 'Répondre aux emails urgents des clients et de l’équipe.',
                'priority' => 'Moyenne',
                'status' => 'À faire',
                'created_at' => Carbon::createFromFormat('d/m/Y', '12/04/2025'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', '12/04/2025'),
            ],
            [
                'title' => 'Lire la documentation',
                'description' => 'Consulter la documentation officielle de React Navigation et Laravel REST API.',
                'priority' => 'Faible',
                'status' => 'Terminée',
                'created_at' => Carbon::createFromFormat('d/m/Y', '11/04/2025'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', '11/04/2025'),
            ],
            [
                'title' => 'Développer la fonctionnalité',
                'description' => 'Implémenter le filtre et la barre de recherche sur la liste des tâches.',
                'priority' => 'Élevée',
                'status' => 'À faire',
                'created_at' => Carbon::createFromFormat('d/m/Y', '13/04/2025'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', '13/04/2025'),
            ],
        ];

        Task::insert($initialTasks);
    }
}
