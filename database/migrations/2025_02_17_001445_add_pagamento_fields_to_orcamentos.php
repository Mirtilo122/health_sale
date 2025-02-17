<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->text('cond_pagamento_anestesista')->nullable();
            $table->text('cond_pagamento_cirurgiao')->nullable();
            $table->text('cond_pagamento_hosp')->nullable();
            $table->timestamp('validade')->nullable();

        });
    }

    public function down()
    {
        Schema::table('orcamentos', function (Blueprint $table) {
            $table->dropColumn(['cond_pagamento_anestesista', 'cond_pagamento_cirurgiao', 'cond_pagamento_hosp']);
        });
    }
};
