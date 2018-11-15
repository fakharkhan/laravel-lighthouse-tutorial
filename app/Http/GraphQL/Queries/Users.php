<?php

namespace App\Http\GraphQL\Queries;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Users
{
    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {

        $client = new Client(); //GuzzleHttp\Client

        $headers = [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Origin'        => 'http://graph-ql-demo.softpyramid.com'
        ];

        $query = ['query' => '{ users { id name email} }'];

        $res = $client->post('http://graph-ql-demo.softpyramid.com/graphql', [
            'query'     =>  $query,
            'headers'   =>  $headers
        ]);

        $response = $res->getBody()->getContents();
        $response = json_decode($response);

        return $response->data->users ;


    }


}
