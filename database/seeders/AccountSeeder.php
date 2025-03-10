<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    public function run()
    {
        // Creamos algunas cuentas manualmente
        $accounts = [
            [
                'title' => 'Cuenta Personal',
                'host' => 1,
                'balance' => 1500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cuenta de Ahorros',
                'host' => 1,
                'balance' => 5000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($accounts as $accountData) {
            $account = Account::create($accountData);

            DB::table('useraccount')->insert([
                'user_id' => 1,
                'account_id' => $account->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
