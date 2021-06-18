<?php

namespace App\Domain\Catalog\Services;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Domain\Catalog\Entities\CatalogCategory;
use App\Domain\Core\Interfaces\ServiceInterface;

class CatalogCategoryService implements ServiceInterface
{
    protected $category;

    private $sortable = [
        'id',
        'active',
        'created_at',
        'updated_at',
    ];

    public function __construct(CatalogCategory $category)
    {
        $this->category = $category;
    }

    public function findAll(array $filter)
    {
        $categories = $this->category;

        if (array_key_exists('active', $filter)) {
            $categories = $categories->active(boolval($filter['active']));
        }

        return $categories;
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

            $translations = $input['translations'];
            unset($input['translations']);

            if ($category = CatalogCategory::create($input)) {
                // Inserting associated translation's id in mapper table
                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc']) {
                            $category->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'name' => $values['name'],
                                    'desc' => $values['desc'],
                                ],
                            ]);
                        }
                    }
                }

                return $category;
            }

            throw new GeneralException(__('exceptions.backend.catalog-categories.create_error'));
        });
    }

    public function update(CatalogCategory $catalogCategory, array $input)
    {
        $input['updated_by'] = auth()->id();

        $translations = $input['translations'];
        unset($input['translations']);

        if (isset($input['active'])) {
            $input['active'] = boolval($input['active']);
        } else {
            $input['active'] = false;
        }

        return DB::transaction(function () use ($catalogCategory, $input, $translations) {
            if ($catalogCategory->update($input)) {
                $catalogCategory->translations()->delete();

                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc']) {
                            $catalogCategory->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'name' => $values['name'],
                                    'desc' => $values['desc'],
                                ],
                            ]);
                        }
                    }
                }

                return $catalogCategory->fresh();
            }

            throw new GeneralException(__('exceptions.backend.languages.update_error'));
        });
    }

    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->category->active()->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    public function delete(CatalogCategory $catalogCategory)
    {
        return $catalogCategory->delete();
    }
}
