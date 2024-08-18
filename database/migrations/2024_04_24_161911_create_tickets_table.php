<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->comment('Belongs to departments Table')->references('id')->on('departments');
            $table->string('contact_name', 100);
            $table->string('status', 20)->comment("Helpers status list");
            $table->string('email', 150)->comment('From email for incoming ticket')->nullable();
            $table->longText('description');
            $table->dateTime('ticket_sla_time')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
