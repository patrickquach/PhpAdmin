#!/usr/local/bin/php
<?php
// projetMath.php for  in /Users/stevenleclerc/Documents/projetMath
// 
// Made by Steven Leclerc
// Login   <lecler_s@etna-alternance.net>
// 
// Started on  Mon Dec 30 14:48:23 2013 Steven Leclerc
// Last update Wed Jan  8 14:28:31 2014 Steven Leclerc
//

   //Phase 2.1
function subdivision ($vA, $vB, $nbSub)
{
  $subdivision = ($vB - $vA)/($nbSub);
  return $subdivision;
}
function calPrimX2 ($pA, $pB)
{
  $result = ($pB * $pB * $pB / 3) - ($pA * $pA * $pA / 3);
  return $result;
}

function calPrimX2Rectangle ($pB)
{
  $result = ($pB * $pB);
  return $result;
}

function calPrimDiv ($pA, $pB)
{
  $result = log($pB+1) - log($pA+1);
  return $result;
}

function calPrimDivRectangle ($pA)
{
  $result = 1 / ($pA+1);
  return $result;
}

function calPrimEx ($pA, $pB)
{
  $result = (exp($pB)) - (exp($pA));
  return $result;
}
function calPrimExRectangle ($pA)
{
  $result = exp($pA);
  return $result;
}
function calPrimSin ($pA, $pB)
{
  $result = (-cos($pB)) - (-cos($pA));
  return $result;
}
function calPrimSinRectangle ($pA)
{
  $result = sin($pA);
  return $result;
}

function MethodeRectangle ($a, $b, $nbSub, $f)
{
  $subDivision = subdivision($a, $b, $nbSub);
  for ($result = 0, $u = 0; $u <= $nbSub-1; $a += $subDivision, $u++)
    if ($f == 1)
      $result += calPrimX2Rectangle($a);
    else if ($f == 2)
	$result += calPrimDivRectangle($a);
    else if ($f == 3)
      $result += calPrimExRectangle($a);
    else if ($f == 4)
      $result += calPrimSinRectangle($a);
  $result *= $subDivision;
  return $result;
}
function MethodeTrapeze ($a, $b, $nbSub, $f)
{
  $subDivision = subdivision($a, $b, $nbSub);
  if ($f == 1)
    $moyenne = (calPrimX2Rectangle($a) + calPrimX2Rectangle($b)) / 2;
  else if ($f == 2)
    $moyenne = (calPrimDivRectangle($a) + calPrimDivRectangle($b)) / 2;
  else if ($f == 3)
    $moyenne = (calPrimExRectangle($a) + calPrimExRectangle($b)) / 2;
  else if ($f == 4)
    $moyenne = (calPrimSinRectangle($a) + calPrimSinRectangle($b)) / 2;
  $a = 1.05;
  for ($result = 0, $u = 1; $u <= $nbSub-1; $a += $subDivision, $u++)
    if ($f == 1)
      $result += calPrimX2Rectangle($a);
    else if ($f == 2)
      $result += calPrimDivRectangle($a);
    else if ($f == 3)
      $result += calPrimExRectangle($a);
    else if ($f == 4)
      $result += calPrimSinRectangle($a);
  $result += $moyenne;
  $result *= $subDivision;
  return $result;
}

function MethodeSimpson ($a, $b, $nbSub, $f)
{
$subdivision = subdivision($a, $b, $nbSub);
for ($xi = 1, $i = 1; $i <= $nbSub - 1; $i++)
{
  $xi += $subdivision;
  if ($f == 1)
  $somme1 = $somme1 + calPrimX2Rectangle($xi);
  else if ($f == 2)
    $somme1 = $somme1 + calPrimDivRectangle($xi);
  else if ($f == 3)
    $somme1 = $somme1 + calPrimExRectangle($xi);
  else if ($f == 4)
    $somme1 = $somme1 + calPrimSinRectangle($xi);
}
for ($xi = 1 , $xj = 1.05 ,$i = 0; $i <= $nbSub - 1; $i++)
  {
    if ($f == 1)
      $somme2 = $somme2 + (calPrimX2Rectangle(($xi + $xj)/2));
    else if ($f == 2)
      $somme2 = $somme2 + (calPrimDivRectangle(($xi + $xj)/2));
    else if ($f == 3)
      $somme2 = $somme2 + (calPrimExRectangle(($xi + $xj)/2));
    else if ($f == 4)
      $somme2 = $somme2 + (calPrimSinRectangle(($xi + $xj)/2));
    $xi += $subdivision;
    $xj += $subdivision;
  }
if ($f == 1)
$result = (calPrimX2Rectangle($a) + calPrimX2Rectangle($b) + (2 * $somme1)+(4 * $somme2))/(6 * $nbSub);
else if ($f == 2)
  $result = (calPrimDivRectangle($a) + calPrimDivRectangle($b) + (2 * $somme1)+(4 * $somme2))/(6 * $nbSub);
else if ($f ==3)
$result = (calPrimExRectangle($a) + calPrimExRectangle($b) + (2 * $somme1)+(4 * $somme2))/(6 * $nbSub);
else if ($f == 4)
$result = (calPrimSinRectangle($a) + calPrimSinRectangle($b) + (2 * $somme1)+(4 * $somme2))/(6 * $nbSub);
return $result;
}
function display ()
{
  $a = 1;
  $b = 2;
  $nbSub = 20;

  $primX2 = calPrimX2($a, $b);
  $primDiv = calPrimDiv($a, $b);
  $primEx = calPrimEx($a, $b);
  $primSin = calPrimSin($a, $b);
  for ($i = 0; $i <= 100; $i++)
    echo "-";
  echo "\n";
  for ($i = 0; $i <= 23; $i++)
    echo " ";
  echo "x^2               1/(1+x)               e^x               sin(x)    \n";
  echo "Valeur Réelle     ".$primX2."    ".$primDiv."     ".$primEx."     ".$primSin."\n";
  echo "Methode Rectangle ".MethodeRectangle($a, $b, $nbSub, 1)."            ".MethodeRectangle($a, $b, $nbSub, 2)."      ".MethodeRectangle($a, $b, $nbSub, 3)."     ".MethodeRectangle($a, $b, $nbSub, 4)."\n";
  echo "Methode Trapeze   ".MethodeTrapeze($a, $b, $nbSub, 1)."            ".MethodeTrapeze($a, $b, $nbSub, 2)."     ".MethodeTrapeze($a, $b, $nbSub, 3)."     ".MethodeTrapeze($a, $b, $nbSub, 4)."\n";
  echo "Methode Simpson   ".MethodeSimpson($a, $b, $nbSub, 1)."    ".MethodeSimpson($a, $b, $nbSub, 2)."     ".MethodeSimpson($a, $b, $nbSub, 3)."     ".MethodeSimpson($a, $b, $nbSub, 4)."\n";
  for ($i = 0; $i <= 100; $i++)
    echo "-";
  echo "\n";
}
<<<<<<< HEAD
calPrimitives();

  //phase 4

function d1($a, $b, $x)
{
  $result = 4 * $x * exp(-2 * $x);
  echo $result."\n";
  echo $a."\n";
  echo $b."\n";
  echo $x."\n";

  return $result;
}


d1(0,100,2);
=======

display();
>>>>>>> 8b9e7dd28a6799323c459b3a5fbad94500a3edd7
