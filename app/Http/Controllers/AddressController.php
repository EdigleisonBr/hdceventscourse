<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;

class AddressController extends Controller
{
    public function create(){
        return view('address.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'zip_code' => 'required|min:9'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors(['msg' => 'Cep deve ter 9 caracteres!']);
        }

        $address = new Address;
        
        $address->zip_code       = $request->zip_code; 
        $address->street         = $request->street;
        $address->address_number = $request->address_number;
        $address->complement     = $request->complement;
        $address->city           = $request->city;
        $address->state          = $request->state;
        $address->neighborhood   = $request->neighborhood;
        $address->event_id       = $request->event_id;

        $address->save();

        return redirect('/')->with('toast_success', 'Endereço criado com sucesso!');
    }
}
