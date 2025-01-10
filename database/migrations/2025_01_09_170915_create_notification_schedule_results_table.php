<?php

declare(strict_types=1);

use App\Models\NotificationSchedule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_schedule_results', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(NotificationSchedule::class)->constrained()->cascadeOnDelete();
            $table->date('scheduled_at');
            $table->boolean('is_created')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_schedule_results');
    }
};
