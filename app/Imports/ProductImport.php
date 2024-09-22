<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Check and handle optional or nullable columns, if any.
        $buyingDate = !empty($row['buying_date']) ? $row['buying_date'] : null;
        $expireDate = !empty($row['expire_date']) ? $row['expire_date'] : null;

        // The $row variable now represents a data row, and the header row is skipped.
        return new Product([
            'product_name' => $row['product_name'],
            'category_id' => (int) $row['category_name'], // Cast to integer if category_id is an integer in the database.
            'supplier_id' => (int) $row['supplier_name'], // Cast to integer if supplier_id is an integer in the database.
            'product_code' => $row['product_code'],
            'product_garage' => $row['product_garage'],
            'product_store' => (int) $row['product_store'], // Cast to integer if product_store is an integer in the database.
            'buying_date' => $buyingDate,
            'expire_date' => $expireDate,
            'buy_price' => (int) $row['buying_price'], // Cast to integer if buy_price is an integer in the database.
            'selling_price' => (int) $row['selling_price'], // Cast to integer if selling_price is an integer in the database.
            'product_track' => (int) $row['product_track'], // Assuming product_track corresponds to unit.
        ]);
    }
}
