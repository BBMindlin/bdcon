<?php
//Definição de variáveis.
//$dataAtual = date("Y") . "-" . date("m") . "-" . date("d");
$dataAtual = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataAtualConvert = strtotime($dataAtual);
$ConfigCalendarioDataPadraoDia = date('d', $dataAtualConvert);
$ConfigCalendarioDataPadraoMes = date('m', $dataAtualConvert);
$ConfigCalendarioDataPadraoAno = date('Y', $dataAtualConvert);
$dataInicial_print = Funcoes::DataLeitura01($ConfigCalendarioDataPadraoAno . "-" . $ConfigCalendarioDataPadraoMes . "-" . $ConfigCalendarioDataPadraoDia, $GLOBALS['configSiteFormatoData'], "1");

$ConfigCalendarioDivID = $includeCalendario_configCalendarioDivID;
$ConfigTipoDiagramacao = $includeCalendario_configTipoDiagramacao; //'1 - fullcalendar 2.6.1 (JQuery)
$ConfigCalendarioTipo = $includeCalendario_configCalendarioTipo; //mensal | semanal

$ConfigCalendarioIntervalo = $includeCalendario_configCalendarioIntervalo; //formato: 00:15:00
if($ConfigCalendarioIntervalo <> "")
{
	$ConfigCalendarioIntervaloMinutos = Funcoes::DataIntervalo02("m", "00:00:00", $ConfigCalendarioIntervalo);
}else{
	$ConfigCalendarioIntervaloMinutos = 30;
}

$ConfigCalendarioHorarioMinimo = $includeCalendario_configCalendarioHorarioMinimo; //formato: 07:00:00
$ConfigCalendarioHorarioMaximo = $includeCalendario_configCalendarioHorarioMaximo; //formato: 23:15:00

$ConfigPaginaSelect = "SiteAdmTarefasIndice.php";

$nomeVariavel1 = "";
$nomeVariavel1Valor = "";
$nomeVariavel2 = "";
$nomeVariavel2Valor = "";
$nomeVariavel3 = "";
$nomeVariavel3Valor = "";

$idTbCadastro = "";
$idTbCadastro1 = "";

$dtCadastroRHContrato = "";
$calendarioEventsCadastroRHContrato = "";


//Tarefas registradas.
//----------
$dtCadastroTarefas = "";
$calendarioEventsTarefas = "";

$dtCadastroTarefas = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_tarefas", 
															array("ativacao;1;i"), 
															$GLOBALS['configClassificacaoTarefas'], 
															"");
														
