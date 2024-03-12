<?php

namespace App\Http\Controllers;

use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        if (!session('cart')) {
            return view('cart');
        }
        $productsWithQuantities = session('cart');
        $total = $this->totalCart();
        return view('cart', compact('productsWithQuantities', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $request->quantity;
        } else {
            $cart[$product->id] = $request->quantity;
        }

        $request->session()->put('cart', $cart);


        $cart_total = $this->totalCart();

        $total_products_count = count(request()->session()->get('cart'));

        return redirect()->back()->with('success', 'Product added to cart successfully!')->with('cart_total', $cart_total)->with('total_products_count', $total_products_count);

    }

    public function update(Request $request)
    {

        if (isset($request->product_id) && isset($request->quantity)) {
            $cart = $request->session()->get('cart');

            if ($request->quantity == 0) {
                unset($cart[$request->product_id]);
                $request->session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product removed from cart successfully!');
            }
            $cart[$request->product_id] = $request->quantity;
            $request->session()->put('cart', $cart);

            $cart_total = $this->totalCart();

            $total_products_count = count(request()->session()->get('cart'));

            return redirect()->back()->with('success', 'Product added to cart successfully!')->with('cart_total', $cart_total)->with('total_products_count', $total_products_count);
        }
        return redirect()->back()->with('error', 'Product not added to cart!');
    }

    public function remove(Request $request)
    {
        $cart = $request->session()->get('cart');
        unset($cart[$request->product_id]);
        $request->session()->put('cart', $cart);

        $cart_products = collect(request()->session()->get('cart'));
        $cart_total = 0;
        if (session('cart')) {
            foreach ($cart_products as $quantity) {

                $cart_total += $quantity * $request->price;
            }
        }

        $total_products_count = count(request()->session()->get('cart'));

        return redirect()->back()->with('success', 'Product removed from cart successfully!')->with('cart_total', $cart_total)->with('total_products_count', $total_products_count);
    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public static function totalCart(): int
    {
        $cart_products = collect(request()->session()->get('cart'));
        $cart_total = 0;
        if (session('cart')) {
            foreach ($cart_products as $id => $quantity) {
                $product = Product::find($id, 'TTC_price');

                $cart_total += isset($product) ? $quantity * $product->TTC_price : 0;
            }
        }
        return $cart_total;
    }


    /**
     * @return int number of products in the cart (include quantities)
     */
    public static function totalProductsCount(): int
    {
        $cart_products = collect(request()->session()->get('cart'));
        $total_products_count = 0;
        if (session('cart')) {
            foreach ($cart_products as $quantity) {
                $total_products_count += $quantity;
            }
        }
        return $total_products_count;
    }

    public function checkout(): View
    {
        //on récupère le cart via la session
        $cart_products = collect(request()->session()->get('cart'));

        //création d'une commande en faisant appel au MOdel Order
        $order = Order::create([
            'user_id' => Auth::user()->id,//on récupère l'id de l'utilisateur connecté
            'delivery_fee_id' => fake()->randomElement(DeliveryFee::pluck('id')->toArray()), //récupère un delivery_fee qui existe déjà (pluck)
            'delivered_at' => fake()->dateTimeThisYear(),
            'total' => self::totalCart(), //on utilise la méthode déjà existante
            'status' => 'pending',
        ]);
        $orderlines = [];

        foreach ($cart_products as $id => $quantity) {
            //Récupération des données produits en fonction de l'id dans le cart
            $product = Product::find($id);


            //creation de l'order line en fonction du produit récupéré
            $orderline = OrderLine::create([
                'picture' => $product->picture,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->TTC_price,
                'quantity' => $quantity,
                'order_id' => $order->id,

            ]);

            $orderlines[] = $orderline;
        }

        //vider le cart une fois la commande passée.
        request()-> session()->forget('cart');

        return view('checkout-success', compact(
            'orderlines',
            'order',
        ));
    }


}




