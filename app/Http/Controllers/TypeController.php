<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Review;
use App\Models\Spot;

class TypeController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $types = Type::paginate(10);
   
        return view('types.index', ['types' => $types]);
    }

    /** 
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('types.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required',]);

        $type = new Type([
            
            'name' => $request->get('name'),
        ]);

        $type->save();

        return redirect('/types')->with('success', 'Tipo criado!');
    }

    /** 
    * Display the specified resource.   
    *
    * @param  \App\Models\Type  $type
    * @return \Illuminate\Http\Response
    */
    public function destroy(Type $type)
    {
        $spots = Spot::where('type_id', $type->id)->get();

        foreach($spots as $spot)
        {
            $carts = Cart::where('spot_id', $spot->id)->get();
            $carts->each->delete();

            $reviews = Review::where('spot_id', $spot->id)->get();
            $reviews->each->delete();

            $spot->delete();
        }

        $type->delete();
        return redirect()->route('types');
    }
}