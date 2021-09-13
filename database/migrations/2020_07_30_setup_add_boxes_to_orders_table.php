<?php

namespace Thoughtco\Boxpacker\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoxesToOrdersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('orders', 'boxes'))
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->json('boxes')->nullable();
            });
        }
    }
}
