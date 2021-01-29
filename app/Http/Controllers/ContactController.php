<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::create($request->all());
        return response()->json([
            'code' => 200,
            'data' => $contact
        ]);
    }
}
