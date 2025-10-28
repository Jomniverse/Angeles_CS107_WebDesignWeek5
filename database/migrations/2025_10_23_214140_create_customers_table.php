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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();   //primary key, auto_increment
            $table->string('username', 30)->unique();
            $table->string('email', 30)->unique();
            $table->string('password_hash', 255);
            $table->string('first_name', 30); //snake case
            $table->string('last_name', 30);
            $table->date('date_of_birth')->nullable();
            $table->text('address'); //full address
            $table->string('phone_number', 25)->nullable();
            $table->softDeletes(); //deleted_at
            $table->timestamps(); //created_at update_at

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
