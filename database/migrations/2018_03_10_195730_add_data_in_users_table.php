<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->integer('phone_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users' ,'surname')) {
                $table->dropColumn('surname');
            }
            if (Schema::hasColumn('users' ,'patronymic')) {
                $table->dropColumn('patronymic');
            }
            if (Schema::hasColumn('users' ,'phone_number')) {
                $table->dropColumn('phone_number');
            }
        });
    }
}
