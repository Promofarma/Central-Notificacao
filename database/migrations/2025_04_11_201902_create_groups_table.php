<?php

use App\Enums\GroupStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 60);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('status', array_column(GroupStatus::cases(), 'value'))->default(GroupStatus::ACTIVE);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
