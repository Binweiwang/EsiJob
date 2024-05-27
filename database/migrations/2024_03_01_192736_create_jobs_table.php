<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('employer_id');
            $table->string('title');
            $table->string('requirements');
            $table->string('description');
            $table->string('salary');
            $table->timestamp('publication_date')->nullable();
            $table->string('state');
            $table->string('location');
            $table->boolean('is_deleted')->default(false);
            $table->string('workday');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
