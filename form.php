
<?php
if (!file_exists(date("Y"))) {
    mkdir(date("Y"), 0777, true);
    chmod(date("Y"), 0777);
}

if (!file_exists(date("Y") . '/' . date("m"))) {
    mkdir(date("Y") . '/' . date("m"), 0777, true);
    chmod(date("Y") . '/' . date("m"), 0777);
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['name'])) {
    $fname = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['phone'];
    $comments = $_POST['message'];

    $email_to = "irfan.sarwar.khan30@gmail.com";
    $email_subject = "Contact Us form submitted";

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }
    $email_message .= "First Name: " . clean_string($fname) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Telephone: " . clean_string($telephone) . "\n";
    $email_message .= "Comments: " . clean_string($comments) . "\n";

    if (!file_exists(date("Y") . '/' . date("m") . '/contactform')) {
        mkdir(date("Y") . '/' . date("m") . '/contactform', 0777, true);
        chmod(date("Y") . '/' . date("m") . '/contactform', 0777);
    }

    $content = $email_message;
    $fp = fopen(date("Y") . '/' . date("m") . '/contactform/' . date('d-h-i-s') . "-form.txt", "wb");
    fwrite($fp, $content);
    fclose($fp);
// create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    if (mail($email_to, $email_subject, $email_message, $headers)) {
        echo '1';
    } else {
        echo '0';
    }
}
?>
