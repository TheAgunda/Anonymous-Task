<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\VendorAvailability;
use App\Models\VendorRescheduleOff;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('user')) {
            $vendorAvailability = VendorAvailability::get();
            return view('home', compact('vendorAvailability'));
        }
        return view('home');
    }
    public function availability()
    {
        return view('pages.vendor.availability');
    }
    public function storeAvailability(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'vendor_id' => 'required',
                'days' => 'required',
                'startTime' => 'array',
                'endTime' => 'array',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('status', 'Bad Request Input.');
            }
            $data = [];
            foreach ($request->days as $key => $value) {
                $startTime = isset($request->startTime[$key]) ? $request->startTime[$key] : '';
                $endTime = isset($request->endTime[$key]) ? $request->endTime[$key] : '';
                $data[] = ['vendor_id' => $request->vendor_id, 'weekday_name' => $value, 'startTime' => $startTime, 'endTime' => $endTime];
            }

            $status = VendorAvailability::insert($data);
            if ($status) {
                return redirect()->back()->with('status', 'Saved Successfully.');
            } else {
                return redirect()->back()->with('status', 'Oops something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('status',  $e->getMessage());
        }
    }
    public function rescheduleOff()
    {
        return view('pages.vendor.reschedule-off');
    }
    public function rescheduleOffStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'vendor_id' => 'required',
                'date' => 'required',
                'startTime' => 'required',
                'endTime' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('status', 'Bad Request Input.');
            }

            $startTime = isset($request->startTime) ? $request->startTime : '';
            $endTime = isset($request->endTime) ? $request->endTime : '';
            $data[] = ['vendor_id' => $request->vendor_id, 'date' => $request->date, 'startTime' => $startTime, 'endTime' => $endTime];

            $status = VendorRescheduleOff::insert($data);
            if ($status) {
                return redirect()->back()->with('status', 'Saved Successfully.');
            } else {
                return redirect()->back()->with('status', 'Oops something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('status',  $e->getMessage());
        }
    }
    public function booking(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'booking_date' => 'required',
                'booking_time' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('status', 'Bad Request Input.');
            }

            $booking_weekday_name = Carbon::parse($request->booking_date)->format('l');
            print_r($booking_weekday_name);
        } catch (\Exception $e) {
            return redirect()->back()->with('status',  $e->getMessage());
        }
    }
}
