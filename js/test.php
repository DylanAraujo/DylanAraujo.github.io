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
        var valMessage = document.getElementById("message").value;
        var url = "counter.php?msg=" + encodeURIComponent(valMessage);
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            updatePage(this.responseText);
          }
        };
        request.open("GET", url, true);
        request.send();
      }
      
      function updatePage(response) {
        var res = response.split(":");
        var counter = res[0];
        var message = res[1];
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
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            updatePage(this.responseText);
          }
        };
        request.open("GET", "counter.php", true);
        request.send();
      }
      
      getMessage();
      setInterval(getMessage, 100);
    </script>
  </body>
</html>
