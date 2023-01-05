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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->float('price')->nullable();
            $table->string('payment_method', 100);
            $table->float('down_payment')->nullable();
            $table->float('paid_amount')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();

            // onDelete Cascade jika data di parent table (task) dihapus maka children table (payment) juga terhapus
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
        Schema::dropIfExists('payments');
    }
};
