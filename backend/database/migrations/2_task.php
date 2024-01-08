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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('t_title');
            $table->string('t_description');
            $table->integer('t_status')->default(0);
            $table->integer('t_assignedto')->references('id')->on('users')->default(0);
            $table->string('t_assignedtoname')->default('Unassigned');
            $table->integer('t_assignedby')->references('id')->on('users')->default(0);
            $table->string('t_assignedbyname')->default(0);
            $table->string('t_remarks')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
