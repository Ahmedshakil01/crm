<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',150)->nullable();
            $table->string('contact',100)->nullable();
            $table->string('username',100)->unique()->nullable();
            $table->string('email',150)->unique()->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('division');
            $table->foreign('division')
                ->references('id')
                ->on('divisions');
            $table->unsignedBigInteger('district');
            $table->foreign('district')
                ->references('id')
                ->on('districts');
            $table->unsignedBigInteger('area');
            $table->foreign('area')
                ->references('id')
                ->on('areas');
            $table->string('zipcode',50)->nullable();
            $table->string('type',100)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('photo',250)->nullable();
            $table->text('password')->nullable();
            $table->rememberToken();
            $table->string('provider',250)->nullable();
            $table->string('provider_id',250)->nullable();
            $table->string('device',250)->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('token',250)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
