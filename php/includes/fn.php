<?php
function inpValidate($donnees)
{
  $donnees = trim($donnees);
  $donnees = stripslashes($donnees);
  $donnees = htmlspecialchars($donnees);
  return $donnees;
}

function creatToken()
{
  $bytes = random_bytes(12);
  return bin2hex($bytes);
}
