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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('user_add_id')->nullable();
            $table->string('image')->nullable(); //  هنا أضفناه
            // $table->foreignId('parent_id')->nullable()->constrained('sections')->nullOnDelete();
            $table->timestamps();
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('set null');
            $table->foreign('user_add_id')->references('id')->on('users')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
