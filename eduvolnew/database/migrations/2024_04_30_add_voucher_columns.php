<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->string('code', 50)->unique()->after('id');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('code');
            $table->boolean('is_active')->default(true)->after('discount_amount');
        });
    }

    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn(['code', 'discount_amount', 'is_active']);
        });
    }
}; 