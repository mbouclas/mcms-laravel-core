<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('item_id')->unsigned()->nullable()->index();
            $table->string('model')->nullable();
            $table->string('slug_pattern');
            $table->string('permalink');
            $table->text('title');
            $table->string('link');
            $table->text('settings');
            $table->boolean('active');
            $table->boolean('sync');
            $table->integer('orderBy')->unsigned();
            $table->timestamps();
            NestedSet::columns($table);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_items');
    }
}
