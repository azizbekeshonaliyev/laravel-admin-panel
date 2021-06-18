<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Domain\Catalog\Entities\Product;
use App\Domain\Catalog\Services\ProductService;
use App\Domain\Catalog\Resources\ProductResource;

class ProductController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $collection = $this->service->retrieveList($request->all());

        return ProductResource::collection($collection);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
