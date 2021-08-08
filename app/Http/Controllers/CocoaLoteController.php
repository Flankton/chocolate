<?php

namespace App\Http\Controllers;

use App\Models\CocoaLote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CocoaLoteController extends Controller
{
    /**
     * Show a selected lote of cocoa
     *
     * @param  int  $myId
     * @return JsonResponse
     */
    public function show($myId) : JsonResponse
    {
        if(!CocoaLote::where('id', $myId)->exists()){
            return response()->json([
                'code'      =>  404,
                'message'   =>  'Lote não encontrado'
            ]);
        }

        $cocoaLote = CocoaLote::where([
            'id' => $myId,
            'deleted' => false]
            )
        ->with('provider')
        ->first();

        return response()->json($cocoaLote);
        
    }

    /**
     * Show all cocoa lotes
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        
        $cocoaLotes = CocoaLote::where('deleted', false)
        ->with('provider')
        ->get();

        return response()->json($cocoaLotes);
        
    }

      /**
     * Create new lote of cocoa
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
            $request->validate(
            [
                'description' => 'string',
                'provider_id' => 'required|integer',
                'organic' => 'boolean'
            ]);

            $data = $request->only([
                'description', 'provider_id', 'organic'
            ]);

            $data['created_at'] = date('Y-m-d H:i:s');
            
            CocoaLote::create($data);

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Lote adicionado com sucesso'
            ]);
    }

      /**
     * Update the lote of cocoa selected
     *
     * @param int myid
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request, $myId) : JsonResponse
    {

            if(!CocoaLote::where([
                'id' => $myId,
                'deleted' => false]
                )->exists()){
                return response()->json([
                    'code'      =>  404,
                    'message'   =>  'Lote não encontrado'
                ]);
            }

            $request->validate(
            [
                'description' => 'string',
                'organic' => 'boolean'
            ]);

            $data = $request->only([
                'description', 'organic'
            ]);

            $data['updated_at_at'] = date('Y-m-d H:i:s');
            
            $cocoaLote = CocoaLote::where([
                'id' => $myId,
                'deleted' => false]
                )->first();

            $cocoaLote->update($data);

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Lote atualizado com sucesso'
            ]);
    }

      /**
     * Update the lote of cocoa selected
     *
     * @param int myid
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request, $myId) : JsonResponse
    {

            if(!CocoaLote::where('id', $myId)->exists()){
                return response()->json([
                    'code'      =>  404,
                    'message'   =>  'Lote não encontrado'
                ]);
            }
            
            $cocoaLote = CocoaLote::where('id', $myId)->first();

            $cocoaLote['deleted'] = true;
            $cocoaLote->update();

            return response()->json([
                'code'      =>  200,
                'message'   =>  'Lote deletado com sucesso'
            ]);
    }
}