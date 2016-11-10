<?php
require("../restoFUNCTIONS.php");

if (isset($_GET["logout"])) {

    session_destroy();
    header("Location: restoSISSELOGIMINE.php");
    exit();
}



?>

<?php require("../header.php");?>
    <style>
        .red {
            max-width: 500px;
            color: red;
            margin: 0 auto;
        }.green{
             max-width: 500px;
             color: green;
             margin: 0 auto;
        }.title{
             font-size: 70px;
             max-width: 500px;
             color: green;
             margin: 0 auto;
        }.backout{
            font-size:30px;
        }
    </style>
    <span class='btn-default btn-lg' style="float: right"><a style="color: maroon"" href="?logout=1">Logi välja</a></span>
    <span style="float: left"><a class='btn-default btn-lg' style="color: maroon" href="restoDATA.php"> < tagasi</a></span>

    <h1 class="text-center" style="font-size: 70px;color: dodgerblue">Sinu profiil</h1>
    <br><br>
    <h1 class="text-center" style="color: maroon">Vabandame!</h1>
    <br><br>
    <p class="text-center" style="color: maroon;font-size: large;;">Hetkel käivad arendustööd Teie profiili paremaks muutmiseks.</p>

    <br><br><br><br><br><br><br><br><br><br>

    <h2 class="text-center" style="color: maroon">TÄNAME KANNATLIKKUSE EEST!</h2>
<?php require("../footer.php");?>

