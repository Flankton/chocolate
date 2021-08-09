<?php

namespace App\Http\Controllers;

use App\Models\ChocolateRecipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChocolateRecipeController extends Controller
{
    /**
     * Show a selected chocolate recipe
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
        ->with('cocoaLote')
        ->with('chocolateBar')
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
        ->with('cocoaLote')
        ->with('chocolateBar')
        ->get();

        return response()->json($ChocolateRecipes);
        
    }

      /**
     * Create new chocolate recipe
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        
            $request->validate([
                'cocoa_lote_id' => 'required|integer',
                'chocolate_bar_id'  => 'required|integer',
                'weight'  => 'required'
            ]);

            $data = $request->only([
                'cocoa_lote_id',
                'chocolate_bar_id',
                'weight',
            ]);

            if($this->limitWeight($request->chocolate_bar_id, $request->weight)){
                return response()->json([
                    'code'      =>  401,
                    'message'   =>  'Limite de peso ultrapassado'
                ]);
            }

            $data['created_at'] = date('Y-m-d H:i:s');
            
            ChocolateRecipe::create($data);

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Produto adicionado com sucesso'
            ]);
    }

      /**
     * Update the chocolate recipe selected
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
     * Update the chocolate recipe selected
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

    private function limitWeight($chocolateId, $weight){
        $weightMax = ChocolateRecipe::where('chocolate_bar_id', $chocolateId)
            ->sum('weight');
        
            if($weightMax+$weight>500){
                return true;
            }
            return false;
    }

}