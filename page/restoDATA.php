<?php
	require("/home/alarvere/public_html/RestoGuru/restoFUNCTIONS.php");

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
		$Resto->saverestos($_POST["restoName"],$_POST["grade"],$_POST["comment"],$_SESSION["customer_sex"]);
		header("Location: restoDATA.php");
		exit();
	}

		if(isset($_GET["q"])){
			//kui otsib siis votame otsisona aadressirealt
			$q = $_GET["q"];
		}else {
			//otsisona tyhi
			$q="";
		}

		$sort="id";
		$order="ASC";
		if(isset($_GET["sort"]) && isset($_GET["order"])){
			$sort = $_GET["sort"];
			$order = $_GET["order"];
		}

		$person = $Resto->getallrestos($q, $sort, $order);

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
	<?php require("../header.php");?>
		
			
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
			<br>
		<p><span style="float: right" class="logout">
		<a class='btn-default btn-lg' href="?logout=1">LOGI VALJA</a><br><br>
                <a class='btn-default btn-sm' href="restoUSER.php"><?=$_SESSION["email"];?></a></span></p>

	
	<h1 class="restoguru">RestoGuru</h1>
		
		<p class="welcome"> Tere tulemast <?=$_SESSION["email"];?>!</p>
	
	<br><br>
		<fieldset style="border-bottom-width: 5px;border-top-width: 5px;border-right-width: 0;border-left-width: 0px" class="center">
		<form  method="POST">
            <p class="errors"><?php echo $restoNameError; ?></p>
			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"><a style="color: dodgerblue">Nimi</a></span>
			<input class="form-control" placeholder="Restorani nimi" name="restoName" type="text">
			
			<br><br><span style="color: lightcoral" class="glyphicon glyphicon-asterisk" "></span>
			<a style="color: dodgerblue">Hinnang:</a><br>

			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Hinne
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a type="radio" name="grade" value="1">1</a></li>
					<li><a type="radio" name="grade" value="2">2</a></li>
					<li><a type="radio" name="grade" value="3">3</a></li>
					<li><a type="radio" name="grade" value="4">4</a></li>
					<li><a type="radio" name="grade" value="5">5</a></li>
				</ul>
			</div>

			<!--<input type="radio" name="grade" value="1"> 1<br>
			<input type="radio" name="grade" value="2"> 2<br>
			<input type="radio" name="grade" value="3"> 3<br>
			<input type="radio" name="grade" value="4"> 4<br>
			<input type="radio" name="grade" value="5" checked> 5-->
			
			<br><br>
            <p class="errors"><?php echo $commentError; ?></p>
			<span style="color: lightcoral" class="glyphicon glyphicon-asterisk"><a style="color: dodgerblue">Kommentaar</a></span>
			<input class="form-control" placeholder="kommentaar" name="comment" type="text">
			
			<br><br>
			
			<input class="buttons" type="submit">
		
		</form>

		</fieldset>
		
<h1 style="color: dodgerblue;margin: 0 auto;max-width: 370px;font-size: 40px">Kasutajate tagasiside</h1><br>
	<fieldset style="border-width: 0px;margin: 0 auto;max-width: 370px">
	<form>
		<input class="form-control" style="color: dodgerblue" name="q" value="<?=$q;?>">
		<input style="width: 370px;color: grey;" type="submit" value="Otsi">
	</form>
	</fieldset>
	<br><br>
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
<h1 class="table-heading;">Kasutajate tagasiside tabel</h1>
<?php

	$html = "<table style='width: auto'>";
		$html .= "<tr>";

			$idOrder= "ASC";
			if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
					$idOrder = "DESC";
			}
			$restoNameOrder= "ASC";
			if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
				$restoNameOrder = "DESC";
			}
			$gradeOrder= "ASC";
			if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
				$gradeOrder = "DESC";
			}
			$commentOrder= "ASC";
			if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
				$commentOrder = "DESC";
			}
			$genderOrder= "ASC";
			if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
				$genderOrder = "DESC";
			}
			$createdOrder= "ASC";
			if(isset($_GET["order"]) && $_GET["order"] == "ASC"){
				$createdOrder = "DESC";
			}

			$html .= "<th style=\"background-color: lightskyblue\">
						<a href='?q=".$q."&sort=id&order=".$idOrder."'>id</a></th>";
			$html .= "<th style=\"background-color: lightblue\">
						<a href='?q=".$q."&sort=restoName&order=".$restoNameOrder."'>restorani nimi</th>";
			$html .= "<th style=\"background-color: lightskyblue\">
						<a href='?q=".$q."&sort=grade&order=".$gradeOrder."'>hinne</th>";
			$html .= "<th style=\"background-color: lightblue\">
						<a href='?q=".$q."&sort=comment&order=".$commentOrder."'>kommentaar</th>";
			$html .= "<th style=\"background-color: lightskyblue\">
						<a href='?q=".$q."&sort=gender&order=".$genderOrder."'>kliendi sugu</th>";
			$html .= "<th style=\"background-color: lightblue\">
						<a href='?q=".$q."&sort=created&order=".$createdOrder."'>loodud</th>";
			$html .= "<th style='background-color: lightskyblue'></th>";
		$html .= "</tr>";

	foreach($person as $P){
		$html .= "<tr>";
			$html .= '<td style="background-color: lightblue">'.$P->id."</td>";
			$html .= '<td style="background-color: lightskyblue">'.$P->restoName."</td>";
			$html .= '<td style="background-color: lightblue">'.$P->grade."</td>";
			$html .= '<td style="background-color: lightskyblue">'.$P->comment."</td>";
			$html .= '<td style="background-color: lightblue">'.$P->gender."</td>";
			$html .= '<td style="background-color: lightskyblue">'.$P->created."</td>";
        $html .= "<td style='background-color: lightblue'><a class='btn-default btn-sm' href='restoEDIT.php?id=".$P->id."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
		$html .= "</tr>";
		
	}
	$html .= "<?Table>";
	echo $html;
	
?>
<audio fadein autoplay loop >
    <source src="firstrain.mp3" type="audio/mpeg"  >;
</audio>
<?php require("../footer.php");?>