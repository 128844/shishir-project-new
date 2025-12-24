<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade');

            $table->foreignId('seeker_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->enum('status', ['applied', 'shortlisted', 'rejected', 'hired'])
                ->default('applied');

            $table->timestamp('applied_at')->useCurrent();
            $table->string('resume_url')->nullable();

            $table->timestamps();

            // Prevent duplicate application
            $table->unique(['job_id', 'seeker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
