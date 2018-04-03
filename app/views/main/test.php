<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
<div class="container">
    <div id="upload">
        <p id="wait"></p>
        <h2>authCard</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <br>
            <label for="device">Device </label>
            <br>
            <input type="text" id="device" name="device">
            <br>
            <label for="input">Input </label>
            <br>
            <input type="text" id="input" name="input">
            <br>
            <input type="submit" value="Тест">
            <br>
        </form>
    </div>
</div>
    

<script>
    function Send(){
        var id = document.getElementById('device').value;
        var value = document.getElementById('input').value;
        xhr = new XMLHttpRequest();

        xhr.open('POST', '/');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 ) {
                alert(xhr.responseText);
            }
            else if (xhr.status !== 200) {
                alert('Request failed.  Returned status of ' + xhr.status);
            }
        };
        xhr.send(encodeURI('id=' + id+'&value='+value));

    }
    document.querySelector('#upload form').addEventListener('submit', function(e) {
        e.preventDefault();
        Send();
    });
</script>

</body>
</html>
