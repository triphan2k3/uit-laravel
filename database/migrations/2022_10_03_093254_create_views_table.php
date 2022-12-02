<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->foreignId('match_id')->constrained();
            $table->foreignId('inviter_id')->constrained('users');
            $table->foreignId('invited_id')->constrained('users');
            $table->timestamps();
            $table->primary(['match_id', 'inviter_id', 'invited_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('views');
    }
};
