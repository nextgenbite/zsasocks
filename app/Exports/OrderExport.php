<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    protected $selectedIds;

    public function __construct($selectedIds)
    {
        $this->selectedIds = $selectedIds;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::whereIn('id', $this->selectedIds)
            ->with('orderitem')
            ->get();

        $exportData = [];

        foreach ($orders as $order) {
            $productDetails = $this->getProductDetails($order->orderitem);
            $exportData[] = [
                'Invoice' => '8' . $order->id,
                'Name' => $order->name,
                'Address' => $order->address,
                'Phone' => $order->phone,
                'Amount' => ($order->amount + $order->delivery_type) -  $order->coupon,
                'Notes' => $order->notes,
                'Contact Name' => $order->name, // Example of an aliased column
                'Customer Phone (Alias)' => $order->phone, // Example of an aliased column
                'Product Model' => $productDetails['productNames'],
                'Color and Size' => $productDetails['colorAndSize'],
                'Quantity' => $productDetails['quantity'],
                'Date & Time' => $order->created_at,
            ];
        }

        return collect($exportData);
    }

    protected function getProductDetails($orderItems)
    {
        $productNames = [];
        $colorAndSize = [];

        foreach ($orderItems as $orderItem) {
            $productNames[] = "{$orderItem->product->sku}";
            $quantity[] = "{$orderItem->qty}";

            $colorAndSize[] = sprintf(
                isset($orderItem->color) ? "{$orderItem->color}" : '',
                isset($orderItem->size) ? ($orderItem->color ? ', ' : '') . "{$orderItem->size}" : ''
            );
        }

        return [
            'productNames' => implode(', ', $productNames),
            'colorAndSize' => implode(', ', $colorAndSize),
            'quantity' => implode(', ', $quantity),
        ];
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Name',
            'Address',
            'Phone',
            'Amount',
            'Notes',
            'Contact Name',
            'Contact Phone',
            'Product Model',
            'Color and Size',
            'Quantity',
            'Date & Time',
        ];
    }
}