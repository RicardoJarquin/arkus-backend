<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserAccountRequest;
use App\Http\Requests\UpdateUserAccountRequest;
use App\Http\Resources\UserAccountResource;
use App\Http\Resources\UserResource;
use App\Models\UserAccount;

class UserAccountController extends Controller
{
    public function show($userAccount)
    {
        return new UserAccountResource(UserAccount::where('user_id', $userAccount)->first());
    }

    public function store(StoreUserAccountRequest $request)
    {
        $data = $request->validated();
        $account = UserAccount::create($data);


        return response(new UserResource($account) , 201);
    }

    public function update(UpdateUserAccountRequest $request)
    {
        $data = $request->validated();

        $userAccount = UserAccount::where('user_id', $data['user_id'])->where('account_id', $data['account_id'])->first();
        $userAccount->update($data);

        return new UserAccountResource($userAccount);
    }

    public function destroy($userId, $accountId)
    {
        //dd($accountId, $userId);
        $userAccount = UserAccount::where('user_id', $userId)->where('account_id', $accountId)->first();
        $userAccount->delete();

        return response("", 204);
    }
}
