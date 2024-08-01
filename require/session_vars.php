<?php 
session_start();
$adultCount = 1;
$childCount = 1;
$warning1 = "";

$journeys = [
  "База Отдыха" => "База отдыха",
  "Гостиница" => "Гостиница",
  "Санаторий" => "Санаторий"
];
$selected_type_of_journey = isset($_SESSION["selected_type_of_journey"]) ? $_SESSION["selected_type_of_journey"] : "";
$text_for_button = isset($_SESSION['buttonCountText']) ? $_SESSION['buttonCountText'] : "Число отдыхающих";
?>