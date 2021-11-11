<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')
                    ->references('id')
                    ->on('customers');
            $table->string('subject',250)->nullable();
            $table->string('tomail',50)->nullable();
            $table->string('slug',250)->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('read_count')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->string('mailtype',50)->nullable();
            $table->string('sender_type',50)->nullable();
            $table->string('receiver_type',50)->nullable();
            $table->string('status',50)->nullable();
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
        Schema::dropIfExists('mailboxes');
    }
}
