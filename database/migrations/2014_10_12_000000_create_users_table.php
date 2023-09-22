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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); //not required when using OAuth
            $table->string('avatar')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->rememberToken(); // on login will update
            $table->timestamps(); //will create created_at & updated_at. These field will autofilled on addition/change
            $table->softDeletes(); // for deleted_at
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
