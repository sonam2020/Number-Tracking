<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Ticket;
use App\Models\Image;
// use App\Models\Image;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;




class TicketController extends Controller
{


     public function list() {
        // Get all tickets
        $area = Area::where('status', 1)->get();
        $normal = Ticket::where('direction', 1)->sum('amount');
        $in = Ticket::where('direction', 2)->sum('amount');
        $out = Ticket::where('direction', 3)->sum('amount');
        $cut = Ticket::where('direction', 4)->sum('amount');

        $tickets = Ticket::all();

        // Process data for display
        $processedData = $this->processTickets($tickets);

        // Return view with processed data
        return view('ticket.list', compact('processedData','area','normal','in','out','cut'));
    }

    private function processTickets($tickets) {
        $data = [];
        $rowSums = [];
        $maxAmount = 0; // Track the maximum amount
        $maxNumber = null; // Track the number with the maximum amount

        // Initialize data and rowSums
        for ($i = 0; $i < 10; $i++) {
            $rowSums[$i] = ['entries' => 0, 'total' => 0];
            $data[$i][0] = $rowSums[$i]; // Initialize the first cell for row sum
            for ($j = 1; $j <= 10; $j++) {
                $data[$i][$j] = ['entries' => 0, 'total' => 0, 'index' => []];
            }
        }

        // Process each ticket
        foreach ($tickets as $ticket) {
            $number = $ticket->number;
            $amount = $ticket->amount;
            $index = $ticket->id;

            if ($number < 1 || $number > 100) {
                // Skip numbers that are out of the expected range
                continue;
            }

            $rowIndex = intval(($number - 1) / 10);
            $colIndex = ($number - 1) % 10 + 1;

            // Ensure the row and column indices are valid
            if (!isset($data[$rowIndex])) {
                $data[$rowIndex] = [];
            }
            if (!isset($data[$rowIndex][$colIndex])) {
                $data[$rowIndex][$colIndex] = ['entries' => 0, 'total' => 0, 'index' => []];
            }

            $data[$rowIndex][$colIndex]['entries']++;
            $data[$rowIndex][$colIndex]['total'] += $amount;
            $data[$rowIndex][$colIndex]['index'][] = $index;

            $data[$rowIndex][0]['entries']++; // Update row sum in the first cell
            $data[$rowIndex][0]['total'] += $amount;

            // Check if this amount is the highest
            if ($data[$rowIndex][$colIndex]['total'] > $maxAmount) {
                $maxAmount = $data[$rowIndex][$colIndex]['total'];
                $maxNumber = ($rowIndex * 10) + $colIndex;
            }
        }

        return ['data' => $data, 'maxNumber' => $maxNumber];
    }
//filter by area and date
  public function filter(Request $request)
{
    if ($request->ajax()) {
        // Handle AJAX request for image retrieval
        $number = $request->input('number');
        $imageId = $request->input('imageId');
        
        // Find the ticket based on number and imageId
        $ticket = Ticket::where('number', $number)
                        ->where('image_id', $imageId)
                        ->first();
        
        if ($ticket) {
            // Find the image
            $image = Image::find($ticket->image_id);
            $imageUrl = $image ? asset('storage/uploads/' . $image->image) : null;

            return response()->json(['imageUrl' => $imageUrl]);
        } else {
            return response()->json(['error' => 'Image not found'], 404);
        }
    }
    
    // Handle form submission
    if ($request->has(['datetime', 'area'])) {
        $date = $request->datetime;
        $getarea = $request->area;
        
        $area = Area::where('status', 1)->get();
        
        $normal = Ticket::where('direction', 1)
                        ->where('area', $getarea)
                        ->whereDate('created_at', $date)
                        ->sum('amount');
        
        $in = Ticket::where('direction', 2)
                    ->where('area', $getarea)
                    ->whereDate('created_at', $date)
                    ->sum('amount');
        
        $out = Ticket::where('direction', 3)
                     ->where('area', $getarea)
                     ->whereDate('created_at', $date)
                     ->sum('amount');
        
        $cut = Ticket::where('direction', 4)
                     ->where('area', $getarea)
                     ->whereDate('created_at', $date)
                     ->sum('amount');
        
        $tickets = Ticket::where('status', 1)
                         ->where('area', $getarea)
                         ->whereDate('created_at', $date)
                         ->get();
        
        $processedData = $this->processTickets($tickets);
        
        return view('ticket.list', compact('processedData', 'area', 'normal', 'in', 'out', 'cut', 'date', 'getarea'));
    }
}


// }
// ===========================================================
public function filter_number(Request $request, $id)
{
    // Fetch area data
    $area = Area::where('status', 1)->get();

    // Calculate sums for different directions
    $normal = Ticket::where('direction', 1)
                    ->where('number', $id)
                    ->sum('amount');

    $in = Ticket::where('direction', 2)
                ->where('number', $id)
                ->sum('amount');

    $out = Ticket::where('direction', 3)
                 ->where('number', $id)
                 ->sum('amount');

    $cut = Ticket::where('direction', 4)
                 ->where('number', $id)
                 ->sum('amount');

    // Fetch the tickets
    $tickets = Ticket::where('status', 1)
                     ->where('number', $id)
                     ->get();

    $processedData = $this->processTickets($tickets);

    // Fetch the Ticket record
    $ticket = Ticket::where('number', $id)->first();
    $imageUrl = null;
    $imageStatus = 'Image not found';

    if ($ticket && $ticket->image_id) {
        $image = Image::find($ticket->image_id);
        if ($image) {
            $imageUrl = asset('storage/' . $image->image); // Adjust path if necessary
            $imageStatus = 'Image found';
        }
    }

    return view('ticket.list', compact('processedData', 'area', 'normal', 'in', 'out', 'cut', 'imageUrl', 'imageStatus'));
}
// ==========================
// public function filter_number(Request $request, $id)
// {
//     // Fetch area data
//     $area = Area::where('status', 1)->get();

//     // Calculate sums for different directions
//     $normal = Ticket::where('direction', 1)
//                     ->where('number', $id)
//                     ->sum('amount');

//     $in = Ticket::where('direction', 2)
//                 ->where('number', $id)
//                 ->sum('amount');

//     $out = Ticket::where('direction', 3)
//                  ->where('number', $id)
//                  ->sum('amount');

//     $cut = Ticket::where('direction', 4)
//                  ->where('number', $id)
//                  ->sum('amount');

//     // Fetch the tickets
//     $tickets = Ticket::where('status', 1)
//                      ->where('number', $id)
//                      ->get();

//     $processedData = $this->processTickets($tickets);
//      dd($processedData);

//     // Fetch the Ticket record
//     $ticket = Ticket::where('number', $id)->first();

//     // Return the view with the data
//     return view('ticket.list', compact('processedData', 'area', 'normal', 'in', 'out', 'cut'));
// }

// public function fetchImage($number)
// {
//     $ticket = Ticket::where('number', $number)->first();

//     if ($ticket && $ticket->image_id) {
//         $image = Image::find($ticket->image_id);
//         if ($image) {
//             return response()->json(['imageUrl' => asset('storage/' . $image->image)]);
//         }
//     }
//     return response()->json(['imageUrl' => null]);
// }




