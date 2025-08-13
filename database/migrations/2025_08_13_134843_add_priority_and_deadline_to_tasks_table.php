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
    Schema::table('tasks', function (Blueprint $table) {
        $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
        $table->date('due_date')->nullable();
    });
}

public function down()
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropColumn(['priority', 'due_date']);
    });
}

    /**
     * Reverse the migrations.
     */

};
