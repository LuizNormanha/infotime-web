<?php
//
class Login_Ctr_apl
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
   var $login;
   var $pswd;
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
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['bok']))
          {
              $this->bok = $this->NM_ajax_info['param']['bok'];
          }
          if (isset($this->NM_ajax_info['param']['login']))
          {
              $this->login = $this->NM_ajax_info['param']['login'];
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
          if (isset($this->NM_ajax_info['param']['pswd']))
          {
              $this->pswd = $this->NM_ajax_info['param']['pswd'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
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
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varIdTenacidade) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (isset($this->varNomeUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varNomeUsuario'] = $this->varNomeUsuario;
      }
      if (isset($this->varEmailUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varEmailUsuario'] = $this->varEmailUsuario;
      }
      if (isset($this->varPrivAdmin) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
      }
      if (isset($this->varIndFinanceiro) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIndFinanceiro'] = $this->varIndFinanceiro;
      }
      if (isset($this->varChaveGeral) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varChaveGeral'] = $this->varChaveGeral;
      }
      if (isset($this->varIdFornecedorGrupo) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdFornecedorGrupo'] = $this->varIdFornecedorGrupo;
      }
      if (isset($this->varDescontoMaximoImp) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varDescontoMaximoImp'] = $this->varDescontoMaximoImp;
      }
      if (isset($this->varDescontoMaximoMes) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varDescontoMaximoMes'] = $this->varDescontoMaximoMes;
      }
      if (isset($this->varAcessoAuditoria) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varAcessoAuditoria'] = $this->varAcessoAuditoria;
      }
      if (isset($this->varEnderecoIpAuditoria) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varEnderecoIpAuditoria'] = $this->varEnderecoIpAuditoria;
      }
      if (isset($this->varIdGrupoUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdGrupoUsuario'] = $this->varIdGrupoUsuario;
      }
      if (isset($this->varAcessoAutorizacoes) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varAcessoAutorizacoes'] = $this->varAcessoAutorizacoes;
      }
      if (isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (isset($this->varIdSituacaoDocumentoExcluidoInt) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->varIdSituacaoDocumentoExcluidoInt;
      }
      if (isset($this->varIdSituacaoDocumentoBaixadoInt) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->varIdSituacaoDocumentoBaixadoInt;
      }
      if (isset($this->varServidorSMTP) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varServidorSMTP'] = $this->varServidorSMTP;
      }
      if (isset($this->varUsuarioSMTP) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varUsuarioSMTP'] = $this->varUsuarioSMTP;
      }
      if (isset($this->varSenhaSMTP) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varSenhaSMTP'] = $this->varSenhaSMTP;
      }
      if (isset($this->varRemetente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varRemetente'] = $this->varRemetente;
      }
      if (isset($this->varColaborador) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varColaborador'] = $this->varColaborador;
      }
      if (isset($this->varApelidoUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varApelidoUsuario'] = $this->varApelidoUsuario;
      }
      if (isset($this->varIdUsuarioColaborador) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
      }
      if (isset($this->varMesAnoReferencia) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varMesAnoReferencia'] = $this->varMesAnoReferencia;
      }
      if (isset($this->varFluxo) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varFluxo'] = $this->varFluxo;
      }
      if (isset($this->varEstoque) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varEstoque'] = $this->varEstoque;
      }
      if (isset($this->varListaEmpresa) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
      }
      if (isset($this->varImplantador) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varImplantador'] = $this->varImplantador;
      }
      if (isset($this->varEmailColaborador) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varEmailColaborador'] = $this->varEmailColaborador;
      }
      if (isset($this->varConsultorImplantacao) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varConsultorImplantacao'] = $this->varConsultorImplantacao;
      }
      if (isset($this->varLiderImplantacao) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varLiderImplantacao'] = $this->varLiderImplantacao;
      }
      if (isset($this->varIdContaCaixaPadrao) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdContaCaixaPadrao'] = $this->varIdContaCaixaPadrao;
      }
      if (isset($this->varListaPopDocumento) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varListaPopDocumento'] = $this->varListaPopDocumento;
      }
      if (isset($this->varUtilizaCentroCusto) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varUtilizaCentroCusto'] = $this->varUtilizaCentroCusto;
      }
      if (isset($_POST["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_POST["varIdUsuario"]) && isset($_POST["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_POST["varidusuario"];
      }
      if (isset($_POST["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
      }
      if (isset($_POST["varNomeUsuario"]) && isset($this->varNomeUsuario)) 
      {
          $_SESSION['varNomeUsuario'] = $this->varNomeUsuario;
      }
      if (!isset($_POST["varNomeUsuario"]) && isset($_POST["varnomeusuario"])) 
      {
          $_SESSION['varNomeUsuario'] = $_POST["varnomeusuario"];
      }
      if (isset($_POST["varEmailUsuario"]) && isset($this->varEmailUsuario)) 
      {
          $_SESSION['varEmailUsuario'] = $this->varEmailUsuario;
      }
      if (!isset($_POST["varEmailUsuario"]) && isset($_POST["varemailusuario"])) 
      {
          $_SESSION['varEmailUsuario'] = $_POST["varemailusuario"];
      }
      if (isset($_POST["varPrivAdmin"]) && isset($this->varPrivAdmin)) 
      {
          $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
      }
      if (!isset($_POST["varPrivAdmin"]) && isset($_POST["varprivadmin"])) 
      {
          $_SESSION['varPrivAdmin'] = $_POST["varprivadmin"];
      }
      if (isset($_POST["varIndFinanceiro"]) && isset($this->varIndFinanceiro)) 
      {
          $_SESSION['varIndFinanceiro'] = $this->varIndFinanceiro;
      }
      if (!isset($_POST["varIndFinanceiro"]) && isset($_POST["varindfinanceiro"])) 
      {
          $_SESSION['varIndFinanceiro'] = $_POST["varindfinanceiro"];
      }
      if (isset($_POST["varChaveGeral"]) && isset($this->varChaveGeral)) 
      {
          $_SESSION['varChaveGeral'] = $this->varChaveGeral;
      }
      if (!isset($_POST["varChaveGeral"]) && isset($_POST["varchavegeral"])) 
      {
          $_SESSION['varChaveGeral'] = $_POST["varchavegeral"];
      }
      if (isset($_POST["varIdFornecedorGrupo"]) && isset($this->varIdFornecedorGrupo)) 
      {
          $_SESSION['varIdFornecedorGrupo'] = $this->varIdFornecedorGrupo;
      }
      if (!isset($_POST["varIdFornecedorGrupo"]) && isset($_POST["varidfornecedorgrupo"])) 
      {
          $_SESSION['varIdFornecedorGrupo'] = $_POST["varidfornecedorgrupo"];
      }
      if (isset($_POST["varDescontoMaximoImp"]) && isset($this->varDescontoMaximoImp)) 
      {
          $_SESSION['varDescontoMaximoImp'] = $this->varDescontoMaximoImp;
      }
      if (!isset($_POST["varDescontoMaximoImp"]) && isset($_POST["vardescontomaximoimp"])) 
      {
          $_SESSION['varDescontoMaximoImp'] = $_POST["vardescontomaximoimp"];
      }
      if (isset($_POST["varDescontoMaximoMes"]) && isset($this->varDescontoMaximoMes)) 
      {
          $_SESSION['varDescontoMaximoMes'] = $this->varDescontoMaximoMes;
      }
      if (!isset($_POST["varDescontoMaximoMes"]) && isset($_POST["vardescontomaximomes"])) 
      {
          $_SESSION['varDescontoMaximoMes'] = $_POST["vardescontomaximomes"];
      }
      if (isset($_POST["varAcessoAuditoria"]) && isset($this->varAcessoAuditoria)) 
      {
          $_SESSION['varAcessoAuditoria'] = $this->varAcessoAuditoria;
      }
      if (!isset($_POST["varAcessoAuditoria"]) && isset($_POST["varacessoauditoria"])) 
      {
          $_SESSION['varAcessoAuditoria'] = $_POST["varacessoauditoria"];
      }
      if (isset($_POST["varEnderecoIpAuditoria"]) && isset($this->varEnderecoIpAuditoria)) 
      {
          $_SESSION['varEnderecoIpAuditoria'] = $this->varEnderecoIpAuditoria;
      }
      if (!isset($_POST["varEnderecoIpAuditoria"]) && isset($_POST["varenderecoipauditoria"])) 
      {
          $_SESSION['varEnderecoIpAuditoria'] = $_POST["varenderecoipauditoria"];
      }
      if (isset($_POST["varIdGrupoUsuario"]) && isset($this->varIdGrupoUsuario)) 
      {
          $_SESSION['varIdGrupoUsuario'] = $this->varIdGrupoUsuario;
      }
      if (!isset($_POST["varIdGrupoUsuario"]) && isset($_POST["varidgrupousuario"])) 
      {
          $_SESSION['varIdGrupoUsuario'] = $_POST["varidgrupousuario"];
      }
      if (isset($_POST["varAcessoAutorizacoes"]) && isset($this->varAcessoAutorizacoes)) 
      {
          $_SESSION['varAcessoAutorizacoes'] = $this->varAcessoAutorizacoes;
      }
      if (!isset($_POST["varAcessoAutorizacoes"]) && isset($_POST["varacessoautorizacoes"])) 
      {
          $_SESSION['varAcessoAutorizacoes'] = $_POST["varacessoautorizacoes"];
      }
      if (isset($_POST["varIdSituacaoDocumentoPendenteInt"]) && isset($this->varIdSituacaoDocumentoPendenteInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (!isset($_POST["varIdSituacaoDocumentoPendenteInt"]) && isset($_POST["varidsituacaodocumentopendenteint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_POST["varidsituacaodocumentopendenteint"];
      }
      if (isset($_POST["varIdSituacaoDocumentoExcluidoInt"]) && isset($this->varIdSituacaoDocumentoExcluidoInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->varIdSituacaoDocumentoExcluidoInt;
      }
      if (!isset($_POST["varIdSituacaoDocumentoExcluidoInt"]) && isset($_POST["varidsituacaodocumentoexcluidoint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $_POST["varidsituacaodocumentoexcluidoint"];
      }
      if (isset($_POST["varIdSituacaoDocumentoBaixadoInt"]) && isset($this->varIdSituacaoDocumentoBaixadoInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->varIdSituacaoDocumentoBaixadoInt;
      }
      if (!isset($_POST["varIdSituacaoDocumentoBaixadoInt"]) && isset($_POST["varidsituacaodocumentobaixadoint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $_POST["varidsituacaodocumentobaixadoint"];
      }
      if (isset($_POST["varServidorSMTP"]) && isset($this->varServidorSMTP)) 
      {
          $_SESSION['varServidorSMTP'] = $this->varServidorSMTP;
      }
      if (!isset($_POST["varServidorSMTP"]) && isset($_POST["varservidorsmtp"])) 
      {
          $_SESSION['varServidorSMTP'] = $_POST["varservidorsmtp"];
      }
      if (isset($_POST["varUsuarioSMTP"]) && isset($this->varUsuarioSMTP)) 
      {
          $_SESSION['varUsuarioSMTP'] = $this->varUsuarioSMTP;
      }
      if (!isset($_POST["varUsuarioSMTP"]) && isset($_POST["varusuariosmtp"])) 
      {
          $_SESSION['varUsuarioSMTP'] = $_POST["varusuariosmtp"];
      }
      if (isset($_POST["varSenhaSMTP"]) && isset($this->varSenhaSMTP)) 
      {
          $_SESSION['varSenhaSMTP'] = $this->varSenhaSMTP;
      }
      if (!isset($_POST["varSenhaSMTP"]) && isset($_POST["varsenhasmtp"])) 
      {
          $_SESSION['varSenhaSMTP'] = $_POST["varsenhasmtp"];
      }
      if (isset($_POST["varRemetente"]) && isset($this->varRemetente)) 
      {
          $_SESSION['varRemetente'] = $this->varRemetente;
      }
      if (!isset($_POST["varRemetente"]) && isset($_POST["varremetente"])) 
      {
          $_SESSION['varRemetente'] = $_POST["varremetente"];
      }
      if (isset($_POST["varColaborador"]) && isset($this->varColaborador)) 
      {
          $_SESSION['varColaborador'] = $this->varColaborador;
      }
      if (!isset($_POST["varColaborador"]) && isset($_POST["varcolaborador"])) 
      {
          $_SESSION['varColaborador'] = $_POST["varcolaborador"];
      }
      if (isset($_POST["varApelidoUsuario"]) && isset($this->varApelidoUsuario)) 
      {
          $_SESSION['varApelidoUsuario'] = $this->varApelidoUsuario;
      }
      if (!isset($_POST["varApelidoUsuario"]) && isset($_POST["varapelidousuario"])) 
      {
          $_SESSION['varApelidoUsuario'] = $_POST["varapelidousuario"];
      }
      if (isset($_POST["varIdUsuarioColaborador"]) && isset($this->varIdUsuarioColaborador)) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
      }
      if (!isset($_POST["varIdUsuarioColaborador"]) && isset($_POST["varidusuariocolaborador"])) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $_POST["varidusuariocolaborador"];
      }
      if (isset($_POST["varMesAnoReferencia"]) && isset($this->varMesAnoReferencia)) 
      {
          $_SESSION['varMesAnoReferencia'] = $this->varMesAnoReferencia;
      }
      if (!isset($_POST["varMesAnoReferencia"]) && isset($_POST["varmesanoreferencia"])) 
      {
          $_SESSION['varMesAnoReferencia'] = $_POST["varmesanoreferencia"];
      }
      if (isset($_POST["varFluxo"]) && isset($this->varFluxo)) 
      {
          $_SESSION['varFluxo'] = $this->varFluxo;
      }
      if (!isset($_POST["varFluxo"]) && isset($_POST["varfluxo"])) 
      {
          $_SESSION['varFluxo'] = $_POST["varfluxo"];
      }
      if (isset($_POST["varEstoque"]) && isset($this->varEstoque)) 
      {
          $_SESSION['varEstoque'] = $this->varEstoque;
      }
      if (!isset($_POST["varEstoque"]) && isset($_POST["varestoque"])) 
      {
          $_SESSION['varEstoque'] = $_POST["varestoque"];
      }
      if (isset($_POST["varListaEmpresa"]) && isset($this->varListaEmpresa)) 
      {
          $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
      }
      if (!isset($_POST["varListaEmpresa"]) && isset($_POST["varlistaempresa"])) 
      {
          $_SESSION['varListaEmpresa'] = $_POST["varlistaempresa"];
      }
      if (isset($_POST["varImplantador"]) && isset($this->varImplantador)) 
      {
          $_SESSION['varImplantador'] = $this->varImplantador;
      }
      if (!isset($_POST["varImplantador"]) && isset($_POST["varimplantador"])) 
      {
          $_SESSION['varImplantador'] = $_POST["varimplantador"];
      }
      if (isset($_POST["varEmailColaborador"]) && isset($this->varEmailColaborador)) 
      {
          $_SESSION['varEmailColaborador'] = $this->varEmailColaborador;
      }
      if (!isset($_POST["varEmailColaborador"]) && isset($_POST["varemailcolaborador"])) 
      {
          $_SESSION['varEmailColaborador'] = $_POST["varemailcolaborador"];
      }
      if (isset($_POST["varConsultorImplantacao"]) && isset($this->varConsultorImplantacao)) 
      {
          $_SESSION['varConsultorImplantacao'] = $this->varConsultorImplantacao;
      }
      if (!isset($_POST["varConsultorImplantacao"]) && isset($_POST["varconsultorimplantacao"])) 
      {
          $_SESSION['varConsultorImplantacao'] = $_POST["varconsultorimplantacao"];
      }
      if (isset($_POST["varLiderImplantacao"]) && isset($this->varLiderImplantacao)) 
      {
          $_SESSION['varLiderImplantacao'] = $this->varLiderImplantacao;
      }
      if (!isset($_POST["varLiderImplantacao"]) && isset($_POST["varliderimplantacao"])) 
      {
          $_SESSION['varLiderImplantacao'] = $_POST["varliderimplantacao"];
      }
      if (isset($_POST["varIdContaCaixaPadrao"]) && isset($this->varIdContaCaixaPadrao)) 
      {
          $_SESSION['varIdContaCaixaPadrao'] = $this->varIdContaCaixaPadrao;
      }
      if (!isset($_POST["varIdContaCaixaPadrao"]) && isset($_POST["varidcontacaixapadrao"])) 
      {
          $_SESSION['varIdContaCaixaPadrao'] = $_POST["varidcontacaixapadrao"];
      }
      if (isset($_POST["varListaPopDocumento"]) && isset($this->varListaPopDocumento)) 
      {
          $_SESSION['varListaPopDocumento'] = $this->varListaPopDocumento;
      }
      if (!isset($_POST["varListaPopDocumento"]) && isset($_POST["varlistapopdocumento"])) 
      {
          $_SESSION['varListaPopDocumento'] = $_POST["varlistapopdocumento"];
      }
      if (isset($_POST["varUtilizaCentroCusto"]) && isset($this->varUtilizaCentroCusto)) 
      {
          $_SESSION['varUtilizaCentroCusto'] = $this->varUtilizaCentroCusto;
      }
      if (!isset($_POST["varUtilizaCentroCusto"]) && isset($_POST["varutilizacentrocusto"])) 
      {
          $_SESSION['varUtilizaCentroCusto'] = $_POST["varutilizacentrocusto"];
      }
      if (isset($_GET["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_GET["varIdUsuario"]) && isset($_GET["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_GET["varidusuario"];
      }
      if (isset($_GET["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
      }
      if (isset($_GET["varNomeUsuario"]) && isset($this->varNomeUsuario)) 
      {
          $_SESSION['varNomeUsuario'] = $this->varNomeUsuario;
      }
      if (!isset($_GET["varNomeUsuario"]) && isset($_GET["varnomeusuario"])) 
      {
          $_SESSION['varNomeUsuario'] = $_GET["varnomeusuario"];
      }
      if (isset($_GET["varEmailUsuario"]) && isset($this->varEmailUsuario)) 
      {
          $_SESSION['varEmailUsuario'] = $this->varEmailUsuario;
      }
      if (!isset($_GET["varEmailUsuario"]) && isset($_GET["varemailusuario"])) 
      {
          $_SESSION['varEmailUsuario'] = $_GET["varemailusuario"];
      }
      if (isset($_GET["varPrivAdmin"]) && isset($this->varPrivAdmin)) 
      {
          $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
      }
      if (!isset($_GET["varPrivAdmin"]) && isset($_GET["varprivadmin"])) 
      {
          $_SESSION['varPrivAdmin'] = $_GET["varprivadmin"];
      }
      if (isset($_GET["varIndFinanceiro"]) && isset($this->varIndFinanceiro)) 
      {
          $_SESSION['varIndFinanceiro'] = $this->varIndFinanceiro;
      }
      if (!isset($_GET["varIndFinanceiro"]) && isset($_GET["varindfinanceiro"])) 
      {
          $_SESSION['varIndFinanceiro'] = $_GET["varindfinanceiro"];
      }
      if (isset($_GET["varChaveGeral"]) && isset($this->varChaveGeral)) 
      {
          $_SESSION['varChaveGeral'] = $this->varChaveGeral;
      }
      if (!isset($_GET["varChaveGeral"]) && isset($_GET["varchavegeral"])) 
      {
          $_SESSION['varChaveGeral'] = $_GET["varchavegeral"];
      }
      if (isset($_GET["varIdFornecedorGrupo"]) && isset($this->varIdFornecedorGrupo)) 
      {
          $_SESSION['varIdFornecedorGrupo'] = $this->varIdFornecedorGrupo;
      }
      if (!isset($_GET["varIdFornecedorGrupo"]) && isset($_GET["varidfornecedorgrupo"])) 
      {
          $_SESSION['varIdFornecedorGrupo'] = $_GET["varidfornecedorgrupo"];
      }
      if (isset($_GET["varDescontoMaximoImp"]) && isset($this->varDescontoMaximoImp)) 
      {
          $_SESSION['varDescontoMaximoImp'] = $this->varDescontoMaximoImp;
      }
      if (!isset($_GET["varDescontoMaximoImp"]) && isset($_GET["vardescontomaximoimp"])) 
      {
          $_SESSION['varDescontoMaximoImp'] = $_GET["vardescontomaximoimp"];
      }
      if (isset($_GET["varDescontoMaximoMes"]) && isset($this->varDescontoMaximoMes)) 
      {
          $_SESSION['varDescontoMaximoMes'] = $this->varDescontoMaximoMes;
      }
      if (!isset($_GET["varDescontoMaximoMes"]) && isset($_GET["vardescontomaximomes"])) 
      {
          $_SESSION['varDescontoMaximoMes'] = $_GET["vardescontomaximomes"];
      }
      if (isset($_GET["varAcessoAuditoria"]) && isset($this->varAcessoAuditoria)) 
      {
          $_SESSION['varAcessoAuditoria'] = $this->varAcessoAuditoria;
      }
      if (!isset($_GET["varAcessoAuditoria"]) && isset($_GET["varacessoauditoria"])) 
      {
          $_SESSION['varAcessoAuditoria'] = $_GET["varacessoauditoria"];
      }
      if (isset($_GET["varEnderecoIpAuditoria"]) && isset($this->varEnderecoIpAuditoria)) 
      {
          $_SESSION['varEnderecoIpAuditoria'] = $this->varEnderecoIpAuditoria;
      }
      if (!isset($_GET["varEnderecoIpAuditoria"]) && isset($_GET["varenderecoipauditoria"])) 
      {
          $_SESSION['varEnderecoIpAuditoria'] = $_GET["varenderecoipauditoria"];
      }
      if (isset($_GET["varIdGrupoUsuario"]) && isset($this->varIdGrupoUsuario)) 
      {
          $_SESSION['varIdGrupoUsuario'] = $this->varIdGrupoUsuario;
      }
      if (!isset($_GET["varIdGrupoUsuario"]) && isset($_GET["varidgrupousuario"])) 
      {
          $_SESSION['varIdGrupoUsuario'] = $_GET["varidgrupousuario"];
      }
      if (isset($_GET["varAcessoAutorizacoes"]) && isset($this->varAcessoAutorizacoes)) 
      {
          $_SESSION['varAcessoAutorizacoes'] = $this->varAcessoAutorizacoes;
      }
      if (!isset($_GET["varAcessoAutorizacoes"]) && isset($_GET["varacessoautorizacoes"])) 
      {
          $_SESSION['varAcessoAutorizacoes'] = $_GET["varacessoautorizacoes"];
      }
      if (isset($_GET["varIdSituacaoDocumentoPendenteInt"]) && isset($this->varIdSituacaoDocumentoPendenteInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (!isset($_GET["varIdSituacaoDocumentoPendenteInt"]) && isset($_GET["varidsituacaodocumentopendenteint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_GET["varidsituacaodocumentopendenteint"];
      }
      if (isset($_GET["varIdSituacaoDocumentoExcluidoInt"]) && isset($this->varIdSituacaoDocumentoExcluidoInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->varIdSituacaoDocumentoExcluidoInt;
      }
      if (!isset($_GET["varIdSituacaoDocumentoExcluidoInt"]) && isset($_GET["varidsituacaodocumentoexcluidoint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $_GET["varidsituacaodocumentoexcluidoint"];
      }
      if (isset($_GET["varIdSituacaoDocumentoBaixadoInt"]) && isset($this->varIdSituacaoDocumentoBaixadoInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->varIdSituacaoDocumentoBaixadoInt;
      }
      if (!isset($_GET["varIdSituacaoDocumentoBaixadoInt"]) && isset($_GET["varidsituacaodocumentobaixadoint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $_GET["varidsituacaodocumentobaixadoint"];
      }
      if (isset($_GET["varServidorSMTP"]) && isset($this->varServidorSMTP)) 
      {
          $_SESSION['varServidorSMTP'] = $this->varServidorSMTP;
      }
      if (!isset($_GET["varServidorSMTP"]) && isset($_GET["varservidorsmtp"])) 
      {
          $_SESSION['varServidorSMTP'] = $_GET["varservidorsmtp"];
      }
      if (isset($_GET["varUsuarioSMTP"]) && isset($this->varUsuarioSMTP)) 
      {
          $_SESSION['varUsuarioSMTP'] = $this->varUsuarioSMTP;
      }
      if (!isset($_GET["varUsuarioSMTP"]) && isset($_GET["varusuariosmtp"])) 
      {
          $_SESSION['varUsuarioSMTP'] = $_GET["varusuariosmtp"];
      }
      if (isset($_GET["varSenhaSMTP"]) && isset($this->varSenhaSMTP)) 
      {
          $_SESSION['varSenhaSMTP'] = $this->varSenhaSMTP;
      }
      if (!isset($_GET["varSenhaSMTP"]) && isset($_GET["varsenhasmtp"])) 
      {
          $_SESSION['varSenhaSMTP'] = $_GET["varsenhasmtp"];
      }
      if (isset($_GET["varRemetente"]) && isset($this->varRemetente)) 
      {
          $_SESSION['varRemetente'] = $this->varRemetente;
      }
      if (!isset($_GET["varRemetente"]) && isset($_GET["varremetente"])) 
      {
          $_SESSION['varRemetente'] = $_GET["varremetente"];
      }
      if (isset($_GET["varColaborador"]) && isset($this->varColaborador)) 
      {
          $_SESSION['varColaborador'] = $this->varColaborador;
      }
      if (!isset($_GET["varColaborador"]) && isset($_GET["varcolaborador"])) 
      {
          $_SESSION['varColaborador'] = $_GET["varcolaborador"];
      }
      if (isset($_GET["varApelidoUsuario"]) && isset($this->varApelidoUsuario)) 
      {
          $_SESSION['varApelidoUsuario'] = $this->varApelidoUsuario;
      }
      if (!isset($_GET["varApelidoUsuario"]) && isset($_GET["varapelidousuario"])) 
      {
          $_SESSION['varApelidoUsuario'] = $_GET["varapelidousuario"];
      }
      if (isset($_GET["varIdUsuarioColaborador"]) && isset($this->varIdUsuarioColaborador)) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
      }
      if (!isset($_GET["varIdUsuarioColaborador"]) && isset($_GET["varidusuariocolaborador"])) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $_GET["varidusuariocolaborador"];
      }
      if (isset($_GET["varMesAnoReferencia"]) && isset($this->varMesAnoReferencia)) 
      {
          $_SESSION['varMesAnoReferencia'] = $this->varMesAnoReferencia;
      }
      if (!isset($_GET["varMesAnoReferencia"]) && isset($_GET["varmesanoreferencia"])) 
      {
          $_SESSION['varMesAnoReferencia'] = $_GET["varmesanoreferencia"];
      }
      if (isset($_GET["varFluxo"]) && isset($this->varFluxo)) 
      {
          $_SESSION['varFluxo'] = $this->varFluxo;
      }
      if (!isset($_GET["varFluxo"]) && isset($_GET["varfluxo"])) 
      {
          $_SESSION['varFluxo'] = $_GET["varfluxo"];
      }
      if (isset($_GET["varEstoque"]) && isset($this->varEstoque)) 
      {
          $_SESSION['varEstoque'] = $this->varEstoque;
      }
      if (!isset($_GET["varEstoque"]) && isset($_GET["varestoque"])) 
      {
          $_SESSION['varEstoque'] = $_GET["varestoque"];
      }
      if (isset($_GET["varListaEmpresa"]) && isset($this->varListaEmpresa)) 
      {
          $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
      }
      if (!isset($_GET["varListaEmpresa"]) && isset($_GET["varlistaempresa"])) 
      {
          $_SESSION['varListaEmpresa'] = $_GET["varlistaempresa"];
      }
      if (isset($_GET["varImplantador"]) && isset($this->varImplantador)) 
      {
          $_SESSION['varImplantador'] = $this->varImplantador;
      }
      if (!isset($_GET["varImplantador"]) && isset($_GET["varimplantador"])) 
      {
          $_SESSION['varImplantador'] = $_GET["varimplantador"];
      }
      if (isset($_GET["varEmailColaborador"]) && isset($this->varEmailColaborador)) 
      {
          $_SESSION['varEmailColaborador'] = $this->varEmailColaborador;
      }
      if (!isset($_GET["varEmailColaborador"]) && isset($_GET["varemailcolaborador"])) 
      {
          $_SESSION['varEmailColaborador'] = $_GET["varemailcolaborador"];
      }
      if (isset($_GET["varConsultorImplantacao"]) && isset($this->varConsultorImplantacao)) 
      {
          $_SESSION['varConsultorImplantacao'] = $this->varConsultorImplantacao;
      }
      if (!isset($_GET["varConsultorImplantacao"]) && isset($_GET["varconsultorimplantacao"])) 
      {
          $_SESSION['varConsultorImplantacao'] = $_GET["varconsultorimplantacao"];
      }
      if (isset($_GET["varLiderImplantacao"]) && isset($this->varLiderImplantacao)) 
      {
          $_SESSION['varLiderImplantacao'] = $this->varLiderImplantacao;
      }
      if (!isset($_GET["varLiderImplantacao"]) && isset($_GET["varliderimplantacao"])) 
      {
          $_SESSION['varLiderImplantacao'] = $_GET["varliderimplantacao"];
      }
      if (isset($_GET["varIdContaCaixaPadrao"]) && isset($this->varIdContaCaixaPadrao)) 
      {
          $_SESSION['varIdContaCaixaPadrao'] = $this->varIdContaCaixaPadrao;
      }
      if (!isset($_GET["varIdContaCaixaPadrao"]) && isset($_GET["varidcontacaixapadrao"])) 
      {
          $_SESSION['varIdContaCaixaPadrao'] = $_GET["varidcontacaixapadrao"];
      }
      if (isset($_GET["varListaPopDocumento"]) && isset($this->varListaPopDocumento)) 
      {
          $_SESSION['varListaPopDocumento'] = $this->varListaPopDocumento;
      }
      if (!isset($_GET["varListaPopDocumento"]) && isset($_GET["varlistapopdocumento"])) 
      {
          $_SESSION['varListaPopDocumento'] = $_GET["varlistapopdocumento"];
      }
      if (isset($_GET["varUtilizaCentroCusto"]) && isset($this->varUtilizaCentroCusto)) 
      {
          $_SESSION['varUtilizaCentroCusto'] = $this->varUtilizaCentroCusto;
      }
      if (!isset($_GET["varUtilizaCentroCusto"]) && isset($_GET["varutilizacentrocusto"])) 
      {
          $_SESSION['varUtilizaCentroCusto'] = $_GET["varutilizacentrocusto"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['Login_Ctr']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['Login_Ctr']['embutida_parms']);
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
                 nm_limpa_str_Login_Ctr($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varNomeUsuario) && isset($this->varnomeusuario)) 
          {
              $this->varNomeUsuario = $this->varnomeusuario;
          }
          if (isset($this->varNomeUsuario)) 
          {
              $_SESSION['varNomeUsuario'] = $this->varNomeUsuario;
          }
          if (!isset($this->varEmailUsuario) && isset($this->varemailusuario)) 
          {
              $this->varEmailUsuario = $this->varemailusuario;
          }
          if (isset($this->varEmailUsuario)) 
          {
              $_SESSION['varEmailUsuario'] = $this->varEmailUsuario;
          }
          if (!isset($this->varPrivAdmin) && isset($this->varprivadmin)) 
          {
              $this->varPrivAdmin = $this->varprivadmin;
          }
          if (isset($this->varPrivAdmin)) 
          {
              $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
          }
          if (!isset($this->varIndFinanceiro) && isset($this->varindfinanceiro)) 
          {
              $this->varIndFinanceiro = $this->varindfinanceiro;
          }
          if (isset($this->varIndFinanceiro)) 
          {
              $_SESSION['varIndFinanceiro'] = $this->varIndFinanceiro;
          }
          if (!isset($this->varChaveGeral) && isset($this->varchavegeral)) 
          {
              $this->varChaveGeral = $this->varchavegeral;
          }
          if (isset($this->varChaveGeral)) 
          {
              $_SESSION['varChaveGeral'] = $this->varChaveGeral;
          }
          if (!isset($this->varIdFornecedorGrupo) && isset($this->varidfornecedorgrupo)) 
          {
              $this->varIdFornecedorGrupo = $this->varidfornecedorgrupo;
          }
          if (isset($this->varIdFornecedorGrupo)) 
          {
              $_SESSION['varIdFornecedorGrupo'] = $this->varIdFornecedorGrupo;
          }
          if (!isset($this->varDescontoMaximoImp) && isset($this->vardescontomaximoimp)) 
          {
              $this->varDescontoMaximoImp = $this->vardescontomaximoimp;
          }
          if (isset($this->varDescontoMaximoImp)) 
          {
              $_SESSION['varDescontoMaximoImp'] = $this->varDescontoMaximoImp;
          }
          if (!isset($this->varDescontoMaximoMes) && isset($this->vardescontomaximomes)) 
          {
              $this->varDescontoMaximoMes = $this->vardescontomaximomes;
          }
          if (isset($this->varDescontoMaximoMes)) 
          {
              $_SESSION['varDescontoMaximoMes'] = $this->varDescontoMaximoMes;
          }
          if (!isset($this->varAcessoAuditoria) && isset($this->varacessoauditoria)) 
          {
              $this->varAcessoAuditoria = $this->varacessoauditoria;
          }
          if (isset($this->varAcessoAuditoria)) 
          {
              $_SESSION['varAcessoAuditoria'] = $this->varAcessoAuditoria;
          }
          if (!isset($this->varEnderecoIpAuditoria) && isset($this->varenderecoipauditoria)) 
          {
              $this->varEnderecoIpAuditoria = $this->varenderecoipauditoria;
          }
          if (isset($this->varEnderecoIpAuditoria)) 
          {
              $_SESSION['varEnderecoIpAuditoria'] = $this->varEnderecoIpAuditoria;
          }
          if (!isset($this->varIdGrupoUsuario) && isset($this->varidgrupousuario)) 
          {
              $this->varIdGrupoUsuario = $this->varidgrupousuario;
          }
          if (isset($this->varIdGrupoUsuario)) 
          {
              $_SESSION['varIdGrupoUsuario'] = $this->varIdGrupoUsuario;
          }
          if (!isset($this->varAcessoAutorizacoes) && isset($this->varacessoautorizacoes)) 
          {
              $this->varAcessoAutorizacoes = $this->varacessoautorizacoes;
          }
          if (isset($this->varAcessoAutorizacoes)) 
          {
              $_SESSION['varAcessoAutorizacoes'] = $this->varAcessoAutorizacoes;
          }
          if (!isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->varidsituacaodocumentopendenteint)) 
          {
              $this->varIdSituacaoDocumentoPendenteInt = $this->varidsituacaodocumentopendenteint;
          }
          if (isset($this->varIdSituacaoDocumentoPendenteInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
          }
          if (!isset($this->varIdSituacaoDocumentoExcluidoInt) && isset($this->varidsituacaodocumentoexcluidoint)) 
          {
              $this->varIdSituacaoDocumentoExcluidoInt = $this->varidsituacaodocumentoexcluidoint;
          }
          if (isset($this->varIdSituacaoDocumentoExcluidoInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->varIdSituacaoDocumentoExcluidoInt;
          }
          if (!isset($this->varIdSituacaoDocumentoBaixadoInt) && isset($this->varidsituacaodocumentobaixadoint)) 
          {
              $this->varIdSituacaoDocumentoBaixadoInt = $this->varidsituacaodocumentobaixadoint;
          }
          if (isset($this->varIdSituacaoDocumentoBaixadoInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->varIdSituacaoDocumentoBaixadoInt;
          }
          if (!isset($this->varServidorSMTP) && isset($this->varservidorsmtp)) 
          {
              $this->varServidorSMTP = $this->varservidorsmtp;
          }
          if (isset($this->varServidorSMTP)) 
          {
              $_SESSION['varServidorSMTP'] = $this->varServidorSMTP;
          }
          if (!isset($this->varUsuarioSMTP) && isset($this->varusuariosmtp)) 
          {
              $this->varUsuarioSMTP = $this->varusuariosmtp;
          }
          if (isset($this->varUsuarioSMTP)) 
          {
              $_SESSION['varUsuarioSMTP'] = $this->varUsuarioSMTP;
          }
          if (!isset($this->varSenhaSMTP) && isset($this->varsenhasmtp)) 
          {
              $this->varSenhaSMTP = $this->varsenhasmtp;
          }
          if (isset($this->varSenhaSMTP)) 
          {
              $_SESSION['varSenhaSMTP'] = $this->varSenhaSMTP;
          }
          if (!isset($this->varRemetente) && isset($this->varremetente)) 
          {
              $this->varRemetente = $this->varremetente;
          }
          if (isset($this->varRemetente)) 
          {
              $_SESSION['varRemetente'] = $this->varRemetente;
          }
          if (!isset($this->varColaborador) && isset($this->varcolaborador)) 
          {
              $this->varColaborador = $this->varcolaborador;
          }
          if (isset($this->varColaborador)) 
          {
              $_SESSION['varColaborador'] = $this->varColaborador;
          }
          if (!isset($this->varApelidoUsuario) && isset($this->varapelidousuario)) 
          {
              $this->varApelidoUsuario = $this->varapelidousuario;
          }
          if (isset($this->varApelidoUsuario)) 
          {
              $_SESSION['varApelidoUsuario'] = $this->varApelidoUsuario;
          }
          if (!isset($this->varIdUsuarioColaborador) && isset($this->varidusuariocolaborador)) 
          {
              $this->varIdUsuarioColaborador = $this->varidusuariocolaborador;
          }
          if (isset($this->varIdUsuarioColaborador)) 
          {
              $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
          }
          if (!isset($this->varMesAnoReferencia) && isset($this->varmesanoreferencia)) 
          {
              $this->varMesAnoReferencia = $this->varmesanoreferencia;
          }
          if (isset($this->varMesAnoReferencia)) 
          {
              $_SESSION['varMesAnoReferencia'] = $this->varMesAnoReferencia;
          }
          if (!isset($this->varFluxo) && isset($this->varfluxo)) 
          {
              $this->varFluxo = $this->varfluxo;
          }
          if (isset($this->varFluxo)) 
          {
              $_SESSION['varFluxo'] = $this->varFluxo;
          }
          if (!isset($this->varEstoque) && isset($this->varestoque)) 
          {
              $this->varEstoque = $this->varestoque;
          }
          if (isset($this->varEstoque)) 
          {
              $_SESSION['varEstoque'] = $this->varEstoque;
          }
          if (!isset($this->varListaEmpresa) && isset($this->varlistaempresa)) 
          {
              $this->varListaEmpresa = $this->varlistaempresa;
          }
          if (isset($this->varListaEmpresa)) 
          {
              $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
          }
          if (!isset($this->varImplantador) && isset($this->varimplantador)) 
          {
              $this->varImplantador = $this->varimplantador;
          }
          if (isset($this->varImplantador)) 
          {
              $_SESSION['varImplantador'] = $this->varImplantador;
          }
          if (!isset($this->varEmailColaborador) && isset($this->varemailcolaborador)) 
          {
              $this->varEmailColaborador = $this->varemailcolaborador;
          }
          if (isset($this->varEmailColaborador)) 
          {
              $_SESSION['varEmailColaborador'] = $this->varEmailColaborador;
          }
          if (!isset($this->varConsultorImplantacao) && isset($this->varconsultorimplantacao)) 
          {
              $this->varConsultorImplantacao = $this->varconsultorimplantacao;
          }
          if (isset($this->varConsultorImplantacao)) 
          {
              $_SESSION['varConsultorImplantacao'] = $this->varConsultorImplantacao;
          }
          if (!isset($this->varLiderImplantacao) && isset($this->varliderimplantacao)) 
          {
              $this->varLiderImplantacao = $this->varliderimplantacao;
          }
          if (isset($this->varLiderImplantacao)) 
          {
              $_SESSION['varLiderImplantacao'] = $this->varLiderImplantacao;
          }
          if (!isset($this->varIdContaCaixaPadrao) && isset($this->varidcontacaixapadrao)) 
          {
              $this->varIdContaCaixaPadrao = $this->varidcontacaixapadrao;
          }
          if (isset($this->varIdContaCaixaPadrao)) 
          {
              $_SESSION['varIdContaCaixaPadrao'] = $this->varIdContaCaixaPadrao;
          }
          if (!isset($this->varListaPopDocumento) && isset($this->varlistapopdocumento)) 
          {
              $this->varListaPopDocumento = $this->varlistapopdocumento;
          }
          if (isset($this->varListaPopDocumento)) 
          {
              $_SESSION['varListaPopDocumento'] = $this->varListaPopDocumento;
          }
          if (!isset($this->varUtilizaCentroCusto) && isset($this->varutilizacentrocusto)) 
          {
              $this->varUtilizaCentroCusto = $this->varutilizacentrocusto;
          }
          if (isset($this->varUtilizaCentroCusto)) 
          {
              $_SESSION['varUtilizaCentroCusto'] = $this->varUtilizaCentroCusto;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['Login_Ctr']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['Login_Ctr']['opc_ant']);
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varNomeUsuario) && isset($this->varnomeusuario)) 
          {
              $this->varNomeUsuario = $this->varnomeusuario;
          }
          if (isset($this->varNomeUsuario)) 
          {
              $_SESSION['varNomeUsuario'] = $this->varNomeUsuario;
          }
          if (!isset($this->varEmailUsuario) && isset($this->varemailusuario)) 
          {
              $this->varEmailUsuario = $this->varemailusuario;
          }
          if (isset($this->varEmailUsuario)) 
          {
              $_SESSION['varEmailUsuario'] = $this->varEmailUsuario;
          }
          if (!isset($this->varPrivAdmin) && isset($this->varprivadmin)) 
          {
              $this->varPrivAdmin = $this->varprivadmin;
          }
          if (isset($this->varPrivAdmin)) 
          {
              $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
          }
          if (!isset($this->varIndFinanceiro) && isset($this->varindfinanceiro)) 
          {
              $this->varIndFinanceiro = $this->varindfinanceiro;
          }
          if (isset($this->varIndFinanceiro)) 
          {
              $_SESSION['varIndFinanceiro'] = $this->varIndFinanceiro;
          }
          if (!isset($this->varChaveGeral) && isset($this->varchavegeral)) 
          {
              $this->varChaveGeral = $this->varchavegeral;
          }
          if (isset($this->varChaveGeral)) 
          {
              $_SESSION['varChaveGeral'] = $this->varChaveGeral;
          }
          if (!isset($this->varIdFornecedorGrupo) && isset($this->varidfornecedorgrupo)) 
          {
              $this->varIdFornecedorGrupo = $this->varidfornecedorgrupo;
          }
          if (isset($this->varIdFornecedorGrupo)) 
          {
              $_SESSION['varIdFornecedorGrupo'] = $this->varIdFornecedorGrupo;
          }
          if (!isset($this->varDescontoMaximoImp) && isset($this->vardescontomaximoimp)) 
          {
              $this->varDescontoMaximoImp = $this->vardescontomaximoimp;
          }
          if (isset($this->varDescontoMaximoImp)) 
          {
              $_SESSION['varDescontoMaximoImp'] = $this->varDescontoMaximoImp;
          }
          if (!isset($this->varDescontoMaximoMes) && isset($this->vardescontomaximomes)) 
          {
              $this->varDescontoMaximoMes = $this->vardescontomaximomes;
          }
          if (isset($this->varDescontoMaximoMes)) 
          {
              $_SESSION['varDescontoMaximoMes'] = $this->varDescontoMaximoMes;
          }
          if (!isset($this->varAcessoAuditoria) && isset($this->varacessoauditoria)) 
          {
              $this->varAcessoAuditoria = $this->varacessoauditoria;
          }
          if (isset($this->varAcessoAuditoria)) 
          {
              $_SESSION['varAcessoAuditoria'] = $this->varAcessoAuditoria;
          }
          if (!isset($this->varEnderecoIpAuditoria) && isset($this->varenderecoipauditoria)) 
          {
              $this->varEnderecoIpAuditoria = $this->varenderecoipauditoria;
          }
          if (isset($this->varEnderecoIpAuditoria)) 
          {
              $_SESSION['varEnderecoIpAuditoria'] = $this->varEnderecoIpAuditoria;
          }
          if (!isset($this->varIdGrupoUsuario) && isset($this->varidgrupousuario)) 
          {
              $this->varIdGrupoUsuario = $this->varidgrupousuario;
          }
          if (isset($this->varIdGrupoUsuario)) 
          {
              $_SESSION['varIdGrupoUsuario'] = $this->varIdGrupoUsuario;
          }
          if (!isset($this->varAcessoAutorizacoes) && isset($this->varacessoautorizacoes)) 
          {
              $this->varAcessoAutorizacoes = $this->varacessoautorizacoes;
          }
          if (isset($this->varAcessoAutorizacoes)) 
          {
              $_SESSION['varAcessoAutorizacoes'] = $this->varAcessoAutorizacoes;
          }
          if (!isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->varidsituacaodocumentopendenteint)) 
          {
              $this->varIdSituacaoDocumentoPendenteInt = $this->varidsituacaodocumentopendenteint;
          }
          if (isset($this->varIdSituacaoDocumentoPendenteInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
          }
          if (!isset($this->varIdSituacaoDocumentoExcluidoInt) && isset($this->varidsituacaodocumentoexcluidoint)) 
          {
              $this->varIdSituacaoDocumentoExcluidoInt = $this->varidsituacaodocumentoexcluidoint;
          }
          if (isset($this->varIdSituacaoDocumentoExcluidoInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->varIdSituacaoDocumentoExcluidoInt;
          }
          if (!isset($this->varIdSituacaoDocumentoBaixadoInt) && isset($this->varidsituacaodocumentobaixadoint)) 
          {
              $this->varIdSituacaoDocumentoBaixadoInt = $this->varidsituacaodocumentobaixadoint;
          }
          if (isset($this->varIdSituacaoDocumentoBaixadoInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->varIdSituacaoDocumentoBaixadoInt;
          }
          if (!isset($this->varServidorSMTP) && isset($this->varservidorsmtp)) 
          {
              $this->varServidorSMTP = $this->varservidorsmtp;
          }
          if (isset($this->varServidorSMTP)) 
          {
              $_SESSION['varServidorSMTP'] = $this->varServidorSMTP;
          }
          if (!isset($this->varUsuarioSMTP) && isset($this->varusuariosmtp)) 
          {
              $this->varUsuarioSMTP = $this->varusuariosmtp;
          }
          if (isset($this->varUsuarioSMTP)) 
          {
              $_SESSION['varUsuarioSMTP'] = $this->varUsuarioSMTP;
          }
          if (!isset($this->varSenhaSMTP) && isset($this->varsenhasmtp)) 
          {
              $this->varSenhaSMTP = $this->varsenhasmtp;
          }
          if (isset($this->varSenhaSMTP)) 
          {
              $_SESSION['varSenhaSMTP'] = $this->varSenhaSMTP;
          }
          if (!isset($this->varRemetente) && isset($this->varremetente)) 
          {
              $this->varRemetente = $this->varremetente;
          }
          if (isset($this->varRemetente)) 
          {
              $_SESSION['varRemetente'] = $this->varRemetente;
          }
          if (!isset($this->varColaborador) && isset($this->varcolaborador)) 
          {
              $this->varColaborador = $this->varcolaborador;
          }
          if (isset($this->varColaborador)) 
          {
              $_SESSION['varColaborador'] = $this->varColaborador;
          }
          if (!isset($this->varApelidoUsuario) && isset($this->varapelidousuario)) 
          {
              $this->varApelidoUsuario = $this->varapelidousuario;
          }
          if (isset($this->varApelidoUsuario)) 
          {
              $_SESSION['varApelidoUsuario'] = $this->varApelidoUsuario;
          }
          if (!isset($this->varIdUsuarioColaborador) && isset($this->varidusuariocolaborador)) 
          {
              $this->varIdUsuarioColaborador = $this->varidusuariocolaborador;
          }
          if (isset($this->varIdUsuarioColaborador)) 
          {
              $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
          }
          if (!isset($this->varMesAnoReferencia) && isset($this->varmesanoreferencia)) 
          {
              $this->varMesAnoReferencia = $this->varmesanoreferencia;
          }
          if (isset($this->varMesAnoReferencia)) 
          {
              $_SESSION['varMesAnoReferencia'] = $this->varMesAnoReferencia;
          }
          if (!isset($this->varFluxo) && isset($this->varfluxo)) 
          {
              $this->varFluxo = $this->varfluxo;
          }
          if (isset($this->varFluxo)) 
          {
              $_SESSION['varFluxo'] = $this->varFluxo;
          }
          if (!isset($this->varEstoque) && isset($this->varestoque)) 
          {
              $this->varEstoque = $this->varestoque;
          }
          if (isset($this->varEstoque)) 
          {
              $_SESSION['varEstoque'] = $this->varEstoque;
          }
          if (!isset($this->varListaEmpresa) && isset($this->varlistaempresa)) 
          {
              $this->varListaEmpresa = $this->varlistaempresa;
          }
          if (isset($this->varListaEmpresa)) 
          {
              $_SESSION['varListaEmpresa'] = $this->varListaEmpresa;
          }
          if (!isset($this->varImplantador) && isset($this->varimplantador)) 
          {
              $this->varImplantador = $this->varimplantador;
          }
          if (isset($this->varImplantador)) 
          {
              $_SESSION['varImplantador'] = $this->varImplantador;
          }
          if (!isset($this->varEmailColaborador) && isset($this->varemailcolaborador)) 
          {
              $this->varEmailColaborador = $this->varemailcolaborador;
          }
          if (isset($this->varEmailColaborador)) 
          {
              $_SESSION['varEmailColaborador'] = $this->varEmailColaborador;
          }
          if (!isset($this->varConsultorImplantacao) && isset($this->varconsultorimplantacao)) 
          {
              $this->varConsultorImplantacao = $this->varconsultorimplantacao;
          }
          if (isset($this->varConsultorImplantacao)) 
          {
              $_SESSION['varConsultorImplantacao'] = $this->varConsultorImplantacao;
          }
          if (!isset($this->varLiderImplantacao) && isset($this->varliderimplantacao)) 
          {
              $this->varLiderImplantacao = $this->varliderimplantacao;
          }
          if (isset($this->varLiderImplantacao)) 
          {
              $_SESSION['varLiderImplantacao'] = $this->varLiderImplantacao;
          }
          if (!isset($this->varIdContaCaixaPadrao) && isset($this->varidcontacaixapadrao)) 
          {
              $this->varIdContaCaixaPadrao = $this->varidcontacaixapadrao;
          }
          if (isset($this->varIdContaCaixaPadrao)) 
          {
              $_SESSION['varIdContaCaixaPadrao'] = $this->varIdContaCaixaPadrao;
          }
          if (!isset($this->varListaPopDocumento) && isset($this->varlistapopdocumento)) 
          {
              $this->varListaPopDocumento = $this->varlistapopdocumento;
          }
          if (isset($this->varListaPopDocumento)) 
          {
              $_SESSION['varListaPopDocumento'] = $this->varListaPopDocumento;
          }
          if (!isset($this->varUtilizaCentroCusto) && isset($this->varutilizacentrocusto)) 
          {
              $this->varUtilizaCentroCusto = $this->varutilizacentrocusto;
          }
          if (isset($this->varUtilizaCentroCusto)) 
          {
              $_SESSION['varUtilizaCentroCusto'] = $this->varUtilizaCentroCusto;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Login_Ctr']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['Login_Ctr']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new Login_Ctr_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['initialize'])
          {
              $_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'on';
  if (isset($_SESSION['scriptcase']['sc_apl_conf']['UsuarioIncluir_Frm']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['UsuarioIncluir_Frm']);
}
;
if (isset($_SESSION['scriptcase']['sc_apl_conf']['SenhaRecuperar_Ctr']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['SenhaRecuperar_Ctr']);
}
;
$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['Login_Ctr']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Login_Ctr']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Login_Ctr'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Login_Ctr']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Login_Ctr']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('Login_Ctr') . "/Login_Ctr.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Login_Ctr']['label'] = "InfoTIME - LIGA Sistemas";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "Login_Ctr")
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
      $this->Ini->Str_btn_form = (isset($_SESSION['scriptcase']['str_button_all'])) ? $_SESSION['scriptcase']['str_button_all'] : "LIGA_BOTOES_01";
      $_SESSION['scriptcase']['str_button_all'] = $this->Ini->Str_btn_form;
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



      $_SESSION['scriptcase']['error_icon']['Login_Ctr']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['Login_Ctr'] = "";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "Login_Ctr.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['ok'] = "on";
      $this->nmgp_botoes['facebook'] = "off";
      $this->nmgp_botoes['google'] = "off";
      $this->nmgp_botoes['twitter'] = "off";
      $this->nmgp_botoes['paypal'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Login_Ctr']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['Login_Ctr'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['Login_Ctr'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("Login_Ctr", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'Login_Ctr_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'Login_Ctr_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('contr:' == substr($str_link_webhelp, 0, 6))
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
          require_once($this->Ini->path_embutida . 'Login_Ctr/Login_Ctr_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "Login_Ctr_erro.class.php"); 
      }
      $this->Erro      = new Login_Ctr_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['Login_Ctr']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varUtilizaCentroCusto)) {$this->sc_temp_varUtilizaCentroCusto = (isset($_SESSION['varUtilizaCentroCusto'])) ? $_SESSION['varUtilizaCentroCusto'] : "";}
if (!isset($this->sc_temp_varListaPopDocumento)) {$this->sc_temp_varListaPopDocumento = (isset($_SESSION['varListaPopDocumento'])) ? $_SESSION['varListaPopDocumento'] : "";}
if (!isset($this->sc_temp_varIdContaCaixaPadrao)) {$this->sc_temp_varIdContaCaixaPadrao = (isset($_SESSION['varIdContaCaixaPadrao'])) ? $_SESSION['varIdContaCaixaPadrao'] : "";}
if (!isset($this->sc_temp_varLiderImplantacao)) {$this->sc_temp_varLiderImplantacao = (isset($_SESSION['varLiderImplantacao'])) ? $_SESSION['varLiderImplantacao'] : "";}
if (!isset($this->sc_temp_varConsultorImplantacao)) {$this->sc_temp_varConsultorImplantacao = (isset($_SESSION['varConsultorImplantacao'])) ? $_SESSION['varConsultorImplantacao'] : "";}
if (!isset($this->sc_temp_varEmailColaborador)) {$this->sc_temp_varEmailColaborador = (isset($_SESSION['varEmailColaborador'])) ? $_SESSION['varEmailColaborador'] : "";}
if (!isset($this->sc_temp_varImplantador)) {$this->sc_temp_varImplantador = (isset($_SESSION['varImplantador'])) ? $_SESSION['varImplantador'] : "";}
if (!isset($this->sc_temp_varListaEmpresa)) {$this->sc_temp_varListaEmpresa = (isset($_SESSION['varListaEmpresa'])) ? $_SESSION['varListaEmpresa'] : "";}
if (!isset($this->sc_temp_varEstoque)) {$this->sc_temp_varEstoque = (isset($_SESSION['varEstoque'])) ? $_SESSION['varEstoque'] : "";}
if (!isset($this->sc_temp_varFluxo)) {$this->sc_temp_varFluxo = (isset($_SESSION['varFluxo'])) ? $_SESSION['varFluxo'] : "";}
if (!isset($this->sc_temp_varMesAnoReferencia)) {$this->sc_temp_varMesAnoReferencia = (isset($_SESSION['varMesAnoReferencia'])) ? $_SESSION['varMesAnoReferencia'] : "";}
if (!isset($this->sc_temp_varIdUsuarioColaborador)) {$this->sc_temp_varIdUsuarioColaborador = (isset($_SESSION['varIdUsuarioColaborador'])) ? $_SESSION['varIdUsuarioColaborador'] : "";}
if (!isset($this->sc_temp_varApelidoUsuario)) {$this->sc_temp_varApelidoUsuario = (isset($_SESSION['varApelidoUsuario'])) ? $_SESSION['varApelidoUsuario'] : "";}
if (!isset($this->sc_temp_varColaborador)) {$this->sc_temp_varColaborador = (isset($_SESSION['varColaborador'])) ? $_SESSION['varColaborador'] : "";}
if (!isset($this->sc_temp_varRemetente)) {$this->sc_temp_varRemetente = (isset($_SESSION['varRemetente'])) ? $_SESSION['varRemetente'] : "";}
if (!isset($this->sc_temp_varSenhaSMTP)) {$this->sc_temp_varSenhaSMTP = (isset($_SESSION['varSenhaSMTP'])) ? $_SESSION['varSenhaSMTP'] : "";}
if (!isset($this->sc_temp_varUsuarioSMTP)) {$this->sc_temp_varUsuarioSMTP = (isset($_SESSION['varUsuarioSMTP'])) ? $_SESSION['varUsuarioSMTP'] : "";}
if (!isset($this->sc_temp_varServidorSMTP)) {$this->sc_temp_varServidorSMTP = (isset($_SESSION['varServidorSMTP'])) ? $_SESSION['varServidorSMTP'] : "";}
if (!isset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt)) {$this->sc_temp_varIdSituacaoDocumentoBaixadoInt = (isset($_SESSION['varIdSituacaoDocumentoBaixadoInt'])) ? $_SESSION['varIdSituacaoDocumentoBaixadoInt'] : "";}
if (!isset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt)) {$this->sc_temp_varIdSituacaoDocumentoExcluidoInt = (isset($_SESSION['varIdSituacaoDocumentoExcluidoInt'])) ? $_SESSION['varIdSituacaoDocumentoExcluidoInt'] : "";}
if (!isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) {$this->sc_temp_varIdSituacaoDocumentoPendenteInt = (isset($_SESSION['varIdSituacaoDocumentoPendenteInt'])) ? $_SESSION['varIdSituacaoDocumentoPendenteInt'] : "";}
if (!isset($this->sc_temp_varAcessoAutorizacoes)) {$this->sc_temp_varAcessoAutorizacoes = (isset($_SESSION['varAcessoAutorizacoes'])) ? $_SESSION['varAcessoAutorizacoes'] : "";}
if (!isset($this->sc_temp_varIdGrupoUsuario)) {$this->sc_temp_varIdGrupoUsuario = (isset($_SESSION['varIdGrupoUsuario'])) ? $_SESSION['varIdGrupoUsuario'] : "";}
if (!isset($this->sc_temp_varEnderecoIpAuditoria)) {$this->sc_temp_varEnderecoIpAuditoria = (isset($_SESSION['varEnderecoIpAuditoria'])) ? $_SESSION['varEnderecoIpAuditoria'] : "";}
if (!isset($this->sc_temp_varAcessoAuditoria)) {$this->sc_temp_varAcessoAuditoria = (isset($_SESSION['varAcessoAuditoria'])) ? $_SESSION['varAcessoAuditoria'] : "";}
if (!isset($this->sc_temp_varDescontoMaximoMes)) {$this->sc_temp_varDescontoMaximoMes = (isset($_SESSION['varDescontoMaximoMes'])) ? $_SESSION['varDescontoMaximoMes'] : "";}
if (!isset($this->sc_temp_varDescontoMaximoImp)) {$this->sc_temp_varDescontoMaximoImp = (isset($_SESSION['varDescontoMaximoImp'])) ? $_SESSION['varDescontoMaximoImp'] : "";}
if (!isset($this->sc_temp_varIdFornecedorGrupo)) {$this->sc_temp_varIdFornecedorGrupo = (isset($_SESSION['varIdFornecedorGrupo'])) ? $_SESSION['varIdFornecedorGrupo'] : "";}
if (!isset($this->sc_temp_varChaveGeral)) {$this->sc_temp_varChaveGeral = (isset($_SESSION['varChaveGeral'])) ? $_SESSION['varChaveGeral'] : "";}
if (!isset($this->sc_temp_varIndFinanceiro)) {$this->sc_temp_varIndFinanceiro = (isset($_SESSION['varIndFinanceiro'])) ? $_SESSION['varIndFinanceiro'] : "";}
if (!isset($this->sc_temp_varPrivAdmin)) {$this->sc_temp_varPrivAdmin = (isset($_SESSION['varPrivAdmin'])) ? $_SESSION['varPrivAdmin'] : "";}
if (!isset($this->sc_temp_varEmailUsuario)) {$this->sc_temp_varEmailUsuario = (isset($_SESSION['varEmailUsuario'])) ? $_SESSION['varEmailUsuario'] : "";}
if (!isset($this->sc_temp_varNomeUsuario)) {$this->sc_temp_varNomeUsuario = (isset($_SESSION['varNomeUsuario'])) ? $_SESSION['varNomeUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
  unset($_SESSION['scriptcase']['sc_apl_seg']);unset($_SESSION['scriptcase']['pass']);unset($_SESSION['varIdUsuario']);
 unset($this->sc_temp_varIdUsuario);
 unset($_SESSION['varIdTenacidade']);
 unset($this->sc_temp_varIdTenacidade);
 unset($_SESSION['varNomeUsuario']);
 unset($this->sc_temp_varNomeUsuario);
 unset($_SESSION['varEmailUsuario']);
 unset($this->sc_temp_varEmailUsuario);
 unset($_SESSION['varPrivAdmin']);
 unset($this->sc_temp_varPrivAdmin);
 unset($_SESSION['varIndFinanceiro']);
 unset($this->sc_temp_varIndFinanceiro);
 unset($_SESSION['varChaveGeral']);
 unset($this->sc_temp_varChaveGeral);
 unset($_SESSION['varIdFornecedorGrupo']);
 unset($this->sc_temp_varIdFornecedorGrupo);
 unset($_SESSION['varDescontoMaximoImp']);
 unset($this->sc_temp_varDescontoMaximoImp);
 unset($_SESSION['varDescontoMaximoMes']);
 unset($this->sc_temp_varDescontoMaximoMes);
 unset($_SESSION['varAcessoAuditoria']);
 unset($this->sc_temp_varAcessoAuditoria);
 unset($_SESSION['varEnderecoIpAuditoria']);
 unset($this->sc_temp_varEnderecoIpAuditoria);
 unset($_SESSION['varIdGrupoUsuario']);
 unset($this->sc_temp_varIdGrupoUsuario);
 unset($_SESSION['varAcessoAuditoria']);
 unset($this->sc_temp_varAcessoAuditoria);
 unset($_SESSION['varAcessoAutorizacoes']);
 unset($this->sc_temp_varAcessoAutorizacoes);
 unset($_SESSION['varIdSituacaoDocumentoPendenteInt']);
 unset($this->sc_temp_varIdSituacaoDocumentoPendenteInt);
 unset($_SESSION['varIdSituacaoDocumentoExcluidoInt']);
 unset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt);
 unset($_SESSION['varIdSituacaoDocumentoBaixadoInt']);
 unset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt);
 unset($_SESSION['varServidorSMTP']);
 unset($this->sc_temp_varServidorSMTP);
 unset($_SESSION['varUsuarioSMTP']);
 unset($this->sc_temp_varUsuarioSMTP);
 unset($_SESSION['varSenhaSMTP']);
 unset($this->sc_temp_varSenhaSMTP);
 unset($_SESSION['varRemetente']);
 unset($this->sc_temp_varRemetente);
 unset($_SESSION['varColaborador']);
 unset($this->sc_temp_varColaborador);
 unset($_SESSION['varApelidoUsuario']);
 unset($this->sc_temp_varApelidoUsuario);
 unset($_SESSION['varIdUsuarioColaborador']);
 unset($this->sc_temp_varIdUsuarioColaborador);
 unset($_SESSION['varMesAnoReferencia']);
 unset($this->sc_temp_varMesAnoReferencia);
 unset($_SESSION['varFluxo']);
 unset($this->sc_temp_varFluxo);
 unset($_SESSION['varEstoque']);
 unset($this->sc_temp_varEstoque);
 unset($_SESSION['varListaEmpresa']);
 unset($this->sc_temp_varListaEmpresa);
 unset($_SESSION['varImplantador']);
 unset($this->sc_temp_varImplantador);
 unset($_SESSION['varEmailColaborador']);
 unset($this->sc_temp_varEmailColaborador);
 unset($_SESSION['varConsultorImplantacao']);
 unset($this->sc_temp_varConsultorImplantacao);
 unset($_SESSION['varLiderImplantacao']);
 unset($this->sc_temp_varLiderImplantacao);
 unset($_SESSION['varIdContaCaixaPadrao']);
 unset($this->sc_temp_varIdContaCaixaPadrao);
 unset($_SESSION['varListaPopDocumento']);
 unset($this->sc_temp_varListaPopDocumento);
 unset($_SESSION['varUtilizaCentroCusto']);
 unset($this->sc_temp_varUtilizaCentroCusto);
;
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varNomeUsuario)) { $_SESSION['varNomeUsuario'] = $this->sc_temp_varNomeUsuario;}
if (isset($this->sc_temp_varEmailUsuario)) { $_SESSION['varEmailUsuario'] = $this->sc_temp_varEmailUsuario;}
if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
if (isset($this->sc_temp_varIndFinanceiro)) { $_SESSION['varIndFinanceiro'] = $this->sc_temp_varIndFinanceiro;}
if (isset($this->sc_temp_varChaveGeral)) { $_SESSION['varChaveGeral'] = $this->sc_temp_varChaveGeral;}
if (isset($this->sc_temp_varIdFornecedorGrupo)) { $_SESSION['varIdFornecedorGrupo'] = $this->sc_temp_varIdFornecedorGrupo;}
if (isset($this->sc_temp_varDescontoMaximoImp)) { $_SESSION['varDescontoMaximoImp'] = $this->sc_temp_varDescontoMaximoImp;}
if (isset($this->sc_temp_varDescontoMaximoMes)) { $_SESSION['varDescontoMaximoMes'] = $this->sc_temp_varDescontoMaximoMes;}
if (isset($this->sc_temp_varAcessoAuditoria)) { $_SESSION['varAcessoAuditoria'] = $this->sc_temp_varAcessoAuditoria;}
if (isset($this->sc_temp_varEnderecoIpAuditoria)) { $_SESSION['varEnderecoIpAuditoria'] = $this->sc_temp_varEnderecoIpAuditoria;}
if (isset($this->sc_temp_varIdGrupoUsuario)) { $_SESSION['varIdGrupoUsuario'] = $this->sc_temp_varIdGrupoUsuario;}
if (isset($this->sc_temp_varAcessoAutorizacoes)) { $_SESSION['varAcessoAutorizacoes'] = $this->sc_temp_varAcessoAutorizacoes;}
if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
if (isset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt)) { $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->sc_temp_varIdSituacaoDocumentoExcluidoInt;}
if (isset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt)) { $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->sc_temp_varIdSituacaoDocumentoBaixadoInt;}
if (isset($this->sc_temp_varServidorSMTP)) { $_SESSION['varServidorSMTP'] = $this->sc_temp_varServidorSMTP;}
if (isset($this->sc_temp_varUsuarioSMTP)) { $_SESSION['varUsuarioSMTP'] = $this->sc_temp_varUsuarioSMTP;}
if (isset($this->sc_temp_varSenhaSMTP)) { $_SESSION['varSenhaSMTP'] = $this->sc_temp_varSenhaSMTP;}
if (isset($this->sc_temp_varRemetente)) { $_SESSION['varRemetente'] = $this->sc_temp_varRemetente;}
if (isset($this->sc_temp_varColaborador)) { $_SESSION['varColaborador'] = $this->sc_temp_varColaborador;}
if (isset($this->sc_temp_varApelidoUsuario)) { $_SESSION['varApelidoUsuario'] = $this->sc_temp_varApelidoUsuario;}
if (isset($this->sc_temp_varIdUsuarioColaborador)) { $_SESSION['varIdUsuarioColaborador'] = $this->sc_temp_varIdUsuarioColaborador;}
if (isset($this->sc_temp_varMesAnoReferencia)) { $_SESSION['varMesAnoReferencia'] = $this->sc_temp_varMesAnoReferencia;}
if (isset($this->sc_temp_varFluxo)) { $_SESSION['varFluxo'] = $this->sc_temp_varFluxo;}
if (isset($this->sc_temp_varEstoque)) { $_SESSION['varEstoque'] = $this->sc_temp_varEstoque;}
if (isset($this->sc_temp_varListaEmpresa)) { $_SESSION['varListaEmpresa'] = $this->sc_temp_varListaEmpresa;}
if (isset($this->sc_temp_varImplantador)) { $_SESSION['varImplantador'] = $this->sc_temp_varImplantador;}
if (isset($this->sc_temp_varEmailColaborador)) { $_SESSION['varEmailColaborador'] = $this->sc_temp_varEmailColaborador;}
if (isset($this->sc_temp_varConsultorImplantacao)) { $_SESSION['varConsultorImplantacao'] = $this->sc_temp_varConsultorImplantacao;}
if (isset($this->sc_temp_varLiderImplantacao)) { $_SESSION['varLiderImplantacao'] = $this->sc_temp_varLiderImplantacao;}
if (isset($this->sc_temp_varIdContaCaixaPadrao)) { $_SESSION['varIdContaCaixaPadrao'] = $this->sc_temp_varIdContaCaixaPadrao;}
if (isset($this->sc_temp_varListaPopDocumento)) { $_SESSION['varListaPopDocumento'] = $this->sc_temp_varListaPopDocumento;}
if (isset($this->sc_temp_varUtilizaCentroCusto)) { $_SESSION['varUtilizaCentroCusto'] = $this->sc_temp_varUtilizaCentroCusto;}
$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['Login_Ctr']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['Login_Ctr']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['Login_Ctr']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['Login_Ctr']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "Login_Ctr.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


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
          if ('validate_login' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'login');
          }
          if ('validate_pswd' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'pswd');
          }
          Login_Ctr_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              Login_Ctr_pack_ajax_response();
              exit;
          }
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
          $_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  Login_Ctr_pack_ajax_response();
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
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  Login_Ctr_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
//
      if (!isset($nm_form_submit) && $this->nmgp_opcao != "nada")
      {
          $this->login = "" ;  
          $this->pswd = "" ;  
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form'] as $NM_campo => $NM_valor)
              {
                  $$NM_campo = $NM_valor;
              }
          }
      }
      else
      {
           if ($this->nmgp_opcao != "nada")
           {
           }
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['campos']))
              { 
                  $login = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['campos'][0]; 
                  $pswd = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['campos'][1]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['campos'][0] = $this->login; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['campos'][1] = $this->pswd; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['redir'] == "redir")
          {
              $this->nmgp_redireciona(); 
          }
          else
          {
              $contr_menu = "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['iframe_menu'])
              {
                  $contr_menu = "glo_menu";
              }
              if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("Login_Ctr", $_SESSION['scriptcase']['sc_ult_apl_menu']))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona_form("Login_Ctr_fim.php", $this->nm_location, $contr_menu); 
              }
              elseif (!$this->NM_ajax_flag)
              {
                  $this->nm_gera_html();
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['embutida_proc'])
                  { 
                      $this->NM_close_db(); 
                  } 
              }
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              Login_Ctr_pack_ajax_response();
              exit;
          }
      }
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "Login_Ctr.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("InfoTIME - LIGA Sistemas") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
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
<form name="Fdown" method="get" action="Login_Ctr_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Login_Ctr"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="Login_Ctr.php" target="_self" style="display: none"> 
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
           case 'login':
               return "Login";
               break;
           case 'pswd':
               return "Pswd";
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
      if ((!is_array($filtro) && ('' == $filtro || 'login' == $filtro)) || (is_array($filtro) && in_array('login', $filtro)))
        $this->ValidateField_login($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "login";

      if ((!is_array($filtro) && ('' == $filtro || 'pswd' == $filtro)) || (is_array($filtro) && in_array('pswd', $filtro)))
        $this->ValidateField_pswd($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "pswd";


      if (empty($Campos_Crit) && empty($Campos_Falta))
      {
      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      $_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_login = $this->login;
    $original_pswd = $this->pswd;
}
if (!isset($this->sc_temp_varColaborador)) {$this->sc_temp_varColaborador = (isset($_SESSION['varColaborador'])) ? $_SESSION['varColaborador'] : "";}
if (!isset($this->sc_temp_varListaPopDocumento)) {$this->sc_temp_varListaPopDocumento = (isset($_SESSION['varListaPopDocumento'])) ? $_SESSION['varListaPopDocumento'] : "";}
if (!isset($this->sc_temp_varLiderImplantacao)) {$this->sc_temp_varLiderImplantacao = (isset($_SESSION['varLiderImplantacao'])) ? $_SESSION['varLiderImplantacao'] : "";}
if (!isset($this->sc_temp_varConsultorImplantacao)) {$this->sc_temp_varConsultorImplantacao = (isset($_SESSION['varConsultorImplantacao'])) ? $_SESSION['varConsultorImplantacao'] : "";}
if (!isset($this->sc_temp_varEmailColaborador)) {$this->sc_temp_varEmailColaborador = (isset($_SESSION['varEmailColaborador'])) ? $_SESSION['varEmailColaborador'] : "";}
if (!isset($this->sc_temp_varImplantador)) {$this->sc_temp_varImplantador = (isset($_SESSION['varImplantador'])) ? $_SESSION['varImplantador'] : "";}
if (!isset($this->sc_temp_varApelidoUsuario)) {$this->sc_temp_varApelidoUsuario = (isset($_SESSION['varApelidoUsuario'])) ? $_SESSION['varApelidoUsuario'] : "";}
if (!isset($this->sc_temp_varIdUsuarioColaborador)) {$this->sc_temp_varIdUsuarioColaborador = (isset($_SESSION['varIdUsuarioColaborador'])) ? $_SESSION['varIdUsuarioColaborador'] : "";}
if (!isset($this->sc_temp_varListaEmpresa)) {$this->sc_temp_varListaEmpresa = (isset($_SESSION['varListaEmpresa'])) ? $_SESSION['varListaEmpresa'] : "";}
if (!isset($this->sc_temp_varAcessoAutorizacoes)) {$this->sc_temp_varAcessoAutorizacoes = (isset($_SESSION['varAcessoAutorizacoes'])) ? $_SESSION['varAcessoAutorizacoes'] : "";}
if (!isset($this->sc_temp_varAcessoAuditoria)) {$this->sc_temp_varAcessoAuditoria = (isset($_SESSION['varAcessoAuditoria'])) ? $_SESSION['varAcessoAuditoria'] : "";}
if (!isset($this->sc_temp_varDescontoMaximoMes)) {$this->sc_temp_varDescontoMaximoMes = (isset($_SESSION['varDescontoMaximoMes'])) ? $_SESSION['varDescontoMaximoMes'] : "";}
if (!isset($this->sc_temp_varDescontoMaximoImp)) {$this->sc_temp_varDescontoMaximoImp = (isset($_SESSION['varDescontoMaximoImp'])) ? $_SESSION['varDescontoMaximoImp'] : "";}
if (!isset($this->sc_temp_varIdFornecedorGrupo)) {$this->sc_temp_varIdFornecedorGrupo = (isset($_SESSION['varIdFornecedorGrupo'])) ? $_SESSION['varIdFornecedorGrupo'] : "";}
if (!isset($this->sc_temp_varIndFinanceiro)) {$this->sc_temp_varIndFinanceiro = (isset($_SESSION['varIndFinanceiro'])) ? $_SESSION['varIndFinanceiro'] : "";}
if (!isset($this->sc_temp_varPrivAdmin)) {$this->sc_temp_varPrivAdmin = (isset($_SESSION['varPrivAdmin'])) ? $_SESSION['varPrivAdmin'] : "";}
if (!isset($this->sc_temp_varEmailUsuario)) {$this->sc_temp_varEmailUsuario = (isset($_SESSION['varEmailUsuario'])) ? $_SESSION['varEmailUsuario'] : "";}
if (!isset($this->sc_temp_varNomeUsuario)) {$this->sc_temp_varNomeUsuario = (isset($_SESSION['varNomeUsuario'])) ? $_SESSION['varNomeUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdGrupoUsuario)) {$this->sc_temp_varIdGrupoUsuario = (isset($_SESSION['varIdGrupoUsuario'])) ? $_SESSION['varIdGrupoUsuario'] : "";}
  $Login = $this->Db->qstr($this->login );
$Senha = $this->Db->qstr(md5($this->pswd ));

$pos = strripos($Login, '@');

if ($pos === false) {
	
	$varColaborador = 'F';

	$sql = "SELECT
			grupousuario.IdGrupoUsuario,
			usuario.IdUsuario, 
			usuario.IdTenacidade, 
			usuario.Administrador, 
			usuario.Ativo, 
			usuario.Nome, 
			usuario.Email, 
			usuario.IndicadorFinanceiro,
			grupousuario.IdFornecedor,
			usuario.DescontoMaximoImp,
			usuario.DescontoMaximoMes,
			usuario.AcessoAuditoria, 
			usuario.AcessoAutorizacoes,
			usuario.ListaEmpresa
	FROM usuario usuario
	   	LEFT JOIN usuariogrupousuario grupo ON (usuario.IdUsuario = grupo.IdUsuario)
		LEFT JOIN grupousuario grupousuario ON (grupousuario.IdGrupoUsuario = grupo.IdGrupoUsuario)
	WHERE Login = ".$Login." AND Senha = ".$Senha." AND Ativo = 'Y'";

} else {
	
	$varColaborador = 'V';
	
	$sql = "SELECT IdColaborador, IdTenacidade, Nome, Apelido, Email, Implanta, ConsultorImplantacao, LiderImplantacao, ListaPopDocumento FROM colaborador WHERE Login = ".$Login." AND Senha = ".$Senha." AND FIND_IN_SET(IdSituacaoColaborador,(SELECT GROUP_CONCAT(a.IdSituacaoColaborador) FROM situacaocolaborador a WHERE a.Descricao IN ('Ativo', 'ATIVO'))) > 0";
	
}

 
      $nm_select = $sql; 
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



if(count($this->rs) == 0) 
{
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Usuário e/ou senha inválido(s)!";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Login_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Login_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Usuário e/ou senha inválido(s)!";
 }
;
	
} else if($varColaborador == 'F') {
	
	$varIdGrupoUsuario	= $this->rs[0][0];
	$varIdUsuario	  	= $this->rs[0][1];
	$varIdTenacidade  	= $this->rs[0][2];
	
	if ($this->rs[0][3] == 'Y') {
		
		$varPrivAdmin     = 1;
		
	} else {
		
		$varPrivAdmin     = 0;
		
	}	
	
	$varNomeUsuario   	   	= $this->rs[0][5];
	$varEmailUsuario  	   	= $this->rs[0][6];
	$varIndFinanceiro 	   	= $this->rs[0][7];
	$varIdFornecedorGrupo  	= $this->rs[0][8];
	$varDescontoMaximoImp  	= $this->rs[0][9];
	$varDescontoMaximoMes  	= $this->rs[0][10];
	$varAcessoAuditoria	   	= $this->rs[0][11];
	$varAcessoAutorizacoes 	= $this->rs[0][12];
	$varListaEmpresa 		= $this->rs[0][13];
	
	if ($varListaEmpresa == NULL || $varListaEmpresa == '') {
		
		$check_sql = "SELECT group_concat(IdEmpresa) FROM empresa WHERE IdTenacidade = '".$varIdTenacidade."'";
		 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs1 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs1[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs1 = false;
          $this->rs1_erro = $this->Db->ErrorMsg();
      } 


		if (isset($this->rs1[0][0])) {
	
    		$varListaEmpresa = $this->rs1[0][0];
    
		}
		
	}
	
	 if (isset($varIdGrupoUsuario)) {$this->sc_temp_varIdGrupoUsuario = $varIdGrupoUsuario;}
;
	 if (isset($varIdUsuario)) {$this->sc_temp_varIdUsuario = $varIdUsuario;}
;
	 if (isset($varIdTenacidade)) {$this->sc_temp_varIdTenacidade = $varIdTenacidade;}
;
	 if (isset($varNomeUsuario)) {$this->sc_temp_varNomeUsuario = $varNomeUsuario;}
;
	 if (isset($varEmailUsuario)) {$this->sc_temp_varEmailUsuario = $varEmailUsuario;}
;
	 if (isset($varPrivAdmin)) {$this->sc_temp_varPrivAdmin = $varPrivAdmin;}
;
	 if (isset($varIndFinanceiro)) {$this->sc_temp_varIndFinanceiro = $varIndFinanceiro;}
;	
	 if (isset($varIdFornecedorGrupo)) {$this->sc_temp_varIdFornecedorGrupo = $varIdFornecedorGrupo;}
;	
	 if (isset($varDescontoMaximoImp)) {$this->sc_temp_varDescontoMaximoImp = $varDescontoMaximoImp;}
;	
	 if (isset($varDescontoMaximoMes)) {$this->sc_temp_varDescontoMaximoMes = $varDescontoMaximoMes;}
;	
	 if (isset($varAcessoAuditoria)) {$this->sc_temp_varAcessoAuditoria = $varAcessoAuditoria;}
;	
	 if (isset($varAcessoAutorizacoes)) {$this->sc_temp_varAcessoAutorizacoes = $varAcessoAutorizacoes;}
;	
	 if (isset($varListaEmpresa)) {$this->sc_temp_varListaEmpresa = $varListaEmpresa;}
;	
	
	
} else {
	
	$varIdUsuarioColaborador = $this->rs[0][0];
	$varIdUsuario	  	= 66;
	$varIdTenacidade  	= $this->rs[0][1];
	$varNomeUsuario   	= $this->rs[0][2];
	$varApelidoUsuario 	= $this->rs[0][3];
	$varEmailColaborador= $this->rs[0][4];
	$varImplantador 	= $this->rs[0][5];
	$varConsultorImplantacao = $this->rs[0][6];
	$varLiderImplantacao = $this->rs[0][7];
	$varListaPopDocumento = $this->rs[0][8];
	
	 if (isset($varIdUsuarioColaborador)) {$this->sc_temp_varIdUsuarioColaborador = $varIdUsuarioColaborador;}
;
	 if (isset($varIdUsuario)) {$this->sc_temp_varIdUsuario = $varIdUsuario;}
;
	 if (isset($varIdTenacidade)) {$this->sc_temp_varIdTenacidade = $varIdTenacidade;}
;
	 if (isset($varNomeUsuario)) {$this->sc_temp_varNomeUsuario = $varNomeUsuario;}
;
	 if (isset($varApelidoUsuario)) {$this->sc_temp_varApelidoUsuario = $varApelidoUsuario;}
;
	 if (isset($varImplantador)) {$this->sc_temp_varImplantador = $varImplantador;}
;
	 if (isset($varEmailColaborador)) {$this->sc_temp_varEmailColaborador = $varEmailColaborador;}
;
	 if (isset($varConsultorImplantacao)) {$this->sc_temp_varConsultorImplantacao = $varConsultorImplantacao;}
;	
	 if (isset($varLiderImplantacao)) {$this->sc_temp_varLiderImplantacao = $varLiderImplantacao;}
;	
	 if (isset($varListaPopDocumento)) {$this->sc_temp_varListaPopDocumento = $varListaPopDocumento;}
;		
	
}
 if (isset($varColaborador)) {$this->sc_temp_varColaborador = $varColaborador;}
;
if (isset($this->sc_temp_varIdGrupoUsuario)) { $_SESSION['varIdGrupoUsuario'] = $this->sc_temp_varIdGrupoUsuario;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varNomeUsuario)) { $_SESSION['varNomeUsuario'] = $this->sc_temp_varNomeUsuario;}
if (isset($this->sc_temp_varEmailUsuario)) { $_SESSION['varEmailUsuario'] = $this->sc_temp_varEmailUsuario;}
if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
if (isset($this->sc_temp_varIndFinanceiro)) { $_SESSION['varIndFinanceiro'] = $this->sc_temp_varIndFinanceiro;}
if (isset($this->sc_temp_varIdFornecedorGrupo)) { $_SESSION['varIdFornecedorGrupo'] = $this->sc_temp_varIdFornecedorGrupo;}
if (isset($this->sc_temp_varDescontoMaximoImp)) { $_SESSION['varDescontoMaximoImp'] = $this->sc_temp_varDescontoMaximoImp;}
if (isset($this->sc_temp_varDescontoMaximoMes)) { $_SESSION['varDescontoMaximoMes'] = $this->sc_temp_varDescontoMaximoMes;}
if (isset($this->sc_temp_varAcessoAuditoria)) { $_SESSION['varAcessoAuditoria'] = $this->sc_temp_varAcessoAuditoria;}
if (isset($this->sc_temp_varAcessoAutorizacoes)) { $_SESSION['varAcessoAutorizacoes'] = $this->sc_temp_varAcessoAutorizacoes;}
if (isset($this->sc_temp_varListaEmpresa)) { $_SESSION['varListaEmpresa'] = $this->sc_temp_varListaEmpresa;}
if (isset($this->sc_temp_varIdUsuarioColaborador)) { $_SESSION['varIdUsuarioColaborador'] = $this->sc_temp_varIdUsuarioColaborador;}
if (isset($this->sc_temp_varApelidoUsuario)) { $_SESSION['varApelidoUsuario'] = $this->sc_temp_varApelidoUsuario;}
if (isset($this->sc_temp_varImplantador)) { $_SESSION['varImplantador'] = $this->sc_temp_varImplantador;}
if (isset($this->sc_temp_varEmailColaborador)) { $_SESSION['varEmailColaborador'] = $this->sc_temp_varEmailColaborador;}
if (isset($this->sc_temp_varConsultorImplantacao)) { $_SESSION['varConsultorImplantacao'] = $this->sc_temp_varConsultorImplantacao;}
if (isset($this->sc_temp_varLiderImplantacao)) { $_SESSION['varLiderImplantacao'] = $this->sc_temp_varLiderImplantacao;}
if (isset($this->sc_temp_varListaPopDocumento)) { $_SESSION['varListaPopDocumento'] = $this->sc_temp_varListaPopDocumento;}
if (isset($this->sc_temp_varColaborador)) { $_SESSION['varColaborador'] = $this->sc_temp_varColaborador;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_login != $this->login || (isset($bFlagRead_login) && $bFlagRead_login)))
    {
        $this->ajax_return_values_login(true);
    }
    if (($original_pswd != $this->pswd || (isset($bFlagRead_pswd) && $bFlagRead_pswd)))
    {
        $this->ajax_return_values_pswd(true);
    }
}
$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off'; 
      }
      }
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
              $_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varColaborador)) {$this->sc_temp_varColaborador = (isset($_SESSION['varColaborador'])) ? $_SESSION['varColaborador'] : "";}
if (!isset($this->sc_temp_varPrivAdmin)) {$this->sc_temp_varPrivAdmin = (isset($_SESSION['varPrivAdmin'])) ? $_SESSION['varPrivAdmin'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varUtilizaCentroCusto)) {$this->sc_temp_varUtilizaCentroCusto = (isset($_SESSION['varUtilizaCentroCusto'])) ? $_SESSION['varUtilizaCentroCusto'] : "";}
if (!isset($this->sc_temp_varIdContaCaixaPadrao)) {$this->sc_temp_varIdContaCaixaPadrao = (isset($_SESSION['varIdContaCaixaPadrao'])) ? $_SESSION['varIdContaCaixaPadrao'] : "";}
if (!isset($this->sc_temp_varEstoque)) {$this->sc_temp_varEstoque = (isset($_SESSION['varEstoque'])) ? $_SESSION['varEstoque'] : "";}
if (!isset($this->sc_temp_varGravarAuditoria)) {$this->sc_temp_varGravarAuditoria = (isset($_SESSION['varGravarAuditoria'])) ? $_SESSION['varGravarAuditoria'] : "";}
if (!isset($this->sc_temp_varClubeTiro)) {$this->sc_temp_varClubeTiro = (isset($_SESSION['varClubeTiro'])) ? $_SESSION['varClubeTiro'] : "";}
if (!isset($this->sc_temp_varRemetente)) {$this->sc_temp_varRemetente = (isset($_SESSION['varRemetente'])) ? $_SESSION['varRemetente'] : "";}
if (!isset($this->sc_temp_varSenhaSMTP)) {$this->sc_temp_varSenhaSMTP = (isset($_SESSION['varSenhaSMTP'])) ? $_SESSION['varSenhaSMTP'] : "";}
if (!isset($this->sc_temp_varUsuarioSMTP)) {$this->sc_temp_varUsuarioSMTP = (isset($_SESSION['varUsuarioSMTP'])) ? $_SESSION['varUsuarioSMTP'] : "";}
if (!isset($this->sc_temp_varServidorSMTP)) {$this->sc_temp_varServidorSMTP = (isset($_SESSION['varServidorSMTP'])) ? $_SESSION['varServidorSMTP'] : "";}
if (!isset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt)) {$this->sc_temp_varIdSituacaoDocumentoBaixadoInt = (isset($_SESSION['varIdSituacaoDocumentoBaixadoInt'])) ? $_SESSION['varIdSituacaoDocumentoBaixadoInt'] : "";}
if (!isset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt)) {$this->sc_temp_varIdSituacaoDocumentoExcluidoInt = (isset($_SESSION['varIdSituacaoDocumentoExcluidoInt'])) ? $_SESSION['varIdSituacaoDocumentoExcluidoInt'] : "";}
if (!isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) {$this->sc_temp_varIdSituacaoDocumentoPendenteInt = (isset($_SESSION['varIdSituacaoDocumentoPendenteInt'])) ? $_SESSION['varIdSituacaoDocumentoPendenteInt'] : "";}
if (!isset($this->sc_temp_varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = (isset($_SESSION['varDiretorioArquivo'])) ? $_SESSION['varDiretorioArquivo'] : "";}
if (!isset($this->sc_temp_IntegracaoInfolabAtiva)) {$this->sc_temp_IntegracaoInfolabAtiva = (isset($_SESSION['IntegracaoInfolabAtiva'])) ? $_SESSION['IntegracaoInfolabAtiva'] : "";}
if (!isset($this->sc_temp_TaxaServicoCartaoDebitoIntG)) {$this->sc_temp_TaxaServicoCartaoDebitoIntG = (isset($_SESSION['TaxaServicoCartaoDebitoIntG'])) ? $_SESSION['TaxaServicoCartaoDebitoIntG'] : "";}
if (!isset($this->sc_temp_TaxaServicoCartaoCreditoIntG)) {$this->sc_temp_TaxaServicoCartaoCreditoIntG = (isset($_SESSION['TaxaServicoCartaoCreditoIntG'])) ? $_SESSION['TaxaServicoCartaoCreditoIntG'] : "";}
if (!isset($this->sc_temp_IdTipoEspecieCartaoCreditoIntG)) {$this->sc_temp_IdTipoEspecieCartaoCreditoIntG = (isset($_SESSION['IdTipoEspecieCartaoCreditoIntG'])) ? $_SESSION['IdTipoEspecieCartaoCreditoIntG'] : "";}
if (!isset($this->sc_temp_IdTipoEspecieCartaoDebitoIntG)) {$this->sc_temp_IdTipoEspecieCartaoDebitoIntG = (isset($_SESSION['IdTipoEspecieCartaoDebitoIntG'])) ? $_SESSION['IdTipoEspecieCartaoDebitoIntG'] : "";}
  $check_sql = "SELECT co.ClienteAtivo, co.IdTipoEspecieCartaoDebitoInt, co.IdTipoEspecieCartaoCreditoInt, co.TaxaServicoCartaoCreditoInt, co.TaxaServicoCartaoDebitoInt, co.IntegracaoInfolabAtiva, co.DiretorioArquivo, co.IdSituacaoDocumentoPendenteInt, co.IdSituacaoDocumentoExcluidoInt, co.IdSituacaoDocumentoBaixadoInt, co.ServidorSMTP, co.UsuarioSMTP, co.SenhaSMTP, co.Remetente, co.GravarAuditoria, te.Estoque, co.IdContaCaixaInt, co.UtilizaCentroCusto"
   . " FROM configuracao co "
   . " INNER JOIN tenacidade te ON (te.IdTenacidade = co.IdTenacidade) "
   . " WHERE co.IdConfiguracao = (select min(IdConfiguracao) FROM configuracao WHERE IdTenacidade='$this->sc_temp_varIdTenacidade') AND co.IdTenacidade = '".$this->sc_temp_varIdTenacidade."'";

 
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
    $ClienteAtivo 						= $this->rs[0][0];
	$IdTipoEspecieCartaoDebitoIntG 		= $this->rs[0][1];
	$IdTipoEspecieCartaoCreditoIntG 	= $this->rs[0][2];
	$TaxaServicoCartaoCreditoIntG 		= $this->rs[0][3];
	$TaxaServicoCartaoDebitoIntG 		= $this->rs[0][4];
	$IntegracaoInfolabAtiva 			= $this->rs[0][5];
	$varDiretorioArquivo 				= $this->rs[0][6];
	$varIdSituacaoDocumentoPendenteInt  = $this->rs[0][7];
	$varIdSituacaoDocumentoExcluidoInt  = $this->rs[0][8];
	$varIdSituacaoDocumentoBaixadoInt 	= $this->rs[0][9];
	$varServidorSMTP				 	= $this->rs[0][10];
	$varUsuarioSMTP					 	= $this->rs[0][11];
	$varSenhaSMTP					 	= $this->rs[0][12];
	$varRemetente					 	= $this->rs[0][13];
	$varGravarAuditoria					= $this->rs[0][14];
	$varEstoque							= $this->rs[0][15];
	$varIdContaCaixaPadrao				= $this->rs[0][16];
	$varUtilizaCentroCusto				= $this->rs[0][17];
	
	$varSenhaSMTP = substr($varSenhaSMTP, 0, -4); 
	$varSenhaSMTP = substr($varSenhaSMTP, 5);
	
	 if (isset($IdTipoEspecieCartaoDebitoIntG)) {$this->sc_temp_IdTipoEspecieCartaoDebitoIntG = $IdTipoEspecieCartaoDebitoIntG;}
;
	 if (isset($IdTipoEspecieCartaoCreditoIntG)) {$this->sc_temp_IdTipoEspecieCartaoCreditoIntG = $IdTipoEspecieCartaoCreditoIntG;}
;
	 if (isset($TaxaServicoCartaoCreditoIntG)) {$this->sc_temp_TaxaServicoCartaoCreditoIntG = $TaxaServicoCartaoCreditoIntG;}
;
	 if (isset($TaxaServicoCartaoDebitoIntG)) {$this->sc_temp_TaxaServicoCartaoDebitoIntG = $TaxaServicoCartaoDebitoIntG;}
;
	 if (isset($IntegracaoInfolabAtiva)) {$this->sc_temp_IntegracaoInfolabAtiva = $IntegracaoInfolabAtiva;}
;
	 if (isset($varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = $varDiretorioArquivo;}
;
	 if (isset($varIdSituacaoDocumentoPendenteInt)) {$this->sc_temp_varIdSituacaoDocumentoPendenteInt = $varIdSituacaoDocumentoPendenteInt;}
;
	 if (isset($varIdSituacaoDocumentoExcluidoInt)) {$this->sc_temp_varIdSituacaoDocumentoExcluidoInt = $varIdSituacaoDocumentoExcluidoInt;}
;
	 if (isset($varIdSituacaoDocumentoBaixadoInt)) {$this->sc_temp_varIdSituacaoDocumentoBaixadoInt = $varIdSituacaoDocumentoBaixadoInt;}
;
	 if (isset($varServidorSMTP)) {$this->sc_temp_varServidorSMTP = $varServidorSMTP;}
;	
	 if (isset($varUsuarioSMTP)) {$this->sc_temp_varUsuarioSMTP = $varUsuarioSMTP;}
;	
	 if (isset($varSenhaSMTP)) {$this->sc_temp_varSenhaSMTP = $varSenhaSMTP;}
;	
	 if (isset($varRemetente)) {$this->sc_temp_varRemetente = $varRemetente;}
;	
	 if (isset($varClubeTiro)) {$this->sc_temp_varClubeTiro = $varClubeTiro;}
;	
	 if (isset($varGravarAuditoria)) {$this->sc_temp_varGravarAuditoria = $varGravarAuditoria;}
;	
	 if (isset($varEstoque)) {$this->sc_temp_varEstoque = $varEstoque;}
;	
	 if (isset($varIdContaCaixaPadrao)) {$this->sc_temp_varIdContaCaixaPadrao = $varIdContaCaixaPadrao;}
;	
	 if (isset($varUtilizaCentroCusto)) {$this->sc_temp_varUtilizaCentroCusto = $varUtilizaCentroCusto;}
;		
	
}
else {
    $ClienteAtivo = 'N';
}

if ($ClienteAtivo != 'S') {
	 if (isset($this->sc_temp_IdTipoEspecieCartaoDebitoIntG)) { $_SESSION['IdTipoEspecieCartaoDebitoIntG'] = $this->sc_temp_IdTipoEspecieCartaoDebitoIntG;}
 if (isset($this->sc_temp_IdTipoEspecieCartaoCreditoIntG)) { $_SESSION['IdTipoEspecieCartaoCreditoIntG'] = $this->sc_temp_IdTipoEspecieCartaoCreditoIntG;}
 if (isset($this->sc_temp_TaxaServicoCartaoCreditoIntG)) { $_SESSION['TaxaServicoCartaoCreditoIntG'] = $this->sc_temp_TaxaServicoCartaoCreditoIntG;}
 if (isset($this->sc_temp_TaxaServicoCartaoDebitoIntG)) { $_SESSION['TaxaServicoCartaoDebitoIntG'] = $this->sc_temp_TaxaServicoCartaoDebitoIntG;}
 if (isset($this->sc_temp_IntegracaoInfolabAtiva)) { $_SESSION['IntegracaoInfolabAtiva'] = $this->sc_temp_IntegracaoInfolabAtiva;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt)) { $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->sc_temp_varIdSituacaoDocumentoExcluidoInt;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt)) { $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->sc_temp_varIdSituacaoDocumentoBaixadoInt;}
 if (isset($this->sc_temp_varServidorSMTP)) { $_SESSION['varServidorSMTP'] = $this->sc_temp_varServidorSMTP;}
 if (isset($this->sc_temp_varUsuarioSMTP)) { $_SESSION['varUsuarioSMTP'] = $this->sc_temp_varUsuarioSMTP;}
 if (isset($this->sc_temp_varSenhaSMTP)) { $_SESSION['varSenhaSMTP'] = $this->sc_temp_varSenhaSMTP;}
 if (isset($this->sc_temp_varRemetente)) { $_SESSION['varRemetente'] = $this->sc_temp_varRemetente;}
 if (isset($this->sc_temp_varClubeTiro)) { $_SESSION['varClubeTiro'] = $this->sc_temp_varClubeTiro;}
 if (isset($this->sc_temp_varGravarAuditoria)) { $_SESSION['varGravarAuditoria'] = $this->sc_temp_varGravarAuditoria;}
 if (isset($this->sc_temp_varEstoque)) { $_SESSION['varEstoque'] = $this->sc_temp_varEstoque;}
 if (isset($this->sc_temp_varIdContaCaixaPadrao)) { $_SESSION['varIdContaCaixaPadrao'] = $this->sc_temp_varIdContaCaixaPadrao;}
 if (isset($this->sc_temp_varUtilizaCentroCusto)) { $_SESSION['varUtilizaCentroCusto'] = $this->sc_temp_varUtilizaCentroCusto;}
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
 if (isset($this->sc_temp_varColaborador)) { $_SESSION['varColaborador'] = $this->sc_temp_varColaborador;}
 if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('AcessoNegado_Ctr') . "/AcessoNegado_Ctr.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
}	

if ($this->sc_temp_varPrivAdmin == 1 || $this->sc_temp_varColaborador == 'V' ) {
	$sql = "SELECT 
			Nome,
			'S',
			'S',
			'S',
			'S',
			'S',
			'S'
	    FROM aplicacao";
}
else {
	$sql = "SELECT 
			APL.Nome,
			GUA.Consulta,
			GUA.Inclusao,
			GUA.Exclusao,
			GUA.Alteracao,
			GUA.Exportacao,
			GUA.Impressao
	    FROM grupousuarioaplicacao GUA
		LEFT JOIN aplicacao APL ON (APL.IdAplicacao = GUA.IdAplicacao)
	    WHERE $this->sc_temp_varPrivAdmin = 1 OR 
			  GUA.IdGrupoUsuario IN	(SELECT IdGrupoUsuario
		   		                         FROM usuariogrupousuario 
		   		                         WHERE IdTenacidade = '$this->sc_temp_varIdTenacidade' AND IdUsuario = '$this->sc_temp_varIdUsuario')";
}
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


if ($this->rs !== false)
{
	$lista = "";
	while (!$this->rs->EOF)
	{
		if( $this->sc_temp_varPrivAdmin == 1 ||
			$this->rs->fields[1] == 'S' || 
		    $this->rs->fields[2] == 'S' || 
		    $this->rs->fields[3] == 'S' || 
		    $this->rs->fields[4] == 'S' || 
		    $this->rs->fields[5] == 'S' || 
		    $this->rs->fields[6] == 'S') {
		    $_SESSION['scriptcase']['sc_apl_seg'][$this->rs->fields[0]] = "on";;
			$lista = $lista . $this->rs->fields[0];
		}
		else {
		    $_SESSION['scriptcase']['sc_apl_seg'][$this->rs->fields[0]] = "off";;
		}
		if ($this->sc_temp_varPrivAdmin == 1) {
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['access'] = 'on';
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['insert'] = 'on';
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['delete'] = 'on';
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['update'] = 'on';
			$export_permission = 'btn_display_on';
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xls'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xls'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['xls'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'xls';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['word'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['word'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['word'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['word'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['word'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'word';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['pdf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['pdf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['pdf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'pdf';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xml'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xml'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['xml'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'xml';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['csv'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['csv'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['csv'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'csv';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['rtf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['rtf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['rtf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'rtf';
}
;

			$export_permission = 'btn_display_on';
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['print'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['print'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['print'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['print'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['print'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'print';
}
;
		}
		else {
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['access'] = $this->has_priv($this->rs->fields[1]);
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['insert'] = $this->has_priv($this->rs->fields[2]);
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['delete'] = $this->has_priv($this->rs->fields[3]);
			$_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['update'] = $this->has_priv($this->rs->fields[4]);
			$export_permission = 'btn_display_'. $this->has_priv($this->rs->fields[5]);
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xls'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xls'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xls'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['xls'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'xls';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['word'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['word'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['word'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['word'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['word'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'word';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['pdf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['pdf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['pdf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['pdf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'pdf';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xml'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xml'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['xml'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['xml'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'xml';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['csv'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['csv'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['csv'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['csv'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'csv';
}
;
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['rtf'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['rtf'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['rtf'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['rtf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'rtf';
}
;

			$export_permission = 'btn_display_'. $this->has_priv($this->rs->fields[6]);
			if ($export_permission == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['print'] = 'on';
}
elseif ($export_permission == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['btn_display']['print'] = 'off';
}
elseif ($export_permission == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['print'] = 'on';
}
elseif ($export_permission == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]]['field_display']['print'] = 'off';
}
elseif ($export_permission == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission]['print'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$this->rs->fields[0]][$export_permission] = 'print';
}
;
		}

		$this->rs->MoveNext();	
	}
	$this->rs->Close();
	if ($varColaborador == 'V') {
		
		 if (isset($this->sc_temp_IdTipoEspecieCartaoDebitoIntG)) { $_SESSION['IdTipoEspecieCartaoDebitoIntG'] = $this->sc_temp_IdTipoEspecieCartaoDebitoIntG;}
 if (isset($this->sc_temp_IdTipoEspecieCartaoCreditoIntG)) { $_SESSION['IdTipoEspecieCartaoCreditoIntG'] = $this->sc_temp_IdTipoEspecieCartaoCreditoIntG;}
 if (isset($this->sc_temp_TaxaServicoCartaoCreditoIntG)) { $_SESSION['TaxaServicoCartaoCreditoIntG'] = $this->sc_temp_TaxaServicoCartaoCreditoIntG;}
 if (isset($this->sc_temp_TaxaServicoCartaoDebitoIntG)) { $_SESSION['TaxaServicoCartaoDebitoIntG'] = $this->sc_temp_TaxaServicoCartaoDebitoIntG;}
 if (isset($this->sc_temp_IntegracaoInfolabAtiva)) { $_SESSION['IntegracaoInfolabAtiva'] = $this->sc_temp_IntegracaoInfolabAtiva;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt)) { $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->sc_temp_varIdSituacaoDocumentoExcluidoInt;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt)) { $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->sc_temp_varIdSituacaoDocumentoBaixadoInt;}
 if (isset($this->sc_temp_varServidorSMTP)) { $_SESSION['varServidorSMTP'] = $this->sc_temp_varServidorSMTP;}
 if (isset($this->sc_temp_varUsuarioSMTP)) { $_SESSION['varUsuarioSMTP'] = $this->sc_temp_varUsuarioSMTP;}
 if (isset($this->sc_temp_varSenhaSMTP)) { $_SESSION['varSenhaSMTP'] = $this->sc_temp_varSenhaSMTP;}
 if (isset($this->sc_temp_varRemetente)) { $_SESSION['varRemetente'] = $this->sc_temp_varRemetente;}
 if (isset($this->sc_temp_varClubeTiro)) { $_SESSION['varClubeTiro'] = $this->sc_temp_varClubeTiro;}
 if (isset($this->sc_temp_varGravarAuditoria)) { $_SESSION['varGravarAuditoria'] = $this->sc_temp_varGravarAuditoria;}
 if (isset($this->sc_temp_varEstoque)) { $_SESSION['varEstoque'] = $this->sc_temp_varEstoque;}
 if (isset($this->sc_temp_varIdContaCaixaPadrao)) { $_SESSION['varIdContaCaixaPadrao'] = $this->sc_temp_varIdContaCaixaPadrao;}
 if (isset($this->sc_temp_varUtilizaCentroCusto)) { $_SESSION['varUtilizaCentroCusto'] = $this->sc_temp_varUtilizaCentroCusto;}
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
 if (isset($this->sc_temp_varColaborador)) { $_SESSION['varColaborador'] = $this->sc_temp_varColaborador;}
 if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('MenuMobile_Mnu') . "/MenuMobile_Mnu.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };	
		
	} else { 	
		
		 if (isset($this->sc_temp_IdTipoEspecieCartaoDebitoIntG)) { $_SESSION['IdTipoEspecieCartaoDebitoIntG'] = $this->sc_temp_IdTipoEspecieCartaoDebitoIntG;}
 if (isset($this->sc_temp_IdTipoEspecieCartaoCreditoIntG)) { $_SESSION['IdTipoEspecieCartaoCreditoIntG'] = $this->sc_temp_IdTipoEspecieCartaoCreditoIntG;}
 if (isset($this->sc_temp_TaxaServicoCartaoCreditoIntG)) { $_SESSION['TaxaServicoCartaoCreditoIntG'] = $this->sc_temp_TaxaServicoCartaoCreditoIntG;}
 if (isset($this->sc_temp_TaxaServicoCartaoDebitoIntG)) { $_SESSION['TaxaServicoCartaoDebitoIntG'] = $this->sc_temp_TaxaServicoCartaoDebitoIntG;}
 if (isset($this->sc_temp_IntegracaoInfolabAtiva)) { $_SESSION['IntegracaoInfolabAtiva'] = $this->sc_temp_IntegracaoInfolabAtiva;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt)) { $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->sc_temp_varIdSituacaoDocumentoExcluidoInt;}
 if (isset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt)) { $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->sc_temp_varIdSituacaoDocumentoBaixadoInt;}
 if (isset($this->sc_temp_varServidorSMTP)) { $_SESSION['varServidorSMTP'] = $this->sc_temp_varServidorSMTP;}
 if (isset($this->sc_temp_varUsuarioSMTP)) { $_SESSION['varUsuarioSMTP'] = $this->sc_temp_varUsuarioSMTP;}
 if (isset($this->sc_temp_varSenhaSMTP)) { $_SESSION['varSenhaSMTP'] = $this->sc_temp_varSenhaSMTP;}
 if (isset($this->sc_temp_varRemetente)) { $_SESSION['varRemetente'] = $this->sc_temp_varRemetente;}
 if (isset($this->sc_temp_varClubeTiro)) { $_SESSION['varClubeTiro'] = $this->sc_temp_varClubeTiro;}
 if (isset($this->sc_temp_varGravarAuditoria)) { $_SESSION['varGravarAuditoria'] = $this->sc_temp_varGravarAuditoria;}
 if (isset($this->sc_temp_varEstoque)) { $_SESSION['varEstoque'] = $this->sc_temp_varEstoque;}
 if (isset($this->sc_temp_varIdContaCaixaPadrao)) { $_SESSION['varIdContaCaixaPadrao'] = $this->sc_temp_varIdContaCaixaPadrao;}
 if (isset($this->sc_temp_varUtilizaCentroCusto)) { $_SESSION['varUtilizaCentroCusto'] = $this->sc_temp_varUtilizaCentroCusto;}
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
 if (isset($this->sc_temp_varColaborador)) { $_SESSION['varColaborador'] = $this->sc_temp_varColaborador;}
 if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('MenuPrincipal_Mnu') . "/MenuPrincipal_Mnu.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };	
		
	}
}
if (isset($this->sc_temp_IdTipoEspecieCartaoDebitoIntG)) { $_SESSION['IdTipoEspecieCartaoDebitoIntG'] = $this->sc_temp_IdTipoEspecieCartaoDebitoIntG;}
if (isset($this->sc_temp_IdTipoEspecieCartaoCreditoIntG)) { $_SESSION['IdTipoEspecieCartaoCreditoIntG'] = $this->sc_temp_IdTipoEspecieCartaoCreditoIntG;}
if (isset($this->sc_temp_TaxaServicoCartaoCreditoIntG)) { $_SESSION['TaxaServicoCartaoCreditoIntG'] = $this->sc_temp_TaxaServicoCartaoCreditoIntG;}
if (isset($this->sc_temp_TaxaServicoCartaoDebitoIntG)) { $_SESSION['TaxaServicoCartaoDebitoIntG'] = $this->sc_temp_TaxaServicoCartaoDebitoIntG;}
if (isset($this->sc_temp_IntegracaoInfolabAtiva)) { $_SESSION['IntegracaoInfolabAtiva'] = $this->sc_temp_IntegracaoInfolabAtiva;}
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
if (isset($this->sc_temp_varIdSituacaoDocumentoExcluidoInt)) { $_SESSION['varIdSituacaoDocumentoExcluidoInt'] = $this->sc_temp_varIdSituacaoDocumentoExcluidoInt;}
if (isset($this->sc_temp_varIdSituacaoDocumentoBaixadoInt)) { $_SESSION['varIdSituacaoDocumentoBaixadoInt'] = $this->sc_temp_varIdSituacaoDocumentoBaixadoInt;}
if (isset($this->sc_temp_varServidorSMTP)) { $_SESSION['varServidorSMTP'] = $this->sc_temp_varServidorSMTP;}
if (isset($this->sc_temp_varUsuarioSMTP)) { $_SESSION['varUsuarioSMTP'] = $this->sc_temp_varUsuarioSMTP;}
if (isset($this->sc_temp_varSenhaSMTP)) { $_SESSION['varSenhaSMTP'] = $this->sc_temp_varSenhaSMTP;}
if (isset($this->sc_temp_varRemetente)) { $_SESSION['varRemetente'] = $this->sc_temp_varRemetente;}
if (isset($this->sc_temp_varClubeTiro)) { $_SESSION['varClubeTiro'] = $this->sc_temp_varClubeTiro;}
if (isset($this->sc_temp_varGravarAuditoria)) { $_SESSION['varGravarAuditoria'] = $this->sc_temp_varGravarAuditoria;}
if (isset($this->sc_temp_varEstoque)) { $_SESSION['varEstoque'] = $this->sc_temp_varEstoque;}
if (isset($this->sc_temp_varIdContaCaixaPadrao)) { $_SESSION['varIdContaCaixaPadrao'] = $this->sc_temp_varIdContaCaixaPadrao;}
if (isset($this->sc_temp_varUtilizaCentroCusto)) { $_SESSION['varUtilizaCentroCusto'] = $this->sc_temp_varUtilizaCentroCusto;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
if (isset($this->sc_temp_varColaborador)) { $_SESSION['varColaborador'] = $this->sc_temp_varColaborador;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off'; 
          }
      }
   }

    function ValidateField_login(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['login'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->login) > 40) 
          { 
              $hasError = true;
              $Campos_Crit .= "Login " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['login']))
              {
                  $Campos_Erros['login'] = array();
              }
              $Campos_Erros['login'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['login']) || !is_array($this->NM_ajax_info['errList']['login']))
              {
                  $this->NM_ajax_info['errList']['login'] = array();
              }
              $this->NM_ajax_info['errList']['login'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'login';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_login

    function ValidateField_pswd(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['pswd'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->pswd) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Pswd " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['pswd']))
              {
                  $Campos_Erros['pswd'] = array();
              }
              $Campos_Erros['pswd'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['pswd']) || !is_array($this->NM_ajax_info['errList']['pswd']))
              {
                  $this->NM_ajax_info['errList']['pswd'] = array();
              }
              $this->NM_ajax_info['errList']['pswd'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'pswd';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_pswd

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
    $this->nmgp_dados_form['login'] = $this->login;
    $this->nmgp_dados_form['pswd'] = $this->pswd;
    $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
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
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
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

   function ajax_return_values()
   {
          $this->ajax_return_values_login();
          $this->ajax_return_values_pswd();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- login
   function ajax_return_values_login($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("login", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->login);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['login'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- pswd
   function ajax_return_values_pswd($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("pswd", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->pswd);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['pswd'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['upload_dir'][$fieldName][] = $newName;
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
//
function ValidouUsuario()
{
$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'on';
  
$resultado = FALSE;

 
      $nm_select = "
  SELECT
     IdColaborador
  FROM
     colaborador
  WHERE login = '$parLogin'
    AND Senha = '$parSenha'
"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->tabLogin = array();
      $this->tablogin = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 $SCrx->fields[0] = str_replace(',', '.', $SCrx->fields[0]);
                 $SCrx->fields[0] = (strpos(strtolower($SCrx->fields[0]), "e")) ? (float)$SCrx->fields[0] : $SCrx->fields[0];
                 $SCrx->fields[0] = (string)$SCrx->fields[0];
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->tabLogin[$SCy] [$SCx] = $SCrx->fields[$SCx];
                      $this->tablogin[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->tabLogin = false;
          $this->tabLogin_erro = $this->Db->ErrorMsg();
          $this->tablogin = false;
          $this->tablogin_erro = $this->Db->ErrorMsg();
      } 


if (FALSE === $this->tablogin ) {
  
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Empresa, login e/ou senha não cadastrados (001).<BR>";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Login_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Login_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Empresa, login e/ou senha não cadastrados (001).<BR>";
 }
;
}
elseif (empty($this->tablogin )) {
  
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Empresa, login e/ou senha não cadastrados (002).<BR>";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Login_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Login_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Empresa, login e/ou senha não cadastrados (002).<BR>";
 }
;
}
else {
  $parIdColaborador = $this->tablogin[0][0];	
  $resultado = TRUE;
}

return $resultado;
$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off';
}
function has_priv($param)
{
$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'on';
  
return ($param == 'S' ? 'on' : 'off');

$_SESSION['scriptcase']['Login_Ctr']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              Login_Ctr_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_saida_global = $_SESSION['scriptcase']['nm_sc_retorno']; 
      } 
    $this->nm_formatar_campos();
        $this->initFormPages();
    $login = $this->login;
    $pswd = $this->pswd;
    header("X-XSS-Protection: 1; mode=block");
    include_once("Login_Ctr_form_user.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array(""))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


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
       $nmgp_saida_form = "Login_Ctr_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['nm_run_menu'] = 2;
       $nmgp_saida_form = "Login_Ctr_fim.php";
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['redir_target_name']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['redir_target_name'])
       {
           $sTarget = $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['redir_target_name'];
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['redir_target_name']);
       }
       else
       {
           $sTarget = '_self';
       }
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       Login_Ctr_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           Login_Ctr_pack_ajax_response();
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
       Login_Ctr_pack_ajax_response();
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
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "ok":
                return array("sub_form_b.sc-unique-btn-1");
                break;
            case "help":
                return array("sc_b_hlp_b");
                break;
            case "exit":
                return array("Bsair_b.sc-unique-btn-2", "Bsair_b.sc-unique-btn-3");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . ""; } else { echo "InfoTIME - LIGA Sistemas"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['Login_Ctr']['ordem_ord'] == " desc") {
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
    {        if ('desc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('asc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('' != $this->Ini->Label_sort) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } else {
            return '';
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
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
