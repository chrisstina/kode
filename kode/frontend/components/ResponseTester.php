<?php

namespace frontend\components;

use Yii;

class ResponseTester extends \yii\base\Component
{
    public function isResponseValid($response)
    {
        return is_array($response);
    }
    
    public function isParameterPresent($array, $expectedName)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                return $this->isParameterPresent($value, $expectedName);
            }
            
            if ($expectedName === $key)
            {
                return true;
            }
        }
        
        return false;
    }
    
    public function isParameterEquals($array, $expectedName, $expectedValue)
    {
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                return $this->isParameterEquals($value, $expectedName, $expectedValue);
            }
            
            if ($expectedName === $key && $expectedValue == $value)
            {
                return true;
            }
        }
        
        return false;
    }
}