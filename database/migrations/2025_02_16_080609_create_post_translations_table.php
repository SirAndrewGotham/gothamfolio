<?php

use App\Models\Language;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the post_translations table with its columns, indexes, and foreign key constraints.
     *
     * The table includes:
     * - id primary key
     * - post_id foreign key (cascade on delete)
     * - language_id nullable foreign key (restrict on delete)
     * - user_id nullable foreign key (restrict on delete)
     * - title, unique slug, nullable excerpt, body
     * - order integer defaulting to 0
     * - nullable image, published_at, published_through
     * - status enum (Published, Draft, Pending, Rejected) defaulting to 'Published'
     * - status_by nullable foreign key to users.id (on delete set null) and nullable status_note
     * - views unsigned big integer defaulting to 0
     * - created_at/updated_at timestamps and deleted_at for soft deletes
     */
    public function up(): void
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('post_translations');
    }
};
