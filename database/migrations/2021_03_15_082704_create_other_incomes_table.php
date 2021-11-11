<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')
                ->references('id')
                ->on('merchants')
                ->onDelete('cascade');
            $table->unsignedBigInteger('head_id');
            $table->foreign('head_id')
                ->references('id')
                ->on('income_heads')
                ->onDelete('cascade');
            $table->bigInteger('amount')->nullable();
            $table->string('amount_in_word',200)->nullable();
            $table->string('received_by',150)->nullable();
            $table->text('remarks')->nullable();
            $table->date('received_date')->nullable();
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
        Schema::dropIfExists('other_incomes');
    }
}
