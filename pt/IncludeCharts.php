<?php
//Definição de variáveis.
$ChartID = $includeCharts_chartID;
$ChartTipo = $includeCharts_chartTipo;
$ChartEstilo = $includeCharts_chartEstilo; //Canvas JS (line, column, bar, area, spline, splineArea, stepLine, scatter, bubble, stackedColumn, stackedBar, stackedArea, stackedColumn100, stackedBar100, stackedArea100, pie, doughnut)
$ChartW = $includeCharts_chartW; //pixels (120px) ou % (100%)
$ChartH = $includeCharts_chartH; //pixels (120px) ou % (100%)

$ChartBarraW = $includeCharts_chartBarraW; //15
$ChartCorBarraPadrao = $includeCharts_chartCorBarraPadrao; //#cccccc
$ChartCorTextos = $includeCharts_chartCorTextos; //#cccccc
$ChartCorGrafico = $includeCharts_chartCorGrafico; //#cccccc
$ChartLinhaGraficoXEspessura = $includeCharts_chartLinhaGraficoXEspessura; //0 - invisível
$ChartLinhaGraficoYEspessura = $includeCharts_chartLinhaGraficoYEspessura; //0 - invisível
$ChartEixoXMaximo = $includeCharts_chartEixoXMaximo;
$ChartEixoYMaximo = $includeCharts_chartEixoYMaximo;
$ChartEixoYIntervalo = $includeCharts_chartEixoYIntervalo;

$ChartTitulo = $includeCharts_chartTitulo;
$ChartTituloX = $includeCharts_chartTituloX;
$ChartTituloY = $includeCharts_chartTituloY;
					
//$includeCharts_chartDados = "";
$ChartDados = $includeCharts_chartDados;
$ChartDadosMultiplos = $includeCharts_chartDadosMultiplos;



//Verificação de erro - debug.
//echo "TipoLogin=" . $TipoLogin . "<br />";
//echo "OrigemLogin=" . $OrigemLogin . "<br />"; 
//echo "paginaRetornoLogin=" . $paginaRetornoLogin . "<br />";
//echo "idRetornoLogin=" . $idRetornoLogin . "<br />";
?>


<?php //Diagramação 1.?>
<?php //**************************************************************************************?>
<?php if($ChartTipo == "1"){ ?>
	<script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("<?php echo $ChartID;?>", {
                interactivityEnabled: false,
                animationEnabled: false,
                exportEnabled: false,
                zoomEnabled:false,
                zoomType: "xy",
				<?php if($ChartBarraW <> "") {?>
					dataPointWidth: <?php echo $ChartBarraW;?>,
				<?php } ?>
                backgroundColor: "transparent",
                theme: "theme1",//theme1 | theme2 | theme3
                <?php if($ChartTitulo <> "") {?>
					title:{
						text: "<?php echo $ChartTitulo;?>",
						fontColor: "<?php echo $ChartCorTextos; ?>"
					},
				<?php } ?>
                toolTip:{
                    enabled: false   //enable here
                },
                axisX:{
                    title: "<?php echo $ChartTituloX;?>",
                    titleFontSize: 10,
                    prefix: "",
                    suffix: "",
					<?php if($ChartEixoXMaximo <> "") {?>
						maximum: <?php echo $ChartEixoXMaximo;?>,
					<?php } ?>
                    labelFontColor: "<?php echo $ChartCorTextos; ?>",
                    labelFontSize: 16,
                    tickColor: "<?php echo $ChartCorGrafico;?>",
                    tickThickness: 1,
                    gridColor: "<?php echo $ChartCorGrafico;?>",
                    gridThickness: <?php echo $ChartLinhaGraficoXEspessura;?>,
                    lineColor: "<?php echo $ChartCorGrafico;?>",
                    lineThickness: 1
                },
                axisY:{
                    title: "<?php echo $ChartTituloY;?>",
                    titleFontSize: 10,
                    prefix: "",
                    suffix: "",
					<?php if($ChartEixoYMaximo <> "") {?>
						maximum: <?php echo $ChartEixoYMaximo;?>,
					<?php } ?>
					<?php if($ChartEixoYIntervalo <> "") {?>
						interval: <?php echo $ChartEixoYIntervalo;?>,
					<?php } ?>
                    labelFontColor: "<?php echo $ChartCorTextos; ?>",
                    labelFontSize: 16,
                    tickColor: "<?php echo $ChartCorGrafico;?>",
                    tickThickness: 1,
                    gridColor: "<?php echo $ChartCorGrafico;?>",
                    gridThickness: <?php echo $ChartLinhaGraficoYEspessura;?>,
                    lineColor: "<?php echo $ChartCorGrafico;?>",
                    lineThickness: 1
                 },
                data: [   
				<?php if($ChartDados <> "") {?>     
                {
                    // Change type to "bar", "area", "spline", "pie",etc.
					name: "Dados 01",
					showInLegend: false,
                    type: "<?php echo $ChartEstilo; ?>",
					<?php if($ChartCorBarraPadrao <> "") {?>
						color: "<?php echo $ChartCorBarraPadrao;?>",
					<?php } ?>
					indexLabel: "{y}",//{label} | Win | x: {x}, y: {y}
					indexLabelPlacement: "outside",//auto | outside | inside
					indexLabelOrientation: "horizontal",
					indexLabelFontColor: "<?php echo $ChartCorTextos; ?>",					
                    dataPoints: [
                        <?php echo $ChartDados; ?>
                    ]
					/*
					dataPoints: [
                        { label: "apple",  y: 50, color: "#ccc"  },
                        { label: "orange", y: 15  },
                        { label: "banana", y: 25  },
                        { label: "mango",  y: 30  },
                        { label: "grape",  y: 28  }
                    ]
					*/
                }
				<?php } ?>
				<?php if($ChartDadosMultiplos <> "") {?>
					<?php echo $ChartDadosMultiplos; ?>
				<?php } ?>
                ]
            });
            chart.render();
        }
    </script>
    <div id="<?php echo $ChartID;?>" style="height: <?php echo $ChartH;?>; width: <?php echo $ChartW;?>;"></div>
<?php } ?>
