<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test script</title>
</head>
<body>
<script>
    (function () {
        var scriptURL = 'assets/js/embed.js';
        // create cookie and set it to the current time and cookie expiration time
        var date = new Date();
        // checker domain is existing in the remote server
        var checkerDomain = 'http://localhost:8080';
        // check if the checker domain is existing
        var xhr = new XMLHttpRequest();
        xhr.open('GET', checkerDomain, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Checker domain is existing');
            } else {
                console.log('Checker domain is not existing');
            }
        };
        // check if the cookie is already set or create a new one
        // if (document.cookie.indexOf('checker') === -1) {
        //
        // }
        // ajax request to the remote server
        function ajaxRequest(url, method, data, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    callback(xhr.responseText);
                }
            };
            xhr.send(data);
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // set the cookie
        function setCookie(name, value, days = (30 * 24 * 60 * 60 * 1000)) {
            const date = new Date();
            date.setTime(date.getTime() + days);
            const expires = "expires=" + date.toUTCString();
            document.cookie = `${name}=${value};${expires};path=/`;
        }

        // form saved or unsaved = 1|0 write to the cookie
        var saved = 0;
        setCookie('saved', saved);
        if (getCookie('saved') === '0') {
            console.log('Form is saved');
            // loader the remote script
            var script = document.createElement('script');
            script.src = scriptURL;
            script.async = true;
            document.head.appendChild(script);
        }
    })();
</script>
</body>
</html>