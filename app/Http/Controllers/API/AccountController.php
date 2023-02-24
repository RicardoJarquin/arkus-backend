<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use App\Http\Resources\UserResource;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
        //$this->middleware('role:super-admin', ["except" => ["index"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\AccountResource
     */
    public function index()
    {
        return AccountResource::collection(Account::query()->orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreAccountRequest  $request
     * @return \App\Http\Resources\AccountResource
     */
    public function store(StoreAccountRequest $request)
    {
        $data = $request->validated();
        $account = Account::create($data);


        return response(new AccountResource($account) , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Account  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return new AccountResource($account);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreAccountRequest  $request
     * @param  Account  $id
     * @return \App\Http\Resources\AccountResource
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $data = $request->validated();
        $account->update($data);

        return new AccountResource($account);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Account  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response("", 204);
    }

}
