<?php
//
class AlmoxarifadoEntrada_Frm_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $formatado = false;
   var $use_100perc_fields = false;
   var $classes_100perc_fields = array();
   var $close_modal_after_insert = false;
   var $NM_ajax_flag    = false;
   var $NM_ajax_opcao   = '';
   var $NM_ajax_retorno = '';
   var $NM_ajax_info    = array('result'            => '',
                                'param'             => array(),
                                'autoComp'          => '',
                                'rsSize'            => '',
                                'msgDisplay'        => '',
                                'errList'           => array(),
                                'fldList'           => array(),
                                'varList'           => array(),
                                'focus'             => '',
                                'navStatus'         => array(),
                                'navSummary'        => array(),
                                'redir'             => array(),
                                'blockDisplay'      => array(),
                                'fieldDisplay'      => array(),
                                'fieldLabel'        => array(),
                                'readOnly'          => array(),
                                'btnVars'           => array(),
                                'ajaxAlert'         => array(),
                                'ajaxMessage'       => array(),
                                'ajaxJavascript'    => array(),
                                'buttonDisplay'     => array(),
                                'buttonDisplayVert' => array(),
                                'calendarReload'    => false,
                                'quickSearchRes'    => false,
                                'displayMsg'        => false,
                                'displayMsgTxt'     => '',
                                'dyn_search'        => array(),
                                'empty_filter'      => '',
                                'event_field'       => '',
                                'fieldsWithErrors'  => array(),
                               );
   var $NM_ajax_force_values = false;
   var $captcha_code;
   var $captcha_sent;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $idalmoxarifadoentrada;
   var $idtenacidade;
   var $idtenacidade_1;
   var $idfornecedor;
   var $idfornecedor_1;
   var $idalmoxarifado;
   var $idalmoxarifado_1;
   var $idusuarioauditoria;
   var $idusuarioauditoria_1;
   var $cnpj;
   var $razaosocial;
   var $nomefantasia;
   var $versao;
   var $codigo;
   var $chave;
   var $numeronota;
   var $numerofatura;
   var $natureza;
   var $serie;
   var $datahoraemissao;
   var $datahoraemissao_hora;
   var $valortotal;
   var $valordesconto;
   var $valorliquido;
   var $valorcofins;
   var $valorpis;
   var $valoricms;
   var $valorfrete;
   var $qtdprodutos;
   var $qtdparcelas;
   var $nomearquivo;
   var $nomereferencia;
   var $nomereferencia_scfile_name;
   var $nomereferencia_ul_name;
   var $nomereferencia_ul_type;
   var $nomereferencia_limpa;
   var $nomereferencia_salva;
   var $observacoes;
   var $datahorainclusao;
   var $datahorainclusao_hora;
   var $enderecoipauditoria;
   var $nomeaplicacaoauditoria;
   var $parcela;
   var $produto;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $nm_location;
   var $nm_flag_iframe;
   var $nm_flag_saida_novo;
   var $nmgp_botoes = array();
   var $nmgp_url_saida;
   var $nmgp_form_show;
   var $nmgp_form_empty;
   var $nmgp_cmp_readonly = array();
   var $nmgp_cmp_hidden   = array();
   var $Field_no_validate  = array();
   var $form_paginacao = 'parcial';
   var $lig_edit_lookup      = false;
   var $lig_edit_lookup_call = false;
   var $lig_edit_lookup_cb   = '';
   var $lig_edit_lookup_row  = '';
   var $is_calendar_app = false;
   var $Embutida_call  = false;
   var $Embutida_ronly = false;
   var $Embutida_proc  = false;
   var $Embutida_form  = false;
   var $Grid_editavel  = false;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
   var $record_insert_ok = false;
   var $record_delete_ok = false;
   var $Upload_refresh_fields = array();
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['chave']))
          {
              $this->chave = $this->NM_ajax_info['param']['chave'];
          }
          if (isset($this->NM_ajax_info['param']['cnpj']))
          {
              $this->cnpj = $this->NM_ajax_info['param']['cnpj'];
          }
          if (isset($this->NM_ajax_info['param']['codigo']))
          {
              $this->codigo = $this->NM_ajax_info['param']['codigo'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['datahoraemissao']))
          {
              $this->datahoraemissao = $this->NM_ajax_info['param']['datahoraemissao'];
          }
          if (isset($this->NM_ajax_info['param']['datahorainclusao']))
          {
              $this->datahorainclusao = $this->NM_ajax_info['param']['datahorainclusao'];
          }
          if (isset($this->NM_ajax_info['param']['enderecoipauditoria']))
          {
              $this->enderecoipauditoria = $this->NM_ajax_info['param']['enderecoipauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifado']))
          {
              $this->idalmoxarifado = $this->NM_ajax_info['param']['idalmoxarifado'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifadoentrada']))
          {
              $this->idalmoxarifadoentrada = $this->NM_ajax_info['param']['idalmoxarifadoentrada'];
          }
          if (isset($this->NM_ajax_info['param']['idfornecedor']))
          {
              $this->idfornecedor = $this->NM_ajax_info['param']['idfornecedor'];
          }
          if (isset($this->NM_ajax_info['param']['idtenacidade']))
          {
              $this->idtenacidade = $this->NM_ajax_info['param']['idtenacidade'];
          }
          if (isset($this->NM_ajax_info['param']['idusuarioauditoria']))
          {
              $this->idusuarioauditoria = $this->NM_ajax_info['param']['idusuarioauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['natureza']))
          {
              $this->natureza = $this->NM_ajax_info['param']['natureza'];
          }
          if (isset($this->NM_ajax_info['param']['nm_form_submit']))
          {
              $this->nm_form_submit = $this->NM_ajax_info['param']['nm_form_submit'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ancora']))
          {
              $this->nmgp_ancora = $this->NM_ajax_info['param']['nmgp_ancora'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_dyn_search']))
          {
              $this->nmgp_arg_dyn_search = $this->NM_ajax_info['param']['nmgp_arg_dyn_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_num_form']))
          {
              $this->nmgp_num_form = $this->NM_ajax_info['param']['nmgp_num_form'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_opcao']))
          {
              $this->nmgp_opcao = $this->NM_ajax_info['param']['nmgp_opcao'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ordem']))
          {
              $this->nmgp_ordem = $this->NM_ajax_info['param']['nmgp_ordem'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_parms']))
          {
              $this->nmgp_parms = $this->NM_ajax_info['param']['nmgp_parms'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['nomeaplicacaoauditoria']))
          {
              $this->nomeaplicacaoauditoria = $this->NM_ajax_info['param']['nomeaplicacaoauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['nomearquivo']))
          {
              $this->nomearquivo = $this->NM_ajax_info['param']['nomearquivo'];
          }
          if (isset($this->NM_ajax_info['param']['nomefantasia']))
          {
              $this->nomefantasia = $this->NM_ajax_info['param']['nomefantasia'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferencia']))
          {
              $this->nomereferencia = $this->NM_ajax_info['param']['nomereferencia'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferencia_limpa']))
          {
              $this->nomereferencia_limpa = $this->NM_ajax_info['param']['nomereferencia_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferencia_salva']))
          {
              $this->nomereferencia_salva = $this->NM_ajax_info['param']['nomereferencia_salva'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferencia_ul_name']))
          {
              $this->nomereferencia_ul_name = $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferencia_ul_type']))
          {
              $this->nomereferencia_ul_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['numerofatura']))
          {
              $this->numerofatura = $this->NM_ajax_info['param']['numerofatura'];
          }
          if (isset($this->NM_ajax_info['param']['numeronota']))
          {
              $this->numeronota = $this->NM_ajax_info['param']['numeronota'];
          }
          if (isset($this->NM_ajax_info['param']['observacoes']))
          {
              $this->observacoes = $this->NM_ajax_info['param']['observacoes'];
          }
          if (isset($this->NM_ajax_info['param']['parcela']))
          {
              $this->parcela = $this->NM_ajax_info['param']['parcela'];
          }
          if (isset($this->NM_ajax_info['param']['produto']))
          {
              $this->produto = $this->NM_ajax_info['param']['produto'];
          }
          if (isset($this->NM_ajax_info['param']['qtdparcelas']))
          {
              $this->qtdparcelas = $this->NM_ajax_info['param']['qtdparcelas'];
          }
          if (isset($this->NM_ajax_info['param']['qtdprodutos']))
          {
              $this->qtdprodutos = $this->NM_ajax_info['param']['qtdprodutos'];
          }
          if (isset($this->NM_ajax_info['param']['razaosocial']))
          {
              $this->razaosocial = $this->NM_ajax_info['param']['razaosocial'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['serie']))
          {
              $this->serie = $this->NM_ajax_info['param']['serie'];
          }
          if (isset($this->NM_ajax_info['param']['valorcofins']))
          {
              $this->valorcofins = $this->NM_ajax_info['param']['valorcofins'];
          }
          if (isset($this->NM_ajax_info['param']['valordesconto']))
          {
              $this->valordesconto = $this->NM_ajax_info['param']['valordesconto'];
          }
          if (isset($this->NM_ajax_info['param']['valorfrete']))
          {
              $this->valorfrete = $this->NM_ajax_info['param']['valorfrete'];
          }
          if (isset($this->NM_ajax_info['param']['valoricms']))
          {
              $this->valoricms = $this->NM_ajax_info['param']['valoricms'];
          }
          if (isset($this->NM_ajax_info['param']['valorliquido']))
          {
              $this->valorliquido = $this->NM_ajax_info['param']['valorliquido'];
          }
          if (isset($this->NM_ajax_info['param']['valorpis']))
          {
              $this->valorpis = $this->NM_ajax_info['param']['valorpis'];
          }
          if (isset($this->NM_ajax_info['param']['valortotal']))
          {
              $this->valortotal = $this->NM_ajax_info['param']['valortotal'];
          }
          if (isset($this->NM_ajax_info['param']['versao']))
          {
              $this->versao = $this->NM_ajax_info['param']['versao'];
          }
          if (isset($this->nmgp_refresh_fields))
          {
              $this->nmgp_refresh_fields = explode('_#fld#_', $this->nmgp_refresh_fields);
              $this->nmgp_opcao          = 'recarga';
          }
          if (!isset($this->nmgp_refresh_row))
          {
              $this->nmgp_refresh_row = '';
          }
      }

      $this->scSajaxReservedWords = array('rs', 'rst', 'rsrnd', 'rsargs');
      $this->sc_conv_var = array();
      if (!empty($_FILES))
      {
          foreach ($_FILES as $nmgp_campo => $nmgp_valores)
          {
               if (!in_array(strtolower($nmgp_campo), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_campo]))
                   {
                       $nmgp_campo = $this->sc_conv_var[$nmgp_campo];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_campo)]))
                   {
                       $nmgp_campo = $this->sc_conv_var[strtolower($nmgp_campo)];
                   }
               }
               $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
               $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
               $this->$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
               $this->$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
               $this->$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
          }
      }
      $Sc_lig_md5 = false;
      if (!empty($_POST))
      {
          foreach ($_POST as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                      $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (!empty($_GET))
      {
          foreach ($_GET as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                       $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
      {
          $_SESSION['sc_session']['SC_parm_violation'] = true;
      }
      if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
      {
          $nmgp_parms = "";
      }
      if (isset($this->varIdAlmoxarifadoEntrada) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdAlmoxarifadoEntrada'] = $this->varIdAlmoxarifadoEntrada;
      }
      if (isset($this->varIdTenacidade) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (isset($this->varListaEmpresa) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
      }
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varPrimeiraVez) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (isset($_POST["varIdAlmoxarifadoEntrada"]) && isset($this->varIdAlmoxarifadoEntrada)) 
      {
          $_SESSION['varIdAlmoxarifadoEntrada'] = $this->varIdAlmoxarifadoEntrada;
      }
      if (!isset($_POST["varIdAlmoxarifadoEntrada"]) && isset($_POST["varidalmoxarifadoentrada"])) 
      {
          $_SESSION['varIdAlmoxarifadoEntrada'] = $_POST["varidalmoxarifadoentrada"];
      }
      if (isset($_POST["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
      }
      if (isset($_POST["varListaEmpresa"]) && isset($this->varListaEmpresa)) 
      {
          $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
      }
      if (!isset($_POST["varListaEmpresa"]) && isset($_POST["varlistaempresa"])) 
      {
          $_SESSION['varListaEmpresa'] = $_POST["varlistaempresa"];
      }
      if (isset($_POST["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_POST["varIdUsuario"]) && isset($_POST["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_POST["varidusuario"];
      }
      if (isset($_POST["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_POST["varPrimeiraVez"]) && isset($_POST["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_POST["varprimeiravez"];
      }
      if (isset($_GET["varIdAlmoxarifadoEntrada"]) && isset($this->varIdAlmoxarifadoEntrada)) 
      {
          $_SESSION['varIdAlmoxarifadoEntrada'] = $this->varIdAlmoxarifadoEntrada;
      }
      if (!isset($_GET["varIdAlmoxarifadoEntrada"]) && isset($_GET["varidalmoxarifadoentrada"])) 
      {
          $_SESSION['varIdAlmoxarifadoEntrada'] = $_GET["varidalmoxarifadoentrada"];
      }
      if (isset($_GET["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
      }
      if (isset($_GET["varListaEmpresa"]) && isset($this->varListaEmpresa)) 
      {
          $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
      }
      if (!isset($_GET["varListaEmpresa"]) && isset($_GET["varlistaempresa"])) 
      {
          $_SESSION['varListaEmpresa'] = $_GET["varlistaempresa"];
      }
      if (isset($_GET["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_GET["varIdUsuario"]) && isset($_GET["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_GET["varidusuario"];
      }
      if (isset($_GET["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_GET["varPrimeiraVez"]) && isset($_GET["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_GET["varprimeiravez"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $nmgp_parms = str_replace("@aspass@", "'", $this->nmgp_parms);
          $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
          $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
          $todo  = explode("?@?", $todox);
          $ix = 0;
          while (!empty($todo[$ix]))
          {
             $cadapar = explode("?#?", $todo[$ix]);
             if (1 < sizeof($cadapar))
             {
                if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                {
                    $cadapar[0] = substr($cadapar[0], 11);
                    $cadapar[1] = $_SESSION[$cadapar[1]];
                }
                 if (isset($this->sc_conv_var[$cadapar[0]]))
                 {
                     $cadapar[0] = $this->sc_conv_var[$cadapar[0]];
                 }
                 elseif (isset($this->sc_conv_var[strtolower($cadapar[0])]))
                 {
                     $cadapar[0] = $this->sc_conv_var[strtolower($cadapar[0])];
                 }
                 nm_limpa_str_AlmoxarifadoEntrada_Frm($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (!isset($this->varIdAlmoxarifadoEntrada) && isset($this->varidalmoxarifadoentrada)) 
          {
              $this->varIdAlmoxarifadoEntrada = $this->varidalmoxarifadoentrada;
          }
          if (isset($this->varIdAlmoxarifadoEntrada)) 
          {
              $_SESSION['varIdAlmoxarifadoEntrada'] = $this->varIdAlmoxarifadoEntrada;
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varListaEmpresa) && isset($this->varlistaempresa)) 
          {
              $this->varListaEmpresa = $this->varlistaempresa;
          }
          if (isset($this->varListaEmpresa)) 
          {
              $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['opc_ant']);
          }
          if (!isset($this->varIdAlmoxarifadoEntrada) && isset($this->varidalmoxarifadoentrada)) 
          {
              $this->varIdAlmoxarifadoEntrada = $this->varidalmoxarifadoentrada;
          }
          if (isset($this->varIdAlmoxarifadoEntrada)) 
          {
              $_SESSION['varIdAlmoxarifadoEntrada'] = $this->varIdAlmoxarifadoEntrada;
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varListaEmpresa) && isset($this->varlistaempresa)) 
          {
              $this->varListaEmpresa = $this->varlistaempresa;
          }
          if (isset($this->varListaEmpresa)) 
          {
              $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['parms']);
              $todo  = explode("?@?", $todox);
              $ix = 0;
              while (!empty($todo[$ix]))
              {
                 $cadapar = explode("?#?", $todo[$ix]);
                 if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                 {
                     $cadapar[0] = substr($cadapar[0], 11);
                     $cadapar[1] = $_SESSION[$cadapar[1]];
                 }
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 $ix++;
              }
          }
      } 

      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['nm_run_menu'] = 1;
      } 
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->datahoraemissao);
          $this->datahoraemissao      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->datahoraemissao_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->datahorainclusao);
          $this->datahorainclusao      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->datahorainclusao_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new AlmoxarifadoEntrada_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
  $this->sc_temp_varPrimeiraVez = "";
$this->sc_temp_varIdTenacidade;
$this->sc_temp_varIdUsuario;
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntrada_Frm']['upload_field_info']['nomereferencia'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'AlmoxarifadoEntrada_Frm',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(xml)$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'N0',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['AlmoxarifadoEntrada_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['AlmoxarifadoEntrada_Frm'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoEntrada_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoEntrada_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('AlmoxarifadoEntrada_Frm') . "/AlmoxarifadoEntrada_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoEntrada_Frm']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Entrada Almoxarifado";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "AlmoxarifadoEntrada_Frm")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if (!function_exists("nmButtonOutput"))
      {
          include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
      }
      include("../_lib/css/" . $this->Ini->str_schema_all . "_form.php");
      $this->Ini->Str_btn_form    = trim($str_button);
      include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $_SESSION['scriptcase']['css_form_help'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form.css";
      $_SESSION['scriptcase']['css_form_help_dir'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->Db = $this->Ini->Db; 
      $this->nm_new_label['datahorainclusao'] = 'Nota fiscal importada em';

      $this->Ini->str_google_fonts = isset($str_google_fonts)?$str_google_fonts:'';
      $this->Ini->Img_sep_form    = "/" . trim($str_toolbar_separator);
      $this->Ini->Color_bg_ajax   = !isset($str_ajax_bg)         || "" == trim($str_ajax_bg)         ? "#000" : $str_ajax_bg;
      $this->Ini->Border_c_ajax   = !isset($str_ajax_border_c)   || "" == trim($str_ajax_border_c)   ? ""     : $str_ajax_border_c;
      $this->Ini->Border_s_ajax   = !isset($str_ajax_border_s)   || "" == trim($str_ajax_border_s)   ? ""     : $str_ajax_border_s;
      $this->Ini->Border_w_ajax   = !isset($str_ajax_border_w)   || "" == trim($str_ajax_border_w)   ? ""     : $str_ajax_border_w;
      $this->Ini->Block_img_exp   = !isset($str_block_exp)       || "" == trim($str_block_exp)       ? ""     : $str_block_exp;
      $this->Ini->Block_img_col   = !isset($str_block_col)       || "" == trim($str_block_col)       ? ""     : $str_block_col;
      $this->Ini->Msg_ico_title   = !isset($str_msg_ico_title)   || "" == trim($str_msg_ico_title)   ? ""     : $str_msg_ico_title;
      $this->Ini->Msg_ico_body    = !isset($str_msg_ico_body)    || "" == trim($str_msg_ico_body)    ? ""     : $str_msg_ico_body;
      $this->Ini->Err_ico_title   = !isset($str_err_ico_title)   || "" == trim($str_err_ico_title)   ? ""     : $str_err_ico_title;
      $this->Ini->Err_ico_body    = !isset($str_err_ico_body)    || "" == trim($str_err_ico_body)    ? ""     : $str_err_ico_body;
      $this->Ini->Cal_ico_back    = !isset($str_cal_ico_back)    || "" == trim($str_cal_ico_back)    ? ""     : $str_cal_ico_back;
      $this->Ini->Cal_ico_for     = !isset($str_cal_ico_for)     || "" == trim($str_cal_ico_for)     ? ""     : $str_cal_ico_for;
      $this->Ini->Cal_ico_close   = !isset($str_cal_ico_close)   || "" == trim($str_cal_ico_close)   ? ""     : $str_cal_ico_close;
      $this->Ini->Tab_space       = !isset($str_tab_space)       || "" == trim($str_tab_space)       ? ""     : $str_tab_space;
      $this->Ini->Bubble_tail     = !isset($str_bubble_tail)     || "" == trim($str_bubble_tail)     ? ""     : $str_bubble_tail;
      $this->Ini->Label_sort_pos  = !isset($str_label_sort_pos)  || "" == trim($str_label_sort_pos)  ? ""     : $str_label_sort_pos;
      $this->Ini->Label_sort      = !isset($str_label_sort)      || "" == trim($str_label_sort)      ? ""     : $str_label_sort;
      $this->Ini->Label_sort_asc  = !isset($str_label_sort_asc)  || "" == trim($str_label_sort_asc)  ? ""     : $str_label_sort_asc;
      $this->Ini->Label_sort_desc = !isset($str_label_sort_desc) || "" == trim($str_label_sort_desc) ? ""     : $str_label_sort_desc;
      $this->Ini->Img_status_ok       = !isset($str_img_status_ok)  || "" == trim($str_img_status_ok)   ? ""     : $str_img_status_ok;
      $this->Ini->Img_status_err      = !isset($str_img_status_err) || "" == trim($str_img_status_err)  ? ""     : $str_img_status_err;
      $this->Ini->Css_status          = "scFormInputError";
      $this->Ini->Css_status_pwd_box  = "scFormInputErrorPwdBox";
      $this->Ini->Css_status_pwd_text = "scFormInputErrorPwdText";
      $this->Ini->Error_icon_span      = !isset($str_error_icon_span)  || "" == trim($str_error_icon_span)  ? false  : "message" == $str_error_icon_span;
      $this->Ini->Img_qs_search        = !isset($img_qs_search)        || "" == trim($img_qs_search)        ? "scriptcase__NM__qs_lupa.png"  : $img_qs_search;
      $this->Ini->Img_qs_clean         = !isset($img_qs_clean)         || "" == trim($img_qs_clean)         ? "scriptcase__NM__qs_close.png" : $img_qs_clean;
      $this->Ini->Str_qs_image_padding = !isset($str_qs_image_padding) || "" == trim($str_qs_image_padding) ? "0"                            : $str_qs_image_padding;
      $this->Ini->App_div_tree_img_col = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp = trim($app_div_str_tree_exp);
      $this->Ini->form_table_width     = isset($str_form_table_width) && '' != trim($str_form_table_width) ? $str_form_table_width : '';
      $this->Ini->Bubble_tail          = trim($str_bubble_tail);

        $this->classes_100perc_fields['table'] = '';
        $this->classes_100perc_fields['input'] = '';
        $this->classes_100perc_fields['span_input'] = '';
        $this->classes_100perc_fields['span_select'] = '';
        $this->classes_100perc_fields['style_category'] = '';
        $this->classes_100perc_fields['keep_field_size'] = true;



      $_SESSION['scriptcase']['error_icon']['AlmoxarifadoEntrada_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['AlmoxarifadoEntrada_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "AlmoxarifadoEntrada_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['nomereferencia_ul_name']) && '' != $this->NM_ajax_info['param']['nomereferencia_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->NM_ajax_info['param']['nomereferencia_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_scfile_name = substr($this->NM_ajax_info['param']['nomereferencia_ul_name'], 12);
          $this->nomereferencia_scfile_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
          $this->nomereferencia_ul_name = $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_ul_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
      }
      elseif (isset($this->nomereferencia_ul_name) && '' != $this->nomereferencia_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->nomereferencia_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->nomereferencia_ul_name;
          $this->nomereferencia_scfile_name = substr($this->nomereferencia_ul_name, 12);
          $this->nomereferencia_scfile_type = $this->nomereferencia_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "on";
      $this->nmgp_botoes['first'] = "off";
      $this->nmgp_botoes['back'] = "off";
      $this->nmgp_botoes['forward'] = "off";
      $this->nmgp_botoes['last'] = "off";
      $this->nmgp_botoes['summary'] = "off";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_orig'] = " where (IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_pesq'] = " where (IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')";
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntrada_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['AlmoxarifadoEntrada_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['AlmoxarifadoEntrada_Frm'];

              if (!$tmpDashboardButtons['form_navigate']) { 
                  $this->nmgp_botoes['first']   = 'off';
                  $this->nmgp_botoes['back']    = 'off';
                  $this->nmgp_botoes['last']    = 'off';
                  $this->nmgp_botoes['forward'] = 'off';
              }
              if (!$tmpDashboardButtons['form_update'])    { $this->nmgp_botoes['update']    = 'off';}
              if (!$tmpDashboardButtons['form_insert'])    { $this->nmgp_botoes['new']       = 'off';}
              if (!$tmpDashboardButtons['form_insert'])    { $this->nmgp_botoes['insert']    = 'off';}
              if (!$tmpDashboardButtons['form_delete'])    { $this->nmgp_botoes['delete']    = 'off';}
              if (!$tmpDashboardButtons['form_copy'])      { $this->nmgp_botoes['copy']      = 'off';}
              if (!$tmpDashboardButtons['form_navpage'])   { $this->nmgp_botoes['navpage']   = 'off';}
              if (!$tmpDashboardButtons['form_goto'])      { $this->nmgp_botoes['goto']      = 'off';}
              if (!$tmpDashboardButtons['form_lineqty'])   { $this->nmgp_botoes['qtline']    = 'off';}
              if (!$tmpDashboardButtons['form_summary'])   { $this->nmgp_botoes['summary']   = 'off';}
              if (!$tmpDashboardButtons['form_qsearch'])   { $this->nmgp_botoes['qsearch']   = 'off';}
              if (!$tmpDashboardButtons['form_dynsearch']) { $this->nmgp_botoes['dynsearch'] = 'off';}
              if (!$tmpDashboardButtons['form_reload'])    { $this->nmgp_botoes['reload']    = 'off';}
          }
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("AlmoxarifadoEntrada_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                      $this->Ini->Nm_lang['lang_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_mnth_june'],
                                      $this->Ini->Nm_lang['lang_mnth_july'],
                                      $this->Ini->Nm_lang['lang_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                      $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                      $this->Ini->Nm_lang['lang_days_sund'],
                                      $this->Ini->Nm_lang['lang_days_mond'],
                                      $this->Ini->Nm_lang['lang_days_tued'],
                                      $this->Ini->Nm_lang['lang_days_wend'],
                                      $this->Ini->Nm_lang['lang_days_thud'],
                                      $this->Ini->Nm_lang['lang_days_frid'],
                                      $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                      $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                      $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                      $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                      $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                      $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                      $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                      $this->Ini->Nm_lang['lang_shrt_days_satd']);
      nm_gc($this->Ini->path_libs);
      $this->Ini->Gd_missing  = true;
      if(function_exists("getProdVersion"))
      {
         $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
         if(function_exists("gd_info"))
         {
            $this->Ini->Gd_missing = false;
         }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      if (isset($_GET['nm_cal_display']))
      {
          if ($this->Embutida_proc)
          { 
              include_once($this->Ini->path_embutida . 'AlmoxarifadoEntrada_Frm/AlmoxarifadoEntrada_Frm_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'AlmoxarifadoEntrada_Frm_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'AlmoxarifadoEntrada_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'AlmoxarifadoEntrada_Frm_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('form:' == substr($str_link_webhelp, 0, 5))
                  {
                      $arr_link_parts = explode(':', $str_link_webhelp);
                      if ('' != $arr_link_parts[1] && is_file($this->Ini->root . $this->Ini->path_help . $arr_link_parts[1]))
                      {
                          $this->url_webhelp = $this->Ini->path_help . $arr_link_parts[1];
                      }
                  }
              }
          }
      }

      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }

      if ($this->Embutida_proc)
      { 
          require_once($this->Ini->path_embutida . 'AlmoxarifadoEntrada_Frm/AlmoxarifadoEntrada_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "AlmoxarifadoEntrada_Frm_erro.class.php"); 
      }
      $this->Erro      = new AlmoxarifadoEntrada_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao']))
         { 
             if ($this->idalmoxarifadoentrada != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntrada_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      if ($this->nmgp_opcao == "excluir")
      {
          $GLOBALS['script_case_init'] = $this->Ini->sc_page;
      }
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }
                $sc_obj_img->setManterAspecto(true);
            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($this->idalmoxarifadoentrada)) { $this->nm_limpa_alfa($this->idalmoxarifadoentrada); }
      if (isset($this->idtenacidade)) { $this->nm_limpa_alfa($this->idtenacidade); }
      if (isset($this->idfornecedor)) { $this->nm_limpa_alfa($this->idfornecedor); }
      if (isset($this->idalmoxarifado)) { $this->nm_limpa_alfa($this->idalmoxarifado); }
      if (isset($this->idusuarioauditoria)) { $this->nm_limpa_alfa($this->idusuarioauditoria); }
      if (isset($this->cnpj)) { $this->nm_limpa_alfa($this->cnpj); }
      if (isset($this->razaosocial)) { $this->nm_limpa_alfa($this->razaosocial); }
      if (isset($this->nomefantasia)) { $this->nm_limpa_alfa($this->nomefantasia); }
      if (isset($this->versao)) { $this->nm_limpa_alfa($this->versao); }
      if (isset($this->codigo)) { $this->nm_limpa_alfa($this->codigo); }
      if (isset($this->chave)) { $this->nm_limpa_alfa($this->chave); }
      if (isset($this->numeronota)) { $this->nm_limpa_alfa($this->numeronota); }
      if (isset($this->numerofatura)) { $this->nm_limpa_alfa($this->numerofatura); }
      if (isset($this->natureza)) { $this->nm_limpa_alfa($this->natureza); }
      if (isset($this->serie)) { $this->nm_limpa_alfa($this->serie); }
      if (isset($this->valortotal)) { $this->nm_limpa_alfa($this->valortotal); }
      if (isset($this->valordesconto)) { $this->nm_limpa_alfa($this->valordesconto); }
      if (isset($this->valorliquido)) { $this->nm_limpa_alfa($this->valorliquido); }
      if (isset($this->valorcofins)) { $this->nm_limpa_alfa($this->valorcofins); }
      if (isset($this->valorpis)) { $this->nm_limpa_alfa($this->valorpis); }
      if (isset($this->valoricms)) { $this->nm_limpa_alfa($this->valoricms); }
      if (isset($this->valorfrete)) { $this->nm_limpa_alfa($this->valorfrete); }
      if (isset($this->qtdprodutos)) { $this->nm_limpa_alfa($this->qtdprodutos); }
      if (isset($this->qtdparcelas)) { $this->nm_limpa_alfa($this->qtdparcelas); }
      if (isset($this->nomearquivo)) { $this->nm_limpa_alfa($this->nomearquivo); }
      if (isset($this->observacoes)) { $this->nm_limpa_alfa($this->observacoes); }
      if (isset($this->enderecoipauditoria)) { $this->nm_limpa_alfa($this->enderecoipauditoria); }
      if (isset($this->nomeaplicacaoauditoria)) { $this->nm_limpa_alfa($this->nomeaplicacaoauditoria); }
      if (isset($this->parcela)) { $this->nm_limpa_alfa($this->parcela); }
      if (isset($this->produto)) { $this->nm_limpa_alfa($this->produto); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "AlmoxarifadoEntrada_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- datahorainclusao
      $this->field_config['datahorainclusao']                 = array();
      $this->field_config['datahorainclusao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datahorainclusao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datahorainclusao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datahorainclusao']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'datahorainclusao');
      //-- idalmoxarifadoentrada
      $this->field_config['idalmoxarifadoentrada']               = array();
      $this->field_config['idalmoxarifadoentrada']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idalmoxarifadoentrada']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idalmoxarifadoentrada']['symbol_dec'] = '';
      $this->field_config['idalmoxarifadoentrada']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idalmoxarifadoentrada']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- datahoraemissao
      $this->field_config['datahoraemissao']                 = array();
      $this->field_config['datahoraemissao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datahoraemissao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datahoraemissao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datahoraemissao']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'datahoraemissao');
      //-- valorcofins
      $this->field_config['valorcofins']               = array();
      $this->field_config['valorcofins']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorcofins']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorcofins']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorcofins']['symbol_mon'] = '';
      $this->field_config['valorcofins']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorcofins']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorpis
      $this->field_config['valorpis']               = array();
      $this->field_config['valorpis']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorpis']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorpis']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorpis']['symbol_mon'] = '';
      $this->field_config['valorpis']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorpis']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valoricms
      $this->field_config['valoricms']               = array();
      $this->field_config['valoricms']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valoricms']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valoricms']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valoricms']['symbol_mon'] = '';
      $this->field_config['valoricms']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valoricms']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorfrete
      $this->field_config['valorfrete']               = array();
      $this->field_config['valorfrete']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorfrete']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorfrete']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorfrete']['symbol_mon'] = '';
      $this->field_config['valorfrete']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorfrete']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valortotal
      $this->field_config['valortotal']               = array();
      $this->field_config['valortotal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valortotal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valortotal']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valortotal']['symbol_mon'] = '';
      $this->field_config['valortotal']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valortotal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorliquido
      $this->field_config['valorliquido']               = array();
      $this->field_config['valorliquido']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorliquido']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorliquido']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorliquido']['symbol_mon'] = '';
      $this->field_config['valorliquido']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorliquido']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valordesconto
      $this->field_config['valordesconto']               = array();
      $this->field_config['valordesconto']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valordesconto']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valordesconto']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valordesconto']['symbol_mon'] = '';
      $this->field_config['valordesconto']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valordesconto']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- qtdparcelas
      $this->field_config['qtdparcelas']               = array();
      $this->field_config['qtdparcelas']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qtdparcelas']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qtdparcelas']['symbol_dec'] = '';
      $this->field_config['qtdparcelas']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qtdparcelas']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- qtdprodutos
      $this->field_config['qtdprodutos']               = array();
      $this->field_config['qtdprodutos']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qtdprodutos']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qtdprodutos']['symbol_dec'] = '';
      $this->field_config['qtdprodutos']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qtdprodutos']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();

      if ('' != $_SESSION['scriptcase']['change_regional_old'])
      {
          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_old'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $this->nm_tira_formatacao();

          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_new'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $guarda_formatado = $this->formatado;
          $this->nm_formatar_campos();
          $this->formatado = $guarda_formatado;

          $_SESSION['scriptcase']['change_regional_old'] = '';
          $_SESSION['scriptcase']['change_regional_new'] = '';
      }

      if ($nm_form_submit == 1 && ($this->nmgp_opcao == 'inicio' || $this->nmgp_opcao == 'igual'))
      {
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->idalmoxarifado = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_form']['idalmoxarifado'];
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_idfornecedor' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idfornecedor');
          }
          if ('validate_cnpj' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cnpj');
          }
          if ('validate_datahorainclusao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datahorainclusao');
          }
          if ('validate_idalmoxarifadoentrada' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifadoentrada');
          }
          if ('validate_razaosocial' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'razaosocial');
          }
          if ('validate_nomefantasia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomefantasia');
          }
          if ('validate_idalmoxarifado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifado');
          }
          if ('validate_nomearquivo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomearquivo');
          }
          if ('validate_nomereferencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomereferencia');
          }
          if ('validate_datahoraemissao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datahoraemissao');
          }
          if ('validate_versao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'versao');
          }
          if ('validate_chave' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'chave');
          }
          if ('validate_codigo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'codigo');
          }
          if ('validate_numeronota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'numeronota');
          }
          if ('validate_natureza' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'natureza');
          }
          if ('validate_serie' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'serie');
          }
          if ('validate_valorcofins' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorcofins');
          }
          if ('validate_valorpis' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorpis');
          }
          if ('validate_valoricms' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valoricms');
          }
          if ('validate_valorfrete' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorfrete');
          }
          if ('validate_valortotal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valortotal');
          }
          if ('validate_valorliquido' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorliquido');
          }
          if ('validate_valordesconto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valordesconto');
          }
          if ('validate_produto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'produto');
          }
          if ('validate_parcela' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'parcela');
          }
          if ('validate_observacoes' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'observacoes');
          }
          if ('validate_qtdparcelas' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qtdparcelas');
          }
          if ('validate_qtdprodutos' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qtdprodutos');
          }
          if ('validate_numerofatura' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'numerofatura');
          }
          if ('validate_idtenacidade' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtenacidade');
          }
          if ('validate_idusuarioauditoria' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idusuarioauditoria');
          }
          if ('validate_enderecoipauditoria' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'enderecoipauditoria');
          }
          if ('validate_nomeaplicacaoauditoria' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomeaplicacaoauditoria');
          }
          AlmoxarifadoEntrada_Frm_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_idfornecedor_onclick' == $this->NM_ajax_opcao)
          {
              $this->IdFornecedor_onClick();
          }
          AlmoxarifadoEntrada_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_select']['idalmoxarifado']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idalmoxarifado = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_select']['idalmoxarifado'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              AlmoxarifadoEntrada_Frm_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          if ($this->nmgp_opcao != "incluir")
          {
              $this->scFormFocusErrorName = '';
          }
          $_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  AlmoxarifadoEntrada_Frm_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, 4);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro, '', true, true); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir" && $nm_apl_dependente == 1) 
              { 
                  $this->nm_flag_saida_novo = "S";; 
              }
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
      elseif (isset($nm_form_submit) && 1 == $nm_form_submit && $this->nmgp_opcao != "menu_link" && $this->nmgp_opcao != "recarga_mobile")
      {
      }
//
      if ($this->nmgp_opcao != "nada")
      {
          $this->nm_acessa_banco();
      }
      else
      {
           if ($this->nmgp_opc_ant == "incluir") 
           { 
               $this->nm_proc_onload(false);
           }
           else
           { 
              $this->nm_guardar_campos();
           }
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_evento == "update")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_evento == "delete")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          AlmoxarifadoEntrada_Frm_pack_ajax_response();
          exit;
      }
      $this->nm_formatar_campos();
      if ($this->NM_ajax_flag)
      {
          $this->NM_ajax_info['result'] = 'OK';
          if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'])
          {
              $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
          }
          AlmoxarifadoEntrada_Frm_pack_ajax_response();
          exit;
      }
      $this->nm_gera_html();
      $this->NM_close_db(); 
      $this->nmgp_opcao = ""; 
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     if (parent.writeFastMenu)
     {
         parent.writeFastMenu(link_atual);
     }
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     if (parent.clearFastMenu)
     {
        parent.clearFastMenu();
     }
  </script>
