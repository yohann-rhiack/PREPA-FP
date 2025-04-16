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
        Schema::table('summaries', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_id')->after('course_id'); // Ajout de la colonne chapter_id après la colonne id
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('summaries', function (Blueprint $table) {
             // Suppression de la colonne test_id et de la contrainte de clé étrangère
             $table->dropForeign(['chapter_id']);
             $table->dropColumn('chapter_id');
        });
    }
};
