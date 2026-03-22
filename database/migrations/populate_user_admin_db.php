<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $token = Str::random(60);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'pmrmagma@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => $token,
            'isAdmin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $filePath = dirname(__DIR__) . '/adminToken.txt';
        file_put_contents($filePath, $token);

        // Output the remember_token to the console
        echo "\nAdmin user created. Remember token: $token\n";


    }

    public function down(): void
    {
        DB::table('users')->where('email', 'pmrmagma@gmail.com')->delete();
    }
};
