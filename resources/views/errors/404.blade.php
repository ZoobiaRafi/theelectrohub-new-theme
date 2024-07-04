<!DOCTYPE html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>404 | The Electrohub</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/frontend/fav.png" type="image/x-icon">
        <link rel="icon" href="/frontend/fav.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/frontend/assets/css/icofont.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="/frontend/assets/css/stylex.css">
        <link rel="stylesheet" href="/frontend/assets/css/stylex-responsive.css">
        <style>
          .body-bg{
            background-color: #262626;
          }
          .btn-secondary{
            font-size: 1rem;
            background-color: transparent;
            border: 1px solid #fff;
            color:#fff;
          }
          .btn-secondary:hover{
            background-color: #fff;
            border: 1px solid #fff;
            color: #262626;
          }
          .navbar{
            /* background-color: #262626; */
          }
          .center{
            display:flex;
            align-items:center;
            justify-content:center;
          }
          
        </style>
    </head>
    <body class="bg-img body-bg">
        <div class="canvas-area">
            <canvas class="constellation"></canvas>
        </div>
        <div class="bg-img color-white main-container">
            <section id="header" class="style-1">
                <div class="container">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{route('homePage')}}">
                            <img src="/frontend/logo-white.png" alt="logo">
                        </a>
                    </nav>
                </div>
            </sction>
            <div id="main-content-home" class="xs-no-positioning fixed fixed-middle positon-fix-style-1">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="title">
                                    <span class="main-title">404! <br> Page not found.</span>
                                </div>
                                <p class="center">
                                  <a href="{{route('homePage')}}" class="btn btn-secondary"> back to home</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>        <script src="/frontend/assets/js/zepto.min.js"></script>
        <script src="/frontend/assets/js/constellation.min.js"></script>
        <script src="/frontend/assets/js/stars.min.js"></script>
        <script src="/frontend/assets/js/scriptsx.js"></script>
        <script>
            $('.canvas-area canvas').constellation({
                star: {
                    width: 3
                },
                line: {
                    color: 'rgba(255,255,255,0.7)'
                },
                length: (window.innerWidth / 9),
                radius: (window.innerWidth / 5)
            });
            $(document).ready(function(){
              setTimeout(function() {
                  window.location.href = "/";
              }, 5000); 
            });
        </script>
    </body>
</html>
