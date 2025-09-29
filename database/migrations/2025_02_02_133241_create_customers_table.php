<?php

use App\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `customers` table with its columns and constraints.
     *
     * The table includes:
     * - `id`: auto-incrementing primary key.
     * - Optional foreign key to `languages` with delete restricted.
     * - `label`: string.
     * - `description`: text.
     * - `image`: nullable string.
     * - `published_at`: nullable timestamp.
     * - `created_at` and `updated_at` timestamps.
     * - `deleted_at` soft delete timestamp.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Language::class)->nullable()->constrained()->restrictOnDelete();
            $table->string('label');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
