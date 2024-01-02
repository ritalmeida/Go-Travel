<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'spot_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        Review::create($request->all());

        return redirect()->route('spots.show', $request->spot_id)
            ->with('sucess', 'Avaliação feita com sucesso.');
    }
}
