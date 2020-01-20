<?php 

namespace common\components;
use linslin\yii2\curl;

class Constants {

    const HOST = 'http://neb-chr.ru/';

    const FLASK_HOST = 'http://217.61.113.12:8080/api/';

    /**
     * Кодирование изображения
     */
    public static function base64Encode($img) : ?string
    {
        $imagedata = file_get_contents($img);
        return base64_encode($imagedata);
    }

    /**
     * Получение вектора лица
     */
    public static function getVectorFace($base64Image = null) : ?string
    {
        if(empty($base64Image)) return null;
        try {
            $curl = new curl\Curl();
            $params = json_encode(
                array( 'data' => [
                    [ 
                        'base64img' => self::base64Encode($base64Image) ]
                    ]
                )
            );
			//echo $params;die;
            $response = $curl->setRequestBody($params)
                        ->setHeaders([
                            'Content-Type' => 'application/json',
                            'Content-Length' => strlen($params)
                        ])->post(self::FLASK_HOST . 'vector-img');
            $decode = json_decode($response, 1); 
            if($decode['data']) :
                $jsonDecode = $decode['data'][0];
                if($jsonDecode['code'] == 200) {
                    return $jsonDecode['vector'];
                }
                
                if($jsonDecode['code'] == 201) {
                    return $jsonDecode['msg'];
                }

                if($jsonDecode['code'] == 404) {
                    return $jsonDecode['msg'];
                }
            endif; 
            return null;
        } catch(Exception $ex) {
            return $ex->getMessage();
        }
    }

}