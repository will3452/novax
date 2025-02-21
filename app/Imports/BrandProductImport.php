<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class BrandProductImport implements ToModel
{

    public $brand_id;

    public function __construct($b)
    {
        $this->brand_id = $b;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Product::firstOrCreate([
            'brand_id' => $this->brand_id,
            'name' => $row[0],
        ], [
            'brand_id' => $this->brand_id,
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'cost' => $row[3],
        ]);
    }
}
