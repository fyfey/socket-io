<?php
    session_start();
    setcookie('download_token_base', '95fd4c9b-bf56-66d6-0d6a-54e1d70ece9b');
?>
<html>

<head>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
</head>
<body>

<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    }
</script>

<script>
    var req = new XMLHttpRequest();
    req.open('POST', 'http://localhost:8000/auth.php');
    req.send(JSON.stringify({'token': getCookie('download_token_base')}));
    req.onreadystatechange = function() {
        if (req.readyState == 4 && req.status == 200) {
            console.log("data received!", req.responseText);
            openSocket(JSON.parse(req.responseText));
        }
    }
    function openSocket(token) {
        if (!token.token) {
            alert("Invalid auth");
        }
        setCookie('token', token.token);
        var socket = io('http://localhost:3000');
    }
</script>
</body>
</html>
