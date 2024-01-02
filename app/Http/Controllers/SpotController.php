<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Spot;
use App\Models\Type;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spots = Spot::paginate(5);
        return view('spot.index', ['spots' => $spots]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('spot.create', ['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:5000',
            'location' => 'required|string|max:30',
            'price' => 'required',
            'type' => 'required|integer',
            'villager' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $request->file('image')->store('public/images');

        $price = $request->get('price');
        $price = str_replace(' ', '', $price);
        $price = str_replace(',', '.', $price);

        $spot = new Spot([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'location' => $request->get('location'),
            'price' => floatval($price),
            'type_id' => $request->get('type'),
            'villager' => $request->get('villager'),
            'image' => $request->file('image')->hashName(),
        ]);

        $spot->save();
        $spots = Spot::where('villager', $spot->villager)->get();
        $user = User::find($spot->user_id);
        return view('spot.mySpots', compact('spots', 'user'));
    }

    /**
     * Display the specified resource.
     * 
     * @param \App\Models\Spot $spot
     * @return \Illuminate\Http\Response
     */
    public function show(Spot $spot)
    {
        $type = Type::find($spot->type_id);
        $villager = User::find($spot->villager);
        $reviews = Review::where('spot_id', $spot->id)->get();
        $users = User::all();
        return view('spot.show', compact('spot', 'type', 'villager', 'reviews', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param \App\Models\Spot $spot
     * @return \Illuminate\Http\Response
     */
    public function edit(Spot $spot)
    {
        $types = Type::all();
        return view('spot.edit', compact('spot', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *      
     * @param \App\Models\Spot $spot
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spot $spot)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:5000',
            'location' => 'required|string|max:30',
            'price' => 'required',
            'type' => 'required|integer',
            'villager' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->file('image') != null) {

            $request->file('image')->store('public/images');
            if($spot->image != 'spot-image-placeholder.jpeg') {

                File::delete('storage/images/' . $spot->image);
            }
            $spot->image = $request->file('image')->hashName();
        }

        $price = $request->get('price');
        $price = str_replace(' ', '', $price);
        $price = str_replace(',', '.', $price);

        $spot->name = $request->get('name');
        $spot->description = $request->get('description');
        $spot->price = floatval($price);
        $spot->type_id = $request->get('type');
        $spot->villager = $request->get('villager');

        $spot->save();
        $spots = Spot::where('villager', $spot->villager)->get();
        $user = User::find($spot->villager);

        return redirect()->route('mySpots', compact('spots', 'user'));
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param \App\Models\Spot $spot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spot $spot)
    {
        $reviews = Review::where('spot_id', $spot->id)->get();
        $reviews->each->delete();

        if($spot->image != 'spot-image-placeholder.jpeg') {

            File::delete('storage/images' . $spot->image);
        }

        $spot->delete();

        return view('spots.mySpots', compact('spots', 'user'));
    }

    public function search(Request $request) {

        $search = $request->get('search');
        $order = $request->get('order');

        if($order == 'priceAsc'){
            $spots = Spot::where('name', 'ilike', '%' . $search . '%')->orderBy('price', 'asc')->paginate(10);
        } 
        else if($order == 'priceDesc'){
            $spots = Spot::where('name', 'ilike', '%' . $search . '%')->orderBy('price', 'desc')->paginate(10);
        }
        else if($order == 'name'){
            $spots = Spot::where('name', 'ilike', '%' . $search . '%')->orderBy('name', 'asc')->paginate(10);
        }
        else if($order == 'dateAsc'){
            $spots = Spot::where('name', 'ilike', '%' . $search . '%')->orderBy('created_at', 'asc')->paginate(10);
        }
        else if($order == 'dateDesc'){
            $spots = Spot::where('name', 'ilike', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $spots = Spot::where('name', 'ilike', '%' . $search . '%')->paginate(10);
        }

        return view('spots.index', compact('spots', 'search', 'order'));
    }

    public function mySpots(User $user) {

        $spots = Spot::where('villager', $user->id)->paginate(5);
        return view('spot.mySpots', compact('spots', 'user'));
    }


    //GERIR CARRINHO
    public function cart() {

        return view('cart');
    }

    public function addToCart($id) {

        $spot = Spot::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "name" => $spot->name,
                "image" => $spot->image,
                "price" => $spot->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Aldeia adicionada com sucesso!');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Carrinho atualizado com sucesso!');
        }
    }

    public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Aldeia removida com sucesso!');
        }
    }
}
