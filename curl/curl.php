<?php

/**
 * @param $url
 * @param $params
 * @return bool|mixed
 */
function curlPost($url,$params)
{
    $json_decode            = @$params['json_decode'];
    $return                 = false;

    if( (!empty($params)) || (is_array($params)) ){
        # ----------------------------------------------------------------------------------------------
        if(!is_array($params)){
            $paramsRawArray 					= explode("&", $params);
            foreach ($paramsRawArray AS $value) {
                $valueArray     				= explode("=", $value);
                $paramsArray[$valueArray[0]] 	= $valueArray[1];
            }
            $params								= $paramsArray;
        }

        # ----------------------------------------------------------------------------------------------
        unset($paramsArray);
        if(is_array($params)){
            foreach($params AS $key=>$value){

                # ------------------------------------------------------------------------------------------------
                # @Important: If you put an @ at the beginning of the param, curl will look for a url or local path
                # to send a file. So if we have text with @ at the beginning we need to add an space in the text.
                if( (preg_match("/url/",$key)) || (preg_match("/path/",$key)) ){
                    $paramsArray[$key]          = $value;
                }else{
                    (substr($value,0,1)=="@") ? $value = " ".$value : false;
                    $paramsArray[$key]          = $value;
                }
            }
            $params                             = $paramsArray;
        }

        # ----------------------------------------------------------------------------------------------

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        $return = curl_exec($ch);
        curl_close($ch);

        ($json_decode==1)						? $return = json_decode($return) : false;
    }
    return $return;

}
