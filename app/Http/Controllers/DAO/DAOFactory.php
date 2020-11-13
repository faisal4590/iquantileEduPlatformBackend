<?php

namespace App\Http\Controllers\DAO;

class DaoFactory
{
    public function make_response($status, $payload)
    {
        $response = array();
        $response["status"] = $status;
        $response["payload"] = $payload;

        $json = json_encode($response);
        return $json;
    }
}
