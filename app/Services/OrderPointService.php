<?php

// orderRewardService.php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Point;

class OrderPointService
{
    public function giveOrderPoints(User $user, Order $order)
    {
        $points = $this->calculateOrderPoints($order);

        // Add points to the user's total points
        $user->increment('points', $points);

        return $points;
    }

    private function calculateOrderPoints(Order $order)
    {
 
        $points = 0;
        $data= Point::where('name', 'product')->first();
        foreach($order->orderitem as $item)
        {

            if ($item->product->point > 0) {
                $points += $item->product->point; 
            } else if ($data) {
                $points += $data->point;
            } else{
                $points = 0;
            }
            
        }

        return $points;
    }
}
