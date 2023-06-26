<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bankAccounts')) {
            Schema::create('bankAccounts', function (Blueprint $table) {
                $table->id();
                $table->integer('account_id');
                $table->bigInteger('balance');
                $table->string('IBAN');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bankAccounts');
    }
};