    public function create(){
        $area = Area::where('status', 1)->get();
        $actionurl = route('ticket.store');
        $imagesdata = Image::orderby('created_at', 'desc')->get();
        return view('ticket.create',compact('area','actionurl','imagesdata'));
    }

  public function getData(Request $request)
    {
        $query = Ticket::with(['image', 'area']);

        // Apply filters
        if ($request->has('area_name') && !empty($request->area_name)) {
            $query->whereHas('area', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->area_name . '%');
            });
        }

        if ($request->has('amount') && !empty($request->amount)) {
            $query->where('amount', $request->amount);
        }

        if ($request->has('type') && !empty($request->type)) {
            $query->where('direction', $request->type);
        }

        if ($request->has('status') && !empty($request->status)) {
            $status = $request->status == 'Active' ? 1 : 0;
            $query->where('status', $status);
        }

        if ($request->has('date_range') && !empty($request->date_range)) {
            $dateRange = explode(' - ', $request->date_range);
            $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dateRange[0])->startOfDay();
            $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dateRange[1])->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $data = $query->orderBy('id', 'desc')->get();

        return DataTables::of($data)
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y H:i A');
            })
            ->editColumn('status', function ($row) {
                return $row->status == 1 ? 'Active' : 'Inactive';
            })
            ->editColumn('image', function ($row) {
                return '<img class="img-fluid" src="' . asset('storage/' . $row->image->image) . '" style="height: 80px;" alt="Photo" data-image-id="' . $row->image->id . '">';
            })
            ->editColumn('type', function ($row) {
                $typeText = '';
                switch ($row->direction) {
                    case 1:
                        $typeText = 'Normal';
                        break;
                    case 2:
                        $typeText = 'In';
                        break;
                    case 3:
                        $typeText = 'Out';
                        break;
                    case 4:
                        $typeText = 'Cut';
                        break;
                    default:
                        $typeText = 'Unknown';
                }
                $mixText = $row->mix == 1 ? ' Mixed' : ''; // Add a space before 'Mixed' if it's displayed
                return $typeText . $mixText;
            })
            ->rawColumns(['image'])
            ->toJson();
    }


    public function store(Request $request)
    {
        $request->validate([
            'area.*' => 'required',
            'number.*' => 'required|numeric',
            'amount.*' => 'required|numeric',
            'direction.*' => 'required|in:1,2,3,4,5',
            'mix.*' => 'nullable|in:5', // Make sure mix values are validated if required
            'selectedImage' => 'required'
        ]);

        $data = $request->all();


        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($data['area']); $i++) {
                $direction = $data['direction'][$i];
                $number = $data['number'][$i];
                $mix = $data['mix'][$i] ?? 0; // Default to 0 if not set

                // Determine the number of permutations to generate
                $maxCount = 9; // Default to 9
                if ($direction == 4 && $mix == 5) {
                    $maxCount = 6;
                }

                if ($direction == 4 && strlen($number) >= 3) {
                    // Generate permutations based on maxCount
                    $permutations = $this->generateMaxNumbers($number, $maxCount);

                    // Create tickets with permutations
                    foreach ($permutations as $perm) {
                        $ticketData = [
                            'area' => $data['area'][$i],
                            'number' => $perm,
                            'amount' => $data['amount'][$i],
                            'direction' => 1,  // Always store with direction 1 for permutations
                            'mix' => $mix,
                            'image_id' => $request->selectedImage,
                        ];
                        Ticket::create($ticketData);
                    }
                } else {
                    // Create tickets without permutations
                    $ticketData = [
                        'area' => $data['area'][$i],
                        'number' => $number,
                        'amount' => $data['amount'][$i],
                        'direction' => $direction,
                        'mix' => $mix,
                        'image_id' => $request->selectedImage,
                    ];
                    Ticket::create($ticketData);
                }
            }
            DB::commit();


            return redirect()->route('ticket')->with('success', 'Tickets Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error while creating tickets: ' . $e->getMessage());
            return back()->with('error', 'Internal Server Error. Please try again later.');
        }
    }

    private function generateMaxNumbers($number, $maxCount)
    {
        $digits = str_split($number);
        $result = [];

        if ($maxCount == 6) {
            // Generate unique combinations of two different digits
            for ($i = 0; $i < count($digits); $i++) {
                for ($j = 0; $j < count($digits); $j++) {
                    if ($i != $j) {
                        $result[] = $digits[$i] . $digits[$j];
                    }
                }
            }
            // Remove duplicates and ensure only 6 permutations are returned
            $result = array_unique($result);
            return array_slice($result, 0, 6);
        } elseif ($maxCount == 9) {
            // Generate all possible two-digit combinations including repetitions
            foreach ($digits as $d1) {
                foreach ($digits as $d2) {
                    $result[] = $d1 . $d2;
                }
            }
            // Remove duplicates and ensure only 9 permutations are returned
            $result = array_unique($result);
            return array_slice($result, 0, 9);
        }

        return $result;
    }


    public function changeStatus(Request $request){
        $data = Ticket::find($request->id);
        $data->status = ($data->status==0)?1:0;
        $data->save();
        return response()->json(['message' => 'Status changhed successfully!'], 201);
    }
// public function getImageUrl(Request $request)
// {
//     $number = $request->input('number');
//     $imageId = $request->input('imageId');

//     // Find the image by its ID
//     $image = Image::find($imageId);

//   if ($image) {
//             $imageUrl = asset('storage/' . $image->image);
//             return response()->json(['imageUrl' => $imageUrl]);
//         } else {
//             return response()->json(['error' => 'Image not found'], 404);
//         }
// }

}





