<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->boolean('design')->nullable();
            $table->boolean('print')->nullable();
            $table->timestamps();

            // onDelete Cascade jika data di parent table (task) dihapus maka children table (progress) juga terhapus
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
};
