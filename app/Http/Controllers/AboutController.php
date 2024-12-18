<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        //buat untuk menampilkan data about
        $data = AboutUs::first();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
