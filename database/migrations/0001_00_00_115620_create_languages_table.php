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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->boolean('default')->default(false);
            $table->boolean('fallback')->default(false);
            $table->string('code')->unique()->index();
            $table->string('regional')->nullable();
            $table->string('script')->nullable();
            $table->string('dir')->nullable();
            $table->string('flag')->nullable();
            $table->string('name');
            $table->string('english');
            $table->string('slug')->unique()->index();
            $table->boolean('is_available')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
