<?php

namespace Thoughtco\Boxpacker\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDimensionsToMenusTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('menus', 'dimensions'))
        {
            Schema::table('menus', function (Blueprint $table) {
                $table->json('dimensions')->nullable();
            });
        }
    }
}
