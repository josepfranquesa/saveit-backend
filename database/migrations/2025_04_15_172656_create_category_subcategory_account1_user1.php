<?php
use App\Models\Account;
use App\Models\AccountSubcategory;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::create([
            'name' => 'Josep Franquesa Bosch',
            'email' => 'josepfranquesa17@gmail.com',
            'phone' => '619686282',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Account::create([
            'id' => 1,
            'host' => 1,
            'balance' => 4000,
            'title' => 'Cuenta principal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Account::create([
            'id' => 2,
            'host' => 1,
            'title' => 'Cuenta ahorro',
            'balance' => 1000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Account::create([
            'id' => 3,
            'host' => 1,
            'balance' => 8000,
            'title' => 'Cuenta pareja',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        UserAccount::create([
            'user_id' => 1,
            'account_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        UserAccount::create([
            'user_id' => 1,
            'account_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        UserAccount::create([
            'user_id' => 1,
            'account_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'name' => 'Nomina',
            'type' => 'Ingreso',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        AccountSubcategory::create([
            'account_id' => 1,
            'category_id' => 1,
            'subcategory_id' => 1,
        ]);

        Category::create([
            'name' => 'Compres',
            'type' => 'Despesa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        AccountSubcategory::create([
            'account_id' => 1,
            'category_id' => 2,
            'subcategory_id' => 2,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
