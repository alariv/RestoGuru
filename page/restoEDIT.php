<?php
require("/home/alarvere/public_html/RestoGuru/restoFUNCTIONS.php");
require("/home/alarvere/public_html/RestoGuru/restoEDITFUNCTIONS.php");

if(isset($_GET["delete"])){


    $Edit->deleteResto(cleanInput($_GET["id"]));
    header("Location: restoDATA.php");
}

//kas kasutaja uuendab andmeid
if(isset($_POST["update"])){

    $Edit->updateResto(cleanInput($_POST["id"]), cleanInput($_POST["grade"]), cleanInput($_POST["comment"]));

    header("Location: restoDATA.php?id=".$_POST["id"]."&success=true");
    exit();

}

//saadan kaasa id
$P = $Edit->getSingleRestoData($_GET["id"]);
//var_dump($P);

?>
<?php require("../header.php");?>
<style>
    .heading {
        width: 410px;;
        color:dodgerblue;
        font-size: 50px;
        margin: 0 auto;
    }
    .center{
        width: 300px;
        margin: 0 auto;
    }
    .delete{
        width: 105px;
        margin: 0 auto;
    }
    .backout{
        font-size:30px;
    }
    .buttons{
        width: 300px;
        margin: 0 auto;
        height: 50px;
    }
</style>
<br><br>
<a class='btn-default btn-sm' href="restoDATA.php" style="font-size: 30px;color: maroon"> < tagasi </a>
<fieldset style="margin: 0 auto;max-width: 450px">
<h2 style="color: dodgerblue;font-size: 50px">Muuda sissekannet</h2>
</fieldset>
<form class="center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
    <input type="hidden" name="id" value="<?=$_GET["id"];?>" >
    <label for="restoName" >Restorani nimi:    </label><?php echo $P->restoName;?><br><br>

    <label>Senine hinne:</label>
    <?php if($P->grade=="1"){
    echo '<b style="color:red;">'.$P->grade.'</b>';
    }
    if($P->grade=="2"){
    echo '<b style="color:crimson;">'.$P->grade.'</b>';
    }
    if($P->grade=="3"){
    echo '<b style="color:blueviolet;">'.$P->grade.'</b>';
    }
    if($P->grade=="4"){
    echo '<b style="color:slateblue;">'.$P->grade.'</b>';
    }
    if($P->grade=="5"){
    echo '<b style="color:dodgerblue;">'.$P->grade.'</b>';
    }?>
    <br><br>

    <label>Uus hinne:</label>
    <input type="radio" name="grade" value="1" ><b style="color: red">1</b>
    <input type="radio" name="grade" value="2" ><b style="color: crimson">2</b>
    <input type="radio" name="grade" value="3" ><b style="color: blueviolet">3</b>
    <input type="radio" name="grade" value="4" ><b style="color: slateblue">4</b>
    <input type="radio" name="grade" value="5" ><b style="color: dodgerblue">5</b>

    <br><br>
    <label for="comment" >kommentaar:   </label>
    <input id="comment" name="comment" type="text" value="<?=$P->comment;?>"><br><br>

    <input class="buttons" type="submit" name="update" value="Salvesta">
</form>

<br><br>
<fieldset style="margin: 0 auto;max-width: 170px">
<a class='btn-default btn-lg' href="?id=<?=$_GET["id"];?>&delete=true">Kustuta postitus</a>
</fieldset>
<?php require("../footer.php");?>