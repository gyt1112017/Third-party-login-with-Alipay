<?php
header("content-type:text/html;charset=utf-8");
//引入的SDK
include "./alipay/AopSdk.php";
include "./alipay/aop/AopClient.php";
include "./alipay/aop/request/AlipaySystemOauthTokenRequest.php";
include "./alipay/aop/request/AlipayUserInfoShareRequest.php";

$actual_link="http://$_SERVER[HTTP_REFERER]$_SERVER[REQUEST_URI]";
$auth_code=strstr($actual_link,"auth_code=");
$real_auth_code=strstr($auth_code,"/alipaysdk.php",true);
$real_real_auth_code=substr($real_auth_code,10);

//APPID
$appid = 'your appid';

//私钥  文件名（rsa_private_key.pem）
$rsaPrivateKey = "your private key";
//公钥  文件名 （rsa_public_key.pem）
$alipayrsaPublicKey = "your public key";
//初始化
$aop = new AopClient ();
$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
$aop->appId = $appid;
$aop->rsaPrivateKey = $rsaPrivateKey;
$aop->alipayrsaPublicKey = $alipayrsaPublicKey;
$aop->apiVersion = '1.0';
$aop->signType = 'RSA2';
$aop->postCharset='utf-8';
$aop->format='json';
//获取access_token
$request = new AlipaySystemOauthTokenRequest ();
$request->setGrantType("authorization_code");
$request->setCode($real_real_auth_code);//这里传入 code
$result = $aop->execute($request);
$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
$access_token = $result->$responseNode->access_token;

//获取用户信息		
$request_a = new AlipayUserInfoShareRequest ();
$result_a = $aop->execute ($request_a, $access_token); 
$responseNode_a = str_replace(".", "_", $request_a->getApiMethodName()) . "_response";
$resultCode_a = $result_a->$responseNode_a->code;
if(!empty($resultCode_a)&&($resultCode_a == 10000)){
    echo "成功";
} else {
    echo "失败";
}

//测试显示出来的信息
$user_data = $result_a->$responseNode_a;
$data = array();
$data['sex'] = $user_data->gender=='m'?1:2;
$data['province'] = $user_data->province;
$data['city']  = $user_data->city;
$data['person_name'] = $user_data->nick_name;
$data['ali_openid'] = $user_data->user_id;
$data['ali_img'] = $user_data->avatar;

var_dump($data['sex']);
var_dump($data['province']);
var_dump($data['city']);
var_dump($data['person_name']);
var_dump($data['ali_img']);
var_dump($data['ali_openid']);

die;

?>
