<?php

namespace Hicolin\Smsbao;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Smsbao
{
    /**
     * @var array|string[]
     */
    public array $statusMap = [
        '0'  => '短信发送成功',
        '-1' => '参数不全',
        '-2' => '服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间',
        '30' => '密码错误',
        '40' => '账号不存在',
        '41' => '余额不足',
        '42' => '账户已过期',
        '43' => 'IP 地址限制',
        '50' => '内容含义敏感词'
    ];

    /**
     * @var string
     */
    public string $apiUrl;

    /**
     * Smsbao constructor.
     * @param string $account
     * @param string $password
     */
    public function __construct(string $account, string $password)
    {
        $smsApi = 'http://api.smsbao.com/';
        $password = md5($password);

        $this->apiUrl = $smsApi . "sms?u={$account}&p={$password}";
    }

    /**
     * @param string $phone
     * @param string $content
     * @throws \Exception
     */
    public function send(string $phone, string $content): ResponseInterface
    {
        $content = urlencode($content);
        $this->apiUrl = $this->apiUrl . "&m={$phone}&c={$content}";

        try {
            return (new Client())->get($this->apiUrl);
        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }
    }

}