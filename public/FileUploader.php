<?php
require_once('../vendor/autoload.php');
/**
 * Created by PhpStorm.
 * User: buniacke
 * Date: 24/06/15
 * Time: 16:59
 */

class FileUploader
{
    private $sftp;
    public function __construct()
    {
        $this->sftp = new Net_SFTP('178.62.128.137', 305);
        if (!$this->sftp->login('ftplr', '1l0v3w1n3s')) {
            exit('Login Failed');
        }
    }
    public function sendFile($filename)
    {
        return $this->sftp->put('new/'.$filename, '/tmp/'.$filename, NET_SFTP_LOCAL_FILE);
    }
}

$fileuploader = new FileUploader();

$filename     = 'payload_' . rand(100,999);

file_put_contents('/tmp/'.$filename, 'This is a test file with a random number ... ' . $filename);

if($fileuploader->sendFile($filename))
{
    echo "A file ... " . $filename . " has been uploaded to the FTP server";
} else {
    echo "Something went wrong ... "; 
};

?>