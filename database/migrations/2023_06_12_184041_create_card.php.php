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
        if (!Schema::hasTable('bankCards')) {
            Schema::create('bankCards', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->float('balance')->nullable();
                $table->bigInteger('card_number');
                $table->string('expires_at');
                $table->string('cvc');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankCards');
    }
};
