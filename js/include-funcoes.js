//Funções genéricas.
//**************************************************************************************
//Função para abrir URL em pop-up.
//Uso: javascript:popUpGenerico01('LayoutPrincipal01.html', 'Login', '300', '200', '1', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no');
function popUpGenerico01(strURL, popUpNome, popUpLargura, popUpAltura, strPosicao, configDirectories, configTitlebar, configToolbar, configLocation, configStatusbar, configMenubar, configScroll, configResizeble)
{
	//strPosicao: 1 - centralizado | 123,123 - left, top
	//configDirectories: no | yes
	//configTitlebar: no | yes
	//configToolbar: no | yes
	//configLocation: no | yes (não funciona em navegadores modernos)
	//configStatusbar: no | yes
	//configMenubar: no | yes
	//configScroll: no | yes
	//configResizeble: no | yes (não funciona em navegadores modernos)
	
	//janelaPopUp = window.open(strURL, '', 'width='+popUpLargura+', height='+popUpAltura+',toolbar='+configToolbar+',scrollbars='+configScroll+',menubar='+configMenubar+'');
	janelaPopUp = window.open(strURL, popUpNome,'directories='+configDirectories+',titlebar='+configTitlebar+',toolbar='+configToolbar+',location='+configLocation+',status='+configStatusbar+',menubar='+configMenubar+',scrollbars='+configScroll+',resizable='+configResizeble+',width='+popUpLargura+',height='+popUpAltura+'');
	//Janela centralizada.
	if(strPosicao == "1")
	{
		janelaPopUp.window.moveTo((screen.availWidth/2)-(popUpLargura/2),(screen.availHeight/2)-(popUpAltura/2));
	}
	janelaPopUp.focus();
}


//Submit de formulário fora do form.
//-------------
//function formularioSubmit(idFomulario, alvo, metodo, paginaDestino)
function formularioSubmit(idFomulario, alvo, metodo, paginaDestino)
{

	//Habilitar campos desabilitados antes de submit.
	formularioCamposDesbloquear();
	/*
	$(".AdmCampoData01").prop("disabled", false);
	$(".AdmCampoDropDownMenu01").prop("disabled", false);
	$(".AdmCampoFiltroGenericoListBox01").prop("disabled", false);//Desabilitar todos listboxs em readonly.
	$(".AdmCampoCheckBox01").prop("disabled", false); //Desabilitar checkboxes
	*/


	//metodo: POST | GET
	//Variáveis.
	var fomulario = document.forms[idFomulario];
	//var fomulario = eval('document.forms["'+formulario+'"]');
	//var fomulario = eval('document.forms['+formulario+']');
	//var fomulario = eval('document.'+formulario+'');
	//var fomulario = document.getElementById(formulario); //Não funcionou.
	
	
	//Configurações do formulário e submit.
	if(paginaDestino != "")
	{
		fomulario.action = paginaDestino;
	}
	if(metodo != "")
	{
		fomulario.method = metodo;
	}
	if(alvo != "")
	{
		fomulario.target = alvo;
	}
	fomulario.submit();
	
	//JQuery.
	//$("#myForm").submit();
	/*
	$(document).ready(function() {
	   $("#myButton").click(function() {
		   $("#myForm").submit();
	   });
	});
	*/
	
	//formularioCamposBloquear();
}
//-------------


//Alterar target de formulário.
//-------------
function formularioAlterar(idFomulario, alvo, metodo, paginaDestino)
{
	//idFomulario: iframe:nome_do_iframe,nome_do_formulario_dentro_do_iframe
	//metodo: POST | GET
	//Variáveis.
	var fomulario = "";
	//var fomulario = document.forms[idFomulario]; //Funcionando.
	//var fomulario = eval('document.forms["'+formulario+'"]');
	//var fomulario = eval('document.forms['+formulario+']');
	//var fomulario = eval('document.'+formulario+'');
	//var fomulario = document.getElementById(formulario); //Não funcionou.
	
	//iframe.
	if(idFomulario.indexOf('iframe:') >= 0)
	{
		//Definição de valores.
		var arrIdElemento = idFomulario.split(':')
		var arrIdElementoValores = arrIdElemento[1].split(",")
		var iframeDestinoID = arrIdElementoValores[0];
		var iframeDestinoElementoID = arrIdElementoValores[1];
		
		//Objeto iframe.
		var iframeDestino = document.getElementById(iframeDestinoID);
		var iframeDestinoDocumento = iframeDestino.contentDocument || iframeDestino.contentWindow.document;
		
		//Gravação de valor.
		//iframeDestinoDocumento.getElementsByName(iframeDestinoElementoID)[0].value = strMensagem; //funcionando
		//iframeDestinoDocumento.getElementById(iframeDestinoElementoID).value = strMensagem;
		fomulario = iframeDestinoDocumento.forms[iframeDestinoElementoID];

		//Debug.
		//window.alert("flag01");
		//window.alert("iframeDestinoID=" + iframeDestinoID);
		//window.alert("iframeDestinoElementoID=" + iframeDestinoElementoID);
	}else{
		fomulario = document.forms[idFomulario];
	}

	//Configurações do formulário e submit.
	if(paginaDestino != "")
	{
		fomulario.action = paginaDestino;
	}
	if(metodo != "")
	{
		fomulario.method = metodo;
	}
	if(alvo != "")
	{
		fomulario.target = alvo;
	}
}
//-------------


