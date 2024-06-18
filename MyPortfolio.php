<!Doctype>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/jquery.terminal.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.terminal/css/jquery.terminal.min.css"/>

    <script src="main.js"></script>
    <style>
        body{
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#45484d+0,000000+100;Black+3D+%231 */
            background: linear-gradient(to bottom, rgba(69,72,77,1) 0%,rgba(0,0,0,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            padding: 0px;
            margin: 0px;
            height: 0px;
        }

        #bgWriter {
            opacity: 100;
            transition: 1s opacity;
        }
        .bgWriter{
            color: rgba(150,150,150,0.2);
            font-size:0.7vw;
            font-family: "Lucida Console", "Courier New", monospace;
            position: absolute;
            width: 100%; 
            display: table;

            -webkit-user-select: none; /* Safari */        
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE10+/Edge */
            user-select: none; /* Standard */
        }

        #bgLeftPanel{
            
        }
        #bgCenterPanel{
            
        }
        #bgRightPanel{
            
        }

        #demo1{
            width: 700px;
            height: 300px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -50px 0 0 -50px;
            transform: translate(-50%, 50%);
            display: none;

        }

        div {
            
        }

        header{
            /*
            background-color: rgba(200,10,10,0.5);
            height:10vw;
            */
            
            
        }

        /* Style all font awesome icons */
        .fa {
        padding: 10px;
        font-size: 15px;
        width: 15px;

        text-align: center;
        text-decoration: none;
        border-radius: 50%;
        }

        /* Add a hover effect if you want */
        .fa:hover {
        opacity: 0.7;
        }

        /* Set a specific color for each brand */

        /* Facebook */
        .fa-facebook {
        background: #3B5998;
        color: white;
        }

        /* Twitter */
        .fa-google {
        background: #55ACEE;
        color: white;
        }

        .fa-github {
        background: #000000;
        color: white;
        }

        /* Center the loader */
        #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 120px;
        height: 120px;
        margin: -76px 0 0 -76px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }

        /* Add animation to "page content" */
        .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 } 
        to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom { 
        from{ bottom:-100px; opacity:0 } 
        to{ bottom:0; opacity:1 }
        }

        #mainContent {
        display: none;
        }
    </style>
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
        

        <div>
            <h1>
            </h1>
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
           //https://terminal.jcubic.pl/
    $(function() {
        $('terminal').terminal({
            hello: function(what) {
                this.echo('Hello, ' + what +
                        '. Welcome to this terminal.');
            },
            dump: function(file){
                fetch(file)
                .then((res) => res.text())
                .then((text) => {
                    this.echo(text)
                })
                .catch((e) => console.error(e));
            }
        }, {
            greetings: 'My First Web Terminal'
        });
    });
    
    </script>



</body>

</html>