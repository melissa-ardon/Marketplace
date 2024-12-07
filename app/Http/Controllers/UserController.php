<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating; 
use App\Models\User; 
use App\Models\Message; 
use App\Models\Book; 

class UserController extends Controller
{
   
    public function perfil()
    {
        $user = Auth::user();
        $ratings = $user->ratingsReceived;
        $books = $user->books;
        return view('User.Perfil', compact('user', 'ratings', 'books'));
    }
   
    public function store_message(Request $request, $receiverId)
    {
        $request->validate([
            'contenido' => 'required|string|max:255',
        ]);

        $sender = Auth::user();
        $receiver = User::findOrFail($receiverId);

        $book = $request->input('book_id') ? Book::findOrFail($request->input('book_id')) : null;

        $message = new Message();
        $message->contenido = $request->input('contenido');
        $message->sender_id = $sender->id;
        $message->receiver_id = $receiver->id;
        $message->book_id = $book ? $book->id : null;

        if ($message->save()) {
            return redirect()->route('book.show', $book->id)->with('success', 'Mensaje enviado correctamente.');
        } else {
            return back()->with('error', 'No se pudo enviar el mensaje.');
        }
    }

    public function store_rating(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer',
            'calificador_id' => 'required|integer',
            'puntuacion' => 'required|numeric|min:1|max:10',
            'comentario' => 'required|string|max:255',
        ]);
        
        $rating = new Rating();
        $rating->user_id=$request->input('user_id');  
        $rating->calificador_id=$request->input('calificador_id');
        $rating->puntuacion=$request->input('puntuacion');
        $rating->comentario=$request->input('comentario');  

        if ($rating->save()){
         $mensaje = "El cometario se creo exitosamente"; 
        }
        
        else{
          $mensaje = "El cometario no se creo exitosamente"; 
        }
        
        return redirect()->route('user.show', $request->input('user_id'));

    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        $ratings = Rating::where('user_id', $id)->latest()->get();

        return view('User.UShow', compact('user', 'ratings'));
    }

}
