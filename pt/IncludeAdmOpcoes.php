<?php
//Definição de variáveis.
$IipoOpcoes = $includeAdmOpcoes_tipoOpcoes; //1 - opções gerais (dashboard) | 2 - opções principais (dashboard) | 11 - opções (menu) | ic1 - opções principais
$ConfigOpcoes = $includeAdmOpcoes_configOpcoes; //ainda implementar (geralPainel, geralCadastroEditar, etc)

$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
?>

<?php //Opções gerais.?>
<?php //**************************************************************************************?>
<?php if($IipoOpcoes == "1"){?>
	<?php //Opções gerais.?>
    <?php //----------------------?>
        <div class="AdmTexto01" style="z-index: 1;"> 
            <strong style="display: none;">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoesGerais"); ?>:
            </strong>
                <!--Links.-->
                <?php if($_SERVER['PHP_SELF'] <> "/pt/SiteAdm.php"){ ?>
                <div class="AdmDivBto01">
                	<a href="SiteAdm.php" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTitulo"); ?>
                    </a>
                </div>
                <?php } ?>
                <div class="AdmDivBto01">
                	<a onmouseover="divShowHide('divSublinks')" class="AdmLinks01" style="cursor: pointer;">
                        Cadastrar/Acessar Uma Obra
                    </a>
                    <div id="divSublinks" onMouseOut="divShowHide('divSublinks')" style="position: absolute; display: none; width: 180px; top: 20px; left: 0px; background-color: #fff; text-align: left; z-index: 1;">
                        <!--Registro.-->
                        <a href="SiteAdmProdutosIndice.php?idParentProdutos=3478&idsProdutosTipo[0]=3483" class="CategoriasMenuNivel02" style="position: relative; display: block;/* width: 100%; */height: 30px; line-height: 30px; padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #000;">
                            Diplomas
                        </a>
                        
                        <a href="SiteAdmProdutosIndice.php?idParentProdutos=3478&idsProdutosTipo[0]=3484" class="CategoriasMenuNivel02" style="position: relative; display: block;/* width: 100%; */height: 30px; line-height: 30px; padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #000;">
                            Documentos
                        </a>
                        
                        <a href="SiteAdmProdutosIndice.php?idParentProdutos=3478&idsProdutosTipo[0]=3485" class="CategoriasMenuNivel02" style="position: relative; display: block;/* width: 100%; */height: 30px; line-height: 30px; padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #000;">
                            Fotografia
                        </a>
                        
                        <a href="SiteAdmProdutosIndice.php?idParentProdutos=3478&idsProdutosTipo[0]=3486" class="CategoriasMenuNivel02" style="position: relative; display: block;/* width: 100%; */height: 30px; line-height: 30px; padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #000;">
                            Livros
                        </a>
                        
                        <a href="SiteAdmProdutosIndice.php?idParentProdutos=3478&idsProdutosTipo[0]=3487" class="CategoriasMenuNivel02" style="position: relative; display: block;/* width: 100%; */height: 30px; line-height: 30px; padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #000;">
                            Mapas
                        </a>
                        
                        <a href="SiteAdmProdutosIndice.php?idParentProdutos=3478&idsProdutosTipo[0]=3488" class="CategoriasMenuNivel02" style="position: relative; display: block;/* width: 100%; */height: 30px; line-height: 30px; padding-left: 10px; padding-right: 10px; border-bottom: 1px solid #000;">
                            Obras de Arte
                        </a>
                        
                    </div>
                </div>
                <div class="AdmDivBto01">
                	<a href="SiteBusca.php" class="AdmLinks01">
                        Busca
                    </a>
                </div>
                <div class="AdmDivBto01">
                	<a href="SiteAdmRelatorios.php" class="AdmLinks01">
                        Relat&oacute;rios
                    </a>
                </div>
                <div class="AdmDivBto01">
                	<a href="SiteConteudo.php?idParentConteudo=3629" class="AdmLinks01">
                        Instru&ccedil;&otilde;es
                    </a>
                </div>
                <div class="AdmDivBto01">
                	<a href="SiteLogoffExe.php" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLogoffTitulo"); ?>
                    </a>
                </div>
        </div>
    <?php //----------------------?>
<?php }?>
<?php //**************************************************************************************?>

    
<?php //Opções principais.?>
<?php //**************************************************************************************?>
<?php if($IipoOpcoes == "2"){?>
	<?php //Opções usuário.?>
    <?php //----------------------?>
    <?php //if(!empty(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario"))){?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoes"); ?>:
            </strong>
            <br />
            [
            <a href="SiteAdmCadastroEnderecosIndice.php?idTbCadastro=<?php echo $idTbCadastroLogin;?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelEnderecosAdministrar"); ?>
            </a>
            ] 
            
            [
            <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $idTbCadastroLogin; ?>&idTbHistoricoStatusSelect=3782" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelHistoricoAdministrar"); ?>
            </a>
            ]
            [
            <a href="SiteAdmTarefasIndice.php?idParent=<?php echo $idTbCadastroLogin; ?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTarefasAdministrar"); ?>
            </a>
            ]

            [
            <a href="SiteAdmCadastroIndice.php?idParentCadastro=3892" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelCadastroAdministrar"); ?>
            </a>
            ]
            [
            <a href="SiteAdmCadastroIndice.php?idParentCadastro=3892&idTbCadastro1=<?php echo $idTbCadastroLogin;?>&idTipoCadastro=<?php echo $GLOBALS['configIdCadastroCliente'];?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelCadastroAdministrar"); ?>
            </a>
            ]
            
            [
            <a href="SiteAdmVeiculosIndice.php?idTbCadastroUsuario=<?php echo $idTbCadastroLogin;?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelVeiculosGerenciamento"); ?>
            </a>
            ]
            [
            <a href="SiteAdmCategoriasIndice.php?idParentCategorias=3529" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelVeiculosInclusao"); ?> (por categoria)
            </a>
            ]
            
            [
            <a href="SiteAdmPaginasIndice.php?idParentPaginas=3974" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelPaginasAdministrar"); ?>
            </a>
            ]
            
            <?php
            // ids das turmas que o cadastro está vinculado.
            $idsTbTurmasVinculoCadastroLogado = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
                                                                        "id_item", 
                                                                        "id_registro", 
                                                                        $idTbCadastroLogin, 
                                                                        "", 
                                                                        "", 
                                                                        1, 
                                                                        "", 
                                                                        "", 
                                                                        "tipo_categoria", 
                                                                        "13", 
                                                                        "", 
                                                                        "");
                                                                        
            //Verificação de erro - debug.
            //echo "idsTbTurmasVinculoCadastroLogado=" . $idsTbTurmasVinculoCadastroLogado . "<br />";														
            ?>
            <?php if($idsTbTurmasVinculoCadastroLogado <> ""){?>
            <?php } ?>
            [
            <a href="SiteAdmTurmasIndice.php?idParentTurmas=3672&idsTbTurmas=<?php echo $idsTbTurmasVinculoCadastroLogado; ?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTurmasIndice"); ?>
            </a>
            ]
            [
            <a href="SiteAdmTurmasIndice.php?idParentTurmas=3672&idTbCadastro1=<?php echo $idTbCadastroLogin; ?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTurmasIndice"); ?>
            </a>
            ]
            
            [
            <a href="SiteAdmCadastroManutencao.php?tipoComplemento=3" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroManutencaoTitulo"); ?>
            </a>
            ]
            
            [
            <a href="SiteAdmPaginasManutencao.php?tipoComplemento=12" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginasManutencaoTitulo"); ?>
            </a>
            ]
            [
            <a href="SiteAdmForumTopicosIndice.php?idParentForum=3961" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelForumTopicoAdministrar"); ?>
            </a>
            ]
            [
            <a href="SiteAdmProcessosManutencao.php?tipoComplemento=1" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcessosManutencaoTitulo"); ?>
            </a>
            ]
            [
            <a href="SiteAdmOrcamentosIndice.php" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTitulo"); ?>
            </a>
            ]
            [
            <a href="SiteAdmFluxoIndice.php?idParentFluxo=3479" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelFluxoAdministrar"); ?>
            </a>
            ]
            
            [
            <a href="SiteAdmItensRelacaoRegistrosIndice.php?idItem=<?php echo $idTbCadastroLogin;?>&tipoCategoria=9&idParentCategoriasRaiz=<?php echo $GLOBALS['configCadastroIdCategoriaMultiplaRaiz'];?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularCategorias"); ?>
            </a>
            ]
            [
            <a href="SiteAdmItensRelacaoRegistrosIndice.php?idItem=<?php echo $idTbCadastroLogin;?>&tipoCategoria=2" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
            </a>
            ]
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções cliente.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoes"); ?>:
            </strong>
            <br />
            [
            <a href="SiteAdmPedidosIndice.php" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelPedidosHistorico"); ?>
            </a>
            ]
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções vendedor.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoes"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções RH.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioRH") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoes"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções assinante.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroAssinante") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoes"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções simples.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroSimples") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoes"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
<?php }?>
<?php //**************************************************************************************?>


