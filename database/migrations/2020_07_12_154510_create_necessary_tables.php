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
        // userテーブル
        Schema::create(DatabaseGateway::TABLE_USER, function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->bigIncrements('id');
            // JMSから降ってくるuuidがハイフン抜きで、ハイフン有りからハイフン抜きの移行が比較的簡単だから。
            $table->string('uuid', 32);
            // mcidは16文字まで
            $table->string('name', 16);
            $table->unique('uuid');
        });
        
        Schema::create("shop_permission", function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->boolean('update')->default(false);
            $table->boolean('new')->default(false);
            $table->boolean('delete')->default(false);
        });
        
        Schema::create("nickname", function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->integer('user_id');
            $table->string('nickname');
            $table->unique('nickname');
        });
        
        // shopテーブル
        Schema::create(DatabaseGateway::TABLE_SHOP, function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->bigIncrements('id');
            $table->string('name', 255);
            // ダブリは紛らわしいから禁止！
            $table->unique('name');
            // shops.owner <-> users.id
            // $table->foreign('owner')->references('id')->on('users');
        });
        
        Schema::create("transactions", function (Blueprint $table) {
            $table->id();
            $table->integer("chain_id");
            $table->integer('user_id');
            $table->integer('quantity');
        });
        
        Schema::create("transactions_chain", function(Blueprint $table){
            $table->id();
            $table->integer('reason');
            $table->date('date');
        });
        
        Schema::create('transactions_reason', function(Blueprint $table){
            $table->id();
            $table->string('stringify', 512);
        });
        
        Schema::create('auction_bid', function(Blueprint $table){
            $table->id();
            $table->integer('chain_id');
            $table->integer('user_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->string('stringify', 512);
        });
        
        Schema::create('auction_chain', function(Blueprint $table){
            $table->id();
            $table->integer('reason');
            $table->date('date');
        });
        
        Schema::create('auction_reason', function(Blueprint $table){
            $table->id();
            $table->string('stringify', 512);
        });
        
        Schema::create('bank', function(Blueprint $table) {
            $table->integer('user_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->primary(['user_id', 'item_id']);
        });
        
        Schema::create('item', function(Blueprint $table)) {
            $table->id();
            $table->string('stringify', 4096);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $x = [DatabaseGateway::TABLE_USER, DatabaseGateway::TABLE_SHOP];
        
        Schema::dropIfExists(DatabaseGateway::TABLE_USER);
        Schema::dropIfExists(DatabaseGateway::TABLE_SHOP);
    }
}
