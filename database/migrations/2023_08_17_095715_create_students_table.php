<?php

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('matric_number')->unique();
            $table->string('name')->unique();
            $table->string('level')->unique();
            $table->string('semester')->unique();
            $table->foreignIdFor(User::class)->unique();
            $table->foreignIdFor(Department::class)->unique();
            $table->foreignIdFor(Faculty::class)->unique();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
