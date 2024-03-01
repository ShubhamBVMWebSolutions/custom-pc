<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $dataarray = [
            'title' => $row[1],
            'product_overview' => $row[2],
            'material' => $row[3],
            'details' => $row[4],
            'short_description' => $row[5],
            'features' => $row[6],
            'price' => $row[7],
            'sale_price' => $row[8],
            'brand' => $row[9],
            'model' => $row[10],
            'sku' => $row[11],
            'stock_qty' => $row[12],
            'image' => $row[13],
            'featured' => $row[14],
            'slug' => $row[15],
            'status' => $row[16],
            'meta_keywords' => $row[17],
            'meta_description' => $row[18],
            'product_type' => $row[19],
        ];
        if(gettype($row[0]) != 'string' || gettype($row[0]) == '' || gettype($row[0]) == null){
            $is_available = Product::find($row[0]);
            if(empty($is_available)){
                return new Product($dataarray);
            }else{
                $is_available->update($dataarray);
                return $is_available;
            }
        }
    }
}
