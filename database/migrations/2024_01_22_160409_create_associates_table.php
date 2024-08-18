<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associatables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->comment('Belongs to users Table who are associates')->references('id')->on('departments');
            $table->unsignedBigInteger('associatable_id');
            $table->string('associatable_type')->comment('department and more');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associatables');
    }
}
