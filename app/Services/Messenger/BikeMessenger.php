<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Messenger;
 
class BikeMessenger implements Messenger {
 
    public function send($message) {
        // ここで、バイクに乗ってメッセージを届ける
 
        return "バイク便で $message を届けました。";
    }
}
