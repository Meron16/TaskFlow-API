<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->text('body');
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // commenter
        $table->foreignId('task_id')->constrained()->cascadeOnDelete(); // related task
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
