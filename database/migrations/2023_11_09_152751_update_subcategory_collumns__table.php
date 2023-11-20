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

        if (!Schema::hasColumn('sub_categories', 'image')) {

            Schema::table('sub_categories', function (Blueprint $table) {
           
                $table->longText('image');
              
            });
        }
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
