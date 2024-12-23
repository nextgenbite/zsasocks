<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SMSService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    protected $orderPointService;
    protected $smsService;
    public function __construct(  SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    public $title = ["Sms", 'sms'];
    public function create()
    {
        $title =$this->title;
        // return User::where('role', 'user')->pluck('phone');
        return view('admin.sms.create', compact('title'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'message' => 'required'
        ]);
    
        // Fetch phone numbers of users with the role 'user' and convert to a comma-separated string
        $numbers = User::where('role', 'user')->pluck('phone')->toArray();
        $numbersString = implode(',', $numbers);
    
        // Send the SMS using the smsService
        $smsResponse = $this->smsService->sendSMS($numbersString, $request->message);
    
        // Decode the JSON response to an associative array
        $sms = json_decode($smsResponse, true);
    
        // Check if JSON decoding was successful
        if (json_last_error() === JSON_ERROR_NONE) {
            // Check the response code
            if ($sms['response_code'] == 202) {
                // Prepare success notification
                $notification = [
                    'messege' => 'SMS sent.',
                    'alert-type' => 'success'
                ];
            } else {
                // Prepare failure notification with error message
                $notification = [
                    'messege' => 'Failed to send SMS. ' . $sms['error_message'],
                    'alert-type' => 'error'
                ];
            }
        } else {
            // Prepare failure notification for JSON decoding error
            $notification = [
                'messege' => 'Failed to parse SMS service response.',
                'alert-type' => 'error'
            ];
        }
    
        // Redirect back with the notification
        return redirect()->back()->with($notification);
    }
    
}
