<?php

namespace App\Controllers;

class DefaultController
{
    /**
     * This magic method is invoked by default. There is no need to declare it on the route
     */
    public function __invoke($request, $response)
    {
        $slug = $request->getAttribute('slug');

        return $response->withJson(
            $ret = [
                "status" => 200,
                "message" => "OK",
                "response" => [
                    "info" => "This is a simple API to retrieve public Facebook Profile info. Only one route is accepted",
                    "hit" => "The Route you are attempting to reach '/{$slug}' is not valid",
                    "usage" => "Hit the Route: /profile/facebook/{profile-id} where 'profile-id' stands for a valid Facebook Profile ID and see the JSON Results",
                ]
            ]
        );
    }
}
