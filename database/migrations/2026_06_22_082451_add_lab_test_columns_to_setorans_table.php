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
    Schema::table('setorans', function (Blueprint $table) {
        $table->decimal('kadar_air', 5, 2)->nullable()->after('harga_dibayar'); // dalam %
        $table->decimal('ffa', 5, 2)->nullable()->after('kadar_air');       // Free Fatty Acid %
        $table->decimal('kotoran', 5, 2)->nullable()->after('ffa');       // Impurities %
        $table->string('grade')->nullable()->after('kotoran');            // Grade A, B, C, Reject
    });
}

public function down(): void
{
    Schema::table('setorans', function (Blueprint $table) {
        $table->dropColumn(['kadar_air', 'ffa', 'kotoran', 'grade']);
    });
}
};
