<?php

use App\Models\Language;
use App\Models\User;
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
        Schema::create('competence_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Competence::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Language::class)->nullable()->restrictOnDelete();
            $table->foreignIdFor(User::class)->nullable()->restrictOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->string('image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('published_through')->nullable();
            $table->enum('status', ['Published', 'Draft', 'Pending', 'Rejected'])->default('Published');
            $table->foreignId('status_by')->nullable()->references('id')->on('users')->onDelete('SET NULL');
            $table->text('status_note')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_translations');
    }
};
