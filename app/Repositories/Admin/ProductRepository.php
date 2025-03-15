<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use App\Traits\Admin\sweetAlerts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends BaseRepository
{
    use sweetAlerts;

    public function __construct(Product $model)
    {
        parent::__construct($model, 'products');
    }

    public function destroy(int $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $image = $product->images->first();

            Storage::delete($image->path);
            $image->delete();

            $product->delete();

            DB::commit();

            $this->alertGenerate1([
                'title' => '¡Registro eliminado!',
                'text' => "El registro ha sido eliminado correctamente",
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            $this->alertGenerate1([
                'icon' => 'error',
                'title' => '¡Error!',
                'text' => "Hubo un problema al eliminar el registro.",
            ]);
        }
    }
}
