<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagsToCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categorias', function (Blueprint $table) {
            if(Schema::hasColumn('categorias', 'categoria_id')){
                $table->boolean('is_parent_category')->after('categoria_id')->default(false);
                $table->boolean('is_leaf_category')->after('is_parent_category')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropColumn('is_parent_category');
            $table->dropColumn('is_leaf_category');
        });
    }
}
