<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id')
                    ->references('id')
                    ->on('divisions')
                    ->onDelete('cascade');
            $table->string('name',30)->nullable();
            $table->decimal('lat', 11, 8)->nullable()->comment('latitude');
            $table->decimal('lon', 11, 8)->nullable()->comment('longitude');;
            $table->string('website',100)->nullable();
            $table->tinyInteger('defaults')->nullable();
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
        Schema::dropIfExists('districts');
    }
}
