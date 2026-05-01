<?php
//
class AlmoxarifadoEntradaProduto_Validacao_Frm_apl
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
   var $idalmoxarifadoentradaproduto;
   var $idtenacidade;
   var $idalmoxarifadoentrada;
   var $idalmoxarifadoproduto;
   var $idalmoxarifadoproduto_1;
   var $idalmoxarifadoprodutovolume;
   var $idalmoxarifadoprodutovolume_1;
   var $idalmoxarifadoprodutolocalarmazenamento;
   var $idalmoxarifadoprodutolocalarmazenamento_1;
   var $idempresa;
   var $idempresa_1;
   var $idusuarioauditoria;
   var $codigo;
   var $nome;
   var $volume;
   var $quantidade;
   var $valorunitario;
   var $valortotal;
   var $tipovalidade;
   var $datavalidade;
   var $datafabricacao;
   var $lote;
   var $estoqueminimo;
   var $estoquemaximo;
   var $valorpontopedido;
   var $tipopontopedido;
   var $tipopontopedido_1;
   var $temperaturarecebimento;
   var $temperaturatransporte;
   var $temperaturapadrao;
   var $codigobarras;
   var $enderecoipauditoria;
   var $nomeaplicacaoauditoria;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $sc_insert_on;
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
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['datafabricacao']))
          {
              $this->datafabricacao = $this->NM_ajax_info['param']['datafabricacao'];
          }
          if (isset($this->NM_ajax_info['param']['datavalidade']))
          {
              $this->datavalidade = $this->NM_ajax_info['param']['datavalidade'];
          }
          if (isset($this->NM_ajax_info['param']['enderecoipauditoria']))
          {
              $this->enderecoipauditoria = $this->NM_ajax_info['param']['enderecoipauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['estoquemaximo']))
          {
              $this->estoquemaximo = $this->NM_ajax_info['param']['estoquemaximo'];
          }
          if (isset($this->NM_ajax_info['param']['estoqueminimo']))
          {
              $this->estoqueminimo = $this->NM_ajax_info['param']['estoqueminimo'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifadoentrada']))
          {
              $this->idalmoxarifadoentrada = $this->NM_ajax_info['param']['idalmoxarifadoentrada'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifadoentradaproduto']))
          {
              $this->idalmoxarifadoentradaproduto = $this->NM_ajax_info['param']['idalmoxarifadoentradaproduto'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifadoproduto']))
          {
              $this->idalmoxarifadoproduto = $this->NM_ajax_info['param']['idalmoxarifadoproduto'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifadoprodutolocalarmazenamento']))
          {
              $this->idalmoxarifadoprodutolocalarmazenamento = $this->NM_ajax_info['param']['idalmoxarifadoprodutolocalarmazenamento'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifadoprodutovolume']))
          {
              $this->idalmoxarifadoprodutovolume = $this->NM_ajax_info['param']['idalmoxarifadoprodutovolume'];
          }
          if (isset($this->NM_ajax_info['param']['idempresa']))
          {
              $this->idempresa = $this->NM_ajax_info['param']['idempresa'];
          }
          if (isset($this->NM_ajax_info['param']['idtenacidade']))
          {
              $this->idtenacidade = $this->NM_ajax_info['param']['idtenacidade'];
          }
          if (isset($this->NM_ajax_info['param']['idusuarioauditoria']))
          {
              $this->idusuarioauditoria = $this->NM_ajax_info['param']['idusuarioauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['lote']))
          {
              $this->lote = $this->NM_ajax_info['param']['lote'];
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
          if (isset($this->NM_ajax_info['param']['nmgp_refresh_fields']))
          {
              $this->nmgp_refresh_fields = $this->NM_ajax_info['param']['nmgp_refresh_fields'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['nomeaplicacaoauditoria']))
          {
              $this->nomeaplicacaoauditoria = $this->NM_ajax_info['param']['nomeaplicacaoauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['quantidade']))
          {
              $this->quantidade = $this->NM_ajax_info['param']['quantidade'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['temperaturapadrao']))
          {
              $this->temperaturapadrao = $this->NM_ajax_info['param']['temperaturapadrao'];
          }
          if (isset($this->NM_ajax_info['param']['temperaturarecebimento']))
          {
              $this->temperaturarecebimento = $this->NM_ajax_info['param']['temperaturarecebimento'];
          }
          if (isset($this->NM_ajax_info['param']['temperaturatransporte']))
          {
              $this->temperaturatransporte = $this->NM_ajax_info['param']['temperaturatransporte'];
          }
          if (isset($this->NM_ajax_info['param']['tipopontopedido']))
          {
              $this->tipopontopedido = $this->NM_ajax_info['param']['tipopontopedido'];
          }
          if (isset($this->NM_ajax_info['param']['tipovalidade']))
          {
              $this->tipovalidade = $this->NM_ajax_info['param']['tipovalidade'];
          }
          if (isset($this->NM_ajax_info['param']['valorpontopedido']))
          {
              $this->valorpontopedido = $this->NM_ajax_info['param']['valorpontopedido'];
          }
          if (isset($this->NM_ajax_info['param']['valortotal']))
          {
              $this->valortotal = $this->NM_ajax_info['param']['valortotal'];
          }
          if (isset($this->NM_ajax_info['param']['valorunitario']))
          {
              $this->valorunitario = $this->NM_ajax_info['param']['valorunitario'];
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
      if (isset($this->varIdEmpresa) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdEmpresa'] = $this->varIdEmpresa;
      }
      if (isset($this->varPrimeiraVez) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varTipoEntrada) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varTipoEntrada'] = $this->varTipoEntrada;
      }
      if (isset($this->varTemInformacoesEstoque) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varTemInformacoesEstoque'] = $this->varTemInformacoesEstoque;
      }
      if (isset($this->varTipoAcesso) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varTipoAcesso'] = $this->varTipoAcesso;
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
      if (isset($_POST["varIdEmpresa"]) && isset($this->varIdEmpresa)) 
      {
          $_SESSION['varIdEmpresa'] = $this->varIdEmpresa;
      }
      if (!isset($_POST["varIdEmpresa"]) && isset($_POST["varidempresa"])) 
      {
          $_SESSION['varIdEmpresa'] = $_POST["varidempresa"];
      }
      if (isset($_POST["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_POST["varPrimeiraVez"]) && isset($_POST["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_POST["varprimeiravez"];
      }
      if (isset($_POST["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_POST["varIdUsuario"]) && isset($_POST["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_POST["varidusuario"];
      }
      if (isset($_POST["varTipoEntrada"]) && isset($this->varTipoEntrada)) 
      {
          $_SESSION['varTipoEntrada'] = $this->varTipoEntrada;
      }
      if (!isset($_POST["varTipoEntrada"]) && isset($_POST["vartipoentrada"])) 
      {
          $_SESSION['varTipoEntrada'] = $_POST["vartipoentrada"];
      }
      if (isset($_POST["varTemInformacoesEstoque"]) && isset($this->varTemInformacoesEstoque)) 
      {
          $_SESSION['varTemInformacoesEstoque'] = $this->varTemInformacoesEstoque;
      }
      if (!isset($_POST["varTemInformacoesEstoque"]) && isset($_POST["varteminformacoesestoque"])) 
      {
          $_SESSION['varTemInformacoesEstoque'] = $_POST["varteminformacoesestoque"];
      }
      if (isset($_POST["varTipoAcesso"]) && isset($this->varTipoAcesso)) 
      {
          $_SESSION['varTipoAcesso'] = $this->varTipoAcesso;
      }
      if (!isset($_POST["varTipoAcesso"]) && isset($_POST["vartipoacesso"])) 
      {
          $_SESSION['varTipoAcesso'] = $_POST["vartipoacesso"];
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
      if (isset($_GET["varIdEmpresa"]) && isset($this->varIdEmpresa)) 
      {
          $_SESSION['varIdEmpresa'] = $this->varIdEmpresa;
      }
      if (!isset($_GET["varIdEmpresa"]) && isset($_GET["varidempresa"])) 
      {
          $_SESSION['varIdEmpresa'] = $_GET["varidempresa"];
      }
      if (isset($_GET["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_GET["varPrimeiraVez"]) && isset($_GET["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_GET["varprimeiravez"];
      }
      if (isset($_GET["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_GET["varIdUsuario"]) && isset($_GET["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_GET["varidusuario"];
      }
      if (isset($_GET["varTipoEntrada"]) && isset($this->varTipoEntrada)) 
      {
          $_SESSION['varTipoEntrada'] = $this->varTipoEntrada;
      }
      if (!isset($_GET["varTipoEntrada"]) && isset($_GET["vartipoentrada"])) 
      {
          $_SESSION['varTipoEntrada'] = $_GET["vartipoentrada"];
      }
      if (isset($_GET["varTemInformacoesEstoque"]) && isset($this->varTemInformacoesEstoque)) 
      {
          $_SESSION['varTemInformacoesEstoque'] = $this->varTemInformacoesEstoque;
      }
      if (!isset($_GET["varTemInformacoesEstoque"]) && isset($_GET["varteminformacoesestoque"])) 
      {
          $_SESSION['varTemInformacoesEstoque'] = $_GET["varteminformacoesestoque"];
      }
      if (isset($_GET["varTipoAcesso"]) && isset($this->varTipoAcesso)) 
      {
          $_SESSION['varTipoAcesso'] = $this->varTipoAcesso;
      }
      if (!isset($_GET["varTipoAcesso"]) && isset($_GET["vartipoacesso"])) 
      {
          $_SESSION['varTipoAcesso'] = $_GET["vartipoacesso"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_parms']);
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
                 nm_limpa_str_AlmoxarifadoEntradaProduto_Validacao_Frm($cadapar[1]);
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
          if (!isset($this->varIdEmpresa) && isset($this->varidempresa)) 
          {
              $this->varIdEmpresa = $this->varidempresa;
          }
          if (isset($this->varIdEmpresa)) 
          {
              $_SESSION['varIdEmpresa'] = $this->varIdEmpresa;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varTipoEntrada) && isset($this->vartipoentrada)) 
          {
              $this->varTipoEntrada = $this->vartipoentrada;
          }
          if (isset($this->varTipoEntrada)) 
          {
              $_SESSION['varTipoEntrada'] = $this->varTipoEntrada;
          }
          if (!isset($this->varTemInformacoesEstoque) && isset($this->varteminformacoesestoque)) 
          {
              $this->varTemInformacoesEstoque = $this->varteminformacoesestoque;
          }
          if (isset($this->varTemInformacoesEstoque)) 
          {
              $_SESSION['varTemInformacoesEstoque'] = $this->varTemInformacoesEstoque;
          }
          if (!isset($this->varTipoAcesso) && isset($this->vartipoacesso)) 
          {
              $this->varTipoAcesso = $this->vartipoacesso;
          }
          if (isset($this->varTipoAcesso)) 
          {
              $_SESSION['varTipoAcesso'] = $this->varTipoAcesso;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opc_ant']);
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
          if (!isset($this->varIdEmpresa) && isset($this->varidempresa)) 
          {
              $this->varIdEmpresa = $this->varidempresa;
          }
          if (isset($this->varIdEmpresa)) 
          {
              $_SESSION['varIdEmpresa'] = $this->varIdEmpresa;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varTipoEntrada) && isset($this->vartipoentrada)) 
          {
              $this->varTipoEntrada = $this->vartipoentrada;
          }
          if (isset($this->varTipoEntrada)) 
          {
              $_SESSION['varTipoEntrada'] = $this->varTipoEntrada;
          }
          if (!isset($this->varTemInformacoesEstoque) && isset($this->varteminformacoesestoque)) 
          {
              $this->varTemInformacoesEstoque = $this->varteminformacoesestoque;
          }
          if (isset($this->varTemInformacoesEstoque)) 
          {
              $_SESSION['varTemInformacoesEstoque'] = $this->varTemInformacoesEstoque;
          }
          if (!isset($this->varTipoAcesso) && isset($this->vartipoacesso)) 
          {
              $this->varTipoAcesso = $this->vartipoacesso;
          }
          if (isset($this->varTipoAcesso)) 
          {
              $_SESSION['varTipoAcesso'] = $this->varTipoAcesso;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new AlmoxarifadoEntradaProduto_Validacao_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varTipoEntrada)) {$this->sc_temp_varTipoEntrada = (isset($_SESSION['varTipoEntrada'])) ? $_SESSION['varTipoEntrada'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
  $this->sc_temp_varPrimeiraVez = "";
$this->sc_temp_varIdTenacidade;
$this->sc_temp_varIdUsuario;
$this->sc_temp_varTipoEntrada;
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varTipoEntrada)) { $_SESSION['varTipoEntrada'] = $this->sc_temp_varTipoEntrada;}
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['AlmoxarifadoEntradaProduto_Validacao_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['AlmoxarifadoEntradaProduto_Validacao_Frm'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoEntradaProduto_Validacao_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoEntradaProduto_Validacao_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('AlmoxarifadoEntradaProduto_Validacao_Frm') . "/AlmoxarifadoEntradaProduto_Validacao_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoEntradaProduto_Validacao_Frm']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Produtos";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "AlmoxarifadoEntradaProduto_Validacao_Frm")
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



      $_SESSION['scriptcase']['error_icon']['AlmoxarifadoEntradaProduto_Validacao_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['AlmoxarifadoEntradaProduto_Validacao_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "AlmoxarifadoEntradaProduto_Validacao_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "on";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_orig'] = " where (IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_pesq'] = " where (IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')";
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoEntradaProduto_Validacao_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['AlmoxarifadoEntradaProduto_Validacao_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['AlmoxarifadoEntradaProduto_Validacao_Frm'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_form'];
          if (!isset($this->codigo)){$this->codigo = $this->nmgp_dados_form['codigo'];} 
          if (!isset($this->nome)){$this->nome = $this->nmgp_dados_form['nome'];} 
          if (!isset($this->volume)){$this->volume = $this->nmgp_dados_form['volume'];} 
          if (!isset($this->codigobarras)){$this->codigobarras = $this->nmgp_dados_form['codigobarras'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("AlmoxarifadoEntradaProduto_Validacao_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'AlmoxarifadoEntradaProduto_Validacao_Frm/AlmoxarifadoEntradaProduto_Validacao_Frm_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'AlmoxarifadoEntradaProduto_Validacao_Frm_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'AlmoxarifadoEntradaProduto_Validacao_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'AlmoxarifadoEntradaProduto_Validacao_Frm_help.txt');
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
          require_once($this->Ini->path_embutida . 'AlmoxarifadoEntradaProduto_Validacao_Frm/AlmoxarifadoEntradaProduto_Validacao_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "AlmoxarifadoEntradaProduto_Validacao_Frm_erro.class.php"); 
      }
      $this->Erro      = new AlmoxarifadoEntradaProduto_Validacao_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao']))
         { 
             if ($this->idalmoxarifadoentradaproduto != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoEntradaProduto_Validacao_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
      $this->sc_insert_on = false;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      
/*----- Scriptcase Locale: Event onScriptinit ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varTipoEntrada)) {$this->sc_temp_varTipoEntrada = (isset($_SESSION['varTipoEntrada'])) ? $_SESSION['varTipoEntrada'] : "";}
  if ($this->sc_temp_varTipoEntrada == 'Inserir') {
	
	$this->nmgp_cmp_hidden["estoqueminimo"] = 'off'; $this->NM_ajax_info['fieldDisplay']['estoqueminimo'] = 'off';
	$this->nmgp_cmp_hidden["estoquemaximo"] = 'off'; $this->NM_ajax_info['fieldDisplay']['estoquemaximo'] = 'off';
	$this->nmgp_cmp_hidden["valorpontopedido"] = 'off'; $this->NM_ajax_info['fieldDisplay']['valorpontopedido'] = 'off';
	$this->nmgp_cmp_hidden["tipopontopedido"] = 'off'; $this->NM_ajax_info['fieldDisplay']['tipopontopedido'] = 'off';
	
} else {
	
	$this->NM_ajax_info['buttonDisplay']['new'] = $this->nmgp_botoes["new"] = 'off';;
	$this->sc_field_readonly("tipovalidade", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_disabled_macro']['tipovalidade'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("datavalidade", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_disabled_macro']['datavalidade'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("datafabricacao", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_disabled_macro']['datafabricacao'] = array('I'=>array(),'U'=>array());
;
	
}
if (isset($this->sc_temp_varTipoEntrada)) { $_SESSION['varTipoEntrada'] = $this->sc_temp_varTipoEntrada;}
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onScriptinit ------*/
 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->idalmoxarifadoentradaproduto)) { $this->nm_limpa_alfa($this->idalmoxarifadoentradaproduto); }
      if (isset($this->idtenacidade)) { $this->nm_limpa_alfa($this->idtenacidade); }
      if (isset($this->idalmoxarifadoentrada)) { $this->nm_limpa_alfa($this->idalmoxarifadoentrada); }
      if (isset($this->idalmoxarifadoproduto)) { $this->nm_limpa_alfa($this->idalmoxarifadoproduto); }
      if (isset($this->idalmoxarifadoprodutovolume)) { $this->nm_limpa_alfa($this->idalmoxarifadoprodutovolume); }
      if (isset($this->idalmoxarifadoprodutolocalarmazenamento)) { $this->nm_limpa_alfa($this->idalmoxarifadoprodutolocalarmazenamento); }
      if (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
      if (isset($this->idusuarioauditoria)) { $this->nm_limpa_alfa($this->idusuarioauditoria); }
      if (isset($this->quantidade)) { $this->nm_limpa_alfa($this->quantidade); }
      if (isset($this->valorunitario)) { $this->nm_limpa_alfa($this->valorunitario); }
      if (isset($this->valortotal)) { $this->nm_limpa_alfa($this->valortotal); }
      if (isset($this->tipovalidade)) { $this->nm_limpa_alfa($this->tipovalidade); }
      if (isset($this->lote)) { $this->nm_limpa_alfa($this->lote); }
      if (isset($this->estoqueminimo)) { $this->nm_limpa_alfa($this->estoqueminimo); }
      if (isset($this->estoquemaximo)) { $this->nm_limpa_alfa($this->estoquemaximo); }
      if (isset($this->valorpontopedido)) { $this->nm_limpa_alfa($this->valorpontopedido); }
      if (isset($this->tipopontopedido)) { $this->nm_limpa_alfa($this->tipopontopedido); }
      if (isset($this->temperaturarecebimento)) { $this->nm_limpa_alfa($this->temperaturarecebimento); }
      if (isset($this->temperaturatransporte)) { $this->nm_limpa_alfa($this->temperaturatransporte); }
      if (isset($this->temperaturapadrao)) { $this->nm_limpa_alfa($this->temperaturapadrao); }
      if (isset($this->enderecoipauditoria)) { $this->nm_limpa_alfa($this->enderecoipauditoria); }
      if (isset($this->nomeaplicacaoauditoria)) { $this->nm_limpa_alfa($this->nomeaplicacaoauditoria); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "AlmoxarifadoEntradaProduto_Validacao_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- quantidade
      $this->field_config['quantidade']               = array();
      $this->field_config['quantidade']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['quantidade']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['quantidade']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['quantidade']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['quantidade']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- valorunitario
      $this->field_config['valorunitario']               = array();
      $this->field_config['valorunitario']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorunitario']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorunitario']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorunitario']['symbol_mon'] = $_SESSION['scriptcase']['reg_conf']['monet_simb'];
      $this->field_config['valorunitario']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorunitario']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valortotal
      $this->field_config['valortotal']               = array();
      $this->field_config['valortotal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valortotal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valortotal']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valortotal']['symbol_mon'] = $_SESSION['scriptcase']['reg_conf']['monet_simb'];
      $this->field_config['valortotal']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valortotal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- idalmoxarifadoentradaproduto
      $this->field_config['idalmoxarifadoentradaproduto']               = array();
      $this->field_config['idalmoxarifadoentradaproduto']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idalmoxarifadoentradaproduto']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idalmoxarifadoentradaproduto']['symbol_dec'] = '';
      $this->field_config['idalmoxarifadoentradaproduto']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idalmoxarifadoentradaproduto']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- estoqueminimo
      $this->field_config['estoqueminimo']               = array();
      $this->field_config['estoqueminimo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['estoqueminimo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['estoqueminimo']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['estoqueminimo']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['estoqueminimo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- estoquemaximo
      $this->field_config['estoquemaximo']               = array();
      $this->field_config['estoquemaximo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['estoquemaximo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['estoquemaximo']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['estoquemaximo']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['estoquemaximo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- valorpontopedido
      $this->field_config['valorpontopedido']               = array();
      $this->field_config['valorpontopedido']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['valorpontopedido']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['valorpontopedido']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['valorpontopedido']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['valorpontopedido']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- datavalidade
      $this->field_config['datavalidade']                 = array();
      $this->field_config['datavalidade']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['datavalidade']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datavalidade']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'datavalidade');
      //-- datafabricacao
      $this->field_config['datafabricacao']                 = array();
      $this->field_config['datafabricacao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['datafabricacao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datafabricacao']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'datafabricacao');
      //-- temperaturarecebimento
      $this->field_config['temperaturarecebimento']               = array();
      $this->field_config['temperaturarecebimento']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['temperaturarecebimento']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['temperaturarecebimento']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['temperaturarecebimento']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['temperaturarecebimento']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- temperaturatransporte
      $this->field_config['temperaturatransporte']               = array();
      $this->field_config['temperaturatransporte']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['temperaturatransporte']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['temperaturatransporte']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['temperaturatransporte']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['temperaturatransporte']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- temperaturapadrao
      $this->field_config['temperaturapadrao']               = array();
      $this->field_config['temperaturapadrao']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['temperaturapadrao']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['temperaturapadrao']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['temperaturapadrao']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['temperaturapadrao']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idtenacidade
      $this->field_config['idtenacidade']               = array();
      $this->field_config['idtenacidade']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idtenacidade']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idtenacidade']['symbol_dec'] = '';
      $this->field_config['idtenacidade']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idtenacidade']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idalmoxarifadoentrada
      $this->field_config['idalmoxarifadoentrada']               = array();
      $this->field_config['idalmoxarifadoentrada']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idalmoxarifadoentrada']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idalmoxarifadoentrada']['symbol_dec'] = '';
      $this->field_config['idalmoxarifadoentrada']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idalmoxarifadoentrada']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idusuarioauditoria
      $this->field_config['idusuarioauditoria']               = array();
      $this->field_config['idusuarioauditoria']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idusuarioauditoria']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idusuarioauditoria']['symbol_dec'] = '';
      $this->field_config['idusuarioauditoria']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idusuarioauditoria']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_idalmoxarifadoproduto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifadoproduto');
          }
          if ('validate_quantidade' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'quantidade');
          }
          if ('validate_idalmoxarifadoprodutovolume' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifadoprodutovolume');
          }
          if ('validate_valorunitario' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorunitario');
          }
          if ('validate_valortotal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valortotal');
          }
          if ('validate_lote' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'lote');
          }
          if ('validate_idalmoxarifadoentradaproduto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifadoentradaproduto');
          }
          if ('validate_estoqueminimo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'estoqueminimo');
          }
          if ('validate_estoquemaximo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'estoquemaximo');
          }
          if ('validate_valorpontopedido' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorpontopedido');
          }
          if ('validate_tipopontopedido' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tipopontopedido');
          }
          if ('validate_idalmoxarifadoprodutolocalarmazenamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifadoprodutolocalarmazenamento');
          }
          if ('validate_tipovalidade' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tipovalidade');
          }
          if ('validate_datavalidade' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datavalidade');
          }
          if ('validate_datafabricacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datafabricacao');
          }
          if ('validate_temperaturarecebimento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'temperaturarecebimento');
          }
          if ('validate_temperaturatransporte' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'temperaturatransporte');
          }
          if ('validate_temperaturapadrao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'temperaturapadrao');
          }
          if ('validate_idtenacidade' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtenacidade');
          }
          if ('validate_idempresa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idempresa');
          }
          if ('validate_idalmoxarifadoentrada' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifadoentrada');
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
          AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['estoqueminimo']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->estoqueminimo = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['estoqueminimo'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['estoquemaximo']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->estoquemaximo = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['estoquemaximo'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['valorpontopedido']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->valorpontopedido = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['valorpontopedido'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['tipopontopedido']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->tipopontopedido = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['tipopontopedido'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['idempresa']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idempresa = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select']['idempresa'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
          $_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_atualiz'] == "ok")
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
          AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
          AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "AlmoxarifadoEntradaProduto_Validacao_Frm.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Produtos") ?></TITLE>
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
<form name="Fdown" method="get" action="AlmoxarifadoEntradaProduto_Validacao_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="AlmoxarifadoEntradaProduto_Validacao_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="AlmoxarifadoEntradaProduto_Validacao_Frm.php" target="_self" style="display: none"> 
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
           case 'idalmoxarifadoproduto':
               return "Produto";
               break;
           case 'quantidade':
               return "Quantidade";
               break;
           case 'idalmoxarifadoprodutovolume':
               return "Volume";
               break;
           case 'valorunitario':
               return "Valor unitário";
               break;
           case 'valortotal':
               return "Valor total";
               break;
           case 'lote':
               return "Lote";
               break;
           case 'idalmoxarifadoentradaproduto':
               return "Id.";
               break;
           case 'estoqueminimo':
               return "Estoque mínimo *";
               break;
           case 'estoquemaximo':
               return "Estoque máximo *";
               break;
           case 'valorpontopedido':
               return "Valor ponto pedido *";
               break;
           case 'tipopontopedido':
               return "Tipo ponto pedido *";
               break;
           case 'idalmoxarifadoprodutolocalarmazenamento':
               return "Local de armazenamento";
               break;
           case 'tipovalidade':
               return "Tipo validade";
               break;
           case 'datavalidade':
               return "Data validade";
               break;
           case 'datafabricacao':
               return "Data fabricação";
               break;
           case 'temperaturarecebimento':
               return "Temperatura recebimento";
               break;
           case 'temperaturatransporte':
               return "Temperatura transporte";
               break;
           case 'temperaturapadrao':
               return "Temperatura padrão";
               break;
           case 'idtenacidade':
               return "Tenacidade";
               break;
           case 'idempresa':
               return "Empresa rateio *";
               break;
           case 'idalmoxarifadoentrada':
               return "Id Almoxarifado Entrada";
               break;
           case 'idusuarioauditoria':
               return "Usuário";
               break;
           case 'enderecoipauditoria':
               return "Endereco IP";
               break;
           case 'nomeaplicacaoauditoria':
               return "Aplicação";
               break;
           case 'codigo':
               return "Código";
               break;
           case 'nome':
               return "Nome";
               break;
           case 'volume':
               return "Volume";
               break;
           case 'codigobarras':
               return "Código de barras";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_AlmoxarifadoEntradaProduto_Validacao_Frm']) || !is_array($this->NM_ajax_info['errList']['geral_AlmoxarifadoEntradaProduto_Validacao_Frm']))
              {
                  $this->NM_ajax_info['errList']['geral_AlmoxarifadoEntradaProduto_Validacao_Frm'] = array();
              }
              $this->NM_ajax_info['errList']['geral_AlmoxarifadoEntradaProduto_Validacao_Frm'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifadoproduto' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifadoproduto', $filtro)))
        $this->ValidateField_idalmoxarifadoproduto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idalmoxarifadoproduto";

      if ((!is_array($filtro) && ('' == $filtro || 'quantidade' == $filtro)) || (is_array($filtro) && in_array('quantidade', $filtro)))
        $this->ValidateField_quantidade($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "quantidade";

      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifadoprodutovolume' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifadoprodutovolume', $filtro)))
        $this->ValidateField_idalmoxarifadoprodutovolume($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idalmoxarifadoprodutovolume";

      if ((!is_array($filtro) && ('' == $filtro || 'valorunitario' == $filtro)) || (is_array($filtro) && in_array('valorunitario', $filtro)))
        $this->ValidateField_valorunitario($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valorunitario";

      if ((!is_array($filtro) && ('' == $filtro || 'valortotal' == $filtro)) || (is_array($filtro) && in_array('valortotal', $filtro)))
        $this->ValidateField_valortotal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valortotal";

      if ((!is_array($filtro) && ('' == $filtro || 'lote' == $filtro)) || (is_array($filtro) && in_array('lote', $filtro)))
        $this->ValidateField_lote($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "lote";

      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifadoentradaproduto' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifadoentradaproduto', $filtro)))
        $this->ValidateField_idalmoxarifadoentradaproduto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idalmoxarifadoentradaproduto";

      if ((!is_array($filtro) && ('' == $filtro || 'estoqueminimo' == $filtro)) || (is_array($filtro) && in_array('estoqueminimo', $filtro)))
        $this->ValidateField_estoqueminimo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "estoqueminimo";

      if ((!is_array($filtro) && ('' == $filtro || 'estoquemaximo' == $filtro)) || (is_array($filtro) && in_array('estoquemaximo', $filtro)))
        $this->ValidateField_estoquemaximo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "estoquemaximo";

      if ((!is_array($filtro) && ('' == $filtro || 'valorpontopedido' == $filtro)) || (is_array($filtro) && in_array('valorpontopedido', $filtro)))
        $this->ValidateField_valorpontopedido($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valorpontopedido";

      if ((!is_array($filtro) && ('' == $filtro || 'tipopontopedido' == $filtro)) || (is_array($filtro) && in_array('tipopontopedido', $filtro)))
        $this->ValidateField_tipopontopedido($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tipopontopedido";

      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifadoprodutolocalarmazenamento' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifadoprodutolocalarmazenamento', $filtro)))
        $this->ValidateField_idalmoxarifadoprodutolocalarmazenamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idalmoxarifadoprodutolocalarmazenamento";

      if ((!is_array($filtro) && ('' == $filtro || 'tipovalidade' == $filtro)) || (is_array($filtro) && in_array('tipovalidade', $filtro)))
        $this->ValidateField_tipovalidade($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tipovalidade";

      if ((!is_array($filtro) && ('' == $filtro || 'datavalidade' == $filtro)) || (is_array($filtro) && in_array('datavalidade', $filtro)))
        $this->ValidateField_datavalidade($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "datavalidade";

      if ((!is_array($filtro) && ('' == $filtro || 'datafabricacao' == $filtro)) || (is_array($filtro) && in_array('datafabricacao', $filtro)))
        $this->ValidateField_datafabricacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "datafabricacao";

      if ((!is_array($filtro) && ('' == $filtro || 'temperaturarecebimento' == $filtro)) || (is_array($filtro) && in_array('temperaturarecebimento', $filtro)))
        $this->ValidateField_temperaturarecebimento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "temperaturarecebimento";

      if ((!is_array($filtro) && ('' == $filtro || 'temperaturatransporte' == $filtro)) || (is_array($filtro) && in_array('temperaturatransporte', $filtro)))
        $this->ValidateField_temperaturatransporte($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "temperaturatransporte";

      if ((!is_array($filtro) && ('' == $filtro || 'temperaturapadrao' == $filtro)) || (is_array($filtro) && in_array('temperaturapadrao', $filtro)))
        $this->ValidateField_temperaturapadrao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "temperaturapadrao";

      if ((!is_array($filtro) && ('' == $filtro || 'idtenacidade' == $filtro)) || (is_array($filtro) && in_array('idtenacidade', $filtro)))
        $this->ValidateField_idtenacidade($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idtenacidade";

      if ((!is_array($filtro) && ('' == $filtro || 'idempresa' == $filtro)) || (is_array($filtro) && in_array('idempresa', $filtro)))
        $this->ValidateField_idempresa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idempresa";

      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifadoentrada' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifadoentrada', $filtro)))
        $this->ValidateField_idalmoxarifadoentrada($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idalmoxarifadoentrada";

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

      if (empty($Campos_Crit) && empty($Campos_Falta) && empty($this->Campos_Mens_erro))
      {
          if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
          {
              
/*----- Scriptcase Locale: Event onValidateSuccess ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varTipoAcesso)) {$this->sc_temp_varTipoAcesso = (isset($_SESSION['varTipoAcesso'])) ? $_SESSION['varTipoAcesso'] : "";}
if (!isset($this->sc_temp_varTipoEntrada)) {$this->sc_temp_varTipoEntrada = (isset($_SESSION['varTipoEntrada'])) ? $_SESSION['varTipoEntrada'] : "";}
  $msgErro = '';

if ($this->sc_temp_varTipoEntrada != 'Inserir') {

	if ($this->sc_temp_varTipoAcesso == 'Produto') {
		if (empty($this->estoqueminimo )) {
			$msgErro = $msgErro . 'Estoque mínimo: Campo obrigatório<br>';
		}
		if (empty($this->estoquemaximo )) {
			$msgErro = $msgErro . 'Estoque máximo: Campo obrigatório<br>';
		}
		if (empty($this->valorpontopedido )) {
			$msgErro = $msgErro . 'Valor ponto de pedido: Campo obrigatório<br>';
		}
		if (empty($this->tipopontopedido )) {
			$msgErro = $msgErro . 'Tipo ponto de pedido; Campo obrigatório<br>';
		}
		
		if (strlen($this->datavalidade ) < 5 && $this->tipovalidade  == 'S') {
			$msgErro = $msgErro . 'Data validade: Campo obrigatório<br>';
		}
	} else {
		if (empty($idplanoconta )) {
			$msgErro = $msgErro . 'Plano conta: Campo obrigatório<br>';
		}
		if (empty($this->idempresa )) {
			$msgErro = $msgErro . 'Empresa rateio: Campo obrigatório<br>';
		}
	}
} else {		
	
	if (strlen($this->datavalidade ) < 5 && $this->tipovalidade  == 'S') {
		$msgErro = $msgErro . 'Data validade: Campo obrigatório<br>';
	}
	
}

if ($msgErro != '') {
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $msgErro;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_AlmoxarifadoEntradaProduto_Validacao_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_AlmoxarifadoEntradaProduto_Validacao_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msgErro;
 }
;
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_varTipoEntrada)) { $_SESSION['varTipoEntrada'] = $this->sc_temp_varTipoEntrada;}
 if (isset($this->sc_temp_varTipoAcesso)) { $_SESSION['varTipoAcesso'] = $this->sc_temp_varTipoAcesso;}
    if ($this->NM_ajax_flag)
    {
        $_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
        AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
        exit;
    }
    $Sc_Lixo = ob_get_clean();
    $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro);
    $_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
    $this->Campos_Mens_erro = "";
    if ($this->nmgp_opcao == "incluir") {$this->nmgp_opcao = "novo";};
    $this->nm_proc_onload();
    $this->nm_formatar_campos();
    $this->nm_gera_html();
    $this->NM_close_db();
    exit;
}
}
if (isset($this->sc_temp_varTipoEntrada)) { $_SESSION['varTipoEntrada'] = $this->sc_temp_varTipoEntrada;}
if (isset($this->sc_temp_varTipoAcesso)) { $_SESSION['varTipoAcesso'] = $this->sc_temp_varTipoAcesso;}
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onValidateSuccess ------*/
 
          }
      }
   }

    function ValidateField_idalmoxarifadoproduto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idalmoxarifadoproduto'])) {
       return;
   }
   if ($this->nmgp_opcao == "incluir")
   {
      if ($this->idalmoxarifadoproduto == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['idalmoxarifadoproduto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['idalmoxarifadoproduto'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Produto" ; 
          if (!isset($Campos_Erros['idalmoxarifadoproduto']))
          {
              $Campos_Erros['idalmoxarifadoproduto'] = array();
          }
          $Campos_Erros['idalmoxarifadoproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoproduto']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoproduto']))
          {
              $this->NM_ajax_info['errList']['idalmoxarifadoproduto'] = array();
          }
          $this->NM_ajax_info['errList']['idalmoxarifadoproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idalmoxarifadoproduto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']) && !in_array($this->idalmoxarifadoproduto, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idalmoxarifadoproduto']))
              {
                  $Campos_Erros['idalmoxarifadoproduto'] = array();
              }
              $Campos_Erros['idalmoxarifadoproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoproduto']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoproduto']))
              {
                  $this->NM_ajax_info['errList']['idalmoxarifadoproduto'] = array();
              }
              $this->NM_ajax_info['errList']['idalmoxarifadoproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idalmoxarifadoproduto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idalmoxarifadoproduto

    function ValidateField_quantidade(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['quantidade'])) {
          if (!empty($this->field_config['quantidade']['symbol_dec'])) {
              nm_limpa_valor($this->quantidade, $this->field_config['quantidade']['symbol_dec'], $this->field_config['quantidade']['symbol_grp']) ; 
          }
          return;
      }
      if (!empty($this->field_config['quantidade']['symbol_dec']))
      {
          nm_limpa_valor($this->quantidade, $this->field_config['quantidade']['symbol_dec'], $this->field_config['quantidade']['symbol_grp']) ; 
          if ('.' == substr($this->quantidade, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->quantidade, 1)))
              {
                  $this->quantidade = '';
              }
              else
              {
                  $this->quantidade = '0' . $this->quantidade;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_quantidade' == $this->NM_ajax_opcao)
      { 
          if ($this->quantidade != '')  
          { 
              $iTestSize = 13;
              if (strlen($this->quantidade) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Quantidade: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['quantidade']))
                  {
                      $Campos_Erros['quantidade'] = array();
                  }
                  $Campos_Erros['quantidade'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['quantidade']) || !is_array($this->NM_ajax_info['errList']['quantidade']))
                  {
                      $this->NM_ajax_info['errList']['quantidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['quantidade'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->quantidade, 12, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Quantidade; " ; 
                  if (!isset($Campos_Erros['quantidade']))
                  {
                      $Campos_Erros['quantidade'] = array();
                  }
                  $Campos_Erros['quantidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['quantidade']) || !is_array($this->NM_ajax_info['errList']['quantidade']))
                  {
                      $this->NM_ajax_info['errList']['quantidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['quantidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['quantidade']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['quantidade'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Quantidade" ; 
              if (!isset($Campos_Erros['quantidade']))
              {
                  $Campos_Erros['quantidade'] = array();
              }
              $Campos_Erros['quantidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['quantidade']) || !is_array($this->NM_ajax_info['errList']['quantidade']))
                  {
                      $this->NM_ajax_info['errList']['quantidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['quantidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'quantidade';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_quantidade

    function ValidateField_idalmoxarifadoprodutovolume(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idalmoxarifadoprodutovolume'])) {
       return;
   }
   if ($this->nmgp_opcao == "incluir")
   {
      if ($this->idalmoxarifadoprodutovolume == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['idalmoxarifadoprodutovolume']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['idalmoxarifadoprodutovolume'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Volume" ; 
          if (!isset($Campos_Erros['idalmoxarifadoprodutovolume']))
          {
              $Campos_Erros['idalmoxarifadoprodutovolume'] = array();
          }
          $Campos_Erros['idalmoxarifadoprodutovolume'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume']))
          {
              $this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume'] = array();
          }
          $this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idalmoxarifadoprodutovolume) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']) && !in_array($this->idalmoxarifadoprodutovolume, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idalmoxarifadoprodutovolume']))
              {
                  $Campos_Erros['idalmoxarifadoprodutovolume'] = array();
              }
              $Campos_Erros['idalmoxarifadoprodutovolume'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume']))
              {
                  $this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume'] = array();
              }
              $this->NM_ajax_info['errList']['idalmoxarifadoprodutovolume'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idalmoxarifadoprodutovolume';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idalmoxarifadoprodutovolume

    function ValidateField_valorunitario(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorunitario'])) {
          if (!empty($this->field_config['valorunitario']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp'], $this->field_config['valorunitario']['symbol_mon']); 
              nm_limpa_valor($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorunitario === "" || is_null($this->valorunitario))  
      { 
          $this->valorunitario = 0;
          $this->sc_force_zero[] = 'valorunitario';
      } 
      }
      if (!empty($this->field_config['valorunitario']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp'], $this->field_config['valorunitario']['symbol_mon']); 
          nm_limpa_valor($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp']) ; 
          if ('.' == substr($this->valorunitario, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorunitario, 1)))
              {
                  $this->valorunitario = '';
              }
              else
              {
                  $this->valorunitario = '0' . $this->valorunitario;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valorunitario != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valorunitario) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor unitário: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorunitario']))
                  {
                      $Campos_Erros['valorunitario'] = array();
                  }
                  $Campos_Erros['valorunitario'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorunitario']) || !is_array($this->NM_ajax_info['errList']['valorunitario']))
                  {
                      $this->NM_ajax_info['errList']['valorunitario'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorunitario'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorunitario, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor unitário; " ; 
                  if (!isset($Campos_Erros['valorunitario']))
                  {
                      $Campos_Erros['valorunitario'] = array();
                  }
                  $Campos_Erros['valorunitario'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorunitario']) || !is_array($this->NM_ajax_info['errList']['valorunitario']))
                  {
                      $this->NM_ajax_info['errList']['valorunitario'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorunitario'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorunitario';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorunitario

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
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valortotal === "" || is_null($this->valortotal))  
      { 
          $this->valortotal = 0;
          $this->sc_force_zero[] = 'valortotal';
      } 
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
      if ($this->nmgp_opcao != "excluir") 
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

    function ValidateField_lote(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['lote'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->lote) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Lote " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['lote']))
              {
                  $Campos_Erros['lote'] = array();
              }
              $Campos_Erros['lote'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['lote']) || !is_array($this->NM_ajax_info['errList']['lote']))
              {
                  $this->NM_ajax_info['errList']['lote'] = array();
              }
              $this->NM_ajax_info['errList']['lote'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'lote';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_lote

    function ValidateField_idalmoxarifadoentradaproduto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idalmoxarifadoentradaproduto'])) {
          nm_limpa_numero($this->idalmoxarifadoentradaproduto, $this->field_config['idalmoxarifadoentradaproduto']['symbol_grp']) ; 
          return;
      }
      if ($this->idalmoxarifadoentradaproduto === "" || is_null($this->idalmoxarifadoentradaproduto))  
      { 
          $this->idalmoxarifadoentradaproduto = 0;
      } 
      nm_limpa_numero($this->idalmoxarifadoentradaproduto, $this->field_config['idalmoxarifadoentradaproduto']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idalmoxarifadoentradaproduto' == $this->NM_ajax_opcao)
      { 
          if ($this->idalmoxarifadoentradaproduto != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idalmoxarifadoentradaproduto) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idalmoxarifadoentradaproduto']))
                  {
                      $Campos_Erros['idalmoxarifadoentradaproduto'] = array();
                  }
                  $Campos_Erros['idalmoxarifadoentradaproduto'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto']))
                  {
                      $this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto'] = array();
                  }
                  $this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idalmoxarifadoentradaproduto, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.; " ; 
                  if (!isset($Campos_Erros['idalmoxarifadoentradaproduto']))
                  {
                      $Campos_Erros['idalmoxarifadoentradaproduto'] = array();
                  }
                  $Campos_Erros['idalmoxarifadoentradaproduto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto']))
                  {
                      $this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto'] = array();
                  }
                  $this->NM_ajax_info['errList']['idalmoxarifadoentradaproduto'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idalmoxarifadoentradaproduto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idalmoxarifadoentradaproduto

    function ValidateField_estoqueminimo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['estoqueminimo'])) {
          if (!empty($this->field_config['estoqueminimo']['symbol_dec'])) {
              nm_limpa_valor($this->estoqueminimo, $this->field_config['estoqueminimo']['symbol_dec'], $this->field_config['estoqueminimo']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->estoqueminimo === "" || is_null($this->estoqueminimo))  
      { 
          $this->estoqueminimo = 0;
          $this->sc_force_zero[] = 'estoqueminimo';
      } 
      }
      if (!empty($this->field_config['estoqueminimo']['symbol_dec']))
      {
          nm_limpa_valor($this->estoqueminimo, $this->field_config['estoqueminimo']['symbol_dec'], $this->field_config['estoqueminimo']['symbol_grp']) ; 
          if ('.' == substr($this->estoqueminimo, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->estoqueminimo, 1)))
              {
                  $this->estoqueminimo = '';
              }
              else
              {
                  $this->estoqueminimo = '0' . $this->estoqueminimo;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->estoqueminimo != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->estoqueminimo) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Estoque mínimo *: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['estoqueminimo']))
                  {
                      $Campos_Erros['estoqueminimo'] = array();
                  }
                  $Campos_Erros['estoqueminimo'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['estoqueminimo']) || !is_array($this->NM_ajax_info['errList']['estoqueminimo']))
                  {
                      $this->NM_ajax_info['errList']['estoqueminimo'] = array();
                  }
                  $this->NM_ajax_info['errList']['estoqueminimo'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->estoqueminimo, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Estoque mínimo *; " ; 
                  if (!isset($Campos_Erros['estoqueminimo']))
                  {
                      $Campos_Erros['estoqueminimo'] = array();
                  }
                  $Campos_Erros['estoqueminimo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['estoqueminimo']) || !is_array($this->NM_ajax_info['errList']['estoqueminimo']))
                  {
                      $this->NM_ajax_info['errList']['estoqueminimo'] = array();
                  }
                  $this->NM_ajax_info['errList']['estoqueminimo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'estoqueminimo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_estoqueminimo

    function ValidateField_estoquemaximo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['estoquemaximo'])) {
          if (!empty($this->field_config['estoquemaximo']['symbol_dec'])) {
              nm_limpa_valor($this->estoquemaximo, $this->field_config['estoquemaximo']['symbol_dec'], $this->field_config['estoquemaximo']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->estoquemaximo === "" || is_null($this->estoquemaximo))  
      { 
          $this->estoquemaximo = 0;
          $this->sc_force_zero[] = 'estoquemaximo';
      } 
      }
      if (!empty($this->field_config['estoquemaximo']['symbol_dec']))
      {
          nm_limpa_valor($this->estoquemaximo, $this->field_config['estoquemaximo']['symbol_dec'], $this->field_config['estoquemaximo']['symbol_grp']) ; 
          if ('.' == substr($this->estoquemaximo, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->estoquemaximo, 1)))
              {
                  $this->estoquemaximo = '';
              }
              else
              {
                  $this->estoquemaximo = '0' . $this->estoquemaximo;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->estoquemaximo != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->estoquemaximo) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Estoque máximo *: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['estoquemaximo']))
                  {
                      $Campos_Erros['estoquemaximo'] = array();
                  }
                  $Campos_Erros['estoquemaximo'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['estoquemaximo']) || !is_array($this->NM_ajax_info['errList']['estoquemaximo']))
                  {
                      $this->NM_ajax_info['errList']['estoquemaximo'] = array();
                  }
                  $this->NM_ajax_info['errList']['estoquemaximo'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->estoquemaximo, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Estoque máximo *; " ; 
                  if (!isset($Campos_Erros['estoquemaximo']))
                  {
                      $Campos_Erros['estoquemaximo'] = array();
                  }
                  $Campos_Erros['estoquemaximo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['estoquemaximo']) || !is_array($this->NM_ajax_info['errList']['estoquemaximo']))
                  {
                      $this->NM_ajax_info['errList']['estoquemaximo'] = array();
                  }
                  $this->NM_ajax_info['errList']['estoquemaximo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'estoquemaximo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_estoquemaximo

    function ValidateField_valorpontopedido(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorpontopedido'])) {
          if (!empty($this->field_config['valorpontopedido']['symbol_dec'])) {
              nm_limpa_valor($this->valorpontopedido, $this->field_config['valorpontopedido']['symbol_dec'], $this->field_config['valorpontopedido']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorpontopedido === "" || is_null($this->valorpontopedido))  
      { 
          $this->valorpontopedido = 0;
          $this->sc_force_zero[] = 'valorpontopedido';
      } 
      }
      if (!empty($this->field_config['valorpontopedido']['symbol_dec']))
      {
          nm_limpa_valor($this->valorpontopedido, $this->field_config['valorpontopedido']['symbol_dec'], $this->field_config['valorpontopedido']['symbol_grp']) ; 
          if ('.' == substr($this->valorpontopedido, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorpontopedido, 1)))
              {
                  $this->valorpontopedido = '';
              }
              else
              {
                  $this->valorpontopedido = '0' . $this->valorpontopedido;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valorpontopedido != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->valorpontopedido) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor ponto pedido *: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorpontopedido']))
                  {
                      $Campos_Erros['valorpontopedido'] = array();
                  }
                  $Campos_Erros['valorpontopedido'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorpontopedido']) || !is_array($this->NM_ajax_info['errList']['valorpontopedido']))
                  {
                      $this->NM_ajax_info['errList']['valorpontopedido'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpontopedido'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorpontopedido, 17, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor ponto pedido *; " ; 
                  if (!isset($Campos_Erros['valorpontopedido']))
                  {
                      $Campos_Erros['valorpontopedido'] = array();
                  }
                  $Campos_Erros['valorpontopedido'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorpontopedido']) || !is_array($this->NM_ajax_info['errList']['valorpontopedido']))
                  {
                      $this->NM_ajax_info['errList']['valorpontopedido'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpontopedido'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorpontopedido';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorpontopedido

    function ValidateField_tipopontopedido(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['tipopontopedido'])) {
       return;
   }
      if ($this->tipopontopedido == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tipopontopedido';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tipopontopedido

    function ValidateField_idalmoxarifadoprodutolocalarmazenamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idalmoxarifadoprodutolocalarmazenamento'])) {
       return;
   }
      if ($this->idalmoxarifadoprodutolocalarmazenamento == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['idalmoxarifadoprodutolocalarmazenamento']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['idalmoxarifadoprodutolocalarmazenamento'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Local de armazenamento" ; 
          if (!isset($Campos_Erros['idalmoxarifadoprodutolocalarmazenamento']))
          {
              $Campos_Erros['idalmoxarifadoprodutolocalarmazenamento'] = array();
          }
          $Campos_Erros['idalmoxarifadoprodutolocalarmazenamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento']))
          {
              $this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento'] = array();
          }
          $this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idalmoxarifadoprodutolocalarmazenamento) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']) && !in_array($this->idalmoxarifadoprodutolocalarmazenamento, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idalmoxarifadoprodutolocalarmazenamento']))
              {
                  $Campos_Erros['idalmoxarifadoprodutolocalarmazenamento'] = array();
              }
              $Campos_Erros['idalmoxarifadoprodutolocalarmazenamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento']))
              {
                  $this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento'] = array();
              }
              $this->NM_ajax_info['errList']['idalmoxarifadoprodutolocalarmazenamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idalmoxarifadoprodutolocalarmazenamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idalmoxarifadoprodutolocalarmazenamento

    function ValidateField_tipovalidade(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['tipovalidade'])) {
       return;
   }
      if ($this->tipovalidade == "" && $this->nmgp_opcao != "excluir")
      { 
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['tipovalidade']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['php_cmp_required']['tipovalidade'] == "on")
        { 
          $hasError = true;
          $Campos_Falta[] = "Tipo validade" ; 
          if (!isset($Campos_Erros['tipovalidade']))
          {
              $Campos_Erros['tipovalidade'] = array();
          }
          $Campos_Erros['tipovalidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tipovalidade']) || !is_array($this->NM_ajax_info['errList']['tipovalidade']))
                  {
                      $this->NM_ajax_info['errList']['tipovalidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['tipovalidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
        } 
      } 
      if ($this->tipovalidade != "" && !in_array("tipovalidade", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_tipovalidade']) && !in_array($this->tipovalidade, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_tipovalidade']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tipovalidade']))
              {
                  $Campos_Erros['tipovalidade'] = array();
              }
              $Campos_Erros['tipovalidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tipovalidade']) || !is_array($this->NM_ajax_info['errList']['tipovalidade']))
              {
                  $this->NM_ajax_info['errList']['tipovalidade'] = array();
              }
              $this->NM_ajax_info['errList']['tipovalidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tipovalidade';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tipovalidade

    function ValidateField_datavalidade(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datavalidade, $this->field_config['datavalidade']['date_sep']) ; 
      if (isset($this->Field_no_validate['datavalidade'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datavalidade']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datavalidade']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datavalidade']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datavalidade']['date_sep']) ; 
          if (trim($this->datavalidade) != "")  
          { 
              $validateTest = $teste_validade->Data($this->datavalidade, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data validade; " ; 
                  if (!isset($Campos_Erros['datavalidade']))
                  {
                      $Campos_Erros['datavalidade'] = array();
                  }
                  $Campos_Erros['datavalidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datavalidade']) || !is_array($this->NM_ajax_info['errList']['datavalidade']))
                  {
                      $this->NM_ajax_info['errList']['datavalidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['datavalidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datavalidade']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datavalidade';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datavalidade

    function ValidateField_datafabricacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datafabricacao, $this->field_config['datafabricacao']['date_sep']) ; 
      if (isset($this->Field_no_validate['datafabricacao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datafabricacao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datafabricacao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datafabricacao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datafabricacao']['date_sep']) ; 
          if (trim($this->datafabricacao) != "")  
          { 
              $validateTest = $teste_validade->Data($this->datafabricacao, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data fabricação; " ; 
                  if (!isset($Campos_Erros['datafabricacao']))
                  {
                      $Campos_Erros['datafabricacao'] = array();
                  }
                  $Campos_Erros['datafabricacao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datafabricacao']) || !is_array($this->NM_ajax_info['errList']['datafabricacao']))
                  {
                      $this->NM_ajax_info['errList']['datafabricacao'] = array();
                  }
                  $this->NM_ajax_info['errList']['datafabricacao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datafabricacao']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datafabricacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datafabricacao

    function ValidateField_temperaturarecebimento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['temperaturarecebimento'])) {
          if (!empty($this->field_config['temperaturarecebimento']['symbol_dec'])) {
              nm_limpa_valor($this->temperaturarecebimento, $this->field_config['temperaturarecebimento']['symbol_dec'], $this->field_config['temperaturarecebimento']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->temperaturarecebimento === "" || is_null($this->temperaturarecebimento))  
      { 
          $this->temperaturarecebimento = 0;
          $this->sc_force_zero[] = 'temperaturarecebimento';
      } 
      }
      if (!empty($this->field_config['temperaturarecebimento']['symbol_dec']))
      {
          nm_limpa_valor($this->temperaturarecebimento, $this->field_config['temperaturarecebimento']['symbol_dec'], $this->field_config['temperaturarecebimento']['symbol_grp']) ; 
          if ('.' == substr($this->temperaturarecebimento, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->temperaturarecebimento, 1)))
              {
                  $this->temperaturarecebimento = '';
              }
              else
              {
                  $this->temperaturarecebimento = '0' . $this->temperaturarecebimento;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->temperaturarecebimento != '')  
          { 
              $iTestSize = 21;
              if ('-' == substr($this->temperaturarecebimento, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->temperaturarecebimento, -1))
              {
                  $iTestSize++;
                  $this->temperaturarecebimento = '-' . substr($this->temperaturarecebimento, 0, -1);
              }
              if (strlen($this->temperaturarecebimento) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Temperatura recebimento: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['temperaturarecebimento']))
                  {
                      $Campos_Erros['temperaturarecebimento'] = array();
                  }
                  $Campos_Erros['temperaturarecebimento'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['temperaturarecebimento']) || !is_array($this->NM_ajax_info['errList']['temperaturarecebimento']))
                  {
                      $this->NM_ajax_info['errList']['temperaturarecebimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['temperaturarecebimento'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->temperaturarecebimento, 18, 2, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Temperatura recebimento; " ; 
                  if (!isset($Campos_Erros['temperaturarecebimento']))
                  {
                      $Campos_Erros['temperaturarecebimento'] = array();
                  }
                  $Campos_Erros['temperaturarecebimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['temperaturarecebimento']) || !is_array($this->NM_ajax_info['errList']['temperaturarecebimento']))
                  {
                      $this->NM_ajax_info['errList']['temperaturarecebimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['temperaturarecebimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'temperaturarecebimento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_temperaturarecebimento

    function ValidateField_temperaturatransporte(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['temperaturatransporte'])) {
          if (!empty($this->field_config['temperaturatransporte']['symbol_dec'])) {
              nm_limpa_valor($this->temperaturatransporte, $this->field_config['temperaturatransporte']['symbol_dec'], $this->field_config['temperaturatransporte']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->temperaturatransporte === "" || is_null($this->temperaturatransporte))  
      { 
          $this->temperaturatransporte = 0;
          $this->sc_force_zero[] = 'temperaturatransporte';
      } 
      }
      if (!empty($this->field_config['temperaturatransporte']['symbol_dec']))
      {
          nm_limpa_valor($this->temperaturatransporte, $this->field_config['temperaturatransporte']['symbol_dec'], $this->field_config['temperaturatransporte']['symbol_grp']) ; 
          if ('.' == substr($this->temperaturatransporte, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->temperaturatransporte, 1)))
              {
                  $this->temperaturatransporte = '';
              }
              else
              {
                  $this->temperaturatransporte = '0' . $this->temperaturatransporte;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->temperaturatransporte != '')  
          { 
              $iTestSize = 21;
              if ('-' == substr($this->temperaturatransporte, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->temperaturatransporte, -1))
              {
                  $iTestSize++;
                  $this->temperaturatransporte = '-' . substr($this->temperaturatransporte, 0, -1);
              }
              if (strlen($this->temperaturatransporte) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Temperatura transporte: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['temperaturatransporte']))
                  {
                      $Campos_Erros['temperaturatransporte'] = array();
                  }
                  $Campos_Erros['temperaturatransporte'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['temperaturatransporte']) || !is_array($this->NM_ajax_info['errList']['temperaturatransporte']))
                  {
                      $this->NM_ajax_info['errList']['temperaturatransporte'] = array();
                  }
                  $this->NM_ajax_info['errList']['temperaturatransporte'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->temperaturatransporte, 18, 2, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Temperatura transporte; " ; 
                  if (!isset($Campos_Erros['temperaturatransporte']))
                  {
                      $Campos_Erros['temperaturatransporte'] = array();
                  }
                  $Campos_Erros['temperaturatransporte'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['temperaturatransporte']) || !is_array($this->NM_ajax_info['errList']['temperaturatransporte']))
                  {
                      $this->NM_ajax_info['errList']['temperaturatransporte'] = array();
                  }
                  $this->NM_ajax_info['errList']['temperaturatransporte'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'temperaturatransporte';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_temperaturatransporte

    function ValidateField_temperaturapadrao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['temperaturapadrao'])) {
          if (!empty($this->field_config['temperaturapadrao']['symbol_dec'])) {
              nm_limpa_valor($this->temperaturapadrao, $this->field_config['temperaturapadrao']['symbol_dec'], $this->field_config['temperaturapadrao']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->temperaturapadrao === "" || is_null($this->temperaturapadrao))  
      { 
          $this->temperaturapadrao = 0;
          $this->sc_force_zero[] = 'temperaturapadrao';
      } 
      }
      if (!empty($this->field_config['temperaturapadrao']['symbol_dec']))
      {
          nm_limpa_valor($this->temperaturapadrao, $this->field_config['temperaturapadrao']['symbol_dec'], $this->field_config['temperaturapadrao']['symbol_grp']) ; 
          if ('.' == substr($this->temperaturapadrao, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->temperaturapadrao, 1)))
              {
                  $this->temperaturapadrao = '';
              }
              else
              {
                  $this->temperaturapadrao = '0' . $this->temperaturapadrao;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->temperaturapadrao != '')  
          { 
              $iTestSize = 21;
              if ('-' == substr($this->temperaturapadrao, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->temperaturapadrao, -1))
              {
                  $iTestSize++;
                  $this->temperaturapadrao = '-' . substr($this->temperaturapadrao, 0, -1);
              }
              if (strlen($this->temperaturapadrao) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Temperatura padrão: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['temperaturapadrao']))
                  {
                      $Campos_Erros['temperaturapadrao'] = array();
                  }
                  $Campos_Erros['temperaturapadrao'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['temperaturapadrao']) || !is_array($this->NM_ajax_info['errList']['temperaturapadrao']))
                  {
                      $this->NM_ajax_info['errList']['temperaturapadrao'] = array();
                  }
                  $this->NM_ajax_info['errList']['temperaturapadrao'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->temperaturapadrao, 18, 2, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Temperatura padrão; " ; 
                  if (!isset($Campos_Erros['temperaturapadrao']))
                  {
                      $Campos_Erros['temperaturapadrao'] = array();
                  }
                  $Campos_Erros['temperaturapadrao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['temperaturapadrao']) || !is_array($this->NM_ajax_info['errList']['temperaturapadrao']))
                  {
                      $this->NM_ajax_info['errList']['temperaturapadrao'] = array();
                  }
                  $this->NM_ajax_info['errList']['temperaturapadrao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'temperaturapadrao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_temperaturapadrao

    function ValidateField_idtenacidade(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idtenacidade'])) {
          nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
          return;
      }
      if ($this->idtenacidade === "" || is_null($this->idtenacidade))  
      { 
          $this->idtenacidade = 0;
          $this->sc_force_zero[] = 'idtenacidade';
      } 
      nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idtenacidade' == $this->NM_ajax_opcao)
      { 
          if ($this->idtenacidade != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idtenacidade) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tenacidade: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idtenacidade']))
                  {
                      $Campos_Erros['idtenacidade'] = array();
                  }
                  $Campos_Erros['idtenacidade'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idtenacidade']) || !is_array($this->NM_ajax_info['errList']['idtenacidade']))
                  {
                      $this->NM_ajax_info['errList']['idtenacidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['idtenacidade'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idtenacidade, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Tenacidade; " ; 
                  if (!isset($Campos_Erros['idtenacidade']))
                  {
                      $Campos_Erros['idtenacidade'] = array();
                  }
                  $Campos_Erros['idtenacidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idtenacidade']) || !is_array($this->NM_ajax_info['errList']['idtenacidade']))
                  {
                      $this->NM_ajax_info['errList']['idtenacidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['idtenacidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
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

    function ValidateField_idempresa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idempresa'])) {
       return;
   }
               if (!empty($this->idempresa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']) && !in_array($this->idempresa, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idempresa']))
                   {
                       $Campos_Erros['idempresa'] = array();
                   }
                   $Campos_Erros['idempresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idempresa']) || !is_array($this->NM_ajax_info['errList']['idempresa']))
                   {
                       $this->NM_ajax_info['errList']['idempresa'] = array();
                   }
                   $this->NM_ajax_info['errList']['idempresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idempresa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idempresa

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
          $this->sc_force_zero[] = 'idalmoxarifadoentrada';
      } 
      nm_limpa_numero($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->idalmoxarifadoentrada != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idalmoxarifadoentrada) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Almoxarifado Entrada: " . $this->Ini->Nm_lang['lang_errm_size']; 
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
                  $Campos_Crit .= "Id Almoxarifado Entrada; " ; 
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

    function ValidateField_idusuarioauditoria(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idusuarioauditoria'])) {
          nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
          return;
      }
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idusuarioauditoria' == $this->NM_ajax_opcao)
      { 
          if ($this->idusuarioauditoria != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idusuarioauditoria) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Usuário: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idusuarioauditoria']))
                  {
                      $Campos_Erros['idusuarioauditoria'] = array();
                  }
                  $Campos_Erros['idusuarioauditoria'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idusuarioauditoria']) || !is_array($this->NM_ajax_info['errList']['idusuarioauditoria']))
                  {
                      $this->NM_ajax_info['errList']['idusuarioauditoria'] = array();
                  }
                  $this->NM_ajax_info['errList']['idusuarioauditoria'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idusuarioauditoria, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Usuário; " ; 
                  if (!isset($Campos_Erros['idusuarioauditoria']))
                  {
                      $Campos_Erros['idusuarioauditoria'] = array();
                  }
                  $Campos_Erros['idusuarioauditoria'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idusuarioauditoria']) || !is_array($this->NM_ajax_info['errList']['idusuarioauditoria']))
                  {
                      $this->NM_ajax_info['errList']['idusuarioauditoria'] = array();
                  }
                  $this->NM_ajax_info['errList']['idusuarioauditoria'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
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
              $Campos_Crit .= "Endereco IP " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
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
              $Campos_Crit .= "Aplicação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
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
    $this->nmgp_dados_form['idalmoxarifadoproduto'] = $this->idalmoxarifadoproduto;
    $this->nmgp_dados_form['quantidade'] = $this->quantidade;
    $this->nmgp_dados_form['idalmoxarifadoprodutovolume'] = $this->idalmoxarifadoprodutovolume;
    $this->nmgp_dados_form['valorunitario'] = $this->valorunitario;
    $this->nmgp_dados_form['valortotal'] = $this->valortotal;
    $this->nmgp_dados_form['lote'] = $this->lote;
    $this->nmgp_dados_form['idalmoxarifadoentradaproduto'] = $this->idalmoxarifadoentradaproduto;
    $this->nmgp_dados_form['estoqueminimo'] = $this->estoqueminimo;
    $this->nmgp_dados_form['estoquemaximo'] = $this->estoquemaximo;
    $this->nmgp_dados_form['valorpontopedido'] = $this->valorpontopedido;
    $this->nmgp_dados_form['tipopontopedido'] = $this->tipopontopedido;
    $this->nmgp_dados_form['idalmoxarifadoprodutolocalarmazenamento'] = $this->idalmoxarifadoprodutolocalarmazenamento;
    $this->nmgp_dados_form['tipovalidade'] = $this->tipovalidade;
    $this->nmgp_dados_form['datavalidade'] = (strlen(trim($this->datavalidade)) > 19) ? str_replace(".", ":", $this->datavalidade) : trim($this->datavalidade);
    $this->nmgp_dados_form['datafabricacao'] = (strlen(trim($this->datafabricacao)) > 19) ? str_replace(".", ":", $this->datafabricacao) : trim($this->datafabricacao);
    $this->nmgp_dados_form['temperaturarecebimento'] = $this->temperaturarecebimento;
    $this->nmgp_dados_form['temperaturatransporte'] = $this->temperaturatransporte;
    $this->nmgp_dados_form['temperaturapadrao'] = $this->temperaturapadrao;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idempresa'] = $this->idempresa;
    $this->nmgp_dados_form['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $this->nmgp_dados_form['codigo'] = $this->codigo;
    $this->nmgp_dados_form['nome'] = $this->nome;
    $this->nmgp_dados_form['volume'] = $this->volume;
    $this->nmgp_dados_form['codigobarras'] = $this->codigobarras;
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['quantidade'] = $this->quantidade;
      if (!empty($this->field_config['quantidade']['symbol_dec']))
      {
         nm_limpa_valor($this->quantidade, $this->field_config['quantidade']['symbol_dec'], $this->field_config['quantidade']['symbol_grp']);
      }
      $this->Before_unformat['valorunitario'] = $this->valorunitario;
      if (!empty($this->field_config['valorunitario']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp'], $this->field_config['valorunitario']['symbol_mon']);
         nm_limpa_valor($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp']);
      }
      $this->Before_unformat['valortotal'] = $this->valortotal;
      if (!empty($this->field_config['valortotal']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp'], $this->field_config['valortotal']['symbol_mon']);
         nm_limpa_valor($this->valortotal, $this->field_config['valortotal']['symbol_dec'], $this->field_config['valortotal']['symbol_grp']);
      }
      $this->Before_unformat['idalmoxarifadoentradaproduto'] = $this->idalmoxarifadoentradaproduto;
      nm_limpa_numero($this->idalmoxarifadoentradaproduto, $this->field_config['idalmoxarifadoentradaproduto']['symbol_grp']) ; 
      $this->Before_unformat['estoqueminimo'] = $this->estoqueminimo;
      if (!empty($this->field_config['estoqueminimo']['symbol_dec']))
      {
         nm_limpa_valor($this->estoqueminimo, $this->field_config['estoqueminimo']['symbol_dec'], $this->field_config['estoqueminimo']['symbol_grp']);
      }
      $this->Before_unformat['estoquemaximo'] = $this->estoquemaximo;
      if (!empty($this->field_config['estoquemaximo']['symbol_dec']))
      {
         nm_limpa_valor($this->estoquemaximo, $this->field_config['estoquemaximo']['symbol_dec'], $this->field_config['estoquemaximo']['symbol_grp']);
      }
      $this->Before_unformat['valorpontopedido'] = $this->valorpontopedido;
      if (!empty($this->field_config['valorpontopedido']['symbol_dec']))
      {
         nm_limpa_valor($this->valorpontopedido, $this->field_config['valorpontopedido']['symbol_dec'], $this->field_config['valorpontopedido']['symbol_grp']);
      }
      $this->Before_unformat['datavalidade'] = $this->datavalidade;
      nm_limpa_data($this->datavalidade, $this->field_config['datavalidade']['date_sep']) ; 
      $this->Before_unformat['datafabricacao'] = $this->datafabricacao;
      nm_limpa_data($this->datafabricacao, $this->field_config['datafabricacao']['date_sep']) ; 
      $this->Before_unformat['temperaturarecebimento'] = $this->temperaturarecebimento;
      if (!empty($this->field_config['temperaturarecebimento']['symbol_dec']))
      {
         nm_limpa_valor($this->temperaturarecebimento, $this->field_config['temperaturarecebimento']['symbol_dec'], $this->field_config['temperaturarecebimento']['symbol_grp']);
      }
      $this->Before_unformat['temperaturatransporte'] = $this->temperaturatransporte;
      if (!empty($this->field_config['temperaturatransporte']['symbol_dec']))
      {
         nm_limpa_valor($this->temperaturatransporte, $this->field_config['temperaturatransporte']['symbol_dec'], $this->field_config['temperaturatransporte']['symbol_grp']);
      }
      $this->Before_unformat['temperaturapadrao'] = $this->temperaturapadrao;
      if (!empty($this->field_config['temperaturapadrao']['symbol_dec']))
      {
         nm_limpa_valor($this->temperaturapadrao, $this->field_config['temperaturapadrao']['symbol_dec'], $this->field_config['temperaturapadrao']['symbol_grp']);
      }
      $this->Before_unformat['idtenacidade'] = $this->idtenacidade;
      nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
      $this->Before_unformat['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
      nm_limpa_numero($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp']) ; 
      $this->Before_unformat['idusuarioauditoria'] = $this->idusuarioauditoria;
      nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
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
      if ($Nome_Campo == "quantidade")
      {
          if (!empty($this->field_config['quantidade']['symbol_dec']))
          {
             nm_limpa_valor($this->quantidade, $this->field_config['quantidade']['symbol_dec'], $this->field_config['quantidade']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorunitario")
      {
          if (!empty($this->field_config['valorunitario']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp'], $this->field_config['valorunitario']['symbol_mon']);
             nm_limpa_valor($this->valorunitario, $this->field_config['valorunitario']['symbol_dec'], $this->field_config['valorunitario']['symbol_grp']);
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
      if ($Nome_Campo == "idalmoxarifadoentradaproduto")
      {
          nm_limpa_numero($this->idalmoxarifadoentradaproduto, $this->field_config['idalmoxarifadoentradaproduto']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "estoqueminimo")
      {
          if (!empty($this->field_config['estoqueminimo']['symbol_dec']))
          {
             nm_limpa_valor($this->estoqueminimo, $this->field_config['estoqueminimo']['symbol_dec'], $this->field_config['estoqueminimo']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "estoquemaximo")
      {
          if (!empty($this->field_config['estoquemaximo']['symbol_dec']))
          {
             nm_limpa_valor($this->estoquemaximo, $this->field_config['estoquemaximo']['symbol_dec'], $this->field_config['estoquemaximo']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorpontopedido")
      {
          if (!empty($this->field_config['valorpontopedido']['symbol_dec']))
          {
             nm_limpa_valor($this->valorpontopedido, $this->field_config['valorpontopedido']['symbol_dec'], $this->field_config['valorpontopedido']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "temperaturarecebimento")
      {
          if (!empty($this->field_config['temperaturarecebimento']['symbol_dec']))
          {
             nm_limpa_valor($this->temperaturarecebimento, $this->field_config['temperaturarecebimento']['symbol_dec'], $this->field_config['temperaturarecebimento']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "temperaturatransporte")
      {
          if (!empty($this->field_config['temperaturatransporte']['symbol_dec']))
          {
             nm_limpa_valor($this->temperaturatransporte, $this->field_config['temperaturatransporte']['symbol_dec'], $this->field_config['temperaturatransporte']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "temperaturapadrao")
      {
          if (!empty($this->field_config['temperaturapadrao']['symbol_dec']))
          {
             nm_limpa_valor($this->temperaturapadrao, $this->field_config['temperaturapadrao']['symbol_dec'], $this->field_config['temperaturapadrao']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "idtenacidade")
      {
          nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idalmoxarifadoentrada")
      {
          nm_limpa_numero($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idusuarioauditoria")
      {
          nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
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
      if ('' !== $this->quantidade || (!empty($format_fields) && isset($format_fields['quantidade'])))
      {
          nmgp_Form_Num_Val($this->quantidade, $this->field_config['quantidade']['symbol_grp'], $this->field_config['quantidade']['symbol_dec'], "0", "S", $this->field_config['quantidade']['format_neg'], "", "", "-", $this->field_config['quantidade']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorunitario || (!empty($format_fields) && isset($format_fields['valorunitario'])))
      {
          nmgp_Form_Num_Val($this->valorunitario, $this->field_config['valorunitario']['symbol_grp'], $this->field_config['valorunitario']['symbol_dec'], "2", "S", $this->field_config['valorunitario']['format_neg'], "", "", "-", $this->field_config['valorunitario']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['valorunitario']['symbol_mon'];
          $this->sc_add_currency($this->valorunitario, $sMonSymb, $this->field_config['valorunitario']['format_pos']); 
      }
      if ('' !== $this->valortotal || (!empty($format_fields) && isset($format_fields['valortotal'])))
      {
          nmgp_Form_Num_Val($this->valortotal, $this->field_config['valortotal']['symbol_grp'], $this->field_config['valortotal']['symbol_dec'], "2", "S", $this->field_config['valortotal']['format_neg'], "", "", "-", $this->field_config['valortotal']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['valortotal']['symbol_mon'];
          $this->sc_add_currency($this->valortotal, $sMonSymb, $this->field_config['valortotal']['format_pos']); 
      }
      if ('' !== $this->idalmoxarifadoentradaproduto || (!empty($format_fields) && isset($format_fields['idalmoxarifadoentradaproduto'])))
      {
          nmgp_Form_Num_Val($this->idalmoxarifadoentradaproduto, $this->field_config['idalmoxarifadoentradaproduto']['symbol_grp'], $this->field_config['idalmoxarifadoentradaproduto']['symbol_dec'], "0", "S", $this->field_config['idalmoxarifadoentradaproduto']['format_neg'], "", "", "-", $this->field_config['idalmoxarifadoentradaproduto']['symbol_fmt']) ; 
      }
      if ('' !== $this->estoqueminimo || (!empty($format_fields) && isset($format_fields['estoqueminimo'])))
      {
          nmgp_Form_Num_Val($this->estoqueminimo, $this->field_config['estoqueminimo']['symbol_grp'], $this->field_config['estoqueminimo']['symbol_dec'], "0", "S", $this->field_config['estoqueminimo']['format_neg'], "", "", "-", $this->field_config['estoqueminimo']['symbol_fmt']) ; 
      }
      if ('' !== $this->estoquemaximo || (!empty($format_fields) && isset($format_fields['estoquemaximo'])))
      {
          nmgp_Form_Num_Val($this->estoquemaximo, $this->field_config['estoquemaximo']['symbol_grp'], $this->field_config['estoquemaximo']['symbol_dec'], "0", "S", $this->field_config['estoquemaximo']['format_neg'], "", "", "-", $this->field_config['estoquemaximo']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorpontopedido || (!empty($format_fields) && isset($format_fields['valorpontopedido'])))
      {
          nmgp_Form_Num_Val($this->valorpontopedido, $this->field_config['valorpontopedido']['symbol_grp'], $this->field_config['valorpontopedido']['symbol_dec'], "2", "S", $this->field_config['valorpontopedido']['format_neg'], "", "", "-", $this->field_config['valorpontopedido']['symbol_fmt']) ; 
      }
      if ((!empty($this->datavalidade) && 'null' != $this->datavalidade) || (!empty($format_fields) && isset($format_fields['datavalidade'])))
      {
          nm_volta_data($this->datavalidade, $this->field_config['datavalidade']['date_format']) ; 
          nmgp_Form_Datas($this->datavalidade, $this->field_config['datavalidade']['date_format'], $this->field_config['datavalidade']['date_sep']) ;  
      }
      elseif ('null' == $this->datavalidade || '' == $this->datavalidade)
      {
          $this->datavalidade = '';
      }
      if ((!empty($this->datafabricacao) && 'null' != $this->datafabricacao) || (!empty($format_fields) && isset($format_fields['datafabricacao'])))
      {
          nm_volta_data($this->datafabricacao, $this->field_config['datafabricacao']['date_format']) ; 
          nmgp_Form_Datas($this->datafabricacao, $this->field_config['datafabricacao']['date_format'], $this->field_config['datafabricacao']['date_sep']) ;  
      }
      elseif ('null' == $this->datafabricacao || '' == $this->datafabricacao)
      {
          $this->datafabricacao = '';
      }
      if ('' !== $this->temperaturarecebimento || (!empty($format_fields) && isset($format_fields['temperaturarecebimento'])))
      {
          nmgp_Form_Num_Val($this->temperaturarecebimento, $this->field_config['temperaturarecebimento']['symbol_grp'], $this->field_config['temperaturarecebimento']['symbol_dec'], "2", "S", $this->field_config['temperaturarecebimento']['format_neg'], "", "", "-", $this->field_config['temperaturarecebimento']['symbol_fmt']) ; 
      }
      if ('' !== $this->temperaturatransporte || (!empty($format_fields) && isset($format_fields['temperaturatransporte'])))
      {
          nmgp_Form_Num_Val($this->temperaturatransporte, $this->field_config['temperaturatransporte']['symbol_grp'], $this->field_config['temperaturatransporte']['symbol_dec'], "2", "S", $this->field_config['temperaturatransporte']['format_neg'], "", "", "-", $this->field_config['temperaturatransporte']['symbol_fmt']) ; 
      }
      if ('' !== $this->temperaturapadrao || (!empty($format_fields) && isset($format_fields['temperaturapadrao'])))
      {
          nmgp_Form_Num_Val($this->temperaturapadrao, $this->field_config['temperaturapadrao']['symbol_grp'], $this->field_config['temperaturapadrao']['symbol_dec'], "2", "S", $this->field_config['temperaturapadrao']['format_neg'], "", "", "-", $this->field_config['temperaturapadrao']['symbol_fmt']) ; 
      }
      if ('' !== $this->idtenacidade || (!empty($format_fields) && isset($format_fields['idtenacidade'])))
      {
          nmgp_Form_Num_Val($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp'], $this->field_config['idtenacidade']['symbol_dec'], "0", "S", $this->field_config['idtenacidade']['format_neg'], "", "", "-", $this->field_config['idtenacidade']['symbol_fmt']) ; 
      }
      if ('' !== $this->idalmoxarifadoentrada || (!empty($format_fields) && isset($format_fields['idalmoxarifadoentrada'])))
      {
          nmgp_Form_Num_Val($this->idalmoxarifadoentrada, $this->field_config['idalmoxarifadoentrada']['symbol_grp'], $this->field_config['idalmoxarifadoentrada']['symbol_dec'], "0", "S", $this->field_config['idalmoxarifadoentrada']['format_neg'], "", "", "-", $this->field_config['idalmoxarifadoentrada']['symbol_fmt']) ; 
      }
      if ('' !== $this->idusuarioauditoria || (!empty($format_fields) && isset($format_fields['idusuarioauditoria'])))
      {
          nmgp_Form_Num_Val($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp'], $this->field_config['idusuarioauditoria']['symbol_dec'], "0", "S", $this->field_config['idusuarioauditoria']['format_neg'], "", "", "-", $this->field_config['idusuarioauditoria']['symbol_fmt']) ; 
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
      $guarda_format_hora = $this->field_config['datavalidade']['date_format'];
      if ($this->datavalidade != "")  
      { 
          nm_conv_data($this->datavalidade, $this->field_config['datavalidade']['date_format']) ; 
          $this->datavalidade_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datavalidade_hora = substr($this->datavalidade_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datavalidade_hora = substr($this->datavalidade_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datavalidade_hora = substr($this->datavalidade_hora, 0, -4);
          }
      } 
      $this->field_config['datavalidade']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['datafabricacao']['date_format'];
      if ($this->datafabricacao != "")  
      { 
          nm_conv_data($this->datafabricacao, $this->field_config['datafabricacao']['date_format']) ; 
          $this->datafabricacao_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datafabricacao_hora = substr($this->datafabricacao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datafabricacao_hora = substr($this->datafabricacao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datafabricacao_hora = substr($this->datafabricacao_hora, 0, -4);
          }
      } 
      $this->field_config['datafabricacao']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_idalmoxarifadoproduto();
          $this->ajax_return_values_quantidade();
          $this->ajax_return_values_idalmoxarifadoprodutovolume();
          $this->ajax_return_values_valorunitario();
          $this->ajax_return_values_valortotal();
          $this->ajax_return_values_lote();
          $this->ajax_return_values_idalmoxarifadoentradaproduto();
          $this->ajax_return_values_estoqueminimo();
          $this->ajax_return_values_estoquemaximo();
          $this->ajax_return_values_valorpontopedido();
          $this->ajax_return_values_tipopontopedido();
          $this->ajax_return_values_idalmoxarifadoprodutolocalarmazenamento();
          $this->ajax_return_values_tipovalidade();
          $this->ajax_return_values_datavalidade();
          $this->ajax_return_values_datafabricacao();
          $this->ajax_return_values_temperaturarecebimento();
          $this->ajax_return_values_temperaturatransporte();
          $this->ajax_return_values_temperaturapadrao();
          $this->ajax_return_values_idtenacidade();
          $this->ajax_return_values_idempresa();
          $this->ajax_return_values_idalmoxarifadoentrada();
          $this->ajax_return_values_idusuarioauditoria();
          $this->ajax_return_values_enderecoipauditoria();
          $this->ajax_return_values_nomeaplicacaoauditoria();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idalmoxarifadoentradaproduto']['keyVal'] = AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string($this->nmgp_dados_form['idalmoxarifadoentradaproduto']);
          }
   } // ajax_return_values

          //----- idalmoxarifadoproduto
   function ajax_return_values_idalmoxarifadoproduto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadoproduto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idalmoxarifadoproduto);
              $aLookup = array();
              $this->_tmp_lookup_idalmoxarifadoproduto = $this->idalmoxarifadoproduto;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'] = array(); 
}
$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT      ap.IdAlmoxarifadoProduto,     CONCAT_WS('',         'SKU (Sigla): ', ap.Sigla,         ' - Produto: ', ap.Descricao,         ' - ', fo.NomeFantasia     ) AS DescricaoCompleta FROM almoxarifadoproduto ap LEFT JOIN fornecedor fo ON (fo.IdFornecedor = ap.IdFornecedor) WHERE ap.IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'   AND ap.Ativo = 'S' ORDER BY ap.Sigla, Descricao;";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idalmoxarifadoproduto\"";
          if (isset($this->NM_ajax_info['select_html']['idalmoxarifadoproduto']) && !empty($this->NM_ajax_info['select_html']['idalmoxarifadoproduto']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idalmoxarifadoproduto']);
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

                  if ($this->idalmoxarifadoproduto == $sValue)
                  {
                      $this->_tmp_lookup_idalmoxarifadoproduto = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadoproduto", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['idalmoxarifadoproduto'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadoproduto']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idalmoxarifadoproduto']['valList'][$i] = AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idalmoxarifadoproduto']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadoproduto']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idalmoxarifadoproduto']['labList'] = $aLabel;
          }
   }

          //----- quantidade
   function ajax_return_values_quantidade($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("quantidade", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->quantidade);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['quantidade'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("quantidade", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- idalmoxarifadoprodutovolume
   function ajax_return_values_idalmoxarifadoprodutovolume($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadoprodutovolume", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idalmoxarifadoprodutovolume);
              $aLookup = array();
              $this->_tmp_lookup_idalmoxarifadoprodutovolume = $this->idalmoxarifadoprodutovolume;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'] = array(); 
}
$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'][] = '';
if ($this->idalmoxarifadoproduto != "")
{ 
   $this->nm_clear_val("idalmoxarifadoproduto");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT IdAlmoxarifadoProdutoVolume, Descricao  FROM almoxarifadoprodutovolume  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND IdAlmoxarifadoProdutoVolume = (SELECT IdAlmoxarifadoProdutoVolume FROM almoxarifadoproduto WHERE IdAlmoxarifadoProduto = '$this->idalmoxarifadoproduto') ORDER BY Descricao";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'][] = $rs->fields[0];
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
} 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"idalmoxarifadoprodutovolume\"";
          if (isset($this->NM_ajax_info['select_html']['idalmoxarifadoprodutovolume']) && !empty($this->NM_ajax_info['select_html']['idalmoxarifadoprodutovolume']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idalmoxarifadoprodutovolume']);
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

                  if ($this->idalmoxarifadoprodutovolume == $sValue)
                  {
                      $this->_tmp_lookup_idalmoxarifadoprodutovolume = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadoprodutovolume", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['idalmoxarifadoprodutovolume'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadoprodutovolume']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idalmoxarifadoprodutovolume']['valList'][$i] = AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idalmoxarifadoprodutovolume']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadoprodutovolume']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idalmoxarifadoprodutovolume']['labList'] = $aLabel;
          }
   }

          //----- valorunitario
   function ajax_return_values_valorunitario($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorunitario", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorunitario);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorunitario'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- lote
   function ajax_return_values_lote($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("lote", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->lote);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['lote'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- idalmoxarifadoentradaproduto
   function ajax_return_values_idalmoxarifadoentradaproduto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadoentradaproduto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idalmoxarifadoentradaproduto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idalmoxarifadoentradaproduto'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idalmoxarifadoentradaproduto", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- estoqueminimo
   function ajax_return_values_estoqueminimo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("estoqueminimo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->estoqueminimo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['estoqueminimo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- estoquemaximo
   function ajax_return_values_estoquemaximo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("estoquemaximo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->estoquemaximo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['estoquemaximo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- valorpontopedido
   function ajax_return_values_valorpontopedido($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorpontopedido", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorpontopedido);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorpontopedido'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tipopontopedido
   function ajax_return_values_tipopontopedido($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tipopontopedido", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tipopontopedido);
              $aLookup = array();
              $this->_tmp_lookup_tipopontopedido = $this->tipopontopedido;

$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('P') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string("Porcentagem")));
$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('Q') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string("Quantidade")));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_tipopontopedido'][] = 'P';
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_tipopontopedido'][] = 'Q';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"tipopontopedido\"";
          if (isset($this->NM_ajax_info['select_html']['tipopontopedido']) && !empty($this->NM_ajax_info['select_html']['tipopontopedido']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['tipopontopedido']);
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

                  if ($this->tipopontopedido == $sValue)
                  {
                      $this->_tmp_lookup_tipopontopedido = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tipopontopedido'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tipopontopedido']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tipopontopedido']['valList'][$i] = AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tipopontopedido']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tipopontopedido']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tipopontopedido']['labList'] = $aLabel;
          }
   }

          //----- idalmoxarifadoprodutolocalarmazenamento
   function ajax_return_values_idalmoxarifadoprodutolocalarmazenamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadoprodutolocalarmazenamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idalmoxarifadoprodutolocalarmazenamento);
              $aLookup = array();
              $this->_tmp_lookup_idalmoxarifadoprodutolocalarmazenamento = $this->idalmoxarifadoprodutolocalarmazenamento;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'] = array(); 
}
$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'][] = '';
if ($this->idalmoxarifadoentrada != "")
{ 
   $this->nm_clear_val("idalmoxarifadoentrada");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT loc.IdAlmoxarifadoProdutoLocalArmazenamento, loc.Descricao  FROM almoxarifadoprodutolocalarmazenamento loc WHERE loc.Ativo = 'S' AND loc.IdAlmoxarifado = (SELECT a.IdAlmoxarifado FROM almoxarifadoentrada a WHERE a.IdAlmoxarifadoEntrada = '$this->idalmoxarifadoentrada') ORDER BY loc.Descricao";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'][] = $rs->fields[0];
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
} 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"idalmoxarifadoprodutolocalarmazenamento\"";
          if (isset($this->NM_ajax_info['select_html']['idalmoxarifadoprodutolocalarmazenamento']) && !empty($this->NM_ajax_info['select_html']['idalmoxarifadoprodutolocalarmazenamento']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idalmoxarifadoprodutolocalarmazenamento']);
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

                  if ($this->idalmoxarifadoprodutolocalarmazenamento == $sValue)
                  {
                      $this->_tmp_lookup_idalmoxarifadoprodutolocalarmazenamento = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idalmoxarifadoprodutolocalarmazenamento'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadoprodutolocalarmazenamento']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idalmoxarifadoprodutolocalarmazenamento']['valList'][$i] = AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idalmoxarifadoprodutolocalarmazenamento']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadoprodutolocalarmazenamento']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idalmoxarifadoprodutolocalarmazenamento']['labList'] = $aLabel;
          }
   }

          //----- tipovalidade
   function ajax_return_values_tipovalidade($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tipovalidade", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tipovalidade);
              $aLookup = array();
              $this->_tmp_lookup_tipovalidade = $this->tipovalidade;

$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string("Informada")));
$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('I') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string("Indeterminada")));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_tipovalidade'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_tipovalidade'][] = 'I';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['tipovalidade']) && !empty($this->NM_ajax_info['select_html']['tipovalidade']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['tipovalidade']);
          }
          $this->NM_ajax_info['fldList']['tipovalidade'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tipovalidade']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tipovalidade']['valList'][$i] = AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tipovalidade']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tipovalidade']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tipovalidade']['labList'] = $aLabel;
          }
   }

          //----- datavalidade
   function ajax_return_values_datavalidade($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datavalidade", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datavalidade);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datavalidade'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- datafabricacao
   function ajax_return_values_datafabricacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datafabricacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datafabricacao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datafabricacao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- temperaturarecebimento
   function ajax_return_values_temperaturarecebimento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("temperaturarecebimento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->temperaturarecebimento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['temperaturarecebimento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- temperaturatransporte
   function ajax_return_values_temperaturatransporte($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("temperaturatransporte", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->temperaturatransporte);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['temperaturatransporte'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- temperaturapadrao
   function ajax_return_values_temperaturapadrao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("temperaturapadrao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->temperaturapadrao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['temperaturapadrao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idtenacidade'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idtenacidade", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- idempresa
   function ajax_return_values_idempresa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idempresa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idempresa);
              $aLookup = array();
              $this->_tmp_lookup_idempresa = $this->idempresa;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'] = array(); 
}
$aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT IdEmpresa, NomeFantasia  FROM empresa  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND IdEmpresa IN (" . $_SESSION['varListaEmpresa'] . ") ORDER BY NomeFantasia";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idempresa\"";
          if (isset($this->NM_ajax_info['select_html']['idempresa']) && !empty($this->NM_ajax_info['select_html']['idempresa']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idempresa']);
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

                  if ($this->idempresa == $sValue)
                  {
                      $this->_tmp_lookup_idempresa = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idempresa'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idempresa']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idempresa']['valList'][$i] = AlmoxarifadoEntradaProduto_Validacao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idempresa']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idempresa']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idempresa']['labList'] = $aLabel;
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
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- idusuarioauditoria
   function ajax_return_values_idusuarioauditoria($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idusuarioauditoria", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idusuarioauditoria);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idusuarioauditoria'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idusuarioauditoria", $this->form_encode_input($sTmpValue))),
              );
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varTipoAcesso)) {$this->sc_temp_varTipoAcesso = (isset($_SESSION['varTipoAcesso'])) ? $_SESSION['varTipoAcesso'] : "";}
if (!isset($this->sc_temp_varTemInformacoesEstoque)) {$this->sc_temp_varTemInformacoesEstoque = (isset($_SESSION['varTemInformacoesEstoque'])) ? $_SESSION['varTemInformacoesEstoque'] : "";}
  $this->Preparar_LstFrm_OnSrip_OnLoad_Auditoria($this->Ini->nm_cod_apl, $this->idalmoxarifadoentradaproduto );

$this->NM_ajax_info['buttonDisplay']['first'] = $this->nmgp_botoes["first"] = 'on';;
$this->NM_ajax_info['buttonDisplay']['back'] = $this->nmgp_botoes["back"] = 'on';;
$this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes["forward"] = 'on';;
$this->NM_ajax_info['buttonDisplay']['last'] = $this->nmgp_botoes["last"] = 'on';;

$this->sc_temp_varTemInformacoesEstoque = $this->verificarInformacoesEstoque();

if ($this->sc_temp_varTipoAcesso == 'Produto') {
	
	$this->nmgp_cmp_hidden["idplanoconta"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idplanoconta'] = 'off';
	
	if ($this->sc_temp_varTemInformacoesEstoque) {
			
		$this->sc_ajax_javascript('nm_field_disabled', array("estoqueminimo=disabled", ""));
;
		$this->sc_ajax_javascript('nm_field_disabled', array("estoquemaximo=disabled", ""));
;
		$this->sc_ajax_javascript('nm_field_disabled', array("valorpontopedido=disabled", ""));
;
		$this->sc_ajax_javascript('nm_field_disabled', array("tipopontopedido=disabled", ""));
;
	
	}	
	
} else {
	
	$this->nmgp_cmp_hidden["valorunitario"] = 'off'; $this->NM_ajax_info['fieldDisplay']['valorunitario'] = 'off';
	$this->nmgp_cmp_hidden["valortotal"] = 'off'; $this->NM_ajax_info['fieldDisplay']['valortotal'] = 'off';
	$this->nmgp_cmp_hidden["estoqueminimo"] = 'off'; $this->NM_ajax_info['fieldDisplay']['estoqueminimo'] = 'off';
	$this->nmgp_cmp_hidden["estoquemaximo"] = 'off'; $this->NM_ajax_info['fieldDisplay']['estoquemaximo'] = 'off';
	$this->nmgp_cmp_hidden["valorpontopedido"] = 'off'; $this->NM_ajax_info['fieldDisplay']['valorpontopedido'] = 'off';
	$this->nmgp_cmp_hidden["tipopontopedido"] = 'off'; $this->NM_ajax_info['fieldDisplay']['tipopontopedido'] = 'off';
	$this->nmgp_cmp_hidden["temperaturarecebimento"] = 'off'; $this->NM_ajax_info['fieldDisplay']['temperaturarecebimento'] = 'off';
	$this->nmgp_cmp_hidden["temperaturatransporte"] = 'off'; $this->NM_ajax_info['fieldDisplay']['temperaturatransporte'] = 'off';
	$this->nmgp_cmp_hidden["temperaturapadrao"] = 'off'; $this->NM_ajax_info['fieldDisplay']['temperaturapadrao'] = 'off';
	if ($this->sc_temp_varTemInformacoesEstoque) {

		$this->sc_ajax_javascript('nm_field_disabled', array("idempresa=disabled", ""));
;
	}
}
if (isset($this->sc_temp_varTemInformacoesEstoque)) { $_SESSION['varTemInformacoesEstoque'] = $this->sc_temp_varTemInformacoesEstoque;}
if (isset($this->sc_temp_varTipoAcesso)) { $_SESSION['varTipoAcesso'] = $this->sc_temp_varTipoAcesso;}
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onLoad ------*/
 
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
      $this->quantidade = str_replace($sc_parm1, $sc_parm2, $this->quantidade); 
      $this->valorunitario = str_replace($sc_parm1, $sc_parm2, $this->valorunitario); 
      $this->valortotal = str_replace($sc_parm1, $sc_parm2, $this->valortotal); 
      $this->estoqueminimo = str_replace($sc_parm1, $sc_parm2, $this->estoqueminimo); 
      $this->estoquemaximo = str_replace($sc_parm1, $sc_parm2, $this->estoquemaximo); 
      $this->valorpontopedido = str_replace($sc_parm1, $sc_parm2, $this->valorpontopedido); 
      $this->temperaturarecebimento = str_replace($sc_parm1, $sc_parm2, $this->temperaturarecebimento); 
      $this->temperaturatransporte = str_replace($sc_parm1, $sc_parm2, $this->temperaturatransporte); 
      $this->temperaturapadrao = str_replace($sc_parm1, $sc_parm2, $this->temperaturapadrao); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->quantidade = "'" . $this->quantidade . "'";
      $this->valorunitario = "'" . $this->valorunitario . "'";
      $this->valortotal = "'" . $this->valortotal . "'";
      $this->estoqueminimo = "'" . $this->estoqueminimo . "'";
      $this->estoquemaximo = "'" . $this->estoquemaximo . "'";
      $this->valorpontopedido = "'" . $this->valorpontopedido . "'";
      $this->temperaturarecebimento = "'" . $this->temperaturarecebimento . "'";
      $this->temperaturatransporte = "'" . $this->temperaturatransporte . "'";
      $this->temperaturapadrao = "'" . $this->temperaturapadrao . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->quantidade = str_replace("'", "", $this->quantidade); 
      $this->valorunitario = str_replace("'", "", $this->valorunitario); 
      $this->valortotal = str_replace("'", "", $this->valortotal); 
      $this->estoqueminimo = str_replace("'", "", $this->estoqueminimo); 
      $this->estoquemaximo = str_replace("'", "", $this->estoquemaximo); 
      $this->valorpontopedido = str_replace("'", "", $this->valorpontopedido); 
      $this->temperaturarecebimento = str_replace("'", "", $this->temperaturarecebimento); 
      $this->temperaturatransporte = str_replace("'", "", $this->temperaturatransporte); 
      $this->temperaturapadrao = str_replace("'", "", $this->temperaturapadrao); 
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
    if ("incluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeInsert ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdAlmoxarifadoEntrada)) {$this->sc_temp_varIdAlmoxarifadoEntrada = (isset($_SESSION['varIdAlmoxarifadoEntrada'])) ? $_SESSION['varIdAlmoxarifadoEntrada'] : "";}
  $this->idalmoxarifadoentrada  = $this->sc_temp_varIdAlmoxarifadoEntrada;
if (isset($this->sc_temp_varIdAlmoxarifadoEntrada)) { $_SESSION['varIdAlmoxarifadoEntrada'] = $this->sc_temp_varIdAlmoxarifadoEntrada;}
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeInsert ------*/
 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $this->nmgp_opcao ; 
          if ($this->nmgp_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          else
          { 
              $this->sc_evento = ""; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->NM_rollback_db(); 
          $this->Campos_Mens_erro = ""; 
      }
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
      $NM_val_form['idalmoxarifadoproduto'] = $this->idalmoxarifadoproduto;
      $NM_val_form['quantidade'] = $this->quantidade;
      $NM_val_form['idalmoxarifadoprodutovolume'] = $this->idalmoxarifadoprodutovolume;
      $NM_val_form['valorunitario'] = $this->valorunitario;
      $NM_val_form['valortotal'] = $this->valortotal;
      $NM_val_form['lote'] = $this->lote;
      $NM_val_form['idalmoxarifadoentradaproduto'] = $this->idalmoxarifadoentradaproduto;
      $NM_val_form['estoqueminimo'] = $this->estoqueminimo;
      $NM_val_form['estoquemaximo'] = $this->estoquemaximo;
      $NM_val_form['valorpontopedido'] = $this->valorpontopedido;
      $NM_val_form['tipopontopedido'] = $this->tipopontopedido;
      $NM_val_form['idalmoxarifadoprodutolocalarmazenamento'] = $this->idalmoxarifadoprodutolocalarmazenamento;
      $NM_val_form['tipovalidade'] = $this->tipovalidade;
      $NM_val_form['datavalidade'] = $this->datavalidade;
      $NM_val_form['datafabricacao'] = $this->datafabricacao;
      $NM_val_form['temperaturarecebimento'] = $this->temperaturarecebimento;
      $NM_val_form['temperaturatransporte'] = $this->temperaturatransporte;
      $NM_val_form['temperaturapadrao'] = $this->temperaturapadrao;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idempresa'] = $this->idempresa;
      $NM_val_form['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      $NM_val_form['codigo'] = $this->codigo;
      $NM_val_form['nome'] = $this->nome;
      $NM_val_form['volume'] = $this->volume;
      $NM_val_form['codigobarras'] = $this->codigobarras;
      if ($this->idalmoxarifadoentradaproduto === "" || is_null($this->idalmoxarifadoentradaproduto))  
      { 
          $this->idalmoxarifadoentradaproduto = 0;
      } 
      if ($this->idtenacidade === "" || is_null($this->idtenacidade))  
      { 
          $this->idtenacidade = 0;
          $this->sc_force_zero[] = 'idtenacidade';
      } 
      if ($this->idalmoxarifadoentrada === "" || is_null($this->idalmoxarifadoentrada))  
      { 
          $this->idalmoxarifadoentrada = 0;
          $this->sc_force_zero[] = 'idalmoxarifadoentrada';
      } 
      if ($this->idalmoxarifadoproduto === "" || is_null($this->idalmoxarifadoproduto))  
      { 
          $this->idalmoxarifadoproduto = 0;
          $this->sc_force_zero[] = 'idalmoxarifadoproduto';
      } 
      if ($this->idalmoxarifadoprodutovolume === "" || is_null($this->idalmoxarifadoprodutovolume))  
      { 
          $this->idalmoxarifadoprodutovolume = 0;
          $this->sc_force_zero[] = 'idalmoxarifadoprodutovolume';
      } 
      if ($this->idalmoxarifadoprodutolocalarmazenamento === "" || is_null($this->idalmoxarifadoprodutolocalarmazenamento))  
      { 
          $this->idalmoxarifadoprodutolocalarmazenamento = 0;
          $this->sc_force_zero[] = 'idalmoxarifadoprodutolocalarmazenamento';
      } 
      if ($this->idempresa === "" || is_null($this->idempresa))  
      { 
          $this->idempresa = 0;
          $this->sc_force_zero[] = 'idempresa';
      } 
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      if ($this->quantidade === "" || is_null($this->quantidade))  
      { 
          $this->quantidade = 0;
          $this->sc_force_zero[] = 'quantidade';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorunitario === "" || is_null($this->valorunitario))  
      { 
          $this->valorunitario = 0;
          $this->sc_force_zero[] = 'valorunitario';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valortotal === "" || is_null($this->valortotal))  
      { 
          $this->valortotal = 0;
          $this->sc_force_zero[] = 'valortotal';
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
      if ($this->estoqueminimo === "" || is_null($this->estoqueminimo))  
      { 
          $this->estoqueminimo = 0;
          $this->sc_force_zero[] = 'estoqueminimo';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->estoquemaximo === "" || is_null($this->estoquemaximo))  
      { 
          $this->estoquemaximo = 0;
          $this->sc_force_zero[] = 'estoquemaximo';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorpontopedido === "" || is_null($this->valorpontopedido))  
      { 
          $this->valorpontopedido = 0;
          $this->sc_force_zero[] = 'valorpontopedido';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->temperaturarecebimento === "" || is_null($this->temperaturarecebimento))  
      { 
          $this->temperaturarecebimento = 0;
          $this->sc_force_zero[] = 'temperaturarecebimento';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->temperaturatransporte === "" || is_null($this->temperaturatransporte))  
      { 
          $this->temperaturatransporte = 0;
          $this->sc_force_zero[] = 'temperaturatransporte';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->temperaturapadrao === "" || is_null($this->temperaturapadrao))  
      { 
          $this->temperaturapadrao = 0;
          $this->sc_force_zero[] = 'temperaturapadrao';
      } 
      }
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->codigo_before_qstr = $this->codigo;
          $this->codigo = substr($this->Db->qstr($this->codigo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->codigo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->codigo);
          }
          if ($this->codigo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->codigo = "null"; 
              $this->NM_val_null[] = "codigo";
          } 
          $this->nome_before_qstr = $this->nome;
          $this->nome = substr($this->Db->qstr($this->nome), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nome = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nome);
          }
          if ($this->nome == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nome = "null"; 
              $this->NM_val_null[] = "nome";
          } 
          $this->volume_before_qstr = $this->volume;
          $this->volume = substr($this->Db->qstr($this->volume), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->volume = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->volume);
          }
          if ($this->volume == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->volume = "null"; 
              $this->NM_val_null[] = "volume";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          $this->tipovalidade_before_qstr = $this->tipovalidade;
          $this->tipovalidade = substr($this->Db->qstr($this->tipovalidade), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tipovalidade = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->tipovalidade);
          }
          if ($this->tipovalidade == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tipovalidade = "null"; 
              $this->NM_val_null[] = "tipovalidade";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->datavalidade == "")  
              { 
                  $this->datavalidade = "null"; 
                  $this->NM_val_null[] = "datavalidade";
              } 
              if ($this->datavalidade == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->datavalidade = "null"; 
                  $this->NM_val_null[] = "datavalidade";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->datafabricacao == "")  
              { 
                  $this->datafabricacao = "null"; 
                  $this->NM_val_null[] = "datafabricacao";
              } 
              if ($this->datafabricacao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->datafabricacao = "null"; 
                  $this->NM_val_null[] = "datafabricacao";
              } 
          }
          $this->lote_before_qstr = $this->lote;
          $this->lote = substr($this->Db->qstr($this->lote), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->lote = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->lote);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->lote == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->lote = "null"; 
                  $this->NM_val_null[] = "lote";
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
          $this->tipopontopedido_before_qstr = $this->tipopontopedido;
          $this->tipopontopedido = substr($this->Db->qstr($this->tipopontopedido), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tipopontopedido = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->tipopontopedido);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->tipopontopedido == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->tipopontopedido = "null"; 
                  $this->NM_val_null[] = "tipopontopedido";
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
          $this->codigobarras_before_qstr = $this->codigobarras;
          $this->codigobarras = substr($this->Db->qstr($this->codigobarras), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->codigobarras = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->codigobarras);
          }
          if ($this->codigobarras == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->codigobarras = "null"; 
              $this->NM_val_null[] = "codigobarras";
          } 
          $this->enderecoipauditoria_before_qstr = $this->enderecoipauditoria;
          $this->enderecoipauditoria = substr($this->Db->qstr($this->enderecoipauditoria), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->enderecoipauditoria = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->enderecoipauditoria);
          }
          if ($this->enderecoipauditoria == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->enderecoipauditoria = "null"; 
              $this->NM_val_null[] = "enderecoipauditoria";
          } 
          $this->nomeaplicacaoauditoria_before_qstr = $this->nomeaplicacaoauditoria;
          $this->nomeaplicacaoauditoria = substr($this->Db->qstr($this->nomeaplicacaoauditoria), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomeaplicacaoauditoria = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomeaplicacaoauditoria);
          }
          if ($this->nomeaplicacaoauditoria == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomeaplicacaoauditoria = "null"; 
              $this->NM_val_null[] = "nomeaplicacaoauditoria";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
                  $SC_fields_update[] = "IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada, IdAlmoxarifadoProdutoLocalArmazenamento = $this->idalmoxarifadoprodutolocalarmazenamento, IdEmpresa = $this->idempresa, ValorUnitario = $this->valorunitario, ValorTotal = $this->valortotal, TipoValidade = '$this->tipovalidade', DataValidade = #$this->datavalidade#, DataFabricacao = #$this->datafabricacao#, Lote = '$this->lote', EstoqueMinimo = $this->estoqueminimo, EstoqueMaximo = $this->estoquemaximo, ValorPontoPedido = $this->valorpontopedido, TipoPontoPedido = '$this->tipopontopedido', TemperaturaRecebimento = $this->temperaturarecebimento, TemperaturaTransporte = $this->temperaturatransporte, TemperaturaPadrao = $this->temperaturapadrao"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada, IdAlmoxarifadoProdutoLocalArmazenamento = $this->idalmoxarifadoprodutolocalarmazenamento, IdEmpresa = $this->idempresa, ValorUnitario = $this->valorunitario, ValorTotal = $this->valortotal, TipoValidade = '$this->tipovalidade', DataValidade = " . $this->Ini->date_delim . $this->datavalidade . $this->Ini->date_delim1 . ", DataFabricacao = " . $this->Ini->date_delim . $this->datafabricacao . $this->Ini->date_delim1 . ", Lote = '$this->lote', EstoqueMinimo = $this->estoqueminimo, EstoqueMaximo = $this->estoquemaximo, ValorPontoPedido = $this->valorpontopedido, TipoPontoPedido = '$this->tipopontopedido', TemperaturaRecebimento = $this->temperaturarecebimento, TemperaturaTransporte = $this->temperaturatransporte, TemperaturaPadrao = $this->temperaturapadrao"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada, IdAlmoxarifadoProdutoLocalArmazenamento = $this->idalmoxarifadoprodutolocalarmazenamento, IdEmpresa = $this->idempresa, ValorUnitario = $this->valorunitario, ValorTotal = $this->valortotal, TipoValidade = '$this->tipovalidade', DataValidade = " . $this->Ini->date_delim . $this->datavalidade . $this->Ini->date_delim1 . ", DataFabricacao = " . $this->Ini->date_delim . $this->datafabricacao . $this->Ini->date_delim1 . ", Lote = '$this->lote', EstoqueMinimo = $this->estoqueminimo, EstoqueMaximo = $this->estoquemaximo, ValorPontoPedido = $this->valorpontopedido, TipoPontoPedido = '$this->tipopontopedido', TemperaturaRecebimento = $this->temperaturarecebimento, TemperaturaTransporte = $this->temperaturatransporte, TemperaturaPadrao = $this->temperaturapadrao"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdAlmoxarifadoEntrada = $this->idalmoxarifadoentrada, IdAlmoxarifadoProdutoLocalArmazenamento = $this->idalmoxarifadoprodutolocalarmazenamento, IdEmpresa = $this->idempresa, ValorUnitario = $this->valorunitario, ValorTotal = $this->valortotal, TipoValidade = '$this->tipovalidade', DataValidade = " . $this->Ini->date_delim . $this->datavalidade . $this->Ini->date_delim1 . ", DataFabricacao = " . $this->Ini->date_delim . $this->datafabricacao . $this->Ini->date_delim1 . ", Lote = '$this->lote', EstoqueMinimo = $this->estoqueminimo, EstoqueMaximo = $this->estoquemaximo, ValorPontoPedido = $this->valorpontopedido, TipoPontoPedido = '$this->tipopontopedido', TemperaturaRecebimento = $this->temperaturarecebimento, TemperaturaTransporte = $this->temperaturatransporte, TemperaturaPadrao = $this->temperaturapadrao"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] == "null"  && $this->nmgp_dados_select['idtenacidade'] == "") ? "null" : $this->nmgp_dados_select['idtenacidade'];
              if (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTenacidade = $this->idtenacidade"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idalmoxarifadoproduto']) && $NM_val_form['idalmoxarifadoproduto'] == "null"  && $this->nmgp_dados_select['idalmoxarifadoproduto'] == "") ? "null" : $this->nmgp_dados_select['idalmoxarifadoproduto'];
              if (isset($NM_val_form['idalmoxarifadoproduto']) && $NM_val_form['idalmoxarifadoproduto'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdAlmoxarifadoProduto = $this->idalmoxarifadoproduto"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idalmoxarifadoprodutovolume']) && $NM_val_form['idalmoxarifadoprodutovolume'] == "null"  && $this->nmgp_dados_select['idalmoxarifadoprodutovolume'] == "") ? "null" : $this->nmgp_dados_select['idalmoxarifadoprodutovolume'];
              if (isset($NM_val_form['idalmoxarifadoprodutovolume']) && $NM_val_form['idalmoxarifadoprodutovolume'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdAlmoxarifadoProdutoVolume = $this->idalmoxarifadoprodutovolume"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] == "null"  && $this->nmgp_dados_select['idusuarioauditoria'] == "") ? "null" : $this->nmgp_dados_select['idusuarioauditoria'];
              if (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioAuditoria = $this->idusuarioauditoria"; 
              } 
              $Prep_Tst = (isset($NM_val_form['codigo']) && $NM_val_form['codigo'] == "null"  && $this->nmgp_dados_select['codigo'] == "") ? "null" : $this->nmgp_dados_select['codigo'];
              if (isset($NM_val_form['codigo']) && $NM_val_form['codigo'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Codigo = '$this->codigo'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nome']) && $NM_val_form['nome'] == "null"  && $this->nmgp_dados_select['nome'] == "") ? "null" : $this->nmgp_dados_select['nome'];
              if (isset($NM_val_form['nome']) && $NM_val_form['nome'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Nome = '$this->nome'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['volume']) && $NM_val_form['volume'] == "null"  && $this->nmgp_dados_select['volume'] == "") ? "null" : $this->nmgp_dados_select['volume'];
              if (isset($NM_val_form['volume']) && $NM_val_form['volume'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Volume = '$this->volume'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['quantidade']) && $NM_val_form['quantidade'] == "null"  && $this->nmgp_dados_select['quantidade'] == "") ? "null" : $this->nmgp_dados_select['quantidade'];
              if (isset($NM_val_form['quantidade']) && $NM_val_form['quantidade'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Quantidade = $this->quantidade"; 
              } 
              $Prep_Tst = (isset($NM_val_form['codigobarras']) && $NM_val_form['codigobarras'] == "null"  && $this->nmgp_dados_select['codigobarras'] == "") ? "null" : $this->nmgp_dados_select['codigobarras'];
              if (isset($NM_val_form['codigobarras']) && $NM_val_form['codigobarras'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "CodigoBarras = '$this->codigobarras'"; 
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
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto ";  
              }  
              else  
              {
                  $comando .= " WHERE IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto ";  
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
                                  AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->codigo = $this->codigo_before_qstr;
              $this->nome = $this->nome_before_qstr;
              $this->volume = $this->volume_before_qstr;
              $this->tipovalidade = $this->tipovalidade_before_qstr;
              $this->lote = $this->lote_before_qstr;
              $this->tipopontopedido = $this->tipopontopedido_before_qstr;
              $this->codigobarras = $this->codigobarras_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idalmoxarifadoentradaproduto'])) { $this->idalmoxarifadoentradaproduto = $NM_val_form['idalmoxarifadoentradaproduto']; }
              elseif (isset($this->idalmoxarifadoentradaproduto)) { $this->nm_limpa_alfa($this->idalmoxarifadoentradaproduto); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtenacidade'])) { $this->idtenacidade = $NM_val_form['idtenacidade']; }
              elseif (isset($this->idtenacidade)) { $this->nm_limpa_alfa($this->idtenacidade); }
              if     (isset($NM_val_form) && isset($NM_val_form['idalmoxarifadoentrada'])) { $this->idalmoxarifadoentrada = $NM_val_form['idalmoxarifadoentrada']; }
              elseif (isset($this->idalmoxarifadoentrada)) { $this->nm_limpa_alfa($this->idalmoxarifadoentrada); }
              if     (isset($NM_val_form) && isset($NM_val_form['idalmoxarifadoproduto'])) { $this->idalmoxarifadoproduto = $NM_val_form['idalmoxarifadoproduto']; }
              elseif (isset($this->idalmoxarifadoproduto)) { $this->nm_limpa_alfa($this->idalmoxarifadoproduto); }
              if     (isset($NM_val_form) && isset($NM_val_form['idalmoxarifadoprodutovolume'])) { $this->idalmoxarifadoprodutovolume = $NM_val_form['idalmoxarifadoprodutovolume']; }
              elseif (isset($this->idalmoxarifadoprodutovolume)) { $this->nm_limpa_alfa($this->idalmoxarifadoprodutovolume); }
              if     (isset($NM_val_form) && isset($NM_val_form['idalmoxarifadoprodutolocalarmazenamento'])) { $this->idalmoxarifadoprodutolocalarmazenamento = $NM_val_form['idalmoxarifadoprodutolocalarmazenamento']; }
              elseif (isset($this->idalmoxarifadoprodutolocalarmazenamento)) { $this->nm_limpa_alfa($this->idalmoxarifadoprodutolocalarmazenamento); }
              if     (isset($NM_val_form) && isset($NM_val_form['idempresa'])) { $this->idempresa = $NM_val_form['idempresa']; }
              elseif (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuarioauditoria'])) { $this->idusuarioauditoria = $NM_val_form['idusuarioauditoria']; }
              elseif (isset($this->idusuarioauditoria)) { $this->nm_limpa_alfa($this->idusuarioauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['quantidade'])) { $this->quantidade = $NM_val_form['quantidade']; }
              elseif (isset($this->quantidade)) { $this->nm_limpa_alfa($this->quantidade); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorunitario'])) { $this->valorunitario = $NM_val_form['valorunitario']; }
              elseif (isset($this->valorunitario)) { $this->nm_limpa_alfa($this->valorunitario); }
              if     (isset($NM_val_form) && isset($NM_val_form['valortotal'])) { $this->valortotal = $NM_val_form['valortotal']; }
              elseif (isset($this->valortotal)) { $this->nm_limpa_alfa($this->valortotal); }
              if     (isset($NM_val_form) && isset($NM_val_form['tipovalidade'])) { $this->tipovalidade = $NM_val_form['tipovalidade']; }
              elseif (isset($this->tipovalidade)) { $this->nm_limpa_alfa($this->tipovalidade); }
              if     (isset($NM_val_form) && isset($NM_val_form['lote'])) { $this->lote = $NM_val_form['lote']; }
              elseif (isset($this->lote)) { $this->nm_limpa_alfa($this->lote); }
              if     (isset($NM_val_form) && isset($NM_val_form['estoqueminimo'])) { $this->estoqueminimo = $NM_val_form['estoqueminimo']; }
              elseif (isset($this->estoqueminimo)) { $this->nm_limpa_alfa($this->estoqueminimo); }
              if     (isset($NM_val_form) && isset($NM_val_form['estoquemaximo'])) { $this->estoquemaximo = $NM_val_form['estoquemaximo']; }
              elseif (isset($this->estoquemaximo)) { $this->nm_limpa_alfa($this->estoquemaximo); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorpontopedido'])) { $this->valorpontopedido = $NM_val_form['valorpontopedido']; }
              elseif (isset($this->valorpontopedido)) { $this->nm_limpa_alfa($this->valorpontopedido); }
              if     (isset($NM_val_form) && isset($NM_val_form['tipopontopedido'])) { $this->tipopontopedido = $NM_val_form['tipopontopedido']; }
              elseif (isset($this->tipopontopedido)) { $this->nm_limpa_alfa($this->tipopontopedido); }
              if     (isset($NM_val_form) && isset($NM_val_form['temperaturarecebimento'])) { $this->temperaturarecebimento = $NM_val_form['temperaturarecebimento']; }
              elseif (isset($this->temperaturarecebimento)) { $this->nm_limpa_alfa($this->temperaturarecebimento); }
              if     (isset($NM_val_form) && isset($NM_val_form['temperaturatransporte'])) { $this->temperaturatransporte = $NM_val_form['temperaturatransporte']; }
              elseif (isset($this->temperaturatransporte)) { $this->nm_limpa_alfa($this->temperaturatransporte); }
              if     (isset($NM_val_form) && isset($NM_val_form['temperaturapadrao'])) { $this->temperaturapadrao = $NM_val_form['temperaturapadrao']; }
              elseif (isset($this->temperaturapadrao)) { $this->nm_limpa_alfa($this->temperaturapadrao); }
              if     (isset($NM_val_form) && isset($NM_val_form['enderecoipauditoria'])) { $this->enderecoipauditoria = $NM_val_form['enderecoipauditoria']; }
              elseif (isset($this->enderecoipauditoria)) { $this->nm_limpa_alfa($this->enderecoipauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomeaplicacaoauditoria'])) { $this->nomeaplicacaoauditoria = $NM_val_form['nomeaplicacaoauditoria']; }
              elseif (isset($this->nomeaplicacaoauditoria)) { $this->nm_limpa_alfa($this->nomeaplicacaoauditoria); }

              $this->nm_formatar_campos();

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('idalmoxarifadoproduto', 'quantidade', 'idalmoxarifadoprodutovolume', 'valorunitario', 'valortotal', 'lote', 'idalmoxarifadoentradaproduto', 'estoqueminimo', 'estoquemaximo', 'valorpontopedido', 'tipopontopedido', 'idalmoxarifadoprodutolocalarmazenamento', 'tipovalidade', 'datavalidade', 'datafabricacao', 'temperaturarecebimento', 'temperaturatransporte', 'temperaturapadrao', 'idtenacidade', 'idempresa', 'idalmoxarifadoentrada', 'idusuarioauditoria', 'enderecoipauditoria', 'nomeaplicacaoauditoria'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "IdAlmoxarifadoEntradaProduto, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(IdAlmoxarifadoEntradaProduto) from " . $this->Ini->nm_tabela; 
          $comando = "select max(IdAlmoxarifadoEntradaProduto) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $this->idalmoxarifadoentradaproduto_before_qstr = $this->idalmoxarifadoentradaproduto = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->valorunitario != "")
                  { 
                       $compl_insert     .= ", ValorUnitario";
                       $compl_insert_val .= ", $this->valorunitario";
                  } 
                  if ($this->valortotal != "")
                  { 
                       $compl_insert     .= ", ValorTotal";
                       $compl_insert_val .= ", $this->valortotal";
                  } 
                  if ($this->datavalidade != "")
                  { 
                       $compl_insert     .= ", DataValidade";
                       $compl_insert_val .= ", #$this->datavalidade#";
                  } 
                  if ($this->datafabricacao != "")
                  { 
                       $compl_insert     .= ", DataFabricacao";
                       $compl_insert_val .= ", #$this->datafabricacao#";
                  } 
                  if ($this->lote != "")
                  { 
                       $compl_insert     .= ", Lote";
                       $compl_insert_val .= ", '$this->lote'";
                  } 
                  if ($this->estoqueminimo != "")
                  { 
                       $compl_insert     .= ", EstoqueMinimo";
                       $compl_insert_val .= ", $this->estoqueminimo";
                  } 
                  if ($this->estoquemaximo != "")
                  { 
                       $compl_insert     .= ", EstoqueMaximo";
                       $compl_insert_val .= ", $this->estoquemaximo";
                  } 
                  if ($this->valorpontopedido != "")
                  { 
                       $compl_insert     .= ", ValorPontoPedido";
                       $compl_insert_val .= ", $this->valorpontopedido";
                  } 
                  if ($this->tipopontopedido != "")
                  { 
                       $compl_insert     .= ", TipoPontoPedido";
                       $compl_insert_val .= ", '$this->tipopontopedido'";
                  } 
                  if ($this->temperaturarecebimento != "")
                  { 
                       $compl_insert     .= ", TemperaturaRecebimento";
                       $compl_insert_val .= ", $this->temperaturarecebimento";
                  } 
                  if ($this->temperaturatransporte != "")
                  { 
                       $compl_insert     .= ", TemperaturaTransporte";
                       $compl_insert_val .= ", $this->temperaturatransporte";
                  } 
                  if ($this->temperaturapadrao != "")
                  { 
                       $compl_insert     .= ", TemperaturaPadrao";
                       $compl_insert_val .= ", $this->temperaturapadrao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdTenacidade, IdAlmoxarifadoEntrada, IdAlmoxarifadoProduto, IdAlmoxarifadoProdutoVolume, IdAlmoxarifadoProdutoLocalArmazenamento, IdEmpresa, IdUsuarioAuditoria, Codigo, Nome, Volume, Quantidade, TipoValidade, CodigoBarras, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES ($this->idtenacidade, $this->idalmoxarifadoentrada, $this->idalmoxarifadoproduto, $this->idalmoxarifadoprodutovolume, $this->idalmoxarifadoprodutolocalarmazenamento, $this->idempresa, $this->idusuarioauditoria, '$this->codigo', '$this->nome', '$this->volume', $this->quantidade, '$this->tipovalidade', '$this->codigobarras', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->valorunitario != "")
                  { 
                       $compl_insert     .= ", ValorUnitario";
                       $compl_insert_val .= ", $this->valorunitario";
                  } 
                  if ($this->valortotal != "")
                  { 
                       $compl_insert     .= ", ValorTotal";
                       $compl_insert_val .= ", $this->valortotal";
                  } 
                  if ($this->datavalidade != "")
                  { 
                       $compl_insert     .= ", DataValidade";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datavalidade . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->datafabricacao != "")
                  { 
                       $compl_insert     .= ", DataFabricacao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datafabricacao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->lote != "")
                  { 
                       $compl_insert     .= ", Lote";
                       $compl_insert_val .= ", '$this->lote'";
                  } 
                  if ($this->estoqueminimo != "")
                  { 
                       $compl_insert     .= ", EstoqueMinimo";
                       $compl_insert_val .= ", $this->estoqueminimo";
                  } 
                  if ($this->estoquemaximo != "")
                  { 
                       $compl_insert     .= ", EstoqueMaximo";
                       $compl_insert_val .= ", $this->estoquemaximo";
                  } 
                  if ($this->valorpontopedido != "")
                  { 
                       $compl_insert     .= ", ValorPontoPedido";
                       $compl_insert_val .= ", $this->valorpontopedido";
                  } 
                  if ($this->tipopontopedido != "")
                  { 
                       $compl_insert     .= ", TipoPontoPedido";
                       $compl_insert_val .= ", '$this->tipopontopedido'";
                  } 
                  if ($this->temperaturarecebimento != "")
                  { 
                       $compl_insert     .= ", TemperaturaRecebimento";
                       $compl_insert_val .= ", $this->temperaturarecebimento";
                  } 
                  if ($this->temperaturatransporte != "")
                  { 
                       $compl_insert     .= ", TemperaturaTransporte";
                       $compl_insert_val .= ", $this->temperaturatransporte";
                  } 
                  if ($this->temperaturapadrao != "")
                  { 
                       $compl_insert     .= ", TemperaturaPadrao";
                       $compl_insert_val .= ", $this->temperaturapadrao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdAlmoxarifadoEntrada, IdAlmoxarifadoProduto, IdAlmoxarifadoProdutoVolume, IdAlmoxarifadoProdutoLocalArmazenamento, IdEmpresa, IdUsuarioAuditoria, Codigo, Nome, Volume, Quantidade, TipoValidade, CodigoBarras, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idalmoxarifadoentrada, $this->idalmoxarifadoproduto, $this->idalmoxarifadoprodutovolume, $this->idalmoxarifadoprodutolocalarmazenamento, $this->idempresa, $this->idusuarioauditoria, '$this->codigo', '$this->nome', '$this->volume', $this->quantidade, '$this->tipovalidade', '$this->codigobarras', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->valorunitario != "")
                  { 
                       $compl_insert     .= ", ValorUnitario";
                       $compl_insert_val .= ", $this->valorunitario";
                  } 
                  if ($this->valortotal != "")
                  { 
                       $compl_insert     .= ", ValorTotal";
                       $compl_insert_val .= ", $this->valortotal";
                  } 
                  if ($this->datavalidade != "")
                  { 
                       $compl_insert     .= ", DataValidade";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datavalidade . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->datafabricacao != "")
                  { 
                       $compl_insert     .= ", DataFabricacao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datafabricacao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->lote != "")
                  { 
                       $compl_insert     .= ", Lote";
                       $compl_insert_val .= ", '$this->lote'";
                  } 
                  if ($this->estoqueminimo != "")
                  { 
                       $compl_insert     .= ", EstoqueMinimo";
                       $compl_insert_val .= ", $this->estoqueminimo";
                  } 
                  if ($this->estoquemaximo != "")
                  { 
                       $compl_insert     .= ", EstoqueMaximo";
                       $compl_insert_val .= ", $this->estoquemaximo";
                  } 
                  if ($this->valorpontopedido != "")
                  { 
                       $compl_insert     .= ", ValorPontoPedido";
                       $compl_insert_val .= ", $this->valorpontopedido";
                  } 
                  if ($this->tipopontopedido != "")
                  { 
                       $compl_insert     .= ", TipoPontoPedido";
                       $compl_insert_val .= ", '$this->tipopontopedido'";
                  } 
                  if ($this->temperaturarecebimento != "")
                  { 
                       $compl_insert     .= ", TemperaturaRecebimento";
                       $compl_insert_val .= ", $this->temperaturarecebimento";
                  } 
                  if ($this->temperaturatransporte != "")
                  { 
                       $compl_insert     .= ", TemperaturaTransporte";
                       $compl_insert_val .= ", $this->temperaturatransporte";
                  } 
                  if ($this->temperaturapadrao != "")
                  { 
                       $compl_insert     .= ", TemperaturaPadrao";
                       $compl_insert_val .= ", $this->temperaturapadrao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdAlmoxarifadoEntrada, IdAlmoxarifadoProduto, IdAlmoxarifadoProdutoVolume, IdAlmoxarifadoProdutoLocalArmazenamento, IdEmpresa, IdUsuarioAuditoria, Codigo, Nome, Volume, Quantidade, TipoValidade, CodigoBarras, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idalmoxarifadoentrada, $this->idalmoxarifadoproduto, $this->idalmoxarifadoprodutovolume, $this->idalmoxarifadoprodutolocalarmazenamento, $this->idempresa, $this->idusuarioauditoria, '$this->codigo', '$this->nome', '$this->volume', $this->quantidade, '$this->tipovalidade', '$this->codigobarras', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->valorunitario != "")
                  { 
                       $compl_insert     .= ", ValorUnitario";
                       $compl_insert_val .= ", $this->valorunitario";
                  } 
                  if ($this->valortotal != "")
                  { 
                       $compl_insert     .= ", ValorTotal";
                       $compl_insert_val .= ", $this->valortotal";
                  } 
                  if ($this->datavalidade != "")
                  { 
                       $compl_insert     .= ", DataValidade";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datavalidade . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->datafabricacao != "")
                  { 
                       $compl_insert     .= ", DataFabricacao";
                       $compl_insert_val .= ", " . $this->Ini->date_delim . $this->datafabricacao . $this->Ini->date_delim1 . "";
                  } 
                  if ($this->lote != "")
                  { 
                       $compl_insert     .= ", Lote";
                       $compl_insert_val .= ", '$this->lote'";
                  } 
                  if ($this->estoqueminimo != "")
                  { 
                       $compl_insert     .= ", EstoqueMinimo";
                       $compl_insert_val .= ", $this->estoqueminimo";
                  } 
                  if ($this->estoquemaximo != "")
                  { 
                       $compl_insert     .= ", EstoqueMaximo";
                       $compl_insert_val .= ", $this->estoquemaximo";
                  } 
                  if ($this->valorpontopedido != "")
                  { 
                       $compl_insert     .= ", ValorPontoPedido";
                       $compl_insert_val .= ", $this->valorpontopedido";
                  } 
                  if ($this->tipopontopedido != "")
                  { 
                       $compl_insert     .= ", TipoPontoPedido";
                       $compl_insert_val .= ", '$this->tipopontopedido'";
                  } 
                  if ($this->temperaturarecebimento != "")
                  { 
                       $compl_insert     .= ", TemperaturaRecebimento";
                       $compl_insert_val .= ", $this->temperaturarecebimento";
                  } 
                  if ($this->temperaturatransporte != "")
                  { 
                       $compl_insert     .= ", TemperaturaTransporte";
                       $compl_insert_val .= ", $this->temperaturatransporte";
                  } 
                  if ($this->temperaturapadrao != "")
                  { 
                       $compl_insert     .= ", TemperaturaPadrao";
                       $compl_insert_val .= ", $this->temperaturapadrao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdAlmoxarifadoEntrada, IdAlmoxarifadoProduto, IdAlmoxarifadoProdutoVolume, IdAlmoxarifadoProdutoLocalArmazenamento, IdEmpresa, IdUsuarioAuditoria, Codigo, Nome, Volume, Quantidade, TipoValidade, CodigoBarras, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idalmoxarifadoentrada, $this->idalmoxarifadoproduto, $this->idalmoxarifadoprodutovolume, $this->idalmoxarifadoprodutolocalarmazenamento, $this->idempresa, $this->idusuarioauditoria, '$this->codigo', '$this->nome', '$this->volume', $this->quantidade, '$this->tipovalidade', '$this->codigobarras', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
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
                              AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
                          AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->idalmoxarifadoentradaproduto =  $rsy->fields[0];
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
                  $this->idalmoxarifadoentradaproduto = $rsy->fields[0];
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
                  $this->idalmoxarifadoentradaproduto = $rsy->fields[0];
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
                  $this->idalmoxarifadoentradaproduto = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->codigo = $this->codigo_before_qstr;
              $this->nome = $this->nome_before_qstr;
              $this->volume = $this->volume_before_qstr;
              $this->tipovalidade = $this->tipovalidade_before_qstr;
              $this->lote = $this->lote_before_qstr;
              $this->tipopontopedido = $this->tipopontopedido_before_qstr;
              $this->codigobarras = $this->codigobarras_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->codigo = $this->codigo_before_qstr;
              $this->nome = $this->nome_before_qstr;
              $this->volume = $this->volume_before_qstr;
              $this->tipovalidade = $this->tipovalidade_before_qstr;
              $this->lote = $this->lote_before_qstr;
              $this->tipopontopedido = $this->tipopontopedido_before_qstr;
              $this->codigobarras = $this->codigobarras_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->idalmoxarifadoentradaproduto = substr($this->Db->qstr($this->idalmoxarifadoentradaproduto), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto "); 
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
                          AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']);
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
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['decimal_db'] == ",")
        {
           $this->nm_troca_decimal(",", ".");
        }
        
/*----- Scriptcase Locale: Event onAfterUpdate ------*/
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
  if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterUpdate ------*/
 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['parms'] = "idalmoxarifadoentradaproduto?#?$this->idalmoxarifadoentradaproduto?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idalmoxarifadoentradaproduto = null === $this->idalmoxarifadoentradaproduto ? null : substr($this->Db->qstr($this->idalmoxarifadoentradaproduto), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->idalmoxarifadoentradaproduto)) 
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
          else 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
      } 
      if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->nmgp_opcao != "nada" && (trim($this->idalmoxarifadoentradaproduto) == "")) 
      { 
          if ($this->nmgp_opcao == "avanca")  
          { 
              $this->nmgp_opcao = "final"; 
          } 
          elseif ($this->nmgp_opcao != "novo")
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("(IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')");
      if (substr(strtolower($sc_where), 0, 5) == "where")
      {
          $sc_where  = substr($sc_where , 5);
      }
      if (!empty($sc_where))
      {
          $sc_where = " where " . $sc_where . " ";
      }
      if ('' != $sc_where_filter)
      {
          $sc_where = ('' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total'] = $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->idalmoxarifadoentradaproduto))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "IdAlmoxarifadoEntradaProduto < $this->idalmoxarifadoentradaproduto "; 
              }  
              else  
              {
                  $Key_Where = "IdAlmoxarifadoEntradaProduto < $this->idalmoxarifadoentradaproduto "; 
              }
              $Where_Start = (empty($sc_where)) ? " where " . $Key_Where :  $sc_where . " and (" . $Key_Where . ")";
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $Where_Start; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] > $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] = $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] = $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total'] + 1; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdAlmoxarifadoEntradaProduto, IdTenacidade, IdAlmoxarifadoEntrada, IdAlmoxarifadoProduto, IdAlmoxarifadoProdutoVolume, IdAlmoxarifadoProdutoLocalArmazenamento, IdEmpresa, IdUsuarioAuditoria, Codigo, Nome, Volume, Quantidade, ValorUnitario, ValorTotal, TipoValidade, DataValidade, DataFabricacao, Lote, EstoqueMinimo, EstoqueMaximo, ValorPontoPedido, TipoPontoPedido, TemperaturaRecebimento, TemperaturaTransporte, TemperaturaPadrao, CodigoBarras, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = "(IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto"; 
                  }  
                  else  
                  {
                     $aWhere[] = "IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto"; 
                  }
              } 
              else
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                      $aWhere[] = "IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto"; 
                  }  
                  else  
                  {
                      $aWhere[] = "IdAlmoxarifadoEntradaProduto = $this->idalmoxarifadoentradaproduto"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "IdAlmoxarifadoEntradaProduto";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter'] = true;
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
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd_extr']); 
              $this->nmgp_opcao = "novo"; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->idalmoxarifadoentradaproduto = $rs->fields[0] ; 
              $this->nmgp_dados_select['idalmoxarifadoentradaproduto'] = $this->idalmoxarifadoentradaproduto;
              $this->idtenacidade = $rs->fields[1] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idalmoxarifadoentrada = $rs->fields[2] ; 
              $this->nmgp_dados_select['idalmoxarifadoentrada'] = $this->idalmoxarifadoentrada;
              $this->idalmoxarifadoproduto = $rs->fields[3] ; 
              $this->nmgp_dados_select['idalmoxarifadoproduto'] = $this->idalmoxarifadoproduto;
              $this->idalmoxarifadoprodutovolume = $rs->fields[4] ; 
              $this->nmgp_dados_select['idalmoxarifadoprodutovolume'] = $this->idalmoxarifadoprodutovolume;
              $this->idalmoxarifadoprodutolocalarmazenamento = $rs->fields[5] ; 
              $this->nmgp_dados_select['idalmoxarifadoprodutolocalarmazenamento'] = $this->idalmoxarifadoprodutolocalarmazenamento;
              $this->idempresa = $rs->fields[6] ; 
              $this->nmgp_dados_select['idempresa'] = $this->idempresa;
              $this->idusuarioauditoria = $rs->fields[7] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->codigo = $rs->fields[8] ; 
              $this->nmgp_dados_select['codigo'] = $this->codigo;
              $this->nome = $rs->fields[9] ; 
              $this->nmgp_dados_select['nome'] = $this->nome;
              $this->volume = $rs->fields[10] ; 
              $this->nmgp_dados_select['volume'] = $this->volume;
              $this->quantidade = trim($rs->fields[11]) ; 
              $this->nmgp_dados_select['quantidade'] = $this->quantidade;
              $this->valorunitario = trim($rs->fields[12]) ; 
              $this->nmgp_dados_select['valorunitario'] = $this->valorunitario;
              $this->valortotal = trim($rs->fields[13]) ; 
              $this->nmgp_dados_select['valortotal'] = $this->valortotal;
              $this->tipovalidade = $rs->fields[14] ; 
              $this->nmgp_dados_select['tipovalidade'] = $this->tipovalidade;
              $this->datavalidade = $rs->fields[15] ; 
              $this->nmgp_dados_select['datavalidade'] = $this->datavalidade;
              $this->datafabricacao = $rs->fields[16] ; 
              $this->nmgp_dados_select['datafabricacao'] = $this->datafabricacao;
              $this->lote = $rs->fields[17] ; 
              $this->nmgp_dados_select['lote'] = $this->lote;
              $this->estoqueminimo = $rs->fields[18] ; 
              $this->nmgp_dados_select['estoqueminimo'] = $this->estoqueminimo;
              $this->estoquemaximo = $rs->fields[19] ; 
              $this->nmgp_dados_select['estoquemaximo'] = $this->estoquemaximo;
              $this->valorpontopedido = $rs->fields[20] ; 
              $this->nmgp_dados_select['valorpontopedido'] = $this->valorpontopedido;
              $this->tipopontopedido = $rs->fields[21] ; 
              $this->nmgp_dados_select['tipopontopedido'] = $this->tipopontopedido;
              $this->temperaturarecebimento = trim($rs->fields[22]) ; 
              $this->nmgp_dados_select['temperaturarecebimento'] = $this->temperaturarecebimento;
              $this->temperaturatransporte = trim($rs->fields[23]) ; 
              $this->nmgp_dados_select['temperaturatransporte'] = $this->temperaturatransporte;
              $this->temperaturapadrao = trim($rs->fields[24]) ; 
              $this->nmgp_dados_select['temperaturapadrao'] = $this->temperaturapadrao;
              $this->codigobarras = $rs->fields[25] ; 
              $this->nmgp_dados_select['codigobarras'] = $this->codigobarras;
              $this->enderecoipauditoria = $rs->fields[26] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[27] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->idalmoxarifadoentradaproduto = (string)$this->idalmoxarifadoentradaproduto; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idalmoxarifadoentrada = (string)$this->idalmoxarifadoentrada; 
              $this->idalmoxarifadoproduto = (string)$this->idalmoxarifadoproduto; 
              $this->idalmoxarifadoprodutovolume = (string)$this->idalmoxarifadoprodutovolume; 
              $this->idalmoxarifadoprodutolocalarmazenamento = (string)$this->idalmoxarifadoprodutolocalarmazenamento; 
              $this->idempresa = (string)$this->idempresa; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->quantidade = (strpos(strtolower($this->quantidade), "e")) ? (float)$this->quantidade : $this->quantidade; 
              $this->quantidade = (string)$this->quantidade; 
              $this->valorunitario = (strpos(strtolower($this->valorunitario), "e")) ? (float)$this->valorunitario : $this->valorunitario; 
              $this->valorunitario = (string)$this->valorunitario; 
              $this->valortotal = (strpos(strtolower($this->valortotal), "e")) ? (float)$this->valortotal : $this->valortotal; 
              $this->valortotal = (string)$this->valortotal; 
              $this->estoqueminimo = (string)$this->estoqueminimo; 
              $this->estoquemaximo = (string)$this->estoquemaximo; 
              $this->valorpontopedido = (string)$this->valorpontopedido; 
              $this->temperaturarecebimento = (strpos(strtolower($this->temperaturarecebimento), "e")) ? (float)$this->temperaturarecebimento : $this->temperaturarecebimento; 
              $this->temperaturarecebimento = (string)$this->temperaturarecebimento; 
              $this->temperaturatransporte = (strpos(strtolower($this->temperaturatransporte), "e")) ? (float)$this->temperaturatransporte : $this->temperaturatransporte; 
              $this->temperaturatransporte = (string)$this->temperaturatransporte; 
              $this->temperaturapadrao = (strpos(strtolower($this->temperaturapadrao), "e")) ? (float)$this->temperaturapadrao : $this->temperaturapadrao; 
              $this->temperaturapadrao = (string)$this->temperaturapadrao; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['parms'] = "idalmoxarifadoentradaproduto?#?$this->idalmoxarifadoentradaproduto?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] < $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm;
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opcao']   = '';
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
              $this->idalmoxarifadoentradaproduto = "";  
              $this->nmgp_dados_form["idalmoxarifadoentradaproduto"] = $this->idalmoxarifadoentradaproduto;
              $this->idtenacidade = "" . $_SESSION['varIdTenacidade'] . "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idalmoxarifadoentrada = "" . $_SESSION['varIdAlmoxarifadoEntrada'] . "";  
              $this->nmgp_dados_form["idalmoxarifadoentrada"] = $this->idalmoxarifadoentrada;
              $this->idalmoxarifadoproduto = "";  
              $this->nmgp_dados_form["idalmoxarifadoproduto"] = $this->idalmoxarifadoproduto;
              $this->idalmoxarifadoprodutovolume = "";  
              $this->nmgp_dados_form["idalmoxarifadoprodutovolume"] = $this->idalmoxarifadoprodutovolume;
              $this->idalmoxarifadoprodutolocalarmazenamento = "";  
              $this->nmgp_dados_form["idalmoxarifadoprodutolocalarmazenamento"] = $this->idalmoxarifadoprodutolocalarmazenamento;
              $this->idempresa = "" . $_SESSION['varIdEmpresa'] . "";  
              $this->nmgp_dados_form["idempresa"] = $this->idempresa;
              $this->idusuarioauditoria = "" . $_SESSION['varIdUsuario'] . "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->codigo = "";  
              $this->nmgp_dados_form["codigo"] = $this->codigo;
              $this->nome = "";  
              $this->nmgp_dados_form["nome"] = $this->nome;
              $this->volume = "";  
              $this->nmgp_dados_form["volume"] = $this->volume;
              $this->quantidade = "";  
              $this->nmgp_dados_form["quantidade"] = $this->quantidade;
              $this->valorunitario = "";  
              $this->nmgp_dados_form["valorunitario"] = $this->valorunitario;
              $this->valortotal = "";  
              $this->nmgp_dados_form["valortotal"] = $this->valortotal;
              $this->tipovalidade = "";  
              $this->nmgp_dados_form["tipovalidade"] = $this->tipovalidade;
              $this->datavalidade = "";  
              $this->datavalidade_hora = "" ;  
              $this->nmgp_dados_form["datavalidade"] = $this->datavalidade;
              $this->datafabricacao = "";  
              $this->datafabricacao_hora = "" ;  
              $this->nmgp_dados_form["datafabricacao"] = $this->datafabricacao;
              $this->lote = "";  
              $this->nmgp_dados_form["lote"] = $this->lote;
              $this->estoqueminimo = "";  
              $this->nmgp_dados_form["estoqueminimo"] = $this->estoqueminimo;
              $this->estoquemaximo = "";  
              $this->nmgp_dados_form["estoquemaximo"] = $this->estoquemaximo;
              $this->valorpontopedido = "";  
              $this->nmgp_dados_form["valorpontopedido"] = $this->valorpontopedido;
              $this->tipopontopedido = "";  
              $this->nmgp_dados_form["tipopontopedido"] = $this->tipopontopedido;
              $this->temperaturarecebimento = "";  
              $this->nmgp_dados_form["temperaturarecebimento"] = $this->temperaturarecebimento;
              $this->temperaturatransporte = "";  
              $this->nmgp_dados_form["temperaturatransporte"] = $this->temperaturatransporte;
              $this->temperaturapadrao = "";  
              $this->nmgp_dados_form["temperaturapadrao"] = $this->temperaturapadrao;
              $this->codigobarras = "";  
              $this->nmgp_dados_form["codigobarras"] = $this->codigobarras;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
  }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

/*----- Scriptcase Locale: PHP Method: verificarInformacoesEstoque ------*/

function verificarInformacoesEstoque()
{
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varTipoAcesso)) {$this->sc_temp_varTipoAcesso = (isset($_SESSION['varTipoAcesso'])) ? $_SESSION['varTipoAcesso'] : "";}
  
$retorno = true;

$check_sql = "SELECT IdAlmoxarifadoProduto, EstoqueMinimo, EstoqueMaximo, ValorPontoPedido, TipoPontoPedido"
   . " FROM almoxarifadoproduto"
   . " WHERE IdAlmoxarifadoProduto = '" . $this->idalmoxarifadoproduto  . "'";
 
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
    
	$varEstoqueMinimo 		= $this->rs[0][1];
    $varEstoqueMaximo 		= $this->rs[0][2];
    $varValorPontoPedido 	= $this->rs[0][3];
    $varPontoTipoPedido 	= $this->rs[0][4];
	
	$this->estoqueminimo 		= $varEstoqueMinimo;
	$this->estoquemaximo 		= $varEstoqueMaximo;
	$this->valorpontopedido 	= $varValorPontoPedido;
	$this->tipopontopedido 	= $varPontoTipoPedido;
	
	if ($this->sc_temp_varTipoAcesso == 'Produto') {
		
		if (empty($varEstoqueMinimo) || empty($varEstoqueMaximo) || empty($varValorPontoPedido) || empty($varPontoTipoPedido)) {
			$retorno = false;
		}
		
	} 
} else {
	
	$retorno = false;
}

return $retorno;
if (isset($this->sc_temp_varTipoAcesso)) { $_SESSION['varTipoAcesso'] = $this->sc_temp_varTipoAcesso;}
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: verificarInformacoesEstoque ------*/


/*----- Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/

function Gravar_Tabela_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
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
                AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

function Preparar_LstFrm_OnSrip_OnLoad_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'on';
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
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_disabled_macro']['idtenacidade'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("idusuarioauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_disabled_macro']['idusuarioauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("enderecoipauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_disabled_macro']['enderecoipauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("nomeaplicacaoauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Field_disabled_macro']['nomeaplicacaoauditoria'] = array('I'=>array(),'U'=>array());
;

			if ($this->sc_temp_varPrivAdmin != 1) {
				if ($this->sc_temp_varAcessoAuditoria != "S") {
					$this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes["Auditoria"] = 'off';;
				}
				if ($this->sc_temp_varAcessoAutorizacoes != "S") {
					$this->NM_ajax_info['buttonDisplay']['Autorizações'] = $this->nmgp_botoes["Autorizações"] = 'off';;
				}
				$this->Ini->nm_hidden_blocos[2] = 'off'; $this->NM_ajax_info['blockDisplay']['2'] = 'off';
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
$_SESSION['scriptcase']['AlmoxarifadoEntradaProduto_Validacao_Frm']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("AlmoxarifadoEntradaProduto_Validacao_Frm_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idalmoxarifadoprodutoentradanotaitem", "idtenacidade", "idalmoxarifadoprodutoentradanota", "idalmoxarifadoproduto", "idusuarioauditoria", "quantidadeproduto", "valorunitario", "valortotal", "observacoes", "enderecoipauditoria", "nomeaplicacaoauditoria"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['csrf_token'];
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

   function Form_lookup_idalmoxarifadoproduto()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'] = array(); 
    }

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT      ap.IdAlmoxarifadoProduto,     CONCAT_WS('',         'SKU (Sigla): ', ap.Sigla,         ' - Produto: ', ap.Descricao,         ' - ', fo.NomeFantasia     ) AS DescricaoCompleta FROM almoxarifadoproduto ap LEFT JOIN fornecedor fo ON (fo.IdFornecedor = ap.IdFornecedor) WHERE ap.IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'   AND ap.Ativo = 'S' ORDER BY ap.Sigla, Descricao;";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoproduto'][] = $rs->fields[0];
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
   function Form_lookup_idalmoxarifadoprodutovolume()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'] = array(); 
}
if ($this->idalmoxarifadoproduto != "")
{ 
   $this->nm_clear_val("idalmoxarifadoproduto");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'] = array(); 
    }

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT IdAlmoxarifadoProdutoVolume, Descricao  FROM almoxarifadoprodutovolume  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND IdAlmoxarifadoProdutoVolume = (SELECT IdAlmoxarifadoProdutoVolume FROM almoxarifadoproduto WHERE IdAlmoxarifadoProduto = '$this->idalmoxarifadoproduto') ORDER BY Descricao";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutovolume'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_tipopontopedido()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Porcentagem?#?P?#?N?@?";
       $nmgp_def_dados .= "Quantidade?#?Q?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_idalmoxarifadoprodutolocalarmazenamento()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'] = array(); 
}
if ($this->idalmoxarifadoentrada != "")
{ 
   $this->nm_clear_val("idalmoxarifadoentrada");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'] = array(); 
    }

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT loc.IdAlmoxarifadoProdutoLocalArmazenamento, loc.Descricao  FROM almoxarifadoprodutolocalarmazenamento loc WHERE loc.Ativo = 'S' AND loc.IdAlmoxarifado = (SELECT a.IdAlmoxarifado FROM almoxarifadoentrada a WHERE a.IdAlmoxarifadoEntrada = '$this->idalmoxarifadoentrada') ORDER BY loc.Descricao";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idalmoxarifadoprodutolocalarmazenamento'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_tipovalidade()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Informada?#?S?#?N?@?";
       $nmgp_def_dados .= "Indeterminada?#?I?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_idempresa()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'] = array(); 
    }

   $old_value_quantidade = $this->quantidade;
   $old_value_valorunitario = $this->valorunitario;
   $old_value_valortotal = $this->valortotal;
   $old_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $old_value_estoqueminimo = $this->estoqueminimo;
   $old_value_estoquemaximo = $this->estoquemaximo;
   $old_value_valorpontopedido = $this->valorpontopedido;
   $old_value_datavalidade = $this->datavalidade;
   $old_value_datafabricacao = $this->datafabricacao;
   $old_value_temperaturarecebimento = $this->temperaturarecebimento;
   $old_value_temperaturatransporte = $this->temperaturatransporte;
   $old_value_temperaturapadrao = $this->temperaturapadrao;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_quantidade = $this->quantidade;
   $unformatted_value_valorunitario = $this->valorunitario;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_idalmoxarifadoentradaproduto = $this->idalmoxarifadoentradaproduto;
   $unformatted_value_estoqueminimo = $this->estoqueminimo;
   $unformatted_value_estoquemaximo = $this->estoquemaximo;
   $unformatted_value_valorpontopedido = $this->valorpontopedido;
   $unformatted_value_datavalidade = $this->datavalidade;
   $unformatted_value_datafabricacao = $this->datafabricacao;
   $unformatted_value_temperaturarecebimento = $this->temperaturarecebimento;
   $unformatted_value_temperaturatransporte = $this->temperaturatransporte;
   $unformatted_value_temperaturapadrao = $this->temperaturapadrao;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idalmoxarifadoentrada = $this->idalmoxarifadoentrada;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT IdEmpresa, NomeFantasia  FROM empresa  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND IdEmpresa IN (" . $_SESSION['varListaEmpresa'] . ") ORDER BY NomeFantasia";

   $this->quantidade = $old_value_quantidade;
   $this->valorunitario = $old_value_valorunitario;
   $this->valortotal = $old_value_valortotal;
   $this->idalmoxarifadoentradaproduto = $old_value_idalmoxarifadoentradaproduto;
   $this->estoqueminimo = $old_value_estoqueminimo;
   $this->estoquemaximo = $old_value_estoquemaximo;
   $this->valorpontopedido = $old_value_valorpontopedido;
   $this->datavalidade = $old_value_datavalidade;
   $this->datafabricacao = $old_value_datafabricacao;
   $this->temperaturarecebimento = $old_value_temperaturarecebimento;
   $this->temperaturatransporte = $old_value_temperaturatransporte;
   $this->temperaturapadrao = $old_value_temperaturapadrao;
   $this->idtenacidade = $old_value_idtenacidade;
   $this->idalmoxarifadoentrada = $old_value_idalmoxarifadoentrada;
   $this->idusuarioauditoria = $old_value_idusuarioauditoria;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['Lookup_idempresa'][] = $rs->fields[0];
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
              $this->SC_monta_condicao($comando, "IdTenacidade", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idalmoxarifadoproduto($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdAlmoxarifadoProduto", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "IdUsuarioAuditoria", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorUnitario", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorTotal", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "EnderecoIpAuditoria", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "NomeAplicacaoAuditoria", $arg_search, $data_search, "VARCHAR", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter_form'] . " and ((IdAlmoxarifadoEntrada = '" . $_SESSION['varIdAlmoxarifadoEntrada'] . "')) and (" . $comando . ")";
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
      $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total'] = $qt_geral_reg_AlmoxarifadoEntradaProduto_Validacao_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
      $nm_numeric[] = "idalmoxarifadoentradaproduto";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idalmoxarifadoentrada";$nm_numeric[] = "idalmoxarifadoproduto";$nm_numeric[] = "idalmoxarifadoprodutovolume";$nm_numeric[] = "idalmoxarifadoprodutolocalarmazenamento";$nm_numeric[] = "idempresa";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "quantidade";$nm_numeric[] = "valorunitario";$nm_numeric[] = "valortotal";$nm_numeric[] = "estoqueminimo";$nm_numeric[] = "estoquemaximo";$nm_numeric[] = "valorpontopedido";$nm_numeric[] = "temperaturarecebimento";$nm_numeric[] = "temperaturatransporte";$nm_numeric[] = "temperaturapadrao";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['decimal_db'] == ".")
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
      $Nm_datas["datavalidade"] = "date";$Nm_datas["datafabricacao"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['SC_sep_date1'];
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
   function SC_lookup_idalmoxarifadoproduto($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT CONCAT_WS('','SKU (Sigla): ', ap.Sigla,         ' - Produto: ', ap.Descricao,         ' - ',fo.NomeFantasia     ), ap.IdAlmoxarifadoProduto FROM almoxarifadoproduto ap LEFT JOIN fornecedor fo ON (fo.IdFornecedor = ap.IdFornecedor) WHERE (#cmp_iCONCAT_WS('','SKU (Sigla): ', ap.Sigla,         ' - Produto: ', ap.Descricao,         ' - ',fo.NomeFantasia     )#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (ap.IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND (ap.Ativo = 'S')" ; 
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
       $nmgp_saida_form = "AlmoxarifadoEntradaProduto_Validacao_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "AlmoxarifadoEntradaProduto_Validacao_Frm_fim.php";
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
       AlmoxarifadoEntradaProduto_Validacao_Frm_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['masterValue']);
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
    function sc_ajax_javascript($sJsFunc, $aParam = array())
    {
        if ($this->NM_ajax_flag)
        {
            foreach ($aParam as $i => $v)
            {
                $aParam[$i] = NM_charset_to_utf8($v);
            }
            $this->NM_ajax_info['ajaxJavascript'][] = array(NM_charset_to_utf8($sJsFunc), $aParam);
        }
        else
        {
            foreach ($aParam as $i => $v)
            {
                $aParam[$i] = '"' . str_replace('"', '\"', $v) . '"';
            }
            $this->NM_non_ajax_info['ajaxJavascript'][] = array($sJsFunc, $aParam);
        }
    } // sc_ajax_javascript
    function sc_field_readonly($sField, $sStatus, $iSeq = '')
    {
        if ('on' != $sStatus && 'off' != $sStatus)
        {
            return;
        }

        $sFieldDateTime = '';

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
            case "0":
                return array("sys_separator.sc-unique-btn-5");
                break;
            case "first":
                return array("sc_b_ini_t.sc-unique-btn-6");
                break;
            case "back":
                return array("sc_b_ret_t.sc-unique-btn-7");
                break;
            case "forward":
                return array("sc_b_avc_t.sc-unique-btn-8");
                break;
            case "last":
                return array("sc_b_fim_t.sc-unique-btn-9");
                break;
            case "bcancelar":
                return array("sc_b_sai_t.sc-unique-btn-10");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-11", "sc_b_sai_t.sc-unique-btn-12", "sc_b_sai_t.sc-unique-btn-14", "sc_b_sai_t.sc-unique-btn-13", "sc_b_sai_t.sc-unique-btn-15");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " Produtos"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Produtos"; } ?></span></td>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-footer">
<style>
#rod_col1 { margin:0px; padding: 3px 0 0 5px; float:left; overflow:hidden;}
#rod_col2 { margin:0px; padding: 3px 5px 0 0; float:right; overflow:hidden; text-align:right;}

</style>

<table style="width: 100%; height:20px;" cellpadding="0px" cellspacing="0px" class="scFormFooter">
    <tr>
        <td>
            <span class="scFormFooterFont" id="rod_col1"><?php echo "* Campo obrigatório" ?></span>
        </td>
        <td>
            <span class="scFormFooterFont" id="rod_col2">
<?php
$this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
echo $this->nm_data->FormataSaida("l, d/m/Y @?#?@à@?#?@s H:i");
?>
</span>
        </td>
    </tr>
</table>
    </td></tr>
<?php
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoEntradaProduto_Validacao_Frm']['ordem_ord'] == " desc") {
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
            case "Quantidade":
                return true;
            case "ValorUnitario":
                return true;
            case "ValorTotal":
                return true;
            case "IdAlmoxarifadoEntradaProduto":
                return true;
            case "EstoqueMinimo":
                return true;
            case "EstoqueMaximo":
                return true;
            case "ValorPontoPedido":
                return true;
            case "TemperaturaRecebimento":
                return true;
            case "TemperaturaTransporte":
                return true;
            case "TemperaturaPadrao":
                return true;
            case "IdTenacidade":
                return true;
            case "IdAlmoxarifadoEntrada":
                return true;
            case "IdUsuarioAuditoria":
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

}
?>
