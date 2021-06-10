<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardSet;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $setFilter = $request->set ?? 1;

            $cards = CardSet::whereHas('cards', function ($cards) use ($setFilter) {
                return $cards->where('id', $setFilter);
            })
                ->with([
                    'cards' => function ($cards) {
                        return $cards->with([
                            'cardType',
                            'cardSet',
                            'cardClass'
                        ]);
                    }
                ])
                ->orderBy('id');
            return response($cards->paginate(10), Response::HTTP_OK);
        } catch (Exception $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:cards',
                'card_class_id' => 'required|exists:card_classes,id',
                'card_type_id' => 'required|exists:card_types,id',
                'card_set_id' => 'required|exists:card_sets,id',
            ], [
                'name.required' => 'Você deve preencher o nome da carta.',
                'name.unique' => 'Já existe uma carta com este nome, favor especificar um nome diferente.',

                'card_class_id.required' => 'Você deve selecionar a classe da carta.',
                'card_class_id.exists' => 'Você deve selecionar uma classe válida para a carta.',

                'card_type_id.required' => 'Você deve selecionar o tipo da carta.',
                'card_type_id.exists' => 'Você deve selecionar um tipo válido para a carta.',

                'card_set_id.required' => 'Você deve selecionar o set da carta.',
                'card_set_id.exists' => 'Você deve selecionar um set válido para a carta.',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $card = Card::create($request->all());

            return response([
                'message' => 'Carta criada com sucesso!',
                'card' => Card::with([
                    'cardType',
                    'cardSet',
                    'cardClass',
                ])->find($card->id)
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:cards,name,' . $id . ',id',
                'card_class_id' => 'required|exists:card_classes,id',
                'card_type_id' => 'required|exists:card_types,id',
                'card_set_id' => 'required|exists:card_sets,id',
            ], [
                'name.required' => 'Você deve preencher o nome da carta.',
                'name.unique' => 'Já existe uma carta com este nome, favor especificar um nome diferente.',

                'card_class_id.required' => 'Você deve selecionar a classe da carta.',
                'card_class_id.exists' => 'Você deve selecionar uma classe válida para a carta.',

                'card_type_id.required' => 'Você deve selecionar o tipo da carta.',
                'card_type_id.exists' => 'Você deve selecionar um tipo válido para a carta.',

                'card_set_id.required' => 'Você deve selecionar o set da carta.',
                'card_set_id.exists' => 'Você deve selecionar um set válido para a carta.',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $card = Card::findOrFail($id);

            $card->update($request->all());

            return response([
                'message' => 'Carta atualizada com sucesso!',
                'card' => Card::with([
                    'cardType',
                    'cardSet',
                    'cardClass',
                ])->find($id)
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function show($id)
    {
        try {
            $cards = Card::with([
                'cardType',
                'cardSet',
                'cardClass'
            ])->findOrFail($id);

            return response($cards, Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => 'Carta não encontrada'], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete($id)
    {
        try {
            $card = Card::with([
                'cardType',
                'cardSet',
                'cardClass'
            ])->findOrFail($id);

            $card->delete();

            return response([
                'message' => 'Carta excluída com sucesso.'
            ], Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => 'Carta não encontrada'], Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
