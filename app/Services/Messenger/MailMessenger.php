<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Messenger;
 
class MailMessenger implements Messenger {
 
    public function send($message) {
        // ここで、メールでメッセージを送る
 
        return "メールで $message を送りました。";
    }
}
