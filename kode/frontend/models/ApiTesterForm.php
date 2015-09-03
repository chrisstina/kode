<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\components\APIClient;

class ApiTesterForm extends Model
{
    const ALLOWED_PARAMS_COUNT = 5;
    
    public $url;
    public $method;
    public $params;
    public $paramKeys;
    public $paramVals;
    public $expectedParamKey;
    public $expectedParamValue;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'method', 'expectedParamKey'], 'required'],
            [['url'], 'url'],
            [['expectedParamValue'], 'string'],
            [['paramKeys', 'paramVals'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url' => 'API method url',
            'method' => 'HTTP request method',
            'params' => 'Parameter'
        ];
    }
    
    public function sendRequest()
    {
        $client = new APIClient();
        return $client->sendRequest($this->url, $this->method, $this->getParams());
    }
    
    public function testResponse($responseBody)
    {
        $tester = new \frontend\components\ResponseTester();
        
        return $tester->isResponseValid($responseBody) && 
            ( ($this->expectedParamValue) ? 
                $tester->isParameterEquals($responseBody, $this->expectedParamKey, $this->expectedParamValue) : 
                $tester->isParameterPresent($responseBody, $this->expectedParamKey)
            );
    }
    
    public function getParams()
    {
        $params = [];
        
        foreach ($this->paramKeys as $position => $key)
        {
            if ( ! isset($params[$key]))
            {
                $params[$key] = $this->paramVals[$position];
            }
        }
        
        return $params;
    }
    
    public static function allowedHttpMethods()
    {
        return ['GET' => 'GET', 'POST' => 'POST'];
    }
}
