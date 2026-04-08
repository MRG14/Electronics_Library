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
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // id

            $table->unsignedBigInteger('user_id'); // foreign key to users.id
            $table->unsignedBigInteger('category_id'); // foreign key to categories.id

            $table->string('slug', 255);
            $table->string('title', 255);
            $table->text('description');
            $table->string('image_path', 255);
            $table->string('file_path', 255);

            $table->enum('status', ['waiting approval', 'approved', 'rejected']);

            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('total_views')->default(0);

            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
