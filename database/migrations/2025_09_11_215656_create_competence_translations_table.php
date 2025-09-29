<?php

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `competence_translations` table with its columns, foreign keys, indexes, timestamps, and soft-delete column.
     *
     * The table includes:
     * - an auto-incrementing primary `id`
     * - a required foreign key to `competences` that cascades on delete
     * - nullable foreign keys to `languages` and `users` that restrict deletion
     * - `title`, unique `slug`, optional `excerpt`, and `body` fields
     * - integer `order` defaulting to 0
     * - optional `image`, `published_at`, and `published_through` timestamps
     * - `status` enum with values `Published`, `Draft`, `Pending`, `Rejected` (default `Published`)
     * - nullable `status_by` foreign key to `users(id)` that is set to null on user deletion
     * - optional `status_note`, unsigned big integer `views` defaulting to 0
     * - `created_at`/`updated_at` timestamps and `deleted_at` for soft deletes
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
            $table->integer('order')->default(0);
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
