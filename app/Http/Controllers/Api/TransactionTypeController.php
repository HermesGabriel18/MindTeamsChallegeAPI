<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConstantResource;
use App\Models\TransactionType;
use Illuminate\Http\JsonResponse;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of all transaction types.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        $transaction_types = TransactionType::get();

        return $this->dataResponse('index', ConstantResource::collection($transaction_types));
    }
}