if (empty($dtCadastroTarefas))
{
	//Nenhum resultado.
}else{
	//Loop pelos resultados.
	foreach($dtCadastroTarefas as $linhaDtCadastroTarefas)
	{
		//Motangem do string events.
		$calendarioEventsTarefas .= "{";
		$calendarioEventsTarefas .= "id: " . $linhaDtCadastroTarefas['id'] . ",";
		$calendarioEventsTarefas .= "title: '" . Funcoes::removerHTML01(Funcoes::ConteudoMascaraLeitura($linhaDtCadastroTarefas['tarefa'], "json_encode")) . "',";
		$calendarioEventsTarefas .= "description: '" . Funcoes::removerHTML01(Funcoes::ConteudoMascaraLeitura($linhaDtCadastroTarefas['descricao'], "json_encode")) . "',";
		
		//$calendarioEventsTarefas .= "color: '#cccccc',";
		//$calendarioEventsTarefas .= "backgroundColor: '#cccccc',";
		//$calendarioEventsTarefas .= "borderColor: '#000',";
		//$calendarioEventsTarefas .= "className: ['AdmTbFundoEscuro'],"; //Não está funcionando.
		//$calendarioEventsTarefas .= "className: 'AdmTbFundoEscuro',"; //Não está funcionando.
		//$calendarioEventsTarefas .= "allDay: true,";
		
		//Campos personalizados (não vai afetar o funcinamento das funções do calendário, mas vai servir para interatividade com os eventos.
		$calendarioEventsTarefas .= "idParent: '" . $linhaDtCadastroTarefas['id_parent'] . "',";
		$calendarioEventsTarefas .= "idTbCadastroUsuario: '" . $linhaDtCadastroTarefas['id_tb_cadastro_usuario'] . "',";
		$calendarioEventsTarefas .= "idTbCadastroUsuarioNome: '" . Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($linhaDtCadastroTarefas['id_tb_cadastro_usuario'], "tb_cadastro", "nome")) . "',";

		$calendarioEventsTarefas .= "start: '" . Funcoes::DataLeitura01($linhaDtCadastroTarefas['data_tarefa'], $GLOBALS["configSiteFormatoData"], 11) . "'";
		//$calendarioEventsTarefas .= "start: '2018-02-27T14:00:00'"; //debug
		$calendarioEventsTarefas .= ",";
		if($habilitarTarefasDataFinal == 1)
		{
			$calendarioEventsTarefas .= "end: '" . Funcoes::DataLeitura01($linhaDtCadastroTarefas['data_tarefa_final'], $GLOBALS["configSiteFormatoData"], 11) . "'";
		}else{
			$calendarioEventsTarefas .= "end: '" . Funcoes::DataLeitura01(Funcoes::DataAlterar01($linhaDtCadastroTarefas['data_tarefa'], $ConfigCalendarioIntervaloMinutos, "+", "m"), $GLOBALS["configSiteFormatoData"], 11) . "'";
		}
		//$calendarioEventsTarefas .= "end: '2018-02-27T14:30:00'"; //debug
		$calendarioEventsTarefas .= "},";
		
		//id: 999,
		//title:      'Início das Operações',
		//start:      '2016-07-28T16:20:00',
		//End '2016-07-28T18:20:00'

		
		//Verificação de erro - debug.
		//echo "id=" . $linhaDtCadastroTarefas['id'] . "<br>";
	}
}

unset($dtCadastroTarefas);
unset($linhaDtCadastroTarefas);
//----------


//Verificação de erro - debug.
//echo "calendarioEventsTarefas=" . $calendarioEventsTarefas . "<br>";
//echo "ConfigCalendarioIntervaloMinutos=" . $ConfigCalendarioIntervaloMinutos . "<br>";
//echo "DataIntervalo02=" . Funcoes::DataIntervalo02("m", "00:00:00", $ConfigCalendarioIntervalo) . "<br>";
//echo "DataAlterar01=" . Funcoes::DataAlterar01("2018-02-23 12:29:07", $ConfigCalendarioIntervaloMinutos, "+", "m") . "<br>";
?>


