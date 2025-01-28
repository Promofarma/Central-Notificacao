<?php

declare(strict_types=1);

use App\Enums\ScheduleResultStatus;
use App\Models\NotificationSchedule;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('notification_schedule_results', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(NotificationSchedule::class)->constrained()->cascadeOnDelete();
            $table->uuid('notification_uuid')->nullable();
            $table->date('scheduled_at');
            $table->string('status')->default(ScheduleResultStatus::Pending);
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_schedule_results');
    }
};
