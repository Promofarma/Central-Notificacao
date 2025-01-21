<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('notification_recipients', function (Blueprint $table): void {
            $table->id();
            $table->uuid('notification_uuid');
            $table->unsignedBigInteger('recipient_id');
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('readed_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();

            $table->foreign('notification_uuid')->references('uuid')->on('notifications')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('recipients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_recipients');
    }
};
