<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GZ;

class CardsController extends Controller
{
    public function index()
    {
        return response(Card::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function create()
    {

        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://api.canzell.com/__public__/user-service/users');// Url of your choosing
        $responses = $request->getBody();
        //echo "<pre>";
        //dd($response);
        foreach($responses as $response){
            $card = new Card();
            $card->first_name = $response->first_name;
            $card->last_name = $response->last_name;
            $card->email = $response->email;
            $card->phone = $response->phone;
            $card->mug = $respone->mug;
            $card->save();
        }

        return response($card->jsonSerialize(), Response::HTTP_CREATED);
    }

}
