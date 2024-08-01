<?php
session_start();
require_once('../require/config.php');
require_once '../lib/Examples/jpgraph/jpgraph.php';
require_once '../lib/Examples/jpgraph/jpgraph_line.php';

    // Запрос к функции
    $sql = "CALL get_booking_counts_by_hotel()";
    $stmt = $connect->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
    $hotels = array();
    $counts = array();

    // Перебор результатов и добавление данных в массивы
    foreach ($results as $row) {
        $hotels[] = $row["Название"];
        $counts[] = $row["Количество_Человек"];
    }

    // Находим индекс отеля с наибольшим количеством людей
    if (!empty($counts)) {
      $maxIndex = array_search(max($counts), $counts);
      $mostPopularHotel = $hotels[$maxIndex];
      $mostPeople = $counts[$maxIndex];
    } 
      
      $graph = new Graph(700,400);
      $graph->SetScale("textlin");

      $theme_class=new UniversalTheme;

      $graph->SetTheme($theme_class);
      $graph->img->SetAntiAliasing(false);
      $graph->title->Set('Распределение проживающих в базах отдыха Омутнинска');
      $graph->SetBox(false);

      $graph->SetMargin(100,100,40,40);

      $graph->img->SetAntiAliasing();

      $graph->yaxis->HideZeroLabel();
      $graph->yaxis->HideLine(false);
      $graph->yaxis->HideTicks(false,false);
      $graph->yaxis->scale->SetAutoMin(0);
      
      $graph->xgrid->Show();
      $graph->xgrid->SetLineStyle("solid");
      $graph->xaxis->SetTickLabels($hotels);
      $graph->xgrid->SetColor('#E3E3E3');

      $p1 = new LinePlot($counts);
      $graph->Add($p1);
      $p1->SetColor("#6495ED");
      $p1->SetLegend('Количество проживающих');

      $graph->legend->SetFrameWeight(1);

      $filename = './graph/graph_' . uniqid() . '.png';
      $graph->Stroke($filename);
?>
