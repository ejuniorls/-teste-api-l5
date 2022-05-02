<?php

namespace App\Http\Controllers;

use App\Api\ApiError;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    /**
     * @var Person
     */
    private Person $person;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    public function index()
    {
        return $this->person->all();

//        $data = ['data' => $this->person->paginate(10)];
//        $data = $this->person->all();
//        return response()->json($data);
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
            $personData = $request->all();
            $this->person->create($personData);
            $return = ['data' => ['msg' => 'Pessoa criado com sucesso!']];
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
        $person = $this->person->find($id);
        if (!$person) return response()->json(ApiError::errorMessage('Pessoa não localizada', 4040), 404);
        $data = ['data' => $person];
        return response()->json($data);
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
            $personData = $request->all();
            $person = $this->person->find($id);
            $person->update($personData);
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
            $person = $this->person->find($id);
            if (!$person) return response()->json(ApiError::errorMessage('Pessoa não localizada', 4041), 404);
            $person->delete();
            return response()->json(['data' => ['msg' => 'Pessoa: ' . $person->name . ' removida com sucesso']], 200);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
            }

            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação de remover', 1012));
        }
    }
}