<?php //Opções principais.?>
<?php //**************************************************************************************?>
<?php if($IipoOpcoes == "ic1"){?>
	<?php //Opções usuário.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuario") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoesComplementares"); ?>:
            </strong>
            <br />
            [
            <a href="SiteAdmArquivosIndice.php?tipoArquivo=1&idParent=<?php echo $idTbCadastroLogin;?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelImagensAdministrar"); ?>
            </a>
            ]
            [
            <a href="SiteAdmArquivosIndice.php?tipoArquivo=3&idParent=<?php echo $idTbCadastroLogin;?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelArquivosAdministrar"); ?>
            </a>
            ]
            [
            <a href="SiteAdmVideos.php?idTbCategorias=<?php echo $idTbCadastroLogin;?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelVideosAdministrar"); ?>
            </a>
            ]
            [
            <a href="SiteAdmConteudoIndice.php?idTbCategorias=<?php echo $idTbCadastroLogin;?>" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelConteudoAdministrar"); ?>
            </a>
            ]
            [
            <a href="SiteAdmConteudoHTMLIndice.php" class="AdmLinks01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelConteudoHTML1Administrar"); ?>
            </a>
            ]
    
            <?php if($GLOBALS['habilitarCadastroLogo'] == 1){?>
                [
                <a href="SiteAdmCadastroArquivosComplementares.php?campo=logo" class="AdmLinks01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroLogoInserir"); ?>
                </a>
                ]
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroMapa'] == 1){?>
                [
                <a href="SiteAdmCadastroArquivosComplementares.php?campo=mapa" class="AdmLinks01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroMapaInserir"); ?>
                </a>
                ]
            <?php } ?>
            <?php if($GLOBALS['habilitarCadastroBanner'] == 1){?>
                [
                <a href="SiteAdmCadastroArquivosComplementares.php?campo=banner" class="AdmLinks01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBannerInserir"); ?>
                </a>
                ]
            <?php } ?>
        </div>
	<?php } ?>
    <?php //----------------------?>
    
    
    <?php //Opções cliente.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoesComplementares"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções vendedor.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioVendedor") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoesComplementares"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções RH.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroUsuarioRH") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoesComplementares"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções assinante.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroAssinante") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoesComplementares"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
    
    
    <?php //Opções simples.?>
    <?php //----------------------?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroSimples") <> ""){?>
        <div class="AdmTexto01"> 
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelOpcoesComplementares"); ?>:
            </strong>
            <br />
        </div>
    <?php }?>
    <?php //----------------------?>
<?php } ?>
<?php //**************************************************************************************?>