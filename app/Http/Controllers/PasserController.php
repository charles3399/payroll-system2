<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passers;
use App\Models\Employee;
use App\Http\Resources\PassersResource;
use Illuminate\Support\Facades\DB;

class PasserController extends Controller
{
    public function get_all()
    {
        //$passers = DB::table('passers')->paginate(10);
        $passers = Passers::with('employee')->get();

        return PassersResource::collection($passers);
    }
}
