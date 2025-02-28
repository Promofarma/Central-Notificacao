<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('notification_schedule_results', function (Blueprint $table): void {
            $table->time('shipping_at')->after('scheduled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('notification_schedule_results', function (Blueprint $table) {
            $table->dropColumn('shipping_at');
        });
    }
};
