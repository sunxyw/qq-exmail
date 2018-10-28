<?php

namespace Sunxyw\QqExmail;

trait User
{
    public function user()
    {
        return $this;
    }

    public function create(array $data)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/create';

        $res = $this->post($url, $data);

        return $res['errcode'] == 0 ? true : $res;
    }

    public function update(array $data)
    {
        $url = ' https://api.exmail.qq.com/cgi-bin/user/update';

        $res = $this->post($url, $data);

        return $res['errcode'] == 0;
    }

    public function delete($userId)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/delete';
        $data = [
            'userid' => $userId
        ];

        $res = $this->get($url, $data);

        return $res['errcode'] == 0;
    }

    public function show($userId)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/get';
        $data = [
            'userid' => $userId
        ];

        $res = $this->get($url, $data);

        return $res;
    }

    public function check(array $users)
    {
        $url = 'https://api.exmail.qq.com/cgi-bin/user/batchcheck';

        $res = $this->post($url, ['userlist' => $users]);

        return $res;
    }
}