<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DeviceRequest;
use App\Http\Resources\DeviceRequestResource;

class DeviceRequestController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $deviceRequests = DeviceRequest::all();
        return DeviceRequestResource::collection($deviceRequests);
    }

    /**
     * Display a listing of the resource.
     */
    public function expired() {
        $deviceRequests = DeviceRequest::all();
        $expiredRequests = collect([]);

        foreach ($deviceRequests as $deviceRequest) {
            $futureDate = Carbon::parse($deviceRequest->created_at)->addYears(2);

            if (Carbon::parse($futureDate)->lessThanOrEqualTo(Carbon::now())) {
                $expiredRequests->push($deviceRequest);
                $deviceRequest->update([
                    'status' => 'Expired'
                ]);
            }
        }

        return DeviceRequestResource::collection($expiredRequests);
    }

    /**
     * Display a listing of a user's resource.
     */
    public function user(User $user) {
        $deviceRequests = DeviceRequest::where('user_id', $user->id)->get();
        return DeviceRequestResource::collection($deviceRequests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $deviceRequest = DeviceRequest::create([
            'user_id' => $request->user_id,
            'device' => $request->device,
            'model' => $request->model,
            'specifications' => $request->specifications,
            'device_bought' => $request->input('device_bought') ? true : false,
            'serial_number' => $request->serial_number,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        return new DeviceRequestResource($deviceRequest);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceRequest $deviceRequest) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceRequest $deviceRequest) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceRequest $deviceRequest) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceRequest $deviceRequest) {
        //
    }
}
