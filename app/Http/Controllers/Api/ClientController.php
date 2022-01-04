<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    /**
     * Get Clients list.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $clients = Client::filter(request()->all())
            ->getOrPaginate();

        return $this->indexResponse(ClientResource::collection($clients));
    }

    /**
     * Display the specified Client.
     * 
     * @param Client $client
     *
     * @return JsonResponse
     */
    public function show(Client $client): JsonResponse
    {
        return $this->showResponse(new ClientResource($client));
    }

    /**
     * Store a newly created Client in storage.
     * 
     * @param ClientRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(ClientRequest $request): JsonResponse
    {
        $client = Client::create($request->validated());

        return $this->storeResponse(new ClientResource($client));
    }

    /**
     * Update the specified Client in storage.
     * 
     * @param ClientRequest $request
     * @param Client $client
     * @param ClientRepository $clientRepository
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(ClientRequest $request, Client $client, ClientRepository $clientRepository): JsonResponse
    {
        $client = $clientRepository->update($client, $request->validated());

        return $this->updateResponse(new ClientResource($client));
    }

    /**
     * Remove the specified Client from storage.
     * 
     * @param Client $client
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Client $client): JsonResponse
    {
        $this->destroyModel($client);

        return $this->destroyResponse(new ClientResource($client));
    }
}
