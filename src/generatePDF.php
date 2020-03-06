<?php

include("../template/setup.php");
require('../lib/fPDF/fPDF.php');
require('../src/getCurrentURL.php');
include("../class/recipes.php");

$id=intval($_GET['id']);    //get id recipe
$pdf = new FPDF();
$bdd = connexion::connexionBdd();
$stmt = $bdd->prepare("SELECT recipe.id, title, content, duree, cuisson, persons, image FROM recipe WHERE id=:id;");
$stmt->execute(array('id' => $id));
$listRecipe=$stmt->fetchAll(PDO::FETCH_CLASS);

foreach ($listRecipe as $lst) {
    $BDDImage = $lst->image;
    $BDDTitle = $lst->title;
    $BDDContent = $lst->content;
    $BDDPreparation = $lst->duree;
    $BDDCuisson = $lst->cuisson;
}
//var_dump($lst);


$pdf->AddPage();
$pdf->SetAuthor("Les Recettes du Developpeur");
$pdf->SetTitle("Les recettes du Developpeur");  //page title
$pdf->SetFont('Arial','B',16);      // font
$pdf->SetX(60);

$pdf->SetFillColor(254,152,1);
$pdf->MultiCell(90, 5,utf8_decode("Les Recettes du \nDeveloppeur"),5,'C',1); // header title


$y=120;

// image's right part
$pdf->SetY(55);
$pdf->SetX(110);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(90,5, utf8_decode("$BDDTitle"),5,'C',1); //$BDDTitle

$pdf->SetFont('Arial','B',8);      // font


//PDF's right part

$prepTime=recipes::timeConvert($BDDPreparation);        //convert minutes in Hours:Minutes
$cookTime=recipes::timeConvert($BDDCuisson);
$tempsTotal = recipes::timeConvert($BDDCuisson+$BDDPreparation);

$pdf->Text(132,105,"Preparation: $prepTime "); //$BDDPreparation (4)
$pdf->Text(170,105,"Cuisson: $cookTime"); //$BDDCuisson (5)
$pdf->Text(150,97,"Temps total: $tempsTotal"); //$BDDCuisson (5)


$stmt = $bdd->prepare("SELECT * FROM recipeingredient WHERE recipe=:id ORDER BY unity DESC");
$stmt->execute(array('id' => $id));
$listIngredient=$stmt->fetchAll(PDO::FETCH_CLASS);
$y=120;
$pdf->SetFont('Arial','B',15); // font
foreach ($listIngredient as $lst)
{
    $BDDName = $lst->ingredient;
    $BDDQuantity = $lst->quantity;
    $BDDUnit = $lst->unity;
    $pdf->Text(135, $y,utf8_decode("$BDDQuantity $BDDUnit")); // nbIngr (6)
    $pdf->Text(155, $y,utf8_decode("$BDDName")); //Ingr (7)
    $y=$y+10;
}

$stmt = $bdd->prepare("SELECT * FROM recipesteps WHERE recipe=:id");
$stmt->execute(array('id' => $id));

$listIngredient=$stmt->fetchAll(PDO::FETCH_CLASS);
$pdf->SetY(105);
$nbEtapes= 1;
foreach ($listIngredient as $lst)
{
    $steps = $lst->steps;
    $pdf->MultiCell(110, 5, utf8_decode("\n$nbEtapes: $steps"),5,'J',1); // étapes recette (3)
    $nbEtapes++;
}

$pdf->Rect(60, 10, 90, 10, 3.5, 'DF');
$BDDImage="../".$BDDImage;
//amélio: $test=getimagesize($BDDImage);

$pdf->Image($BDDImage,10,30,-330 ); //$image (1)
$pdf->Line(10,100,200,100);
$pdf->Line(165,100,165,110);
$pdf->Line(130,100,130,250);
$pdf->Link(10, 30, 87, 58,"../index.php");


$pdf->SetFont('Arial','B',8 );      // font
$link=getCurrentURL();
$pdf->Text(5,295,utf8_decode("$link")); //(8)


$stmt = $bdd->prepare("SELECT user_id, nickname FROM recipe rec INNER JOIN user us ON rec.user_id=us.id WHERE rec.id=:id");
$stmt->execute(array('id' => $id));
$recupeNickname=$stmt->fetchAll(PDO::FETCH_CLASS);

foreach ($recupeNickname as $lst)
{
    $BDDNickname = $lst->nickname;
}

$pdf->Text(165,5,utf8_decode("Recette proposée par $BDDNickname")); //(8)
$pdf->Output("","Les recettes du Developpeur - $BDDContent.pdf"); //recipe.content

