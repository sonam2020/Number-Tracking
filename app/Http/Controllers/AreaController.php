<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area; 
use DataTables;

class AreaController extends Controller
{
    public function index(){
        return view('area.index');
    }
    
   public function getData(Request $request)
    {
        $data = Area::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->editColumn('created_at', function($row) {
                return $row->created_at->format('d-m-Y H:i A');
            })
            ->toJson();
    }
    
   public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:areas,name', 
            ]);
    
            $area = new Area();
            $area->name = $validatedData['name'];
            $area->save();
    
            return response()->json(['message' => 'Area created successfully'], 201);
        } catch (ValidationException $e) {
            // Validation failed, return error response
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        }
    }
    
    public function changeStatus(Request $request){
        $data = Area::find($request->id);
        $data->status = ($data->status==0)?1:0;
        $data->save();
        return response()->json(['message' => 'Status changhed successfully!'], 201);
    }
    
    
}
