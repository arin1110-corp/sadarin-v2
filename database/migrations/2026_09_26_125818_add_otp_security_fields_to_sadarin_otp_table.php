<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sadarin_otp', function (Blueprint $table) {
            $table->timestamp('otp_sent_at')->nullable()->after('otp_expires_at');

            $table->timestamp('otp_locked_until')->nullable()->after('otp_attempt_count');

            $table->index('otp_sent_at', 'otp_sent_at_idx');

            $table->index('otp_locked_until', 'otp_locked_until_idx');
        });
    }

    public function down(): void
    {
        Schema::table('sadarin_otp', function (Blueprint $table) {
            $table->dropIndex('otp_sent_at_idx');
            $table->dropIndex('otp_locked_until_idx');

            $table->dropColumn(['otp_sent_at', 'otp_locked_until']);
        });
    }
};