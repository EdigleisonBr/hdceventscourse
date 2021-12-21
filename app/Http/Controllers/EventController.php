<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event;
use App\Models\Address;
use App\Models\User;

class EventController extends Controller
{
    public function index(){
        // faz referência ao name = "search" do welcome.blade
        $search = request('search'); 

        // Se a busca foi preenchida
        if($search){
            // define os campos a serem buscados
            $events = Event::where([
            ['title', 'like', '%'.$search.'%']
            ])->get(); // este get() está dizendo que quer pegar esses registros
        }else{ // Senão retorna todos os eventos
            $events = Event::all();
        }        

        return view('welcome', [ 'events' => $events, 'search' => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', 'Nome do Evento não pode ter menos que 3 caracteres!');
        }

        // if ($validator->fails()) {
        //     return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        // }

        $event = new Event;
        
        $event->active = intval($request->get('active'));
        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = strtoupper($request->city);
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        $address = new Address;
        
        $address->zip_code       = $request->zip_code; 
        $address->street         = $request->street;
        $address->address_number = $request->address_number;
        $address->complement     = $request->complement;
        $address->city           = $request->city;
        $address->state          = $request->state;
        $address->neighborhood   = $request->neighborhood;
        $address->event_id       = $request->event_id;

        //Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

          $requestImage = $request->image;
          
          $extension  = $requestImage->extension();

          $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

          $requestImage->move(public_path('img/events'), $imageName);

          $event->image = $imageName;
        }

        // guardando usuário autenticado no banco
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();
        $address->save();

        return redirect('/')->with('toast_success', 'Evento criado com sucesso!');
    }
    
    public function show($id) {
           
        $event = Event::findOrFail($id);

        $user = auth()->user();

        $hasUserJoined = false;

        if($user){

            // Mandando todos os dados para um array.
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent){
                if ($userEvent['id'] == $id){
                    $hasUserJoined = true;  
                }
            }
         
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();
<<<<<<< HEAD
        
        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
=======

        return view(
            'events.show', [
                'event' => $event, 
                'eventOwner' => $eventOwner, 
                'hasUserJoined' => $hasUserJoined
            ]
        );
>>>>>>> cdfd3a9162e480d1df77c7348668824e4f72dbdf
    }

    public function dashboard(){
        
        // Verificar usuário autenticado
        $user = auth()->user();

        // Verificar os eventos desse usuário autenticado
        // Nesse caso ele está buscando lá na Models (events)
        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        // retorna o dashboard e manda os events lá pra view
        return view('events.dashboard', 
            [
                'events' => $events,
                'eventsAsParticipant' => $eventsAsParticipant
            ]);
    }

    public function destroy($id) {
           
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('toast_success', 'Evento excluído com sucesso!');
    }

    public function edit($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user->id){
            return redirect('/dashboard');
        }
           
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request) {

        $data = $request->all();

        //Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;
            
            $extension  = $requestImage->extension();
  
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
  
            $requestImage->move(public_path('img/events'), $imageName);
  
            $data['image'] = $imageName;
        }
           
        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('toast_success', 'Evento editado com sucesso!');
    }

    public function createAddress(){
        return view('address.create');
    }

    public function create_address(Request $request){

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

    public function joinEvent($id){

        $user = auth()->user();
       
        //Vattach = Vincular o usuário ao evento
        $user->eventsAsParticipant()->attach($id);
<<<<<<< HEAD
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('toast_success', 'Sua presença foi confirmada no evento '.$event->title);
=======
      
        $event = Event::findOrFail($id);
        
        return redirect('/dashboard')->with('toast_success', 'Sua presença foi confirmada no evento: '.$event->title);
    }

    public function leaveEvent($id){

        $user = auth()->user();
        
        //detach = Remove o vinculo do usuário com o evento
        $user->eventsAsParticipant()->detach($id);
        
        $event = Event::findOrFail($id);
      
        return redirect('/dashboard')->with('toast_success', 'Você saiu com sucesso do evento: '.$event->title);
>>>>>>> cdfd3a9162e480d1df77c7348668824e4f72dbdf
    }

    public function validaNome(){

        $validaNome = request()->get('name');

        $searchUser = User::select(
        [
            "name",
            'email'
        ])
        ->where('name', '=', $validaNome)
        ->first();

        if ($searchUser != null){ // ele vai pro .fail
           //return response()->json(['success' => true, 'aux1' => $searchUser->name, 'aux2' => $searchUser->email], 422); 
           return response()->json(['success' => true, 'aux' => $searchUser->name], 422);
        }
        else{
            return response()->json(['success' => false]);  
        }

        //return response()->json(['success' => true, $validaNome], 422);

        
      
    }

}

