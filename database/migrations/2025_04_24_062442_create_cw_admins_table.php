<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cw_admins', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('ipaddr');
            $table->string('activity');
            $table->string('type');
            $table->string('header');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cw_admins');
    }
};
