<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('coins')) {
            Schema::create('coins', function (Blueprint $table) {
                $table->id();
                $table->integer('account_id');
                $table->string('symbol');
                $table->string('name');
                $table->string('price');
                $table->string('amount');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('coins');
    }
};
