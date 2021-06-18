<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('catalog_category_id')->nullable();
            $table->string('locale')->index();

            $table->string('name')->nullable();
            $table->text('desc')->nullable();

            $table->unique(['catalog_category_id', 'locale']);
            $table->foreign('catalog_category_id')
                ->references('id')
                ->on('catalog_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_category_translations');
    }
}
