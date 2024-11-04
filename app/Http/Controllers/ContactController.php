<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::firstOrFail();

        return response()->json([
            'data' => $contacts,
            'message' => 'Contact fetched successfully',
            'status' => true,
        ], 200);
        
    }
}
