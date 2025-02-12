<?php

use App\Models\Language;
use App\Models\User;
use App\Models\Work;
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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Language::class)->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignIdFor(Work::class)->nullable()->constrained()->onDelete('SET NULL');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
