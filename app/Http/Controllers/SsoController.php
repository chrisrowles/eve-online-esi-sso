<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Contracts\EsiClientContract;
use App\Models\Scopes;
use App\Http\Api\JwtValidator;

class SsoController extends Controller
{
    /** @var EsiClientContract $esi */
    protected EsiClientContract $esi;

    /** @var JwtValidator $validator */
    protected JwtValidator $validator;

    /**
     * SsoController constructor.
     *
     * @param EsiClientContract $esi
     */
    public function __construct(EsiClientContract $esi, JwtValidator $validator)
    {
        $this->esi = $esi;
        $this->validator = $validator;
    }

    /**
     * Perform SSO login.
     *
     * @return mixed
     */
    public function login()
    {
        $scopes = Scopes::where('access', 'all')
            ->pluck('name')
            ->toArray();

        $authorizationURL = $this->esi->getAuthorizationServerURL($scopes);

        return redirect($authorizationURL);
    }

    /**
     * Forget SSO character tokens
     */
    public function logout()
    {
        Session::flush();
        return redirect()->route('home');
    }

    /**
     * Receive token from ESI via callback.
     *
     * @param Request $request
     * @return mixed
     * @throws GuzzleException
     */
    public function callback(Request $request)
    {
        try {
            $auth = $this->esi->issueAccessToken($request);

            $expires_on = Carbon::parse(Carbon::now())
                ->addSeconds($auth->expires_in)
                ->toIso8601String();

            $this->validator->validate($auth->access_token);

            Session::put('character.access_token', $auth->access_token);
            Session::put('character.expires_on', $expires_on);
            Session::put('character.refresh_token', $auth->refresh_token);

            return $this->verify();
        } catch (Exception $e) {
            Log::error('SSO error ' . $e->getMessage());

            Session::flush();
            return redirect()->route('home');
        }
    }

    /**
     * Verify login and return character information.
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function verify()
    {
        $character = $this->esi->verifyAuthorization();

        Session::put('character.id', $character->CharacterID);
        Session::put('character.name', $character->CharacterName);
        Session::put('character.scopes', explode(" ", $character->Scopes));
        Session::put('character.portrait', 'https://images.evetech.net/characters/'.
            $character->CharacterID.'/portrait?tenant=tranquility&size=128');


        return redirect(route('home'))
            ->with('logged_in', true);
    }
}
