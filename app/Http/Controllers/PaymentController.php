<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Spot;
use App\Models\Buy;
use App\Models\Cart;
use App\Models\Review;
use App\Models\SpotsBuy;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;


class PaymentController extends Controller
{   
    private $stripe;

    /**
     * Instalação da biblioteca "cashier" (laravel)
     */
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    /**
     * 
     */
    public function checkout(Spot $spot)
    {
        return view('payment.checkout', ['price' => $spot->price, 'spot' => $spot, 'type' => 'spot']);
    }

    /**
     * 
     */
    public function paymentProduct(Request $request, Spot $spot)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/');
        }

        $token = $this->createToken($request);

        if (!empty($token['error'])) {
            return response()->redirectTo('/');
        }
        if (empty($token['id'])) {
            return response()->redirectTo('/');
        }

        $charge = $this->createCharge($token['id'], $request->price * 100);

        if (!empty($charge) && $charge['status'] == 'succeeded') {

            $buy = new Buy();
            $buy->user_id = auth()->user()->id;
            $buy->total = $request->price;
            $buy->save();

            $spotsBuy = new SpotsBuy();
            $spotsBuy->buy_id = $buy->id;
            $spotsBuy->product_id = $spot->id;
            $spotsBuy->quantity = 1;
            $spotsBuy->total = $spot->price;
            $spotsBuy->save();

            if($spot->stock - 1 == 0) {

                $reviews = Review::where('spot_id', $spot->id)->get();
                $reviews->each->delete();

                $carts = Cart::where('spot_id', $spot->id)->get();
                $carts->each->delete();

                if($spot->image != 'spot-image-placeholder.jpeg'){
                    File::delete('storage/images/' . $spot->image);
                }

                $spotsBuy = SpotsBuy::where('spot_id', $spot->id)->get();
                $spotsBuy->each->delete();

                $spot->delete();

            }else {

                $spot->stock = $spot->stock - 1;
                $spot->save();

            }

            return redirect()->route('emailReceipt', ['buy' => $buy]);
        }
        return response()->redirectTo('/');
    }

    /**
     * 
     */
    public function paymentCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('danger', $validator->errors()->first());
            return response()->redirectTo('/');
        }

        $token = $this->createToken($request);

        if (!empty($token['error'])) {
            return response()->redirectTo('/');
        }
        if (empty($token['id'])) {
            return response()->redirectTo('/');
        }

        $charge = $this->createCharge($token['id'], $request->price * 100);

        if (!empty($charge) && $charge['status'] == 'succeeded') {

            $buy = new Buy();
            $buy->user_id = auth()->user()->id;
            $buy->total = $request->price;
            $buy->save();

            $carts = Cart::where('user_id', auth()->user()->id)->get();

            foreach ($carts as $cart) {
                $spotsBuy = new SpotsBuy();
                $spotsBuy->buy_id = $buy->id;
                $spotsBuy->spot_id = $cart->spot_id;
                $spotsBuy->quantity = $cart->quantity;
                $spotsBuy->total = $cart->price;
                $spotsBuy->save();

                $spot = Spot::find($cart->spot_id);

                if($spot->stock - 1 == 0) {

                    $reviews = Review::where('spot_id', $spot->id)->get();
                    $reviews->each->delete();

                    $carts = Cart::where('spot_id', $spot->id)->get();
                    $carts->each->delete();

                    if($spot->image != 'spot-image-placeholder.jpeg'){
                        File::delete('storage/images/' . $spot->image);
                    }

                    $spotsBuy = SpotsBuy::where('spot_id', $spot->id)->get();
                    $spotsBuy->each->delete();

                    $spot->delete();

                }else {

                    $spot->stock = $spot->stock - 1;
                    $spot->save();

                }
            }
            
            return redirect()->route('emailReceipt', ['buy' => $buy]);
        }
        return response()->redirectTo('/');
    }

    /**
     * 
     */
    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'eur',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}