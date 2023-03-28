<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('uuid');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('is_admin');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->string('password');
            $table->boolean('is_marketing');
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();

            $table->index(['uuid'], 'INX_USERS_UUID');
            $table->index(['email', 'is_admin'], 'INX_USERS_AUTH');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
