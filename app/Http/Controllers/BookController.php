<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Book; 


class BookController extends Controller
{
  
    public function index(Request $request)
    {
        $BookBuscar=$request->get('buscar');

        $books = Book::with('user')
                    ->where('titulo', 'LIKE', '%'.$BookBuscar.'%')
                    ->orwhere('autor', 'LIKE', '%'.$BookBuscar.'%')
                    ->orwhere('precio', 'LIKE', '%'.$BookBuscar.'%')
                    ->paginate(9);

        return view ('Book.BIndex', compact('books','BookBuscar'));
    
    }

    public function create()
    {
        return view('Book.BCreate');
    }

    public function store(Request $request)
    {

        $request->validate([
            'titulo'=>'required|regex:/[A-Z][a-z]+/i',
            'autor'=>'required|regex:/[A-Z][a-z]+/i',
            'descripcion'=>'required|regex:/[A-Z][a-z]+/i',
            'precio'=>'required|numeric',
            'estado'=>'required',
        ]);
        
        $book = new Book();
        $book->titulo=$request->input('titulo');
        $book->autor=$request->input('autor');
        $book->descripcion=$request->input('descripcion');
        $book->precio=$request->input('precio');
        $book->user_id = auth()->id();
        $book->estado=$request->input('estado'); 

        if ($book->save()){
         $mensaje = "El libro se creo exitosamente"; 
        }
        
        else{
          $mensaje = "El libro no se creo exitosamente"; 
        }

        return redirect()->route('perfil')->with('mensaje',$mensaje);
    }

    public function show(string $id)
    {
        $book = Book::with(['user', 'messages.sender'])->findOrFail($id);

        return view('Book.BShow' , compact('book'));
    }

    public function edit(string $id)
    {
        $book = Book::findOrfail($id);
        return view('Book.BEdit')->with('books',$book);
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrfail($id);

        $request->validate([
            'titulo'=>'required|regex:/[A-Z][a-z]+/i',
            'autor'=>'required|regex:/[A-Z][a-z]+/i',
            'descripcion'=>'required|regex:/[A-Z][a-z]+/i',
            'precio'=>'required|numeric',
            'estado'=>'required',
        ]);
        
        $book->titulo=$request->input('titulo');
        $book->autor=$request->input('autor');
        $book->descripcion=$request->input('descripcion');
        $book->precio=$request->input('precio');
        $book->estado=$request->input('estado'); 

        if ($book->save()){
         $mensaje = "El libro se edito exitosamente"; 
        }
        
        else{
          $mensaje = "El libro no se edito exitosamente"; 
        }

        return redirect()->route('perfil')->with('mensaje',$mensaje);
    }

    public function destroy(string $id)
    {
        $borrados = Book::destroy($id);
    
        if ($borrados > 0){
            $mensaje = "El libro se elimino exitosamente"; 
           }
           
           else{
             $mensaje = "El libro no se elimino exitosamente"; 
           }
   
           return redirect()->route('perfil')->with('mensaje',$mensaje);
    }
}
