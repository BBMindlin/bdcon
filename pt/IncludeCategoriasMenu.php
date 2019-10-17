<?php
//Definição de variáveis.
$categoriaMenuAtual = "";

$IdTbCategoriasMenuRaiz = $includeCategoriasMenu_idTbCategoriasMenuRaiz;
$TipoCategoria = $includeCategoriasMenu_tipoCategoria;
$IdTbCadastroUsuario = $includeCategoriasMenu_idTbCadastroUsuario; //1 - TreeView1 | 11 - Repeater | 21 - Div/JavaScript

$TipoCategoriasMenu = $includeCategoriasMenu_tipoCategoriasMenu;


//Resgate de variáveis.
$idTbCategoriasNivel1 = $_GET["idTbCategoriasNivel1"];
$idTbCategoriasNivel2 = $_GET["idTbCategoriasNivel2"];


//Query de pesquisa.
//----------
$strSqlCategoriasNivel1Select = "";
$strSqlCategoriasNivel1Select .= "SELECT ";
$strSqlCategoriasNivel1Select .= "id, ";
$strSqlCategoriasNivel1Select .= "id_parent, ";
$strSqlCategoriasNivel1Select .= "id_tb_cadastro_usuario, ";
$strSqlCategoriasNivel1Select .= "n_classificacao, ";
$strSqlCategoriasNivel1Select .= "data_categoria, ";
$strSqlCategoriasNivel1Select .= "categoria, ";
$strSqlCategoriasNivel1Select .= "descricao, ";
$strSqlCategoriasNivel1Select .= "informacao_complementar1, ";
$strSqlCategoriasNivel1Select .= "informacao_complementar2, ";
$strSqlCategoriasNivel1Select .= "informacao_complementar3, ";
$strSqlCategoriasNivel1Select .= "informacao_complementar4, ";
$strSqlCategoriasNivel1Select .= "informacao_complementar5, ";
$strSqlCategoriasNivel1Select .= "tipo_categoria, ";
$strSqlCategoriasNivel1Select .= "imagem, ";
$strSqlCategoriasNivel1Select .= "ativacao, ";
$strSqlCategoriasNivel1Select .= "acesso_restrito ";
$strSqlCategoriasNivel1Select .= "FROM tb_categorias ";
$strSqlCategoriasNivel1Select .= "WHERE id <> 0 ";
//$strSqlCategoriasNivel1Select .= "AND id_parent = ? ";
//$strSqlCategoriasNivel1Select .= "AND id_parent = " . $idParentCategorias . " ";

//if(!empty($idParentCategorias)) //0 está retornando empty (talvez - verificar)
$strSqlCategoriasNivel1Select .= "AND ativacao = 1 ";

if($IdTbCategoriasMenuRaiz <> "")
{
	$strSqlCategoriasNivel1Select .= "AND id_parent = :id_parent ";
}

$strSqlCategoriasNivel1Select .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
//----------


//Criação de componentes.
//----------
$statementCategoriasNivel1Select = $dbSistemaConPDO->prepare($strSqlCategoriasNivel1Select);

if ($statementCategoriasNivel1Select !== false)
{
	if($IdTbCategoriasMenuRaiz <> "")
	{
		$statementCategoriasNivel1Select->bindParam(':id_parent', $IdTbCategoriasMenuRaiz, PDO::PARAM_STR);
	}
	$statementCategoriasNivel1Select->execute();
}

//$resultadoCategoriasNivel1 = $dbSistemaConPDO->query($strSqlCategoriasNivel1Select);
$resultadoCategoriasNivel1 = $statementCategoriasNivel1Select->fetchAll();
//----------


//Verificação de erro - debug.
//echo "IdTbCategoriasMenuRaiz=" . $IdTbCategoriasMenuRaiz . "<br />";
//echo "TipoCategoriasMenu=" . $TipoCategoriasMenu . "<br />";
//echo "strSqlCategoriasNivel1Select=" . $strSqlCategoriasNivel1Select . "<br />";
?>

