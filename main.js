

var i = 0;
var txt = 'Lorem ipsum dummy text blabla.';
var speed = 0.1;
var currentPanel = 0;

var panelIndex = [];
var panelPortion = [];

var myVar;

function onLoad() {
    setTimeout(loadWriter,500);
    setTimeout(showPage, 1000);
    //setTimeout(showTerminal,2000);
}

function showPage() {
document.getElementById("loader").style.display = "none";
document.getElementById("mainContent").style.display = "block";
}

function showTerminal(){
    document.getElementById("demo1").style.display = "block";
}

function loadWriter(){
    fetch('snake.py')
    .then((res) => txt=res.text())
    .then((text) => {
        txt=text.toString()
        //panelPortion[0] = txt.indexOf("\n", txt.length/3);
        //panelPortion[1] = txt.indexOf("\n", txt.length*2/3);
        //panelPortion[2] = txt.length;
        document.getElementById("bgLeftPanel").innerHTML = "";
        document.getElementById("bgCenterPanel").innerHTML = "";
        document.getElementById("bgRightPanel").innerHTML = "";
        panelIndex[0] = 0;
        panelIndex[1] = txt.indexOf("\n", txt.length/3) - 1;
        panelIndex[2] = txt.indexOf("\n", txt.length*2/3) - 1;
        i = 0;
        typeWriter();
    })
    .catch((e) => console.error(e));
    
}

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

        showTerminal();
        await new Promise(r => setTimeout(r, 1000));
        document.getElementById("bgWriter").style.opacity = "0";
        await new Promise(r => setTimeout(r, 2000));
        document.getElementById("bgWriter").style.opacity = "1";
        loadWriter();

    }
}