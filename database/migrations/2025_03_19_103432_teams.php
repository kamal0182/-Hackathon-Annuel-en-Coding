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
        schema::create('teams', function(Blueprint $table)
        {
            $table->id() ;
            $table->string('name');

            $table->foreignId('hackathon_id')->constrained('hackathons');
            $table->foreignId('jury_id')->constrained('jurys');
            $table->foreignId('creator_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('teams');
    }
};
