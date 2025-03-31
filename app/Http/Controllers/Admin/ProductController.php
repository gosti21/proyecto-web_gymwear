<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\ProductRepository;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends BaseAdminController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:manage products'),
        ];
    }

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
        $this->productRepository = $productRepository;
    }

    public function destroy(int $id)
    {
        $this->productRepository->destroy($id);

        return redirect()->route("admin.products.index");
    }
    
}
