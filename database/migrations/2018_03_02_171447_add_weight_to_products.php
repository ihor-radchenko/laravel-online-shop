<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeightToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('weight', 8, 3);
            $table->decimal('width');
            $table->decimal('height');
            $table->decimal('length');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products' ,'weight')) {
                $table->dropColumn('weight');
            }
            if (Schema::hasColumn('products' ,'width')) {
                $table->dropColumn('width');
            }
            if (Schema::hasColumn('products' ,'height')) {
                $table->dropColumn('height');
            }
            if (Schema::hasColumn('products' ,'length')) {
                $table->dropColumn('length');
            }
        });
    }
}
