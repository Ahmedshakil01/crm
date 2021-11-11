<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
            $table->string('fullname',150)->nullable();
            $table->string('contact',50)->nullable();
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
            $table->tinyInteger('set_as_default')->nullable();
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
        Schema::dropIfExists('customer_addresses');
    }
}
