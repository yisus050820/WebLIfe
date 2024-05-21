<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pie de pagina</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
     <!--Iconos-->
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
    <script>
        Weglot.initialize({
            api_key: 'wg_7e952e0e75f7c6ce64c71ead9ef0ec902'
        });
    </script>
</head>
<body>
    

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }
        /*:::::Pie de Pagina*/
        .pie-pagina{
            width: 100%;
            background-color: #191919;
        }
        .pie-pagina .grupo-1{
            width: 100%;
            max-width: 1200px;
            margin: auto;
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap:50px;
            padding: 45px 0px;
        }
        .pie-pagina .grupo-1 .box figure{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pie-pagina .grupo-1 .box figure img{
            width: 250px;
        }
        .pie-pagina .grupo-1 .box h2{
            color: #fff;
            margin-bottom: 25px;
            font-size: 20px;
        }
        .pie-pagina .grupo-1 .box p{
            color: #efefef;
            margin-bottom: 10px;
        }
        .pie-pagina .grupo-1 .red-social a{
            display: inline-block;
            text-decoration: none;
            width: 45px;
            height: 45px;
            line-height: 45px;
            color: #fff;
            margin-right: 10px;
            background-color: #191919;
            text-align: center;
            transition: all 300ms ease;
        }
        .pie-pagina .grupo-1 .red-social a:hover{
            color: red;
        }
        .pie-pagina .grupo-2{
            background-color: black;
            padding: 15px 10px;
            text-align: center;
            color: #fff;
        }
        .pie-pagina .grupo-2 small{
            font-size: 15px;
        }
        @media screen and (max-width:800px){
            .pie-pagina .grupo-1{
                width: 90%;
                grid-template-columns: repeat(1, 1fr);
                grid-gap:30px;
                padding: 35px 0px;
            }
        }
<!--ffff -->
    </style>


<!--::::Pie de Pagina::::::-->
    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="/project333/img/logowl.png" alt="Logo">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Somos un grupo de estudiantes de la universidad de colima </p>
                <p>Jesus, Flor, Daniel, Ricardo y Alan dieron marcha a este proyecto llamado WebLife, sean bienvenidos.</p>
            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="#" class="fa fa-envelope"></a>
                    <a href="https://www.instagram.com/weblife.0/" class="fa fa-instagram"></a>
                    
                </div>
                <h2>IDIOMA</h2>
                <!-- Weglot Language Selector -->
                 <li>
                    <div id="weglot_here"></div>
                </li>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2024 <b>JARDA - WebLife</b> - Todos los Derechos Reservados. </small>
        </div>
    </footer>
</body>
</html>


<script src="<?= ROOT_URL ?>js/main.js"></script>
</body>

</html>