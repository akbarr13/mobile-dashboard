<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselsController extends Controller
{

    public function index(){
        $carousels = Carousel::firstOrFail();

        return response()->json($carousels, 200);
    }
}
