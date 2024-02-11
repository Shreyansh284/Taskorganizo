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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_id')->nullable(true);
            $table->unsignedBigInteger('label_id')->nullable(true);

            $table->string('task_name');
            $table->string('task_description')->nullable(true);
            $table->date('due_date')->nullable(true);
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')
            ->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('label_id')
            ->references('id')->on('labels')->onDelete('set null');
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
