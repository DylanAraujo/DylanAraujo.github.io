<!DOCTYPE html>
<html>
  <head>
    <title>Send Message Form</title>
  </head>
  <h1>Welcome to the group chat!</h1>
  <p>Enter a message  below!</p>
  <body>
    <form onsubmit="sendMessage(); return false;">
      <input type="text" id="message" placeholder="Type your message here">
      <input type="submit" value="Send">
    </form>
    <div id="counter"></div>
    <div id="messages"></div>
    <script>
      var count = 0;
      
      function sendMessage() {
        event.preventDefault();
        var messageContent = document.getElementById("message").value;
        var url = "counter.php?message=" + encodeURIComponent(messageContent);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            updatePage(this.responseText);
          }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
      }
      
      function updatePage(response) {
        var responseArray = response.split(":");
        var counter = responseArray[0];
        var message = responseArray[1];
        if (counter > count) {
          count = counter;
          document.getElementById("counter").innerHTML = "Total messages: " + counter;
          var para = document.createElement("p");
          para.innerHTML = message;
          document.getElementById("messages").appendChild(para);
        }
        document.getElementById("counter").innerHTML = "Total messages: " +  counter;
      }
      
      function getMessage() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            updatePage(this.responseText);
          }
        };
        xhttp.open("GET", "counter.php", true);
        xhttp.send();
      }
      
      getMessage();
      setInterval(getMessage, 100);
    </script>
  </body>
</html>
