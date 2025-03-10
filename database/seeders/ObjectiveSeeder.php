<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Account;
use App\Models\Objective;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener todas las relaciones válidas de useraccount
        $validUserAccounts = DB::table('useraccount')->get();

        if ($validUserAccounts->count() == 0) {
            return; // No creamos objetivos si no hay relaciones válidas en useraccount
        }

        // Crear 5 objetivos aleatorios para combinaciones válidas de useraccount
        for ($i = 0; $i < 5; $i++) {
            $relation = $validUserAccounts->random(); // Selecciona una relación válida

            Objective::create([
                'user_id' => $relation->user_id,
                'account_id' => $relation->account_id,
                'type' => ['GOAL', 'LIMIT'][array_rand(['GOAL', 'LIMIT'])],
                'amount' => rand(100, 5000),
            ]);
        }
    }
}
