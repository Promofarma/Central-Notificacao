<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('notification_schedules', function (Blueprint $table): void {
            $table->time('shipping_hour')->after('end_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('notification_schedules', function (Blueprint $table): void {
            $table->dropColumn('shipping_hour');
        });
    }
};
