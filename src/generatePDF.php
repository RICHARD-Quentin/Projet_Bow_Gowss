<?php
include_once ('../class/connexion.php');
include("../template/setup.php");
require('../lib/fPDF/fPDF.php');
require('../lib/PHPMailer/src/SMTP.php');
require('../src/getCurrentURL.php');
include("../class/recipes.php");


$pdf = new FPDF();
$bdd = connexion::connexionBdd();
$id=37;
$stmt=$bdd->query("SELECT recipe.id, title, content, duree, cuisson, persons, image FROM recipe WHERE id=$id;");
$listRecipe=$stmt->fetchAll(PDO::FETCH_CLASS);

foreach ($listRecipe as $lst) {
    $BDDImage = $lst->image;
    $BDDTitle = $lst->title;
    $BDDContent = $lst->content;
    $BDDPreparation = $lst->duree;
    $BDDCuisson = $lst->cuisson;
}
//var_dump($list);


$pdf->AddPage();
$pdf->SetAuthor("Les Recettes du Developpeur");
$pdf->SetTitle("Les recettes du Developpeur");  //page title
$pdf->SetFont('Arial','B',16);      // font
$pdf->SetX(60);

$pdf->SetFillColor(254,152,1);
$pdf->MultiCell(90, 5,utf8_decode("Les Recettes du \nDeveloppeur"),5,'C',1); // header title


$y=120;

// contenu à droite de l'image
$pdf->SetY(55);
$pdf->SetX(110);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(90,5, utf8_decode("$BDDTitle"),5,'C',1); //$BDDTitle (2)

$pdf->SetFont('Arial','B',8);      // font


//right part PDF

$prepTime=recipes::timeConvert($BDDPreparation);
$cookTime=recipes::timeConvert($BDDCuisson);

$tempsTotal = recipes::timeConvert($BDDCuisson+$BDDPreparation);


$pdf->Text(132,105,"Preparation: $prepTime "); //$BDDPreparation (4)
$pdf->Text(170,105,"Cuisson: $cookTime"); //$BDDCuisson (5)
$pdf->Text(150,97,"Temps total: $tempsTotal"); //$BDDCuisson (5)


$stmt=$bdd->query("SELECT * FROM recipeingredient WHERE recipe=$id");
$listIngredient=$stmt->fetchAll(PDO::FETCH_CLASS);
$y=120;
$pdf->SetFont('Arial','B',15); // font
foreach ($listIngredient as $lst)
{
    $BDDName = $lst->ingredient;
    $BDDQuantity = $lst->quantity;
    $pdf->Text(135, $y,"$BDDQuantity"); // nbIngr (6)
    $pdf->Text(155, $y,"$BDDName"); //Ingr (7)
    $y=$y+10;
}


$stmt=$bdd->query("SELECT * FROM recipesteps WHERE recipe=37;");
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

$pdf->Image($BDDImage,10,30,-330 ); //$image (1)
$pdf->Line(10,100,200,100);
$pdf->Line(165,100,165,110);
$pdf->Line(130,100,130,250);
$pdf->Link(10, 30, 87, 58,"../index.php");


$pdf->SetFont('Arial','B',8 );      // font
$link=getCurrentURL();
$pdf->Text(5,295,"$link"); //(8)

$pdf->Output("","Les recettes du Developpeur - $BDDContent.pdf"); //$lenomdelarecette







