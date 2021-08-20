<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "test";
        // создание нового
//        $product = new Product();
//        $product->name = "Xiaomi";
//        $product->price = 888;
//        $product->save();

//        return view('hello');
//        return view('hello', ['products' => Product::all(), 'qqq' => "dff"]);

//        return view('hello', ['products' => Product::where('id', 9)->get()]);
//        return view('hello', ['products' => Product::
//                                                where('name', 'like', 'Sam%')
//                                                ->get()]);

//        return view('hello', ['products' => Product::
//                                                where([
//                                                    ['name', 'like', 'L%']
//                                                ])->get()]);

//        return view('hello', ['products' => Product::
//                                                where([
//                                                    ['name', 'like', 'L%'],
//                                                    ['id', '=', 10]
//                                                ])->get()]);

        $cities = DB::table('hashtagexpress.cities')->get();

            // апдейт товара
//        $product = Product::find(12);
//        $product->name = "Xiaomi1";
//        $product->price = 99;
//        $product->save();

        // метод update
//        Product::
//        where('id', 12)
//        ->update(['price' => 899]);

        // метод update
//        Product::
//        where('name', 'like', 'A%')
//        ->update(['price' => 1999]);


//        $users = DB::table('users')
//            ->select(DB::raw('count(*) as user_count, status'))
//            ->where('status', '<>', 1)
//            ->groupBy('status')
//            ->get();

//        $find = Product::
//                    where([
//                        ['name', 'like', 'X%']
//                        ])
//                    ->get();

        $find = Product::
                    where([
                        ['name', 'like', 'X%']
                        ])
                    ->first();

        return view('hello', ['products' => Product::
                                                where([
                                                    ['name', 'like', 'L%'],
                                                    ['id', '=', 10]
                                                    ])
                                                ->orWhere([
                                                    ['name', 'like', 'A%'],
                                                    ])
                                                ->orWhere([
                                                    ['name', 'like', 'X%'],
                                                    ])
                                                ->get(),
                                    'cities' => $cities,
                                    'find' => $find
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
