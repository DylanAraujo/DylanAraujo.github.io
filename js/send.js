function sendMessage(){
    var val = document.getElementById("send").value;
    var ht = new XMLHttpRequest();
    ht.open("GET", "js/counter.php?message=" + encodeURIComponent(val));
    ht.send();
    return false;
}

function getMessage(){
    ht = new XMLHttpRequest();
    ht.onreadystatechange = update;
    ht.open("GET", "js/counter.php", true);
    ht.send();
}

function update(){
    //console.log(ht.responseText);
    if (ht.readyState == 4 && ht.status == 200){
        document.getElementById("count").innerHTML = "Number of responses: " + ht.responseText;
    }
}

getMessage();
setInterval('getMessage()',100);