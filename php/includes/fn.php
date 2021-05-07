<?php
function inpValidate($donnees)
{
  $donnees = trim($donnees);
  $donnees = stripslashes($donnees);
  $donnees = htmlspecialchars($donnees);
  return $donnees;
}
