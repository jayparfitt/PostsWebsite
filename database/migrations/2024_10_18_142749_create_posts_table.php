<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Defines the schema for the 'posts' table
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            /**
             * Foreign key referencing the 'modules' table
             * Ensures the foreign key constraint is applied
             * Deletes the post if the related module is deleted
             */
            $table->foreignId('module_id')->constrained()->onDelete('cascade');
            $table->string("title");
            $table->text('excerpt');
            $table->text("body");
            $table->string('image_path')->nullable();
            /**
             * Foreign key referencing the 'users' table
             * Ensures the foreign key constraint is applied
             * Deletes the post if the related user is deleted
             */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
