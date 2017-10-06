<?php

class JQGPlugin extends CComponent
{	
	public function __construct()
	{
	}

	public function init()
	{
	}
	
	public function createGraph($content, $file)
	{
		spl_autoload_unregister(array('YiiBase','autoload')); //required when incorporating third party lib
		require_once (Yii::app()->basePath.'/extensions/jpgraph/src/jpgraph.php');
		require_once (Yii::app()->basePath.'/extensions/jpgraph/src/jpgraph_line.php');
		spl_autoload_register(array('YiiBase','autoload')); //required when incorporating third party lib
		
		$datay1 = array(20,15,23,15);
		$datay2 = array(12,9,42,8);
		$datay3 = array(5,17,32,24);
		
		for($i=0; $i < 4; $i++)
		{
			$datay1[$i]=rand(5, 24);
			$datay2[$i]=rand(5, 24);
			$datay3[$i]=rand(5, 24);
		}

		// Setup the graph
		$graph = new Graph(500,250);
		$graph->SetScale("textlin");

		$theme_class=new UniversalTheme;

		$graph->SetTheme($theme_class);
		$graph->img->SetAntiAliasing(false);
		$graph->title->Set('SMS Statistics');
		$graph->SetBox(false);

		$graph->img->SetAntiAliasing();

		$graph->yaxis->HideZeroLabel();
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle("solid");
		$graph->xaxis->SetTickLabels(array('Season 1','Season 2','Season 3','Season 4'));
		$graph->xgrid->SetColor('#E3E3E3');

		// Create the first line
		$p1 = new LinePlot($datay1);
		$graph->Add($p1);
		$p1->SetColor("#6495ED");
		$p1->SetLegend('Outbox');

		// Create the second line
		$p2 = new LinePlot($datay2);
		$graph->Add($p2);
		$p2->SetColor("#B22222");
		$p2->SetLegend('Sent');

		// Create the third line
		$p3 = new LinePlot($datay3);
		$graph->Add($p3);
		$p3->SetColor("#FF1493");
		$p3->SetLegend('Trash');

		$graph->legend->SetFrameWeight(1);

		// Output line
		$graph->Stroke();
		
		
	}
}
?>