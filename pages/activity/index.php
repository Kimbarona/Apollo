<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <form action="" >
        <input type="text" name="username" id="username" value=""/>
        <input type="text" name="password" id="password" value=""/>
        <button type="text" name="" id="submit">submit</button>
    </form>
</body>
</html>
<script>
    $( "#submit" ).click(function() {
        var username = $('#username').val();
        var password = $('#username').val();
        $.ajax({
            url: "posting.php",
            data: {username,password},
            method: "POST",
            success: function(res) {
                alert(res);
            }
            });
        });
</script>