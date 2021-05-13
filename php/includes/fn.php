<?php
function inpValidate($donnees)
{
  $donnees = trim($donnees);
  $donnees = stripslashes($donnees);
  $donnees = strip_tags($donnees);
  $donnees = htmlspecialchars($donnees);
  return $donnees;
}

function createToken()
{
  $bytes = random_bytes(12);
  return bin2hex($bytes);
}
