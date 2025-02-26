<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('prestadores', function (Blueprint $table) {
            $table->dropColumn(['crm']);
        });

    }

    public function down()
    {
        Schema::table('prestadores', function (Blueprint $table) {
            $table->string('crm', 20)->nullable();
        });
    }
};
