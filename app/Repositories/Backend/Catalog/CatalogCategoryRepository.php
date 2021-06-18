<?php


namespace App\Repositories\Backend\Catalog;


use App\Exceptions\GeneralException;
use App\Models\Catalog\CatalogCategory;

class CatalogCategoryRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CatalogCategory::class;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'active',
        'created_at',
        'updated_at',
    ];

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->with([
                'creator',
                'updater',
            ])
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'catalog_categories.created_by')
            ->select([
                'catalog_categories.id',
                'catalog_categories.name',
                'catalog_categories.status',
                'catalog_categories.created_at',
                'users.first_name as created_by',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(__('exceptions.backend.catalog-category.already_exists'));
        }

        $input['status'] = $input['status'] ?? 0;
        $input['created_by'] = auth()->user()->id;

        if ($catalogcategory = CatalogCategory::create($input)) {
            event(new CatalogCategoryCreated($catalogcategory));

            return $catalogcategory;
        }

        throw new GeneralException(__('exceptions.backend.catalog-category.create_error'));
    }

    /**
     * @param \App\Models\CatalogCategory $catalogcategory
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(CatalogCategory $catalogcategory, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $catalogcategory->id)->first()) {
            throw new GeneralException(__('exceptions.backend.catalog-category.already_exists'));
        }

        $input['status'] = $input['status'] ?? 0;
        $input['updated_by'] = auth()->user()->id;

        if ($catalogcategory->update($input)) {
            event(new CatalogCategoryUpdated($catalogcategory));

            return $catalogcategory->fresh();
        }

        throw new GeneralException(__('exceptions.backend.catalog-category.update_error'));
    }

    /**
     * @param \App\Models\CatalogCategory $catalogcategory
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(CatalogCategory $catalogcategory)
    {
        if ($catalogcategory->delete()) {
            event(new CatalogCategoryDeleted($catalogcategory));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.catalog-category.delete_error'));
    }
}
