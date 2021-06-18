<?php

namespace App\Domain\Catalog\Services;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Domain\Catalog\Entities\Product;
use App\Domain\Core\Interfaces\ServiceInterface;

class ProductService implements ServiceInterface
{
    private $products;

    private $sortable = [
        'id',
        'active',
        'rank',
        'price',
        'in_stock',
        'created_at',
        'updated_at',
    ];

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function findAll(array $filter)
    {
        $products = $this->products;

        if (isset($filter['category_id'])) {
            $category_id = $filter['category_id'];
            $products = $products->where('catalog_category_id', $category_id);
        }

        if (isset($filter['search_text'])) {
            $search = $filter['search_text'];
            $products = $products->whereTranslationLike('name', "%$search%")
                ->orWhereTranslationLike('desc', "%$search%");
        }

        if (array_key_exists('active', $filter)) {
            $products = $products->active(boolval($filter['active']));
        }

        return $products;
    }

    public function create(array $input)
    {
        return DB::transaction(function () use ($input) {
            $input['created_by'] = auth()->id();

            if (isset($input['active'])) {
                $input['active'] = boolval($input['active']);
            } else {
                $input['active'] = false;
            }

            $images = $input['images'] ?? [];
            unset($input['images']);

            $cover_image = $input['cover_image'] ?? null;
            unset($input['cover_image']);

            $translations = $input['translations'];
            unset($input['translations']);

            if ($product = Product::create($input)) {
                // Inserting associated translation's id in mapper table
                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc'] || $values['meta_title'] || $values['meta_description'] || $values['meta_keywords']) {
                            $product->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'name' => $values['name'],
                                    'desc' => $values['desc'],
                                    'meta_title' => $values['meta_title'],
                                    'meta_description' => $values['meta_description'],
                                    'meta_keywords' => $values['meta_keywords'],
                                ],
                            ]);
                        }
                    }
                }

                if ($cover_image) {
                    $product->album->setImageAsCover($cover_image);
                }

                if (count($images)) {
                    foreach ($images as $image) {
                        $product->album->addImage($image);
                    }
                }

                return $product;
            }

            throw new GeneralException(__('exceptions.backend.products.create_error'));
        });
    }

    public function update(Product $product, array $input)
    {
        $input['updated_by'] = auth()->id();

        $translations = $input['translations'];
        unset($input['translations']);

        if (isset($input['active'])) {
            $input['active'] = boolval($input['active']);
        } else {
            $input['active'] = false;
        }

        $images = $input['images'] ?? [];
        unset($input['images']);

        $cover_image = $input['cover_image'] ?? null;
        unset($input['cover_image']);

        return DB::transaction(function () use ($product, $input, $translations, $cover_image, $images) {
            if ($product->update($input)) {
                if ($cover_image) {
                    $product->album->setImageAsCover($cover_image);
                }

                if (count($images)) {
                    foreach ($images as $image) {
                        $product->album->addImage($image);
                    }
                }

                $product->translations()->delete();

                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc'] || $values['meta_title'] || $values['meta_description'] || $values['meta_keywords']) {
                            $product->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'name' => $values['name'],
                                    'desc' => $values['desc'],
                                    'meta_title' => $values['meta_title'],
                                    'meta_description' => $values['meta_description'],
                                    'meta_keywords' => $values['meta_keywords'],
                                ],
                            ]);
                        }
                    }
                }

                return $product->fresh();
            }

            throw new GeneralException(__('exceptions.backend.products.update_error'));
        });
    }

    public function retrieveList(array $options)
    {
        $products = $this->findAll($options);

        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'rank';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'asc';
        $products = $products->active()->orderBy($orderBy, $order);

        return $products->paginate($perPage);
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }
}