<?php
          }
      }
   }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "AlmoxarifadoEntrada_Frm.zip";
          $Arq_htm = $this->Ini->path_imag_temp . "/" . $Zip_name;
          $Arq_zip = $this->Ini->root . $Arq_htm;
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($Arq_base, ' ')) ? " \"" . $Arq_base . "\"" :  $Arq_base;
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Html_password . " " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
           {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                }
                else
                {
                    chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                }
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           if (!empty($str_zip)) {
               exec($str_zip);
           }
           // ----- ZIP log
           $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
           if ($fp)
           {
               @fwrite($fp, $str_zip . "\r\n\r\n");
               @fclose($fp);
           }
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
               $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
               if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
               {
                   $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Html_password . " " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               if (!empty($str_zip)) {
                   exec($str_zip);
               }
               // ----- ZIP log
               $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
               if ($fp)
               {
                   @fwrite($fp, $str_zip . "\r\n\r\n");
                   @fclose($fp);
               }
           }
           if (is_file($Arq_zip)) {
               unlink($Arq_base);
           } 
          $path_doc_md5 = md5($Arq_htm);
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Entrada Almoxarifado") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Pragma" content="no-cache"/>
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" /> 
  <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</HEAD>
<BODY class="scExportPage">
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: top">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">PRINT</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
   <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo  $this->form_encode_input($Arq_htm) ?>" target="_self" style="display: none"> 
</form>
<form name="Fdown" method="get" action="AlmoxarifadoEntrada_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="AlmoxarifadoEntrada_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="AlmoxarifadoEntrada_Frm.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nmgp_opcao" value="<?php echo $this->nmgp_opcao ?>"> 
</form> 
         </BODY>
         </HTML>
<?php
          exit;
  }
//
//--------------------------------------------------------------------------------------
   function NM_has_trans()
   {
       return !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access);
   }
//
//--------------------------------------------------------------------------------------
   function NM_commit_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->CommitTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_rollback_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->RollbackTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_close_db()
   {
       if ($this->Db && !$this->Embutida_proc)
       { 
           $this->Db->Close(); 
       } 
   }
