<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function verificationMail($record)
{
	$CI =& get_instance();
    $data['record'] = $record;
    $data['verificationLink'] = base_url('verify-user?usr='.$record['username'].'&authtoken='.$record['user_token']);
    $email =  $CI->load->view('email/verification',$data,TRUE);
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= "From: No-Reply ReadRealm<no-reply@readrealm.tk>\r\n";
    $headers .= "Reply-To: no-reply@readrealm.tk\r\n";
    $headers .= "Return-Path: no-reply@readrealm.tk\r\n";
    $to = $record['email'];
    $subject = "Email Verification";
    return mail($to,$subject,$email,$headers);
}