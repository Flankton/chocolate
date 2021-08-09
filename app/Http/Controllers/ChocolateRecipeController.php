<?php

namespace App\Http\Controllers;

use App\Models\ChocolateRecipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChocolateRecipeController extends Controller
{
    /**
     * Show a selected chocolate bar
     *
     * @param  int  $myId
     * @return JsonResponse
     */
    public function show($myId) : JsonResponse
    {
        if(!ChocolateRecipe::where('id', $myId)->exists()){
            return response()->json([
                'code'      =>  404,
                'message'   =>  'Produto não encontrado'
            ]);
        }

        $ChocolateRecipe = ChocolateRecipe::where([
            'id' => $myId,
            'deleted' => false]
            )
        ->first();

        return response()->json($ChocolateRecipe);
        
    }

    /**
     * Show all Produtos
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        
        $ChocolateRecipes = ChocolateRecipe::where('deleted', false)
        ->get();

        return response()->json($ChocolateRecipes);
        
    }

      /**
     * Create new chocolate bar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
            $request->validate([
                'cocoa_lote_id' => 'required|int',
                'chocolate_bar_id' => 'required|int',
                'weight' => 'required',
            ]);

            $data = $request->only([
                'cocoa_lote_id',
                'chocolate_bar_id',
                'weight',
            ]);

            $data['created_at'] = date('Y-m-d H:i:s');
            
            ChocolateRecipe::create($data);

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

            if(!ChocolateRecipe::where([
                'id' => $myId,
                'deleted' => false]
                )->exists()){
                return response()->json([
                    'code'      =>  404,
                    'message'   =>  'Produto não encontrado'
                ]);
            }

            $data = $request->only([
                'weight'
            ]);

            $data['updated_at_at'] = date('Y-m-d H:i:s');
            
            $ChocolateRecipe = ChocolateRecipe::where([
                'id' => $myId,
                'deleted' => false]
                )->first();

            $ChocolateRecipe->update($data);

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

            if(!ChocolateRecipe::where('id', $myId)->exists()){
                return response()->json([
                    'code'      =>  404,
                    'message'   =>  'Produto não encontrado'
                ]);
            }
            
            $ChocolateRecipe = ChocolateRecipe::where('id', $myId)->first();

            $ChocolateRecipe['deleted'] = true;
            $ChocolateRecipe->update();

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Produto deletado com sucesso'
            ]);
    }
}