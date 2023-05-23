<?php 

//Create Year Directory

if (!file_exists(date("Y"))) {
    mkdir(date("Y"), 0777, true);
    chmod(date("Y"), 0777);
}


//Create Month Directory
if (!file_exists(date("Y") . '/' . date("m"))) {
    mkdir(date("Y") . '/' . date("m"), 0777, true);
    chmod(date("Y") . '/' . date("m"), 0777);
}

//Display Error
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Isset $_POST
if (isset($_POST['name'])) {
    $fname = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['phone'];
    $comments = $_POST['message'];
    $formname = $_POST['formname'];

    $data = [];
    
    foreach($_POST as $k => $post){
        $data[$k]   =   $post;
    }

    $email_to = "irfan.sarwar.khan30@gmail.com";
    $email_subject = "Contact Us form submitted";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }
    $email_message = "First Name: " . clean_string($fname) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Telephone: " . clean_string($telephone) . "\n";
    $email_message .= "Comments: " . clean_string($comments) . "\n";

    if (!file_exists(date("Y") . '/' . date("m") . '/'.$formname)) {
        mkdir(date("Y") . '/' . date("m") . '/'.$formname, 0777, true);
        chmod(date("Y") . '/' . date("m") . '/'.$formname, 0777);
    }

    $content = $email_message;

    //Order Count
    $directory = date("Y") . '/' . date("m") . '/'.$formname;
    $filecount = count(glob("$directory/*.txt"));

    $fp = fopen(date("Y") . '/' . date("m") . '/'.$formname.'/' . $filecount . '-form-' . $email . '-' .date('d-h-i-s-') .floor(microtime(true) * 1000). ".txt", "wb");
    fwrite($fp, $content);
    fclose($fp);

    //Create form Image
    include_once('image.php');
    echo get_image($data, $filecount);

    

    echo json_encode(array('success'=>true,'data'=>array('name'=>$fname,'email'=>$email,'phone'=>$telephone,'message'=>$comments)));

    // create email headers
    // $headers = 'From: ' . $email . "\r\n" .
    //     'Reply-To: ' . $email . "\r\n" .
    //     'X-Mailer: PHP/' . phpversion();

    // if (mail($email_to, $email_subject, $email_message, $headers)) {
    //     echo '1';
    // } else {
    //     echo '0';
    // }
}else{
    echo json_encode(array('success'=>false));
}
?>
