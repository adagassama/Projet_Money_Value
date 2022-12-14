<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PairResource;
use App\Models\currency;
use App\Models\Pairs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PairsController extends Controller
{

    // Methode permettant de tester si l'API de conversion est fonctionnelle
    public function conversion()
    {
        return response()->json([
            'success' => true,
            'message' => 'API fonctionnelle',
            'status'    => 200
        ], 200);
    }

    // Méthode permettant de faire une  conversion de devise en fonction des paramètres qui lui seront transmis par l'utilisateur
    public function convert($curr1, $curr2, $amount, $invert = false)
    {
        $codeFrom = Currency::where('code', $curr1)->first();
        $codeTo = Currency::where('code', $curr2)->first();

        if(isset($codeFrom)){
            if(isset($codeTo)){
                $pair = Pairs::with('from', 'to')
                    ->where('from_id', $codeFrom->id)
                    ->where('to_id', $codeTo->id)->first();
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Devise 2 non trouvée'
                ], 404);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Devise 1 non trouvée'
            ], 404);
        }

        if($pair) {
            if ($invert == 'true') {
                $converted = $amount * (1/$pair->rates);
                $req = $pair->nbreRequest + 1;
                // Stosker le nombre requête en BD
                DB::table('pairs')
                    ->where('id', $pair->id)
                    ->update(['nbreRequest' => $req]);

                $data = [
                    'amount_currecy_from'   => $amount,
                    'from'                  => $curr1,
                    'amount_currency_to'    => $converted,
                    'to'                    => $curr2,
                    'Requête'              => $req
                ];
            } else {
                $converted = $amount * $pair->rates;
                $req = $pair->nbreRequest + 1;
                // Stosker le nombre requête en BD
                DB::table('pairs')
                    ->where('id', $pair->id)
                    ->update(['nbreRequest' => $req]);

                $data = [
                    'amount_currency_from' => $amount,
                    'from'                 => $curr1,
                    'amount_currency_to'   => $converted,
                    'to'                   => $curr2,
                    'Requête'              => $req,
                ];

            }
            return response()->json([
                'status' => true,
                'convert'=> $data,
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Conversion impossible paire non trouvée'
            ], 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // Récupération de toutes les paires de devises.
    public function index()
    {
        $pairs = Pairs::with('from', 'to')->latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List data pairs',
            'data' => $pairs
        ], 200);
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
    // Ajout d'une paire de devise
     public function store(Request $request)
    {
        $request->validate([
            'from_id'       => ['required'],
            'to_id'         => ['required'],
            'rates'         => ['required'],
        ]);
        $newPair = Pairs::create([
            'from_id'       => $request->from_id,
            'to_id'         => $request->to_id,
            'rates'         => $request->rates,
            'nbreRequest'   => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Paire crée',
            'data' => $newPair
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pairs  $pairs
     * @return \Illuminate\Http\Response
     */
    // Récupération d'une paire de devise en fonction de son id
    public function show(Request $request, $id)
    {
        $pair = Pairs::find($id);
        return new PairResource($pair);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pairs  $pairs
     * @return \Illuminate\Http\Response
     */
    public function edit(Pairs $pairs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pairs  $pairs
     * @return \Illuminate\Http\Response
     */
    // Modification d'une paire de devise
    public function update(Request $request, $id)
    {
        $request->validate([
            'from_id'      => ['required'],
            'to_id'  => ['required'],
            'rates'     => ['required']
        ]);
        $pair = Pairs::find($id);

        $pair->update([
            'from_id' => $request->from_id,
            'to_id' => $request->to_id,
            'rates' => $request->rates
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Paire modifiée',
            'data' => $pair
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pairs  $pairs
     * @return \Illuminate\Http\Response
     */
    // Suppression d'une paire de devise
    public function destroy($id)
    {
        $pairs = Pairs::find($id);
        if ($pairs) {
            $pairs->delete();
            return response()->json([
                'success' => true,
                'message' => 'Paire supprimée'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Paire non trouvée'
        ], 404);
    }
}
