<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password_hash');
            $table->string('nickname');
            $table->enum('type', [1, 2])->default(1)->comment('1:总 2：散');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->enum('disabled', [-1, 1])->default(-1)->comment('-1：不禁用  1:禁用');
            $table->timestamp('created_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        \Illuminate\Support\Facades\DB::table('admin')->insert([
            'username' => "root",
            'nickname' => 'SuperRoot',
            'password_hash' => bcrypt('root@lg'),
            'created_by' => 0,
            'updated_by' => 0,
            'type' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'disabled' => '-1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
