<?php
/**
 * Created by PhpStorm.
 * User: konghy
 * Date: 19-9-29
 * Time: 19-9-29
 */
namespace App\TraitTools;

use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette\Mail\SmtpMailer;

trait email {


    /**
     * @param $id
     * @param $email
     */
    public function sendEmail($id,$email,$url) {
        //发送邮件
        $mail = new Message;
        $mail->setFrom('steffenkong <steffenkong@163.com>') //发件人的邮箱
            ->addTo($email) //接受者的邮箱
            ->setSubject('会员帐号激活')  //邮箱标题
            ->setHtmlBody("你好，请点击以下链接进行激活操作<br/><a href='$url'>$url</a>");  //邮箱内容

        //配置SMTP服务器
        $mailer = new SmtpMailer([
            'host' => 'smtp.163.com',       //利用网易163作为服务器
            'username' => '',    //填写用户名
            'password' => '',  //填写秘钥
        ]);
        $mailer->send($mail);
        return true;
    }
}