<?php
if (empty($resultadoCategoriasNivel1))
{
	//echo "Nenhum registro encontrado";
?>

<?php
}else{
?>
	<?php //Registro simples.?>
    <?php //**************************************************************************************?>
    <?php if($TipoCategoriasMenu == "11"){ ?>
			<?php
            //Loop pelos resultados.
            foreach($resultadoCategoriasNivel1 as $linhaCategoriasNivel1)
            {
                //echo "id=" . $linhaCategoriasNivel1['id'] . "<br />";
            ?>
                <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategoriasNivel1['tipo_categoria'], "1");?>?<?php echo Funcoes::CategoriaPaginaSelect($linhaCategoriasNivel1['tipo_categoria'], "2");?>=<?php echo $linhaCategoriasNivel1['id'];?>" class="CategoriasMenuNivel01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategoriasNivel1['categoria']);?> 
                </a>
			<?php } ?>
    <?php } ?>
    <?php //**************************************************************************************?>


	<?php //Div/JavaScript.?>
    <?php //**************************************************************************************?>
    <?php if($TipoCategoriasMenu == "21"){ ?>
        <ul class="SiteLinksUL02" style="/*background-color: #ccc;*/">
			<?php
            //Loop pelos resultados.
            foreach($resultadoCategoriasNivel1 as $linhaCategoriasNivel1)
            {
                //echo "id=" . $linhaCategoriasNivel1['id'] . "<br />";
            ?>
                <li class="SiteLinksLI02">
                    <div style="position:relative; display: inline-block; width: 15px; height: 15px; overflow: visible;">
                        <img src="../imagens_globais/MenuExpandir.png" alt="Bullet" style="position:absolute; display: inline-block; top: 3px;" />
                    </div>
                    
                    <?php if($linhaCategoriasNivel1['tipo_categoria'] == 9){ ?>
                        <a onclick="divShowHide('divSublinks<?php echo $linhaCategoriasNivel1['id'];?>')" style="cursor: pointer;" class="CategoriasMenuNivel01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategoriasNivel1['categoria']);?> 
                        </a>
                    <?php }else{ ?>
                        <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategoriasNivel1['tipo_categoria'], "1");?>?<?php echo Funcoes::CategoriaPaginaSelect($linhaCategoriasNivel1['tipo_categoria'], "2");?>=<?php echo $linhaCategoriasNivel1['id'];?>" class="CategoriasMenuNivel01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategoriasNivel1['categoria']);?> 
                        </a>
                    <?php } ?>
                    
                    
					<?php //Categorias - Nível 2.?>
                    <?php //----------?>
                    <?php if($linhaCategoriasNivel1['tipo_categoria'] == 9){ ?>
                    	<?php 
						//Query de pesquisa.
						//----------
						$strSqlCategoriasNivel2Select = "";
						$strSqlCategoriasNivel2Select .= "SELECT ";
						$strSqlCategoriasNivel2Select .= "id, ";
						$strSqlCategoriasNivel2Select .= "id_parent, ";
						$strSqlCategoriasNivel2Select .= "id_tb_cadastro_usuario, ";
						$strSqlCategoriasNivel2Select .= "n_classificacao, ";
						$strSqlCategoriasNivel2Select .= "data_categoria, ";
						$strSqlCategoriasNivel2Select .= "categoria, ";
						$strSqlCategoriasNivel2Select .= "descricao, ";
						$strSqlCategoriasNivel2Select .= "informacao_complementar1, ";
						$strSqlCategoriasNivel2Select .= "informacao_complementar2, ";
						$strSqlCategoriasNivel2Select .= "informacao_complementar3, ";
						$strSqlCategoriasNivel2Select .= "informacao_complementar4, ";
						$strSqlCategoriasNivel2Select .= "informacao_complementar5, ";
						$strSqlCategoriasNivel2Select .= "tipo_categoria, ";
						$strSqlCategoriasNivel2Select .= "imagem, ";
						$strSqlCategoriasNivel2Select .= "ativacao, ";
						$strSqlCategoriasNivel2Select .= "acesso_restrito ";
						$strSqlCategoriasNivel2Select .= "FROM tb_categorias ";
						$strSqlCategoriasNivel2Select .= "WHERE id <> 0 ";
						$strSqlCategoriasNivel2Select .= "AND ativacao = 1 ";
						//if($IdTbCategoriasMenuRaiz <> "")
						//{
							$strSqlCategoriasNivel2Select .= "AND id_parent = :id_parent ";
						//}
						
						$strSqlCategoriasNivel2Select .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
						//----------
						
						
						//Criação de componentes.
						//----------
						$statementCategoriasNivel2Select = $dbSistemaConPDO->prepare($strSqlCategoriasNivel2Select);
						
						if ($statementCategoriasNivel2Select !== false)
						{
							//if($IdTbCategoriasMenuRaiz <> "")
							//{
								$statementCategoriasNivel2Select->bindParam(':id_parent', $linhaCategoriasNivel1['id'], PDO::PARAM_STR);
							//}
							$statementCategoriasNivel2Select->execute();
						}
						
						//$resultadoCategoriasNivel1 = $dbSistemaConPDO->query($strSqlCategoriasNivel2Select);
						$resultadoCategoriasNivel2 = $statementCategoriasNivel2Select->fetchAll();
						//----------
						?>
                        
                        
                        <?php
						//Mecanismo de exibição do submenu.
						$divCategoriasNivel2 = "none";
						
						//if($idTbCategoriasNivel2 <> "")
						//{
							
						//}
						
						if($linhaCategoriasNivel1['id'] == $idTbCategoriasNivel1)
						{
							$divCategoriasNivel2 = "block";
						}
						?>
                        <div id="divSublinks<?php echo $linhaCategoriasNivel1['id'];?>" style="position: relative; display: <?php echo $divCategoriasNivel2;?>; clear: both;">
                            <ul class="SiteLinksUL02">
								<?php
                                //Loop pelos resultados.
                                foreach($resultadoCategoriasNivel2 as $linhaCategoriasNivel2)
                                {
                                ?>
                                    <li class="SiteLinksLI02">
										<?php if($linhaCategoriasNivel2['tipo_categoria'] == 9){ ?>
                                            <a onclick="divShowHide('divSublinks<?php echo $linhaCategoriasNivel2['id'];?>')" style="cursor: pointer;" class="CategoriasMenuNivel02">
                                                &bull; <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategoriasNivel2['categoria']);?> 
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo Funcoes::CategoriaPaginaSelect($linhaCategoriasNivel2['tipo_categoria'], "1");?>?<?php echo Funcoes::CategoriaPaginaSelect($linhaCategoriasNivel2['tipo_categoria'], "2");?>=<?php echo $linhaCategoriasNivel2['id'];?>&idTbCategoriasNivel1=<?php echo $linhaCategoriasNivel1['id'];?>&idTbCategoriasNivel2=<?php echo $linhaCategoriasNivel2['id'];?>" class="CategoriasMenuNivel02">
                                                &bull; <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategoriasNivel2['categoria']);?> 
                                            </a>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php
						//Limpeza de objetos.
						unset($strSqlCategoriasNivel2Select);
						unset($statementCategoriasNivel2Select);
						unset($resultadoCategoriasNivel2);
						unset($linhaCategoriasNivel2);
						//----------
						?>
                    <?php } ?>
                    <?php //----------?>
                </li>
			<?php } ?>
        </ul>
    <?php } ?>
    <?php //**************************************************************************************?>
<?php } ?>

<?php
//Limpeza de objetos.
unset($strSqlCategoriasNivel1Select);
unset($statementCategoriasNivel1Select);
unset($resultadoCategoriasNivel1);
unset($linhaCategoriasNivel1);
//----------
?>