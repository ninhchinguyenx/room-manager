<?php

namespace App\Http\Controllers;

use App\Http\Requests\Device\StoreDeviceRequest;
use App\Http\Requests\Device\UpdateDeviceRequest;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $device = Device::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy thành công!',
            'data' => $device
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceRequest $request)
    {
        try {
            $device =  DB::transaction(function () use ($request) {
                $dataDevice = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    "description" => $request->description,
                ];
                return Device::query()->create($dataDevice);
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Tạo thành công!',
                'data' => $device
            ], 201);
        } catch (\Exception  $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $findDevice = Device::find($id);
        if (!$findDevice) {
            return response()->json([
                'status' => 'error',
                'status' => 'error',
                'message' => 'Thiết bị không tồn tại!',
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy thiết bị thành công!',
            'data' => $findDevice
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, $id)
    {
        try {
            $findDevice = Device::find($id);
            if (!$findDevice) {
                return response()->json(['status' => 'error', 'message' => 'Thiết bị không tồn tại'], 404);
            }
            DB::transaction(function () use ($request, $findDevice) {

                $dataDevice = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    "description" => $request->description,
                ];
                $findDevice->update($dataDevice);
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Sửa thiết bị thành công!',
            ], 201);
        } catch (\Exception  $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $findDevice = Device::find($id);
            if (!$findDevice) {
                return response()->json(['status' => 'error', 'message' => 'Thiết bị không tồn tại'], 404);
            }
            $findDevice->update(['is_active' => false]);
            return response()->json([
                'status' => 'success',
                'message' => 'Ngừng thiết bị thành công!',
            ], 201);
        } catch (\Exception  $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update record: ' . $e->getMessage()
            ], 500);
        }
    }
}
