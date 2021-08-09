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

        $ChocolateBar = ChocolateBar::where([
            'id' => $myId,
            'deleted' => false]
            )
        ->with('recipes')
        ->first();

        return response()->json($ChocolateBar);
        
    }

    /**
     * Show all Produtos
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        
        $ChocolateBars = ChocolateBar::where('deleted', false)
        ->get();

        return response()->json($ChocolateBars);
        
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
            
            $ChocolateBar = ChocolateBar::where([
                'id' => $myId,
                'deleted' => false]
                )->first();

            $ChocolateBar->update($data);

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
            
            $ChocolateBar = ChocolateBar::where('id', $myId)->first();

            $ChocolateBar['deleted'] = true;
            $ChocolateBar->update();

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Produto deletado com sucesso'
            ]);
    }
}