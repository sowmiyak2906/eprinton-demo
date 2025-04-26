<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('print_calculations', function (Blueprint $table) {
            $table->id();
            $table->decimal('paper_width', 8, 2);
            $table->decimal('paper_height', 8, 2);
            $table->decimal('custom_width', 8, 2);
            $table->decimal('custom_height', 8, 2); 
            $table->string('orientation');
           
            $table->integer('total_copies');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('print_calculations');
    }
};
