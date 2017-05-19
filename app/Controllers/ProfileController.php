<?php

namespace App\Controllers;

use Slim\Container;

class ProfileController
{
    protected $container;

    /**
     * By declaring the constructor with Type Hinting, the parameter get's injected!
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * This magic method is invoked by default. There is no need to declare it on the route
     */
    public function __invoke($request, $response)
    {
        try {
            $id = $request->getAttribute('profile_id');
            $this->container->logger->info(
                "Slim Framework test '/profile/facebook/' route with {profile-id}: " . $id,
                ["context" => ["file" =>  __FILE__, "line" => __LINE__]]
            );

            $fbReq = $this->container->get('fbRequest');
            $fbReq->setMethod('GET');
            $fbReq->setEndpoint("/{$id}");

            $res = $this->container->get('fbObject')->getClient()->sendRequest($fbReq);
            $dataNode = $res->getGraphNode();

            $fullName = explode(" ", $dataNode->asArray()["name"]);

            $ret = [
                "status" => $res->getHttpStatusCode(),
                "message" => "OK",
                "response" => [
                    "id" => $dataNode->asArray()["id"],
                    "firstName" => ucfirst($fullName[0]),
                    "lastName" => ucfirst($fullName[count($fullName)-1])
                ]
            ];
        } catch (\Exception $e) {
            $ret = ["status" => 500, "message" => "ERROR", "error" => ["code" => $e->getCode(), "message" => $e->getMessage()]];
        }

        return $response->withJson($ret);
    }
}
