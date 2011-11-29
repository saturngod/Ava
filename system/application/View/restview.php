<html>
<head>
    <title>Ava Framework</title>
    <style>
    .content
    {
        width:800px;
        margin:0px auto;
        padding:5px 10px;
        border:1px solid #EEE;
        -webkit-box-shadow: 0 0 8px #D0D0D0;
    }
    .content > h1 {
        text-align:center;
        margin-top:3px;
        border-bottom: 1px solid #D0D0D0;
        color: #444;
    }

    .content a, .content a:link, .content a:visited {
        color: #555;
        text-decoration:none;
    }
    </style>
</head>
<body>
    <div class="content">
        <h1>Username</h1>
        <p><?php if(isset($username)) echo $username; ?></p>

        <h1>ID</h1>
        <p><?php if(isset($id)) echo $id; ?></p>
    </div>

</body>
</html>