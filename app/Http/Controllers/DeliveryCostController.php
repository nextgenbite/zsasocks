<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCost;
use Illuminate\Http\Request;

class DeliveryCostController extends Controller
{
    public $title = ["Delivery Cost", 'delivery-cost'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title =$this->title;
        $index = DeliveryCost::latest()->get();
        // return response()->json($index);
        return view('admin.delivery_cost.index', compact('index', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title =$this->title;
        return view('admin.delivery_cost.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
 
        DeliveryCost::create($data);

        $notification = array(
            'messege' => 'Data is create successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/delivery-cost')->with($notification);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryCost  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryCost $deliveryCost)
    {
        $title =$this->title;
        $data = $deliveryCost;
        return view('admin.delivery_cost.edit', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryCost  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryCost $deliveryCost)
    {
        $requestdata = $request->all();

   
        $deliveryCost->update($requestdata);
        
        $notification = array(
            'messege' => 'data is update successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/delivery-cost')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryCost  $deliveryCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryCost $deliveryCost)
    {

        $deliveryCost->delete();

        $notification = array(
            'messege' => 'Data is Deleted!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function active(DeliveryCost $deliveryCost, $id)
    {
        $active = $deliveryCost->whereId($id)->update(['status' => 1]);
        //return response()->json($active);
        if ($active) {
            $notification = array(
                'messege' => 'Actived is successfully!',
                'alert-type' => 'success'
            );
        };
        return  Redirect()->back()->with($notification);
    }
    public function inActive(DeliveryCost $deliveryCost, $id)
    {
        $inactive =   $deliveryCost->whereId($id)->update(['status' => 0]);
        if ($inactive) {
            $notification = array(
                'messege' => 'Deactived is successfully!',
                'alert-type' => 'error'
            );
        };
        return  Redirect()->back()->with($notification);
    }
}
