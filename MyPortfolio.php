<!Doctype>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/BackEnd.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/jquery.terminal.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.terminal/css/jquery.terminal.min.css"/>

    <script src="main.js"></script>
</head>

<body onLoad="onLoad()">
    
    <div id="loader"></div>
    
    <div id="mainContent" class="animate-bottom">
        <!--
        <header>
            <div style="height: 9vw;">
                <a href="https://www.facebook.com/alexander.cadua.3/" class="fa fa-facebook"></a>
                <a href="cadua.alexander02@gmail.com" class="fa fa-google"></a>
                <a href="https://github.com/AlexCadua" class="fa fa-github"></a>
            </div>
            <hr style="position:relative;">
        </header>
        -->
        

        <div class="introduction">
            <h1><b id="introGreetings">Hello</b>, I am Alexander Cadua.</h1>
            <h2> A Curious Enthusiast </h2>
            <img src="AlexCaduaID.png" class="asciiProfile" style="width:1000px;height:1000px;">
            <p class="asciiProfile" style="font-size:8px;">
            <?php 
            $image_name =  'AlexCaduaID.png';      
            // jpeg
            //$image = imagecreatefromjpeg($image_name);  
            // png
            $image = imagecreatefrompng($image_name);
            // gif
            //$image = imagecreatefromgif($image_name);
            $imgResized = imagescale($image , 225, 100);
            // jpeg
            //imagejpeg($imgResized, 'path_of_Image/Name_of_Image_resized.jpg'); 
            // png
            //imagepng($imgResized, 'path_of_Image/Name_of_Image_resized.png');
            //$asciiPx = "`.-':_,^=;><+!rc*/z?sLTv)J7(|Fi{C}fI31tlu[neoZ5Yxjya]2ESwqkP6h9d4VpOGbUAKXHm8RD#\$Bg0MNWQ%&@";
            
            $asciiPx = " .,:ilwW";
            $width = imagesx($imgResized);
            $height = imagesy($imgResized);
            imagefilter($imgResized, IMG_FILTER_GRAYSCALE);
            for($y = 0; $y < $height; $y++) {
                for($x = 0; $x < $width; $x++) {
                    // pixel color at (x, y)
                    $rgb = imagecolorat($imgResized, $x, $y);
                    
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;

                    $gray = round(($r + $g + $b) / 3);

                    
                    echo $asciiPx[(int)map($gray,0,255,0,strlen($asciiPx)-1)];
                }
                echo "<br>";
            }

            function map($value, $fromLow, $fromHigh, $toLow, $toHigh) {
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
            
            ?></p>
        </div>

        <footer>

        </footer>

        <div class="bgWriter" id="bgWriter" style="display: table;">
            <div style="display: table-row">
                <div id="bgLeftPanel" style="width:33%; display: table-cell;">
                </div>
                <div id="bgCenterPanel" style="display: table-cell;">
                </div>
                <div id="bgRightPanel" style="display: table-cell;">
                </div>
            </div>
        </div>

        <terminal id="demo1" class="animate-bottom"></terminal>
    </div>



</body>

</html>