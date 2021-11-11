<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrations', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',150)->nullable();
            $table->string('contact',100)->nullable();
            $table->string('username',100)->unique()->nullable();
            $table->string('email',150)->unique()->nullable();
            $table->string('designation',150)->nullable();
            $table->text('address')->nullable();
            $table->string('photo',250)->nullable();
            $table->text('password')->nullable();
            $table->rememberToken();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('administrations');
    }
}
