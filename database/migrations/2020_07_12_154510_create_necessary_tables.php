<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Database\DatabaseGateway;
class CreateNecessaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DatabaseGateway::TABLE_USER, function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->bigIncrements('id');
            // JMSから降ってくるuuidがハイフン抜きで、ハイフン有りからハイフン抜きの移行が比較的簡単だから。
            $table->string('uuid', 32);
            // mcidは16文字まで
            $table->string('name', 16);
            $table->unique('uuid');
        });
        
        Schema::create(DatabaseGateway::TABLE_SHOP, function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->integer('owner');
            // ダブリは紛らわしいから禁止！
            $table->unique('name');
            // shops.owner <-> users.id
            // $table->foreign('owner')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseGateway::TABLE_USER);
        Schema::dropIfExists(DatabaseGateway::TABLE_SHOP);
    }
}