//
//--------------------------------------------------------------------------------------
   function Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, $mode = 3) 
   {
       switch ($mode)
       {
           case 1:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 2:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta, true);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 3:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;

           case 4:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros_SweetAlert($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;
       }
   }

   function Formata_Campos_Falta($Campos_Falta, $table = false) 
   {
       $Campos_Falta = array_unique($Campos_Falta);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_reqd'] . ' ' . implode('; ', $Campos_Falta);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Falta);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Falta as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_reqd'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Crit($Campos_Crit, $table = false) 
   {
       $Campos_Crit = array_unique($Campos_Crit);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . implode('; ', $Campos_Crit);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Crit);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Crit as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_flds'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros($Campos_Erros) 
   {
       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= '<tr>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Recupera_Nome_Campo($campo) . ':</td>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', array_unique($erros)) . '</td>';
           $sError .= '</tr>';
       }

       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros_SweetAlert($Campos_Erros) 
   {
       $sError  = '';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= $this->Recupera_Nome_Campo($campo) . ': ' . implode('<br />', array_unique($erros)) . '<br />';
       }

       return $sError;
   }

   function Recupera_Nome_Campo($campo) 
   {
       switch($campo)
       {
           case 'idfornecedor':
               return "Fornecedor";
               break;
           case 'cnpj':
               return "CNPJ";
               break;
           case 'datahorainclusao':
               return "Nota fiscal importada em";
               break;
           case 'idalmoxarifadoentrada':
               return "Id.";
               break;
           case 'razaosocial':
               return "Razão social";
               break;
           case 'nomefantasia':
               return "Nome fantasia";
               break;
           case 'idalmoxarifado':
               return "Empresa/Almoxarifado";
               break;
           case 'nomearquivo':
               return "Nome Arquivo";
               break;
           case 'nomereferencia':
               return "Arquivo";
               break;
           case 'datahoraemissao':
               return "Nota fiscal emitida em";
               break;
           case 'versao':
               return "Nota fiscal versão";
               break;
           case 'chave':
               return "Nota fiscal chave";
               break;
           case 'codigo':
               return "Nota fiscal código";
               break;
           case 'numeronota':
               return "Número nota fiscal";
               break;
           case 'natureza':
               return "Nota fiscal natureza";
               break;
           case 'serie':
               return "Nota fiscal série";
               break;
           case 'valorcofins':
               return "Valor COFINS";
               break;
           case 'valorpis':
               return "Valor PIS";
               break;
           case 'valoricms':
               return "Valor ICMS";
               break;
           case 'valorfrete':
               return "Valor frete";
               break;
           case 'valortotal':
               return "Valor total";
               break;
           case 'valorliquido':
               return "Valor líquido";
               break;
           case 'valordesconto':
               return "Valor desconto";
               break;
           case 'produto':
               return "Produtos";
               break;
           case 'parcela':
               return "Parcelas";
               break;
           case 'observacoes':
               return "Observações";
               break;
           case 'qtdparcelas':
               return "Qtd Parcelas";
               break;
           case 'qtdprodutos':
               return "Qtd Produtos";
               break;
           case 'numerofatura':
               return "Número fatura";
               break;
           case 'idtenacidade':
               return "Tenacidade";
               break;
           case 'idusuarioauditoria':
               return "Usuário";
               break;
           case 'enderecoipauditoria':
               return "Endereço IP";
               break;
           case 'nomeaplicacaoauditoria':
               return "Nome Aplicação";
               break;
       }

       return $campo;
   }

   function dateDefaultFormat()
   {
       if (isset($this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']))
       {
           $sDate = str_replace('yyyy', 'Y', $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']);
           $sDate = str_replace('mm',   'm', $sDate);
           $sDate = str_replace('dd',   'd', $sDate);
           return substr(chunk_split($sDate, 1, $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_sep']), 0, -1);
       }
       elseif ('en_us' == $this->Ini->str_lang)
       {
           return 'm/d/Y';
       }
       else
       {
           return 'd/m/Y';
       }
   } // dateDefaultFormat

//
//--------------------------------------------------------------------------------------
   function Valida_campos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser, $teste_validade;
     if (is_array($filtro) && empty($filtro)) {
         $filtro = '';
     }
//---------------------------------------------------------
     $this->scFormFocusErrorName = '';
     $this->sc_force_zero = array();

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_AlmoxarifadoEntrada_Frm']) || !is_array($this->NM_ajax_info['errList']['geral_AlmoxarifadoEntrada_Frm']))
              {
                  $this->NM_ajax_info['errList']['geral_AlmoxarifadoEntrada_Frm'] = array();
              }
              $this->NM_ajax_info['errList']['geral_AlmoxarifadoEntrada_Frm'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'idfornecedor' == $filtro)) || (is_array($filtro) && in_array('idfornecedor', $filtro)))
        $this->ValidateField_idfornecedor($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idfornecedor";

      if ((!is_array($filtro) && ('' == $filtro || 'cnpj' == $filtro)) || (is_array($filtro) && in_array('cnpj', $filtro)))
        $this->ValidateField_cnpj($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "cnpj";

      if ((!is_array($filtro) && ('' == $filtro || 'datahorainclusao' == $filtro)) || (is_array($filtro) && in_array('datahorainclusao', $filtro)))
        $this->ValidateField_datahorainclusao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "datahorainclusao";

      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifadoentrada' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifadoentrada', $filtro)))
        $this->ValidateField_idalmoxarifadoentrada($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idalmoxarifadoentrada";

      if ((!is_array($filtro) && ('' == $filtro || 'razaosocial' == $filtro)) || (is_array($filtro) && in_array('razaosocial', $filtro)))
        $this->ValidateField_razaosocial($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "razaosocial";

      if ((!is_array($filtro) && ('' == $filtro || 'nomefantasia' == $filtro)) || (is_array($filtro) && in_array('nomefantasia', $filtro)))
        $this->ValidateField_nomefantasia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "nomefantasia";

      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifado' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifado', $filtro)))
        $this->ValidateField_idalmoxarifado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idalmoxarifado";

      if ((!is_array($filtro) && ('' == $filtro || 'nomearquivo' == $filtro)) || (is_array($filtro) && in_array('nomearquivo', $filtro)))
        $this->ValidateField_nomearquivo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "nomearquivo";

      if ((!is_array($filtro) && ('' == $filtro || 'nomereferencia' == $filtro)) || (is_array($filtro) && in_array('nomereferencia', $filtro)))
        $this->ValidateField_nomereferencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "nomereferencia";

      if ((!is_array($filtro) && ('' == $filtro || 'datahoraemissao' == $filtro)) || (is_array($filtro) && in_array('datahoraemissao', $filtro)))
        $this->ValidateField_datahoraemissao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "datahoraemissao";

      if ((!is_array($filtro) && ('' == $filtro || 'versao' == $filtro)) || (is_array($filtro) && in_array('versao', $filtro)))
        $this->ValidateField_versao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "versao";

      if ((!is_array($filtro) && ('' == $filtro || 'chave' == $filtro)) || (is_array($filtro) && in_array('chave', $filtro)))
        $this->ValidateField_chave($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "chave";

      if ((!is_array($filtro) && ('' == $filtro || 'codigo' == $filtro)) || (is_array($filtro) && in_array('codigo', $filtro)))
        $this->ValidateField_codigo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "codigo";

      if ((!is_array($filtro) && ('' == $filtro || 'numeronota' == $filtro)) || (is_array($filtro) && in_array('numeronota', $filtro)))
        $this->ValidateField_numeronota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "numeronota";

      if ((!is_array($filtro) && ('' == $filtro || 'natureza' == $filtro)) || (is_array($filtro) && in_array('natureza', $filtro)))
        $this->ValidateField_natureza($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "natureza";

      if ((!is_array($filtro) && ('' == $filtro || 'serie' == $filtro)) || (is_array($filtro) && in_array('serie', $filtro)))
        $this->ValidateField_serie($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "serie";

      if ((!is_array($filtro) && ('' == $filtro || 'valorcofins' == $filtro)) || (is_array($filtro) && in_array('valorcofins', $filtro)))
        $this->ValidateField_valorcofins($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valorcofins";

      if ((!is_array($filtro) && ('' == $filtro || 'valorpis' == $filtro)) || (is_array($filtro) && in_array('valorpis', $filtro)))
        $this->ValidateField_valorpis($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valorpis";

      if ((!is_array($filtro) && ('' == $filtro || 'valoricms' == $filtro)) || (is_array($filtro) && in_array('valoricms', $filtro)))
        $this->ValidateField_valoricms($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valoricms";

      if ((!is_array($filtro) && ('' == $filtro || 'valorfrete' == $filtro)) || (is_array($filtro) && in_array('valorfrete', $filtro)))
        $this->ValidateField_valorfrete($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valorfrete";

      if ((!is_array($filtro) && ('' == $filtro || 'valortotal' == $filtro)) || (is_array($filtro) && in_array('valortotal', $filtro)))
        $this->ValidateField_valortotal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valortotal";

      if ((!is_array($filtro) && ('' == $filtro || 'valorliquido' == $filtro)) || (is_array($filtro) && in_array('valorliquido', $filtro)))
        $this->ValidateField_valorliquido($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valorliquido";

      if ((!is_array($filtro) && ('' == $filtro || 'valordesconto' == $filtro)) || (is_array($filtro) && in_array('valordesconto', $filtro)))
        $this->ValidateField_valordesconto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valordesconto";

      if ((!is_array($filtro) && ('' == $filtro || 'produto' == $filtro)) || (is_array($filtro) && in_array('produto', $filtro)))
        $this->ValidateField_produto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "produto";

      if ((!is_array($filtro) && ('' == $filtro || 'parcela' == $filtro)) || (is_array($filtro) && in_array('parcela', $filtro)))
        $this->ValidateField_parcela($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "parcela";

      if ((!is_array($filtro) && ('' == $filtro || 'observacoes' == $filtro)) || (is_array($filtro) && in_array('observacoes', $filtro)))
        $this->ValidateField_observacoes($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "observacoes";

      if ((!is_array($filtro) && ('' == $filtro || 'qtdparcelas' == $filtro)) || (is_array($filtro) && in_array('qtdparcelas', $filtro)))
        $this->ValidateField_qtdparcelas($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "qtdparcelas";

      if ((!is_array($filtro) && ('' == $filtro || 'qtdprodutos' == $filtro)) || (is_array($filtro) && in_array('qtdprodutos', $filtro)))
        $this->ValidateField_qtdprodutos($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "qtdprodutos";

      if ((!is_array($filtro) && ('' == $filtro || 'numerofatura' == $filtro)) || (is_array($filtro) && in_array('numerofatura', $filtro)))
        $this->ValidateField_numerofatura($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "numerofatura";

      if ((!is_array($filtro) && ('' == $filtro || 'idtenacidade' == $filtro)) || (is_array($filtro) && in_array('idtenacidade', $filtro)))
        $this->ValidateField_idtenacidade($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idtenacidade";

      if ((!is_array($filtro) && ('' == $filtro || 'idusuarioauditoria' == $filtro)) || (is_array($filtro) && in_array('idusuarioauditoria', $filtro)))
        $this->ValidateField_idusuarioauditoria($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idusuarioauditoria";

      if ((!is_array($filtro) && ('' == $filtro || 'enderecoipauditoria' == $filtro)) || (is_array($filtro) && in_array('enderecoipauditoria', $filtro)))
        $this->ValidateField_enderecoipauditoria($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "enderecoipauditoria";

      if ((!is_array($filtro) && ('' == $filtro || 'nomeaplicacaoauditoria' == $filtro)) || (is_array($filtro) && in_array('nomeaplicacaoauditoria', $filtro)))
        $this->ValidateField_nomeaplicacaoauditoria($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "nomeaplicacaoauditoria";

      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---
      if (!empty($Campos_Crit) || !empty($Campos_Falta) || !empty($this->Campos_Mens_erro))
      {
          if (!empty($this->sc_force_zero))
          {
              foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
              {
                  eval('$this->' . $sc_force_zero_field . ' = "";');
                  unset($this->sc_force_zero[$i_force_zero]);
              }
          }
      }
   }

    function ValidateField_idfornecedor(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idfornecedor'])) {
       return;
   }
   if ($this->nmgp_opcao == "incluir")
   {
      if ($this->idfornecedor == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['idfornecedor']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['idfornecedor'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Fornecedor" ; 
          if (!isset($Campos_Erros['idfornecedor']))
          {
              $Campos_Erros['idfornecedor'] = array();
          }
          $Campos_Erros['idfornecedor'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idfornecedor']) || !is_array($this->NM_ajax_info['errList']['idfornecedor']))
          {
              $this->NM_ajax_info['errList']['idfornecedor'] = array();
          }
          $this->NM_ajax_info['errList']['idfornecedor'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idfornecedor) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']) && !in_array($this->idfornecedor, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idfornecedor']))
              {
                  $Campos_Erros['idfornecedor'] = array();
              }
              $Campos_Erros['idfornecedor'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idfornecedor']) || !is_array($this->NM_ajax_info['errList']['idfornecedor']))
              {
                  $this->NM_ajax_info['errList']['idfornecedor'] = array();
              }
              $this->NM_ajax_info['errList']['idfornecedor'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idfornecedor';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idfornecedor

    function ValidateField_cnpj(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_ciccnpj($this->cnpj) ; 
      if (isset($this->Field_no_validate['cnpj'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_cnpj' == $this->NM_ajax_opcao)
      { 
          if (trim($this->cnpj) != "")  
          { 
              if ($teste_validade->CNPJ($this->cnpj) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "CNPJ; " ; 
                  if (!isset($Campos_Erros['cnpj']))
                  {
                      $Campos_Erros['cnpj'] = array();
                  }
                  $Campos_Erros['cnpj'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['cnpj']) || !is_array($this->NM_ajax_info['errList']['cnpj']))
                  {
                      $this->NM_ajax_info['errList']['cnpj'] = array();
                  }
                  $this->NM_ajax_info['errList']['cnpj'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cnpj';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cnpj

    function ValidateField_datahorainclusao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datahorainclusao, $this->field_config['datahorainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datahorainclusao_hora, $this->field_config['datahorainclusao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datahorainclusao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao == "incluir" || 'validate_datahorainclusao' == $this->NM_ajax_opcao)
      { 
          $guarda_datahora = $this->field_config['datahorainclusao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datahorainclusao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datahorainclusao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datahorainclusao']['date_sep']) ; 
          $Format_Hora = $this->field_config['datahorainclusao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datahorainclusao_hora']['time_sep']) ; 
          if (trim($this->datahorainclusao) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->datahorainclusao, $Format_Data, $this->datahorainclusao_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->datahorainclusao_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->datahorainclusao, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->datahorainclusao, $Format_Data, $this->datahorainclusao_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->datahorainclusao_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->datahorainclusao, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nota fiscal importada em; " ; 
                  if (!isset($Campos_Erros['datahorainclusao']))
                  {
                      $Campos_Erros['datahorainclusao'] = array();
                  }
                  $Campos_Erros['datahorainclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datahorainclusao']) || !is_array($this->NM_ajax_info['errList']['datahorainclusao']))
                  {
                      $this->NM_ajax_info['errList']['datahorainclusao'] = array();
                  }
                  $this->NM_ajax_info['errList']['datahorainclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datahorainclusao']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datahorainclusao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->datahorainclusao_hora, $this->field_config['datahorainclusao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datahorainclusao_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao == "incluir")
      {
          $Format_Hora = $this->field_config['datahorainclusao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datahorainclusao_hora']['time_sep']) ; 
          if (trim($this->datahorainclusao_hora) != "")  
          { 
              if ($teste_validade->Hora($this->datahorainclusao_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nota fiscal importada em; " ; 
                  if (!isset($Campos_Erros['datahorainclusao_hora']))
                  {
                      $Campos_Erros['datahorainclusao_hora'] = array();
                  }
                  $Campos_Erros['datahorainclusao_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datahorainclusao']) || !is_array($this->NM_ajax_info['errList']['datahorainclusao']))
                  {
                      $this->NM_ajax_info['errList']['datahorainclusao'] = array();
                  }
                  $this->NM_ajax_info['errList']['datahorainclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
      if (isset($Campos_Erros['datahorainclusao']) && isset($Campos_Erros['datahorainclusao_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['datahorainclusao'], $Campos_Erros['datahorainclusao_hora']);
          if (empty($Campos_Erros['datahorainclusao_hora']))
          {
              unset($Campos_Erros['datahorainclusao_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['datahorainclusao']))
          {
              $this->NM_ajax_info['errList']['datahorainclusao'] = array_unique($this->NM_ajax_info['errList']['datahorainclusao']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datahorainclusao_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datahorainclusao_hora

    function ValidateField_idalmoxarifadoentrada(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idalmoxarifadoentrada'])) {
          nm_limpa_numero($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp']) ; 
          return;
      }
      if ($this->idalmoxarifadoentrada === "" || is_null($this->idalmoxarifadoentrada))  
      { 
          $this->idalmoxarifadoentrada = 0;
      } 
      nm_limpa_numero($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idalmoxarifadoentrada' == $this->NM_ajax_opcao)
      { 
          if ($this->idalmoxarifadoentrada != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idalmoxarifadoentrada) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idalmoxarifadoentrada']))
                  {
                      $Campos_Erros['idalmoxarifadoentrada'] = array();
                  }
                  $Campos_Erros['idalmoxarifadoentrada'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoentrada']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoentrada']))
                  {
                      $this->NM_ajax_info['errList']['idalmoxarifadoentrada'] = array();
                  }
                  $this->NM_ajax_info['errList']['idalmoxarifadoentrada'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idalmoxarifadoentrada, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.; " ; 
                  if (!isset($Campos_Erros['idalmoxarifadoentrada']))
                  {
                      $Campos_Erros['idalmoxarifadoentrada'] = array();
                  }
                  $Campos_Erros['idalmoxarifadoentrada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoentrada']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoentrada']))
                  {
                      $this->NM_ajax_info['errList']['idalmoxarifadoentrada'] = array();
                  }
                  $this->NM_ajax_info['errList']['idalmoxarifadoentrada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idalmoxarifadoentrada';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idalmoxarifadoentrada

    function ValidateField_razaosocial(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['razaosocial'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['razaosocial']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['razaosocial'] == "on")) 
      { 
          if ($this->razaosocial == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Razão social" ; 
              if (!isset($Campos_Erros['razaosocial']))
              {
                  $Campos_Erros['razaosocial'] = array();
              }
              $Campos_Erros['razaosocial'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['razaosocial']) || !is_array($this->NM_ajax_info['errList']['razaosocial']))
                  {
                      $this->NM_ajax_info['errList']['razaosocial'] = array();
                  }
                  $this->NM_ajax_info['errList']['razaosocial'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->razaosocial) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Razão social " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['razaosocial']))
              {
                  $Campos_Erros['razaosocial'] = array();
              }
              $Campos_Erros['razaosocial'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['razaosocial']) || !is_array($this->NM_ajax_info['errList']['razaosocial']))
              {
                  $this->NM_ajax_info['errList']['razaosocial'] = array();
              }
              $this->NM_ajax_info['errList']['razaosocial'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'razaosocial';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_razaosocial

    function ValidateField_nomefantasia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomefantasia'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['nomefantasia']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['nomefantasia'] == "on")) 
      { 
          if ($this->nomefantasia == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Nome fantasia" ; 
              if (!isset($Campos_Erros['nomefantasia']))
              {
                  $Campos_Erros['nomefantasia'] = array();
              }
              $Campos_Erros['nomefantasia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['nomefantasia']) || !is_array($this->NM_ajax_info['errList']['nomefantasia']))
                  {
                      $this->NM_ajax_info['errList']['nomefantasia'] = array();
                  }
                  $this->NM_ajax_info['errList']['nomefantasia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->nomefantasia) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nome fantasia " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['nomefantasia']))
              {
                  $Campos_Erros['nomefantasia'] = array();
              }
              $Campos_Erros['nomefantasia'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['nomefantasia']) || !is_array($this->NM_ajax_info['errList']['nomefantasia']))
              {
                  $this->NM_ajax_info['errList']['nomefantasia'] = array();
              }
              $this->NM_ajax_info['errList']['nomefantasia'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomefantasia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomefantasia

    function ValidateField_idalmoxarifado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idalmoxarifado'])) {
       return;
   }
      if ($this->idalmoxarifado == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['idalmoxarifado']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['idalmoxarifado'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Empresa/Almoxarifado" ; 
          if (!isset($Campos_Erros['idalmoxarifado']))
          {
              $Campos_Erros['idalmoxarifado'] = array();
          }
          $Campos_Erros['idalmoxarifado'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idalmoxarifado']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifado']))
          {
              $this->NM_ajax_info['errList']['idalmoxarifado'] = array();
          }
          $this->NM_ajax_info['errList']['idalmoxarifado'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idalmoxarifado) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']) && !in_array($this->idalmoxarifado, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idalmoxarifado']))
              {
                  $Campos_Erros['idalmoxarifado'] = array();
              }
              $Campos_Erros['idalmoxarifado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idalmoxarifado']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifado']))
              {
                  $this->NM_ajax_info['errList']['idalmoxarifado'] = array();
              }
              $this->NM_ajax_info['errList']['idalmoxarifado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idalmoxarifado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idalmoxarifado

    function ValidateField_nomearquivo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomearquivo'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->nomearquivo) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nome Arquivo " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['nomearquivo']))
              {
                  $Campos_Erros['nomearquivo'] = array();
              }
              $Campos_Erros['nomearquivo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['nomearquivo']) || !is_array($this->NM_ajax_info['errList']['nomearquivo']))
              {
                  $this->NM_ajax_info['errList']['nomearquivo'] = array();
              }
              $this->NM_ajax_info['errList']['nomearquivo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomearquivo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomearquivo

    function ValidateField_nomereferencia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomereferencia'])) {
          return;
      }
        if ($this->nmgp_opcao == "incluir")
        {
            $sTestFile = $this->nomereferencia;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'AlmoxarifadoEntrada_Frm_doc_name.php';
            }
            $this->nomereferencia = sc_upload_unprotect_chars($this->nomereferencia, true);
            $this->nomereferencia_scfile_name = sc_upload_unprotect_chars($this->nomereferencia_scfile_name, true);
            if (strpos($this->nomereferencia, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
                if (!isset($Campos_Erros['nomereferencia']))
                {
                    $Campos_Erros['nomereferencia'] = array();
                }
                $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
                if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                {
                    $this->NM_ajax_info['errList']['nomereferencia'] = array();
                }
                $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
            }
            if ("" != $this->nomereferencia && "S" != $this->nomereferencia_limpa && !$teste_validade->ArqExtensao($this->nomereferencia, array('xml')))
            {
                $hasError = true;
                $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['nomereferencia']))
                {
                    $Campos_Erros['nomereferencia'] = array();
                }
                $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                {
                    $this->NM_ajax_info['errList']['nomereferencia'] = array();
                }
                $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
            if (!$hasError && "" != $this->nomereferencia && "S" != $this->nomereferencia_limpa) {
                if (!function_exists('sc_upload_unprotect_chars')) {
                    include_once 'AlmoxarifadoEntrada_Frm_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ($hasError) {
                    $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($Campos_Erros['nomereferencia']))
                    {
                        $Campos_Erros['nomereferencia'] = array();
                    }
                    $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                    {
                        $this->NM_ajax_info['errList']['nomereferencia'] = array();
                    }
                    $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                }
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomereferencia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomereferencia

    function ValidateField_datahoraemissao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datahoraemissao, $this->field_config['datahoraemissao']['date_sep']) ; 
      nm_limpa_hora($this->datahoraemissao_hora, $this->field_config['datahoraemissao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datahoraemissao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao == "incluir" || 'validate_datahoraemissao' == $this->NM_ajax_opcao)
      { 
          $guarda_datahora = $this->field_config['datahoraemissao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datahoraemissao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datahoraemissao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datahoraemissao']['date_sep']) ; 
          $Format_Hora = $this->field_config['datahoraemissao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datahoraemissao_hora']['time_sep']) ; 
          if (trim($this->datahoraemissao) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->datahoraemissao, $Format_Data, $this->datahoraemissao_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->datahoraemissao_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->datahoraemissao, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->datahoraemissao, $Format_Data, $this->datahoraemissao_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->datahoraemissao_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->datahoraemissao, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nota fiscal emitida em; " ; 
                  if (!isset($Campos_Erros['datahoraemissao']))
                  {
                      $Campos_Erros['datahoraemissao'] = array();
                  }
                  $Campos_Erros['datahoraemissao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datahoraemissao']) || !is_array($this->NM_ajax_info['errList']['datahoraemissao']))
                  {
                      $this->NM_ajax_info['errList']['datahoraemissao'] = array();
                  }
                  $this->NM_ajax_info['errList']['datahoraemissao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datahoraemissao']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datahoraemissao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->datahoraemissao_hora, $this->field_config['datahoraemissao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datahoraemissao_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao == "incluir")
      {
          $Format_Hora = $this->field_config['datahoraemissao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datahoraemissao_hora']['time_sep']) ; 
          if (trim($this->datahoraemissao_hora) != "")  
          { 
              if ($teste_validade->Hora($this->datahoraemissao_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nota fiscal emitida em; " ; 
                  if (!isset($Campos_Erros['datahoraemissao_hora']))
                  {
                      $Campos_Erros['datahoraemissao_hora'] = array();
                  }
                  $Campos_Erros['datahoraemissao_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datahoraemissao']) || !is_array($this->NM_ajax_info['errList']['datahoraemissao']))
                  {
                      $this->NM_ajax_info['errList']['datahoraemissao'] = array();
                  }
                  $this->NM_ajax_info['errList']['datahoraemissao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
      if (isset($Campos_Erros['datahoraemissao']) && isset($Campos_Erros['datahoraemissao_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['datahoraemissao'], $Campos_Erros['datahoraemissao_hora']);
          if (empty($Campos_Erros['datahoraemissao_hora']))
          {
              unset($Campos_Erros['datahoraemissao_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['datahoraemissao']))
          {
              $this->NM_ajax_info['errList']['datahoraemissao'] = array_unique($this->NM_ajax_info['errList']['datahoraemissao']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datahoraemissao_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datahoraemissao_hora

    function ValidateField_versao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['versao'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->versao) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nota fiscal versão " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['versao']))
              {
                  $Campos_Erros['versao'] = array();
              }
              $Campos_Erros['versao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['versao']) || !is_array($this->NM_ajax_info['errList']['versao']))
              {
                  $this->NM_ajax_info['errList']['versao'] = array();
              }
              $this->NM_ajax_info['errList']['versao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'versao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_versao

    function ValidateField_chave(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['chave'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->chave) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nota fiscal chave " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['chave']))
              {
                  $Campos_Erros['chave'] = array();
              }
              $Campos_Erros['chave'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['chave']) || !is_array($this->NM_ajax_info['errList']['chave']))
              {
                  $this->NM_ajax_info['errList']['chave'] = array();
              }
              $this->NM_ajax_info['errList']['chave'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'chave';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_chave

    function ValidateField_codigo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['codigo'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->codigo) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nota fiscal código " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['codigo']))
              {
                  $Campos_Erros['codigo'] = array();
              }
              $Campos_Erros['codigo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['codigo']) || !is_array($this->NM_ajax_info['errList']['codigo']))
              {
                  $this->NM_ajax_info['errList']['codigo'] = array();
              }
              $this->NM_ajax_info['errList']['codigo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'codigo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_codigo

    function ValidateField_numeronota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['numeronota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->numeronota) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Número nota fiscal " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['numeronota']))
              {
                  $Campos_Erros['numeronota'] = array();
              }
              $Campos_Erros['numeronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['numeronota']) || !is_array($this->NM_ajax_info['errList']['numeronota']))
              {
                  $this->NM_ajax_info['errList']['numeronota'] = array();
              }
              $this->NM_ajax_info['errList']['numeronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'numeronota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_numeronota

    function ValidateField_natureza(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['natureza'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->natureza) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nota fiscal natureza " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['natureza']))
              {
                  $Campos_Erros['natureza'] = array();
              }
              $Campos_Erros['natureza'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['natureza']) || !is_array($this->NM_ajax_info['errList']['natureza']))
              {
                  $this->NM_ajax_info['errList']['natureza'] = array();
              }
              $this->NM_ajax_info['errList']['natureza'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'natureza';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_natureza

    function ValidateField_serie(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['serie'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->serie) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nota fiscal série " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['serie']))
              {
                  $Campos_Erros['serie'] = array();
              }
              $Campos_Erros['serie'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['serie']) || !is_array($this->NM_ajax_info['errList']['serie']))
              {
                  $this->NM_ajax_info['errList']['serie'] = array();
              }
              $this->NM_ajax_info['errList']['serie'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'serie';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_serie

    function ValidateField_valorcofins(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorcofins'])) {
          if (!empty($this->field_config['valorcofins']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp'], $this->field_config['valorcofins']['symbol_mon']); 
              nm_limpa_valor($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorcofins === "" || is_null($this->valorcofins))  
      { 
          $this->valorcofins = 0;
          $this->sc_force_zero[] = 'valorcofins';
      } 
      }
      if (!empty($this->field_config['valorcofins']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp'], $this->field_config['valorcofins']['symbol_mon']); 
          nm_limpa_valor($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp']) ; 
          if ('.' == substr($this->valorcofins, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorcofins, 1)))
              {
                  $this->valorcofins = '';
              }
              else
              {
                  $this->valorcofins = '0' . $this->valorcofins;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valorcofins' == $this->NM_ajax_opcao)
      { 
          if ($this->valorcofins != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valorcofins) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor COFINS: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorcofins']))
                  {
                      $Campos_Erros['valorcofins'] = array();
                  }
                  $Campos_Erros['valorcofins'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorcofins']) || !is_array($this->NM_ajax_info['errList']['valorcofins']))
                  {
                      $this->NM_ajax_info['errList']['valorcofins'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorcofins'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorcofins, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor COFINS; " ; 
                  if (!isset($Campos_Erros['valorcofins']))
                  {
                      $Campos_Erros['valorcofins'] = array();
                  }
                  $Campos_Erros['valorcofins'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorcofins']) || !is_array($this->NM_ajax_info['errList']['valorcofins']))
                  {
                      $this->NM_ajax_info['errList']['valorcofins'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorcofins'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorcofins';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorcofins

    function ValidateField_valorpis(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorpis'])) {
          if (!empty($this->field_config['valorpis']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp'], $this->field_config['valorpis']['symbol_mon']); 
              nm_limpa_valor($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorpis === "" || is_null($this->valorpis))  
      { 
          $this->valorpis = 0;
          $this->sc_force_zero[] = 'valorpis';
      } 
      }
      if (!empty($this->field_config['valorpis']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp'], $this->field_config['valorpis']['symbol_mon']); 
          nm_limpa_valor($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp']) ; 
          if ('.' == substr($this->valorpis, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorpis, 1)))
              {
                  $this->valorpis = '';
              }
              else
              {
                  $this->valorpis = '0' . $this->valorpis;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valorpis' == $this->NM_ajax_opcao)
      { 
          if ($this->valorpis != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valorpis) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor PIS: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorpis']))
                  {
                      $Campos_Erros['valorpis'] = array();
                  }
                  $Campos_Erros['valorpis'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorpis']) || !is_array($this->NM_ajax_info['errList']['valorpis']))
                  {
                      $this->NM_ajax_info['errList']['valorpis'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpis'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorpis, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor PIS; " ; 
                  if (!isset($Campos_Erros['valorpis']))
                  {
                      $Campos_Erros['valorpis'] = array();
                  }
                  $Campos_Erros['valorpis'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorpis']) || !is_array($this->NM_ajax_info['errList']['valorpis']))
                  {
                      $this->NM_ajax_info['errList']['valorpis'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpis'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorpis';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorpis

    function ValidateField_valoricms(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valoricms'])) {
          if (!empty($this->field_config['valoricms']['symbol_dec'])) {
              $this->sc_remove_currency($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp'], $this->field_config['valoricms']['symbol_mon']); 
              nm_limpa_valor($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valoricms === "" || is_null($this->valoricms))  
      { 
          $this->valoricms = 0;
          $this->sc_force_zero[] = 'valoricms';
      } 
      }
      if (!empty($this->field_config['valoricms']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp'], $this->field_config['valoricms']['symbol_mon']); 
          nm_limpa_valor($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp']) ; 
          if ('.' == substr($this->valoricms, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valoricms, 1)))
              {
                  $this->valoricms = '';
              }
              else
              {
                  $this->valoricms = '0' . $this->valoricms;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valoricms' == $this->NM_ajax_opcao)
      { 
          if ($this->valoricms != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valoricms) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor ICMS: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valoricms']))
                  {
                      $Campos_Erros['valoricms'] = array();
                  }
                  $Campos_Erros['valoricms'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valoricms']) || !is_array($this->NM_ajax_info['errList']['valoricms']))
                  {
                      $this->NM_ajax_info['errList']['valoricms'] = array();
                  }
                  $this->NM_ajax_info['errList']['valoricms'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valoricms, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor ICMS; " ; 
                  if (!isset($Campos_Erros['valoricms']))
                  {
                      $Campos_Erros['valoricms'] = array();
                  }
                  $Campos_Erros['valoricms'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valoricms']) || !is_array($this->NM_ajax_info['errList']['valoricms']))
                  {
                      $this->NM_ajax_info['errList']['valoricms'] = array();
                  }
                  $this->NM_ajax_info['errList']['valoricms'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valoricms';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valoricms

    function ValidateField_valorfrete(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorfrete'])) {
          if (!empty($this->field_config['valorfrete']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp'], $this->field_config['valorfrete']['symbol_mon']); 
              nm_limpa_valor($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorfrete === "" || is_null($this->valorfrete))  
      { 
          $this->valorfrete = 0;
          $this->sc_force_zero[] = 'valorfrete';
      } 
      }
      if (!empty($this->field_config['valorfrete']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp'], $this->field_config['valorfrete']['symbol_mon']); 
          nm_limpa_valor($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp']) ; 
          if ('.' == substr($this->valorfrete, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorfrete, 1)))
              {
                  $this->valorfrete = '';
              }
              else
              {
                  $this->valorfrete = '0' . $this->valorfrete;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valorfrete' == $this->NM_ajax_opcao)
      { 
          if ($this->valorfrete != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valorfrete) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor frete: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorfrete']))
                  {
                      $Campos_Erros['valorfrete'] = array();
                  }
                  $Campos_Erros['valorfrete'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorfrete']) || !is_array($this->NM_ajax_info['errList']['valorfrete']))
                  {
                      $this->NM_ajax_info['errList']['valorfrete'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorfrete'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorfrete, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor frete; " ; 
                  if (!isset($Campos_Erros['valorfrete']))
                  {
                      $Campos_Erros['valorfrete'] = array();
                  }
                  $Campos_Erros['valorfrete'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorfrete']) || !is_array($this->NM_ajax_info['errList']['valorfrete']))
                  {
                      $this->NM_ajax_info['errList']['valorfrete'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorfrete'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorfrete';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorfrete

    function ValidateField_valortotal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valortotal'])) {
          if (!empty($this->field_config['valortotal']['symbol_dec'])) {
              $this->sc_remove_currency($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp'], $this->field_config['valortotal']['symbol_mon']); 
              nm_limpa_valor($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp']) ; 
          }
          return;
      }
      if (!empty($this->field_config['valortotal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp'], $this->field_config['valortotal']['symbol_mon']); 
          nm_limpa_valor($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp']) ; 
          if ('.' == substr($this->valortotal, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valortotal, 1)))
              {
                  $this->valortotal = '';
              }
              else
              {
                  $this->valortotal = '0' . $this->valortotal;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valortotal' == $this->NM_ajax_opcao)
      { 
          if ($this->valortotal != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valortotal) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor total: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valortotal']))
                  {
                      $Campos_Erros['valortotal'] = array();
                  }
                  $Campos_Erros['valortotal'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valortotal']) || !is_array($this->NM_ajax_info['errList']['valortotal']))
                  {
                      $this->NM_ajax_info['errList']['valortotal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valortotal'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valortotal, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor total; " ; 
                  if (!isset($Campos_Erros['valortotal']))
                  {
                      $Campos_Erros['valortotal'] = array();
                  }
                  $Campos_Erros['valortotal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valortotal']) || !is_array($this->NM_ajax_info['errList']['valortotal']))
                  {
                      $this->NM_ajax_info['errList']['valortotal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valortotal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['valortotal']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['valortotal'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Valor total" ; 
              if (!isset($Campos_Erros['valortotal']))
              {
                  $Campos_Erros['valortotal'] = array();
              }
              $Campos_Erros['valortotal'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['valortotal']) || !is_array($this->NM_ajax_info['errList']['valortotal']))
                  {
                      $this->NM_ajax_info['errList']['valortotal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valortotal'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valortotal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valortotal

    function ValidateField_valorliquido(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorliquido'])) {
          if (!empty($this->field_config['valorliquido']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']); 
              nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']) ; 
          }
          return;
      }
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']); 
          nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']) ; 
          if ('.' == substr($this->valorliquido, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorliquido, 1)))
              {
                  $this->valorliquido = '';
              }
              else
              {
                  $this->valorliquido = '0' . $this->valorliquido;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valorliquido' == $this->NM_ajax_opcao)
      { 
          if ($this->valorliquido != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valorliquido) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor líquido: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorliquido']))
                  {
                      $Campos_Erros['valorliquido'] = array();
                  }
                  $Campos_Erros['valorliquido'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorliquido']) || !is_array($this->NM_ajax_info['errList']['valorliquido']))
                  {
                      $this->NM_ajax_info['errList']['valorliquido'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorliquido'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorliquido, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor líquido; " ; 
                  if (!isset($Campos_Erros['valorliquido']))
                  {
                      $Campos_Erros['valorliquido'] = array();
                  }
                  $Campos_Erros['valorliquido'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorliquido']) || !is_array($this->NM_ajax_info['errList']['valorliquido']))
                  {
                      $this->NM_ajax_info['errList']['valorliquido'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorliquido'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['valorliquido']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['php_cmp_required']['valorliquido'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Valor líquido" ; 
              if (!isset($Campos_Erros['valorliquido']))
              {
                  $Campos_Erros['valorliquido'] = array();
              }
              $Campos_Erros['valorliquido'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['valorliquido']) || !is_array($this->NM_ajax_info['errList']['valorliquido']))
                  {
                      $this->NM_ajax_info['errList']['valorliquido'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorliquido'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorliquido';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorliquido

    function ValidateField_valordesconto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valordesconto'])) {
          if (!empty($this->field_config['valordesconto']['symbol_dec'])) {
              $this->sc_remove_currency($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_mon']); 
              nm_limpa_valor($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valordesconto === "" || is_null($this->valordesconto))  
      { 
          $this->valordesconto = 0;
          $this->sc_force_zero[] = 'valordesconto';
      } 
      }
      if (!empty($this->field_config['valordesconto']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_mon']); 
          nm_limpa_valor($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp']) ; 
          if ('.' == substr($this->valordesconto, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valordesconto, 1)))
              {
                  $this->valordesconto = '';
              }
              else
              {
                  $this->valordesconto = '0' . $this->valordesconto;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valordesconto' == $this->NM_ajax_opcao)
      { 
          if ($this->valordesconto != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valordesconto) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor desconto: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valordesconto']))
                  {
                      $Campos_Erros['valordesconto'] = array();
                  }
                  $Campos_Erros['valordesconto'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valordesconto']) || !is_array($this->NM_ajax_info['errList']['valordesconto']))
                  {
                      $this->NM_ajax_info['errList']['valordesconto'] = array();
                  }
                  $this->NM_ajax_info['errList']['valordesconto'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valordesconto, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor desconto; " ; 
                  if (!isset($Campos_Erros['valordesconto']))
                  {
                      $Campos_Erros['valordesconto'] = array();
                  }
                  $Campos_Erros['valordesconto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valordesconto']) || !is_array($this->NM_ajax_info['errList']['valordesconto']))
                  {
                      $this->NM_ajax_info['errList']['valordesconto'] = array();
                  }
                  $this->NM_ajax_info['errList']['valordesconto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valordesconto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valordesconto

    function ValidateField_produto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['produto'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->produto) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'produto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_produto

    function ValidateField_parcela(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['parcela'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->parcela) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'parcela';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_parcela

    function ValidateField_observacoes(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['observacoes'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->observacoes) > 32767) 
          { 
              $hasError = true;
              $Campos_Crit .= "Observações " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['observacoes']))
              {
                  $Campos_Erros['observacoes'] = array();
              }
              $Campos_Erros['observacoes'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['observacoes']) || !is_array($this->NM_ajax_info['errList']['observacoes']))
              {
                  $this->NM_ajax_info['errList']['observacoes'] = array();
              }
              $this->NM_ajax_info['errList']['observacoes'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'observacoes';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_observacoes

    function ValidateField_qtdparcelas(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qtdparcelas'])) {
          nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->qtdparcelas === "" || is_null($this->qtdparcelas))  
      { 
          $this->qtdparcelas = 0;
          $this->sc_force_zero[] = 'qtdparcelas';
      } 
      }
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_qtdparcelas' == $this->NM_ajax_opcao)
      { 
          if ($this->qtdparcelas != '')  
          { 
              $iTestSize = 5;
              if (strlen($this->qtdparcelas) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd Parcelas: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['qtdparcelas']))
                  {
                      $Campos_Erros['qtdparcelas'] = array();
                  }
                  $Campos_Erros['qtdparcelas'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['qtdparcelas']) || !is_array($this->NM_ajax_info['errList']['qtdparcelas']))
                  {
                      $this->NM_ajax_info['errList']['qtdparcelas'] = array();
                  }
                  $this->NM_ajax_info['errList']['qtdparcelas'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->qtdparcelas, 5, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd Parcelas; " ; 
                  if (!isset($Campos_Erros['qtdparcelas']))
                  {
                      $Campos_Erros['qtdparcelas'] = array();
                  }
                  $Campos_Erros['qtdparcelas'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['qtdparcelas']) || !is_array($this->NM_ajax_info['errList']['qtdparcelas']))
                  {
                      $this->NM_ajax_info['errList']['qtdparcelas'] = array();
                  }
                  $this->NM_ajax_info['errList']['qtdparcelas'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'qtdparcelas';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_qtdparcelas

    function ValidateField_qtdprodutos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qtdprodutos'])) {
          nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->qtdprodutos === "" || is_null($this->qtdprodutos))  
      { 
          $this->qtdprodutos = 0;
          $this->sc_force_zero[] = 'qtdprodutos';
      } 
      }
      nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_qtdprodutos' == $this->NM_ajax_opcao)
      { 
          if ($this->qtdprodutos != '')  
          { 
              $iTestSize = 5;
              if (strlen($this->qtdprodutos) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd Produtos: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['qtdprodutos']))
                  {
                      $Campos_Erros['qtdprodutos'] = array();
                  }
                  $Campos_Erros['qtdprodutos'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['qtdprodutos']) || !is_array($this->NM_ajax_info['errList']['qtdprodutos']))
                  {
                      $this->NM_ajax_info['errList']['qtdprodutos'] = array();
                  }
                  $this->NM_ajax_info['errList']['qtdprodutos'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->qtdprodutos, 5, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd Produtos; " ; 
                  if (!isset($Campos_Erros['qtdprodutos']))
                  {
                      $Campos_Erros['qtdprodutos'] = array();
                  }
                  $Campos_Erros['qtdprodutos'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['qtdprodutos']) || !is_array($this->NM_ajax_info['errList']['qtdprodutos']))
                  {
                      $this->NM_ajax_info['errList']['qtdprodutos'] = array();
                  }
                  $this->NM_ajax_info['errList']['qtdprodutos'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'qtdprodutos';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_qtdprodutos

    function ValidateField_numerofatura(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['numerofatura'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->numerofatura) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Número fatura " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['numerofatura']))
              {
                  $Campos_Erros['numerofatura'] = array();
              }
              $Campos_Erros['numerofatura'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['numerofatura']) || !is_array($this->NM_ajax_info['errList']['numerofatura']))
              {
                  $this->NM_ajax_info['errList']['numerofatura'] = array();
              }
              $this->NM_ajax_info['errList']['numerofatura'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'numerofatura';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_numerofatura

    function ValidateField_idtenacidade(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtenacidade'])) {
       return;
   }
   if ($this->nmgp_opcao == "incluir")
   {
               if (!empty($this->idtenacidade) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']) && !in_array($this->idtenacidade, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtenacidade']))
                   {
                       $Campos_Erros['idtenacidade'] = array();
                   }
                   $Campos_Erros['idtenacidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtenacidade']) || !is_array($this->NM_ajax_info['errList']['idtenacidade']))
                   {
                       $this->NM_ajax_info['errList']['idtenacidade'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtenacidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtenacidade';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtenacidade

    function ValidateField_idusuarioauditoria(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idusuarioauditoria'])) {
       return;
   }
   if ($this->nmgp_opcao == "incluir")
   {
               if (!empty($this->idusuarioauditoria) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']) && !in_array($this->idusuarioauditoria, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idusuarioauditoria']))
                   {
                       $Campos_Erros['idusuarioauditoria'] = array();
                   }
                   $Campos_Erros['idusuarioauditoria'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idusuarioauditoria']) || !is_array($this->NM_ajax_info['errList']['idusuarioauditoria']))
                   {
                       $this->NM_ajax_info['errList']['idusuarioauditoria'] = array();
                   }
                   $this->NM_ajax_info['errList']['idusuarioauditoria'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idusuarioauditoria';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idusuarioauditoria

    function ValidateField_enderecoipauditoria(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['enderecoipauditoria'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->enderecoipauditoria) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Endereço IP " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['enderecoipauditoria']))
              {
                  $Campos_Erros['enderecoipauditoria'] = array();
              }
              $Campos_Erros['enderecoipauditoria'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['enderecoipauditoria']) || !is_array($this->NM_ajax_info['errList']['enderecoipauditoria']))
              {
                  $this->NM_ajax_info['errList']['enderecoipauditoria'] = array();
              }
              $this->NM_ajax_info['errList']['enderecoipauditoria'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'enderecoipauditoria';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_enderecoipauditoria

    function ValidateField_nomeaplicacaoauditoria(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomeaplicacaoauditoria'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->nomeaplicacaoauditoria) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nome Aplicação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['nomeaplicacaoauditoria']))
              {
                  $Campos_Erros['nomeaplicacaoauditoria'] = array();
              }
              $Campos_Erros['nomeaplicacaoauditoria'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['nomeaplicacaoauditoria']) || !is_array($this->NM_ajax_info['errList']['nomeaplicacaoauditoria']))
              {
                  $this->NM_ajax_info['errList']['nomeaplicacaoauditoria'] = array();
              }
              $this->NM_ajax_info['errList']['nomeaplicacaoauditoria'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomeaplicacaoauditoria';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomeaplicacaoauditoria
//
//--------------------------------------------------------------------------------------
   function upload_img_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser;
     if (!empty($Campos_Crit) || !empty($Campos_Falta))
     {
          return;
     }
      if ($this->nmgp_opcao == "incluir" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['recarga'] == "novo")
      { 
          if ($this->nomereferencia == "none") 
          { 
              $this->nomereferencia = ""; 
          } 
          if ($this->nomereferencia != "") 
          { 
              if (!is_file($this->nomereferencia) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->nomereferencia, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->nomereferencia = $mbConvertFileName;
                  }
              }
              if (is_file($this->nomereferencia))  
              { 
                  if ($this->nmgp_opcao == "incluir")
                  { 
                      $this->SC_DOC_nomereferencia = $this->nomereferencia;
                  } 
                  else 
                  { 
                      $arq_nomereferencia = fopen($this->nomereferencia, "r") ; 
                      $reg_nomereferencia = fread($arq_nomereferencia, filesize($this->nomereferencia)) ; 
                      fclose($arq_nomereferencia) ;  
                  } 
                  $this->NM_size_docs[$this->nomereferencia_scfile_name] = $this->sc_file_size($this->nomereferencia);
                  $this->nomereferencia =  trim($this->nomereferencia_scfile_name) ;  
                  $dir_doc = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
                 if ($this->nmgp_opcao != "incluir")
                 { 
                  if (is_dir($dir_doc))  
                  { 
                      $_test_file = $this->fetchUniqueUploadName($this->nomereferencia_scfile_name, $dir_doc, "nomereferencia");
                      if (trim($this->nomereferencia_scfile_name) != $_test_file)
                      {
                          $this->nomereferencia_scfile_name = $_test_file;
                          $this->nomereferencia = $_test_file;
                      }
                      $arq_nomereferencia = fopen($dir_doc . trim($this->nomereferencia_scfile_name), "w") ; 
                      fwrite($arq_nomereferencia, $reg_nomereferencia) ;  
                      fclose($arq_nomereferencia) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_nfdr']; 
                      if (!isset($Campos_Erros['nomereferencia']))
                      {
                          $Campos_Erros['nomereferencia'] = array();
                      }
                      $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_nfdr'];
                      if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                      {
                          $this->NM_ajax_info['errList']['nomereferencia'] = array();
                      }
                      $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_nfdr'];
                  } 
                 } 
              } 
              else 
              { 
                  $Campos_Crit .= "Arquivo " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->nomereferencia = "";
                  if (!isset($Campos_Erros['nomereferencia']))
                  {
                      $Campos_Erros['nomereferencia'] = array();
                  }
                  $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                  {
                      $this->NM_ajax_info['errList']['nomereferencia'] = array();
                  }
                  $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
          elseif (!empty($this->nomereferencia_salva) && $this->nomereferencia_limpa != "S")
          {
              $this->nomereferencia = $this->nomereferencia_salva;
          }
      } 
      elseif (!empty($this->nomereferencia_salva) && $this->nomereferencia_limpa != "S")
      {
          $this->nomereferencia = $this->nomereferencia_salva;
      }
   }

    function removeDuplicateDttmError($aErrDate, &$aErrTime)
    {
        if (empty($aErrDate) || empty($aErrTime))
        {
            return;
        }

        foreach ($aErrDate as $sErrDate)
        {
            foreach ($aErrTime as $iErrTime => $sErrTime)
            {
                if ($sErrDate == $sErrTime)
                {
                    unset($aErrTime[$iErrTime]);
                }
            }
        }
    } // removeDuplicateDttmError

   function nm_guardar_campos()
   {
    global
           $sc_seq_vert;
    $this->nmgp_dados_form['idfornecedor'] = $this->idfornecedor;
    $this->nmgp_dados_form['cnpj'] = $this->cnpj;
    $this->nmgp_dados_form['datahorainclusao'] = (strlen(trim($this->datahorainclusao)) > 19) ? str_replace(".", ":", $this->datahorainclusao) : trim($this->datahorainclusao);
    $this->nmgp_dados_form['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
    $this->nmgp_dados_form['razaosocial'] = $this->razaosocial;
    $this->nmgp_dados_form['nomefantasia'] = $this->nomefantasia;
    $this->nmgp_dados_form['idalmoxarifado'] = $this->idalmoxarifado;
    $this->nmgp_dados_form['nomearquivo'] = $this->nomearquivo;
    if (empty($this->nomereferencia))
    {
        $this->nomereferencia = $this->nmgp_dados_form['nomereferencia'];
    }
    $this->nmgp_dados_form['nomereferencia'] = $this->nomereferencia;
    $this->nmgp_dados_form['nomereferencia_limpa'] = $this->nomereferencia_limpa;
    $this->nmgp_dados_form['datahoraemissao'] = (strlen(trim($this->datahoraemissao)) > 19) ? str_replace(".", ":", $this->datahoraemissao) : trim($this->datahoraemissao);
    $this->nmgp_dados_form['versao'] = $this->versao;
    $this->nmgp_dados_form['chave'] = $this->chave;
    $this->nmgp_dados_form['codigo'] = $this->codigo;
    $this->nmgp_dados_form['numeronota'] = $this->numeronota;
    $this->nmgp_dados_form['natureza'] = $this->natureza;
    $this->nmgp_dados_form['serie'] = $this->serie;
    $this->nmgp_dados_form['valorcofins'] = $this->valorcofins;
    $this->nmgp_dados_form['valorpis'] = $this->valorpis;
    $this->nmgp_dados_form['valoricms'] = $this->valoricms;
    $this->nmgp_dados_form['valorfrete'] = $this->valorfrete;
    $this->nmgp_dados_form['valortotal'] = $this->valortotal;
    $this->nmgp_dados_form['valorliquido'] = $this->valorliquido;
    $this->nmgp_dados_form['valordesconto'] = $this->valordesconto;
    $this->nmgp_dados_form['produto'] = $this->produto;
    $this->nmgp_dados_form['parcela'] = $this->parcela;
    $this->nmgp_dados_form['observacoes'] = $this->observacoes;
    $this->nmgp_dados_form['qtdparcelas'] = $this->qtdparcelas;
    $this->nmgp_dados_form['qtdprodutos'] = $this->qtdprodutos;
    $this->nmgp_dados_form['numerofatura'] = $this->numerofatura;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['cnpj'] = $this->cnpj;
      nm_limpa_ciccnpj($this->cnpj) ; 
      $this->Before_unformat['datahorainclusao'] = $this->datahorainclusao;
      $this->Before_unformat['datahorainclusao_hora'] = $this->datahorainclusao_hora;
      nm_limpa_data($this->datahorainclusao, $this->field_config['datahorainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datahorainclusao_hora, $this->field_config['datahorainclusao']['time_sep']) ; 
      $this->Before_unformat['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
      nm_limpa_numero($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp']) ; 
      $this->Before_unformat['datahoraemissao'] = $this->datahoraemissao;
      $this->Before_unformat['datahoraemissao_hora'] = $this->datahoraemissao_hora;
      nm_limpa_data($this->datahoraemissao, $this->field_config['datahoraemissao']['date_sep']) ; 
      nm_limpa_hora($this->datahoraemissao_hora, $this->field_config['datahoraemissao']['time_sep']) ; 
      $this->Before_unformat['valorcofins'] = $this->valorcofins;
      if (!empty($this->field_config['valorcofins']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp'], $this->field_config['valorcofins']['symbol_mon']);
         nm_limpa_valor($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp']);
      }
      $this->Before_unformat['valorpis'] = $this->valorpis;
      if (!empty($this->field_config['valorpis']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp'], $this->field_config['valorpis']['symbol_mon']);
         nm_limpa_valor($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp']);
      }
      $this->Before_unformat['valoricms'] = $this->valoricms;
      if (!empty($this->field_config['valoricms']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp'], $this->field_config['valoricms']['symbol_mon']);
         nm_limpa_valor($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp']);
      }
      $this->Before_unformat['valorfrete'] = $this->valorfrete;
      if (!empty($this->field_config['valorfrete']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp'], $this->field_config['valorfrete']['symbol_mon']);
         nm_limpa_valor($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp']);
      }
      $this->Before_unformat['valortotal'] = $this->valortotal;
      if (!empty($this->field_config['valortotal']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp'], $this->field_config['valortotal']['symbol_mon']);
         nm_limpa_valor($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp']);
      }
      $this->Before_unformat['valorliquido'] = $this->valorliquido;
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']);
         nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']);
      }
      $this->Before_unformat['valordesconto'] = $this->valordesconto;
      if (!empty($this->field_config['valordesconto']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_mon']);
         nm_limpa_valor($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp']);
      }
      $this->Before_unformat['qtdparcelas'] = $this->qtdparcelas;
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      $this->Before_unformat['qtdprodutos'] = $this->qtdprodutos;
      nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
   }
   function sc_add_currency(&$value, $symbol, $pos)
   {
       if ('' == $value)
       {
           return;
       }
       $value = (1 == $pos || 3 == $pos) ? $symbol . ' ' . $value : $value . ' ' . $symbol;
   }
   function sc_remove_currency(&$value, $symbol_dec, $symbol_tho, $symbol_mon)
   {
       $value = preg_replace('~&#x0*([0-9a-f]+);~i', '', $value);
       $sNew  = str_replace($symbol_mon, '', $value);
       if ($sNew != $value)
       {
           $value = str_replace(' ', '', $sNew);
           return;
       }
       $aTest = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', $symbol_dec, $symbol_tho);
       $sNew  = '';
       for ($i = 0; $i < strlen($value); $i++)
       {
           if ($this->sc_test_currency_char($value[$i], $aTest))
           {
               $sNew .= $value[$i];
           }
       }
       $value = $sNew;
   }
   function sc_test_currency_char($char, $test)
   {
       $found = false;
       foreach ($test as $test_char)
       {
           if ($char === $test_char)
           {
               $found = true;
           }
       }
       return $found;
   }
   function nm_clear_val($Nome_Campo)
   {
      if ($Nome_Campo == "cnpj")
      {
          nm_limpa_ciccnpj($this->cnpj) ; 
      }
      if ($Nome_Campo == "idalmoxarifadoentrada")
      {
          nm_limpa_numero($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valorcofins")
      {
          if (!empty($this->field_config['valorcofins']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp'], $this->field_config['valorcofins']['symbol_mon']);
             nm_limpa_valor($this->valorcofins, $this->field_config['valorcofins']['symbol_dec'], $this->field_config['valorcofins']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorpis")
      {
          if (!empty($this->field_config['valorpis']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp'], $this->field_config['valorpis']['symbol_mon']);
             nm_limpa_valor($this->valorpis, $this->field_config['valorpis']['symbol_dec'], $this->field_config['valorpis']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valoricms")
      {
          if (!empty($this->field_config['valoricms']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp'], $this->field_config['valoricms']['symbol_mon']);
             nm_limpa_valor($this->valoricms, $this->field_config['valoricms']['symbol_dec'], $this->field_config['valoricms']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorfrete")
      {
          if (!empty($this->field_config['valorfrete']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp'], $this->field_config['valorfrete']['symbol_mon']);
             nm_limpa_valor($this->valorfrete, $this->field_config['valorfrete']['symbol_dec'], $this->field_config['valorfrete']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valortotal")
      {
          if (!empty($this->field_config['valortotal']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp'], $this->field_config['valortotal']['symbol_mon']);
             nm_limpa_valor($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorliquido")
      {
          if (!empty($this->field_config['valorliquido']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']);
             nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valordesconto")
      {
          if (!empty($this->field_config['valordesconto']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_mon']);
             nm_limpa_valor($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "qtdparcelas")
      {
          nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "qtdprodutos")
      {
          nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if (!empty($this->cnpj) || (!empty($format_fields) && isset($format_fields['cnpj'])))
      {
          nmgp_Form_CicCnpj($this->cnpj) ; 
      }
      if ((!empty($this->datahorainclusao) && 'null' != $this->datahorainclusao) || (!empty($format_fields) && isset($format_fields['datahorainclusao'])))
      {
          $nm_separa_data = strpos($this->field_config['datahorainclusao']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['datahorainclusao']['date_format'];
          $this->field_config['datahorainclusao']['date_format'] = substr($this->field_config['datahorainclusao']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->datahorainclusao, " ") ; 
          $this->datahorainclusao_hora = substr($this->datahorainclusao, $separador + 1) ; 
          $this->datahorainclusao = substr($this->datahorainclusao, 0, $separador) ; 
          nm_volta_data($this->datahorainclusao, $this->field_config['datahorainclusao']['date_format']) ; 
          nmgp_Form_Datas($this->datahorainclusao, $this->field_config['datahorainclusao']['date_format'], $this->field_config['datahorainclusao']['date_sep']) ;  
          $this->field_config['datahorainclusao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->datahorainclusao_hora, $this->field_config['datahorainclusao']['date_format']) ; 
          nmgp_Form_Hora($this->datahorainclusao_hora, $this->field_config['datahorainclusao']['date_format'], $this->field_config['datahorainclusao']['time_sep']) ;  
          $this->field_config['datahorainclusao']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->datahorainclusao || '' == $this->datahorainclusao)
      {
          $this->datahorainclusao_hora = '';
          $this->datahorainclusao = '';
      }
      if ('' !== $this->idalmoxarifadoentrada || (!empty($format_fields) && isset($format_fields['idalmoxarifadoentrada'])))
      {
          nmgp_Form_Num_Val($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp'], $this->field_config['idalmoxarifadoentrada']['symbol_dec'], "0", "S", $this->field_config['idalmoxarifadoentrada']['format_neg'], "", "", "-", $this->field_config['idalmoxarifadoentrada']['symbol_fmt']) ; 
      }
      if ((!empty($this->datahoraemissao) && 'null' != $this->datahoraemissao) || (!empty($format_fields) && isset($format_fields['datahoraemissao'])))
      {
          $nm_separa_data = strpos($this->field_config['datahoraemissao']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['datahoraemissao']['date_format'];
          $this->field_config['datahoraemissao']['date_format'] = substr($this->field_config['datahoraemissao']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->datahoraemissao, " ") ; 
          $this->datahoraemissao_hora = substr($this->datahoraemissao, $separador + 1) ; 
          $this->datahoraemissao = substr($this->datahoraemissao, 0, $separador) ; 
          nm_volta_data($this->datahoraemissao, $this->field_config['datahoraemissao']['date_format']) ; 
          nmgp_Form_Datas($this->datahoraemissao, $this->field_config['datahoraemissao']['date_format'], $this->field_config['datahoraemissao']['date_sep']) ;  
          $this->field_config['datahoraemissao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->datahoraemissao_hora, $this->field_config['datahoraemissao']['date_format']) ; 
          nmgp_Form_Hora($this->datahoraemissao_hora, $this->field_config['datahoraemissao']['date_format'], $this->field_config['datahoraemissao']['time_sep']) ;  
          $this->field_config['datahoraemissao']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->datahoraemissao || '' == $this->datahoraemissao)
      {
          $this->datahoraemissao_hora = '';
          $this->datahoraemissao = '';
      }
      if ('' !== $this->valorcofins || (!empty($format_fields) && isset($format_fields['valorcofins'])))
      {
          nmgp_Form_Num_Val($this->valorcofins, $this->field_config['valorcofins']['symbol_grp'], $this->field_config['valorcofins']['symbol_dec'], "2", "S", $this->field_config['valorcofins']['format_neg'], "", "", "-", $this->field_config['valorcofins']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorpis || (!empty($format_fields) && isset($format_fields['valorpis'])))
      {
          nmgp_Form_Num_Val($this->valorpis, $this->field_config['valorpis']['symbol_grp'], $this->field_config['valorpis']['symbol_dec'], "2", "S", $this->field_config['valorpis']['format_neg'], "", "", "-", $this->field_config['valorpis']['symbol_fmt']) ; 
      }
      if ('' !== $this->valoricms || (!empty($format_fields) && isset($format_fields['valoricms'])))
      {
          nmgp_Form_Num_Val($this->valoricms, $this->field_config['valoricms']['symbol_grp'], $this->field_config['valoricms']['symbol_dec'], "2", "S", $this->field_config['valoricms']['format_neg'], "", "", "-", $this->field_config['valoricms']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorfrete || (!empty($format_fields) && isset($format_fields['valorfrete'])))
      {
          nmgp_Form_Num_Val($this->valorfrete, $this->field_config['valorfrete']['symbol_grp'], $this->field_config['valorfrete']['symbol_dec'], "2", "S", $this->field_config['valorfrete']['format_neg'], "", "", "-", $this->field_config['valorfrete']['symbol_fmt']) ; 
      }
      if ('' !== $this->valortotal || (!empty($format_fields) && isset($format_fields['valortotal'])))
      {
          nmgp_Form_Num_Val($this->valortotal, $this->field_config['valortotal']['symbol_grp'], $this->field_config['valortotal']['symbol_dec'], "2", "S", $this->field_config['valortotal']['format_neg'], "", "", "-", $this->field_config['valortotal']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorliquido || (!empty($format_fields) && isset($format_fields['valorliquido'])))
      {
          nmgp_Form_Num_Val($this->valorliquido, $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_dec'], "2", "S", $this->field_config['valorliquido']['format_neg'], "", "", "-", $this->field_config['valorliquido']['symbol_fmt']) ; 
      }
      if ('' !== $this->valordesconto || (!empty($format_fields) && isset($format_fields['valordesconto'])))
      {
          nmgp_Form_Num_Val($this->valordesconto, $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_dec'], "2", "S", $this->field_config['valordesconto']['format_neg'], "", "", "-", $this->field_config['valordesconto']['symbol_fmt']) ; 
      }
      if ('' !== $this->qtdparcelas || (!empty($format_fields) && isset($format_fields['qtdparcelas'])))
      {
          nmgp_Form_Num_Val($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp'], $this->field_config['qtdparcelas']['symbol_dec'], "0", "S", $this->field_config['qtdparcelas']['format_neg'], "", "", "-", $this->field_config['qtdparcelas']['symbol_fmt']) ; 
      }
      if ('' !== $this->qtdprodutos || (!empty($format_fields) && isset($format_fields['qtdprodutos'])))
      {
          nmgp_Form_Num_Val($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp'], $this->field_config['qtdprodutos']['symbol_dec'], "0", "S", $this->field_config['qtdprodutos']['format_neg'], "", "", "-", $this->field_config['qtdprodutos']['symbol_fmt']) ; 
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $new_campo = '';
          $a_mask_ord  = array();
          $i_mask_size = -1;

          foreach (explode(';', $nm_mask) as $str_mask)
          {
              $a_mask_ord[ $this->nm_conta_mask_chars($str_mask) ] = $str_mask;
          }
          ksort($a_mask_ord);

          foreach ($a_mask_ord as $i_size => $s_mask)
          {
              if (-1 == $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
              elseif (strlen($nm_campo) >= $i_size && strlen($nm_campo) > $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
          }
          $nm_mask = $a_mask_ord[$i_mask_size];

          for ($i = 0; $i < strlen($nm_mask); $i++)
          {
              $test_mask = substr($nm_mask, $i, 1);
              
              if ('9' == $test_mask || 'a' == $test_mask || '*' == $test_mask)
              {
                  $new_campo .= substr($nm_campo, 0, 1);
                  $nm_campo   = substr($nm_campo, 1);
              }
              else
              {
                  $new_campo .= $test_mask;
              }
          }

                  $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont1 < $cont2 && $tam_campo <= $cont2 && $tam_campo > $cont1)
              {
                  $trab_mask = $ver_duas[1];
              }
              elseif ($cont1 > $cont2 && $tam_campo <= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
   function nm_conta_mask_chars($sMask)
   {
       $iLength = 0;

       for ($i = 0; $i < strlen($sMask); $i++)
       {
           if (in_array($sMask[$i], array('9', 'a', '*')))
           {
               $iLength++;
           }
       }

       return $iLength;
   }
   function nm_tira_mask(&$nm_campo, $nm_mask, $nm_chars = '')
   { 
      $mask_dados = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $tam_mask   = strlen($nm_mask);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $raw_campo = $this->sc_clear_mask($nm_campo, $nm_chars);
          $raw_mask  = $this->sc_clear_mask($nm_mask, $nm_chars);
          $new_campo = '';

          $test_mask = substr($raw_mask, 0, 1);
          $raw_mask  = substr($raw_mask, 1);

          while ('' != $raw_campo)
          {
              $test_val  = substr($raw_campo, 0, 1);
              $raw_campo = substr($raw_campo, 1);
              $ord       = ord($test_val);
              $found     = false;

              switch ($test_mask)
              {
                  case '9':
                      if (48 <= $ord && 57 >= $ord)
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case 'a':
                      if ((65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case '*':
                      if ((48 <= $ord && 57 >= $ord) || (65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;
              }

              if ($found)
              {
                  $test_mask = substr($raw_mask, 0, 1);
                  $raw_mask  = substr($raw_mask, 1);
              }
          }

          $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          for ($x=0; $x < strlen($mask_dados); $x++)
          {
              if (is_numeric(substr($mask_dados, $x, 1)))
              {
                  $trab_saida .= substr($mask_dados, $x, 1);
              }
          }
          $nm_campo = $trab_saida;
          return;
      }
      if ($tam_mask > $tam_campo)
      {
         $mask_desfaz = "";
         for ($mask_ind = 0; $tam_mask > $tam_campo; $mask_ind++)
         {
              $mask_char = substr($trab_mask, $mask_ind, 1);
              if ($mask_char == "z")
              {
                  $tam_mask--;
              }
              else
              {
                  $mask_desfaz .= $mask_char;
              }
              if ($mask_ind == $tam_campo)
              {
                  $tam_mask = $tam_campo;
              }
         }
         $trab_mask = $mask_desfaz . substr($trab_mask, $mask_ind);
      }
      $mask_saida = "";
      for ($mask_ind = strlen($trab_mask); $mask_ind > 0; $mask_ind--)
      {
          $mask_char = substr($trab_mask, $mask_ind - 1, 1);
          if ($mask_char == "x" || $mask_char == "z")
          {
              if ($tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
              }
          }
          else
          {
              if ($mask_char != substr($mask_dados, $tam_campo - 1, 1) && $tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
                  $mask_ind--;
              }
          }
          $tam_campo--;
      }
      if ($tam_campo > 0)
      {
         $mask_saida = substr($mask_dados, 0, $tam_campo) . $mask_saida;
      }
      $nm_campo = $mask_saida;
   }

   function sc_clear_mask($value, $chars)
   {
       $new = '';

       for ($i = 0; $i < strlen($value); $i++)
       {
           if (false === strpos($chars, $value[$i]))
           {
               $new .= $value[$i];
           }
       }

       return $new;
   }
//
   function nm_limpa_alfa(&$str)
   {
   }
//
//-- 
   function nm_converte_datas($use_null = true, $bForce = false)
   {
      $guarda_format_hora = $this->field_config['datahorainclusao']['date_format'];
      if ($this->datahorainclusao != "")  
      { 
          $nm_separa_data = strpos($this->field_config['datahorainclusao']['date_format'], ";") ;
          $this->field_config['datahorainclusao']['date_format'] = substr($this->field_config['datahorainclusao']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->datahorainclusao, $this->field_config['datahorainclusao']['date_format']) ; 
          $this->field_config['datahorainclusao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->datahorainclusao_hora, $this->field_config['datahorainclusao']['date_format']) ; 
          if ($this->datahorainclusao_hora == "" )  
          { 
              $this->datahorainclusao_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->datahorainclusao_hora = substr($this->datahorainclusao_hora, 0, -4) . "." . substr($this->datahorainclusao_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datahorainclusao_hora = substr($this->datahorainclusao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datahorainclusao_hora = substr($this->datahorainclusao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datahorainclusao_hora = substr($this->datahorainclusao_hora, 0, -4);
          }
          if ($this->datahorainclusao != "")  
          { 
              $this->datahorainclusao .= " " . $this->datahorainclusao_hora ; 
          }
      } 
      $this->field_config['datahorainclusao']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['datahoraemissao']['date_format'];
      if ($this->datahoraemissao != "")  
      { 
          $nm_separa_data = strpos($this->field_config['datahoraemissao']['date_format'], ";") ;
          $this->field_config['datahoraemissao']['date_format'] = substr($this->field_config['datahoraemissao']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->datahoraemissao, $this->field_config['datahoraemissao']['date_format']) ; 
          $this->field_config['datahoraemissao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->datahoraemissao_hora, $this->field_config['datahoraemissao']['date_format']) ; 
          if ($this->datahoraemissao_hora == "" )  
          { 
              $this->datahoraemissao_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->datahoraemissao_hora = substr($this->datahoraemissao_hora, 0, -4) . "." . substr($this->datahoraemissao_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datahoraemissao_hora = substr($this->datahoraemissao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datahoraemissao_hora = substr($this->datahoraemissao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datahoraemissao_hora = substr($this->datahoraemissao_hora, 0, -4);
          }
          if ($this->datahoraemissao != "")  
          { 
              $this->datahoraemissao .= " " . $this->datahoraemissao_hora ; 
          }
      } 
      $this->field_config['datahoraemissao']['date_format'] = $guarda_format_hora;
   }
//
   function nm_prep_date_change($cmp_date, $format_dt)
   {
       $vl_return  = "";
       if ($cmp_date != 'null') {
           $vl_return .= (strpos($format_dt, "yy") !== false) ? substr($cmp_date,  0, 4) : "";
           $vl_return .= (strpos($format_dt, "mm") !== false) ? substr($cmp_date,  5, 2) : "";
           $vl_return .= (strpos($format_dt, "dd") !== false) ? substr($cmp_date,  8, 2) : "";
           $vl_return .= (strpos($format_dt, "hh") !== false) ? substr($cmp_date, 11, 2) : "";
           $vl_return .= (strpos($format_dt, "ii") !== false) ? substr($cmp_date, 14, 2) : "";
           $vl_return .= (strpos($format_dt, "ss") !== false) ? substr($cmp_date, 17, 2) : "";
       }
       return $vl_return;
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out, $replaces = array())
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out, $replaces);
           return $dt_out;
       }
   }

   function returnWhere($aCond, $sOp = 'AND')
   {
       $aWhere = array();
       foreach ($aCond as $sCond)
       {
           $this->handleWhereCond($sCond);
           if ('' != $sCond)
           {
               $aWhere[] = $sCond;
           }
       }
       if (empty($aWhere))
       {
           return '';
       }
       else
       {
           return ' WHERE (' . implode(') ' . $sOp . ' (', $aWhere) . ')';
       }
   } // returnWhere

   function handleWhereCond(&$sCond)
   {
       $sCond = trim($sCond);
       if ('where' == strtolower(substr($sCond, 0, 5)))
       {
           $sCond = trim(substr($sCond, 5));
       }
   } // handleWhereCond

   function ajax_return_values()
   {
          $this->ajax_return_values_idfornecedor();
          $this->ajax_return_values_cnpj();
          $this->ajax_return_values_datahorainclusao();
          $this->ajax_return_values_idalmoxarifadoentrada();
          $this->ajax_return_values_razaosocial();
          $this->ajax_return_values_nomefantasia();
          $this->ajax_return_values_idalmoxarifado();
          $this->ajax_return_values_nomearquivo();
          $this->ajax_return_values_nomereferencia();
          $this->ajax_return_values_datahoraemissao();
          $this->ajax_return_values_versao();
          $this->ajax_return_values_chave();
          $this->ajax_return_values_codigo();
          $this->ajax_return_values_numeronota();
          $this->ajax_return_values_natureza();
          $this->ajax_return_values_serie();
          $this->ajax_return_values_valorcofins();
          $this->ajax_return_values_valorpis();
          $this->ajax_return_values_valoricms();
          $this->ajax_return_values_valorfrete();
          $this->ajax_return_values_valortotal();
          $this->ajax_return_values_valorliquido();
          $this->ajax_return_values_valordesconto();
          $this->ajax_return_values_produto();
          $this->ajax_return_values_parcela();
          $this->ajax_return_values_observacoes();
          $this->ajax_return_values_qtdparcelas();
          $this->ajax_return_values_qtdprodutos();
          $this->ajax_return_values_numerofatura();
          $this->ajax_return_values_idtenacidade();
          $this->ajax_return_values_idusuarioauditoria();
          $this->ajax_return_values_enderecoipauditoria();
          $this->ajax_return_values_nomeaplicacaoauditoria();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idalmoxarifadoentrada']['keyVal'] = AlmoxarifadoEntrada_Frm_pack_protect_string($this->nmgp_dados_form['idalmoxarifadoentrada']);
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaParcela_Lst_script_case_init'] ]['AlmoxarifadoEntradaParcela_Lst']['embutida_form_full'] = false;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaParcela_Lst_script_case_init'] ]['AlmoxarifadoEntradaParcela_Lst']['embutida_form']       = true;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaParcela_Lst_script_case_init'] ]['AlmoxarifadoEntradaParcela_Lst']['embutida_pai']        = "AlmoxarifadoEntrada_Frm";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaParcela_Lst_script_case_init'] ]['AlmoxarifadoEntradaParcela_Lst']['embutida_form_parms'] = "varidalmoxarifadoentrada*scin" . $this->nmgp_dados_form['idalmoxarifadoentrada'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scoutlink_remove_background*scinok*scout";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaParcela_Lst_script_case_init'] ]['AlmoxarifadoEntradaParcela_Lst']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaParcela_Lst_script_case_init'] ]['AlmoxarifadoEntradaParcela_Lst']['total']);
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaProduto_Lst_script_case_init'] ]['AlmoxarifadoEntradaProduto_Lst']['embutida_form_full'] = false;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaProduto_Lst_script_case_init'] ]['AlmoxarifadoEntradaProduto_Lst']['embutida_form']       = true;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaProduto_Lst_script_case_init'] ]['AlmoxarifadoEntradaProduto_Lst']['embutida_pai']        = "AlmoxarifadoEntrada_Frm";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaProduto_Lst_script_case_init'] ]['AlmoxarifadoEntradaProduto_Lst']['embutida_form_parms'] = "varidalmoxarifadoentrada*scin" . $this->nmgp_dados_form['idalmoxarifadoentrada'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scoutlink_remove_background*scinok*scout";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaProduto_Lst_script_case_init'] ]['AlmoxarifadoEntradaProduto_Lst']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['AlmoxarifadoEntradaProduto_Lst_script_case_init'] ]['AlmoxarifadoEntradaProduto_Lst']['total']);
          }
   } // ajax_return_values

          //----- idfornecedor
   function ajax_return_values_idfornecedor($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idfornecedor", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idfornecedor);
              $aLookup = array();
              $this->_tmp_lookup_idfornecedor = $this->idfornecedor;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'] = array(); 
}
$aLookup[] = array(AlmoxarifadoEntrada_Frm_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoEntrada_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT IdFornecedor, CONCAT(NomeFantasia, ' (', IdFornecedor, ')') FROM fornecedor WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY NomeFantasia";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"idfornecedor\"";
          if (isset($this->NM_ajax_info['select_html']['idfornecedor']) && !empty($this->NM_ajax_info['select_html']['idfornecedor']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idfornecedor']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->idfornecedor == $sValue)
                  {
                      $this->_tmp_lookup_idfornecedor = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idfornecedor", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['idfornecedor'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idfornecedor']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idfornecedor']['valList'][$i] = AlmoxarifadoEntrada_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idfornecedor']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idfornecedor']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idfornecedor']['labList'] = $aLabel;
          }
   }

          //----- cnpj
   function ajax_return_values_cnpj($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cnpj", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cnpj);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cnpj'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("cnpj", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- datahorainclusao
   function ajax_return_values_datahorainclusao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datahorainclusao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datahorainclusao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datahorainclusao'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->datahorainclusao . ' ' . $this->datahorainclusao_hora),
               'labList' => array($this->form_format_readonly("datahorainclusao", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- idalmoxarifadoentrada
   function ajax_return_values_idalmoxarifadoentrada($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadoentrada", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idalmoxarifadoentrada);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idalmoxarifadoentrada'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idalmoxarifadoentrada", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- razaosocial
   function ajax_return_values_razaosocial($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("razaosocial", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->razaosocial);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['razaosocial'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- nomefantasia
   function ajax_return_values_nomefantasia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomefantasia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomefantasia);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomefantasia'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- idalmoxarifado
   function ajax_return_values_idalmoxarifado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idalmoxarifado);
              $aLookup = array();
              $this->_tmp_lookup_idalmoxarifado = $this->idalmoxarifado;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'] = array(); 
}
$aLookup[] = array(AlmoxarifadoEntrada_Frm_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoEntrada_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT al.IdAlmoxarifado, CONCAT('Empresa: ', e.NomeFantasia, ' - ', al.Sigla, ' - ', al.Descricao)  FROM almoxarifado al INNER JOIN empresa e ON (e.IdEmpresa  = al.IdEmpresa) WHERE al.IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND al.IdEmpresa IN (" . $_SESSION['varListaEmpresa'] . ") AND al.PermiteEntrada = 'S'";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"idalmoxarifado\"";
          if (isset($this->NM_ajax_info['select_html']['idalmoxarifado']) && !empty($this->NM_ajax_info['select_html']['idalmoxarifado']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idalmoxarifado']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->idalmoxarifado == $sValue)
                  {
                      $this->_tmp_lookup_idalmoxarifado = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idalmoxarifado'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifado']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idalmoxarifado']['valList'][$i] = AlmoxarifadoEntrada_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idalmoxarifado']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifado']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idalmoxarifado']['labList'] = $aLabel;
          }
   }

          //----- nomearquivo
   function ajax_return_values_nomearquivo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomearquivo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomearquivo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomearquivo'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("nomearquivo", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- nomereferencia
   function ajax_return_values_nomereferencia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomereferencia", $this->nmgp_refresh_fields)) || $bForce || in_array("nomereferencia", $this->Upload_refresh_fields))
          {
              $sTmpValue = NM_charset_to_utf8($this->nomereferencia);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->nomereferencia, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_nomereferencia_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['download_filenames'][$sTmpFile] = $this->nomereferencia;
              $tmp_file_nomereferencia = trim(NM_charset_to_utf8($this->nomereferencia));
              $tmp_icon_nomereferencia = '';
              if ('' != $tmp_file_nomereferencia)
              {
                  $tmp_icon_nomereferencia = $this->gera_icone($tmp_file_nomereferencia);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomereferencia'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($sTmpValue),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('0', '" . $sTmpFile . "', 'AlmoxarifadoEntrada_Frm')\">" . $tmp_file_nomereferencia . "</a>",
               'docIcon' => $tmp_icon_nomereferencia,
               'docReadonly' => "S",
              );
              if ('navigate_form' == $this->NM_ajax_opcao)
              {
                  $this->NM_ajax_info['fldList']['nomereferencia_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
          }
   }

          //----- datahoraemissao
   function ajax_return_values_datahoraemissao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datahoraemissao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datahoraemissao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datahoraemissao'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->datahoraemissao . ' ' . $this->datahoraemissao_hora),
               'labList' => array($this->form_format_readonly("datahoraemissao", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- versao
   function ajax_return_values_versao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("versao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->versao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['versao'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("versao", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- chave
   function ajax_return_values_chave($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("chave", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->chave);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['chave'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("chave", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- codigo
   function ajax_return_values_codigo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("codigo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->codigo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['codigo'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("codigo", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- numeronota
   function ajax_return_values_numeronota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numeronota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numeronota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numeronota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("numeronota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- natureza
   function ajax_return_values_natureza($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("natureza", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->natureza);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['natureza'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("natureza", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- serie
   function ajax_return_values_serie($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("serie", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->serie);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['serie'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("serie", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valorcofins
   function ajax_return_values_valorcofins($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorcofins", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorcofins);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorcofins'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valorcofins", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valorpis
   function ajax_return_values_valorpis($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorpis", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorpis);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorpis'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valorpis", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valoricms
   function ajax_return_values_valoricms($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valoricms", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valoricms);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valoricms'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valoricms", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valorfrete
   function ajax_return_values_valorfrete($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorfrete", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorfrete);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorfrete'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valorfrete", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valortotal
   function ajax_return_values_valortotal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valortotal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valortotal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valortotal'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valortotal", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valorliquido
   function ajax_return_values_valorliquido($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorliquido", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorliquido);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorliquido'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valorliquido", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valordesconto
   function ajax_return_values_valordesconto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valordesconto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valordesconto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valordesconto'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valordesconto", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- produto
   function ajax_return_values_produto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("produto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->produto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['produto'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- parcela
   function ajax_return_values_parcela($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("parcela", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->parcela);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['parcela'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- observacoes
   function ajax_return_values_observacoes($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("observacoes", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->observacoes);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['observacoes'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("observacoes", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- qtdparcelas
   function ajax_return_values_qtdparcelas($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("qtdparcelas", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->qtdparcelas);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['qtdparcelas'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("qtdparcelas", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- qtdprodutos
   function ajax_return_values_qtdprodutos($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("qtdprodutos", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->qtdprodutos);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['qtdprodutos'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("qtdprodutos", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- numerofatura
   function ajax_return_values_numerofatura($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numerofatura", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numerofatura);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numerofatura'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("numerofatura", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- idtenacidade
   function ajax_return_values_idtenacidade($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtenacidade", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtenacidade);
              $aLookup = array();
              $this->_tmp_lookup_idtenacidade = $this->idtenacidade;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT IdTenacidade, NomeFantasia  FROM tenacidade  ORDER BY NomeFantasia";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"idtenacidade\"";
          if (isset($this->NM_ajax_info['select_html']['idtenacidade']) && !empty($this->NM_ajax_info['select_html']['idtenacidade']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtenacidade']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->idtenacidade == $sValue)
                  {
                      $this->_tmp_lookup_idtenacidade = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idtenacidade", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['idtenacidade'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtenacidade']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtenacidade']['valList'][$i] = AlmoxarifadoEntrada_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtenacidade']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtenacidade']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtenacidade']['labList'] = $aLabel;
          }
   }

          //----- idusuarioauditoria
   function ajax_return_values_idusuarioauditoria($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idusuarioauditoria", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idusuarioauditoria);
              $aLookup = array();
              $this->_tmp_lookup_idusuarioauditoria = $this->idusuarioauditoria;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario  ORDER BY Nome";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntrada_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"idusuarioauditoria\"";
          if (isset($this->NM_ajax_info['select_html']['idusuarioauditoria']) && !empty($this->NM_ajax_info['select_html']['idusuarioauditoria']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idusuarioauditoria']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->idusuarioauditoria == $sValue)
                  {
                      $this->_tmp_lookup_idusuarioauditoria = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idusuarioauditoria", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['idusuarioauditoria'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idusuarioauditoria']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idusuarioauditoria']['valList'][$i] = AlmoxarifadoEntrada_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idusuarioauditoria']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idusuarioauditoria']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idusuarioauditoria']['labList'] = $aLabel;
          }
   }

          //----- enderecoipauditoria
   function ajax_return_values_enderecoipauditoria($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("enderecoipauditoria", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->enderecoipauditoria);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['enderecoipauditoria'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("enderecoipauditoria", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- nomeaplicacaoauditoria
   function ajax_return_values_nomeaplicacaoauditoria($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomeaplicacaoauditoria", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomeaplicacaoauditoria);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomeaplicacaoauditoria'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("nomeaplicacaoauditoria", $this->form_encode_input($sTmpValue))),
              );
          }
   }

    function fetchUniqueUploadName($originalName, $uploadDir, $fieldName)
    {
        $originalName = trim($originalName);
        if ('' == $originalName)
        {
            return $originalName;
        }
        if (!@is_dir($uploadDir))
        {
            return $originalName;
        }
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['upload_dir'][$fieldName][] = $newName;
            $this->Upload_refresh_fields[] = $fieldName;
            return $newName;
        }
    } // fetchUniqueUploadName

    function fetchFileNextName($uniqueName, $uniqueList)
    {
        $aPathinfo     = pathinfo($uniqueName);
        $fileExtension = $aPathinfo['extension'];
        $fileName      = $aPathinfo['filename'];
        $foundName     = false;
        $nameIt        = 1;
        if ('' != $fileExtension)
        {
            $fileExtension = '.' . $fileExtension;
        }
        while (!$foundName)
        {
            $testName = $fileName . '(' . $nameIt . ')' . $fileExtension;
            if (in_array($testName, $uniqueList))
            {
                $nameIt++;
            }
            else
            {
                $foundName = true;
                return $testName;
            }
        }
    } // fetchFileNextName

   function ajax_add_parameters()
   {
       $this->NM_ajax_info['summary_line'] = $this->getSummaryLine();
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      $Ctrl_Proc_Onload = true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'on';
  $this->Preparar_LstFrm_OnSrip_OnLoad_Auditoria($this->Ini->nm_cod_apl, $this->idalmoxarifadoentrada );

$this->sc_field_readonly("datahorainclusao", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_disabled_macro']['datahorainclusao'] = array('I'=>array(),'U'=>array());
;

$this->ajustarFormulario();
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onLoad ------*/
 
      }
      if (empty($this->datahorainclusao))
      {
          $this->datahorainclusao_hora = $this->datahorainclusao;
      }
      if (empty($this->datahoraemissao))
      {
          $this->datahoraemissao_hora = $this->datahoraemissao;
      }
      if (!isset($Ctrl_Format) || !$Ctrl_Format) {
          $this->nm_guardar_campos();
          if ($bFormat) $this->nm_formatar_campos();
      }
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//
   function nm_troca_decimal($sc_parm1, $sc_parm2) 
   { 
      $this->valorcofins = str_replace($sc_parm1, $sc_parm2, $this->valorcofins); 
      $this->valorpis = str_replace($sc_parm1, $sc_parm2, $this->valorpis); 
      $this->valoricms = str_replace($sc_parm1, $sc_parm2, $this->valoricms); 
      $this->valorfrete = str_replace($sc_parm1, $sc_parm2, $this->valorfrete); 
      $this->valortotal = str_replace($sc_parm1, $sc_parm2, $this->valortotal); 
      $this->valorliquido = str_replace($sc_parm1, $sc_parm2, $this->valorliquido); 
      $this->valordesconto = str_replace($sc_parm1, $sc_parm2, $this->valordesconto); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->valorcofins = "'" . $this->valorcofins . "'";
      $this->valorpis = "'" . $this->valorpis . "'";
      $this->valoricms = "'" . $this->valoricms . "'";
      $this->valorfrete = "'" . $this->valorfrete . "'";
      $this->valortotal = "'" . $this->valortotal . "'";
      $this->valorliquido = "'" . $this->valorliquido . "'";
      $this->valordesconto = "'" . $this->valordesconto . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->valorcofins = str_replace("'", "", $this->valorcofins); 
      $this->valorpis = str_replace("'", "", $this->valorpis); 
      $this->valoricms = str_replace("'", "", $this->valoricms); 
      $this->valorfrete = str_replace("'", "", $this->valorfrete); 
      $this->valortotal = str_replace("'", "", $this->valortotal); 
      $this->valorliquido = str_replace("'", "", $this->valorliquido); 
      $this->valordesconto = str_replace("'", "", $this->valordesconto); 
   } 
//----------- 


   function temRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       if ($rsc === false && !$rsc->EOF)
       {
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
           exit; 
       }
       $iTotal = $rsc->fields[0];
       $rsc->Close();
       return 0 < $iTotal;
   } // temRegistros

   function deletaRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'DELETE FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       $bResult = $rsc;
       $rsc->Close();
       return $bResult == true;
   } // deletaRegistros
    function handleDbErrorMessage(&$dbErrorMessage, $dbErrorCode)
    {
        if (1267 == $dbErrorCode) {
            $dbErrorMessage = $this->Ini->Nm_lang['lang_errm_db_invalid_collation'];
        }
    }

   function restore_zeros_null()
   {
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      if (!empty($this->NM_val_null))
      {
          foreach ($this->NM_val_null as $i_val_null => $sc_val_null_field)
          {
              eval('$this->' . $sc_val_null_field . ' = "";');
          }
      }
      $this->NM_val_null = array();
   }

   function nm_acessa_banco() 
   { 
      global  $nm_form_submit, $teste_validade, $sc_where;
 
      $this->NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      $this->restore_zeros_null();
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $salva_opcao = $this->nmgp_opcao; 
      if ($this->sc_evento != "novo" && $this->sc_evento != "incluir") 
      { 
          $this->sc_evento = ""; 
      } 
      if ((!isset($this->Ini->nm_bases_access) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) && !$this->Ini->sc_tem_trans_banco && in_array($this->nmgp_opcao, array('excluir', 'incluir', 'alterar')))
      { 
          $this->Ini->sc_tem_trans_banco = $this->Db->BeginTrans(); 
      } 
      $NM_val_form['idfornecedor'] = $this->idfornecedor;
      $NM_val_form['cnpj'] = $this->cnpj;
      $NM_val_form['datahorainclusao'] = $this->datahorainclusao;
      $NM_val_form['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
      $NM_val_form['razaosocial'] = $this->razaosocial;
      $NM_val_form['nomefantasia'] = $this->nomefantasia;
      $NM_val_form['idalmoxarifado'] = $this->idalmoxarifado;
      $NM_val_form['nomearquivo'] = $this->nomearquivo;
      $NM_val_form['nomereferencia'] = $this->nomereferencia;
      $NM_val_form['datahoraemissao'] = $this->datahoraemissao;
      $NM_val_form['versao'] = $this->versao;
      $NM_val_form['chave'] = $this->chave;
      $NM_val_form['codigo'] = $this->codigo;
      $NM_val_form['numeronota'] = $this->numeronota;
      $NM_val_form['natureza'] = $this->natureza;
      $NM_val_form['serie'] = $this->serie;
      $NM_val_form['valorcofins'] = $this->valorcofins;
      $NM_val_form['valorpis'] = $this->valorpis;
      $NM_val_form['valoricms'] = $this->valoricms;
      $NM_val_form['valorfrete'] = $this->valorfrete;
      $NM_val_form['valortotal'] = $this->valortotal;
      $NM_val_form['valorliquido'] = $this->valorliquido;
      $NM_val_form['valordesconto'] = $this->valordesconto;
      $NM_val_form['produto'] = $this->produto;
      $NM_val_form['parcela'] = $this->parcela;
      $NM_val_form['observacoes'] = $this->observacoes;
      $NM_val_form['qtdparcelas'] = $this->qtdparcelas;
      $NM_val_form['qtdprodutos'] = $this->qtdprodutos;
      $NM_val_form['numerofatura'] = $this->numerofatura;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      if ($this->idalmoxarifadoentrada === "" || is_null($this->idalmoxarifadoentrada))  
      { 
          $this->idalmoxarifadoentrada = 0;
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->idtenacidade === "" || is_null($this->idtenacidade))  
      { 
          $this->idtenacidade = 0;
          $this->sc_force_zero[] = 'idtenacidade';
      } 
      }
      if ($this->idfornecedor === "" || is_null($this->idfornecedor))  
      { 
          $this->idfornecedor = 0;
          $this->sc_force_zero[] = 'idfornecedor';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->idalmoxarifado === "" || is_null($this->idalmoxarifado))  
      { 
          $this->idalmoxarifado = 0;
          $this->sc_force_zero[] = 'idalmoxarifado';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->valortotal === "" || is_null($this->valortotal))  
      { 
          $this->valortotal = 0;
          $this->sc_force_zero[] = 'valortotal';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valordesconto === "" || is_null($this->valordesconto))  
      { 
          $this->valordesconto = 0;
          $this->sc_force_zero[] = 'valordesconto';
      } 
      }
      if ($this->valorliquido === "" || is_null($this->valorliquido))  
      { 
          $this->valorliquido = 0;
          $this->sc_force_zero[] = 'valorliquido';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorcofins === "" || is_null($this->valorcofins))  
      { 
          $this->valorcofins = 0;
          $this->sc_force_zero[] = 'valorcofins';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorpis === "" || is_null($this->valorpis))  
      { 
          $this->valorpis = 0;
          $this->sc_force_zero[] = 'valorpis';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valoricms === "" || is_null($this->valoricms))  
      { 
          $this->valoricms = 0;
          $this->sc_force_zero[] = 'valoricms';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorfrete === "" || is_null($this->valorfrete))  
      { 
          $this->valorfrete = 0;
          $this->sc_force_zero[] = 'valorfrete';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->qtdprodutos === "" || is_null($this->qtdprodutos))  
      { 
          $this->qtdprodutos = 0;
          $this->sc_force_zero[] = 'qtdprodutos';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->qtdparcelas === "" || is_null($this->qtdparcelas))  
      { 
          $this->qtdparcelas = 0;
          $this->sc_force_zero[] = 'qtdparcelas';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->cnpj_before_qstr = $this->cnpj;
          $this->cnpj = substr($this->Db->qstr($this->cnpj), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->cnpj = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->cnpj);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->cnpj == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->cnpj = "null"; 
                  $this->NM_val_null[] = "cnpj";
              } 
          }
          $this->razaosocial_before_qstr = $this->razaosocial;
          $this->razaosocial = substr($this->Db->qstr($this->razaosocial), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->razaosocial = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->razaosocial);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->razaosocial == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->razaosocial = "null"; 
                  $this->NM_val_null[] = "razaosocial";
              } 
          }
          $this->nomefantasia_before_qstr = $this->nomefantasia;
          $this->nomefantasia = substr($this->Db->qstr($this->nomefantasia), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomefantasia = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomefantasia);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->nomefantasia == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->nomefantasia = "null"; 
                  $this->NM_val_null[] = "nomefantasia";
              } 
          }
          $this->versao_before_qstr = $this->versao;
          $this->versao = substr($this->Db->qstr($this->versao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->versao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->versao);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->versao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->versao = "null"; 
                  $this->NM_val_null[] = "versao";
              } 
          }
          $this->codigo_before_qstr = $this->codigo;
          $this->codigo = substr($this->Db->qstr($this->codigo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->codigo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->codigo);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->codigo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->codigo = "null"; 
                  $this->NM_val_null[] = "codigo";
              } 
          }
          $this->chave_before_qstr = $this->chave;
          $this->chave = substr($this->Db->qstr($this->chave), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->chave = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->chave);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->chave == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->chave = "null"; 
                  $this->NM_val_null[] = "chave";
              } 
          }
          $this->numeronota_before_qstr = $this->numeronota;
          $this->numeronota = substr($this->Db->qstr($this->numeronota), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->numeronota = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->numeronota);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->numeronota == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->numeronota = "null"; 
                  $this->NM_val_null[] = "numeronota";
              } 
          }
          $this->numerofatura_before_qstr = $this->numerofatura;
          $this->numerofatura = substr($this->Db->qstr($this->numerofatura), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->numerofatura = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->numerofatura);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->numerofatura == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->numerofatura = "null"; 
                  $this->NM_val_null[] = "numerofatura";
              } 
          }
          $this->natureza_before_qstr = $this->natureza;
          $this->natureza = substr($this->Db->qstr($this->natureza), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->natureza = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->natureza);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->natureza == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->natureza = "null"; 
                  $this->NM_val_null[] = "natureza";
              } 
          }
          $this->serie_before_qstr = $this->serie;
          $this->serie = substr($this->Db->qstr($this->serie), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->serie = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->serie);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->serie == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->serie = "null"; 
                  $this->NM_val_null[] = "serie";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->datahoraemissao == "")  
              { 
                  $this->datahoraemissao = "null"; 
                  $this->NM_val_null[] = "datahoraemissao";
              } 
              if ($this->datahoraemissao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->datahoraemissao = "null"; 
                  $this->NM_val_null[] = "datahoraemissao";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->nomearquivo_before_qstr = $this->nomearquivo;
          $this->nomearquivo = substr($this->Db->qstr($this->nomearquivo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomearquivo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomearquivo);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->nomearquivo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->nomearquivo = "null"; 
                  $this->NM_val_null[] = "nomearquivo";
              } 
          }
          $this->nomereferencia_original_filename = $this->nomereferencia; 
          $this->nomereferencia_before_qstr = $this->nomereferencia;
          $this->nomereferencia = substr($this->Db->qstr($this->nomereferencia), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomereferencia = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomereferencia);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->nomereferencia == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->nomereferencia = "null"; 
                  $this->NM_val_null[] = "nomereferencia";
              } 
          }
          $this->observacoes_before_qstr = $this->observacoes;
          $this->observacoes = substr($this->Db->qstr($this->observacoes), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->observacoes = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->observacoes);
          }
          if ($this->observacoes == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->observacoes = "null"; 
              $this->NM_val_null[] = "observacoes";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->datahorainclusao == "")  
              { 
                  $this->datahorainclusao = "null"; 
                  $this->NM_val_null[] = "datahorainclusao";
              } 
              if ($this->datahorainclusao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->datahorainclusao = "null"; 
                  $this->NM_val_null[] = "datahorainclusao";
              } 
          }
          $this->enderecoipauditoria_before_qstr = $this->enderecoipauditoria;
          $this->enderecoipauditoria = substr($this->Db->qstr($this->enderecoipauditoria), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->enderecoipauditoria = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->enderecoipauditoria);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->enderecoipauditoria == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->enderecoipauditoria = "null"; 
                  $this->NM_val_null[] = "enderecoipauditoria";
              } 
          }
          $this->nomeaplicacaoauditoria_before_qstr = $this->nomeaplicacaoauditoria;
          $this->nomeaplicacaoauditoria = substr($this->Db->qstr($this->nomeaplicacaoauditoria), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomeaplicacaoauditoria = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomeaplicacaoauditoria);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->nomeaplicacaoauditoria == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->nomeaplicacaoauditoria = "null"; 
                  $this->NM_val_null[] = "nomeaplicacaoauditoria";
              } 
          }
          $this->parcela_before_qstr = $this->parcela;
          $this->parcela = substr($this->Db->qstr($this->parcela), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->parcela = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->parcela);
          }
          if ($this->parcela == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->parcela = "null"; 
              $this->NM_val_null[] = "parcela";
          } 
          $this->produto_before_qstr = $this->produto;
          $this->produto = substr($this->Db->qstr($this->produto), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->produto = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->produto);
          }
          if ($this->produto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->produto = "null"; 
              $this->NM_val_null[] = "produto";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 AlmoxarifadoEntrada_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $bUpdateOk = false;
              $this->sc_evento = 'update';
          } 
          $aUpdateOk = array();
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdAlmoxarifado = $this->idalmoxarifado, RazaoSocial = '$this->razaosocial', NomeFantasia = '$this->nomefantasia'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdAlmoxarifado = $this->idalmoxarifado, RazaoSocial = '$this->razaosocial', NomeFantasia = '$this->nomefantasia'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdAlmoxarifado = $this->idalmoxarifado, RazaoSocial = '$this->razaosocial', NomeFantasia = '$this->nomefantasia'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdAlmoxarifado = $this->idalmoxarifado, RazaoSocial = '$this->razaosocial', NomeFantasia = '$this->nomefantasia'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] == "null"  && $this->nmgp_dados_select['idtenacidade'] == "") ? "null" : $this->nmgp_dados_select['idtenacidade'];
              if (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTenacidade = $this->idtenacidade"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idfornecedor']) && $NM_val_form['idfornecedor'] == "null"  && $this->nmgp_dados_select['idfornecedor'] == "") ? "null" : $this->nmgp_dados_select['idfornecedor'];
              if (isset($NM_val_form['idfornecedor']) && $NM_val_form['idfornecedor'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdFornecedor = $this->idfornecedor"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] == "null"  && $this->nmgp_dados_select['idusuarioauditoria'] == "") ? "null" : $this->nmgp_dados_select['idusuarioauditoria'];
              if (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioAuditoria = $this->idusuarioauditoria"; 
              } 
              $Prep_Tst = (isset($NM_val_form['cnpj']) && $NM_val_form['cnpj'] == "null"  && $this->nmgp_dados_select['cnpj'] == "") ? "null" : $this->nmgp_dados_select['cnpj'];
              if (isset($NM_val_form['cnpj']) && $NM_val_form['cnpj'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Cnpj = '$this->cnpj'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['versao']) && $NM_val_form['versao'] == "null"  && $this->nmgp_dados_select['versao'] == "") ? "null" : $this->nmgp_dados_select['versao'];
              if (isset($NM_val_form['versao']) && $NM_val_form['versao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Versao = '$this->versao'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['codigo']) && $NM_val_form['codigo'] == "null"  && $this->nmgp_dados_select['codigo'] == "") ? "null" : $this->nmgp_dados_select['codigo'];
              if (isset($NM_val_form['codigo']) && $NM_val_form['codigo'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Codigo = '$this->codigo'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['chave']) && $NM_val_form['chave'] == "null"  && $this->nmgp_dados_select['chave'] == "") ? "null" : $this->nmgp_dados_select['chave'];
              if (isset($NM_val_form['chave']) && $NM_val_form['chave'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Chave = '$this->chave'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['numeronota']) && $NM_val_form['numeronota'] == "null"  && $this->nmgp_dados_select['numeronota'] == "") ? "null" : $this->nmgp_dados_select['numeronota'];
              if (isset($NM_val_form['numeronota']) && $NM_val_form['numeronota'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Numeronota = '$this->numeronota'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['numerofatura']) && $NM_val_form['numerofatura'] == "null"  && $this->nmgp_dados_select['numerofatura'] == "") ? "null" : $this->nmgp_dados_select['numerofatura'];
              if (isset($NM_val_form['numerofatura']) && $NM_val_form['numerofatura'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Numerofatura = '$this->numerofatura'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['natureza']) && $NM_val_form['natureza'] == "null"  && $this->nmgp_dados_select['natureza'] == "") ? "null" : $this->nmgp_dados_select['natureza'];
              if (isset($NM_val_form['natureza']) && $NM_val_form['natureza'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Natureza = '$this->natureza'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['serie']) && $NM_val_form['serie'] == "null"  && $this->nmgp_dados_select['serie'] == "") ? "null" : $this->nmgp_dados_select['serie'];
              if (isset($NM_val_form['serie']) && $NM_val_form['serie'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Serie = '$this->serie'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['datahoraemissao']) && $NM_val_form['datahoraemissao'] == "null"  && $this->nmgp_dados_select['datahoraemissao'] == "") ? "null" : $this->nmgp_dados_select['datahoraemissao'];
              if (isset($NM_val_form['datahoraemissao']) && $NM_val_form['datahoraemissao'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataHoraEmissao = #$this->datahoraemissao#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataHoraEmissao = " . $this->Ini->date_delim . $this->datahoraemissao . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['valortotal']) && $NM_val_form['valortotal'] == "null"  && $this->nmgp_dados_select['valortotal'] == "") ? "null" : $this->nmgp_dados_select['valortotal'];
              if (isset($NM_val_form['valortotal']) && $NM_val_form['valortotal'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorTotal = $this->valortotal"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valordesconto']) && $NM_val_form['valordesconto'] == "null"  && $this->nmgp_dados_select['valordesconto'] == "") ? "null" : $this->nmgp_dados_select['valordesconto'];
              if (isset($NM_val_form['valordesconto']) && $NM_val_form['valordesconto'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorDesconto = $this->valordesconto"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valorliquido']) && $NM_val_form['valorliquido'] == "null"  && $this->nmgp_dados_select['valorliquido'] == "") ? "null" : $this->nmgp_dados_select['valorliquido'];
              if (isset($NM_val_form['valorliquido']) && $NM_val_form['valorliquido'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorLiquido = $this->valorliquido"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valorcofins']) && $NM_val_form['valorcofins'] == "null"  && $this->nmgp_dados_select['valorcofins'] == "") ? "null" : $this->nmgp_dados_select['valorcofins'];
              if (isset($NM_val_form['valorcofins']) && $NM_val_form['valorcofins'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorCofins = $this->valorcofins"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valorpis']) && $NM_val_form['valorpis'] == "null"  && $this->nmgp_dados_select['valorpis'] == "") ? "null" : $this->nmgp_dados_select['valorpis'];
              if (isset($NM_val_form['valorpis']) && $NM_val_form['valorpis'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorPis = $this->valorpis"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valoricms']) && $NM_val_form['valoricms'] == "null"  && $this->nmgp_dados_select['valoricms'] == "") ? "null" : $this->nmgp_dados_select['valoricms'];
              if (isset($NM_val_form['valoricms']) && $NM_val_form['valoricms'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorIcms = $this->valoricms"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valorfrete']) && $NM_val_form['valorfrete'] == "null"  && $this->nmgp_dados_select['valorfrete'] == "") ? "null" : $this->nmgp_dados_select['valorfrete'];
              if (isset($NM_val_form['valorfrete']) && $NM_val_form['valorfrete'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorFrete = $this->valorfrete"; 
              } 
              $Prep_Tst = (isset($NM_val_form['qtdprodutos']) && $NM_val_form['qtdprodutos'] == "null"  && $this->nmgp_dados_select['qtdprodutos'] == "") ? "null" : $this->nmgp_dados_select['qtdprodutos'];
              if (isset($NM_val_form['qtdprodutos']) && $NM_val_form['qtdprodutos'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "QtdProdutos = $this->qtdprodutos"; 
              } 
              $Prep_Tst = (isset($NM_val_form['qtdparcelas']) && $NM_val_form['qtdparcelas'] == "null"  && $this->nmgp_dados_select['qtdparcelas'] == "") ? "null" : $this->nmgp_dados_select['qtdparcelas'];
              if (isset($NM_val_form['qtdparcelas']) && $NM_val_form['qtdparcelas'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "QtdParcelas = $this->qtdparcelas"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nomearquivo']) && $NM_val_form['nomearquivo'] == "null"  && $this->nmgp_dados_select['nomearquivo'] == "") ? "null" : $this->nmgp_dados_select['nomearquivo'];
              if (isset($NM_val_form['nomearquivo']) && $NM_val_form['nomearquivo'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NomeArquivo = '$this->nomearquivo'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['observacoes']) && $NM_val_form['observacoes'] == "null"  && $this->nmgp_dados_select['observacoes'] == "") ? "null" : $this->nmgp_dados_select['observacoes'];
              if (isset($NM_val_form['observacoes']) && $NM_val_form['observacoes'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Observacoes = '$this->observacoes'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['datahorainclusao']) && $NM_val_form['datahorainclusao'] == "null"  && $this->nmgp_dados_select['datahorainclusao'] == "") ? "null" : $this->nmgp_dados_select['datahorainclusao'];
              if (isset($NM_val_form['datahorainclusao']) && $NM_val_form['datahorainclusao'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataHoraInclusao = #$this->datahorainclusao#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataHoraInclusao = " . $this->Ini->date_delim . $this->datahorainclusao . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['enderecoipauditoria']) && $NM_val_form['enderecoipauditoria'] == "null"  && $this->nmgp_dados_select['enderecoipauditoria'] == "") ? "null" : $this->nmgp_dados_select['enderecoipauditoria'];
              if (isset($NM_val_form['enderecoipauditoria']) && $NM_val_form['enderecoipauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "EnderecoIpAuditoria = '$this->enderecoipauditoria'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nomeaplicacaoauditoria']) && $NM_val_form['nomeaplicacaoauditoria'] == "null"  && $this->nmgp_dados_select['nomeaplicacaoauditoria'] == "") ? "null" : $this->nmgp_dados_select['nomeaplicacaoauditoria'];
              if (isset($NM_val_form['nomeaplicacaoauditoria']) && $NM_val_form['nomeaplicacaoauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NomeAplicacaoAuditoria = '$this->nomeaplicacaoauditoria'"; 
              } 
              $temp_cmd_sql = "";
              if ($this->nomereferencia_limpa == "S")
              {
                  if ($this->nomereferencia != "null")
                  {
                      $this->nomereferencia = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                      $temp_cmd_sql = "NomeReferencia = '" . $this->nomereferencia . "'";
                  }
                  else
                  {
                      $temp_cmd_sql = "NomeReferencia = '" . $this->nomereferencia . "'";
                  }
                  $this->nomereferencia = "";
              }
              else
              {
                  if ($this->nomereferencia != "none" && $this->nomereferencia != "" && $this->nomereferencia != "*nm*")
                  {
                      $NM_conteudo =  $this->nomereferencia;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      $temp_cmd_sql .= " NomeReferencia = '$NM_conteudo'";
                      }
                      else
                      {
                          $temp_cmd_sql .= " NomeReferencia = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "nomereferencia";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada ";  
              }  
              else  
              {
                  $comando .= " WHERE IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada ";  
              }  
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              $useUpdateProcedure = false;
              if (!empty($SC_fields_update) || $useUpdateProcedure)
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
                  $rs = $this->Db->Execute($comando);  
                  if ($rs === false) 
                  { 
                      if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                      {
                          $dbErrorMessage = $this->Db->ErrorMsg();
                          $dbErrorCode = $this->Db->ErrorNo();
                          $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $dbErrorMessage, true);
                          if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                          { 
                              $this->sc_erro_update = $dbErrorMessage;
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  AlmoxarifadoEntrada_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->cnpj = $this->cnpj_before_qstr;
              $this->razaosocial = $this->razaosocial_before_qstr;
              $this->nomefantasia = $this->nomefantasia_before_qstr;
              $this->versao = $this->versao_before_qstr;
              $this->codigo = $this->codigo_before_qstr;
              $this->chave = $this->chave_before_qstr;
              $this->numeronota = $this->numeronota_before_qstr;
              $this->numerofatura = $this->numerofatura_before_qstr;
              $this->natureza = $this->natureza_before_qstr;
              $this->serie = $this->serie_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->parcela = $this->parcela_before_qstr;
              $this->produto = $this->produto_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
              if ($this->nomereferencia_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['nomereferencia_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['nomereferencia_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idalmoxarifadoentrada'])) { $this->idalmoxarifadoentrada = $NM_val_form['idalmoxarifadoentrada']; }
              elseif (isset($this->idalmoxarifadoentrada)) { $this->nm_limpa_alfa($this->idalmoxarifadoentrada); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtenacidade'])) { $this->idtenacidade = $NM_val_form['idtenacidade']; }
              elseif (isset($this->idtenacidade)) { $this->nm_limpa_alfa($this->idtenacidade); }
              if     (isset($NM_val_form) && isset($NM_val_form['idfornecedor'])) { $this->idfornecedor = $NM_val_form['idfornecedor']; }
              elseif (isset($this->idfornecedor)) { $this->nm_limpa_alfa($this->idfornecedor); }
              if     (isset($NM_val_form) && isset($NM_val_form['idalmoxarifado'])) { $this->idalmoxarifado = $NM_val_form['idalmoxarifado']; }
              elseif (isset($this->idalmoxarifado)) { $this->nm_limpa_alfa($this->idalmoxarifado); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuarioauditoria'])) { $this->idusuarioauditoria = $NM_val_form['idusuarioauditoria']; }
              elseif (isset($this->idusuarioauditoria)) { $this->nm_limpa_alfa($this->idusuarioauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['cnpj'])) { $this->cnpj = $NM_val_form['cnpj']; }
              elseif (isset($this->cnpj)) { $this->nm_limpa_alfa($this->cnpj); }
              if     (isset($NM_val_form) && isset($NM_val_form['razaosocial'])) { $this->razaosocial = $NM_val_form['razaosocial']; }
              elseif (isset($this->razaosocial)) { $this->nm_limpa_alfa($this->razaosocial); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomefantasia'])) { $this->nomefantasia = $NM_val_form['nomefantasia']; }
              elseif (isset($this->nomefantasia)) { $this->nm_limpa_alfa($this->nomefantasia); }
              if     (isset($NM_val_form) && isset($NM_val_form['versao'])) { $this->versao = $NM_val_form['versao']; }
              elseif (isset($this->versao)) { $this->nm_limpa_alfa($this->versao); }
              if     (isset($NM_val_form) && isset($NM_val_form['codigo'])) { $this->codigo = $NM_val_form['codigo']; }
              elseif (isset($this->codigo)) { $this->nm_limpa_alfa($this->codigo); }
              if     (isset($NM_val_form) && isset($NM_val_form['chave'])) { $this->chave = $NM_val_form['chave']; }
              elseif (isset($this->chave)) { $this->nm_limpa_alfa($this->chave); }
              if     (isset($NM_val_form) && isset($NM_val_form['numeronota'])) { $this->numeronota = $NM_val_form['numeronota']; }
              elseif (isset($this->numeronota)) { $this->nm_limpa_alfa($this->numeronota); }
              if     (isset($NM_val_form) && isset($NM_val_form['numerofatura'])) { $this->numerofatura = $NM_val_form['numerofatura']; }
              elseif (isset($this->numerofatura)) { $this->nm_limpa_alfa($this->numerofatura); }
              if     (isset($NM_val_form) && isset($NM_val_form['natureza'])) { $this->natureza = $NM_val_form['natureza']; }
              elseif (isset($this->natureza)) { $this->nm_limpa_alfa($this->natureza); }
              if     (isset($NM_val_form) && isset($NM_val_form['serie'])) { $this->serie = $NM_val_form['serie']; }
              elseif (isset($this->serie)) { $this->nm_limpa_alfa($this->serie); }
              if     (isset($NM_val_form) && isset($NM_val_form['valortotal'])) { $this->valortotal = $NM_val_form['valortotal']; }
              elseif (isset($this->valortotal)) { $this->nm_limpa_alfa($this->valortotal); }
              if     (isset($NM_val_form) && isset($NM_val_form['valordesconto'])) { $this->valordesconto = $NM_val_form['valordesconto']; }
              elseif (isset($this->valordesconto)) { $this->nm_limpa_alfa($this->valordesconto); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorliquido'])) { $this->valorliquido = $NM_val_form['valorliquido']; }
              elseif (isset($this->valorliquido)) { $this->nm_limpa_alfa($this->valorliquido); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorcofins'])) { $this->valorcofins = $NM_val_form['valorcofins']; }
              elseif (isset($this->valorcofins)) { $this->nm_limpa_alfa($this->valorcofins); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorpis'])) { $this->valorpis = $NM_val_form['valorpis']; }
              elseif (isset($this->valorpis)) { $this->nm_limpa_alfa($this->valorpis); }
              if     (isset($NM_val_form) && isset($NM_val_form['valoricms'])) { $this->valoricms = $NM_val_form['valoricms']; }
              elseif (isset($this->valoricms)) { $this->nm_limpa_alfa($this->valoricms); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorfrete'])) { $this->valorfrete = $NM_val_form['valorfrete']; }
              elseif (isset($this->valorfrete)) { $this->nm_limpa_alfa($this->valorfrete); }
              if     (isset($NM_val_form) && isset($NM_val_form['qtdprodutos'])) { $this->qtdprodutos = $NM_val_form['qtdprodutos']; }
              elseif (isset($this->qtdprodutos)) { $this->nm_limpa_alfa($this->qtdprodutos); }
              if     (isset($NM_val_form) && isset($NM_val_form['qtdparcelas'])) { $this->qtdparcelas = $NM_val_form['qtdparcelas']; }
              elseif (isset($this->qtdparcelas)) { $this->nm_limpa_alfa($this->qtdparcelas); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomearquivo'])) { $this->nomearquivo = $NM_val_form['nomearquivo']; }
              elseif (isset($this->nomearquivo)) { $this->nm_limpa_alfa($this->nomearquivo); }
              if     (isset($NM_val_form) && isset($NM_val_form['observacoes'])) { $this->observacoes = $NM_val_form['observacoes']; }
              elseif (isset($this->observacoes)) { $this->nm_limpa_alfa($this->observacoes); }
              if     (isset($NM_val_form) && isset($NM_val_form['enderecoipauditoria'])) { $this->enderecoipauditoria = $NM_val_form['enderecoipauditoria']; }
              elseif (isset($this->enderecoipauditoria)) { $this->nm_limpa_alfa($this->enderecoipauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomeaplicacaoauditoria'])) { $this->nomeaplicacaoauditoria = $NM_val_form['nomeaplicacaoauditoria']; }
              elseif (isset($this->nomeaplicacaoauditoria)) { $this->nm_limpa_alfa($this->nomeaplicacaoauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['parcela'])) { $this->parcela = $NM_val_form['parcela']; }
              elseif (isset($this->parcela)) { $this->nm_limpa_alfa($this->parcela); }
              if     (isset($NM_val_form) && isset($NM_val_form['produto'])) { $this->produto = $NM_val_form['produto']; }
              elseif (isset($this->produto)) { $this->nm_limpa_alfa($this->produto); }

              $this->nm_formatar_campos();

              $bChange_nomereferencia = false;
              if (isset($this->nomereferencia_original_filename) && '' != $this->nomereferencia_original_filename && $this->nomereferencia_original_filename != $this->nomereferencia)
              {
                  $sTmpOrig_nomereferencia = $this->nomereferencia;
                  $this->nomereferencia    = $this->nomereferencia_original_filename;
                  $bChange_nomereferencia  = true;
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('idfornecedor', 'cnpj', 'datahorainclusao', 'idalmoxarifadoentrada', 'razaosocial', 'nomefantasia', 'idalmoxarifado', 'nomearquivo', 'nomereferencia', 'datahoraemissao', 'versao', 'chave', 'codigo', 'numeronota', 'natureza', 'serie', 'valorcofins', 'valorpis', 'valoricms', 'valorfrete', 'valortotal', 'valorliquido', 'valordesconto', 'produto', 'parcela', 'observacoes', 'qtdparcelas', 'qtdprodutos', 'numerofatura', 'idtenacidade', 'idusuarioauditoria', 'enderecoipauditoria', 'nomeaplicacaoauditoria'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              if ($bChange_nomereferencia)
              {
                  $this->nomereferencia                   = $sTmpOrig_nomereferencia;
                  $this->nomereferencia_original_filename = '';
              }

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "IdAlmoxarifadoEntrada, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(IdAlmoxarifadoEntrada) from " . $this->Ini->nm_tabela; 
          $comando = "select max(IdAlmoxarifadoEntrada) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  AlmoxarifadoEntrada_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $this->idalmoxarifadoentrada_before_qstr = $this->idalmoxarifadoentrada = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      AlmoxarifadoEntrada_Frm_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $dir_file = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
              $_test_file = $this->fetchUniqueUploadName($this->nomereferencia_scfile_name, $dir_file, "nomereferencia");
              if (trim($this->nomereferencia_scfile_name) != $_test_file)
              {
                  $this->nomereferencia_scfile_name = $_test_file;
                  $this->nomereferencia = $_test_file;
                 $this->produto_before_qstr = $this->produto;
                 $this->produto = substr($this->Db->qstr($this->produto), 1, -1); 
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idtenacidade != "")
                  { 
                       $compl_insert     .= ", IdTenacidade";
                       $compl_insert_val .= ", $this->idtenacidade";
                  } 
                  if ($this->idalmoxarifado != "")
                  { 
                       $compl_insert     .= ", IdAlmoxarifado";
                       $compl_insert_val .= ", $this->idalmoxarifado";
                  } 
                  if ($this->idusuarioauditoria != "")
                  { 
                       $compl_insert     .= ", IdUsuarioAuditoria";
                       $compl_insert_val .= ", $this->idusuarioauditoria";
                  } 
                  if ($this->cnpj != "")
                  { 
                       $compl_insert     .= ", Cnpj";
                       $compl_insert_val .= ", '$this->cnpj'";
                  } 
                  if ($this->razaosocial != "")
                  { 
                       $compl_insert     .= ", RazaoSocial";
                       $compl_insert_val .= ", '$this->razaosocial'";
                  } 
                  if ($this->nomefantasia != "")
                  { 
                       $compl_insert     .= ", NomeFantasia";
                       $compl_insert_val .= ", '$this->nomefantasia'";
                  } 
                  if ($this->versao != "")
                  { 
                       $compl_insert     .= ", Versao";
                       $compl_insert_val .= ", '$this->versao'";
                  } 
                  if ($this->codigo != "")
                  { 
                       $compl_insert     .= ", Codigo";
                       $compl_insert_val .= ", '$this->codigo'";
                  } 
                  if ($this->chave != "")
                  { 
                       $compl_insert     .= ", Chave";
                       $compl_insert_val .= ", '$this->chave'";
                  } 
                  if ($this->numeronota != "")
                  { 
                       $compl_insert     .= ", Numeronota";
                       $compl_insert_val .= ", '$this->numeronota'";
                  } 
                  if ($this->numerofatura != "")
                  { 
                       $compl_insert     .= ", Numerofatura";
                       $compl_insert_val .= ", '$this->numerofatura'";
                  } 
                  if ($this->natureza != "")
                  { 
                       $compl_insert     .= ", Natureza";
                       $compl_insert_val .= ", '$this->natureza'";
                  } 
                  if ($this->serie != "")
                  { 
                       $compl_insert     .= ", Serie";
                       $compl_insert_val .= ", '$this->serie'";
                  } 
                  if ($this->datahoraemissao != "")
                  { 
                       $compl_insert     .= ", DataHoraEmissao";
                       $compl_insert_val .= ", #$this->datahoraemissao#";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valorcofins != "")
                  { 
                       $compl_insert     .= ", ValorCofins";
                       $compl_insert_val .= ", $this->valorcofins";
                  } 
                  if ($this->valorpis != "")
                  { 
                       $compl_insert     .= ", ValorPis";
                       $compl_insert_val .= ", $this->valorpis";
                  } 
                  if ($this->valoricms != "")
                  { 
                       $compl_insert     .= ", ValorIcms";
                       $compl_insert_val .= ", $this->valoricms";
                  } 
                  if ($this->valorfrete != "")
                  { 
                       $compl_insert     .= ", ValorFrete";
                       $compl_insert_val .= ", $this->valorfrete";
                  } 
                  if ($this->qtdprodutos != "")
                  { 
                       $compl_insert     .= ", QtdProdutos";
                       $compl_insert_val .= ", $this->qtdprodutos";
                  } 
                  if ($this->qtdparcelas != "")
                  { 
                       $compl_insert     .= ", QtdParcelas";
                       $compl_insert_val .= ", $this->qtdparcelas";
                  } 
                  if ($this->nomearquivo != "")
                  { 
                       $compl_insert     .= ", NomeArquivo";
                       $compl_insert_val .= ", '$this->nomearquivo'";
                  } 
                  if ($this->nomereferencia != "")
                  { 
                       $compl_insert     .= ", NomeReferencia";
                       $compl_insert_val .= ", '$this->nomereferencia'";
                  } 
                  if ($this->datahorainclusao != "")
                  { 
                       $compl_insert     .= ", DataHoraInclusao";
                       $compl_insert_val .= ", #$this->datahorainclusao#";
                  } 
                  if ($this->enderecoipauditoria != "")
                  { 
                       $compl_insert     .= ", EnderecoIpAuditoria";
                       $compl_insert_val .= ", '$this->enderecoipauditoria'";
                  } 
                  if ($this->nomeaplicacaoauditoria != "")
                  { 
                       $compl_insert     .= ", NomeAplicacaoAuditoria";
                       $compl_insert_val .= ", '$this->nomeaplicacaoauditoria'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdFornecedor, ValorTotal, ValorLiquido, Observacoes $compl_insert) VALUES ($this->idfornecedor, $this->valortotal, $this->valorliquido, '$this->observacoes' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idtenacidade != "")
                  { 
                       $compl_insert     .= ", IdTenacidade";
                       $compl_insert_val .= ", $this->idtenacidade";
                  } 
                  if ($this->idalmoxarifado != "")
                  { 
                       $compl_insert     .= ", IdAlmoxarifado";
                       $compl_insert_val .= ", $this->idalmoxarifado";
                  } 
                  if ($this->idusuarioauditoria != "")
                  { 
                       $compl_insert     .= ", IdUsuarioAuditoria";
                       $compl_insert_val .= ", $this->idusuarioauditoria";
                  } 
                  if ($this->cnpj != "")
                  { 
                       $compl_insert     .= ", Cnpj";
                       $compl_insert_val .= ", '$this->cnpj'";
                  } 
                  if ($this->razaosocial != "")
                  { 
                       $compl_insert     .= ", RazaoSocial";
                       $compl_insert_val .= ", '$this->razaosocial'";
                  } 
                  if ($this->nomefantasia != "")
                  { 
                       $compl_insert     .= ", NomeFantasia";
                       $compl_insert_val .= ", '$this->nomefantasia'";
                  } 
                  if ($this->versao != "")
                  { 
                       $compl_insert     .= ", Versao";
                       $compl_insert_val .= ", '$this->versao'";
                  } 
                  if ($this->codigo != "")
                  { 
                       $compl_insert     .= ", Codigo";
                       $compl_insert_val .= ", '$this->codigo'";
                  } 
                  if ($this->chave != "")
                  { 
                       $compl_insert     .= ", Chave";
                       $compl_insert_val .= ", '$this->chave'";
                  } 
                  if ($this->numeronota != "")
                  { 
                       $compl_insert     .= ", Numeronota";
                       $compl_insert_val .= ", '$this->numeronota'";
                  } 
                  if ($this->numerofatura != "")
                  { 
                       $compl_insert     .= ", Numerofatura";
                       $compl_insert_val .= ", '$this->numerofatura'";
                  } 
                  if ($this->natureza != "")
                  { 
                       $compl_insert     .= ", Natureza";
                       $compl_insert_val .= ", '$this->natureza'";
                  } 
                  if ($this->serie != "")
                  { 
                       $compl_insert     .= ", Serie";
                       $compl_insert_val .= ", '$this->serie'";
                  } 
                  if ($this->datahoraemissao != "")
                  { 
                       $compl_insert     .= ", DataHoraEmissao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datahoraemissao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valorcofins != "")
                  { 
                       $compl_insert     .= ", ValorCofins";
                       $compl_insert_val .= ", $this->valorcofins";
                  } 
                  if ($this->valorpis != "")
                  { 
                       $compl_insert     .= ", ValorPis";
                       $compl_insert_val .= ", $this->valorpis";
                  } 
                  if ($this->valoricms != "")
                  { 
                       $compl_insert     .= ", ValorIcms";
                       $compl_insert_val .= ", $this->valoricms";
                  } 
                  if ($this->valorfrete != "")
                  { 
                       $compl_insert     .= ", ValorFrete";
                       $compl_insert_val .= ", $this->valorfrete";
                  } 
                  if ($this->qtdprodutos != "")
                  { 
                       $compl_insert     .= ", QtdProdutos";
                       $compl_insert_val .= ", $this->qtdprodutos";
                  } 
                  if ($this->qtdparcelas != "")
                  { 
                       $compl_insert     .= ", QtdParcelas";
                       $compl_insert_val .= ", $this->qtdparcelas";
                  } 
                  if ($this->nomearquivo != "")
                  { 
                       $compl_insert     .= ", NomeArquivo";
                       $compl_insert_val .= ", '$this->nomearquivo'";
                  } 
                  if ($this->nomereferencia != "")
                  { 
                       $compl_insert     .= ", NomeReferencia";
                       $compl_insert_val .= ", '$this->nomereferencia'";
                  } 
                  if ($this->datahorainclusao != "")
                  { 
                       $compl_insert     .= ", DataHoraInclusao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datahorainclusao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->enderecoipauditoria != "")
                  { 
                       $compl_insert     .= ", EnderecoIpAuditoria";
                       $compl_insert_val .= ", '$this->enderecoipauditoria'";
                  } 
                  if ($this->nomeaplicacaoauditoria != "")
                  { 
                       $compl_insert     .= ", NomeAplicacaoAuditoria";
                       $compl_insert_val .= ", '$this->nomeaplicacaoauditoria'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdFornecedor, ValorTotal, ValorLiquido, Observacoes $compl_insert) VALUES (" . $NM_seq_auto . "$this->idfornecedor, $this->valortotal, $this->valorliquido, '$this->observacoes' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idtenacidade != "")
                  { 
                       $compl_insert     .= ", IdTenacidade";
                       $compl_insert_val .= ", $this->idtenacidade";
                  } 
                  if ($this->idalmoxarifado != "")
                  { 
                       $compl_insert     .= ", IdAlmoxarifado";
                       $compl_insert_val .= ", $this->idalmoxarifado";
                  } 
                  if ($this->idusuarioauditoria != "")
                  { 
                       $compl_insert     .= ", IdUsuarioAuditoria";
                       $compl_insert_val .= ", $this->idusuarioauditoria";
                  } 
                  if ($this->cnpj != "")
                  { 
                       $compl_insert     .= ", Cnpj";
                       $compl_insert_val .= ", '$this->cnpj'";
                  } 
                  if ($this->razaosocial != "")
                  { 
                       $compl_insert     .= ", RazaoSocial";
                       $compl_insert_val .= ", '$this->razaosocial'";
                  } 
                  if ($this->nomefantasia != "")
                  { 
                       $compl_insert     .= ", NomeFantasia";
                       $compl_insert_val .= ", '$this->nomefantasia'";
                  } 
                  if ($this->versao != "")
                  { 
                       $compl_insert     .= ", Versao";
                       $compl_insert_val .= ", '$this->versao'";
                  } 
                  if ($this->codigo != "")
                  { 
                       $compl_insert     .= ", Codigo";
                       $compl_insert_val .= ", '$this->codigo'";
                  } 
                  if ($this->chave != "")
                  { 
                       $compl_insert     .= ", Chave";
                       $compl_insert_val .= ", '$this->chave'";
                  } 
                  if ($this->numeronota != "")
                  { 
                       $compl_insert     .= ", Numeronota";
                       $compl_insert_val .= ", '$this->numeronota'";
                  } 
                  if ($this->numerofatura != "")
                  { 
                       $compl_insert     .= ", Numerofatura";
                       $compl_insert_val .= ", '$this->numerofatura'";
                  } 
                  if ($this->natureza != "")
                  { 
                       $compl_insert     .= ", Natureza";
                       $compl_insert_val .= ", '$this->natureza'";
                  } 
                  if ($this->serie != "")
                  { 
                       $compl_insert     .= ", Serie";
                       $compl_insert_val .= ", '$this->serie'";
                  } 
                  if ($this->datahoraemissao != "")
                  { 
                       $compl_insert     .= ", DataHoraEmissao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datahoraemissao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valorcofins != "")
                  { 
                       $compl_insert     .= ", ValorCofins";
                       $compl_insert_val .= ", $this->valorcofins";
                  } 
                  if ($this->valorpis != "")
                  { 
                       $compl_insert     .= ", ValorPis";
                       $compl_insert_val .= ", $this->valorpis";
                  } 
                  if ($this->valoricms != "")
                  { 
                       $compl_insert     .= ", ValorIcms";
                       $compl_insert_val .= ", $this->valoricms";
                  } 
                  if ($this->valorfrete != "")
                  { 
                       $compl_insert     .= ", ValorFrete";
                       $compl_insert_val .= ", $this->valorfrete";
                  } 
                  if ($this->qtdprodutos != "")
                  { 
                       $compl_insert     .= ", QtdProdutos";
                       $compl_insert_val .= ", $this->qtdprodutos";
                  } 
                  if ($this->qtdparcelas != "")
                  { 
                       $compl_insert     .= ", QtdParcelas";
                       $compl_insert_val .= ", $this->qtdparcelas";
                  } 
                  if ($this->nomearquivo != "")
                  { 
                       $compl_insert     .= ", NomeArquivo";
                       $compl_insert_val .= ", '$this->nomearquivo'";
                  } 
                  if ($this->nomereferencia != "")
                  { 
                       $compl_insert     .= ", NomeReferencia";
                       $compl_insert_val .= ", '$this->nomereferencia'";
                  } 
                  if ($this->datahorainclusao != "")
                  { 
                       $compl_insert     .= ", DataHoraInclusao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datahorainclusao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->enderecoipauditoria != "")
                  { 
                       $compl_insert     .= ", EnderecoIpAuditoria";
                       $compl_insert_val .= ", '$this->enderecoipauditoria'";
                  } 
                  if ($this->nomeaplicacaoauditoria != "")
                  { 
                       $compl_insert     .= ", NomeAplicacaoAuditoria";
                       $compl_insert_val .= ", '$this->nomeaplicacaoauditoria'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdFornecedor, ValorTotal, ValorLiquido, Observacoes $compl_insert) VALUES (" . $NM_seq_auto . "$this->idfornecedor, $this->valortotal, $this->valorliquido, '$this->observacoes' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idtenacidade != "")
                  { 
                       $compl_insert     .= ", IdTenacidade";
                       $compl_insert_val .= ", $this->idtenacidade";
                  } 
                  if ($this->idalmoxarifado != "")
                  { 
                       $compl_insert     .= ", IdAlmoxarifado";
                       $compl_insert_val .= ", $this->idalmoxarifado";
                  } 
                  if ($this->idusuarioauditoria != "")
                  { 
                       $compl_insert     .= ", IdUsuarioAuditoria";
                       $compl_insert_val .= ", $this->idusuarioauditoria";
                  } 
                  if ($this->cnpj != "")
                  { 
                       $compl_insert     .= ", Cnpj";
                       $compl_insert_val .= ", '$this->cnpj'";
                  } 
                  if ($this->razaosocial != "")
                  { 
                       $compl_insert     .= ", RazaoSocial";
                       $compl_insert_val .= ", '$this->razaosocial'";
                  } 
                  if ($this->nomefantasia != "")
                  { 
                       $compl_insert     .= ", NomeFantasia";
                       $compl_insert_val .= ", '$this->nomefantasia'";
                  } 
                  if ($this->versao != "")
                  { 
                       $compl_insert     .= ", Versao";
                       $compl_insert_val .= ", '$this->versao'";
                  } 
                  if ($this->codigo != "")
                  { 
                       $compl_insert     .= ", Codigo";
                       $compl_insert_val .= ", '$this->codigo'";
                  } 
                  if ($this->chave != "")
                  { 
                       $compl_insert     .= ", Chave";
                       $compl_insert_val .= ", '$this->chave'";
                  } 
                  if ($this->numeronota != "")
                  { 
                       $compl_insert     .= ", Numeronota";
                       $compl_insert_val .= ", '$this->numeronota'";
                  } 
                  if ($this->numerofatura != "")
                  { 
                       $compl_insert     .= ", Numerofatura";
                       $compl_insert_val .= ", '$this->numerofatura'";
                  } 
                  if ($this->natureza != "")
                  { 
                       $compl_insert     .= ", Natureza";
                       $compl_insert_val .= ", '$this->natureza'";
                  } 
                  if ($this->serie != "")
                  { 
                       $compl_insert     .= ", Serie";
                       $compl_insert_val .= ", '$this->serie'";
                  } 
                  if ($this->datahoraemissao != "")
                  { 
                       $compl_insert     .= ", DataHoraEmissao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datahoraemissao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valorcofins != "")
                  { 
                       $compl_insert     .= ", ValorCofins";
                       $compl_insert_val .= ", $this->valorcofins";
                  } 
                  if ($this->valorpis != "")
                  { 
                       $compl_insert     .= ", ValorPis";
                       $compl_insert_val .= ", $this->valorpis";
                  } 
                  if ($this->valoricms != "")
                  { 
                       $compl_insert     .= ", ValorIcms";
                       $compl_insert_val .= ", $this->valoricms";
                  } 
                  if ($this->valorfrete != "")
                  { 
                       $compl_insert     .= ", ValorFrete";
                       $compl_insert_val .= ", $this->valorfrete";
                  } 
                  if ($this->qtdprodutos != "")
                  { 
                       $compl_insert     .= ", QtdProdutos";
                       $compl_insert_val .= ", $this->qtdprodutos";
                  } 
                  if ($this->qtdparcelas != "")
                  { 
                       $compl_insert     .= ", QtdParcelas";
                       $compl_insert_val .= ", $this->qtdparcelas";
                  } 
                  if ($this->nomearquivo != "")
                  { 
                       $compl_insert     .= ", NomeArquivo";
                       $compl_insert_val .= ", '$this->nomearquivo'";
                  } 
                  if ($this->nomereferencia != "")
                  { 
                       $compl_insert     .= ", NomeReferencia";
                       $compl_insert_val .= ", '$this->nomereferencia'";
                  } 
                  if ($this->datahorainclusao != "")
                  { 
                       $compl_insert     .= ", DataHoraInclusao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datahorainclusao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->enderecoipauditoria != "")
                  { 
                       $compl_insert     .= ", EnderecoIpAuditoria";
                       $compl_insert_val .= ", '$this->enderecoipauditoria'";
                  } 
                  if ($this->nomeaplicacaoauditoria != "")
                  { 
                       $compl_insert     .= ", NomeAplicacaoAuditoria";
                       $compl_insert_val .= ", '$this->nomeaplicacaoauditoria'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdFornecedor, ValorTotal, ValorLiquido, Observacoes $compl_insert) VALUES (" . $NM_seq_auto . "$this->idfornecedor, $this->valortotal, $this->valorliquido, '$this->observacoes' $compl_insert_val)"; 
              }
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
              $rs = $this->Db->Execute($comando); 
              if ($rs === false)  
              { 
                  if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                  {
                      $dbErrorMessage = $this->Db->ErrorMsg();
                      $dbErrorCode = $this->Db->ErrorNo();
                      $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $dbErrorMessage, true);
                      if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
                      { 
                          $this->sc_erro_insert = $dbErrorMessage;
                          $this->nmgp_opcao     = 'refresh_insert';
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              AlmoxarifadoEntrada_Frm_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select @@identity"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          AlmoxarifadoEntrada_Frm_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->idalmoxarifadoentrada =  $rsy->fields[0];
                 $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  {
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_id()"; 
                  }
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->idalmoxarifadoentrada = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select CURRVAL('')"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->idalmoxarifadoentrada = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_rowid()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->idalmoxarifadoentrada = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->cnpj = $this->cnpj_before_qstr;
              $this->razaosocial = $this->razaosocial_before_qstr;
              $this->nomefantasia = $this->nomefantasia_before_qstr;
              $this->versao = $this->versao_before_qstr;
              $this->codigo = $this->codigo_before_qstr;
              $this->chave = $this->chave_before_qstr;
              $this->numeronota = $this->numeronota_before_qstr;
              $this->numerofatura = $this->numerofatura_before_qstr;
              $this->natureza = $this->natureza_before_qstr;
              $this->serie = $this->serie_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->parcela = $this->parcela_before_qstr;
              $this->produto = $this->produto_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total']);
              }

              $dir_doc = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
              $reg_nomereferencia = ""; 
              if (is_file($this->SC_DOC_nomereferencia)) { 
                  $arq_nomereferencia = fopen($this->SC_DOC_nomereferencia, "r") ; 
                  $reg_nomereferencia = fread($arq_nomereferencia, filesize($this->SC_DOC_nomereferencia)) ; 
                  fclose($arq_nomereferencia) ;  
                  $arq_nomereferencia = fopen($dir_doc . trim($this->nomereferencia_scfile_name), "w") ; 
                  fwrite($arq_nomereferencia, $reg_nomereferencia) ;  
                  fclose($arq_nomereferencia) ;  
              }
              $this->sc_evento = "insert"; 
              $this->cnpj = $this->cnpj_before_qstr;
              $this->razaosocial = $this->razaosocial_before_qstr;
              $this->nomefantasia = $this->nomefantasia_before_qstr;
              $this->versao = $this->versao_before_qstr;
              $this->codigo = $this->codigo_before_qstr;
              $this->chave = $this->chave_before_qstr;
              $this->numeronota = $this->numeronota_before_qstr;
              $this->numerofatura = $this->numerofatura_before_qstr;
              $this->natureza = $this->natureza_before_qstr;
              $this->serie = $this->serie_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->parcela = $this->parcela_before_qstr;
              $this->produto = $this->produto_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->idalmoxarifadoentrada = substr($this->Db->qstr($this->idalmoxarifadoentrada), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_dele_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada "); 
              }  
              if ($rs === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg(), true); 
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                  { 
                      $this->sc_erro_delete = $this->Db->ErrorMsg();  
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          AlmoxarifadoEntrada_Frm_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              if (empty($this->sc_erro_delete)) {
                  $this->record_delete_ok = true;
              }
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total']);
              }

              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
          }

          }
          else
          {
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "igual"; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sMsgErro); 
          }

      }  
      $this->restore_zeros_null();
    if ("insert" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        
/*----- Scriptcase Locale: Event onAfterInsert ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'on';
  if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('AlmoxarifadoEntrada_Lst') . "/AlmoxarifadoEntrada_Lst.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterInsert ------*/
 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $salva_opcao ; 
          if ($salva_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->sc_evento = ""; 
          $this->NM_rollback_db(); 
          return; 
      }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['parms'] = "idalmoxarifadoentrada?#?$this->idalmoxarifadoentrada?@?"; 
      }
      $this->nmgp_dados_form['nomereferencia'] = ""; 
      $this->nomereferencia_limpa = ""; 
      $this->nomereferencia_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idalmoxarifadoentrada = null === $this->idalmoxarifadoentrada ? null : substr($this->Db->qstr($this->idalmoxarifadoentrada), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter'] . ")";
          }
      }
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "inicio")
      { 
          $this->nmgp_opcao = "igual"; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdAlmoxarifadoEntrada, IdTenacidade, IdFornecedor, IdAlmoxarifado, IdUsuarioAuditoria, Cnpj, RazaoSocial, NomeFantasia, Versao, Codigo, Chave, Numeronota, Numerofatura, Natureza, Serie, DataHoraEmissao, ValorTotal, ValorDesconto, ValorLiquido, ValorCofins, ValorPis, ValorIcms, ValorFrete, QtdProdutos, QtdParcelas, NomeArquivo, NomeReferencia, Observacoes, DataHoraInclusao, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = "(IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada"; 
                  }  
                  else  
                  {
                     $aWhere[] = "IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "IdAlmoxarifadoEntrada";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start']) ;  
              } 
          } 
          if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs->EOF) 
          { 
              $this->NM_ajax_info['navSummary']['reg_ini'] = 0; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = 0; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = 0; 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter'] = true;
                  return; 
              }
              if ($this->nmgp_botoes['insert'] != "on")
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
              }
              $this->nmgp_opcao = "novo"; 
              $this->nm_flag_saida_novo = "S"; 
              $rs->Close(); 
              if ($this->aba_iframe)
              {
                  $this->NM_ajax_info['buttonDisplay']['exit'] = $this->nmgp_botoes['exit'] = 'off';
              }
          } 
          else 
          { 
              $this->NM_ajax_info['navSummary']['reg_ini'] = 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = 1; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = 1; 
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd_extr']); 
              $this->nmgp_opcao = "novo"; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->idalmoxarifadoentrada = $rs->fields[0] ; 
              $this->nmgp_dados_select['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
              $this->idtenacidade = $rs->fields[1] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idfornecedor = $rs->fields[2] ; 
              $this->nmgp_dados_select['idfornecedor'] = $this->idfornecedor;
              $this->idalmoxarifado = $rs->fields[3] ; 
              $this->nmgp_dados_select['idalmoxarifado'] = $this->idalmoxarifado;
              $this->idusuarioauditoria = $rs->fields[4] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->cnpj = $rs->fields[5] ; 
              $this->nmgp_dados_select['cnpj'] = $this->cnpj;
              $this->cnpj = trim($this->cnpj);
              if (strlen($this->cnpj) < 14 && !empty($this->cnpj)) 
              { 
                  $this->cnpj = str_repeat(0, 14 - strlen($this->cnpj)) . $this->cnpj; 
              } 
              elseif (strlen($this->cnpj) > 14) 
              { 
                     $this->cnpj = substr($this->cnpj, strlen($this->cnpj) - 14); 
              } 
              $this->razaosocial = $rs->fields[6] ; 
              $this->nmgp_dados_select['razaosocial'] = $this->razaosocial;
              $this->nomefantasia = $rs->fields[7] ; 
              $this->nmgp_dados_select['nomefantasia'] = $this->nomefantasia;
              $this->versao = $rs->fields[8] ; 
              $this->nmgp_dados_select['versao'] = $this->versao;
              $this->codigo = $rs->fields[9] ; 
              $this->nmgp_dados_select['codigo'] = $this->codigo;
              $this->chave = $rs->fields[10] ; 
              $this->nmgp_dados_select['chave'] = $this->chave;
              $this->numeronota = $rs->fields[11] ; 
              $this->nmgp_dados_select['numeronota'] = $this->numeronota;
              $this->numerofatura = $rs->fields[12] ; 
              $this->nmgp_dados_select['numerofatura'] = $this->numerofatura;
              $this->natureza = $rs->fields[13] ; 
              $this->nmgp_dados_select['natureza'] = $this->natureza;
              $this->serie = $rs->fields[14] ; 
              $this->nmgp_dados_select['serie'] = $this->serie;
              $this->datahoraemissao = $rs->fields[15] ; 
              if (substr($this->datahoraemissao, 10, 1) == "-") 
              { 
                 $this->datahoraemissao = substr($this->datahoraemissao, 0, 10) . " " . substr($this->datahoraemissao, 11);
              } 
              if (substr($this->datahoraemissao, 13, 1) == ".") 
              { 
                 $this->datahoraemissao = substr($this->datahoraemissao, 0, 13) . ":" . substr($this->datahoraemissao, 14, 2) . ":" . substr($this->datahoraemissao, 17);
              } 
              $this->nmgp_dados_select['datahoraemissao'] = $this->datahoraemissao;
              $this->valortotal = trim($rs->fields[16]) ; 
              $this->nmgp_dados_select['valortotal'] = $this->valortotal;
              $this->valordesconto = trim($rs->fields[17]) ; 
              $this->nmgp_dados_select['valordesconto'] = $this->valordesconto;
              $this->valorliquido = trim($rs->fields[18]) ; 
              $this->nmgp_dados_select['valorliquido'] = $this->valorliquido;
              $this->valorcofins = trim($rs->fields[19]) ; 
              $this->nmgp_dados_select['valorcofins'] = $this->valorcofins;
              $this->valorpis = trim($rs->fields[20]) ; 
              $this->nmgp_dados_select['valorpis'] = $this->valorpis;
              $this->valoricms = trim($rs->fields[21]) ; 
              $this->nmgp_dados_select['valoricms'] = $this->valoricms;
              $this->valorfrete = trim($rs->fields[22]) ; 
              $this->nmgp_dados_select['valorfrete'] = $this->valorfrete;
              $this->qtdprodutos = $rs->fields[23] ; 
              $this->nmgp_dados_select['qtdprodutos'] = $this->qtdprodutos;
              $this->qtdparcelas = $rs->fields[24] ; 
              $this->nmgp_dados_select['qtdparcelas'] = $this->qtdparcelas;
              $this->nomearquivo = $rs->fields[25] ; 
              $this->nmgp_dados_select['nomearquivo'] = $this->nomearquivo;
              $this->nomereferencia = $rs->fields[26] ; 
              $this->nmgp_dados_select['nomereferencia'] = $this->nomereferencia;
              $this->observacoes = $rs->fields[27] ; 
              $this->nmgp_dados_select['observacoes'] = $this->observacoes;
              $this->datahorainclusao = $rs->fields[28] ; 
              if (substr($this->datahorainclusao, 10, 1) == "-") 
              { 
                 $this->datahorainclusao = substr($this->datahorainclusao, 0, 10) . " " . substr($this->datahorainclusao, 11);
              } 
              if (substr($this->datahorainclusao, 13, 1) == ".") 
              { 
                 $this->datahorainclusao = substr($this->datahorainclusao, 0, 13) . ":" . substr($this->datahorainclusao, 14, 2) . ":" . substr($this->datahorainclusao, 17);
              } 
              $this->nmgp_dados_select['datahorainclusao'] = $this->datahorainclusao;
              $this->enderecoipauditoria = $rs->fields[29] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[30] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->idalmoxarifadoentrada = (string)$this->idalmoxarifadoentrada; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idfornecedor = (string)$this->idfornecedor; 
              $this->idalmoxarifado = (string)$this->idalmoxarifado; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->valortotal = (strpos(strtolower($this->valortotal), "e")) ? (float)$this->valortotal : $this->valortotal; 
              $this->valortotal = (string)$this->valortotal; 
              $this->valordesconto = (strpos(strtolower($this->valordesconto), "e")) ? (float)$this->valordesconto : $this->valordesconto; 
              $this->valordesconto = (string)$this->valordesconto; 
              $this->valorliquido = (strpos(strtolower($this->valorliquido), "e")) ? (float)$this->valorliquido : $this->valorliquido; 
              $this->valorliquido = (string)$this->valorliquido; 
              $this->valorcofins = (strpos(strtolower($this->valorcofins), "e")) ? (float)$this->valorcofins : $this->valorcofins; 
              $this->valorcofins = (string)$this->valorcofins; 
              $this->valorpis = (strpos(strtolower($this->valorpis), "e")) ? (float)$this->valorpis : $this->valorpis; 
              $this->valorpis = (string)$this->valorpis; 
              $this->valoricms = (strpos(strtolower($this->valoricms), "e")) ? (float)$this->valoricms : $this->valoricms; 
              $this->valoricms = (string)$this->valoricms; 
              $this->valorfrete = (strpos(strtolower($this->valorfrete), "e")) ? (float)$this->valorfrete : $this->valorfrete; 
              $this->valorfrete = (string)$this->valorfrete; 
              $this->qtdprodutos = (string)$this->qtdprodutos; 
              $this->qtdparcelas = (string)$this->qtdparcelas; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['parms'] = "idalmoxarifadoentrada?#?$this->idalmoxarifadoentrada?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sub_dir'][0]  = "/" . $_SESSION['varIdTenacidade'];
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start'] < $qt_geral_reg_AlmoxarifadoEntrada_Frm;
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao']   = '';
          }
      } 
      if ($this->nmgp_opcao == "novo" || $this->nmgp_opcao == "refresh_insert") 
      { 
          $this->sc_evento_old = $this->sc_evento;
          $this->sc_evento = "novo";
          if ('refresh_insert' == $this->nmgp_opcao)
          {
              $this->nmgp_opcao = 'novo';
          }
          else
          {
              $this->nm_formatar_campos();
              $this->idalmoxarifadoentrada = "";  
              $this->nmgp_dados_form["idalmoxarifadoentrada"] = $this->idalmoxarifadoentrada;
              $this->idtenacidade = "" . $_SESSION['varIdTenacidade'] . "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idfornecedor = "";  
              $this->nmgp_dados_form["idfornecedor"] = $this->idfornecedor;
              $this->idalmoxarifado = "";  
              $this->nmgp_dados_form["idalmoxarifado"] = $this->idalmoxarifado;
              $this->idusuarioauditoria = "" . $_SESSION['varIdUsuario'] . "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->cnpj = "";  
              $this->nmgp_dados_form["cnpj"] = $this->cnpj;
              $this->razaosocial = "";  
              $this->nmgp_dados_form["razaosocial"] = $this->razaosocial;
              $this->nomefantasia = "";  
              $this->nmgp_dados_form["nomefantasia"] = $this->nomefantasia;
              $this->versao = "";  
              $this->nmgp_dados_form["versao"] = $this->versao;
              $this->codigo = "";  
              $this->nmgp_dados_form["codigo"] = $this->codigo;
              $this->chave = "";  
              $this->nmgp_dados_form["chave"] = $this->chave;
              $this->numeronota = "";  
              $this->nmgp_dados_form["numeronota"] = $this->numeronota;
              $this->numerofatura = "";  
              $this->nmgp_dados_form["numerofatura"] = $this->numerofatura;
              $this->natureza = "";  
              $this->nmgp_dados_form["natureza"] = $this->natureza;
              $this->serie = "";  
              $this->nmgp_dados_form["serie"] = $this->serie;
              $this->datahoraemissao = "";  
              $this->datahoraemissao_hora = "" ;  
              $this->nmgp_dados_form["datahoraemissao"] = $this->datahoraemissao;
              $this->valortotal = "";  
              $this->nmgp_dados_form["valortotal"] = $this->valortotal;
              $this->valordesconto = "";  
              $this->nmgp_dados_form["valordesconto"] = $this->valordesconto;
              $this->valorliquido = "";  
              $this->nmgp_dados_form["valorliquido"] = $this->valorliquido;
              $this->valorcofins = "";  
              $this->nmgp_dados_form["valorcofins"] = $this->valorcofins;
              $this->valorpis = "";  
              $this->nmgp_dados_form["valorpis"] = $this->valorpis;
              $this->valoricms = "";  
              $this->nmgp_dados_form["valoricms"] = $this->valoricms;
              $this->valorfrete = "";  
              $this->nmgp_dados_form["valorfrete"] = $this->valorfrete;
              $this->qtdprodutos = "";  
              $this->nmgp_dados_form["qtdprodutos"] = $this->qtdprodutos;
              $this->qtdparcelas = "";  
              $this->nmgp_dados_form["qtdparcelas"] = $this->qtdparcelas;
              $this->nomearquivo = "";  
              $this->nmgp_dados_form["nomearquivo"] = $this->nomearquivo;
              $this->nomereferencia = "";  
              $this->nomereferencia_ul_name = "" ;  
              $this->nomereferencia_ul_type = "" ;  
              $this->nmgp_dados_form["nomereferencia"] = $this->nomereferencia;
              $this->observacoes = "";  
              $this->nmgp_dados_form["observacoes"] = $this->observacoes;
              $this->datahorainclusao =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->datahorainclusao_hora =  date('H') . ":" . date('i') . ":" . date('s');
              $this->nmgp_dados_form["datahorainclusao"] = $this->datahorainclusao;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $this->parcela = "";  
              $this->nmgp_dados_form["parcela"] = $this->parcela;
              $this->produto = "";  
              $this->nmgp_dados_form["produto"] = $this->produto;
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
      }  
//
//
//-- 
      if ($this->nmgp_opcao != "novo") 
      {
      }
      if (!isset($this->nmgp_refresh_fields)) 
      { 
          $this->nm_proc_onload();
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Lst']['embutida_parms'] = "varidalmoxarifadoentrada*scin" . $this->nmgp_dados_form['idalmoxarifadoentrada'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scoutlink_remove_background*scinok*scout";
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaParcela_Lst']['embutida_parms'] = "varidalmoxarifadoentrada*scin" . $this->nmgp_dados_form['idalmoxarifadoentrada'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scoutlink_remove_background*scinok*scout";
  }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

// 
 function gera_icone($doc) 
 {
    $cam_icone = "";
    $path =  $this->Ini->root . $this->Ini->path_icones . "/";
    if (is_dir($path))
    {
        $nm_icones = nm_list_icon($path); 
        $nm_tipo = strtolower(substr($doc, strrpos($doc, ".") + 1));
        $nm_tipo = str_replace(array('docx', 'xlsx'), array('doc', 'xls'), $nm_tipo);
        if (isset($nm_icones[$nm_tipo]) && !empty($nm_icones[$nm_tipo]))
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones[$nm_tipo];
        }
        else
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones["default"];
        }
    }
    return $cam_icone;
 } 
//

/*----- Scriptcase Locale: Ajax Event IdFornecedor_onClick ------*/

function IdFornecedor_onClick()
{
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'on';
  
$original_idfornecedor = $this->idfornecedor;
$original_razaosocial = $this->razaosocial;
$original_nomefantasia = $this->nomefantasia;
$original_cnpj = $this->cnpj;

if ($this->idfornecedor  > 0) {
	$check_sql = "SELECT TipoPessoa, RazaoSocial, NomeFantasia, Cnpj, Cep, TipoLogradouro, Logradouro, Numero, Complemento, Bairro, Cidade, Estado, Telefone"
	   . " FROM fornecedor"
	   . " WHERE IdFornecedor = '$this->idfornecedor'";
	 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


	if (isset($this->rs[0][0])) {
		$tipoPessoa 	= $this->rs[0][0];
		$razaoSocial	= $this->rs[0][1];
		$nomeFantasia	= $this->rs[0][2];
		$cnpjc			= $this->rs[0][3];
		
	} else {
		$tipoPessoa 	= '';
		$razaoSocial	= '';
		$nomeFantasia	= '';
		$cnpjc			= '';
		
	}
	$this->nmgp_cmp_hidden["razaosocial"] = 'on'; $this->NM_ajax_info['fieldDisplay']['razaosocial'] = 'on';
	$this->nmgp_cmp_hidden["nomefantasia"] = 'on'; $this->NM_ajax_info['fieldDisplay']['nomefantasia'] = 'on';
	$this->razaosocial  	= $razaoSocial;
	$this->nomefantasia  	= $nomeFantasia;
	$this->cnpj  			= $cnpjc;
	
}


$modificado_idfornecedor = $this->idfornecedor;
$modificado_razaosocial = $this->razaosocial;
$modificado_nomefantasia = $this->nomefantasia;
$modificado_cnpj = $this->cnpj;
$this->nm_formatar_campos('idfornecedor', 'razaosocial', 'nomefantasia', 'cnpj');
if ($original_idfornecedor !== $modificado_idfornecedor || isset($this->nmgp_cmp_readonly['idfornecedor']) || (isset($bFlagRead_idfornecedor) && $bFlagRead_idfornecedor))
{
    $this->ajax_return_values_idfornecedor(true);
}
if ($original_razaosocial !== $modificado_razaosocial || isset($this->nmgp_cmp_readonly['razaosocial']) || (isset($bFlagRead_razaosocial) && $bFlagRead_razaosocial))
{
    $this->ajax_return_values_razaosocial(true);
}
if ($original_nomefantasia !== $modificado_nomefantasia || isset($this->nmgp_cmp_readonly['nomefantasia']) || (isset($bFlagRead_nomefantasia) && $bFlagRead_nomefantasia))
{
    $this->ajax_return_values_nomefantasia(true);
}
if ($original_cnpj !== $modificado_cnpj || isset($this->nmgp_cmp_readonly['cnpj']) || (isset($bFlagRead_cnpj) && $bFlagRead_cnpj))
{
    $this->ajax_return_values_cnpj(true);
}
$this->NM_ajax_info['event_field'] = 'IdFornecedor';
AlmoxarifadoEntrada_Frm_pack_ajax_response();
exit;
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event IdFornecedor_onClick ------*/


/*----- Scriptcase Locale: PHP Method: ajustarFormulario ------*/

function ajustarFormulario()
{
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'on';
  
if ($this->sc_evento == "novo") {
	
	$sc_tmp_field_name = 'datahorainclusao';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = 'Incluída em';
	$this->sc_field_readonly("cnpj", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_disabled_macro']['cnpj'] = array('I'=>array(),'U'=>array());
;
	
	$this->nmgp_cmp_hidden["nomereferencia"] = 'off'; $this->NM_ajax_info['fieldDisplay']['nomereferencia'] = 'off';
	$this->nmgp_cmp_hidden["datahorainclusao"] = 'off'; $this->NM_ajax_info['fieldDisplay']['datahorainclusao'] = 'off';
	$this->nmgp_cmp_hidden["qtdprodutos"] = 'off'; $this->NM_ajax_info['fieldDisplay']['qtdprodutos'] = 'off';
	$this->nmgp_cmp_hidden["qtdparcelas"] = 'off'; $this->NM_ajax_info['fieldDisplay']['qtdparcelas'] = 'off';
	$this->nmgp_cmp_hidden["razaosocial"] = 'off'; $this->NM_ajax_info['fieldDisplay']['razaosocial'] = 'off';
	$this->nmgp_cmp_hidden["nomefantasia"] = 'off'; $this->NM_ajax_info['fieldDisplay']['nomefantasia'] = 'off';
	
	$this->Ini->nm_hidden_blocos[4] = 'off'; $this->NM_ajax_info['blockDisplay']['4'] = 'off';
	$this->Ini->nm_hidden_blocos[5] = 'off'; $this->NM_ajax_info['blockDisplay']['5'] = 'off';	
	
} else {
	
	if (!empty($this->nomereferencia )) {
		$sc_tmp_field_name = 'datahorainclusao';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = 'Incluída em';
	}	
	
	$check_table = 'almoxarifadoentradaparcela'; 
	$check_where = "IdAlmoxarifadoEntrada = '$this->idalmoxarifadoentrada'"; 

	$check_sql = 'SELECT *'
	   . ' FROM '  . $check_table
	   . ' WHERE ' . $check_where;
	 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dataset = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 


	if (false == $this->dataset ) {

		die("Erro de acesso a base de dados");

	} elseif ($this->dataset->EOF) {

		$this->Ini->nm_hidden_blocos[5] = 'off'; $this->NM_ajax_info['blockDisplay']['5'] = 'off';

	} else {
		
    $this->Ini->nm_hidden_blocos[5] = 'on'; $this->NM_ajax_info['blockDisplay']['5'] = 'on';
		
	}
}
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: ajustarFormulario ------*/


/*----- Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/

function Gravar_Tabela_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
	
	$posicao = strpos($parNomeAplicacao, '_');
	$nomeTabela =  strtolower(substr($parNomeAplicacao, 0, $posicao));
	if ($parValorIdChavePrimaria == NULL) {
		$Sql = "CALL GravarAuditoria('$this->sc_temp_varIdTenacidade', '$this->sc_temp_varIdUsuario', '" .  
				$parNomeAplicacao . "', '" .  $nomeTabela . "' , NULL, 'A', '" . $_SERVER['REMOTE_ADDR'] . "')";
	}
	else {
		$Sql = "CALL GravarAuditoria('$this->sc_temp_varIdTenacidade', '$this->sc_temp_varIdUsuario', '" .  
				$parNomeAplicacao . "', '" .  $nomeTabela . "' , " . $parValorIdChavePrimaria . ", 'A', '" . $_SERVER['REMOTE_ADDR'] . "')";
	}
	
     $nm_select = $Sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                AlmoxarifadoEntrada_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
	

	return true;
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

function Preparar_LstFrm_OnSrip_OnLoad_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varAcessoAutorizacoes)) {$this->sc_temp_varAcessoAutorizacoes = (isset($_SESSION['varAcessoAutorizacoes'])) ? $_SESSION['varAcessoAutorizacoes'] : "";}
if (!isset($this->sc_temp_varAcessoAuditoria)) {$this->sc_temp_varAcessoAuditoria = (isset($_SESSION['varAcessoAuditoria'])) ? $_SESSION['varAcessoAuditoria'] : "";}
if (!isset($this->sc_temp_varPrivAdmin)) {$this->sc_temp_varPrivAdmin = (isset($_SESSION['varPrivAdmin'])) ? $_SESSION['varPrivAdmin'] : "";}
  
	$pos = strripos($parNomeAplicacao, '_');
	if ($pos !== false) {
		$tipoAplicacao = substr($parNomeAplicacao, $pos + 1);
	}
	else {
		sc_erro_message("Nome da aplicação inválido (" . $parNomeAplicacao . ").");
	}

	if (is_file($_SESSION['scriptcase']['dir_temp'] . "/sc_apl_default_LIGA_InfoTIME.txt")) {
    unlink($_SESSION['scriptcase']['dir_temp'] . "/sc_apl_default_LIGA_InfoTIME.txt");
}
if (is_file("../_lib/_app_data/Login_Ctr_ini.php")) {
    $SC_arq_def = fopen($_SESSION['scriptcase']['dir_temp'] . "/sc_apl_default_LIGA_InfoTIME.txt", "w");
    fwrite ($SC_arq_def, 'Login_Ctr,M');
    fclose ($SC_arq_def);
    setcookie('sc_apl_default_LIGA_InfoTIME','Login_Ctr,M','0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
}
;	

	switch(strtoupper($tipoAplicacao)) {
		case 'FRM':
			$this->NM_ajax_info['buttonDisplay']['first'] = $this->nmgp_botoes["first"] = 'off';;	
			$this->NM_ajax_info['buttonDisplay']['back'] = $this->nmgp_botoes["back"] = 'off';;	
			$this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes["forward"] = 'off';;	
			$this->NM_ajax_info['buttonDisplay']['last'] = $this->nmgp_botoes["last"] = 'off';;

			$this->sc_field_readonly("idtenacidade", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_disabled_macro']['idtenacidade'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("idusuarioauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_disabled_macro']['idusuarioauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("enderecoipauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_disabled_macro']['enderecoipauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("nomeaplicacaoauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Field_disabled_macro']['nomeaplicacaoauditoria'] = array('I'=>array(),'U'=>array());
;

			if ($this->sc_temp_varPrivAdmin != 1) {
				if ($this->sc_temp_varAcessoAuditoria != "S") {
					$this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes["Auditoria"] = 'off';;
				}
				if ($this->sc_temp_varAcessoAutorizacoes != "S") {
					$this->NM_ajax_info['buttonDisplay']['Autorizações'] = $this->nmgp_botoes["Autorizações"] = 'off';;
				}
				$this->Ini->nm_hidden_blocos[7] = 'off'; $this->NM_ajax_info['blockDisplay']['7'] = 'off';
			} elseif ($this->sc_temp_varPrivAdmin == 1) {				
				
				echo '<span title="' . htmlspecialchars($parNomeAplicacao, ENT_QUOTES, 'UTF-8') . '" style="
				display:inline-block;
				font-size:11px;
				line-height:11px;
				color:#fff;
				margin-left:4px;
				vertical-align:middle;
				cursor:help;
				">▣</span>';				
				
			}
			$this->idusuarioauditoria  		= $this->sc_temp_varIdUsuario;
			$this->enderecoipauditoria  		= $_SERVER['REMOTE_ADDR'];
			$this->nomeaplicacaoauditoria 	= $parNomeAplicacao;

			$pos = strpos($this->sc_temp_varPrimeiraVez, "," . $parNomeAplicacao . ",");
			if ($pos === false) {
				$this->sc_temp_varPrimeiraVez = $this->sc_temp_varPrimeiraVez . "," . $parNomeAplicacao  . ",";
			}				
		break;
		case 'CAL':
		break;
		case 'LST':
			$pos = strpos($this->sc_temp_varPrimeiraVez, "," . $parNomeAplicacao . ",");
			if ($pos === false) {
				$this->sc_temp_varPrimeiraVez = $this->sc_temp_varPrimeiraVez . "," . $parNomeAplicacao  . ",";
			}
			
		break;
		default:
		break;
	}
	
	return true;
if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
if (isset($this->sc_temp_varAcessoAuditoria)) { $_SESSION['varAcessoAuditoria'] = $this->sc_temp_varAcessoAuditoria;}
if (isset($this->sc_temp_varAcessoAutorizacoes)) { $_SESSION['varAcessoAutorizacoes'] = $this->sc_temp_varAcessoAutorizacoes;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
$_SESSION['scriptcase']['AlmoxarifadoEntrada_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

//
 function nm_gera_html()
 {
    global
           $nm_url_saida, $nmgp_url_saida, $nm_saida_global, $nm_apl_dependente, $glo_subst, $sc_check_excl, $sc_check_incl, $nmgp_num_form, $NM_run_iframe;
     if ($this->Embutida_proc)
     {
         return;
     }
     if ($this->nmgp_form_show == 'off')
     {
         exit;
     }
      if (isset($NM_run_iframe) && $NM_run_iframe == 1)
      {
          $this->nmgp_botoes['exit'] = "off";
      }
     $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opc_ant'] = $this->nmgp_opcao;
     }
     else
     {
         $this->nmgp_opcao = $this->nmgp_opc_ant;
     }
     if (!empty($this->Campos_Mens_erro)) 
     {
         $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
         $this->Campos_Mens_erro = "";
     }
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              AlmoxarifadoEntrada_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
//-- 
   if ($this->nomereferencia != "" && $this->nomereferencia != "none")   
   { 
       $sTmpExtension = pathinfo($this->nomereferencia, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_nomereferencia = 'sc_nomereferencia_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['download_filenames'][$sTmpFile_nomereferencia] = $this->nomereferencia;
   } 
        $this->initFormPages();
    include_once("AlmoxarifadoEntrada_Frm_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_format_readonly($field, $value)
    {
        $result = $value;

        $this->form_highlight_search($result, $field, $value);

        return $result;
    }

    function form_highlight_search(&$result, $field, $value)
    {
        if ($this->proc_fast_search) {
            $this->form_highlight_search_quicksearch($result, $field, $value);
        }
    }

    function form_highlight_search_quicksearch(&$result, $field, $value)
    {
        $searchOk = false;
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idalmoxarifadoprodutoentradanota", "idfornecedor", "idalmoxarifado", "numeronotafiscal", "dataemissao", "valornota", "valorcofins", "valorpis", "valoricms", "valorfrete", "observacoes", "datainclusao"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array(""))) {
            $searchOk = true;
        }

        if (!$searchOk || '' == $this->nmgp_arg_fast_search) {
            return;
        }

        $htmlIni = '<div class="highlight" style="background-color: #fafaca; display: inline-block">';
        $htmlFim = '</div>';

        if ('qp' == $this->nmgp_cond_fast_search) {
            $keywords = preg_quote($this->nmgp_arg_fast_search, '/');
            $result = preg_replace('/'. $keywords .'/i', $htmlIni . '$0' . $htmlFim, $result);
        } elseif ('eq' == $this->nmgp_cond_fast_search) {
            if (strcasecmp($this->nmgp_arg_fast_search, $value) == 0) {
                $result = $htmlIni. $result .$htmlFim;
            }
        }
    }


    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarTimeStart($sFormat, $value)
   {
       $aDateParts = explode(';', $sFormat);

       if (2 == sizeof($aDateParts))
       {
           $sTime = $aDateParts[1];
       }
       else
       {
           $sTime = 'hh:mm:ss';
       }

       if ('now' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array(date('H'), date('i'), date('i'), date('s')), $sTime);
       } elseif ('end' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array('23', '59', '59', '59'), $sTime);
       } else {
           return str_replace(array('h', 'm', 'i', 's'), array('0', '0', '0', '0'), $sTime);
       }
   } // jqueryCalendarTimeStart

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   function jqueryIconFile($sModule)
   {
       $sImage = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && 'image' == $this->arr_buttons['bcalendario']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalendario']['display'])
           {
               $sImage = $this->arr_buttons['bcalendario']['image'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && 'image' == $this->arr_buttons['bcalculadora']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalculadora']['display'])
           {
               $sImage = $this->arr_buttons['bcalculadora']['image'];
           }
       }

       return '' == $sImage ? '' : $this->Ini->path_icones . '/' . $sImage;
   } // jqueryIconFile

   function jqueryFAFile($sModule)
   {
       $sFA = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
           {
               $sFA = $this->arr_buttons['bcalendario']['fontawesomeicon'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
           {
               $sFA = $this->arr_buttons['bcalculadora']['fontawesomeicon'];
           }
       }

       return '' == $sFA ? '' : "<span class='scButton_fontawesome " . $sFA . "'></span>";
   } // jqueryFAFile

   function jqueryButtonText($sModule)
   {
       $sClass = '';
       $sText  = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalendario']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalendario']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalendario']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i>";
                   }
               }
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalculadora']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalculadora']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalculadora']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> ";
                   }
               }
           }
       }

       return '' == $sText ? array('', '') : array($sText, $sClass);
   } // jqueryButtonText


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['csrf_token'];
    }

    function scCsrfGenerateToken()
    {
        $aSources = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!@$*()-_[]{},.;:'
        );

        $sRandom = '';

        $aSourcesSizes = array();
        $iSourceSize   = sizeof($aSources) - 1;
        for ($i = 0; $i <= $iSourceSize; $i++)
        {
            $aSourcesSizes[$i] = strlen($aSources[$i]) - 1;
        }

        for ($i = 0; $i < 64; $i++)
        {
            $iSource = $this->scCsrfRandom(0, $iSourceSize);
            $sRandom .= substr($aSources[$iSource], $this->scCsrfRandom(0, $aSourcesSizes[$iSource]), 1);
        }

        return $sRandom;
    }

    function scCsrfRandom($iMin, $iMax)
    {
        return mt_rand($iMin, $iMax);
    }

        function addUrlParam($url, $param, $value) {
                $urlParts  = explode('?', $url);
                $urlParams = isset($urlParts[1]) ? explode('&', $urlParts[1]) : array();
                $objParams = array();
                foreach ($urlParams as $paramInfo) {
                        $paramParts = explode('=', $paramInfo);
                        $objParams[ $paramParts[0] ] = isset($paramParts[1]) ? $paramParts[1] : '';
                }
                $objParams[$param] = $value;
                $urlParams = array();
                foreach ($objParams as $paramName => $paramValue) {
                        $urlParams[] = $paramName . '=' . $paramValue;
                }
                return $urlParts[0] . '?' . implode('&', $urlParams);
        }
 function allowedCharsCharset($charlist)
 {
     if ($_SESSION['scriptcase']['charset'] != 'UTF-8')
     {
         $charlist = NM_conv_charset($charlist, $_SESSION['scriptcase']['charset'], 'UTF-8');
     }
     return str_replace("'", "\'", $charlist);
 }

function sc_file_size($file, $format = false)
{
    if ('' == $file) {
        return '';
    }
    if (!@is_file($file)) {
        return '';
    }
    $fileSize = @filesize($file);
    if ($format) {
        $suffix = '';
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' KB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' MB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' GB';
        }
        $fileSize = $fileSize . $suffix;
    }
    return $fileSize;
}


 function new_date_format($type, $field)
 {
     $new_date_format_out = '';

     if ('DT' == $type)
     {
         $date_format  = $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = $this->field_config[$field]['date_display'];
         $time_format  = '';
         $time_sep     = '';
         $time_display = '';
     }
     elseif ('DH' == $type)
     {
         $date_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , 0, strpos($this->field_config[$field]['date_format'] , ';')) : $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], 0, strpos($this->field_config[$field]['date_display'], ';')) : $this->field_config[$field]['date_display'];
         $time_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , strpos($this->field_config[$field]['date_format'] , ';') + 1) : '';
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], strpos($this->field_config[$field]['date_display'], ';') + 1) : '';
     }
     elseif ('HH' == $type)
     {
         $date_format  = '';
         $date_sep     = '';
         $date_display = '';
         $time_format  = $this->field_config[$field]['date_format'];
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = $this->field_config[$field]['date_display'];
     }

     if ('DT' == $type || 'DH' == $type)
     {
         $date_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_format); $i++)
         {
             $char = strtolower(substr($date_format, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $date_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $date_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $disp_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_display); $i++)
         {
             $char = strtolower(substr($date_display, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $disp_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $disp_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $date_final = array();
         foreach ($date_array as $date_part)
         {
             if (in_array($date_part, $disp_array))
             {
                 $date_final[] = $date_part;
             }
         }

         $date_format = implode($date_sep, $date_final);
     }
     if ('HH' == $type || 'DH' == $type)
     {
         $time_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_format); $i++)
         {
             $char = strtolower(substr($time_format, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $time_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $time_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $disp_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_display); $i++)
         {
             $char = strtolower(substr($time_display, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $disp_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $disp_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $time_final = array();
         foreach ($time_array as $time_part)
         {
             if (in_array($time_part, $disp_array))
             {
                 $time_final[] = $time_part;
             }
         }

         $time_format = implode($time_sep, $time_final);
     }

     if ('DT' == $type)
     {
         $old_date_format = $date_format;
     }
     elseif ('DH' == $type)
     {
         $old_date_format = $date_format . ';' . $time_format;
     }
     elseif ('HH' == $type)
     {
         $old_date_format = $time_format;
     }

     for ($i = 0; $i < strlen($old_date_format); $i++)
     {
         $char = substr($old_date_format, $i, 1);
         if ('/' == $char)
         {
             $new_date_format_out .= $date_sep;
         }
         elseif (':' == $char)
         {
             $new_date_format_out .= $time_sep;
         }
         else
         {
             $new_date_format_out .= $char;
         }
     }

     $this->field_config[$field]['date_format'] = $new_date_format_out;
     if ('DH' == $type)
     {
         $new_date_format_out                                  = explode(';', $new_date_format_out);
         $this->field_config[$field]['date_format_js']        = $new_date_format_out[0];
         $this->field_config[$field . '_hora']['date_format'] = $new_date_format_out[1];
         $this->field_config[$field . '_hora']['time_sep']    = $this->field_config[$field]['time_sep'];
     }
 } // new_date_format

   function Form_lookup_idfornecedor()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'] = array(); 
    }

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT IdFornecedor, CONCAT(NomeFantasia, ' (', IdFornecedor, ')') FROM fornecedor WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY NomeFantasia";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idfornecedor'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_idalmoxarifado()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'] = array(); 
    }

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT al.IdAlmoxarifado, CONCAT('Empresa: ', e.NomeFantasia, ' - ', al.Sigla, ' - ', al.Descricao)  FROM almoxarifado al INNER JOIN empresa e ON (e.IdEmpresa  = al.IdEmpresa) WHERE al.IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND al.IdEmpresa IN (" . $_SESSION['varListaEmpresa'] . ") AND al.PermiteEntrada = 'S'";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idalmoxarifado'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_idtenacidade()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'] = array(); 
    }

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT IdTenacidade, NomeFantasia  FROM tenacidade  ORDER BY NomeFantasia";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idtenacidade'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_idusuarioauditoria()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'] = array(); 
    }

   $old_value_cnpj = $this->cnpj;
   $old_value_datahorainclusao = $this->datahorainclusao;
   $old_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_datahoraemissao = $this->datahoraemissao;
   $old_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_cnpj = $this->cnpj;
   $unformatted_value_datahorainclusao = $this->datahorainclusao;
   $unformatted_value_datahorainclusao_hora = $this->datahorainclusao_hora;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_datahoraemissao = $this->datahoraemissao;
   $unformatted_value_datahoraemissao_hora = $this->datahoraemissao_hora;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario  ORDER BY Nome";

   $this->cnpj = $old_value_cnpj;
   $this->datahorainclusao = $old_value_datahorainclusao;
   $this->datahorainclusao_hora = $old_value_datahorainclusao_hora;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->datahoraemissao = $old_value_datahoraemissao;
   $this->datahoraemissao_hora = $old_value_datahoraemissao_hora;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valorliquido = $old_value_valorliquido;
   $this->valordesconto = $old_value_valordesconto;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->qtdprodutos = $old_value_qtdprodutos;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['Lookup_idusuarioauditoria'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              AlmoxarifadoEntrada_Frm_pack_ajax_response();
              exit;
          }
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idfornecedor($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdFornecedor", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idalmoxarifado($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdAlmoxarifado", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorCofins", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorPis", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorIcms", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorFrete", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Observacoes", $arg_search, $data_search, "TEXT", false);
          }
      }
      if ($this->NM_case_insensitive)
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $comando = str_replace("#lowerI#", "UCase(", $comando);
          }
          else
          {
              $comando = str_replace("#lowerI#", "Upper(", $comando);
           }
          $comando = str_replace("#lowerF#", ")", $comando);
      }
      else
      {
          $comando = str_replace("#lowerI#", "", $comando);
          $comando = str_replace("#lowerF#", "", $comando);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter_form'] . " and ((IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')) and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where (IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "') and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_AlmoxarifadoEntrada_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total'] = $qt_geral_reg_AlmoxarifadoEntrada_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          AlmoxarifadoEntrada_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          AlmoxarifadoEntrada_Frm_pack_ajax_response();
          exit;
      }
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="", $tp_unaccent=false)
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $nm_esp_postgres = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = " #lowerI#";
      $nm_fim_lower = "#lowerF#";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $nm_numeric[] = "idalmoxarifadoentrada";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idfornecedor";$nm_numeric[] = "idalmoxarifado";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "valortotal";$nm_numeric[] = "valordesconto";$nm_numeric[] = "valorliquido";$nm_numeric[] = "valorcofins";$nm_numeric[] = "valorpis";$nm_numeric[] = "valoricms";$nm_numeric[] = "valorfrete";$nm_numeric[] = "qtdprodutos";$nm_numeric[] = "qtdparcelas";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
      }
      if (is_array($campo)) {
          foreach ($campo as $Ind => $Cmp) {
             if ($Cmp != null) {
                 $campo[$Ind] = substr($this->Ini->Db->qstr($Cmp), 1, -1);
             }
          }
      }
      else {
          $campo = substr($this->Ini->Db->qstr($campo), 1, -1);
      }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
      $Nm_datas["datahoraemissao"] = "datetime";$Nm_datas["datahorainclusao"] = "datetime";
         if (isset($Nm_datas[$campo_join]))
         {
             for ($x = 0; $x < strlen($campo); $x++)
             {
                 $tst = substr($campo, $x, 1);
                 if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
                 {
                     return;
                 }
             }
         }
         if (isset($Nm_datas[$campo_join]))
          {
            $nm_ini_lower = "";
             $nm_fim_lower = "";
          }
          if (isset($Nm_datas[$campo_join]))
          {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['SC_sep_date1'];
              }
          }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
          if (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
          elseif ($Nm_datas[$campo_join] == "time" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'hh24:mi:ss')";
          }
      }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_ini_lower . $nm_aspas . $Cmp . $nm_aspas1 . $nm_fim_lower;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $cond_tst = strtoupper($condicao);
         if ($cond_tst == "II" || $cond_tst == "QP" || $cond_tst == "NP")
         {
             if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
             {
                 $op_like      = " ilike ";
                 $nm_ini_lower = "";
                 $nm_fim_lower = "";
             }
             else
             {
                 $op_like = " like ";
             }
         }
         switch ($cond_tst)
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . " not" . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
         }
   }
   function SC_lookup_idfornecedor($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT CONCAT(NomeFantasia,' (', IdFornecedor, ')'), IdFornecedor FROM fornecedor WHERE (CAST (IdFornecedor AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT CONCAT(NomeFantasia,' (', IdFornecedor, ')'), IdFornecedor FROM fornecedor WHERE (#cmp_iCONCAT(NomeFantasia,' (', IdFornecedor, ')')#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
       {
           $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           if ($this->NM_case_insensitive)
           {
               $campo  = sc_strtoupper($campo);
           }
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($this->NM_case_insensitive)
               {
                   $label  = sc_strtoupper($label);
               }
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_lookup_idalmoxarifado($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT CONCAT('Empresa: ', e.NomeFantasia, ' - ', al.Sigla, ' - ',al.Descricao), al.IdAlmoxarifado FROM almoxarifado al INNER JOIN empresa e ON (e.IdEmpresa  = al.IdEmpresa) WHERE (#cmp_iCONCAT('Empresa: ', e.NomeFantasia, ' - ', al.Sigla, ' - ',al.Descricao)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (al.IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND (al.IdEmpresa IN (" . $_SESSION['varListaEmpresa'] . ")) AND (al.PermiteEntrada = 'S)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
       {
           $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           if ($this->NM_case_insensitive)
           {
               $campo  = sc_strtoupper($campo);
           }
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($this->NM_case_insensitive)
               {
                   $label  = sc_strtoupper($label);
               }
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
function nmgp_redireciona($tipo=0)
{
   global $nm_apl_dependente;
   if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['scriptcase']['sc_tp_saida'] != "D" && $nm_apl_dependente != 1) 
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['nm_sc_retorno'];
   }
   else
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page];
   }
   if ($tipo == 2)
   {
       $nmgp_saida_form = "AlmoxarifadoEntrada_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "AlmoxarifadoEntrada_Frm_fim.php";
   }
   $diretorio = explode("/", $nmgp_saida_form);
   $cont = count($diretorio);
   $apl = $diretorio[$cont - 1];
   $apl = str_replace(".php", "", $apl);
   $pos = strpos($apl, "?");
   if ($pos !== false)
   {
       $apl = substr($apl, 0, $pos);
   }
   if ($tipo != 1 && $tipo != 2)
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page][$apl]['where_orig']);
   }
   if ($this->NM_ajax_flag)
   {
       $sTarget = '_self';
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       AlmoxarifadoEntrada_Frm_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
   {
?>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
   }

?>
    <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
    <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
    <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
    <META http-equiv="Pragma" content="no-cache"/>
    <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
   </HEAD>
   <BODY>
   <FORM name="form_ok" method="POST" action="<?php echo $this->form_encode_input($nmgp_saida_form); ?>" target="_self">
<?php
   if ($tipo == 0)
   {
?>
     <INPUT type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($this->nm_location); ?>"> 
<?php
   }
?>
     <INPUT type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
   </FORM>
   <SCRIPT type="text/javascript">
      bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
      function scLigEditLookupCall()
      {
<?php
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['sc_modal'])
   {
?>
        parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
   elseif ($this->lig_edit_lookup)
   {
?>
        opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
?>
      }
      if (bLigEditLookupCall)
      {
        scLigEditLookupCall();
      }
<?php
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['masterValue']);
?>
}
<?php
    }
}
?>
      document.form_ok.submit();
   </SCRIPT>
   </BODY>
   </HTML>
<?php
  exit;
}
function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $opc="", $alt_modal=430, $larg_modal=630)
{
   if (isset($this->NM_is_redirected) && $this->NM_is_redirected)
   {
       return;
   }
   if (is_array($nm_apl_parms))
   {
       $tmp_parms = "";
       foreach ($nm_apl_parms as $par => $val)
       {
           $par = trim($par);
           $val = trim($val);
           $tmp_parms .= str_replace(".", "_", $par) . "?#?";
           if (substr($val, 0, 1) == "$")
           {
               $tmp_parms .= $$val;
           }
           elseif (substr($val, 0, 1) == "{")
           {
               $val        = substr($val, 1, -1);
               $tmp_parms .= $this->$val;
           }
           elseif (substr($val, 0, 1) == "[")
           {
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm'][substr($val, 1, -1)];
           }
           else
           {
               $tmp_parms .= $val;
           }
           $tmp_parms .= "?@?";
       }
       $nm_apl_parms = $tmp_parms;
   }
   if (empty($opc))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           AlmoxarifadoEntrada_Frm_pack_ajax_response();
           exit;
       }
       echo "<SCRIPT language=\"javascript\">";
       if (strtolower($nm_target) == "_blank")
       {
           echo "window.open ('" . $nm_apl_dest . "');";
           echo "</SCRIPT>";
           return;
       }
       else
       {
           echo "window.location='" . $nm_apl_dest . "';";
           echo "</SCRIPT>";
           $this->NM_close_db();
           exit;
       }
   }
   $dir = explode("/", $nm_apl_dest);
   if (count($dir) == 1)
   {
       $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
       $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
   }
   if ($this->NM_ajax_flag)
   {
       $nm_apl_parms = str_replace("?#?", "*scin", NM_charset_to_utf8($nm_apl_parms));
       $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
       $this->NM_ajax_info['redir']['metodo']     = 'post';
       $this->NM_ajax_info['redir']['action']     = $nm_apl_dest;
       $this->NM_ajax_info['redir']['nmgp_parms'] = $nm_apl_parms;
       $this->NM_ajax_info['redir']['target']     = $nm_target_form;
       $this->NM_ajax_info['redir']['h_modal']    = $alt_modal;
       $this->NM_ajax_info['redir']['w_modal']    = $larg_modal;
       if ($nm_target_form == "_blank")
       {
           $this->NM_ajax_info['redir']['nmgp_outra_jan'] = 'true';
       }
       else
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida']      = $nm_apl_retorno;
           $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       }
       AlmoxarifadoEntrada_Frm_pack_ajax_response();
       exit;
   }
   if ($nm_target == "modal")
   {
       if (!empty($nm_apl_parms))
       {
           $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
           $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
           $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
       }
       $par_modal = "?script_case_init=" . $this->Ini->sc_page . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
       $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
       $this->NM_is_redirected = true;
       return;
   }
   if ($nm_target == "_blank")
   {
?>
<form name="Fredir" method="post" target="_blank" action="<?php echo $nm_apl_dest; ?>">
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
</form>
<script type="text/javascript">
setTimeout(function() { document.Fredir.submit(); }, 250);
</script>
<?php
    return;
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
   {
?>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
   }

?>
    <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
    <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
    <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
    <META http-equiv="Pragma" content="no-cache"/>
    <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
   </HEAD>
   <BODY>
<?php
   }
?>
<form name="Fredir" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
<?php
   if ($nm_target_form == "_blank")
   {
?>
  <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
  <input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nm_apl_retorno) ?>">
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
<?php
   }
?>
</form> 
   <SCRIPT type="text/javascript">
<?php
   if ($nm_target_form == "modal")
   {
?>
       $(document).ready(function(){
           tb_show('', '<?php echo $nm_apl_dest ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo $this->form_encode_input($nm_apl_parms); ?>&nmgp_outra_jan=true&TB_iframe=true&height=<?php echo $alt_modal; ?>&width=<?php echo $larg_modal; ?>&modal=true', '');
       });
<?php
   }
   else
   {
?>
    $(function() {
       document.Fredir.target = "<?php echo $nm_target_form ?>"; 
       document.Fredir.action = "<?php echo $nm_apl_dest ?>";
       document.Fredir.submit();
    });
<?php
   }
?>
   </SCRIPT>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
   </BODY>
   </HTML>
<?php
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
       $this->NM_close_db();
       exit;
   }
}
    function sc_field_readonly($sField, $sStatus, $iSeq = '')
    {
        if ('on' != $sStatus && 'off' != $sStatus)
        {
            return;
        }

        $sFieldDateTime = '';
        if ('datahorainclusao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('datahoraemissao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }

        $sFlagVar        = 'bFlagRead_' . $sField;
        $this->$sFlagVar = 'on' == $sStatus;

        $this->nmgp_cmp_readonly[$sField]                = $sStatus;
        $this->NM_ajax_info['readOnly'][$sField . $iSeq] = $sStatus;
        if ('' != $sFieldDateTime)
        {
            $this->NM_ajax_info['readOnly'][$sFieldDateTime . $iSeq] = $sStatus;
        }
    } // sc_field_readonly
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "new":
                return array("sc_b_new_t.sc-unique-btn-1");
                break;
            case "insert":
                return array("sc_b_ins_t.sc-unique-btn-2");
                break;
            case "update":
                return array("sc_b_upd_t.sc-unique-btn-3");
                break;
            case "delete":
                return array("sc_b_del_t.sc-unique-btn-4");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-5", "sc_b_sai_t.sc-unique-btn-7", "sc_b_sai_t.sc-unique-btn-6");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
#lin1_col1 { padding-left:9px; padding-top:2px;  height:22px; overflow:hidden; text-align:left; font-size:14px; font-weight:normal; font-style: italic; font-weight: bold; color: #72c045; }			 
#lin1_col2 { padding-right:9px; padding-top:2px; height:22px; text-align:right; overflow:hidden; font-size:14px; font-weight:normal;font-style: italic; font-weight: bold; color: #72c045; }
</style>

<div style="width: 100%">
  <!-- <div class="scFormHeader" style="height:11px; display: block; border-width:0px; "></div> -->
  <!-- <div class="scFormHeader" style="height:2px; display: block; border-width:0px; "></div> -->
 <div style="height:25px; background-color:#FFFFFF; border-width:0px 0px 1px 0px;  border-style: solid; border-color:#72c045; display: block">
 	<table style="width:100%; border-collapse:collapse; padding:0;">
    	<tr>
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " Entrada Almoxarifado"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Entrada Almoxarifado"; } ?></span></td>
            <td id="lin1_col2" class="scFormHeaderFont"><span></span></td>
        </tr>
    </table>		 
 </div>
</div>
    </td></tr>
<?php
    }

    function displayAppFooter()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-footer">
<style>
#rod_col1 { margin:0px; padding: 3px 0px 0px 5px; float:left; overflow:hidden;}
#rod_col2 { margin:0px; padding: 3px 5px 0px 0px; float:right; overflow:hidden; text-align:right;}

</style>

<div style="width: 100%; height:20px;" class="scFormFooter">
        <span class="scFormFooterFont" id="rod_col1"><?php echo "* Campo obrigatório" ?></span>
        <span class="scFormFooterFont" id="rod_col2">
<?php
$this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
echo $this->nm_data->FormataSaida("l, d/m/Y @?#?@à@?#?@s H:i");
?>
</span>
</div>
    </td></tr>
<?php
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['run_iframe'] != "R") {
        } else {
            return false;
        }
        return true;
    } // displayAppToolbars

    function displayTopToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayTopToolbar

    function displayBottomToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayBottomToolbar

    function getSummaryLine()
    {
        $summaryLine = "[" . $this->Ini->Nm_lang['lang_othr_smry_info_simp'] . "]";
        $summaryLine = str_replace(
            [
                '?final?',
                '?total?',
            ],
            [
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntrada_Frm']['ordem_ord'] == " desc") {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_desc;
                $orderColRule = $sortRule = 'desc';
            } else {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_asc;
                $orderColRule = $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule)
    {        if ($this->scIsFieldNumeric($fieldName)) {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "IdAlmoxarifadoEntrada":
                return true;
            case "ValorCofins":
                return true;
            case "ValorPis":
                return true;
            case "ValorIcms":
                return true;
            case "ValorFrete":
                return true;
            case "ValorTotal":
                return true;
            case "ValorLiquido":
                return true;
            case "ValorDesconto":
                return true;
            case "QtdParcelas":
                return true;
            case "QtdProdutos":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            default:
                return 'asc';
        }
        return 'asc';
    }

    function scGetImageExtension(string $binary) {
        if (function_exists('finfo_buffer')) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->buffer($binary);
            $map = [
               'image/jpeg' => '.jpg',
               'image/png'  => '.png',
               'image/gif'  => '.gif',
               'image/webp' => '.webp',
               'image/bmp'  => '.bmp',
               'image/svg+xml' => '.svg',
               'image/x-icon' => '.ico',
            ];
            if (isset($map[$mime])) {
                return $map[$mime];
            }
        }
        $header = bin2hex(substr($binary, 0, 12));
        if (strpos($header, 'ffd8ff') === 0) return '.jpg';
        if (strpos($header, '89504e47') === 0) return '.png';
        if (strpos($header, '47494638') === 0) return '.gif';
        if (substr($binary, 0, 4) === "RIFF" && substr($binary, 8, 4) === "WEBP") return '.webp';
        if (strpos($header, '424d') === 0) return '.bmp';
        if (strpos($header, '00000100') === 0) return '.ico';
        return '.gif';
    }
}
?>
