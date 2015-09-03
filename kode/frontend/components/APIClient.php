<?php

namespace frontend\components;

use Yii;

/**
 * Description of APIClient
 *
 * @author chriss
 */
class APIClient
{
    public $responseBody;
    public $httpStatus;
    public $isSuccessful = false;

    public function sendRequest($url, $method, $params)
    {
        try
        {
            $this->responseBody = Yii::$app->httpclient->request($url, $method, function(\understeam\httpclient\Event $event) use ($params) {
                
                if ( ! $params) {
                    return false;
                }
                
                $request = $event->message;
                
                if ($request->getMethod() === 'POST')
                {
                    $post = new \GuzzleHttp\Post\PostBody();
                
                    foreach ($params as $key => $value)
                    {
                        $post->setField($key, $value);
                    }

                    $request->setBody($post);
                }
                else
                {
                    $request->setQuery($params);
                }
            });
            
            $this->isSuccessful = true;
        } 
        catch (\GuzzleHttp\Exception\RequestException $ex)
        {
            $this->httpStatus = $ex->getResponse()->getStatusCode();
        }
        
        return $this;
    }
}