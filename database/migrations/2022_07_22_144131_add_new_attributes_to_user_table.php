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
        Schema::table('users', function (Blueprint $table) {
            $table->after('id', function($table) {
                $table->enum('role', ['owner', 'admin', 'user'])->default('user');
            });
            $table->after('name', function($table) {
                $table->date('date_of_birth')->default('1000-01-01');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('role');
            $table->dropColumn('date_of_birth');
        });
    }
};
