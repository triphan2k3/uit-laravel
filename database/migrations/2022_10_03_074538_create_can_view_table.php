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
        Schema::create('can_view', function (Blueprint $table) {
            $table->foreignId('player_id')->constrained('users');
            $table->foreignId('viewer_id')->constrained('users');
            $table->foreignId('match_id')->constrained('matches');
            $table->primary(['player_id', 'viewer_id', 'match_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('can_view');
    }
};
