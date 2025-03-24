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
        schema::create('notes', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('comment');
            $table->float('note');

            $table->foreignId('team_id')->constrained('teams');
            $table->foreignId('member_id')->constrained('membrejuries');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::drop('notes');
    }
};
