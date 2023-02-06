<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class ContactController extends Controller
{
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'subject' => 'required|max:255',
            'message' => 'required|max:1023',

        ]); 
        $contact = new Contact(); 
        $contact->email = $request->email; 
        $contact->phone = $request->phone; 
        $contact->subject = $request->subject; 
        $contact->message = $request->message; 

        $contact->save(); 

        return response()->json(
            ['message'=>'Successful','data' => $contact]
            , 201); 


    }
}
