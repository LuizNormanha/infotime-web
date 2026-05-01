<?php
//
class LancamentoReceita_Recorrente_Frm_apl
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
   var $idlancamentoreceita;
   var $idtenacidade;
   var $idtenacidade_1;
   var $idcliente;
   var $idcontacaixa;
   var $idplanoconta;
   var $idsituacaodocumento;
   var $idsituacaodocumento_1;
   var $idtipoespecie;
   var $idtipoespecie_1;
   var $idnotafiscal;
   var $idempresa;
   var $idcontacaixaregistro;
   var $idcontacaixaregistro_1;
   var $idlancamentoreceitapai;
   var $idcontacaixatransferencia;
   var $idcontacaixatransferencia_1;
   var $idcontrato;
   var $idusuarioinclusao;
   var $idusuarioinclusao_1;
   var $idusuarioprevisao;
   var $idusuarioprevisao_1;
   var $idusuariorealizacao;
   var $idusuariorealizacao_1;
   var $idusuariobaixa;
   var $idlancamentoreceitarecorrente;
   var $idtipoagente;
   var $idfornecedor;
   var $idcolaborador;
   var $idusuarioauditoria;
   var $idusuarioauditoria_1;
   var $parcela;
   var $datainclusao;
   var $datainclusao_hora;
   var $dataprevisao;
   var $valorprevisao;
   var $datarealizacao;
   var $datarealizacao_hora;
   var $valoracrescimo;
   var $valordesconto;
   var $valormulta;
   var $valorjuros;
   var $valorrealizacao;
   var $numerodocumento;
   var $contacontabil;
   var $databaixa;
   var $databaixa_hora;
   var $datacompetencia;
   var $historico;
   var $nomearquivo1;
   var $nomereferencia1;
   var $nomearquivo2;
   var $nomereferencia2;
   var $observacoes;
   var $nossonumero;
   var $valororiginal;
   var $unidadeorigem;
   var $enviouemail;
   var $usuarioexterno;
   var $enviouemailcobranca;
   var $lidoemailcobranca;
   var $notafiscal;
   var $fechamentofinanceiro;
   var $enderecoipauditoria;
   var $nomeaplicacaoauditoria;
   var $qtdrecorrencia;
   var $recorrentetemp;
   var $tiporecorrencia;
   var $tiporecorrencia_1;
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
          if (isset($this->NM_ajax_info['param']['dataprevisao']))
          {
              $this->dataprevisao = $this->NM_ajax_info['param']['dataprevisao'];
          }
          if (isset($this->NM_ajax_info['param']['idcliente']))
          {
              $this->idcliente = $this->NM_ajax_info['param']['idcliente'];
          }
          if (isset($this->NM_ajax_info['param']['idcolaborador']))
          {
              $this->idcolaborador = $this->NM_ajax_info['param']['idcolaborador'];
          }
          if (isset($this->NM_ajax_info['param']['idcontacaixa']))
          {
              $this->idcontacaixa = $this->NM_ajax_info['param']['idcontacaixa'];
          }
          if (isset($this->NM_ajax_info['param']['idempresa']))
          {
              $this->idempresa = $this->NM_ajax_info['param']['idempresa'];
          }
          if (isset($this->NM_ajax_info['param']['idfornecedor']))
          {
              $this->idfornecedor = $this->NM_ajax_info['param']['idfornecedor'];
          }
          if (isset($this->NM_ajax_info['param']['idlancamentoreceita']))
          {
              $this->idlancamentoreceita = $this->NM_ajax_info['param']['idlancamentoreceita'];
          }
          if (isset($this->NM_ajax_info['param']['idplanoconta']))
          {
              $this->idplanoconta = $this->NM_ajax_info['param']['idplanoconta'];
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
          if (isset($this->NM_ajax_info['param']['qtdrecorrencia']))
          {
              $this->qtdrecorrencia = $this->NM_ajax_info['param']['qtdrecorrencia'];
          }
          if (isset($this->NM_ajax_info['param']['recorrentetemp']))
          {
              $this->recorrentetemp = $this->NM_ajax_info['param']['recorrentetemp'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['tiporecorrencia']))
          {
              $this->tiporecorrencia = $this->NM_ajax_info['param']['tiporecorrencia'];
          }
          if (isset($this->NM_ajax_info['param']['valorprevisao']))
          {
              $this->valorprevisao = $this->NM_ajax_info['param']['valorprevisao'];
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
      if (isset($this->varIdLancamentoReceita) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
      }
      if (isset($this->varQtdRecorrencia) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varQtdRecorrencia'] = $this->varQtdRecorrencia;
      }
      if (isset($this->varTipoRecorrencia) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varTipoRecorrencia'] = $this->varTipoRecorrencia;
      }
      if (isset($this->varToken) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varToken'] = $this->varToken;
      }
      if (isset($this->varAcao) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varAcao'] = $this->varAcao;
      }
      if (isset($this->varIdTenacidade) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (isset($_POST["varIdLancamentoReceita"]) && isset($this->varIdLancamentoReceita)) 
      {
          $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
      }
      if (!isset($_POST["varIdLancamentoReceita"]) && isset($_POST["varidlancamentoreceita"])) 
      {
          $_SESSION['varIdLancamentoReceita'] = $_POST["varidlancamentoreceita"];
      }
      if (isset($_POST["varQtdRecorrencia"]) && isset($this->varQtdRecorrencia)) 
      {
          $_SESSION['varQtdRecorrencia'] = $this->varQtdRecorrencia;
      }
      if (!isset($_POST["varQtdRecorrencia"]) && isset($_POST["varqtdrecorrencia"])) 
      {
          $_SESSION['varQtdRecorrencia'] = $_POST["varqtdrecorrencia"];
      }
      if (isset($_POST["varTipoRecorrencia"]) && isset($this->varTipoRecorrencia)) 
      {
          $_SESSION['varTipoRecorrencia'] = $this->varTipoRecorrencia;
      }
      if (!isset($_POST["varTipoRecorrencia"]) && isset($_POST["vartiporecorrencia"])) 
      {
          $_SESSION['varTipoRecorrencia'] = $_POST["vartiporecorrencia"];
      }
      if (isset($_POST["varToken"]) && isset($this->varToken)) 
      {
          $_SESSION['varToken'] = $this->varToken;
      }
      if (!isset($_POST["varToken"]) && isset($_POST["vartoken"])) 
      {
          $_SESSION['varToken'] = $_POST["vartoken"];
      }
      if (isset($_POST["varAcao"]) && isset($this->varAcao)) 
      {
          $_SESSION['varAcao'] = $this->varAcao;
      }
      if (!isset($_POST["varAcao"]) && isset($_POST["varacao"])) 
      {
          $_SESSION['varAcao'] = $_POST["varacao"];
      }
      if (isset($_POST["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
      }
      if (isset($_POST["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_POST["varIdUsuario"]) && isset($_POST["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_POST["varidusuario"];
      }
      if (isset($_POST["varIdSituacaoDocumentoPendenteInt"]) && isset($this->varIdSituacaoDocumentoPendenteInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (!isset($_POST["varIdSituacaoDocumentoPendenteInt"]) && isset($_POST["varidsituacaodocumentopendenteint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_POST["varidsituacaodocumentopendenteint"];
      }
      if (isset($_GET["varIdLancamentoReceita"]) && isset($this->varIdLancamentoReceita)) 
      {
          $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
      }
      if (!isset($_GET["varIdLancamentoReceita"]) && isset($_GET["varidlancamentoreceita"])) 
      {
          $_SESSION['varIdLancamentoReceita'] = $_GET["varidlancamentoreceita"];
      }
      if (isset($_GET["varQtdRecorrencia"]) && isset($this->varQtdRecorrencia)) 
      {
          $_SESSION['varQtdRecorrencia'] = $this->varQtdRecorrencia;
      }
      if (!isset($_GET["varQtdRecorrencia"]) && isset($_GET["varqtdrecorrencia"])) 
      {
          $_SESSION['varQtdRecorrencia'] = $_GET["varqtdrecorrencia"];
      }
      if (isset($_GET["varTipoRecorrencia"]) && isset($this->varTipoRecorrencia)) 
      {
          $_SESSION['varTipoRecorrencia'] = $this->varTipoRecorrencia;
      }
      if (!isset($_GET["varTipoRecorrencia"]) && isset($_GET["vartiporecorrencia"])) 
      {
          $_SESSION['varTipoRecorrencia'] = $_GET["vartiporecorrencia"];
      }
      if (isset($_GET["varToken"]) && isset($this->varToken)) 
      {
          $_SESSION['varToken'] = $this->varToken;
      }
      if (!isset($_GET["varToken"]) && isset($_GET["vartoken"])) 
      {
          $_SESSION['varToken'] = $_GET["vartoken"];
      }
      if (isset($_GET["varAcao"]) && isset($this->varAcao)) 
      {
          $_SESSION['varAcao'] = $this->varAcao;
      }
      if (!isset($_GET["varAcao"]) && isset($_GET["varacao"])) 
      {
          $_SESSION['varAcao'] = $_GET["varacao"];
      }
      if (isset($_GET["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
      }
      if (isset($_GET["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_GET["varIdUsuario"]) && isset($_GET["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_GET["varidusuario"];
      }
      if (isset($_GET["varIdSituacaoDocumentoPendenteInt"]) && isset($this->varIdSituacaoDocumentoPendenteInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (!isset($_GET["varIdSituacaoDocumentoPendenteInt"]) && isset($_GET["varidsituacaodocumentopendenteint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_GET["varidsituacaodocumentopendenteint"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['embutida_parms']);
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
                 nm_limpa_str_LancamentoReceita_Recorrente_Frm($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (!isset($this->varIdLancamentoReceita) && isset($this->varidlancamentoreceita)) 
          {
              $this->varIdLancamentoReceita = $this->varidlancamentoreceita;
          }
          if (isset($this->varIdLancamentoReceita)) 
          {
              $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
          }
          if (!isset($this->varQtdRecorrencia) && isset($this->varqtdrecorrencia)) 
          {
              $this->varQtdRecorrencia = $this->varqtdrecorrencia;
          }
          if (isset($this->varQtdRecorrencia)) 
          {
              $_SESSION['varQtdRecorrencia'] = $this->varQtdRecorrencia;
          }
          if (!isset($this->varTipoRecorrencia) && isset($this->vartiporecorrencia)) 
          {
              $this->varTipoRecorrencia = $this->vartiporecorrencia;
          }
          if (isset($this->varTipoRecorrencia)) 
          {
              $_SESSION['varTipoRecorrencia'] = $this->varTipoRecorrencia;
          }
          if (!isset($this->varToken) && isset($this->vartoken)) 
          {
              $this->varToken = $this->vartoken;
          }
          if (isset($this->varToken)) 
          {
              $_SESSION['varToken'] = $this->varToken;
          }
          if (!isset($this->varAcao) && isset($this->varacao)) 
          {
              $this->varAcao = $this->varacao;
          }
          if (isset($this->varAcao)) 
          {
              $_SESSION['varAcao'] = $this->varAcao;
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->varidsituacaodocumentopendenteint)) 
          {
              $this->varIdSituacaoDocumentoPendenteInt = $this->varidsituacaodocumentopendenteint;
          }
          if (isset($this->varIdSituacaoDocumentoPendenteInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['opc_ant']);
          }
          if (!isset($this->varIdLancamentoReceita) && isset($this->varidlancamentoreceita)) 
          {
              $this->varIdLancamentoReceita = $this->varidlancamentoreceita;
          }
          if (isset($this->varIdLancamentoReceita)) 
          {
              $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
          }
          if (!isset($this->varQtdRecorrencia) && isset($this->varqtdrecorrencia)) 
          {
              $this->varQtdRecorrencia = $this->varqtdrecorrencia;
          }
          if (isset($this->varQtdRecorrencia)) 
          {
              $_SESSION['varQtdRecorrencia'] = $this->varQtdRecorrencia;
          }
          if (!isset($this->varTipoRecorrencia) && isset($this->vartiporecorrencia)) 
          {
              $this->varTipoRecorrencia = $this->vartiporecorrencia;
          }
          if (isset($this->varTipoRecorrencia)) 
          {
              $_SESSION['varTipoRecorrencia'] = $this->varTipoRecorrencia;
          }
          if (!isset($this->varToken) && isset($this->vartoken)) 
          {
              $this->varToken = $this->vartoken;
          }
          if (isset($this->varToken)) 
          {
              $_SESSION['varToken'] = $this->varToken;
          }
          if (!isset($this->varAcao) && isset($this->varacao)) 
          {
              $this->varAcao = $this->varacao;
          }
          if (isset($this->varAcao)) 
          {
              $_SESSION['varAcao'] = $this->varAcao;
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->varidsituacaodocumentopendenteint)) 
          {
              $this->varIdSituacaoDocumentoPendenteInt = $this->varidsituacaodocumentopendenteint;
          }
          if (isset($this->varIdSituacaoDocumentoPendenteInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new LancamentoReceita_Recorrente_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['initialize'])
          {
              $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdLancamentoReceita)) {$this->sc_temp_varIdLancamentoReceita = (isset($_SESSION['varIdLancamentoReceita'])) ? $_SESSION['varIdLancamentoReceita'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varToken)) {$this->sc_temp_varToken = (isset($_SESSION['varToken'])) ? $_SESSION['varToken'] : "";}
if (!isset($this->sc_temp_varAcao)) {$this->sc_temp_varAcao = (isset($_SESSION['varAcao'])) ? $_SESSION['varAcao'] : "";}
  if (!isset($this->sc_temp_varAcao)) {
	$varAcao = -1;
	 if (isset($varAcao)) {$this->sc_temp_varAcao = $varAcao;}
;
} else {
	$this->sc_temp_varAcao = -1;
}
if (!isset($this->sc_temp_varToken)) {
	$varToken = '';
	 if (isset($varToken)) {$this->sc_temp_varToken = $varToken;}
;
} else {
	$this->sc_temp_varToken = '';
}

$delete_table  = '_lancamentoreceitarecorrente';
$delete_where  = "IdTenacidade = '$this->sc_temp_varIdTenacidade' AND IdLancamentoReceita = '$this->sc_temp_varIdLancamentoReceita'";
$delete_sql = 'DELETE FROM ' . $delete_table
    . ' WHERE '      . $delete_where;

     $nm_select = $delete_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
if (isset($this->sc_temp_varAcao)) { $_SESSION['varAcao'] = $this->sc_temp_varAcao;}
if (isset($this->sc_temp_varToken)) { $_SESSION['varToken'] = $this->sc_temp_varToken;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdLancamentoReceita)) { $_SESSION['varIdLancamentoReceita'] = $this->sc_temp_varIdLancamentoReceita;}
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['LancamentoReceita_Recorrente_Frm']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['LancamentoReceita_Recorrente_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['LancamentoReceita_Recorrente_Frm'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['LancamentoReceita_Recorrente_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['LancamentoReceita_Recorrente_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('LancamentoReceita_Recorrente_Frm') . "/LancamentoReceita_Recorrente_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['LancamentoReceita_Recorrente_Frm']['label'] = "Geração de recorrências de contas a receber (receitas)";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "LancamentoReceita_Recorrente_Frm")
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


      $this->arr_buttons['gerarrecorrencia']['hint']             = "";
      $this->arr_buttons['gerarrecorrencia']['type']             = "button";
      $this->arr_buttons['gerarrecorrencia']['value']            = "Gerar recorrência";
      $this->arr_buttons['gerarrecorrencia']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['gerarrecorrencia']['display_position'] = "text_right";
      $this->arr_buttons['gerarrecorrencia']['style']            = "ok";
      $this->arr_buttons['gerarrecorrencia']['image']            = "";
      $this->arr_buttons['gerarrecorrencia']['has_fa']            = "true";
      $this->arr_buttons['gerarrecorrencia']['fontawesomeicon']            = "fas fa-database";

      $this->arr_buttons['gerarsimulacao']['hint']             = "";
      $this->arr_buttons['gerarsimulacao']['type']             = "button";
      $this->arr_buttons['gerarsimulacao']['value']            = "Gerar simulação";
      $this->arr_buttons['gerarsimulacao']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['gerarsimulacao']['display_position'] = "text_right";
      $this->arr_buttons['gerarsimulacao']['style']            = "paypal";
      $this->arr_buttons['gerarsimulacao']['image']            = "";
      $this->arr_buttons['gerarsimulacao']['has_fa']            = "true";
      $this->arr_buttons['gerarsimulacao']['fontawesomeicon']            = "fas fa-info-circle";


      $_SESSION['scriptcase']['error_icon']['LancamentoReceita_Recorrente_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['LancamentoReceita_Recorrente_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "LancamentoReceita_Recorrente_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new']  = "off";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['insert'] = "off";
      $this->nmgp_botoes['update'] = "off";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "off";
      $this->nmgp_botoes['back'] = "off";
      $this->nmgp_botoes['forward'] = "off";
      $this->nmgp_botoes['last'] = "off";
      $this->nmgp_botoes['summary'] = "off";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      $this->nmgp_botoes['GerarRecorrencia'] = "on";
      $this->nmgp_botoes['GerarSimulacao'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_orig'] = " where (IdLancamentoReceita = '" . $_SESSION['varIdLancamentoReceita'] . "')";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_pesq'] = " where (IdLancamentoReceita = '" . $_SESSION['varIdLancamentoReceita'] . "')";
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['LancamentoReceita_Recorrente_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['LancamentoReceita_Recorrente_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['LancamentoReceita_Recorrente_Frm'];

              $this->nmgp_botoes['update']     = $tmpDashboardButtons['form_update']    ? 'on' : 'off';
              $this->nmgp_botoes['new']        = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['insert']     = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['delete']     = $tmpDashboardButtons['form_delete']    ? 'on' : 'off';
              $this->nmgp_botoes['copy']       = $tmpDashboardButtons['form_copy']      ? 'on' : 'off';
              $this->nmgp_botoes['first']      = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']    = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['navpage']    = $tmpDashboardButtons['form_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['goto']       = $tmpDashboardButtons['form_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']     = $tmpDashboardButtons['form_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['summary']    = $tmpDashboardButtons['form_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']    = $tmpDashboardButtons['form_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']  = $tmpDashboardButtons['form_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['reload']     = $tmpDashboardButtons['form_reload']    ? 'on' : 'off';
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form'];
          if (!isset($this->idlancamentoreceita)){$this->idlancamentoreceita = $this->nmgp_dados_form['idlancamentoreceita'];} 
          if (!isset($this->idtenacidade)){$this->idtenacidade = $this->nmgp_dados_form['idtenacidade'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['idcontacaixa'] != "null"){$this->idcontacaixa = $this->nmgp_dados_form['idcontacaixa'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['idplanoconta'] != "null"){$this->idplanoconta = $this->nmgp_dados_form['idplanoconta'];} 
          if (!isset($this->idsituacaodocumento)){$this->idsituacaodocumento = $this->nmgp_dados_form['idsituacaodocumento'];} 
          if (!isset($this->idtipoespecie)){$this->idtipoespecie = $this->nmgp_dados_form['idtipoespecie'];} 
          if (!isset($this->idnotafiscal)){$this->idnotafiscal = $this->nmgp_dados_form['idnotafiscal'];} 
          if (!isset($this->idcontacaixaregistro)){$this->idcontacaixaregistro = $this->nmgp_dados_form['idcontacaixaregistro'];} 
          if (!isset($this->idlancamentoreceitapai)){$this->idlancamentoreceitapai = $this->nmgp_dados_form['idlancamentoreceitapai'];} 
          if (!isset($this->idcontacaixatransferencia)){$this->idcontacaixatransferencia = $this->nmgp_dados_form['idcontacaixatransferencia'];} 
          if (!isset($this->idcontrato)){$this->idcontrato = $this->nmgp_dados_form['idcontrato'];} 
          if (!isset($this->idusuarioinclusao)){$this->idusuarioinclusao = $this->nmgp_dados_form['idusuarioinclusao'];} 
          if (!isset($this->idusuarioprevisao)){$this->idusuarioprevisao = $this->nmgp_dados_form['idusuarioprevisao'];} 
          if (!isset($this->idusuariorealizacao)){$this->idusuariorealizacao = $this->nmgp_dados_form['idusuariorealizacao'];} 
          if (!isset($this->idusuariobaixa)){$this->idusuariobaixa = $this->nmgp_dados_form['idusuariobaixa'];} 
          if (!isset($this->idlancamentoreceitarecorrente)){$this->idlancamentoreceitarecorrente = $this->nmgp_dados_form['idlancamentoreceitarecorrente'];} 
          if (!isset($this->idtipoagente)){$this->idtipoagente = $this->nmgp_dados_form['idtipoagente'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['idfornecedor'] != "null"){$this->idfornecedor = $this->nmgp_dados_form['idfornecedor'];} 
          if (!isset($this->idusuarioauditoria)){$this->idusuarioauditoria = $this->nmgp_dados_form['idusuarioauditoria'];} 
          if (!isset($this->parcela)){$this->parcela = $this->nmgp_dados_form['parcela'];} 
          if (!isset($this->datainclusao)){$this->datainclusao = $this->nmgp_dados_form['datainclusao'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['dataprevisao'] != "null"){
              $this->dataprevisao = $this->nmgp_dados_form['dataprevisao'];
              $this->dataprevisao = $this->nm_conv_data_db($this->dataprevisao, 'yyyy-mm-dd', $this->field_config['dataprevisao']['date_format']);
          }
          if (!isset($this->datarealizacao)){$this->datarealizacao = $this->nmgp_dados_form['datarealizacao'];} 
          if (!isset($this->valoracrescimo)){$this->valoracrescimo = $this->nmgp_dados_form['valoracrescimo'];} 
          if (!isset($this->valordesconto)){$this->valordesconto = $this->nmgp_dados_form['valordesconto'];} 
          if (!isset($this->valormulta)){$this->valormulta = $this->nmgp_dados_form['valormulta'];} 
          if (!isset($this->valorjuros)){$this->valorjuros = $this->nmgp_dados_form['valorjuros'];} 
          if (!isset($this->valorrealizacao)){$this->valorrealizacao = $this->nmgp_dados_form['valorrealizacao'];} 
          if (!isset($this->numerodocumento)){$this->numerodocumento = $this->nmgp_dados_form['numerodocumento'];} 
          if (!isset($this->contacontabil)){$this->contacontabil = $this->nmgp_dados_form['contacontabil'];} 
          if (!isset($this->databaixa)){$this->databaixa = $this->nmgp_dados_form['databaixa'];} 
          if (!isset($this->datacompetencia)){$this->datacompetencia = $this->nmgp_dados_form['datacompetencia'];} 
          if (!isset($this->historico)){$this->historico = $this->nmgp_dados_form['historico'];} 
          if (!isset($this->nomearquivo1)){$this->nomearquivo1 = $this->nmgp_dados_form['nomearquivo1'];} 
          if (!isset($this->nomereferencia1)){$this->nomereferencia1 = $this->nmgp_dados_form['nomereferencia1'];} 
          if (!isset($this->nomearquivo2)){$this->nomearquivo2 = $this->nmgp_dados_form['nomearquivo2'];} 
          if (!isset($this->nomereferencia2)){$this->nomereferencia2 = $this->nmgp_dados_form['nomereferencia2'];} 
          if (!isset($this->observacoes)){$this->observacoes = $this->nmgp_dados_form['observacoes'];} 
          if (!isset($this->nossonumero)){$this->nossonumero = $this->nmgp_dados_form['nossonumero'];} 
          if (!isset($this->valororiginal)){$this->valororiginal = $this->nmgp_dados_form['valororiginal'];} 
          if (!isset($this->unidadeorigem)){$this->unidadeorigem = $this->nmgp_dados_form['unidadeorigem'];} 
          if (!isset($this->enviouemail)){$this->enviouemail = $this->nmgp_dados_form['enviouemail'];} 
          if (!isset($this->usuarioexterno)){$this->usuarioexterno = $this->nmgp_dados_form['usuarioexterno'];} 
          if (!isset($this->enviouemailcobranca)){$this->enviouemailcobranca = $this->nmgp_dados_form['enviouemailcobranca'];} 
          if (!isset($this->lidoemailcobranca)){$this->lidoemailcobranca = $this->nmgp_dados_form['lidoemailcobranca'];} 
          if (!isset($this->notafiscal)){$this->notafiscal = $this->nmgp_dados_form['notafiscal'];} 
          if (!isset($this->fechamentofinanceiro)){$this->fechamentofinanceiro = $this->nmgp_dados_form['fechamentofinanceiro'];} 
          if (!isset($this->enderecoipauditoria)){$this->enderecoipauditoria = $this->nmgp_dados_form['enderecoipauditoria'];} 
          if (!isset($this->nomeaplicacaoauditoria)){$this->nomeaplicacaoauditoria = $this->nmgp_dados_form['nomeaplicacaoauditoria'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("LancamentoReceita_Recorrente_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'LancamentoReceita_Recorrente_Frm/LancamentoReceita_Recorrente_Frm_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'LancamentoReceita_Recorrente_Frm_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'LancamentoReceita_Recorrente_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'LancamentoReceita_Recorrente_Frm_help.txt');
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
          require_once($this->Ini->path_embutida . 'LancamentoReceita_Recorrente_Frm/LancamentoReceita_Recorrente_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "LancamentoReceita_Recorrente_Frm_erro.class.php"); 
      }
      $this->Erro      = new LancamentoReceita_Recorrente_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao']))
         { 
             if ($this->idlancamentoreceita != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['LancamentoReceita_Recorrente_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['GerarRecorrencia'] = "off";
          $this->nmgp_botoes['GerarSimulacao'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['GerarRecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['botoes']['GerarRecorrencia'];
          $this->nmgp_botoes['GerarSimulacao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['botoes']['GerarSimulacao'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form'];
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
                 if (isset($_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->idcliente)) { $this->nm_limpa_alfa($this->idcliente); }
      if (isset($this->idcontacaixa)) { $this->nm_limpa_alfa($this->idcontacaixa); }
      if (isset($this->idplanoconta)) { $this->nm_limpa_alfa($this->idplanoconta); }
      if (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
      if (isset($this->idfornecedor)) { $this->nm_limpa_alfa($this->idfornecedor); }
      if (isset($this->idcolaborador)) { $this->nm_limpa_alfa($this->idcolaborador); }
      if (isset($this->valorprevisao)) { $this->nm_limpa_alfa($this->valorprevisao); }
      if (isset($this->recorrentetemp)) { $this->nm_limpa_alfa($this->recorrentetemp); }
      if ($nm_opc_form_php == "formphp")
      { 
          if ($nm_call_php == "GerarRecorrencia")
          { 
              $this->sc_btn_GerarRecorrencia();
          } 
          if ($nm_call_php == "GerarSimulacao")
          { 
              $this->sc_btn_GerarSimulacao();
          } 
          $this->NM_close_db(); 
          exit;
      } 
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "LancamentoReceita_Recorrente_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- idcliente
      $this->field_config['idcliente']               = array();
      $this->field_config['idcliente']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcliente']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcliente']['symbol_dec'] = '';
      $this->field_config['idcliente']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcliente']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idcolaborador
      $this->field_config['idcolaborador']               = array();
      $this->field_config['idcolaborador']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcolaborador']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcolaborador']['symbol_dec'] = '';
      $this->field_config['idcolaborador']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcolaborador']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idfornecedor
      $this->field_config['idfornecedor']               = array();
      $this->field_config['idfornecedor']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idfornecedor']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idfornecedor']['symbol_dec'] = '';
      $this->field_config['idfornecedor']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idfornecedor']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idplanoconta
      $this->field_config['idplanoconta']               = array();
      $this->field_config['idplanoconta']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idplanoconta']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idplanoconta']['symbol_dec'] = '';
      $this->field_config['idplanoconta']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idplanoconta']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idcontacaixa
      $this->field_config['idcontacaixa']               = array();
      $this->field_config['idcontacaixa']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcontacaixa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcontacaixa']['symbol_dec'] = '';
      $this->field_config['idcontacaixa']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcontacaixa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idempresa
      $this->field_config['idempresa']               = array();
      $this->field_config['idempresa']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idempresa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idempresa']['symbol_dec'] = '';
      $this->field_config['idempresa']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idempresa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- dataprevisao
      $this->field_config['dataprevisao']                 = array();
      $this->field_config['dataprevisao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['dataprevisao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dataprevisao']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'dataprevisao');
      //-- valorprevisao
      $this->field_config['valorprevisao']               = array();
      $this->field_config['valorprevisao']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorprevisao']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorprevisao']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorprevisao']['symbol_mon'] = '';
      $this->field_config['valorprevisao']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorprevisao']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- qtdrecorrencia
      $this->field_config['qtdrecorrencia']               = array();
      $this->field_config['qtdrecorrencia']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qtdrecorrencia']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qtdrecorrencia']['symbol_dec'] = '';
      $this->field_config['qtdrecorrencia']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qtdrecorrencia']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idlancamentoreceita
      $this->field_config['idlancamentoreceita']               = array();
      $this->field_config['idlancamentoreceita']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idlancamentoreceita']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idlancamentoreceita']['symbol_dec'] = '';
      $this->field_config['idlancamentoreceita']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idlancamentoreceita']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idnotafiscal
      $this->field_config['idnotafiscal']               = array();
      $this->field_config['idnotafiscal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idnotafiscal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idnotafiscal']['symbol_dec'] = '';
      $this->field_config['idnotafiscal']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idnotafiscal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idlancamentoreceitapai
      $this->field_config['idlancamentoreceitapai']               = array();
      $this->field_config['idlancamentoreceitapai']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idlancamentoreceitapai']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idlancamentoreceitapai']['symbol_dec'] = '';
      $this->field_config['idlancamentoreceitapai']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idlancamentoreceitapai']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idcontrato
      $this->field_config['idcontrato']               = array();
      $this->field_config['idcontrato']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcontrato']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcontrato']['symbol_dec'] = '';
      $this->field_config['idcontrato']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcontrato']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idusuariobaixa
      $this->field_config['idusuariobaixa']               = array();
      $this->field_config['idusuariobaixa']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idusuariobaixa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idusuariobaixa']['symbol_dec'] = '';
      $this->field_config['idusuariobaixa']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idusuariobaixa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idlancamentoreceitarecorrente
      $this->field_config['idlancamentoreceitarecorrente']               = array();
      $this->field_config['idlancamentoreceitarecorrente']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idlancamentoreceitarecorrente']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idlancamentoreceitarecorrente']['symbol_dec'] = '';
      $this->field_config['idlancamentoreceitarecorrente']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idlancamentoreceitarecorrente']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idtipoagente
      $this->field_config['idtipoagente']               = array();
      $this->field_config['idtipoagente']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idtipoagente']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idtipoagente']['symbol_dec'] = '';
      $this->field_config['idtipoagente']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idtipoagente']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- parcela
      $this->field_config['parcela']               = array();
      $this->field_config['parcela']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['parcela']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['parcela']['symbol_dec'] = '';
      $this->field_config['parcela']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['parcela']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- datainclusao
      $this->field_config['datainclusao']                 = array();
      $this->field_config['datainclusao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datainclusao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datainclusao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datainclusao']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'datainclusao');
      //-- datarealizacao
      $this->field_config['datarealizacao']                 = array();
      $this->field_config['datarealizacao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datarealizacao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datarealizacao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datarealizacao']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'datarealizacao');
      //-- valoracrescimo
      $this->field_config['valoracrescimo']               = array();
      $this->field_config['valoracrescimo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valoracrescimo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valoracrescimo']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valoracrescimo']['symbol_mon'] = '';
      $this->field_config['valoracrescimo']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valoracrescimo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valordesconto
      $this->field_config['valordesconto']               = array();
      $this->field_config['valordesconto']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valordesconto']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valordesconto']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valordesconto']['symbol_mon'] = '';
      $this->field_config['valordesconto']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valordesconto']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valormulta
      $this->field_config['valormulta']               = array();
      $this->field_config['valormulta']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valormulta']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valormulta']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valormulta']['symbol_mon'] = '';
      $this->field_config['valormulta']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valormulta']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorjuros
      $this->field_config['valorjuros']               = array();
      $this->field_config['valorjuros']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorjuros']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorjuros']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorjuros']['symbol_mon'] = '';
      $this->field_config['valorjuros']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorjuros']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorrealizacao
      $this->field_config['valorrealizacao']               = array();
      $this->field_config['valorrealizacao']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorrealizacao']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorrealizacao']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorrealizacao']['symbol_mon'] = '';
      $this->field_config['valorrealizacao']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorrealizacao']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- databaixa
      $this->field_config['databaixa']                 = array();
      $this->field_config['databaixa']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['databaixa']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['databaixa']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['databaixa']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'databaixa');
      //-- datacompetencia
      $this->field_config['datacompetencia']                 = array();
      $this->field_config['datacompetencia']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['datacompetencia']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datacompetencia']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'datacompetencia');
      //-- nossonumero
      $this->field_config['nossonumero']               = array();
      $this->field_config['nossonumero']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['nossonumero']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['nossonumero']['symbol_dec'] = '';
      $this->field_config['nossonumero']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['nossonumero']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- valororiginal
      $this->field_config['valororiginal']               = array();
      $this->field_config['valororiginal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valororiginal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valororiginal']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valororiginal']['symbol_mon'] = '';
      $this->field_config['valororiginal']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valororiginal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
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
      if ($this->nmgp_opcao == "incluir") {
          $this->idfornecedor = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idfornecedor'];
      if ('' !== $this->idfornecedor || (!empty($format_fields) && isset($format_fields['idfornecedor'])))
      {
          nmgp_Form_Num_Val($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp'], $this->field_config['idfornecedor']['symbol_dec'], "0", "S", $this->field_config['idfornecedor']['format_neg'], "", "", "-", $this->field_config['idfornecedor']['symbol_fmt']) ; 
      }
          $this->idplanoconta = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idplanoconta'];
      if ('' !== $this->idplanoconta || (!empty($format_fields) && isset($format_fields['idplanoconta'])))
      {
          nmgp_Form_Num_Val($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp'], $this->field_config['idplanoconta']['symbol_dec'], "0", "S", $this->field_config['idplanoconta']['format_neg'], "", "", "-", $this->field_config['idplanoconta']['symbol_fmt']) ; 
      }
          $this->idcontacaixa = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcontacaixa'];
      if ('' !== $this->idcontacaixa || (!empty($format_fields) && isset($format_fields['idcontacaixa'])))
      {
          nmgp_Form_Num_Val($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp'], $this->field_config['idcontacaixa']['symbol_dec'], "0", "S", $this->field_config['idcontacaixa']['format_neg'], "", "", "-", $this->field_config['idcontacaixa']['symbol_fmt']) ; 
      }
          $this->dataprevisao = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['dataprevisao'];
      if ((!empty($this->dataprevisao) && 'null' != $this->dataprevisao) || (!empty($format_fields) && isset($format_fields['dataprevisao'])))
      {
          nm_volta_data($this->dataprevisao, $this->field_config['dataprevisao']['date_format']) ; 
          nmgp_Form_Datas($this->dataprevisao, $this->field_config['dataprevisao']['date_format'], $this->field_config['dataprevisao']['date_sep']) ;  
      }
      elseif ('null' == $this->dataprevisao || '' == $this->dataprevisao)
      {
          $this->dataprevisao = '';
      }
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->idfornecedor = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idfornecedor'];
      if ('' !== $this->idfornecedor || (!empty($format_fields) && isset($format_fields['idfornecedor'])))
      {
          nmgp_Form_Num_Val($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp'], $this->field_config['idfornecedor']['symbol_dec'], "0", "S", $this->field_config['idfornecedor']['format_neg'], "", "", "-", $this->field_config['idfornecedor']['symbol_fmt']) ; 
      }
          $this->idplanoconta = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idplanoconta'];
      if ('' !== $this->idplanoconta || (!empty($format_fields) && isset($format_fields['idplanoconta'])))
      {
          nmgp_Form_Num_Val($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp'], $this->field_config['idplanoconta']['symbol_dec'], "0", "S", $this->field_config['idplanoconta']['format_neg'], "", "", "-", $this->field_config['idplanoconta']['symbol_fmt']) ; 
      }
          $this->idcontacaixa = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcontacaixa'];
      if ('' !== $this->idcontacaixa || (!empty($format_fields) && isset($format_fields['idcontacaixa'])))
      {
          nmgp_Form_Num_Val($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp'], $this->field_config['idcontacaixa']['symbol_dec'], "0", "S", $this->field_config['idcontacaixa']['format_neg'], "", "", "-", $this->field_config['idcontacaixa']['symbol_fmt']) ; 
      }
          $this->dataprevisao = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['dataprevisao'];
      if ((!empty($this->dataprevisao) && 'null' != $this->dataprevisao) || (!empty($format_fields) && isset($format_fields['dataprevisao'])))
      {
          nm_volta_data($this->dataprevisao, $this->field_config['dataprevisao']['date_format']) ; 
          nmgp_Form_Datas($this->dataprevisao, $this->field_config['dataprevisao']['date_format'], $this->field_config['dataprevisao']['date_sep']) ;  
      }
      elseif ('null' == $this->dataprevisao || '' == $this->dataprevisao)
      {
          $this->dataprevisao = '';
      }
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_idcliente' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcliente');
          }
          if ('validate_idcolaborador' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcolaborador');
          }
          if ('validate_idfornecedor' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idfornecedor');
          }
          if ('validate_idplanoconta' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanoconta');
          }
          if ('validate_idcontacaixa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcontacaixa');
          }
          if ('validate_idempresa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idempresa');
          }
          if ('validate_dataprevisao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dataprevisao');
          }
          if ('validate_valorprevisao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorprevisao');
          }
          if ('validate_tiporecorrencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tiporecorrencia');
          }
          if ('validate_qtdrecorrencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qtdrecorrencia');
          }
          if ('validate_recorrentetemp' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'recorrentetemp');
          }
          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_qtdrecorrencia_onchange' == $this->NM_ajax_opcao)
          {
              $this->QtdRecorrencia_onChange();
          }
          if ('event_tiporecorrencia_onclick' == $this->NM_ajax_opcao)
          {
              $this->TipoRecorrencia_onClick();
          }
          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('autocomp_idcliente' == $this->NM_ajax_opcao)
          {
              if (isset($_GET['term'])) {
                  $this->idcliente = ($_SESSION['scriptcase']['charset'] != "UTF-8") ? NM_utf8_decode(sc_convert_encoding($_GET['term'], $_SESSION['scriptcase']['charset'], 'UTF-8')) : $_GET['term'];
              } else {
                  $this->idcliente = '';
              }
if ($this->idcliente != "")
{ 
   $this->nm_clear_val("idcliente");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcliente");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdCliente, NomeFantasia FROM cliente WHERE (IdCliente = '$this->idcliente') AND #upperI#NomeFantasia#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idcliente)), 1, -1) . "%'";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente'][] = $rs->fields[0];
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
              $AjaxLim = 0;
              $aResponse = array();
              foreach ($aLookup as $sLkpIndex => $aLkpList)
              {
                  $AjaxLim++;
                  if ($AjaxLim > 10)
                  {
                      break;
                  }
                  foreach ($aLkpList as $sLkpIndex => $sLkpValue)
                  {
                      $sLkpIndex = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpIndex);
                      $sLkpValue = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpValue);
                      $aResponse[] = array('label' => $sLkpValue, 'value' => $sLkpIndex);
                  }
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($aResponse);
              exit;
          }
          if ('autocomp_idcontacaixa' == $this->NM_ajax_opcao)
          {
              if (isset($_GET['term'])) {
                  $this->idcontacaixa = ($_SESSION['scriptcase']['charset'] != "UTF-8") ? NM_utf8_decode(sc_convert_encoding($_GET['term'], $_SESSION['scriptcase']['charset'], 'UTF-8')) : $_GET['term'];
              } else {
                  $this->idcontacaixa = '';
              }
if ($this->idcontacaixa != "")
{ 
   $this->nm_clear_val("idcontacaixa");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcontacaixa");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdContaCaixa, Descricao FROM contacaixa WHERE (IdContaCaixa = $this->idcontacaixa) AND #upperI#Descricao#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idcontacaixa)), 1, -1) . "%' ORDER BY IdContaCaixa";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa'][] = $rs->fields[0];
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
              $AjaxLim = 0;
              $aResponse = array();
              foreach ($aLookup as $sLkpIndex => $aLkpList)
              {
                  $AjaxLim++;
                  if ($AjaxLim > 10)
                  {
                      break;
                  }
                  foreach ($aLkpList as $sLkpIndex => $sLkpValue)
                  {
                      $sLkpIndex = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpIndex);
                      $sLkpValue = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpValue);
                      $aResponse[] = array('label' => $sLkpValue, 'value' => $sLkpIndex);
                  }
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($aResponse);
              exit;
          }
          if ('autocomp_idplanoconta' == $this->NM_ajax_opcao)
          {
              if (isset($_GET['term'])) {
                  $this->idplanoconta = ($_SESSION['scriptcase']['charset'] != "UTF-8") ? NM_utf8_decode(sc_convert_encoding($_GET['term'], $_SESSION['scriptcase']['charset'], 'UTF-8')) : $_GET['term'];
              } else {
                  $this->idplanoconta = '';
              }
if ($this->idplanoconta != "")
{ 
   $this->nm_clear_val("idplanoconta");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idplanoconta");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdPlanoConta, Descricao FROM planoconta WHERE (IdPlanoConta = '$this->idplanoconta') AND #upperI#Descricao#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idplanoconta)), 1, -1) . "%' ORDER BY IdPlanoConta";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta'][] = $rs->fields[0];
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
              $AjaxLim = 0;
              $aResponse = array();
              foreach ($aLookup as $sLkpIndex => $aLkpList)
              {
                  $AjaxLim++;
                  if ($AjaxLim > 10)
                  {
                      break;
                  }
                  foreach ($aLkpList as $sLkpIndex => $sLkpValue)
                  {
                      $sLkpIndex = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpIndex);
                      $sLkpValue = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpValue);
                      $aResponse[] = array('label' => $sLkpValue, 'value' => $sLkpIndex);
                  }
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($aResponse);
              exit;
          }
          if ('autocomp_idempresa' == $this->NM_ajax_opcao)
          {
              if (isset($_GET['term'])) {
                  $this->idempresa = ($_SESSION['scriptcase']['charset'] != "UTF-8") ? NM_utf8_decode(sc_convert_encoding($_GET['term'], $_SESSION['scriptcase']['charset'], 'UTF-8')) : $_GET['term'];
              } else {
                  $this->idempresa = '';
              }
if ($this->idempresa != "")
{ 
   $this->nm_clear_val("idempresa");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idempresa");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdEmpresa, NomeFantasia FROM empresa WHERE (IdEmpresa = $this->idempresa) AND #upperI#NomeFantasia#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idempresa)), 1, -1) . "%' ORDER BY IdEmpresa";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa'][] = $rs->fields[0];
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
              $AjaxLim = 0;
              $aResponse = array();
              foreach ($aLookup as $sLkpIndex => $aLkpList)
              {
                  $AjaxLim++;
                  if ($AjaxLim > 10)
                  {
                      break;
                  }
                  foreach ($aLkpList as $sLkpIndex => $sLkpValue)
                  {
                      $sLkpIndex = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpIndex);
                      $sLkpValue = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpValue);
                      $aResponse[] = array('label' => $sLkpValue, 'value' => $sLkpIndex);
                  }
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($aResponse);
              exit;
          }
          if ('autocomp_idfornecedor' == $this->NM_ajax_opcao)
          {
              if (isset($_GET['term'])) {
                  $this->idfornecedor = ($_SESSION['scriptcase']['charset'] != "UTF-8") ? NM_utf8_decode(sc_convert_encoding($_GET['term'], $_SESSION['scriptcase']['charset'], 'UTF-8')) : $_GET['term'];
              } else {
                  $this->idfornecedor = '';
              }
if ($this->idfornecedor != "")
{ 
   $this->nm_clear_val("idfornecedor");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idfornecedor");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdFornecedor, NomeFantasia FROM fornecedor WHERE (IdFornecedor = '$this->idfornecedor') AND #upperI#NomeFantasia#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idfornecedor)), 1, -1) . "%'";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor'][] = $rs->fields[0];
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
              $AjaxLim = 0;
              $aResponse = array();
              foreach ($aLookup as $sLkpIndex => $aLkpList)
              {
                  $AjaxLim++;
                  if ($AjaxLim > 10)
                  {
                      break;
                  }
                  foreach ($aLkpList as $sLkpIndex => $sLkpValue)
                  {
                      $sLkpIndex = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpIndex);
                      $sLkpValue = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpValue);
                      $aResponse[] = array('label' => $sLkpValue, 'value' => $sLkpIndex);
                  }
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($aResponse);
              exit;
          }
          if ('autocomp_idcolaborador' == $this->NM_ajax_opcao)
          {
              if (isset($_GET['term'])) {
                  $this->idcolaborador = ($_SESSION['scriptcase']['charset'] != "UTF-8") ? NM_utf8_decode(sc_convert_encoding($_GET['term'], $_SESSION['scriptcase']['charset'], 'UTF-8')) : $_GET['term'];
              } else {
                  $this->idcolaborador = '';
              }
if ($this->idcolaborador != "")
{ 
   $this->nm_clear_val("idcolaborador");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcolaborador");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdColaborador, Nome FROM colaborador WHERE (IdColaborador = '$this->idcolaborador') AND #upperI#Nome#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idcolaborador)), 1, -1) . "%'";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador'][] = $rs->fields[0];
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
              $AjaxLim = 0;
              $aResponse = array();
              foreach ($aLookup as $sLkpIndex => $aLkpList)
              {
                  $AjaxLim++;
                  if ($AjaxLim > 10)
                  {
                      break;
                  }
                  foreach ($aLkpList as $sLkpIndex => $sLkpValue)
                  {
                      $sLkpIndex = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpIndex);
                      $sLkpValue = str_replace(array("\r", "\n"), array('', '<br />'), $sLkpValue);
                      $aResponse[] = array('label' => $sLkpValue, 'value' => $sLkpIndex);
                  }
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($aResponse);
              exit;
          }
          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['idfornecedor']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idfornecedor = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['idfornecedor'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['idplanoconta']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idplanoconta = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['idplanoconta'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['idcontacaixa']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idcontacaixa = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['idcontacaixa'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['dataprevisao']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->dataprevisao = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select']['dataprevisao'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
          $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_redir_atualiz'] == "ok")
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
          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "LancamentoReceita_Recorrente_Frm.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Geração de recorrências de contas a receber (receitas)") ?></TITLE>
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
<form name="Fdown" method="get" action="LancamentoReceita_Recorrente_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="LancamentoReceita_Recorrente_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="LancamentoReceita_Recorrente_Frm.php" target="_self" style="display: none"> 
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
   function sc_btn_GerarRecorrencia() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("LancamentoReceita_Recorrente_Frm_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $varloc_btn_php = array();
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->tiporecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia']))
          {
              $varloc_btn_php['tiporecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia'];
          }
          if (!isset($this->qtdrecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia']))
          {
              $varloc_btn_php['qtdrecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia'];
          }
          if (!isset($this->tiporecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia']))
          {
              $varloc_btn_php['tiporecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia'];
          }
          if (!isset($this->qtdrecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia']))
          {
              $varloc_btn_php['qtdrecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia'];
          }
          if (!isset($this->idlancamentoreceita) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita']))
          {
              $varloc_btn_php['idlancamentoreceita'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados_erro) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados_erro']))
          {
              $varloc_btn_php['meus_dados_erro'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados_erro'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->idlancamentoreceita) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita']))
          {
              $varloc_btn_php['idlancamentoreceita'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->meus_dados) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados']))
          {
              $varloc_btn_php['meus_dados'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['meus_dados'];
          }
          if (!isset($this->idlancamentoreceita) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita']))
          {
              $varloc_btn_php['idlancamentoreceita'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita'];
          }
          if (!isset($this->idlancamentoreceita) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita']))
          {
              $varloc_btn_php['idlancamentoreceita'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita'];
          }
      }
      if (!isset($_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]) || empty($_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]))
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = "LancamentoReceita_Recorrente_Frm.php";
      }
      $nm_f_saida = "LancamentoReceita_Recorrente_Frm_fim.php";
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_f_saida = $_SESSION['scriptcase']['nm_sc_retorno'];
      } 
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idcolaborador, $this->field_config['idcolaborador']['symbol_grp']) ; 
      nm_limpa_numero($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp']) ; 
      nm_limpa_numero($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp']) ; 
      nm_limpa_numero($this->idempresa, $this->field_config['idempresa']['symbol_grp']) ; 
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      if (!empty($this->field_config['valorprevisao']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp'], $this->field_config['valorprevisao']['symbol_mon']); 
          nm_limpa_valor($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->qtdrecorrencia, $this->field_config['qtdrecorrencia']['symbol_grp']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varQtdRecorrencia)) {$this->sc_temp_varQtdRecorrencia = (isset($_SESSION['varQtdRecorrencia'])) ? $_SESSION['varQtdRecorrencia'] : "";}
if (!isset($this->sc_temp_varTipoRecorrencia)) {$this->sc_temp_varTipoRecorrencia = (isset($_SESSION['varTipoRecorrencia'])) ? $_SESSION['varTipoRecorrencia'] : "";}
if (!isset($this->sc_temp_varAcao)) {$this->sc_temp_varAcao = (isset($_SESSION['varAcao'])) ? $_SESSION['varAcao'] : "";}
  $this->sc_temp_varAcao = 2;
$msg= '';
if (empty($this->tiporecorrencia )) {
	$msg = $msg . '<Campo obrigatório: Recorrência';
}
if (empty($this->qtdrecorrencia )) {
	$msg = $msg . 'Campo obrigatório: Quantidade';
}

if ($msg != '') {
	$this->sc_temp_varTipoRecorrencia = $this->tiporecorrencia ;
	$this->sc_temp_varQtdRecorrencia = $this->qtdrecorrencia ;
	} else {
	$sql = "SELECT IdTenacidade, IdFornecedor, IdContaCaixa, IdPlanoConta, IdEmpresa, IdLancamentoReceita, DataPrevisao, ValorPrevisao, DataCompetencia, IdTipoAgente, IdCliente, IdColaborador, Parcela, IdSituacaoDocumento FROM _lancamentoreceitarecorrente WHERE IdLancamentoReceita = '$this->idlancamentoreceita'";
	 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->meus_dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Db->ErrorMsg();
      } 

	if ( $this->meus_dados  === false ) {
	  	$msg = $msg . "Erro de acesso. Mensagem = " . $this->meus_dados_erro ;
	} else {
		$enderecoIP = $_SERVER['REMOTE_ADDR'];
		$nomeAplicacao = $this->Ini->nm_cod_apl;
		$dataInclusao = date('Y-m-d H:i:s');
		while ( !$this->meus_dados->EOF ) {
			$IdTenacidade 			= $this->meus_dados->fields[0];
			$IdFornecedor 			= $this->meus_dados->fields[1];
			$IdContaCaixa 			= $this->meus_dados->fields[2];
			$IdPlanoConta 			= $this->meus_dados->fields[3];
			$IdEmpresa 				= $this->meus_dados->fields[4];
			$IdLancamentoReceita 	= $this->meus_dados->fields[5];
			$DataPrevisao 			= $this->meus_dados->fields[6];
			$ValorPrevisao 			= $this->meus_dados->fields[7];
			$DataCompetencia 		= $this->meus_dados->fields[8];
			$IdTipoAgente	 		= $this->meus_dados->fields[9];
			$IdCliente		 		= $this->meus_dados->fields[10];
			$IdColaborador	 		= $this->meus_dados->fields[11];
			$Parcela	 			= $this->meus_dados->fields[12];
			$IdSituacaoDocumento	= $this->meus_dados->fields[13];

			if (empty($IdFornecedor)) {
				$IdFornecedor = 'NULL';
			}
			if (empty($IdCliente)) {
				$IdCliente = 'NULL';
			}
			if (empty($IdColaborador)) {
				$IdColaborador = 'NULL';
			}
			
			$insert_table  = 'lancamentoreceita';
			$insert_fields = array(
				 'IdTenacidade' 					=> "'$IdTenacidade'",
				 'IdFornecedor' 					=> "$IdFornecedor",
				 'IdContaCaixa' 					=> "'$IdContaCaixa'",
				 'IdPlanoConta' 					=> "'$IdPlanoConta'",
				 'IdEmpresa' 						=> "'$IdEmpresa'",
				 'IdLancamentoReceitaRecorrente'	=> "'$this->idlancamentoreceita'",
				 'IdUsuarioPrevisao'				=> "'$this->sc_temp_varIdUsuario'",
				 'DataPrevisao' 					=> "'$DataPrevisao'",
				 'ValorPrevisao'					=> "'$ValorPrevisao'",
				 'DataCompetencia' 					=> "'$DataCompetencia'",
				 'IdTipoAgente' 					=> "'$IdTipoAgente'",
				 'IdCliente' 						=> "$IdCliente",
				 'IdColaborador' 					=> "$IdColaborador",
				 'IdSituacaoDocumento' 				=> "$IdSituacaoDocumento",
				 'Parcela' 							=> "'$Parcela'",
				 'IdUsuarioInclusao' 				=> "'$this->sc_temp_varIdUsuario'",
				 'DataInclusao' 					=> "'$dataInclusao'",
				 'IdUsuarioAuditoria' 				=> "'$this->sc_temp_varIdUsuario'",
				 'EnderecoIpAuditoria' 				=> "'$enderecoIP'",
				 'NomeAplicacaoAuditoria' 			=> "'$nomeAplicacao'",
			 );
			$insert_sql = 'INSERT INTO ' . $insert_table
				. ' ('   . implode(', ', array_keys($insert_fields))   . ')'
				. ' VALUES ('    . implode(', ', array_values($insert_fields)) . ')';

			
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
			$this->meus_dados->MoveNext();
		}
		$this->meus_dados->Close();

		$update_table  = 'lancamentoreceita';
		$update_where  = "IdLancamentoReceita = '$this->idlancamentoreceita'";
		$update_fields = array(
			 "IdLancamentoReceitaRecorrente = '$this->idlancamentoreceita'",
			 "Parcela 						= '1'",
			 "IdUsuarioAuditoria 			= '$this->sc_temp_varIdUsuario'",
			 "EnderecoIpAuditoria 			= '$enderecoIP'",
			 "NomeAplicacaoAuditoria 		= '$nomeAplicacao'",
		 );

		$update_sql = 'UPDATE ' . $update_table
			. ' SET '   . implode(', ', $update_fields)
			. ' WHERE ' . $update_where;
		
     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      		
		
		}	
}
if (isset($this->sc_temp_varAcao)) { $_SESSION['varAcao'] = $this->sc_temp_varAcao;}
if (isset($this->sc_temp_varTipoRecorrencia)) { $_SESSION['varTipoRecorrencia'] = $this->sc_temp_varTipoRecorrencia;}
if (isset($this->sc_temp_varQtdRecorrencia)) { $_SESSION['varQtdRecorrencia'] = $this->sc_temp_varQtdRecorrencia;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idlancamentoreceita" value="<?php echo $this->form_encode_input($this->idlancamentoreceita) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      </form>
      <script type="text/javascript">
          document.FPHP.submit();
      </script>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
       }
   }
   function sc_btn_GerarSimulacao() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("LancamentoReceita_Recorrente_Frm_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $varloc_btn_php = array();
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->tiporecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia']))
          {
              $varloc_btn_php['tiporecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia'];
          }
          if (!isset($this->qtdrecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia']))
          {
              $varloc_btn_php['qtdrecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia'];
          }
          if (!isset($this->qtdrecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia']))
          {
              $varloc_btn_php['qtdrecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia'];
          }
          if (!isset($this->tiporecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia']))
          {
              $varloc_btn_php['tiporecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia'];
          }
          if (!isset($this->qtdrecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia']))
          {
              $varloc_btn_php['qtdrecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia'];
          }
          if (!isset($this->dataprevisao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['dataprevisao']))
          {
              $varloc_btn_php['dataprevisao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['dataprevisao'];
          }
          if (!isset($this->dataprevisao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['dataprevisao']))
          {
              $varloc_btn_php['dataprevisao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['dataprevisao'];
          }
          if (!isset($this->idfornecedor) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idfornecedor']))
          {
              $varloc_btn_php['idfornecedor'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idfornecedor'];
          }
          if (!isset($this->idfornecedor) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idfornecedor']))
          {
              $varloc_btn_php['idfornecedor'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idfornecedor'];
          }
          if (!isset($this->idcliente) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcliente']))
          {
              $varloc_btn_php['idcliente'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcliente'];
          }
          if (!isset($this->idcliente) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcliente']))
          {
              $varloc_btn_php['idcliente'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcliente'];
          }
          if (!isset($this->idcolaborador) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcolaborador']))
          {
              $varloc_btn_php['idcolaborador'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcolaborador'];
          }
          if (!isset($this->idcolaborador) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcolaborador']))
          {
              $varloc_btn_php['idcolaborador'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcolaborador'];
          }
          if (!isset($this->qtdrecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia']))
          {
              $varloc_btn_php['qtdrecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia'];
          }
          if (!isset($this->tiporecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia']))
          {
              $varloc_btn_php['tiporecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia'];
          }
          if (!isset($this->idcontacaixa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcontacaixa']))
          {
              $varloc_btn_php['idcontacaixa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idcontacaixa'];
          }
          if (!isset($this->idplanoconta) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idplanoconta']))
          {
              $varloc_btn_php['idplanoconta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idplanoconta'];
          }
          if (!isset($this->idempresa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idempresa']))
          {
              $varloc_btn_php['idempresa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idempresa'];
          }
          if (!isset($this->idlancamentoreceita) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita']))
          {
              $varloc_btn_php['idlancamentoreceita'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idlancamentoreceita'];
          }
          if (!isset($this->idtipoagente) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idtipoagente']))
          {
              $varloc_btn_php['idtipoagente'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['idtipoagente'];
          }
          if (!isset($this->datainclusao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['datainclusao']))
          {
              $varloc_btn_php['datainclusao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['datainclusao'];
          }
          if (!isset($this->valorprevisao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['valorprevisao']))
          {
              $varloc_btn_php['valorprevisao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['valorprevisao'];
          }
          if (!isset($this->historico) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['historico']))
          {
              $varloc_btn_php['historico'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['historico'];
          }
          if (!isset($this->tiporecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia']))
          {
              $varloc_btn_php['tiporecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['tiporecorrencia'];
          }
          if (!isset($this->qtdrecorrencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia']))
          {
              $varloc_btn_php['qtdrecorrencia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form']['qtdrecorrencia'];
          }
      }
      $nm_f_saida = "LancamentoReceita_Recorrente_Frm.php";
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idcolaborador, $this->field_config['idcolaborador']['symbol_grp']) ; 
      nm_limpa_numero($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp']) ; 
      nm_limpa_numero($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp']) ; 
      nm_limpa_numero($this->idempresa, $this->field_config['idempresa']['symbol_grp']) ; 
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      if (!empty($this->field_config['valorprevisao']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp'], $this->field_config['valorprevisao']['symbol_mon']); 
          nm_limpa_valor($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->qtdrecorrencia, $this->field_config['qtdrecorrencia']['symbol_grp']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) {$this->sc_temp_varIdSituacaoDocumentoPendenteInt = (isset($_SESSION['varIdSituacaoDocumentoPendenteInt'])) ? $_SESSION['varIdSituacaoDocumentoPendenteInt'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varToken)) {$this->sc_temp_varToken = (isset($_SESSION['varToken'])) ? $_SESSION['varToken'] : "";}
if (!isset($this->sc_temp_varQtdRecorrencia)) {$this->sc_temp_varQtdRecorrencia = (isset($_SESSION['varQtdRecorrencia'])) ? $_SESSION['varQtdRecorrencia'] : "";}
if (!isset($this->sc_temp_varTipoRecorrencia)) {$this->sc_temp_varTipoRecorrencia = (isset($_SESSION['varTipoRecorrencia'])) ? $_SESSION['varTipoRecorrencia'] : "";}
if (!isset($this->sc_temp_varAcao)) {$this->sc_temp_varAcao = (isset($_SESSION['varAcao'])) ? $_SESSION['varAcao'] : "";}
  $this->sc_temp_varAcao = 1;
$msg= '';

if (empty($this->tiporecorrencia )) {
	$msg = $msg . 'Campo obrigatório: Recorrência</br>';
}

if (empty($this->qtdrecorrencia )) {
	$msg = $msg . 'Campo obrigatório: Quantidade</br>';
} elseif ($this->qtdrecorrencia  < 2) {
	$msg = $msg . 'Campo Quantidade deve ser maior ou igual a 2</br>';
}
if ($msg != '') {
	$this->sc_temp_varTipoRecorrencia = $this->tiporecorrencia ;
	$this->sc_temp_varQtdRecorrencia = $this->qtdrecorrencia ;
	$delete_table  = '_lancamentoreceitarecorrente';
	$delete_where  = "Token = '$this->sc_temp_varToken'";
	$delete_sql = 'DELETE FROM ' . $delete_table
		. ' WHERE '      . $delete_where;
	
     $nm_select = $delete_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	} else {

	$delete_table  = '_lancamentoreceitarecorrente';
	$delete_where  = "Token = '$this->sc_temp_varToken'";
	$delete_sql = 'DELETE FROM ' . $delete_table
		. ' WHERE '      . $delete_where;
	
     $nm_select = $delete_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	
	$dataRecorrencia = substr($this->dataprevisao , 0, 10);
	$dataRecorrencia = $this->dataprevisao ;

	$vetUltimoDia = array();
	$vetUltimoDia[1] = 31;
	$vetUltimoDia[2] = 28;
	$vetUltimoDia[3] = 31;
	$vetUltimoDia[4] = 30;
	$vetUltimoDia[5] = 31;
	$vetUltimoDia[6] = 30;
	$vetUltimoDia[7] = 31;
	$vetUltimoDia[8] = 31;
	$vetUltimoDia[9] = 30;
	$vetUltimoDia[10] = 31;
	$vetUltimoDia[11] = 30;
	$vetUltimoDia[12] = 31;
	$anoAtual = substr($dataRecorrencia, 0, 4);
	if($anoAtual % 4 == 0) {
		$vetUltimoDia[2] = 29;	
	}
	$diaPrevisao = substr($dataRecorrencia, 8, 2);
	$mesPrevisao = (int) substr($dataRecorrencia, 5, 2);
	$ultimoDia = 0;
	if ($diaPrevisao == $vetUltimoDia[$mesPrevisao]) {
		$ultimoDia = 1;	
	}
	$sql = '';
	$this->sc_temp_varToken = uniqid();

	if (empty($this->idfornecedor )) {
		$idFornecedor = 'NULL';
	} else {
		$idFornecedor = $this->idfornecedor ;
	}
	if (empty($this->idcliente )) {
		$idCliente = 'NULL';
	} else {
		$idCliente = $this->idcliente ;
	}
	if (empty($this->idcolaborador )) {
		$idColaborador = 'NULL';
	} else {
		$idColaborador = $this->idcolaborador ;
	}
	for ($i = 2; $i <= $this->qtdrecorrencia ; $i++) {
		switch ($this->tiporecorrencia ) {
			case 1: 
				$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 15, 0, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
				break;
			case 2:  
				$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 1, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
				break;
			case 3: 
				$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 2, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
				break;
			case 4:
				$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 3, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
				break;
			case 5: 
				$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 6, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
				break;
			case 6: 
				$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 0, 1, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
				break;
		}
		$diaRecorrencia = substr($dataRecorrencia, 8);
		$anoRecorrencia = substr($dataRecorrencia, 0, 4);
		if($anoRecorrencia % 4 == 0) {
			$vetUltimoDia[2] = 29;	
		}
		$diaRecorrencia = substr($dataRecorrencia, 8, 2);
		$mesRecorrencia = (int) substr($dataRecorrencia, 5, 2);

		if ($ultimoDia == 1) {
			$dataRecorrencia = substr($dataRecorrencia, 0, 8) . $vetUltimoDia[$mesRecorrencia];
		}
		$dataCompetencia = substr($dataRecorrencia, 0, 8) . '01';
		$insert_table  = '_lancamentoreceitarecorrente';
		$insert_fields = array( 
			 'IdTenacidade' 					=> "'$this->sc_temp_varIdTenacidade'",
			 'IdFornecedor' 					=> "$idFornecedor",
			 'IdContaCaixa' 					=> "'$this->idcontacaixa'",
			 'IdPlanoConta' 					=> "'$this->idplanoconta'",
			 'IdEmpresa' 						=> "'$this->idempresa'",
			 'IdLancamentoReceita'				=> "'$this->idlancamentoreceita'",
			 'IdTipoAgente'						=> "'$this->idtipoagente'",
			 'IdCliente' 						=> "$idCliente",
			 'IdColaborador	' 					=> "$idColaborador",
			 'Token' 							=> "'$this->sc_temp_varToken'",
			 'Parcela' 							=> "'$i'",
			 'DataInclusao' 					=> "'$this->datainclusao'",
			 'DataPrevisao' 					=> "'$dataRecorrencia'",
			 'ValorPrevisao'					=> "$this->valorprevisao ",
			 'DataCompetencia' 					=> "'$dataCompetencia'",
			 'Historico' 						=> "'$this->historico'",
			 'IdSituacaoDocumento'				=> "'$this->sc_temp_varIdSituacaoDocumentoPendenteInt'",
		);
		$insert_sql = 'INSERT INTO ' . $insert_table
			. ' ('   . implode(', ', array_keys($insert_fields))   . ')'
			. ' VALUES ('    . implode(', ', array_values($insert_fields)) . ')';
		
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
				
	}
}

if ($msg == '') {
	 if (isset($this->sc_temp_varAcao)) { $_SESSION['varAcao'] = $this->sc_temp_varAcao;}
 if (isset($this->sc_temp_varTipoRecorrencia)) { $_SESSION['varTipoRecorrencia'] = $this->sc_temp_varTipoRecorrencia;}
 if (isset($this->sc_temp_varQtdRecorrencia)) { $_SESSION['varQtdRecorrencia'] = $this->sc_temp_varQtdRecorrencia;}
 if (isset($this->sc_temp_varToken)) { $_SESSION['varToken'] = $this->sc_temp_varToken;}
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('LancamentoReceita_Recorrente_Frm') . "/LancamentoReceita_Recorrente_Frm.php", $this->nm_location, "varTipoRecorrencia?#?" . NM_encode_input($this->tiporecorrencia ) . "?@?" . "varQtdRecorrencia?#?" . NM_encode_input($this->qtdrecorrencia ) . "?@?" . "varAcao?#?" . NM_encode_input("2") . "?@?","_self", '', 440, 630);
 };
}
if (isset($this->sc_temp_varAcao)) { $_SESSION['varAcao'] = $this->sc_temp_varAcao;}
if (isset($this->sc_temp_varTipoRecorrencia)) { $_SESSION['varTipoRecorrencia'] = $this->sc_temp_varTipoRecorrencia;}
if (isset($this->sc_temp_varQtdRecorrencia)) { $_SESSION['varQtdRecorrencia'] = $this->sc_temp_varQtdRecorrencia;}
if (isset($this->sc_temp_varToken)) { $_SESSION['varToken'] = $this->sc_temp_varToken;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idcliente" value="<?php echo $this->form_encode_input($this->idcliente) ?>"/>
      <input type=hidden name="idcolaborador" value="<?php echo $this->form_encode_input($this->idcolaborador) ?>"/>
      <input type=hidden name="idfornecedor" value="<?php echo $this->form_encode_input($this->idfornecedor) ?>"/>
      <input type=hidden name="idplanoconta" value="<?php echo $this->form_encode_input($this->idplanoconta) ?>"/>
      <input type=hidden name="idcontacaixa" value="<?php echo $this->form_encode_input($this->idcontacaixa) ?>"/>
      <input type=hidden name="idempresa" value="<?php echo $this->form_encode_input($this->idempresa) ?>"/>
      <input type=hidden name="dataprevisao" value="<?php echo $this->form_encode_input($this->dataprevisao) ?>"/>
      <input type=hidden name="valorprevisao" value="<?php echo $this->form_encode_input($this->valorprevisao) ?>"/>
      <input type=hidden name="tiporecorrencia" value="<?php echo $this->form_encode_input($this->tiporecorrencia) ?>"/>
      <input type=hidden name="qtdrecorrencia" value="<?php echo $this->form_encode_input($this->qtdrecorrencia) ?>"/>
      <input type=hidden name="recorrentetemp" value="<?php echo $this->form_encode_input($this->recorrentetemp) ?>"/>
      <input type=hidden name="nmgp_opcao" value="igual"/>
      </form>
      <script type="text/javascript">
          document.FPHP.submit();
      </script>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
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
           case 'idcliente':
               return "Cliente";
               break;
           case 'idcolaborador':
               return "Colaborador";
               break;
           case 'idfornecedor':
               return "Fornecedor";
               break;
           case 'idplanoconta':
               return "Plano de Contas";
               break;
           case 'idcontacaixa':
               return "Conta Caixa";
               break;
           case 'idempresa':
               return "Empresa";
               break;
           case 'dataprevisao':
               return "Previsão";
               break;
           case 'valorprevisao':
               return "Vr. previsto";
               break;
           case 'tiporecorrencia':
               return "Recorrência*";
               break;
           case 'qtdrecorrencia':
               return "Quantidade* ";
               break;
           case 'recorrentetemp':
               return "RecorrenteTemp";
               break;
           case 'idlancamentoreceita':
               return "Id Lancamento Receita";
               break;
           case 'idtenacidade':
               return "Id Tenacidade";
               break;
           case 'idsituacaodocumento':
               return "Id Situacao Documento";
               break;
           case 'idtipoespecie':
               return "Id Tipo Especie";
               break;
           case 'idnotafiscal':
               return "Id Nota Fiscal";
               break;
           case 'idcontacaixaregistro':
               return "Id Conta Caixa Registro";
               break;
           case 'idlancamentoreceitapai':
               return "Id Lancamento Receita Pai";
               break;
           case 'idcontacaixatransferencia':
               return "Id Conta Caixa Transferencia";
               break;
           case 'idcontrato':
               return "Id Contrato";
               break;
           case 'idusuarioinclusao':
               return "Id Usuario Inclusao";
               break;
           case 'idusuarioprevisao':
               return "Id Usuario Previsao";
               break;
           case 'idusuariorealizacao':
               return "Id Usuario Realizacao";
               break;
           case 'idusuariobaixa':
               return "Idusuario Baixa";
               break;
           case 'idlancamentoreceitarecorrente':
               return "Id Lancamento Receita Recorrente";
               break;
           case 'idtipoagente':
               return "Id Tipo Agente";
               break;
           case 'idusuarioauditoria':
               return "Id Usuario Auditoria";
               break;
           case 'parcela':
               return "Parcela";
               break;
           case 'datainclusao':
               return "Data Inclusao";
               break;
           case 'datarealizacao':
               return "Data Realizacao";
               break;
           case 'valoracrescimo':
               return "Valor Acrescimo";
               break;
           case 'valordesconto':
               return "Valor Desconto";
               break;
           case 'valormulta':
               return "Valor Multa";
               break;
           case 'valorjuros':
               return "Valor Juros";
               break;
           case 'valorrealizacao':
               return "Valor Realizacao";
               break;
           case 'numerodocumento':
               return "Numero Documento";
               break;
           case 'contacontabil':
               return "Conta Contabil";
               break;
           case 'databaixa':
               return "Data Baixa";
               break;
           case 'datacompetencia':
               return "Data Competencia";
               break;
           case 'historico':
               return "Histórico";
               break;
           case 'nomearquivo1':
               return "Nome Arquivo 1";
               break;
           case 'nomereferencia1':
               return "Nome Referencia 1";
               break;
           case 'nomearquivo2':
               return "Nome Arquivo 2";
               break;
           case 'nomereferencia2':
               return "Nome Referencia 2";
               break;
           case 'observacoes':
               return "Observacoes";
               break;
           case 'nossonumero':
               return "Nosso Numero";
               break;
           case 'valororiginal':
               return "Valor Original";
               break;
           case 'unidadeorigem':
               return "Unidade Origem";
               break;
           case 'enviouemail':
               return "Enviou Email";
               break;
           case 'usuarioexterno':
               return "Usuario Externo";
               break;
           case 'enviouemailcobranca':
               return "Enviou Email Cobranca";
               break;
           case 'lidoemailcobranca':
               return "Lido Email Cobranca";
               break;
           case 'notafiscal':
               return "Nota Fiscal";
               break;
           case 'fechamentofinanceiro':
               return "Fechamento Financeiro";
               break;
           case 'enderecoipauditoria':
               return "Endereco Ip Auditoria";
               break;
           case 'nomeaplicacaoauditoria':
               return "Nome Aplicacao Auditoria";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_LancamentoReceita_Recorrente_Frm']) || !is_array($this->NM_ajax_info['errList']['geral_LancamentoReceita_Recorrente_Frm']))
              {
                  $this->NM_ajax_info['errList']['geral_LancamentoReceita_Recorrente_Frm'] = array();
              }
              $this->NM_ajax_info['errList']['geral_LancamentoReceita_Recorrente_Frm'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'idcliente' == $filtro)) || (is_array($filtro) && in_array('idcliente', $filtro)))
        $this->ValidateField_idcliente($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idcliente";

      if ((!is_array($filtro) && ('' == $filtro || 'idcolaborador' == $filtro)) || (is_array($filtro) && in_array('idcolaborador', $filtro)))
        $this->ValidateField_idcolaborador($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idcolaborador";

      if ((!is_array($filtro) && ('' == $filtro || 'idfornecedor' == $filtro)) || (is_array($filtro) && in_array('idfornecedor', $filtro)))
        $this->ValidateField_idfornecedor($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idfornecedor";

      if ((!is_array($filtro) && ('' == $filtro || 'idplanoconta' == $filtro)) || (is_array($filtro) && in_array('idplanoconta', $filtro)))
        $this->ValidateField_idplanoconta($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idplanoconta";

      if ((!is_array($filtro) && ('' == $filtro || 'idcontacaixa' == $filtro)) || (is_array($filtro) && in_array('idcontacaixa', $filtro)))
        $this->ValidateField_idcontacaixa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idcontacaixa";

      if ((!is_array($filtro) && ('' == $filtro || 'idempresa' == $filtro)) || (is_array($filtro) && in_array('idempresa', $filtro)))
        $this->ValidateField_idempresa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idempresa";

      if ((!is_array($filtro) && ('' == $filtro || 'dataprevisao' == $filtro)) || (is_array($filtro) && in_array('dataprevisao', $filtro)))
        $this->ValidateField_dataprevisao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "dataprevisao";

      if ((!is_array($filtro) && ('' == $filtro || 'valorprevisao' == $filtro)) || (is_array($filtro) && in_array('valorprevisao', $filtro)))
        $this->ValidateField_valorprevisao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "valorprevisao";

      if ((!is_array($filtro) && ('' == $filtro || 'tiporecorrencia' == $filtro)) || (is_array($filtro) && in_array('tiporecorrencia', $filtro)))
        $this->ValidateField_tiporecorrencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tiporecorrencia";

      if ((!is_array($filtro) && ('' == $filtro || 'qtdrecorrencia' == $filtro)) || (is_array($filtro) && in_array('qtdrecorrencia', $filtro)))
        $this->ValidateField_qtdrecorrencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "qtdrecorrencia";

      if ((!is_array($filtro) && ('' == $filtro || 'recorrentetemp' == $filtro)) || (is_array($filtro) && in_array('recorrentetemp', $filtro)))
        $this->ValidateField_recorrentetemp($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "recorrentetemp";

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

    function ValidateField_idcliente(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idcliente'])) {
          nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
          return;
      }
      if ($this->idcliente === "" || is_null($this->idcliente))  
      { 
          $this->idcliente = 0;
          $this->sc_force_zero[] = 'idcliente';
      } 
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idcliente' == $this->NM_ajax_opcao)
      { 
          if ($this->idcliente != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idcliente) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cliente: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idcliente']))
                  {
                      $Campos_Erros['idcliente'] = array();
                  }
                  $Campos_Erros['idcliente'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idcliente']) || !is_array($this->NM_ajax_info['errList']['idcliente']))
                  {
                      $this->NM_ajax_info['errList']['idcliente'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcliente'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idcliente, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cliente; " ; 
                  if (!isset($Campos_Erros['idcliente']))
                  {
                      $Campos_Erros['idcliente'] = array();
                  }
                  $Campos_Erros['idcliente'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idcliente']) || !is_array($this->NM_ajax_info['errList']['idcliente']))
                  {
                      $this->NM_ajax_info['errList']['idcliente'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcliente'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcliente';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcliente

    function ValidateField_idcolaborador(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idcolaborador'])) {
          nm_limpa_numero($this->idcolaborador, $this->field_config['idcolaborador']['symbol_grp']) ; 
          return;
      }
      if ($this->idcolaborador === "" || is_null($this->idcolaborador))  
      { 
          $this->idcolaborador = 0;
          $this->sc_force_zero[] = 'idcolaborador';
      } 
      nm_limpa_numero($this->idcolaborador, $this->field_config['idcolaborador']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idcolaborador' == $this->NM_ajax_opcao)
      { 
          if ($this->idcolaborador != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idcolaborador) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Colaborador: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idcolaborador']))
                  {
                      $Campos_Erros['idcolaborador'] = array();
                  }
                  $Campos_Erros['idcolaborador'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idcolaborador']) || !is_array($this->NM_ajax_info['errList']['idcolaborador']))
                  {
                      $this->NM_ajax_info['errList']['idcolaborador'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcolaborador'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idcolaborador, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Colaborador; " ; 
                  if (!isset($Campos_Erros['idcolaborador']))
                  {
                      $Campos_Erros['idcolaborador'] = array();
                  }
                  $Campos_Erros['idcolaborador'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idcolaborador']) || !is_array($this->NM_ajax_info['errList']['idcolaborador']))
                  {
                      $this->NM_ajax_info['errList']['idcolaborador'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcolaborador'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcolaborador';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcolaborador

    function ValidateField_idfornecedor(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idfornecedor'])) {
          nm_limpa_numero($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp']) ; 
          return;
      }
      if ($this->idfornecedor === "" || is_null($this->idfornecedor))  
      { 
          $this->idfornecedor = 0;
          $this->sc_force_zero[] = 'idfornecedor';
      } 
      nm_limpa_numero($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idfornecedor' == $this->NM_ajax_opcao)
      { 
          if ($this->idfornecedor != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idfornecedor) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idfornecedor']))
                  {
                      $Campos_Erros['idfornecedor'] = array();
                  }
                  $Campos_Erros['idfornecedor'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idfornecedor']) || !is_array($this->NM_ajax_info['errList']['idfornecedor']))
                  {
                      $this->NM_ajax_info['errList']['idfornecedor'] = array();
                  }
                  $this->NM_ajax_info['errList']['idfornecedor'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idfornecedor, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Fornecedor; " ; 
                  if (!isset($Campos_Erros['idfornecedor']))
                  {
                      $Campos_Erros['idfornecedor'] = array();
                  }
                  $Campos_Erros['idfornecedor'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idfornecedor']) || !is_array($this->NM_ajax_info['errList']['idfornecedor']))
                  {
                      $this->NM_ajax_info['errList']['idfornecedor'] = array();
                  }
                  $this->NM_ajax_info['errList']['idfornecedor'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
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

    function ValidateField_idplanoconta(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idplanoconta'])) {
          nm_limpa_numero($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp']) ; 
          return;
      }
      if ($this->idplanoconta === "" || is_null($this->idplanoconta))  
      { 
          $this->idplanoconta = 0;
          $this->sc_force_zero[] = 'idplanoconta';
      } 
      nm_limpa_numero($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idplanoconta' == $this->NM_ajax_opcao)
      { 
          if ($this->idplanoconta != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idplanoconta) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Plano de Contas: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idplanoconta']))
                  {
                      $Campos_Erros['idplanoconta'] = array();
                  }
                  $Campos_Erros['idplanoconta'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idplanoconta']) || !is_array($this->NM_ajax_info['errList']['idplanoconta']))
                  {
                      $this->NM_ajax_info['errList']['idplanoconta'] = array();
                  }
                  $this->NM_ajax_info['errList']['idplanoconta'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idplanoconta, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Plano de Contas; " ; 
                  if (!isset($Campos_Erros['idplanoconta']))
                  {
                      $Campos_Erros['idplanoconta'] = array();
                  }
                  $Campos_Erros['idplanoconta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idplanoconta']) || !is_array($this->NM_ajax_info['errList']['idplanoconta']))
                  {
                      $this->NM_ajax_info['errList']['idplanoconta'] = array();
                  }
                  $this->NM_ajax_info['errList']['idplanoconta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanoconta';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanoconta

    function ValidateField_idcontacaixa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idcontacaixa'])) {
          nm_limpa_numero($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp']) ; 
          return;
      }
      if ($this->idcontacaixa === "" || is_null($this->idcontacaixa))  
      { 
          $this->idcontacaixa = 0;
          $this->sc_force_zero[] = 'idcontacaixa';
      } 
      nm_limpa_numero($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idcontacaixa' == $this->NM_ajax_opcao)
      { 
          if ($this->idcontacaixa != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idcontacaixa) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Conta Caixa: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idcontacaixa']))
                  {
                      $Campos_Erros['idcontacaixa'] = array();
                  }
                  $Campos_Erros['idcontacaixa'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idcontacaixa']) || !is_array($this->NM_ajax_info['errList']['idcontacaixa']))
                  {
                      $this->NM_ajax_info['errList']['idcontacaixa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcontacaixa'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idcontacaixa, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Conta Caixa; " ; 
                  if (!isset($Campos_Erros['idcontacaixa']))
                  {
                      $Campos_Erros['idcontacaixa'] = array();
                  }
                  $Campos_Erros['idcontacaixa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idcontacaixa']) || !is_array($this->NM_ajax_info['errList']['idcontacaixa']))
                  {
                      $this->NM_ajax_info['errList']['idcontacaixa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcontacaixa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcontacaixa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcontacaixa

    function ValidateField_idempresa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idempresa'])) {
          nm_limpa_numero($this->idempresa, $this->field_config['idempresa']['symbol_grp']) ; 
          return;
      }
      if ($this->idempresa === "" || is_null($this->idempresa))  
      { 
          $this->idempresa = 0;
          $this->sc_force_zero[] = 'idempresa';
      } 
      nm_limpa_numero($this->idempresa, $this->field_config['idempresa']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idempresa' == $this->NM_ajax_opcao)
      { 
          if ($this->idempresa != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idempresa) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Empresa: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idempresa']))
                  {
                      $Campos_Erros['idempresa'] = array();
                  }
                  $Campos_Erros['idempresa'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idempresa']) || !is_array($this->NM_ajax_info['errList']['idempresa']))
                  {
                      $this->NM_ajax_info['errList']['idempresa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idempresa'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idempresa, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Empresa; " ; 
                  if (!isset($Campos_Erros['idempresa']))
                  {
                      $Campos_Erros['idempresa'] = array();
                  }
                  $Campos_Erros['idempresa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idempresa']) || !is_array($this->NM_ajax_info['errList']['idempresa']))
                  {
                      $this->NM_ajax_info['errList']['idempresa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idempresa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
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

    function ValidateField_dataprevisao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      if (isset($this->Field_no_validate['dataprevisao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao == "incluir" || 'validate_dataprevisao' == $this->NM_ajax_opcao)
      { 
          $guarda_datahora = $this->field_config['dataprevisao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dataprevisao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dataprevisao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dataprevisao']['date_sep']) ; 
          if (trim($this->dataprevisao) != "")  
          { 
              $validateTest = $teste_validade->Data($this->dataprevisao, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Previsão; " ; 
                  if (!isset($Campos_Erros['dataprevisao']))
                  {
                      $Campos_Erros['dataprevisao'] = array();
                  }
                  $Campos_Erros['dataprevisao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dataprevisao']) || !is_array($this->NM_ajax_info['errList']['dataprevisao']))
                  {
                      $this->NM_ajax_info['errList']['dataprevisao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataprevisao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['dataprevisao']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dataprevisao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dataprevisao

    function ValidateField_valorprevisao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorprevisao'])) {
          if (!empty($this->field_config['valorprevisao']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp'], $this->field_config['valorprevisao']['symbol_mon']); 
              nm_limpa_valor($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valorprevisao === "" || is_null($this->valorprevisao))  
      { 
          $this->valorprevisao = 0;
          $this->sc_force_zero[] = 'valorprevisao';
      } 
      if (!empty($this->field_config['valorprevisao']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp'], $this->field_config['valorprevisao']['symbol_mon']); 
          nm_limpa_valor($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp']) ; 
          if ('.' == substr($this->valorprevisao, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorprevisao, 1)))
              {
                  $this->valorprevisao = '';
              }
              else
              {
                  $this->valorprevisao = '0' . $this->valorprevisao;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valorprevisao' == $this->NM_ajax_opcao)
      { 
          if ($this->valorprevisao != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valorprevisao) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vr. previsto: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorprevisao']))
                  {
                      $Campos_Erros['valorprevisao'] = array();
                  }
                  $Campos_Erros['valorprevisao'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorprevisao']) || !is_array($this->NM_ajax_info['errList']['valorprevisao']))
                  {
                      $this->NM_ajax_info['errList']['valorprevisao'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorprevisao'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorprevisao, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vr. previsto; " ; 
                  if (!isset($Campos_Erros['valorprevisao']))
                  {
                      $Campos_Erros['valorprevisao'] = array();
                  }
                  $Campos_Erros['valorprevisao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorprevisao']) || !is_array($this->NM_ajax_info['errList']['valorprevisao']))
                  {
                      $this->NM_ajax_info['errList']['valorprevisao'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorprevisao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorprevisao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorprevisao

    function ValidateField_tiporecorrencia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['tiporecorrencia'])) {
       return;
   }
      if ($this->tiporecorrencia == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tiporecorrencia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tiporecorrencia

    function ValidateField_qtdrecorrencia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qtdrecorrencia'])) {
          nm_limpa_numero($this->qtdrecorrencia, $this->field_config['qtdrecorrencia']['symbol_grp']) ; 
          return;
      }
      if ($this->qtdrecorrencia === "" || is_null($this->qtdrecorrencia))  
      { 
          $this->qtdrecorrencia = 0;
          $this->sc_force_zero[] = 'qtdrecorrencia';
      } 
      nm_limpa_numero($this->qtdrecorrencia, $this->field_config['qtdrecorrencia']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->qtdrecorrencia != '')  
          { 
              $iTestSize = 20;
              if ('-' == substr($this->qtdrecorrencia, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->qtdrecorrencia, -1))
              {
                  $iTestSize++;
                  $this->qtdrecorrencia = '-' . substr($this->qtdrecorrencia, 0, -1);
              }
              if (strlen($this->qtdrecorrencia) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Quantidade* : " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['qtdrecorrencia']))
                  {
                      $Campos_Erros['qtdrecorrencia'] = array();
                  }
                  $Campos_Erros['qtdrecorrencia'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['qtdrecorrencia']) || !is_array($this->NM_ajax_info['errList']['qtdrecorrencia']))
                  {
                      $this->NM_ajax_info['errList']['qtdrecorrencia'] = array();
                  }
                  $this->NM_ajax_info['errList']['qtdrecorrencia'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->qtdrecorrencia, 20, 0, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Quantidade* ; " ; 
                  if (!isset($Campos_Erros['qtdrecorrencia']))
                  {
                      $Campos_Erros['qtdrecorrencia'] = array();
                  }
                  $Campos_Erros['qtdrecorrencia'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['qtdrecorrencia']) || !is_array($this->NM_ajax_info['errList']['qtdrecorrencia']))
                  {
                      $this->NM_ajax_info['errList']['qtdrecorrencia'] = array();
                  }
                  $this->NM_ajax_info['errList']['qtdrecorrencia'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'qtdrecorrencia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_qtdrecorrencia

    function ValidateField_recorrentetemp(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['recorrentetemp'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->recorrentetemp) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'recorrentetemp';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_recorrentetemp

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
    $this->nmgp_dados_form['idcliente'] = $this->idcliente;
    $this->nmgp_dados_form['idcolaborador'] = $this->idcolaborador;
    $this->nmgp_dados_form['idfornecedor'] = $this->idfornecedor;
    $this->nmgp_dados_form['idplanoconta'] = $this->idplanoconta;
    $this->nmgp_dados_form['idcontacaixa'] = $this->idcontacaixa;
    $this->nmgp_dados_form['idempresa'] = $this->idempresa;
    $this->nmgp_dados_form['dataprevisao'] = (strlen(trim($this->dataprevisao)) > 19) ? str_replace(".", ":", $this->dataprevisao) : trim($this->dataprevisao);
    $this->nmgp_dados_form['valorprevisao'] = $this->valorprevisao;
    $this->nmgp_dados_form['tiporecorrencia'] = $this->tiporecorrencia;
    $this->nmgp_dados_form['qtdrecorrencia'] = $this->qtdrecorrencia;
    $this->nmgp_dados_form['recorrentetemp'] = $this->recorrentetemp;
    $this->nmgp_dados_form['idlancamentoreceita'] = $this->idlancamentoreceita;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idsituacaodocumento'] = $this->idsituacaodocumento;
    $this->nmgp_dados_form['idtipoespecie'] = $this->idtipoespecie;
    $this->nmgp_dados_form['idnotafiscal'] = $this->idnotafiscal;
    $this->nmgp_dados_form['idcontacaixaregistro'] = $this->idcontacaixaregistro;
    $this->nmgp_dados_form['idlancamentoreceitapai'] = $this->idlancamentoreceitapai;
    $this->nmgp_dados_form['idcontacaixatransferencia'] = $this->idcontacaixatransferencia;
    $this->nmgp_dados_form['idcontrato'] = $this->idcontrato;
    $this->nmgp_dados_form['idusuarioinclusao'] = $this->idusuarioinclusao;
    $this->nmgp_dados_form['idusuarioprevisao'] = $this->idusuarioprevisao;
    $this->nmgp_dados_form['idusuariorealizacao'] = $this->idusuariorealizacao;
    $this->nmgp_dados_form['idusuariobaixa'] = $this->idusuariobaixa;
    $this->nmgp_dados_form['idlancamentoreceitarecorrente'] = $this->idlancamentoreceitarecorrente;
    $this->nmgp_dados_form['idtipoagente'] = $this->idtipoagente;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['parcela'] = $this->parcela;
    $this->nmgp_dados_form['datainclusao'] = $this->datainclusao;
    $this->nmgp_dados_form['datarealizacao'] = $this->datarealizacao;
    $this->nmgp_dados_form['valoracrescimo'] = $this->valoracrescimo;
    $this->nmgp_dados_form['valordesconto'] = $this->valordesconto;
    $this->nmgp_dados_form['valormulta'] = $this->valormulta;
    $this->nmgp_dados_form['valorjuros'] = $this->valorjuros;
    $this->nmgp_dados_form['valorrealizacao'] = $this->valorrealizacao;
    $this->nmgp_dados_form['numerodocumento'] = $this->numerodocumento;
    $this->nmgp_dados_form['contacontabil'] = $this->contacontabil;
    $this->nmgp_dados_form['databaixa'] = $this->databaixa;
    $this->nmgp_dados_form['datacompetencia'] = $this->datacompetencia;
    $this->nmgp_dados_form['historico'] = $this->historico;
    $this->nmgp_dados_form['nomearquivo1'] = $this->nomearquivo1;
    $this->nmgp_dados_form['nomereferencia1'] = $this->nomereferencia1;
    $this->nmgp_dados_form['nomearquivo2'] = $this->nomearquivo2;
    $this->nmgp_dados_form['nomereferencia2'] = $this->nomereferencia2;
    $this->nmgp_dados_form['observacoes'] = $this->observacoes;
    $this->nmgp_dados_form['nossonumero'] = $this->nossonumero;
    $this->nmgp_dados_form['valororiginal'] = $this->valororiginal;
    $this->nmgp_dados_form['unidadeorigem'] = $this->unidadeorigem;
    $this->nmgp_dados_form['enviouemail'] = $this->enviouemail;
    $this->nmgp_dados_form['usuarioexterno'] = $this->usuarioexterno;
    $this->nmgp_dados_form['enviouemailcobranca'] = $this->enviouemailcobranca;
    $this->nmgp_dados_form['lidoemailcobranca'] = $this->lidoemailcobranca;
    $this->nmgp_dados_form['notafiscal'] = $this->notafiscal;
    $this->nmgp_dados_form['fechamentofinanceiro'] = $this->fechamentofinanceiro;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['idcliente'] = $this->idcliente;
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      $this->Before_unformat['idcolaborador'] = $this->idcolaborador;
      nm_limpa_numero($this->idcolaborador, $this->field_config['idcolaborador']['symbol_grp']) ; 
      $this->Before_unformat['idfornecedor'] = $this->idfornecedor;
      nm_limpa_numero($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp']) ; 
      $this->Before_unformat['idplanoconta'] = $this->idplanoconta;
      nm_limpa_numero($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp']) ; 
      $this->Before_unformat['idcontacaixa'] = $this->idcontacaixa;
      nm_limpa_numero($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp']) ; 
      $this->Before_unformat['idempresa'] = $this->idempresa;
      nm_limpa_numero($this->idempresa, $this->field_config['idempresa']['symbol_grp']) ; 
      $this->Before_unformat['dataprevisao'] = $this->dataprevisao;
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      $this->Before_unformat['valorprevisao'] = $this->valorprevisao;
      if (!empty($this->field_config['valorprevisao']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp'], $this->field_config['valorprevisao']['symbol_mon']);
         nm_limpa_valor($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp']);
      }
      $this->Before_unformat['qtdrecorrencia'] = $this->qtdrecorrencia;
      nm_limpa_numero($this->qtdrecorrencia, $this->field_config['qtdrecorrencia']['symbol_grp']) ; 
      $this->Before_unformat['idlancamentoreceita'] = $this->idlancamentoreceita;
      nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      $this->Before_unformat['idnotafiscal'] = $this->idnotafiscal;
      nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      $this->Before_unformat['idlancamentoreceitapai'] = $this->idlancamentoreceitapai;
      nm_limpa_numero($this->idlancamentoreceitapai, $this->field_config['idlancamentoreceitapai']['symbol_grp']) ; 
      $this->Before_unformat['idcontrato'] = $this->idcontrato;
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      $this->Before_unformat['idusuariobaixa'] = $this->idusuariobaixa;
      nm_limpa_numero($this->idusuariobaixa, $this->field_config['idusuariobaixa']['symbol_grp']) ; 
      $this->Before_unformat['idlancamentoreceitarecorrente'] = $this->idlancamentoreceitarecorrente;
      nm_limpa_numero($this->idlancamentoreceitarecorrente, $this->field_config['idlancamentoreceitarecorrente']['symbol_grp']) ; 
      $this->Before_unformat['idtipoagente'] = $this->idtipoagente;
      nm_limpa_numero($this->idtipoagente, $this->field_config['idtipoagente']['symbol_grp']) ; 
      $this->Before_unformat['parcela'] = $this->parcela;
      nm_limpa_numero($this->parcela, $this->field_config['parcela']['symbol_grp']) ; 
      $this->Before_unformat['datainclusao'] = $this->datainclusao;
      $this->Before_unformat['datainclusao_hora'] = $this->datainclusao_hora;
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      $this->Before_unformat['datarealizacao'] = $this->datarealizacao;
      $this->Before_unformat['datarealizacao_hora'] = $this->datarealizacao_hora;
      nm_limpa_data($this->datarealizacao, $this->field_config['datarealizacao']['date_sep']) ; 
      nm_limpa_hora($this->datarealizacao_hora, $this->field_config['datarealizacao']['time_sep']) ; 
      $this->Before_unformat['valoracrescimo'] = $this->valoracrescimo;
      if (!empty($this->field_config['valoracrescimo']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valoracrescimo, $this->field_config['valoracrescimo']['symbol_dec'], $this->field_config['valoracrescimo']['symbol_grp'], $this->field_config['valoracrescimo']['symbol_mon']);
         nm_limpa_valor($this->valoracrescimo, $this->field_config['valoracrescimo']['symbol_dec'], $this->field_config['valoracrescimo']['symbol_grp']);
      }
      $this->Before_unformat['valordesconto'] = $this->valordesconto;
      if (!empty($this->field_config['valordesconto']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_mon']);
         nm_limpa_valor($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp']);
      }
      $this->Before_unformat['valormulta'] = $this->valormulta;
      if (!empty($this->field_config['valormulta']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valormulta, $this->field_config['valormulta']['symbol_dec'], $this->field_config['valormulta']['symbol_grp'], $this->field_config['valormulta']['symbol_mon']);
         nm_limpa_valor($this->valormulta, $this->field_config['valormulta']['symbol_dec'], $this->field_config['valormulta']['symbol_grp']);
      }
      $this->Before_unformat['valorjuros'] = $this->valorjuros;
      if (!empty($this->field_config['valorjuros']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorjuros, $this->field_config['valorjuros']['symbol_dec'], $this->field_config['valorjuros']['symbol_grp'], $this->field_config['valorjuros']['symbol_mon']);
         nm_limpa_valor($this->valorjuros, $this->field_config['valorjuros']['symbol_dec'], $this->field_config['valorjuros']['symbol_grp']);
      }
      $this->Before_unformat['valorrealizacao'] = $this->valorrealizacao;
      if (!empty($this->field_config['valorrealizacao']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorrealizacao, $this->field_config['valorrealizacao']['symbol_dec'], $this->field_config['valorrealizacao']['symbol_grp'], $this->field_config['valorrealizacao']['symbol_mon']);
         nm_limpa_valor($this->valorrealizacao, $this->field_config['valorrealizacao']['symbol_dec'], $this->field_config['valorrealizacao']['symbol_grp']);
      }
      $this->Before_unformat['databaixa'] = $this->databaixa;
      $this->Before_unformat['databaixa_hora'] = $this->databaixa_hora;
      nm_limpa_data($this->databaixa, $this->field_config['databaixa']['date_sep']) ; 
      nm_limpa_hora($this->databaixa_hora, $this->field_config['databaixa']['time_sep']) ; 
      $this->Before_unformat['datacompetencia'] = $this->datacompetencia;
      nm_limpa_data($this->datacompetencia, $this->field_config['datacompetencia']['date_sep']) ; 
      $this->Before_unformat['nossonumero'] = $this->nossonumero;
      nm_limpa_numero($this->nossonumero, $this->field_config['nossonumero']['symbol_grp']) ; 
      $this->Before_unformat['valororiginal'] = $this->valororiginal;
      if (!empty($this->field_config['valororiginal']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valororiginal, $this->field_config['valororiginal']['symbol_dec'], $this->field_config['valororiginal']['symbol_grp'], $this->field_config['valororiginal']['symbol_mon']);
         nm_limpa_valor($this->valororiginal, $this->field_config['valororiginal']['symbol_dec'], $this->field_config['valororiginal']['symbol_grp']);
      }
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
      if ($Nome_Campo == "idcliente")
      {
          nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idcolaborador")
      {
          nm_limpa_numero($this->idcolaborador, $this->field_config['idcolaborador']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idfornecedor")
      {
          nm_limpa_numero($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idplanoconta")
      {
          nm_limpa_numero($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idcontacaixa")
      {
          nm_limpa_numero($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idempresa")
      {
          nm_limpa_numero($this->idempresa, $this->field_config['idempresa']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valorprevisao")
      {
          if (!empty($this->field_config['valorprevisao']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp'], $this->field_config['valorprevisao']['symbol_mon']);
             nm_limpa_valor($this->valorprevisao, $this->field_config['valorprevisao']['symbol_dec'], $this->field_config['valorprevisao']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "qtdrecorrencia")
      {
          nm_limpa_numero($this->qtdrecorrencia, $this->field_config['qtdrecorrencia']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idlancamentoreceita")
      {
          nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idnotafiscal")
      {
          nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idlancamentoreceitapai")
      {
          nm_limpa_numero($this->idlancamentoreceitapai, $this->field_config['idlancamentoreceitapai']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idcontrato")
      {
          nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idusuariobaixa")
      {
          nm_limpa_numero($this->idusuariobaixa, $this->field_config['idusuariobaixa']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idlancamentoreceitarecorrente")
      {
          nm_limpa_numero($this->idlancamentoreceitarecorrente, $this->field_config['idlancamentoreceitarecorrente']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idtipoagente")
      {
          nm_limpa_numero($this->idtipoagente, $this->field_config['idtipoagente']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "parcela")
      {
          nm_limpa_numero($this->parcela, $this->field_config['parcela']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valoracrescimo")
      {
          if (!empty($this->field_config['valoracrescimo']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valoracrescimo, $this->field_config['valoracrescimo']['symbol_dec'], $this->field_config['valoracrescimo']['symbol_grp'], $this->field_config['valoracrescimo']['symbol_mon']);
             nm_limpa_valor($this->valoracrescimo, $this->field_config['valoracrescimo']['symbol_dec'], $this->field_config['valoracrescimo']['symbol_grp']);
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
      if ($Nome_Campo == "valormulta")
      {
          if (!empty($this->field_config['valormulta']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valormulta, $this->field_config['valormulta']['symbol_dec'], $this->field_config['valormulta']['symbol_grp'], $this->field_config['valormulta']['symbol_mon']);
             nm_limpa_valor($this->valormulta, $this->field_config['valormulta']['symbol_dec'], $this->field_config['valormulta']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorjuros")
      {
          if (!empty($this->field_config['valorjuros']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorjuros, $this->field_config['valorjuros']['symbol_dec'], $this->field_config['valorjuros']['symbol_grp'], $this->field_config['valorjuros']['symbol_mon']);
             nm_limpa_valor($this->valorjuros, $this->field_config['valorjuros']['symbol_dec'], $this->field_config['valorjuros']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorrealizacao")
      {
          if (!empty($this->field_config['valorrealizacao']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorrealizacao, $this->field_config['valorrealizacao']['symbol_dec'], $this->field_config['valorrealizacao']['symbol_grp'], $this->field_config['valorrealizacao']['symbol_mon']);
             nm_limpa_valor($this->valorrealizacao, $this->field_config['valorrealizacao']['symbol_dec'], $this->field_config['valorrealizacao']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "nossonumero")
      {
          nm_limpa_numero($this->nossonumero, $this->field_config['nossonumero']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valororiginal")
      {
          if (!empty($this->field_config['valororiginal']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valororiginal, $this->field_config['valororiginal']['symbol_dec'], $this->field_config['valororiginal']['symbol_grp'], $this->field_config['valororiginal']['symbol_mon']);
             nm_limpa_valor($this->valororiginal, $this->field_config['valororiginal']['symbol_dec'], $this->field_config['valororiginal']['symbol_grp']);
          }
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
      if ('' !== $this->idcliente || (!empty($format_fields) && isset($format_fields['idcliente'])))
      {
          nmgp_Form_Num_Val($this->idcliente, $this->field_config['idcliente']['symbol_grp'], $this->field_config['idcliente']['symbol_dec'], "0", "S", $this->field_config['idcliente']['format_neg'], "", "", "-", $this->field_config['idcliente']['symbol_fmt']) ; 
      }
      if ('' !== $this->idcolaborador || (!empty($format_fields) && isset($format_fields['idcolaborador'])))
      {
          nmgp_Form_Num_Val($this->idcolaborador, $this->field_config['idcolaborador']['symbol_grp'], $this->field_config['idcolaborador']['symbol_dec'], "0", "S", $this->field_config['idcolaborador']['format_neg'], "", "", "-", $this->field_config['idcolaborador']['symbol_fmt']) ; 
      }
      if ('' !== $this->idfornecedor || (!empty($format_fields) && isset($format_fields['idfornecedor'])))
      {
          nmgp_Form_Num_Val($this->idfornecedor, $this->field_config['idfornecedor']['symbol_grp'], $this->field_config['idfornecedor']['symbol_dec'], "0", "S", $this->field_config['idfornecedor']['format_neg'], "", "", "-", $this->field_config['idfornecedor']['symbol_fmt']) ; 
      }
      if ('' !== $this->idplanoconta || (!empty($format_fields) && isset($format_fields['idplanoconta'])))
      {
          nmgp_Form_Num_Val($this->idplanoconta, $this->field_config['idplanoconta']['symbol_grp'], $this->field_config['idplanoconta']['symbol_dec'], "0", "S", $this->field_config['idplanoconta']['format_neg'], "", "", "-", $this->field_config['idplanoconta']['symbol_fmt']) ; 
      }
      if ('' !== $this->idcontacaixa || (!empty($format_fields) && isset($format_fields['idcontacaixa'])))
      {
          nmgp_Form_Num_Val($this->idcontacaixa, $this->field_config['idcontacaixa']['symbol_grp'], $this->field_config['idcontacaixa']['symbol_dec'], "0", "S", $this->field_config['idcontacaixa']['format_neg'], "", "", "-", $this->field_config['idcontacaixa']['symbol_fmt']) ; 
      }
      if ('' !== $this->idempresa || (!empty($format_fields) && isset($format_fields['idempresa'])))
      {
          nmgp_Form_Num_Val($this->idempresa, $this->field_config['idempresa']['symbol_grp'], $this->field_config['idempresa']['symbol_dec'], "0", "S", $this->field_config['idempresa']['format_neg'], "", "", "-", $this->field_config['idempresa']['symbol_fmt']) ; 
      }
      if ((!empty($this->dataprevisao) && 'null' != $this->dataprevisao) || (!empty($format_fields) && isset($format_fields['dataprevisao'])))
      {
          nm_volta_data($this->dataprevisao, $this->field_config['dataprevisao']['date_format']) ; 
          nmgp_Form_Datas($this->dataprevisao, $this->field_config['dataprevisao']['date_format'], $this->field_config['dataprevisao']['date_sep']) ;  
      }
      elseif ('null' == $this->dataprevisao || '' == $this->dataprevisao)
      {
          $this->dataprevisao = '';
      }
      if ('' !== $this->valorprevisao || (!empty($format_fields) && isset($format_fields['valorprevisao'])))
      {
          nmgp_Form_Num_Val($this->valorprevisao, $this->field_config['valorprevisao']['symbol_grp'], $this->field_config['valorprevisao']['symbol_dec'], "2", "S", $this->field_config['valorprevisao']['format_neg'], "", "", "-", $this->field_config['valorprevisao']['symbol_fmt']) ; 
      }
      if ('' !== $this->qtdrecorrencia || (!empty($format_fields) && isset($format_fields['qtdrecorrencia'])))
      {
          nmgp_Form_Num_Val($this->qtdrecorrencia, $this->field_config['qtdrecorrencia']['symbol_grp'], $this->field_config['qtdrecorrencia']['symbol_dec'], "0", "S", $this->field_config['qtdrecorrencia']['format_neg'], "", "", "-", $this->field_config['qtdrecorrencia']['symbol_fmt']) ; 
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
      $guarda_format_hora = $this->field_config['dataprevisao']['date_format'];
      if ($this->dataprevisao != "")  
      { 
          nm_conv_data($this->dataprevisao, $this->field_config['dataprevisao']['date_format']) ; 
          $this->dataprevisao_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->dataprevisao_hora = substr($this->dataprevisao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->dataprevisao_hora = substr($this->dataprevisao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->dataprevisao_hora = substr($this->dataprevisao_hora, 0, -4);
          }
          $this->dataprevisao .= " " . $this->dataprevisao_hora ; 
      } 
      if ($this->dataprevisao == "" && $use_null)  
      { 
          $this->dataprevisao = "null" ; 
      } 
      $this->field_config['dataprevisao']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_idcliente();
          $this->ajax_return_values_idcolaborador();
          $this->ajax_return_values_idfornecedor();
          $this->ajax_return_values_idplanoconta();
          $this->ajax_return_values_idcontacaixa();
          $this->ajax_return_values_idempresa();
          $this->ajax_return_values_dataprevisao();
          $this->ajax_return_values_valorprevisao();
          $this->ajax_return_values_tiporecorrencia();
          $this->ajax_return_values_qtdrecorrencia();
          $this->ajax_return_values_recorrentetemp();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idlancamentoreceita']['keyVal'] = LancamentoReceita_Recorrente_Frm_pack_protect_string($this->nmgp_dados_form['idlancamentoreceita']);
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['_LancamentoReceitaRecorrente_Lst_script_case_init'] ]['_LancamentoReceitaRecorrente_Lst']['embutida_form_full'] = false;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['_LancamentoReceitaRecorrente_Lst_script_case_init'] ]['_LancamentoReceitaRecorrente_Lst']['embutida_form']       = true;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['_LancamentoReceitaRecorrente_Lst_script_case_init'] ]['_LancamentoReceitaRecorrente_Lst']['embutida_pai']        = "LancamentoReceita_Recorrente_Frm";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['_LancamentoReceitaRecorrente_Lst_script_case_init'] ]['_LancamentoReceitaRecorrente_Lst']['embutida_form_parms'] = "varidlancamentoreceita*scin" . $this->nmgp_dados_form['idlancamentoreceita'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scoutlink_remove_background*scinno*scout";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['_LancamentoReceitaRecorrente_Lst_script_case_init'] ]['_LancamentoReceitaRecorrente_Lst']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['_LancamentoReceitaRecorrente_Lst_script_case_init'] ]['_LancamentoReceitaRecorrente_Lst']['total']);
          }
   } // ajax_return_values

          //----- idcliente
   function ajax_return_values_idcliente($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcliente", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcliente);
              $aLookup = array();
              $this->_tmp_lookup_idcliente = $this->idcliente;

if ($this->idcliente != "")
{ 
   $this->nm_clear_val("idcliente");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcliente");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdCliente, NomeFantasia FROM cliente WHERE (IdCliente = '$this->idcliente') AND IdCliente = " . substr($this->Db->qstr($this->idcliente), 1, -1) . "";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   if ('' != $this->idcliente)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcliente'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
} 
          $aLookupOrig = $aLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idcliente", $this->nmgp_refresh_fields)) ? 'text' : 'text';
          $this->NM_ajax_info['fldList']['idcliente'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($unformatted_value_idcliente),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcliente']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcliente']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcliente']['labList'] = $aLabel;
          $val_output = isset($aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcliente))]) ? $aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcliente))] : "";
          $this->NM_ajax_info['fldList']['idcliente_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
              );
          }
   }

          //----- idcolaborador
   function ajax_return_values_idcolaborador($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcolaborador", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcolaborador);
              $aLookup = array();
              $this->_tmp_lookup_idcolaborador = $this->idcolaborador;

if ($this->idcolaborador != "")
{ 
   $this->nm_clear_val("idcolaborador");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcolaborador");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdColaborador, Nome FROM colaborador WHERE (IdColaborador = '$this->idcolaborador') AND IdColaborador = " . substr($this->Db->qstr($this->idcolaborador), 1, -1) . "";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   if ('' != $this->idcolaborador)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcolaborador'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
} 
          $aLookupOrig = $aLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idcolaborador", $this->nmgp_refresh_fields)) ? 'text' : 'text';
          $this->NM_ajax_info['fldList']['idcolaborador'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($unformatted_value_idcolaborador),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcolaborador']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcolaborador']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcolaborador']['labList'] = $aLabel;
          $val_output = isset($aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcolaborador))]) ? $aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcolaborador))] : "";
          $this->NM_ajax_info['fldList']['idcolaborador_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
              );
          }
   }

          //----- idfornecedor
   function ajax_return_values_idfornecedor($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idfornecedor", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idfornecedor);
              $aLookup = array();
              $this->_tmp_lookup_idfornecedor = $this->idfornecedor;

if ($this->idfornecedor != "")
{ 
   $this->nm_clear_val("idfornecedor");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idfornecedor");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdFornecedor, NomeFantasia FROM fornecedor WHERE (IdFornecedor = '$this->idfornecedor') AND IdFornecedor = " . substr($this->Db->qstr($this->idfornecedor), 1, -1) . "";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   if ('' != $this->idfornecedor)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idfornecedor'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
} 
          $aLookupOrig = $aLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idfornecedor", $this->nmgp_refresh_fields)) ? 'text' : 'text';
          $this->NM_ajax_info['fldList']['idfornecedor'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($unformatted_value_idfornecedor),
              );
          $aLabel     = array();
          $aLabelTemp = array();
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
          $val_output = isset($aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idfornecedor))]) ? $aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idfornecedor))] : "";
          $this->NM_ajax_info['fldList']['idfornecedor_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
              );
          }
   }

          //----- idplanoconta
   function ajax_return_values_idplanoconta($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanoconta", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanoconta);
              $aLookup = array();
              $this->_tmp_lookup_idplanoconta = $this->idplanoconta;

if ($this->idplanoconta != "")
{ 
   $this->nm_clear_val("idplanoconta");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idplanoconta");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdPlanoConta, Descricao FROM planoconta WHERE (IdPlanoConta = '$this->idplanoconta') AND IdPlanoConta = " . substr($this->Db->qstr($this->idplanoconta), 1, -1) . " ORDER BY IdPlanoConta";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   if ('' != $this->idplanoconta)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idplanoconta'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
} 
          $aLookupOrig = $aLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idplanoconta", $this->nmgp_refresh_fields)) ? 'text' : 'text';
          $this->NM_ajax_info['fldList']['idplanoconta'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($unformatted_value_idplanoconta),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanoconta']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanoconta']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanoconta']['labList'] = $aLabel;
          $val_output = isset($aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idplanoconta))]) ? $aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idplanoconta))] : "";
          $this->NM_ajax_info['fldList']['idplanoconta_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
              );
          }
   }

          //----- idcontacaixa
   function ajax_return_values_idcontacaixa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcontacaixa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcontacaixa);
              $aLookup = array();
              $this->_tmp_lookup_idcontacaixa = $this->idcontacaixa;

if ($this->idcontacaixa != "")
{ 
   $this->nm_clear_val("idcontacaixa");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcontacaixa");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdContaCaixa, Descricao FROM contacaixa WHERE (IdContaCaixa = $this->idcontacaixa) AND IdContaCaixa = " . substr($this->Db->qstr($this->idcontacaixa), 1, -1) . " ORDER BY IdContaCaixa";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   if ('' != $this->idcontacaixa)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idcontacaixa'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
} 
          $aLookupOrig = $aLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idcontacaixa", $this->nmgp_refresh_fields)) ? 'text' : 'text';
          $this->NM_ajax_info['fldList']['idcontacaixa'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($unformatted_value_idcontacaixa),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcontacaixa']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcontacaixa']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcontacaixa']['labList'] = $aLabel;
          $val_output = isset($aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcontacaixa))]) ? $aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcontacaixa))] : "";
          $this->NM_ajax_info['fldList']['idcontacaixa_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
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

if ($this->idempresa != "")
{ 
   $this->nm_clear_val("idempresa");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idcolaborador = $this->idcolaborador;
   $old_value_idfornecedor = $this->idfornecedor;
   $old_value_idplanoconta = $this->idplanoconta;
   $old_value_idcontacaixa = $this->idcontacaixa;
   $old_value_idempresa = $this->idempresa;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_valorprevisao = $this->valorprevisao;
   $old_value_qtdrecorrencia = $this->qtdrecorrencia;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idempresa");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idcolaborador = $this->idcolaborador;
   $unformatted_value_idfornecedor = $this->idfornecedor;
   $unformatted_value_idplanoconta = $this->idplanoconta;
   $unformatted_value_idcontacaixa = $this->idcontacaixa;
   $unformatted_value_idempresa = $this->idempresa;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_valorprevisao = $this->valorprevisao;
   $unformatted_value_qtdrecorrencia = $this->qtdrecorrencia;

   $nm_comando = "SELECT IdEmpresa, NomeFantasia FROM empresa WHERE (IdEmpresa = $this->idempresa) AND IdEmpresa = " . substr($this->Db->qstr($this->idempresa), 1, -1) . " ORDER BY IdEmpresa";
   if ($this->NM_case_insensitive)
   {
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && strpos($nm_comando, " LIKE ") !== false) {
           $nm_comando = str_replace(array(" LIKE ","#upperI#","#upperF#"), array(" ilike ","",""), $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) {
           $nm_comando = str_replace("#upperI#", "UCase(", $nm_comando);
       }
       $nm_comando = str_replace("#upperI#", "Upper(", $nm_comando);
       $nm_comando = str_replace("#upperF#", ")", $nm_comando);
   }
   else
   {
       $nm_comando = str_replace("#upperI#", "", $nm_comando);
       $nm_comando = str_replace("#upperF#", "", $nm_comando);
   }

   $this->idcliente = $old_value_idcliente;
   $this->idcolaborador = $old_value_idcolaborador;
   $this->idfornecedor = $old_value_idfornecedor;
   $this->idplanoconta = $old_value_idplanoconta;
   $this->idcontacaixa = $old_value_idcontacaixa;
   $this->idempresa = $old_value_idempresa;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->valorprevisao = $old_value_valorprevisao;
   $this->qtdrecorrencia = $old_value_qtdrecorrencia;

   if ('' != $this->idempresa)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_idempresa'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
} 
          $aLookupOrig = $aLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idempresa", $this->nmgp_refresh_fields)) ? 'text' : 'text';
          $this->NM_ajax_info['fldList']['idempresa'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($unformatted_value_idempresa),
              );
          $aLabel     = array();
          $aLabelTemp = array();
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
          $val_output = isset($aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idempresa))]) ? $aLookup[0][LancamentoReceita_Recorrente_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idempresa))] : "";
          $this->NM_ajax_info['fldList']['idempresa_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
              );
          }
   }

          //----- dataprevisao
   function ajax_return_values_dataprevisao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dataprevisao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dataprevisao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dataprevisao'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("dataprevisao", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- valorprevisao
   function ajax_return_values_valorprevisao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorprevisao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorprevisao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorprevisao'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valorprevisao", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- tiporecorrencia
   function ajax_return_values_tiporecorrencia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tiporecorrencia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tiporecorrencia);
              $aLookup = array();
              $this->_tmp_lookup_tiporecorrencia = $this->tiporecorrencia;

$aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string('1') => str_replace('<', '&lt;',LancamentoReceita_Recorrente_Frm_pack_protect_string("Quinzenal")));
$aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string('2') => str_replace('<', '&lt;',LancamentoReceita_Recorrente_Frm_pack_protect_string("Mensal")));
$aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string('3') => str_replace('<', '&lt;',LancamentoReceita_Recorrente_Frm_pack_protect_string("Bimestral")));
$aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string('4') => str_replace('<', '&lt;',LancamentoReceita_Recorrente_Frm_pack_protect_string("Trimestral")));
$aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string('5') => str_replace('<', '&lt;',LancamentoReceita_Recorrente_Frm_pack_protect_string("Semestral")));
$aLookup[] = array(LancamentoReceita_Recorrente_Frm_pack_protect_string('6') => str_replace('<', '&lt;',LancamentoReceita_Recorrente_Frm_pack_protect_string("Anual")));
$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_tiporecorrencia'][] = '1';
$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_tiporecorrencia'][] = '2';
$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_tiporecorrencia'][] = '3';
$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_tiporecorrencia'][] = '4';
$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_tiporecorrencia'][] = '5';
$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Lookup_tiporecorrencia'][] = '6';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"tiporecorrencia\"";
          if (isset($this->NM_ajax_info['select_html']['tiporecorrencia']) && !empty($this->NM_ajax_info['select_html']['tiporecorrencia']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['tiporecorrencia']);
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

                  if ($this->tiporecorrencia == $sValue)
                  {
                      $this->_tmp_lookup_tiporecorrencia = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tiporecorrencia'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tiporecorrencia']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tiporecorrencia']['valList'][$i] = LancamentoReceita_Recorrente_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tiporecorrencia']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tiporecorrencia']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tiporecorrencia']['labList'] = $aLabel;
          }
   }

          //----- qtdrecorrencia
   function ajax_return_values_qtdrecorrencia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("qtdrecorrencia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->qtdrecorrencia);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['qtdrecorrencia'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- recorrentetemp
   function ajax_return_values_recorrentetemp($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("recorrentetemp", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->recorrentetemp);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['recorrentetemp'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdLancamentoReceita)) {$this->sc_temp_varIdLancamentoReceita = (isset($_SESSION['varIdLancamentoReceita'])) ? $_SESSION['varIdLancamentoReceita'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varQtdRecorrencia)) {$this->sc_temp_varQtdRecorrencia = (isset($_SESSION['varQtdRecorrencia'])) ? $_SESSION['varQtdRecorrencia'] : "";}
if (!isset($this->sc_temp_varTipoRecorrencia)) {$this->sc_temp_varTipoRecorrencia = (isset($_SESSION['varTipoRecorrencia'])) ? $_SESSION['varTipoRecorrencia'] : "";}
if (!isset($this->sc_temp_varAcao)) {$this->sc_temp_varAcao = (isset($_SESSION['varAcao'])) ? $_SESSION['varAcao'] : "";}
  switch ($this->idtipoagente ) {
    case 1:
        $this->nmgp_cmp_hidden["idfornecedor"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idfornecedor'] = 'off';
		$this->nmgp_cmp_hidden["idcolaborador"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idcolaborador'] = 'off';
        break;
    case 2:
        $this->nmgp_cmp_hidden["idcliente"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idcliente'] = 'off';
		$this->nmgp_cmp_hidden["idcolaborador"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idcolaborador'] = 'off';
        break;
    case 3:
        $this->nmgp_cmp_hidden["idcliente"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idcliente'] = 'off';
		$this->nmgp_cmp_hidden["idfornecedor"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idfornecedor'] = 'off';
        break;
}

$msg = '';
if ($this->sc_temp_varAcao == 1 || $this->sc_temp_varAcao == 2) {
	if (isset($this->sc_temp_varTipoRecorrencia)) {
		$this->tiporecorrencia  = $this->sc_temp_varTipoRecorrencia;
	}
	if (isset($this->sc_temp_varQtdRecorrencia)) {
		$this->qtdrecorrencia  = $this->sc_temp_varQtdRecorrencia;
	}
	
	if (empty($this->tiporecorrencia )) {
		$msg = $msg . 'Campo obrigatório: Recorrência<br>';
	}
	if (empty($this->qtdrecorrencia )) {
		$msg = $msg . 'Campo obrigatório: Quantidade<br>';
	}elseif ($this->qtdrecorrencia  < 2) {
		$msg = $msg . 'Campo Quantidade deve ser maior ou igual a 2</br>';
	}

	if ($this->sc_temp_varAcao == 2) {
		$sql = "SELECT COUNT(*) FROM _lancamentoreceitarecorrente WHERE IdTenacidade = '$this->sc_temp_varIdTenacidade' AND IdLancamentoReceita = '$this->sc_temp_varIdLancamentoReceita'";
		 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->meus_dados = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->meus_dados[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Db->ErrorMsg();
      } 

		if ($this->meus_dados  === false) {
			$msg = $msg . "Erro de acesso. Mensagem = " . $this->meus_dados_erro ;
		} elseif (empty($this->meus_dados )) {
			$msg = $msg . "Consulta informações sobre a simulação não retornou dados <br>";
		} else {
			if ($this->meus_dados[0][0] == 0) {
				$this->NM_ajax_info['buttonDisplay']['GerarRecorrencia'] = $this->nmgp_botoes["GerarRecorrencia"] = 'off';;
			} else {
				$this->NM_ajax_info['buttonDisplay']['GerarRecorrencia'] = $this->nmgp_botoes["GerarRecorrencia"] = 'on';;
			}
		}
	} else {
		$this->NM_ajax_info['buttonDisplay']['GerarRecorrencia'] = $this->nmgp_botoes["GerarRecorrencia"] = 'off';;
	}
} else {
	$this->sc_temp_varAcao = 1;
	$this->NM_ajax_info['buttonDisplay']['GerarRecorrencia'] = $this->nmgp_botoes["GerarRecorrencia"] = 'off';;
}
if ($msg != '') {
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $msg;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_LancamentoReceita_Recorrente_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_LancamentoReceita_Recorrente_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $msg;
 }
;
}

$this->sc_field_readonly("idempresa", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['Field_disabled_macro']['idempresa'] = array('I'=>array(),'U'=>array());
;
if (isset($this->sc_temp_varAcao)) { $_SESSION['varAcao'] = $this->sc_temp_varAcao;}
if (isset($this->sc_temp_varTipoRecorrencia)) { $_SESSION['varTipoRecorrencia'] = $this->sc_temp_varTipoRecorrencia;}
if (isset($this->sc_temp_varQtdRecorrencia)) { $_SESSION['varQtdRecorrencia'] = $this->sc_temp_varQtdRecorrencia;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdLancamentoReceita)) { $_SESSION['varIdLancamentoReceita'] = $this->sc_temp_varIdLancamentoReceita;}
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off'; 
      }
      if (empty($this->datainclusao))
      {
          $this->datainclusao_hora = $this->datainclusao;
      }
      if (empty($this->datarealizacao))
      {
          $this->datarealizacao_hora = $this->datarealizacao;
      }
      if (empty($this->databaixa))
      {
          $this->databaixa_hora = $this->databaixa;
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
      $this->valorprevisao = str_replace($sc_parm1, $sc_parm2, $this->valorprevisao); 
      $this->valoracrescimo = str_replace($sc_parm1, $sc_parm2, $this->valoracrescimo); 
      $this->valordesconto = str_replace($sc_parm1, $sc_parm2, $this->valordesconto); 
      $this->valormulta = str_replace($sc_parm1, $sc_parm2, $this->valormulta); 
      $this->valorjuros = str_replace($sc_parm1, $sc_parm2, $this->valorjuros); 
      $this->valorrealizacao = str_replace($sc_parm1, $sc_parm2, $this->valorrealizacao); 
      $this->valororiginal = str_replace($sc_parm1, $sc_parm2, $this->valororiginal); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->valorprevisao = "'" . $this->valorprevisao . "'";
      $this->valoracrescimo = "'" . $this->valoracrescimo . "'";
      $this->valordesconto = "'" . $this->valordesconto . "'";
      $this->valormulta = "'" . $this->valormulta . "'";
      $this->valorjuros = "'" . $this->valorjuros . "'";
      $this->valorrealizacao = "'" . $this->valorrealizacao . "'";
      $this->valororiginal = "'" . $this->valororiginal . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->valorprevisao = str_replace("'", "", $this->valorprevisao); 
      $this->valoracrescimo = str_replace("'", "", $this->valoracrescimo); 
      $this->valordesconto = str_replace("'", "", $this->valordesconto); 
      $this->valormulta = str_replace("'", "", $this->valormulta); 
      $this->valorjuros = str_replace("'", "", $this->valorjuros); 
      $this->valorrealizacao = str_replace("'", "", $this->valorrealizacao); 
      $this->valororiginal = str_replace("'", "", $this->valororiginal); 
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
    if ("excluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
              /* lancamentodespesa */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "SELECT COUNT(*) AS countTest FROM lancamentodespesa WHERE IdLancamentoDespesa = '" . $idlancamentodespesa  . "'";
      }
      else
      {
          $sc_cmd_dependency = "SELECT COUNT(*) AS countTest FROM lancamentodespesa WHERE IdLancamentoDespesa = '" . $idlancamentodespesa  . "'";
      }
       
      $nm_select = $sc_cmd_dependency; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset_lancamentodespesa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->dataset_lancamentodespesa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset_lancamentodespesa = false;
          $this->dataset_lancamentodespesa_erro = $this->Db->ErrorMsg();
      } 


      if($this->dataset_lancamentodespesa[0][0] > 0)
      {
          
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "" . $this->Ini->Nm_lang['lang_errm_dele_rhcr'] . "";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_LancamentoReceita_Recorrente_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_LancamentoReceita_Recorrente_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "" . $this->Ini->Nm_lang['lang_errm_dele_rhcr'] . "";
 }
;
      }

            /* lancamentodespesa */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "SELECT COUNT(*) AS countTest FROM lancamentodespesa WHERE IdLancamentoDespesa = '" . $idlancamentodespesa  . "'";
      }
      else
      {
          $sc_cmd_dependency = "SELECT COUNT(*) AS countTest FROM lancamentodespesa WHERE IdLancamentoDespesa = '" . $idlancamentodespesa  . "'";
      }
       
      $nm_select = $sc_cmd_dependency; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset_lancamentodespesa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->dataset_lancamentodespesa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset_lancamentodespesa = false;
          $this->dataset_lancamentodespesa_erro = $this->Db->ErrorMsg();
      } 


      if($this->dataset_lancamentodespesa[0][0] > 0)
      {
          
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "" . $this->Ini->Nm_lang['lang_errm_dele_rhcr'] . "";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_LancamentoReceita_Recorrente_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_LancamentoReceita_Recorrente_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "" . $this->Ini->Nm_lang['lang_errm_dele_rhcr'] . "";
 }
;
      }
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off'; 
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
      $NM_val_form['idcliente'] = $this->idcliente;
      $NM_val_form['idcolaborador'] = $this->idcolaborador;
      $NM_val_form['idfornecedor'] = $this->idfornecedor;
      $NM_val_form['idplanoconta'] = $this->idplanoconta;
      $NM_val_form['idcontacaixa'] = $this->idcontacaixa;
      $NM_val_form['idempresa'] = $this->idempresa;
      $NM_val_form['dataprevisao'] = $this->dataprevisao;
      $NM_val_form['valorprevisao'] = $this->valorprevisao;
      $NM_val_form['tiporecorrencia'] = $this->tiporecorrencia;
      $NM_val_form['qtdrecorrencia'] = $this->qtdrecorrencia;
      $NM_val_form['recorrentetemp'] = $this->recorrentetemp;
      $NM_val_form['idlancamentoreceita'] = $this->idlancamentoreceita;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idsituacaodocumento'] = $this->idsituacaodocumento;
      $NM_val_form['idtipoespecie'] = $this->idtipoespecie;
      $NM_val_form['idnotafiscal'] = $this->idnotafiscal;
      $NM_val_form['idcontacaixaregistro'] = $this->idcontacaixaregistro;
      $NM_val_form['idlancamentoreceitapai'] = $this->idlancamentoreceitapai;
      $NM_val_form['idcontacaixatransferencia'] = $this->idcontacaixatransferencia;
      $NM_val_form['idcontrato'] = $this->idcontrato;
      $NM_val_form['idusuarioinclusao'] = $this->idusuarioinclusao;
      $NM_val_form['idusuarioprevisao'] = $this->idusuarioprevisao;
      $NM_val_form['idusuariorealizacao'] = $this->idusuariorealizacao;
      $NM_val_form['idusuariobaixa'] = $this->idusuariobaixa;
      $NM_val_form['idlancamentoreceitarecorrente'] = $this->idlancamentoreceitarecorrente;
      $NM_val_form['idtipoagente'] = $this->idtipoagente;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['parcela'] = $this->parcela;
      $NM_val_form['datainclusao'] = $this->datainclusao;
      $NM_val_form['datarealizacao'] = $this->datarealizacao;
      $NM_val_form['valoracrescimo'] = $this->valoracrescimo;
      $NM_val_form['valordesconto'] = $this->valordesconto;
      $NM_val_form['valormulta'] = $this->valormulta;
      $NM_val_form['valorjuros'] = $this->valorjuros;
      $NM_val_form['valorrealizacao'] = $this->valorrealizacao;
      $NM_val_form['numerodocumento'] = $this->numerodocumento;
      $NM_val_form['contacontabil'] = $this->contacontabil;
      $NM_val_form['databaixa'] = $this->databaixa;
      $NM_val_form['datacompetencia'] = $this->datacompetencia;
      $NM_val_form['historico'] = $this->historico;
      $NM_val_form['nomearquivo1'] = $this->nomearquivo1;
      $NM_val_form['nomereferencia1'] = $this->nomereferencia1;
      $NM_val_form['nomearquivo2'] = $this->nomearquivo2;
      $NM_val_form['nomereferencia2'] = $this->nomereferencia2;
      $NM_val_form['observacoes'] = $this->observacoes;
      $NM_val_form['nossonumero'] = $this->nossonumero;
      $NM_val_form['valororiginal'] = $this->valororiginal;
      $NM_val_form['unidadeorigem'] = $this->unidadeorigem;
      $NM_val_form['enviouemail'] = $this->enviouemail;
      $NM_val_form['usuarioexterno'] = $this->usuarioexterno;
      $NM_val_form['enviouemailcobranca'] = $this->enviouemailcobranca;
      $NM_val_form['lidoemailcobranca'] = $this->lidoemailcobranca;
      $NM_val_form['notafiscal'] = $this->notafiscal;
      $NM_val_form['fechamentofinanceiro'] = $this->fechamentofinanceiro;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      if ($this->idlancamentoreceita === "" || is_null($this->idlancamentoreceita))  
      { 
          $this->idlancamentoreceita = 0;
      } 
      if ($this->idtenacidade === "" || is_null($this->idtenacidade))  
      { 
          $this->idtenacidade = 0;
          $this->sc_force_zero[] = 'idtenacidade';
      } 
      if ($this->idcliente === "" || is_null($this->idcliente))  
      { 
          $this->idcliente = 0;
          $this->sc_force_zero[] = 'idcliente';
      } 
      if ($this->idcontacaixa === "" || is_null($this->idcontacaixa))  
      { 
          $this->idcontacaixa = 0;
          $this->sc_force_zero[] = 'idcontacaixa';
      } 
      if ($this->idplanoconta === "" || is_null($this->idplanoconta))  
      { 
          $this->idplanoconta = 0;
          $this->sc_force_zero[] = 'idplanoconta';
      } 
      if ($this->idsituacaodocumento === "" || is_null($this->idsituacaodocumento))  
      { 
          $this->idsituacaodocumento = 0;
          $this->sc_force_zero[] = 'idsituacaodocumento';
      } 
      if ($this->idtipoespecie === "" || is_null($this->idtipoespecie))  
      { 
          $this->idtipoespecie = 0;
          $this->sc_force_zero[] = 'idtipoespecie';
      } 
      if ($this->idnotafiscal === "" || is_null($this->idnotafiscal))  
      { 
          $this->idnotafiscal = 0;
          $this->sc_force_zero[] = 'idnotafiscal';
      } 
      if ($this->idempresa === "" || is_null($this->idempresa))  
      { 
          $this->idempresa = 0;
          $this->sc_force_zero[] = 'idempresa';
      } 
      if ($this->idcontacaixaregistro === "" || is_null($this->idcontacaixaregistro))  
      { 
          $this->idcontacaixaregistro = 0;
          $this->sc_force_zero[] = 'idcontacaixaregistro';
      } 
      if ($this->idlancamentoreceitapai === "" || is_null($this->idlancamentoreceitapai))  
      { 
          $this->idlancamentoreceitapai = 0;
          $this->sc_force_zero[] = 'idlancamentoreceitapai';
      } 
      if ($this->idcontacaixatransferencia === "" || is_null($this->idcontacaixatransferencia))  
      { 
          $this->idcontacaixatransferencia = 0;
          $this->sc_force_zero[] = 'idcontacaixatransferencia';
      } 
      if ($this->idcontrato === "" || is_null($this->idcontrato))  
      { 
          $this->idcontrato = 0;
          $this->sc_force_zero[] = 'idcontrato';
      } 
      if ($this->idusuarioinclusao === "" || is_null($this->idusuarioinclusao))  
      { 
          $this->idusuarioinclusao = 0;
          $this->sc_force_zero[] = 'idusuarioinclusao';
      } 
      if ($this->idusuarioprevisao === "" || is_null($this->idusuarioprevisao))  
      { 
          $this->idusuarioprevisao = 0;
          $this->sc_force_zero[] = 'idusuarioprevisao';
      } 
      if ($this->idusuariorealizacao === "" || is_null($this->idusuariorealizacao))  
      { 
          $this->idusuariorealizacao = 0;
          $this->sc_force_zero[] = 'idusuariorealizacao';
      } 
      if ($this->idusuariobaixa === "" || is_null($this->idusuariobaixa))  
      { 
          $this->idusuariobaixa = 0;
          $this->sc_force_zero[] = 'idusuariobaixa';
      } 
      if ($this->idlancamentoreceitarecorrente === "" || is_null($this->idlancamentoreceitarecorrente))  
      { 
          $this->idlancamentoreceitarecorrente = 0;
          $this->sc_force_zero[] = 'idlancamentoreceitarecorrente';
      } 
      if ($this->idtipoagente === "" || is_null($this->idtipoagente))  
      { 
          $this->idtipoagente = 0;
          $this->sc_force_zero[] = 'idtipoagente';
      } 
      if ($this->idfornecedor === "" || is_null($this->idfornecedor))  
      { 
          $this->idfornecedor = 0;
          $this->sc_force_zero[] = 'idfornecedor';
      } 
      if ($this->idcolaborador === "" || is_null($this->idcolaborador))  
      { 
          $this->idcolaborador = 0;
          $this->sc_force_zero[] = 'idcolaborador';
      } 
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      if ($this->parcela === "" || is_null($this->parcela))  
      { 
          $this->parcela = 0;
          $this->sc_force_zero[] = 'parcela';
      } 
      if ($this->valorprevisao === "" || is_null($this->valorprevisao))  
      { 
          $this->valorprevisao = 0;
          $this->sc_force_zero[] = 'valorprevisao';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valoracrescimo === "" || is_null($this->valoracrescimo))  
      { 
          $this->valoracrescimo = 0;
          $this->sc_force_zero[] = 'valoracrescimo';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valordesconto === "" || is_null($this->valordesconto))  
      { 
          $this->valordesconto = 0;
          $this->sc_force_zero[] = 'valordesconto';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valormulta === "" || is_null($this->valormulta))  
      { 
          $this->valormulta = 0;
          $this->sc_force_zero[] = 'valormulta';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorjuros === "" || is_null($this->valorjuros))  
      { 
          $this->valorjuros = 0;
          $this->sc_force_zero[] = 'valorjuros';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->valorrealizacao === "" || is_null($this->valorrealizacao))  
      { 
          $this->valorrealizacao = 0;
          $this->sc_force_zero[] = 'valorrealizacao';
      } 
      }
      if ($this->nossonumero === "" || is_null($this->nossonumero))  
      { 
          $this->nossonumero = 0;
          $this->sc_force_zero[] = 'nossonumero';
      } 
      if ($this->valororiginal === "" || is_null($this->valororiginal))  
      { 
          $this->valororiginal = 0;
          $this->sc_force_zero[] = 'valororiginal';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->datainclusao == "")  
          { 
              $this->datainclusao = "null"; 
              $this->NM_val_null[] = "datainclusao";
          } 
          if ($this->dataprevisao == "")  
          { 
              $this->dataprevisao = "null"; 
              $this->NM_val_null[] = "dataprevisao";
          } 
          if ($this->datarealizacao == "")  
          { 
              $this->datarealizacao = "null"; 
              $this->NM_val_null[] = "datarealizacao";
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
          $this->numerodocumento_before_qstr = $this->numerodocumento;
          $this->numerodocumento = substr($this->Db->qstr($this->numerodocumento), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->numerodocumento = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->numerodocumento);
          }
          if ($this->numerodocumento == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->numerodocumento = "null"; 
              $this->NM_val_null[] = "numerodocumento";
          } 
          $this->contacontabil_before_qstr = $this->contacontabil;
          $this->contacontabil = substr($this->Db->qstr($this->contacontabil), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contacontabil = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->contacontabil);
          }
          if ($this->contacontabil == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->contacontabil = "null"; 
              $this->NM_val_null[] = "contacontabil";
          } 
          if ($this->databaixa == "")  
          { 
              $this->databaixa = "null"; 
              $this->NM_val_null[] = "databaixa";
          } 
          if ($this->datacompetencia == "")  
          { 
              $this->datacompetencia = "null"; 
              $this->NM_val_null[] = "datacompetencia";
          } 
          $this->historico_before_qstr = $this->historico;
          $this->historico = substr($this->Db->qstr($this->historico), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->historico = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->historico);
          }
          if ($this->historico == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->historico = "null"; 
              $this->NM_val_null[] = "historico";
          } 
          $this->nomearquivo1_before_qstr = $this->nomearquivo1;
          $this->nomearquivo1 = substr($this->Db->qstr($this->nomearquivo1), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomearquivo1 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomearquivo1);
          }
          if ($this->nomearquivo1 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomearquivo1 = "null"; 
              $this->NM_val_null[] = "nomearquivo1";
          } 
          $this->nomereferencia1_before_qstr = $this->nomereferencia1;
          $this->nomereferencia1 = substr($this->Db->qstr($this->nomereferencia1), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomereferencia1 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomereferencia1);
          }
          if ($this->nomereferencia1 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomereferencia1 = "null"; 
              $this->NM_val_null[] = "nomereferencia1";
          } 
          $this->nomearquivo2_before_qstr = $this->nomearquivo2;
          $this->nomearquivo2 = substr($this->Db->qstr($this->nomearquivo2), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomearquivo2 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomearquivo2);
          }
          if ($this->nomearquivo2 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomearquivo2 = "null"; 
              $this->NM_val_null[] = "nomearquivo2";
          } 
          $this->nomereferencia2_before_qstr = $this->nomereferencia2;
          $this->nomereferencia2 = substr($this->Db->qstr($this->nomereferencia2), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomereferencia2 = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomereferencia2);
          }
          if ($this->nomereferencia2 == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomereferencia2 = "null"; 
              $this->NM_val_null[] = "nomereferencia2";
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
          $this->unidadeorigem_before_qstr = $this->unidadeorigem;
          $this->unidadeorigem = substr($this->Db->qstr($this->unidadeorigem), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->unidadeorigem = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->unidadeorigem);
          }
          if ($this->unidadeorigem == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->unidadeorigem = "null"; 
              $this->NM_val_null[] = "unidadeorigem";
          } 
          $this->enviouemail_before_qstr = $this->enviouemail;
          $this->enviouemail = substr($this->Db->qstr($this->enviouemail), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->enviouemail = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->enviouemail);
          }
          if ($this->enviouemail == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->enviouemail = "null"; 
              $this->NM_val_null[] = "enviouemail";
          } 
          $this->usuarioexterno_before_qstr = $this->usuarioexterno;
          $this->usuarioexterno = substr($this->Db->qstr($this->usuarioexterno), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->usuarioexterno = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->usuarioexterno);
          }
          if ($this->usuarioexterno == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->usuarioexterno = "null"; 
              $this->NM_val_null[] = "usuarioexterno";
          } 
          $this->enviouemailcobranca_before_qstr = $this->enviouemailcobranca;
          $this->enviouemailcobranca = substr($this->Db->qstr($this->enviouemailcobranca), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->enviouemailcobranca = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->enviouemailcobranca);
          }
          if ($this->enviouemailcobranca == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->enviouemailcobranca = "null"; 
              $this->NM_val_null[] = "enviouemailcobranca";
          } 
          $this->lidoemailcobranca_before_qstr = $this->lidoemailcobranca;
          $this->lidoemailcobranca = substr($this->Db->qstr($this->lidoemailcobranca), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->lidoemailcobranca = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->lidoemailcobranca);
          }
          if ($this->lidoemailcobranca == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->lidoemailcobranca = "null"; 
              $this->NM_val_null[] = "lidoemailcobranca";
          } 
          $this->notafiscal_before_qstr = $this->notafiscal;
          $this->notafiscal = substr($this->Db->qstr($this->notafiscal), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->notafiscal = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->notafiscal);
          }
          if ($this->notafiscal == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->notafiscal = "null"; 
              $this->NM_val_null[] = "notafiscal";
          } 
          $this->fechamentofinanceiro_before_qstr = $this->fechamentofinanceiro;
          $this->fechamentofinanceiro = substr($this->Db->qstr($this->fechamentofinanceiro), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->fechamentofinanceiro = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->fechamentofinanceiro);
          }
          if ($this->fechamentofinanceiro == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->fechamentofinanceiro = "null"; 
              $this->NM_val_null[] = "fechamentofinanceiro";
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
          $this->recorrentetemp_before_qstr = $this->recorrentetemp;
          $this->recorrentetemp = substr($this->Db->qstr($this->recorrentetemp), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->recorrentetemp = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->recorrentetemp);
          }
          if ($this->recorrentetemp == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->recorrentetemp = "null"; 
              $this->NM_val_null[] = "recorrentetemp";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
              } 
              $Prep_Tst = (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] == "null"  && $this->nmgp_dados_select['idtenacidade'] == "") ? "null" : $this->nmgp_dados_select['idtenacidade'];
              if (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTenacidade = $this->idtenacidade"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idcliente']) && $NM_val_form['idcliente'] == "null"  && $this->nmgp_dados_select['idcliente'] == "") ? "null" : $this->nmgp_dados_select['idcliente'];
              if (isset($NM_val_form['idcliente']) && $NM_val_form['idcliente'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdCliente = $this->idcliente"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idcontacaixa']) && $NM_val_form['idcontacaixa'] == "null"  && $this->nmgp_dados_select['idcontacaixa'] == "") ? "null" : $this->nmgp_dados_select['idcontacaixa'];
              if (isset($NM_val_form['idcontacaixa']) && $NM_val_form['idcontacaixa'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdContaCaixa = $this->idcontacaixa"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idplanoconta']) && $NM_val_form['idplanoconta'] == "null"  && $this->nmgp_dados_select['idplanoconta'] == "") ? "null" : $this->nmgp_dados_select['idplanoconta'];
              if (isset($NM_val_form['idplanoconta']) && $NM_val_form['idplanoconta'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdPlanoConta = $this->idplanoconta"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idsituacaodocumento']) && $NM_val_form['idsituacaodocumento'] == "null"  && $this->nmgp_dados_select['idsituacaodocumento'] == "") ? "null" : $this->nmgp_dados_select['idsituacaodocumento'];
              if (isset($NM_val_form['idsituacaodocumento']) && $NM_val_form['idsituacaodocumento'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdSituacaoDocumento = $this->idsituacaodocumento"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idtipoespecie']) && $NM_val_form['idtipoespecie'] == "null"  && $this->nmgp_dados_select['idtipoespecie'] == "") ? "null" : $this->nmgp_dados_select['idtipoespecie'];
              if (isset($NM_val_form['idtipoespecie']) && $NM_val_form['idtipoespecie'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTipoEspecie = $this->idtipoespecie"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idnotafiscal']) && $NM_val_form['idnotafiscal'] == "null"  && $this->nmgp_dados_select['idnotafiscal'] == "") ? "null" : $this->nmgp_dados_select['idnotafiscal'];
              if (isset($NM_val_form['idnotafiscal']) && $NM_val_form['idnotafiscal'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdNotaFiscal = $this->idnotafiscal"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idempresa']) && $NM_val_form['idempresa'] == "null"  && $this->nmgp_dados_select['idempresa'] == "") ? "null" : $this->nmgp_dados_select['idempresa'];
              if (isset($NM_val_form['idempresa']) && $NM_val_form['idempresa'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdEmpresa = $this->idempresa"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idcontacaixaregistro']) && $NM_val_form['idcontacaixaregistro'] == "null"  && $this->nmgp_dados_select['idcontacaixaregistro'] == "") ? "null" : $this->nmgp_dados_select['idcontacaixaregistro'];
              if (isset($NM_val_form['idcontacaixaregistro']) && $NM_val_form['idcontacaixaregistro'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdContaCaixaRegistro = $this->idcontacaixaregistro"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idlancamentoreceitapai']) && $NM_val_form['idlancamentoreceitapai'] == "null"  && $this->nmgp_dados_select['idlancamentoreceitapai'] == "") ? "null" : $this->nmgp_dados_select['idlancamentoreceitapai'];
              if (isset($NM_val_form['idlancamentoreceitapai']) && $NM_val_form['idlancamentoreceitapai'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdLancamentoReceitaPai = $this->idlancamentoreceitapai"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idcontacaixatransferencia']) && $NM_val_form['idcontacaixatransferencia'] == "null"  && $this->nmgp_dados_select['idcontacaixatransferencia'] == "") ? "null" : $this->nmgp_dados_select['idcontacaixatransferencia'];
              if (isset($NM_val_form['idcontacaixatransferencia']) && $NM_val_form['idcontacaixatransferencia'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdContaCaixaTransferencia = $this->idcontacaixatransferencia"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idcontrato']) && $NM_val_form['idcontrato'] == "null"  && $this->nmgp_dados_select['idcontrato'] == "") ? "null" : $this->nmgp_dados_select['idcontrato'];
              if (isset($NM_val_form['idcontrato']) && $NM_val_form['idcontrato'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdContrato = $this->idcontrato"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioinclusao']) && $NM_val_form['idusuarioinclusao'] == "null"  && $this->nmgp_dados_select['idusuarioinclusao'] == "") ? "null" : $this->nmgp_dados_select['idusuarioinclusao'];
              if (isset($NM_val_form['idusuarioinclusao']) && $NM_val_form['idusuarioinclusao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioInclusao = $this->idusuarioinclusao"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioprevisao']) && $NM_val_form['idusuarioprevisao'] == "null"  && $this->nmgp_dados_select['idusuarioprevisao'] == "") ? "null" : $this->nmgp_dados_select['idusuarioprevisao'];
              if (isset($NM_val_form['idusuarioprevisao']) && $NM_val_form['idusuarioprevisao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioPrevisao = $this->idusuarioprevisao"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuariorealizacao']) && $NM_val_form['idusuariorealizacao'] == "null"  && $this->nmgp_dados_select['idusuariorealizacao'] == "") ? "null" : $this->nmgp_dados_select['idusuariorealizacao'];
              if (isset($NM_val_form['idusuariorealizacao']) && $NM_val_form['idusuariorealizacao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioRealizacao = $this->idusuariorealizacao"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuariobaixa']) && $NM_val_form['idusuariobaixa'] == "null"  && $this->nmgp_dados_select['idusuariobaixa'] == "") ? "null" : $this->nmgp_dados_select['idusuariobaixa'];
              if (isset($NM_val_form['idusuariobaixa']) && $NM_val_form['idusuariobaixa'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdusuarioBaixa = $this->idusuariobaixa"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idlancamentoreceitarecorrente']) && $NM_val_form['idlancamentoreceitarecorrente'] == "null"  && $this->nmgp_dados_select['idlancamentoreceitarecorrente'] == "") ? "null" : $this->nmgp_dados_select['idlancamentoreceitarecorrente'];
              if (isset($NM_val_form['idlancamentoreceitarecorrente']) && $NM_val_form['idlancamentoreceitarecorrente'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdLancamentoReceitaRecorrente = $this->idlancamentoreceitarecorrente"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idtipoagente']) && $NM_val_form['idtipoagente'] == "null"  && $this->nmgp_dados_select['idtipoagente'] == "") ? "null" : $this->nmgp_dados_select['idtipoagente'];
              if (isset($NM_val_form['idtipoagente']) && $NM_val_form['idtipoagente'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTipoAgente = $this->idtipoagente"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idfornecedor']) && $NM_val_form['idfornecedor'] == "null"  && $this->nmgp_dados_select['idfornecedor'] == "") ? "null" : $this->nmgp_dados_select['idfornecedor'];
              if (isset($NM_val_form['idfornecedor']) && $NM_val_form['idfornecedor'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdFornecedor = $this->idfornecedor"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idcolaborador']) && $NM_val_form['idcolaborador'] == "null"  && $this->nmgp_dados_select['idcolaborador'] == "") ? "null" : $this->nmgp_dados_select['idcolaborador'];
              if (isset($NM_val_form['idcolaborador']) && $NM_val_form['idcolaborador'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdColaborador = $this->idcolaborador"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] == "null"  && $this->nmgp_dados_select['idusuarioauditoria'] == "") ? "null" : $this->nmgp_dados_select['idusuarioauditoria'];
              if (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioAuditoria = $this->idusuarioauditoria"; 
              } 
              $Prep_Tst = (isset($NM_val_form['parcela']) && $NM_val_form['parcela'] == "null"  && $this->nmgp_dados_select['parcela'] == "") ? "null" : $this->nmgp_dados_select['parcela'];
              if (isset($NM_val_form['parcela']) && $NM_val_form['parcela'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Parcela = $this->parcela"; 
              } 
              $Prep_Tst = (isset($NM_val_form['datainclusao']) && $NM_val_form['datainclusao'] == "null"  && $this->nmgp_dados_select['datainclusao'] == "") ? "null" : $this->nmgp_dados_select['datainclusao'];
              if (isset($NM_val_form['datainclusao']) && $NM_val_form['datainclusao'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataInclusao = #$this->datainclusao#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataInclusao = " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['dataprevisao']) && $NM_val_form['dataprevisao'] == "null"  && $this->nmgp_dados_select['dataprevisao'] == "") ? "null" : $this->nmgp_dados_select['dataprevisao'];
              if (isset($NM_val_form['dataprevisao']) && $NM_val_form['dataprevisao'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataPrevisao = #$this->dataprevisao#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataPrevisao = " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['valorprevisao']) && $NM_val_form['valorprevisao'] == "null"  && $this->nmgp_dados_select['valorprevisao'] == "") ? "null" : $this->nmgp_dados_select['valorprevisao'];
              if (isset($NM_val_form['valorprevisao']) && $NM_val_form['valorprevisao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorPrevisao = $this->valorprevisao"; 
              } 
              $Prep_Tst = (isset($NM_val_form['datarealizacao']) && $NM_val_form['datarealizacao'] == "null"  && $this->nmgp_dados_select['datarealizacao'] == "") ? "null" : $this->nmgp_dados_select['datarealizacao'];
              if (isset($NM_val_form['datarealizacao']) && $NM_val_form['datarealizacao'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataRealizacao = #$this->datarealizacao#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataRealizacao = " . $this->Ini->date_delim . $this->datarealizacao . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['valoracrescimo']) && $NM_val_form['valoracrescimo'] == "null"  && $this->nmgp_dados_select['valoracrescimo'] == "") ? "null" : $this->nmgp_dados_select['valoracrescimo'];
              if (isset($NM_val_form['valoracrescimo']) && $NM_val_form['valoracrescimo'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorAcrescimo = $this->valoracrescimo"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valordesconto']) && $NM_val_form['valordesconto'] == "null"  && $this->nmgp_dados_select['valordesconto'] == "") ? "null" : $this->nmgp_dados_select['valordesconto'];
              if (isset($NM_val_form['valordesconto']) && $NM_val_form['valordesconto'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorDesconto = $this->valordesconto"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valormulta']) && $NM_val_form['valormulta'] == "null"  && $this->nmgp_dados_select['valormulta'] == "") ? "null" : $this->nmgp_dados_select['valormulta'];
              if (isset($NM_val_form['valormulta']) && $NM_val_form['valormulta'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorMulta = $this->valormulta"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valorjuros']) && $NM_val_form['valorjuros'] == "null"  && $this->nmgp_dados_select['valorjuros'] == "") ? "null" : $this->nmgp_dados_select['valorjuros'];
              if (isset($NM_val_form['valorjuros']) && $NM_val_form['valorjuros'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorJuros = $this->valorjuros"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valorrealizacao']) && $NM_val_form['valorrealizacao'] == "null"  && $this->nmgp_dados_select['valorrealizacao'] == "") ? "null" : $this->nmgp_dados_select['valorrealizacao'];
              if (isset($NM_val_form['valorrealizacao']) && $NM_val_form['valorrealizacao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorRealizacao = $this->valorrealizacao"; 
              } 
              $Prep_Tst = (isset($NM_val_form['numerodocumento']) && $NM_val_form['numerodocumento'] == "null"  && $this->nmgp_dados_select['numerodocumento'] == "") ? "null" : $this->nmgp_dados_select['numerodocumento'];
              if (isset($NM_val_form['numerodocumento']) && $NM_val_form['numerodocumento'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NumeroDocumento = '$this->numerodocumento'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['contacontabil']) && $NM_val_form['contacontabil'] == "null"  && $this->nmgp_dados_select['contacontabil'] == "") ? "null" : $this->nmgp_dados_select['contacontabil'];
              if (isset($NM_val_form['contacontabil']) && $NM_val_form['contacontabil'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ContaContabil = '$this->contacontabil'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['databaixa']) && $NM_val_form['databaixa'] == "null"  && $this->nmgp_dados_select['databaixa'] == "") ? "null" : $this->nmgp_dados_select['databaixa'];
              if (isset($NM_val_form['databaixa']) && $NM_val_form['databaixa'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataBaixa = #$this->databaixa#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataBaixa = " . $this->Ini->date_delim . $this->databaixa . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['datacompetencia']) && $NM_val_form['datacompetencia'] == "null"  && $this->nmgp_dados_select['datacompetencia'] == "") ? "null" : $this->nmgp_dados_select['datacompetencia'];
              if (isset($NM_val_form['datacompetencia']) && $NM_val_form['datacompetencia'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataCompetencia = #$this->datacompetencia#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataCompetencia = " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['historico']) && $NM_val_form['historico'] == "null"  && $this->nmgp_dados_select['historico'] == "") ? "null" : $this->nmgp_dados_select['historico'];
              if (isset($NM_val_form['historico']) && $NM_val_form['historico'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Historico = '$this->historico'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nomearquivo1']) && $NM_val_form['nomearquivo1'] == "null"  && $this->nmgp_dados_select['nomearquivo1'] == "") ? "null" : $this->nmgp_dados_select['nomearquivo1'];
              if (isset($NM_val_form['nomearquivo1']) && $NM_val_form['nomearquivo1'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NomeArquivo1 = '$this->nomearquivo1'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nomereferencia1']) && $NM_val_form['nomereferencia1'] == "null"  && $this->nmgp_dados_select['nomereferencia1'] == "") ? "null" : $this->nmgp_dados_select['nomereferencia1'];
              if (isset($NM_val_form['nomereferencia1']) && $NM_val_form['nomereferencia1'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NomeReferencia1 = '$this->nomereferencia1'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nomearquivo2']) && $NM_val_form['nomearquivo2'] == "null"  && $this->nmgp_dados_select['nomearquivo2'] == "") ? "null" : $this->nmgp_dados_select['nomearquivo2'];
              if (isset($NM_val_form['nomearquivo2']) && $NM_val_form['nomearquivo2'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NomeArquivo2 = '$this->nomearquivo2'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nomereferencia2']) && $NM_val_form['nomereferencia2'] == "null"  && $this->nmgp_dados_select['nomereferencia2'] == "") ? "null" : $this->nmgp_dados_select['nomereferencia2'];
              if (isset($NM_val_form['nomereferencia2']) && $NM_val_form['nomereferencia2'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NomeReferencia2 = '$this->nomereferencia2'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['observacoes']) && $NM_val_form['observacoes'] == "null"  && $this->nmgp_dados_select['observacoes'] == "") ? "null" : $this->nmgp_dados_select['observacoes'];
              if (isset($NM_val_form['observacoes']) && $NM_val_form['observacoes'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Observacoes = '$this->observacoes'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nossonumero']) && $NM_val_form['nossonumero'] == "null"  && $this->nmgp_dados_select['nossonumero'] == "") ? "null" : $this->nmgp_dados_select['nossonumero'];
              if (isset($NM_val_form['nossonumero']) && $NM_val_form['nossonumero'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NossoNumero = $this->nossonumero"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valororiginal']) && $NM_val_form['valororiginal'] == "null"  && $this->nmgp_dados_select['valororiginal'] == "") ? "null" : $this->nmgp_dados_select['valororiginal'];
              if (isset($NM_val_form['valororiginal']) && $NM_val_form['valororiginal'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorOriginal = $this->valororiginal"; 
              } 
              $Prep_Tst = (isset($NM_val_form['unidadeorigem']) && $NM_val_form['unidadeorigem'] == "null"  && $this->nmgp_dados_select['unidadeorigem'] == "") ? "null" : $this->nmgp_dados_select['unidadeorigem'];
              if (isset($NM_val_form['unidadeorigem']) && $NM_val_form['unidadeorigem'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "UnidadeOrigem = '$this->unidadeorigem'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['enviouemail']) && $NM_val_form['enviouemail'] == "null"  && $this->nmgp_dados_select['enviouemail'] == "") ? "null" : $this->nmgp_dados_select['enviouemail'];
              if (isset($NM_val_form['enviouemail']) && $NM_val_form['enviouemail'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "EnviouEmail = '$this->enviouemail'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['usuarioexterno']) && $NM_val_form['usuarioexterno'] == "null"  && $this->nmgp_dados_select['usuarioexterno'] == "") ? "null" : $this->nmgp_dados_select['usuarioexterno'];
              if (isset($NM_val_form['usuarioexterno']) && $NM_val_form['usuarioexterno'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "UsuarioExterno = '$this->usuarioexterno'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['enviouemailcobranca']) && $NM_val_form['enviouemailcobranca'] == "null"  && $this->nmgp_dados_select['enviouemailcobranca'] == "") ? "null" : $this->nmgp_dados_select['enviouemailcobranca'];
              if (isset($NM_val_form['enviouemailcobranca']) && $NM_val_form['enviouemailcobranca'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "EnviouEmailCobranca = '$this->enviouemailcobranca'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['lidoemailcobranca']) && $NM_val_form['lidoemailcobranca'] == "null"  && $this->nmgp_dados_select['lidoemailcobranca'] == "") ? "null" : $this->nmgp_dados_select['lidoemailcobranca'];
              if (isset($NM_val_form['lidoemailcobranca']) && $NM_val_form['lidoemailcobranca'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "LidoEmailCobranca = '$this->lidoemailcobranca'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['notafiscal']) && $NM_val_form['notafiscal'] == "null"  && $this->nmgp_dados_select['notafiscal'] == "") ? "null" : $this->nmgp_dados_select['notafiscal'];
              if (isset($NM_val_form['notafiscal']) && $NM_val_form['notafiscal'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "NotaFiscal = '$this->notafiscal'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['fechamentofinanceiro']) && $NM_val_form['fechamentofinanceiro'] == "null"  && $this->nmgp_dados_select['fechamentofinanceiro'] == "") ? "null" : $this->nmgp_dados_select['fechamentofinanceiro'];
              if (isset($NM_val_form['fechamentofinanceiro']) && $NM_val_form['fechamentofinanceiro'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "FechamentoFinanceiro = '$this->fechamentofinanceiro'"; 
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
                  $comando .= " WHERE IdLancamentoReceita = $this->idlancamentoreceita ";  
              }  
              else  
              {
                  $comando .= " WHERE IdLancamentoReceita = $this->idlancamentoreceita ";  
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
                                  LancamentoReceita_Recorrente_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->numerodocumento = $this->numerodocumento_before_qstr;
              $this->contacontabil = $this->contacontabil_before_qstr;
              $this->historico = $this->historico_before_qstr;
              $this->nomearquivo1 = $this->nomearquivo1_before_qstr;
              $this->nomereferencia1 = $this->nomereferencia1_before_qstr;
              $this->nomearquivo2 = $this->nomearquivo2_before_qstr;
              $this->nomereferencia2 = $this->nomereferencia2_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->unidadeorigem = $this->unidadeorigem_before_qstr;
              $this->enviouemail = $this->enviouemail_before_qstr;
              $this->usuarioexterno = $this->usuarioexterno_before_qstr;
              $this->enviouemailcobranca = $this->enviouemailcobranca_before_qstr;
              $this->lidoemailcobranca = $this->lidoemailcobranca_before_qstr;
              $this->notafiscal = $this->notafiscal_before_qstr;
              $this->fechamentofinanceiro = $this->fechamentofinanceiro_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->recorrentetemp = $this->recorrentetemp_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idcliente'])) { $this->idcliente = $NM_val_form['idcliente']; }
              elseif (isset($this->idcliente)) { $this->nm_limpa_alfa($this->idcliente); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcontacaixa'])) { $this->idcontacaixa = $NM_val_form['idcontacaixa']; }
              elseif (isset($this->idcontacaixa)) { $this->nm_limpa_alfa($this->idcontacaixa); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanoconta'])) { $this->idplanoconta = $NM_val_form['idplanoconta']; }
              elseif (isset($this->idplanoconta)) { $this->nm_limpa_alfa($this->idplanoconta); }
              if     (isset($NM_val_form) && isset($NM_val_form['idempresa'])) { $this->idempresa = $NM_val_form['idempresa']; }
              elseif (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
              if     (isset($NM_val_form) && isset($NM_val_form['idfornecedor'])) { $this->idfornecedor = $NM_val_form['idfornecedor']; }
              elseif (isset($this->idfornecedor)) { $this->nm_limpa_alfa($this->idfornecedor); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcolaborador'])) { $this->idcolaborador = $NM_val_form['idcolaborador']; }
              elseif (isset($this->idcolaborador)) { $this->nm_limpa_alfa($this->idcolaborador); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorprevisao'])) { $this->valorprevisao = $NM_val_form['valorprevisao']; }
              elseif (isset($this->valorprevisao)) { $this->nm_limpa_alfa($this->valorprevisao); }
              if     (isset($NM_val_form) && isset($NM_val_form['recorrentetemp'])) { $this->recorrentetemp = $NM_val_form['recorrentetemp']; }
              elseif (isset($this->recorrentetemp)) { $this->nm_limpa_alfa($this->recorrentetemp); }

              $this->nm_formatar_campos();

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('idcliente', 'idcolaborador', 'idfornecedor', 'idplanoconta', 'idcontacaixa', 'idempresa', 'dataprevisao', 'valorprevisao', 'tiporecorrencia', 'qtdrecorrencia', 'recorrentetemp'), $aDoNotUpdate);
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 0) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_pkey']); 
              $this->nmgp_opcao = "nada"; 
              $GLOBALS["erro_incl"] = 1; 
              $bInsertOk = false;
              $this->sc_evento = 'insert';
          } 
          $rs1->Close(); 
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
                  if ($this->valoracrescimo != "")
                  { 
                       $compl_insert     .= ", ValorAcrescimo";
                       $compl_insert_val .= ", $this->valoracrescimo";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valormulta != "")
                  { 
                       $compl_insert     .= ", ValorMulta";
                       $compl_insert_val .= ", $this->valormulta";
                  } 
                  if ($this->valorjuros != "")
                  { 
                       $compl_insert     .= ", ValorJuros";
                       $compl_insert_val .= ", $this->valorjuros";
                  } 
                  if ($this->valorrealizacao != "")
                  { 
                       $compl_insert     .= ", ValorRealizacao";
                       $compl_insert_val .= ", $this->valorrealizacao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdLancamentoReceita, IdTenacidade, IdCliente, IdContaCaixa, IdPlanoConta, IdSituacaoDocumento, IdTipoEspecie, IdNotaFiscal, IdEmpresa, IdContaCaixaRegistro, IdLancamentoReceitaPai, IdContaCaixaTransferencia, IdContrato, IdUsuarioInclusao, IdUsuarioPrevisao, IdUsuarioRealizacao, IdusuarioBaixa, IdLancamentoReceitaRecorrente, IdTipoAgente, IdFornecedor, IdColaborador, IdUsuarioAuditoria, Parcela, DataInclusao, DataPrevisao, ValorPrevisao, DataRealizacao, NumeroDocumento, ContaContabil, DataBaixa, DataCompetencia, Historico, NomeArquivo1, NomeReferencia1, NomeArquivo2, NomeReferencia2, Observacoes, NossoNumero, ValorOriginal, UnidadeOrigem, EnviouEmail, UsuarioExterno, EnviouEmailCobranca, LidoEmailCobranca, NotaFiscal, FechamentoFinanceiro, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES ($this->idlancamentoreceita, $this->idtenacidade, $this->idcliente, $this->idcontacaixa, $this->idplanoconta, $this->idsituacaodocumento, $this->idtipoespecie, $this->idnotafiscal, $this->idempresa, $this->idcontacaixaregistro, $this->idlancamentoreceitapai, $this->idcontacaixatransferencia, $this->idcontrato, $this->idusuarioinclusao, $this->idusuarioprevisao, $this->idusuariorealizacao, $this->idusuariobaixa, $this->idlancamentoreceitarecorrente, $this->idtipoagente, $this->idfornecedor, $this->idcolaborador, $this->idusuarioauditoria, $this->parcela, #$this->datainclusao#, #$this->dataprevisao#, $this->valorprevisao, #$this->datarealizacao#, '$this->numerodocumento', '$this->contacontabil', #$this->databaixa#, #$this->datacompetencia#, '$this->historico', '$this->nomearquivo1', '$this->nomereferencia1', '$this->nomearquivo2', '$this->nomereferencia2', '$this->observacoes', $this->nossonumero, $this->valororiginal, '$this->unidadeorigem', '$this->enviouemail', '$this->usuarioexterno', '$this->enviouemailcobranca', '$this->lidoemailcobranca', '$this->notafiscal', '$this->fechamentofinanceiro', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->valoracrescimo != "")
                  { 
                       $compl_insert     .= ", ValorAcrescimo";
                       $compl_insert_val .= ", $this->valoracrescimo";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valormulta != "")
                  { 
                       $compl_insert     .= ", ValorMulta";
                       $compl_insert_val .= ", $this->valormulta";
                  } 
                  if ($this->valorjuros != "")
                  { 
                       $compl_insert     .= ", ValorJuros";
                       $compl_insert_val .= ", $this->valorjuros";
                  } 
                  if ($this->valorrealizacao != "")
                  { 
                       $compl_insert     .= ", ValorRealizacao";
                       $compl_insert_val .= ", $this->valorrealizacao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdLancamentoReceita, IdTenacidade, IdCliente, IdContaCaixa, IdPlanoConta, IdSituacaoDocumento, IdTipoEspecie, IdNotaFiscal, IdEmpresa, IdContaCaixaRegistro, IdLancamentoReceitaPai, IdContaCaixaTransferencia, IdContrato, IdUsuarioInclusao, IdUsuarioPrevisao, IdUsuarioRealizacao, IdusuarioBaixa, IdLancamentoReceitaRecorrente, IdTipoAgente, IdFornecedor, IdColaborador, IdUsuarioAuditoria, Parcela, DataInclusao, DataPrevisao, ValorPrevisao, DataRealizacao, NumeroDocumento, ContaContabil, DataBaixa, DataCompetencia, Historico, NomeArquivo1, NomeReferencia1, NomeArquivo2, NomeReferencia2, Observacoes, NossoNumero, ValorOriginal, UnidadeOrigem, EnviouEmail, UsuarioExterno, EnviouEmailCobranca, LidoEmailCobranca, NotaFiscal, FechamentoFinanceiro, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idlancamentoreceita, $this->idtenacidade, $this->idcliente, $this->idcontacaixa, $this->idplanoconta, $this->idsituacaodocumento, $this->idtipoespecie, $this->idnotafiscal, $this->idempresa, $this->idcontacaixaregistro, $this->idlancamentoreceitapai, $this->idcontacaixatransferencia, $this->idcontrato, $this->idusuarioinclusao, $this->idusuarioprevisao, $this->idusuariorealizacao, $this->idusuariobaixa, $this->idlancamentoreceitarecorrente, $this->idtipoagente, $this->idfornecedor, $this->idcolaborador, $this->idusuarioauditoria, $this->parcela, " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", $this->valorprevisao, " . $this->Ini->date_delim . $this->datarealizacao . $this->Ini->date_delim1 . ", '$this->numerodocumento', '$this->contacontabil', " . $this->Ini->date_delim . $this->databaixa . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", '$this->historico', '$this->nomearquivo1', '$this->nomereferencia1', '$this->nomearquivo2', '$this->nomereferencia2', '$this->observacoes', $this->nossonumero, $this->valororiginal, '$this->unidadeorigem', '$this->enviouemail', '$this->usuarioexterno', '$this->enviouemailcobranca', '$this->lidoemailcobranca', '$this->notafiscal', '$this->fechamentofinanceiro', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->valoracrescimo != "")
                  { 
                       $compl_insert     .= ", ValorAcrescimo";
                       $compl_insert_val .= ", $this->valoracrescimo";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valormulta != "")
                  { 
                       $compl_insert     .= ", ValorMulta";
                       $compl_insert_val .= ", $this->valormulta";
                  } 
                  if ($this->valorjuros != "")
                  { 
                       $compl_insert     .= ", ValorJuros";
                       $compl_insert_val .= ", $this->valorjuros";
                  } 
                  if ($this->valorrealizacao != "")
                  { 
                       $compl_insert     .= ", ValorRealizacao";
                       $compl_insert_val .= ", $this->valorrealizacao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdLancamentoReceita, IdTenacidade, IdCliente, IdContaCaixa, IdPlanoConta, IdSituacaoDocumento, IdTipoEspecie, IdNotaFiscal, IdEmpresa, IdContaCaixaRegistro, IdLancamentoReceitaPai, IdContaCaixaTransferencia, IdContrato, IdUsuarioInclusao, IdUsuarioPrevisao, IdUsuarioRealizacao, IdusuarioBaixa, IdLancamentoReceitaRecorrente, IdTipoAgente, IdFornecedor, IdColaborador, IdUsuarioAuditoria, Parcela, DataInclusao, DataPrevisao, ValorPrevisao, DataRealizacao, NumeroDocumento, ContaContabil, DataBaixa, DataCompetencia, Historico, NomeArquivo1, NomeReferencia1, NomeArquivo2, NomeReferencia2, Observacoes, NossoNumero, ValorOriginal, UnidadeOrigem, EnviouEmail, UsuarioExterno, EnviouEmailCobranca, LidoEmailCobranca, NotaFiscal, FechamentoFinanceiro, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idlancamentoreceita, $this->idtenacidade, $this->idcliente, $this->idcontacaixa, $this->idplanoconta, $this->idsituacaodocumento, $this->idtipoespecie, $this->idnotafiscal, $this->idempresa, $this->idcontacaixaregistro, $this->idlancamentoreceitapai, $this->idcontacaixatransferencia, $this->idcontrato, $this->idusuarioinclusao, $this->idusuarioprevisao, $this->idusuariorealizacao, $this->idusuariobaixa, $this->idlancamentoreceitarecorrente, $this->idtipoagente, $this->idfornecedor, $this->idcolaborador, $this->idusuarioauditoria, $this->parcela, " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", $this->valorprevisao, " . $this->Ini->date_delim . $this->datarealizacao . $this->Ini->date_delim1 . ", '$this->numerodocumento', '$this->contacontabil', " . $this->Ini->date_delim . $this->databaixa . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", '$this->historico', '$this->nomearquivo1', '$this->nomereferencia1', '$this->nomearquivo2', '$this->nomereferencia2', '$this->observacoes', $this->nossonumero, $this->valororiginal, '$this->unidadeorigem', '$this->enviouemail', '$this->usuarioexterno', '$this->enviouemailcobranca', '$this->lidoemailcobranca', '$this->notafiscal', '$this->fechamentofinanceiro', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->valoracrescimo != "")
                  { 
                       $compl_insert     .= ", ValorAcrescimo";
                       $compl_insert_val .= ", $this->valoracrescimo";
                  } 
                  if ($this->valordesconto != "")
                  { 
                       $compl_insert     .= ", ValorDesconto";
                       $compl_insert_val .= ", $this->valordesconto";
                  } 
                  if ($this->valormulta != "")
                  { 
                       $compl_insert     .= ", ValorMulta";
                       $compl_insert_val .= ", $this->valormulta";
                  } 
                  if ($this->valorjuros != "")
                  { 
                       $compl_insert     .= ", ValorJuros";
                       $compl_insert_val .= ", $this->valorjuros";
                  } 
                  if ($this->valorrealizacao != "")
                  { 
                       $compl_insert     .= ", ValorRealizacao";
                       $compl_insert_val .= ", $this->valorrealizacao";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdLancamentoReceita, IdTenacidade, IdCliente, IdContaCaixa, IdPlanoConta, IdSituacaoDocumento, IdTipoEspecie, IdNotaFiscal, IdEmpresa, IdContaCaixaRegistro, IdLancamentoReceitaPai, IdContaCaixaTransferencia, IdContrato, IdUsuarioInclusao, IdUsuarioPrevisao, IdUsuarioRealizacao, IdusuarioBaixa, IdLancamentoReceitaRecorrente, IdTipoAgente, IdFornecedor, IdColaborador, IdUsuarioAuditoria, Parcela, DataInclusao, DataPrevisao, ValorPrevisao, DataRealizacao, NumeroDocumento, ContaContabil, DataBaixa, DataCompetencia, Historico, NomeArquivo1, NomeReferencia1, NomeArquivo2, NomeReferencia2, Observacoes, NossoNumero, ValorOriginal, UnidadeOrigem, EnviouEmail, UsuarioExterno, EnviouEmailCobranca, LidoEmailCobranca, NotaFiscal, FechamentoFinanceiro, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idlancamentoreceita, $this->idtenacidade, $this->idcliente, $this->idcontacaixa, $this->idplanoconta, $this->idsituacaodocumento, $this->idtipoespecie, $this->idnotafiscal, $this->idempresa, $this->idcontacaixaregistro, $this->idlancamentoreceitapai, $this->idcontacaixatransferencia, $this->idcontrato, $this->idusuarioinclusao, $this->idusuarioprevisao, $this->idusuariorealizacao, $this->idusuariobaixa, $this->idlancamentoreceitarecorrente, $this->idtipoagente, $this->idfornecedor, $this->idcolaborador, $this->idusuarioauditoria, $this->parcela, " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", $this->valorprevisao, " . $this->Ini->date_delim . $this->datarealizacao . $this->Ini->date_delim1 . ", '$this->numerodocumento', '$this->contacontabil', " . $this->Ini->date_delim . $this->databaixa . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", '$this->historico', '$this->nomearquivo1', '$this->nomereferencia1', '$this->nomearquivo2', '$this->nomereferencia2', '$this->observacoes', $this->nossonumero, $this->valororiginal, '$this->unidadeorigem', '$this->enviouemail', '$this->usuarioexterno', '$this->enviouemailcobranca', '$this->lidoemailcobranca', '$this->notafiscal', '$this->fechamentofinanceiro', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
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
                              LancamentoReceita_Recorrente_Frm_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              $this->numerodocumento = $this->numerodocumento_before_qstr;
              $this->contacontabil = $this->contacontabil_before_qstr;
              $this->historico = $this->historico_before_qstr;
              $this->nomearquivo1 = $this->nomearquivo1_before_qstr;
              $this->nomereferencia1 = $this->nomereferencia1_before_qstr;
              $this->nomearquivo2 = $this->nomearquivo2_before_qstr;
              $this->nomereferencia2 = $this->nomereferencia2_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->unidadeorigem = $this->unidadeorigem_before_qstr;
              $this->enviouemail = $this->enviouemail_before_qstr;
              $this->usuarioexterno = $this->usuarioexterno_before_qstr;
              $this->enviouemailcobranca = $this->enviouemailcobranca_before_qstr;
              $this->lidoemailcobranca = $this->lidoemailcobranca_before_qstr;
              $this->notafiscal = $this->notafiscal_before_qstr;
              $this->fechamentofinanceiro = $this->fechamentofinanceiro_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->recorrentetemp = $this->recorrentetemp_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->numerodocumento = $this->numerodocumento_before_qstr;
              $this->contacontabil = $this->contacontabil_before_qstr;
              $this->historico = $this->historico_before_qstr;
              $this->nomearquivo1 = $this->nomearquivo1_before_qstr;
              $this->nomereferencia1 = $this->nomereferencia1_before_qstr;
              $this->nomearquivo2 = $this->nomearquivo2_before_qstr;
              $this->nomereferencia2 = $this->nomereferencia2_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->unidadeorigem = $this->unidadeorigem_before_qstr;
              $this->enviouemail = $this->enviouemail_before_qstr;
              $this->usuarioexterno = $this->usuarioexterno_before_qstr;
              $this->enviouemailcobranca = $this->enviouemailcobranca_before_qstr;
              $this->lidoemailcobranca = $this->lidoemailcobranca_before_qstr;
              $this->notafiscal = $this->notafiscal_before_qstr;
              $this->fechamentofinanceiro = $this->fechamentofinanceiro_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->recorrentetemp = $this->recorrentetemp_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->nmgp_botoes['GerarRecorrencia'] = "on";
              $this->nmgp_botoes['GerarSimulacao'] = "on";
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->idlancamentoreceita = substr($this->Db->qstr($this->idlancamentoreceita), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdLancamentoReceita = $this->idlancamentoreceita "); 
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
                          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total']);
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
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['parms'] = "idlancamentoreceita?#?$this->idlancamentoreceita?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idlancamentoreceita = null === $this->idlancamentoreceita ? null : substr($this->Db->qstr($this->idlancamentoreceita), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter'] . ")";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdLancamentoReceita, IdTenacidade, IdCliente, IdContaCaixa, IdPlanoConta, IdSituacaoDocumento, IdTipoEspecie, IdNotaFiscal, IdEmpresa, IdContaCaixaRegistro, IdLancamentoReceitaPai, IdContaCaixaTransferencia, IdContrato, IdUsuarioInclusao, IdUsuarioPrevisao, IdUsuarioRealizacao, IdusuarioBaixa, IdLancamentoReceitaRecorrente, IdTipoAgente, IdFornecedor, IdColaborador, IdUsuarioAuditoria, Parcela, DataInclusao, DataPrevisao, ValorPrevisao, DataRealizacao, ValorAcrescimo, ValorDesconto, ValorMulta, ValorJuros, ValorRealizacao, NumeroDocumento, ContaContabil, DataBaixa, DataCompetencia, Historico, NomeArquivo1, NomeReferencia1, NomeArquivo2, NomeReferencia2, Observacoes, NossoNumero, ValorOriginal, UnidadeOrigem, EnviouEmail, UsuarioExterno, EnviouEmailCobranca, LidoEmailCobranca, NotaFiscal, FechamentoFinanceiro, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = "(IdLancamentoReceita = '" . $_SESSION['varIdLancamentoReceita'] . "')";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "IdLancamentoReceita = $this->idlancamentoreceita"; 
                  }  
                  else  
                  {
                     $aWhere[] = "IdLancamentoReceita = $this->idlancamentoreceita"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "IdLancamentoReceita";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['GerarRecorrencia'] = $this->nmgp_botoes['GerarRecorrencia'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['GerarSimulacao'] = $this->nmgp_botoes['GerarSimulacao'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes['update'] = "off";
              $this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes['delete'] = "off";
              return; 
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->idlancamentoreceita = $rs->fields[0] ; 
              $this->nmgp_dados_select['idlancamentoreceita'] = $this->idlancamentoreceita;
              $this->idtenacidade = $rs->fields[1] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idcliente = $rs->fields[2] ; 
              $this->nmgp_dados_select['idcliente'] = $this->idcliente;
              $this->idcontacaixa = $rs->fields[3] ; 
              $this->nmgp_dados_select['idcontacaixa'] = $this->idcontacaixa;
              $this->idplanoconta = $rs->fields[4] ; 
              $this->nmgp_dados_select['idplanoconta'] = $this->idplanoconta;
              $this->idsituacaodocumento = $rs->fields[5] ; 
              $this->nmgp_dados_select['idsituacaodocumento'] = $this->idsituacaodocumento;
              $this->idtipoespecie = $rs->fields[6] ; 
              $this->nmgp_dados_select['idtipoespecie'] = $this->idtipoespecie;
              $this->idnotafiscal = $rs->fields[7] ; 
              $this->nmgp_dados_select['idnotafiscal'] = $this->idnotafiscal;
              $this->idempresa = $rs->fields[8] ; 
              $this->nmgp_dados_select['idempresa'] = $this->idempresa;
              $this->idcontacaixaregistro = $rs->fields[9] ; 
              $this->nmgp_dados_select['idcontacaixaregistro'] = $this->idcontacaixaregistro;
              $this->idlancamentoreceitapai = $rs->fields[10] ; 
              $this->nmgp_dados_select['idlancamentoreceitapai'] = $this->idlancamentoreceitapai;
              $this->idcontacaixatransferencia = $rs->fields[11] ; 
              $this->nmgp_dados_select['idcontacaixatransferencia'] = $this->idcontacaixatransferencia;
              $this->idcontrato = $rs->fields[12] ; 
              $this->nmgp_dados_select['idcontrato'] = $this->idcontrato;
              $this->idusuarioinclusao = $rs->fields[13] ; 
              $this->nmgp_dados_select['idusuarioinclusao'] = $this->idusuarioinclusao;
              $this->idusuarioprevisao = $rs->fields[14] ; 
              $this->nmgp_dados_select['idusuarioprevisao'] = $this->idusuarioprevisao;
              $this->idusuariorealizacao = $rs->fields[15] ; 
              $this->nmgp_dados_select['idusuariorealizacao'] = $this->idusuariorealizacao;
              $this->idusuariobaixa = $rs->fields[16] ; 
              $this->nmgp_dados_select['idusuariobaixa'] = $this->idusuariobaixa;
              $this->idlancamentoreceitarecorrente = $rs->fields[17] ; 
              $this->nmgp_dados_select['idlancamentoreceitarecorrente'] = $this->idlancamentoreceitarecorrente;
              $this->idtipoagente = $rs->fields[18] ; 
              $this->nmgp_dados_select['idtipoagente'] = $this->idtipoagente;
              $this->idfornecedor = $rs->fields[19] ; 
              $this->nmgp_dados_select['idfornecedor'] = $this->idfornecedor;
              $this->idcolaborador = $rs->fields[20] ; 
              $this->nmgp_dados_select['idcolaborador'] = $this->idcolaborador;
              $this->idusuarioauditoria = $rs->fields[21] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->parcela = $rs->fields[22] ; 
              $this->nmgp_dados_select['parcela'] = $this->parcela;
              $this->datainclusao = $rs->fields[23] ; 
              if (substr($this->datainclusao, 10, 1) == "-") 
              { 
                 $this->datainclusao = substr($this->datainclusao, 0, 10) . " " . substr($this->datainclusao, 11);
              } 
              if (substr($this->datainclusao, 13, 1) == ".") 
              { 
                 $this->datainclusao = substr($this->datainclusao, 0, 13) . ":" . substr($this->datainclusao, 14, 2) . ":" . substr($this->datainclusao, 17);
              } 
              $this->nmgp_dados_select['datainclusao'] = $this->datainclusao;
              $this->dataprevisao = $rs->fields[24] ; 
              if (substr($this->dataprevisao, 10, 1) == "-") 
              { 
                 $this->dataprevisao = substr($this->dataprevisao, 0, 10) . " " . substr($this->dataprevisao, 11);
              } 
              if (substr($this->dataprevisao, 13, 1) == ".") 
              { 
                 $this->dataprevisao = substr($this->dataprevisao, 0, 13) . ":" . substr($this->dataprevisao, 14, 2) . ":" . substr($this->dataprevisao, 17);
              } 
              $this->nmgp_dados_select['dataprevisao'] = $this->dataprevisao;
              $this->valorprevisao = trim($rs->fields[25]) ; 
              $this->nmgp_dados_select['valorprevisao'] = $this->valorprevisao;
              $this->datarealizacao = $rs->fields[26] ; 
              if (substr($this->datarealizacao, 10, 1) == "-") 
              { 
                 $this->datarealizacao = substr($this->datarealizacao, 0, 10) . " " . substr($this->datarealizacao, 11);
              } 
              if (substr($this->datarealizacao, 13, 1) == ".") 
              { 
                 $this->datarealizacao = substr($this->datarealizacao, 0, 13) . ":" . substr($this->datarealizacao, 14, 2) . ":" . substr($this->datarealizacao, 17);
              } 
              $this->nmgp_dados_select['datarealizacao'] = $this->datarealizacao;
              $this->valoracrescimo = trim($rs->fields[27]) ; 
              $this->nmgp_dados_select['valoracrescimo'] = $this->valoracrescimo;
              $this->valordesconto = trim($rs->fields[28]) ; 
              $this->nmgp_dados_select['valordesconto'] = $this->valordesconto;
              $this->valormulta = trim($rs->fields[29]) ; 
              $this->nmgp_dados_select['valormulta'] = $this->valormulta;
              $this->valorjuros = trim($rs->fields[30]) ; 
              $this->nmgp_dados_select['valorjuros'] = $this->valorjuros;
              $this->valorrealizacao = trim($rs->fields[31]) ; 
              $this->nmgp_dados_select['valorrealizacao'] = $this->valorrealizacao;
              $this->numerodocumento = $rs->fields[32] ; 
              $this->nmgp_dados_select['numerodocumento'] = $this->numerodocumento;
              $this->contacontabil = $rs->fields[33] ; 
              $this->nmgp_dados_select['contacontabil'] = $this->contacontabil;
              $this->databaixa = $rs->fields[34] ; 
              if (substr($this->databaixa, 10, 1) == "-") 
              { 
                 $this->databaixa = substr($this->databaixa, 0, 10) . " " . substr($this->databaixa, 11);
              } 
              if (substr($this->databaixa, 13, 1) == ".") 
              { 
                 $this->databaixa = substr($this->databaixa, 0, 13) . ":" . substr($this->databaixa, 14, 2) . ":" . substr($this->databaixa, 17);
              } 
              $this->nmgp_dados_select['databaixa'] = $this->databaixa;
              $this->datacompetencia = $rs->fields[35] ; 
              $this->nmgp_dados_select['datacompetencia'] = $this->datacompetencia;
              $this->historico = $rs->fields[36] ; 
              $this->nmgp_dados_select['historico'] = $this->historico;
              $this->nomearquivo1 = $rs->fields[37] ; 
              $this->nmgp_dados_select['nomearquivo1'] = $this->nomearquivo1;
              $this->nomereferencia1 = $rs->fields[38] ; 
              $this->nmgp_dados_select['nomereferencia1'] = $this->nomereferencia1;
              $this->nomearquivo2 = $rs->fields[39] ; 
              $this->nmgp_dados_select['nomearquivo2'] = $this->nomearquivo2;
              $this->nomereferencia2 = $rs->fields[40] ; 
              $this->nmgp_dados_select['nomereferencia2'] = $this->nomereferencia2;
              $this->observacoes = $rs->fields[41] ; 
              $this->nmgp_dados_select['observacoes'] = $this->observacoes;
              $this->nossonumero = $rs->fields[42] ; 
              $this->nmgp_dados_select['nossonumero'] = $this->nossonumero;
              $this->valororiginal = trim($rs->fields[43]) ; 
              $this->nmgp_dados_select['valororiginal'] = $this->valororiginal;
              $this->unidadeorigem = $rs->fields[44] ; 
              $this->nmgp_dados_select['unidadeorigem'] = $this->unidadeorigem;
              $this->enviouemail = $rs->fields[45] ; 
              $this->nmgp_dados_select['enviouemail'] = $this->enviouemail;
              $this->usuarioexterno = $rs->fields[46] ; 
              $this->nmgp_dados_select['usuarioexterno'] = $this->usuarioexterno;
              $this->enviouemailcobranca = $rs->fields[47] ; 
              $this->nmgp_dados_select['enviouemailcobranca'] = $this->enviouemailcobranca;
              $this->lidoemailcobranca = $rs->fields[48] ; 
              $this->nmgp_dados_select['lidoemailcobranca'] = $this->lidoemailcobranca;
              $this->notafiscal = $rs->fields[49] ; 
              $this->nmgp_dados_select['notafiscal'] = $this->notafiscal;
              $this->fechamentofinanceiro = $rs->fields[50] ; 
              $this->nmgp_dados_select['fechamentofinanceiro'] = $this->fechamentofinanceiro;
              $this->enderecoipauditoria = $rs->fields[51] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[52] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->idlancamentoreceita = (string)$this->idlancamentoreceita; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idcliente = (string)$this->idcliente; 
              $this->idcontacaixa = (string)$this->idcontacaixa; 
              $this->idplanoconta = (string)$this->idplanoconta; 
              $this->idsituacaodocumento = (string)$this->idsituacaodocumento; 
              $this->idtipoespecie = (string)$this->idtipoespecie; 
              $this->idnotafiscal = (string)$this->idnotafiscal; 
              $this->idempresa = (string)$this->idempresa; 
              $this->idcontacaixaregistro = (string)$this->idcontacaixaregistro; 
              $this->idlancamentoreceitapai = (string)$this->idlancamentoreceitapai; 
              $this->idcontacaixatransferencia = (string)$this->idcontacaixatransferencia; 
              $this->idcontrato = (string)$this->idcontrato; 
              $this->idusuarioinclusao = (string)$this->idusuarioinclusao; 
              $this->idusuarioprevisao = (string)$this->idusuarioprevisao; 
              $this->idusuariorealizacao = (string)$this->idusuariorealizacao; 
              $this->idusuariobaixa = (string)$this->idusuariobaixa; 
              $this->idlancamentoreceitarecorrente = (string)$this->idlancamentoreceitarecorrente; 
              $this->idtipoagente = (string)$this->idtipoagente; 
              $this->idfornecedor = (string)$this->idfornecedor; 
              $this->idcolaborador = (string)$this->idcolaborador; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->parcela = (string)$this->parcela; 
              $this->valorprevisao = (strpos(strtolower($this->valorprevisao), "e")) ? (float)$this->valorprevisao : $this->valorprevisao; 
              $this->valorprevisao = (string)$this->valorprevisao; 
              $this->valoracrescimo = (strpos(strtolower($this->valoracrescimo), "e")) ? (float)$this->valoracrescimo : $this->valoracrescimo; 
              $this->valoracrescimo = (string)$this->valoracrescimo; 
              $this->valordesconto = (strpos(strtolower($this->valordesconto), "e")) ? (float)$this->valordesconto : $this->valordesconto; 
              $this->valordesconto = (string)$this->valordesconto; 
              $this->valormulta = (strpos(strtolower($this->valormulta), "e")) ? (float)$this->valormulta : $this->valormulta; 
              $this->valormulta = (string)$this->valormulta; 
              $this->valorjuros = (strpos(strtolower($this->valorjuros), "e")) ? (float)$this->valorjuros : $this->valorjuros; 
              $this->valorjuros = (string)$this->valorjuros; 
              $this->valorrealizacao = (strpos(strtolower($this->valorrealizacao), "e")) ? (float)$this->valorrealizacao : $this->valorrealizacao; 
              $this->valorrealizacao = (string)$this->valorrealizacao; 
              $this->nossonumero = (string)$this->nossonumero; 
              $this->valororiginal = (strpos(strtolower($this->valororiginal), "e")) ? (float)$this->valororiginal : $this->valororiginal; 
              $this->valororiginal = (string)$this->valororiginal; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['parms'] = "idlancamentoreceita?#?$this->idlancamentoreceita?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start'] < $qt_geral_reg_LancamentoReceita_Recorrente_Frm;
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao']   = '';
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
              $this->idlancamentoreceita = "";  
              $this->nmgp_dados_form["idlancamentoreceita"] = $this->idlancamentoreceita;
              $this->idtenacidade = "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idcliente = "";  
              $this->nmgp_dados_form["idcliente"] = $this->idcliente;
              $this->idcontacaixa = "";  
              $this->nmgp_dados_form["idcontacaixa"] = $this->idcontacaixa;
              $this->idplanoconta = "";  
              $this->nmgp_dados_form["idplanoconta"] = $this->idplanoconta;
              $this->idsituacaodocumento = "";  
              $this->nmgp_dados_form["idsituacaodocumento"] = $this->idsituacaodocumento;
              $this->idtipoespecie = "";  
              $this->nmgp_dados_form["idtipoespecie"] = $this->idtipoespecie;
              $this->idnotafiscal = "";  
              $this->nmgp_dados_form["idnotafiscal"] = $this->idnotafiscal;
              $this->idempresa = "";  
              $this->nmgp_dados_form["idempresa"] = $this->idempresa;
              $this->idcontacaixaregistro = "";  
              $this->nmgp_dados_form["idcontacaixaregistro"] = $this->idcontacaixaregistro;
              $this->idlancamentoreceitapai = "";  
              $this->nmgp_dados_form["idlancamentoreceitapai"] = $this->idlancamentoreceitapai;
              $this->idcontacaixatransferencia = "";  
              $this->nmgp_dados_form["idcontacaixatransferencia"] = $this->idcontacaixatransferencia;
              $this->idcontrato = "";  
              $this->nmgp_dados_form["idcontrato"] = $this->idcontrato;
              $this->idusuarioinclusao = "";  
              $this->nmgp_dados_form["idusuarioinclusao"] = $this->idusuarioinclusao;
              $this->idusuarioprevisao = "";  
              $this->nmgp_dados_form["idusuarioprevisao"] = $this->idusuarioprevisao;
              $this->idusuariorealizacao = "";  
              $this->nmgp_dados_form["idusuariorealizacao"] = $this->idusuariorealizacao;
              $this->idusuariobaixa = "";  
              $this->nmgp_dados_form["idusuariobaixa"] = $this->idusuariobaixa;
              $this->idlancamentoreceitarecorrente = "";  
              $this->nmgp_dados_form["idlancamentoreceitarecorrente"] = $this->idlancamentoreceitarecorrente;
              $this->idtipoagente = "";  
              $this->nmgp_dados_form["idtipoagente"] = $this->idtipoagente;
              $this->idfornecedor = "";  
              $this->nmgp_dados_form["idfornecedor"] = $this->idfornecedor;
              $this->idcolaborador = "";  
              $this->nmgp_dados_form["idcolaborador"] = $this->idcolaborador;
              $this->idusuarioauditoria = "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->parcela = "";  
              $this->nmgp_dados_form["parcela"] = $this->parcela;
              $this->datainclusao = "";  
              $this->datainclusao_hora = "" ;  
              $this->nmgp_dados_form["datainclusao"] = $this->datainclusao;
              $this->dataprevisao = "";  
              $this->dataprevisao_hora = "" ;  
              $this->nmgp_dados_form["dataprevisao"] = $this->dataprevisao;
              $this->valorprevisao = "";  
              $this->nmgp_dados_form["valorprevisao"] = $this->valorprevisao;
              $this->datarealizacao = "";  
              $this->datarealizacao_hora = "" ;  
              $this->nmgp_dados_form["datarealizacao"] = $this->datarealizacao;
              $this->valoracrescimo = "";  
              $this->nmgp_dados_form["valoracrescimo"] = $this->valoracrescimo;
              $this->valordesconto = "";  
              $this->nmgp_dados_form["valordesconto"] = $this->valordesconto;
              $this->valormulta = "";  
              $this->nmgp_dados_form["valormulta"] = $this->valormulta;
              $this->valorjuros = "";  
              $this->nmgp_dados_form["valorjuros"] = $this->valorjuros;
              $this->valorrealizacao = "";  
              $this->nmgp_dados_form["valorrealizacao"] = $this->valorrealizacao;
              $this->numerodocumento = "";  
              $this->nmgp_dados_form["numerodocumento"] = $this->numerodocumento;
              $this->contacontabil = "";  
              $this->nmgp_dados_form["contacontabil"] = $this->contacontabil;
              $this->databaixa = "";  
              $this->databaixa_hora = "" ;  
              $this->nmgp_dados_form["databaixa"] = $this->databaixa;
              $this->datacompetencia = "";  
              $this->datacompetencia_hora = "" ;  
              $this->nmgp_dados_form["datacompetencia"] = $this->datacompetencia;
              $this->historico = "";  
              $this->nmgp_dados_form["historico"] = $this->historico;
              $this->nomearquivo1 = "";  
              $this->nmgp_dados_form["nomearquivo1"] = $this->nomearquivo1;
              $this->nomereferencia1 = "";  
              $this->nmgp_dados_form["nomereferencia1"] = $this->nomereferencia1;
              $this->nomearquivo2 = "";  
              $this->nmgp_dados_form["nomearquivo2"] = $this->nomearquivo2;
              $this->nomereferencia2 = "";  
              $this->nmgp_dados_form["nomereferencia2"] = $this->nomereferencia2;
              $this->observacoes = "";  
              $this->nmgp_dados_form["observacoes"] = $this->observacoes;
              $this->nossonumero = "";  
              $this->nmgp_dados_form["nossonumero"] = $this->nossonumero;
              $this->valororiginal = "";  
              $this->nmgp_dados_form["valororiginal"] = $this->valororiginal;
              $this->unidadeorigem = "";  
              $this->nmgp_dados_form["unidadeorigem"] = $this->unidadeorigem;
              $this->enviouemail = "";  
              $this->nmgp_dados_form["enviouemail"] = $this->enviouemail;
              $this->usuarioexterno = "";  
              $this->nmgp_dados_form["usuarioexterno"] = $this->usuarioexterno;
              $this->enviouemailcobranca = "";  
              $this->nmgp_dados_form["enviouemailcobranca"] = $this->enviouemailcobranca;
              $this->lidoemailcobranca = "";  
              $this->nmgp_dados_form["lidoemailcobranca"] = $this->lidoemailcobranca;
              $this->notafiscal = "";  
              $this->nmgp_dados_form["notafiscal"] = $this->notafiscal;
              $this->fechamentofinanceiro = "";  
              $this->nmgp_dados_form["fechamentofinanceiro"] = $this->fechamentofinanceiro;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $this->qtdrecorrencia = "";  
              $this->nmgp_dados_form["qtdrecorrencia"] = $this->qtdrecorrencia;
              $this->recorrentetemp = "";  
              $this->nmgp_dados_form["recorrentetemp"] = $this->recorrentetemp;
              $this->tiporecorrencia = "";  
              $this->nmgp_dados_form["tiporecorrencia"] = $this->tiporecorrencia;
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['_LancamentoReceitaRecorrente_Lst']['embutida_parms'] = "varidlancamentoreceita*scin" . $this->nmgp_dados_form['idlancamentoreceita'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinok*scoutlink_remove_border*scinok*scoutlink_remove_background*scinno*scout";
  }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function QtdRecorrencia_onChange()
{
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varQtdRecorrencia)) {$this->sc_temp_varQtdRecorrencia = (isset($_SESSION['varQtdRecorrencia'])) ? $_SESSION['varQtdRecorrencia'] : "";}
  
$original_qtdrecorrencia = $this->qtdrecorrencia;

$this->sc_temp_varQtdRecorrencia = $this->qtdrecorrencia ;


if (isset($this->sc_temp_varQtdRecorrencia)) { $_SESSION['varQtdRecorrencia'] = $this->sc_temp_varQtdRecorrencia;}
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off';
$modificado_qtdrecorrencia = $this->qtdrecorrencia;
$this->nm_formatar_campos('qtdrecorrencia');
if ($original_qtdrecorrencia !== $modificado_qtdrecorrencia || isset($this->nmgp_cmp_readonly['qtdrecorrencia']) || (isset($bFlagRead_qtdrecorrencia) && $bFlagRead_qtdrecorrencia))
{
    $this->ajax_return_values_qtdrecorrencia(true);
}
$this->NM_ajax_info['event_field'] = 'QtdRecorrencia';
LancamentoReceita_Recorrente_Frm_pack_ajax_response();
exit;
}
function TipoRecorrencia_onClick()
{
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varTipoRecorrencia)) {$this->sc_temp_varTipoRecorrencia = (isset($_SESSION['varTipoRecorrencia'])) ? $_SESSION['varTipoRecorrencia'] : "";}
  
$original_tiporecorrencia = $this->tiporecorrencia;

$this->sc_temp_varTipoRecorrencia = $this->tiporecorrencia ;



if (isset($this->sc_temp_varTipoRecorrencia)) { $_SESSION['varTipoRecorrencia'] = $this->sc_temp_varTipoRecorrencia;}
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off';
$modificado_tiporecorrencia = $this->tiporecorrencia;
$this->nm_formatar_campos('tiporecorrencia');
if ($original_tiporecorrencia !== $modificado_tiporecorrencia || isset($this->nmgp_cmp_readonly['tiporecorrencia']) || (isset($bFlagRead_tiporecorrencia) && $bFlagRead_tiporecorrencia))
{
    $this->ajax_return_values_tiporecorrencia(true);
}
$this->NM_ajax_info['event_field'] = 'TipoRecorrencia';
LancamentoReceita_Recorrente_Frm_pack_ajax_response();
exit;
}
function gerarRegistros($parAcao)
{
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varAcao)) {$this->sc_temp_varAcao = (isset($_SESSION['varAcao'])) ? $_SESSION['varAcao'] : "";}
if (!isset($this->sc_temp_varToken)) {$this->sc_temp_varToken = (isset($_SESSION['varToken'])) ? $_SESSION['varToken'] : "";}
  
$delete_table  = '_lancamentodespesarecorrente';
$delete_where  = "Token = '$this->sc_temp_varToken'";
$delete_sql = 'DELETE FROM ' . $delete_table
    . ' WHERE '      . $delete_where;

     $nm_select = $delete_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


$dataPrevisao	 = substr($this->dataprevisao , 0, 10);
$dataRecorrencia = substr($this->datacompetencia , 0, 10);
$vetUltimoDia = array();
$vetUltimoDia[1] = 31;
$vetUltimoDia[2] = 28;
$vetUltimoDia[3] = 31;
$vetUltimoDia[4] = 30;
$vetUltimoDia[5] = 31;
$vetUltimoDia[6] = 30;
$vetUltimoDia[7] = 31;
$vetUltimoDia[8] = 31;
$vetUltimoDia[9] = 30;
$vetUltimoDia[10] = 31;
$vetUltimoDia[11] = 30;
$vetUltimoDia[11] = 31;
$anoAtual = substr($dataRecorrencia, 0, 4);
if($anoAtual % 4 == 0) {
	$vetUltimoDia[2] = 29;	
}
$diaPrevisao = substr($dataPrevisao, 8, 2);
$mesPrevisao = (int) substr($dataRecorrencia, 5, 2);
$ultimoDia = 0;
if ($diaPrevisao == $vetUltimoDia[$mesPrevisao]) {
	$ultimoDia = 1;	
}
for ($i = 1; $i <= $this->qtdrecorrencia ; $i++) {
	switch ($this->tiporecorrencia ) {
		case 1: 
			$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 15, 0, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
			break;
		case 2:  
			$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 1, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
			break;
		case 3: 
			$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 2, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
			break;
		case 4:
			$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 3, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
			break;
		case 5: 
			$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 6, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
			break;
		case 6: 
			$dataRecorrencia = 
         $this->nm_data->CalculaData($dataRecorrencia, "aaaa-mm-dd", "+ ", 0, 0, 1, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;
			break;
	}
	$diaRecorrencia = substr($dataRecorrencia, 8);
	$anoRecorrencia = substr($dataRecorrencia, 0, 4);
	if($anoRecorrencia % 4 == 0) {
		$vetUltimoDia[2] = 29;	
	}
	$diaRecorrencia = substr($dataRecorrencia, 8, 2);
	$mesRecorrencia = (int) substr($dataRecorrencia, 5, 2);

	if ($ultimoDia == 1) {
		$dataRecorrencia = substr($dataRecorrencia, 0, 8) . $vetUltimoDia[$mesRecorrencia];
	}
	$dataCompetencia = substr($dataRecorrencia, 0, 8) . '01';
	if ($this->sc_temp_varAcao == 1) {
		$insert_table  = '_lancamentodespesarecorrente';
		$insert_fields = array( 
			 'IdTenacidade' 					=> "'$this->idtenacidade'",
			 'IdFornecedor' 					=> "'$this->idfornecedor'",
			 'IdContaCaixa' 					=> "'$this->idcontacaixa'",
			 'IdPlanoConta' 					=> "'$this->idplanoconta'",
			 'IdEmpresa' 						=> "'$this->idempresa'",
			 'IdLancamentoDespesaRecorrente'	=> "'$idlancamentodespesa'",
			 'Token' 							=> "'$this->sc_temp_varToken'",
			 'Parcela' 							=> "'$i'",
			 'DataInclusao' 					=> "'$this->datainclusao'",
			 'DataPrevisao' 					=> "'$dataRecorrencia'",
			 'ValorPrevisao'					=> "$this->valorprevisao ",
			 'DataCompetencia' 					=> "'$dataCompetencia'",
			 'Historico' 						=> "'$this->historico'",
		);		
		$insert_sql = 'INSERT INTO ' . $insert_table
			. ' ('   . implode(', ', array_keys($insert_fields))   . ')'
			. ' VALUES ('    . implode(', ', array_values($insert_fields)) . ')';
		
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                LancamentoReceita_Recorrente_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
				
	} else {

	}
}
$this->sc_temp_varAcao = $parAcao;
echo "<script type=\"text/javascript\">";
echo "setTimeout(function() { window.location = \"" . $this->nmgp_url_saida . "?script_case_init=" . $this->form_encode_input($this->Ini->sc_page) . "\"; }, 500);";
echo "</script>";
if (isset($this->sc_temp_varToken)) { $_SESSION['varToken'] = $this->sc_temp_varToken;}
if (isset($this->sc_temp_varAcao)) { $_SESSION['varAcao'] = $this->sc_temp_varAcao;}
exit;
if (isset($this->sc_temp_varToken)) { $_SESSION['varToken'] = $this->sc_temp_varToken;}
if (isset($this->sc_temp_varAcao)) { $_SESSION['varAcao'] = $this->sc_temp_varAcao;}
$_SESSION['scriptcase']['LancamentoReceita_Recorrente_Frm']['contr_erro'] = 'off';
}
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              LancamentoReceita_Recorrente_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("LancamentoReceita_Recorrente_Frm_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idlancamentodespesa", "idtenacidade", "idfornecedor", "idcontacaixa", "idplanoconta", "idsituacaodocumento", "idtipoespecie", "idempresa", "idcheque", "idcontacaixaregistro", "idlancamentodespesapai", "idcontacaixatransferencia", "idusuarioinclusao", "idusuarioprevisao", "idusuarioagendamento", "idusuariorealizacao", "idusuariobaixa", "idlancamentodespesarecorrente", "idusuarioauditoria", "parcela", "datainclusao", "dataprevisao", "valorprevisao", "dataagendamento", "datarealizacao", "valoracrescimo", "valordesconto", "valormulta", "valorjuros", "valorrealizacao", "numerodocumento", "contacontabil", "databaixa", "datacompetencia", "historico", "observacoes", "nomearquivoboleto", "nomereferenciaboleto", "nomearquivonotafiscal", "nomereferencianotafiscal", "nomearquivocomprovante", "nomereferenciacomprovante", "fechamentofinanceiro", "enderecoipauditoria", "nomeaplicacaoauditoria"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['csrf_token'];
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

   function Form_lookup_tiporecorrencia()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Quinzenal?#?1?#?N?@?";
       $nmgp_def_dados .= "Mensal?#?2?#?N?@?";
       $nmgp_def_dados .= "Bimestral?#?3?#?N?@?";
       $nmgp_def_dados .= "Trimestral?#?4?#?N?@?";
       $nmgp_def_dados .= "Semestral?#?5?#?N?@?";
       $nmgp_def_dados .= "Anual?#?6?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
              $data_lookup = $this->SC_lookup_idtenacidade($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdTenacidade", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
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
              $data_lookup = $this->SC_lookup_idcontacaixa($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdContaCaixa", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idplanoconta($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdPlanoConta", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idsituacaodocumento($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdSituacaoDocumento", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idtipoespecie($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdTipoEspecie", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idempresa($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdEmpresa", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idcontacaixaregistro($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdContaCaixaRegistro", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idcontacaixatransferencia($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdContaCaixaTransferencia", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idusuarioinclusao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioInclusao", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idusuarioprevisao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioPrevisao", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idusuariorealizacao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioRealizacao", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "IdusuarioBaixa", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idusuarioauditoria($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioAuditoria", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Parcela", $arg_search, str_replace(",", ".", $data_search), "SMALLINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DataInclusao", $arg_search, $data_search, "DATETIME", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DataPrevisao", $arg_search, $data_search, "DATETIME", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorPrevisao", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DataRealizacao", $arg_search, $data_search, "DATETIME", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorAcrescimo", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorDesconto", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorMulta", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorJuros", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorRealizacao", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "NumeroDocumento", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ContaContabil", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DataBaixa", $arg_search, $data_search, "DATETIME", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DataCompetencia", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Historico", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Observacoes", $arg_search, $data_search, "TEXT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "FechamentoFinanceiro", $arg_search, $data_search, "CHAR", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter_form'] . " and ((IdLancamentoReceita = '" . $_SESSION['varIdLancamentoReceita'] . "')) and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where (IdLancamentoReceita = '" . $_SESSION['varIdLancamentoReceita'] . "') and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_LancamentoReceita_Recorrente_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total'] = $qt_geral_reg_LancamentoReceita_Recorrente_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
      $nm_numeric[] = "idlancamentoreceita";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idcliente";$nm_numeric[] = "idcontacaixa";$nm_numeric[] = "idplanoconta";$nm_numeric[] = "idsituacaodocumento";$nm_numeric[] = "idtipoespecie";$nm_numeric[] = "idnotafiscal";$nm_numeric[] = "idempresa";$nm_numeric[] = "idcontacaixaregistro";$nm_numeric[] = "idlancamentoreceitapai";$nm_numeric[] = "idcontacaixatransferencia";$nm_numeric[] = "idcontrato";$nm_numeric[] = "idusuarioinclusao";$nm_numeric[] = "idusuarioprevisao";$nm_numeric[] = "idusuariorealizacao";$nm_numeric[] = "idusuariobaixa";$nm_numeric[] = "idlancamentoreceitarecorrente";$nm_numeric[] = "idtipoagente";$nm_numeric[] = "idfornecedor";$nm_numeric[] = "idcolaborador";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "parcela";$nm_numeric[] = "valorprevisao";$nm_numeric[] = "valoracrescimo";$nm_numeric[] = "valordesconto";$nm_numeric[] = "valormulta";$nm_numeric[] = "valorjuros";$nm_numeric[] = "valorrealizacao";$nm_numeric[] = "nossonumero";$nm_numeric[] = "valororiginal";$nm_numeric[] = "";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['decimal_db'] == ".")
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
      $Nm_datas["datainclusao"] = "datetime";$Nm_datas["dataprevisao"] = "datetime";$Nm_datas["datarealizacao"] = "datetime";$Nm_datas["databaixa"] = "datetime";$Nm_datas["datacompetencia"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['SC_sep_date1'];
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
   function SC_lookup_idtenacidade($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdTenacidade, IdTenacidade FROM tenacidade WHERE (CAST (IdTenacidade AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdTenacidade, IdTenacidade FROM tenacidade WHERE (#cmp_iIdTenacidade#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idfornecedor($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT NomeFantasia, IdFornecedor FROM fornecedor WHERE (CAST (IdFornecedor AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT NomeFantasia, IdFornecedor FROM fornecedor WHERE (#cmp_iNomeFantasia#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idcontacaixa($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Descricao, IdContaCaixa, IdContaCaixa FROM contacaixa WHERE (CAST (IdContaCaixa AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT Descricao, IdContaCaixa, IdContaCaixa FROM contacaixa WHERE (#cmp_iDescricao#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idplanoconta($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Descricao, IdPlanoConta, IdPlanoConta FROM planoconta WHERE (CAST (IdPlanoConta AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT Descricao, IdPlanoConta, IdPlanoConta FROM planoconta WHERE (#cmp_iDescricao#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idsituacaodocumento($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdSituacaoDocumento, IdSituacaoDocumento FROM situacaodocumento WHERE (CAST (IdSituacaoDocumento AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdSituacaoDocumento, IdSituacaoDocumento FROM situacaodocumento WHERE (#cmp_iIdSituacaoDocumento#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idtipoespecie($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdTipoEspecie, IdTipoEspecie FROM tipoespecie WHERE (CAST (IdTipoEspecie AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdTipoEspecie, IdTipoEspecie FROM tipoespecie WHERE (#cmp_iIdTipoEspecie#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idempresa($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT NomeFantasia, IdEmpresa, IdEmpresa FROM empresa WHERE (CAST (IdEmpresa AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT NomeFantasia, IdEmpresa, IdEmpresa FROM empresa WHERE (#cmp_iNomeFantasia#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idcontacaixaregistro($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdContaCaixaRegistro, IdContaCaixaRegistro FROM contacaixaregistro WHERE (CAST (IdContaCaixaRegistro AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdContaCaixaRegistro, IdContaCaixaRegistro FROM contacaixaregistro WHERE (#cmp_iIdContaCaixaRegistro#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idcontacaixatransferencia($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdContaCaixa, IdContaCaixa FROM contacaixa WHERE (CAST (IdContaCaixa AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdContaCaixa, IdContaCaixa FROM contacaixa WHERE (#cmp_iIdContaCaixa#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idusuarioinclusao($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (CAST (IdUsuario AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (#cmp_iIdUsuario#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idusuarioprevisao($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (CAST (IdUsuario AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (#cmp_iIdUsuario#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idusuariorealizacao($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (CAST (IdUsuario AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (#cmp_iIdUsuario#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idusuarioauditoria($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (CAST (IdUsuario AS TEXT) LIKE '%$campo%')" ; 
       }
       else
       {
           $nm_comando = "SELECT IdUsuario, IdUsuario FROM usuario WHERE (#cmp_iIdUsuario#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
       $nmgp_saida_form = "LancamentoReceita_Recorrente_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "LancamentoReceita_Recorrente_Frm_fim.php";
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
       LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
       LancamentoReceita_Recorrente_Frm_pack_ajax_response();
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
        if ('datainclusao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('datarealizacao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('databaixa' == $sField)
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
            case "gerarsimulacao":
                return array("sc_GerarSimulacao_bot");
                break;
            case "gerarrecorrencia":
                return array("sc_GerarRecorrencia_bot");
                break;
            case "help":
                return array("sc_b_hlp_b");
                break;
            case "exit":
                return array("sc_b_sai_b.sc-unique-btn-1", "sc_b_sai_b.sc-unique-btn-3", "sc_b_sai_b.sc-unique-btn-2");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "Geração de recorrências de contas a receber (receitas)"; } else { echo "Geração de recorrências de contas a receber (receitas)"; } ?></span></td>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-footer">
<style>
#rod_col1 { margin:0px; padding: 3px 0px 0px 5px; float:left; overflow:hidden;}
#rod_col2 { margin:0px; padding: 3px 5px 0px 0px; float:right; overflow:hidden; text-align:right;}

</style>

<div style="width: 100%; height:20px;" class="scFormFooter">
        <span class="scFormFooterFont" id="rod_col1"><?php echo "* Campos obrigatórios" ?></span>
        <span class="scFormFooterFont" id="rod_col2">
<?php
$this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
echo $this->nm_data->FormataSaida("l, d @?#?@, F@?#?@, Y");
?>
</span>
</div>
    </td></tr>
<?php
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['LancamentoReceita_Recorrente_Frm']['ordem_ord'] == " desc") {
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
            case "IdCliente":
                return true;
            case "IdColaborador":
                return true;
            case "IdFornecedor":
                return true;
            case "IdPlanoConta":
                return true;
            case "IdContaCaixa":
                return true;
            case "IdEmpresa":
                return true;
            case "ValorPrevisao":
                return true;
            case "":
                return true;
            case "IdLancamentoReceita":
                return true;
            case "IdNotaFiscal":
                return true;
            case "IdLancamentoReceitaPai":
                return true;
            case "IdContrato":
                return true;
            case "IdusuarioBaixa":
                return true;
            case "IdLancamentoReceitaRecorrente":
                return true;
            case "IdTipoAgente":
                return true;
            case "Parcela":
                return true;
            case "ValorAcrescimo":
                return true;
            case "ValorDesconto":
                return true;
            case "ValorMulta":
                return true;
            case "ValorJuros":
                return true;
            case "ValorRealizacao":
                return true;
            case "NossoNumero":
                return true;
            case "ValorOriginal":
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
