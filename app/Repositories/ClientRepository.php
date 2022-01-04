<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{

    /**
     * @param Client $client
     * @param array $data
     * @return Client
     */
    public function update(Client $client, array $data): Client
    {
        $client->update($data);

        return $client;
    }

}
