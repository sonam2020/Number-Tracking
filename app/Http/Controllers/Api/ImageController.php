<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Image;

class ImageController extends Controller
{
    public function uploade(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $file_path = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();


            $file->storeAs('uploads', $filename, 'public');
            $file_path = 'uploads/' . $filename;
        }

        DB::beginTransaction();
        try {

            $data = new Image();
            $data->image = $file_path;
            $data->save();
            DB::commit();

            return response()->json([
                'statuscode' => '200',
                'message' => 'Image uploaded successfully.',
                'status' => 'success',
                'data' => asset('storage/' . $data->image),
            ], 200);

        } catch (\Exception $err) {
            DB::rollBack();
            return response()->json([
                'message' => 'Internal Server Error',
                'status' => 'fail',
                'error_msg' => $err->getMessage(),
                'data' => "",
            ], 500);
        }
    }
}