//Função para auxiliar na definição de bloqueio de campos - níveis de usuários.
//-------------
function formularioCamposBloquear()
{
			$(".AdmCampoTexto02").prop("readonly", true); //Transformar todos campos em readonly.
			$(".AdmCampoTexto02").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo desativado.
			
			$(".AdmCampoTextoMultilinha01").prop("readonly", true); //Transformar todos campos multilinha em readonly.
			$(".AdmCampoTextoMultilinha01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo multilinha desativado.
			
			$(".AdmCampoData01").prop("readonly", true); //Transformar todos campos de data em readonly.
			$(".AdmCampoData01").prop("disabled", true);
			$(".AdmCampoData01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo de data desativado.
			//$(".AdmCampoData01").prop("disabled", true);

			//$(".AdmCampoArquivoUpload01").prop("readonly", true); //Transformar todos campos de upload em readonly.
			$(".AdmCampoArquivoUpload01").prop("disabled", true);
			$(".AdmCampoArquivoUpload01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do campo de upload desativado.
			
			//$(".AdmCampoDropDownMenu01").prop("readonly", true); //Transformar todos dropdowns em readonly.
			$(".AdmCampoDropDownMenu01").prop("disabled", true);//Desabilitar todos dropdowns em readonly.
			//$(".AdmCampoDropDownMenu01").attr("disabled", "disabled");
			//$(".AdmCampoDropDownMenu01").each(function() {
				//$(this).data('lastSelected', $(this).find('option:selected'));
			//});
			$(".AdmCampoDropDownMenu01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do dropdowns desativado.
			
			$(".AdmCampoFiltroGenericoListBox01").prop("disabled", true);//Desabilitar todos listboxs em readonly.
			$(".AdmCampoFiltroGenericoListBox01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do listboxs desativado.
			
			//$(".AdmLinks01").hide();//Ocultar mecanismos de manutenção.
			$('img[src="img/btoManutencao.png"]').hide();
			/*
			$("img").each(function() {
                if (this.src == "img/btoManutencao.png") {
					//if it has source
					$("img").hide();
				}
            });*/
			
			$(".AdmLinksExcluir01").hide();//Ocultar mecanismos de manutenção.
			
			$(".AdmCampoCheckBox01").prop("disabled", true); //Desabilitar checkboxes
			$(".AdmCampoCheckBox01").addClass("AdmCampoDesabilitado01"); //Alterar a cor do checkbox desativado.
}

function formularioCamposDesbloquear()
{
			$(".AdmCampoTexto02").prop("readonly", false); //Transformar todos campos em readonly.
			$(".AdmCampoTexto02").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do campo desativado.
			
			$(".AdmCampoTextoMultilinha01").prop("readonly", false); //Transformar todos campos multilinha em readonly.
			$(".AdmCampoTextoMultilinha01").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do campo multilinha desativado.
			
			$(".AdmCampoData01").prop("readonly", false); //Transformar todos campos de data em readonly.
			$(".AdmCampoData01").prop("disabled", false);
			$(".AdmCampoData01").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do campo de data desativado.
			//$(".AdmCampoData01").prop("disabled", true);

			//$(".AdmCampoArquivoUpload01").prop("readonly", true); //Transformar todos campos de upload em readonly.
			$(".AdmCampoArquivoUpload01").prop("disabled", false);
			$(".AdmCampoArquivoUpload01").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do campo de upload desativado.
			
			//$(".AdmCampoDropDownMenu01").prop("readonly", true); //Transformar todos dropdowns em readonly.
			$(".AdmCampoDropDownMenu01").prop("disabled", false);//Desabilitar todos dropdowns em readonly.
			//$(".AdmCampoDropDownMenu01").attr("disabled", "disabled");
			//$(".AdmCampoDropDownMenu01").each(function() {
				//$(this).data('lastSelected', $(this).find('option:selected'));
			//});
			$(".AdmCampoDropDownMenu01").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do dropdowns desativado.
			
			$(".AdmCampoFiltroGenericoListBox01").prop("disabled", false);//Desabilitar todos listboxs em readonly.
			$(".AdmCampoFiltroGenericoListBox01").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do listboxs desativado.
			
			//$(".AdmLinks01").hide();//Ocultar mecanismos de manutenção.
			$('img[src="img/btoManutencao.png"]').show();
			/*
			$("img").each(function() {
                if (this.src == "img/btoManutencao.png") {
					//if it has source
					$("img").hide();
				}
            });*/
			
			$(".AdmLinksExcluir01").show();//Ocultar mecanismos de manutenção.
			
			$(".AdmCampoCheckBox01").prop("disabled", false); //Desabilitar checkboxes
			$(".AdmCampoCheckBox01").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do checkbox desativado.
}
//-------------


//Função para auxiliar no desbloqueio de campo antes de form submit - níveis de usuários.
//-------------
function formularioCamposDesbloquear()
{
	$(".AdmCampoData01").prop("disabled", false);
	$(".AdmCampoDropDownMenu01").prop("disabled", false);
	$(".AdmCampoFiltroGenericoListBox01").prop("disabled", false);//Desabilitar todos listboxs em readonly.
	$(".AdmCampoCheckBox01").prop("disabled", false); //Desabilitar checkboxes
}
//-------------


//Função para auxiliar no desbloqueio de campo antes de form submit - níveis de usuários.
//-------------
function formularioCamposDesbloquearHigienizacao()
{
	$("#idsHistoricoFiltroGenerico04").prop("readonly", false); //Transformar todos campos de data em readonly.
	$("#idsHistoricoFiltroGenerico04").prop("disabled", false);
	$("#idsHistoricoFiltroGenerico04").removeClass("AdmCampoDesabilitado01"); //Alterar a cor do campo de data desativado.
}
//-------------


//Redirecionamento de página por seleção de item.
//-------------
function paginaRedirecionar(paginaDestino, idControleValor, parametrosExtras)
{
	//Variáveis.
	var urlDestino = paginaDestino;
	var valorControle = "";
	
	if(idControleValor != "")
	{
		//Javascript - funcionando.
		/*
		var radios = document.getElementsByName(idControleValor);
		
		for (var i = 0, length = radios.length; i < length; i++)
		{
			if (radios[i].checked)
			{
				// do whatever you want with the checked radio
				//alert(radios[i].value);
				valorControle = radios[i].value
				
				// only one radio can be logically checked, don't check the rest
				break;
			}
		}	
		*/
		
		
		//JQuery	
		valorControle = $('input[name='+idControleValor+']:checked').val();				
		
		
		urlDestino = urlDestino + valorControle;
	}
	
	if(parametrosExtras != "")
	{
		urlDestino = urlDestino + parametrosExtras;
	}
	
	window.location.href = urlDestino;	
}
//-------------


//Função para carregar URL em iframe.
//-------------
function iframeLoad(iframeID, iframeURL, idControle, tipoControle, strParametrosExtras)
{
	//iframeID: id_do_iframe | window.parent;id_do_iframe
	//strParametrosAdicionais: array ex: tipo_pesquisa1,id_pesquisa_fonte1,elemento_pesquisa1,tipo_elemento_pesquisa1,nome_variavel_url_destino1;tipo_pesquisa2,id_pesquisa_fonte2,elemento2,tipo_elemento2,nome_variavel_url_destino2
								   //ex: 'document,document,idCePedidos,textfield,idCePedidos;document,document,id_tb_cadastro_cliente,hidden,idTbCadastroCliente'
		//tipo_pesquisa: iframe | document
		//elemento_pesquisa: nome ou id do elemento
		//tipo_elemento_pesquisa: radiobuttonNameChecked | hidden
	//tipoControle: radiobutton | hidden

	
	//Variáveis.
	var valorVariavel = "";
	var strURL = "";
	var URLQuery = "";

	
	//Construção da URL.
	strURL = iframeURL;
	
	
	//Obs: Tentar substituir essa parte com esta função: elementoLerDados01('', '');
	//radiobutton
	if(tipoControle == "radiobutton")
	{
		valorVariavel = $("input[name="+idControle+"]:checked").val();
		if(valorVariavel != null)
		{
			strURL = strURL + valorVariavel;
		}
	}
	
	//hidden
	if(tipoControle == "hidden")
	{
		valorVariavel = document.getElementById(idControle).value;
		if(valorVariavel != null)
		{
			strURL = strURL + valorVariavel;
		}
	}
	
	//textfield
	if(tipoControle == "textfield")
	{
		valorVariavel = document.getElementById(idControle).value;
		if(valorVariavel != null)
		{
			strURL = strURL + valorVariavel;
		}
	}
	
	
	//strParametrosExtras
	//-------------
	if(strParametrosExtras != "")
	{
		var arrStrParametros = strParametrosExtras.split(";");
		
		//Loop pelo primeiro array.
		for (var countArrayParametros = 0; countArrayParametros < arrStrParametros.length; countArrayParametros++)
		{
			//alert(myStringArray[i]);
			//Do something
			
			//Variáveis dos valores do array.
			var arrStrParametrosValores = arrStrParametros[countArrayParametros].split(",");
			//Loop pelos valores.
			//for (var countArrayParametrosValores = 0; countArrayParametrosValores < arrStrParametrosValores.length; countArrayParametrosValores++)
			//{
			//}
				var tipoPesquisa = arrStrParametrosValores[0];
				var idPesquisaFonte = arrStrParametrosValores[1];
				var elementoPesquisa = arrStrParametrosValores[2];
				var elementoPesquisaValor = "";
				var tipoElementoPesquisa = arrStrParametrosValores[3];
				var nomeVariavelDestino = arrStrParametrosValores[4];
				
				
				//iFrame
				if(tipoPesquisa == "iframe")
				{
					//if(tipoElementoPesquisa == "")
					//{
						elementoPesquisaValor = iframeLerDados01(idPesquisaFonte, elementoPesquisa, tipoElementoPesquisa);
						URLQuery = URLQuery + "&" + nomeVariavelDestino + "=" + elementoPesquisaValor;
					//}
					
					
					//Debug.
					//URLQuery = URLQuery + "&" + nomeVariavelDestino + "=" + "valor_resgatado"; //teste	
				}
				
				
				//document
				if(tipoPesquisa == "document")
				{
					//if(tipoElementoPesquisa == "")
					//{
						elementoPesquisaValor = elementoLerDados01(elementoPesquisa, tipoElementoPesquisa);
						URLQuery = URLQuery + "&" + nomeVariavelDestino + "=" + elementoPesquisaValor;
					//}
					
					
					//Debug.
					//URLQuery = URLQuery + "&" + nomeVariavelDestino + "=" + "valor_resgatado"; //teste	
				}
				
				
				//Debug.
				//window.alert("flag02");
			
			
			//Debug.
			//window.alert("flag01");
		}	
		
		strURL = strURL + "?variavelBlank=" + URLQuery;					
	}
	//-------------

	
	//Carregamento do iFrame.
	//Acessar parent.
	if(iframeID.indexOf('window.parent') >= 0)
	{
		var arrIframeID = iframeID.split(";");
		window.parent.$("#" + arrIframeID[1]).attr("src", strURL);
	}else{
	//$("#button").click(function () { 
		$("#" + iframeID).attr("src", strURL);
	//});
	}
}
//-------------


//Função para recarregar um determinado frame.
//-------------
//ref: https://stackoverflow.com/questions/86428/what-s-the-best-way-to-reload-refresh-an-iframe
function iframeRecarregar(iframeID, strParametrosExtras)
{
	//não testado
	//var iframeDestino = document.getElementById(iframeID);
	//var iframeDestinoDocumento = iframeDestino.contentDocument || iframeDestino.contentWindow.document;
	//iframeDestinoDocumento.location.reload();

	if(strParametrosExtras != "")
	{
		var URLAtual = document.getElementById(iframeID).contentWindow.location;
		var URLModificada = URLAtual + strParametrosExtras;
		$("#" + iframeID).attr("src", URLModificada);
	}else{
		document.getElementById(iframeID).contentWindow.location.reload();
	}

	//document.getElementById(iframeID).contentWindow.location.reload();
	//document.getElementById(iframeID).location.reload();
	
	
	//Recarrega, inclusie cross-domain (não testado)
	//document.getElementById('iframeid').src = document.getElementById('iframeid').src
}
//-------------


//Função para ler dados de uma variável dentro de um iFrame.
//-------------
//Obs: Prestar atenção com Same-origin security policy. Os endereço de origem e do iFrame devem estar no mesmo local.
//Ref: https://stackoverflow.com/questions/25098021/securityerror-blocked-a-frame-with-origin-from-accessing-a-cross-origin-frame
//Google Chrome: Desabilitar same origin policy: https://stackoverflow.com/questions/3102819/disable-same-origin-policy-in-chrome
//Firefox: Desabilitar same origin policy: https://stackoverflow.com/questions/17088609/disable-firefox-same-origin-policy
function iframeLerDados01(_iframeFonte, _strElemento, elementoTipo)
{
	//strParametros: radiobuttonNameChecked | hidden
	
	//Variáveis.
	var iframeFonte;
	var strElemento;
	var strRetorno = "";


	//Definição de valores.
	iframeFonte = document.getElementById(_iframeFonte);
	
	
	//Radio Button Name - Checked
	if(elementoTipo == "radiobuttonNameChecked")
	{
		strElemento = $(iframeFonte).contents().find('input[name=' + _strElemento + ']:checked')
		strRetorno = strElemento.val();
	}
	
	if(elementoTipo == "hidden")
	{
		//strElemento = $(_iframeFonte).contents().$('#' + _strElemento); //erro.
		strElemento = $(iframeFonte).contents().find('#' + _strElemento);
		strRetorno = strElemento.val();
	}

	
	return strRetorno;	
}
//-------------


//Função para ler dados de uma variável dentro de um elemento.
//-------------
function elementoLerDados01(idControle, tipoControle)
{
	//tipoControle: radiobutton | hidden | textfield
	
	//Variáveis.
	var strRetorno = "";
	var valorVariavel = "";
	
	
	//radiobutton
	if(tipoControle == "radiobutton")
	{
		valorVariavel = $("input[name="+idControle+"]:checked").val();
		if(valorVariavel != null)
		{
			strRetorno = valorVariavel;
		}
	}
	
	
	//hidden
	if(tipoControle == "hidden")
	{
		valorVariavel = document.getElementById(idControle).value;
		if(valorVariavel != null)
		{
			strRetorno = valorVariavel;
		}
	}
	
	
	//textfield
	if(tipoControle == "textfield")
	{
		valorVariavel = document.getElementById(idControle).value;
		if(valorVariavel != null)
		{
			strRetorno = valorVariavel;
		}
	}
	
	return strRetorno;	
}
//-------------


//Função para mostrar/esconder elemento.
//-------------
function elementoMostrarOcultar(idElemento) {
    var e = document.getElementById(idElemento);
	
	if(e.tagName == 'TR')
	{
		if (e.style.display == 'table-row') {
			e.style.display = 'none';
		}
		else {
			e.style.display = 'table-row';
		}
	}else if(e.tagName == 'TBODY'){
		if (e.style.display == 'table-row-group') {
			e.style.display = 'none';
		}
		else {
			e.style.display = 'table-row-group';
		}
	}else{
		if (e.style.display == 'block') {
			e.style.display = 'none';
		}
		else {
			e.style.display = 'block';
		}
	}
}
function elementoMostrar(idElemento) {
	var e = document.getElementById(idElemento);
	
	if(e.tagName == 'TR')
	{
		e.style.display = 'table-row';
	}else if(e.tagName == 'TBODY'){
		e.style.display = 'table-row-group';
	}else{
		e.style.display = 'block';
	}
}
function elementoOcultar(idElemento) {
	document.getElementById(idElemento).style.display = 'none';
}
//-------------


//Função para copiar mensagem para algum elemento HTML.
//-------------
function elementoMensagem01(idElemento, strMensagem)
{
	//idElemento: id do elemento do documento | iframe:nome_do_iframe,nome_do_elemento_dentro_do_iframe
	

	//iframe.
	if(idElemento.indexOf('iframe:') >= 0)
	{
		//Definição de valores.
		var arrIdElemento = idElemento.split(':')
		var arrIdElementoValores = arrIdElemento[1].split(",")
		var iframeDestinoID = arrIdElementoValores[0];
		var iframeDestinoElementoID = arrIdElementoValores[1];
		
		//Objeto iframe.
		var iframeDestino = document.getElementById(iframeDestinoID);
		var iframeDestinoDocumento = iframeDestino.contentDocument || iframeDestino.contentWindow.document;
		
		//Gravação de valor.
		//iframeDestinoDocumento.getElementsByName(iframeDestinoElementoID)[0].value = strMensagem; //funcionando
		iframeDestinoDocumento.getElementById(iframeDestinoElementoID).value = strMensagem;


		//Debug.
		//window.alert("flag01");
		//window.alert("iframeDestinoID=" + iframeDestinoID);
		//window.alert("iframeDestinoElementoID=" + iframeDestinoElementoID);
	}else{
		//Variáveis.
		var e = document.getElementById(idElemento);
		
		//input type - hidden
		if(e.getAttribute('type') == 'hidden')
		{
			e.value = strMensagem;
		}
		
		//input type - hidden
		if(e.getAttribute('type') == 'text')
		{
			e.value = strMensagem;
		}
		
		//input type - checkbox
		if(e.getAttribute('type') == 'checkbox')
		{
			e.value = strMensagem;
		}
	}
}
//-------------


//Função para ir automaticamente para o final do scroll do div desejado.
function divScrollFinal(targetDiv) {
    var objDiv = document.getElementById(targetDiv);
    objDiv.scrollTop = objDiv.scrollHeight;
}


//Função para mostrar/esconder div.
//-------------
/*Acionamento.
<a onclick="divShowHide('nomeDaDiv')" style="cursor: pointer;">
    Mostrar/Esconder
</a>
<div id="nomeDaDiv" style="display:none;">
    Info.
</div>
*/
function divShowHide(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block') {
        e.style.display = 'none';
    }
    else {
        e.style.display = 'block';
    }
}
function divShow(idDiv) {
	if(document.getElementById(idDiv))
	{
		document.getElementById(idDiv).style.display = 'block';
    }
}
function divHide(idDiv) {
	if(document.getElementById(idDiv))
	{
		document.getElementById(idDiv).style.display = 'none';
	}
}
//-------------


//Função alternativa para mostrar/esconder div.
//-------------
function divMostrar(idDiv) {
	document.getElementById(idDiv).style.visibility = "visible";
}
function divOcultar(idDiv) {
	document.getElementById(idDiv).style.visibility = "hidden";
}
//-------------


//Função para acionar um botão.
//-------------
function btoClick_onEvent(idBto)
{
	document.getElementById(idBto).click();
}
//-------------

//Função para selecionar um valor de um dropdown.
//-------------
function dropDownSelect_onClick(idDropDown, strValor)
{
	document.getElementById(idDropDown).value = strValor;
}	
//-------------

//Função para alterar uma tag de imagem já existente.
//-------------
function imagemSrcAlterar(idImg, novoSrc)
{
	//document.getElementById(idImg).scr = novoSrc;
	$("#" + idImg).attr('src', novoSrc);
}	
//-------------


//Função para mostrar mensagem em div (JQuery).
//-------------
function divMensagem01(idDiv, strMensagem)
{
	var divTarget = $('#' + idDiv);
	
	//divTarget.text(strMensagem);
	divTarget.empty();
	divTarget.append(strMensagem);
	
}
//-------------


//Função para desabilitar uma caixa de texto.
//-------------
function campoDesabilitar(idCampo, strFuncao)
{
	//strFuncao: habilitar | desabilitar
	
	if(strFuncao == "desabilitar")
	{
		document.getElementById(idCampo).disabled = true;
		document.getElementById(idCampo).readOnly = true;
	}
	if(strFuncao == "habilitar")
	{
		document.getElementById(idCampo).disabled = false;
		document.getElementById(idCampo).readOnly = false;
	}
}
//-------------


//Função para mover um elemento HTML.
//-------------
//Acionamento: HTMLMove01('divAmbiente1_item1','0px','5px');
function HTMLMove01(idHTML, posLeft, posTop) {
	document.getElementById(idHTML).style.left = posLeft;
	document.getElementById(idHTML).style.top = posTop;
}
//-------------


//Função para alterar parâmetros de estilo de elementos html.
//-------------
//HTMLEstiloGenerico01('','','');
function HTMLEstiloGenerico01(idHTML, nomeEstilo, valorParametro) 
{
	//display
	if(nomeEstilo == "display")
	{
		document.getElementById(idHTML).style.display = valorParametro;
	}
	
	//height
	if(nomeEstilo == "height")
	{
		document.getElementById(idHTML).style.height = valorParametro;
	}
	
	//min-height
	if(nomeEstilo == "min-height")
	{
		//if(valorParametro == "scrollHeight")
		//{
			//document.getElementById(idHTML).style.minHeight = $("#" + idHTML)[0].scrollHeight;
		//}else{
			document.getElementById(idHTML).style.minHeight = valorParametro;
		//}
	}

	//margin-bottom
	if(nomeEstilo == "margin-bottom")
	{
		document.getElementById(idHTML).style.marginBottom = valorParametro;
	}
}
//-------------


//Função para alterar parâmetros de estilo de elementos html.
//-------------
//ex: parent.HTMLModificar01('iframe:iframeOdontogramaProdutosServicos,informacao_complementar2v', 'propriedade', 'disabled', false);
//ex (se modificar a propriedade onclick de algum elemento): HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\')');
function HTMLModificar01(idElemento, tipoModificacao, strParametro, strParametroValor) 
{
	//idHTML: id do elemento do documento | iframe:nome_do_iframe,nome_do_elemento_dentro_do_iframe
	//tipoModificacao: style | propriedade
	//strParametro: disabled
	
	//Variáveis.
	var elementoHTML = "";
	
	
	//Definição de valores.
	if(idElemento.indexOf('iframe:') >= 0)//verificação se o elememento está dentro de iframe.
	{
		//iframe
		var arrIdElemento = idElemento.split(':')
		var arrIdElementoValores = arrIdElemento[1].split(",")
		var iframeDestinoID = arrIdElementoValores[0];
		var iframeDestinoElementoID = arrIdElementoValores[1];
		
		//Objeto iframe.
		var iframeDestino = document.getElementById(iframeDestinoID);
		var iframeDestinoDocumento = iframeDestino.contentDocument || iframeDestino.contentWindow.document;
		
		//Gravação de valor.
		//iframeDestinoDocumento.getElementsByName(iframeDestinoElementoID)[0].value = strMensagem; //funcionando
		//iframeDestinoDocumento.getElementById(iframeDestinoElementoID).value = strMensagem; //funcionando
		elementoHTML = iframeDestinoDocumento.getElementById(iframeDestinoElementoID);
		
	}else{
		//sem iframe	
		elementoHTML = document.getElementById(idElemento);
	}
	
	
	//propriedade
	if(tipoModificacao == "propriedade")
	{
		//disabled
		if(strParametro == "disabled")
		{
			elementoHTML.disabled = strParametroValor;
		}	
		
		//onclick	
		if(strParametro == "onclick")
		{
			//elementoHTML.onclick = strParametroValor;
			elementoHTML.setAttribute( "onClick", "javascript: " + strParametroValor );
		}
	}
}
//-------------


//Ajax - função para preencher elementos HTML.
//-------------
function ajaxOptionsFill01(apiURL, apiURLQuery, idElemento, tipoControle, optionSelected, _ajaxType, _ajaxDataType, divBarraProgresso, terminal)
{
	//tipoControle: 1 - checkbox | 2 - listbox | 3 - dropdown menu
	//ajaxType: GET | POST
	//terminal: 0 - sistema (backend) | 1 - site (frontend)
	
	
	//Variáveis.
	var divProgressBar = divBarraProgresso;
	var ajaxType = _ajaxType;
	if(_ajaxType == "")
	{
		ajaxType = "GET";
	}
	var ajaxDataType = _ajaxDataType;
	if(_ajaxDataType == "")
	{
		ajaxDataType = "html";
	}


	//Exibição da poleta.
	if(divProgressBar != "")
	{
		divShow(divProgressBar);
	}
	
	
	$.ajax({
		/*funcionando.
		xhr: function () {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					console.log(percentComplete);
					$('.progress').css({
						width: percentComplete * 100 + '%'
					});
					if (percentComplete === 1) {
						$('.progress').addClass('hide');
					}
				}
			}, false);
			xhr.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					console.log(percentComplete);
					$('.progress').css({
						width: percentComplete * 100 + '%'
					});
				}
			}, false);
			return xhr;
		},
		
		async: false,
		*/
		url: apiURL,
		dataType: ajaxDataType,
		type: ajaxType,
		data: apiURLQuery,
		success: function(retornoDadosURL, success) 
		{
			//Ocultação da poleta.
			if(divProgressBar != "")
			{
					divHide(divProgressBar);
			}
			
			
			//Limpeza de opções dos elementos.
			//$('#' + divCidades).html('<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>'); 
			//$('#' + divBairros).html('<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>'); 
			//$('#' + divLogradouros).html('<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>'); 
			
			//$('#idsHistoricoFiltroGenerico14').html('<option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>');
			if(optionSelected != "")
			{
				if(tipoControle == 3)
				{
					$('#' + idElemento).html('<option value="0" selected="true">' + optionSelected + '</option>');
				}else{
					$('#' + idElemento).html('');
				}
			}
			
			
			//Ocultação elementos adicionais.
			//elementoOcultar(divBairros);
			//elementoOcultar(divLogradouros);
			
			//Exibição do elemento com os resultados.
			//elementoMostrar(divCidades);
			
			//Preenchimento de resultados.
			//$('#idsHistoricoFiltroGenerico14[]').html(retornoDadosURL); 
			//$('#idsHistoricoFiltroGenerico14').html(retornoDadosURL);
			//$('#idsHistoricoFiltroGenerico14').append(retornoDadosURL);
			$('#' + idElemento).append(retornoDadosURL);
			//$("#idsHistoricoFiltroGenerico14\\[]\\").append(retornoDadosURL);
			//$('[id="idsHistoricoFiltroGenerico14[]"]').append(retornoDadosURL); //funcionando
			
			//$('#testeDropdown').append(retornoDadosURL);
			 
			//$('#' + divCidades).append(retornoDadosURL); 
			//$('#id_db_cep_tblUF_veiculos').append('<option value="">Select state first</option>'); //teste 
			
			
			//Debug.
			//alert('retornoDadosURL=' + retornoDadosURL);
			
			/*
			$('.AdmCampoFiltroGenericoListBox01').load('change', function() {
				$(this).find('option').not(':selected').remove();
			});
			*/
			
			$('.AdmCampoFiltroGenericoListBox01').find('option').not(':selected').remove();
		},
		error: function(retornoDadosURL, success) 
		{
			//$(".zip-error").show(); // Ruh row
			//elementoMensagem01('testeAlvo01', "erro");
			//divShow('lblCEPAlerta');
			
			//Debug.
			//alert('erro=' + retornoDadosURL);
		}	
	});
}
//-------------


//Mudar parâmetros CSS com animação.
//-------------
//HTMLAnimacaoGenerico01('idHTML', 'height', 'valorParametro', 'estiloAnimacao', null);
function HTMLAnimacaoGenerico01(idHTML, nomeEstilo, valorParametro, estiloAnimacao, velocidadeAnimacao)
{
	//Variáveis.
	var intVelocidadeAnimacao = 500;
	if(velocidadeAnimacao != null)
	{
		intVelocidadeAnimacao = velocidadeAnimacao
	}
	
	
	//height
	if(nomeEstilo == "height")
	{
		//Retirar min-height, se tiver definido, para conseguir realizar a animação. 
		$("#" + idHTML).css('min-height', '');
		
		//animate - Pesquisar easing.
		if(valorParametro == '')
		{
			$('#' + idHTML).animate(
				{
					//'height': 'null',
					'height': $("#" + idHTML)[0].scrollHeight
				},
				{
					complete: function(){ 
						//$("#" + idHTML).css('height', null); 
						//$("#" + idHTML).css('min-height', ''); 
						//alert('debug');
					},
					duration: intVelocidadeAnimacao
				}
			);
		}else{
			$('#' + idHTML).animate(
				{
					//'height': 'null',
					'height': valorParametro
				},
				{
					complete: function(){ 
						//$("#" + idHTML).css('height', null); 
						//$("#" + idHTML).css('min-height', ''); 
						//alert('debug');
					},
					duration: intVelocidadeAnimacao
				}
			);
		}
	}	
	
	
	//min-height
	if(nomeEstilo == "min-height")
	{
		//animate - Pesquisar easing.
		if(valorParametro == '')
		{
			$('#' + idHTML).animate(
				{
					//'height': 'null',
					'min-height': $("#" + idHTML)[0].scrollHeight
				},
				{
					complete: function(){ 
						//$("#" + idHTML).css('height', null); 
						$("#" + idHTML).css('height', ''); 
						//alert('debug');
					},
					duration: intVelocidadeAnimacao
				}
			);
		}else{
			$('#' + idHTML).animate(
				{
					//'height': 'null',
					'min-height': valorParametro
				},
				{
					complete: function(){ 
						//$("#" + idHTML).css('height', null); 
						$("#" + idHTML).css('height', ''); 
						//alert('debug');
					},
					duration: intVelocidadeAnimacao
				}
			);
		}
	}	
	
	
	//width
	if(nomeEstilo == "width")
	{
		//Retirar min-width, se tiver definido, para conseguir realizar a animação. 
		$("#" + idHTML).css('min-width', '');
		//$("#" + idHTML).css('width', '');
		
		//animate - Pesquisar easing.
		if(valorParametro == '')
		{
			$('#' + idHTML).animate(
				{
					//'height': 'null',
					'width': $("#" + idHTML)[0].scrollWidth
				},
				{
					complete: function(){ 
						//$("#" + idHTML).css('height', null); 
						//$("#" + idHTML).css('min-height', ''); 
						//alert('debug');
					},
					duration: intVelocidadeAnimacao
				}
			);
		}else{
			$('#' + idHTML).animate(
				{
					//'height': 'null',
					'width': valorParametro
				},
				{
					complete: function(){ 
						//$("#" + idHTML).css('height', null); 
						//$("#" + idHTML).css('min-height', ''); 
						//alert('debug');
					},
					duration: intVelocidadeAnimacao
				}
			);
		}
	}	

}
//-------------


//Função para acionar um checkbox.
//Acionamento: checkboxCheck01('informacao_complementar1m',true);
function checkboxCheck01(idCheckbox, strCheck)
{
	var checkboxSelect = document.getElementById(idCheckbox);
	//var checkboxSelect = document.getElementById('teste');
	//window.alert("acionado");
	if(strCheck == true)
	{
		//document.getElementById('informacao_complementar1m').checked = true;//teste
		checkboxSelect.checked = true;
	}else{
		checkboxSelect.checked = false;
	}
}


//Função para copiar dados de um campo para outro.
function dadosCampoCopiar(idCampoOrigem, idCampoDestino)
{
	//idCampoOrigem: id do elemento do documento | iframe:nome_do_iframe,nome_do_elemento_dentro_do_iframe
	//idCampoDestino: id do elemento do documento | iframe:nome_do_iframe,nome_do_elemento_dentro_do_iframe

	//Variáveis.
	var strDados = "";
	var elementoHTML = "";

	
	//Resgate de informações.
	//iframe.
	if(idCampoOrigem.indexOf('iframe:') >= 0)
	{
		//Definição de valores.
		var arrIdElementoOrigem = idCampoOrigem.split(':')
		var arrIdElementoOrigemValores = arrIdElementoOrigem[1].split(",")
		var iframeOrigemID = arrIdElementoOrigemValores[0];
		var iframeOrigemElementoID = arrIdElementoOrigemValores[1];
		
		//Objeto iframe.
		var iframeOrigem = document.getElementById(iframeOrigemID);
		var iframeOrigemDocumento = iframeOrigem.contentDocument || iframeOrigem.contentWindow.document;
		
		//Leitura de valor.
		//iframeDestinoDocumento.getElementsByName(iframeDestinoElementoID)[0].value = strMensagem; //funcionando
		//iframeDestinoDocumento.getElementById(iframeDestinoElementoID).value = strMensagem;
		strDados = iframeOrigemDocumento.getElementById(iframeOrigemElementoID).value


		//Debug.
		//window.alert("flag01");
		//window.alert("iframeDestinoID=" + iframeDestinoID);
		//window.alert("iframeDestinoElementoID=" + iframeDestinoElementoID);
	}else{
		//strDados = document.getElementById(idCampoOrigem).value; //Funcionando.
		
		elementoHTML = document.getElementById(idCampoOrigem);
		
		//input type - select
		//if(elementoHTML.getAttribute('type') == 'select')
		if(elementoHTML.tagName === 'SELECT')
		{
			strDados = elementoHTML.options[elementoHTML.selectedIndex].text;
		}else{
			strDados = document.getElementById(idCampoOrigem).value;
		}
	}
	//Resgate de informações.
	//strDados = document.getElementById(idCampoOrigem).value;
	
	
	//Preenchimento do campo de destino.
	//iframe.
	if(idCampoDestino.indexOf('iframe:') >= 0)
	{
		//Definição de valores.
		var arrIdElementoDestino = idCampoDestino.split(':')
		var arrIdElementoDestinoValores = arrIdElementoDestino[1].split(",")
		var iframeDestinoID = arrIdElementoDestinoValores[0];
		var iframeDestinoElementoID = arrIdElementoDestinoValores[1];
		
		//Objeto iframe.
		var iframeDestino = document.getElementById(iframeDestinoID);
		var iframeDestinoDocumento = iframeDestino.contentDocument || iframeDestino.contentWindow.document;
		
		//Leitura de valor.
		//iframeDestinoDocumento.getElementsByName(iframeDestinoElementoID)[0].value = strMensagem; //funcionando
		//iframeDestinoDocumento.getElementById(iframeDestinoElementoID).value = strMensagem;
		//strDados = iframeDestinoDocumento.getElementById(iframeDestinoElementoID).value
		iframeDestinoDocumento.getElementById(iframeDestinoElementoID).value = strDados


		//Debug.
		//window.alert("flag01");
		//window.alert("iframeDestinoID=" + iframeDestinoID);
		//window.alert("iframeDestinoElementoID=" + iframeDestinoElementoID);
	}else{
		//Preenchimento do campo de destino.
		document.getElementById(idCampoDestino).value = strDados;
	}
	//Preenchimento do campo de destino.
	//document.getElementById(idCampoDestino).value = strDados;
}
//**************************************************************************************


//Máscaras de entrada de dados.
//**************************************************************************************
//Máscara genérica.
function mascaraGenerica(mascara, documento, formulario, campo){

	//definição do tamanho máximo do campo.
	var tamanhoCampo = mascara.length;
	var campo = eval('document.'+formulario+'.'+campo);
	campo.maxLength = tamanhoCampo;
	
	var i = documento.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(i);
	
	if (texto.substring(0,1) != saida){
			documento.value += texto.substring(0,1);
	}
  
}
//**************************************************************************************


//Função para gravar valores monetários formatados.
//**************************************************************************************
function mascaraValorGravar(strValor)
{
	//Variáveis.
	var strRetorno = strValor;
	
	if(strValor != null)
	{
		strRetorno = strRetorno.replace(',','');
		strRetorno = strRetorno.replace('.','');
	}else{
		strRetorno = 0;
	}
	
	return strRetorno;
  
}
//**************************************************************************************


//Retirar caractéres especiais.
//**************************************************************************************
function removerCaracteresEspeciais(conteudo)
{
	//Variáveis.
	var strRetorno = conteudo;
	
	if(conteudo != null && conteudo != "")
	{
		strRetorno = strRetorno.replace(/\s/g, ''); //Retirar espaços.
		strRetorno = strRetorno.replace(/-+/, ''); //Remover hífens múltiplos.
		strRetorno = strRetorno.replace(/[^\w\s]/gi, ''); //Remover caractéres especiais.	
	}else{
		strRetorno = "";
	}
	
	return strRetorno;
  
}
//**************************************************************************************


//Função para formaração de leitura de valores monetários.
//**************************************************************************************
//Variáveis de auxílio para formação de valores.
//ref: https://stackoverflow.com/questions/149055/how-can-i-format-numbers-as-dollars-currency-string-in-javascript
var formatoValorBR = new Intl.NumberFormat('pt-BR', {
	//style: 'currency',
	currency: 'BRL',
	minimumFractionDigits: 2,
});

var formatoValorUS = new Intl.NumberFormat('en-US', {
	//style: 'currency',
	currency: 'USD',
	minimumFractionDigits: 2,
});


function mascaraValorLer(strValor, configMoeda)
{
	if(configMoeda == "")
	{
		configMoeda = "R$";	
	}
	
	//Variáveis.
	var strRetorno = "";
	strValor = String(strValor)
	
	
	if(strValor != "")
	{
		if(strValor.length < 3)
		{
			strValor = "00" + strValor;	
		}
		
		var strDecimal = strValor.substring((strValor.length - 2), strValor.length);
		strValor = strValor.substring(0, (strValor.length - 2)) + "." +  strDecimal;
		
		//R$ (Real)
		if(configMoeda == "R$")
		{
			//strRetorno = strValor.formatMoney(2, ',', '.');
			strRetorno = formatoValorBR.format(strValor);
		}
		
		//$ (dólar)
		if(configMoeda == "$")
		{
			//strRetorno = strValor.formatMoney(2, '.', ',');
			strRetorno = formatoValorUS.format(strValor);
		}
	}
	
	return strRetorno;
}

/*Não funcionou.
ref: https://stackoverflow.com/questions/149055/how-can-i-format-numbers-as-dollars-currency-string-in-javascript
Number.prototype.formatMoney = function(c, d, t)
{
    var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
*/
//**************************************************************************************


//Bloqueio do botão direito.
//**************************************************************************************
/*
//Variáveis.
//var message="Copyright © 2017 - Club Golden";//
var mensagemBloqueioPopup="Copyright 2017 - Club Golden";//
//var message="Copyright &copy; 2017 - Todos direitos reservados.";//

function clickIE4()
{
	if (event.button==2)
	{
		alert(mensagemBloqueioPopup);
		return false;
	}
}

function clickNS4(e)
{
	if (document.layers||document.getElementById&&!document.all)
		{
		if (e.which==2||e.which==3)
		{
			alert(mensagemBloqueioPopup);
			return false;
		}
	}
}

if (document.layers)
{
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById)
{
	document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(mensagemBloqueioPopup);return false");
*/
//**************************************************************************************


//Gerador de CPF / CNPJ
//**************************************************************************************
//Função para gerar informação e transportar para determinado campo.
//-------------
function gerarInformacao01(_idCampoDestino, _tipoInformacao)
{
	//tipoInformacao: cpf | cnpj | radiobutton:nomedocampo
	
	//Variáveis.			
	var tipoInformacao = _tipoInformacao;
	var strInformacao = "";
	
	
	//Verificação se tem algum controle para indicar qual informação a ser gerada.
	//if(tipoInformacao.search("radiobutton") > 0)
	if(tipoInformacao.indexOf("radiobutton:") >= 0)
	{
		var arrTipoInformacao = tipoInformacao.split(":");
		
		
		tipoInformacao = $('input[name='+arrTipoInformacao[1]+']:checked').val();
		
		
		//Debug.
		//alert(tipoInformacao.indexOf("radiobutton"));
		//alert("contem palavra");
		//alert("tipoInformacao=" + tipoInformacao);
		//alert("arrTipoInformacao=" + arrTipoInformacao[1]);
	}
	
	
	//CPF
	if(tipoInformacao == "cpf")
	{
		strInformacao = gerarCPF();
		//alert("strInformacao=" + strInformacao);
		//alert("gerarCPF=" + cpf());
	}
	
	
	//CNPJ
	if(tipoInformacao == "cnpj")
	{
		strInformacao = gerarCNPJ();
		//alert("strInformacao=" + strInformacao);
		//alert("gerarCPF=" + cpf());
	}
	
	
	//Preencher campo de destino.
	if(strInformacao != "")
	{
		document.getElementById(_idCampoDestino).value = strInformacao;
	}
}
//-------------


// ****************************************
// Script Gerador de CPF e CNPJ Válidos
// Autor: Marcos Guiga
// Site : Worldigital.co.cc
// Email: marcosguiga@hotmail.com
// Data: 19/12/2010
// ****************************************

//Função para gerar números randômicos.
function gera_random(n)
{
	var ranNum = Math.round(Math.random()*n);
	return ranNum;
}
 
//Função para retornar o resto da divisao entre números (mod).
function mod(dividendo,divisor)
{
	return Math.round(dividendo - (Math.floor(dividendo/divisor)*divisor));
}
 
//Função que gera números de CPF válidos.
function gerarCPF()
{
	var n = 9;
	var n1 = gera_random(n);
	var n2 = gera_random(n);
	var n3 = gera_random(n);
	var n4 = gera_random(n);
	var n5 = gera_random(n);
	var n6 = gera_random(n);
	var n7 = gera_random(n);
	var n8 = gera_random(n);
	var n9 = gera_random(n);
	var d1 = n9*2+n8*3+n7*4+n6*5+n5*6+n4*7+n3*8+n2*9+n1*10;
	d1 = 11 - ( mod(d1,11) );
	if (d1>=10) d1 = 0;
	var d2 = d1*2+n9*3+n8*4+n7*5+n6*6+n5*7+n4*8+n3*9+n2*10+n1*11;
	d2 = 11 - ( mod(d2,11) );
	if (d2>=10) d2 = 0;
	return ''+n1+n2+n3+'.'+n4+n5+n6+'.'+n7+n8+n9+'-'+d1+d2;
}
 
//Função que gera números de CNPJ válidos.
function gerarCNPJ()
{
	var n = 9;
	var n1 = gera_random(n);
	var n2 = gera_random(n);
	var n3 = gera_random(n);
	var n4 = gera_random(n);
	var n5 = gera_random(n);
	var n6 = gera_random(n);
	var n7 = gera_random(n);
	var n8 = gera_random(n);
	var n9 = 0;//gera_random(n);
	var n10 = 0;//gera_random(n);
	var n11 = 0;//gera_random(n);
	var n12 = 1;//gera_random(n);
	var d1 = n12*2+n11*3+n10*4+n9*5+n8*6+n7*7+n6*8+n5*9+n4*2+n3*3+n2*4+n1*5;
	d1 = 11 - ( mod(d1,11) );
	if (d1>=10) d1 = 0;
	var d2 = d1*2+n12*3+n11*4+n10*5+n9*6+n8*7+n7*8+n6*9+n5*2+n4*3+n3*4+n2*5+n1*6;
	d2 = 11 - ( mod(d2,11) );
	if (d2>=10) d2 = 0;
	return ''+n1+n2+'.'+n3+n4+n5+'.'+n6+n7+n8+'/'+n9+n10+n11+n12+'-'+d1+d2;
}
 
//Função para escolher qual função chamar de acordo com a chamada.
function faz()
{
	if (document.form1.tipo[0].checked)
	document.form1.numero.value = cpf();
	else
	document.form1.numero.value = cnpj();
}
//**************************************************************************************


//Manipulação de navegadores.
//**************************************************************************************
var currFFZoom = 1;
var currIEZoom = 100;

function NavegadorZoomIn()
{
	//alert('sad');
	var zoomStep = 0.02;
	currFFZoom += zoomStep;
	$('body').css('MozTransform','scale(' + currFFZoom + ')');
	
	var stepie = 2;
	currIEZoom += stepie;
	$('body').css('zoom', ' ' + currIEZoom + '%');

}
function NavegadorZoomOut()
{
	//alert('sad');
	var zoomStep = 0.02;
	currFFZoom -= zoomStep;
	$('body').css('MozTransform','scale(' + currFFZoom + ')');
	
	var stepie = 2;
	currIEZoom -= stepie;
	$('body').css('zoom', ' ' + currIEZoom + '%');
}
//**************************************************************************************