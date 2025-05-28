<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::table('schools', function (Blueprint $table) {
        $table->string('img_school')->nullable()->after('description');
    });
}

public function down()
{
    Schema::table('schools', function (Blueprint $table) {
        $table->dropColumn('img_school');
    });
}

};
