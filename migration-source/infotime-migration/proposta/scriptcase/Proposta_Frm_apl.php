<?php
//
class Proposta_Frm_apl
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
   var $idproposta;
   var $idtenacidade;
   var $idcliente;
   var $idtipocontrato;
   var $idtipocontrato_1;
   var $idindicereajuste;
   var $idindicereajuste_1;
   var $idempresa;
   var $idempresa_1;
   var $idcontrato;
   var $idusuarioinclusao;
   var $idusuarioinclusao_1;
   var $idusuariofechamento;
   var $idusuariofechamento_1;
   var $idcolaboradorimplantacao;
   var $idcolaboradorimplantacao_1;
   var $idusuarioauditoria;
   var $datainclusao;
   var $datainclusao_hora;
   var $datafechamento;
   var $datafechamento_hora;
   var $motivofechamento;
   var $solicitante;
   var $diavencimento;
   var $diasvalidade;
   var $situacaoproposta;
   var $situacaoproposta_1;
   var $datainicioimplantacao;
   var $prazoentrega;
   var $formapagamento;
   var $observacoes;
   var $nomearquivo;
   var $nomereferencia;
   var $nomereferencia_scfile_name;
   var $nomereferencia_ul_name;
   var $nomereferencia_ul_type;
   var $nomereferencia_limpa;
   var $nomereferencia_salva;
   var $historico;
   var $valordescontounico;
   var $valordescontomensal;
   var $motivodescontounico;
   var $motivodescontomensal;
   var $qtdparcelas;
   var $enderecoipauditoria;
   var $nomeaplicacaoauditoria;
   var $andamento;
   var $produtos;
   var $valorpropostamensal;
   var $valorpropostaunica;
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
          if (isset($this->NM_ajax_info['param']['andamento']))
          {
              $this->andamento = $this->NM_ajax_info['param']['andamento'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['datafechamento']))
          {
              $this->datafechamento = $this->NM_ajax_info['param']['datafechamento'];
          }
          if (isset($this->NM_ajax_info['param']['datainclusao']))
          {
              $this->datainclusao = $this->NM_ajax_info['param']['datainclusao'];
          }
          if (isset($this->NM_ajax_info['param']['diasvalidade']))
          {
              $this->diasvalidade = $this->NM_ajax_info['param']['diasvalidade'];
          }
          if (isset($this->NM_ajax_info['param']['diavencimento']))
          {
              $this->diavencimento = $this->NM_ajax_info['param']['diavencimento'];
          }
          if (isset($this->NM_ajax_info['param']['formapagamento']))
          {
              $this->formapagamento = $this->NM_ajax_info['param']['formapagamento'];
          }
          if (isset($this->NM_ajax_info['param']['idcliente']))
          {
              $this->idcliente = $this->NM_ajax_info['param']['idcliente'];
          }
          if (isset($this->NM_ajax_info['param']['idcontrato']))
          {
              $this->idcontrato = $this->NM_ajax_info['param']['idcontrato'];
          }
          if (isset($this->NM_ajax_info['param']['idempresa']))
          {
              $this->idempresa = $this->NM_ajax_info['param']['idempresa'];
          }
          if (isset($this->NM_ajax_info['param']['idindicereajuste']))
          {
              $this->idindicereajuste = $this->NM_ajax_info['param']['idindicereajuste'];
          }
          if (isset($this->NM_ajax_info['param']['idproposta']))
          {
              $this->idproposta = $this->NM_ajax_info['param']['idproposta'];
          }
          if (isset($this->NM_ajax_info['param']['idtipocontrato']))
          {
              $this->idtipocontrato = $this->NM_ajax_info['param']['idtipocontrato'];
          }
          if (isset($this->NM_ajax_info['param']['idusuariofechamento']))
          {
              $this->idusuariofechamento = $this->NM_ajax_info['param']['idusuariofechamento'];
          }
          if (isset($this->NM_ajax_info['param']['idusuarioinclusao']))
          {
              $this->idusuarioinclusao = $this->NM_ajax_info['param']['idusuarioinclusao'];
          }
          if (isset($this->NM_ajax_info['param']['motivodescontomensal']))
          {
              $this->motivodescontomensal = $this->NM_ajax_info['param']['motivodescontomensal'];
          }
          if (isset($this->NM_ajax_info['param']['motivodescontounico']))
          {
              $this->motivodescontounico = $this->NM_ajax_info['param']['motivodescontounico'];
          }
          if (isset($this->NM_ajax_info['param']['motivofechamento']))
          {
              $this->motivofechamento = $this->NM_ajax_info['param']['motivofechamento'];
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
          if (isset($this->NM_ajax_info['param']['nomearquivo']))
          {
              $this->nomearquivo = $this->NM_ajax_info['param']['nomearquivo'];
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
          if (isset($this->NM_ajax_info['param']['observacoes']))
          {
              $this->observacoes = $this->NM_ajax_info['param']['observacoes'];
          }
          if (isset($this->NM_ajax_info['param']['prazoentrega']))
          {
              $this->prazoentrega = $this->NM_ajax_info['param']['prazoentrega'];
          }
          if (isset($this->NM_ajax_info['param']['produtos']))
          {
              $this->produtos = $this->NM_ajax_info['param']['produtos'];
          }
          if (isset($this->NM_ajax_info['param']['qtdparcelas']))
          {
              $this->qtdparcelas = $this->NM_ajax_info['param']['qtdparcelas'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['situacaoproposta']))
          {
              $this->situacaoproposta = $this->NM_ajax_info['param']['situacaoproposta'];
          }
          if (isset($this->NM_ajax_info['param']['solicitante']))
          {
              $this->solicitante = $this->NM_ajax_info['param']['solicitante'];
          }
          if (isset($this->NM_ajax_info['param']['valordescontomensal']))
          {
              $this->valordescontomensal = $this->NM_ajax_info['param']['valordescontomensal'];
          }
          if (isset($this->NM_ajax_info['param']['valordescontounico']))
          {
              $this->valordescontounico = $this->NM_ajax_info['param']['valordescontounico'];
          }
          if (isset($this->NM_ajax_info['param']['valorpropostamensal']))
          {
              $this->valorpropostamensal = $this->NM_ajax_info['param']['valorpropostamensal'];
          }
          if (isset($this->NM_ajax_info['param']['valorpropostaunica']))
          {
              $this->valorpropostaunica = $this->NM_ajax_info['param']['valorpropostaunica'];
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
      if (isset($this->varIdTenacidade) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (isset($this->varProposta_IdCliente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varProposta_IdCliente'] = $this->varProposta_IdCliente;
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
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varDiretorioArquivo) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varDiretorioArquivo'] = $this->varDiretorioArquivo;
      }
      if (isset($this->varPrimeiraVez) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (isset($this->varNomeReferencia) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
      }
      if (isset($this->varSituacaoPropostaAnt) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varSituacaoPropostaAnt'] = $this->varSituacaoPropostaAnt;
      }
      if (isset($this->varDescontoMaximoImp) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varDescontoMaximoImp'] = $this->varDescontoMaximoImp;
      }
      if (isset($this->varDescontoMaximoMes) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varDescontoMaximoMes'] = $this->varDescontoMaximoMes;
      }
      if (isset($_POST["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
      }
      if (isset($_POST["varProposta_IdCliente"]) && isset($this->varProposta_IdCliente)) 
      {
          $_SESSION['varProposta_IdCliente'] = $this->varProposta_IdCliente;
      }
      if (!isset($_POST["varProposta_IdCliente"]) && isset($_POST["varproposta_idcliente"])) 
      {
          $_SESSION['varProposta_IdCliente'] = $_POST["varproposta_idcliente"];
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
      if (isset($_POST["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_POST["varIdUsuario"]) && isset($_POST["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_POST["varidusuario"];
      }
      if (isset($_POST["varDiretorioArquivo"]) && isset($this->varDiretorioArquivo)) 
      {
          $_SESSION['varDiretorioArquivo'] = $this->varDiretorioArquivo;
      }
      if (!isset($_POST["varDiretorioArquivo"]) && isset($_POST["vardiretorioarquivo"])) 
      {
          $_SESSION['varDiretorioArquivo'] = $_POST["vardiretorioarquivo"];
      }
      if (isset($_POST["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_POST["varPrimeiraVez"]) && isset($_POST["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_POST["varprimeiravez"];
      }
      if (isset($_POST["varNomeReferencia"]) && isset($this->varNomeReferencia)) 
      {
          $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
      }
      if (!isset($_POST["varNomeReferencia"]) && isset($_POST["varnomereferencia"])) 
      {
          $_SESSION['varNomeReferencia'] = $_POST["varnomereferencia"];
      }
      if (isset($_POST["varSituacaoPropostaAnt"]) && isset($this->varSituacaoPropostaAnt)) 
      {
          $_SESSION['varSituacaoPropostaAnt'] = $this->varSituacaoPropostaAnt;
      }
      if (!isset($_POST["varSituacaoPropostaAnt"]) && isset($_POST["varsituacaopropostaant"])) 
      {
          $_SESSION['varSituacaoPropostaAnt'] = $_POST["varsituacaopropostaant"];
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
      if (isset($_GET["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
      }
      if (isset($_GET["varProposta_IdCliente"]) && isset($this->varProposta_IdCliente)) 
      {
          $_SESSION['varProposta_IdCliente'] = $this->varProposta_IdCliente;
      }
      if (!isset($_GET["varProposta_IdCliente"]) && isset($_GET["varproposta_idcliente"])) 
      {
          $_SESSION['varProposta_IdCliente'] = $_GET["varproposta_idcliente"];
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
      if (isset($_GET["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_GET["varIdUsuario"]) && isset($_GET["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_GET["varidusuario"];
      }
      if (isset($_GET["varDiretorioArquivo"]) && isset($this->varDiretorioArquivo)) 
      {
          $_SESSION['varDiretorioArquivo'] = $this->varDiretorioArquivo;
      }
      if (!isset($_GET["varDiretorioArquivo"]) && isset($_GET["vardiretorioarquivo"])) 
      {
          $_SESSION['varDiretorioArquivo'] = $_GET["vardiretorioarquivo"];
      }
      if (isset($_GET["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_GET["varPrimeiraVez"]) && isset($_GET["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_GET["varprimeiravez"];
      }
      if (isset($_GET["varNomeReferencia"]) && isset($this->varNomeReferencia)) 
      {
          $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
      }
      if (!isset($_GET["varNomeReferencia"]) && isset($_GET["varnomereferencia"])) 
      {
          $_SESSION['varNomeReferencia'] = $_GET["varnomereferencia"];
      }
      if (isset($_GET["varSituacaoPropostaAnt"]) && isset($this->varSituacaoPropostaAnt)) 
      {
          $_SESSION['varSituacaoPropostaAnt'] = $this->varSituacaoPropostaAnt;
      }
      if (!isset($_GET["varSituacaoPropostaAnt"]) && isset($_GET["varsituacaopropostaant"])) 
      {
          $_SESSION['varSituacaoPropostaAnt'] = $_GET["varsituacaopropostaant"];
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
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['embutida_parms']);
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
                 nm_limpa_str_Proposta_Frm($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varProposta_IdCliente) && isset($this->varproposta_idcliente)) 
          {
              $this->varProposta_IdCliente = $this->varproposta_idcliente;
          }
          if (isset($this->varProposta_IdCliente)) 
          {
              $_SESSION['varProposta_IdCliente'] = $this->varProposta_IdCliente;
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
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varDiretorioArquivo) && isset($this->vardiretorioarquivo)) 
          {
              $this->varDiretorioArquivo = $this->vardiretorioarquivo;
          }
          if (isset($this->varDiretorioArquivo)) 
          {
              $_SESSION['varDiretorioArquivo'] = $this->varDiretorioArquivo;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
          if (!isset($this->varNomeReferencia) && isset($this->varnomereferencia)) 
          {
              $this->varNomeReferencia = $this->varnomereferencia;
          }
          if (isset($this->varNomeReferencia)) 
          {
              $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
          }
          if (!isset($this->varSituacaoPropostaAnt) && isset($this->varsituacaopropostaant)) 
          {
              $this->varSituacaoPropostaAnt = $this->varsituacaopropostaant;
          }
          if (isset($this->varSituacaoPropostaAnt)) 
          {
              $_SESSION['varSituacaoPropostaAnt'] = $this->varSituacaoPropostaAnt;
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
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['total']);
          }
          if (!isset($_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['total']))
          {
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['opc_ant']);
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varProposta_IdCliente) && isset($this->varproposta_idcliente)) 
          {
              $this->varProposta_IdCliente = $this->varproposta_idcliente;
          }
          if (isset($this->varProposta_IdCliente)) 
          {
              $_SESSION['varProposta_IdCliente'] = $this->varProposta_IdCliente;
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
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varDiretorioArquivo) && isset($this->vardiretorioarquivo)) 
          {
              $this->varDiretorioArquivo = $this->vardiretorioarquivo;
          }
          if (isset($this->varDiretorioArquivo)) 
          {
              $_SESSION['varDiretorioArquivo'] = $this->varDiretorioArquivo;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
          if (!isset($this->varNomeReferencia) && isset($this->varnomereferencia)) 
          {
              $this->varNomeReferencia = $this->varnomereferencia;
          }
          if (isset($this->varNomeReferencia)) 
          {
              $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
          }
          if (!isset($this->varSituacaoPropostaAnt) && isset($this->varsituacaopropostaant)) 
          {
              $this->varSituacaoPropostaAnt = $this->varsituacaopropostaant;
          }
          if (isset($this->varSituacaoPropostaAnt)) 
          {
              $_SESSION['varSituacaoPropostaAnt'] = $this->varSituacaoPropostaAnt;
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
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['nm_run_menu'] = 1;
      } 
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->datainclusao);
          $this->datainclusao      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->datainclusao_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->datafechamento);
          $this->datafechamento      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->datafechamento_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new Proposta_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
  $this->sc_temp_varPrimeiraVez = "";
$this->sc_temp_varIdTenacidade;
$this->sc_temp_varIdUsuario;
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['Proposta_Frm']['upload_field_info']['nomereferencia'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'Proposta_Frm',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/.+$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'N0',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Proposta_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Proposta_Frm'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Proposta_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Proposta_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('Proposta_Frm') . "/Proposta_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Proposta_Frm']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Proposta";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "Proposta_Frm")
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
      $this->nm_new_label['datafechamento'] = 'Aprovada em';
      $this->nm_new_label['idusuariofechamento'] = 'Aprovada por';
      $this->nm_new_label['motivofechamento'] = 'Motivo do fechamento';

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


      $this->arr_buttons['reabrir']['hint']             = "Reabrir a proposta";
      $this->arr_buttons['reabrir']['type']             = "button";
      $this->arr_buttons['reabrir']['value']            = "Reabrir";
      $this->arr_buttons['reabrir']['display']          = "only_text";
      $this->arr_buttons['reabrir']['display_position'] = "text_right";
      $this->arr_buttons['reabrir']['style']            = "";
      $this->arr_buttons['reabrir']['image']            = "";

      $this->arr_buttons['voltar']['hint']             = "Voltar à página anterior";
      $this->arr_buttons['voltar']['type']             = "button";
      $this->arr_buttons['voltar']['value']            = "Voltar";
      $this->arr_buttons['voltar']['display']          = "only_text";
      $this->arr_buttons['voltar']['display_position'] = "text_right";
      $this->arr_buttons['voltar']['style']            = "";
      $this->arr_buttons['voltar']['image']            = "";

      $this->arr_buttons['auditoria']['hint']             = "";
      $this->arr_buttons['auditoria']['type']             = "button";
      $this->arr_buttons['auditoria']['value']            = "Auditoria";
      $this->arr_buttons['auditoria']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['auditoria']['display_position'] = "text_right";
      $this->arr_buttons['auditoria']['style']            = "default";
      $this->arr_buttons['auditoria']['image']            = "";
      $this->arr_buttons['auditoria']['has_fa']            = "true";
      $this->arr_buttons['auditoria']['fontawesomeicon']            = "far fa-eye";

      $this->arr_buttons['sc_btn_0']['hint']             = "";
      $this->arr_buttons['sc_btn_0']['type']             = "button";
      $this->arr_buttons['sc_btn_0']['value']            = "Autorizações";
      $this->arr_buttons['sc_btn_0']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['sc_btn_0']['display_position'] = "text_right";
      $this->arr_buttons['sc_btn_0']['style']            = "default";
      $this->arr_buttons['sc_btn_0']['image']            = "";
      $this->arr_buttons['sc_btn_0']['has_fa']            = "true";
      $this->arr_buttons['sc_btn_0']['fontawesomeicon']            = "fas fa-key";

      $this->arr_buttons['sc_btn_1']['hint']             = "";
      $this->arr_buttons['sc_btn_1']['type']             = "button";
      $this->arr_buttons['sc_btn_1']['value']            = "Imprimir Proposta";
      $this->arr_buttons['sc_btn_1']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['sc_btn_1']['display_position'] = "text_right";
      $this->arr_buttons['sc_btn_1']['style']            = "default";
      $this->arr_buttons['sc_btn_1']['image']            = "";
      $this->arr_buttons['sc_btn_1']['has_fa']            = "true";
      $this->arr_buttons['sc_btn_1']['fontawesomeicon']            = "fas fa-print";

      $this->arr_buttons['imprimir']['hint']             = "";
      $this->arr_buttons['imprimir']['type']             = "button";
      $this->arr_buttons['imprimir']['value']            = "Imprimir Contrato";
      $this->arr_buttons['imprimir']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['imprimir']['display_position'] = "text_right";
      $this->arr_buttons['imprimir']['style']            = "default";
      $this->arr_buttons['imprimir']['image']            = "";
      $this->arr_buttons['imprimir']['has_fa']            = "true";
      $this->arr_buttons['imprimir']['fontawesomeicon']            = "fas fa-print";

      $this->arr_buttons['group_group_1']= array(
          'value'            => "Ações",
          'hint'             => "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "fas fa-download",
          'fontawesomeicon'  => "fas fa-download",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );


      $_SESSION['scriptcase']['error_icon']['Proposta_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['Proposta_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "Proposta_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['nomereferencia_ul_name']) && '' != $this->NM_ajax_info['param']['nomereferencia_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->NM_ajax_info['param']['nomereferencia_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_scfile_name = substr($this->NM_ajax_info['param']['nomereferencia_ul_name'], 12);
          $this->nomereferencia_scfile_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
          $this->nomereferencia_ul_name = $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_ul_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
      }
      elseif (isset($this->nomereferencia_ul_name) && '' != $this->nomereferencia_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->nomereferencia_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->nomereferencia_ul_name;
          $this->nomereferencia_scfile_name = substr($this->nomereferencia_ul_name, 12);
          $this->nomereferencia_scfile_type = $this->nomereferencia_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['goto']      = 'on';
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
      $this->nmgp_botoes['Reabrir'] = "on";
      $this->nmgp_botoes['Voltar'] = "on";
      $this->nmgp_botoes['Auditoria'] = "on";
      $this->nmgp_botoes['sc_btn_0'] = "on";
      $this->nmgp_botoes['sc_btn_1'] = "on";
      $this->nmgp_botoes['Imprimir'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Proposta_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['Proposta_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['Proposta_Frm'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form'];
          if (!isset($this->idtenacidade)){$this->idtenacidade = $this->nmgp_dados_form['idtenacidade'];} 
          if (!isset($this->idcolaboradorimplantacao)){$this->idcolaboradorimplantacao = $this->nmgp_dados_form['idcolaboradorimplantacao'];} 
          if (!isset($this->idusuarioauditoria)){$this->idusuarioauditoria = $this->nmgp_dados_form['idusuarioauditoria'];} 
          if (!isset($this->datainicioimplantacao)){$this->datainicioimplantacao = $this->nmgp_dados_form['datainicioimplantacao'];} 
          if (!isset($this->historico)){$this->historico = $this->nmgp_dados_form['historico'];} 
          if (!isset($this->enderecoipauditoria)){$this->enderecoipauditoria = $this->nmgp_dados_form['enderecoipauditoria'];} 
          if (!isset($this->nomeaplicacaoauditoria)){$this->nomeaplicacaoauditoria = $this->nmgp_dados_form['nomeaplicacaoauditoria'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['valorpropostamensal'] != "null"){$this->valorpropostamensal = $this->nmgp_dados_form['valorpropostamensal'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['valorpropostaunica'] != "null"){$this->valorpropostaunica = $this->nmgp_dados_form['valorpropostaunica'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("Proposta_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'Proposta_Frm/Proposta_Frm_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'Proposta_Frm_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'Proposta_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'Proposta_Frm_help.txt');
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
          require_once($this->Ini->path_embutida . 'Proposta_Frm/Proposta_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "Proposta_Frm_erro.class.php"); 
      }
      $this->Erro      = new Proposta_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao']))
         { 
             if ($this->idproposta != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['Proposta_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['Reabrir'] = "off";
          $this->nmgp_botoes['Voltar'] = "on";
          $this->nmgp_botoes['Auditoria'] = "off";
          $this->nmgp_botoes['sc_btn_0'] = "off";
          $this->nmgp_botoes['sc_btn_1'] = "off";
          $this->nmgp_botoes['Imprimir'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['Reabrir'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes']['Reabrir'];
          $this->nmgp_botoes['Voltar'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes']['Voltar'];
          $this->nmgp_botoes['Auditoria'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes']['Auditoria'];
          $this->nmgp_botoes['sc_btn_0'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes']['sc_btn_0'];
          $this->nmgp_botoes['sc_btn_1'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes']['sc_btn_1'];
          $this->nmgp_botoes['Imprimir'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes']['Imprimir'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form'];
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
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['embutida_form'] = false;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['embutida_proc'] = true;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['reg_start'] = "";
          unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['total']);
          $detailAppObject = "PropostaItem_Gde_apl";
          require_once($this->Ini->root . $this->Ini->path_link  . SC_dir_app_name('PropostaItem_Gde') . "/PropostaItem_Gde.php");
          require_once($this->Ini->root . $this->Ini->path_link  . SC_dir_app_name('PropostaItem_Gde') . "/PropostaItem_Gde_apl.php");
          $this->PropostaItem_Gde = new $detailAppObject;
      }
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['Proposta_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['Proposta_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['Proposta_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['Proposta_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->idproposta)) { $this->nm_limpa_alfa($this->idproposta); }
      if (isset($this->idcliente)) { $this->nm_limpa_alfa($this->idcliente); }
      if (isset($this->idtipocontrato)) { $this->nm_limpa_alfa($this->idtipocontrato); }
      if (isset($this->idindicereajuste)) { $this->nm_limpa_alfa($this->idindicereajuste); }
      if (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
      if (isset($this->idcontrato)) { $this->nm_limpa_alfa($this->idcontrato); }
      if (isset($this->idusuarioinclusao)) { $this->nm_limpa_alfa($this->idusuarioinclusao); }
      if (isset($this->idusuariofechamento)) { $this->nm_limpa_alfa($this->idusuariofechamento); }
      if (isset($this->motivofechamento)) { $this->nm_limpa_alfa($this->motivofechamento); }
      if (isset($this->solicitante)) { $this->nm_limpa_alfa($this->solicitante); }
      if (isset($this->diavencimento)) { $this->nm_limpa_alfa($this->diavencimento); }
      if (isset($this->diasvalidade)) { $this->nm_limpa_alfa($this->diasvalidade); }
      if (isset($this->situacaoproposta)) { $this->nm_limpa_alfa($this->situacaoproposta); }
      if (isset($this->prazoentrega)) { $this->nm_limpa_alfa($this->prazoentrega); }
      if (isset($this->formapagamento)) { $this->nm_limpa_alfa($this->formapagamento); }
      if (isset($this->observacoes)) { $this->nm_limpa_alfa($this->observacoes); }
      if (isset($this->nomearquivo)) { $this->nm_limpa_alfa($this->nomearquivo); }
      if (isset($this->valordescontounico)) { $this->nm_limpa_alfa($this->valordescontounico); }
      if (isset($this->valordescontomensal)) { $this->nm_limpa_alfa($this->valordescontomensal); }
      if (isset($this->motivodescontounico)) { $this->nm_limpa_alfa($this->motivodescontounico); }
      if (isset($this->motivodescontomensal)) { $this->nm_limpa_alfa($this->motivodescontomensal); }
      if (isset($this->qtdparcelas)) { $this->nm_limpa_alfa($this->qtdparcelas); }
      if (isset($this->andamento)) { $this->nm_limpa_alfa($this->andamento); }
      if (isset($this->produtos)) { $this->nm_limpa_alfa($this->produtos); }
      if ($nm_opc_form_php == "formphp")
      { 
          if ($nm_call_php == "Reabrir")
          { 
              $this->sc_btn_Reabrir();
          } 
          if ($nm_call_php == "Voltar")
          { 
              $this->sc_btn_Voltar();
          } 
          if ($nm_call_php == "Auditoria")
          { 
              $this->sc_btn_Auditoria();
          } 
          if ($nm_call_php == "sc_btn_0")
          { 
              $this->sc_btn_sc_btn_0();
          } 
          if ($nm_call_php == "sc_btn_1")
          { 
              $this->sc_btn_sc_btn_1();
          } 
          if ($nm_call_php == "Imprimir")
          { 
              $this->sc_btn_Imprimir();
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "Proposta_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select'];
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
      //-- idproposta
      $this->field_config['idproposta']               = array();
      $this->field_config['idproposta']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idproposta']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idproposta']['symbol_dec'] = '';
      $this->field_config['idproposta']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idproposta']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- datainclusao
      $this->field_config['datainclusao']                 = array();
      $this->field_config['datainclusao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datainclusao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datainclusao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datainclusao']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'datainclusao');
      //-- diavencimento
      $this->field_config['diavencimento']               = array();
      $this->field_config['diavencimento']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['diavencimento']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['diavencimento']['symbol_dec'] = '';
      $this->field_config['diavencimento']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['diavencimento']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- diasvalidade
      $this->field_config['diasvalidade']               = array();
      $this->field_config['diasvalidade']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['diasvalidade']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['diasvalidade']['symbol_dec'] = '';
      $this->field_config['diasvalidade']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['diasvalidade']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idcontrato
      $this->field_config['idcontrato']               = array();
      $this->field_config['idcontrato']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcontrato']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcontrato']['symbol_dec'] = '';
      $this->field_config['idcontrato']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcontrato']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- qtdparcelas
      $this->field_config['qtdparcelas']               = array();
      $this->field_config['qtdparcelas']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qtdparcelas']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qtdparcelas']['symbol_dec'] = '';
      $this->field_config['qtdparcelas']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qtdparcelas']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- valordescontounico
      $this->field_config['valordescontounico']               = array();
      $this->field_config['valordescontounico']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valordescontounico']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valordescontounico']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valordescontounico']['symbol_mon'] = '';
      $this->field_config['valordescontounico']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valordescontounico']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valordescontomensal
      $this->field_config['valordescontomensal']               = array();
      $this->field_config['valordescontomensal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valordescontomensal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valordescontomensal']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valordescontomensal']['symbol_mon'] = '';
      $this->field_config['valordescontomensal']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valordescontomensal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorpropostaunica
      $this->field_config['valorpropostaunica']               = array();
      $this->field_config['valorpropostaunica']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorpropostaunica']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorpropostaunica']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorpropostaunica']['symbol_mon'] = '';
      $this->field_config['valorpropostaunica']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorpropostaunica']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorpropostamensal
      $this->field_config['valorpropostamensal']               = array();
      $this->field_config['valorpropostamensal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorpropostamensal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorpropostamensal']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorpropostamensal']['symbol_mon'] = '';
      $this->field_config['valorpropostamensal']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorpropostamensal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- datafechamento
      $this->field_config['datafechamento']                 = array();
      $this->field_config['datafechamento']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datafechamento']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datafechamento']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datafechamento']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'datafechamento');
      //-- idtenacidade
      $this->field_config['idtenacidade']               = array();
      $this->field_config['idtenacidade']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idtenacidade']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idtenacidade']['symbol_dec'] = '';
      $this->field_config['idtenacidade']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idtenacidade']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idusuarioauditoria
      $this->field_config['idusuarioauditoria']               = array();
      $this->field_config['idusuarioauditoria']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idusuarioauditoria']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idusuarioauditoria']['symbol_dec'] = '';
      $this->field_config['idusuarioauditoria']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idusuarioauditoria']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- datainicioimplantacao
      $this->field_config['datainicioimplantacao']                 = array();
      $this->field_config['datainicioimplantacao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['datainicioimplantacao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datainicioimplantacao']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'datainicioimplantacao');
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
          $this->valorpropostaunica = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostaunica'];
      if ('' !== $this->valorpropostaunica || (!empty($format_fields) && isset($format_fields['valorpropostaunica'])))
      {
          nmgp_Form_Num_Val($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_dec'], "2", "S", $this->field_config['valorpropostaunica']['format_neg'], "", "", "-", $this->field_config['valorpropostaunica']['symbol_fmt']) ; 
      }
          $this->valorpropostamensal = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostamensal'];
      if ('' !== $this->valorpropostamensal || (!empty($format_fields) && isset($format_fields['valorpropostamensal'])))
      {
          nmgp_Form_Num_Val($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_dec'], "2", "S", $this->field_config['valorpropostamensal']['format_neg'], "", "", "-", $this->field_config['valorpropostamensal']['symbol_fmt']) ; 
      }
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->idcliente = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idcliente'];
      if ('' !== $this->idcliente || (!empty($format_fields) && isset($format_fields['idcliente'])))
      {
          nmgp_Form_Num_Val($this->idcliente, $this->field_config['idcliente']['symbol_grp'], $this->field_config['idcliente']['symbol_dec'], "0", "S", $this->field_config['idcliente']['format_neg'], "", "", "-", $this->field_config['idcliente']['symbol_fmt']) ; 
      }
          $this->valorpropostaunica = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostaunica'];
      if ('' !== $this->valorpropostaunica || (!empty($format_fields) && isset($format_fields['valorpropostaunica'])))
      {
          nmgp_Form_Num_Val($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_dec'], "2", "S", $this->field_config['valorpropostaunica']['format_neg'], "", "", "-", $this->field_config['valorpropostaunica']['symbol_fmt']) ; 
      }
          $this->valorpropostamensal = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostamensal'];
      if ('' !== $this->valorpropostamensal || (!empty($format_fields) && isset($format_fields['valorpropostamensal'])))
      {
          nmgp_Form_Num_Val($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_dec'], "2", "S", $this->field_config['valorpropostamensal']['format_neg'], "", "", "-", $this->field_config['valorpropostamensal']['symbol_fmt']) ; 
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
          if ('validate_idempresa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idempresa');
          }
          if ('validate_idcliente' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcliente');
          }
          if ('validate_idtipocontrato' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipocontrato');
          }
          if ('validate_idproposta' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idproposta');
          }
          if ('validate_solicitante' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'solicitante');
          }
          if ('validate_datainclusao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datainclusao');
          }
          if ('validate_idusuarioinclusao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idusuarioinclusao');
          }
          if ('validate_situacaoproposta' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'situacaoproposta');
          }
          if ('validate_prazoentrega' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'prazoentrega');
          }
          if ('validate_formapagamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'formapagamento');
          }
          if ('validate_diavencimento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'diavencimento');
          }
          if ('validate_diasvalidade' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'diasvalidade');
          }
          if ('validate_idindicereajuste' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idindicereajuste');
          }
          if ('validate_idcontrato' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcontrato');
          }
          if ('validate_qtdparcelas' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qtdparcelas');
          }
          if ('validate_valordescontounico' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valordescontounico');
          }
          if ('validate_motivodescontounico' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'motivodescontounico');
          }
          if ('validate_valordescontomensal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valordescontomensal');
          }
          if ('validate_motivodescontomensal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'motivodescontomensal');
          }
          if ('validate_valorpropostaunica' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorpropostaunica');
          }
          if ('validate_valorpropostamensal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorpropostamensal');
          }
          if ('validate_datafechamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datafechamento');
          }
          if ('validate_idusuariofechamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idusuariofechamento');
          }
          if ('validate_motivofechamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'motivofechamento');
          }
          if ('validate_observacoes' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'observacoes');
          }
          if ('validate_produtos' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'produtos');
          }
          if ('validate_andamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'andamento');
          }
          if ('validate_nomereferencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomereferencia');
          }
          if ('validate_nomearquivo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomearquivo');
          }
          Proposta_Frm_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_diavencimento_onchange' == $this->NM_ajax_opcao)
          {
              $this->DiaVencimento_onChange();
          }
          if ('event_qtdparcelas_onchange' == $this->NM_ajax_opcao)
          {
              $this->QtdParcelas_onChange();
          }
          if ('event_situacaoproposta_onchange' == $this->NM_ajax_opcao)
          {
              $this->SituacaoProposta_onChange();
          }
          if ('event_valordescontomensal_onblur' == $this->NM_ajax_opcao)
          {
              $this->ValorDescontoMensal_onBlur();
          }
          if ('event_valordescontounico_onblur' == $this->NM_ajax_opcao)
          {
              $this->ValorDescontoUnico_onBlur();
          }
          Proposta_Frm_pack_ajax_response();
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
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcliente");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdCliente, Descricao FROM clienteempresa_view WHERE (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND #upperI#Descricao#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idcliente)), 1, -1) . "%' ORDER BY Descricao";
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
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente'][] = $rs->fields[0];
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
          Proposta_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['datainclusao']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->datainclusao = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['datainclusao'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['idusuarioinclusao']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idusuarioinclusao = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['idusuarioinclusao'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['datafechamento']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->datafechamento = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['datafechamento'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['idusuariofechamento']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idusuariofechamento = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['idusuariofechamento'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['formapagamento']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->formapagamento = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['formapagamento'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['situacaoproposta']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->situacaoproposta = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['situacaoproposta'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['motivofechamento']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->motivofechamento = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['motivofechamento'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['idcliente']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->idcliente = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['idcliente'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['valorpropostaunica']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->valorpropostaunica = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['valorpropostaunica'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['valorpropostamensal']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->valorpropostamensal = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select']['valorpropostamensal'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              Proposta_Frm_pack_ajax_response();
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
          $_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  Proposta_Frm_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_redir_atualiz'] == "ok")
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
          Proposta_Frm_pack_ajax_response();
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
          Proposta_Frm_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "Proposta_Frm.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Proposta") ?></TITLE>
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
<form name="Fdown" method="get" action="Proposta_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Proposta_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="Proposta_Frm.php" target="_self" style="display: none"> 
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
   function sc_btn_Reabrir() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'] : "";
     }
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
include_once("Proposta_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idproposta) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta']))
          {
              $varloc_btn_php['idproposta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta'];
          }
      }
      $nm_f_saida = "Proposta_Frm.php";
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
          nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
          nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento']['time_sep']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button Reabrir ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
  $check_sql = "SELECT Nome"
   . " FROM usuario"
   . " WHERE IdUsuario = '" . $this->sc_temp_varIdUsuario . "'";
 
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
    $Nome = $this->rs[0][0];
}
else {
	$Nome = 'Usuário não cadastrado';
}

$Historico = 'Reaberto em ' . date('d/m/Y H:i') . ' por ' . $Nome;

$SQL = 'update proposta set Historico = concat_ws(CHAR(10), "' . $Historico . '", Historico),  SituacaoProposta = "P" where IdProposta = ' . $this->idproposta ;

     $nm_select = $SQL; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                Proposta_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button Reabrir ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idempresa" value="<?php echo $this->form_encode_input($this->idempresa) ?>"/>
      <input type=hidden name="idcliente" value="<?php echo $this->form_encode_input($this->idcliente) ?>"/>
      <input type=hidden name="idtipocontrato" value="<?php echo $this->form_encode_input($this->idtipocontrato) ?>"/>
      <input type=hidden name="idproposta" value="<?php echo $this->form_encode_input($this->idproposta) ?>"/>
      <input type=hidden name="solicitante" value="<?php echo $this->form_encode_input($this->solicitante) ?>"/>
      <input type=hidden name="datainclusao" value="<?php echo $this->form_encode_input($this->datainclusao) ?>"/>
      <input type=hidden name="idusuarioinclusao" value="<?php echo $this->form_encode_input($this->idusuarioinclusao) ?>"/>
      <input type=hidden name="situacaoproposta" value="<?php echo $this->form_encode_input($this->situacaoproposta) ?>"/>
      <input type=hidden name="prazoentrega" value="<?php echo $this->form_encode_input($this->prazoentrega) ?>"/>
      <input type=hidden name="formapagamento" value="<?php echo $this->form_encode_input($this->formapagamento) ?>"/>
      <input type=hidden name="diavencimento" value="<?php echo $this->form_encode_input($this->diavencimento) ?>"/>
      <input type=hidden name="diasvalidade" value="<?php echo $this->form_encode_input($this->diasvalidade) ?>"/>
      <input type=hidden name="idindicereajuste" value="<?php echo $this->form_encode_input($this->idindicereajuste) ?>"/>
      <input type=hidden name="idcontrato" value="<?php echo $this->form_encode_input($this->idcontrato) ?>"/>
      <input type=hidden name="qtdparcelas" value="<?php echo $this->form_encode_input($this->qtdparcelas) ?>"/>
      <input type=hidden name="valordescontounico" value="<?php echo $this->form_encode_input($this->valordescontounico) ?>"/>
      <input type=hidden name="motivodescontounico" value="<?php echo $this->form_encode_input($this->motivodescontounico) ?>"/>
      <input type=hidden name="valordescontomensal" value="<?php echo $this->form_encode_input($this->valordescontomensal) ?>"/>
      <input type=hidden name="motivodescontomensal" value="<?php echo $this->form_encode_input($this->motivodescontomensal) ?>"/>
      <input type=hidden name="valorpropostaunica" value="<?php echo $this->form_encode_input($this->valorpropostaunica) ?>"/>
      <input type=hidden name="valorpropostamensal" value="<?php echo $this->form_encode_input($this->valorpropostamensal) ?>"/>
      <input type=hidden name="datafechamento" value="<?php echo $this->form_encode_input($this->datafechamento) ?>"/>
      <input type=hidden name="idusuariofechamento" value="<?php echo $this->form_encode_input($this->idusuariofechamento) ?>"/>
      <input type=hidden name="motivofechamento" value="<?php echo $this->form_encode_input($this->motivofechamento) ?>"/>
      <input type=hidden name="observacoes" value="<?php echo $this->form_encode_input($this->observacoes) ?>"/>
      <input type=hidden name="produtos" value="<?php echo $this->form_encode_input($this->produtos) ?>"/>
      <input type=hidden name="andamento" value="<?php echo $this->form_encode_input($this->andamento) ?>"/>
      <input type=hidden name="nomereferencia" value="<?php echo $this->form_encode_input($this->nomereferencia) ?>"/>
      <input type=hidden name="nomearquivo" value="<?php echo $this->form_encode_input($this->nomearquivo) ?>"/>
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
   function sc_btn_Voltar() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'] : "";
     }
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
include_once("Proposta_Frm_sajax_js.php");
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
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "Proposta_Frm.php";
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
          nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
          nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento']['time_sep']) ; 
      $this->nm_converte_datas();
      
/*----- Scriptcase Locale: Button Voltar ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
   if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('Proposta_Lst') . "/Proposta_Lst.php", $this->nm_location, "","_self", '', 440, 630);
 };
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button Voltar ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idproposta" value="<?php echo $this->form_encode_input($this->idproposta) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
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
   function sc_btn_Auditoria() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'] : "";
     }
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
include_once("Proposta_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idproposta) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta']))
          {
              $varloc_btn_php['idproposta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta'];
          }
      }
      $nm_f_saida = "Proposta_Frm.php";
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
          nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
          nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento']['time_sep']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button Auditoria ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  $posicao = strpos($this->Ini->nm_cod_apl, '_');
$nomeTabela =  strtolower(substr($this->Ini->nm_cod_apl, 0, $posicao));	
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('AuditoriaRegistro_Lst') . "/AuditoriaRegistro_Lst.php", $this->nm_location, "varIdTenacidade?#?" . NM_encode_input($this->sc_temp_varIdTenacidade) . "?@?" . "varNomeTabelaAuditoria?#?" . NM_encode_input($nomeTabela) . "?@?" . "varValorIdChavePrimariaAuditoria?#?" . NM_encode_input($this->idproposta ) . "?@?","_self", '', 440, 630);
 };
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button Auditoria ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idproposta" value="<?php echo $this->form_encode_input($this->idproposta) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
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
   function sc_btn_sc_btn_0() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'] : "";
     }
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
include_once("Proposta_Frm_sajax_js.php");
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
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "Proposta_Frm.php";
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
          nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
          nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento']['time_sep']) ; 
      $this->nm_converte_datas();
      
/*----- Scriptcase Locale: Button sc_btn_0 ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  $check_sql = "SELECT IdAplicacao FROM aplicacao WHERE Nome = '" . $this->Ini->nm_cod_apl . "'";

 
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
    $idAplicacao = $this->rs[0][0];
}
else {
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Aplicação não cadastrada. Por favor, informe ao Administrador do sistema.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Aplicação não cadastrada. Por favor, informe ao Administrador do sistema.";
 }
;
}

 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('GrupoUsuarioAplicacao_Gde') . "/GrupoUsuarioAplicacao_Gde.php", $this->nm_location, "varIdGrupoUsuario?#?" . NM_encode_input("") . "?@?" . "varIdAplicacao?#?" . NM_encode_input($idAplicacao) . "?@?","_self", '', 440, 630);
 };
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button sc_btn_0 ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idproposta" value="<?php echo $this->form_encode_input($this->idproposta) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
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
   function sc_btn_sc_btn_1() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'] : "";
     }
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
include_once("Proposta_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idproposta) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta']))
          {
              $varloc_btn_php['idproposta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta'];
          }
          if (!isset($this->idtipocontrato) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idtipocontrato']))
          {
              $varloc_btn_php['idtipocontrato'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idtipocontrato'];
          }
      }
      $nm_f_saida = "Proposta_Frm.php";
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
          nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
          nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento']['time_sep']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button sc_btn_1 ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
   if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('RelatorioPropostaNovo_Blk') . "/RelatorioPropostaNovo_Blk.php", $this->nm_location, "IdProposta?#?" . NM_encode_input($this->idproposta ) . "?@?" . "idTipoContrato?#?" . NM_encode_input($this->idtipocontrato ) . "?@?","_self", '', 440, 630);
 };
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button sc_btn_1 ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idproposta" value="<?php echo $this->form_encode_input($this->idproposta) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>" onclick="window.close()"/>
      </form>
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
   function sc_btn_Imprimir() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['nomereferencia'] : "";
     }
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
include_once("Proposta_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idproposta) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta']))
          {
              $varloc_btn_php['idproposta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idproposta'];
          }
          if (!isset($this->idtipocontrato) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idtipocontrato']))
          {
              $varloc_btn_php['idtipocontrato'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['idtipocontrato'];
          }
      }
      $nm_f_saida = "Proposta_Frm.php";
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
          nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
          nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento']['time_sep']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button Imprimir ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
   if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('RelatorioProposta_Blk') . "/RelatorioProposta_Blk.php", $this->nm_location, "IdProposta?#?" . NM_encode_input($this->idproposta ) . "?@?" . "idTipoContrato?#?" . NM_encode_input($this->idtipocontrato ) . "?@?","_self", '', 440, 630);
 };
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button Imprimir ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idproposta" value="<?php echo $this->form_encode_input($this->idproposta) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>" onclick="window.close()"/>
      </form>
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
           case 'idempresa':
               return "Empresa";
               break;
           case 'idcliente':
               return "Cliente (Nome Fantasia - CNPJ - Id.)";
               break;
           case 'idtipocontrato':
               return "Tipo do contrato";
               break;
           case 'idproposta':
               return "Id.";
               break;
           case 'solicitante':
               return "Solicitado por";
               break;
           case 'datainclusao':
               return "Incluído em";
               break;
           case 'idusuarioinclusao':
               return "Incluído por";
               break;
           case 'situacaoproposta':
               return "Situação";
               break;
           case 'prazoentrega':
               return "Prazo de Entrega";
               break;
           case 'formapagamento':
               return "Forma de Pagamento";
               break;
           case 'diavencimento':
               return "Vencimento dia";
               break;
           case 'diasvalidade':
               return "Validade (dias)";
               break;
           case 'idindicereajuste':
               return "Índice de Reajuste";
               break;
           case 'idcontrato':
               return "Id Contrato";
               break;
           case 'qtdparcelas':
               return "Qtd Parcelas";
               break;
           case 'valordescontounico':
               return "Valor Desconto Unico";
               break;
           case 'motivodescontounico':
               return "Motivo Desconto Unico";
               break;
           case 'valordescontomensal':
               return "Valor Desconto Mensal";
               break;
           case 'motivodescontomensal':
               return "Motivo Desconto Mensal";
               break;
           case 'valorpropostaunica':
               return "Valor Cobrança Única";
               break;
           case 'valorpropostamensal':
               return "Valor cobrança mensal";
               break;
           case 'datafechamento':
               return "Aprovada em";
               break;
           case 'idusuariofechamento':
               return "Aprovada por";
               break;
           case 'motivofechamento':
               return "Motivo do fechamento";
               break;
           case 'observacoes':
               return "Observações";
               break;
           case 'produtos':
               return "";
               break;
           case 'andamento':
               return "";
               break;
           case 'nomereferencia':
               return "Nome Referencia";
               break;
           case 'nomearquivo':
               return "Nome Arquivo";
               break;
           case 'idtenacidade':
               return "Id Tenacidade";
               break;
           case 'idcolaboradorimplantacao':
               return "Técnico Implantação";
               break;
           case 'idusuarioauditoria':
               return "Id Usuario Auditoria";
               break;
           case 'datainicioimplantacao':
               return "Início Implantação";
               break;
           case 'historico':
               return "Texto";
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
     $this->sc_force_zero = array();

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_Proposta_Frm']) || !is_array($this->NM_ajax_info['errList']['geral_Proposta_Frm']))
              {
                  $this->NM_ajax_info['errList']['geral_Proposta_Frm'] = array();
              }
              $this->NM_ajax_info['errList']['geral_Proposta_Frm'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'idempresa' == $filtro)) || (is_array($filtro) && in_array('idempresa', $filtro)))
        $this->ValidateField_idempresa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcliente' == $filtro)) || (is_array($filtro) && in_array('idcliente', $filtro)))
        $this->ValidateField_idcliente($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipocontrato' == $filtro)) || (is_array($filtro) && in_array('idtipocontrato', $filtro)))
        $this->ValidateField_idtipocontrato($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idproposta' == $filtro)) || (is_array($filtro) && in_array('idproposta', $filtro)))
        $this->ValidateField_idproposta($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'solicitante' == $filtro)) || (is_array($filtro) && in_array('solicitante', $filtro)))
        $this->ValidateField_solicitante($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'datainclusao' == $filtro)) || (is_array($filtro) && in_array('datainclusao', $filtro)))
        $this->ValidateField_datainclusao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idusuarioinclusao' == $filtro)) || (is_array($filtro) && in_array('idusuarioinclusao', $filtro)))
        $this->ValidateField_idusuarioinclusao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'situacaoproposta' == $filtro)) || (is_array($filtro) && in_array('situacaoproposta', $filtro)))
        $this->ValidateField_situacaoproposta($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'prazoentrega' == $filtro)) || (is_array($filtro) && in_array('prazoentrega', $filtro)))
        $this->ValidateField_prazoentrega($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'formapagamento' == $filtro)) || (is_array($filtro) && in_array('formapagamento', $filtro)))
        $this->ValidateField_formapagamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'diavencimento' == $filtro)) || (is_array($filtro) && in_array('diavencimento', $filtro)))
        $this->ValidateField_diavencimento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'diasvalidade' == $filtro)) || (is_array($filtro) && in_array('diasvalidade', $filtro)))
        $this->ValidateField_diasvalidade($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idindicereajuste' == $filtro)) || (is_array($filtro) && in_array('idindicereajuste', $filtro)))
        $this->ValidateField_idindicereajuste($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcontrato' == $filtro)) || (is_array($filtro) && in_array('idcontrato', $filtro)))
        $this->ValidateField_idcontrato($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'qtdparcelas' == $filtro)) || (is_array($filtro) && in_array('qtdparcelas', $filtro)))
        $this->ValidateField_qtdparcelas($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valordescontounico' == $filtro)) || (is_array($filtro) && in_array('valordescontounico', $filtro)))
        $this->ValidateField_valordescontounico($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'motivodescontounico' == $filtro)) || (is_array($filtro) && in_array('motivodescontounico', $filtro)))
        $this->ValidateField_motivodescontounico($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valordescontomensal' == $filtro)) || (is_array($filtro) && in_array('valordescontomensal', $filtro)))
        $this->ValidateField_valordescontomensal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'motivodescontomensal' == $filtro)) || (is_array($filtro) && in_array('motivodescontomensal', $filtro)))
        $this->ValidateField_motivodescontomensal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorpropostaunica' == $filtro)) || (is_array($filtro) && in_array('valorpropostaunica', $filtro)))
        $this->ValidateField_valorpropostaunica($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorpropostamensal' == $filtro)) || (is_array($filtro) && in_array('valorpropostamensal', $filtro)))
        $this->ValidateField_valorpropostamensal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'datafechamento' == $filtro)) || (is_array($filtro) && in_array('datafechamento', $filtro)))
        $this->ValidateField_datafechamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idusuariofechamento' == $filtro)) || (is_array($filtro) && in_array('idusuariofechamento', $filtro)))
        $this->ValidateField_idusuariofechamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'motivofechamento' == $filtro)) || (is_array($filtro) && in_array('motivofechamento', $filtro)))
        $this->ValidateField_motivofechamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'observacoes' == $filtro)) || (is_array($filtro) && in_array('observacoes', $filtro)))
        $this->ValidateField_observacoes($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'produtos' == $filtro)) || (is_array($filtro) && in_array('produtos', $filtro)))
        $this->ValidateField_produtos($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'andamento' == $filtro)) || (is_array($filtro) && in_array('andamento', $filtro)))
        $this->ValidateField_andamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomereferencia' == $filtro)) || (is_array($filtro) && in_array('nomereferencia', $filtro)))
        $this->ValidateField_nomereferencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomearquivo' == $filtro)) || (is_array($filtro) && in_array('nomearquivo', $filtro)))
        $this->ValidateField_nomearquivo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---

      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      
/*----- Scriptcase Locale: Event onValidate ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varDescontoMaximoMes)) {$this->sc_temp_varDescontoMaximoMes = (isset($_SESSION['varDescontoMaximoMes'])) ? $_SESSION['varDescontoMaximoMes'] : "";}
if (!isset($this->sc_temp_varDescontoMaximoImp)) {$this->sc_temp_varDescontoMaximoImp = (isset($_SESSION['varDescontoMaximoImp'])) ? $_SESSION['varDescontoMaximoImp'] : "";}
  if ($this->valordescontounico  > $this->sc_temp_varDescontoMaximoImp) {
		
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Desconto único não autorizado.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Desconto único não autorizado.';
 }
;
	$this->sc_set_focus('ValorDescontoUnico');
	
} elseif ($this->valordescontomensal  > $this->sc_temp_varDescontoMaximoMes) {
	
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Desconto mensal não autorizado.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Desconto mensal não autorizado.';
 }
;
	$this->sc_set_focus('ValorDescontoMensal');
	
}

$sql = "SELECT IdPropostaItem FROM propostaitem WHERE IdTenacidade = '".$this->sc_temp_varIdTenacidade."' AND IdProposta = '".$this->idproposta ."'";
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->dataset = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset = false;
          $this->dataset_erro = $this->Db->ErrorMsg();
      } 


if ($this->situacaoproposta  == 'A') {
	
	if ($this->dataset->EOF) {

		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Erro: proposta sem produto/serviço associado.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Erro: proposta sem produto/serviço associado.';
 }
;

	}
}
if (isset($this->sc_temp_varDescontoMaximoImp)) { $_SESSION['varDescontoMaximoImp'] = $this->sc_temp_varDescontoMaximoImp;}
if (isset($this->sc_temp_varDescontoMaximoMes)) { $_SESSION['varDescontoMaximoMes'] = $this->sc_temp_varDescontoMaximoMes;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onValidate ------*/
 
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
              
/*----- Scriptcase Locale: Event onValidateSuccess ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varSituacaoPropostaAnt)) {$this->sc_temp_varSituacaoPropostaAnt = (isset($_SESSION['varSituacaoPropostaAnt'])) ? $_SESSION['varSituacaoPropostaAnt'] : "";}
  if (($this->situacaoproposta  == 'P') && ($this->sc_temp_varSituacaoPropostaAnt != $this->situacaoproposta )) {
	
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Proposta não pode voltar para a situação "Pendente".';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Proposta não pode voltar para a situação "Pendente".';
 }
;
	$this->sc_set_focus('SituacaoProposta');
	
} else if ($this->situacaoproposta  == 'R') {
	
	if ($this->motivofechamento  == '') {
		
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Motivo Fechamento: Dado obrigatório.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Motivo Fechamento: Dado obrigatório.';
 }
;
		$this->sc_set_focus('MotivoFechamento');
		
	}
	
} else if ($this->situacaoproposta  == 'C') {
	
	if ($this->motivofechamento  == '') {
		
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Motivo Cancelamento: Dado obrigatório.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Motivo Cancelamento: Dado obrigatório.';
 }
;
		$this->sc_set_focus('MotivoFechamento');
		
	}
}
if (isset($this->sc_temp_varSituacaoPropostaAnt)) { $_SESSION['varSituacaoPropostaAnt'] = $this->sc_temp_varSituacaoPropostaAnt;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onValidateSuccess ------*/
 
          }
      }
   }

    function ValidateField_idempresa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idempresa'])) {
       return;
   }
      if ($this->idempresa == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idempresa']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idempresa'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Empresa" ; 
          if (!isset($Campos_Erros['idempresa']))
          {
              $Campos_Erros['idempresa'] = array();
          }
          $Campos_Erros['idempresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idempresa']) || !is_array($this->NM_ajax_info['errList']['idempresa']))
          {
              $this->NM_ajax_info['errList']['idempresa'] = array();
          }
          $this->NM_ajax_info['errList']['idempresa'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idempresa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']) && !in_array($this->idempresa, $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']))
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

    function ValidateField_idcliente(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idcliente'])) {
          nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
          return;
      }
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->idcliente != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->idcliente) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cliente (Nome Fantasia - CNPJ - Id.): " . $this->Ini->Nm_lang['lang_errm_size']; 
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
              if ($teste_validade->Valor($this->idcliente, 20, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cliente (Nome Fantasia - CNPJ - Id.); " ; 
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
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idcliente']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idcliente'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Cliente (Nome Fantasia - CNPJ - Id.)" ; 
              if (!isset($Campos_Erros['idcliente']))
              {
                  $Campos_Erros['idcliente'] = array();
              }
              $Campos_Erros['idcliente'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['idcliente']) || !is_array($this->NM_ajax_info['errList']['idcliente']))
                  {
                      $this->NM_ajax_info['errList']['idcliente'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcliente'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
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

    function ValidateField_idtipocontrato(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipocontrato'])) {
       return;
   }
      if ($this->idtipocontrato == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idtipocontrato']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idtipocontrato'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Tipo do contrato" ; 
          if (!isset($Campos_Erros['idtipocontrato']))
          {
              $Campos_Erros['idtipocontrato'] = array();
          }
          $Campos_Erros['idtipocontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idtipocontrato']) || !is_array($this->NM_ajax_info['errList']['idtipocontrato']))
          {
              $this->NM_ajax_info['errList']['idtipocontrato'] = array();
          }
          $this->NM_ajax_info['errList']['idtipocontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idtipocontrato) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']) && !in_array($this->idtipocontrato, $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idtipocontrato']))
              {
                  $Campos_Erros['idtipocontrato'] = array();
              }
              $Campos_Erros['idtipocontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idtipocontrato']) || !is_array($this->NM_ajax_info['errList']['idtipocontrato']))
              {
                  $this->NM_ajax_info['errList']['idtipocontrato'] = array();
              }
              $this->NM_ajax_info['errList']['idtipocontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipocontrato';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipocontrato

    function ValidateField_idproposta(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idproposta'])) {
          nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
          return;
      }
      if ($this->idproposta === "" || is_null($this->idproposta))  
      { 
          $this->idproposta = 0;
      } 
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idproposta' == $this->NM_ajax_opcao)
      { 
          if ($this->idproposta != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->idproposta) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idproposta']))
                  {
                      $Campos_Erros['idproposta'] = array();
                  }
                  $Campos_Erros['idproposta'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idproposta']) || !is_array($this->NM_ajax_info['errList']['idproposta']))
                  {
                      $this->NM_ajax_info['errList']['idproposta'] = array();
                  }
                  $this->NM_ajax_info['errList']['idproposta'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idproposta, 20, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.; " ; 
                  if (!isset($Campos_Erros['idproposta']))
                  {
                      $Campos_Erros['idproposta'] = array();
                  }
                  $Campos_Erros['idproposta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idproposta']) || !is_array($this->NM_ajax_info['errList']['idproposta']))
                  {
                      $this->NM_ajax_info['errList']['idproposta'] = array();
                  }
                  $this->NM_ajax_info['errList']['idproposta'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idproposta';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idproposta

    function ValidateField_solicitante(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['solicitante'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['solicitante']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['solicitante'] == "on")) 
      { 
          if ($this->solicitante == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Solicitado por" ; 
              if (!isset($Campos_Erros['solicitante']))
              {
                  $Campos_Erros['solicitante'] = array();
              }
              $Campos_Erros['solicitante'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['solicitante']) || !is_array($this->NM_ajax_info['errList']['solicitante']))
                  {
                      $this->NM_ajax_info['errList']['solicitante'] = array();
                  }
                  $this->NM_ajax_info['errList']['solicitante'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->solicitante) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Solicitado por " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['solicitante']))
              {
                  $Campos_Erros['solicitante'] = array();
              }
              $Campos_Erros['solicitante'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['solicitante']) || !is_array($this->NM_ajax_info['errList']['solicitante']))
              {
                  $this->NM_ajax_info['errList']['solicitante'] = array();
              }
              $this->NM_ajax_info['errList']['solicitante'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'solicitante';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_solicitante

    function ValidateField_datainclusao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datainclusao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datainclusao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datainclusao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datainclusao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datainclusao']['date_sep']) ; 
          $Format_Hora = $this->field_config['datainclusao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datainclusao_hora']['time_sep']) ; 
          if (trim($this->datainclusao) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->datainclusao, $Format_Data, $this->datainclusao_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->datainclusao_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->datainclusao, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->datainclusao, $Format_Data, $this->datainclusao_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->datainclusao_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->datainclusao, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Incluído em; " ; 
                  if (!isset($Campos_Erros['datainclusao']))
                  {
                      $Campos_Erros['datainclusao'] = array();
                  }
                  $Campos_Erros['datainclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datainclusao']) || !is_array($this->NM_ajax_info['errList']['datainclusao']))
                  {
                      $this->NM_ajax_info['errList']['datainclusao'] = array();
                  }
                  $this->NM_ajax_info['errList']['datainclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datainclusao']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datainclusao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datainclusao_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['datainclusao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datainclusao_hora']['time_sep']) ; 
          if (trim($this->datainclusao_hora) != "")  
          { 
              if ($teste_validade->Hora($this->datainclusao_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Incluído em; " ; 
                  if (!isset($Campos_Erros['datainclusao_hora']))
                  {
                      $Campos_Erros['datainclusao_hora'] = array();
                  }
                  $Campos_Erros['datainclusao_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datainclusao']) || !is_array($this->NM_ajax_info['errList']['datainclusao']))
                  {
                      $this->NM_ajax_info['errList']['datainclusao'] = array();
                  }
                  $this->NM_ajax_info['errList']['datainclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
      if (isset($Campos_Erros['datainclusao']) && isset($Campos_Erros['datainclusao_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['datainclusao'], $Campos_Erros['datainclusao_hora']);
          if (empty($Campos_Erros['datainclusao_hora']))
          {
              unset($Campos_Erros['datainclusao_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['datainclusao']))
          {
              $this->NM_ajax_info['errList']['datainclusao'] = array_unique($this->NM_ajax_info['errList']['datainclusao']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datainclusao_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datainclusao_hora

    function ValidateField_idusuarioinclusao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idusuarioinclusao'])) {
       return;
   }
               if (!empty($this->idusuarioinclusao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']) && !in_array($this->idusuarioinclusao, $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idusuarioinclusao']))
                   {
                       $Campos_Erros['idusuarioinclusao'] = array();
                   }
                   $Campos_Erros['idusuarioinclusao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idusuarioinclusao']) || !is_array($this->NM_ajax_info['errList']['idusuarioinclusao']))
                   {
                       $this->NM_ajax_info['errList']['idusuarioinclusao'] = array();
                   }
                   $this->NM_ajax_info['errList']['idusuarioinclusao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idusuarioinclusao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idusuarioinclusao

    function ValidateField_situacaoproposta(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['situacaoproposta'])) {
       return;
   }
      if ($this->situacaoproposta == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'situacaoproposta';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_situacaoproposta

    function ValidateField_prazoentrega(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['prazoentrega'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['prazoentrega']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['prazoentrega'] == "on")) 
      { 
          if ($this->prazoentrega == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Prazo de Entrega" ; 
              if (!isset($Campos_Erros['prazoentrega']))
              {
                  $Campos_Erros['prazoentrega'] = array();
              }
              $Campos_Erros['prazoentrega'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['prazoentrega']) || !is_array($this->NM_ajax_info['errList']['prazoentrega']))
                  {
                      $this->NM_ajax_info['errList']['prazoentrega'] = array();
                  }
                  $this->NM_ajax_info['errList']['prazoentrega'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->prazoentrega) > 600) 
          { 
              $hasError = true;
              $Campos_Crit .= "Prazo de Entrega " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 600 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['prazoentrega']))
              {
                  $Campos_Erros['prazoentrega'] = array();
              }
              $Campos_Erros['prazoentrega'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 600 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['prazoentrega']) || !is_array($this->NM_ajax_info['errList']['prazoentrega']))
              {
                  $this->NM_ajax_info['errList']['prazoentrega'] = array();
              }
              $this->NM_ajax_info['errList']['prazoentrega'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 600 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'prazoentrega';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_prazoentrega

    function ValidateField_formapagamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['formapagamento'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->formapagamento) > 600) 
          { 
              $hasError = true;
              $Campos_Crit .= "Forma de Pagamento " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 600 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['formapagamento']))
              {
                  $Campos_Erros['formapagamento'] = array();
              }
              $Campos_Erros['formapagamento'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 600 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['formapagamento']) || !is_array($this->NM_ajax_info['errList']['formapagamento']))
              {
                  $this->NM_ajax_info['errList']['formapagamento'] = array();
              }
              $this->NM_ajax_info['errList']['formapagamento'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 600 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'formapagamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_formapagamento

    function ValidateField_diavencimento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['diavencimento'])) {
          nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
          return;
      }
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->diavencimento != '')  
          { 
              $iTestSize = 6;
              if (strlen($this->diavencimento) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vencimento dia: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['diavencimento']))
                  {
                      $Campos_Erros['diavencimento'] = array();
                  }
                  $Campos_Erros['diavencimento'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['diavencimento']) || !is_array($this->NM_ajax_info['errList']['diavencimento']))
                  {
                      $this->NM_ajax_info['errList']['diavencimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['diavencimento'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->diavencimento, 6, 0, 1, 28, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Vencimento dia; " ; 
                  if (!isset($Campos_Erros['diavencimento']))
                  {
                      $Campos_Erros['diavencimento'] = array();
                  }
                  $Campos_Erros['diavencimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['diavencimento']) || !is_array($this->NM_ajax_info['errList']['diavencimento']))
                  {
                      $this->NM_ajax_info['errList']['diavencimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['diavencimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['diavencimento']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['diavencimento'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Vencimento dia" ; 
              if (!isset($Campos_Erros['diavencimento']))
              {
                  $Campos_Erros['diavencimento'] = array();
              }
              $Campos_Erros['diavencimento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['diavencimento']) || !is_array($this->NM_ajax_info['errList']['diavencimento']))
                  {
                      $this->NM_ajax_info['errList']['diavencimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['diavencimento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'diavencimento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_diavencimento

    function ValidateField_diasvalidade(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['diasvalidade'])) {
          nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
          return;
      }
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->diasvalidade != '')  
          { 
              $iTestSize = 6;
              if (strlen($this->diasvalidade) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Validade (dias): " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['diasvalidade']))
                  {
                      $Campos_Erros['diasvalidade'] = array();
                  }
                  $Campos_Erros['diasvalidade'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['diasvalidade']) || !is_array($this->NM_ajax_info['errList']['diasvalidade']))
                  {
                      $this->NM_ajax_info['errList']['diasvalidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['diasvalidade'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->diasvalidade, 6, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Validade (dias); " ; 
                  if (!isset($Campos_Erros['diasvalidade']))
                  {
                      $Campos_Erros['diasvalidade'] = array();
                  }
                  $Campos_Erros['diasvalidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['diasvalidade']) || !is_array($this->NM_ajax_info['errList']['diasvalidade']))
                  {
                      $this->NM_ajax_info['errList']['diasvalidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['diasvalidade'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['diasvalidade']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['diasvalidade'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Validade (dias)" ; 
              if (!isset($Campos_Erros['diasvalidade']))
              {
                  $Campos_Erros['diasvalidade'] = array();
              }
              $Campos_Erros['diasvalidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['diasvalidade']) || !is_array($this->NM_ajax_info['errList']['diasvalidade']))
                  {
                      $this->NM_ajax_info['errList']['diasvalidade'] = array();
                  }
                  $this->NM_ajax_info['errList']['diasvalidade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'diasvalidade';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_diasvalidade

    function ValidateField_idindicereajuste(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idindicereajuste'])) {
       return;
   }
      if ($this->idindicereajuste == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idindicereajuste']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['idindicereajuste'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Índice de Reajuste" ; 
          if (!isset($Campos_Erros['idindicereajuste']))
          {
              $Campos_Erros['idindicereajuste'] = array();
          }
          $Campos_Erros['idindicereajuste'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idindicereajuste']) || !is_array($this->NM_ajax_info['errList']['idindicereajuste']))
          {
              $this->NM_ajax_info['errList']['idindicereajuste'] = array();
          }
          $this->NM_ajax_info['errList']['idindicereajuste'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idindicereajuste) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']) && !in_array($this->idindicereajuste, $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idindicereajuste']))
              {
                  $Campos_Erros['idindicereajuste'] = array();
              }
              $Campos_Erros['idindicereajuste'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idindicereajuste']) || !is_array($this->NM_ajax_info['errList']['idindicereajuste']))
              {
                  $this->NM_ajax_info['errList']['idindicereajuste'] = array();
              }
              $this->NM_ajax_info['errList']['idindicereajuste'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idindicereajuste';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idindicereajuste

    function ValidateField_idcontrato(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idcontrato'])) {
          nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
          return;
      }
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->idcontrato != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idcontrato) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Contrato: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idcontrato']))
                  {
                      $Campos_Erros['idcontrato'] = array();
                  }
                  $Campos_Erros['idcontrato'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idcontrato']) || !is_array($this->NM_ajax_info['errList']['idcontrato']))
                  {
                      $this->NM_ajax_info['errList']['idcontrato'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcontrato'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idcontrato, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Contrato; " ; 
                  if (!isset($Campos_Erros['idcontrato']))
                  {
                      $Campos_Erros['idcontrato'] = array();
                  }
                  $Campos_Erros['idcontrato'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idcontrato']) || !is_array($this->NM_ajax_info['errList']['idcontrato']))
                  {
                      $this->NM_ajax_info['errList']['idcontrato'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcontrato'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcontrato';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcontrato

    function ValidateField_qtdparcelas(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qtdparcelas'])) {
          nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
          return;
      }
      if ($this->qtdparcelas === "" || is_null($this->qtdparcelas))  
      { 
          $this->qtdparcelas = 0;
          $this->sc_force_zero[] = 'qtdparcelas';
      } 
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
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

    function ValidateField_valordescontounico(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valordescontounico'])) {
          if (!empty($this->field_config['valordescontounico']['symbol_dec'])) {
              $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
              nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valordescontounico === "" || is_null($this->valordescontounico))  
      { 
          $this->valordescontounico = 0;
          $this->sc_force_zero[] = 'valordescontounico';
      } 
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']); 
          nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']) ; 
          if ('.' == substr($this->valordescontounico, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valordescontounico, 1)))
              {
                  $this->valordescontounico = '';
              }
              else
              {
                  $this->valordescontounico = '0' . $this->valordescontounico;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valordescontounico != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valordescontounico) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Desconto Unico: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valordescontounico']))
                  {
                      $Campos_Erros['valordescontounico'] = array();
                  }
                  $Campos_Erros['valordescontounico'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valordescontounico']) || !is_array($this->NM_ajax_info['errList']['valordescontounico']))
                  {
                      $this->NM_ajax_info['errList']['valordescontounico'] = array();
                  }
                  $this->NM_ajax_info['errList']['valordescontounico'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valordescontounico, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Desconto Unico; " ; 
                  if (!isset($Campos_Erros['valordescontounico']))
                  {
                      $Campos_Erros['valordescontounico'] = array();
                  }
                  $Campos_Erros['valordescontounico'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valordescontounico']) || !is_array($this->NM_ajax_info['errList']['valordescontounico']))
                  {
                      $this->NM_ajax_info['errList']['valordescontounico'] = array();
                  }
                  $this->NM_ajax_info['errList']['valordescontounico'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valordescontounico';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valordescontounico

    function ValidateField_motivodescontounico(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['motivodescontounico'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->motivodescontounico) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Motivo Desconto Unico " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['motivodescontounico']))
              {
                  $Campos_Erros['motivodescontounico'] = array();
              }
              $Campos_Erros['motivodescontounico'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['motivodescontounico']) || !is_array($this->NM_ajax_info['errList']['motivodescontounico']))
              {
                  $this->NM_ajax_info['errList']['motivodescontounico'] = array();
              }
              $this->NM_ajax_info['errList']['motivodescontounico'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'motivodescontounico';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_motivodescontounico

    function ValidateField_valordescontomensal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valordescontomensal'])) {
          if (!empty($this->field_config['valordescontomensal']['symbol_dec'])) {
              $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
              nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valordescontomensal === "" || is_null($this->valordescontomensal))  
      { 
          $this->valordescontomensal = 0;
          $this->sc_force_zero[] = 'valordescontomensal';
      } 
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']); 
          nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']) ; 
          if ('.' == substr($this->valordescontomensal, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valordescontomensal, 1)))
              {
                  $this->valordescontomensal = '';
              }
              else
              {
                  $this->valordescontomensal = '0' . $this->valordescontomensal;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valordescontomensal != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->valordescontomensal) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Desconto Mensal: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valordescontomensal']))
                  {
                      $Campos_Erros['valordescontomensal'] = array();
                  }
                  $Campos_Erros['valordescontomensal'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valordescontomensal']) || !is_array($this->NM_ajax_info['errList']['valordescontomensal']))
                  {
                      $this->NM_ajax_info['errList']['valordescontomensal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valordescontomensal'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valordescontomensal, 8, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Desconto Mensal; " ; 
                  if (!isset($Campos_Erros['valordescontomensal']))
                  {
                      $Campos_Erros['valordescontomensal'] = array();
                  }
                  $Campos_Erros['valordescontomensal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valordescontomensal']) || !is_array($this->NM_ajax_info['errList']['valordescontomensal']))
                  {
                      $this->NM_ajax_info['errList']['valordescontomensal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valordescontomensal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valordescontomensal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valordescontomensal

    function ValidateField_motivodescontomensal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['motivodescontomensal'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->motivodescontomensal) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Motivo Desconto Mensal " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['motivodescontomensal']))
              {
                  $Campos_Erros['motivodescontomensal'] = array();
              }
              $Campos_Erros['motivodescontomensal'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['motivodescontomensal']) || !is_array($this->NM_ajax_info['errList']['motivodescontomensal']))
              {
                  $this->NM_ajax_info['errList']['motivodescontomensal'] = array();
              }
              $this->NM_ajax_info['errList']['motivodescontomensal'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'motivodescontomensal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_motivodescontomensal

    function ValidateField_valorpropostaunica(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorpropostaunica'])) {
          if (!empty($this->field_config['valorpropostaunica']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
              nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valorpropostaunica === "" || is_null($this->valorpropostaunica))  
      { 
          $this->valorpropostaunica = 0;
          $this->sc_force_zero[] = 'valorpropostaunica';
      } 
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']) ; 
          if ('.' == substr($this->valorpropostaunica, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorpropostaunica, 1)))
              {
                  $this->valorpropostaunica = '';
              }
              else
              {
                  $this->valorpropostaunica = '0' . $this->valorpropostaunica;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valorpropostaunica != '')  
          { 
              $iTestSize = 21;
              if ('-' == substr($this->valorpropostaunica, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valorpropostaunica, -1))
              {
                  $iTestSize++;
                  $this->valorpropostaunica = '-' . substr($this->valorpropostaunica, 0, -1);
              }
              if (strlen($this->valorpropostaunica) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Cobrança Única: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorpropostaunica']))
                  {
                      $Campos_Erros['valorpropostaunica'] = array();
                  }
                  $Campos_Erros['valorpropostaunica'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorpropostaunica']) || !is_array($this->NM_ajax_info['errList']['valorpropostaunica']))
                  {
                      $this->NM_ajax_info['errList']['valorpropostaunica'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpropostaunica'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorpropostaunica, 18, 2, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Cobrança Única; " ; 
                  if (!isset($Campos_Erros['valorpropostaunica']))
                  {
                      $Campos_Erros['valorpropostaunica'] = array();
                  }
                  $Campos_Erros['valorpropostaunica'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorpropostaunica']) || !is_array($this->NM_ajax_info['errList']['valorpropostaunica']))
                  {
                      $this->NM_ajax_info['errList']['valorpropostaunica'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpropostaunica'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorpropostaunica';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorpropostaunica

    function ValidateField_valorpropostamensal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorpropostamensal'])) {
          if (!empty($this->field_config['valorpropostamensal']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
              nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valorpropostamensal === "" || is_null($this->valorpropostamensal))  
      { 
          $this->valorpropostamensal = 0;
          $this->sc_force_zero[] = 'valorpropostamensal';
      } 
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']); 
          nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']) ; 
          if ('.' == substr($this->valorpropostamensal, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorpropostamensal, 1)))
              {
                  $this->valorpropostamensal = '';
              }
              else
              {
                  $this->valorpropostamensal = '0' . $this->valorpropostamensal;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valorpropostamensal != '')  
          { 
              $iTestSize = 21;
              if ('-' == substr($this->valorpropostamensal, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valorpropostamensal, -1))
              {
                  $iTestSize++;
                  $this->valorpropostamensal = '-' . substr($this->valorpropostamensal, 0, -1);
              }
              if (strlen($this->valorpropostamensal) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor cobrança mensal: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorpropostamensal']))
                  {
                      $Campos_Erros['valorpropostamensal'] = array();
                  }
                  $Campos_Erros['valorpropostamensal'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorpropostamensal']) || !is_array($this->NM_ajax_info['errList']['valorpropostamensal']))
                  {
                      $this->NM_ajax_info['errList']['valorpropostamensal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpropostamensal'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorpropostamensal, 18, 2, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor cobrança mensal; " ; 
                  if (!isset($Campos_Erros['valorpropostamensal']))
                  {
                      $Campos_Erros['valorpropostamensal'] = array();
                  }
                  $Campos_Erros['valorpropostamensal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorpropostamensal']) || !is_array($this->NM_ajax_info['errList']['valorpropostamensal']))
                  {
                      $this->NM_ajax_info['errList']['valorpropostamensal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorpropostamensal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorpropostamensal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorpropostamensal

    function ValidateField_datafechamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datafechamento'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datafechamento']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datafechamento']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datafechamento']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datafechamento']['date_sep']) ; 
          $Format_Hora = $this->field_config['datafechamento_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datafechamento_hora']['time_sep']) ; 
          if (trim($this->datafechamento) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->datafechamento, $Format_Data, $this->datafechamento_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->datafechamento_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->datafechamento, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->datafechamento, $Format_Data, $this->datafechamento_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->datafechamento_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->datafechamento, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Aprovada em; " ; 
                  if (!isset($Campos_Erros['datafechamento']))
                  {
                      $Campos_Erros['datafechamento'] = array();
                  }
                  $Campos_Erros['datafechamento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datafechamento']) || !is_array($this->NM_ajax_info['errList']['datafechamento']))
                  {
                      $this->NM_ajax_info['errList']['datafechamento'] = array();
                  }
                  $this->NM_ajax_info['errList']['datafechamento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datafechamento']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datafechamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datafechamento_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['datafechamento_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datafechamento_hora']['time_sep']) ; 
          if (trim($this->datafechamento_hora) != "")  
          { 
              if ($teste_validade->Hora($this->datafechamento_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Aprovada em; " ; 
                  if (!isset($Campos_Erros['datafechamento_hora']))
                  {
                      $Campos_Erros['datafechamento_hora'] = array();
                  }
                  $Campos_Erros['datafechamento_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datafechamento']) || !is_array($this->NM_ajax_info['errList']['datafechamento']))
                  {
                      $this->NM_ajax_info['errList']['datafechamento'] = array();
                  }
                  $this->NM_ajax_info['errList']['datafechamento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
      if (isset($Campos_Erros['datafechamento']) && isset($Campos_Erros['datafechamento_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['datafechamento'], $Campos_Erros['datafechamento_hora']);
          if (empty($Campos_Erros['datafechamento_hora']))
          {
              unset($Campos_Erros['datafechamento_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['datafechamento']))
          {
              $this->NM_ajax_info['errList']['datafechamento'] = array_unique($this->NM_ajax_info['errList']['datafechamento']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datafechamento_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datafechamento_hora

    function ValidateField_idusuariofechamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idusuariofechamento'])) {
       return;
   }
               if (!empty($this->idusuariofechamento) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']) && !in_array($this->idusuariofechamento, $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idusuariofechamento']))
                   {
                       $Campos_Erros['idusuariofechamento'] = array();
                   }
                   $Campos_Erros['idusuariofechamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idusuariofechamento']) || !is_array($this->NM_ajax_info['errList']['idusuariofechamento']))
                   {
                       $this->NM_ajax_info['errList']['idusuariofechamento'] = array();
                   }
                   $this->NM_ajax_info['errList']['idusuariofechamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idusuariofechamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idusuariofechamento

    function ValidateField_motivofechamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['motivofechamento'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->motivofechamento) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Motivo do fechamento " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['motivofechamento']))
              {
                  $Campos_Erros['motivofechamento'] = array();
              }
              $Campos_Erros['motivofechamento'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['motivofechamento']) || !is_array($this->NM_ajax_info['errList']['motivofechamento']))
              {
                  $this->NM_ajax_info['errList']['motivofechamento'] = array();
              }
              $this->NM_ajax_info['errList']['motivofechamento'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'motivofechamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_motivofechamento

    function ValidateField_observacoes(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['observacoes'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['observacoes']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['php_cmp_required']['observacoes'] == "on")) 
      { 
          if ($this->observacoes == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Observações" ; 
              if (!isset($Campos_Erros['observacoes']))
              {
                  $Campos_Erros['observacoes'] = array();
              }
              $Campos_Erros['observacoes'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['observacoes']) || !is_array($this->NM_ajax_info['errList']['observacoes']))
                  {
                      $this->NM_ajax_info['errList']['observacoes'] = array();
                  }
                  $this->NM_ajax_info['errList']['observacoes'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
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

    function ValidateField_produtos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['produtos'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->produtos) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'produtos';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_produtos

    function ValidateField_andamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['andamento'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->andamento) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'andamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_andamento

    function ValidateField_nomereferencia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomereferencia'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->nomereferencia;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'Proposta_Frm_doc_name.php';
            }
            $this->nomereferencia = sc_upload_unprotect_chars($this->nomereferencia, true);
            $this->nomereferencia_scfile_name = sc_upload_unprotect_chars($this->nomereferencia_scfile_name, true);
            if (strpos($this->nomereferencia, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Nome Referencia: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
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
            if ("" != $this->nomereferencia && "S" != $this->nomereferencia_limpa && !$teste_validade->ArqExtensao($this->nomereferencia, array()))
            {
                $hasError = true;
                $Campos_Crit .= "Nome Referencia: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
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

    function ValidateField_nomearquivo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomearquivo'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
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
//
//--------------------------------------------------------------------------------------
   function upload_img_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser;
     if (!empty($Campos_Crit) || !empty($Campos_Falta))
     {
          return;
     }
      if ($this->nmgp_opcao != "excluir") 
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
                      $arq_nomereferencia = fopen($dir_doc . trim($this->nomereferencia_scfile_name), "w") ; 
                      fwrite($arq_nomereferencia, $reg_nomereferencia) ;  
                      fclose($arq_nomereferencia) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Nome Referencia: " . $this->Ini->Nm_lang['lang_errm_nfdr']; 
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
                  $Campos_Crit .= "Nome Referencia " . $this->Ini->Nm_lang['lang_errm_upld']; 
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
    $this->nmgp_dados_form['idempresa'] = $this->idempresa;
    $this->nmgp_dados_form['idcliente'] = $this->idcliente;
    $this->nmgp_dados_form['idtipocontrato'] = $this->idtipocontrato;
    $this->nmgp_dados_form['idproposta'] = $this->idproposta;
    $this->nmgp_dados_form['solicitante'] = $this->solicitante;
    $this->nmgp_dados_form['datainclusao'] = (strlen(trim($this->datainclusao)) > 19) ? str_replace(".", ":", $this->datainclusao) : trim($this->datainclusao);
    $this->nmgp_dados_form['idusuarioinclusao'] = $this->idusuarioinclusao;
    $this->nmgp_dados_form['situacaoproposta'] = $this->situacaoproposta;
    $this->nmgp_dados_form['prazoentrega'] = $this->prazoentrega;
    $this->nmgp_dados_form['formapagamento'] = $this->formapagamento;
    $this->nmgp_dados_form['diavencimento'] = $this->diavencimento;
    $this->nmgp_dados_form['diasvalidade'] = $this->diasvalidade;
    $this->nmgp_dados_form['idindicereajuste'] = $this->idindicereajuste;
    $this->nmgp_dados_form['idcontrato'] = $this->idcontrato;
    $this->nmgp_dados_form['qtdparcelas'] = $this->qtdparcelas;
    $this->nmgp_dados_form['valordescontounico'] = $this->valordescontounico;
    $this->nmgp_dados_form['motivodescontounico'] = $this->motivodescontounico;
    $this->nmgp_dados_form['valordescontomensal'] = $this->valordescontomensal;
    $this->nmgp_dados_form['motivodescontomensal'] = $this->motivodescontomensal;
    $this->nmgp_dados_form['valorpropostaunica'] = $this->valorpropostaunica;
    $this->nmgp_dados_form['valorpropostamensal'] = $this->valorpropostamensal;
    $this->nmgp_dados_form['datafechamento'] = (strlen(trim($this->datafechamento)) > 19) ? str_replace(".", ":", $this->datafechamento) : trim($this->datafechamento);
    $this->nmgp_dados_form['idusuariofechamento'] = $this->idusuariofechamento;
    $this->nmgp_dados_form['motivofechamento'] = $this->motivofechamento;
    $this->nmgp_dados_form['observacoes'] = $this->observacoes;
    $this->nmgp_dados_form['produtos'] = $this->produtos;
    $this->nmgp_dados_form['andamento'] = $this->andamento;
    if (empty($this->nomereferencia))
    {
        $this->nomereferencia = $this->nmgp_dados_form['nomereferencia'];
    }
    $this->nmgp_dados_form['nomereferencia'] = $this->nomereferencia;
    $this->nmgp_dados_form['nomereferencia_limpa'] = $this->nomereferencia_limpa;
    $this->nmgp_dados_form['nomearquivo'] = $this->nomearquivo;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idcolaboradorimplantacao'] = $this->idcolaboradorimplantacao;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['datainicioimplantacao'] = $this->datainicioimplantacao;
    $this->nmgp_dados_form['historico'] = $this->historico;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['idcliente'] = $this->idcliente;
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      $this->Before_unformat['idproposta'] = $this->idproposta;
      nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      $this->Before_unformat['datainclusao'] = $this->datainclusao;
      $this->Before_unformat['datainclusao_hora'] = $this->datainclusao_hora;
      nm_limpa_data($this->datainclusao, $this->field_config['datainclusao']['date_sep']) ; 
      nm_limpa_hora($this->datainclusao_hora, $this->field_config['datainclusao']['time_sep']) ; 
      $this->Before_unformat['diavencimento'] = $this->diavencimento;
      nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      $this->Before_unformat['diasvalidade'] = $this->diasvalidade;
      nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      $this->Before_unformat['idcontrato'] = $this->idcontrato;
      nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      $this->Before_unformat['qtdparcelas'] = $this->qtdparcelas;
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      $this->Before_unformat['valordescontounico'] = $this->valordescontounico;
      if (!empty($this->field_config['valordescontounico']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']);
         nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']);
      }
      $this->Before_unformat['valordescontomensal'] = $this->valordescontomensal;
      if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']);
         nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']);
      }
      $this->Before_unformat['valorpropostaunica'] = $this->valorpropostaunica;
      if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']);
         nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']);
      }
      $this->Before_unformat['valorpropostamensal'] = $this->valorpropostamensal;
      if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']);
         nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']);
      }
      $this->Before_unformat['datafechamento'] = $this->datafechamento;
      $this->Before_unformat['datafechamento_hora'] = $this->datafechamento_hora;
      nm_limpa_data($this->datafechamento, $this->field_config['datafechamento']['date_sep']) ; 
      nm_limpa_hora($this->datafechamento_hora, $this->field_config['datafechamento']['time_sep']) ; 
      $this->Before_unformat['idtenacidade'] = $this->idtenacidade;
      nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
      $this->Before_unformat['idusuarioauditoria'] = $this->idusuarioauditoria;
      nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
      $this->Before_unformat['datainicioimplantacao'] = $this->datainicioimplantacao;
      nm_limpa_data($this->datainicioimplantacao, $this->field_config['datainicioimplantacao']['date_sep']) ; 
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
      if ($Nome_Campo == "idproposta")
      {
          nm_limpa_numero($this->idproposta, $this->field_config['idproposta']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "diavencimento")
      {
          nm_limpa_numero($this->diavencimento, $this->field_config['diavencimento']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "diasvalidade")
      {
          nm_limpa_numero($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idcontrato")
      {
          nm_limpa_numero($this->idcontrato, $this->field_config['idcontrato']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "qtdparcelas")
      {
          nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valordescontounico")
      {
          if (!empty($this->field_config['valordescontounico']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_mon']);
             nm_limpa_valor($this->valordescontounico, $this->field_config['valordescontounico']['symbol_dec'], $this->field_config['valordescontounico']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valordescontomensal")
      {
          if (!empty($this->field_config['valordescontomensal']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_mon']);
             nm_limpa_valor($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_dec'], $this->field_config['valordescontomensal']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorpropostaunica")
      {
          if (!empty($this->field_config['valorpropostaunica']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_mon']);
             nm_limpa_valor($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_dec'], $this->field_config['valorpropostaunica']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorpropostamensal")
      {
          if (!empty($this->field_config['valorpropostamensal']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_mon']);
             nm_limpa_valor($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_dec'], $this->field_config['valorpropostamensal']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "idtenacidade")
      {
          nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
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
      if ('' !== $this->idcliente || (!empty($format_fields) && isset($format_fields['idcliente'])))
      {
          nmgp_Form_Num_Val($this->idcliente, $this->field_config['idcliente']['symbol_grp'], $this->field_config['idcliente']['symbol_dec'], "0", "S", $this->field_config['idcliente']['format_neg'], "", "", "-", $this->field_config['idcliente']['symbol_fmt']) ; 
      }
      if ('' !== $this->idproposta || (!empty($format_fields) && isset($format_fields['idproposta'])))
      {
          nmgp_Form_Num_Val($this->idproposta, $this->field_config['idproposta']['symbol_grp'], $this->field_config['idproposta']['symbol_dec'], "0", "S", $this->field_config['idproposta']['format_neg'], "", "", "-", $this->field_config['idproposta']['symbol_fmt']) ; 
      }
      if ((!empty($this->datainclusao) && 'null' != $this->datainclusao) || (!empty($format_fields) && isset($format_fields['datainclusao'])))
      {
          $nm_separa_data = strpos($this->field_config['datainclusao']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['datainclusao']['date_format'];
          $this->field_config['datainclusao']['date_format'] = substr($this->field_config['datainclusao']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->datainclusao, " ") ; 
          $this->datainclusao_hora = substr($this->datainclusao, $separador + 1) ; 
          $this->datainclusao = substr($this->datainclusao, 0, $separador) ; 
          nm_volta_data($this->datainclusao, $this->field_config['datainclusao']['date_format']) ; 
          nmgp_Form_Datas($this->datainclusao, $this->field_config['datainclusao']['date_format'], $this->field_config['datainclusao']['date_sep']) ;  
          $this->field_config['datainclusao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->datainclusao_hora, $this->field_config['datainclusao']['date_format']) ; 
          nmgp_Form_Hora($this->datainclusao_hora, $this->field_config['datainclusao']['date_format'], $this->field_config['datainclusao']['time_sep']) ;  
          $this->field_config['datainclusao']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->datainclusao || '' == $this->datainclusao)
      {
          $this->datainclusao_hora = '';
          $this->datainclusao = '';
      }
      if ('' !== $this->diavencimento || (!empty($format_fields) && isset($format_fields['diavencimento'])))
      {
          nmgp_Form_Num_Val($this->diavencimento, $this->field_config['diavencimento']['symbol_grp'], $this->field_config['diavencimento']['symbol_dec'], "0", "S", $this->field_config['diavencimento']['format_neg'], "", "", "-", $this->field_config['diavencimento']['symbol_fmt']) ; 
      }
      if ('' !== $this->diasvalidade || (!empty($format_fields) && isset($format_fields['diasvalidade'])))
      {
          nmgp_Form_Num_Val($this->diasvalidade, $this->field_config['diasvalidade']['symbol_grp'], $this->field_config['diasvalidade']['symbol_dec'], "0", "S", $this->field_config['diasvalidade']['format_neg'], "", "", "-", $this->field_config['diasvalidade']['symbol_fmt']) ; 
      }
      if ('' !== $this->idcontrato || (!empty($format_fields) && isset($format_fields['idcontrato'])))
      {
          nmgp_Form_Num_Val($this->idcontrato, $this->field_config['idcontrato']['symbol_grp'], $this->field_config['idcontrato']['symbol_dec'], "0", "S", $this->field_config['idcontrato']['format_neg'], "", "", "-", $this->field_config['idcontrato']['symbol_fmt']) ; 
      }
      if ('' !== $this->qtdparcelas || (!empty($format_fields) && isset($format_fields['qtdparcelas'])))
      {
          nmgp_Form_Num_Val($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp'], $this->field_config['qtdparcelas']['symbol_dec'], "0", "S", $this->field_config['qtdparcelas']['format_neg'], "", "", "-", $this->field_config['qtdparcelas']['symbol_fmt']) ; 
      }
      if ('' !== $this->valordescontounico || (!empty($format_fields) && isset($format_fields['valordescontounico'])))
      {
          nmgp_Form_Num_Val($this->valordescontounico, $this->field_config['valordescontounico']['symbol_grp'], $this->field_config['valordescontounico']['symbol_dec'], "2", "S", $this->field_config['valordescontounico']['format_neg'], "", "", "-", $this->field_config['valordescontounico']['symbol_fmt']) ; 
      }
      if ('' !== $this->valordescontomensal || (!empty($format_fields) && isset($format_fields['valordescontomensal'])))
      {
          nmgp_Form_Num_Val($this->valordescontomensal, $this->field_config['valordescontomensal']['symbol_grp'], $this->field_config['valordescontomensal']['symbol_dec'], "2", "S", $this->field_config['valordescontomensal']['format_neg'], "", "", "-", $this->field_config['valordescontomensal']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorpropostaunica || (!empty($format_fields) && isset($format_fields['valorpropostaunica'])))
      {
          nmgp_Form_Num_Val($this->valorpropostaunica, $this->field_config['valorpropostaunica']['symbol_grp'], $this->field_config['valorpropostaunica']['symbol_dec'], "2", "S", $this->field_config['valorpropostaunica']['format_neg'], "", "", "-", $this->field_config['valorpropostaunica']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorpropostamensal || (!empty($format_fields) && isset($format_fields['valorpropostamensal'])))
      {
          nmgp_Form_Num_Val($this->valorpropostamensal, $this->field_config['valorpropostamensal']['symbol_grp'], $this->field_config['valorpropostamensal']['symbol_dec'], "2", "S", $this->field_config['valorpropostamensal']['format_neg'], "", "", "-", $this->field_config['valorpropostamensal']['symbol_fmt']) ; 
      }
      if ((!empty($this->datafechamento) && 'null' != $this->datafechamento) || (!empty($format_fields) && isset($format_fields['datafechamento'])))
      {
          $nm_separa_data = strpos($this->field_config['datafechamento']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['datafechamento']['date_format'];
          $this->field_config['datafechamento']['date_format'] = substr($this->field_config['datafechamento']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->datafechamento, " ") ; 
          $this->datafechamento_hora = substr($this->datafechamento, $separador + 1) ; 
          $this->datafechamento = substr($this->datafechamento, 0, $separador) ; 
          nm_volta_data($this->datafechamento, $this->field_config['datafechamento']['date_format']) ; 
          nmgp_Form_Datas($this->datafechamento, $this->field_config['datafechamento']['date_format'], $this->field_config['datafechamento']['date_sep']) ;  
          $this->field_config['datafechamento']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->datafechamento_hora, $this->field_config['datafechamento']['date_format']) ; 
          nmgp_Form_Hora($this->datafechamento_hora, $this->field_config['datafechamento']['date_format'], $this->field_config['datafechamento']['time_sep']) ;  
          $this->field_config['datafechamento']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->datafechamento || '' == $this->datafechamento)
      {
          $this->datafechamento_hora = '';
          $this->datafechamento = '';
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
      $guarda_format_hora = $this->field_config['datainclusao']['date_format'];
      if ($this->datainclusao != "")  
      { 
          $nm_separa_data = strpos($this->field_config['datainclusao']['date_format'], ";") ;
          $this->field_config['datainclusao']['date_format'] = substr($this->field_config['datainclusao']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->datainclusao, $this->field_config['datainclusao']['date_format']) ; 
          $this->field_config['datainclusao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->datainclusao_hora, $this->field_config['datainclusao']['date_format']) ; 
          if ($this->datainclusao_hora == "" )  
          { 
              $this->datainclusao_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->datainclusao_hora = substr($this->datainclusao_hora, 0, -4) . "." . substr($this->datainclusao_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datainclusao_hora = substr($this->datainclusao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datainclusao_hora = substr($this->datainclusao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datainclusao_hora = substr($this->datainclusao_hora, 0, -4);
          }
          if ($this->datainclusao != "")  
          { 
              $this->datainclusao .= " " . $this->datainclusao_hora ; 
          }
      } 
      if ($this->datainclusao == "" && $use_null)  
      { 
          $this->datainclusao = "null" ; 
      } 
      $this->field_config['datainclusao']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['datafechamento']['date_format'];
      if ($this->datafechamento != "")  
      { 
          $nm_separa_data = strpos($this->field_config['datafechamento']['date_format'], ";") ;
          $this->field_config['datafechamento']['date_format'] = substr($this->field_config['datafechamento']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->datafechamento, $this->field_config['datafechamento']['date_format']) ; 
          $this->field_config['datafechamento']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->datafechamento_hora, $this->field_config['datafechamento']['date_format']) ; 
          if ($this->datafechamento_hora == "" )  
          { 
              $this->datafechamento_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->datafechamento_hora = substr($this->datafechamento_hora, 0, -4) . "." . substr($this->datafechamento_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datafechamento_hora = substr($this->datafechamento_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datafechamento_hora = substr($this->datafechamento_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datafechamento_hora = substr($this->datafechamento_hora, 0, -4);
          }
          if ($this->datafechamento != "")  
          { 
              $this->datafechamento .= " " . $this->datafechamento_hora ; 
          }
      } 
      if ($this->datafechamento == "" && $use_null)  
      { 
          $this->datafechamento = "null" ; 
      } 
      $this->field_config['datafechamento']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_idempresa();
          $this->ajax_return_values_idcliente();
          $this->ajax_return_values_idtipocontrato();
          $this->ajax_return_values_idproposta();
          $this->ajax_return_values_solicitante();
          $this->ajax_return_values_datainclusao();
          $this->ajax_return_values_idusuarioinclusao();
          $this->ajax_return_values_situacaoproposta();
          $this->ajax_return_values_prazoentrega();
          $this->ajax_return_values_formapagamento();
          $this->ajax_return_values_diavencimento();
          $this->ajax_return_values_diasvalidade();
          $this->ajax_return_values_idindicereajuste();
          $this->ajax_return_values_idcontrato();
          $this->ajax_return_values_qtdparcelas();
          $this->ajax_return_values_valordescontounico();
          $this->ajax_return_values_motivodescontounico();
          $this->ajax_return_values_valordescontomensal();
          $this->ajax_return_values_motivodescontomensal();
          $this->ajax_return_values_valorpropostaunica();
          $this->ajax_return_values_valorpropostamensal();
          $this->ajax_return_values_datafechamento();
          $this->ajax_return_values_idusuariofechamento();
          $this->ajax_return_values_motivofechamento();
          $this->ajax_return_values_observacoes();
          $this->ajax_return_values_produtos();
          $this->ajax_return_values_andamento();
          $this->ajax_return_values_nomereferencia();
          $this->ajax_return_values_nomearquivo();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idproposta']['keyVal'] = Proposta_Frm_pack_protect_string($this->nmgp_dados_form['idproposta']);
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaAndamento_Lst_script_case_init'] ]['PropostaAndamento_Lst']['embutida_form_full'] = true;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaAndamento_Lst_script_case_init'] ]['PropostaAndamento_Lst']['embutida_form']       = true;
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaAndamento_Lst_script_case_init'] ]['PropostaAndamento_Lst']['embutida_pai']        = "Proposta_Frm";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaAndamento_Lst_script_case_init'] ]['PropostaAndamento_Lst']['embutida_form_parms'] = "varidproposta*scin" . $this->nmgp_dados_form['idproposta'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaAndamento_Lst_script_case_init'] ]['PropostaAndamento_Lst']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaAndamento_Lst_script_case_init'] ]['PropostaAndamento_Lst']['total']);
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['foreign_key']['idproposta'] = $this->nmgp_dados_form['idproposta'];
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['where_filter'] = "IdProposta = " . $this->nmgp_dados_form['idproposta'] . "";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['where_detal']  = "IdProposta = " . $this->nmgp_dados_form['idproposta'] . "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] < 0)
              {
                  $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['where_filter'] = "1 <> 1";
              }
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['PropostaItem_Gde_script_case_init'] ]['PropostaItem_Gde']['total']);
          }
   } // ajax_return_values

          //----- idempresa
   function ajax_return_values_idempresa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idempresa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idempresa);
              $aLookup = array();
              $this->_tmp_lookup_idempresa = $this->idempresa;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdEmpresa, RazaoSocial  FROM empresa WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY RazaoSocial";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'][] = $rs->fields[0];
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
              $this->NM_ajax_info['fldList']['idempresa']['valList'][$i] = Proposta_Frm_pack_protect_string($v);
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

          //----- idcliente
   function ajax_return_values_idcliente($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcliente", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcliente);
              $aLookup = array();
              $this->_tmp_lookup_idcliente = $this->idcliente;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcliente");

   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdCliente, Descricao FROM clienteempresa_view WHERE (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND IdCliente = " . substr($this->Db->qstr($this->idcliente), 1, -1) . " ORDER BY Descricao";
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
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

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
              $aLookup[] = array(Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idcliente'][] = $rs->fields[0];
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
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idcliente'] = array(
                       'row'    => '',
               'type'    => 'text',
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
          $val_output = isset($aLookup[0][Proposta_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcliente))]) ? $aLookup[0][Proposta_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcliente))] : "";
          $this->NM_ajax_info['fldList']['idcliente_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
              );
          }
   }

          //----- idtipocontrato
   function ajax_return_values_idtipocontrato($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipocontrato", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipocontrato);
              $aLookup = array();
              $this->_tmp_lookup_idtipocontrato = $this->idtipocontrato;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'] = array(); 
}
$aLookup[] = array(Proposta_Frm_pack_protect_string('') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string('Escolha o tipo do contrato')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdTipoContrato, Descricao  FROM tipocontrato  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND Ativo = 'S' ORDER BY Descricao";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipocontrato\"";
          if (isset($this->NM_ajax_info['select_html']['idtipocontrato']) && !empty($this->NM_ajax_info['select_html']['idtipocontrato']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipocontrato']);
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

                  if ($this->idtipocontrato == $sValue)
                  {
                      $this->_tmp_lookup_idtipocontrato = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipocontrato'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipocontrato']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipocontrato']['valList'][$i] = Proposta_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipocontrato']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipocontrato']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipocontrato']['labList'] = $aLabel;
          }
   }

          //----- idproposta
   function ajax_return_values_idproposta($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idproposta", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idproposta);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idproposta'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idproposta", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- solicitante
   function ajax_return_values_solicitante($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("solicitante", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->solicitante);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['solicitante'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- datainclusao
   function ajax_return_values_datainclusao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datainclusao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datainclusao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datainclusao'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->datainclusao . ' ' . $this->datainclusao_hora),
              );
          }
   }

          //----- idusuarioinclusao
   function ajax_return_values_idusuarioinclusao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idusuarioinclusao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idusuarioinclusao);
              $aLookup = array();
              $this->_tmp_lookup_idusuarioinclusao = $this->idusuarioinclusao;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'] = array(); 
}
$aLookup[] = array(Proposta_Frm_pack_protect_string('NULL') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string('Informe o usuário')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'][] = 'NULL';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Nome";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idusuarioinclusao\"";
          if (isset($this->NM_ajax_info['select_html']['idusuarioinclusao']) && !empty($this->NM_ajax_info['select_html']['idusuarioinclusao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idusuarioinclusao']);
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

                  if ($this->idusuarioinclusao == $sValue)
                  {
                      $this->_tmp_lookup_idusuarioinclusao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idusuarioinclusao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idusuarioinclusao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idusuarioinclusao']['valList'][$i] = Proposta_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idusuarioinclusao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idusuarioinclusao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idusuarioinclusao']['labList'] = $aLabel;
          }
   }

          //----- situacaoproposta
   function ajax_return_values_situacaoproposta($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("situacaoproposta", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->situacaoproposta);
              $aLookup = array();
              $this->_tmp_lookup_situacaoproposta = $this->situacaoproposta;

$aLookup[] = array(Proposta_Frm_pack_protect_string('P') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string("Pendente")));
$aLookup[] = array(Proposta_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string("Aprovada, aguardando assinatura")));
$aLookup[] = array(Proposta_Frm_pack_protect_string('A') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string("Aprovada e assinada")));
$aLookup[] = array(Proposta_Frm_pack_protect_string('R') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string("Reprovada")));
$aLookup[] = array(Proposta_Frm_pack_protect_string('C') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string("Cancelada")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_situacaoproposta'][] = 'P';
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_situacaoproposta'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_situacaoproposta'][] = 'A';
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_situacaoproposta'][] = 'R';
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_situacaoproposta'][] = 'C';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"situacaoproposta\"";
          if (isset($this->NM_ajax_info['select_html']['situacaoproposta']) && !empty($this->NM_ajax_info['select_html']['situacaoproposta']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['situacaoproposta']);
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

                  if ($this->situacaoproposta == $sValue)
                  {
                      $this->_tmp_lookup_situacaoproposta = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['situacaoproposta'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['situacaoproposta']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['situacaoproposta']['valList'][$i] = Proposta_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['situacaoproposta']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['situacaoproposta']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['situacaoproposta']['labList'] = $aLabel;
          }
   }

          //----- prazoentrega
   function ajax_return_values_prazoentrega($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("prazoentrega", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->prazoentrega);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['prazoentrega'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- formapagamento
   function ajax_return_values_formapagamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("formapagamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->formapagamento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['formapagamento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- diavencimento
   function ajax_return_values_diavencimento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("diavencimento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->diavencimento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['diavencimento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- diasvalidade
   function ajax_return_values_diasvalidade($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("diasvalidade", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->diasvalidade);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['diasvalidade'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- idindicereajuste
   function ajax_return_values_idindicereajuste($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idindicereajuste", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idindicereajuste);
              $aLookup = array();
              $this->_tmp_lookup_idindicereajuste = $this->idindicereajuste;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'] = array(); 
}
$aLookup[] = array(Proposta_Frm_pack_protect_string('') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string('Escolha o índice de reajuste')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdIndiceReajuste, Descricao  FROM indicereajuste  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idindicereajuste\"";
          if (isset($this->NM_ajax_info['select_html']['idindicereajuste']) && !empty($this->NM_ajax_info['select_html']['idindicereajuste']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idindicereajuste']);
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

                  if ($this->idindicereajuste == $sValue)
                  {
                      $this->_tmp_lookup_idindicereajuste = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idindicereajuste'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idindicereajuste']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idindicereajuste']['valList'][$i] = Proposta_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idindicereajuste']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idindicereajuste']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idindicereajuste']['labList'] = $aLabel;
          }
   }

          //----- idcontrato
   function ajax_return_values_idcontrato($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcontrato", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcontrato);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idcontrato'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- valordescontounico
   function ajax_return_values_valordescontounico($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valordescontounico", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valordescontounico);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valordescontounico'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- motivodescontounico
   function ajax_return_values_motivodescontounico($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("motivodescontounico", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->motivodescontounico);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['motivodescontounico'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- valordescontomensal
   function ajax_return_values_valordescontomensal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valordescontomensal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valordescontomensal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valordescontomensal'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- motivodescontomensal
   function ajax_return_values_motivodescontomensal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("motivodescontomensal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->motivodescontomensal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['motivodescontomensal'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- valorpropostaunica
   function ajax_return_values_valorpropostaunica($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorpropostaunica", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorpropostaunica);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorpropostaunica'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- valorpropostamensal
   function ajax_return_values_valorpropostamensal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorpropostamensal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorpropostamensal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorpropostamensal'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- datafechamento
   function ajax_return_values_datafechamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datafechamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datafechamento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datafechamento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->datafechamento . ' ' . $this->datafechamento_hora),
              );
          }
   }

          //----- idusuariofechamento
   function ajax_return_values_idusuariofechamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idusuariofechamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idusuariofechamento);
              $aLookup = array();
              $this->_tmp_lookup_idusuariofechamento = $this->idusuariofechamento;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'] = array(); 
}
$aLookup[] = array(Proposta_Frm_pack_protect_string('NULL') => str_replace('<', '&lt;',Proposta_Frm_pack_protect_string('Informe o usuário')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'][] = 'NULL';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Nome";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Proposta_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idusuariofechamento\"";
          if (isset($this->NM_ajax_info['select_html']['idusuariofechamento']) && !empty($this->NM_ajax_info['select_html']['idusuariofechamento']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idusuariofechamento']);
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

                  if ($this->idusuariofechamento == $sValue)
                  {
                      $this->_tmp_lookup_idusuariofechamento = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idusuariofechamento'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idusuariofechamento']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idusuariofechamento']['valList'][$i] = Proposta_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idusuariofechamento']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idusuariofechamento']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idusuariofechamento']['labList'] = $aLabel;
          }
   }

          //----- motivofechamento
   function ajax_return_values_motivofechamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("motivofechamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->motivofechamento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['motivofechamento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
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
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- produtos
   function ajax_return_values_produtos($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("produtos", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->produtos);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['produtos'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- andamento
   function ajax_return_values_andamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("andamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->andamento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['andamento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- nomereferencia
   function ajax_return_values_nomereferencia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomereferencia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomereferencia);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->nomereferencia, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_nomereferencia_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['download_filenames'][$sTmpFile] = $this->nomereferencia;
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
               'docLink' => "<a href=\"javascript:nm_mostra_doc('0', '" . $sTmpFile . "', 'Proposta_Frm')\">" . $tmp_file_nomereferencia . "</a>",
               'docIcon' => $tmp_icon_nomereferencia,
               'docReadonly' => "N",
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varSituacaoPropostaAnt)) {$this->sc_temp_varSituacaoPropostaAnt = (isset($_SESSION['varSituacaoPropostaAnt'])) ? $_SESSION['varSituacaoPropostaAnt'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varNomeReferencia)) {$this->sc_temp_varNomeReferencia = (isset($_SESSION['varNomeReferencia'])) ? $_SESSION['varNomeReferencia'] : "";}
if (!isset($this->sc_temp_varProposta_IdCliente)) {$this->sc_temp_varProposta_IdCliente = (isset($_SESSION['varProposta_IdCliente'])) ? $_SESSION['varProposta_IdCliente'] : "";}
  $this->Preparar_LstFrm_OnSrip_OnLoad_Auditoria($this->Ini->nm_cod_apl, $this->idproposta );

if ($this->sc_evento == "novo")
{
	$this->sc_temp_varProposta_IdCliente 	= NULL;
}


$this->sc_temp_varNomeReferencia = $this->nomereferencia ;

$this->sc_ajax_javascript('nm_field_disabled', array("datainclusao=disabled", ""));
;
$this->sc_ajax_javascript('nm_field_disabled', array("idusuarioinclusao=disabled", ""));
;
$this->sc_ajax_javascript('nm_field_disabled', array("datafechamento=disabled", ""));
;
$this->sc_ajax_javascript('nm_field_disabled', array("idusuariofechamento=disabled", ""));
;
$this->sc_ajax_javascript('nm_field_disabled', array("formapagamento=disabled", ""));
;

if ($this->situacaoproposta  != 'P') {
	$this->sc_ajax_javascript('nm_field_disabled', array("situacaoproposta=disabled", ""));
;
	$this->sc_ajax_javascript('nm_field_disabled', array("motivofechamento=disabled", ""));
;
	$this->NM_ajax_info['buttonDisplay']['Reabrir'] = $this->nmgp_botoes["Reabrir"] = 'on';;
}
else {
	$this->NM_ajax_info['buttonDisplay']['Reabrir'] = $this->nmgp_botoes["Reabrir"] = 'off';;
}	

if (!empty($this->sc_temp_varProposta_IdCliente)) {
	$this->sc_ajax_javascript('nm_field_disabled', array("idcliente=disabled", ""));
;
}

$this->AtualizarValorProposta();
if ($this->situacaoproposta  == 'A' ) {
	$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Aprovada em *";	
	$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Aprovada por *";	
	$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Comentários da aprovação";	
	$this->NM_ajax_info['buttonDisplay']['Reabrir'] = $this->nmgp_botoes["Reabrir"] = 'off';;
	$this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = 'off';;
	$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;
}
else {
	if ($this->situacaoproposta  == 'R') {
  		$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Reprovada em *";	
  		$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Reprovada por *";	
  		$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Motivo da reprovação *";	
	}
	else {
		if ($this->situacaoproposta  == 'C') {
  			$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Cancelada em *";	
  			$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Cancelada por *";	
	  		$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Motivo do cancelamento *";	
		}
		else {
  			$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Fechada em";	
  			$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Fechada por";	
	  		$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Motivo do fechamento";	
		}
	}
}

if ($this->sc_evento == "novo") {
	
	$this->qtdparcelas  = 1;	
	$this->situacaoproposta  = 'P';
	$this->sc_ajax_javascript('nm_field_disabled', array("situacaoproposta=disabled", ""));
;
	$this->idusuarioinclusao  = $this->sc_temp_varIdUsuario;
	$this->AcertarFormaPagamento();
	;
	;
	$this->Ini->nm_hidden_blocos[7] = 'off'; $this->NM_ajax_info['blockDisplay']['7'] = 'off';
	$this->Ini->nm_hidden_blocos[4] = 'off'; $this->NM_ajax_info['blockDisplay']['4'] = 'off';

	
}
if ($this->situacaoproposta  == '')
	$this->situacaoproposta  = 'P';

$this->sc_temp_varSituacaoPropostaAnt = $this->situacaoproposta ;
if (isset($this->sc_temp_varProposta_IdCliente)) { $_SESSION['varProposta_IdCliente'] = $this->sc_temp_varProposta_IdCliente;}
if (isset($this->sc_temp_varNomeReferencia)) { $_SESSION['varNomeReferencia'] = $this->sc_temp_varNomeReferencia;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varSituacaoPropostaAnt)) { $_SESSION['varSituacaoPropostaAnt'] = $this->sc_temp_varSituacaoPropostaAnt;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onLoad ------*/
 
      }
      if (empty($this->datainclusao))
      {
          $this->datainclusao_hora = $this->datainclusao;
      }
      if (empty($this->datafechamento))
      {
          $this->datafechamento_hora = $this->datafechamento;
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
      $this->valordescontounico = str_replace($sc_parm1, $sc_parm2, $this->valordescontounico); 
      $this->valordescontomensal = str_replace($sc_parm1, $sc_parm2, $this->valordescontomensal); 
      $this->valorpropostaunica = str_replace($sc_parm1, $sc_parm2, $this->valorpropostaunica); 
      $this->valorpropostamensal = str_replace($sc_parm1, $sc_parm2, $this->valorpropostamensal); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->valordescontounico = "'" . $this->valordescontounico . "'";
      $this->valordescontomensal = "'" . $this->valordescontomensal . "'";
      $this->valorpropostaunica = "'" . $this->valorpropostaunica . "'";
      $this->valorpropostamensal = "'" . $this->valorpropostamensal . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->valordescontounico = str_replace("'", "", $this->valordescontounico); 
      $this->valordescontomensal = str_replace("'", "", $this->valordescontomensal); 
      $this->valorpropostaunica = str_replace("'", "", $this->valorpropostaunica); 
      $this->valorpropostamensal = str_replace("'", "", $this->valorpropostamensal); 
   } 
//----------- 

   function controle_navegacao()
   {
      global $sc_where;

          if (false && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']))
          {
               $sc_where_pos = " WHERE ((IdProposta < $this->idproposta))";
               if ('' != $sc_where)
               {
                   if ('where ' == strtolower(substr(trim($sc_where), 0, 6)))
                   {
                       $sc_where = substr(trim($sc_where), 6);
                   }
                   if ('and ' == strtolower(substr(trim($sc_where), 0, 4)))
                   {
                       $sc_where = substr(trim($sc_where), 4);
                   }
                   $sc_where_pos .= ' AND (' . $sc_where . ')';
                   $sc_where = ' WHERE ' . $sc_where;
               }
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] = $rsc->fields[0];
               $rsc->Close(); 
               if ('' != $this->idproposta)
               {
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = $rsc->fields[0];
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] < 0)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = 0;
               }
               $rsc->Close(); 
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = 0;
               }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['qt_reg_grid'] = 1;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['final']  = 0;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] = $this->NM_ajax_info['param']['nmgp_opcao'];
          if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'], array('incluir', 'alterar', 'excluir')))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] = '';
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] == 'inicio')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = 0;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] == 'retorna')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = 0 ;
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] == 'avanca' && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] > $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['final']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['final'];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] == 'final')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] = 0;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['final'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['qt_reg_grid'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['final'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] = '';

   }
   function return_after_insert()
   {
      global $sc_where;
      $this->restore_zeros_null();
      $sc_where_pos = " WHERE ((IdProposta < $this->idproposta))";
      if ('' != $sc_where)
      {
          if ('where ' == strtolower(substr(trim($sc_where), 0, 6)))
          {
              $sc_where = substr(trim($sc_where), 6);
          }
          if ('and ' == strtolower(substr(trim($sc_where), 0, 4)))
          {
              $sc_where = substr(trim($sc_where), 4);
          }
          $sc_where_pos .= ' AND (' . $sc_where . ')';
          $sc_where = ' WHERE ' . $sc_where;
      }
      if ('' != $this->idproposta)
      {
          $sc_where_pos = str_replace("'null'", "null", $sc_where_pos);
          $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count;
          $rsc = $this->Db->Execute($nmgp_sel_count);
          if ($rsc === false && !$rsc->EOF)
          {
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
              exit;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['reg_start'] = $rsc->fields[0];
          $rsc->Close();
      }
   }

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
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varSituacaoPropostaAnt)) {$this->sc_temp_varSituacaoPropostaAnt = (isset($_SESSION['varSituacaoPropostaAnt'])) ? $_SESSION['varSituacaoPropostaAnt'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varNomeReferencia)) {$this->sc_temp_varNomeReferencia = (isset($_SESSION['varNomeReferencia'])) ? $_SESSION['varNomeReferencia'] : "";}
  if (($this->nomereferencia  != "") && ($this->nomereferencia  != $this->sc_temp_varNomeReferencia)) {
	
	$this->nomearquivo  = $this->nomereferencia ;
	$extensaoArquivo = pathinfo($this->nomereferencia , PATHINFO_EXTENSION);
	$this->nomereferencia  = md5(date('YdmHisu') . $this->nomereferencia  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;

} else if ($this->nomereferencia  == "") {
	
	$this->nomearquivo  = "";
}


$this->sc_temp_varNomeReferencia = $this->nomereferencia ;

if (($this->situacaoproposta  != 'P') && ($this->sc_temp_varSituacaoPropostaAnt != $this->situacaoproposta )) {
	
	$this->datafechamento  = date('Y-m-d H:i');
	$this->idusuariofechamento  = $this->sc_temp_varIdUsuario;
	
}
if (isset($this->sc_temp_varNomeReferencia)) { $_SESSION['varNomeReferencia'] = $this->sc_temp_varNomeReferencia;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varSituacaoPropostaAnt)) { $_SESSION['varSituacaoPropostaAnt'] = $this->sc_temp_varSituacaoPropostaAnt;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeInsert ------*/
 
    }
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeUpdate ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varSituacaoPropostaAnt)) {$this->sc_temp_varSituacaoPropostaAnt = (isset($_SESSION['varSituacaoPropostaAnt'])) ? $_SESSION['varSituacaoPropostaAnt'] : "";}
if (!isset($this->sc_temp_varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = (isset($_SESSION['varDiretorioArquivo'])) ? $_SESSION['varDiretorioArquivo'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varNomeReferencia)) {$this->sc_temp_varNomeReferencia = (isset($_SESSION['varNomeReferencia'])) ? $_SESSION['varNomeReferencia'] : "";}
  if (($this->nomereferencia  != "") && ($this->nomereferencia  != $this->sc_temp_varNomeReferencia)) {
	
	$this->nomearquivo  = $this->nomereferencia ;
	$extensaoArquivo = pathinfo($this->nomereferencia , PATHINFO_EXTENSION);
	$this->nomereferencia  = md5(date('YdmHisu') . $this->nomereferencia  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;
	$nomeOriginal = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomearquivo ;
	$nomeReferencia = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferencia ;
	rename($nomeOriginal, $nomeReferencia);

} else if ($this->nomereferencia  == "") {
	
	$this->nomearquivo  = "";
}

$this->sc_temp_varNomeReferencia = $this->nomereferencia ;

if (($this->situacaoproposta  != 'P') && ($this->sc_temp_varSituacaoPropostaAnt != $this->situacaoproposta )) {
	
	$this->datafechamento  = date('Y-m-d H:i');
	$this->idusuariofechamento  = $this->sc_temp_varIdUsuario;
	
}

$this->AtualizarValorProposta();
if (isset($this->sc_temp_varNomeReferencia)) { $_SESSION['varNomeReferencia'] = $this->sc_temp_varNomeReferencia;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
if (isset($this->sc_temp_varSituacaoPropostaAnt)) { $_SESSION['varSituacaoPropostaAnt'] = $this->sc_temp_varSituacaoPropostaAnt;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeUpdate ------*/
 
    }
    if ("excluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event Dependency ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
              /* propostaitem */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "DELETE FROM propostaitem WHERE IdProposta = '" . $this->idproposta  . "'";
      }
      else
      {
          $sc_cmd_dependency = "DELETE FROM propostaitem WHERE IdProposta = '" . $this->idproposta  . "'";
      }
      
     $nm_select = $sc_cmd_dependency; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                Proposta_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event Dependency ------*/
 
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
      if ('incluir' == $this->nmgp_opcao && empty($this->idusuarioinclusao)) {$this->idusuarioinclusao = "" . $_SESSION['varIdUsuario'] . ""; $this->NM_val_null[] = "idusuarioinclusao";}  
      if ('incluir' == $this->nmgp_opcao && $this->idusuariofechamento == ""){$this->idusuariofechamento = "null"; $this->NM_val_null[] = "idusuariofechamento";}  
      if ('incluir' == $this->nmgp_opcao && $this->idcolaboradorimplantacao == ""){$this->idcolaboradorimplantacao = "null"; $this->NM_val_null[] = "idcolaboradorimplantacao";}  
      $NM_val_form['idempresa'] = $this->idempresa;
      $NM_val_form['idcliente'] = $this->idcliente;
      $NM_val_form['idtipocontrato'] = $this->idtipocontrato;
      $NM_val_form['idproposta'] = $this->idproposta;
      $NM_val_form['solicitante'] = $this->solicitante;
      $NM_val_form['datainclusao'] = $this->datainclusao;
      $NM_val_form['idusuarioinclusao'] = $this->idusuarioinclusao;
      $NM_val_form['situacaoproposta'] = $this->situacaoproposta;
      $NM_val_form['prazoentrega'] = $this->prazoentrega;
      $NM_val_form['formapagamento'] = $this->formapagamento;
      $NM_val_form['diavencimento'] = $this->diavencimento;
      $NM_val_form['diasvalidade'] = $this->diasvalidade;
      $NM_val_form['idindicereajuste'] = $this->idindicereajuste;
      $NM_val_form['idcontrato'] = $this->idcontrato;
      $NM_val_form['qtdparcelas'] = $this->qtdparcelas;
      $NM_val_form['valordescontounico'] = $this->valordescontounico;
      $NM_val_form['motivodescontounico'] = $this->motivodescontounico;
      $NM_val_form['valordescontomensal'] = $this->valordescontomensal;
      $NM_val_form['motivodescontomensal'] = $this->motivodescontomensal;
      $NM_val_form['valorpropostaunica'] = $this->valorpropostaunica;
      $NM_val_form['valorpropostamensal'] = $this->valorpropostamensal;
      $NM_val_form['datafechamento'] = $this->datafechamento;
      $NM_val_form['idusuariofechamento'] = $this->idusuariofechamento;
      $NM_val_form['motivofechamento'] = $this->motivofechamento;
      $NM_val_form['observacoes'] = $this->observacoes;
      $NM_val_form['produtos'] = $this->produtos;
      $NM_val_form['andamento'] = $this->andamento;
      $NM_val_form['nomereferencia'] = $this->nomereferencia;
      $NM_val_form['nomearquivo'] = $this->nomearquivo;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idcolaboradorimplantacao'] = $this->idcolaboradorimplantacao;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['datainicioimplantacao'] = $this->datainicioimplantacao;
      $NM_val_form['historico'] = $this->historico;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      if ($this->idproposta === "" || is_null($this->idproposta))  
      { 
          $this->idproposta = 0;
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
      if ($this->idtipocontrato === "" || is_null($this->idtipocontrato))  
      { 
          $this->idtipocontrato = 0;
          $this->sc_force_zero[] = 'idtipocontrato';
      } 
      if ($this->idindicereajuste === "" || is_null($this->idindicereajuste))  
      { 
          $this->idindicereajuste = 0;
          $this->sc_force_zero[] = 'idindicereajuste';
      } 
      if ($this->idempresa === "" || is_null($this->idempresa))  
      { 
          $this->idempresa = 0;
          $this->sc_force_zero[] = 'idempresa';
      } 
      if ($this->idusuarioinclusao === "" || is_null($this->idusuarioinclusao))  
      { 
          $this->idusuarioinclusao = 0;
          $this->sc_force_zero[] = 'idusuarioinclusao';
      } 
      if ($this->idusuariofechamento === "" || is_null($this->idusuariofechamento))  
      { 
          $this->idusuariofechamento = 0;
          $this->sc_force_zero[] = 'idusuariofechamento';
      } 
      if ($this->nmgp_opcao == "incluir")
      {
      if ($this->idcolaboradorimplantacao === "" || is_null($this->idcolaboradorimplantacao))  
      { 
          $this->idcolaboradorimplantacao = 0;
          $this->sc_force_zero[] = 'idcolaboradorimplantacao';
      } 
      }
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      if ($this->diavencimento === "" || is_null($this->diavencimento))  
      { 
          $this->diavencimento = 0;
          $this->sc_force_zero[] = 'diavencimento';
      } 
      if ($this->diasvalidade === "" || is_null($this->diasvalidade))  
      { 
          $this->diasvalidade = 0;
          $this->sc_force_zero[] = 'diasvalidade';
      } 
      if ($this->valordescontounico === "" || is_null($this->valordescontounico))  
      { 
          $this->valordescontounico = 0;
          $this->sc_force_zero[] = 'valordescontounico';
      } 
      if ($this->valordescontomensal === "" || is_null($this->valordescontomensal))  
      { 
          $this->valordescontomensal = 0;
          $this->sc_force_zero[] = 'valordescontomensal';
      } 
      if ($this->qtdparcelas === "" || is_null($this->qtdparcelas))  
      { 
          $this->qtdparcelas = 0;
          $this->sc_force_zero[] = 'qtdparcelas';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->datainclusao == "")  
          { 
              $this->datainclusao = "null"; 
              $this->NM_val_null[] = "datainclusao";
          } 
          if ($this->datafechamento == "")  
          { 
              $this->datafechamento = "null"; 
              $this->NM_val_null[] = "datafechamento";
          } 
          $this->motivofechamento_before_qstr = $this->motivofechamento;
          $this->motivofechamento = substr($this->Db->qstr($this->motivofechamento), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->motivofechamento = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->motivofechamento);
          }
          if ($this->motivofechamento == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->motivofechamento = "null"; 
              $this->NM_val_null[] = "motivofechamento";
          } 
          $this->solicitante_before_qstr = $this->solicitante;
          $this->solicitante = substr($this->Db->qstr($this->solicitante), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->solicitante = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->solicitante);
          }
          if ($this->solicitante == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->solicitante = "null"; 
              $this->NM_val_null[] = "solicitante";
          } 
          $this->situacaoproposta_before_qstr = $this->situacaoproposta;
          $this->situacaoproposta = substr($this->Db->qstr($this->situacaoproposta), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->situacaoproposta = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->situacaoproposta);
          }
          if ($this->situacaoproposta == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->situacaoproposta = "null"; 
              $this->NM_val_null[] = "situacaoproposta";
          } 
          if ($this->datainicioimplantacao == "")  
          { 
              $this->datainicioimplantacao = "null"; 
              $this->NM_val_null[] = "datainicioimplantacao";
          } 
          $this->prazoentrega_before_qstr = $this->prazoentrega;
          $this->prazoentrega = substr($this->Db->qstr($this->prazoentrega), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->prazoentrega = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->prazoentrega);
          }
          if ($this->prazoentrega == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->prazoentrega = "null"; 
              $this->NM_val_null[] = "prazoentrega";
          } 
          $this->formapagamento_before_qstr = $this->formapagamento;
          $this->formapagamento = substr($this->Db->qstr($this->formapagamento), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->formapagamento = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->formapagamento);
          }
          if ($this->formapagamento == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->formapagamento = "null"; 
              $this->NM_val_null[] = "formapagamento";
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
          $this->nomearquivo_before_qstr = $this->nomearquivo;
          $this->nomearquivo = substr($this->Db->qstr($this->nomearquivo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomearquivo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomearquivo);
          }
          if ($this->nomearquivo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomearquivo = "null"; 
              $this->NM_val_null[] = "nomearquivo";
          } 
          $this->nomereferencia_original_filename = $this->nomereferencia; 
          $this->nomereferencia_before_qstr = $this->nomereferencia;
          $this->nomereferencia = substr($this->Db->qstr($this->nomereferencia), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomereferencia = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomereferencia);
          }
          if ($this->nomereferencia == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomereferencia = "null"; 
              $this->NM_val_null[] = "nomereferencia";
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
          $this->motivodescontounico_before_qstr = $this->motivodescontounico;
          $this->motivodescontounico = substr($this->Db->qstr($this->motivodescontounico), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->motivodescontounico = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->motivodescontounico);
          }
          if ($this->motivodescontounico == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->motivodescontounico = "null"; 
              $this->NM_val_null[] = "motivodescontounico";
          } 
          $this->motivodescontomensal_before_qstr = $this->motivodescontomensal;
          $this->motivodescontomensal = substr($this->Db->qstr($this->motivodescontomensal), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->motivodescontomensal = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->motivodescontomensal);
          }
          if ($this->motivodescontomensal == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->motivodescontomensal = "null"; 
              $this->NM_val_null[] = "motivodescontomensal";
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
          $this->andamento_before_qstr = $this->andamento;
          $this->andamento = substr($this->Db->qstr($this->andamento), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->andamento = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->andamento);
          }
          if ($this->andamento == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->andamento = "null"; 
              $this->NM_val_null[] = "andamento";
          } 
          $this->produtos_before_qstr = $this->produtos;
          $this->produtos = substr($this->Db->qstr($this->produtos), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->produtos = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->produtos);
          }
          if ($this->produtos == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->produtos = "null"; 
              $this->NM_val_null[] = "produtos";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 Proposta_Frm_pack_ajax_response();
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
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdTipoContrato = $this->idtipocontrato, IdIndiceReajuste = $this->idindicereajuste, IdEmpresa = $this->idempresa, IdUsuarioInclusao = $this->idusuarioinclusao, IdUsuarioFechamento = $this->idusuariofechamento, DataInclusao = #$this->datainclusao#, DataFechamento = #$this->datafechamento#, MotivoFechamento = '$this->motivofechamento', Solicitante = '$this->solicitante', DiaVencimento = $this->diavencimento, DiasValidade = $this->diasvalidade, SituacaoProposta = '$this->situacaoproposta', PrazoEntrega = '$this->prazoentrega', FormaPagamento = '$this->formapagamento', Observacoes = '$this->observacoes', NomeArquivo = '$this->nomearquivo', ValorDescontoUnico = $this->valordescontounico, ValorDescontoMensal = $this->valordescontomensal, MotivoDescontoUnico = '$this->motivodescontounico', MotivoDescontoMensal = '$this->motivodescontomensal', QtdParcelas = $this->qtdparcelas"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdTipoContrato = $this->idtipocontrato, IdIndiceReajuste = $this->idindicereajuste, IdEmpresa = $this->idempresa, IdUsuarioInclusao = $this->idusuarioinclusao, IdUsuarioFechamento = $this->idusuariofechamento, DataInclusao = " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", DataFechamento = " . $this->Ini->date_delim . $this->datafechamento . $this->Ini->date_delim1 . ", MotivoFechamento = '$this->motivofechamento', Solicitante = '$this->solicitante', DiaVencimento = $this->diavencimento, DiasValidade = $this->diasvalidade, SituacaoProposta = '$this->situacaoproposta', PrazoEntrega = '$this->prazoentrega', FormaPagamento = '$this->formapagamento', Observacoes = '$this->observacoes', NomeArquivo = '$this->nomearquivo', ValorDescontoUnico = $this->valordescontounico, ValorDescontoMensal = $this->valordescontomensal, MotivoDescontoUnico = '$this->motivodescontounico', MotivoDescontoMensal = '$this->motivodescontomensal', QtdParcelas = $this->qtdparcelas"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdTipoContrato = $this->idtipocontrato, IdIndiceReajuste = $this->idindicereajuste, IdEmpresa = $this->idempresa, IdUsuarioInclusao = $this->idusuarioinclusao, IdUsuarioFechamento = $this->idusuariofechamento, DataInclusao = " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", DataFechamento = " . $this->Ini->date_delim . $this->datafechamento . $this->Ini->date_delim1 . ", MotivoFechamento = '$this->motivofechamento', Solicitante = '$this->solicitante', DiaVencimento = $this->diavencimento, DiasValidade = $this->diasvalidade, SituacaoProposta = '$this->situacaoproposta', PrazoEntrega = '$this->prazoentrega', FormaPagamento = '$this->formapagamento', Observacoes = '$this->observacoes', NomeArquivo = '$this->nomearquivo', ValorDescontoUnico = $this->valordescontounico, ValorDescontoMensal = $this->valordescontomensal, MotivoDescontoUnico = '$this->motivodescontounico', MotivoDescontoMensal = '$this->motivodescontomensal', QtdParcelas = $this->qtdparcelas"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdTipoContrato = $this->idtipocontrato, IdIndiceReajuste = $this->idindicereajuste, IdEmpresa = $this->idempresa, IdUsuarioInclusao = $this->idusuarioinclusao, IdUsuarioFechamento = $this->idusuariofechamento, DataInclusao = " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", DataFechamento = " . $this->Ini->date_delim . $this->datafechamento . $this->Ini->date_delim1 . ", MotivoFechamento = '$this->motivofechamento', Solicitante = '$this->solicitante', DiaVencimento = $this->diavencimento, DiasValidade = $this->diasvalidade, SituacaoProposta = '$this->situacaoproposta', PrazoEntrega = '$this->prazoentrega', FormaPagamento = '$this->formapagamento', Observacoes = '$this->observacoes', NomeArquivo = '$this->nomearquivo', ValorDescontoUnico = $this->valordescontounico, ValorDescontoMensal = $this->valordescontomensal, MotivoDescontoUnico = '$this->motivodescontounico', MotivoDescontoMensal = '$this->motivodescontomensal', QtdParcelas = $this->qtdparcelas"; 
              } 
              if (isset($this->idcontrato) && $this->idcontrato != "") 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "IdContrato = $this->idcontrato"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                  { 
                      $SC_fields_update[] = "IdContrato = $this->idcontrato"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                  { 
                      $SC_fields_update[] = "IdContrato = $this->idcontrato"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "IdContrato = $this->idcontrato"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] == "null"  && $this->nmgp_dados_select['idtenacidade'] == "") ? "null" : $this->nmgp_dados_select['idtenacidade'];
              if (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTenacidade = $this->idtenacidade"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idcolaboradorimplantacao']) && $NM_val_form['idcolaboradorimplantacao'] == "null"  && $this->nmgp_dados_select['idcolaboradorimplantacao'] == "") ? "null" : $this->nmgp_dados_select['idcolaboradorimplantacao'];
              if (isset($NM_val_form['idcolaboradorimplantacao']) && $NM_val_form['idcolaboradorimplantacao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdColaboradorImplantacao = $this->idcolaboradorimplantacao"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] == "null"  && $this->nmgp_dados_select['idusuarioauditoria'] == "") ? "null" : $this->nmgp_dados_select['idusuarioauditoria'];
              if (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioAuditoria = $this->idusuarioauditoria"; 
              } 
              $Prep_Tst = (isset($NM_val_form['datainicioimplantacao']) && $NM_val_form['datainicioimplantacao'] == "null"  && $this->nmgp_dados_select['datainicioimplantacao'] == "") ? "null" : $this->nmgp_dados_select['datainicioimplantacao'];
              if (isset($NM_val_form['datainicioimplantacao']) && $NM_val_form['datainicioimplantacao'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataInicioImplantacao = #$this->datainicioimplantacao#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataInicioImplantacao = " . $this->Ini->date_delim . $this->datainicioimplantacao . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['historico']) && $NM_val_form['historico'] == "null"  && $this->nmgp_dados_select['historico'] == "") ? "null" : $this->nmgp_dados_select['historico'];
              if (isset($NM_val_form['historico']) && $NM_val_form['historico'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "Historico = '$this->historico'"; 
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
              $aEraseFiles  = array();
              $temp_cmd_sql = "";
              if ($this->nomereferencia_limpa == "S")
              {
                  $sDirErase     = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/";
                  $aEraseFiles[] = array('dir' => $sDirErase, 'file' => $this->nmgp_dados_form['nomereferencia']);
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
                  $comando .= " WHERE IdProposta = $this->idproposta ";  
              }  
              else  
              {
                  $comando .= " WHERE IdProposta = $this->idproposta ";  
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
                                  Proposta_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->motivofechamento = $this->motivofechamento_before_qstr;
              $this->solicitante = $this->solicitante_before_qstr;
              $this->situacaoproposta = $this->situacaoproposta_before_qstr;
              $this->prazoentrega = $this->prazoentrega_before_qstr;
              $this->formapagamento = $this->formapagamento_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->historico = $this->historico_before_qstr;
              $this->motivodescontounico = $this->motivodescontounico_before_qstr;
              $this->motivodescontomensal = $this->motivodescontomensal_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->andamento = $this->andamento_before_qstr;
              $this->produtos = $this->produtos_before_qstr;
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
              if (!empty($aEraseFiles))
              {
                  foreach ($aEraseFiles as $aEraseData)
                  {
                      $sEraseFile = $aEraseData['dir'] . $aEraseData['file'];
                      if (@is_file($sEraseFile))
                      {
                          @unlink($sEraseFile);
                      }
                  }
              }
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['nomereferencia_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idproposta'])) { $this->idproposta = $NM_val_form['idproposta']; }
              elseif (isset($this->idproposta)) { $this->nm_limpa_alfa($this->idproposta); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcliente'])) { $this->idcliente = $NM_val_form['idcliente']; }
              elseif (isset($this->idcliente)) { $this->nm_limpa_alfa($this->idcliente); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipocontrato'])) { $this->idtipocontrato = $NM_val_form['idtipocontrato']; }
              elseif (isset($this->idtipocontrato)) { $this->nm_limpa_alfa($this->idtipocontrato); }
              if     (isset($NM_val_form) && isset($NM_val_form['idindicereajuste'])) { $this->idindicereajuste = $NM_val_form['idindicereajuste']; }
              elseif (isset($this->idindicereajuste)) { $this->nm_limpa_alfa($this->idindicereajuste); }
              if     (isset($NM_val_form) && isset($NM_val_form['idempresa'])) { $this->idempresa = $NM_val_form['idempresa']; }
              elseif (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcontrato'])) { $this->idcontrato = $NM_val_form['idcontrato']; }
              elseif (isset($this->idcontrato)) { $this->nm_limpa_alfa($this->idcontrato); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuarioinclusao'])) { $this->idusuarioinclusao = $NM_val_form['idusuarioinclusao']; }
              elseif (isset($this->idusuarioinclusao)) { $this->nm_limpa_alfa($this->idusuarioinclusao); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuariofechamento'])) { $this->idusuariofechamento = $NM_val_form['idusuariofechamento']; }
              elseif (isset($this->idusuariofechamento)) { $this->nm_limpa_alfa($this->idusuariofechamento); }
              if     (isset($NM_val_form) && isset($NM_val_form['motivofechamento'])) { $this->motivofechamento = $NM_val_form['motivofechamento']; }
              elseif (isset($this->motivofechamento)) { $this->nm_limpa_alfa($this->motivofechamento); }
              if     (isset($NM_val_form) && isset($NM_val_form['solicitante'])) { $this->solicitante = $NM_val_form['solicitante']; }
              elseif (isset($this->solicitante)) { $this->nm_limpa_alfa($this->solicitante); }
              if     (isset($NM_val_form) && isset($NM_val_form['diavencimento'])) { $this->diavencimento = $NM_val_form['diavencimento']; }
              elseif (isset($this->diavencimento)) { $this->nm_limpa_alfa($this->diavencimento); }
              if     (isset($NM_val_form) && isset($NM_val_form['diasvalidade'])) { $this->diasvalidade = $NM_val_form['diasvalidade']; }
              elseif (isset($this->diasvalidade)) { $this->nm_limpa_alfa($this->diasvalidade); }
              if     (isset($NM_val_form) && isset($NM_val_form['situacaoproposta'])) { $this->situacaoproposta = $NM_val_form['situacaoproposta']; }
              elseif (isset($this->situacaoproposta)) { $this->nm_limpa_alfa($this->situacaoproposta); }
              if     (isset($NM_val_form) && isset($NM_val_form['prazoentrega'])) { $this->prazoentrega = $NM_val_form['prazoentrega']; }
              elseif (isset($this->prazoentrega)) { $this->nm_limpa_alfa($this->prazoentrega); }
              if     (isset($NM_val_form) && isset($NM_val_form['formapagamento'])) { $this->formapagamento = $NM_val_form['formapagamento']; }
              elseif (isset($this->formapagamento)) { $this->nm_limpa_alfa($this->formapagamento); }
              if     (isset($NM_val_form) && isset($NM_val_form['observacoes'])) { $this->observacoes = $NM_val_form['observacoes']; }
              elseif (isset($this->observacoes)) { $this->nm_limpa_alfa($this->observacoes); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomearquivo'])) { $this->nomearquivo = $NM_val_form['nomearquivo']; }
              elseif (isset($this->nomearquivo)) { $this->nm_limpa_alfa($this->nomearquivo); }
              if     (isset($NM_val_form) && isset($NM_val_form['valordescontounico'])) { $this->valordescontounico = $NM_val_form['valordescontounico']; }
              elseif (isset($this->valordescontounico)) { $this->nm_limpa_alfa($this->valordescontounico); }
              if     (isset($NM_val_form) && isset($NM_val_form['valordescontomensal'])) { $this->valordescontomensal = $NM_val_form['valordescontomensal']; }
              elseif (isset($this->valordescontomensal)) { $this->nm_limpa_alfa($this->valordescontomensal); }
              if     (isset($NM_val_form) && isset($NM_val_form['motivodescontounico'])) { $this->motivodescontounico = $NM_val_form['motivodescontounico']; }
              elseif (isset($this->motivodescontounico)) { $this->nm_limpa_alfa($this->motivodescontounico); }
              if     (isset($NM_val_form) && isset($NM_val_form['motivodescontomensal'])) { $this->motivodescontomensal = $NM_val_form['motivodescontomensal']; }
              elseif (isset($this->motivodescontomensal)) { $this->nm_limpa_alfa($this->motivodescontomensal); }
              if     (isset($NM_val_form) && isset($NM_val_form['qtdparcelas'])) { $this->qtdparcelas = $NM_val_form['qtdparcelas']; }
              elseif (isset($this->qtdparcelas)) { $this->nm_limpa_alfa($this->qtdparcelas); }
              if     (isset($NM_val_form) && isset($NM_val_form['andamento'])) { $this->andamento = $NM_val_form['andamento']; }
              elseif (isset($this->andamento)) { $this->nm_limpa_alfa($this->andamento); }
              if     (isset($NM_val_form) && isset($NM_val_form['produtos'])) { $this->produtos = $NM_val_form['produtos']; }
              elseif (isset($this->produtos)) { $this->nm_limpa_alfa($this->produtos); }

              $this->nm_formatar_campos();

              $bChange_nomereferencia = false;
              if (isset($this->nomereferencia_original_filename) && '' != $this->nomereferencia_original_filename && $this->nomereferencia_original_filename != $this->nomereferencia)
              {
                  $sTmpOrig_nomereferencia = $this->nomereferencia;
                  $this->nomereferencia    = $this->nomereferencia_original_filename;
                  $bChange_nomereferencia  = true;
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('idempresa', 'idcliente', 'idtipocontrato', 'idproposta', 'solicitante', 'datainclusao', 'idusuarioinclusao', 'situacaoproposta', 'prazoentrega', 'formapagamento', 'diavencimento', 'diasvalidade', 'idindicereajuste', 'idcontrato', 'qtdparcelas', 'valordescontounico', 'motivodescontounico', 'valordescontomensal', 'motivodescontomensal', 'valorpropostaunica', 'valorpropostamensal', 'datafechamento', 'idusuariofechamento', 'motivofechamento', 'observacoes', 'produtos', 'andamento', 'nomereferencia', 'nomearquivo'), $aDoNotUpdate);
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "IdProposta, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(IdProposta) from " . $this->Ini->nm_tabela; 
          $comando = "select max(IdProposta) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  Proposta_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $this->idproposta_before_qstr = $this->idproposta = $rs->fields[0] + 1;
          $rs->Close(); 
              $this->datainclusao =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->datainclusao_hora =  date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      Proposta_Frm_pack_ajax_response();
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
                  if ($this->idcontrato != "")
                  { 
                       $compl_insert     .= ", IdContrato";
                       $compl_insert_val .= ", $this->idcontrato";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdTenacidade, IdCliente, IdTipoContrato, IdIndiceReajuste, IdEmpresa, IdUsuarioInclusao, IdUsuarioFechamento, IdColaboradorImplantacao, IdUsuarioAuditoria, DataInclusao, DataFechamento, MotivoFechamento, Solicitante, DiaVencimento, DiasValidade, SituacaoProposta, DataInicioImplantacao, PrazoEntrega, FormaPagamento, Observacoes, NomeArquivo, NomeReferencia, Historico, ValorDescontoUnico, ValorDescontoMensal, MotivoDescontoUnico, MotivoDescontoMensal, QtdParcelas, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES ($this->idtenacidade, $this->idcliente, $this->idtipocontrato, $this->idindicereajuste, $this->idempresa, $this->idusuarioinclusao, $this->idusuariofechamento, $this->idcolaboradorimplantacao, $this->idusuarioauditoria, #$this->datainclusao#, #$this->datafechamento#, '$this->motivofechamento', '$this->solicitante', $this->diavencimento, $this->diasvalidade, '$this->situacaoproposta', #$this->datainicioimplantacao#, '$this->prazoentrega', '$this->formapagamento', '$this->observacoes', '$this->nomearquivo', '$this->nomereferencia', '$this->historico', $this->valordescontounico, $this->valordescontomensal, '$this->motivodescontounico', '$this->motivodescontomensal', $this->qtdparcelas, '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idcontrato != "")
                  { 
                       $compl_insert     .= ", IdContrato";
                       $compl_insert_val .= ", $this->idcontrato";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdCliente, IdTipoContrato, IdIndiceReajuste, IdEmpresa, IdUsuarioInclusao, IdUsuarioFechamento, IdColaboradorImplantacao, IdUsuarioAuditoria, DataInclusao, DataFechamento, MotivoFechamento, Solicitante, DiaVencimento, DiasValidade, SituacaoProposta, DataInicioImplantacao, PrazoEntrega, FormaPagamento, Observacoes, NomeArquivo, NomeReferencia, Historico, ValorDescontoUnico, ValorDescontoMensal, MotivoDescontoUnico, MotivoDescontoMensal, QtdParcelas, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcliente, $this->idtipocontrato, $this->idindicereajuste, $this->idempresa, $this->idusuarioinclusao, $this->idusuariofechamento, $this->idcolaboradorimplantacao, $this->idusuarioauditoria, " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datafechamento . $this->Ini->date_delim1 . ", '$this->motivofechamento', '$this->solicitante', $this->diavencimento, $this->diasvalidade, '$this->situacaoproposta', " . $this->Ini->date_delim . $this->datainicioimplantacao . $this->Ini->date_delim1 . ", '$this->prazoentrega', '$this->formapagamento', '$this->observacoes', '$this->nomearquivo', '$this->nomereferencia', '$this->historico', $this->valordescontounico, $this->valordescontomensal, '$this->motivodescontounico', '$this->motivodescontomensal', $this->qtdparcelas, '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idcontrato != "")
                  { 
                       $compl_insert     .= ", IdContrato";
                       $compl_insert_val .= ", $this->idcontrato";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdCliente, IdTipoContrato, IdIndiceReajuste, IdEmpresa, IdUsuarioInclusao, IdUsuarioFechamento, IdColaboradorImplantacao, IdUsuarioAuditoria, DataInclusao, DataFechamento, MotivoFechamento, Solicitante, DiaVencimento, DiasValidade, SituacaoProposta, DataInicioImplantacao, PrazoEntrega, FormaPagamento, Observacoes, NomeArquivo, NomeReferencia, Historico, ValorDescontoUnico, ValorDescontoMensal, MotivoDescontoUnico, MotivoDescontoMensal, QtdParcelas, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcliente, $this->idtipocontrato, $this->idindicereajuste, $this->idempresa, $this->idusuarioinclusao, $this->idusuariofechamento, $this->idcolaboradorimplantacao, $this->idusuarioauditoria, " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datafechamento . $this->Ini->date_delim1 . ", '$this->motivofechamento', '$this->solicitante', $this->diavencimento, $this->diasvalidade, '$this->situacaoproposta', " . $this->Ini->date_delim . $this->datainicioimplantacao . $this->Ini->date_delim1 . ", '$this->prazoentrega', '$this->formapagamento', '$this->observacoes', '$this->nomearquivo', '$this->nomereferencia', '$this->historico', $this->valordescontounico, $this->valordescontomensal, '$this->motivodescontounico', '$this->motivodescontomensal', $this->qtdparcelas, '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idcontrato != "")
                  { 
                       $compl_insert     .= ", IdContrato";
                       $compl_insert_val .= ", $this->idcontrato";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdCliente, IdTipoContrato, IdIndiceReajuste, IdEmpresa, IdUsuarioInclusao, IdUsuarioFechamento, IdColaboradorImplantacao, IdUsuarioAuditoria, DataInclusao, DataFechamento, MotivoFechamento, Solicitante, DiaVencimento, DiasValidade, SituacaoProposta, DataInicioImplantacao, PrazoEntrega, FormaPagamento, Observacoes, NomeArquivo, NomeReferencia, Historico, ValorDescontoUnico, ValorDescontoMensal, MotivoDescontoUnico, MotivoDescontoMensal, QtdParcelas, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcliente, $this->idtipocontrato, $this->idindicereajuste, $this->idempresa, $this->idusuarioinclusao, $this->idusuariofechamento, $this->idcolaboradorimplantacao, $this->idusuarioauditoria, " . $this->Ini->date_delim . $this->datainclusao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datafechamento . $this->Ini->date_delim1 . ", '$this->motivofechamento', '$this->solicitante', $this->diavencimento, $this->diasvalidade, '$this->situacaoproposta', " . $this->Ini->date_delim . $this->datainicioimplantacao . $this->Ini->date_delim1 . ", '$this->prazoentrega', '$this->formapagamento', '$this->observacoes', '$this->nomearquivo', '$this->nomereferencia', '$this->historico', $this->valordescontounico, $this->valordescontomensal, '$this->motivodescontounico', '$this->motivodescontomensal', $this->qtdparcelas, '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
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
                              Proposta_Frm_pack_ajax_response();
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
                          Proposta_Frm_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->idproposta =  $rsy->fields[0];
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
                  $this->idproposta = $rsy->fields[0];
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
                  $this->idproposta = $rsy->fields[0];
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
                  $this->idproposta = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->motivofechamento = $this->motivofechamento_before_qstr;
              $this->solicitante = $this->solicitante_before_qstr;
              $this->situacaoproposta = $this->situacaoproposta_before_qstr;
              $this->prazoentrega = $this->prazoentrega_before_qstr;
              $this->formapagamento = $this->formapagamento_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->historico = $this->historico_before_qstr;
              $this->motivodescontounico = $this->motivodescontounico_before_qstr;
              $this->motivodescontomensal = $this->motivodescontomensal_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->andamento = $this->andamento_before_qstr;
              $this->produtos = $this->produtos_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']);
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
              $this->motivofechamento = $this->motivofechamento_before_qstr;
              $this->solicitante = $this->solicitante_before_qstr;
              $this->situacaoproposta = $this->situacaoproposta_before_qstr;
              $this->prazoentrega = $this->prazoentrega_before_qstr;
              $this->formapagamento = $this->formapagamento_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->historico = $this->historico_before_qstr;
              $this->motivodescontounico = $this->motivodescontounico_before_qstr;
              $this->motivodescontomensal = $this->motivodescontomensal_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              $this->andamento = $this->andamento_before_qstr;
              $this->produtos = $this->produtos_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->nmgp_botoes['Reabrir'] = "on";
              $this->nmgp_botoes['Voltar'] = "on";
              $this->nmgp_botoes['Auditoria'] = "on";
              $this->nmgp_botoes['sc_btn_0'] = "on";
              $this->nmgp_botoes['sc_btn_1'] = "on";
              $this->nmgp_botoes['Imprimir'] = "on";
              $this->return_after_insert();
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->idproposta = substr($this->Db->qstr($this->idproposta), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';
          if ($bDelecaoOk)
          {
              $sDetailWhere = "IdProposta = " . $this->idproposta . "";
              $this->PropostaItem_Gde->ini_controle();
              if ($this->PropostaItem_Gde->temRegistros($sDetailWhere))
              {
                  $bDelecaoOk = false;
                  $sMsgErro   = $this->Ini->Nm_lang['lang_errm_fkvi'];
              }
          }

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "); 
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
          $aEraseFiles = array();
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdProposta = $this->idproposta "); 
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
                          Proposta_Frm_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
                  $sDirErase     = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
                  $aEraseFiles[] = array('dir' => $sDirErase, 'file' => $this->nmgp_dados_form['nomereferencia']);
              if (!empty($aEraseFiles))
              {
                  foreach ($aEraseFiles as $aEraseData)
                  {
                      $sEraseFile = $aEraseData['dir'] . $aEraseData['file'];
                      if (@is_file($sEraseFile))
                      {
                          @unlink($sEraseFile);
                      }
                  }
              }
              $this->sc_evento = "delete"; 
              if (empty($this->sc_erro_delete)) {
                  $this->record_delete_ok = true;
              }
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;

              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']);
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
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        
/*----- Scriptcase Locale: Event onAfterInsert ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = (isset($_SESSION['varDiretorioArquivo'])) ? $_SESSION['varDiretorioArquivo'] : "";}
  if ($this->nomereferencia  != "") { 
	$nomeOriginal = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomearquivo ;
	$nomeReferencia = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferencia ;
	rename($nomeOriginal, $nomeReferencia);
}
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterInsert ------*/
 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        
/*----- Scriptcase Locale: Event onAfterUpdate ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  $this->AtualizarValorProposta();


if ($this->situacaoproposta  == 'A') {
	
	$this->datainicioimplantacao  = date('Y-m-d H:i');
	
	$check_sql = "SELECT IdContrato"
   . " FROM contrato"
   . " WHERE IdProposta = '" . $this->idproposta  . "'";
	 
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


	if (isset($this->rs[0][0]))  {
	
	} else  {
		
		$this->GerarContrato();
		$this->EnviarEmail();
		
	}
	
} else if ($this->situacaoproposta  == 'S') {
	
	$this->datainicioimplantacao  = date('Y-m-d H:i');
	
	require_once("../_lib/libraries/sys/jrs-rest-php-client/autoload.dist.php");

	$tipoContrato = $this->idtipocontrato ;

	if ($tipoContrato == 19) { 

		$report_unit = "/reports/Proposta_1_1/propostaLIGA.jrxml";

	} else {

		$report_unit = "/reports/Proposta2021/PropostaNova2021ok";
	}
	
	$cliente = new Jaspersoft\Client\Client("http://ligaintranet.no-ip.info:8085/jasperserver",
				"ligasistemas",
				"infoliga.07",
				"");



	$parametros = array("IdProposta" => $this->idproposta );

	$relatorio = $cliente->reportService()->runReport($report_unit, 'pdf', null, null, $parametros);

	$nomeArquivo = $this->idproposta ."_proposta.pdf";
	file_put_contents($nomeArquivo, $relatorio);
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}



		?>
	<script>
		alert("ok");
		window.location.href="../Proposta_Lst/index.php";

		</script>
<?php

	
   
	
	
	
	
	
}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterUpdate ------*/
 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      
/*----- Scriptcase Locale: Event onAfterDelete ------*/
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

echo "<script type=\"text/javascript\">";
echo "setTimeout(function() { window.location = \"" . $this->nmgp_url_saida . "?script_case_init=" . $this->form_encode_input($this->Ini->sc_page) . "\"; }, 500);";
echo "</script>";
exit;
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterDelete ------*/
 
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['parms'] = "idproposta?#?$this->idproposta?@?"; 
      }
      $this->nmgp_dados_form['nomereferencia'] = ""; 
      $this->nomereferencia_limpa = ""; 
      $this->nomereferencia_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idproposta = null === $this->idproposta ? null : substr($this->Db->qstr($this->idproposta), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter'] . ")";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdProposta, IdTenacidade, IdCliente, IdTipoContrato, IdIndiceReajuste, IdEmpresa, IdContrato, IdUsuarioInclusao, IdUsuarioFechamento, IdColaboradorImplantacao, IdUsuarioAuditoria, DataInclusao, DataFechamento, MotivoFechamento, Solicitante, DiaVencimento, DiasValidade, SituacaoProposta, DataInicioImplantacao, PrazoEntrega, FormaPagamento, Observacoes, NomeArquivo, NomeReferencia, Historico, ValorDescontoUnico, ValorDescontoMensal, MotivoDescontoUnico, MotivoDescontoMensal, QtdParcelas, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "IdProposta = $this->idproposta"; 
              }  
              else  
              {
                  $aWhere[] = "IdProposta = $this->idproposta"; 
              }  
              if (!empty($sc_where_filter))  
              {
                  $teste_select = $nmgp_select . $this->returnWhere($aWhere);
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $teste_select; 
                  $rs = $this->Db->Execute($teste_select); 
                  if ($rs->EOF)
                  {
                     $aWhere = array($sc_where_filter);
                  }  
                  $rs->Close(); 
              }  
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "IdProposta";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "insert" || $this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['select'] = ""; 
              } 
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rs = $this->Db->Execute($nmgp_select) ; 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['Reabrir'] = $this->nmgp_botoes['Reabrir'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['Voltar'] = $this->nmgp_botoes['Voltar'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes['Auditoria'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['sc_btn_0'] = $this->nmgp_botoes['sc_btn_0'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['sc_btn_1'] = $this->nmgp_botoes['sc_btn_1'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['Imprimir'] = $this->nmgp_botoes['Imprimir'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['Reabrir'] = $this->nmgp_botoes['Reabrir'] = "off";
              $this->NM_ajax_info['buttonDisplay']['Voltar'] = $this->nmgp_botoes['Voltar'] = "on";
              $this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes['Auditoria'] = "off";
              $this->NM_ajax_info['buttonDisplay']['sc_btn_0'] = $this->nmgp_botoes['sc_btn_0'] = "off";
              $this->NM_ajax_info['buttonDisplay']['sc_btn_1'] = $this->nmgp_botoes['sc_btn_1'] = "off";
              $this->NM_ajax_info['buttonDisplay']['Imprimir'] = $this->nmgp_botoes['Imprimir'] = "off";
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
              $this->idproposta = $rs->fields[0] ; 
              $this->nmgp_dados_select['idproposta'] = $this->idproposta;
              $this->idtenacidade = $rs->fields[1] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idcliente = $rs->fields[2] ; 
              $this->nmgp_dados_select['idcliente'] = $this->idcliente;
              $this->idtipocontrato = $rs->fields[3] ; 
              $this->nmgp_dados_select['idtipocontrato'] = $this->idtipocontrato;
              $this->idindicereajuste = $rs->fields[4] ; 
              $this->nmgp_dados_select['idindicereajuste'] = $this->idindicereajuste;
              $this->idempresa = $rs->fields[5] ; 
              $this->nmgp_dados_select['idempresa'] = $this->idempresa;
              $this->idcontrato = $rs->fields[6] ; 
              $this->nmgp_dados_select['idcontrato'] = $this->idcontrato;
              $this->idusuarioinclusao = $rs->fields[7] ; 
              $this->nmgp_dados_select['idusuarioinclusao'] = $this->idusuarioinclusao;
              $this->idusuariofechamento = $rs->fields[8] ; 
              $this->nmgp_dados_select['idusuariofechamento'] = $this->idusuariofechamento;
              $this->idcolaboradorimplantacao = $rs->fields[9] ; 
              $this->nmgp_dados_select['idcolaboradorimplantacao'] = $this->idcolaboradorimplantacao;
              $this->idusuarioauditoria = $rs->fields[10] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->datainclusao = $rs->fields[11] ; 
              if (substr($this->datainclusao, 10, 1) == "-") 
              { 
                 $this->datainclusao = substr($this->datainclusao, 0, 10) . " " . substr($this->datainclusao, 11);
              } 
              if (substr($this->datainclusao, 13, 1) == ".") 
              { 
                 $this->datainclusao = substr($this->datainclusao, 0, 13) . ":" . substr($this->datainclusao, 14, 2) . ":" . substr($this->datainclusao, 17);
              } 
              $this->nmgp_dados_select['datainclusao'] = $this->datainclusao;
              $this->datafechamento = $rs->fields[12] ; 
              if (substr($this->datafechamento, 10, 1) == "-") 
              { 
                 $this->datafechamento = substr($this->datafechamento, 0, 10) . " " . substr($this->datafechamento, 11);
              } 
              if (substr($this->datafechamento, 13, 1) == ".") 
              { 
                 $this->datafechamento = substr($this->datafechamento, 0, 13) . ":" . substr($this->datafechamento, 14, 2) . ":" . substr($this->datafechamento, 17);
              } 
              $this->nmgp_dados_select['datafechamento'] = $this->datafechamento;
              $this->motivofechamento = $rs->fields[13] ; 
              $this->nmgp_dados_select['motivofechamento'] = $this->motivofechamento;
              $this->solicitante = $rs->fields[14] ; 
              $this->nmgp_dados_select['solicitante'] = $this->solicitante;
              $this->diavencimento = $rs->fields[15] ; 
              $this->nmgp_dados_select['diavencimento'] = $this->diavencimento;
              $this->diasvalidade = $rs->fields[16] ; 
              $this->nmgp_dados_select['diasvalidade'] = $this->diasvalidade;
              $this->situacaoproposta = $rs->fields[17] ; 
              $this->nmgp_dados_select['situacaoproposta'] = $this->situacaoproposta;
              $this->datainicioimplantacao = $rs->fields[18] ; 
              if (substr($this->datainicioimplantacao, 10, 1) == "-") 
              { 
                 $this->datainicioimplantacao = substr($this->datainicioimplantacao, 0, 10) . " " . substr($this->datainicioimplantacao, 11);
              } 
              if (substr($this->datainicioimplantacao, 13, 1) == ".") 
              { 
                 $this->datainicioimplantacao = substr($this->datainicioimplantacao, 0, 13) . ":" . substr($this->datainicioimplantacao, 14, 2) . ":" . substr($this->datainicioimplantacao, 17);
              } 
              $this->nmgp_dados_select['datainicioimplantacao'] = $this->datainicioimplantacao;
              $this->prazoentrega = $rs->fields[19] ; 
              $this->nmgp_dados_select['prazoentrega'] = $this->prazoentrega;
              $this->formapagamento = $rs->fields[20] ; 
              $this->nmgp_dados_select['formapagamento'] = $this->formapagamento;
              $this->observacoes = $rs->fields[21] ; 
              $this->nmgp_dados_select['observacoes'] = $this->observacoes;
              $this->nomearquivo = $rs->fields[22] ; 
              $this->nmgp_dados_select['nomearquivo'] = $this->nomearquivo;
              $this->nomereferencia = $rs->fields[23] ; 
              $this->nmgp_dados_select['nomereferencia'] = $this->nomereferencia;
              $this->historico = $rs->fields[24] ; 
              $this->nmgp_dados_select['historico'] = $this->historico;
              $this->valordescontounico = trim($rs->fields[25]) ; 
              $this->nmgp_dados_select['valordescontounico'] = $this->valordescontounico;
              $this->valordescontomensal = trim($rs->fields[26]) ; 
              $this->nmgp_dados_select['valordescontomensal'] = $this->valordescontomensal;
              $this->motivodescontounico = $rs->fields[27] ; 
              $this->nmgp_dados_select['motivodescontounico'] = $this->motivodescontounico;
              $this->motivodescontomensal = $rs->fields[28] ; 
              $this->nmgp_dados_select['motivodescontomensal'] = $this->motivodescontomensal;
              $this->qtdparcelas = $rs->fields[29] ; 
              $this->nmgp_dados_select['qtdparcelas'] = $this->qtdparcelas;
              $this->enderecoipauditoria = $rs->fields[30] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[31] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->idproposta = (string)$this->idproposta; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idcliente = (string)$this->idcliente; 
              $this->idtipocontrato = (string)$this->idtipocontrato; 
              $this->idindicereajuste = (string)$this->idindicereajuste; 
              $this->idempresa = (string)$this->idempresa; 
              $this->idcontrato = (string)$this->idcontrato; 
              $this->idusuarioinclusao = (string)$this->idusuarioinclusao; 
              $this->idusuariofechamento = (string)$this->idusuariofechamento; 
              $this->idcolaboradorimplantacao = (string)$this->idcolaboradorimplantacao; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->diavencimento = (string)$this->diavencimento; 
              $this->diasvalidade = (string)$this->diasvalidade; 
              $this->valordescontounico = (strpos(strtolower($this->valordescontounico), "e")) ? (float)$this->valordescontounico : $this->valordescontounico; 
              $this->valordescontounico = (string)$this->valordescontounico; 
              $this->valordescontomensal = (strpos(strtolower($this->valordescontomensal), "e")) ? (float)$this->valordescontomensal : $this->valordescontomensal; 
              $this->valordescontomensal = (string)$this->valordescontomensal; 
              $this->qtdparcelas = (string)$this->qtdparcelas; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['parms'] = "idproposta?#?$this->idproposta?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sub_dir'][0]  = "/" . $_SESSION['varIdTenacidade'];
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->controle_navegacao();
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
              $this->idproposta = "";  
              $this->nmgp_dados_form["idproposta"] = $this->idproposta;
              $this->idtenacidade = "" . $_SESSION['varIdTenacidade'] . "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idcliente = "" . $_SESSION['varProposta_IdCliente'] . "";  
              $this->nmgp_dados_form["idcliente"] = $this->idcliente;
              $this->idtipocontrato = "";  
              $this->nmgp_dados_form["idtipocontrato"] = $this->idtipocontrato;
              $this->idindicereajuste = "";  
              $this->nmgp_dados_form["idindicereajuste"] = $this->idindicereajuste;
              $this->idempresa = "";  
              $this->nmgp_dados_form["idempresa"] = $this->idempresa;
              $this->idcontrato = "";  
              $this->nmgp_dados_form["idcontrato"] = $this->idcontrato;
              $this->idusuarioinclusao = "" . $_SESSION['varIdUsuario'] . "";  
              $this->nmgp_dados_form["idusuarioinclusao"] = $this->idusuarioinclusao;
              $this->idusuariofechamento = "";  
              $this->nmgp_dados_form["idusuariofechamento"] = $this->idusuariofechamento;
              $this->idcolaboradorimplantacao = "";  
              $this->nmgp_dados_form["idcolaboradorimplantacao"] = $this->idcolaboradorimplantacao;
              $this->idusuarioauditoria = "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->datainclusao =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->datainclusao_hora =  date('H') . ":" . date('i') . ":" . date('s');
              $this->nmgp_dados_form["datainclusao"] = $this->datainclusao;
              $this->datafechamento = "";  
              $this->datafechamento_hora = "" ;  
              $this->nmgp_dados_form["datafechamento"] = $this->datafechamento;
              $this->motivofechamento = "";  
              $this->nmgp_dados_form["motivofechamento"] = $this->motivofechamento;
              $this->solicitante = "";  
              $this->nmgp_dados_form["solicitante"] = $this->solicitante;
              $this->diavencimento = "2";  
              $this->nmgp_dados_form["diavencimento"] = $this->diavencimento;
              $this->diasvalidade = "15";  
              $this->nmgp_dados_form["diasvalidade"] = $this->diasvalidade;
              $this->situacaoproposta = "";  
              $this->nmgp_dados_form["situacaoproposta"] = $this->situacaoproposta;
              $this->datainicioimplantacao = "";  
              $this->datainicioimplantacao_hora = "" ;  
              $this->nmgp_dados_form["datainicioimplantacao"] = $this->datainicioimplantacao;
              $this->prazoentrega = "";  
              $this->nmgp_dados_form["prazoentrega"] = $this->prazoentrega;
              $this->formapagamento = "";  
              $this->nmgp_dados_form["formapagamento"] = $this->formapagamento;
              $this->observacoes = "";  
              $this->nmgp_dados_form["observacoes"] = $this->observacoes;
              $this->nomearquivo = "";  
              $this->nmgp_dados_form["nomearquivo"] = $this->nomearquivo;
              $this->nomereferencia = "";  
              $this->nomereferencia_ul_name = "" ;  
              $this->nomereferencia_ul_type = "" ;  
              $this->nmgp_dados_form["nomereferencia"] = $this->nomereferencia;
              $this->historico = "";  
              $this->nmgp_dados_form["historico"] = $this->historico;
              $this->valordescontounico = "";  
              $this->nmgp_dados_form["valordescontounico"] = $this->valordescontounico;
              $this->valordescontomensal = "";  
              $this->nmgp_dados_form["valordescontomensal"] = $this->valordescontomensal;
              $this->motivodescontounico = "";  
              $this->nmgp_dados_form["motivodescontounico"] = $this->motivodescontounico;
              $this->motivodescontomensal = "";  
              $this->nmgp_dados_form["motivodescontomensal"] = $this->motivodescontomensal;
              $this->qtdparcelas = "";  
              $this->nmgp_dados_form["qtdparcelas"] = $this->qtdparcelas;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $this->andamento = "";  
              $this->nmgp_dados_form["andamento"] = $this->andamento;
              $this->produtos = "";  
              $this->nmgp_dados_form["produtos"] = $this->produtos;
              $this->valorpropostamensal = "";  
              $this->nmgp_dados_form["valorpropostamensal"] = $this->valorpropostamensal;
              $this->valorpropostaunica = "";  
              $this->nmgp_dados_form["valorpropostaunica"] = $this->valorpropostaunica;
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['PropostaItem_Gde']['embutida_parms'] = "varidproposta*scin" . $this->nmgp_dados_form['idproposta'] . "*scoutSC_glo_par_varidtenacidade*scinvarIdTenacidade*scoutSC_glo_par_varidusuario*scinvarIdUsuario*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
      $_SESSION['sc_session'][$this->Ini->sc_page]['PropostaAndamento_Lst']['embutida_parms'] = "varidproposta*scin" . $this->nmgp_dados_form['idproposta'] . "*scoutNMSC_inicial*scininicio*scoutNMSC_paginacao*scinPARCIAL*scoutNMSC_cab*scinN*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout";
  }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
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

/*----- Scriptcase Locale: PHP Method: AcertarFormaPagamento ------*/

function AcertarFormaPagamento()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
if (empty($this->qtdparcelas )) {
	$this->formapagamento  = '?';
}
elseif (empty($this->diavencimento )) {
	$this->formapagamento  = '?';
}
else {
	if ($this->qtdparcelas  == 1) {
		$this->formapagamento  = 'O valor inicial deverá ser pago a vista, e o valor mensal todo dia '.$this->diavencimento .$this->NumeroExtenso($this->diavencimento ).' de cada mês, e será cobrado 30 (trinta) dias após o início do uso sistema/serviço.';
	}
	else {
		$this->formapagamento  = 'O valor inicial será dividido em '.$this->qtdparcelas .$this->NumeroExtenso($this->qtdparcelas ).' parcelas, e o valor mensal todo dia '.$this->diavencimento .$this->NumeroExtenso($this->diavencimento ).' de cada mês e será cobrado 30 (trinta) dias após o início do sistema/serviço.';
	}
}

$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: AcertarFormaPagamento ------*/


/*----- Scriptcase Locale: PHP Method: AtualizarValorProposta ------*/

function AtualizarValorProposta()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
$ValorPropostaUnica = 0;
$ValorPropostaMensal = 0;

$this->CalcularValorProposta($this->idproposta , $ValorPropostaUnica, $ValorPropostaMensal);


if (($this->valordescontounico  > 0) && ($this->valordescontomensal  > 0)) {
	$this->valorpropostaunica  = $ValorPropostaUnica - ($ValorPropostaUnica*($this->valordescontounico /100));
	$this->valorpropostamensal  = $ValorPropostaMensal - ($ValorPropostaMensal*($this->valordescontomensal /100)); 
}
else {
	$this->valorpropostaunica   = $ValorPropostaUnica;
	$this->valorpropostamensal  = $ValorPropostaMensal; 
}


$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: AtualizarValorProposta ------*/


/*----- Scriptcase Locale: Ajax Event DiaVencimento_onChange ------*/

function DiaVencimento_onChange()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
$original_qtdparcelas = $this->qtdparcelas;
$original_formapagamento = $this->formapagamento;
$original_diavencimento = $this->diavencimento;

$this->AcertarFormaPagamento();

$modificado_qtdparcelas = $this->qtdparcelas;
$modificado_formapagamento = $this->formapagamento;
$modificado_diavencimento = $this->diavencimento;
$this->nm_formatar_campos('qtdparcelas', 'formapagamento', 'diavencimento');
if ($original_qtdparcelas !== $modificado_qtdparcelas || isset($this->nmgp_cmp_readonly['qtdparcelas']) || (isset($bFlagRead_qtdparcelas) && $bFlagRead_qtdparcelas))
{
    $this->ajax_return_values_qtdparcelas(true);
}
if ($original_formapagamento !== $modificado_formapagamento || isset($this->nmgp_cmp_readonly['formapagamento']) || (isset($bFlagRead_formapagamento) && $bFlagRead_formapagamento))
{
    $this->ajax_return_values_formapagamento(true);
}
if ($original_diavencimento !== $modificado_diavencimento || isset($this->nmgp_cmp_readonly['diavencimento']) || (isset($bFlagRead_diavencimento) && $bFlagRead_diavencimento))
{
    $this->ajax_return_values_diavencimento(true);
}
$this->NM_ajax_info['event_field'] = 'DiaVencimento';
Proposta_Frm_pack_ajax_response();
exit;


$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event DiaVencimento_onChange ------*/


/*----- Scriptcase Locale: PHP Method: EnviarEmail ------*/

function EnviarEmail()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varRemetente)) {$this->sc_temp_varRemetente = (isset($_SESSION['varRemetente'])) ? $_SESSION['varRemetente'] : "";}
if (!isset($this->sc_temp_varSenhaSMTP)) {$this->sc_temp_varSenhaSMTP = (isset($_SESSION['varSenhaSMTP'])) ? $_SESSION['varSenhaSMTP'] : "";}
if (!isset($this->sc_temp_varUsuarioSMTP)) {$this->sc_temp_varUsuarioSMTP = (isset($_SESSION['varUsuarioSMTP'])) ? $_SESSION['varUsuarioSMTP'] : "";}
if (!isset($this->sc_temp_varServidorSMTP)) {$this->sc_temp_varServidorSMTP = (isset($_SESSION['varServidorSMTP'])) ? $_SESSION['varServidorSMTP'] : "";}
  
$enviadoSucesso = 0;

$sql = "SELECT u.nome, c.NomeFantasia, c.Contatos, c.Email, c.Telefone, c.Celular, p.Observacoes 
			FROM proposta p 
			INNER JOIN cliente c ON (c.IdCliente = p.IdCliente) 
			INNER JOIN usuario u ON (u.IdUsuario = p.IdUsuarioFechamento) 
			WHERE p.IdProposta = '".$this->idproposta ."'";	
	
 
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

	
if ($this->meus_dados  === false) {
		
	echo "Erro de acesso. Mensagem = " . $this->meus_dados_erro ;
		
} else {
		
	while (!$this->meus_dados->EOF) {
			
		$varNomeUsuarioFechamento = $this->meus_dados->fields[0];
		$varNomeFantasia = $this->meus_dados->fields[1];
		$varContato = $this->meus_dados->fields[2];
		$varEmail = $this->meus_dados->fields[3];
		$varTelefone = $this->meus_dados->fields[4];
		$varCelular = $this->meus_dados->fields[5];	
		$varObservacoes = $this->meus_dados->fields[6];	
			
		$mail_smtp_server 		= $this->sc_temp_varServidorSMTP;        							
		$mail_smtp_user   		= $this->sc_temp_varUsuarioSMTP;                 					
		$mail_smtp_pass   		= $this->sc_temp_varSenhaSMTP;                						
		$mail_from        		= $this->sc_temp_varRemetente;          								
		$mail_to          		= 'yuri.tavares@liga.inf.br'; 							
		$mail_subject     		= 'AUTORIZAÇÃO DE IMPLANTAÇÃO - '.$varNomeFantasia;     

		$mail_message = "<html><head></head><body>";
		$mail_message .= "Está autorizado o início da implantação das soluções abaixo: <br><br>";
		
		$sqlItens = "SELECT pi.DescricaoProduto, pi.Descricao, pi.Quantidade
						FROM propostaitem_view pi 
						WHERE  pi.IdProposta = '".$this->idproposta ."' 
						AND pi.IdTipoCobranca = 1 ORDER By pi.IdPropostaItem";	
	
		 
      $nm_select = $sqlItens; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->meus_itens = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_itens = false;
          $this->meus_itens_erro = $this->Db->ErrorMsg();
      } 


		if ($this->meus_itens  === false) {

			echo "Erro de acesso. Mensagem = " . $this->meus_itens_erro ;

		} else {

			while (!$this->meus_itens->EOF) {
				
				$mail_message .= " - ".$this->meus_itens->fields[0]. " ".$this->meus_itens->fields[1]."<br>";				
				
				$this->meus_itens->MoveNext();
			}
				
			$this->meus_itens->Close();				
			
		}
		$mail_message .= "<br>- Observações: ".$varObservacoes."<br><br>";
		$mail_message .= "<br>- Nome fantasia: ".$varNomeFantasia;
		$mail_message .= "<br>- Contato: ".$varContato;
		$mail_message .= "<br>- E-mail: ".$varEmail;
		$mail_message .= "<br>- Telefone: ".$varTelefone;
		$mail_message .= "<br>- Celular: ".$varCelular;
		$mail_message .= "<br>- Proposta fechada por: ".$varNomeUsuarioFechamento;
		$mail_message .= "<br><br><strong> Será necessário enviar e-mail de conclusão de implantação, com o termo de aceite assinado pelo cliente e relatório de visita técnica (quando houver) para o setor administrativo e comercial. <br><br> A implantação só estará finalizada quando estiver documentado que os itens contratados foram entregues e aceitos pelo cliente.</strong>";
							 
		$mail_message .= "</body></html>";

		$mail_format      		= 'H';                       				
		$mail_copies         	= 'joao.normanha@liga.inf.br;nelson.ibrahim@liga.inf.br;william.braga@liga.inf.br';  			
		$mail_tp_copies      	= 'CCC';           							
		$mail_port           	= '465';                     				
		$mail_tp_connection  	= 'S';                       				
		$mail_attachments 		= '';
		
			
		    include_once($this->Ini->path_third . "/swift/swift_required.php");
    $sc_mail_port     = "$mail_port";
    $sc_mail_tp_port  = "$mail_tp_connection";
    $sc_mail_tp_mens  = "$mail_format";
    $sc_mail_tp_copy  = "$mail_tp_copies";
    $this->sc_mail_count = 0;
    $this->sc_mail_erro  = "";
    $this->sc_mail_ok    = true;
    if ($sc_mail_tp_port == "S" || $sc_mail_tp_port == "Y")
    {
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance($mail_smtp_server, $sc_mail_port, 'ssl');
    }
    elseif ($sc_mail_tp_port == "T")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 587;
        $Con_Mail = Swift_SmtpTransport::newInstance($mail_smtp_server, $sc_mail_port, 'tls');
    }
    else
    {
        $sc_mail_port = (!empty($sc_mail_port)) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance($mail_smtp_server, $sc_mail_port);
    }
    $Con_Mail->setUsername($mail_smtp_user);
    $Con_Mail->setpassword($mail_smtp_pass);
    $Send_Mail = Swift_Mailer::newInstance($Con_Mail);
    if ($sc_mail_tp_mens == "H")
    {
        $Mens_Mail = Swift_Message::newInstance($mail_subject);
        $Mens_Mail->setBody(SC_Mail_Image($mail_message, $Mens_Mail))->setContentType("text/html");
    }
    else
    {
        $Mens_Mail = Swift_Message::newInstance($mail_subject)->setBody($mail_message);
    }
    if (!empty($_SESSION['scriptcase']['charset']))
    {
        $Mens_Mail->setCharset($_SESSION['scriptcase']['charset']);
    }
    $Temp_mail = $mail_attachments;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $mail_attachments);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Mens_Mail->attach(Swift_Attachment::fromPath($NM_dest));
        }
    }
    $Temp_mail = $mail_to;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $mail_to);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            $Mens_Mail->addTo($Arr_addr[0], $Arr_addr[1]);
        }
    }
    $Temp_mail = $mail_copies;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $mail_copies);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            if (strtoupper(substr($sc_mail_tp_copy, 0, 2)) == "CC")
            {
                $Mens_Mail->addCc($Arr_addr[0], $Arr_addr[1]);
            }
            else
            {
                $Mens_Mail->addBcc($Arr_addr[0], $Arr_addr[1]);
            }
        }
    }
    $Arr_addr = SC_Mail_Address($mail_from);
    $Err_mail = array();
    $this->sc_mail_count = $Send_Mail->send($Mens_Mail->setFrom($Arr_addr[0], $Arr_addr[1]), $Err_mail);
    if (!empty($Err_mail))
    {
        $this->sc_mail_erro = $Err_mail;
        $this->sc_mail_ok   = false;
    }
;	
			
		if ($this->sc_mail_ok ) {
				
					
		} else {
			
			
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->sc_mail_erro ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Proposta_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $this->sc_mail_erro ;
 }
;			
		}
			
		$this->meus_dados->MoveNext();
	}
		
	$this->meus_dados->Close();	
	
}
if (isset($this->sc_temp_varServidorSMTP)) { $_SESSION['varServidorSMTP'] = $this->sc_temp_varServidorSMTP;}
if (isset($this->sc_temp_varUsuarioSMTP)) { $_SESSION['varUsuarioSMTP'] = $this->sc_temp_varUsuarioSMTP;}
if (isset($this->sc_temp_varSenhaSMTP)) { $_SESSION['varSenhaSMTP'] = $this->sc_temp_varSenhaSMTP;}
if (isset($this->sc_temp_varRemetente)) { $_SESSION['varRemetente'] = $this->sc_temp_varRemetente;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: EnviarEmail ------*/


/*----- Scriptcase Locale: PHP Method: GerarContrato ------*/

function GerarContrato()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
  
$varIdUsuarioAuditoria = $this->sc_temp_varIdUsuario;
$varNomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;
$varEnderecoIpAuditoria = $_SERVER['REMOTE_ADDR'];

$sql = "INSERT INTO contrato (IdTenacidade,IdProposta,IdCliente,IdTipoContrato,IdIndiceReajuste,IdEmpresa,IdUsuarioInclusao,DataInclusao,Solicitante,DiaVencimento,SituacaoContrato,PrazoEntrega,FormaPagamento,Observacoes,ValorDescontoUnico,ValorDescontoMensal,MotivoDescontoUnico,MotivoDescontoMensal,IdUsuarioAuditoria,NomeAplicacaoAuditoria,EnderecoIpAuditoria, UltimaAtualizacao) VALUES ($this->idtenacidade ,$this->idproposta ,$this->idcliente ,$this->idtipocontrato ,$this->idindicereajuste ,$this->idempresa ,$this->idusuariofechamento ,'".$this->datafechamento ."','".$this->solicitante ."',$this->diavencimento ,'A','".$this->prazoentrega ."','".$this->formapagamento ."','".$this->observacoes ."',$this->valordescontounico ,$this->valordescontomensal ,'".$this->motivodescontounico ."','".$this->motivodescontomensal ."',$varIdUsuarioAuditoria,'".$varNomeAplicacaoAuditoria."','".$varEnderecoIpAuditoria."','".$this->datafechamento ."')";


     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                Proposta_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


$sql = "INSERT INTO contratoitem (IdTenacidade,IdContrato,IdProduto,IdClienteInstalado,DataInicioContrato,Descricao,ValorUnitario,IdUsuarioAuditoria,NomeAplicacaoAuditoria,EnderecoIpAuditoria,Ativo) SELECT IdTenacidade, LAST_INSERT_ID(),IdProduto,IdClienteInstalado, now(), Descricao,ValorUnitario,IdUsuarioAuditoria,NomeAplicacaoAuditoria,EnderecoIpAuditoria, 'S' FROM propostaitem WHERE IdProposta = $this->idproposta ";

     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                Proposta_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: GerarContrato ------*/


/*----- Scriptcase Locale: PHP Method: GerarProposta ------*/

function GerarProposta()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
require_once("../_lib/libraries/sys/jrs-rest-php-client/autoload.dist.php");

$tipoContrato = $this->idtipocontrato ;

if ($tipoContrato == 19) { 

	$report_unit = "/reports/Proposta_1_1/propostaLIGA.jrxml";

} else {

	$report_unit = "/reports/Proposta2021/PropostaNova2021ok";
}

$cliente = new Jaspersoft\Client\Client("http://201.87.229.66:8080/jasperserver",
					"liga",
					"infoliga.07",
					"");

$parametros = array("IdProposta" => $this->idproposta );

$relatorio = $cliente->reportService()->runReport($report_unit, 'pdf', null, null, $parametros);
	
$nomeArquivo = $this->idproposta ."_proposta.pdf";
file_put_contents($nomeArquivo, $relatorio);


$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: GerarProposta ------*/


/*----- Scriptcase Locale: PHP Method: GerarReceita ------*/

function GerarReceita()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$check_sql = "SELECT IdContaCaixaLancamentoReceitaNotaFiscal, IdPlanoContaLancamentoReceitaNotaFiscal, IdTipoEspecieLancamentoReceitaNotaFiscal,c.IdProposta FROM configuracao 
INNER JOIN contrato c on (c.IdProposta = $this->idproposta )
WHERE IdConfiguracao = (select min(IdConfiguracao) FROM configuracao WHERE IdTenacidade='$this->sc_temp_varIdTenacidade')";
 
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


if ($this->rs === false) {
    $IdContaCaixa = '';
    $IdPlanoConta = '';
    $IdTipoEspecie = '';
	$IdContrato = '';
}
elseif (empty($this->rs)) {
    $IdContaCaixa = '';
    $IdPlanoConta = '';
    $IdTipoEspecie = '';
	$IdContrato = '';
}
else {
    $IdContaCaixa = $this->rs[0][0];
    $IdPlanoConta = $this->rs[0][1];
    $IdTipoEspecie = $this->rs[0][2];
	$IdContrato = $this->rs[0][3];
}

if ($this->qtdparcelas  > 1) {
	
	$valorParcela = $this->valorpropostaunica /$this->qtdparcelas ;
	
	for ($i = 0; $i < $this->qtdparcelas ; $i++) {
		
		
	
	}


} else {
	
	$sql = "INSERT INTO lancamentoreceita (IdTenacidade, IdCliente, IdContaCaixa, IdPlanoConta, IdSituacaoDocumento, IdTipoEspecie,IdEmpresa, DataInclusao, IdUsuarioInclusao, DataPrevisao, IdUsuarioPrevisao, ValorPrevisao, IdContrato) VALUES ($this->sc_temp_varIdTenacidade,$this->idcliente , " . $IdContaCaixa . ", " . $IdPlanoConta . ",'1'," . $IdTipoEspecie . ", $this->idempresa , now(), $this->idusuariofechamento , DATE_ADD(CURDATE(), INTERVAL 30 DAY), $this->idusuariofechamento , $this->valorpropostaunica ,".$IdContrato.")";
	
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                Proposta_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	
	}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: GerarReceita ------*/


/*----- Scriptcase Locale: PHP Method: NumeroExtenso ------*/

function NumeroExtenso($Numero)
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
$Extenso = '(?)';
switch ($Numero) {
    case 1:
        $Extenso = ' (um)';
        break;
    case 2:
        $Extenso = ' (dois)';
        break;
    case 3:
        $Extenso = ' (três)';
        break;
    case 4:
        $Extenso = ' (quatro)';
        break;
    case 5:
        $Extenso = ' (cinco)';
        break;
    case 6:
        $Extenso = ' (seis)';
        break;
    case 7:
        $Extenso = ' (sete)';
        break;
    case 8:
        $Extenso = ' (oito)';
        break;
    case 9:
        $Extenso = ' (nove)';
        break;
    case 10:
        $Extenso = ' (dez)';
        break;
    case 11:
        $Extenso = ' (onze)';
        break;
    case 12:
        $Extenso = ' (doze)';
        break;
    case 13:
        $Extenso = ' (treze)';
        break;
    case 14:
        $Extenso = ' (quatorze)';
        break;
    case 15:
        $Extenso = ' (quinze)';
        break;
    case 16:
        $Extenso = ' (dezesseis)';
        break;
    case 17:
        $Extenso = ' (dezessete)';
        break;
    case 18:
        $Extenso = ' (dezoito)';
        break;
    case 19:
        $Extenso = ' (dezenove)';
        break;
    case 20:
        $Extenso = ' (vinte)';
        break;
    case 21:
        $Extenso = ' (vinte e um)';
        break;
    case 22:
        $Extenso = ' (vinte e dois)';
        break;
    case 23:
        $Extenso = ' (vinte e três)';
        break;
    case 24:
        $Extenso = ' (vinte e quatro)';
        break;
    case 25:
        $Extenso = ' (vinte e cinco)';
        break;
    case 26:
        $Extenso = ' (vinte e seis)';
        break;
    case 27:
        $Extenso = ' (vinte e sete)';
        break;
    case 28:
        $Extenso = ' (vinte e oito)';
        break;
    case 29:
        $Extenso = ' (vinte e nove)';
        break;
    case 30:
        $Extenso = ' (trinta)';
        break;
	case 31:
        $Extenso = ' (trinta e um)';
        break;
}
return $Extenso;

$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: NumeroExtenso ------*/


/*----- Scriptcase Locale: Ajax Event QtdParcelas_onChange ------*/

function QtdParcelas_onChange()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
$original_qtdparcelas = $this->qtdparcelas;
$original_formapagamento = $this->formapagamento;
$original_diavencimento = $this->diavencimento;


$this->AcertarFormaPagamento();

$modificado_qtdparcelas = $this->qtdparcelas;
$modificado_formapagamento = $this->formapagamento;
$modificado_diavencimento = $this->diavencimento;
$this->nm_formatar_campos('qtdparcelas', 'formapagamento', 'diavencimento');
if ($original_qtdparcelas !== $modificado_qtdparcelas || isset($this->nmgp_cmp_readonly['qtdparcelas']) || (isset($bFlagRead_qtdparcelas) && $bFlagRead_qtdparcelas))
{
    $this->ajax_return_values_qtdparcelas(true);
}
if ($original_formapagamento !== $modificado_formapagamento || isset($this->nmgp_cmp_readonly['formapagamento']) || (isset($bFlagRead_formapagamento) && $bFlagRead_formapagamento))
{
    $this->ajax_return_values_formapagamento(true);
}
if ($original_diavencimento !== $modificado_diavencimento || isset($this->nmgp_cmp_readonly['diavencimento']) || (isset($bFlagRead_diavencimento) && $bFlagRead_diavencimento))
{
    $this->ajax_return_values_diavencimento(true);
}
$this->NM_ajax_info['event_field'] = 'QtdParcelas';
Proposta_Frm_pack_ajax_response();
exit;


$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event QtdParcelas_onChange ------*/


/*----- Scriptcase Locale: Ajax Event SituacaoProposta_onChange ------*/

function SituacaoProposta_onChange()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
$original_situacaoproposta = $this->situacaoproposta;

if ($this->situacaoproposta  == 'A' || $this->situacaoproposta  == 'S') {
  	$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Aprovada em*";	
  	$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Aprovada por*";	
	$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Comentarios da Aprovacao";	
} else {
	if ($this->situacaoproposta  == 'R') {
  		$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Reprovada em*";	
  		$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Reprovada por*";	
	  	$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Motivo da Reprovacao*";	
	} else {
		if ($this->situacaoproposta  == 'C') {
  			$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Cancelada em*";	
  			$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Cancelada por*";	
	  		$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Motivo do Cancelamento*";	
		}
		else {
  			$sc_tmp_field_name = 'datafechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Fechada em";	
  			$sc_tmp_field_name = 'idusuariofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Fechada por";	
	  		$sc_tmp_field_name = 'motivofechamento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] = "Motivo do Fechamento";	
		}
	}
}

$modificado_situacaoproposta = $this->situacaoproposta;
$this->nm_formatar_campos('situacaoproposta');
if ($original_situacaoproposta !== $modificado_situacaoproposta || isset($this->nmgp_cmp_readonly['situacaoproposta']) || (isset($bFlagRead_situacaoproposta) && $bFlagRead_situacaoproposta))
{
    $this->ajax_return_values_situacaoproposta(true);
}
$this->NM_ajax_info['event_field'] = 'SituacaoProposta';
Proposta_Frm_pack_ajax_response();
exit;
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event SituacaoProposta_onChange ------*/


/*----- Scriptcase Locale: Ajax Event ValorDescontoMensal_onBlur ------*/

function ValorDescontoMensal_onBlur()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
$original_idproposta = $this->idproposta;
$original_valorpropostaunica = $this->valorpropostaunica;
$original_valorpropostamensal = $this->valorpropostamensal;
$original_valordescontounico = $this->valordescontounico;
$original_valordescontomensal = $this->valordescontomensal;

$this->AtualizarValorProposta();

$modificado_idproposta = $this->idproposta;
$modificado_valorpropostaunica = $this->valorpropostaunica;
$modificado_valorpropostamensal = $this->valorpropostamensal;
$modificado_valordescontounico = $this->valordescontounico;
$modificado_valordescontomensal = $this->valordescontomensal;
$this->nm_formatar_campos('idproposta', 'valorpropostaunica', 'valorpropostamensal', 'valordescontounico', 'valordescontomensal');
if ($original_idproposta !== $modificado_idproposta || isset($this->nmgp_cmp_readonly['idproposta']) || (isset($bFlagRead_idproposta) && $bFlagRead_idproposta))
{
    $this->ajax_return_values_idproposta(true);
}
if ($original_valorpropostaunica !== $modificado_valorpropostaunica || isset($this->nmgp_cmp_readonly['valorpropostaunica']) || (isset($bFlagRead_valorpropostaunica) && $bFlagRead_valorpropostaunica))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostaunica'] = $this->valorpropostaunica;
    $this->ajax_return_values_valorpropostaunica(true);
}
if ($original_valorpropostamensal !== $modificado_valorpropostamensal || isset($this->nmgp_cmp_readonly['valorpropostamensal']) || (isset($bFlagRead_valorpropostamensal) && $bFlagRead_valorpropostamensal))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostamensal'] = $this->valorpropostamensal;
    $this->ajax_return_values_valorpropostamensal(true);
}
if ($original_valordescontounico !== $modificado_valordescontounico || isset($this->nmgp_cmp_readonly['valordescontounico']) || (isset($bFlagRead_valordescontounico) && $bFlagRead_valordescontounico))
{
    $this->ajax_return_values_valordescontounico(true);
}
if ($original_valordescontomensal !== $modificado_valordescontomensal || isset($this->nmgp_cmp_readonly['valordescontomensal']) || (isset($bFlagRead_valordescontomensal) && $bFlagRead_valordescontomensal))
{
    $this->ajax_return_values_valordescontomensal(true);
}
$this->NM_ajax_info['event_field'] = 'ValorDescontoMensal';
Proposta_Frm_pack_ajax_response();
exit;


$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event ValorDescontoMensal_onBlur ------*/


/*----- Scriptcase Locale: Ajax Event ValorDescontoUnico_onBlur ------*/

function ValorDescontoUnico_onBlur()
{
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  
$original_idproposta = $this->idproposta;
$original_valorpropostaunica = $this->valorpropostaunica;
$original_valorpropostamensal = $this->valorpropostamensal;
$original_valordescontounico = $this->valordescontounico;
$original_valordescontomensal = $this->valordescontomensal;

$this->AtualizarValorProposta();

$modificado_idproposta = $this->idproposta;
$modificado_valorpropostaunica = $this->valorpropostaunica;
$modificado_valorpropostamensal = $this->valorpropostamensal;
$modificado_valordescontounico = $this->valordescontounico;
$modificado_valordescontomensal = $this->valordescontomensal;
$this->nm_formatar_campos('idproposta', 'valorpropostaunica', 'valorpropostamensal', 'valordescontounico', 'valordescontomensal');
if ($original_idproposta !== $modificado_idproposta || isset($this->nmgp_cmp_readonly['idproposta']) || (isset($bFlagRead_idproposta) && $bFlagRead_idproposta))
{
    $this->ajax_return_values_idproposta(true);
}
if ($original_valorpropostaunica !== $modificado_valorpropostaunica || isset($this->nmgp_cmp_readonly['valorpropostaunica']) || (isset($bFlagRead_valorpropostaunica) && $bFlagRead_valorpropostaunica))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostaunica'] = $this->valorpropostaunica;
    $this->ajax_return_values_valorpropostaunica(true);
}
if ($original_valorpropostamensal !== $modificado_valorpropostamensal || isset($this->nmgp_cmp_readonly['valorpropostamensal']) || (isset($bFlagRead_valorpropostamensal) && $bFlagRead_valorpropostamensal))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dados_form']['valorpropostamensal'] = $this->valorpropostamensal;
    $this->ajax_return_values_valorpropostamensal(true);
}
if ($original_valordescontounico !== $modificado_valordescontounico || isset($this->nmgp_cmp_readonly['valordescontounico']) || (isset($bFlagRead_valordescontounico) && $bFlagRead_valordescontounico))
{
    $this->ajax_return_values_valordescontounico(true);
}
if ($original_valordescontomensal !== $modificado_valordescontomensal || isset($this->nmgp_cmp_readonly['valordescontomensal']) || (isset($bFlagRead_valordescontomensal) && $bFlagRead_valordescontomensal))
{
    $this->ajax_return_values_valordescontomensal(true);
}
$this->NM_ajax_info['event_field'] = 'ValorDescontoUnico';
Proposta_Frm_pack_ajax_response();
exit;


$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event ValorDescontoUnico_onBlur ------*/


/*----- Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/

function Gravar_Tabela_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
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
                Proposta_Frm_pack_ajax_response();
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
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: CalcularValorProposta.php ------*/

function CalcularValorProposta($parIdProposta, &$parValorPropostaUnica, &$parValorPropostaMensal){
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
  

	 
      $nm_select = "SELECT pr.IdTipoCobranca, pr.CreditoDebito, pi.Quantidade, pi.ValorUnitario FROM 
						   propostaitem pi
						   INNER JOIN produto pr ON (pr.IdProduto = pi.IdProduto)
						   WHERE IdProposta =  '$parIdProposta'"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->meus_dados = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados = false;
          $this->meus_dados_erro = $this->Db->ErrorMsg();
      } 

	if ($this->meus_dados  === false) {
		
		echo "Erro de acesso. Mensagem = " . $this->meus_dados_erro ;
	
	} else {	
		
		$ValorTotalUnica = 0;
		$ValorTotalMensal = 0;
		
		while (!$this->meus_dados->EOF) {
			if ($this->meus_dados->fields[0] == 1) {
				if ($this->meus_dados->fields[1] == 'C') {
					$ValorTotalUnica = $ValorTotalUnica + ($this->meus_dados->fields[2] * $this->meus_dados->fields[3]);
				}
				else {
					$ValorTotalUnica = $ValorTotalUnica - ($this->meus_dados->fields[2] * $this->meus_dados->fields[3]);
				}
			}
			else {
				if ($this->meus_dados->fields[0] == 2) {
					if ($this->meus_dados->fields[1] == 'C') {
						$ValorTotalMensal = $ValorTotalMensal + ($this->meus_dados->fields[2] * $this->meus_dados->fields[3]);
					}
					else {
						$ValorTotalMensal = $ValorTotalMensal - ($this->meus_dados->fields[2] * $this->meus_dados->fields[3]);
					}
				}
			}
			$this->meus_dados->MoveNext();
		}
	}	
	
	
	 
      $nm_select = "SELECT p.ValorDescontoUnico, p.ValorDescontoMensal FROM proposta p WHERE p.IdProposta = '$parIdProposta'"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->meus_dados_desconto = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->meus_dados_desconto = false;
          $this->meus_dados_desconto_erro = $this->Db->ErrorMsg();
      } 

	
 $parValorPropostaUnica = 0;
 $parValorPropostaMensal = 0;
	

	if ($this->meus_dados_desconto  === false) {
		echo "Erro de acesso. Mensagem = " . $this->meus_dados_desconto_erro ;
	} else {
		
		while (!$this->meus_dados_desconto->EOF) {			
			if ($this->meus_dados_desconto->fields[0] > 0) {
				$parValorPropostaUnica = $ValorTotalUnica - ($ValorTotalUnica*($this->meus_dados_desconto->fields[0]/100));	
			} else {
				$parValorPropostaUnica = $ValorTotalUnica;
			}
			if ($this->meus_dados_desconto->fields[1] > 0) {
				$parValorPropostaMensal = $ValorTotalMensal - ($ValorTotalMensal*($this->meus_dados_desconto->fields[1]/100));	
			} else {
				$parValorPropostaMensal = $ValorTotalMensal;
			}					
			$this->meus_dados_desconto->MoveNext();
		}
	}
	
	$this->meus_dados_desconto->Close();
	$this->meus_dados->Close();
	
	return true;
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: CalcularValorProposta.php ------*/


/*----- Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

function Preparar_LstFrm_OnSrip_OnLoad_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'on';
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
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Field_disabled_macro']['idtenacidade'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("idusuarioauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Field_disabled_macro']['idusuarioauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("enderecoipauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Field_disabled_macro']['enderecoipauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("nomeaplicacaoauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Field_disabled_macro']['nomeaplicacaoauditoria'] = array('I'=>array(),'U'=>array());
;

			if ($this->sc_temp_varPrivAdmin != 1) {
				if ($this->sc_temp_varAcessoAuditoria != "S") {
					$this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes["Auditoria"] = 'off';;
				}
				if ($this->sc_temp_varAcessoAutorizacoes != "S") {
					$this->NM_ajax_info['buttonDisplay']['sc_btn_0'] = $this->nmgp_botoes["sc_btn_0"] = 'off';;
				}
				;
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
$_SESSION['scriptcase']['Proposta_Frm']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              Proposta_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit'] . "';";
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
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['download_filenames'][$sTmpFile_nomereferencia] = $this->nomereferencia;
   } 
        $this->initFormPages();
    include_once("Proposta_Frm_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idproposta", "idcliente", "idtipocontrato", "idindicereajuste", "idempresa", "idusuarioinclusao", "idusuariofechamento", "motivofechamento", "solicitante", "diavencimento", "diasvalidade", "situacaoproposta", "idcolaboradorimplantacao", "prazoentrega", "formapagamento", "observacoes", "nomearquivo", "historico", "produtos"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['csrf_token'];
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

   function Form_lookup_idempresa()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdEmpresa, RazaoSocial  FROM empresa WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY RazaoSocial";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idempresa'][] = $rs->fields[0];
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
   function Form_lookup_idtipocontrato()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdTipoContrato, Descricao  FROM tipocontrato  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND Ativo = 'S' ORDER BY Descricao";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idtipocontrato'][] = $rs->fields[0];
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
   function Form_lookup_idusuarioinclusao()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Nome";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuarioinclusao'][] = $rs->fields[0];
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
   function Form_lookup_situacaoproposta()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Pendente?#?P?#?S?@?";
       $nmgp_def_dados .= "Aprovada, aguardando assinatura?#?S?#?N?@?";
       $nmgp_def_dados .= "Aprovada e assinada?#?A?#?N?@?";
       $nmgp_def_dados .= "Reprovada?#?R?#?N?@?";
       $nmgp_def_dados .= "Cancelada?#?C?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_idindicereajuste()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdIndiceReajuste, Descricao  FROM indicereajuste  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idindicereajuste'][] = $rs->fields[0];
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
   function Form_lookup_idusuariofechamento()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'] = array(); 
    }

   $old_value_idcliente = $this->idcliente;
   $old_value_idproposta = $this->idproposta;
   $old_value_datainclusao = $this->datainclusao;
   $old_value_datainclusao_hora = $this->datainclusao_hora;
   $old_value_diavencimento = $this->diavencimento;
   $old_value_diasvalidade = $this->diasvalidade;
   $old_value_idcontrato = $this->idcontrato;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valordescontounico = $this->valordescontounico;
   $old_value_valordescontomensal = $this->valordescontomensal;
   $old_value_valorpropostaunica = $this->valorpropostaunica;
   $old_value_valorpropostamensal = $this->valorpropostamensal;
   $old_value_datafechamento = $this->datafechamento;
   $old_value_datafechamento_hora = $this->datafechamento_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_idproposta = $this->idproposta;
   $unformatted_value_datainclusao = $this->datainclusao;
   $unformatted_value_datainclusao_hora = $this->datainclusao_hora;
   $unformatted_value_diavencimento = $this->diavencimento;
   $unformatted_value_diasvalidade = $this->diasvalidade;
   $unformatted_value_idcontrato = $this->idcontrato;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valordescontounico = $this->valordescontounico;
   $unformatted_value_valordescontomensal = $this->valordescontomensal;
   $unformatted_value_valorpropostaunica = $this->valorpropostaunica;
   $unformatted_value_valorpropostamensal = $this->valorpropostamensal;
   $unformatted_value_datafechamento = $this->datafechamento;
   $unformatted_value_datafechamento_hora = $this->datafechamento_hora;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Nome";

   $this->idcliente = $old_value_idcliente;
   $this->idproposta = $old_value_idproposta;
   $this->datainclusao = $old_value_datainclusao;
   $this->datainclusao_hora = $old_value_datainclusao_hora;
   $this->diavencimento = $old_value_diavencimento;
   $this->diasvalidade = $old_value_diasvalidade;
   $this->idcontrato = $old_value_idcontrato;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valordescontounico = $old_value_valordescontounico;
   $this->valordescontomensal = $old_value_valordescontomensal;
   $this->valorpropostaunica = $old_value_valorpropostaunica;
   $this->valorpropostamensal = $old_value_valorpropostamensal;
   $this->datafechamento = $old_value_datafechamento;
   $this->datafechamento_hora = $old_value_datafechamento_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['Lookup_idusuariofechamento'][] = $rs->fields[0];
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              Proposta_Frm_pack_ajax_response();
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
              $this->SC_monta_condicao($comando, "IdProposta", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idcliente($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdCliente", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idtipocontrato($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdTipoContrato", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idindicereajuste($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdIndiceReajuste", $arg_search, $data_lookup, "BIGINT", false);
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
              $data_lookup = $this->SC_lookup_idusuarioinclusao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioInclusao", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idusuariofechamento($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioFechamento", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "MotivoFechamento", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Solicitante", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DiaVencimento", $arg_search, str_replace(",", ".", $data_search), "SMALLINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DiasValidade", $arg_search, str_replace(",", ".", $data_search), "SMALLINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_situacaoproposta($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "SituacaoProposta", $arg_search, $data_lookup, "CHAR", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idcolaboradorimplantacao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdColaboradorImplantacao", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "PrazoEntrega", $arg_search, $data_search, "TEXT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "FormaPagamento", $arg_search, $data_search, "TEXT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Observacoes", $arg_search, $data_search, "TEXT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "NomeArquivo", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Historico", $arg_search, $data_search, "TEXT", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter_form'] . " and (" . $comando . ")";
      }
      else
      {
         $sc_where = " where " . $comando;
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_Proposta_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] = $qt_geral_reg_Proposta_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          Proposta_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          Proposta_Frm_pack_ajax_response();
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
      $nm_numeric[] = "idproposta";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idcliente";$nm_numeric[] = "idtipocontrato";$nm_numeric[] = "idindicereajuste";$nm_numeric[] = "idempresa";$nm_numeric[] = "idcontrato";$nm_numeric[] = "idusuarioinclusao";$nm_numeric[] = "idusuariofechamento";$nm_numeric[] = "idcolaboradorimplantacao";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "diavencimento";$nm_numeric[] = "diasvalidade";$nm_numeric[] = "valordescontounico";$nm_numeric[] = "valordescontomensal";$nm_numeric[] = "qtdparcelas";$nm_numeric[] = "";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['decimal_db'] == ".")
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
      $Nm_datas["datainclusao"] = "datetime";$Nm_datas["datafechamento"] = "datetime";$Nm_datas["datainicioimplantacao"] = "datetime";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['SC_sep_date1'];
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
   function SC_lookup_idcliente($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Descricao, IdCliente FROM clienteempresa_view WHERE (CAST (IdCliente AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT Descricao, IdCliente FROM clienteempresa_view WHERE (#cmp_iDescricao#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
   function SC_lookup_idtipocontrato($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Descricao, IdTipoContrato FROM tipocontrato WHERE (CAST (IdTipoContrato AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND (Ativo = 'S')" ; 
       }
       else
       {
           $nm_comando = "SELECT Descricao, IdTipoContrato FROM tipocontrato WHERE (#cmp_iDescricao#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND (Ativo = 'S')" ; 
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
   function SC_lookup_idindicereajuste($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Descricao, IdIndiceReajuste FROM indicereajuste WHERE (CAST (IdIndiceReajuste AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT Descricao, IdIndiceReajuste FROM indicereajuste WHERE (#cmp_iDescricao#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
           $nm_comando = "SELECT RazaoSocial, IdEmpresa FROM empresa WHERE (CAST (IdEmpresa AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT RazaoSocial, IdEmpresa FROM empresa WHERE (#cmp_iRazaoSocial#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
           $nm_comando = "SELECT Nome, IdUsuario FROM usuario WHERE (CAST (IdUsuario AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT Nome, IdUsuario FROM usuario WHERE (#cmp_iNome#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
   function SC_lookup_idusuariofechamento($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Nome, IdUsuario FROM usuario WHERE (CAST (IdUsuario AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT Nome, IdUsuario FROM usuario WHERE (#cmp_iNome#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
   function SC_lookup_situacaoproposta($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['P'] = "Pendente";
       $data_look['S'] = "Aprovada, aguardando assinatura";
       $data_look['A'] = "Aprovada e assinada";
       $data_look['R'] = "Reprovada";
       $data_look['C'] = "Cancelada";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
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
          
       }
       return $result;
   }
   function SC_lookup_idcolaboradorimplantacao($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Nome, IdColaborador FROM colaborador WHERE (CAST (IdColaborador AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT Nome, IdColaborador FROM colaborador WHERE (#cmp_iNome#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
       $nmgp_saida_form = "Proposta_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "Proposta_Frm_fim.php";
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
       Proposta_Frm_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['masterValue']);
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['PropostaItem_Gde']['reg_start'] = "";
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['PropostaItem_Gde']['total']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           Proposta_Frm_pack_ajax_response();
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
       Proposta_Frm_pack_ajax_response();
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
    function sc_set_focus($sFieldName)
    {
        $sFieldName = strtolower($sFieldName);
        $aFocus = array(
                        'idempresa' => 'idempresa',
                        'idcliente' => 'id_ac_idcliente',
                        'idtipocontrato' => 'idtipocontrato',
                        'idproposta' => 'idproposta',
                        'solicitante' => 'solicitante',
                        'datainclusao' => 'datainclusao',
                        'idusuarioinclusao' => 'idusuarioinclusao',
                        'situacaoproposta' => 'situacaoproposta',
                        'prazoentrega' => 'prazoentrega',
                        'formapagamento' => 'formapagamento',
                        'diavencimento' => 'diavencimento',
                        'diasvalidade' => 'diasvalidade',
                        'idindicereajuste' => 'idindicereajuste',
                        'idcontrato' => 'idcontrato',
                        'qtdparcelas' => 'qtdparcelas',
                        'valordescontounico' => 'valordescontounico',
                        'motivodescontounico' => 'motivodescontounico',
                        'valordescontomensal' => 'valordescontomensal',
                        'motivodescontomensal' => 'motivodescontomensal',
                        'valorpropostaunica' => 'valorpropostaunica',
                        'valorpropostamensal' => 'valorpropostamensal',
                        'datafechamento' => 'datafechamento',
                        'idusuariofechamento' => 'idusuariofechamento',
                        'motivofechamento' => 'motivofechamento',
                        'observacoes' => 'observacoes',
                        'produtos' => 'produtos',
                        'andamento' => 'andamento',
                        'nomereferencia' => 'nomereferencia',
                        'nomearquivo' => 'nomearquivo',
                       );
        if (isset($aFocus[$sFieldName]))
        {
            $this->NM_ajax_info['focus'] = $aFocus[$sFieldName];
        }
    } // sc_set_focus
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
        if ('datainclusao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('datafechamento' == $sField)
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
            case "imprimir":
                return array("sc_Imprimir_top");
                break;
            case "sc_btn_1":
                return array("sc_sc_btn_1_top");
                break;
            case "reabrir":
                return array("sc_Reabrir_top");
                break;
            case "auditoria":
                return array("sc_Auditoria_top");
                break;
            case "sc_btn_0":
                return array("sc_sc_btn_0_top");
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " Proposta"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Proposta"; } ?></span></td>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['link_info']['compact_mode']) {
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['Proposta_Frm']['ordem_ord'] == " desc") {
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
            case "IdCliente":
                return true;
            case "IdProposta":
                return true;
            case "DiaVencimento":
                return true;
            case "DiasValidade":
                return true;
            case "IdContrato":
                return true;
            case "QtdParcelas":
                return true;
            case "ValorDescontoUnico":
                return true;
            case "ValorDescontoMensal":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "IdTenacidade":
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
