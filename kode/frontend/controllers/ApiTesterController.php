<?php

namespace frontend\controllers;

use Yii;

class ApiTesterController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new \frontend\models\ApiTesterForm();
        $responseBlock = '';
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $apiResponse = $model->sendRequest();
            if ($apiResponse->isSuccessful)
            {
                $testPassed = $model->testResponse($apiResponse->responseBody);
                $responseBlock = $this->renderPartial('_response', [
                    'response' => $apiResponse->responseBody,
                    'expectedParamKey' => $model->expectedParamKey,
                    'expectedParamValue' => $model->expectedParamValue,
                    'testPassed' => $testPassed
                ]);
            }
            else
            {
                Yii::$app->session->setFlash('error', 'There was an error sending api request. Returned HTTP status code: ' . $apiResponse->httpStatus);
            }
        }
        
        return $this->render('index', [
            'model' => $model,
            'response' => $responseBlock
        ]);
    }
}
