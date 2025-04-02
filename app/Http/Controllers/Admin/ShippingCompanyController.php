<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\ShippingCompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ShippingCompanyController extends BaseAdminController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:manage couriers'),
        ];
    }

    protected $shippingCompanyRepository;

    public function __construct(ShippingCompanyRepository $shippingCompanyRepository)
    {
        parent::__construct($shippingCompanyRepository);
        $this->shippingCompanyRepository = $shippingCompanyRepository;
    }

    public function store(Request $request)
    {
        $this->shippingCompanyRepository->store($request);

        return redirect()->route("admin.shipping-companies.create");
    }
    
    public function update(Request $request, int $id)
    {
        $this->shippingCompanyRepository->update($request, $id);

        return redirect()->route("admin.shipping-companies.edit", $id);
    }

    public function destroy(int $id)
    {
        $this->shippingCompanyRepository->destroy($id);
    
        return redirect()->route('admin.shipping-companies.index');
    }
}
