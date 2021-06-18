<?php

use Domain\Catalog\Entities\CatalogCategory;
use Domain\Catalog\Entities\CatalogCategoryTranslation;
use Illuminate\Database\Seeder;

class CatalogCategorySeeder extends Seeder
{
    public function run()
    {
        if (! \App::environment(['production'])) {
            factory(CatalogCategory::class, 50)->create()->each(function ($category) {
                $category->translations()->saveMany(factory(CatalogCategoryTranslation::class, 1)->make());
            });
        }
    }
}
