<html>

<head>
    <meta charset="utf-8">
    <title>Site Yapım Aşamasında</title>
</head>

<style>
    @charset "UTF-8";

    body {
        background: #000;
    }

    div {
        color: #3c7941;
        font-family: Monaco, monospace;
        font-size: 24px;
        width: 100%;
        text-align: center;
        position: absolute;
        top: 45%;
        left: 0;
        animation: 120ms infinite normal glitch;
    }

    @media screen and (max-width: 991px) {
        div {
            font-size: 50px;
        }
    }

    span {
        animation: 1.5s infinite normal imleç;
    }

    ::-moz-selection {
        background: #7021d2;
        color: #fff;
    }

    ::selection {
        background: #7021d2;
        color: #fff;
    }

    @keyframes glitch {
        0% {
            opacity: 0;
            left: 0;
        }

        40%,
        80% {
            opacity: 1;
            left: -2px;
        }
    }

    @keyframes imleç {
        0% {
            opacity: 0;
            left: 0;
        }

        40% {
            opacity: 0;
            left: -2px;
        }

        80% {
            opacity: 1;
            left: -2px;
        }
    }
</style>

<body>

    <body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
        <div id="yazı">█ █ █ <span style="color:#164419">█ █ █ █ █ █ █ █ █ █ </span>77%
            <br>&gt; Site Yapım Aşamasında&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <br>&gt; Yakında Hizmette <span id="imleç">█</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </body>

</html>