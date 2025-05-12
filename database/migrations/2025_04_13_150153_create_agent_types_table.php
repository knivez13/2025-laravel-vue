<?php

use App\Models\Maintenance\AgentType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agent_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->uuid('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
        });

        AgentType::create([
            'code' => 'Super',
            'description' => 'Super',
        ]);

        AgentType::create([
            'code' => 'Senior',
            'description' => 'Senior',
        ]);
        AgentType::create([
            'code' => 'Master',
            'description' => 'Master',
        ]);
        AgentType::create([
            'code' => 'Agent',
            'description' => 'Agent',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_types');
    }
};