<?php //Calender (full calendar 2.6.1).?>
<?php //**************************************************************************************?>
<?php //OBS dev: O código neste local não funciona no Firefox. Para funcionar no firefox, deve colocar o código jquery no head (e depois dos includes) - consultar o HTML de teste para verificar.?>
<?php if($ConfigTipoDiagramacao == "2"){ ?>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#<?php echo $ConfigCalendarioDivID; ?>').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: ''
                        //right: 'month,agendaWeek,agendaDay'
                    },
					/*
					views: {
						agendaWeek: { // name of view
							//columnHeaderFormat: 'dddd D/M'
							columnHeader: 'dddd D/M'
						}
					},
					*/
					
					//header:false, //funcionando (obs: div pai não pode ser table).
					//height: 371, //funcionando.
                    //defaultDate: '2016-01-12',
                    defaultDate: '<?php echo $ConfigCalendarioDataPadraoAno; ?>-<?php echo $ConfigCalendarioDataPadraoMes; ?>-<?php echo $ConfigCalendarioDataPadraoDia; ?>',
					hiddenDays: [0], //Ocultar dias das semana (0 - domingo | 1 - segunda, ect).
					allDaySlot: false,

					//month | basicWeek | basicDay | agendaWeek | agendaDay | listYear | listMonth | listWeek | listDay
					<?php if($ConfigCalendarioTipo == "mensal"){ ?>
						defaultView: 'month', 
					<?php } ?>
					<?php if($ConfigCalendarioTipo == "semanal"){ ?>
						defaultView: 'agendaWeek', 
					<?php } ?>
					
					<?php if($ConfigCalendarioIntervalo <> ""){ ?>
						slotDuration: '<?php echo $ConfigCalendarioIntervalo; ?>',
					<?php } ?>
					<?php if($ConfigCalendarioIntervalo <> ""){ ?>
						slotLabelInterval: '<?php echo $ConfigCalendarioIntervalo; ?>',
					<?php } ?>
					slotLabelFormat: 'H:mm', //h:mm | H:mm (24h) | ref: https://fullcalendar.io/docs/text/timeFormat/
					
					<?php if($ConfigCalendarioHorarioMinimo <> ""){ ?>
					minTime: '<?php echo $ConfigCalendarioHorarioMinimo; ?>',
					<?php } ?>
					<?php if($ConfigCalendarioHorarioMaximo <> ""){ ?>
					maxTime: '<?php echo $ConfigCalendarioHorarioMaximo; ?>',
					<?php } ?>
					//columnHeaderFormat: 'dddd D/M',//Não funcionou
					
					
					//Formatação das datas das colunas (funcionando).
					//ref: https://fullcalendar.io/docs/titleFormat
					columnFormat: {
						month: 'ddd',
						week: 'dddd d/M/YY',
						day: 'dddd d/M'
					},
					

					selectable: true,
                    selectHelper: true,
					
                    select: function (start, end) {
						//Datas.
						//ref (formato de datas): https://stackoverflow.com/questions/3552461/how-to-format-a-javascript-date
						
						//Data inicial.
						var calendarioDataDiaSelect = moment(start).format('DD', new Date());
						var calendarioDataMesSelect = moment(start).format('MM', new Date());
						var calendarioDataAnoSelect = moment(start).format('YYYY', new Date());
						
						var calendarioDataDiaSemanaSelect = moment(start).format('dddd', new Date());

						var calendarioDataHoraSelect = moment(start).format('HH', new Date());
						var calendarioDataMinutoSelect = moment(start).format('mm', new Date());
						
						//Data final.
						var calendarioDataFinalDiaSelect = moment(end).format('DD', new Date());
						var calendarioDataFinalMesSelect = moment(end).format('MM', new Date());
						var calendarioDataFinalAnoSelect = moment(end).format('YYYY', new Date());
						
						var calendarioDataFinalDiaSemanaSelect = moment(end).format('dddd', new Date());

						var calendarioDataFinalHoraSelect = moment(end).format('HH', new Date());
						var calendarioDataFinalMinutoSelect = moment(end).format('mm', new Date());


						//Montagem URL.
						//var urlCalendarioDestino = '<?php echo $configUrl; ?>/<?php echo $visualizacaoAtivaSistema; ?>/<?php echo $ConfigPaginaSelect; ?>?calendarioDataSelect=' + moment(start).format() + '&calendarioDataFinalSelect=' + moment(end).format() + '&calendarioDataDiaSelect=' + moment(start).format('DD', new Date()) + '&calendarioDataMesSelect=' + moment(start).format('MM', new Date()) + '&calendarioDataAnoSelect=' + moment(start).format('YYYY', new Date()) + '<?php echo $queryPadrao; ?>';
						var urlCalendarioDestino = '<?php echo $configUrl; ?>/<?php echo $visualizacaoAtivaSistema; ?>/<?php echo $ConfigPaginaSelect; ?>?calendarioDataSelect=' + moment(start).format('YYYY-MM-DDTHH:mm:SS') + '&calendarioDataFinalSelect=' + moment(end).format('YYYY-MM-DDTHH:mm:SS') + '&calendarioDataDiaSelect=' + moment(start).format('DD', new Date()) + '&calendarioDataMesSelect=' + moment(start).format('MM', new Date()) + '&calendarioDataAnoSelect=' + moment(start).format('YYYY', new Date()) + '<?php echo $queryPadrao; ?>';


                        //window.location.replace('http://www.google.com.br?data=' + defaultDate);
                        //window.location.replace('http://www.google.com.br?data=' + start);
                        //window.location.replace('http://www.google.com.br?data=' + moment(start).format());
						
						
						//Direrionar para uma página com os dados da seleção (funcionando).
                        //window.location.replace('<?php echo $configUrl; ?>/<?php echo $visualizacaoAtivaSistema; ?>/<?php echo $ConfigPaginaSelect; ?>?calendarioDataSelect=' + moment(start).format() + '&calendarioDataDiaSelect=' + moment(start).format('DD', new Date()) + '&calendarioDataMesSelect=' + moment(start).format('MM', new Date()) + '&calendarioDataAnoSelect=' + moment(start).format('YYYY', new Date()) + '<?php echo $queryPadrao; ?>');
                        //window.location.replace(urlCalendarioDestino);
						
						
						//Alterar link de agendar tarefas.
						//$('#linkTarefas').attr('href', '<?php echo $configUrl; ?>/<?php echo $visualizacaoAtivaSistema; ?>/<?php echo $ConfigPaginaSelect; ?>?calendarioDataSelect=' + moment(start).format() + '&calendarioDataFinalSelect=' + moment(end).format() + '&calendarioDataDiaSelect=' + moment(start).format('DD', new Date()) + '&calendarioDataMesSelect=' + moment(start).format('MM', new Date()) + '&calendarioDataAnoSelect=' + moment(start).format('YYYY', new Date()) + '<?php echo $queryPadrao; ?>');
						$('#linkTarefas').attr('href', urlCalendarioDestino);


						//Preenchimento de campos.
						/*
						elementoMensagem01('data_tarefa', calendarioDataDiaSelect + '/' + calendarioDataMesSelect + '/' + calendarioDataAnoSelect);
						elementoMensagem01('data_tarefa_dia_semana', calendarioDataDiaSemanaSelect);
						elementoMensagem01('data_tarefa_hora', calendarioDataHoraSelect);
						elementoMensagem01('data_tarefa_minuto', calendarioDataMinutoSelect);
						
						elementoMensagem01('data_final_tarefa_hora', calendarioDataFinalHoraSelect);
						elementoMensagem01('data_final_tarefa_minuto', calendarioDataFinalMinutoSelect);
						*/


                        /*var title = prompt('Event Title:');
                        var eventData;
                        if (title) {
                        eventData = {
                        title: title,
                        start: start,
                        end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                        }
                        $('#calendar').fullCalendar('unselect');
                        */
                    },
					
                    //editable: true, // arrastar event
                    eventLimit: true, // allow "more" link when too many events
                    events: [
					
					//Dados registrados - Cadastro RH Contrato.
                    //<%=calendarioEventsCadastroRHContrato %>
					
					//Dados registrados - Tarefas.
					<?php echo $calendarioEventsTarefas; ?>
					//{id: 4215,title: 'Teste com agendamento',start: '2018-02-27T14:00:00',end: '2018-02-27T14:30:00'},{id: 4216,title: 'Teste com agendamento açougue',start: '2018-02-27T14:00:00',end: '2018-02-27T14:30:00'},
					
                    {
                        id: 999,
                        title: 'Início das Operações',
                        start: '<?php echo $configAnoCopiright; ?>-01-01T00:00:00',
                        end: '<?php echo $configAnoCopiright; ?>-01-01T00:00:00'
                    }

                    /*
                    {
                    title: 'All Day Event',
                    start: '2016-01-01'
                    },
                    {
                    title: 'Long Event',
                    start: '2016-01-07',
                    end: '2016-01-10'
                    },
                    {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2016-01-09T16:00:00'
                    },
                    {
                    title: 'Conference',
                    start: '2016-02-11',
                    end: '2016-02-13'
                    },
                    {
                    title: 'Meeting',
                    start: '2016-01-12T10:30:00',
                    end: '2016-01-12T12:30:00'
                    },
                    {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2016-01-28'
                    }
                    */
			        ],
                    eventSources: [{
                        //className: ["AdmTbFundoEscuro"]
                        //className: 'AdmTbFundoEscuro'
                        //backgroundColor: "#304e80"
                    }],                    
                    //eventClass: "AdmTbFundoEscuro",
					
					
					//Click do evento.
					eventClick: function(calEvent, jsEvent, view) {
						//Variáveis - dados do evento.
						var eventoID = calEvent.id;
						var eventoIdParent = calEvent.idParent;
						var eventoTitulo = calEvent.title;
						var eventoDescricao = calEvent.description;
						
						var eventoDataInicio = calEvent.start;
						var eventoDataFinal = calEvent.end;
						
						//Data inicial.
						var eventoDataInicioDia = moment(eventoDataInicio).format('DD', new Date());
						var eventoDataInicioMes = moment(eventoDataInicio).format('MM', new Date());
						var eventoDataInicioAno = moment(eventoDataInicio).format('YYYY', new Date());
						
						var eventoDataInicioDiaSemana = moment(eventoDataInicio).format('dddd', new Date());

						var eventoDataInicioHora = moment(eventoDataInicio).format('HH', new Date());
						var eventoDataInicioMinuto = moment(eventoDataInicio).format('mm', new Date());
						
						//Data final.
						var eventoDataFinalDia = moment(eventoDataFinal).format('DD', new Date());
						var eventoDataFinalMes = moment(eventoDataFinal).format('MM', new Date());
						var eventoDataFinalAno = moment(eventoDataFinal).format('YYYY', new Date());
						
						var eventoDataFinalDiaSemana = moment(eventoDataFinal).format('dddd', new Date());

						var eventoDataFinalHora = moment(eventoDataFinal).format('HH', new Date());
						var eventoDataFinalMinuto = moment(eventoDataFinal).format('mm', new Date());

						//Campos personalizados.
						var eventoIdTbCadastroUsuarioNome = calEvent.idTbCadastroUsuarioNome;
						
						
						//Preenchimento de campos.
						//elementoMensagem01('eventoCadastroNome', eventoTitulo);
						//elementoMensagem01('eventoDescricao', eventoDescricao);
						
						//elementoMensagem01('eventoData', eventoDataInicioDia + '/' + eventoDataInicioMes + '/' + eventoDataInicioAno);
						//elementoMensagem01('eventoHorario', eventoDataInicioHora + ':' + eventoDataInicioMinuto);
						
						//elementoMensagem01('eventoUsuario', eventoIdTbCadastroUsuarioNome);
						
						//Mudar a borda do evento, depois do click (funcionando).
						//$(this).css('border-color', 'red');


						//Verificação de erro - debug.
						//alert('Event: ' + calEvent.title);
						//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
						//alert('View: ' + view.name);
					},
					
					
                    eventRender: function (event, element, view) { 

                            //element.addClass('AdmTbFundoEscuro');
                            //event.className == 'AdmTbFundoEscuro';

                            //element.find('.fc-title').append("<br/>" + event.description); 


                            //Alterar a cor do fundo do dia.
                            //----------
                            // event.start is already a moment.js object
                            // we can apply .format()
                            var dateString = event.start.format("YYYY-MM-DD");
        
                            //$(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#FAA732');
                            $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').addClass('AdmTbFundoMedio');
                            //----------
                    }

                });

            });
        </script>
        
        <div align="center" style="position: relative; display: block;">
            <a id="linkTarefas" class="AdmLinks01">
                Agendar Tarefa
            </a>
            
            <!--Navegação externa.-->
            <!--ref: https://fullcalendar.io/docs/today.-->
            <a onclick="$('#calendario1').fullCalendar('today');" style="text-decoration: none; cursor: pointer;">
                Hoje
            </a>
            <a onclick="$('#calendario1').fullCalendar('prev');" style="text-decoration: none; cursor: pointer;">
                Anterior
            </a>
            <a onclick="$('#calendario1').fullCalendar('next');" style="text-decoration: none; cursor: pointer;">
                Próximo
            </a>
        </div>
        
        <!--display: table; - calendário não funciona com header: false-->    
        <div class="AdmTexto01" style="position: relative; display: block; background-color: #ffffff; padding: 10px; margin-left: auto; margin-right: auto;">
            <div id='<?php echo $ConfigCalendarioDivID; ?>' style="max-width: 900px; margin: 0 auto;"></div>
        </div>
<?php } ?>
<?php //**************************************************************************************?>