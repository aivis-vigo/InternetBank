<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('cardHistory')) {
            Schema::create('cardHistory', function (Blueprint $table) {
                $table->id();
                $table->integer('card_id');
                $table->string('transaction_name');
                $table->bigInteger('transaction_amount');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardHistory');
    }
};
