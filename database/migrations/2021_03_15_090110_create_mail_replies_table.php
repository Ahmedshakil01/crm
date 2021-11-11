<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mail_id');
            $table->foreign('mail_id')
                    ->references('id')
                    ->on('mailboxes');
            $table->string('tomail',50)->nullable();
            $table->mediumText('description')->nullable();
            $table->string('sender_type',50)->nullable();
            $table->string('receiver_type',50)->nullable();
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
        Schema::dropIfExists('mail_replies');
    }
}
