<?php

namespace App\Http\Controllers;

use App\Api\ApiError;
use App\Models\Contact;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class ContactController extends BaseController
{
    /**
     * @var Contact
     */
    private Contact $contact;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        return $this->contact->all();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $contactData = $request->all();
            $this->contact->create($contactData);
            $return = ['data' => ['msg' => 'Contato criado com sucesso!']];
            return response()->json($return, 201);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
            }

            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = $this->contact->find($id);
        if (!$contact) return response()->json(ApiError::errorMessage('Pessoa não localizada', 4040), 404);
//        $data = ['data' => $contact];
        return response()->json($contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $contactData = $request->all();
            $contact = $this->contact->find($id);
            $contact->update($contactData);
            $return = ['data' => ['msg' => 'Pessoa atualizada com sucesso!']];
            return response()->json($return, 201);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1011), 500);
            }

            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação de atualizar', 1011), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $contact = $this->contact->find($id);
            if (!$contact) return response()->json(ApiError::errorMessage('Pessoa não localizada', 4041), 404);
            $contact->delete();
            return response()->json(['data' => ['msg' => 'Pessoa: ' . $contact->name . ' removida com sucesso']], 200);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
            }

            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação de remover', 1012));
        }
    }

}
