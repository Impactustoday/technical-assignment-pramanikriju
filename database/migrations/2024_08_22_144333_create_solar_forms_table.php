<?php

use App\Enums\StatusEnum;
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
        Schema::create('solar_forms', function (Blueprint $table) {
            $table->id();
            $table->boolean('hasSolar')->default(false);
            $table->unsignedInteger('panel_count');
            $table->string('status')->default(StatusEnum::UNQUALIFIED->value); //Assumed unqualified by default, only changes when the panel_count > 5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_forms');
    }
};
