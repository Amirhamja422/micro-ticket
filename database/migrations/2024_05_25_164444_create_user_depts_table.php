<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_depts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('Belongs to user Table')->references('id')->on('users');
            $table->foreignId('department_id')->comment('Belongs to departments Table')->references('id')->on('departments');
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
        Schema::dropIfExists('user_depts');
    }
}
