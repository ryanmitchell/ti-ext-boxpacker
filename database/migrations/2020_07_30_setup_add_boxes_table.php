<?php

namespace Thoughtco\Boxpacker\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoxesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('thoughtco_boxes'))
        {
            Schema::create('thoughtco_boxes', function (Blueprint $table) {
                $table->increments('id');
                $table->text('label');
                $table->json('dimensions')->nullable();
                $table->boolean('is_enabled');
                $table->timestamps();
            });
        }
    }
    
    public function down()
    {
        Schema::dropIfExists('thoughtco_boxes');
    }
}
