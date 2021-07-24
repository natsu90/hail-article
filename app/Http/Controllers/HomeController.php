<?php

namespace App\Http\Controllers;

use Hail\OAuth\Provider;
use Illuminate\Http\Request;
use Hail\Api\Client;

class HomeController extends Controller
{
    private $provider;

    public function __construct()
    {
        $this->provider = new Provider([
            'clientId' => env('CLIENT_ID'),
            'clientSecret' => env('CLIENT_SECRET'),
            'redirectUri' => url('/callback')
        ]);
    }

    public function index(Request $request)
    {
        $isLoggedIn = $request->session()->has('accessToken');
        if (!$isLoggedIn) {
            return view('guest');
        }
        
        $accessToken = $request->session()->get('accessToken');
        $client = new Client($accessToken);
        $articles = $client->getCurrentArticles();
        return view('home', compact('articles'));
    }

    public function oauth(Request $request)
    {
        $authUrl = $this->provider->getAuthorizationUrl();
        $request->session()->put('oauthState', $this->provider->getState());
        return redirect($authUrl);
    }

    public function oauthCallback(Request $request)
    {
        $oauthCode = $request->input('code');
        $oauthState = $request->input('state');
        $previousOauthState = $request->session()->get('oauthState');

        if (empty($oauthState) || $oauthState != $previousOauthState) {
            throw new \Exception('Invalid State');
        }

        if (!empty($oauthCode)) {
            $accessToken = $this->provider->getAccessToken('authorization_code', [
                'code' => $oauthCode
            ]);
            $request->session()->put('accessToken', $accessToken);
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
