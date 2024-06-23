var i = 0;
var txt = "Lorem ipsum dummy text blabla.";
var speed = 0.1;
var currentPanel = 0;

var bgWriter = [];

var myVar;
var asciiProfile;
const delay = ms => new Promise(res => setTimeout(res, ms));
/* too complex to be used in imediate designs
var interpreter = "guest";

           //https://terminal.jcubic.pl/
var __EVAL = (s) => eval(`void (__EVAL = ${__EVAL}); ${s}`);
const term = $(function() {
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
            },
            eval: function(command) {
                if (command !== '') {
                    try {
                        var result = __EVAL(command);
                        if (result !== undefined) {
                            this.echo(new String(result));
                        }
                    } catch(e) {
                        this.error(new String(e));
                    }
                }
            } 
            
        }, {
            greetings: 'Welcome',
            prompt
        });
});

function prompt() {
  if (interpreter == "eval") {
    eval;
  }
  return "guest> ";
}

function changeCSS(cssFile, cssLinkIndex) {
  var oldlink = document.getElementsByTagName("link").item(cssLinkIndex);

  var newlink = document.createElement("link");
  newlink.setAttribute("rel", "stylesheet");
  newlink.setAttribute("type", "text/css");
  newlink.setAttribute("href", cssFile);

  document
    .getElementsByTagName("head")
    .item(cssLinkIndex)
    .replaceChild(newlink, oldlink);
}
*/


function onLoad() {
  setTimeout(loadWriter, 500);
  setTimeout(showPage, 1000);
  setTimeout(showTerminal, 3000);
}

async function check(){

  if(asciiProfile.isFinished){
    await delay(200);
    document.getElementById("ProfileImg").style.opacity = 100;
    document.getElementById("asciiProfile").style.opacity = 0;
    document.body.style.background = "rgba(250,250,250,0.9)";
    document.getElementById("bgWriter").style.display = "none";
    document.getElementById("introGreetings").style.opacity = 100;
    document.getElementById("introGreetings").style.color = "rgba(50,50,50,1)"

    await delay(1000);
    new typeWriter("Hello, I am Alexander Cadua.","introHeadings", 40);
    await delay(2000);
    document.getElementById("introLine").innerHTML += "A Curious Hobbyist";
    document.getElementById("introLine").style.opacity = 100;
    
  }else{
    setTimeout(check, 100);
  }
}

 function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("mainContent").style.display = "block";

}

function showTerminal() {
  document.getElementById("demo1").style.display = "block";
}

function loadWriter() {
  $.ajax({
    url: "asciiConverter.php",
    success: function(data){
      asciiProfile =  new typeWriter(data, "asciiProfile");
      asciiProfile.chunks = 40;
      check();
    }
  });

  fetch("snake.py")
    .then((res) => (txt = res.text()))
    .then((text) => {
      txt = text.toString();
      //panelPortion[0] = txt.indexOf("\n", txt.length/3);
      //panelPortion[1] = txt.indexOf("\n", txt.length*2/3);
      //panelPortion[2] = txt.length;
      document.getElementById("bgLeftPanel").innerHTML = "";
      document.getElementById("bgCenterPanel").innerHTML = "";
      document.getElementById("bgRightPanel").innerHTML = "";

      bgWriter[0] = new typeWriter(        
        txt.substring(
            0, 
            txt.indexOf("\n", txt.length / 3) - 1
        ),"bgLeftPanel"
      );
      bgWriter[0].chunks = 1;

      
      bgWriter[1] = new typeWriter(
        txt.substring(
            txt.indexOf("\n", txt.length / 3),
            txt.indexOf("\n", (txt.length * 2) / 3) - 1
        ),"bgCenterPanel"
      );
      bgWriter[1].chunks = 1;
      
      bgWriter[2] = new typeWriter(
        txt.substring(
            txt.indexOf("\n", (txt.length * 2) / 3) - 1,
            txt.length
        ), "bgRightPanel"
      );
      bgWriter[2].chunks = 1;
      
    })
    .catch((e) => console.error(e));
}
/*
async function typeWriter() {
    if (i < txt.length) {
        for(var p = 0; p < 3; p++){
            
            var writeChar = txt.charAt(panelIndex[p]);
            if(writeChar == "\n"){
                writeChar = "<br>";
                //await new Promise(r => setTimeout(r, 500));
            } else if(writeChar === " "){
                writeChar = "&nbsp;";
            }
            //document.getElementById("demo").innerHTML=document.getElementById("demo").innerHTML.slice(0,-1);
            
            switch(p){
                case 0:
                    document.getElementById("bgLeftPanel").innerHTML += writeChar;
                    break;
                case 1:
                    document.getElementById("bgCenterPanel").innerHTML += writeChar;
                    break;
                case 2:
                    document.getElementById("bgRightPanel").innerHTML += writeChar;
                    break;
            }

            panelIndex[p]++;
        
        }
        i += 3;

        setTimeout(typeWriter, speed);
        
    } else{
        //showTerminal();
        await new Promise(r => setTimeout(r, 2000));
        document.getElementById("bgWriter").style.opacity = "0";
        await new Promise(r => setTimeout(r, 2000));
        document.getElementById("bgWriter").style.opacity = "1";
        loadWriter();

    }
}
    */

class typeWriter {
  constructor(txt, id,  speed = 1, autoRun = true) {
    this.text = txt;
    this.idLoc = id;

    this.i = 0;
    this.end = txt.length;
    this.speed = speed;
    this.chunks = 1;
    this.fadeEn = false;
    this.isFinished = false;
    if(autoRun){
      this.writeIn();
    }
    
  }

 async writeIn() {
    if (this.i < this.end) {
      var writeTxt = "";
      for(var t = 0; t < this.chunks; t++){
        var writeChar = this.text.charAt(this.i + t);
        if (writeChar == "\n") {
          writeChar = "<br>";
          //await new Promise(r => setTimeout(r, 500));
        } else if (writeChar === " ") {
          writeChar = "&nbsp;";
        }
        writeTxt += writeChar;
    }

      document.getElementById(this.idLoc).innerHTML += writeTxt;

      this.i += this.chunks;

      setTimeout(this.writeIn.bind(this), this.speed); //https://stackoverflow.com/questions/5911211/settimeout-inside-javascript-class-using-this
    } else {
      this.isFinished = true;
    }
  }
}
