<?php
include_once ('../class/connexion.php');
include("../template/setup.php");
require('../lib/fPDF/fPDF.php');
require('../lib/PHPMailer/src/SMTP.php');
require('../src/getCurrentURL.php');


$pdf = new FPDF();
$bdd = connexion::connexionBdd();

$stmt=$bdd->query("SELECT * FROM recipe WHERE id=25");
$listRecipe=$stmt->fetchAll(PDO::FETCH_CLASS);

foreach ($listRecipe as $lst) { //récup image/titre/contenu recette
    $a = $lst->image;
    $b = $lst->title;
    $c = $lst->content;
    $d = $lst->duree;
}
//var_dump($list);



$pdf->AddPage();
$pdf->SetAuthor("Les Recettes du Developpeur");
$pdf->SetTitle("Les recettes du Developpeur");  //page title
$pdf->SetFont('Arial','B',16);      // font
$pdf->SetX(60);

$pdf->SetFillColor(254,152,1);
$pdf->MultiCell(90, 5,utf8_decode("Les Recettes du \nDeveloppeur"),5,'C',1);


$y=120;


$pdf->SetY(55);
$pdf->SetX(110);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(90,5, utf8_decode("$b"),5,'C',1);

$pdf->SetFont('Arial','B',8);      // font


//right part PDF
$pdf->Text(132,105,"Preparation: $d mn");
$pdf->Text(170,105,"Cuisson: mn");
$stmt=$bdd->query("SELECT * FROM ingredient WHERE id=1");
$listIngredient=$stmt->fetchAll(PDO::FETCH_CLASS);
$y=120;
$pdf->SetFont('Arial','B',15);      // font
foreach ($listIngredient as $lst)
{
    $d=$lst->name;
    $e= $lst->quantity;
    $pdf->Text(150,$y,"$e      $d");
    $y=$y+10;
}

$pdf->SetY(105);
$pdf->MultiCell(110, 5,utf8_decode("$c"),5,'L',1); //content recipe
$pdf->Rect(60, 10, 90, 10, 3.5, 'DF');
$pdf->Image('../img/image(1).jpg',10,30,-300);
$pdf->Line(10,100,200,100);
$pdf->Line(165,100,165,110);
$pdf->Line(130,100,130,250);
$pdf->Link(10, 30, 87, 58,"../index.php");



$pdf->SetFont('Arial','B',8 );      // font
$link=getCurrentURL();
$pdf->Text(5,295,"$link");

$pdf->Output("","Les recettes du Geek - $b");







