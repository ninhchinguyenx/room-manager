<?php

namespace App\Http\Controllers;

use App\Http\Requests\Floor\StoreFloorRequest;
use App\Http\Requests\Floor\UpdateFloorRequest;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $floor = Floor::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy thành công!',
            'data' => $floor
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFloorRequest $request)
    {
        try {
            $data = Floor::pluck('name')->toArray();
            
            if (in_array($request->name, $data)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Dữ liệu đã tồn tại!',
                ], 404);
            }
            $floor =  DB::transaction(function () use ($request) {
                $dataFloor = [
                    'name' => $request->name,
                    'code' => $request->code,
                ];
                return Floor::query()->create($dataFloor);
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Tạo thành công!',
                'data' => $floor
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
        $findDataByID = Floor::find($id);
        if (!$findDataByID) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tầng không tồn tại!',
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Lấy tầng thành công!',
            'data' => $findDataByID
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
    public function update(UpdateFloorRequest $request, string $id)
    {
        try {
            $findDataByID = Floor::find($id);
            if (!$findDataByID) {
                return response()->json(['status' => 'error', 'message' => 'Tầng tồn tại'], 404);
            }
            if (Str::is($findDataByID->name, $request->name)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Dữ liệu đã tồn tại!',
                ], 404);
            }
            DB::transaction(function () use ($request, $findDataByID) {

                $dataFloor = [
                    'name' => $request->name,
                    'code' => $request->code,
                ];
                $findDataByID->update($dataFloor);
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Sửa tầng thành công!',
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
            $findDataById = Floor::find($id);
            if (!$findDataById) {
                return response()->json(['status' => 'error', 'message' => 'tầng không tồn tại'], 404);
            }
            $findDataById->update(['is_active' => false]);
            return response()->json([
                'status' => 'success',
                'message' => 'Ngừng tầng thành công!',
            ], 201);
        } catch (\Exception  $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update record: ' . $e->getMessage()
            ], 500);
        }
    }
}

