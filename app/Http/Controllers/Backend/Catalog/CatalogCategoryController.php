<?php

namespace App\Http\Controllers\Backend\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use Domain\Catalog\Entities\CatalogCategory;
use App\Domain\Catalog\Services\CatalogCategoryService;
use Domain\Catalog\Requests\CatalogCategoryStoreRequest;

class CatalogCategoryController extends Controller
{
    private $catalogCategoryService;

    private $view_location = 'backend.catalog-categories.';

    public function __construct(CatalogCategoryService $catalogCategoryService)
    {
        $this->catalogCategoryService = $catalogCategoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->catalogCategoryService->findAll($request->all());

        $categories = $categories->paginate();

        return view($this->view_location.'index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = $this->catalogCategoryService->findAll([]);

        $categories = $categories->get();

        return view($this->view_location.'create', [
            'categories' => $categories,
        ]);
    }

    public function store(CatalogCategoryStoreRequest $request)
    {
        $this->catalogCategoryService->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.catalog-categories.index'), ['flash_success' => __('alerts.backend.catalog-categories.created')]);
    }

    public function show($id)
    {
        //
    }

    public function edit(CatalogCategory $catalogCategory)
    {
        $categories = $this->catalogCategoryService->findAll([]);

        $categories = $categories->get();

        return view($this->view_location.'edit', [
            'categories' => $categories,
            'category' => $catalogCategory,
        ]);
    }

    public function update(Request $request, CatalogCategory $catalogCategory)
    {
        $this->catalogCategoryService->update($catalogCategory, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.catalog-categories.index'), ['flash_success' => __('alerts.backend.catalog-categories.updated')]);
    }

    public function destroy(CatalogCategory $catalogCategory)
    {
        $this->catalogCategoryService->delete($catalogCategory);

        return new RedirectResponse(route('admin.catalog-categories.index'), ['flash_success' => __('alerts.backend.catalog-categories.deleted')]);
    }
}
