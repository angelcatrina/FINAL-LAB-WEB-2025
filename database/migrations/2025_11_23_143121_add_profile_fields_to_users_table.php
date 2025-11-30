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
    Schema::table('users', function (Blueprint $table) {
        $table->string('avatar_path')->nullable();
        $table->string('display_name')->nullable();
        $table->text('bio')->nullable();
        $table->string('website_url')->nullable();
        $table->string('instagram_url')->nullable();
        $table->string('behance_url')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['avatar_path', 'display_name', 'bio', 'website_url', 'instagram_url', 'behance_url']);
    });
}
};
