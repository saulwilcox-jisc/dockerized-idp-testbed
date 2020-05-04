<?php

namespace App\Jisc\SalesforceBundle\Client;

use App\Jisc\SalesforceBundle\Service\UrlGenerator;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class SalesforceClient
{
    protected $token = '00D0E000000AXO2!AQYAQH.Qj3t3EtHMEOU4Jp163n5BXDL10Qat.9q2x25EtnwBYNEePBxl1SAftz_PiptvrXQtaIYcqChUYUL3RqIUQerAEGCg';
    /**
     * @var Client
     */
    private $client;
    /**
     * @var UrlGenerator
     */
    private $urlGenerator;
    private $authEndpoint;
    private $clientId;
    private $username;

    public function __construct(ClientInterface $client, UrlGenerator $urlGenerator, $authEndpoint = '', $clientId = '', $username = '')
    {
        $this->client = $client;
        $this->urlGenerator = $urlGenerator;
        $this->authEndpoint = $authEndpoint;
        $this->clientId = $clientId;
        $this->username = $username;
        $this->testConnection();
    }

    public function testConnection()
    {
        $url = $url = $this->authEndpoint . '/services/oauth2/introspect';
        try {
            $salesforceResponse = $this->client->get(
                $url,
                ['headers' => $this->getAuthorizationHeaders()]
            );
        } catch (\Exception $e) {
            $this->getToken();
        }
    }

    public function getToken()
    {
        $url = $url = $this->authEndpoint . '/services/oauth2/token';
        $payload = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $this->generateJwtAuthCode()
        ];
        try {
            $salesforceResponse = $this->client->post(
                $url,
                [
                    'headers' => $this->getHeaders(),
                    'form_params' => $payload,
                ]
            );
            $data = json_decode($salesforceResponse->getBody()->getContents());
            $this->token = $data->access_token;
        } catch (\Exception $e) {
            print_r($payload);
            print_r($e->getMessage());
            die;
        }
    }

    protected function getHeaders()
    {
        return [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
    }

    public function getObject($type, $id)
    {
        $url = $this->urlGenerator->getUrl('sobjects/' . $type . '/' . $id);
        try {
            $salesforceResponse = $this->client->get(
                $url,
                ['headers' => $this->getAuthorizationHeaders()]
            );
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die;
        }
        return json_decode($salesforceResponse->getBody()->getContents());
    }

    public function query($query)
    {
        $resultsStack= [];
        $url = $this->urlGenerator->getUrl('query', ['q' => $query]);
        $jsonResponse = $this->runQuery($url);
        $resultsStack = array_merge($resultsStack, $jsonResponse->records);
        while (!$jsonResponse->done) {
            $jsonResponse = $this->runQuery($this->urlGenerator->getEndpoint($jsonResponse->nextRecordsUrl));
            $resultsStack = array_merge($resultsStack, $jsonResponse->records);
        }

        return $resultsStack;
    }

    public function runQuery($url)
    {
        try {
            $salesforceResponse = $this->client->get(
                $url,
                ['headers' => $this->getAuthorizationHeaders()]
            );
            $jsonResponse = json_decode($salesforceResponse->getBody()->getContents());
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die;
        }

        return $jsonResponse;
    }


    public function get($action = null, $query = null)
    {
        $url = $this->urlGenerator->getUrl($action, $this->resolveParams($query));
        try {
            $salesforceResponse = $this->client->get(
                $url,
                ['headers' => $this->getAuthorizationHeaders()]
            );
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die;
        }
        return $salesforceResponse->getBody()->getContents();
    }

    /**
     * @param $query
     * @return array|null
     */
    protected function resolveParams($query)
    {
        $params = null;
        if ($query) {
            $params = ['q' => $query];
        }
        return $params;
    }

    /**
     * @return array
     */
    protected function getAuthorizationHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . $this->token
        ];
    }

    protected function generateJwtAuthCode()
    {
        $h = [
            "alg" => "RS256"
        ];
        $jsonH = json_encode(($h));
        $header = (base64_encode($jsonH));
        $exp = strval(time() + (5 * 60));
        $c = [
            "iss" => $this->clientId,
            "sub" => $this->username,
            "aud" => $this->authEndpoint,
            "exp" => $exp
        ];
        $jsonC = json_encode($c);
        $payload = base64_encode($jsonC);
        $privateKey = openssl_get_privatekey("file:///srv/api/jwt/salesforce/server.key", '123456789');

        // This is where openssl_sign will put the signature
        $s = '';

        // Sign the header and payload
        openssl_sign($header . '.' . $payload, $s, $privateKey, OPENSSL_ALGO_SHA256);

        $secret = base64_encode($s);

        $token = $header . '.' . $payload . '.' . $secret;
        $token = strtr($token, '+/', '-_');
        $token = rtrim($token, '=');

        return $token;
    }
}