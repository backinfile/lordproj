
<?php 
require 'vendor/autoload.php';

$appid = 1400085730;
$appkey = "5dd0ce901528d2a9397cae982b99f07f";
$phoneNumber1 = "15209230125";
$templId = 112052;
use Qcloud\Sms\SmsSingleSender;
try {
$sender = new SmsSingleSender($appid, $appkey);
$result = $sender->send(0, "86", $phoneNumber1,
    "【煋云科技】1234为您的登录验证码，请于5分钟内填写。如非本人操作，请忽略本短信。", "", "");
$rsp = json_decode($result);
echo $result;
} catch(\Exception $e) {
echo var_dump($e);
}

?>