<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('site')->nullable();
            $table->string('titre')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->mediumText('resume')->nullable();
            $table->longText('contenu')->nullable();
            $table->integer('view_count')->nullable();
            $table->integer('categorie_id')->nullable();
            $table->float('actif')->nullable();
            $table->integer('user_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activites');
    }
}
