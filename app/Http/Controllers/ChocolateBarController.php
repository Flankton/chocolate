<?php

namespace App\Http\Controllers;

use App\Models\ChocolateBar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChocolateBarController extends Controller
{
    /**
     * Show a selected chocolate bar
     *
     * @param  int  $myId
     * @return JsonResponse
     */
    public function show($myId) : JsonResponse
    {
        if(!ChocolateBar::where('id', $myId)->exists()){
            return response()->json([
                'code'      =>  404,
                'message'   =>  'Produto não encontrado'
            ]);
        }

        $chocolateBar = ChocolateBar::where([
            'id' => $myId,
            'deleted' => false]
            )
        ->with('recipes')
        ->first();

        return response()->json($chocolateBar);
        
    }

    /**
     * Show all Produtos
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        
        $chocolateBars = ChocolateBar::where('deleted', false)
        ->get();

        return response()->json($chocolateBars);
        
    }

      /**
     * Create new chocolate bar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
            $data = $request->only([
                'public_id'
            ]);

            $data['created_at'] = date('Y-m-d H:i:s');
            
            ChocolateBar::create($data);

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Produto adicionado com sucesso'
            ]);
    }

      /**
     * Update the chocolate bar selected
     *
     * @param int myid
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request, $myId) : JsonResponse
    {

            if(!ChocolateBar::where([
                'id' => $myId,
                'deleted' => false]
                )->exists()){
                return response()->json([
                    'code'      =>  404,
                    'message'   =>  'Produto não encontrado'
                ]);
            }

            $data = $request->only([
                'public_id'
            ]);

            $data['updated_at_at'] = date('Y-m-d H:i:s');
            
            $chocolateBar = ChocolateBar::where([
                'id' => $myId,
                'deleted' => false]
                )->first();

            $chocolateBar->update($data);

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Produto atualizado com sucesso'
            ]);
    }

      /**
     * Update the chocolate bar selected
     *
     * @param int myid
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request, $myId) : JsonResponse
    {

            if(!ChocolateBar::where('id', $myId)->exists()){
                return response()->json([
                    'code'      =>  404,
                    'message'   =>  'Produto não encontrado'
                ]);
            }
            
            $chocolateBar = ChocolateBar::where('id', $myId)->first();

            $chocolateBar['deleted'] = true;
            $chocolateBar->update();

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Produto deletado com sucesso'
            ]);
    }

     /**
     * Update the chocolate bar selected
     *
     * @param int myid
     * @return JsonResponse
     */
    public function getChocolate($myId) : JsonResponse
    {
        $chocolate = ChocolateBar::where([
            'public_id' => $myId,
            'deleted' => false
        ])
        ->with(['recipes' => function($recipe){
            $recipe->where('deleted', false)
                    ->with(['cocoaLote' => function($cocoaLote){
                        $cocoaLote->where('deleted', false)
                        ->with('provider');
                    }]);
        }])
        ->get();

        return response()->json($chocolate);
    }
}