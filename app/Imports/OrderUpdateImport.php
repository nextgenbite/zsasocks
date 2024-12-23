<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrderUpdateImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Remove the first digit from the Invoice column
        $id = substr($row['invoice'], 1); // Extracts 2104 from 82104

        // Find the Order by ID
        $data = Order::find($id);
        // if (!$data) {
        //     \Log::warning("Order with ID {$id} not found.");
        //     return null;
        // }
        // Update the Order if it exists
        if ($data) {
            $data->update([
                'status' => $row['delivery_status'] == 'Delivered' ? 2 : 0 // 2 for delivered, 0 for canceled
            ]);
        }

        return $data;
    }

}
