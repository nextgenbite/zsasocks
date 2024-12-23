<?php

namespace App\Http\Controllers;

use finfo;
use Illuminate\Http\Request;
use Xenon\BkashPhp\Handler\Exception\RenderBkashPHPException;
use Xenon\BkashPhp\BkashPhp;

class PaymentController extends Controller
{
    public function store(Request $request)
    {

        $configuration = [
            'config' => [
                "app_key" => "app key goes here",
                "app_secret" => "app secret goes here",
            ],
            'headers' => [
                "username" => "username goes here",
                "password" => "password goes here",
            ]
        ];
        $bkash = new BkashPhp($configuration);
        $bkash->setEnvironment('sandbox'); //sandbox|production
        try{
            $paymentData = [ 
                 'mode' => '0011', //fixed
                 'payerReference' => '017AAXXYYZZ',
                 'callbackURL' => 'http://example.com/callback',
                 'merchantAssociationInfo' => 'xxxxxxxxxx',
                 'amount' => 10,
                 'currency' => 'BDT', //fixed
                 'intent' => 'sale', //fixed
                 'merchantInvoiceNumber' => "invoice number goes here",
             ];
             $createTokenizedPaymentResponse = $bkash->createTokenizedPayment($paymentData);
         
         }catch(RenderBkashPHPException $e){
             //do whatever you want
         }
    }
}
