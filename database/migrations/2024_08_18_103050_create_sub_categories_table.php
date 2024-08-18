<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->comment('Belongs to Category Table')->references('id')->on('sub_categories');
            $table->string('sub_cat_name');
            $table->enum('is_active', [0, 1])->default(1)->comment('active = 1, deactive = 0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *s
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
