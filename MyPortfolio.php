<!Doctype>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/BackEnd.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/jquery.terminal.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.terminal/css/jquery.terminal.min.css" />

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


        <div class="introduction" id="introGreetings">
            <h1 id="introHeadings"> </h1>
            <h2 id="introLine" style="transition: 2s opacity; opacity: 0;">  </h2>
            <img src="AlexCaduaID.png" class="ProfilePicture" id="ProfileImg" style="width:500px;height:480px; opacity: 0;">
            <p class="ProfilePicture" id="asciiProfile"></p>
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

    <script>

    </script>


</body>

</html>