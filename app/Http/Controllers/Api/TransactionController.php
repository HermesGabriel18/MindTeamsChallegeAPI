<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    protected bool $female = true;

    /**
     * Get Transaction list.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $transaction = Transaction::filter(request()->all())
            ->getOrPaginate();

        return $this->indexResponse(TransactionResource::collection($transaction
            ->load('user', 'project', 'createdBy')));
    }

    /**
     * Display the specified Transaction.
     * 
     * @param Transaction $transaction
     *
     * @return JsonResponse
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return $this->showResponse(new TransactionResource($transaction
            ->load('user', 'project', 'createdBy')));
    }

}
