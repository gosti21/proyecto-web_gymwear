<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Variant;
use App\Repositories\Admin\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends BaseAdminController
{
    public function __construct()
    {
        $model = new Product();
        $viewName = 'products';

        $repository = new BaseRepository($model, $viewName);

        parent::__construct($repository);
    }

    public function destroy(int $id)
    {
        DB::beginTransaction();
        try{
            $product = Product::findOrFail($id);
            $image = $product->images->first();
    
            Storage::delete($image->path);
            $image->delete();
            
            $product->delete();

            DB::commit();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Registro eliminado!',
                'text' => "El registro ha sido eliminado correctamente",
                'timer' => 1600,
                'timerProgressBar' => true
            ]);
    
            return redirect()->route("admin.products.index");
            
        }catch (\Exception $e){
            DB::rollback();

            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => "Hubo un problema al eliminar el registro.",
                'draggable' => true,
                'timer' => 1800,
                'timerProgressBar' => true
            ]);

            return redirect()->route("admin.products.index");
        }
    }

    public function variants(Product $product, Variant $variant)
    {
        return view('admin.products.variants', compact('product', 'variant'));
    }
}
