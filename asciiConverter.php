<?php
    $image_name = 'AlexCaduaID.png';
    // jpeg
    //$image = imagecreatefromjpeg($image_name);  
    // png
    $image = imagecreatefrompng($image_name);
    // gif
    //$image = imagecreatefromgif($image_name);
    $imgResized = imagescale($image, 225, 100);
    // jpeg
    //imagejpeg($imgResized, 'path_of_Image/Name_of_Image_resized.jpg'); 
    // png
    //imagepng($imgResized, 'path_of_Image/Name_of_Image_resized.png');
    //$asciiPx = "`.-':_,^=;><+!rc*/z?sLTv)J7(|Fi{C}fI31tlu[neoZ5Yxjya]2ESwqkP6h9d4VpOGbUAKXHm8RD#\$Bg0MNWQ%&@";
    
    $asciiPx = " .,:ilwW";
    $width = imagesx($imgResized);
    $height = imagesy($imgResized);
    imagefilter($imgResized, IMG_FILTER_GRAYSCALE);
    $asciiImg = "";
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            // pixel color at (x, y)
            $rgb = imagecolorat($imgResized, $x, $y);

            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $gray = round(($r + $g + $b) / 3);


            $asciiImg .= $asciiPx[(int) map($gray, 0, 255, 0, strlen($asciiPx) - 1)];
        }
        $asciiImg .= "\n";
    }

    echo $asciiImg;

    function map($value, $fromLow, $fromHigh, $toLow, $toHigh)
    {
        $fromRange = $fromHigh - $fromLow;
        $toRange = $toHigh - $toLow;
        $scaleFactor = $toRange / $fromRange;

        // Re-zero the value within the from range
        $tmpValue = $value - $fromLow;
        // Rescale the value to the to range
        $tmpValue *= $scaleFactor;
        // Re-zero back to the to range
        return $tmpValue + $toLow;
    }

