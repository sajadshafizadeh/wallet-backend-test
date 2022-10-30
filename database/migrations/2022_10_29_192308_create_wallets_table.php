<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['deposit', 'withdraw', 'reward', 'payment'])->comment('Sample types');
            $table->decimal('amount', $precision = 15, $scale = 2)->comment('IRT Currency');
            $table->decimal('tracking_code', $precision = 15, $scale = 0)->comment('Always 15 digits');
            $table->timestamps();

            // Indexe(s)
            $table->unique(['tracking_code']);

            // Foreign Key(s)
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
