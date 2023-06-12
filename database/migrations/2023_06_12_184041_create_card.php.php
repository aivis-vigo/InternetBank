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
        Schema::create('bankCards', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('card_id');
            $table->float('balance');
        });

        /**
        if (Schema::hasColumn('bankCards', 'id')) {
            Schema::table('bankCards', function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }
         */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankCards');
    }
};
