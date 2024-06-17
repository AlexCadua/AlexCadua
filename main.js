

var i = 0;
var txt = 'Lorem ipsum dummy text blabla.';
var speed = 50;

function loadWriter(){
    fetch('snake.py')
    .then((res) => txt=res.text())
    .then((text) => {
        txt=text.toString()
        typeWriter();
    })
    .catch((e) => console.error(e));
    
}

async function typeWriter() {
    if (i < txt.length) {
        var writeChar = txt.charAt(i);
        if(writeChar == "\n"){
            writeChar = "<br>";
            //await new Promise(r => setTimeout(r, 500));
        } else if(writeChar === " "){
            writeChar = "&nbsp;";
        }
        document.getElementById("demo").innerHTML=document.getElementById("demo").innerHTML.slice(0,-1);
        document.getElementById("demo").innerHTML += writeChar;
        document.getElementById("demo").innerHTML += "|";
        i++;
        setTimeout(typeWriter, speed);
    }
}