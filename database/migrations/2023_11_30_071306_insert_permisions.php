<?php

use App\Helpers\Helper;
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
        Helper::createPermissions();
        Helper::createRoles();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
