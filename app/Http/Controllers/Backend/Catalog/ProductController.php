<?php

namespace App\Http\Controllers\Backend\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Domain\Catalog\Entities\Product;
use App\Http\Responses\RedirectResponse;
use App\Domain\Catalog\Services\ProductService;
use Domain\Catalog\Requests\ProductStoreRequest;
use App\Domain\Catalog\Services\CatalogCategoryService;

class ProductController extends Controller
{
    private $productService;

    private $view_location = 'backend.products.';

    private $catalogCategoryService;

    public function __construct(ProductService $productService, CatalogCategoryService $catalogCategoryService)
    {
        $this->productService = $productService;
        $this->catalogCategoryService = $catalogCategoryService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->findAll($request->all());

        $products = $products->latest()->paginate();

        return view($this->view_location.'index', [
            'products' => $products,
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

    public function store(ProductStoreRequest $request)
    {
        $this->productService->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.products.index'), ['flash_success' => __('alerts.backend.products.created')]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = $this->catalogCategoryService->findAll([]);

        $categories = $categories->get();

        return view($this->view_location.'edit', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->productService->update($product, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.products.index'), ['flash_success' => __('alerts.backend.products.updated')]);
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return new RedirectResponse(route('admin.products.index'), ['flash_success' => __('alerts.backend.products.deleted')]);
    }

    public function deleteImage(Product $product, $image_id = null)
    {
        $product->album->removeImage($image_id);

        return response()->json([
            'message' => 'Successfully deleted',
        ]);
    }
}
