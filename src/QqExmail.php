<?php

namespace Sunxyw\QqExmail;

use function Couchbase\defaultDecoder;
use GuzzleHttp\Client;
use http\Exception\BadQueryStringException;

class QqExmail
{
    protected $corpid;
    protected $corpsecret;
    protected $guzzleOptions = [];
    protected $accessToken;

    use User;

    public function __construct($corpid, $corpsecret)
    {
        $this->corpid = $corpid;
        $this->corpsecret = $corpsecret;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    protected function post($url, $data = [])
    {
        if (empty($this->accessToken)) {
            $this->accessToken = $this->getAccessToken();
        }

        $query = array_merge($data, [
            'access_token' => $this->accessToken
        ]);

        dump($query);

        $res = $this->getHttpClient()->post($url, [
            'query' => $query,
        ])->getBody()->getContents();

        return json_decode($res, true);
    }

    protected function get($url, array $data = [])
    {
        if (empty($this->accessToken)) {
            $this->accessToken = $this->getAccessToken();
        }

        dump($data);

        $url = $url . '?' . http_build_query(array_merge([
                'access_token' => $this->accessToken
            ], $data));

        dump($url);

        $res = $this->getHttpClient()->get($url)->getBody()->getContents();

        return json_decode($res, true);
    }

    protected function getAccessToken()
    {
        $url = "https://api.exmail.qq.com/cgi-bin/gettoken?corpid={$this->corpid}&corpsecret={$this->corpsecret}";

        $res = $this->getHttpClient()->get($url)->getBody()->getContents();
        $res = json_decode($res, true);

        return $res['access_token'];
    }
}