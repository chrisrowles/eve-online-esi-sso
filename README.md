# EVE Online SSO site

![Screenshot](https://raw.githubusercontent.com/chrisrowles/eve-online-esi-sso/master/screenshot.png)

## Table of contents

* [Using SSO](#using-single-sign-on)
  * [Authorization Flow](#authorization-flow)
* [Importing Data from the ESI](#importing-data)

## Documentation

### Using Single Sign-On

#### Authorization Flow

1. The user will navigate to `http://localhost/auth/login`, which will redirect the user to the EVE SSO authorization server.
    The request to the EVE SSO authorization server will contain the following query parameters:
      - response_type=`code`
      - redirect_uri=`<app-callback-url>`
      - client_id=`<app-client-id>`
      - scope=`<space-delimited-scopes>`
      - state=`<random-string>`
    
2. The user will log in with their specified EVE online account and character, EVE SSO will then make a GET request to the callback URL provided (`redirect_uri`), containing a
single-use authorization code that expires in 5 minutes from the time of issue.

3. The callback endpoint will retrieve the authorization code from the request and make a POST request to `https://login.eveonline.com/v2/oauth/token` with a payload containing the code, using [Basic authentication](https://swagger.io/docs/specification/authentication/basic-authentication/) where the application's client ID is the username and the client secret key is the password.

5. EVE SSO will respond with a JSON payload containing a JWT access token and a refresh token that looks like this:

    ```
    {
      "access_token": <JWT token>,
      "expires_in": 1199,
      "token_type": "Bearer",
      "refresh_token": <unique string>
    }
    ```

## Useful Links

* [Crowd-sourced documentation](https://docs.esi.evetech.net/)
* [EVE Swagger Interface](https://esi.evetech.net/ui/)
* [EVE Developers](https://developers.eveonline.com/)

