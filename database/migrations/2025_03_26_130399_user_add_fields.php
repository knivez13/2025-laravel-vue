<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        $admin = [
            'ShowDashboard',

            'ShowMaintenance',
            'CanAddMaintenance',
            'CanEditMaintenance',

            'ShowDataLogs',
            'Delete',
            'Restore',
        ];

        foreach ($admin as $u) {
            Permission::create(['name' => $u]);
        }

        $user = User::create([
            // 'emp_id' => 'SA-001',
            'name' => 'Bonjour',
            // 'middle_name' => 'Lopez',
            // 'last_name' => 'De Guzman',
            'email' => 'bonjourdeguzman@gmail.com',
            // 'contact_no' => '09666594533',
            // 'status' => 1,
            'password' => Hash::make('password'),
        ]);
        $role = Role::create(['name' => 'SystemAdmin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole('SystemAdmin');
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_created_by_foreign');
            $table->dropForeign('users_updated_by_foreign');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
