<fieldset style="border-left-width: 0px;border-right-width: 0px;border-bottom-width: 0px;border-top-width: 0px;background-color: rgba(0, 36, 255, 0.10)">
<?php
	require("restoFUNCTIONS.php");

	if(!isset ($_SESSION["userId"])) {
		
		header("Location: restoSISSELOGIMINE.php");
		exit();
	}
	if(isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: restoSISSELOGIMINE.php");
		exit();
	}


	
	$restoName = "";
	$grade = "";
	$comment= "";
	$customer_sex = "";
	$person = "";
    $restoNameError = "";
    $commentError = "";
	//kontrollin et valjad poleks tyhjad
	if( isset($_POST["restoName"]) &&
		isset($_POST["comment"]) &&
		!empty($_POST["restoName"]) &&
		!empty($_POST["comment"])
	)	{
		//login sisse
		$Resto->saverestos($_POST["restoName"],$_POST["grade"],$_POST["comment"],$_POST["customer_sex"]);
		header("Location: restoDATA.php");
		exit();
	}
	
		$person = $Resto->getallrestos();

    if (isset ($_POST ["restoName"])) {
        // oli olemas, ehk keegi vajutas nuppu
        if (empty($_POST ["restoName"])) {
            //oli tõesti tühi
            $restoNameError = "Sisesta restorani nimi!";
        } else {
            $restoName = $_POST ["restoName"];
        }
    }
    if (isset ($_POST ["comment"])) {
        // oli olemas, ehk keegi vajutas nuppu
        if (empty($_POST ["comment"])) {
            //oli tõesti tühi
            $commentError = "Sisesta kommentaar!";
        } else {
            $comment = $_POST ["comment"];
        }
    }



//echo"<pre>";
		//var_dump($person);
		//echo"</pre>";


?>
		
			
			<style>
				.restoguru {
                min-width: 50px;
				max-width: 300px;
				color:dodgerblue;
				font-size: 70px;
				margin: 0 auto;
				}
				.logout {
				min-width: 150px;
				max-width: 500px;
				color:dodgerblue;
				}
				.welcome{
					font-size:30px;
					max-width: 400px;
					color:dodgerblue;
					margin: 0 auto;
				}
                .errors {
                    max-width: 150px;
                    color:red;
                }
				table, th, td{
					border: 2px solid dodgerblue;
					border-collapse: collapse;
					margin: 0 auto;
				}
				th, td{
					padding: 10px;
				}
				.center{
					margin: 0 auto;
					max-width: 300px;
				}
				.table-heading{
					margin: 0 auto;
					max-width: 380px;
				}
				.buttons{
					color: grey;
					margin: 0 auto;
					width: 300px;
					height: 50px;
				}
				.feedback{
					float:left;
				}
			</style>
			
		<p><span style="float: right" class="logout">
		<a href="?logout=1">LOGI VALJA</a><br><br>
                <a href="restoUSER.php"><?=$_SESSION["email"];?></a></span></p>

	
	<h1 class="restoguru">RestoGuru</h1>
		
		<p class="welcome"> Tere tulemast <?=$_SESSION["email"];?>!</p>
	
	<br><br>
		<fieldset style="border-bottom-width: 5px;border-top-width: 5px;border-right-width: 0;border-left-width: 0px" class="center">
		<form  method="POST">
            <p class="errors"><?php echo $restoNameError; ?></p>
			<input  placeholder="Restorani nimi" name="restoName" type="text">
			
			<br><br>
			hinnang restoranile:<br>
			<input type="radio" name="grade" value="1"> 1<br>
			<input type="radio" name="grade" value="2"> 2<br>
			<input type="radio" name="grade" value="3"> 3<br>
			<input type="radio" name="grade" value="4"> 4<br>
			<input type="radio" name="grade" value="5" checked> 5
			
			<br><br>
            <p class="errors"><?php echo $commentError; ?></p>
			<input placeholder="kommentaar" name="comment" type="text">
			
			<br><br>
			
			<input class="buttons" type="submit">
		
		</form>
		</fieldset>
		
<h1 style="color: dodgerblue;margin: 0 auto;max-width: 370px;font-size: 40px">Kasutajate tagasiside</h1><br><br>
	<fieldset style="border-bottom-width: 15px;border-top-width: 15px;border-right-width: 0;border-left-width: 0px">
<?php

	foreach($person as $P){
			if($P->grade=="1"){
				echo '<h3 class="feedback" style="color:red;font-size: 22">'.$P->restoName.'</h3>';
			}
			if($P->grade=="2"){
				echo '<h3 class="feedback" style="color:crimson;font-size: 27">'.$P->restoName.'</h3>';
			}
			if($P->grade=="3"){
				echo '<h3 class="feedback" style="color:blueviolet;font-size: 32">'.$P->restoName.'</h3>';
			}
			if($P->grade=="4"){
				echo '<h3 class="feedback" style="color:slateblue;font-size: 37">'.$P->restoName.'</h3>';
			}
			if($P->grade=="5"){
				echo '<h3 class="feedback" style="color:dodgerblue;font-size: 42">'.$P->restoName.'</h3>';
		}
		
	}
?></fieldset><br><br><br><br><br><br>
<h1 class="table-heading">Kasutajate tagasiside tabel</h1>
<?php

	$html = "<table style='width: auto'>";
		$html .= "<tr>";
			$html .= "<th style=\"background-color: lightskyblue\">id</th>";
			$html .= "<th style=\"background-color: lightblue\">restorani nimi</th>";
			$html .= "<th style=\"background-color: lightskyblue\">hinne</th>";
			$html .= "<th style=\"background-color: lightblue\">kommentaar</th>";
			$html .= "<th style=\"background-color: lightskyblue\">kliendi sugu</th>";
			$html .= "<th style=\"background-color: lightblue\">loodud</th>";
			$html .= "<th style='background-color: lightskyblue'></th>";
		$html .= "</tr>";

	foreach($person as $P){
		$html .= "<tr>";
			$html .= '<td style="background-color: lightblue">'.$P->id."</td>";
			$html .= '<td style="background-color: lightskyblue">'.$P->restoName."</td>";
			$html .= '<td style="background-color: lightblue">'.$P->grade."</td>";
			$html .= '<td style="background-color: lightskyblue">'.$P->comment."</td>";
			$html .= '<td style="background-color: lightblue">'.$P->customer_sex."</td>";
			$html .= '<td style="background-color: lightskyblue">'.$P->created."</td>";
        $html .= "<td style='background-color: lightblue'><a href='restoEDIT.php?id=".$P->id."'>muuda</a></td>";
		$html .= "</tr>";
		
	}
	$html .= "<?Table>";
	echo $html;
	
?>
</fieldset>
<audio fadein autoplay loop >
    <source src="firstrain.mp3" type="audio/mpeg"  >;
</audio>