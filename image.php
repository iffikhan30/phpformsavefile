<?php function get_image($data, $filecount){
    // Set image dimensions
    $image_width = 500;
    $image_height = 500;

    // Create new image
    $image = imagecreatetruecolor($image_width, $image_height);

    // Set background color
    $bg_color = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $bg_color);

    // Set text color
    $text_color = imagecolorallocate($image, 0, 0, 0);

    // Write form data onto image
    $font_path = dirname(__FILE__) .'/fonts/Montserrat-Regular.ttf';
    $font_size = 20;
    $y_offset = 50;

    $text = "Name: ".$data['name']."\nEmail: ".$data['email']."\nPhone: ".$data['phone']."\nAddress: ".$data['address']."\nComments: ".$data['message'];

    // Set the maximum width for each line
    $maxWidth = $image_width - 50;

    // Split the text into lines that fit the maximum width
    $lines = [];
    $currentLine = '';
    $words = explode(' ', $text);
    foreach ($words as $word) {
        $testLine = $currentLine . ' ' . $word;
        $testWidth = imagettfbbox($font_size, 0, $font_path, $testLine)[2];
        if ($testWidth > $maxWidth) {
            $lines[] = $currentLine;
            $currentLine = $word;
        } else {
            $currentLine .= ' ' . $word;
        }
    }
    $lines[] = $currentLine;

    // Write each line to the image
    $x = 25;
    $y = 25;
    $lineHeight = 0;
    foreach ($lines as $line) {
        $lineBox = imagettfbbox($font_size, 0, $font_path, $line);
        $lineWidth = $lineBox[2] - $lineBox[0];
        $lineHeight = $lineBox[3] - $lineBox[5];
        imagettftext($image, $font_size, 0, $x, $y + $lineHeight, $text_color, $font_path, $line);
        $y += $lineHeight * 1.5;
    }
    
    // Save image to directory
    $image_path = date("Y") . '/' . date("m") . '/'.$data['formname'].'/' . $filecount . '-image-' . $data['email'] . '-' .date('d-h-i-s-') .floor(microtime(true) * 1000). '.jpg'; // Generate unique filename
    
    imagejpeg($image, $image_path);

    // Destroy image object to free up memory
    imagedestroy($image);
}
?>
