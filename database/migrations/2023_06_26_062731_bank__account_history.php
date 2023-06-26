<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('accountHistory')) {
            Schema::create('accountHistory', function (Blueprint $table) {
                $table->id();
                $table->integer('account_id');
                $table->string('transaction_name');
                $table->bigInteger('transaction_amount');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('accountHistory');
    }
};
