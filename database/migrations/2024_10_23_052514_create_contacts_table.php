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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('office_no');
            $table->string('phone_number');
            $table->string('email');
            $table->string('main_office_name');
            $table->string('nat_branch_office');
            $table->string('inter_branch_office');
            $table->float("latitude",20, 20);
            $table->float("longitude",20, 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
