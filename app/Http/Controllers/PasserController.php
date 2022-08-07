<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passers;
use App\Models\Employee;
use App\Http\Resources\PassersResource;
use Illuminate\Support\Facades\DB;

class PasserController extends Controller
{
    public function get_all(Request $request)
    {
        $searchQuery = $request->searchPasser;

        $passers = Passers::whereHas('employee', function($query) use($searchQuery){
            $query->where('full_name', 'LIKE', '%'.$searchQuery.'%');
        })
        ->orWhereHas('employee', function($query) use($searchQuery){
            $query->where('gender', 'LIKE', '%'.$searchQuery.'%');
        })
        ->orWhereHas('employee.position', function($query) use($searchQuery){
            $query->where('position_name', 'LIKE', '%'.$searchQuery.'%');
        })
        ->with(['employee','employee.position'])
        ->paginate(10);

        return PassersResource::collection($passers);
    }
}
