<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('postby',150)->nullable();
            $table->date('publishdate')->nullable();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->longText('details')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('sequence')->default(0);
            $table->text('meta_description')->nullable();
            $table->text('keywords')->nullable();
            $table->date('entry_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
