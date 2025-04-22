<?php

use App\Models\Gallery;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->restrictOnDelete();
            $table->foreignIdFor(Gallery::class)->nullable()->constrained()->restrictOnDelete();
            $table->boolean('is_cover')->default(false);
            $table->string('image');
            $table->string('caption')->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('published_through')->nullable();
            $table->enum('status', ['Published', 'Draft', 'Pending', 'Rejected'])->default('Published');
            $table->unsignedBigInteger('order')->default(0);
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
        Schema::dropIfExists('images');
    }
};
