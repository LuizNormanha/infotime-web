<?php
//
class NotaFiscal_Frm_apl
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
   var $idnotafiscal;
   var $idtenacidade;
   var $idcliente;
   var $idsituacaodocumento;
   var $idsituacaodocumento_1;
   var $idempresa;
   var $idempresa_1;
   var $idlancamentoreceita;
   var $idplanoconta;
   var $idplanoconta_1;
   var $idusuarioauditoria;
   var $idusuariocancelamento;
   var $datacompetencia;
   var $numeronotafiscal;
   var $codigoverificacao;
   var $dataemissao;
   var $dataemissao_hora;
   var $idusuarioemissao;
   var $idusuarioemissao_1;
   var $datavencimento;
   var $valornotafiscal;
   var $valoriss;
   var $valorliquido;
   var $databaixa;
   var $datarecebimento;
   var $idusuariobaixa;
   var $idusuariobaixa_1;
   var $valorbaixa;
   var $discriminacao;
   var $competenciasimples;
   var $nomearquivo;
   var $nomereferencia;
   var $nomereferencia_scfile_name;
   var $nomereferencia_ul_name;
   var $nomereferencia_ul_type;
   var $nomereferencia_limpa;
   var $nomereferencia_salva;
   var $nomearquivoboleto;
   var $nomereferenciaboleto;
   var $nomereferenciaboleto_scfile_name;
   var $nomereferenciaboleto_ul_name;
   var $nomereferenciaboleto_ul_type;
   var $nomereferenciaboleto_limpa;
   var $nomereferenciaboleto_salva;
   var $dataliberacaoboleto;
   var $dataliberacaoboleto_hora;
   var $nomearquivoxml;
   var $nomereferenciaxml;
   var $nomereferenciaxml_scfile_name;
   var $nomereferenciaxml_ul_name;
   var $nomereferenciaxml_ul_type;
   var $nomereferenciaxml_limpa;
   var $nomereferenciaxml_salva;
   var $boletoliberado;
   var $numerolote;
   var $protocolo;
   var $datarecebimentonota;
   var $datarecebimentonota_hora;
   var $numeronotafiscalcompleto;
   var $enderecoipauditoria;
   var $nomeaplicacaoauditoria;
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
          if (isset($this->NM_ajax_info['param']['boletoliberado']))
          {
              $this->boletoliberado = $this->NM_ajax_info['param']['boletoliberado'];
          }
          if (isset($this->NM_ajax_info['param']['codigoverificacao']))
          {
              $this->codigoverificacao = $this->NM_ajax_info['param']['codigoverificacao'];
          }
          if (isset($this->NM_ajax_info['param']['competenciasimples']))
          {
              $this->competenciasimples = $this->NM_ajax_info['param']['competenciasimples'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['databaixa']))
          {
              $this->databaixa = $this->NM_ajax_info['param']['databaixa'];
          }
          if (isset($this->NM_ajax_info['param']['datacompetencia']))
          {
              $this->datacompetencia = $this->NM_ajax_info['param']['datacompetencia'];
          }
          if (isset($this->NM_ajax_info['param']['datarecebimento']))
          {
              $this->datarecebimento = $this->NM_ajax_info['param']['datarecebimento'];
          }
          if (isset($this->NM_ajax_info['param']['datarecebimentonota']))
          {
              $this->datarecebimentonota = $this->NM_ajax_info['param']['datarecebimentonota'];
          }
          if (isset($this->NM_ajax_info['param']['datarecebimentonota_hora']))
          {
              $this->datarecebimentonota_hora = $this->NM_ajax_info['param']['datarecebimentonota_hora'];
          }
          if (isset($this->NM_ajax_info['param']['datavencimento']))
          {
              $this->datavencimento = $this->NM_ajax_info['param']['datavencimento'];
          }
          if (isset($this->NM_ajax_info['param']['discriminacao']))
          {
              $this->discriminacao = $this->NM_ajax_info['param']['discriminacao'];
          }
          if (isset($this->NM_ajax_info['param']['idcliente']))
          {
              $this->idcliente = $this->NM_ajax_info['param']['idcliente'];
          }
          if (isset($this->NM_ajax_info['param']['idempresa']))
          {
              $this->idempresa = $this->NM_ajax_info['param']['idempresa'];
          }
          if (isset($this->NM_ajax_info['param']['idlancamentoreceita']))
          {
              $this->idlancamentoreceita = $this->NM_ajax_info['param']['idlancamentoreceita'];
          }
          if (isset($this->NM_ajax_info['param']['idnotafiscal']))
          {
              $this->idnotafiscal = $this->NM_ajax_info['param']['idnotafiscal'];
          }
          if (isset($this->NM_ajax_info['param']['idplanoconta']))
          {
              $this->idplanoconta = $this->NM_ajax_info['param']['idplanoconta'];
          }
          if (isset($this->NM_ajax_info['param']['idsituacaodocumento']))
          {
              $this->idsituacaodocumento = $this->NM_ajax_info['param']['idsituacaodocumento'];
          }
          if (isset($this->NM_ajax_info['param']['idusuariobaixa']))
          {
              $this->idusuariobaixa = $this->NM_ajax_info['param']['idusuariobaixa'];
          }
          if (isset($this->NM_ajax_info['param']['idusuariocancelamento']))
          {
              $this->idusuariocancelamento = $this->NM_ajax_info['param']['idusuariocancelamento'];
          }
          if (isset($this->NM_ajax_info['param']['idusuarioemissao']))
          {
              $this->idusuarioemissao = $this->NM_ajax_info['param']['idusuarioemissao'];
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
          if (isset($this->NM_ajax_info['param']['nomearquivoboleto']))
          {
              $this->nomearquivoboleto = $this->NM_ajax_info['param']['nomearquivoboleto'];
          }
          if (isset($this->NM_ajax_info['param']['nomearquivoxml']))
          {
              $this->nomearquivoxml = $this->NM_ajax_info['param']['nomearquivoxml'];
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
          if (isset($this->NM_ajax_info['param']['nomereferenciaboleto']))
          {
              $this->nomereferenciaboleto = $this->NM_ajax_info['param']['nomereferenciaboleto'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaboleto_limpa']))
          {
              $this->nomereferenciaboleto_limpa = $this->NM_ajax_info['param']['nomereferenciaboleto_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaboleto_salva']))
          {
              $this->nomereferenciaboleto_salva = $this->NM_ajax_info['param']['nomereferenciaboleto_salva'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaboleto_ul_name']))
          {
              $this->nomereferenciaboleto_ul_name = $this->NM_ajax_info['param']['nomereferenciaboleto_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaboleto_ul_type']))
          {
              $this->nomereferenciaboleto_ul_type = $this->NM_ajax_info['param']['nomereferenciaboleto_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaxml']))
          {
              $this->nomereferenciaxml = $this->NM_ajax_info['param']['nomereferenciaxml'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaxml_limpa']))
          {
              $this->nomereferenciaxml_limpa = $this->NM_ajax_info['param']['nomereferenciaxml_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaxml_salva']))
          {
              $this->nomereferenciaxml_salva = $this->NM_ajax_info['param']['nomereferenciaxml_salva'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaxml_ul_name']))
          {
              $this->nomereferenciaxml_ul_name = $this->NM_ajax_info['param']['nomereferenciaxml_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['nomereferenciaxml_ul_type']))
          {
              $this->nomereferenciaxml_ul_type = $this->NM_ajax_info['param']['nomereferenciaxml_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['numerolote']))
          {
              $this->numerolote = $this->NM_ajax_info['param']['numerolote'];
          }
          if (isset($this->NM_ajax_info['param']['numeronotafiscal']))
          {
              $this->numeronotafiscal = $this->NM_ajax_info['param']['numeronotafiscal'];
          }
          if (isset($this->NM_ajax_info['param']['numeronotafiscalcompleto']))
          {
              $this->numeronotafiscalcompleto = $this->NM_ajax_info['param']['numeronotafiscalcompleto'];
          }
          if (isset($this->NM_ajax_info['param']['protocolo']))
          {
              $this->protocolo = $this->NM_ajax_info['param']['protocolo'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['valorbaixa']))
          {
              $this->valorbaixa = $this->NM_ajax_info['param']['valorbaixa'];
          }
          if (isset($this->NM_ajax_info['param']['valoriss']))
          {
              $this->valoriss = $this->NM_ajax_info['param']['valoriss'];
          }
          if (isset($this->NM_ajax_info['param']['valorliquido']))
          {
              $this->valorliquido = $this->NM_ajax_info['param']['valorliquido'];
          }
          if (isset($this->NM_ajax_info['param']['valornotafiscal']))
          {
              $this->valornotafiscal = $this->NM_ajax_info['param']['valornotafiscal'];
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
      if (isset($this->varNotaFiscal_IdCliente) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varNotaFiscal_IdCliente'] = $this->varNotaFiscal_IdCliente;
      }
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varDiretorioArquivo) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varDiretorioArquivo'] = $this->varDiretorioArquivo;
      }
      if (isset($this->varIdLancamentoReceita) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
      }
      if (isset($this->varPrimeiraVez) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (isset($this->varNomeReferencia) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
      }
      if (isset($this->varNomeReferenciaBoleto) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varNomeReferenciaBoleto'] = $this->varNomeReferenciaBoleto;
      }
      if (isset($this->varPrivAdmin) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
      }
      if (isset($_POST["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
      }
      if (isset($_POST["varNotaFiscal_IdCliente"]) && isset($this->varNotaFiscal_IdCliente)) 
      {
          $_SESSION['varNotaFiscal_IdCliente'] = $this->varNotaFiscal_IdCliente;
      }
      if (!isset($_POST["varNotaFiscal_IdCliente"]) && isset($_POST["varnotafiscal_idcliente"])) 
      {
          $_SESSION['varNotaFiscal_IdCliente'] = $_POST["varnotafiscal_idcliente"];
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
      if (isset($_POST["varIdLancamentoReceita"]) && isset($this->varIdLancamentoReceita)) 
      {
          $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
      }
      if (!isset($_POST["varIdLancamentoReceita"]) && isset($_POST["varidlancamentoreceita"])) 
      {
          $_SESSION['varIdLancamentoReceita'] = $_POST["varidlancamentoreceita"];
      }
      if (isset($_POST["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_POST["varPrimeiraVez"]) && isset($_POST["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_POST["varprimeiravez"];
      }
      if (isset($_POST["varIdSituacaoDocumentoPendenteInt"]) && isset($this->varIdSituacaoDocumentoPendenteInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (!isset($_POST["varIdSituacaoDocumentoPendenteInt"]) && isset($_POST["varidsituacaodocumentopendenteint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_POST["varidsituacaodocumentopendenteint"];
      }
      if (isset($_POST["varNomeReferencia"]) && isset($this->varNomeReferencia)) 
      {
          $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
      }
      if (!isset($_POST["varNomeReferencia"]) && isset($_POST["varnomereferencia"])) 
      {
          $_SESSION['varNomeReferencia'] = $_POST["varnomereferencia"];
      }
      if (isset($_POST["varNomeReferenciaBoleto"]) && isset($this->varNomeReferenciaBoleto)) 
      {
          $_SESSION['varNomeReferenciaBoleto'] = $this->varNomeReferenciaBoleto;
      }
      if (!isset($_POST["varNomeReferenciaBoleto"]) && isset($_POST["varnomereferenciaboleto"])) 
      {
          $_SESSION['varNomeReferenciaBoleto'] = $_POST["varnomereferenciaboleto"];
      }
      if (isset($_POST["varPrivAdmin"]) && isset($this->varPrivAdmin)) 
      {
          $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
      }
      if (!isset($_POST["varPrivAdmin"]) && isset($_POST["varprivadmin"])) 
      {
          $_SESSION['varPrivAdmin'] = $_POST["varprivadmin"];
      }
      if (isset($_GET["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
      }
      if (isset($_GET["varNotaFiscal_IdCliente"]) && isset($this->varNotaFiscal_IdCliente)) 
      {
          $_SESSION['varNotaFiscal_IdCliente'] = $this->varNotaFiscal_IdCliente;
      }
      if (!isset($_GET["varNotaFiscal_IdCliente"]) && isset($_GET["varnotafiscal_idcliente"])) 
      {
          $_SESSION['varNotaFiscal_IdCliente'] = $_GET["varnotafiscal_idcliente"];
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
      if (isset($_GET["varIdLancamentoReceita"]) && isset($this->varIdLancamentoReceita)) 
      {
          $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
      }
      if (!isset($_GET["varIdLancamentoReceita"]) && isset($_GET["varidlancamentoreceita"])) 
      {
          $_SESSION['varIdLancamentoReceita'] = $_GET["varidlancamentoreceita"];
      }
      if (isset($_GET["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_GET["varPrimeiraVez"]) && isset($_GET["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_GET["varprimeiravez"];
      }
      if (isset($_GET["varIdSituacaoDocumentoPendenteInt"]) && isset($this->varIdSituacaoDocumentoPendenteInt)) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
      }
      if (!isset($_GET["varIdSituacaoDocumentoPendenteInt"]) && isset($_GET["varidsituacaodocumentopendenteint"])) 
      {
          $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_GET["varidsituacaodocumentopendenteint"];
      }
      if (isset($_GET["varNomeReferencia"]) && isset($this->varNomeReferencia)) 
      {
          $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
      }
      if (!isset($_GET["varNomeReferencia"]) && isset($_GET["varnomereferencia"])) 
      {
          $_SESSION['varNomeReferencia'] = $_GET["varnomereferencia"];
      }
      if (isset($_GET["varNomeReferenciaBoleto"]) && isset($this->varNomeReferenciaBoleto)) 
      {
          $_SESSION['varNomeReferenciaBoleto'] = $this->varNomeReferenciaBoleto;
      }
      if (!isset($_GET["varNomeReferenciaBoleto"]) && isset($_GET["varnomereferenciaboleto"])) 
      {
          $_SESSION['varNomeReferenciaBoleto'] = $_GET["varnomereferenciaboleto"];
      }
      if (isset($_GET["varPrivAdmin"]) && isset($this->varPrivAdmin)) 
      {
          $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
      }
      if (!isset($_GET["varPrivAdmin"]) && isset($_GET["varprivadmin"])) 
      {
          $_SESSION['varPrivAdmin'] = $_GET["varprivadmin"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_parms']);
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
                 nm_limpa_str_NotaFiscal_Frm($cadapar[1]);
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
          if (!isset($this->varNotaFiscal_IdCliente) && isset($this->varnotafiscal_idcliente)) 
          {
              $this->varNotaFiscal_IdCliente = $this->varnotafiscal_idcliente;
          }
          if (isset($this->varNotaFiscal_IdCliente)) 
          {
              $_SESSION['varNotaFiscal_IdCliente'] = $this->varNotaFiscal_IdCliente;
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
          if (!isset($this->varIdLancamentoReceita) && isset($this->varidlancamentoreceita)) 
          {
              $this->varIdLancamentoReceita = $this->varidlancamentoreceita;
          }
          if (isset($this->varIdLancamentoReceita)) 
          {
              $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
          if (!isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->varidsituacaodocumentopendenteint)) 
          {
              $this->varIdSituacaoDocumentoPendenteInt = $this->varidsituacaodocumentopendenteint;
          }
          if (isset($this->varIdSituacaoDocumentoPendenteInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
          }
          if (!isset($this->varNomeReferencia) && isset($this->varnomereferencia)) 
          {
              $this->varNomeReferencia = $this->varnomereferencia;
          }
          if (isset($this->varNomeReferencia)) 
          {
              $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
          }
          if (!isset($this->varNomeReferenciaBoleto) && isset($this->varnomereferenciaboleto)) 
          {
              $this->varNomeReferenciaBoleto = $this->varnomereferenciaboleto;
          }
          if (isset($this->varNomeReferenciaBoleto)) 
          {
              $_SESSION['varNomeReferenciaBoleto'] = $this->varNomeReferenciaBoleto;
          }
          if (!isset($this->varPrivAdmin) && isset($this->varprivadmin)) 
          {
              $this->varPrivAdmin = $this->varprivadmin;
          }
          if (isset($this->varPrivAdmin)) 
          {
              $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['opc_ant']);
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varNotaFiscal_IdCliente) && isset($this->varnotafiscal_idcliente)) 
          {
              $this->varNotaFiscal_IdCliente = $this->varnotafiscal_idcliente;
          }
          if (isset($this->varNotaFiscal_IdCliente)) 
          {
              $_SESSION['varNotaFiscal_IdCliente'] = $this->varNotaFiscal_IdCliente;
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
          if (!isset($this->varIdLancamentoReceita) && isset($this->varidlancamentoreceita)) 
          {
              $this->varIdLancamentoReceita = $this->varidlancamentoreceita;
          }
          if (isset($this->varIdLancamentoReceita)) 
          {
              $_SESSION['varIdLancamentoReceita'] = $this->varIdLancamentoReceita;
          }
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
          if (!isset($this->varIdSituacaoDocumentoPendenteInt) && isset($this->varidsituacaodocumentopendenteint)) 
          {
              $this->varIdSituacaoDocumentoPendenteInt = $this->varidsituacaodocumentopendenteint;
          }
          if (isset($this->varIdSituacaoDocumentoPendenteInt)) 
          {
              $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->varIdSituacaoDocumentoPendenteInt;
          }
          if (!isset($this->varNomeReferencia) && isset($this->varnomereferencia)) 
          {
              $this->varNomeReferencia = $this->varnomereferencia;
          }
          if (isset($this->varNomeReferencia)) 
          {
              $_SESSION['varNomeReferencia'] = $this->varNomeReferencia;
          }
          if (!isset($this->varNomeReferenciaBoleto) && isset($this->varnomereferenciaboleto)) 
          {
              $this->varNomeReferenciaBoleto = $this->varnomereferenciaboleto;
          }
          if (isset($this->varNomeReferenciaBoleto)) 
          {
              $_SESSION['varNomeReferenciaBoleto'] = $this->varNomeReferenciaBoleto;
          }
          if (!isset($this->varPrivAdmin) && isset($this->varprivadmin)) 
          {
              $this->varPrivAdmin = $this->varprivadmin;
          }
          if (isset($this->varPrivAdmin)) 
          {
              $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new NotaFiscal_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
  $this->sc_temp_varPrimeiraVez = "";
$this->sc_temp_varIdTenacidade;
$this->sc_temp_varIdUsuario;
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['upload_field_info']['nomereferencia'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'NotaFiscal_Frm',
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

      $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['upload_field_info']['nomereferenciaboleto'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'NotaFiscal_Frm',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/.+$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'N1',
      );

      $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['upload_field_info']['nomereferenciaxml'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'NotaFiscal_Frm',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(xml)$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'N2',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['NotaFiscal_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['NotaFiscal_Frm'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['NotaFiscal_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['NotaFiscal_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['NotaFiscal_Frm']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Nota Fiscal";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "NotaFiscal_Frm")
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

      $this->arr_buttons['imprimirnotafiscal']['hint']             = "";
      $this->arr_buttons['imprimirnotafiscal']['type']             = "button";
      $this->arr_buttons['imprimirnotafiscal']['value']            = "Imprimir Nota Fiscal";
      $this->arr_buttons['imprimirnotafiscal']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['imprimirnotafiscal']['display_position'] = "text_right";
      $this->arr_buttons['imprimirnotafiscal']['style']            = "default";
      $this->arr_buttons['imprimirnotafiscal']['image']            = "";
      $this->arr_buttons['imprimirnotafiscal']['has_fa']            = "true";
      $this->arr_buttons['imprimirnotafiscal']['fontawesomeicon']            = "fas fa-print";

      $this->arr_buttons['cancelar']['hint']             = "";
      $this->arr_buttons['cancelar']['type']             = "button";
      $this->arr_buttons['cancelar']['value']            = "Cancelar Nota Fiscal";
      $this->arr_buttons['cancelar']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['cancelar']['display_position'] = "text_right";
      $this->arr_buttons['cancelar']['style']            = "default";
      $this->arr_buttons['cancelar']['image']            = "";
      $this->arr_buttons['cancelar']['has_fa']            = "true";
      $this->arr_buttons['cancelar']['fontawesomeicon']            = "fas fa-ban";

      $this->arr_buttons['gerarnota']['hint']             = "";
      $this->arr_buttons['gerarnota']['type']             = "button";
      $this->arr_buttons['gerarnota']['value']            = "Gerar Nota Fiscal";
      $this->arr_buttons['gerarnota']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['gerarnota']['display_position'] = "text_right";
      $this->arr_buttons['gerarnota']['style']            = "success";
      $this->arr_buttons['gerarnota']['image']            = "";
      $this->arr_buttons['gerarnota']['has_fa']            = "true";
      $this->arr_buttons['gerarnota']['fontawesomeicon']            = "far fa-file-lines";

      $this->arr_buttons['cancelarnotaportalnacional']['hint']             = "";
      $this->arr_buttons['cancelarnotaportalnacional']['type']             = "button";
      $this->arr_buttons['cancelarnotaportalnacional']['value']            = "Cancelar nota fiscal";
      $this->arr_buttons['cancelarnotaportalnacional']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['cancelarnotaportalnacional']['display_position'] = "text_right";
      $this->arr_buttons['cancelarnotaportalnacional']['style']            = "warning";
      $this->arr_buttons['cancelarnotaportalnacional']['image']            = "";
      $this->arr_buttons['cancelarnotaportalnacional']['has_fa']            = "true";
      $this->arr_buttons['cancelarnotaportalnacional']['fontawesomeicon']            = "fas fa-ban";


      $_SESSION['scriptcase']['error_icon']['NotaFiscal_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['NotaFiscal_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "NotaFiscal_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['nomereferencia_ul_name']) && '' != $this->NM_ajax_info['param']['nomereferencia_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->NM_ajax_info['param']['nomereferencia_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_scfile_name = substr($this->NM_ajax_info['param']['nomereferencia_ul_name'], 12);
          $this->nomereferencia_scfile_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
          $this->nomereferencia_ul_name = $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_ul_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
      }
      elseif (isset($this->nomereferencia_ul_name) && '' != $this->nomereferencia_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->nomereferencia_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->nomereferencia_ul_name;
          $this->nomereferencia_scfile_name = substr($this->nomereferencia_ul_name, 12);
          $this->nomereferencia_scfile_type = $this->nomereferencia_ul_type;
      }
      if (isset($this->NM_ajax_info['param']['nomereferenciaboleto_ul_name']) && '' != $this->NM_ajax_info['param']['nomereferenciaboleto_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaboleto_ul_name]))
          {
              $this->NM_ajax_info['param']['nomereferenciaboleto_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaboleto_ul_name];
          }
          $this->nomereferenciaboleto = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['nomereferenciaboleto_ul_name'];
          $this->nomereferenciaboleto_scfile_name = substr($this->NM_ajax_info['param']['nomereferenciaboleto_ul_name'], 12);
          $this->nomereferenciaboleto_scfile_type = $this->NM_ajax_info['param']['nomereferenciaboleto_ul_type'];
          $this->nomereferenciaboleto_ul_name = $this->NM_ajax_info['param']['nomereferenciaboleto_ul_name'];
          $this->nomereferenciaboleto_ul_type = $this->NM_ajax_info['param']['nomereferenciaboleto_ul_type'];
      }
      elseif (isset($this->nomereferenciaboleto_ul_name) && '' != $this->nomereferenciaboleto_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaboleto_ul_name]))
          {
              $this->nomereferenciaboleto_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaboleto_ul_name];
          }
          $this->nomereferenciaboleto = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->nomereferenciaboleto_ul_name;
          $this->nomereferenciaboleto_scfile_name = substr($this->nomereferenciaboleto_ul_name, 12);
          $this->nomereferenciaboleto_scfile_type = $this->nomereferenciaboleto_ul_type;
      }
      if (isset($this->NM_ajax_info['param']['nomereferenciaxml_ul_name']) && '' != $this->NM_ajax_info['param']['nomereferenciaxml_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaxml_ul_name]))
          {
              $this->NM_ajax_info['param']['nomereferenciaxml_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaxml_ul_name];
          }
          $this->nomereferenciaxml = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['nomereferenciaxml_ul_name'];
          $this->nomereferenciaxml_scfile_name = substr($this->NM_ajax_info['param']['nomereferenciaxml_ul_name'], 12);
          $this->nomereferenciaxml_scfile_type = $this->NM_ajax_info['param']['nomereferenciaxml_ul_type'];
          $this->nomereferenciaxml_ul_name = $this->NM_ajax_info['param']['nomereferenciaxml_ul_name'];
          $this->nomereferenciaxml_ul_type = $this->NM_ajax_info['param']['nomereferenciaxml_ul_type'];
      }
      elseif (isset($this->nomereferenciaxml_ul_name) && '' != $this->nomereferenciaxml_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaxml_ul_name]))
          {
              $this->nomereferenciaxml_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_field_ul_name'][$this->nomereferenciaxml_ul_name];
          }
          $this->nomereferenciaxml = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->nomereferenciaxml_ul_name;
          $this->nomereferenciaxml_scfile_name = substr($this->nomereferenciaxml_ul_name, 12);
          $this->nomereferenciaxml_scfile_type = $this->nomereferenciaxml_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "on";
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
      $this->nmgp_botoes['Auditoria'] = "on";
      $this->nmgp_botoes['sc_btn_0'] = "on";
      $this->nmgp_botoes['ImprimirNotaFiscal'] = "on";
      $this->nmgp_botoes['Cancelar'] = "on";
      $this->nmgp_botoes['GerarNota'] = "on";
      $this->nmgp_botoes['CancelarNotaPortalNacional'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert'];
          $this->nmgp_botoes['copy']   = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['NotaFiscal_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['copy']   = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['insert'];
          $this->nmgp_botoes['copy']   = $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['NotaFiscal_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['NotaFiscal_Frm'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form'];
          if (!isset($this->idtenacidade)){$this->idtenacidade = $this->nmgp_dados_form['idtenacidade'];} 
          if (!isset($this->idusuarioauditoria)){$this->idusuarioauditoria = $this->nmgp_dados_form['idusuarioauditoria'];} 
          if (!isset($this->dataemissao)){$this->dataemissao = $this->nmgp_dados_form['dataemissao'];} 
          if (!isset($this->dataliberacaoboleto)){$this->dataliberacaoboleto = $this->nmgp_dados_form['dataliberacaoboleto'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['numerolote'] != "null"){$this->numerolote = $this->nmgp_dados_form['numerolote'];} 
          if ($this->nmgp_opcao == "incluir" && $this->nmgp_dados_form['protocolo'] != "null"){$this->protocolo = $this->nmgp_dados_form['protocolo'];} 
          if (!isset($this->enderecoipauditoria)){$this->enderecoipauditoria = $this->nmgp_dados_form['enderecoipauditoria'];} 
          if (!isset($this->nomeaplicacaoauditoria)){$this->nomeaplicacaoauditoria = $this->nmgp_dados_form['nomeaplicacaoauditoria'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("NotaFiscal_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'NotaFiscal_Frm/NotaFiscal_Frm_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'NotaFiscal_Frm_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'NotaFiscal_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'NotaFiscal_Frm_help.txt');
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
          require_once($this->Ini->path_embutida . 'NotaFiscal_Frm/NotaFiscal_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "NotaFiscal_Frm_erro.class.php"); 
      }
      $this->Erro      = new NotaFiscal_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao']))
         { 
             if ($this->idnotafiscal != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['NotaFiscal_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['Auditoria'] = "off";
          $this->nmgp_botoes['sc_btn_0'] = "off";
          $this->nmgp_botoes['ImprimirNotaFiscal'] = "off";
          $this->nmgp_botoes['Cancelar'] = "off";
          $this->nmgp_botoes['GerarNota'] = "off";
          $this->nmgp_botoes['CancelarNotaPortalNacional'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['Auditoria'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes']['Auditoria'];
          $this->nmgp_botoes['sc_btn_0'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes']['sc_btn_0'];
          $this->nmgp_botoes['ImprimirNotaFiscal'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes']['ImprimirNotaFiscal'];
          $this->nmgp_botoes['Cancelar'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes']['Cancelar'];
          $this->nmgp_botoes['GerarNota'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes']['GerarNota'];
          $this->nmgp_botoes['CancelarNotaPortalNacional'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes']['CancelarNotaPortalNacional'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->idnotafiscal)) { $this->nm_limpa_alfa($this->idnotafiscal); }
      if (isset($this->idcliente)) { $this->nm_limpa_alfa($this->idcliente); }
      if (isset($this->idsituacaodocumento)) { $this->nm_limpa_alfa($this->idsituacaodocumento); }
      if (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
      if (isset($this->idlancamentoreceita)) { $this->nm_limpa_alfa($this->idlancamentoreceita); }
      if (isset($this->idplanoconta)) { $this->nm_limpa_alfa($this->idplanoconta); }
      if (isset($this->idusuariocancelamento)) { $this->nm_limpa_alfa($this->idusuariocancelamento); }
      if (isset($this->numeronotafiscal)) { $this->nm_limpa_alfa($this->numeronotafiscal); }
      if (isset($this->codigoverificacao)) { $this->nm_limpa_alfa($this->codigoverificacao); }
      if (isset($this->idusuarioemissao)) { $this->nm_limpa_alfa($this->idusuarioemissao); }
      if (isset($this->valornotafiscal)) { $this->nm_limpa_alfa($this->valornotafiscal); }
      if (isset($this->valoriss)) { $this->nm_limpa_alfa($this->valoriss); }
      if (isset($this->valorliquido)) { $this->nm_limpa_alfa($this->valorliquido); }
      if (isset($this->idusuariobaixa)) { $this->nm_limpa_alfa($this->idusuariobaixa); }
      if (isset($this->valorbaixa)) { $this->nm_limpa_alfa($this->valorbaixa); }
      if (isset($this->discriminacao)) { $this->nm_limpa_alfa($this->discriminacao); }
      if (isset($this->nomearquivo)) { $this->nm_limpa_alfa($this->nomearquivo); }
      if (isset($this->nomearquivoboleto)) { $this->nm_limpa_alfa($this->nomearquivoboleto); }
      if (isset($this->nomearquivoxml)) { $this->nm_limpa_alfa($this->nomearquivoxml); }
      if (isset($this->boletoliberado)) { $this->nm_limpa_alfa($this->boletoliberado); }
      if (isset($this->numerolote)) { $this->nm_limpa_alfa($this->numerolote); }
      if (isset($this->protocolo)) { $this->nm_limpa_alfa($this->protocolo); }
      if (isset($this->numeronotafiscalcompleto)) { $this->nm_limpa_alfa($this->numeronotafiscalcompleto); }
      if ($nm_opc_form_php == "formphp")
      { 
          if ($nm_call_php == "Auditoria")
          { 
              $this->sc_btn_Auditoria();
          } 
          if ($nm_call_php == "sc_btn_0")
          { 
              $this->sc_btn_sc_btn_0();
          } 
          if ($nm_call_php == "ImprimirNotaFiscal")
          { 
              $this->sc_btn_ImprimirNotaFiscal();
          } 
          if ($nm_call_php == "Cancelar")
          { 
              $this->sc_btn_Cancelar();
          } 
          if ($nm_call_php == "GerarNota")
          { 
              $this->sc_btn_GerarNota();
          } 
          if ($nm_call_php == "CancelarNotaPortalNacional")
          { 
              $this->sc_btn_CancelarNotaPortalNacional();
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "NotaFiscal_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- datacompetencia
      $this->field_config['datacompetencia']                 = array();
      $this->field_config['datacompetencia']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['datacompetencia']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datacompetencia']['date_display'] = "mmaaaa";
      $this->new_date_format('DT', 'datacompetencia');
      //-- idnotafiscal
      $this->field_config['idnotafiscal']               = array();
      $this->field_config['idnotafiscal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idnotafiscal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idnotafiscal']['symbol_dec'] = '';
      $this->field_config['idnotafiscal']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idnotafiscal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idcliente
      $this->field_config['idcliente']               = array();
      $this->field_config['idcliente']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcliente']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcliente']['symbol_dec'] = '';
      $this->field_config['idcliente']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcliente']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- datavencimento
      $this->field_config['datavencimento']                 = array();
      $this->field_config['datavencimento']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['datavencimento']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datavencimento']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'datavencimento');
      //-- valornotafiscal
      $this->field_config['valornotafiscal']               = array();
      $this->field_config['valornotafiscal']['symbol_grp'] = '';
      $this->field_config['valornotafiscal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valornotafiscal']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valornotafiscal']['symbol_mon'] = $_SESSION['scriptcase']['reg_conf']['monet_simb'];
      $this->field_config['valornotafiscal']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valornotafiscal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valoriss
      $this->field_config['valoriss']               = array();
      $this->field_config['valoriss']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['valoriss']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['valoriss']['symbol_dec'] = '';
      $this->field_config['valoriss']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['valoriss']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- valorliquido
      $this->field_config['valorliquido']               = array();
      $this->field_config['valorliquido']['symbol_grp'] = '';
      $this->field_config['valorliquido']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorliquido']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorliquido']['symbol_mon'] = $_SESSION['scriptcase']['reg_conf']['monet_simb'];
      $this->field_config['valorliquido']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorliquido']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- datarecebimento
      $this->field_config['datarecebimento']                 = array();
      $this->field_config['datarecebimento']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['datarecebimento']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datarecebimento']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'datarecebimento');
      //-- databaixa
      $this->field_config['databaixa']                 = array();
      $this->field_config['databaixa']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['databaixa']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['databaixa']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'databaixa');
      //-- valorbaixa
      $this->field_config['valorbaixa']               = array();
      $this->field_config['valorbaixa']['symbol_grp'] = '';
      $this->field_config['valorbaixa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorbaixa']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorbaixa']['symbol_mon'] = $_SESSION['scriptcase']['reg_conf']['monet_simb'];
      $this->field_config['valorbaixa']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorbaixa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- idlancamentoreceita
      $this->field_config['idlancamentoreceita']               = array();
      $this->field_config['idlancamentoreceita']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idlancamentoreceita']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idlancamentoreceita']['symbol_dec'] = '';
      $this->field_config['idlancamentoreceita']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idlancamentoreceita']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- competenciasimples
      $this->field_config['competenciasimples']                 = array();
      $this->field_config['competenciasimples']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['competenciasimples']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['competenciasimples']['date_display'] = "mmaaaa";
      $this->new_date_format('DT', 'competenciasimples');
      //-- datarecebimentonota
      $this->field_config['datarecebimentonota']                 = array();
      $this->field_config['datarecebimentonota']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datarecebimentonota']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datarecebimentonota']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datarecebimentonota']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'datarecebimentonota');
      //-- idusuariocancelamento
      $this->field_config['idusuariocancelamento']               = array();
      $this->field_config['idusuariocancelamento']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idusuariocancelamento']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idusuariocancelamento']['symbol_dec'] = '';
      $this->field_config['idusuariocancelamento']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idusuariocancelamento']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
      //-- dataemissao
      $this->field_config['dataemissao']                 = array();
      $this->field_config['dataemissao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dataemissao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dataemissao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dataemissao']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'dataemissao');
      //-- dataliberacaoboleto
      $this->field_config['dataliberacaoboleto']                 = array();
      $this->field_config['dataliberacaoboleto']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dataliberacaoboleto']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dataliberacaoboleto']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dataliberacaoboleto']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'dataliberacaoboleto');
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
          $this->numerolote = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numerolote'];
          $this->protocolo = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['protocolo'];
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") {
          $this->numerolote = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numerolote'];
          $this->protocolo = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['protocolo'];
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_datacompetencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datacompetencia');
          }
          if ('validate_idempresa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idempresa');
          }
          if ('validate_idnotafiscal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idnotafiscal');
          }
          if ('validate_idcliente' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcliente');
          }
          if ('validate_idplanoconta' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanoconta');
          }
          if ('validate_datavencimento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datavencimento');
          }
          if ('validate_valornotafiscal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valornotafiscal');
          }
          if ('validate_valoriss' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valoriss');
          }
          if ('validate_valorliquido' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorliquido');
          }
          if ('validate_idusuarioemissao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idusuarioemissao');
          }
          if ('validate_idsituacaodocumento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idsituacaodocumento');
          }
          if ('validate_boletoliberado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'boletoliberado');
          }
          if ('validate_datarecebimento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datarecebimento');
          }
          if ('validate_databaixa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'databaixa');
          }
          if ('validate_idusuariobaixa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idusuariobaixa');
          }
          if ('validate_valorbaixa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorbaixa');
          }
          if ('validate_idlancamentoreceita' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idlancamentoreceita');
          }
          if ('validate_numeronotafiscal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'numeronotafiscal');
          }
          if ('validate_numeronotafiscalcompleto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'numeronotafiscalcompleto');
          }
          if ('validate_competenciasimples' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'competenciasimples');
          }
          if ('validate_codigoverificacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'codigoverificacao');
          }
          if ('validate_datarecebimentonota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datarecebimentonota');
          }
          if ('validate_numerolote' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'numerolote');
          }
          if ('validate_protocolo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'protocolo');
          }
          if ('validate_idusuariocancelamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idusuariocancelamento');
          }
          if ('validate_discriminacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'discriminacao');
          }
          if ('validate_nomereferencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomereferencia');
          }
          if ('validate_nomearquivo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomearquivo');
          }
          if ('validate_nomereferenciaboleto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomereferenciaboleto');
          }
          if ('validate_nomearquivoboleto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomearquivoboleto');
          }
          if ('validate_nomereferenciaxml' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomereferenciaxml');
          }
          if ('validate_nomearquivoxml' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomearquivoxml');
          }
          NotaFiscal_Frm_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_databaixa_onchange' == $this->NM_ajax_opcao)
          {
              $this->DataBaixa_onChange();
          }
          if ('event_idsituacaodocumento_onchange' == $this->NM_ajax_opcao)
          {
              $this->IdSituacaoDocumento_onChange();
          }
          if ('event_valoriss_onchange' == $this->NM_ajax_opcao)
          {
              $this->ValorISS_onChange();
          }
          if ('event_scajaxbutton_cancelar_onclick' == $this->NM_ajax_opcao)
          {
              $this->scajaxbutton_Cancelar_onClick();
          }
          if ('event_scajaxbutton_gerarnota_onclick' == $this->NM_ajax_opcao)
          {
              $this->scajaxbutton_GerarNota_onClick();
          }
          NotaFiscal_Frm_pack_ajax_response();
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcliente");

   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdCliente, Descricao FROM clienteempresa_view WHERE (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND IdSituacaoCliente = 1) AND #upperI#Descricao#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idcliente)), 1, -1) . "%' ORDER BY Descricao";
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

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 50, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente'][] = $rs->fields[0];
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
                  if ($AjaxLim > 50)
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
          if ('autocomp_idlancamentoreceita' == $this->NM_ajax_opcao)
          {
              if (isset($_GET['term'])) {
                  $this->idlancamentoreceita = ($_SESSION['scriptcase']['charset'] != "UTF-8") ? NM_utf8_decode(sc_convert_encoding($_GET['term'], $_SESSION['scriptcase']['charset'], 'UTF-8')) : $_GET['term'];
              } else {
                  $this->idlancamentoreceita = '';
              }
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idlancamentoreceita");

   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdLancamentoReceita, concat_ws(' ', IdLancamentoReceita, Historico, ValorPrevisao) FROM lancamentoreceita WHERE #upperI#concat_ws(' ', IdLancamentoReceita, Historico, ValorPrevisao)#upperF# LIKE '%" . substr($this->Db->qstr(sc_strtoupper($this->idlancamentoreceita)), 1, -1) . "%' ORDER BY Historico, ValorPrevisao";
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

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 10, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita'][] = $rs->fields[0];
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
          NotaFiscal_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select']['discriminacao']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->discriminacao = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select']['discriminacao'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select']['numerolote']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->numerolote = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select']['numerolote'];
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select']['protocolo']) && !isset($this->nmgp_refresh_fields))
          { 
              $this->protocolo = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select']['protocolo'];
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              NotaFiscal_Frm_pack_ajax_response();
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
          $_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  NotaFiscal_Frm_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_redir_atualiz'] == "ok")
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
          NotaFiscal_Frm_pack_ajax_response();
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
          NotaFiscal_Frm_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "NotaFiscal_Frm.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Nota Fiscal") ?></TITLE>
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
<form name="Fdown" method="get" action="NotaFiscal_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="NotaFiscal_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="NotaFiscal_Frm.php" target="_self" style="display: none"> 
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
   function sc_btn_Auditoria() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'] : "";
     }
     if (empty($this->nomereferenciaboleto)) {
         $this->nomereferenciaboleto = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'] : "";
     }
     if (empty($this->nomereferenciaxml)) {
         $this->nomereferenciaxml = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'] : "";
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
include_once("NotaFiscal_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idnotafiscal) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idnotafiscal']))
          {
              $varloc_btn_php['idnotafiscal'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idnotafiscal'];
          }
      }
      $nm_f_saida = "NotaFiscal_Frm.php";
      nm_limpa_data($this->datacompetencia, $this->field_config['datacompetencia']['date_sep']) ; 
      nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_data($this->datavencimento, $this->field_config['datavencimento']['date_sep']) ; 
      if (!empty($this->field_config['valornotafiscal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']); 
          nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']); 
          nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datarecebimento, $this->field_config['datarecebimento']['date_sep']) ; 
      nm_limpa_data($this->databaixa, $this->field_config['databaixa']['date_sep']) ; 
      if (!empty($this->field_config['valorbaixa']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']); 
          nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      $this->nm_tira_mask($this->numeronotafiscal, "9999 / 9999", "(){}[].,;:-+/ "); 
      nm_limpa_data($this->competenciasimples, $this->field_config['competenciasimples']['date_sep']) ; 
      nm_limpa_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_sep']) ; 
      nm_limpa_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['time_sep']) ; 
      nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button Auditoria ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  $posicao = strpos($this->Ini->nm_cod_apl, '_');
$nomeTabela =  strtolower(substr($this->Ini->nm_cod_apl, 0, $posicao));	
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('AuditoriaRegistro_Lst') . "/AuditoriaRegistro_Lst.php", $this->nm_location, "varIdTenacidade?#?" . NM_encode_input($this->sc_temp_varIdTenacidade) . "?@?" . "varNomeTabelaAuditoria?#?" . NM_encode_input($nomeTabela) . "?@?" . "varValorIdChavePrimariaAuditoria?#?" . NM_encode_input($this->idnotafiscal ) . "?@?","_self", '', 440, 630);
 };
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button Auditoria ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idnotafiscal" value="<?php echo $this->form_encode_input($this->idnotafiscal) ?>"/>
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
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'] : "";
     }
     if (empty($this->nomereferenciaboleto)) {
         $this->nomereferenciaboleto = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'] : "";
     }
     if (empty($this->nomereferenciaxml)) {
         $this->nomereferenciaxml = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'] : "";
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
include_once("NotaFiscal_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "NotaFiscal_Frm.php";
      nm_limpa_data($this->datacompetencia, $this->field_config['datacompetencia']['date_sep']) ; 
      nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_data($this->datavencimento, $this->field_config['datavencimento']['date_sep']) ; 
      if (!empty($this->field_config['valornotafiscal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']); 
          nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']); 
          nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datarecebimento, $this->field_config['datarecebimento']['date_sep']) ; 
      nm_limpa_data($this->databaixa, $this->field_config['databaixa']['date_sep']) ; 
      if (!empty($this->field_config['valorbaixa']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']); 
          nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      $this->nm_tira_mask($this->numeronotafiscal, "9999 / 9999", "(){}[].,;:-+/ "); 
      nm_limpa_data($this->competenciasimples, $this->field_config['competenciasimples']['date_sep']) ; 
      nm_limpa_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_sep']) ; 
      nm_limpa_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['time_sep']) ; 
      nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
      $this->nm_converte_datas();
      
/*----- Scriptcase Locale: Button sc_btn_0 ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
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
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
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
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button sc_btn_0 ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idnotafiscal" value="<?php echo $this->form_encode_input($this->idnotafiscal) ?>"/>
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
   function sc_btn_ImprimirNotaFiscal() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'] : "";
     }
     if (empty($this->nomereferenciaboleto)) {
         $this->nomereferenciaboleto = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'] : "";
     }
     if (empty($this->nomereferenciaxml)) {
         $this->nomereferenciaxml = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'] : "";
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
include_once("NotaFiscal_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "NotaFiscal_Frm.php";
      nm_limpa_data($this->datacompetencia, $this->field_config['datacompetencia']['date_sep']) ; 
      nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_data($this->datavencimento, $this->field_config['datavencimento']['date_sep']) ; 
      if (!empty($this->field_config['valornotafiscal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']); 
          nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']); 
          nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datarecebimento, $this->field_config['datarecebimento']['date_sep']) ; 
      nm_limpa_data($this->databaixa, $this->field_config['databaixa']['date_sep']) ; 
      if (!empty($this->field_config['valorbaixa']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']); 
          nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      $this->nm_tira_mask($this->numeronotafiscal, "9999 / 9999", "(){}[].,;:-+/ "); 
      nm_limpa_data($this->competenciasimples, $this->field_config['competenciasimples']['date_sep']) ; 
      nm_limpa_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_sep']) ; 
      nm_limpa_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['time_sep']) ; 
      nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
      $this->nm_converte_datas();
      
/*----- Scriptcase Locale: Button ImprimirNotaFiscal ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  $this->gerarNotaFiscal('I','');
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button ImprimirNotaFiscal ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idnotafiscal" value="<?php echo $this->form_encode_input($this->idnotafiscal) ?>"/>
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
   function sc_btn_CancelarNotaPortalNacional() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
     if (empty($this->nomereferencia)) {
         $this->nomereferencia = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferencia'] : "";
     }
     if (empty($this->nomereferenciaboleto)) {
         $this->nomereferenciaboleto = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaboleto'] : "";
     }
     if (empty($this->nomereferenciaxml)) {
         $this->nomereferenciaxml = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'] : "";
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
include_once("NotaFiscal_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idempresa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idempresa']))
          {
              $varloc_btn_php['idempresa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idempresa'];
          }
          if (!isset($this->idnotafiscal) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idnotafiscal']))
          {
              $varloc_btn_php['idnotafiscal'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idnotafiscal'];
          }
          if (!isset($this->idnotafiscal) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idnotafiscal']))
          {
              $varloc_btn_php['idnotafiscal'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['idnotafiscal'];
          }
          if (!isset($this->numeronotafiscalcompleto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto']))
          {
              $varloc_btn_php['numeronotafiscalcompleto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto'];
          }
          if (!isset($this->protocolo) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['protocolo']))
          {
              $varloc_btn_php['protocolo'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['protocolo'];
          }
          if (!isset($this->nomereferenciaxml) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml']))
          {
              $varloc_btn_php['nomereferenciaxml'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomereferenciaxml'];
          }
          if (!isset($this->nomearquivoxml) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomearquivoxml']))
          {
              $varloc_btn_php['nomearquivoxml'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['nomearquivoxml'];
          }
          if (!isset($this->numeronotafiscalcompleto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto']))
          {
              $varloc_btn_php['numeronotafiscalcompleto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto'];
          }
          if (!isset($this->numeronotafiscalcompleto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto']))
          {
              $varloc_btn_php['numeronotafiscalcompleto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto'];
          }
          if (!isset($this->numeronotafiscalcompleto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto']))
          {
              $varloc_btn_php['numeronotafiscalcompleto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form']['numeronotafiscalcompleto'];
          }
      }
      $nm_f_saida = "NotaFiscal_Frm.php";
      nm_limpa_data($this->datacompetencia, $this->field_config['datacompetencia']['date_sep']) ; 
      nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      nm_limpa_data($this->datavencimento, $this->field_config['datavencimento']['date_sep']) ; 
      if (!empty($this->field_config['valornotafiscal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']); 
          nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']); 
          nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']) ; 
      }
      nm_limpa_data($this->datarecebimento, $this->field_config['datarecebimento']['date_sep']) ; 
      nm_limpa_data($this->databaixa, $this->field_config['databaixa']['date_sep']) ; 
      if (!empty($this->field_config['valorbaixa']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']); 
          nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']) ; 
      }
      nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      $this->nm_tira_mask($this->numeronotafiscal, "9999 / 9999", "(){}[].,;:-+/ "); 
      nm_limpa_data($this->competenciasimples, $this->field_config['competenciasimples']['date_sep']) ; 
      nm_limpa_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_sep']) ; 
      nm_limpa_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['time_sep']) ; 
      nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button CancelarNotaPortalNacional ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = (isset($_SESSION['varDiretorioArquivo'])) ? $_SESSION['varDiretorioArquivo'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  $check_sql = "SELECT IdEmpresaNotaFiscal, Ambiente, EmitenteNome, EmitenteCnpj, EmitenteInscricaoMunicipal, EmitenteCodigoMunicipio, DiretorioCertificado, NomeCertificado, NomeMixedKey, NomePrivateKey, NomePublicKey, SenhaCertificado, TipoNotaFiscal, AnoNotaFiscal, SequencialNotaFiscal FROM empresanotafiscal WHERE IdEmpresa = $this->idempresa  AND IdTenacidade = '$this->sc_temp_varIdTenacidade' AND Ativo = 'S'";
 
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

	
if (isset($this->rs[0][0]) && $this->rs[0][0] > 0) {
	
	$anoAtual = date('Y');
	$varLocAmbiente = $this->rs[0][1];
	$varLocEmitenteNome = $this->rs[0][2];
	$varLocEmitenteCnpj = $this->rs[0][3];
	$varLocEmitenteInscricaoMunicipal = $this->rs[0][4];
	$varLocEmitenteCodigoMunicipio = $this->rs[0][5];
	$varDiretorioCertificado = $this->rs[0][6];	
	$varNomeCertificado = $this->rs[0][7];	
	$varNomeMixedKey = $this->rs[0][8];	
	$varNomePrivateKey = $this->rs[0][9];	
	$varNomePublicKey = $this->rs[0][10];
	$varSenhaCertificado = $this->rs[0][11];
	$varTipoNotaFiscal = $this->rs[0][12];
	$varAnoNotaFiscal = $this->rs[0][13];
	$varSequenciaNotaFiscal = $this->rs[0][14];
	
} else {
	
	sc_message_error("Empresa não configurada para emissão de nota fiscal.");
		
}

try {

    sc_include_library("prj", "nfse", "autoload.php", true, true);

    date_default_timezone_set('America/Sao_Paulo');

    $pfxPath     = '/opt/LIGASistemas/v9_81/certificado/certificate.pfx';
    $pfxPassword = 'Infoliga.10';

    $debugDir = '/var/www/html/temp';
    if (!is_dir($debugDir)) {
        mkdir($debugDir, 0777, true);
    }

    $xmlFile      = $debugDir . '/cancelamento_pedRegEvento_assinado.xml';
    $payloadFile  = $debugDir . '/cancelamento_payload.json';
    $curlLogFile  = $debugDir . '/cancelamento_curl_verbose.log';
    $gzBase64File = $debugDir . '/cancelamento_pedRegEvento_gzip_b64.txt';
    $respBodyFile = $debugDir . '/cancelamento_response_body.txt';
    $respHeadFile = $debugDir . '/cancelamento_response_header.txt';

    

    

    

    

    

    $idNotaFiscal = $this->idnotafiscal ;

    if (empty($idNotaFiscal)) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "IdNotaFiscal não informado.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "IdNotaFiscal não informado.";
 }
;
        return;
    }

    $numeroNotaFiscal         = $this->idnotafiscal ;
    $numeroNotaFiscalCompleto = $this->numeronotafiscalcompleto ;
    $this->protocolo                = trim($this->protocolo );
    $nomeReferenciaXmlBanco   = trim($this->nomereferenciaxml );
    $nomeArquivoXmlBanco      = trim($this->nomearquivoxml );

    if (empty($this->protocolo)) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "A nota não possui protocolo/chave de acesso gravado.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "A nota não possui protocolo/chave de acesso gravado.";
 }
;
        return;
    }

    $chaveAcesso = $this->protocolo;
    $chaveAcesso = trim($chaveAcesso);

    $idNfse = '';

    if (!empty($this->numeronotafiscalcompleto ) && substr(trim($this->numeronotafiscalcompleto ), 0, 3) === 'NFS') {
        $idNfse = trim($this->numeronotafiscalcompleto );
    }

    if (empty($idNfse)) {
        $caminhoXml1 = '';
        $caminhoXml2 = '';

        if (!empty($nomeReferenciaXmlBanco)) {
            $caminhoXml1 = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade . "/" . $nomeReferenciaXmlBanco;
        }

        if (!empty($nomeArquivoXmlBanco)) {
            $caminhoXml2 = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade . "/" . $nomeArquivoXmlBanco;
        }

        $xmlPath = '';
        if (!empty($caminhoXml1) && file_exists($caminhoXml1)) {
            $xmlPath = $caminhoXml1;
        } elseif (!empty($caminhoXml2) && file_exists($caminhoXml2)) {
            $xmlPath = $caminhoXml2;
        }

        if (!empty($xmlPath)) {
            libxml_use_internal_errors(true);
            $xmlNota = simplexml_load_file($xmlPath);
            if ($xmlNota !== false) {
                $xmlNota->registerXPathNamespace('ns', 'http://www.sped.fazenda.gov.br/nfse');
                $infNFSeList = $xmlNota->xpath('//ns:infNFSe');
                if (isset($infNFSeList[0])) {
                    $attrs = $infNFSeList[0]->attributes();
                    if (isset($attrs['Id'])) {
                        $idNfse = trim((string)$attrs['Id']);
                    }
                }
            }
        }
    }

    if (empty($idNfse)) {
        if (substr($chaveAcesso, 0, 3) === 'NFS') {
            $idNfse = $chaveAcesso;
            $chaveAcesso = $this->extrairChaveAcessoDaTagNFS($idNfse);
        } else {
            $idNfse = 'NFS' . $chaveAcesso;
        }
    }

    if (empty($idNfse) || substr($idNfse, 0, 3) !== 'NFS') {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Não foi possível determinar o idNfse no formato NFS...";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Não foi possível determinar o idNfse no formato NFS...";
 }
;
        return;
    }

    if (empty($chaveAcesso)) {
        $chaveAcesso = $this->extrairChaveAcessoDaTagNFS($idNfse);
    }

	
	$varLocAmbiente = 'producao';
    if ($varLocAmbiente == 'homologacao') {
        $tpAmb = 2;
        $endpoint = 'https://sefin.producaorestrita.nfse.gov.br/SefinNacional/nfse/' . $chaveAcesso . '/eventos';
    } else {
        $tpAmb = 1;
        $endpoint = 'https://sefin.nfse.gov.br/SefinNacional/nfse/' . $chaveAcesso . '/eventos';
    }

    $cnpjAutor = $this->somenteNumeros($varLocEmitenteCnpj);
    $cpfAutor  = '';

    if (strlen($cnpjAutor) !== 14) {
        $cpfAutor  = $this->somenteNumeros($varLocEmitenteCnpj);
        $cnpjAutor = '';
    }

    if (empty($cnpjAutor) && empty($cpfAutor)) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Não foi possível identificar CNPJ/CPF do autor do evento.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Não foi possível identificar CNPJ/CPF do autor do evento.";
 }
;
        return;
    }

    $tpEvento   = '101101';
    $nSeqEvento = '001';
    $verAplic   = 'NFSe_0.0.0.2';
    $dhEvento   = $this->montarDhEvento();
    $xDesc      = $this->limparTextoEvento('Cancelamento de NFS-e');
    $cMotivo    = '1';
    $xMotivo    = $this->limparTextoEvento('Erro na emissão');
    $idEvento   = $this->montarIdEvento($tpEvento, $idNfse, $nSeqEvento);

    $tagAutor = !empty($cnpjAutor)
        ? "<CNPJ>{$cnpjAutor}</CNPJ>"
        : "<CPF>{$cpfAutor}</CPF>";

    $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<pedRegEvento xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.01">
    <infPedRegEvento Id="{$idEvento}">
        <tpAmb>{$tpAmb}</tpAmb>
        <verAplic>{$verAplic}</verAplic>
        <dhEvento>{$dhEvento}</dhEvento>
        {$tagAutor}
        <idNfse>{$idNfse}</idNfse>
        <e101101>
            <descEvento>{$xDesc}</descEvento>
            <nSeqEvento>{$nSeqEvento}</nSeqEvento>
            <xDesc>{$xDesc}</xDesc>
            <cMotivo>{$cMotivo}</cMotivo>
            <xMotivo>{$xMotivo}</xMotivo>
        </e101101>
    </infPedRegEvento>
</pedRegEvento>
XML;

    $pfxContent = @file_get_contents($pfxPath);
    if (!$pfxContent) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro fatal: não conseguiu ler o PFX em {$pfxPath}";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro fatal: não conseguiu ler o PFX em {$pfxPath}";
 }
;
        return;
    }

    if (!openssl_pkcs12_read($pfxContent, $certs, $pfxPassword)) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro fatal: falha ao ler PFX — senha errada ou arquivo inválido.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro fatal: falha ao ler PFX — senha errada ou arquivo inválido.";
 }
;
        return;
    }

    $privateKey = $certs['pkey'];
    $publicCert = $certs['cert'];

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = false;

    if (!$dom->loadXML($xml)) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro: não foi possível carregar o XML do pedido de registro de evento.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro: não foi possível carregar o XML do pedido de registro de evento.";
 }
;
        return;
    }

    $xpath = new DOMXPath($dom);
    $xpath->registerNamespace('ns', 'http://www.sped.fazenda.gov.br/nfse');
    $list = $xpath->query('//ns:infPedRegEvento');

    if ($list->length === 0) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro: elemento infPedRegEvento não encontrado.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro: elemento infPedRegEvento não encontrado.";
 }
;
        return;
    }

    $infPedRegEvento = $list->item(0);

    $dsig = new \RobRichards\XMLSecLibs\XMLSecurityDSig('');
    $transforms = [
        'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
        'http://www.w3.org/TR/2001/REC-xml-c14n-20010315'
    ];

    $dsig->addReference(
        $infPedRegEvento,
        \RobRichards\XMLSecLibs\XMLSecurityDSig::SHA1,
        $transforms,
        ['id_name' => 'Id', 'overwrite' => false]
    );

    $key = new \RobRichards\XMLSecLibs\XMLSecurityKey(
        \RobRichards\XMLSecLibs\XMLSecurityKey::RSA_SHA1,
        ['type' => 'private']
    );
    $key->loadKey($privateKey, false);

    $dsig->setCanonicalMethod('http://www.w3.org/TR/2001/REC-xml-c14n-20010315');
    $dsig->sign($key);

    $certPem = $publicCert;
    if (preg_match_all('/-----BEGIN CERTIFICATE-----(.*?)-----END CERTIFICATE-----/s', $certPem, $matches)) {
        $certBody = preg_replace('/\s+/', '', $matches[1][0]);
    } else {
        $certBody = preg_replace('/-----BEGIN CERTIFICATE-----|-----END CERTIFICATE-----|\s+/', '', $certPem);
    }

    $dsig->add509Cert($certBody, false, false);
    $dsig->sigNode->setAttribute('xmlns', 'http://www.w3.org/2000/09/xmldsig#');

    $signatureNodeImported = $dom->importNode($dsig->sigNode, true);
    $parent = $infPedRegEvento->parentNode;
    $next = $infPedRegEvento->nextSibling;

    if ($next) {
        $parent->insertBefore($signatureNodeImported, $next);
    } else {
        $parent->appendChild($signatureNodeImported);
    }

    $xmlAssinado = $dom->saveXML();
    file_put_contents($xmlFile, $xmlAssinado);

    $gzip   = gzencode($xmlAssinado);
    $base64 = base64_encode($gzip);

    file_put_contents($gzBase64File, $base64);

    $data = [
        "pedidoRegistroEventoXmlGZipB64" => $base64
    ];

    $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    file_put_contents($payloadFile, $json);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

    $headers = [
        "Content-Type: application/json",
        "Accept: application/json",
        "User-Agent: PHP-NFSe-Client/1.0"
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

    curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');
    curl_setopt($ch, CURLOPT_SSLCERT, $pfxPath);
    curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $pfxPassword);

    curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

    $verbose = fopen($curlLogFile, 'w+');
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_STDERR, $verbose);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_TIMEOUT, 90);

    $response = curl_exec($ch);
    $errno    = curl_errno($ch);
    $error    = curl_error($ch);
    $info     = curl_getinfo($ch);
    curl_close($ch);
    fclose($verbose);

    if ($errno) {
        
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "CURL error ({$errno}): {$error}";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "CURL error ({$errno}): {$error}";
 }
;
        return;
    }

    $httpCode   = $info['http_code'] ?? 0;
    $headerSize = $info['header_size'] ?? 0;
    $rawHeader  = substr($response, 0, $headerSize);
    $body       = substr($response, $headerSize);

    file_put_contents($respHeadFile, $rawHeader);
    file_put_contents($respBodyFile, $body);

    if ($httpCode == 201 || $httpCode == 200) {

        $resp = json_decode($body, true);

        $dataHoraProcessamento = isset($resp['dataHoraProcessamento']) ? $resp['dataHoraProcessamento'] : date('Y-m-d H:i:s');
        $eventoXmlGZipB64      = isset($resp['eventoXmlGZipB64']) ? $resp['eventoXmlGZipB64'] : '';
        $tipoAmbienteResp      = isset($resp['tipoAmbiente']) ? $resp['tipoAmbiente'] : '';
        $versaoAplicativoResp  = isset($resp['versaoAplicativo']) ? $resp['versaoAplicativo'] : '';

        $nomeEventoXml = '';
        $nomeReferenciaEventoXml = '';

        if (!empty($eventoXmlGZipB64)) {
            $eventoXmlZip = base64_decode($eventoXmlGZipB64);
            $eventoXml = @gzdecode($eventoXmlZip);

            if ($eventoXml === false) {
                $eventoXml = @gzuncompress($eventoXmlZip);
            }

            if ($eventoXml !== false) {
                $nomeEventoXml = 'evento_cancelamento_' . $chaveAcesso . '.xml';
                $caminhoEventoXml = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade . "/" . $nomeEventoXml;
                file_put_contents($caminhoEventoXml, $eventoXml);

                $ext = pathinfo($nomeEventoXml, PATHINFO_EXTENSION);
                $nomeReferenciaEventoXml = md5(date('YmdHisu') . $nomeEventoXml . $this->sc_temp_varIdTenacidade) . "." . $ext;
                $caminhoReferenciaEventoXml = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade . "/" . $nomeReferenciaEventoXml;
                rename($caminhoEventoXml, $caminhoReferenciaEventoXml);
            }
        }

        $dhBanco = substr(str_replace('T', ' ', $dataHoraProcessamento), 0, 19);

        $updateFields = array(
            "IdUsuarioCancelamento = $this->sc_temp_varIdUsuario"
        );

        if (!empty($nomeReferenciaEventoXml)) {
            $updateFields[] = "NomeReferenciaXml = '" . addslashes($nomeReferenciaEventoXml) . "'";
            $updateFields[] = "NomeArquivoXml = '" . addslashes($nomeEventoXml) . "'";
        }

        $updateSql = "
            UPDATE notafiscal
               SET " . implode(", ", $updateFields) . "
             WHERE IdNotaFiscal = " . (int)$idNotaFiscal;

        
     $nm_select = $updateSql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
        if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


        $this->nm_mens_alert[] = "Evento de cancelamento enviado com sucesso."; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Evento de cancelamento enviado com sucesso."); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "","_self", '', 440, 630);
 };

    } else {

        $errorData = json_decode($body, true);

        if (isset($errorData['erros'][0])) {
            $descricaoErro   = isset($errorData['erros'][0]['Descricao']) ? $errorData['erros'][0]['Descricao'] : 'Erro ao cancelar NFS-e.';
            $complementoErro = isset($errorData['erros'][0]['Complemento']) ? $errorData['erros'][0]['Complemento'] : $body;
            
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $descricaoErro . " Detalhe Técnico: " . $complementoErro;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $descricaoErro . " Detalhe Técnico: " . $complementoErro;
 }
;
        } else {
            
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Falha no cancelamento. HTTP {$httpCode}. Resposta: {$body}";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Falha no cancelamento. HTTP {$httpCode}. Resposta: {$body}";
 }
;
        }
    }

} catch (Exception $e) {
    
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $e->getMessage();
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $e->getMessage();
 }
;
}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button CancelarNotaPortalNacional ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idnotafiscal" value="<?php echo $this->form_encode_input($this->idnotafiscal) ?>"/>
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
           case 'datacompetencia':
               return "Serviços prestados em";
               break;
           case 'idempresa':
               return "Empresa";
               break;
           case 'idnotafiscal':
               return "Id.";
               break;
           case 'idcliente':
               return "Nome Fantasia - CNPJ";
               break;
           case 'idplanoconta':
               return "Plano de Contas";
               break;
           case 'datavencimento':
               return "Data do Vencimento";
               break;
           case 'valornotafiscal':
               return "Valor dos Serviços";
               break;
           case 'valoriss':
               return "Valor do ISS (%)";
               break;
           case 'valorliquido':
               return "Valor Líquido";
               break;
           case 'idusuarioemissao':
               return "Emitido por";
               break;
           case 'idsituacaodocumento':
               return "Situação";
               break;
           case 'boletoliberado':
               return "Boleto liberado";
               break;
           case 'datarecebimento':
               return "Recebido em";
               break;
           case 'databaixa':
               return "Baixado em";
               break;
           case 'idusuariobaixa':
               return "Baixado por";
               break;
           case 'valorbaixa':
               return "Valor da Baixa";
               break;
           case 'idlancamentoreceita':
               return "Conta a Receber";
               break;
           case 'numeronotafiscal':
               return "Número da Nota Fiscal";
               break;
           case 'numeronotafiscalcompleto':
               return "Número da Nota Fiscal Completo";
               break;
           case 'competenciasimples':
               return "Competência simples";
               break;
           case 'codigoverificacao':
               return "Código de Verificação";
               break;
           case 'datarecebimentonota':
               return "Data Recebimento Nota";
               break;
           case 'numerolote':
               return "Numero Lote";
               break;
           case 'protocolo':
               return "Protocolo/Chave de acesso";
               break;
           case 'idusuariocancelamento':
               return "Id Usuario Cancelamento";
               break;
           case 'discriminacao':
               return "Discriminação";
               break;
           case 'nomereferencia':
               return "Nota fiscal";
               break;
           case 'nomearquivo':
               return "";
               break;
           case 'nomereferenciaboleto':
               return "Boleto";
               break;
           case 'nomearquivoboleto':
               return "";
               break;
           case 'nomereferenciaxml':
               return "Xml";
               break;
           case 'nomearquivoxml':
               return "";
               break;
           case 'idtenacidade':
               return "Id Tenacidade";
               break;
           case 'idusuarioauditoria':
               return "Id Usuario Auditoria";
               break;
           case 'dataemissao':
               return "Emitido em";
               break;
           case 'dataliberacaoboleto':
               return "Liberado em";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_NotaFiscal_Frm']) || !is_array($this->NM_ajax_info['errList']['geral_NotaFiscal_Frm']))
              {
                  $this->NM_ajax_info['errList']['geral_NotaFiscal_Frm'] = array();
              }
              $this->NM_ajax_info['errList']['geral_NotaFiscal_Frm'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'datacompetencia' == $filtro)) || (is_array($filtro) && in_array('datacompetencia', $filtro)))
        $this->ValidateField_datacompetencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idempresa' == $filtro)) || (is_array($filtro) && in_array('idempresa', $filtro)))
        $this->ValidateField_idempresa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idnotafiscal' == $filtro)) || (is_array($filtro) && in_array('idnotafiscal', $filtro)))
        $this->ValidateField_idnotafiscal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcliente' == $filtro)) || (is_array($filtro) && in_array('idcliente', $filtro)))
        $this->ValidateField_idcliente($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanoconta' == $filtro)) || (is_array($filtro) && in_array('idplanoconta', $filtro)))
        $this->ValidateField_idplanoconta($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'datavencimento' == $filtro)) || (is_array($filtro) && in_array('datavencimento', $filtro)))
        $this->ValidateField_datavencimento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valornotafiscal' == $filtro)) || (is_array($filtro) && in_array('valornotafiscal', $filtro)))
        $this->ValidateField_valornotafiscal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valoriss' == $filtro)) || (is_array($filtro) && in_array('valoriss', $filtro)))
        $this->ValidateField_valoriss($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorliquido' == $filtro)) || (is_array($filtro) && in_array('valorliquido', $filtro)))
        $this->ValidateField_valorliquido($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idusuarioemissao' == $filtro)) || (is_array($filtro) && in_array('idusuarioemissao', $filtro)))
        $this->ValidateField_idusuarioemissao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idsituacaodocumento' == $filtro)) || (is_array($filtro) && in_array('idsituacaodocumento', $filtro)))
        $this->ValidateField_idsituacaodocumento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'boletoliberado' == $filtro)) || (is_array($filtro) && in_array('boletoliberado', $filtro)))
        $this->ValidateField_boletoliberado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'datarecebimento' == $filtro)) || (is_array($filtro) && in_array('datarecebimento', $filtro)))
        $this->ValidateField_datarecebimento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'databaixa' == $filtro)) || (is_array($filtro) && in_array('databaixa', $filtro)))
        $this->ValidateField_databaixa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idusuariobaixa' == $filtro)) || (is_array($filtro) && in_array('idusuariobaixa', $filtro)))
        $this->ValidateField_idusuariobaixa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorbaixa' == $filtro)) || (is_array($filtro) && in_array('valorbaixa', $filtro)))
        $this->ValidateField_valorbaixa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idlancamentoreceita' == $filtro)) || (is_array($filtro) && in_array('idlancamentoreceita', $filtro)))
        $this->ValidateField_idlancamentoreceita($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'numeronotafiscal' == $filtro)) || (is_array($filtro) && in_array('numeronotafiscal', $filtro)))
        $this->ValidateField_numeronotafiscal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'numeronotafiscalcompleto' == $filtro)) || (is_array($filtro) && in_array('numeronotafiscalcompleto', $filtro)))
        $this->ValidateField_numeronotafiscalcompleto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'competenciasimples' == $filtro)) || (is_array($filtro) && in_array('competenciasimples', $filtro)))
        $this->ValidateField_competenciasimples($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'codigoverificacao' == $filtro)) || (is_array($filtro) && in_array('codigoverificacao', $filtro)))
        $this->ValidateField_codigoverificacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'datarecebimentonota' == $filtro)) || (is_array($filtro) && in_array('datarecebimentonota', $filtro)))
        $this->ValidateField_datarecebimentonota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'numerolote' == $filtro)) || (is_array($filtro) && in_array('numerolote', $filtro)))
        $this->ValidateField_numerolote($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'protocolo' == $filtro)) || (is_array($filtro) && in_array('protocolo', $filtro)))
        $this->ValidateField_protocolo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idusuariocancelamento' == $filtro)) || (is_array($filtro) && in_array('idusuariocancelamento', $filtro)))
        $this->ValidateField_idusuariocancelamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'discriminacao' == $filtro)) || (is_array($filtro) && in_array('discriminacao', $filtro)))
        $this->ValidateField_discriminacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomereferencia' == $filtro)) || (is_array($filtro) && in_array('nomereferencia', $filtro)))
        $this->ValidateField_nomereferencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomearquivo' == $filtro)) || (is_array($filtro) && in_array('nomearquivo', $filtro)))
        $this->ValidateField_nomearquivo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomereferenciaboleto' == $filtro)) || (is_array($filtro) && in_array('nomereferenciaboleto', $filtro)))
        $this->ValidateField_nomereferenciaboleto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomearquivoboleto' == $filtro)) || (is_array($filtro) && in_array('nomearquivoboleto', $filtro)))
        $this->ValidateField_nomearquivoboleto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomereferenciaxml' == $filtro)) || (is_array($filtro) && in_array('nomereferenciaxml', $filtro)))
        $this->ValidateField_nomereferenciaxml($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomearquivoxml' == $filtro)) || (is_array($filtro) && in_array('nomearquivoxml', $filtro)))
        $this->ValidateField_nomearquivoxml($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---

      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      
/*----- Scriptcase Locale: Event onValidate ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  if ($this->sc_temp_varIdTenacidade == 1) {
	
	$check_sql = "SELECT IdFechamentoFinanceiro"
		   . " FROM fechamentofinanceiro"
		   . " WHERE IdTenacidade = '".$this->sc_temp_varIdTenacidade."' AND '".$this->datavencimento ."' >= DataInicial AND '".$this->datavencimento ."' <= DataFinal";
	 
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
			
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Nota fiscal não pode ser incluída. Já houve fechamento financeiro para esse período.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Nota fiscal não pode ser incluída. Já houve fechamento financeiro para esse período.';
 }
;
			
	}	
}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  if($this->idsituacaodocumento  == 4) {
	if((empty($this->databaixa ) || $this->databaixa  == "null")) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Campo obrigatório: Data da Baixa';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Campo obrigatório: Data da Baixa';
 }
;
	}
}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onValidateSuccess ------*/
 
          }
      }
   }

    function ValidateField_datacompetencia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datacompetencia, $this->field_config['datacompetencia']['date_sep']) ; 
      if (isset($this->Field_no_validate['datacompetencia'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datacompetencia']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datacompetencia']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datacompetencia']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datacompetencia']['date_sep']) ; 
          if (trim($this->datacompetencia) != "")  
          { 
              $validateTest = $teste_validade->Data($this->datacompetencia, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Serviços prestados em; " ; 
                  if (!isset($Campos_Erros['datacompetencia']))
                  {
                      $Campos_Erros['datacompetencia'] = array();
                  }
                  $Campos_Erros['datacompetencia'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datacompetencia']) || !is_array($this->NM_ajax_info['errList']['datacompetencia']))
                  {
                      $this->NM_ajax_info['errList']['datacompetencia'] = array();
                  }
                  $this->NM_ajax_info['errList']['datacompetencia'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['datacompetencia']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['datacompetencia'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Serviços prestados em" ; 
              if (!isset($Campos_Erros['datacompetencia']))
              {
                  $Campos_Erros['datacompetencia'] = array();
              }
              $Campos_Erros['datacompetencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['datacompetencia']) || !is_array($this->NM_ajax_info['errList']['datacompetencia']))
                  {
                      $this->NM_ajax_info['errList']['datacompetencia'] = array();
                  }
                  $this->NM_ajax_info['errList']['datacompetencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['datacompetencia']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datacompetencia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datacompetencia

    function ValidateField_idempresa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idempresa'])) {
       return;
   }
      if ($this->idempresa == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idempresa']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idempresa'] == "on"))
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
          if (!empty($this->idempresa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']) && !in_array($this->idempresa, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']))
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

    function ValidateField_idnotafiscal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idnotafiscal'])) {
          nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
          return;
      }
      if ($this->idnotafiscal === "" || is_null($this->idnotafiscal))  
      { 
          $this->idnotafiscal = 0;
      } 
      nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idnotafiscal' == $this->NM_ajax_opcao)
      { 
          if ($this->idnotafiscal != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->idnotafiscal) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idnotafiscal']))
                  {
                      $Campos_Erros['idnotafiscal'] = array();
                  }
                  $Campos_Erros['idnotafiscal'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idnotafiscal']) || !is_array($this->NM_ajax_info['errList']['idnotafiscal']))
                  {
                      $this->NM_ajax_info['errList']['idnotafiscal'] = array();
                  }
                  $this->NM_ajax_info['errList']['idnotafiscal'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idnotafiscal, 20, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.; " ; 
                  if (!isset($Campos_Erros['idnotafiscal']))
                  {
                      $Campos_Erros['idnotafiscal'] = array();
                  }
                  $Campos_Erros['idnotafiscal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idnotafiscal']) || !is_array($this->NM_ajax_info['errList']['idnotafiscal']))
                  {
                      $this->NM_ajax_info['errList']['idnotafiscal'] = array();
                  }
                  $this->NM_ajax_info['errList']['idnotafiscal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idnotafiscal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idnotafiscal

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
                  $Campos_Crit .= "Nome Fantasia - CNPJ: " . $this->Ini->Nm_lang['lang_errm_size']; 
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
                  $Campos_Crit .= "Nome Fantasia - CNPJ; " ; 
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
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idcliente']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idcliente'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Nome Fantasia - CNPJ" ; 
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

    function ValidateField_idplanoconta(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanoconta'])) {
       return;
   }
      if ($this->idplanoconta == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idplanoconta']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idplanoconta'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Plano de Contas" ; 
          if (!isset($Campos_Erros['idplanoconta']))
          {
              $Campos_Erros['idplanoconta'] = array();
          }
          $Campos_Erros['idplanoconta'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idplanoconta']) || !is_array($this->NM_ajax_info['errList']['idplanoconta']))
          {
              $this->NM_ajax_info['errList']['idplanoconta'] = array();
          }
          $this->NM_ajax_info['errList']['idplanoconta'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idplanoconta) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']) && !in_array($this->idplanoconta, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idplanoconta']))
              {
                  $Campos_Erros['idplanoconta'] = array();
              }
              $Campos_Erros['idplanoconta'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idplanoconta']) || !is_array($this->NM_ajax_info['errList']['idplanoconta']))
              {
                  $this->NM_ajax_info['errList']['idplanoconta'] = array();
              }
              $this->NM_ajax_info['errList']['idplanoconta'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
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

    function ValidateField_datavencimento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datavencimento, $this->field_config['datavencimento']['date_sep']) ; 
      if (isset($this->Field_no_validate['datavencimento'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datavencimento']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datavencimento']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datavencimento']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datavencimento']['date_sep']) ; 
          if (trim($this->datavencimento) != "")  
          { 
              $validateTest = $teste_validade->Data($this->datavencimento, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data do Vencimento; " ; 
                  if (!isset($Campos_Erros['datavencimento']))
                  {
                      $Campos_Erros['datavencimento'] = array();
                  }
                  $Campos_Erros['datavencimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datavencimento']) || !is_array($this->NM_ajax_info['errList']['datavencimento']))
                  {
                      $this->NM_ajax_info['errList']['datavencimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['datavencimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['datavencimento']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['datavencimento'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Data do Vencimento" ; 
              if (!isset($Campos_Erros['datavencimento']))
              {
                  $Campos_Erros['datavencimento'] = array();
              }
              $Campos_Erros['datavencimento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['datavencimento']) || !is_array($this->NM_ajax_info['errList']['datavencimento']))
                  {
                      $this->NM_ajax_info['errList']['datavencimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['datavencimento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['datavencimento']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datavencimento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datavencimento

    function ValidateField_valornotafiscal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valornotafiscal'])) {
          if (!empty($this->field_config['valornotafiscal']['symbol_dec'])) {
              $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']); 
              nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']) ; 
          }
          return;
      }
      if (!empty($this->field_config['valornotafiscal']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']); 
          nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']) ; 
          if ('.' == substr($this->valornotafiscal, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valornotafiscal, 1)))
              {
                  $this->valornotafiscal = '';
              }
              else
              {
                  $this->valornotafiscal = '0' . $this->valornotafiscal;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valornotafiscal != '')  
          { 
              $iTestSize = 13;
              if (strlen($this->valornotafiscal) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor dos Serviços: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valornotafiscal']))
                  {
                      $Campos_Erros['valornotafiscal'] = array();
                  }
                  $Campos_Erros['valornotafiscal'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valornotafiscal']) || !is_array($this->NM_ajax_info['errList']['valornotafiscal']))
                  {
                      $this->NM_ajax_info['errList']['valornotafiscal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valornotafiscal'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valornotafiscal, 10, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor dos Serviços; " ; 
                  if (!isset($Campos_Erros['valornotafiscal']))
                  {
                      $Campos_Erros['valornotafiscal'] = array();
                  }
                  $Campos_Erros['valornotafiscal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valornotafiscal']) || !is_array($this->NM_ajax_info['errList']['valornotafiscal']))
                  {
                      $this->NM_ajax_info['errList']['valornotafiscal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valornotafiscal'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['valornotafiscal']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['valornotafiscal'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Valor dos Serviços" ; 
              if (!isset($Campos_Erros['valornotafiscal']))
              {
                  $Campos_Erros['valornotafiscal'] = array();
              }
              $Campos_Erros['valornotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['valornotafiscal']) || !is_array($this->NM_ajax_info['errList']['valornotafiscal']))
                  {
                      $this->NM_ajax_info['errList']['valornotafiscal'] = array();
                  }
                  $this->NM_ajax_info['errList']['valornotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valornotafiscal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valornotafiscal

    function ValidateField_valoriss(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valoriss'])) {
          nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
          return;
      }
      if ($this->valoriss === "" || is_null($this->valoriss))  
      { 
          $this->valoriss = 0;
          $this->sc_force_zero[] = 'valoriss';
      } 
      nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valoriss != '')  
          { 
              $iTestSize = 12;
              if (strlen($this->valoriss) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor do ISS (%): " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valoriss']))
                  {
                      $Campos_Erros['valoriss'] = array();
                  }
                  $Campos_Erros['valoriss'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valoriss']) || !is_array($this->NM_ajax_info['errList']['valoriss']))
                  {
                      $this->NM_ajax_info['errList']['valoriss'] = array();
                  }
                  $this->NM_ajax_info['errList']['valoriss'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valoriss, 12, 0, 0, 100, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor do ISS (%); " ; 
                  if (!isset($Campos_Erros['valoriss']))
                  {
                      $Campos_Erros['valoriss'] = array();
                  }
                  $Campos_Erros['valoriss'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valoriss']) || !is_array($this->NM_ajax_info['errList']['valoriss']))
                  {
                      $this->NM_ajax_info['errList']['valoriss'] = array();
                  }
                  $this->NM_ajax_info['errList']['valoriss'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valoriss';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valoriss

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
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->valorliquido != '')  
          { 
              $iTestSize = 13;
              if (strlen($this->valorliquido) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Líquido: " . $this->Ini->Nm_lang['lang_errm_size']; 
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
              if ($teste_validade->Valor($this->valorliquido, 10, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor Líquido; " ; 
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
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['valorliquido']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['valorliquido'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Valor Líquido" ; 
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

    function ValidateField_idusuarioemissao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idusuarioemissao'])) {
       return;
   }
               if (!empty($this->idusuarioemissao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']) && !in_array($this->idusuarioemissao, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idusuarioemissao']))
                   {
                       $Campos_Erros['idusuarioemissao'] = array();
                   }
                   $Campos_Erros['idusuarioemissao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idusuarioemissao']) || !is_array($this->NM_ajax_info['errList']['idusuarioemissao']))
                   {
                       $this->NM_ajax_info['errList']['idusuarioemissao'] = array();
                   }
                   $this->NM_ajax_info['errList']['idusuarioemissao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idusuarioemissao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idusuarioemissao

    function ValidateField_idsituacaodocumento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idsituacaodocumento'])) {
       return;
   }
      if ($this->idsituacaodocumento == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idsituacaodocumento']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['idsituacaodocumento'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Situação" ; 
          if (!isset($Campos_Erros['idsituacaodocumento']))
          {
              $Campos_Erros['idsituacaodocumento'] = array();
          }
          $Campos_Erros['idsituacaodocumento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idsituacaodocumento']) || !is_array($this->NM_ajax_info['errList']['idsituacaodocumento']))
          {
              $this->NM_ajax_info['errList']['idsituacaodocumento'] = array();
          }
          $this->NM_ajax_info['errList']['idsituacaodocumento'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idsituacaodocumento) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']) && !in_array($this->idsituacaodocumento, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idsituacaodocumento']))
              {
                  $Campos_Erros['idsituacaodocumento'] = array();
              }
              $Campos_Erros['idsituacaodocumento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idsituacaodocumento']) || !is_array($this->NM_ajax_info['errList']['idsituacaodocumento']))
              {
                  $this->NM_ajax_info['errList']['idsituacaodocumento'] = array();
              }
              $this->NM_ajax_info['errList']['idsituacaodocumento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idsituacaodocumento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idsituacaodocumento

    function ValidateField_boletoliberado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['boletoliberado'])) {
       return;
   }
      if ($this->boletoliberado == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->boletoliberado != "" && !in_array("boletoliberado", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_boletoliberado']) && !in_array($this->boletoliberado, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_boletoliberado']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['boletoliberado']))
              {
                  $Campos_Erros['boletoliberado'] = array();
              }
              $Campos_Erros['boletoliberado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['boletoliberado']) || !is_array($this->NM_ajax_info['errList']['boletoliberado']))
              {
                  $this->NM_ajax_info['errList']['boletoliberado'] = array();
              }
              $this->NM_ajax_info['errList']['boletoliberado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'boletoliberado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_boletoliberado

    function ValidateField_datarecebimento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datarecebimento, $this->field_config['datarecebimento']['date_sep']) ; 
      if (isset($this->Field_no_validate['datarecebimento'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao == "incluir" || 'validate_datarecebimento' == $this->NM_ajax_opcao)
      { 
          $guarda_datahora = $this->field_config['datarecebimento']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datarecebimento']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datarecebimento']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datarecebimento']['date_sep']) ; 
          if (trim($this->datarecebimento) != "")  
          { 
              $validateTest = $teste_validade->Data($this->datarecebimento, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Recebido em; " ; 
                  if (!isset($Campos_Erros['datarecebimento']))
                  {
                      $Campos_Erros['datarecebimento'] = array();
                  }
                  $Campos_Erros['datarecebimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datarecebimento']) || !is_array($this->NM_ajax_info['errList']['datarecebimento']))
                  {
                      $this->NM_ajax_info['errList']['datarecebimento'] = array();
                  }
                  $this->NM_ajax_info['errList']['datarecebimento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datarecebimento']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datarecebimento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datarecebimento

    function ValidateField_databaixa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->databaixa, $this->field_config['databaixa']['date_sep']) ; 
      if (isset($this->Field_no_validate['databaixa'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao == "incluir" || 'validate_databaixa' == $this->NM_ajax_opcao)
      { 
          $guarda_datahora = $this->field_config['databaixa']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['databaixa']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['databaixa']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['databaixa']['date_sep']) ; 
          if (trim($this->databaixa) != "")  
          { 
              $validateTest = $teste_validade->Data($this->databaixa, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Baixado em; " ; 
                  if (!isset($Campos_Erros['databaixa']))
                  {
                      $Campos_Erros['databaixa'] = array();
                  }
                  $Campos_Erros['databaixa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['databaixa']) || !is_array($this->NM_ajax_info['errList']['databaixa']))
                  {
                      $this->NM_ajax_info['errList']['databaixa'] = array();
                  }
                  $this->NM_ajax_info['errList']['databaixa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['databaixa']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'databaixa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_databaixa

    function ValidateField_idusuariobaixa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idusuariobaixa'])) {
       return;
   }
   if ($this->nmgp_opcao == "incluir")
   {
               if (!empty($this->idusuariobaixa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']) && !in_array($this->idusuariobaixa, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idusuariobaixa']))
                   {
                       $Campos_Erros['idusuariobaixa'] = array();
                   }
                   $Campos_Erros['idusuariobaixa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idusuariobaixa']) || !is_array($this->NM_ajax_info['errList']['idusuariobaixa']))
                   {
                       $this->NM_ajax_info['errList']['idusuariobaixa'] = array();
                   }
                   $this->NM_ajax_info['errList']['idusuariobaixa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
   }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idusuariobaixa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idusuariobaixa

    function ValidateField_valorbaixa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['valorbaixa'])) {
          if (!empty($this->field_config['valorbaixa']['symbol_dec'])) {
              $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']); 
              nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->valorbaixa === "" || is_null($this->valorbaixa))  
      { 
          $this->valorbaixa = 0;
          $this->sc_force_zero[] = 'valorbaixa';
      } 
      if (!empty($this->field_config['valorbaixa']['symbol_dec']))
      {
          $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']); 
          nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']) ; 
          if ('.' == substr($this->valorbaixa, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->valorbaixa, 1)))
              {
                  $this->valorbaixa = '';
              }
              else
              {
                  $this->valorbaixa = '0' . $this->valorbaixa;
              }
          }
      }
      if ($this->nmgp_opcao == "incluir" || 'validate_valorbaixa' == $this->NM_ajax_opcao)
      { 
          if ($this->valorbaixa != '')  
          { 
              $iTestSize = 13;
              if (strlen($this->valorbaixa) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor da Baixa: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['valorbaixa']))
                  {
                      $Campos_Erros['valorbaixa'] = array();
                  }
                  $Campos_Erros['valorbaixa'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['valorbaixa']) || !is_array($this->NM_ajax_info['errList']['valorbaixa']))
                  {
                      $this->NM_ajax_info['errList']['valorbaixa'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorbaixa'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->valorbaixa, 10, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Valor da Baixa; " ; 
                  if (!isset($Campos_Erros['valorbaixa']))
                  {
                      $Campos_Erros['valorbaixa'] = array();
                  }
                  $Campos_Erros['valorbaixa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['valorbaixa']) || !is_array($this->NM_ajax_info['errList']['valorbaixa']))
                  {
                      $this->NM_ajax_info['errList']['valorbaixa'] = array();
                  }
                  $this->NM_ajax_info['errList']['valorbaixa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'valorbaixa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_valorbaixa

    function ValidateField_idlancamentoreceita(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idlancamentoreceita'])) {
          nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->idlancamentoreceita === "" || is_null($this->idlancamentoreceita))  
      { 
          $this->idlancamentoreceita = 0;
          $this->sc_force_zero[] = 'idlancamentoreceita';
      } 
      }
      nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idlancamentoreceita' == $this->NM_ajax_opcao)
      { 
          if ($this->idlancamentoreceita != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->idlancamentoreceita) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Conta a Receber: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idlancamentoreceita']))
                  {
                      $Campos_Erros['idlancamentoreceita'] = array();
                  }
                  $Campos_Erros['idlancamentoreceita'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idlancamentoreceita']) || !is_array($this->NM_ajax_info['errList']['idlancamentoreceita']))
                  {
                      $this->NM_ajax_info['errList']['idlancamentoreceita'] = array();
                  }
                  $this->NM_ajax_info['errList']['idlancamentoreceita'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idlancamentoreceita, 20, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Conta a Receber; " ; 
                  if (!isset($Campos_Erros['idlancamentoreceita']))
                  {
                      $Campos_Erros['idlancamentoreceita'] = array();
                  }
                  $Campos_Erros['idlancamentoreceita'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idlancamentoreceita']) || !is_array($this->NM_ajax_info['errList']['idlancamentoreceita']))
                  {
                      $this->NM_ajax_info['errList']['idlancamentoreceita'] = array();
                  }
                  $this->NM_ajax_info['errList']['idlancamentoreceita'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idlancamentoreceita';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idlancamentoreceita

    function ValidateField_numeronotafiscal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['numeronotafiscal'])) {
          return;
      }
      $this->nm_tira_mask($this->numeronotafiscal, "9999 / 9999", "(){}[].,;:-+/ "); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->numeronotafiscal) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Número da Nota Fiscal " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['numeronotafiscal']))
              {
                  $Campos_Erros['numeronotafiscal'] = array();
              }
              $Campos_Erros['numeronotafiscal'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['numeronotafiscal']) || !is_array($this->NM_ajax_info['errList']['numeronotafiscal']))
              {
                  $this->NM_ajax_info['errList']['numeronotafiscal'] = array();
              }
              $this->NM_ajax_info['errList']['numeronotafiscal'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'numeronotafiscal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_numeronotafiscal

    function ValidateField_numeronotafiscalcompleto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['numeronotafiscalcompleto'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->numeronotafiscalcompleto) > 80) 
          { 
              $hasError = true;
              $Campos_Crit .= "Número da Nota Fiscal Completo " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 80 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['numeronotafiscalcompleto']))
              {
                  $Campos_Erros['numeronotafiscalcompleto'] = array();
              }
              $Campos_Erros['numeronotafiscalcompleto'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 80 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['numeronotafiscalcompleto']) || !is_array($this->NM_ajax_info['errList']['numeronotafiscalcompleto']))
              {
                  $this->NM_ajax_info['errList']['numeronotafiscalcompleto'] = array();
              }
              $this->NM_ajax_info['errList']['numeronotafiscalcompleto'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 80 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'numeronotafiscalcompleto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_numeronotafiscalcompleto

    function ValidateField_competenciasimples(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->competenciasimples, $this->field_config['competenciasimples']['date_sep']) ; 
      if (isset($this->Field_no_validate['competenciasimples'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['competenciasimples']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['competenciasimples']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['competenciasimples']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['competenciasimples']['date_sep']) ; 
          if (trim($this->competenciasimples) != "")  
          { 
              $validateTest = $teste_validade->Data($this->competenciasimples, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Competência simples; " ; 
                  if (!isset($Campos_Erros['competenciasimples']))
                  {
                      $Campos_Erros['competenciasimples'] = array();
                  }
                  $Campos_Erros['competenciasimples'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['competenciasimples']) || !is_array($this->NM_ajax_info['errList']['competenciasimples']))
                  {
                      $this->NM_ajax_info['errList']['competenciasimples'] = array();
                  }
                  $this->NM_ajax_info['errList']['competenciasimples'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['competenciasimples']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'competenciasimples';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_competenciasimples

    function ValidateField_codigoverificacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['codigoverificacao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->codigoverificacao) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Código de Verificação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['codigoverificacao']))
              {
                  $Campos_Erros['codigoverificacao'] = array();
              }
              $Campos_Erros['codigoverificacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['codigoverificacao']) || !is_array($this->NM_ajax_info['errList']['codigoverificacao']))
              {
                  $this->NM_ajax_info['errList']['codigoverificacao'] = array();
              }
              $this->NM_ajax_info['errList']['codigoverificacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'codigoverificacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_codigoverificacao

    function ValidateField_datarecebimentonota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_sep']) ; 
      nm_limpa_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datarecebimentonota'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datarecebimentonota']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datarecebimentonota']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datarecebimentonota']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datarecebimentonota']['date_sep']) ; 
          $Format_Hora = $this->field_config['datarecebimentonota_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datarecebimentonota_hora']['time_sep']) ; 
          if (trim($this->datarecebimentonota) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->datarecebimentonota, $Format_Data, $this->datarecebimentonota_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->datarecebimentonota_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->datarecebimentonota, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->datarecebimentonota, $Format_Data, $this->datarecebimentonota_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->datarecebimentonota_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->datarecebimentonota, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data Recebimento Nota; " ; 
                  if (!isset($Campos_Erros['datarecebimentonota']))
                  {
                      $Campos_Erros['datarecebimentonota'] = array();
                  }
                  $Campos_Erros['datarecebimentonota'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datarecebimentonota']) || !is_array($this->NM_ajax_info['errList']['datarecebimentonota']))
                  {
                      $this->NM_ajax_info['errList']['datarecebimentonota'] = array();
                  }
                  $this->NM_ajax_info['errList']['datarecebimentonota'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['datarecebimentonota']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datarecebimentonota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datarecebimentonota_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['datarecebimentonota_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datarecebimentonota_hora']['time_sep']) ; 
          if (trim($this->datarecebimentonota_hora) != "")  
          { 
              if ($teste_validade->Hora($this->datarecebimentonota_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data Recebimento Nota; " ; 
                  if (!isset($Campos_Erros['datarecebimentonota_hora']))
                  {
                      $Campos_Erros['datarecebimentonota_hora'] = array();
                  }
                  $Campos_Erros['datarecebimentonota_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datarecebimentonota']) || !is_array($this->NM_ajax_info['errList']['datarecebimentonota']))
                  {
                      $this->NM_ajax_info['errList']['datarecebimentonota'] = array();
                  }
                  $this->NM_ajax_info['errList']['datarecebimentonota'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datarecebimentonota_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datarecebimentonota_hora

    function ValidateField_numerolote(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['numerolote'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->numerolote) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Numero Lote " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['numerolote']))
              {
                  $Campos_Erros['numerolote'] = array();
              }
              $Campos_Erros['numerolote'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['numerolote']) || !is_array($this->NM_ajax_info['errList']['numerolote']))
              {
                  $this->NM_ajax_info['errList']['numerolote'] = array();
              }
              $this->NM_ajax_info['errList']['numerolote'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'numerolote';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_numerolote

    function ValidateField_protocolo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['protocolo'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->protocolo) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Protocolo/Chave de acesso " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['protocolo']))
              {
                  $Campos_Erros['protocolo'] = array();
              }
              $Campos_Erros['protocolo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['protocolo']) || !is_array($this->NM_ajax_info['errList']['protocolo']))
              {
                  $this->NM_ajax_info['errList']['protocolo'] = array();
              }
              $this->NM_ajax_info['errList']['protocolo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'protocolo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_protocolo

    function ValidateField_idusuariocancelamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idusuariocancelamento'])) {
          nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
          return;
      }
      if ($this->idusuariocancelamento === "" || is_null($this->idusuariocancelamento))  
      { 
          $this->idusuariocancelamento = 0;
          $this->sc_force_zero[] = 'idusuariocancelamento';
      } 
      nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->idusuariocancelamento != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idusuariocancelamento) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Usuario Cancelamento: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idusuariocancelamento']))
                  {
                      $Campos_Erros['idusuariocancelamento'] = array();
                  }
                  $Campos_Erros['idusuariocancelamento'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idusuariocancelamento']) || !is_array($this->NM_ajax_info['errList']['idusuariocancelamento']))
                  {
                      $this->NM_ajax_info['errList']['idusuariocancelamento'] = array();
                  }
                  $this->NM_ajax_info['errList']['idusuariocancelamento'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idusuariocancelamento, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Usuario Cancelamento; " ; 
                  if (!isset($Campos_Erros['idusuariocancelamento']))
                  {
                      $Campos_Erros['idusuariocancelamento'] = array();
                  }
                  $Campos_Erros['idusuariocancelamento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idusuariocancelamento']) || !is_array($this->NM_ajax_info['errList']['idusuariocancelamento']))
                  {
                      $this->NM_ajax_info['errList']['idusuariocancelamento'] = array();
                  }
                  $this->NM_ajax_info['errList']['idusuariocancelamento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idusuariocancelamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idusuariocancelamento

    function ValidateField_discriminacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['discriminacao'])) {
          return;
      }
      $this->discriminacao = sc_strtoupper($this->discriminacao); 
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['discriminacao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['php_cmp_required']['discriminacao'] == "on")) 
      { 
          if ($this->discriminacao == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Discriminação" ; 
              if (!isset($Campos_Erros['discriminacao']))
              {
                  $Campos_Erros['discriminacao'] = array();
              }
              $Campos_Erros['discriminacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['discriminacao']) || !is_array($this->NM_ajax_info['errList']['discriminacao']))
                  {
                      $this->NM_ajax_info['errList']['discriminacao'] = array();
                  }
                  $this->NM_ajax_info['errList']['discriminacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->discriminacao) > 32767) 
          { 
              $hasError = true;
              $Campos_Crit .= "Discriminação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['discriminacao']))
              {
                  $Campos_Erros['discriminacao'] = array();
              }
              $Campos_Erros['discriminacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['discriminacao']) || !is_array($this->NM_ajax_info['errList']['discriminacao']))
              {
                  $this->NM_ajax_info['errList']['discriminacao'] = array();
              }
              $this->NM_ajax_info['errList']['discriminacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'discriminacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_discriminacao

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
                include_once 'NotaFiscal_Frm_doc_name.php';
            }
            $this->nomereferencia = sc_upload_unprotect_chars($this->nomereferencia, true);
            $this->nomereferencia_scfile_name = sc_upload_unprotect_chars($this->nomereferencia_scfile_name, true);
            if (strpos($this->nomereferencia, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Nota fiscal: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
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
                $Campos_Crit .= "Nota fiscal: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
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
              $Campos_Crit .= " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
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

    function ValidateField_nomereferenciaboleto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomereferenciaboleto'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->nomereferenciaboleto;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'NotaFiscal_Frm_doc_name.php';
            }
            $this->nomereferenciaboleto = sc_upload_unprotect_chars($this->nomereferenciaboleto, true);
            $this->nomereferenciaboleto_scfile_name = sc_upload_unprotect_chars($this->nomereferenciaboleto_scfile_name, true);
            if (strpos($this->nomereferenciaboleto, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Boleto: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
                if (!isset($Campos_Erros['nomereferenciaboleto']))
                {
                    $Campos_Erros['nomereferenciaboleto'] = array();
                }
                $Campos_Erros['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
                if (!isset($this->NM_ajax_info['errList']['nomereferenciaboleto']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaboleto']))
                {
                    $this->NM_ajax_info['errList']['nomereferenciaboleto'] = array();
                }
                $this->NM_ajax_info['errList']['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
            }
            if ("" != $this->nomereferenciaboleto && "S" != $this->nomereferenciaboleto_limpa && !$teste_validade->ArqExtensao($this->nomereferenciaboleto, array()))
            {
                $hasError = true;
                $Campos_Crit .= "Boleto: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['nomereferenciaboleto']))
                {
                    $Campos_Erros['nomereferenciaboleto'] = array();
                }
                $Campos_Erros['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['nomereferenciaboleto']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaboleto']))
                {
                    $this->NM_ajax_info['errList']['nomereferenciaboleto'] = array();
                }
                $this->NM_ajax_info['errList']['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomereferenciaboleto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomereferenciaboleto

    function ValidateField_nomearquivoboleto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomearquivoboleto'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->nomearquivoboleto) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['nomearquivoboleto']))
              {
                  $Campos_Erros['nomearquivoboleto'] = array();
              }
              $Campos_Erros['nomearquivoboleto'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['nomearquivoboleto']) || !is_array($this->NM_ajax_info['errList']['nomearquivoboleto']))
              {
                  $this->NM_ajax_info['errList']['nomearquivoboleto'] = array();
              }
              $this->NM_ajax_info['errList']['nomearquivoboleto'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomearquivoboleto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomearquivoboleto

    function ValidateField_nomereferenciaxml(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomereferenciaxml'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->nomereferenciaxml;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'NotaFiscal_Frm_doc_name.php';
            }
            $this->nomereferenciaxml = sc_upload_unprotect_chars($this->nomereferenciaxml, true);
            $this->nomereferenciaxml_scfile_name = sc_upload_unprotect_chars($this->nomereferenciaxml_scfile_name, true);
            if (strpos($this->nomereferenciaxml, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Xml: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
                if (!isset($Campos_Erros['nomereferenciaxml']))
                {
                    $Campos_Erros['nomereferenciaxml'] = array();
                }
                $Campos_Erros['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
                if (!isset($this->NM_ajax_info['errList']['nomereferenciaxml']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaxml']))
                {
                    $this->NM_ajax_info['errList']['nomereferenciaxml'] = array();
                }
                $this->NM_ajax_info['errList']['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
            }
            if ("" != $this->nomereferenciaxml && "S" != $this->nomereferenciaxml_limpa && !$teste_validade->ArqExtensao($this->nomereferenciaxml, array('xml')))
            {
                $hasError = true;
                $Campos_Crit .= "Xml: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['nomereferenciaxml']))
                {
                    $Campos_Erros['nomereferenciaxml'] = array();
                }
                $Campos_Erros['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['nomereferenciaxml']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaxml']))
                {
                    $this->NM_ajax_info['errList']['nomereferenciaxml'] = array();
                }
                $this->NM_ajax_info['errList']['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
            if (!$hasError && "" != $this->nomereferenciaxml && "S" != $this->nomereferenciaxml_limpa) {
                if (!function_exists('sc_upload_unprotect_chars')) {
                    include_once 'NotaFiscal_Frm_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ($hasError) {
                    $Campos_Crit .= "Xml: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($Campos_Erros['nomereferenciaxml']))
                    {
                        $Campos_Erros['nomereferenciaxml'] = array();
                    }
                    $Campos_Erros['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($this->NM_ajax_info['errList']['nomereferenciaxml']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaxml']))
                    {
                        $this->NM_ajax_info['errList']['nomereferenciaxml'] = array();
                    }
                    $this->NM_ajax_info['errList']['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                }
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomereferenciaxml';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomereferenciaxml

    function ValidateField_nomearquivoxml(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomearquivoxml'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->nomearquivoxml) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['nomearquivoxml']))
              {
                  $Campos_Erros['nomearquivoxml'] = array();
              }
              $Campos_Erros['nomearquivoxml'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['nomearquivoxml']) || !is_array($this->NM_ajax_info['errList']['nomearquivoxml']))
              {
                  $this->NM_ajax_info['errList']['nomearquivoxml'] = array();
              }
              $this->NM_ajax_info['errList']['nomearquivoxml'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomearquivoxml';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomearquivoxml
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
                  if (nm_mkdir($dir_doc))  
                  { 
                      $arq_nomereferencia = fopen($dir_doc . trim($this->nomereferencia_scfile_name), "w") ; 
                      fwrite($arq_nomereferencia, $reg_nomereferencia) ;  
                      fclose($arq_nomereferencia) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Nota fiscal: " . $this->Ini->Nm_lang['lang_errm_ivdr']; 
                      if (!isset($Campos_Erros['nomereferencia']))
                      {
                          $Campos_Erros['nomereferencia'] = array();
                      }
                      $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                      if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                      {
                          $this->NM_ajax_info['errList']['nomereferencia'] = array();
                      }
                      $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                  } 
                 } 
              } 
              else 
              { 
                  $Campos_Crit .= "Nota fiscal " . $this->Ini->Nm_lang['lang_errm_upld']; 
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
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->nomereferenciaboleto == "none") 
          { 
              $this->nomereferenciaboleto = ""; 
          } 
          if ($this->nomereferenciaboleto != "") 
          { 
              if (!is_file($this->nomereferenciaboleto) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->nomereferenciaboleto, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->nomereferenciaboleto = $mbConvertFileName;
                  }
              }
              if (is_file($this->nomereferenciaboleto))  
              { 
                  if ($this->nmgp_opcao == "incluir")
                  { 
                      $this->SC_DOC_nomereferenciaboleto = $this->nomereferenciaboleto;
                  } 
                  else 
                  { 
                      $arq_nomereferenciaboleto = fopen($this->nomereferenciaboleto, "r") ; 
                      $reg_nomereferenciaboleto = fread($arq_nomereferenciaboleto, filesize($this->nomereferenciaboleto)) ; 
                      fclose($arq_nomereferenciaboleto) ;  
                  } 
                  $this->NM_size_docs[$this->nomereferenciaboleto_scfile_name] = $this->sc_file_size($this->nomereferenciaboleto);
                  $this->nomereferenciaboleto =  trim($this->nomereferenciaboleto_scfile_name) ;  
                  $dir_doc = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
                 if ($this->nmgp_opcao != "incluir")
                 { 
                  if (nm_mkdir($dir_doc))  
                  { 
                      $arq_nomereferenciaboleto = fopen($dir_doc . trim($this->nomereferenciaboleto_scfile_name), "w") ; 
                      fwrite($arq_nomereferenciaboleto, $reg_nomereferenciaboleto) ;  
                      fclose($arq_nomereferenciaboleto) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Boleto: " . $this->Ini->Nm_lang['lang_errm_ivdr']; 
                      if (!isset($Campos_Erros['nomereferenciaboleto']))
                      {
                          $Campos_Erros['nomereferenciaboleto'] = array();
                      }
                      $Campos_Erros['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                      if (!isset($this->NM_ajax_info['errList']['nomereferenciaboleto']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaboleto']))
                      {
                          $this->NM_ajax_info['errList']['nomereferenciaboleto'] = array();
                      }
                      $this->NM_ajax_info['errList']['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                  } 
                 } 
              } 
              else 
              { 
                  $Campos_Crit .= "Boleto " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->nomereferenciaboleto = "";
                  if (!isset($Campos_Erros['nomereferenciaboleto']))
                  {
                      $Campos_Erros['nomereferenciaboleto'] = array();
                  }
                  $Campos_Erros['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['nomereferenciaboleto']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaboleto']))
                  {
                      $this->NM_ajax_info['errList']['nomereferenciaboleto'] = array();
                  }
                  $this->NM_ajax_info['errList']['nomereferenciaboleto'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
          elseif (!empty($this->nomereferenciaboleto_salva) && $this->nomereferenciaboleto_limpa != "S")
          {
              $this->nomereferenciaboleto = $this->nomereferenciaboleto_salva;
          }
      } 
      elseif (!empty($this->nomereferenciaboleto_salva) && $this->nomereferenciaboleto_limpa != "S")
      {
          $this->nomereferenciaboleto = $this->nomereferenciaboleto_salva;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->nomereferenciaxml == "none") 
          { 
              $this->nomereferenciaxml = ""; 
          } 
          if ($this->nomereferenciaxml != "") 
          { 
              if (!is_file($this->nomereferenciaxml) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->nomereferenciaxml, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->nomereferenciaxml = $mbConvertFileName;
                  }
              }
              if (is_file($this->nomereferenciaxml))  
              { 
                  if ($this->nmgp_opcao == "incluir")
                  { 
                      $this->SC_DOC_nomereferenciaxml = $this->nomereferenciaxml;
                  } 
                  else 
                  { 
                      $arq_nomereferenciaxml = fopen($this->nomereferenciaxml, "r") ; 
                      $reg_nomereferenciaxml = fread($arq_nomereferenciaxml, filesize($this->nomereferenciaxml)) ; 
                      fclose($arq_nomereferenciaxml) ;  
                  } 
                  $this->NM_size_docs[$this->nomereferenciaxml_scfile_name] = $this->sc_file_size($this->nomereferenciaxml);
                  $this->nomereferenciaxml =  trim($this->nomereferenciaxml_scfile_name) ;  
                  $dir_doc = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
                 if ($this->nmgp_opcao != "incluir")
                 { 
                  if (nm_mkdir($dir_doc))  
                  { 
                      $_test_file = $this->fetchUniqueUploadName($this->nomereferenciaxml_scfile_name, $dir_doc, "nomereferenciaxml");
                      if (trim($this->nomereferenciaxml_scfile_name) != $_test_file)
                      {
                          $this->nomereferenciaxml_scfile_name = $_test_file;
                          $this->nomereferenciaxml = $_test_file;
                      }
                      $arq_nomereferenciaxml = fopen($dir_doc . trim($this->nomereferenciaxml_scfile_name), "w") ; 
                      fwrite($arq_nomereferenciaxml, $reg_nomereferenciaxml) ;  
                      fclose($arq_nomereferenciaxml) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Xml: " . $this->Ini->Nm_lang['lang_errm_ivdr']; 
                      if (!isset($Campos_Erros['nomereferenciaxml']))
                      {
                          $Campos_Erros['nomereferenciaxml'] = array();
                      }
                      $Campos_Erros['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                      if (!isset($this->NM_ajax_info['errList']['nomereferenciaxml']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaxml']))
                      {
                          $this->NM_ajax_info['errList']['nomereferenciaxml'] = array();
                      }
                      $this->NM_ajax_info['errList']['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                  } 
                 } 
              } 
              else 
              { 
                  $Campos_Crit .= "Xml " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->nomereferenciaxml = "";
                  if (!isset($Campos_Erros['nomereferenciaxml']))
                  {
                      $Campos_Erros['nomereferenciaxml'] = array();
                  }
                  $Campos_Erros['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['nomereferenciaxml']) || !is_array($this->NM_ajax_info['errList']['nomereferenciaxml']))
                  {
                      $this->NM_ajax_info['errList']['nomereferenciaxml'] = array();
                  }
                  $this->NM_ajax_info['errList']['nomereferenciaxml'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
          elseif (!empty($this->nomereferenciaxml_salva) && $this->nomereferenciaxml_limpa != "S")
          {
              $this->nomereferenciaxml = $this->nomereferenciaxml_salva;
          }
      } 
      elseif (!empty($this->nomereferenciaxml_salva) && $this->nomereferenciaxml_limpa != "S")
      {
          $this->nomereferenciaxml = $this->nomereferenciaxml_salva;
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
    $this->nmgp_dados_form['datacompetencia'] = (strlen(trim($this->datacompetencia)) > 19) ? str_replace(".", ":", $this->datacompetencia) : trim($this->datacompetencia);
    $this->nmgp_dados_form['idempresa'] = $this->idempresa;
    $this->nmgp_dados_form['idnotafiscal'] = $this->idnotafiscal;
    $this->nmgp_dados_form['idcliente'] = $this->idcliente;
    $this->nmgp_dados_form['idplanoconta'] = $this->idplanoconta;
    $this->nmgp_dados_form['datavencimento'] = (strlen(trim($this->datavencimento)) > 19) ? str_replace(".", ":", $this->datavencimento) : trim($this->datavencimento);
    $this->nmgp_dados_form['valornotafiscal'] = $this->valornotafiscal;
    $this->nmgp_dados_form['valoriss'] = $this->valoriss;
    $this->nmgp_dados_form['valorliquido'] = $this->valorliquido;
    $this->nmgp_dados_form['idusuarioemissao'] = $this->idusuarioemissao;
    $this->nmgp_dados_form['idsituacaodocumento'] = $this->idsituacaodocumento;
    $this->nmgp_dados_form['boletoliberado'] = $this->boletoliberado;
    $this->nmgp_dados_form['datarecebimento'] = (strlen(trim($this->datarecebimento)) > 19) ? str_replace(".", ":", $this->datarecebimento) : trim($this->datarecebimento);
    $this->nmgp_dados_form['databaixa'] = (strlen(trim($this->databaixa)) > 19) ? str_replace(".", ":", $this->databaixa) : trim($this->databaixa);
    $this->nmgp_dados_form['idusuariobaixa'] = $this->idusuariobaixa;
    $this->nmgp_dados_form['valorbaixa'] = $this->valorbaixa;
    $this->nmgp_dados_form['idlancamentoreceita'] = $this->idlancamentoreceita;
    $this->nmgp_dados_form['numeronotafiscal'] = $this->numeronotafiscal;
    $this->nmgp_dados_form['numeronotafiscalcompleto'] = $this->numeronotafiscalcompleto;
    $this->nmgp_dados_form['competenciasimples'] = (strlen(trim($this->competenciasimples)) > 19) ? str_replace(".", ":", $this->competenciasimples) : trim($this->competenciasimples);
    $this->nmgp_dados_form['codigoverificacao'] = $this->codigoverificacao;
    $this->nmgp_dados_form['datarecebimentonota'] = (strlen(trim($this->datarecebimentonota)) > 19) ? str_replace(".", ":", $this->datarecebimentonota) : trim($this->datarecebimentonota);
    $this->nmgp_dados_form['numerolote'] = $this->numerolote;
    $this->nmgp_dados_form['protocolo'] = $this->protocolo;
    $this->nmgp_dados_form['idusuariocancelamento'] = $this->idusuariocancelamento;
    $this->nmgp_dados_form['discriminacao'] = $this->discriminacao;
    if (empty($this->nomereferencia))
    {
        $this->nomereferencia = $this->nmgp_dados_form['nomereferencia'];
    }
    $this->nmgp_dados_form['nomereferencia'] = $this->nomereferencia;
    $this->nmgp_dados_form['nomereferencia_limpa'] = $this->nomereferencia_limpa;
    $this->nmgp_dados_form['nomearquivo'] = $this->nomearquivo;
    if (empty($this->nomereferenciaboleto))
    {
        $this->nomereferenciaboleto = $this->nmgp_dados_form['nomereferenciaboleto'];
    }
    $this->nmgp_dados_form['nomereferenciaboleto'] = $this->nomereferenciaboleto;
    $this->nmgp_dados_form['nomereferenciaboleto_limpa'] = $this->nomereferenciaboleto_limpa;
    $this->nmgp_dados_form['nomearquivoboleto'] = $this->nomearquivoboleto;
    if (empty($this->nomereferenciaxml))
    {
        $this->nomereferenciaxml = $this->nmgp_dados_form['nomereferenciaxml'];
    }
    $this->nmgp_dados_form['nomereferenciaxml'] = $this->nomereferenciaxml;
    $this->nmgp_dados_form['nomereferenciaxml_limpa'] = $this->nomereferenciaxml_limpa;
    $this->nmgp_dados_form['nomearquivoxml'] = $this->nomearquivoxml;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['dataemissao'] = $this->dataemissao;
    $this->nmgp_dados_form['dataliberacaoboleto'] = $this->dataliberacaoboleto;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['datacompetencia'] = $this->datacompetencia;
      nm_limpa_data($this->datacompetencia, $this->field_config['datacompetencia']['date_sep']) ; 
      $this->Before_unformat['idnotafiscal'] = $this->idnotafiscal;
      nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      $this->Before_unformat['idcliente'] = $this->idcliente;
      nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      $this->Before_unformat['datavencimento'] = $this->datavencimento;
      nm_limpa_data($this->datavencimento, $this->field_config['datavencimento']['date_sep']) ; 
      $this->Before_unformat['valornotafiscal'] = $this->valornotafiscal;
      if (!empty($this->field_config['valornotafiscal']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']);
         nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']);
      }
      $this->Before_unformat['valoriss'] = $this->valoriss;
      nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
      $this->Before_unformat['valorliquido'] = $this->valorliquido;
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']);
         nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']);
      }
      $this->Before_unformat['datarecebimento'] = $this->datarecebimento;
      nm_limpa_data($this->datarecebimento, $this->field_config['datarecebimento']['date_sep']) ; 
      $this->Before_unformat['databaixa'] = $this->databaixa;
      nm_limpa_data($this->databaixa, $this->field_config['databaixa']['date_sep']) ; 
      $this->Before_unformat['valorbaixa'] = $this->valorbaixa;
      if (!empty($this->field_config['valorbaixa']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']);
         nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']);
      }
      $this->Before_unformat['idlancamentoreceita'] = $this->idlancamentoreceita;
      nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      $this->Before_unformat['numeronotafiscal'] = $this->numeronotafiscal;
      $this->nm_tira_mask($this->numeronotafiscal, "9999 / 9999", "(){}[].,;:-+/ "); 
      $this->Before_unformat['competenciasimples'] = $this->competenciasimples;
      nm_limpa_data($this->competenciasimples, $this->field_config['competenciasimples']['date_sep']) ; 
      $this->Before_unformat['datarecebimentonota'] = $this->datarecebimentonota;
      $this->Before_unformat['datarecebimentonota_hora'] = $this->datarecebimentonota_hora;
      nm_limpa_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_sep']) ; 
      nm_limpa_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['time_sep']) ; 
      $this->Before_unformat['idusuariocancelamento'] = $this->idusuariocancelamento;
      nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
      $this->Before_unformat['idtenacidade'] = $this->idtenacidade;
      nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
      $this->Before_unformat['idusuarioauditoria'] = $this->idusuarioauditoria;
      nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
      $this->Before_unformat['dataemissao'] = $this->dataemissao;
      $this->Before_unformat['dataemissao_hora'] = $this->dataemissao_hora;
      nm_limpa_data($this->dataemissao, $this->field_config['dataemissao']['date_sep']) ; 
      nm_limpa_hora($this->dataemissao_hora, $this->field_config['dataemissao']['time_sep']) ; 
      $this->Before_unformat['dataliberacaoboleto'] = $this->dataliberacaoboleto;
      $this->Before_unformat['dataliberacaoboleto_hora'] = $this->dataliberacaoboleto_hora;
      nm_limpa_data($this->dataliberacaoboleto, $this->field_config['dataliberacaoboleto']['date_sep']) ; 
      nm_limpa_hora($this->dataliberacaoboleto_hora, $this->field_config['dataliberacaoboleto']['time_sep']) ; 
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
      if ($Nome_Campo == "idnotafiscal")
      {
          nm_limpa_numero($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idcliente")
      {
          nm_limpa_numero($this->idcliente, $this->field_config['idcliente']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valornotafiscal")
      {
          if (!empty($this->field_config['valornotafiscal']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_mon']);
             nm_limpa_valor($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_dec'], $this->field_config['valornotafiscal']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valoriss")
      {
          nm_limpa_numero($this->valoriss, $this->field_config['valoriss']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "valorliquido")
      {
          if (!empty($this->field_config['valorliquido']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']);
             nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "valorbaixa")
      {
          if (!empty($this->field_config['valorbaixa']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_mon']);
             nm_limpa_valor($this->valorbaixa, $this->field_config['valorbaixa']['symbol_dec'], $this->field_config['valorbaixa']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "idlancamentoreceita")
      {
          nm_limpa_numero($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "numeronotafiscal")
      {
          $this->nm_tira_mask($this->numeronotafiscal, "9999 / 9999", "(){}[].,;:-+/ "); 
      }
      if ($Nome_Campo == "idusuariocancelamento")
      {
          nm_limpa_numero($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp']) ; 
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
      if ((!empty($this->datacompetencia) && 'null' != $this->datacompetencia) || (!empty($format_fields) && isset($format_fields['datacompetencia'])))
      {
          nm_volta_data($this->datacompetencia, $this->field_config['datacompetencia']['date_format']) ; 
          nmgp_Form_Datas($this->datacompetencia, $this->field_config['datacompetencia']['date_format'], $this->field_config['datacompetencia']['date_sep']) ;  
      }
      elseif ('null' == $this->datacompetencia || '' == $this->datacompetencia)
      {
          $this->datacompetencia = '';
      }
      if ('' !== $this->idnotafiscal || (!empty($format_fields) && isset($format_fields['idnotafiscal'])))
      {
          nmgp_Form_Num_Val($this->idnotafiscal, $this->field_config['idnotafiscal']['symbol_grp'], $this->field_config['idnotafiscal']['symbol_dec'], "0", "S", $this->field_config['idnotafiscal']['format_neg'], "", "", "-", $this->field_config['idnotafiscal']['symbol_fmt']) ; 
      }
      if ('' !== $this->idcliente || (!empty($format_fields) && isset($format_fields['idcliente'])))
      {
          nmgp_Form_Num_Val($this->idcliente, $this->field_config['idcliente']['symbol_grp'], $this->field_config['idcliente']['symbol_dec'], "0", "S", $this->field_config['idcliente']['format_neg'], "", "", "-", $this->field_config['idcliente']['symbol_fmt']) ; 
      }
      if ((!empty($this->datavencimento) && 'null' != $this->datavencimento) || (!empty($format_fields) && isset($format_fields['datavencimento'])))
      {
          nm_volta_data($this->datavencimento, $this->field_config['datavencimento']['date_format']) ; 
          nmgp_Form_Datas($this->datavencimento, $this->field_config['datavencimento']['date_format'], $this->field_config['datavencimento']['date_sep']) ;  
      }
      elseif ('null' == $this->datavencimento || '' == $this->datavencimento)
      {
          $this->datavencimento = '';
      }
      if ('' !== $this->valornotafiscal || (!empty($format_fields) && isset($format_fields['valornotafiscal'])))
      {
          nmgp_Form_Num_Val($this->valornotafiscal, $this->field_config['valornotafiscal']['symbol_grp'], $this->field_config['valornotafiscal']['symbol_dec'], "2", "S", $this->field_config['valornotafiscal']['format_neg'], "", "", "-", $this->field_config['valornotafiscal']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['valornotafiscal']['symbol_mon'];
          $this->sc_add_currency($this->valornotafiscal, $sMonSymb, $this->field_config['valornotafiscal']['format_pos']); 
      }
      if ('' !== $this->valoriss || (!empty($format_fields) && isset($format_fields['valoriss'])))
      {
          nmgp_Form_Num_Val($this->valoriss, $this->field_config['valoriss']['symbol_grp'], $this->field_config['valoriss']['symbol_dec'], "0", "S", $this->field_config['valoriss']['format_neg'], "", "", "-", $this->field_config['valoriss']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorliquido || (!empty($format_fields) && isset($format_fields['valorliquido'])))
      {
          nmgp_Form_Num_Val($this->valorliquido, $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_dec'], "2", "S", $this->field_config['valorliquido']['format_neg'], "", "", "-", $this->field_config['valorliquido']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['valorliquido']['symbol_mon'];
          $this->sc_add_currency($this->valorliquido, $sMonSymb, $this->field_config['valorliquido']['format_pos']); 
      }
      if ((!empty($this->datarecebimento) && 'null' != $this->datarecebimento) || (!empty($format_fields) && isset($format_fields['datarecebimento'])))
      {
          nm_volta_data($this->datarecebimento, $this->field_config['datarecebimento']['date_format']) ; 
          nmgp_Form_Datas($this->datarecebimento, $this->field_config['datarecebimento']['date_format'], $this->field_config['datarecebimento']['date_sep']) ;  
      }
      elseif ('null' == $this->datarecebimento || '' == $this->datarecebimento)
      {
          $this->datarecebimento = '';
      }
      if ((!empty($this->databaixa) && 'null' != $this->databaixa) || (!empty($format_fields) && isset($format_fields['databaixa'])))
      {
          nm_volta_data($this->databaixa, $this->field_config['databaixa']['date_format']) ; 
          nmgp_Form_Datas($this->databaixa, $this->field_config['databaixa']['date_format'], $this->field_config['databaixa']['date_sep']) ;  
      }
      elseif ('null' == $this->databaixa || '' == $this->databaixa)
      {
          $this->databaixa = '';
      }
      if ('' !== $this->valorbaixa || (!empty($format_fields) && isset($format_fields['valorbaixa'])))
      {
          nmgp_Form_Num_Val($this->valorbaixa, $this->field_config['valorbaixa']['symbol_grp'], $this->field_config['valorbaixa']['symbol_dec'], "2", "S", $this->field_config['valorbaixa']['format_neg'], "", "", "-", $this->field_config['valorbaixa']['symbol_fmt']) ; 
          $sMonSymb = $this->field_config['valorbaixa']['symbol_mon'];
          $this->sc_add_currency($this->valorbaixa, $sMonSymb, $this->field_config['valorbaixa']['format_pos']); 
      }
      if ('' !== $this->idlancamentoreceita || (!empty($format_fields) && isset($format_fields['idlancamentoreceita'])))
      {
          nmgp_Form_Num_Val($this->idlancamentoreceita, $this->field_config['idlancamentoreceita']['symbol_grp'], $this->field_config['idlancamentoreceita']['symbol_dec'], "0", "S", $this->field_config['idlancamentoreceita']['format_neg'], "", "", "-", $this->field_config['idlancamentoreceita']['symbol_fmt']) ; 
      }
      if (!empty($this->numeronotafiscal) || (!empty($format_fields) && isset($format_fields['numeronotafiscal'])))
      {
          $this->nm_gera_mask($this->numeronotafiscal, "9999 / 9999"); 
      }
      if ((!empty($this->competenciasimples) && 'null' != $this->competenciasimples) || (!empty($format_fields) && isset($format_fields['competenciasimples'])))
      {
          nm_volta_data($this->competenciasimples, $this->field_config['competenciasimples']['date_format']) ; 
          nmgp_Form_Datas($this->competenciasimples, $this->field_config['competenciasimples']['date_format'], $this->field_config['competenciasimples']['date_sep']) ;  
      }
      elseif ('null' == $this->competenciasimples || '' == $this->competenciasimples)
      {
          $this->competenciasimples = '';
      }
      if ((!empty($this->datarecebimentonota) && 'null' != $this->datarecebimentonota) || (!empty($format_fields) && isset($format_fields['datarecebimentonota'])))
      {
          $nm_separa_data = strpos($this->field_config['datarecebimentonota']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['datarecebimentonota']['date_format'];
          $this->field_config['datarecebimentonota']['date_format'] = substr($this->field_config['datarecebimentonota']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->datarecebimentonota, " ") ; 
          $this->datarecebimentonota_hora = substr($this->datarecebimentonota, $separador + 1) ; 
          $this->datarecebimentonota = substr($this->datarecebimentonota, 0, $separador) ; 
          nm_volta_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_format']) ; 
          nmgp_Form_Datas($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_format'], $this->field_config['datarecebimentonota']['date_sep']) ;  
          $this->field_config['datarecebimentonota']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['date_format']) ; 
          nmgp_Form_Hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['date_format'], $this->field_config['datarecebimentonota']['time_sep']) ;  
          $this->field_config['datarecebimentonota']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->datarecebimentonota || '' == $this->datarecebimentonota)
      {
          $this->datarecebimentonota_hora = '';
          $this->datarecebimentonota = '';
      }
      if ('' !== $this->idusuariocancelamento || (!empty($format_fields) && isset($format_fields['idusuariocancelamento'])))
      {
          nmgp_Form_Num_Val($this->idusuariocancelamento, $this->field_config['idusuariocancelamento']['symbol_grp'], $this->field_config['idusuariocancelamento']['symbol_dec'], "0", "S", $this->field_config['idusuariocancelamento']['format_neg'], "", "", "-", $this->field_config['idusuariocancelamento']['symbol_fmt']) ; 
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
      $guarda_format_hora = $this->field_config['datacompetencia']['date_format'];
      if ($this->datacompetencia != "")  
      { 
          nm_conv_data($this->datacompetencia, $this->field_config['datacompetencia']['date_format']) ; 
          $this->datacompetencia_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datacompetencia_hora = substr($this->datacompetencia_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datacompetencia_hora = substr($this->datacompetencia_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datacompetencia_hora = substr($this->datacompetencia_hora, 0, -4);
          }
          $this->datacompetencia .= " " . $this->datacompetencia_hora ; 
      } 
      if ($this->datacompetencia == "" && $use_null)  
      { 
          $this->datacompetencia = "null" ; 
      } 
      $this->field_config['datacompetencia']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['datavencimento']['date_format'];
      if ($this->datavencimento != "")  
      { 
          nm_conv_data($this->datavencimento, $this->field_config['datavencimento']['date_format']) ; 
          $this->datavencimento_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datavencimento_hora = substr($this->datavencimento_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datavencimento_hora = substr($this->datavencimento_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datavencimento_hora = substr($this->datavencimento_hora, 0, -4);
          }
          $this->datavencimento .= " " . $this->datavencimento_hora ; 
      } 
      if ($this->datavencimento == "" && $use_null)  
      { 
          $this->datavencimento = "null" ; 
      } 
      $this->field_config['datavencimento']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['datarecebimento']['date_format'];
      if ($this->datarecebimento != "")  
      { 
          nm_conv_data($this->datarecebimento, $this->field_config['datarecebimento']['date_format']) ; 
          $this->datarecebimento_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datarecebimento_hora = substr($this->datarecebimento_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datarecebimento_hora = substr($this->datarecebimento_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datarecebimento_hora = substr($this->datarecebimento_hora, 0, -4);
          }
          $this->datarecebimento .= " " . $this->datarecebimento_hora ; 
      } 
      if ($this->datarecebimento == "" && $use_null)  
      { 
          $this->datarecebimento = "null" ; 
      } 
      $this->field_config['datarecebimento']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['databaixa']['date_format'];
      if ($this->databaixa != "")  
      { 
          nm_conv_data($this->databaixa, $this->field_config['databaixa']['date_format']) ; 
          $this->databaixa_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->databaixa_hora = substr($this->databaixa_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->databaixa_hora = substr($this->databaixa_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->databaixa_hora = substr($this->databaixa_hora, 0, -4);
          }
          $this->databaixa .= " " . $this->databaixa_hora ; 
      } 
      if ($this->databaixa == "" && $use_null)  
      { 
          $this->databaixa = "null" ; 
      } 
      $this->field_config['databaixa']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['competenciasimples']['date_format'];
      if ($this->competenciasimples != "")  
      { 
          nm_conv_data($this->competenciasimples, $this->field_config['competenciasimples']['date_format']) ; 
          $this->competenciasimples_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->competenciasimples_hora = substr($this->competenciasimples_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->competenciasimples_hora = substr($this->competenciasimples_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->competenciasimples_hora = substr($this->competenciasimples_hora, 0, -4);
          }
          $this->competenciasimples .= " " . $this->competenciasimples_hora ; 
      } 
      if ($this->competenciasimples == "" && $use_null)  
      { 
          $this->competenciasimples = "null" ; 
      } 
      $this->field_config['competenciasimples']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['datarecebimentonota']['date_format'];
      if ($this->datarecebimentonota != "")  
      { 
          $nm_separa_data = strpos($this->field_config['datarecebimentonota']['date_format'], ";") ;
          $this->field_config['datarecebimentonota']['date_format'] = substr($this->field_config['datarecebimentonota']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->datarecebimentonota, $this->field_config['datarecebimentonota']['date_format']) ; 
          $this->field_config['datarecebimentonota']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->datarecebimentonota_hora, $this->field_config['datarecebimentonota']['date_format']) ; 
          if ($this->datarecebimentonota_hora == "" )  
          { 
              $this->datarecebimentonota_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->datarecebimentonota_hora = substr($this->datarecebimentonota_hora, 0, -4) . "." . substr($this->datarecebimentonota_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datarecebimentonota_hora = substr($this->datarecebimentonota_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datarecebimentonota_hora = substr($this->datarecebimentonota_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datarecebimentonota_hora = substr($this->datarecebimentonota_hora, 0, -4);
          }
          if ($this->datarecebimentonota != "")  
          { 
              $this->datarecebimentonota .= " " . $this->datarecebimentonota_hora ; 
          }
      } 
      if ($this->datarecebimentonota == "" && $use_null)  
      { 
          $this->datarecebimentonota = "null" ; 
      } 
      $this->field_config['datarecebimentonota']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_datacompetencia();
          $this->ajax_return_values_idempresa();
          $this->ajax_return_values_idnotafiscal();
          $this->ajax_return_values_idcliente();
          $this->ajax_return_values_idplanoconta();
          $this->ajax_return_values_datavencimento();
          $this->ajax_return_values_valornotafiscal();
          $this->ajax_return_values_valoriss();
          $this->ajax_return_values_valorliquido();
          $this->ajax_return_values_idusuarioemissao();
          $this->ajax_return_values_idsituacaodocumento();
          $this->ajax_return_values_boletoliberado();
          $this->ajax_return_values_datarecebimento();
          $this->ajax_return_values_databaixa();
          $this->ajax_return_values_idusuariobaixa();
          $this->ajax_return_values_valorbaixa();
          $this->ajax_return_values_idlancamentoreceita();
          $this->ajax_return_values_numeronotafiscal();
          $this->ajax_return_values_numeronotafiscalcompleto();
          $this->ajax_return_values_competenciasimples();
          $this->ajax_return_values_codigoverificacao();
          $this->ajax_return_values_datarecebimentonota();
          $this->ajax_return_values_numerolote();
          $this->ajax_return_values_protocolo();
          $this->ajax_return_values_idusuariocancelamento();
          $this->ajax_return_values_discriminacao();
          $this->ajax_return_values_nomereferencia();
          $this->ajax_return_values_nomearquivo();
          $this->ajax_return_values_nomereferenciaboleto();
          $this->ajax_return_values_nomearquivoboleto();
          $this->ajax_return_values_nomereferenciaxml();
          $this->ajax_return_values_nomearquivoxml();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idnotafiscal']['keyVal'] = NotaFiscal_Frm_pack_protect_string($this->nmgp_dados_form['idnotafiscal']);
          }
   } // ajax_return_values

          //----- datacompetencia
   function ajax_return_values_datacompetencia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datacompetencia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datacompetencia);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datacompetencia'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'] = array(); 
}
$aLookup[] = array(NotaFiscal_Frm_pack_protect_string('') => str_replace('<', '&lt;',NotaFiscal_Frm_pack_protect_string('Selecione a empresa')));
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT IdEmpresa, concat_ws(' - ', NomeFantasia, TipoEmpresa)  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT IdEmpresa, ' - '&NomeFantasia&TipoEmpresa  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT IdEmpresa, ' - '||NomeFantasia||TipoEmpresa  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }
   else
   {
       $nm_comando = "SELECT IdEmpresa, ' - '||NomeFantasia||TipoEmpresa  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'][] = $rs->fields[0];
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
              $this->NM_ajax_info['fldList']['idempresa']['valList'][$i] = NotaFiscal_Frm_pack_protect_string($v);
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

          //----- idnotafiscal
   function ajax_return_values_idnotafiscal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idnotafiscal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idnotafiscal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idnotafiscal'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idnotafiscal", $this->form_encode_input($sTmpValue))),
              );
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idcliente");

   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdCliente, Descricao FROM clienteempresa_view WHERE (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' AND IdSituacaoCliente = 1) AND IdCliente = " . substr($this->Db->qstr($this->idcliente), 1, -1) . " ORDER BY Descricao";
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

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   if ('' != $this->idcliente)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->SelectLimit($nm_comando, 50, 0))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idcliente'][] = $rs->fields[0];
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
          $val_output = isset($aLookup[0][NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcliente))]) ? $aLookup[0][NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idcliente))] : "";
          $this->NM_ajax_info['fldList']['idcliente_autocomp'] = array(
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

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'] = array(); 
}
$aLookup[] = array(NotaFiscal_Frm_pack_protect_string('') => str_replace('<', '&lt;',NotaFiscal_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Tipo = 'A' AND Origem = 'R' and IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Classificador";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanoconta\"";
          if (isset($this->NM_ajax_info['select_html']['idplanoconta']) && !empty($this->NM_ajax_info['select_html']['idplanoconta']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanoconta']);
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

                  if ($this->idplanoconta == $sValue)
                  {
                      $this->_tmp_lookup_idplanoconta = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanoconta'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanoconta']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanoconta']['valList'][$i] = NotaFiscal_Frm_pack_protect_string($v);
          }
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
          }
   }

          //----- datavencimento
   function ajax_return_values_datavencimento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datavencimento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datavencimento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datavencimento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- valornotafiscal
   function ajax_return_values_valornotafiscal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valornotafiscal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valornotafiscal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valornotafiscal'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- valoriss
   function ajax_return_values_valoriss($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valoriss", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valoriss);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valoriss'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- idusuarioemissao
   function ajax_return_values_idusuarioemissao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idusuarioemissao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idusuarioemissao);
              $aLookup = array();
              $this->_tmp_lookup_idusuarioemissao = $this->idusuarioemissao;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'] = array(); 
}
$aLookup[] = array(NotaFiscal_Frm_pack_protect_string('NULL') => str_replace('<', '&lt;',NotaFiscal_Frm_pack_protect_string('Informe o usuário')));
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'][] = 'NULL';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Nome";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idusuarioemissao\"";
          if (isset($this->NM_ajax_info['select_html']['idusuarioemissao']) && !empty($this->NM_ajax_info['select_html']['idusuarioemissao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idusuarioemissao']);
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

                  if ($this->idusuarioemissao == $sValue)
                  {
                      $this->_tmp_lookup_idusuarioemissao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idusuarioemissao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idusuarioemissao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idusuarioemissao']['valList'][$i] = NotaFiscal_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idusuarioemissao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idusuarioemissao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idusuarioemissao']['labList'] = $aLabel;
          }
   }

          //----- idsituacaodocumento
   function ajax_return_values_idsituacaodocumento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idsituacaodocumento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idsituacaodocumento);
              $aLookup = array();
              $this->_tmp_lookup_idsituacaodocumento = $this->idsituacaodocumento;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'] = array(); 
}
$aLookup[] = array(NotaFiscal_Frm_pack_protect_string('') => str_replace('<', '&lt;',NotaFiscal_Frm_pack_protect_string('Informe a situação')));
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idsituacaodocumento\"";
          if (isset($this->NM_ajax_info['select_html']['idsituacaodocumento']) && !empty($this->NM_ajax_info['select_html']['idsituacaodocumento']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idsituacaodocumento']);
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

                  if ($this->idsituacaodocumento == $sValue)
                  {
                      $this->_tmp_lookup_idsituacaodocumento = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idsituacaodocumento'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumento']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idsituacaodocumento']['valList'][$i] = NotaFiscal_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idsituacaodocumento']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumento']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idsituacaodocumento']['labList'] = $aLabel;
          }
   }

          //----- boletoliberado
   function ajax_return_values_boletoliberado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("boletoliberado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->boletoliberado);
              $aLookup = array();
              $this->_tmp_lookup_boletoliberado = $this->boletoliberado;

$aLookup[] = array(NotaFiscal_Frm_pack_protect_string('N') => str_replace('<', '&lt;',NotaFiscal_Frm_pack_protect_string("Não")));
$aLookup[] = array(NotaFiscal_Frm_pack_protect_string('S') => str_replace('<', '&lt;',NotaFiscal_Frm_pack_protect_string("Sim")));
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_boletoliberado'][] = 'N';
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_boletoliberado'][] = 'S';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['boletoliberado']) && !empty($this->NM_ajax_info['select_html']['boletoliberado']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['boletoliberado']);
          }
          $this->NM_ajax_info['fldList']['boletoliberado'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['boletoliberado']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['boletoliberado']['valList'][$i] = NotaFiscal_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['boletoliberado']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['boletoliberado']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['boletoliberado']['labList'] = $aLabel;
          }
   }

          //----- datarecebimento
   function ajax_return_values_datarecebimento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datarecebimento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datarecebimento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datarecebimento'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("datarecebimento", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- databaixa
   function ajax_return_values_databaixa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("databaixa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->databaixa);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['databaixa'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("databaixa", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- idusuariobaixa
   function ajax_return_values_idusuariobaixa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idusuariobaixa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idusuariobaixa);
              $aLookup = array();
              $this->_tmp_lookup_idusuariobaixa = $this->idusuariobaixa;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'] = array(); 
}
$aLookup[] = array(NotaFiscal_Frm_pack_protect_string('NULL') => str_replace('<', '&lt;',NotaFiscal_Frm_pack_protect_string('Informe o usuário')));
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'][] = 'NULL';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Nome";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idusuariobaixa\"";
          if (isset($this->NM_ajax_info['select_html']['idusuariobaixa']) && !empty($this->NM_ajax_info['select_html']['idusuariobaixa']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idusuariobaixa']);
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

                  if ($this->idusuariobaixa == $sValue)
                  {
                      $this->_tmp_lookup_idusuariobaixa = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idusuariobaixa", $this->nmgp_refresh_fields)) ? 'select' : 'text';
          $this->NM_ajax_info['fldList']['idusuariobaixa'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idusuariobaixa']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idusuariobaixa']['valList'][$i] = NotaFiscal_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idusuariobaixa']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idusuariobaixa']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idusuariobaixa']['labList'] = $aLabel;
          }
   }

          //----- valorbaixa
   function ajax_return_values_valorbaixa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("valorbaixa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->valorbaixa);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['valorbaixa'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("valorbaixa", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- idlancamentoreceita
   function ajax_return_values_idlancamentoreceita($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idlancamentoreceita", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idlancamentoreceita);
              $aLookup = array();
              $this->_tmp_lookup_idlancamentoreceita = $this->idlancamentoreceita;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }

   $this->nm_clear_val("idlancamentoreceita");

   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdLancamentoReceita, concat_ws(' ', IdLancamentoReceita, Historico, ValorPrevisao) FROM lancamentoreceita WHERE IdLancamentoReceita = " . substr($this->Db->qstr($this->idlancamentoreceita), 1, -1) . " ORDER BY Historico, ValorPrevisao";
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

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

   if ('' != $this->idlancamentoreceita)
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
              $aLookup[] = array(NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idlancamentoreceita'][] = $rs->fields[0];
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
          $Nm_tp_obj = (isset($this->nmgp_refresh_fields) && in_array("idlancamentoreceita", $this->nmgp_refresh_fields)) ? 'text' : 'text';
          $this->NM_ajax_info['fldList']['idlancamentoreceita'] = array(
                       'row'    => '',
               'type'    => $Nm_tp_obj,
               'valList' => array($unformatted_value_idlancamentoreceita),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idlancamentoreceita']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idlancamentoreceita']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idlancamentoreceita']['labList'] = $aLabel;
          $val_output = isset($aLookup[0][NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idlancamentoreceita))]) ? $aLookup[0][NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($unformatted_value_idlancamentoreceita))] : "";
          $this->NM_ajax_info['fldList']['idlancamentoreceita_autocomp'] = array(
               'type'    => 'text',
               'valList' => array($val_output),
              );
          }
   }

          //----- numeronotafiscal
   function ajax_return_values_numeronotafiscal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numeronotafiscal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numeronotafiscal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numeronotafiscal'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- numeronotafiscalcompleto
   function ajax_return_values_numeronotafiscalcompleto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numeronotafiscalcompleto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numeronotafiscalcompleto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numeronotafiscalcompleto'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- competenciasimples
   function ajax_return_values_competenciasimples($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("competenciasimples", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->competenciasimples);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['competenciasimples'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- codigoverificacao
   function ajax_return_values_codigoverificacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("codigoverificacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->codigoverificacao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['codigoverificacao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- datarecebimentonota
   function ajax_return_values_datarecebimentonota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datarecebimentonota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datarecebimentonota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datarecebimentonota'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          $this->NM_ajax_info['fldList']['datarecebimentonota_hora'] = array(
               'type'    => 'text',
               'valList' => array($this->datarecebimentonota_hora),
              );
          }
   }

          //----- numerolote
   function ajax_return_values_numerolote($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numerolote", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numerolote);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numerolote'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- protocolo
   function ajax_return_values_protocolo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("protocolo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->protocolo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['protocolo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- idusuariocancelamento
   function ajax_return_values_idusuariocancelamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idusuariocancelamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idusuariocancelamento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idusuariocancelamento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- discriminacao
   function ajax_return_values_discriminacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("discriminacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->discriminacao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['discriminacao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
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
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'][$sTmpFile] = $this->nomereferencia;
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
               'docLink' => "<a href=\"javascript:nm_mostra_doc('0', '" . $sTmpFile . "', 'NotaFiscal_Frm')\">" . $tmp_file_nomereferencia . "</a>",
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

          //----- nomereferenciaboleto
   function ajax_return_values_nomereferenciaboleto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomereferenciaboleto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomereferenciaboleto);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->nomereferenciaboleto, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_nomereferenciaboleto_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'][$sTmpFile] = $this->nomereferenciaboleto;
              $tmp_file_nomereferenciaboleto = trim(NM_charset_to_utf8($this->nomereferenciaboleto));
              $tmp_icon_nomereferenciaboleto = '';
              if ('' != $tmp_file_nomereferenciaboleto)
              {
                  $tmp_icon_nomereferenciaboleto = $this->gera_icone($tmp_file_nomereferenciaboleto);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomereferenciaboleto'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($sTmpValue),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('1', '" . $sTmpFile . "', 'NotaFiscal_Frm')\">" . $tmp_file_nomereferenciaboleto . "</a>",
               'docIcon' => $tmp_icon_nomereferenciaboleto,
               'docReadonly' => "N",
              );
              if ('navigate_form' == $this->NM_ajax_opcao)
              {
                  $this->NM_ajax_info['fldList']['nomereferenciaboleto_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
          }
   }

          //----- nomearquivoboleto
   function ajax_return_values_nomearquivoboleto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomearquivoboleto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomearquivoboleto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomearquivoboleto'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- nomereferenciaxml
   function ajax_return_values_nomereferenciaxml($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomereferenciaxml", $this->nmgp_refresh_fields)) || $bForce || in_array("nomereferenciaxml", $this->Upload_refresh_fields))
          {
              $sTmpValue = NM_charset_to_utf8($this->nomereferenciaxml);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->nomereferenciaxml, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_nomereferenciaxml_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'][$sTmpFile] = $this->nomereferenciaxml;
              $tmp_file_nomereferenciaxml = trim(NM_charset_to_utf8($this->nomereferenciaxml));
              $tmp_icon_nomereferenciaxml = '';
              if ('' != $tmp_file_nomereferenciaxml)
              {
                  $tmp_icon_nomereferenciaxml = $this->gera_icone($tmp_file_nomereferenciaxml);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomereferenciaxml'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($sTmpValue),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('2', '" . $sTmpFile . "', 'NotaFiscal_Frm')\">" . $tmp_file_nomereferenciaxml . "</a>",
               'docIcon' => $tmp_icon_nomereferenciaxml,
               'docReadonly' => "N",
              );
              if ('navigate_form' == $this->NM_ajax_opcao)
              {
                  $this->NM_ajax_info['fldList']['nomereferenciaxml_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
          }
   }

          //----- nomearquivoxml
   function ajax_return_values_nomearquivoxml($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomearquivoxml", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomearquivoxml);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomearquivoxml'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varPrivAdmin)) {$this->sc_temp_varPrivAdmin = (isset($_SESSION['varPrivAdmin'])) ? $_SESSION['varPrivAdmin'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varNotaFiscal_IdCliente)) {$this->sc_temp_varNotaFiscal_IdCliente = (isset($_SESSION['varNotaFiscal_IdCliente'])) ? $_SESSION['varNotaFiscal_IdCliente'] : "";}
if (!isset($this->sc_temp_varNomeReferenciaBoleto)) {$this->sc_temp_varNomeReferenciaBoleto = (isset($_SESSION['varNomeReferenciaBoleto'])) ? $_SESSION['varNomeReferenciaBoleto'] : "";}
if (!isset($this->sc_temp_varNomeReferencia)) {$this->sc_temp_varNomeReferencia = (isset($_SESSION['varNomeReferencia'])) ? $_SESSION['varNomeReferencia'] : "";}
  $this->Preparar_LstFrm_OnSrip_OnLoad_Auditoria($this->Ini->nm_cod_apl, $this->idnotafiscal );

$this->sc_temp_varNomeReferencia = $this->nomereferencia ;
$this->sc_temp_varNomeReferenciaBoleto = $this->nomereferenciaboleto ;

$this->sc_field_readonly("datainclusao", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['datainclusao'] = array('I'=>array(),'U'=>array());
;
$this->sc_field_readonly("idusuarioinclusao", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['idusuarioinclusao'] = array('I'=>array(),'U'=>array());
;
$this->sc_field_readonly("idusuariobaixa", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['idusuariobaixa'] = array('I'=>array(),'U'=>array());
;

if ( $this->sc_evento != "novo" ) {
	
	if(isset($this->sc_temp_varNotaFiscal_IdCliente) && !empty($this->sc_temp_varNotaFiscal_IdCliente)) {
		$this->sc_field_readonly("idcliente", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['idcliente'] = array('I'=>array(),'U'=>array());
;	
	}
	
	if (strlen($this->numeronotafiscal ) > 5) {
		
		$this->NM_ajax_info['buttonDisplay']['ImprimirNotaFiscal'] = $this->nmgp_botoes["ImprimirNotaFiscal"] = 'off';;
		$this->NM_ajax_info['buttonDisplay']['GerarNota'] = $this->nmgp_botoes["GerarNota"] = 'off';;
		$this->NM_ajax_info['buttonDisplay']['Cancelar'] = $this->nmgp_botoes["Cancelar"] = 'off';;
		$this->sc_ajax_javascript('nm_field_disabled', array("discriminacao=disabled", ""));
;
		
	} else {
		
		$this->NM_ajax_info['buttonDisplay']['ImprimirNotaFiscal'] = $this->nmgp_botoes["ImprimirNotaFiscal"] = 'off';;
		$this->NM_ajax_info['buttonDisplay']['GerarNota'] = $this->nmgp_botoes["GerarNota"] = 'on';;		
		$this->NM_ajax_info['buttonDisplay']['Cancelar'] = $this->nmgp_botoes["Cancelar"] = 'off';;
		$this->sc_ajax_javascript('nm_field_disabled', array("discriminacao=", ""));
;
		
	}
	
} else {
	
	$check_sql = "SELECT IdEmpresa FROM empresa WHERE IdTenacidade = '$this->sc_temp_varIdTenacidade'";
	 
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

	if ((isset($this->rs[0][0])) && (count($this->rs) == 1)) {
    	$this->idempresa  = $this->rs[0][0];
	}
	$this->NM_ajax_info['buttonDisplay']['GerarNota'] = $this->nmgp_botoes["GerarNota"] = 'off';;
	$this->NM_ajax_info['buttonDisplay']['ImprimirNotaFiscal'] = $this->nmgp_botoes["ImprimirNotaFiscal"] = 'off';;
}

if ($this->sc_temp_varPrivAdmin != 1 && $this->sc_temp_varIdUsuario != 160) {
	
	$this->NM_ajax_info['buttonDisplay']['Cancelar'] = $this->nmgp_botoes["Cancelar"] = 'off';;
	
}

if($this->nmgp_clone == "S") { 
	
	$this->numeronotafiscal  = '';
	$this->competenciasimples  = '';
	$this->codigoverificacao  = '';
	$this->numerolote  = '';
	$this->protocolo  = '';
	$this->datarecebimentonota  = '';	
	$this->nomereferencia  = '';	
	$this->nomearquivo  = '';
	$this->nomereferenciaboleto  = '';	
	$this->nomearquivoboleto  = '';
	$this->nomearquivoxml  = '';
	$this->nomereferenciaxml  = '';
	$this->datarecebimento  = '';	
	
	$novaDataCompetencia = 
         $this->nm_data->CalculaData($this->datacompetencia , "aaaa-mm-dd", "+", 0, 1, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;	
	$this->datacompetencia  = $novaDataCompetencia;
	$novaDataVencimento = 
         $this->nm_data->CalculaData($this->datavencimento , "aaaa-mm-dd", "+", 0, 1, 0, "aaaa-mm-dd",  "aaaa-mm-dd"); 
      ;	
	$this->datavencimento  = $novaDataVencimento;
	$this->idusuarioemissao  = $this->sc_temp_varIdUsuario;
	$this->idsituacaodocumento  = 1;
	$this->boletoliberado  = 'N';
	$this->dataliberacaoboleto  = '';
	$this->databaixa  = '';
	$this->idusuariobaixa  = '';
	$this->valorbaixa  = '';
	$this->idlancamentoreceita  = '';
	$this->discriminacao  = preg_replace('/- VENCIMENTO: \d{2}\/\d{2}\/\d{4}\s*/', '- VENCIMENTO: '.$this->nm_conv_data_db($novaDataVencimento,"db_format","dd/mm/aaaa"), $this->discriminacao );
	
}
if (isset($this->sc_temp_varNomeReferencia)) { $_SESSION['varNomeReferencia'] = $this->sc_temp_varNomeReferencia;}
if (isset($this->sc_temp_varNomeReferenciaBoleto)) { $_SESSION['varNomeReferenciaBoleto'] = $this->sc_temp_varNomeReferenciaBoleto;}
if (isset($this->sc_temp_varNotaFiscal_IdCliente)) { $_SESSION['varNotaFiscal_IdCliente'] = $this->sc_temp_varNotaFiscal_IdCliente;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onLoad ------*/
 
      }
      if (empty($this->datarecebimentonota))
      {
          $this->datarecebimentonota_hora = $this->datarecebimentonota;
      }
      if (empty($this->dataemissao))
      {
          $this->dataemissao_hora = $this->dataemissao;
      }
      if (empty($this->dataliberacaoboleto))
      {
          $this->dataliberacaoboleto_hora = $this->dataliberacaoboleto;
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
      $this->valornotafiscal = str_replace($sc_parm1, $sc_parm2, $this->valornotafiscal); 
      $this->valorliquido = str_replace($sc_parm1, $sc_parm2, $this->valorliquido); 
      $this->valorbaixa = str_replace($sc_parm1, $sc_parm2, $this->valorbaixa); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->valornotafiscal = "'" . $this->valornotafiscal . "'";
      $this->valorliquido = "'" . $this->valorliquido . "'";
      $this->valorbaixa = "'" . $this->valorbaixa . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->valornotafiscal = str_replace("'", "", $this->valornotafiscal); 
      $this->valorliquido = str_replace("'", "", $this->valorliquido); 
      $this->valorbaixa = str_replace("'", "", $this->valorbaixa); 
   } 
//----------- 

   function controle_navegacao()
   {
      global $sc_where;

          if (false && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']))
          {
               $sc_where_pos = " WHERE ((IdNotaFiscal < $this->idnotafiscal))";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total'] = $rsc->fields[0];
               $rsc->Close(); 
               if ('' != $this->idnotafiscal)
               {
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = $rsc->fields[0];
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] < 0)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = 0;
               }
               $rsc->Close(); 
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = 0;
               }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['qt_reg_grid'] = 1;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['final']  = 0;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] = $this->NM_ajax_info['param']['nmgp_opcao'];
          if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'], array('incluir', 'alterar', 'excluir')))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] = '';
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] == 'inicio')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = 0;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] == 'retorna')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = 0 ;
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] == 'avanca' && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total'] > $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['final']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['final'];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] == 'final')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] = 0;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['final'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['qt_reg_grid'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['final'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] = '';

   }
   function return_after_insert()
   {
      global $sc_where;
      $this->restore_zeros_null();
      $sc_where_pos = " WHERE ((IdNotaFiscal < $this->idnotafiscal))";
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
      if ('' != $this->idnotafiscal)
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['reg_start'] = $rsc->fields[0];
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
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varNomeReferenciaBoleto)) {$this->sc_temp_varNomeReferenciaBoleto = (isset($_SESSION['varNomeReferenciaBoleto'])) ? $_SESSION['varNomeReferenciaBoleto'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varNomeReferencia)) {$this->sc_temp_varNomeReferencia = (isset($_SESSION['varNomeReferencia'])) ? $_SESSION['varNomeReferencia'] : "";}
  if (($this->nomereferencia  != "") && ($this->nomereferencia  != $this->sc_temp_varNomeReferencia)) {
	$this->nomearquivo  = $this->nomereferencia ;
	$extensaoArquivo = pathinfo($this->nomereferencia , PATHINFO_EXTENSION);
	$this->nomereferencia  = md5(date('YdmHisu') . $this->nomereferencia  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;
}
else {
	if ($this->nomereferencia  == "") {
		$this->nomearquivo  = "";
	}
}
$this->sc_temp_varNomeReferencia = $this->nomereferencia ;

if (($this->nomereferenciaboleto  != "") && ($this->nomereferenciaboleto  != $this->sc_temp_varNomeReferenciaBoleto)) {
	$this->nomereferenciaboleto  = $this->nomereferenciaboleto ;
	$extensaoArquivo = pathinfo($this->nomereferenciaboleto , PATHINFO_EXTENSION);
	$this->nomereferenciaboleto  = md5(date('YdmHisu') . $this->nomereferenciaboleto  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;
}
else {
	if ($this->nomereferenciaboleto  == "") {
		$this->nomereferenciaboleto  = "";
	}
}
$this->sc_temp_varNomeReferenciaBoleto = $this->nomearquivoboleto ;
if (isset($this->sc_temp_varNomeReferencia)) { $_SESSION['varNomeReferencia'] = $this->sc_temp_varNomeReferencia;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varNomeReferenciaBoleto)) { $_SESSION['varNomeReferenciaBoleto'] = $this->sc_temp_varNomeReferenciaBoleto;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeInsert ------*/
 
    }
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeUpdate ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varNomeReferenciaBoleto)) {$this->sc_temp_varNomeReferenciaBoleto = (isset($_SESSION['varNomeReferenciaBoleto'])) ? $_SESSION['varNomeReferenciaBoleto'] : "";}
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
}
else {
	if ($this->nomereferencia  == "") {
		$this->nomearquivo  = "";
	}
}
$this->sc_temp_varNomeReferencia = $this->nomereferencia ;

if (($this->nomereferenciaboleto  != "") && ($this->nomereferenciaboleto  != $this->sc_temp_varNomeReferenciaBoleto)) {
	$this->nomereferenciaboleto  = $this->nomereferenciaboleto ;
	$extensaoArquivo = pathinfo($this->nomereferenciaboleto , PATHINFO_EXTENSION);
	$this->nomereferenciaboleto  = md5(date('YdmHisu') . $this->nomereferenciaboleto  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;
	$nomeOriginal = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomearquivoboleto ;
	$nomeReferencia = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferenciaboleto ;
	rename($nomeOriginal, $nomeReferencia);
}
else {
	if ($this->nomereferenciaboleto  == "") {
		$this->nomereferenciaboleto  = "";
	}
}
$this->sc_temp_varNomeReferenciaBoleto = $this->nomearquivoboleto ;
if (isset($this->sc_temp_varNomeReferencia)) { $_SESSION['varNomeReferencia'] = $this->sc_temp_varNomeReferencia;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
if (isset($this->sc_temp_varNomeReferenciaBoleto)) { $_SESSION['varNomeReferenciaBoleto'] = $this->sc_temp_varNomeReferenciaBoleto;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeUpdate ------*/
 
    }
    if ("excluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeDelete ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdLancamentoReceita)) {$this->sc_temp_varIdLancamentoReceita = (isset($_SESSION['varIdLancamentoReceita'])) ? $_SESSION['varIdLancamentoReceita'] : "";}
if (!isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) {$this->sc_temp_varIdSituacaoDocumentoPendenteInt = (isset($_SESSION['varIdSituacaoDocumentoPendenteInt'])) ? $_SESSION['varIdSituacaoDocumentoPendenteInt'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  $check_sql = "SELECT IdLancamentoReceita"
   . " FROM lancamentoreceita"
   . " WHERE IdNotaFiscal = '" . $this->idnotafiscal  . "' AND IdTenacidade = $this->sc_temp_varIdTenacidade AND IdSituacaoDocumento = $this->sc_temp_varIdSituacaoDocumentoPendenteInt";
 
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
	
	$this->sc_temp_varIdLancamentoReceita = $this->rs[0][0];
	
	$update_table  = 'lancamentoreceita';      
	$update_where  = "IdLancamentoReceita = '$this->sc_temp_varIdLancamentoReceita'"; 
	$update_fields = array(   
		 "IdNotaFiscal = NULL",

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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
          
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	
} else  {

	$error_message = 'Receita não encontrada ou com status diferente de Pendente.'; 
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $error_message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_NotaFiscal_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $error_message;
 }
;
}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdSituacaoDocumentoPendenteInt)) { $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $this->sc_temp_varIdSituacaoDocumentoPendenteInt;}
if (isset($this->sc_temp_varIdLancamentoReceita)) { $_SESSION['varIdLancamentoReceita'] = $this->sc_temp_varIdLancamentoReceita;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeDelete ------*/
 
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
      if (('alterar' == $this->nmgp_opcao || 'igual' == $this->nmgp_opcao) && empty($this->idlancamentoreceita)){$this->idlancamentoreceita = "NULL"; $this->sc_force_zero[] = "idlancamentoreceita";}  
      $NM_val_form['datacompetencia'] = $this->datacompetencia;
      $NM_val_form['idempresa'] = $this->idempresa;
      $NM_val_form['idnotafiscal'] = $this->idnotafiscal;
      $NM_val_form['idcliente'] = $this->idcliente;
      $NM_val_form['idplanoconta'] = $this->idplanoconta;
      $NM_val_form['datavencimento'] = $this->datavencimento;
      $NM_val_form['valornotafiscal'] = $this->valornotafiscal;
      $NM_val_form['valoriss'] = $this->valoriss;
      $NM_val_form['valorliquido'] = $this->valorliquido;
      $NM_val_form['idusuarioemissao'] = $this->idusuarioemissao;
      $NM_val_form['idsituacaodocumento'] = $this->idsituacaodocumento;
      $NM_val_form['boletoliberado'] = $this->boletoliberado;
      $NM_val_form['datarecebimento'] = $this->datarecebimento;
      $NM_val_form['databaixa'] = $this->databaixa;
      $NM_val_form['idusuariobaixa'] = $this->idusuariobaixa;
      $NM_val_form['valorbaixa'] = $this->valorbaixa;
      $NM_val_form['idlancamentoreceita'] = $this->idlancamentoreceita;
      $NM_val_form['numeronotafiscal'] = $this->numeronotafiscal;
      $NM_val_form['numeronotafiscalcompleto'] = $this->numeronotafiscalcompleto;
      $NM_val_form['competenciasimples'] = $this->competenciasimples;
      $NM_val_form['codigoverificacao'] = $this->codigoverificacao;
      $NM_val_form['datarecebimentonota'] = $this->datarecebimentonota;
      $NM_val_form['numerolote'] = $this->numerolote;
      $NM_val_form['protocolo'] = $this->protocolo;
      $NM_val_form['idusuariocancelamento'] = $this->idusuariocancelamento;
      $NM_val_form['discriminacao'] = $this->discriminacao;
      $NM_val_form['nomereferencia'] = $this->nomereferencia;
      $NM_val_form['nomearquivo'] = $this->nomearquivo;
      $NM_val_form['nomereferenciaboleto'] = $this->nomereferenciaboleto;
      $NM_val_form['nomearquivoboleto'] = $this->nomearquivoboleto;
      $NM_val_form['nomereferenciaxml'] = $this->nomereferenciaxml;
      $NM_val_form['nomearquivoxml'] = $this->nomearquivoxml;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['dataemissao'] = $this->dataemissao;
      $NM_val_form['dataliberacaoboleto'] = $this->dataliberacaoboleto;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      if ($this->idnotafiscal === "" || is_null($this->idnotafiscal))  
      { 
          $this->idnotafiscal = 0;
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
      if ($this->idsituacaodocumento === "" || is_null($this->idsituacaodocumento))  
      { 
          $this->idsituacaodocumento = 0;
          $this->sc_force_zero[] = 'idsituacaodocumento';
      } 
      if ($this->idempresa === "" || is_null($this->idempresa))  
      { 
          $this->idempresa = 0;
          $this->sc_force_zero[] = 'idempresa';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->idlancamentoreceita === "" || is_null($this->idlancamentoreceita))  
      { 
          $this->idlancamentoreceita = 0;
          $this->sc_force_zero[] = 'idlancamentoreceita';
      } 
      }
      if ($this->idplanoconta === "" || is_null($this->idplanoconta))  
      { 
          $this->idplanoconta = 0;
          $this->sc_force_zero[] = 'idplanoconta';
      } 
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      if ($this->idusuariocancelamento === "" || is_null($this->idusuariocancelamento))  
      { 
          $this->idusuariocancelamento = 0;
          $this->sc_force_zero[] = 'idusuariocancelamento';
      } 
      if ($this->idusuarioemissao === "" || is_null($this->idusuarioemissao))  
      { 
          $this->idusuarioemissao = 0;
          $this->sc_force_zero[] = 'idusuarioemissao';
      } 
      if ($this->valornotafiscal === "" || is_null($this->valornotafiscal))  
      { 
          $this->valornotafiscal = 0;
          $this->sc_force_zero[] = 'valornotafiscal';
      } 
      if ($this->valoriss === "" || is_null($this->valoriss))  
      { 
          $this->valoriss = 0;
          $this->sc_force_zero[] = 'valoriss';
      } 
      if ($this->valorliquido === "" || is_null($this->valorliquido))  
      { 
          $this->valorliquido = 0;
          $this->sc_force_zero[] = 'valorliquido';
      } 
      if ($this->idusuariobaixa === "" || is_null($this->idusuariobaixa))  
      { 
          $this->idusuariobaixa = 0;
          $this->sc_force_zero[] = 'idusuariobaixa';
      } 
      if ($this->valorbaixa === "" || is_null($this->valorbaixa))  
      { 
          $this->valorbaixa = 0;
          $this->sc_force_zero[] = 'valorbaixa';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->datacompetencia == "")  
          { 
              $this->datacompetencia = "null"; 
              $this->NM_val_null[] = "datacompetencia";
          } 
          $this->numeronotafiscal_before_qstr = $this->numeronotafiscal;
          $this->numeronotafiscal = substr($this->Db->qstr($this->numeronotafiscal), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->numeronotafiscal = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->numeronotafiscal);
          }
          if ($this->numeronotafiscal == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->numeronotafiscal = "null"; 
              $this->NM_val_null[] = "numeronotafiscal";
          } 
          $this->codigoverificacao_before_qstr = $this->codigoverificacao;
          $this->codigoverificacao = substr($this->Db->qstr($this->codigoverificacao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->codigoverificacao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->codigoverificacao);
          }
          if ($this->codigoverificacao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->codigoverificacao = "null"; 
              $this->NM_val_null[] = "codigoverificacao";
          } 
          if ($this->dataemissao == "")  
          { 
              $this->dataemissao = "null"; 
              $this->NM_val_null[] = "dataemissao";
          } 
          if ($this->datavencimento == "")  
          { 
              $this->datavencimento = "null"; 
              $this->NM_val_null[] = "datavencimento";
          } 
          if ($this->databaixa == "")  
          { 
              $this->databaixa = "null"; 
              $this->NM_val_null[] = "databaixa";
          } 
          if ($this->datarecebimento == "")  
          { 
              $this->datarecebimento = "null"; 
              $this->NM_val_null[] = "datarecebimento";
          } 
          $this->discriminacao_before_qstr = $this->discriminacao;
          $this->discriminacao = substr($this->Db->qstr($this->discriminacao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->discriminacao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->discriminacao);
          }
          if ($this->discriminacao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->discriminacao = "null"; 
              $this->NM_val_null[] = "discriminacao";
          } 
          if ($this->competenciasimples == "")  
          { 
              $this->competenciasimples = "null"; 
              $this->NM_val_null[] = "competenciasimples";
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
          $this->nomearquivoboleto_before_qstr = $this->nomearquivoboleto;
          $this->nomearquivoboleto = substr($this->Db->qstr($this->nomearquivoboleto), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomearquivoboleto = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomearquivoboleto);
          }
          if ($this->nomearquivoboleto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomearquivoboleto = "null"; 
              $this->NM_val_null[] = "nomearquivoboleto";
          } 
          $this->nomereferenciaboleto_original_filename = $this->nomereferenciaboleto; 
          $this->nomereferenciaboleto_before_qstr = $this->nomereferenciaboleto;
          $this->nomereferenciaboleto = substr($this->Db->qstr($this->nomereferenciaboleto), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomereferenciaboleto = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomereferenciaboleto);
          }
          if ($this->nomereferenciaboleto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomereferenciaboleto = "null"; 
              $this->NM_val_null[] = "nomereferenciaboleto";
          } 
          if ($this->dataliberacaoboleto == "")  
          { 
              $this->dataliberacaoboleto = "null"; 
              $this->NM_val_null[] = "dataliberacaoboleto";
          } 
          $this->nomearquivoxml_before_qstr = $this->nomearquivoxml;
          $this->nomearquivoxml = substr($this->Db->qstr($this->nomearquivoxml), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomearquivoxml = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomearquivoxml);
          }
          if ($this->nomearquivoxml == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomearquivoxml = "null"; 
              $this->NM_val_null[] = "nomearquivoxml";
          } 
          $this->nomereferenciaxml_original_filename = $this->nomereferenciaxml; 
          $this->nomereferenciaxml_before_qstr = $this->nomereferenciaxml;
          $this->nomereferenciaxml = substr($this->Db->qstr($this->nomereferenciaxml), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nomereferenciaxml = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nomereferenciaxml);
          }
          if ($this->nomereferenciaxml == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nomereferenciaxml = "null"; 
              $this->NM_val_null[] = "nomereferenciaxml";
          } 
          $this->boletoliberado_before_qstr = $this->boletoliberado;
          $this->boletoliberado = substr($this->Db->qstr($this->boletoliberado), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->boletoliberado = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->boletoliberado);
          }
          if ($this->boletoliberado == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->boletoliberado = "null"; 
              $this->NM_val_null[] = "boletoliberado";
          } 
          $this->numerolote_before_qstr = $this->numerolote;
          $this->numerolote = substr($this->Db->qstr($this->numerolote), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->numerolote = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->numerolote);
          }
          if ($this->numerolote == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->numerolote = "null"; 
              $this->NM_val_null[] = "numerolote";
          } 
          $this->protocolo_before_qstr = $this->protocolo;
          $this->protocolo = substr($this->Db->qstr($this->protocolo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->protocolo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->protocolo);
          }
          if ($this->protocolo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->protocolo = "null"; 
              $this->NM_val_null[] = "protocolo";
          } 
          if ($this->datarecebimentonota == "")  
          { 
              $this->datarecebimentonota = "null"; 
              $this->NM_val_null[] = "datarecebimentonota";
          } 
          $this->numeronotafiscalcompleto_before_qstr = $this->numeronotafiscalcompleto;
          $this->numeronotafiscalcompleto = substr($this->Db->qstr($this->numeronotafiscalcompleto), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->numeronotafiscalcompleto = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->numeronotafiscalcompleto);
          }
          if ($this->numeronotafiscalcompleto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->numeronotafiscalcompleto = "null"; 
              $this->NM_val_null[] = "numeronotafiscalcompleto";
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 NotaFiscal_Frm_pack_ajax_response();
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
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdSituacaoDocumento = $this->idsituacaodocumento, IdEmpresa = $this->idempresa, IdPlanoConta = $this->idplanoconta, IdUsuarioCancelamento = $this->idusuariocancelamento, DataCompetencia = #$this->datacompetencia#, NumeroNotaFiscal = '$this->numeronotafiscal', CodigoVerificacao = '$this->codigoverificacao', IdUsuarioEmissao = $this->idusuarioemissao, DataVencimento = #$this->datavencimento#, ValorNotaFiscal = $this->valornotafiscal, ValorISS = $this->valoriss, ValorLiquido = $this->valorliquido, Discriminacao = '$this->discriminacao', CompetenciaSimples = #$this->competenciasimples#, NomeArquivo = '$this->nomearquivo', NomeArquivoBoleto = '$this->nomearquivoboleto', NomeArquivoXml = '$this->nomearquivoxml', BoletoLiberado = '$this->boletoliberado', NumeroLote = '$this->numerolote', Protocolo = '$this->protocolo', DataRecebimentoNota = #$this->datarecebimentonota#, NumeroNotaFiscalCompleto = '$this->numeronotafiscalcompleto'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdSituacaoDocumento = $this->idsituacaodocumento, IdEmpresa = $this->idempresa, IdPlanoConta = $this->idplanoconta, IdUsuarioCancelamento = $this->idusuariocancelamento, DataCompetencia = " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", NumeroNotaFiscal = '$this->numeronotafiscal', CodigoVerificacao = '$this->codigoverificacao', IdUsuarioEmissao = $this->idusuarioemissao, DataVencimento = " . $this->Ini->date_delim . $this->datavencimento . $this->Ini->date_delim1 . ", ValorNotaFiscal = $this->valornotafiscal, ValorISS = $this->valoriss, ValorLiquido = $this->valorliquido, Discriminacao = '$this->discriminacao', CompetenciaSimples = " . $this->Ini->date_delim . $this->competenciasimples . $this->Ini->date_delim1 . ", NomeArquivo = '$this->nomearquivo', NomeArquivoBoleto = '$this->nomearquivoboleto', NomeArquivoXml = '$this->nomearquivoxml', BoletoLiberado = '$this->boletoliberado', NumeroLote = '$this->numerolote', Protocolo = '$this->protocolo', DataRecebimentoNota = " . $this->Ini->date_delim . $this->datarecebimentonota . $this->Ini->date_delim1 . ", NumeroNotaFiscalCompleto = '$this->numeronotafiscalcompleto'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdSituacaoDocumento = $this->idsituacaodocumento, IdEmpresa = $this->idempresa, IdPlanoConta = $this->idplanoconta, IdUsuarioCancelamento = $this->idusuariocancelamento, DataCompetencia = " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", NumeroNotaFiscal = '$this->numeronotafiscal', CodigoVerificacao = '$this->codigoverificacao', IdUsuarioEmissao = $this->idusuarioemissao, DataVencimento = " . $this->Ini->date_delim . $this->datavencimento . $this->Ini->date_delim1 . ", ValorNotaFiscal = $this->valornotafiscal, ValorISS = $this->valoriss, ValorLiquido = $this->valorliquido, Discriminacao = '$this->discriminacao', CompetenciaSimples = " . $this->Ini->date_delim . $this->competenciasimples . $this->Ini->date_delim1 . ", NomeArquivo = '$this->nomearquivo', NomeArquivoBoleto = '$this->nomearquivoboleto', NomeArquivoXml = '$this->nomearquivoxml', BoletoLiberado = '$this->boletoliberado', NumeroLote = '$this->numerolote', Protocolo = '$this->protocolo', DataRecebimentoNota = " . $this->Ini->date_delim . $this->datarecebimentonota . $this->Ini->date_delim1 . ", NumeroNotaFiscalCompleto = '$this->numeronotafiscalcompleto'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCliente = $this->idcliente, IdSituacaoDocumento = $this->idsituacaodocumento, IdEmpresa = $this->idempresa, IdPlanoConta = $this->idplanoconta, IdUsuarioCancelamento = $this->idusuariocancelamento, DataCompetencia = " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", NumeroNotaFiscal = '$this->numeronotafiscal', CodigoVerificacao = '$this->codigoverificacao', IdUsuarioEmissao = $this->idusuarioemissao, DataVencimento = " . $this->Ini->date_delim . $this->datavencimento . $this->Ini->date_delim1 . ", ValorNotaFiscal = $this->valornotafiscal, ValorISS = $this->valoriss, ValorLiquido = $this->valorliquido, Discriminacao = '$this->discriminacao', CompetenciaSimples = " . $this->Ini->date_delim . $this->competenciasimples . $this->Ini->date_delim1 . ", NomeArquivo = '$this->nomearquivo', NomeArquivoBoleto = '$this->nomearquivoboleto', NomeArquivoXml = '$this->nomearquivoxml', BoletoLiberado = '$this->boletoliberado', NumeroLote = '$this->numerolote', Protocolo = '$this->protocolo', DataRecebimentoNota = " . $this->Ini->date_delim . $this->datarecebimentonota . $this->Ini->date_delim1 . ", NumeroNotaFiscalCompleto = '$this->numeronotafiscalcompleto'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] == "null"  && $this->nmgp_dados_select['idtenacidade'] == "") ? "null" : $this->nmgp_dados_select['idtenacidade'];
              if (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTenacidade = $this->idtenacidade"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idlancamentoreceita']) && $NM_val_form['idlancamentoreceita'] == "null"  && $this->nmgp_dados_select['idlancamentoreceita'] == "") ? "null" : $this->nmgp_dados_select['idlancamentoreceita'];
              if (isset($NM_val_form['idlancamentoreceita']) && $NM_val_form['idlancamentoreceita'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdLancamentoReceita = $this->idlancamentoreceita"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] == "null"  && $this->nmgp_dados_select['idusuarioauditoria'] == "") ? "null" : $this->nmgp_dados_select['idusuarioauditoria'];
              if (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioAuditoria = $this->idusuarioauditoria"; 
              } 
              $Prep_Tst = (isset($NM_val_form['dataemissao']) && $NM_val_form['dataemissao'] == "null"  && $this->nmgp_dados_select['dataemissao'] == "") ? "null" : $this->nmgp_dados_select['dataemissao'];
              if (isset($NM_val_form['dataemissao']) && $NM_val_form['dataemissao'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataEmissao = #$this->dataemissao#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataEmissao = " . $this->Ini->date_delim . $this->dataemissao . $this->Ini->date_delim1 . ""; 
                  } 
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
              $Prep_Tst = (isset($NM_val_form['datarecebimento']) && $NM_val_form['datarecebimento'] == "null"  && $this->nmgp_dados_select['datarecebimento'] == "") ? "null" : $this->nmgp_dados_select['datarecebimento'];
              if (isset($NM_val_form['datarecebimento']) && $NM_val_form['datarecebimento'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataRecebimento = #$this->datarecebimento#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataRecebimento = " . $this->Ini->date_delim . $this->datarecebimento . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuariobaixa']) && $NM_val_form['idusuariobaixa'] == "null"  && $this->nmgp_dados_select['idusuariobaixa'] == "") ? "null" : $this->nmgp_dados_select['idusuariobaixa'];
              if (isset($NM_val_form['idusuariobaixa']) && $NM_val_form['idusuariobaixa'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioBaixa = $this->idusuariobaixa"; 
              } 
              $Prep_Tst = (isset($NM_val_form['valorbaixa']) && $NM_val_form['valorbaixa'] == "null"  && $this->nmgp_dados_select['valorbaixa'] == "") ? "null" : $this->nmgp_dados_select['valorbaixa'];
              if (isset($NM_val_form['valorbaixa']) && $NM_val_form['valorbaixa'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "ValorBaixa = $this->valorbaixa"; 
              } 
              $Prep_Tst = (isset($NM_val_form['dataliberacaoboleto']) && $NM_val_form['dataliberacaoboleto'] == "null"  && $this->nmgp_dados_select['dataliberacaoboleto'] == "") ? "null" : $this->nmgp_dados_select['dataliberacaoboleto'];
              if (isset($NM_val_form['dataliberacaoboleto']) && $NM_val_form['dataliberacaoboleto'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataLiberacaoBoleto = #$this->dataliberacaoboleto#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataLiberacaoBoleto = " . $this->Ini->date_delim . $this->dataliberacaoboleto . $this->Ini->date_delim1 . ""; 
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
              $temp_cmd_sql = "";
              if ($this->nomereferenciaboleto_limpa == "S")
              {
                  $sDirErase     = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/";
                  $aEraseFiles[] = array('dir' => $sDirErase, 'file' => $this->nmgp_dados_form['nomereferenciaboleto']);
                  if ($this->nomereferenciaboleto != "null")
                  {
                      $this->nomereferenciaboleto = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                      $temp_cmd_sql = "NomeReferenciaBoleto = '" . $this->nomereferenciaboleto . "'";
                  }
                  else
                  {
                      $temp_cmd_sql = "NomeReferenciaBoleto = '" . $this->nomereferenciaboleto . "'";
                  }
                  $this->nomereferenciaboleto = "";
              }
              else
              {
                  if ($this->nomereferenciaboleto != "none" && $this->nomereferenciaboleto != "" && $this->nomereferenciaboleto != "*nm*")
                  {
                      $NM_conteudo =  $this->nomereferenciaboleto;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      $temp_cmd_sql .= " NomeReferenciaBoleto = '$NM_conteudo'";
                      }
                      else
                      {
                          $temp_cmd_sql .= " NomeReferenciaBoleto = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "nomereferenciaboleto";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              $temp_cmd_sql = "";
              if ($this->nomereferenciaxml_limpa == "S")
              {
                  if ($this->nomereferenciaxml != "null")
                  {
                      $this->nomereferenciaxml = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                      $temp_cmd_sql = "NomeReferenciaXml = '" . $this->nomereferenciaxml . "'";
                  }
                  else
                  {
                      $temp_cmd_sql = "NomeReferenciaXml = '" . $this->nomereferenciaxml . "'";
                  }
                  $this->nomereferenciaxml = "";
              }
              else
              {
                  if ($this->nomereferenciaxml != "none" && $this->nomereferenciaxml != "" && $this->nomereferenciaxml != "*nm*")
                  {
                      $NM_conteudo =  $this->nomereferenciaxml;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      $temp_cmd_sql .= " NomeReferenciaXml = '$NM_conteudo'";
                      }
                      else
                      {
                          $temp_cmd_sql .= " NomeReferenciaXml = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "nomereferenciaxml";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE IdNotaFiscal = $this->idnotafiscal ";  
              }  
              else  
              {
                  $comando .= " WHERE IdNotaFiscal = $this->idnotafiscal ";  
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
                                  NotaFiscal_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->numeronotafiscal = $this->numeronotafiscal_before_qstr;
              $this->codigoverificacao = $this->codigoverificacao_before_qstr;
              $this->discriminacao = $this->discriminacao_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->nomearquivoboleto = $this->nomearquivoboleto_before_qstr;
              $this->nomereferenciaboleto = $this->nomereferenciaboleto_before_qstr;
              $this->nomearquivoxml = $this->nomearquivoxml_before_qstr;
              $this->nomereferenciaxml = $this->nomereferenciaxml_before_qstr;
              $this->boletoliberado = $this->boletoliberado_before_qstr;
              $this->numerolote = $this->numerolote_before_qstr;
              $this->protocolo = $this->protocolo_before_qstr;
              $this->numeronotafiscalcompleto = $this->numeronotafiscalcompleto_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
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
              if ($this->nomereferenciaboleto_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['nomereferenciaboleto_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              if ($this->nomereferenciaxml_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['nomereferenciaxml_salva'] = array(
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['nomereferencia_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
                  $this->NM_ajax_info['fldList']['nomereferenciaboleto_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
                  $this->NM_ajax_info['fldList']['nomereferenciaxml_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idnotafiscal'])) { $this->idnotafiscal = $NM_val_form['idnotafiscal']; }
              elseif (isset($this->idnotafiscal)) { $this->nm_limpa_alfa($this->idnotafiscal); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcliente'])) { $this->idcliente = $NM_val_form['idcliente']; }
              elseif (isset($this->idcliente)) { $this->nm_limpa_alfa($this->idcliente); }
              if     (isset($NM_val_form) && isset($NM_val_form['idsituacaodocumento'])) { $this->idsituacaodocumento = $NM_val_form['idsituacaodocumento']; }
              elseif (isset($this->idsituacaodocumento)) { $this->nm_limpa_alfa($this->idsituacaodocumento); }
              if     (isset($NM_val_form) && isset($NM_val_form['idempresa'])) { $this->idempresa = $NM_val_form['idempresa']; }
              elseif (isset($this->idempresa)) { $this->nm_limpa_alfa($this->idempresa); }
              if     (isset($NM_val_form) && isset($NM_val_form['idlancamentoreceita'])) { $this->idlancamentoreceita = $NM_val_form['idlancamentoreceita']; }
              elseif (isset($this->idlancamentoreceita)) { $this->nm_limpa_alfa($this->idlancamentoreceita); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanoconta'])) { $this->idplanoconta = $NM_val_form['idplanoconta']; }
              elseif (isset($this->idplanoconta)) { $this->nm_limpa_alfa($this->idplanoconta); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuariocancelamento'])) { $this->idusuariocancelamento = $NM_val_form['idusuariocancelamento']; }
              elseif (isset($this->idusuariocancelamento)) { $this->nm_limpa_alfa($this->idusuariocancelamento); }
              if     (isset($NM_val_form) && isset($NM_val_form['numeronotafiscal'])) { $this->numeronotafiscal = $NM_val_form['numeronotafiscal']; }
              elseif (isset($this->numeronotafiscal)) { $this->nm_limpa_alfa($this->numeronotafiscal); }
              if     (isset($NM_val_form) && isset($NM_val_form['codigoverificacao'])) { $this->codigoverificacao = $NM_val_form['codigoverificacao']; }
              elseif (isset($this->codigoverificacao)) { $this->nm_limpa_alfa($this->codigoverificacao); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuarioemissao'])) { $this->idusuarioemissao = $NM_val_form['idusuarioemissao']; }
              elseif (isset($this->idusuarioemissao)) { $this->nm_limpa_alfa($this->idusuarioemissao); }
              if     (isset($NM_val_form) && isset($NM_val_form['valornotafiscal'])) { $this->valornotafiscal = $NM_val_form['valornotafiscal']; }
              elseif (isset($this->valornotafiscal)) { $this->nm_limpa_alfa($this->valornotafiscal); }
              if     (isset($NM_val_form) && isset($NM_val_form['valoriss'])) { $this->valoriss = $NM_val_form['valoriss']; }
              elseif (isset($this->valoriss)) { $this->nm_limpa_alfa($this->valoriss); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorliquido'])) { $this->valorliquido = $NM_val_form['valorliquido']; }
              elseif (isset($this->valorliquido)) { $this->nm_limpa_alfa($this->valorliquido); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuariobaixa'])) { $this->idusuariobaixa = $NM_val_form['idusuariobaixa']; }
              elseif (isset($this->idusuariobaixa)) { $this->nm_limpa_alfa($this->idusuariobaixa); }
              if     (isset($NM_val_form) && isset($NM_val_form['valorbaixa'])) { $this->valorbaixa = $NM_val_form['valorbaixa']; }
              elseif (isset($this->valorbaixa)) { $this->nm_limpa_alfa($this->valorbaixa); }
              if     (isset($NM_val_form) && isset($NM_val_form['discriminacao'])) { $this->discriminacao = $NM_val_form['discriminacao']; }
              elseif (isset($this->discriminacao)) { $this->nm_limpa_alfa($this->discriminacao); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomearquivo'])) { $this->nomearquivo = $NM_val_form['nomearquivo']; }
              elseif (isset($this->nomearquivo)) { $this->nm_limpa_alfa($this->nomearquivo); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomearquivoboleto'])) { $this->nomearquivoboleto = $NM_val_form['nomearquivoboleto']; }
              elseif (isset($this->nomearquivoboleto)) { $this->nm_limpa_alfa($this->nomearquivoboleto); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomearquivoxml'])) { $this->nomearquivoxml = $NM_val_form['nomearquivoxml']; }
              elseif (isset($this->nomearquivoxml)) { $this->nm_limpa_alfa($this->nomearquivoxml); }
              if     (isset($NM_val_form) && isset($NM_val_form['boletoliberado'])) { $this->boletoliberado = $NM_val_form['boletoliberado']; }
              elseif (isset($this->boletoliberado)) { $this->nm_limpa_alfa($this->boletoliberado); }
              if     (isset($NM_val_form) && isset($NM_val_form['numerolote'])) { $this->numerolote = $NM_val_form['numerolote']; }
              elseif (isset($this->numerolote)) { $this->nm_limpa_alfa($this->numerolote); }
              if     (isset($NM_val_form) && isset($NM_val_form['protocolo'])) { $this->protocolo = $NM_val_form['protocolo']; }
              elseif (isset($this->protocolo)) { $this->nm_limpa_alfa($this->protocolo); }
              if     (isset($NM_val_form) && isset($NM_val_form['numeronotafiscalcompleto'])) { $this->numeronotafiscalcompleto = $NM_val_form['numeronotafiscalcompleto']; }
              elseif (isset($this->numeronotafiscalcompleto)) { $this->nm_limpa_alfa($this->numeronotafiscalcompleto); }

              $this->nm_formatar_campos();

              $bChange_nomereferencia = false;
              if (isset($this->nomereferencia_original_filename) && '' != $this->nomereferencia_original_filename && $this->nomereferencia_original_filename != $this->nomereferencia)
              {
                  $sTmpOrig_nomereferencia = $this->nomereferencia;
                  $this->nomereferencia    = $this->nomereferencia_original_filename;
                  $bChange_nomereferencia  = true;
              }

              $bChange_nomereferenciaboleto = false;
              if (isset($this->nomereferenciaboleto_original_filename) && '' != $this->nomereferenciaboleto_original_filename && $this->nomereferenciaboleto_original_filename != $this->nomereferenciaboleto)
              {
                  $sTmpOrig_nomereferenciaboleto = $this->nomereferenciaboleto;
                  $this->nomereferenciaboleto    = $this->nomereferenciaboleto_original_filename;
                  $bChange_nomereferenciaboleto  = true;
              }

              $bChange_nomereferenciaxml = false;
              if (isset($this->nomereferenciaxml_original_filename) && '' != $this->nomereferenciaxml_original_filename && $this->nomereferenciaxml_original_filename != $this->nomereferenciaxml)
              {
                  $sTmpOrig_nomereferenciaxml = $this->nomereferenciaxml;
                  $this->nomereferenciaxml    = $this->nomereferenciaxml_original_filename;
                  $bChange_nomereferenciaxml  = true;
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('datacompetencia', 'idempresa', 'idnotafiscal', 'idcliente', 'idplanoconta', 'datavencimento', 'valornotafiscal', 'valoriss', 'valorliquido', 'idusuarioemissao', 'idsituacaodocumento', 'boletoliberado', 'datarecebimento', 'databaixa', 'idusuariobaixa', 'valorbaixa', 'idlancamentoreceita', 'numeronotafiscal', 'numeronotafiscalcompleto', 'competenciasimples', 'codigoverificacao', 'datarecebimentonota', 'numerolote', 'protocolo', 'idusuariocancelamento', 'discriminacao', 'nomereferencia', 'nomearquivo', 'nomereferenciaboleto', 'nomearquivoboleto', 'nomereferenciaxml', 'nomearquivoxml'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              if ($bChange_nomereferencia)
              {
                  $this->nomereferencia                   = $sTmpOrig_nomereferencia;
                  $this->nomereferencia_original_filename = '';
              }

              if ($bChange_nomereferenciaboleto)
              {
                  $this->nomereferenciaboleto                   = $sTmpOrig_nomereferenciaboleto;
                  $this->nomereferenciaboleto_original_filename = '';
              }

              if ($bChange_nomereferenciaxml)
              {
                  $this->nomereferenciaxml                   = $sTmpOrig_nomereferenciaxml;
                  $this->nomereferenciaxml_original_filename = '';
              }

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "IdNotaFiscal, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(IdNotaFiscal) from " . $this->Ini->nm_tabela; 
          $comando = "select max(IdNotaFiscal) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  NotaFiscal_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $this->idnotafiscal_before_qstr = $this->idnotafiscal = $rs->fields[0] + 1;
          $rs->Close(); 
              $this->dataemissao =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->dataemissao_hora =  date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      NotaFiscal_Frm_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $dir_file = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
              $_test_file = $this->fetchUniqueUploadName($this->nomereferenciaxml_scfile_name, $dir_file, "nomereferenciaxml");
              if (trim($this->nomereferenciaxml_scfile_name) != $_test_file)
              {
                  $this->nomereferenciaxml_scfile_name = $_test_file;
                  $this->nomereferenciaxml = $_test_file;
                 $this->nomeaplicacaoauditoria_before_qstr = $this->nomeaplicacaoauditoria;
                 $this->nomeaplicacaoauditoria = substr($this->Db->qstr($this->nomeaplicacaoauditoria), 1, -1); 
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idlancamentoreceita != "")
                  { 
                       $compl_insert     .= ", IdLancamentoReceita";
                       $compl_insert_val .= ", $this->idlancamentoreceita";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdTenacidade, IdCliente, IdSituacaoDocumento, IdEmpresa, IdPlanoConta, IdUsuarioAuditoria, IdUsuarioCancelamento, DataCompetencia, NumeroNotaFiscal, CodigoVerificacao, DataEmissao, IdUsuarioEmissao, DataVencimento, ValorNotaFiscal, ValorISS, ValorLiquido, DataBaixa, DataRecebimento, IdUsuarioBaixa, ValorBaixa, Discriminacao, CompetenciaSimples, NomeArquivo, NomeReferencia, NomeArquivoBoleto, NomeReferenciaBoleto, DataLiberacaoBoleto, NomeArquivoXml, NomeReferenciaXml, BoletoLiberado, NumeroLote, Protocolo, DataRecebimentoNota, NumeroNotaFiscalCompleto, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES ($this->idtenacidade, $this->idcliente, $this->idsituacaodocumento, $this->idempresa, $this->idplanoconta, $this->idusuarioauditoria, $this->idusuariocancelamento, #$this->datacompetencia#, '$this->numeronotafiscal', '$this->codigoverificacao', #$this->dataemissao#, $this->idusuarioemissao, #$this->datavencimento#, $this->valornotafiscal, $this->valoriss, $this->valorliquido, #$this->databaixa#, #$this->datarecebimento#, $this->idusuariobaixa, $this->valorbaixa, '$this->discriminacao', #$this->competenciasimples#, '$this->nomearquivo', '$this->nomereferencia', '$this->nomearquivoboleto', '$this->nomereferenciaboleto', #$this->dataliberacaoboleto#, '$this->nomearquivoxml', '$this->nomereferenciaxml', '$this->boletoliberado', '$this->numerolote', '$this->protocolo', #$this->datarecebimentonota#, '$this->numeronotafiscalcompleto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idlancamentoreceita != "")
                  { 
                       $compl_insert     .= ", IdLancamentoReceita";
                       $compl_insert_val .= ", $this->idlancamentoreceita";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdCliente, IdSituacaoDocumento, IdEmpresa, IdPlanoConta, IdUsuarioAuditoria, IdUsuarioCancelamento, DataCompetencia, NumeroNotaFiscal, CodigoVerificacao, DataEmissao, IdUsuarioEmissao, DataVencimento, ValorNotaFiscal, ValorISS, ValorLiquido, DataBaixa, DataRecebimento, IdUsuarioBaixa, ValorBaixa, Discriminacao, CompetenciaSimples, NomeArquivo, NomeReferencia, NomeArquivoBoleto, NomeReferenciaBoleto, DataLiberacaoBoleto, NomeArquivoXml, NomeReferenciaXml, BoletoLiberado, NumeroLote, Protocolo, DataRecebimentoNota, NumeroNotaFiscalCompleto, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcliente, $this->idsituacaodocumento, $this->idempresa, $this->idplanoconta, $this->idusuarioauditoria, $this->idusuariocancelamento, " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", '$this->numeronotafiscal', '$this->codigoverificacao', " . $this->Ini->date_delim . $this->dataemissao . $this->Ini->date_delim1 . ", $this->idusuarioemissao, " . $this->Ini->date_delim . $this->datavencimento . $this->Ini->date_delim1 . ", $this->valornotafiscal, $this->valoriss, $this->valorliquido, " . $this->Ini->date_delim . $this->databaixa . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datarecebimento . $this->Ini->date_delim1 . ", $this->idusuariobaixa, $this->valorbaixa, '$this->discriminacao', " . $this->Ini->date_delim . $this->competenciasimples . $this->Ini->date_delim1 . ", '$this->nomearquivo', '$this->nomereferencia', '$this->nomearquivoboleto', '$this->nomereferenciaboleto', " . $this->Ini->date_delim . $this->dataliberacaoboleto . $this->Ini->date_delim1 . ", '$this->nomearquivoxml', '$this->nomereferenciaxml', '$this->boletoliberado', '$this->numerolote', '$this->protocolo', " . $this->Ini->date_delim . $this->datarecebimentonota . $this->Ini->date_delim1 . ", '$this->numeronotafiscalcompleto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idlancamentoreceita != "")
                  { 
                       $compl_insert     .= ", IdLancamentoReceita";
                       $compl_insert_val .= ", $this->idlancamentoreceita";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdCliente, IdSituacaoDocumento, IdEmpresa, IdPlanoConta, IdUsuarioAuditoria, IdUsuarioCancelamento, DataCompetencia, NumeroNotaFiscal, CodigoVerificacao, DataEmissao, IdUsuarioEmissao, DataVencimento, ValorNotaFiscal, ValorISS, ValorLiquido, DataBaixa, DataRecebimento, IdUsuarioBaixa, ValorBaixa, Discriminacao, CompetenciaSimples, NomeArquivo, NomeReferencia, NomeArquivoBoleto, NomeReferenciaBoleto, DataLiberacaoBoleto, NomeArquivoXml, NomeReferenciaXml, BoletoLiberado, NumeroLote, Protocolo, DataRecebimentoNota, NumeroNotaFiscalCompleto, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcliente, $this->idsituacaodocumento, $this->idempresa, $this->idplanoconta, $this->idusuarioauditoria, $this->idusuariocancelamento, " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", '$this->numeronotafiscal', '$this->codigoverificacao', " . $this->Ini->date_delim . $this->dataemissao . $this->Ini->date_delim1 . ", $this->idusuarioemissao, " . $this->Ini->date_delim . $this->datavencimento . $this->Ini->date_delim1 . ", $this->valornotafiscal, $this->valoriss, $this->valorliquido, " . $this->Ini->date_delim . $this->databaixa . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datarecebimento . $this->Ini->date_delim1 . ", $this->idusuariobaixa, $this->valorbaixa, '$this->discriminacao', " . $this->Ini->date_delim . $this->competenciasimples . $this->Ini->date_delim1 . ", '$this->nomearquivo', '$this->nomereferencia', '$this->nomearquivoboleto', '$this->nomereferenciaboleto', " . $this->Ini->date_delim . $this->dataliberacaoboleto . $this->Ini->date_delim1 . ", '$this->nomearquivoxml', '$this->nomereferenciaxml', '$this->boletoliberado', '$this->numerolote', '$this->protocolo', " . $this->Ini->date_delim . $this->datarecebimentonota . $this->Ini->date_delim1 . ", '$this->numeronotafiscalcompleto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->idlancamentoreceita != "")
                  { 
                       $compl_insert     .= ", IdLancamentoReceita";
                       $compl_insert_val .= ", $this->idlancamentoreceita";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdCliente, IdSituacaoDocumento, IdEmpresa, IdPlanoConta, IdUsuarioAuditoria, IdUsuarioCancelamento, DataCompetencia, NumeroNotaFiscal, CodigoVerificacao, DataEmissao, IdUsuarioEmissao, DataVencimento, ValorNotaFiscal, ValorISS, ValorLiquido, DataBaixa, DataRecebimento, IdUsuarioBaixa, ValorBaixa, Discriminacao, CompetenciaSimples, NomeArquivo, NomeReferencia, NomeArquivoBoleto, NomeReferenciaBoleto, DataLiberacaoBoleto, NomeArquivoXml, NomeReferenciaXml, BoletoLiberado, NumeroLote, Protocolo, DataRecebimentoNota, NumeroNotaFiscalCompleto, EnderecoIpAuditoria, NomeAplicacaoAuditoria $compl_insert) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcliente, $this->idsituacaodocumento, $this->idempresa, $this->idplanoconta, $this->idusuarioauditoria, $this->idusuariocancelamento, " . $this->Ini->date_delim . $this->datacompetencia . $this->Ini->date_delim1 . ", '$this->numeronotafiscal', '$this->codigoverificacao', " . $this->Ini->date_delim . $this->dataemissao . $this->Ini->date_delim1 . ", $this->idusuarioemissao, " . $this->Ini->date_delim . $this->datavencimento . $this->Ini->date_delim1 . ", $this->valornotafiscal, $this->valoriss, $this->valorliquido, " . $this->Ini->date_delim . $this->databaixa . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->datarecebimento . $this->Ini->date_delim1 . ", $this->idusuariobaixa, $this->valorbaixa, '$this->discriminacao', " . $this->Ini->date_delim . $this->competenciasimples . $this->Ini->date_delim1 . ", '$this->nomearquivo', '$this->nomereferencia', '$this->nomearquivoboleto', '$this->nomereferenciaboleto', " . $this->Ini->date_delim . $this->dataliberacaoboleto . $this->Ini->date_delim1 . ", '$this->nomearquivoxml', '$this->nomereferenciaxml', '$this->boletoliberado', '$this->numerolote', '$this->protocolo', " . $this->Ini->date_delim . $this->datarecebimentonota . $this->Ini->date_delim1 . ", '$this->numeronotafiscalcompleto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria' $compl_insert_val)"; 
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
                              NotaFiscal_Frm_pack_ajax_response();
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
                          NotaFiscal_Frm_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->idnotafiscal =  $rsy->fields[0];
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
                  $this->idnotafiscal = $rsy->fields[0];
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
                  $this->idnotafiscal = $rsy->fields[0];
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
                  $this->idnotafiscal = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->numeronotafiscal = $this->numeronotafiscal_before_qstr;
              $this->codigoverificacao = $this->codigoverificacao_before_qstr;
              $this->discriminacao = $this->discriminacao_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->nomearquivoboleto = $this->nomearquivoboleto_before_qstr;
              $this->nomereferenciaboleto = $this->nomereferenciaboleto_before_qstr;
              $this->nomearquivoxml = $this->nomearquivoxml_before_qstr;
              $this->nomereferenciaxml = $this->nomereferenciaxml_before_qstr;
              $this->boletoliberado = $this->boletoliberado_before_qstr;
              $this->numerolote = $this->numerolote_before_qstr;
              $this->protocolo = $this->protocolo_before_qstr;
              $this->numeronotafiscalcompleto = $this->numeronotafiscalcompleto_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']);
              }

              $dir_doc = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
              if (nm_mkdir($dir_doc))  
              { 
                  $reg_nomereferencia = ""; 
                  if (is_file($this->SC_DOC_nomereferencia)) { 
                      $arq_nomereferencia = fopen($this->SC_DOC_nomereferencia, "r") ; 
                      $reg_nomereferencia = fread($arq_nomereferencia, filesize($this->SC_DOC_nomereferencia)) ; 
                      fclose($arq_nomereferencia) ;  
                      $arq_nomereferencia = fopen($dir_doc . trim($this->nomereferencia_scfile_name), "w") ; 
                      fwrite($arq_nomereferencia, $reg_nomereferencia) ;  
                      fclose($arq_nomereferencia) ;  
                  }
              } 
              $dir_doc = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
              if (nm_mkdir($dir_doc))  
              { 
                  $reg_nomereferenciaboleto = ""; 
                  if (is_file($this->SC_DOC_nomereferenciaboleto)) { 
                      $arq_nomereferenciaboleto = fopen($this->SC_DOC_nomereferenciaboleto, "r") ; 
                      $reg_nomereferenciaboleto = fread($arq_nomereferenciaboleto, filesize($this->SC_DOC_nomereferenciaboleto)) ; 
                      fclose($arq_nomereferenciaboleto) ;  
                      $arq_nomereferenciaboleto = fopen($dir_doc . trim($this->nomereferenciaboleto_scfile_name), "w") ; 
                      fwrite($arq_nomereferenciaboleto, $reg_nomereferenciaboleto) ;  
                      fclose($arq_nomereferenciaboleto) ;  
                  }
              } 
              $dir_doc = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
              if (nm_mkdir($dir_doc))  
              { 
                  $reg_nomereferenciaxml = ""; 
                  if (is_file($this->SC_DOC_nomereferenciaxml)) { 
                      $arq_nomereferenciaxml = fopen($this->SC_DOC_nomereferenciaxml, "r") ; 
                      $reg_nomereferenciaxml = fread($arq_nomereferenciaxml, filesize($this->SC_DOC_nomereferenciaxml)) ; 
                      fclose($arq_nomereferenciaxml) ;  
                      $arq_nomereferenciaxml = fopen($dir_doc . trim($this->nomereferenciaxml_scfile_name), "w") ; 
                      fwrite($arq_nomereferenciaxml, $reg_nomereferenciaxml) ;  
                      fclose($arq_nomereferenciaxml) ;  
                  }
              } 
              $this->sc_evento = "insert"; 
              $this->numeronotafiscal = $this->numeronotafiscal_before_qstr;
              $this->codigoverificacao = $this->codigoverificacao_before_qstr;
              $this->discriminacao = $this->discriminacao_before_qstr;
              $this->nomearquivo = $this->nomearquivo_before_qstr;
              $this->nomereferencia = $this->nomereferencia_before_qstr;
              $this->nomearquivoboleto = $this->nomearquivoboleto_before_qstr;
              $this->nomereferenciaboleto = $this->nomereferenciaboleto_before_qstr;
              $this->nomearquivoxml = $this->nomearquivoxml_before_qstr;
              $this->nomereferenciaxml = $this->nomereferenciaxml_before_qstr;
              $this->boletoliberado = $this->boletoliberado_before_qstr;
              $this->numerolote = $this->numerolote_before_qstr;
              $this->protocolo = $this->protocolo_before_qstr;
              $this->numeronotafiscalcompleto = $this->numeronotafiscalcompleto_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->nmgp_botoes['Auditoria'] = "on";
              $this->nmgp_botoes['sc_btn_0'] = "on";
              $this->nmgp_botoes['ImprimirNotaFiscal'] = "on";
              $this->nmgp_botoes['Cancelar'] = "on";
              $this->nmgp_botoes['GerarNota'] = "on";
              $this->nmgp_botoes['CancelarNotaPortalNacional'] = "on";
              $this->return_after_insert();
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->idnotafiscal = substr($this->Db->qstr($this->idnotafiscal), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdNotaFiscal = $this->idnotafiscal "); 
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
                          NotaFiscal_Frm_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
                  $sDirErase     = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
                  $aEraseFiles[] = array('dir' => $sDirErase, 'file' => $this->nmgp_dados_form['nomereferencia']);
                  $sDirErase     = $this->Ini->path_doc . "/" . $_SESSION['varIdTenacidade'] . "/"; 
                  $aEraseFiles[] = array('dir' => $sDirErase, 'file' => $this->nmgp_dados_form['nomereferenciaboleto']);
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']);
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
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['decimal_db'] == ",")
        {
            $this->nm_troca_decimal(",", ".");
        }
        
/*----- Scriptcase Locale: Event onAfterInsert ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = (isset($_SESSION['varDiretorioArquivo'])) ? $_SESSION['varDiretorioArquivo'] : "";}
  if ($this->nomereferencia  != "") { 
	$nomeOriginal = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomearquivo ;
	$nomeReferencia = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferencia ;
	rename($nomeOriginal, $nomeReferencia);
}

if ($this->nomereferenciaboleto  != "") { 
	$nomeOriginal = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomearquivoboleto ;
	$nomeReferencia = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferenciaboleto ;
	rename($nomeOriginal, $nomeReferencia);
}

$check_sql_integracao = "SELECT IntegracaoInfolabAtiva"
   . " FROM configuracao"
   . " WHERE IdTenacidade='$this->sc_temp_varIdTenacidade'";
 
      $nm_select = $check_sql_integracao; 
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

if ($this->rs[0][0] == 'N') {

$check_sql = "SELECT IdContaCaixaLancamentoReceitaNotaFiscal, IdPlanoContaLancamentoReceitaNotaFiscal, IdTipoEspecieLancamentoReceitaNotaFiscal"
   . " FROM configuracao"
   . " WHERE IdConfiguracao = (select min(IdConfiguracao) from configuracao where IdTenacidade='$this->sc_temp_varIdTenacidade')";
 
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
}
elseif (empty($this->rs)) {
    $IdContaCaixa = '';
    $IdPlanoConta = '';
    $IdTipoEspecie = '';
}
else {
    $IdContaCaixa = $this->rs[0][0];
    $IdPlanoConta = $this->rs[0][1];
    $IdTipoEspecie = $this->rs[0][2];
}

$SQL = "INSERT INTO lancamentoreceita (IdTenacidade, IdCliente, IdTipoAgente, EnviouEmail, IdContaCaixa, IdPlanoConta,  IdSituacaoDocumento, IdTipoEspecie, IdNotaFiscal, IdEmpresa, DataInclusao, IdUsuarioInclusao, DataPrevisao, IdUsuarioPrevisao, ValorPrevisao, IdUsuarioAuditoria, EnderecoIpAuditoria, NomeAplicacaoAuditoria, DataCompetencia) VALUES ($this->sc_temp_varIdTenacidade,$this->idcliente , 1, 'N', " . $IdContaCaixa . ", " . $this->idplanoconta  . ", $this->idsituacaodocumento ,". $IdTipoEspecie .", $this->idnotafiscal ,$this->idempresa , CURRENT_DATE, $this->idusuarioemissao , '$this->datavencimento', $this->idusuarioemissao , $this->valorliquido " . ", '$this->sc_temp_varIdUsuario', '" . $_SERVER['REMOTE_ADDR'] . "', '" . $this->Ini->nm_cod_apl . "','".$this->datacompetencia ."')";

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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


$SQL = "UPDATE notafiscal SET IdLancamentoReceita = LAST_INSERT_ID() WHERE IdNotaFiscal = $this->idnotafiscal ";

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
                NotaFiscal_Frm_pack_ajax_response();
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
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterInsert ------*/
 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        
/*----- Scriptcase Locale: Event onAfterUpdate ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  if (!empty($this->idlancamentoreceita )) {
	
	if ($this->idsituacaodocumento  == 4) {
  		
		$SQL = "UPDATE lancamentoreceita SET IdSituacaoDocumento = $this->idsituacaodocumento ,
        		         DataRealizacao = '$this->databaixa', IdUsuarioRealizacao = $this->idusuariobaixa , ValorRealizacao = $this->valorbaixa , IdPlanoConta = $this->idplanoconta 
    	  		WHERE IdLancamentoReceita = $this->idlancamentoreceita ";	
	

		if ($this->idplanoconta  == 26) {

			$check_sql = "SELECT ClientePublico FROM cliente WHERE IdCliente = ".$this->idcliente ;
			 
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



			$check_sql = "SELECT l.IdLancamentoReceita FROM lancamentoreceita l WHERE IDCliente = ".$this->idcliente ." AND IdTenacidade = 1 AND IdSituacaoDocumento IN (238,1,73,2) AND DataPrevisao < NOW()"; 
			 
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


			if (!isset($this->rs1[0][0]) || $this->rs[0][0] == 'S') { 

				$update_sql = "UPDATE cliente SET DataExpiracao = DATE_ADD(DataExpiracao, INTERVAL 30 DAY), IdUsuarioAuditoria = 66 WHERE IdCliente = ".$this->idcliente ;
				
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      					

			}
		}		
	} else {
		
  		$SQL = "UPDATE lancamentoreceita SET IdSituacaoDocumento = $this->idsituacaodocumento , IdPlanoConta = $this->idplanoconta , DataPrevisao = '". $this->datavencimento  . "'
	  			WHERE IdLancamentoReceita = $this->idlancamentoreceita ";
		
	}	  
	
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
                NotaFiscal_Frm_pack_ajax_response();
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
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onAfterUpdate ------*/
 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      
/*----- Scriptcase Locale: Event onAfterDelete ------*/
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdLancamentoReceita)) {$this->sc_temp_varIdLancamentoReceita = (isset($_SESSION['varIdLancamentoReceita'])) ? $_SESSION['varIdLancamentoReceita'] : "";}
  $queryExclusao = "DELETE FROM lancamentoreceita WHERE IdLancamentoReceita = '".$this->sc_temp_varIdLancamentoReceita."'";
	
     $nm_select = $queryExclusao; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
          
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->sc_temp_varIdLancamentoReceita)) { $_SESSION['varIdLancamentoReceita'] = $this->sc_temp_varIdLancamentoReceita;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['decimal_db'] == ",")
   {
       $this->nm_troca_decimal(".", ",");
   }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['parms'] = "idnotafiscal?#?$this->idnotafiscal?@?"; 
      }
      $this->nmgp_dados_form['nomereferencia'] = ""; 
      $this->nomereferencia_limpa = ""; 
      $this->nomereferencia_salva = ""; 
      $this->nmgp_dados_form['nomereferenciaboleto'] = ""; 
      $this->nomereferenciaboleto_limpa = ""; 
      $this->nomereferenciaboleto_salva = ""; 
      $this->nmgp_dados_form['nomereferenciaxml'] = ""; 
      $this->nomereferenciaxml_limpa = ""; 
      $this->nomereferenciaxml_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idnotafiscal = null === $this->idnotafiscal ? null : substr($this->Db->qstr($this->idnotafiscal), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter'] . ")";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdNotaFiscal, IdTenacidade, IdCliente, IdSituacaoDocumento, IdEmpresa, IdLancamentoReceita, IdPlanoConta, IdUsuarioAuditoria, IdUsuarioCancelamento, DataCompetencia, NumeroNotaFiscal, CodigoVerificacao, DataEmissao, IdUsuarioEmissao, DataVencimento, ValorNotaFiscal, ValorISS, ValorLiquido, DataBaixa, DataRecebimento, IdUsuarioBaixa, ValorBaixa, Discriminacao, CompetenciaSimples, NomeArquivo, NomeReferencia, NomeArquivoBoleto, NomeReferenciaBoleto, DataLiberacaoBoleto, NomeArquivoXml, NomeReferenciaXml, BoletoLiberado, NumeroLote, Protocolo, DataRecebimentoNota, NumeroNotaFiscalCompleto, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "IdNotaFiscal = $this->idnotafiscal"; 
              }  
              else  
              {
                  $aWhere[] = "IdNotaFiscal = $this->idnotafiscal"; 
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
          $sc_order_by = "IdNotaFiscal";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "insert" || $this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['select'] = ""; 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes['Auditoria'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['sc_btn_0'] = $this->nmgp_botoes['sc_btn_0'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['ImprimirNotaFiscal'] = $this->nmgp_botoes['ImprimirNotaFiscal'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['Cancelar'] = $this->nmgp_botoes['Cancelar'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['GerarNota'] = $this->nmgp_botoes['GerarNota'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['CancelarNotaPortalNacional'] = $this->nmgp_botoes['CancelarNotaPortalNacional'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes['Auditoria'] = "off";
              $this->NM_ajax_info['buttonDisplay']['sc_btn_0'] = $this->nmgp_botoes['sc_btn_0'] = "off";
              $this->NM_ajax_info['buttonDisplay']['ImprimirNotaFiscal'] = $this->nmgp_botoes['ImprimirNotaFiscal'] = "off";
              $this->NM_ajax_info['buttonDisplay']['Cancelar'] = $this->nmgp_botoes['Cancelar'] = "off";
              $this->NM_ajax_info['buttonDisplay']['GerarNota'] = $this->nmgp_botoes['GerarNota'] = "off";
              $this->NM_ajax_info['buttonDisplay']['CancelarNotaPortalNacional'] = $this->nmgp_botoes['CancelarNotaPortalNacional'] = "off";
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
              $this->idnotafiscal = $rs->fields[0] ; 
              $this->nmgp_dados_select['idnotafiscal'] = $this->idnotafiscal;
              $this->idtenacidade = $rs->fields[1] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idcliente = $rs->fields[2] ; 
              $this->nmgp_dados_select['idcliente'] = $this->idcliente;
              $this->idsituacaodocumento = $rs->fields[3] ; 
              $this->nmgp_dados_select['idsituacaodocumento'] = $this->idsituacaodocumento;
              $this->idempresa = $rs->fields[4] ; 
              $this->nmgp_dados_select['idempresa'] = $this->idempresa;
              $this->idlancamentoreceita = $rs->fields[5] ; 
              $this->nmgp_dados_select['idlancamentoreceita'] = $this->idlancamentoreceita;
              $this->idplanoconta = $rs->fields[6] ; 
              $this->nmgp_dados_select['idplanoconta'] = $this->idplanoconta;
              $this->idusuarioauditoria = $rs->fields[7] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->idusuariocancelamento = $rs->fields[8] ; 
              $this->nmgp_dados_select['idusuariocancelamento'] = $this->idusuariocancelamento;
              $this->datacompetencia = $rs->fields[9] ; 
              if (substr($this->datacompetencia, 10, 1) == "-") 
              { 
                 $this->datacompetencia = substr($this->datacompetencia, 0, 10) . " " . substr($this->datacompetencia, 11);
              } 
              if (substr($this->datacompetencia, 13, 1) == ".") 
              { 
                 $this->datacompetencia = substr($this->datacompetencia, 0, 13) . ":" . substr($this->datacompetencia, 14, 2) . ":" . substr($this->datacompetencia, 17);
              } 
              $this->nmgp_dados_select['datacompetencia'] = $this->datacompetencia;
              $this->numeronotafiscal = $rs->fields[10] ; 
              $this->nmgp_dados_select['numeronotafiscal'] = $this->numeronotafiscal;
              $this->codigoverificacao = $rs->fields[11] ; 
              $this->nmgp_dados_select['codigoverificacao'] = $this->codigoverificacao;
              $this->dataemissao = $rs->fields[12] ; 
              if (substr($this->dataemissao, 10, 1) == "-") 
              { 
                 $this->dataemissao = substr($this->dataemissao, 0, 10) . " " . substr($this->dataemissao, 11);
              } 
              if (substr($this->dataemissao, 13, 1) == ".") 
              { 
                 $this->dataemissao = substr($this->dataemissao, 0, 13) . ":" . substr($this->dataemissao, 14, 2) . ":" . substr($this->dataemissao, 17);
              } 
              $this->nmgp_dados_select['dataemissao'] = $this->dataemissao;
              $this->idusuarioemissao = $rs->fields[13] ; 
              $this->nmgp_dados_select['idusuarioemissao'] = $this->idusuarioemissao;
              $this->datavencimento = $rs->fields[14] ; 
              if (substr($this->datavencimento, 10, 1) == "-") 
              { 
                 $this->datavencimento = substr($this->datavencimento, 0, 10) . " " . substr($this->datavencimento, 11);
              } 
              if (substr($this->datavencimento, 13, 1) == ".") 
              { 
                 $this->datavencimento = substr($this->datavencimento, 0, 13) . ":" . substr($this->datavencimento, 14, 2) . ":" . substr($this->datavencimento, 17);
              } 
              $this->nmgp_dados_select['datavencimento'] = $this->datavencimento;
              $this->valornotafiscal = trim($rs->fields[15]) ; 
              $this->nmgp_dados_select['valornotafiscal'] = $this->valornotafiscal;
              $this->valoriss = trim($rs->fields[16]) ; 
              $this->nmgp_dados_select['valoriss'] = $this->valoriss;
              $this->valorliquido = trim($rs->fields[17]) ; 
              $this->nmgp_dados_select['valorliquido'] = $this->valorliquido;
              $this->databaixa = $rs->fields[18] ; 
              if (substr($this->databaixa, 10, 1) == "-") 
              { 
                 $this->databaixa = substr($this->databaixa, 0, 10) . " " . substr($this->databaixa, 11);
              } 
              if (substr($this->databaixa, 13, 1) == ".") 
              { 
                 $this->databaixa = substr($this->databaixa, 0, 13) . ":" . substr($this->databaixa, 14, 2) . ":" . substr($this->databaixa, 17);
              } 
              $this->nmgp_dados_select['databaixa'] = $this->databaixa;
              $this->datarecebimento = $rs->fields[19] ; 
              if (substr($this->datarecebimento, 10, 1) == "-") 
              { 
                 $this->datarecebimento = substr($this->datarecebimento, 0, 10) . " " . substr($this->datarecebimento, 11);
              } 
              if (substr($this->datarecebimento, 13, 1) == ".") 
              { 
                 $this->datarecebimento = substr($this->datarecebimento, 0, 13) . ":" . substr($this->datarecebimento, 14, 2) . ":" . substr($this->datarecebimento, 17);
              } 
              $this->nmgp_dados_select['datarecebimento'] = $this->datarecebimento;
              $this->idusuariobaixa = $rs->fields[20] ; 
              $this->nmgp_dados_select['idusuariobaixa'] = $this->idusuariobaixa;
              $this->valorbaixa = trim($rs->fields[21]) ; 
              $this->nmgp_dados_select['valorbaixa'] = $this->valorbaixa;
              $this->discriminacao = $rs->fields[22] ; 
              $this->nmgp_dados_select['discriminacao'] = $this->discriminacao;
              $this->competenciasimples = $rs->fields[23] ; 
              if (substr($this->competenciasimples, 10, 1) == "-") 
              { 
                 $this->competenciasimples = substr($this->competenciasimples, 0, 10) . " " . substr($this->competenciasimples, 11);
              } 
              if (substr($this->competenciasimples, 13, 1) == ".") 
              { 
                 $this->competenciasimples = substr($this->competenciasimples, 0, 13) . ":" . substr($this->competenciasimples, 14, 2) . ":" . substr($this->competenciasimples, 17);
              } 
              $this->nmgp_dados_select['competenciasimples'] = $this->competenciasimples;
              $this->nomearquivo = $rs->fields[24] ; 
              $this->nmgp_dados_select['nomearquivo'] = $this->nomearquivo;
              $this->nomereferencia = $rs->fields[25] ; 
              $this->nmgp_dados_select['nomereferencia'] = $this->nomereferencia;
              $this->nomearquivoboleto = $rs->fields[26] ; 
              $this->nmgp_dados_select['nomearquivoboleto'] = $this->nomearquivoboleto;
              $this->nomereferenciaboleto = $rs->fields[27] ; 
              $this->nmgp_dados_select['nomereferenciaboleto'] = $this->nomereferenciaboleto;
              $this->dataliberacaoboleto = $rs->fields[28] ; 
              if (substr($this->dataliberacaoboleto, 10, 1) == "-") 
              { 
                 $this->dataliberacaoboleto = substr($this->dataliberacaoboleto, 0, 10) . " " . substr($this->dataliberacaoboleto, 11);
              } 
              if (substr($this->dataliberacaoboleto, 13, 1) == ".") 
              { 
                 $this->dataliberacaoboleto = substr($this->dataliberacaoboleto, 0, 13) . ":" . substr($this->dataliberacaoboleto, 14, 2) . ":" . substr($this->dataliberacaoboleto, 17);
              } 
              $this->nmgp_dados_select['dataliberacaoboleto'] = $this->dataliberacaoboleto;
              $this->nomearquivoxml = $rs->fields[29] ; 
              $this->nmgp_dados_select['nomearquivoxml'] = $this->nomearquivoxml;
              $this->nomereferenciaxml = $rs->fields[30] ; 
              $this->nmgp_dados_select['nomereferenciaxml'] = $this->nomereferenciaxml;
              $this->boletoliberado = $rs->fields[31] ; 
              $this->nmgp_dados_select['boletoliberado'] = $this->boletoliberado;
              $this->numerolote = $rs->fields[32] ; 
              $this->nmgp_dados_select['numerolote'] = $this->numerolote;
              $this->protocolo = $rs->fields[33] ; 
              $this->nmgp_dados_select['protocolo'] = $this->protocolo;
              $this->datarecebimentonota = $rs->fields[34] ; 
              if (substr($this->datarecebimentonota, 10, 1) == "-") 
              { 
                 $this->datarecebimentonota = substr($this->datarecebimentonota, 0, 10) . " " . substr($this->datarecebimentonota, 11);
              } 
              if (substr($this->datarecebimentonota, 13, 1) == ".") 
              { 
                 $this->datarecebimentonota = substr($this->datarecebimentonota, 0, 13) . ":" . substr($this->datarecebimentonota, 14, 2) . ":" . substr($this->datarecebimentonota, 17);
              } 
              $this->nmgp_dados_select['datarecebimentonota'] = $this->datarecebimentonota;
              $this->numeronotafiscalcompleto = $rs->fields[35] ; 
              $this->nmgp_dados_select['numeronotafiscalcompleto'] = $this->numeronotafiscalcompleto;
              $this->enderecoipauditoria = $rs->fields[36] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[37] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->idnotafiscal = (string)$this->idnotafiscal; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idcliente = (string)$this->idcliente; 
              $this->idsituacaodocumento = (string)$this->idsituacaodocumento; 
              $this->idempresa = (string)$this->idempresa; 
              $this->idlancamentoreceita = (string)$this->idlancamentoreceita; 
              $this->idplanoconta = (string)$this->idplanoconta; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->idusuariocancelamento = (string)$this->idusuariocancelamento; 
              $this->idusuarioemissao = (string)$this->idusuarioemissao; 
              $this->valornotafiscal = (strpos(strtolower($this->valornotafiscal), "e")) ? (float)$this->valornotafiscal : $this->valornotafiscal; 
              $this->valornotafiscal = (string)$this->valornotafiscal; 
              $this->valoriss = (strpos(strtolower($this->valoriss), "e")) ? (float)$this->valoriss : $this->valoriss; 
              $this->valoriss = (string)$this->valoriss; 
              $this->valorliquido = (strpos(strtolower($this->valorliquido), "e")) ? (float)$this->valorliquido : $this->valorliquido; 
              $this->valorliquido = (string)$this->valorliquido; 
              $this->idusuariobaixa = (string)$this->idusuariobaixa; 
              $this->valorbaixa = (strpos(strtolower($this->valorbaixa), "e")) ? (float)$this->valorbaixa : $this->valorbaixa; 
              $this->valorbaixa = (string)$this->valorbaixa; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['parms'] = "idnotafiscal?#?$this->idnotafiscal?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sub_dir'][0]  = "/" . $_SESSION['varIdTenacidade'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sub_dir'][1]  = "/" . $_SESSION['varIdTenacidade'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sub_dir'][2]  = "/" . $_SESSION['varIdTenacidade'];
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select'] = $this->nmgp_dados_select;
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
              $this->idnotafiscal = "NULL";  
              $this->nmgp_dados_form["idnotafiscal"] = $this->idnotafiscal;
              $this->idtenacidade = "" . $_SESSION['varIdTenacidade'] . "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idcliente = "" . $_SESSION['varNotaFiscal_IdCliente'] . "";  
              $this->nmgp_dados_form["idcliente"] = $this->idcliente;
              $this->idsituacaodocumento = "1";  
              $this->nmgp_dados_form["idsituacaodocumento"] = $this->idsituacaodocumento;
              $this->idempresa = "";  
              $this->nmgp_dados_form["idempresa"] = $this->idempresa;
              $this->idlancamentoreceita = "";  
              $this->nmgp_dados_form["idlancamentoreceita"] = $this->idlancamentoreceita;
              $this->idplanoconta = "";  
              $this->nmgp_dados_form["idplanoconta"] = $this->idplanoconta;
              $this->idusuarioauditoria = "" . $_SESSION['varIdUsuario'] . "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->idusuariocancelamento = "";  
              $this->nmgp_dados_form["idusuariocancelamento"] = $this->idusuariocancelamento;
              $this->datacompetencia = "";  
              $this->datacompetencia_hora = "" ;  
              $this->nmgp_dados_form["datacompetencia"] = $this->datacompetencia;
              $this->numeronotafiscal = "";  
              $this->nmgp_dados_form["numeronotafiscal"] = $this->numeronotafiscal;
              $this->codigoverificacao = "";  
              $this->nmgp_dados_form["codigoverificacao"] = $this->codigoverificacao;
              $this->dataemissao =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->dataemissao_hora =  date('H') . ":" . date('i') . ":" . date('s');
              $this->nmgp_dados_form["dataemissao"] = $this->dataemissao;
              $this->idusuarioemissao = "" . $_SESSION['varIdUsuario'] . "";  
              $this->nmgp_dados_form["idusuarioemissao"] = $this->idusuarioemissao;
              $this->datavencimento = "";  
              $this->datavencimento_hora = "" ;  
              $this->nmgp_dados_form["datavencimento"] = $this->datavencimento;
              $this->valornotafiscal = "";  
              $this->nmgp_dados_form["valornotafiscal"] = $this->valornotafiscal;
              $this->valoriss = "";  
              $this->nmgp_dados_form["valoriss"] = $this->valoriss;
              $this->valorliquido = "";  
              $this->nmgp_dados_form["valorliquido"] = $this->valorliquido;
              $this->databaixa = "";  
              $this->databaixa_hora = "" ;  
              $this->nmgp_dados_form["databaixa"] = $this->databaixa;
              $this->datarecebimento = "";  
              $this->datarecebimento_hora = "" ;  
              $this->nmgp_dados_form["datarecebimento"] = $this->datarecebimento;
              $this->idusuariobaixa = "";  
              $this->nmgp_dados_form["idusuariobaixa"] = $this->idusuariobaixa;
              $this->valorbaixa = "";  
              $this->nmgp_dados_form["valorbaixa"] = $this->valorbaixa;
              $this->discriminacao = "";  
              $this->nmgp_dados_form["discriminacao"] = $this->discriminacao;
              $this->competenciasimples =  date('Y') . "-" . date('m')  . "-" . date('d');
              $this->nmgp_dados_form["competenciasimples"] = $this->competenciasimples;
              $this->nomearquivo = "";  
              $this->nmgp_dados_form["nomearquivo"] = $this->nomearquivo;
              $this->nomereferencia = "";  
              $this->nomereferencia_ul_name = "" ;  
              $this->nomereferencia_ul_type = "" ;  
              $this->nmgp_dados_form["nomereferencia"] = $this->nomereferencia;
              $this->nomearquivoboleto = "";  
              $this->nmgp_dados_form["nomearquivoboleto"] = $this->nomearquivoboleto;
              $this->nomereferenciaboleto = "";  
              $this->nomereferenciaboleto_ul_name = "" ;  
              $this->nomereferenciaboleto_ul_type = "" ;  
              $this->nmgp_dados_form["nomereferenciaboleto"] = $this->nomereferenciaboleto;
              $this->dataliberacaoboleto = "";  
              $this->dataliberacaoboleto_hora = "" ;  
              $this->nmgp_dados_form["dataliberacaoboleto"] = $this->dataliberacaoboleto;
              $this->nomearquivoxml = "";  
              $this->nmgp_dados_form["nomearquivoxml"] = $this->nomearquivoxml;
              $this->nomereferenciaxml = "";  
              $this->nomereferenciaxml_ul_name = "" ;  
              $this->nomereferenciaxml_ul_type = "" ;  
              $this->nmgp_dados_form["nomereferenciaxml"] = $this->nomereferenciaxml;
              $this->boletoliberado = "";  
              $this->nmgp_dados_form["boletoliberado"] = $this->boletoliberado;
              $this->numerolote = "";  
              $this->nmgp_dados_form["numerolote"] = $this->numerolote;
              $this->protocolo = "";  
              $this->nmgp_dados_form["protocolo"] = $this->protocolo;
              $this->datarecebimentonota = "";  
              $this->datarecebimentonota_hora = "" ;  
              $this->nmgp_dados_form["datarecebimentonota"] = $this->datarecebimentonota;
              $this->numeronotafiscalcompleto = "";  
              $this->nmgp_dados_form["numeronotafiscalcompleto"] = $this->numeronotafiscalcompleto;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
              if ($this->nmgp_clone != "S")
              {
              }
              if ($this->nmgp_clone == "S" && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select']))
              {
                  $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dados_select'];
                  $this->idtenacidade = $this->nmgp_dados_select['idtenacidade'];  
                  $this->idcliente = $this->nmgp_dados_select['idcliente'];  
                  $this->idsituacaodocumento = $this->nmgp_dados_select['idsituacaodocumento'];  
                  $this->idempresa = $this->nmgp_dados_select['idempresa'];  
                  $this->idlancamentoreceita = $this->nmgp_dados_select['idlancamentoreceita'];  
                  $this->idplanoconta = $this->nmgp_dados_select['idplanoconta'];  
                  $this->idusuarioauditoria = $this->nmgp_dados_select['idusuarioauditoria'];  
                  $this->idusuariocancelamento = $this->nmgp_dados_select['idusuariocancelamento'];  
                  $this->datacompetencia = $this->nmgp_dados_select['datacompetencia'];  
                  $this->numeronotafiscal = $this->nmgp_dados_select['numeronotafiscal'];  
                  $this->codigoverificacao = $this->nmgp_dados_select['codigoverificacao'];  
                  $this->dataemissao = $this->nmgp_dados_select['dataemissao'];  
                  $this->idusuarioemissao = $this->nmgp_dados_select['idusuarioemissao'];  
                  $this->datavencimento = $this->nmgp_dados_select['datavencimento'];  
                  $this->valornotafiscal = $this->nmgp_dados_select['valornotafiscal'];  
                  $this->valoriss = $this->nmgp_dados_select['valoriss'];  
                  $this->valorliquido = $this->nmgp_dados_select['valorliquido'];  
                  $this->databaixa = $this->nmgp_dados_select['databaixa'];  
                  $this->datarecebimento = $this->nmgp_dados_select['datarecebimento'];  
                  $this->idusuariobaixa = $this->nmgp_dados_select['idusuariobaixa'];  
                  $this->valorbaixa = $this->nmgp_dados_select['valorbaixa'];  
                  $this->discriminacao = $this->nmgp_dados_select['discriminacao'];  
                  $this->competenciasimples = $this->nmgp_dados_select['competenciasimples'];  
                  $this->nomearquivo = $this->nmgp_dados_select['nomearquivo'];  
                  $this->nomereferencia = $this->nmgp_dados_select['nomereferencia'];  
                  $this->nomearquivoboleto = $this->nmgp_dados_select['nomearquivoboleto'];  
                  $this->nomereferenciaboleto = $this->nmgp_dados_select['nomereferenciaboleto'];  
                  $this->dataliberacaoboleto = $this->nmgp_dados_select['dataliberacaoboleto'];  
                  $this->nomearquivoxml = $this->nmgp_dados_select['nomearquivoxml'];  
                  $this->nomereferenciaxml = $this->nmgp_dados_select['nomereferenciaxml'];  
                  $this->boletoliberado = $this->nmgp_dados_select['boletoliberado'];  
                  $this->numerolote = $this->nmgp_dados_select['numerolote'];  
                  $this->protocolo = $this->nmgp_dados_select['protocolo'];  
                  $this->datarecebimentonota = $this->nmgp_dados_select['datarecebimentonota'];  
                  $this->numeronotafiscalcompleto = $this->nmgp_dados_select['numeronotafiscalcompleto'];  
                  $this->enderecoipauditoria = $this->nmgp_dados_select['enderecoipauditoria'];  
                  $this->nomeaplicacaoauditoria = $this->nmgp_dados_select['nomeaplicacaoauditoria'];  
              }
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
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

/*----- Scriptcase Locale: Ajax Event DataBaixa_onChange ------*/

function DataBaixa_onChange()
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
  
$original_databaixa = $this->databaixa;
$original_idsituacaodocumento = $this->idsituacaodocumento;
$original_idusuariobaixa = $this->idusuariobaixa;

if(!(empty($this->databaixa ) || $this->databaixa  == "null")) {
	$this->idsituacaodocumento  = 4;
	$this->idusuariobaixa  = $this->sc_temp_varIdUsuario;	
}


if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
$modificado_databaixa = $this->databaixa;
$modificado_idsituacaodocumento = $this->idsituacaodocumento;
$modificado_idusuariobaixa = $this->idusuariobaixa;
$this->nm_formatar_campos('databaixa', 'idsituacaodocumento', 'idusuariobaixa');
if ($original_databaixa !== $modificado_databaixa || isset($this->nmgp_cmp_readonly['databaixa']) || (isset($bFlagRead_databaixa) && $bFlagRead_databaixa))
{
    $this->ajax_return_values_databaixa(true);
}
if ($original_idsituacaodocumento !== $modificado_idsituacaodocumento || isset($this->nmgp_cmp_readonly['idsituacaodocumento']) || (isset($bFlagRead_idsituacaodocumento) && $bFlagRead_idsituacaodocumento))
{
    $this->ajax_return_values_idsituacaodocumento(true);
}
if ($original_idusuariobaixa !== $modificado_idusuariobaixa || isset($this->nmgp_cmp_readonly['idusuariobaixa']) || (isset($bFlagRead_idusuariobaixa) && $bFlagRead_idusuariobaixa))
{
    $this->ajax_return_values_idusuariobaixa(true);
}
$this->NM_ajax_info['event_field'] = 'DataBaixa';
NotaFiscal_Frm_pack_ajax_response();
exit;
}

/*----- END - Scriptcase Locale: Ajax Event DataBaixa_onChange ------*/


/*----- Scriptcase Locale: Ajax Event IdSituacaoDocumento_onChange ------*/

function IdSituacaoDocumento_onChange()
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
  
$original_idsituacaodocumento = $this->idsituacaodocumento;
$original_databaixa = $this->databaixa;
$original_idusuariobaixa = $this->idusuariobaixa;

if($this->idsituacaodocumento  == 4) { 
	if((empty($this->databaixa ) || $this->databaixa  == "null")) {
		$this->databaixa  = date('Y-m-d');
	}
	$this->idusuariobaixa  = $this->sc_temp_varIdUsuario;	
}


if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
$modificado_idsituacaodocumento = $this->idsituacaodocumento;
$modificado_databaixa = $this->databaixa;
$modificado_idusuariobaixa = $this->idusuariobaixa;
$this->nm_formatar_campos('idsituacaodocumento', 'databaixa', 'idusuariobaixa');
if ($original_idsituacaodocumento !== $modificado_idsituacaodocumento || isset($this->nmgp_cmp_readonly['idsituacaodocumento']) || (isset($bFlagRead_idsituacaodocumento) && $bFlagRead_idsituacaodocumento))
{
    $this->ajax_return_values_idsituacaodocumento(true);
}
if ($original_databaixa !== $modificado_databaixa || isset($this->nmgp_cmp_readonly['databaixa']) || (isset($bFlagRead_databaixa) && $bFlagRead_databaixa))
{
    $this->ajax_return_values_databaixa(true);
}
if ($original_idusuariobaixa !== $modificado_idusuariobaixa || isset($this->nmgp_cmp_readonly['idusuariobaixa']) || (isset($bFlagRead_idusuariobaixa) && $bFlagRead_idusuariobaixa))
{
    $this->ajax_return_values_idusuariobaixa(true);
}
$this->NM_ajax_info['event_field'] = 'IdSituacaoDocumento';
NotaFiscal_Frm_pack_ajax_response();
exit;
}

/*----- END - Scriptcase Locale: Ajax Event IdSituacaoDocumento_onChange ------*/


/*----- Scriptcase Locale: Ajax Event ValorISS_onChange ------*/

function ValorISS_onChange()
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
$original_valoriss = $this->valoriss;
$original_valorliquido = $this->valorliquido;
$original_valornotafiscal = $this->valornotafiscal;

if ($this->valoriss  > 0) {

	$this->valorliquido  = $this->valornotafiscal  - ($this->valornotafiscal *($this->valoriss /100));
		
} else {
	
	$this->valorliquido  = $this->valornotafiscal ;
	
}

$modificado_valoriss = $this->valoriss;
$modificado_valorliquido = $this->valorliquido;
$modificado_valornotafiscal = $this->valornotafiscal;
$this->nm_formatar_campos('valoriss', 'valorliquido', 'valornotafiscal');
if ($original_valoriss !== $modificado_valoriss || isset($this->nmgp_cmp_readonly['valoriss']) || (isset($bFlagRead_valoriss) && $bFlagRead_valoriss))
{
    $this->ajax_return_values_valoriss(true);
}
if ($original_valorliquido !== $modificado_valorliquido || isset($this->nmgp_cmp_readonly['valorliquido']) || (isset($bFlagRead_valorliquido) && $bFlagRead_valorliquido))
{
    $this->ajax_return_values_valorliquido(true);
}
if ($original_valornotafiscal !== $modificado_valornotafiscal || isset($this->nmgp_cmp_readonly['valornotafiscal']) || (isset($bFlagRead_valornotafiscal) && $bFlagRead_valornotafiscal))
{
    $this->ajax_return_values_valornotafiscal(true);
}
$this->NM_ajax_info['event_field'] = 'ValorISS';
NotaFiscal_Frm_pack_ajax_response();
exit;


$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event ValorISS_onChange ------*/


/*----- Scriptcase Locale: PHP Method: gerarNotaFiscal ------*/

function gerarNotaFiscal($tipoGeracao, $varXml)
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = (isset($_SESSION['varDiretorioArquivo'])) ? $_SESSION['varDiretorioArquivo'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
header("Content-type: text/html; charset=utf-8");
sc_include_library("prj", "nfsebh", "vendor/index.php", true, true);

$check_sql = "SELECT cli.RazaoSocial, cli.Cnpj, cli.TipoLogradouro, cli.Logradouro, cli.Numero, cli.Complemento, cli.Bairro, cli.Cidade, cli.Estado, cli.Cep, m.Codigo, cli.InscricaoMunicipal, nf.DataRecebimentoNota, nf.CodigoVerificacao, nf.NumeroNotaFiscal, nf.discriminacao FROM cliente cli INNER JOIN municipio m ON (m.IdMunicipio = cli.IdMunicipio) INNER JOIN notafiscal nf ON (nf.IdNotaFiscal = $this->idnotafiscal ) WHERE cli.IdCliente = $this->idcliente ";


 
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

	
$varRazaoSocial = $this->rs[0][0];
$varCnpj = $this->rs[0][1];
$varTipoLogradouro = $this->rs[0][2];
$varLogradouro = $this->rs[0][3];
$varNumero = $this->rs[0][4];
$varComplemento = $this->rs[0][5];
$varBairro = $this->rs[0][6];
$varCidade = $this->rs[0][7];
$varEstado = $this->rs[0][8];
$varCep = $this->rs[0][9];
$varCodigo = $this->rs[0][10];
$varInscricaoMunicipalTomador = $this->rs[0][11];	
$varDataRecebimentoNota = $this->rs[0][12];
$varCodigoVerificacao = $this->rs[0][13];
$varNumeroNotaFiscal = $this->rs[0][14];
$varDiscriminacao = $this->rs[0][15];
		

try {
	
    $settings = new NFse\Models\Settings();
    $settings->environment = 'producao';

    $settings->issuer->name = 'LIGA SISTEMAS DE INFORMATICA LTDA';
    $settings->issuer->cnpj = '00325244000144';
	$settings->issuer->imun = '0113966001X';	                   
    $settings->issuer->codMun = 3106200;	

	
    $settings->certificate->folder = '/opt/LIGASistemas/v9_81/wwwroot/liga_infotime/_lib/libraries/grp/nfsebh/vendor/wsilva94/nfse-bh-sdk/storage/certificates/0032524400144/'; 
    $settings->certificate->certFile = 'certificate.pfx';
    $settings->certificate->mixedKey = 'mixedKey.pem';
    $settings->certificate->privateKey = 'privateKey.pem';
    $settings->certificate->publicKey = 'publicKey.pem';
    $settings->certificate->password = 'Ligalann1';
    $settings->certificate->noValidate = true;

    if ($settings->environment == 'homologacao') {
        NFse\Helpers\Utils::xdebugMode();
    }
	
    $system = new NFse\Config\Boot($settings);
    $system->init();
	
try {
   
    $logoBase64 = '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';

    $nfse = new NFse\Models\NFse();
	
    $nfse->year = substr($varNumeroNotaFiscal, 0, 4);
    $nfse->number = ltrim(substr($varNumeroNotaFiscal,4,strlen($varNumeroNotaFiscal)),'0');
	
    $nfse->dateEmission = $this->nm_conv_data_db($varDataRecebimentoNota,"db_format","dd/mm/aaaa");
    $nfse->timeEmission = substr($varDataRecebimentoNota, 11, 8);
    $nfse->competence = $this->nm_conv_data_db($varDataRecebimentoNota,"db_format","dd/mm/aaaa");
    $nfse->verificationCode = $varCodigoVerificacao;
    $nfse->nfseNumberReplaced = false;

    $nfse->provider->name = 'LIGA SISTEMAS DE INFORMATICA LTDA';
    $nfse->provider->cnpj = '00325244000144';
    $nfse->provider->inscription = '0113966001X';
    $nfse->provider->phone = 3132140100;
    $nfse->provider->email = 'liga@liga.inf.br';
    $nfse->provider->address->address = 'RUA PAULO FREIRE DE ARAUJO';
    $nfse->provider->address->number = 300;
    $nfse->provider->address->neighborhood = 'ESTORIL';
    $nfse->provider->address->complement = 'CONJUNTO 10';
    $nfse->provider->address->zipCode = 30494280;
    $nfse->provider->address->city = 'BELO HORIZONTE';
    $nfse->provider->address->state = 'MG';

	
	if ($this->valoriss  > 0) {
			
			$valorAliquota = $this->valoriss /100;	
		    $valorLiquido = $this->valorliquido ;
		    $valorDescontoISS = $this->valornotafiscal *$valorAliquota;
		    			
	} else {
			$valorAliquota = 0;
		    $valorLiquido = $this->valorliquido ;
		    $valorDescontoISS = 0;
			$varInscricaoMunicipalTomador = false;
		
	}
	
	$varRazaoSocial = $this->tirarAcentos($varRazaoSocial);		
	$varRazaoSocial = iconv('UTF-8', 'UTF-8//IGNORE', $varRazaoSocial);
	
	$nfse->taker->name = $varRazaoSocial;
    $nfse->taker->document = $varCnpj;
    $nfse->taker->municipalRegistration = $varInscricaoMunicipalTomador;
    
	
	$varEndereco = $varTipoLogradouro." ".$this->tirarAcentos($varLogradouro);
	$varEndereco = iconv('UTF-8', 'UTF-8//IGNORE', $varEndereco);
		
    $varComplemento = $this->tirarAcentos($varComplemento);
	$varComplemento = iconv('UTF-8', 'UTF-8//IGNORE', $varComplemento);
		
	$varBairro = $this->tirarAcentos($varBairro);
	$varBairro = iconv('UTF-8', 'UTF-8//IGNORE', $varBairro);	
	
	$varCidade = $this->tirarAcentos($varCidade);
	$varCidade = iconv('UTF-8', 'UTF-8//IGNORE', $varCidade);	
	
    $nfse->taker->address = $varEndereco;
    $nfse->taker->number = $varNumero;
    $nfse->taker->neighborhood = $varBairro;
    $nfse->taker->zipCode = $varCep;
    $nfse->taker->city = $varCidade;
    $nfse->taker->state = $varEstado;

	
	$descricaoServico = $this->tirarAcentos($varDiscriminacao);		
	$descricaoServico = iconv('UTF-8', 'UTF-8//IGNORE', $descricaoServico);
	
    $nfse->service->description = $descricaoServico;
    $nfse->service->municipalityTaxationCode = '010500188';
    $nfse->service->taxCodeDescription = 'Licenciamento ou cessao de direito de uso de programas de computacao.';
    $nfse->service->itemList = 1.05;
    $nfse->service->itemDescription = 'Licenciamento ou cessao de direito de uso de programas de computacao.';
    $nfse->service->municipalCode = 3106200;
    $nfse->service->municipalName = 'Belo Horizonte';
    $nfse->service->nature = 1;
    $nfse->service->specialTaxRegime = 6;

	
	$nfse->service->serviceValue = $this->valornotafiscal ;
    $nfse->service->discountCondition = 0;
    $nfse->service->otherWithholdings = 0;
    $nfse->service->issValueWithheld = $valorDescontoISS;
    $nfse->service->netValue = $valorLiquido;
    $nfse->service->valueDeductions = 0;
    $nfse->service->unconditionedDiscount = 0;
    $nfse->service->calculationBase = $this->valornotafiscal ;
    $nfse->service->aliquot = $valorAliquota;
    $nfse->service->issValue = $valorDescontoISS;
    $nfse->service->valuePis = 0;
    $nfse->service->valueConfis = 0;
    $nfse->service->valueIR = 0;
    $nfse->service->valueCSLL = 0;
    $nfse->service->valueINSS = 0;

    $nfse->service->simpleNational = true;
	

    $print = new NFse\Service\PrintPDFNFse($nfse, $logoBase64);
	
	
	$nomePdf = $varNumeroNotaFiscal.'.pdf';
	$nomeXml = $varNumeroNotaFiscal.'.xml';
    $print->getPDF($tipoGeracao, $nomePdf);
	
	if ($tipoGeracao == 'P') {
		
		$this->nomereferencia  = $nomePdf;		
		$this->nomearquivo  = $this->nomereferencia ;
		
		$extensaoArquivo = pathinfo($this->nomereferencia , PATHINFO_EXTENSION);
		
		$this->nomereferencia  = md5(date('YdmHisu') . $this->nomereferencia  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;
		
		$varNomeReferencia = $this->nomereferencia ;
		
		$nomeOriginal = $this->nomearquivo ;
		
		$nomeReferencia = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferencia ;
		
		rename($nomeOriginal, $nomeReferencia);
		
		$this->nomereferenciaxml  = $nomeXml;		
		$this->nomearquivoxml  = $this->nomereferenciaxml ;
		
		file_put_contents($nomeXml, $varXml);
		
		$extensaoArquivo = pathinfo($this->nomereferenciaxml , PATHINFO_EXTENSION);
		
		$this->nomereferenciaxml  = md5(date('YdmHisu') . $this->nomereferenciaxml  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;
		
		$varNomeReferenciaXml = $this->nomereferenciaxml ;
		
		$nomeOriginalXml = $this->nomearquivoxml ;
		
		$nomeReferenciaXml = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferenciaxml ;
		
		rename($nomeOriginalXml, $nomeReferenciaXml);
		
		$update_table  = 'notafiscal';     
		$update_where  = "IdNotaFiscal = '$this->idnotafiscal'"; 
		$update_fields = array(   
						"NomeReferencia = '$varNomeReferencia'",
						"NomeArquivo = '$nomeOriginal'",	
						"NomeReferenciaXml = '$varNomeReferenciaXml'",
						"NomeArquivoXml = '$nomeOriginalXml'",	
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
                NotaFiscal_Frm_pack_ajax_response();
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
			
} catch (Exception $e) {
    var_dump($e);
    throw $e;
}

} catch (Exception $e) {
    throw $e;
}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: gerarNotaFiscal ------*/


/*----- Scriptcase Locale: PHP Method: gerarQRCode ------*/

function gerarQRCode($parValorQrcode)
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
sc_include_library("prj", "QRCode", "autoload.php", true, true);

$locQrCode = new \Endroid\QrCode\QrCode($parValorQrcode);
$locQrCode->setSize(160);
$locWriter = new \Endroid\QrCode\Writer\PngWriter();

$locRetorno = $locWriter->write($locQrCode);
$locImagem = $locRetorno->getString();

$locBase64Imagem = 'data:image/png;base64,' . base64_encode($locImagem);

return $locBase64Imagem;


$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: gerarQRCode ------*/


/*----- Scriptcase Locale: PHP Method: tirarAcentos ------*/

function tirarAcentos($string)
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);

$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: tirarAcentos ------*/


/*----- Scriptcase Locale: Button Cancelar_onClick ------*/

function scajaxbutton_Cancelar_onClick()
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$original_idempresa = $this->idempresa;
$original_idnotafiscal = $this->idnotafiscal;
$original_numeronotafiscalcompleto = $this->numeronotafiscalcompleto;

sc_include_library("prj", "nfsebh", "vendor/index.php", true, true);

$check_sql = "SELECT IdEmpresaNotaFiscal, Ambiente, EmitenteNome, EmitenteCnpj, EmitenteInscricaoMunicipal, EmitenteCodigoMunicipio, DiretorioCertificado, NomeCertificado, NomeMixedKey, NomePrivateKey, NomePublicKey, SenhaCertificado FROM empresanotafiscal WHERE IdEmpresa = $this->idempresa  AND IdTenacidade = '$this->sc_temp_varIdTenacidade' AND Ativo = 'S'";
 
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

	
if (isset($this->rs[0][0]) && $this->rs[0][0] > 0) {
	
	$anoAtual = date('Y');
	$varLocAmbiente = $this->rs[0][1];
	$varLocEmitenteNome = $this->rs[0][2];
	$varLocEmitenteCnpj = $this->rs[0][3];
	$varLocEmitenteInscricaoMunicipal = $this->rs[0][4];
	$varLocEmitenteCodigoMunicipio = $this->rs[0][5];
	$varDiretorioCertificado = $this->rs[0][6];	
	$varNomeCertificado = $this->rs[0][7];	
	$varNomeMixedKey = $this->rs[0][8];	
	$varNomePrivateKey = $this->rs[0][9];	
	$varNomePublicKey = $this->rs[0][10];
	$varSenhaCertificado = $this->rs[0][11];
	
} else {
	
	sc_message_error("Empresa não configurada para emissão de nota fiscal.");
		
}

try {
	
    $settings = new NFse\Models\Settings();
    $settings->environment = $varLocAmbiente;

    $settings->issuer->name = $varLocEmitenteNome;
    $settings->issuer->cnpj = $varLocEmitenteCnpj;
	$settings->issuer->imun = $varLocEmitenteInscricaoMunicipal;
    $settings->issuer->codMun = $varLocEmitenteCodigoMunicipio;

	
    $settings->certificate->folder = $varDiretorioCertificado;
	                             	
    $settings->certificate->certFile = $varNomeCertificado;
    $settings->certificate->mixedKey = $varNomeMixedKey;
    $settings->certificate->privateKey = $varNomePrivateKey;
    $settings->certificate->publicKey = $varNomePublicKey;
    $settings->certificate->password = $varSenhaCertificado;
    $settings->certificate->noValidate = true;

    if ($settings->environment == 'homologacao') {
        NFse\Helpers\Utils::xdebugMode();
    }
	
    $system = new NFse\Config\Boot($settings);
    $system->init();
	
	$parameters  = (object)[
        'id' => $this->idnotafiscal ,
        'numerNFse' => $this->numeronotafiscalcompleto ,
        'cancellationCode' => 2,
    ];

    $result = new NFse\Service\NFseCancellation($settings, $parameters);
    $result = $result->sendConsultation();
	
	$retorno = json_decode(json_encode($result), true);
	
	$tamanho = count($retorno);
			
    if ($tamanho > 2) {
		
		$texto = 'Nota fiscal cancelada com sucesso: '.$this->numeronotafiscalcompleto ;
		
		$varIdUsuarioCancelamento = $this->sc_temp_varIdUsuario;
	
		$update_table  = 'notafiscal';     
		$update_where  = "IdNotaFiscal = '$this->idnotafiscal'"; 
		$update_fields = array(   
							"NumeroNotaFiscal = null",
							"NumeroNotaFiscalCompleto = null",
							"CodigoVerificacao = null",
							"DataRecebimentoNota = null",
							"NumeroLote = null",
							"Protocolo = null",	
							"NomeReferencia = null",	
							"NomeArquivo = null",	
							"NomeReferenciaXml = null",	
							"NomeArquivoXml = null",						
							"IdUsuarioCancelamento = '$varIdUsuarioCancelamento'",
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      				
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
	
		
		$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };	
		
	} else {
		
		$texto = 'Erro ao cancelar nota fiscal: '.$this->numeronotafiscalcompleto ;
		$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); }}
	
} catch (Exception $e) {
	throw $e;
}



if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
$modificado_idempresa = $this->idempresa;
$modificado_idnotafiscal = $this->idnotafiscal;
$modificado_numeronotafiscalcompleto = $this->numeronotafiscalcompleto;
$this->nm_formatar_campos('idempresa', 'idnotafiscal', 'numeronotafiscalcompleto');
if ($original_idempresa !== $modificado_idempresa || isset($this->nmgp_cmp_readonly['idempresa']) || (isset($bFlagRead_idempresa) && $bFlagRead_idempresa))
{
    $this->ajax_return_values_idempresa(true);
}
if ($original_idnotafiscal !== $modificado_idnotafiscal || isset($this->nmgp_cmp_readonly['idnotafiscal']) || (isset($bFlagRead_idnotafiscal) && $bFlagRead_idnotafiscal))
{
    $this->ajax_return_values_idnotafiscal(true);
}
if ($original_numeronotafiscalcompleto !== $modificado_numeronotafiscalcompleto || isset($this->nmgp_cmp_readonly['numeronotafiscalcompleto']) || (isset($bFlagRead_numeronotafiscalcompleto) && $bFlagRead_numeronotafiscalcompleto))
{
    $this->ajax_return_values_numeronotafiscalcompleto(true);
}
$this->NM_ajax_info['event_field'] = 'scajaxbutton';
NotaFiscal_Frm_pack_ajax_response();
exit;
}

/*----- END - Scriptcase Locale: Button Cancelar_onClick ------*/


/*----- Scriptcase Locale: Button GerarNota_onClick ------*/

function gerarIdDPS($codMunicipio, $tipoInscricao, $inscricaoFederal, $serieDPS, $numeroDPS) {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
			
			$codMunicipio     = str_pad($codMunicipio, 7, '0', STR_PAD_LEFT);
			$tipoInscricao    = substr($tipoInscricao, 0, 1); 
			$inscricaoFederal = str_pad(preg_replace('/\D/', '', $inscricaoFederal), 14, '0', STR_PAD_LEFT);
			$serieDPS         = str_pad($serieDPS, 5, '0', STR_PAD_LEFT);
			$numeroDPS        = str_pad($numeroDPS, 15, '0', STR_PAD_LEFT);

			$id = "DPS{$codMunicipio}{$tipoInscricao}{$inscricaoFederal}{$serieDPS}{$numeroDPS}";

			return $id;
		
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Button GerarNota_onClick ------*/


/*----- Scriptcase Locale: Button GerarNota_onClick ------*/

function v($v) {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
								return trim((string)$v) !== '' ? (string)$v : '-';
							
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Button GerarNota_onClick ------*/


/*----- Scriptcase Locale: Button GerarNota_onClick ------*/

function moeda($v) {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
								return trim((string)$v) !== '' ? 'R$ ' . number_format((float)$v, 2, ',', '.') : 'R$ 0,00';
							
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Button GerarNota_onClick ------*/


/*----- Scriptcase Locale: Button GerarNota_onClick ------*/

function scajaxbutton_GerarNota_onClick()
{
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varDiretorioArquivo)) {$this->sc_temp_varDiretorioArquivo = (isset($_SESSION['varDiretorioArquivo'])) ? $_SESSION['varDiretorioArquivo'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$original_idempresa = $this->idempresa;
$original_datacompetencia = $this->datacompetencia;
$original_idcliente = $this->idcliente;
$original_discriminacao = $this->discriminacao;
$original_valornotafiscal = $this->valornotafiscal;
$original_valoriss = $this->valoriss;
$original_idnotafiscal = $this->idnotafiscal;
$original_nomereferenciaxml = $this->nomereferenciaxml;
$original_nomearquivoxml = $this->nomearquivoxml;
$original_nomereferencia = $this->nomereferencia;
$original_nomearquivo = $this->nomearquivo;
$original_valorliquido = $this->valorliquido;

$check_sql = "SELECT IdEmpresaNotaFiscal, Ambiente, EmitenteNome, EmitenteCnpj, EmitenteInscricaoMunicipal, EmitenteCodigoMunicipio, DiretorioCertificado, NomeCertificado, NomeMixedKey, NomePrivateKey, NomePublicKey, SenhaCertificado, TipoNotaFiscal, AnoNotaFiscal, SequencialNotaFiscal FROM empresanotafiscal WHERE IdEmpresa = $this->idempresa  AND IdTenacidade = '$this->sc_temp_varIdTenacidade' AND Ativo = 'S'";
 
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

	
if (isset($this->rs[0][0]) && $this->rs[0][0] > 0) {
	
	$anoAtual = date('Y');
	$varLocAmbiente = $this->rs[0][1];
	$varLocEmitenteNome = $this->rs[0][2];
	$varLocEmitenteCnpj = $this->rs[0][3];
	$varLocEmitenteInscricaoMunicipal = $this->rs[0][4];
	$varLocEmitenteCodigoMunicipio = $this->rs[0][5];
	$varDiretorioCertificado = $this->rs[0][6];	
	$varNomeCertificado = $this->rs[0][7];	
	$varNomeMixedKey = $this->rs[0][8];	
	$varNomePrivateKey = $this->rs[0][9];	
	$varNomePublicKey = $this->rs[0][10];
	$varSenhaCertificado = $this->rs[0][11];
	$varTipoNotaFiscal = $this->rs[0][12];
	$varAnoNotaFiscal = $this->rs[0][13];
	$varSequenciaNotaFiscal = $this->rs[0][14];
	
} else {
	
	sc_message_error("Empresa não configurada para emissão de nota fiscal.");
		
}

if (empty($this->datacompetencia ) || $this->datacompetencia  == '') {
	
	sc_message_error("Data da competência para a nota fiscal não preenchida.");
		
}


if ($varTipoNotaFiscal == 'P') {	

	try {
		
		sc_include_library("prj", "nfsebh", "vendor/index.php", true, true);

		$settings = new NFse\Models\Settings();
		$settings->environment = $varLocAmbiente; 

		$settings->issuer->name = $varLocEmitenteNome;
		$settings->issuer->cnpj = $varLocEmitenteCnpj;
		$settings->issuer->imun = $varLocEmitenteInscricaoMunicipal;
		$settings->issuer->codMun = $varLocEmitenteCodigoMunicipio;


		$settings->certificate->folder = $varDiretorioCertificado;
		$settings->certificate->certFile = $varNomeCertificado;
		$settings->certificate->mixedKey = $varNomeMixedKey;
		$settings->certificate->privateKey = $varNomePrivateKey;
		$settings->certificate->publicKey = $varNomePublicKey;
		$settings->certificate->password = $varSenhaCertificado;
		$settings->certificate->noValidate = true;

		if ($settings->environment == 'homologacao') {
			NFse\Helpers\Utils::xdebugMode();
		}

		$system = new NFse\Config\Boot($settings);
		$system->init();



		$check_sql = "SELECT c.AnoNotaFiscal, c.SequencialNotaFiscal, cli.RazaoSocial, cli.Cnpj, cli.TipoLogradouro, cli.Logradouro, cli.Numero, cli.Complemento, cli.Bairro, cli.Cidade, cli.Estado, cli.Cep, m.Codigo, cli.InscricaoMunicipal FROM cliente cli INNER JOIN configuracao c ON (c.IdTenacidade = cli.IdTenacidade) INNER JOIN municipio m ON (m.IdMunicipio = cli.IdMunicipio) WHERE cli.IdCliente = $this->idcliente ";
		 
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


		if (isset($this->rs[0][0]) && $this->rs[0][12] > 0) {

			$anoAtual = date('Y');
			$varAno = $this->rs[0][0];
			$varSequencial = $this->rs[0][1];
			$varRazaoSocial = $this->rs[0][2];
			$varCnpj = $this->rs[0][3];
			$varTipoLogradouro = $this->rs[0][4];
			$varLogradouro = $this->rs[0][5];
			$varNumero = $this->rs[0][6];
			$varComplemento = $this->rs[0][7];
			$varBairro = $this->rs[0][8];
			$varCidade = $this->rs[0][9];
			$varEstado = $this->rs[0][10];
			$varCep = $this->rs[0][11];
			$varCodigo = $this->rs[0][12];
			$varInscricaoMunicipalTomador = $this->rs[0][13];

			if ($anoAtual > $varAno) {


				$varAno = $anoAtual;
				$varSequencial = 1;

			} else {

				$varSequencial = $varSequencial +1;

			}

			$update_table  = 'configuracao';     
						$update_where  = "IdTenacidade = '$this->sc_temp_varIdTenacidade'"; 
						$update_fields = array(   
							"AnoNotaFiscal = '$varAno'",
							"SequencialNotaFiscal = '$varSequencial'",
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


			$varLoteNumero = $varAno.str_pad($varSequencial , 11 , '0' , STR_PAD_LEFT);

			$parameter = new NFse\Models\Lot();
			$parameter->rpsLot = $varLoteNumero;
			$parameter->rps->number = $varLoteNumero;
			$parameter->rps->serie = 'AAAAA';
			$parameter->rps->type = 1;
			$parameter->rps->date = date('Y-m-d H:i:s');
			$parameter->rps->nature = 1;
			$parameter->rps->regime = 6;
			$parameter->rps->simple = 1;
			$parameter->rps->culturalPromoter = 2;
			$parameter->rps->status = 1;

			$parameter->rps->service->itemList = 1.05;
			$parameter->rps->service->municipalityTaxationCode = 10500188;

			$descricaoServico = $this->tirarAcentos($this->discriminacao );		
			$descricaoServico = iconv('UTF-8', 'UTF-8//IGNORE', $descricaoServico);

			$parameter->rps->service->municipalCode = $varLocEmitenteCodigoMunicipio;
			$parameter->rps->service->description = $descricaoServico;
			$parameter->rps->service->serviceValue = $this->valornotafiscal ;

			if ($this->valoriss  > 0) {

				$parameter->rps->service->issWithheld = 1;
				$valorAliquota = $this->valoriss /100;	

			} else {

				$parameter->rps->service->issWithheld = 2;
				$valorAliquota = 0;
				$varInscricaoMunicipalTomador = '';

			}

			$parameter->rps->service->aliquot = $valorAliquota;
			$parameter->rps->service->valueDeductions = 0;
			$parameter->rps->service->otherDeductions = 0;
			$parameter->rps->service->valuePis = 0;
			$parameter->rps->service->valueConfis = 0;
			$parameter->rps->service->valueINSS = 0;
			$parameter->rps->service->valueIR = 0;
			$parameter->rps->service->valueCSLL = 0;
			$parameter->rps->service->discountCondition = 0;
			$parameter->rps->service->unconditionedDiscount = 0;


			$varRazaoSocial = $this->tirarAcentos($varRazaoSocial);		
			$varRazaoSocial = iconv('UTF-8', 'UTF-8//IGNORE', $varRazaoSocial);

			$parameter->rps->taker->type = 1;
			$parameter->rps->taker->name = $varRazaoSocial;
			$parameter->rps->taker->document = $varCnpj;
			$parameter->rps->taker->municipalRegistration = $varInscricaoMunicipalTomador;

			$varEndereco = $varTipoLogradouro." ".$this->tirarAcentos($varLogradouro);
			$varEndereco = iconv('UTF-8', 'UTF-8//IGNORE', $varEndereco);

			$varComplemento = $this->tirarAcentos($varComplemento);
			$varComplemento = iconv('UTF-8', 'UTF-8//IGNORE', $varComplemento);

			$varBairro = $this->tirarAcentos($varBairro);
			$varBairro = iconv('UTF-8', 'UTF-8//IGNORE', $varBairro);	


			$parameter->rps->taker->address->address = $varEndereco;
			$parameter->rps->taker->address->number = $varNumero;
			$parameter->rps->taker->address->complement = $varComplemento;
			$parameter->rps->taker->address->neighborhood = $varBairro;
			$parameter->rps->taker->address->zipCode = $varCep;
			$parameter->rps->taker->address->state = $varEstado;
			$parameter->rps->taker->address->municipalityCode = $varCodigo;

			$lote = (new NFse\Service\LoteRps($settings, $parameter->rpsLot));
			$rps = (new NFse\Service\Rps($settings, $parameter->rps->number . $parameter->rps->serie));


			$rps->setRpsIdentification($parameter);

			$rps->setService($parameter);

			$rps->setProvider();

			$rps->setTaker($parameter);

			$signedRps = $rps->getSignedRps();	

			$lote->addRps($signedRps);



			$retorno = json_decode(json_encode($result), true);
			$this->sc_ajax_message($retorno);
			var_dump($retorno);
	

			foreach ($retorno as $row) {

				if (is_array($row)) {

					foreach($row as $campo => $valor) {

						switch ($campo) {
							case 'numeroLote':
								$varNumeroLote = $valor;
								break;
							case 'protocolo':
								$varProtocolo = $valor;
								break;
							case 'dataRecebimento':
								$varDataRecebimento = $valor;
								break;
							case 'scalar':
								$varErroEnvio = $valor;
								break;
						}
					}
				}
			}

			if (!isset($varNumeroLote)) {

				$texto = 'Erro ao gerar a nota fiscal. Motivo: '.$varErroEnvio;

				$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };

			}

			sleep(2);

			$rps = new NFse\Models\Rps();
			$rps->number = $varProtocolo;

			$sync   = new NFse\Service\LotStatusConsultation($settings, $rps->number);
			$result = $sync->sendConsultation();

			$retorno = json_decode(json_encode($result), true);




			$varSituacaoLote = $retorno['descricaoSituaco'];	

			if (strlen($varNumeroLote) > 5 && $varSituacaoLote = 'Processado com sucesso') {


				$protocol = $varProtocolo;

				$sync = new NFse\Service\ConsultBatch($settings, $protocol);

				$result = $sync->sendConsultation();

				$retorno = json_decode(json_encode($result), true);


				if (array_key_exists("nfs", $retorno)) {

					foreach($retorno['nfs'] as $campo) {		

						$varNotaFiscal = $campo["numero"];					
						$varCodigoVerificacao = $campo["codigoVerificacao"];
						$varDataHoraEmissao = $campo["dataEmissao"];

					}

						$varNotaFiscalCompleta = $varNotaFiscal;

						$varNotaFiscal = substr($varNotaFiscal, 0, 4).ltrim(substr($varNotaFiscal,4,strlen($varNotaFiscal)),'0');

						$varDataHoraEmissao = explode('T', $varDataHoraEmissao);
						$varDataHoraEmissao = $varDataHoraEmissao[0].' '.$varDataHoraEmissao[1];


						$update_table  = 'notafiscal';     
						$update_where  = "IdNotaFiscal = '$this->idnotafiscal'"; 
						$update_fields = array(   
							"NumeroNotaFiscal = '$varNotaFiscal'",
							"NumeroNotaFiscalCompleto = '$varNotaFiscalCompleta'",
							"CodigoVerificacao = '$varCodigoVerificacao'",
							"DataRecebimentoNota = '$varDataHoraEmissao'",
							"NumeroLote = '$varNumeroLote'",
							"Protocolo = '$varProtocolo'",						
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      					

						if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
	

						$this->gerarNotaFiscal('P', $retorno['xml']);

						$texto = 'Nota fiscal gerada com sucesso: '.$varNotaFiscal;

						$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };	

				} else {

						$this->nm_mens_alert[] = 'Erro ao gerar a nota fiscal.'; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert('Erro ao gerar a nota fiscal.'); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };

				}		

			}  	

		} else {

			$texto = 'Erro ao gerar a nota fiscal. Por favor, verifique o cadastro do cliente.';

			$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };

		}

	} catch (Exception $e) {
		throw $e;
	}
} else if ($varTipoNotaFiscal == 'N') {	
	
	try {
		
		
		sc_include_library("prj", "nfse", "autoload.php", true, true);
		
		$pfxPath     = '/opt/LIGASistemas/v9_81/certificado/certificate.pfx';
		$pfxPassword = 'Infoliga.10';
		
		
		if ($varLocAmbiente == 'homologacao') {
			
			$endpoint = 'https://sefin.producaorestrita.nfse.gov.br/SefinNacional/nfse';
			$consultaDanfse = 'https://adn.producaorestrita.nfse.gov.br/danfse/';
			$tpAmb = 2; 
			
		} else {
			
			$endpoint = 'https://sefin.nfse.gov.br/SefinNacional/nfse';
			$consultaDanfse = 'https://adn.nfse.gov.br/danfse/';
			$tpAmb = 1; 
			
		}

		$debugDir = '/var/www/html/temp';
		if (!is_dir($debugDir)) {
			mkdir($debugDir, 0777, true);
		}

		$xmlFile       = $debugDir . '/dps_assinado.xml';
		$payloadFile   = $debugDir . '/payload.json';
		$curlLogFile   = $debugDir . '/curl_verbose.log';
		$gzBase64File  = $debugDir . '/dps_gzip_b64.txt';	
		$retornoNota  = $debugDir . '/dps_retorno.json';
		
		$pfxContent = @file_get_contents($pfxPath);
		if (!$pfxContent) {
			die("Erro fatal: não conseguiu ler o PFX em {$pfxPath}\n");
		}
		if (!openssl_pkcs12_read($pfxContent, $certs, $pfxPassword)) {
			die("Erro fatal: falha ao ler PFX — senha errada ou arquivo inválido.\n");
		}
		$privateKey = $certs['pkey']; 
		$publicCert = $certs['cert']; 
		
		
		date_default_timezone_set('America/Sao_Paulo');


		

		$codMunicipio  =  $varLocEmitenteCodigoMunicipio;     
		$tipoInscricao = '2';           
		$inscricaoFed  = $varLocEmitenteCnpj; 
		$serieDPS      = '1';           
		$numeroDPS     = $varSequenciaNotaFiscal;         

		$idDPS = $this->gerarIdDPS($codMunicipio, $tipoInscricao, $inscricaoFed, $serieDPS, $numeroDPS);

		$dhEmi = date('Y-m-d\TH:i:sP');				
		
		$check_sql = "SELECT cli.RazaoSocial, cli.Cnpj, cli.TipoLogradouro, cli.Logradouro, cli.Numero, cli.Complemento, cli.Bairro, cli.Cidade, cli.Estado, cli.Cep, m.Codigo, cli.InscricaoMunicipal FROM cliente cli INNER JOIN municipio m ON (m.IdMunicipio = cli.IdMunicipio) WHERE cli.IdCliente = $this->idcliente ";
		
	     
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
		

		if (isset($this->rs[0][0]) && $this->rs[0][10] > 0) {	
			
			$anoAtual = date('Y');
			$varRazaoSocial = $this->rs[0][0];
			$varCnpj = $this->rs[0][1];
			$varTipoLogradouro = $this->rs[0][2];
			$varLogradouro = $this->rs[0][3];
			$varNumero = $this->rs[0][4];
			$varComplemento = $this->rs[0][5];
			$varBairro = $this->rs[0][6];
			$varCidade = $this->rs[0][7];
			$varEstado = $this->rs[0][8];
			$varCep = $this->rs[0][9];
			$varCodigo = $this->rs[0][10];
			$varInscricaoMunicipalTomador = $this->rs[0][11];			

			if ($anoAtual > $varAnoNotaFiscal) {
				

				$varAnoNotaFiscal = $anoAtual;
				$varSequenciaNotaFiscal = 1;

			} else {

				$varSequenciaNotaFiscal = $varSequenciaNotaFiscal + 1;

			}			
		

			$update_table  = 'empresanotafiscal';     
			$update_where  = "IdEmpresa = '$this->idempresa'"; 
			$update_fields = array(   
				"AnoNotaFiscal = '$varAnoNotaFiscal'",
				"SequencialNotaFiscal = '$varSequenciaNotaFiscal'",
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
				
			
		
			$varDataHoraAtual = date('Y-m-d H:i:s');
			
			$descricaoServico = $this->tirarAcentos($this->discriminacao );		
			$descricaoServico = iconv('UTF-8', 'UTF-8//IGNORE', $descricaoServico);

			if ($this->valoriss  > 0) {
				
				$varAliquotaISSQN = $this->valoriss ;	
				$varRetISSQN = 2;
				$tagAliquota = "<pAliq>".$varAliquotaISSQN."</pAliq>";

			} else {

				$varAliquotaISSQN = 0;	
				$varRetISSQN = 1;
				$tagAliquota = "";

			}			
			
			$imTomador = !empty($varInscricaoMunicipalTomador) ? "<IM>{$varInscricaoMunicipalTomador}</IM>" : "";

			$varRazaoSocial = $this->tirarAcentos($varRazaoSocial);		
			$varRazaoSocial = iconv('UTF-8', 'UTF-8//IGNORE', $varRazaoSocial);

			$varEndereco = $varTipoLogradouro." ".$this->tirarAcentos($varLogradouro);
			$varEndereco = iconv('UTF-8', 'UTF-8//IGNORE', $varEndereco);
			
			$varEndereco = trim($varEndereco);

			$varComplemento = $this->tirarAcentos($varComplemento);
			$varComplemento = iconv('UTF-8', 'UTF-8//IGNORE', $varComplemento);
			
			$varComplemento = !empty($varComplemento) ? "<xCpl>{$varComplemento}</xCpl>" : "";
			
			$varComplemento = trim($varComplemento);

			$varBairro = $this->tirarAcentos($varBairro);
			$varBairro = iconv('UTF-8', 'UTF-8//IGNORE', $varBairro);	
			
			$varValorNotaFiscal = trim($this->valornotafiscal );
			
			$descricaoServico = trim($descricaoServico);			
		
			$varDtCompetencia = $this->nm_conv_data_db($this->datacompetencia ,"db_format","aaaa-mm-dd");
		
			$xml = <<<XML
					<?xml version="1.0" encoding="UTF-8"?>
					<DPS xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.00">					
						<infDPS Id="$idDPS">
							<tpAmb>$tpAmb</tpAmb>
							<dhEmi>$dhEmi</dhEmi>
							<verAplic>NFSe_0.0.0.2</verAplic>
							<serie>$serieDPS</serie>
							<nDPS>$numeroDPS</nDPS>
							<dCompet>$varDtCompetencia</dCompet>
							<tpEmit>1</tpEmit>
							<cLocEmi>$varLocEmitenteCodigoMunicipio</cLocEmi>
							
							<prest>
								<CNPJ>$varLocEmitenteCnpj</CNPJ>
								<IM>$varLocEmitenteInscricaoMunicipal</IM>
								<regTrib>
									<opSimpNac>3</opSimpNac>
									<regApTribSN>1</regApTribSN>
									<regEspTrib>0</regEspTrib>
								</regTrib>
							</prest>

							<toma>
								<CNPJ>$varCnpj</CNPJ>
								$imTomador
								<xNome>$varRazaoSocial</xNome>
								<end>
									<endNac>
										<cMun>$varCodigo</cMun>
										<CEP>$varCep</CEP>
									</endNac>
									<xLgr>$varEndereco</xLgr>
									<nro>$varNumero</nro>
									$varComplemento
									<xBairro>$varBairro</xBairro>
								</end>
							</toma>
							<serv>
								<locPrest>
									<cLocPrestacao>$varLocEmitenteCodigoMunicipio</cLocPrestacao>
								</locPrest>
								<cServ>
									<cTribNac>010501</cTribNac>
									<cTribMun>001</cTribMun>
									<xDescServ>$descricaoServico</xDescServ>
								</cServ>
							</serv>
							
							<valores>
								<vServPrest>
									<vServ>$varValorNotaFiscal</vServ>
								</vServPrest>							
								<trib>
									<tribMun>
									    <tribISSQN>1</tribISSQN>									
										<tpRetISSQN>$varRetISSQN</tpRetISSQN>
										$tagAliquota
									</tribMun>
									<totTrib>
										<vTotTrib>
											<vTotTribFed>0</vTotTribFed>
											<vTotTribEst>0</vTotTribEst>
											<vTotTribMun>0</vTotTribMun>
										</vTotTrib>
									</totTrib>
								</trib>			
							</valores>  							
						</infDPS>
					</DPS>
					XML;

			$dom = new DOMDocument('1.0', 'UTF-8');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = false;

			if (!$dom->loadXML($xml)) {
				
				die("Erro: não foi possível carregar o XML DPS.\n");
				
			}		
	
			$xpath = new DOMXPath($dom);
			$xpath->registerNamespace('ns', 'http://www.sped.fazenda.gov.br/nfse');
			$list = $xpath->query('//ns:infDPS');
			if ($list->length === 0) {
				die("Erro: elemento <infDPS> não encontrado (verifique namespace)\n");
			}
			$infDPS = $list->item(0);

			$dsig = new \RobRichards\XMLSecLibs\XMLSecurityDSig('');

			$transforms = [
				'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
				'http://www.w3.org/TR/2001/REC-xml-c14n-20010315'
			];

			$dsig->addReference(
				$infDPS,
				\RobRichards\XMLSecLibs\XMLSecurityDSig::SHA1,
				$transforms,
				['id_name' => 'Id', 'overwrite' => false]
			);

			$key = new \RobRichards\XMLSecLibs\XMLSecurityKey(
				\RobRichards\XMLSecLibs\XMLSecurityKey::RSA_SHA1,
				['type' => 'private']
			);
			$key->loadKey($privateKey, false);

			$dsig->setCanonicalMethod('http://www.w3.org/TR/2001/REC-xml-c14n-20010315'); 

			$dsig->sign($key);

			$certPem = $publicCert;
			if (preg_match_all('/-----BEGIN CERTIFICATE-----(.*?)-----END CERTIFICATE-----/s', $certPem, $matches)) {
				$certBody = preg_replace('/\s+/', '', $matches[1][0]);
			} else {
				$certBody = preg_replace('/-----BEGIN CERTIFICATE-----|-----END CERTIFICATE-----|\s+/', '', $certPem);
			}
			$dsig->add509Cert($certBody, false, false);

			$dsig->sigNode->setAttribute('xmlns', 'http://www.w3.org/2000/09/xmldsig#');

			$signatureNodeImported = $dom->importNode($dsig->sigNode, true);

			$parent = $infDPS->parentNode;
			$next   = $infDPS->nextSibling;

			if ($next) {
				$parent->insertBefore($signatureNodeImported, $next);
			} else {
				$parent->appendChild($signatureNodeImported);
			}


			$xmlAssinado = $dom->saveXML();

			file_put_contents($xmlFile, $xmlAssinado);
			
			echo "XML assinado salvo em: $xmlFile\n";

			$docVerify = new DOMDocument();
			$docVerify->loadXML($xmlAssinado);

			$dsigVerify = new \RobRichards\XMLSecLibs\XMLSecurityDSig();
			$dsigVerify->locateSignature($docVerify);
			$keyVerify = $dsigVerify->locateKey();
			$keyVerify->type = \RobRichards\XMLSecLibs\XMLSecurityKey::RSA_SHA1;

			$keyVerify->loadKey("-----BEGIN CERTIFICATE-----\n" . chunk_split($certBody, 64, "\n") . "-----END CERTIFICATE-----\n", false, true);

			$gzip   = gzencode($xmlAssinado);
			$base64 = base64_encode($gzip);
			file_put_contents($gzBase64File, $base64);

			$data = ["dpsXmlGZipB64" => $base64];
			$json = json_encode($data, JSON_UNESCAPED_SLASHES);
			file_put_contents($payloadFile, $json);
			echo "Payload salvo em: $payloadFile\n";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $endpoint);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

			$headers = [
				"Content-Type: application/json",
				"Accept: application/json",
				"User-Agent: PHP-NFSe-Client/1.0"
			];
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

			curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'P12');
			curl_setopt($ch, CURLOPT_SSLCERT, $pfxPath);
			curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $pfxPassword);

			curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

			$verbose = fopen($curlLogFile, 'w+');
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			curl_setopt($ch, CURLOPT_STDERR, $verbose);

			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 90);

			$response = curl_exec($ch);
			$errno = curl_errno($ch);
			$error = curl_error($ch);
			$info = curl_getinfo($ch);
			fclose($verbose);

			if ($errno) {
				
				echo "CURL error ($errno): $error\n";
				echo "Ver log verbose em: $curlLogFile\n";
			}

			$httpCode = $info['http_code'] ?? 'n/a';
			echo "HTTP Status: $httpCode\n";			

			if ($response !== false) {
				
				$headerSize = $info['header_size'] ?? 0;
				$rawHeader  = substr($response, 0, $headerSize);
				$body       = substr($response, $headerSize);

				echo "=== RESPONSE HEADER ===\n$rawHeader\n";
				echo "=== RESPONSE BODY ===\n$body\n";

				file_put_contents($debugDir . '/response_body.txt', $body);
				file_put_contents($debugDir . '/response_header.txt', $rawHeader);

				
				if ($httpCode === 201) {
					
					$data = json_decode($body, true);
					
					if (isset($data['nfseXmlGZipB64']) && !empty($data['nfseXmlGZipB64'])) {

						$xml_base64_gzip = $data['nfseXmlGZipB64'];
						$chave_acesso    = $data['chaveAcesso'] ?? 'NFS-e_desconhecida';	
						$varNotaFiscalCompleta = $data['idDps'];
						$varDataHoraEmissao = $data['dataHoraProcessamento'];
						$varDataHoraEmissao = explode('T', $varDataHoraEmissao);
						$varDataHoraEmissao = $varDataHoraEmissao[0].' '.$varDataHoraEmissao[1];						

						$xml_gzip = base64_decode($xml_base64_gzip);

						$xml_puro = @gzdecode($xml_gzip);

						if ($xml_puro === false) {
							 $xml_puro = @gzuncompress($xml_gzip);
						}

						if ($xml_puro !== false) {

							$filename = "NFSe_" . $chave_acesso . ".xml";
							$nfseDir = $debugDir . '/nfse_emitidas/';
							if (!is_dir($nfseDir)) {
								mkdir($nfseDir, 0777, true); 
							}
							
							$fullPath = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/".$filename;

							echo "\n--- NFS-e Processada ---\n";
							echo "<h3>**SUCESSO!** NFS-e Emitida!</h3>";
							echo "<p>Chave de Acesso: <strong>{$chave_acesso}</strong></p>";

							if (file_put_contents($fullPath, $xml_puro) !== false) {
								echo "<p style='color: green;'>XML da NFS-e salvo em: <strong>{$fullPath}</strong></p>";
							} else {
								echo "<p style='color: orange;'>AVISO: Falha ao salvar o XML da NFS-e em: {$fullPath}. Verifique permissões (777) no diretório.</p>";
							}
							
							$varNotaFiscal = $anoAtual.$numeroDPS;	
							
							$nomeXml = $filename;
							$this->nomereferenciaxml  = $nomeXml;		
							$this->nomearquivoxml  = $this->nomereferenciaxml ;


							$extensaoArquivo = pathinfo($this->nomereferenciaxml , PATHINFO_EXTENSION);
							$this->nomereferenciaxml  = md5(date('YdmHisu') . $this->nomereferenciaxml  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;
							$varNomeReferenciaXml = $this->nomereferenciaxml ;
							$nomeOriginalXml = $fullPath;
							$nomeReferenciaXml = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferenciaxml ;
							
							rename($nomeOriginalXml, $nomeReferenciaXml);
							
							libxml_use_internal_errors(true);
							$xml = simplexml_load_file($nomeReferenciaXml);
							$xml->registerXPathNamespace('ns', 'http://www.sped.fazenda.gov.br/nfse');	
							$infNFSe = $xml->xpath('//ns:infNFSe')[0];

							
							
													

							$numeroNFSe   = $this->v($infNFSe->nNFSe);
							
							$varNotaFiscal = $anoAtual.$numeroNFSe;
							
							$update_table  = 'notafiscal';     
							$update_where  = "IdNotaFiscal = '$this->idnotafiscal'"; 
							$update_fields = array(   
									"NumeroNotaFiscal = '$varNotaFiscal'",
									"NumeroNotaFiscalCompleto = '$varNotaFiscalCompleta'",
									"DataRecebimentoNota = '$varDataHoraEmissao'",
									"Protocolo = '$chave_acesso'",		
								    "NomeReferenciaXml = '$varNomeReferenciaXml'",
									"NomeArquivoXml = '$nomeXml'",
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
																
						
							

							$danfseUrl  = $consultaDanfse.$chave_acesso;
							
							$danfseFile = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/". "DANFSe_" . $chave_acesso . ".pdf";
							
							$danfseNome = "DANFSe_" . $chave_acesso . ".pdf";


							$verboseLog = fopen($debugDir . '/curl_verbose_danfse_adn.log', 'w+');
							$danfseFileHandle = fopen($danfseFile, 'w');

							$ch = curl_init($danfseUrl);
							curl_setopt_array($ch, [
								CURLOPT_FILE => $danfseFileHandle,
								CURLOPT_HTTPHEADER => [
									"User-Agent: PHP-NFSe-Client/1.0"
								],
								CURLOPT_SSLCERTTYPE => 'P12',
								CURLOPT_SSLCERT => $pfxPath,
								CURLOPT_SSLCERTPASSWD => $pfxPassword,
								CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
								CURLOPT_SSL_VERIFYPEER => true,
								CURLOPT_SSL_VERIFYHOST => 2,
								CURLOPT_CONNECTTIMEOUT => 30,
								CURLOPT_TIMEOUT => 120,
								CURLOPT_VERBOSE => true,
								CURLOPT_STDERR => $verboseLog,
								CURLOPT_FOLLOWLOCATION => true,
							]);

							curl_exec($ch);
							$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
							$error    = curl_error($ch);

							fclose($verboseLog);
							fclose($danfseFileHandle);
							curl_close($ch);

							echo "Verbose log: {$debugDir}/curl_verbose_danfse_adn.log\n";							

							if ($httpCode == 200) {
								
								

								$nomeXml = $filename;
								$nomePdf = $danfseNome;

								$this->nomereferencia  = $nomePdf;		
								$this->nomearquivo  = $this->nomereferencia ;

								$extensaoArquivo = pathinfo($this->nomereferencia , PATHINFO_EXTENSION);

								$this->nomereferencia  = md5(date('YdmHisu') . $this->nomereferencia  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;

								$varNomeReferencia = $this->nomereferencia ;

								$nomeOriginal = $danfseFile;

								$nomeReferencia = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferencia ;

								rename($nomeOriginal, $nomeReferencia);

								$this->nomereferenciaxml  = $nomeXml;		
								$this->nomearquivoxml  = $this->nomereferenciaxml ;


								$extensaoArquivo = pathinfo($this->nomereferenciaxml , PATHINFO_EXTENSION);

								$this->nomereferenciaxml  = md5(date('YdmHisu') . $this->nomereferenciaxml  . $this->sc_temp_varIdTenacidade) . "." . $extensaoArquivo;

								$varNomeReferenciaXml = $this->nomereferenciaxml ;

								$nomeOriginalXml = $fullPath;

								$nomeReferenciaXml = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade  . "/" . $this->nomereferenciaxml ;

								rename($nomeOriginalXml, $nomeReferenciaXml);

								$update_table  = 'notafiscal';     
								$update_where  = "IdNotaFiscal = '$this->idnotafiscal'"; 
								
								$update_fields = array(   
									"NumeroNotaFiscalCompleto = '$varNotaFiscalCompleta'",
									"DataRecebimentoNota = '$varDataHoraEmissao'",
									"Protocolo = '$chave_acesso'",	
									"NomeReferencia = '$varNomeReferencia'",
									"NomeArquivo = '$nomePdf'",	
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
								if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
		
								
								$varNotaFiscal = substr_replace($varNotaFiscal, ' / ', 4, 0);
								
								$texto = "Nota fiscal do governo gerada com sucesso! ".$varNotaFiscal;			
								$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
								
							} else {
								
								
								
								
								sc_include_library("prj", "nfsebh", "mpdf_autoload.php", true, true);

								
								$xmlPath = $nomeReferenciaXml;
								$tempDir = '/opt/LIGASistemas/v9_81/wwwroot/arqs/infotime_arqs/1/temp/';

								if (!file_exists($xmlPath)) {
									$this->nm_mens_alert[] = 'XML da NFS-e não encontrado.'.$fullPath; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert('XML da NFS-e não encontrado.'.$fullPath); }}

								if (!is_dir($tempDir)) {
									mkdir($tempDir, 0777, true);
								}
								
								
								libxml_use_internal_errors(true);
								$xml = simplexml_load_file($xmlPath);
								$xml->registerXPathNamespace('ns', 'http://www.sped.fazenda.gov.br/nfse');								
								

								$infNFSe = $xml->xpath('//ns:infNFSe')[0];
								$emit    = $infNFSe->emit;
								$infDPS  = $infNFSe->DPS->infDPS;
								$toma    = $infDPS->toma;
								$serv    = $infDPS->serv;
								$valoresDPS = $infDPS->valores;

								
								
								

								
								$chaveRaw = (string)$infNFSe['Id'];

								$chaveAcesso = preg_replace('/^NFS/', '', $chaveRaw);

								$numeroNFSe   = $this->v($infNFSe->nNFSe);
								$competencia  = date('m/Y', strtotime($infDPS->dCompet));
								$dataEmissaoN = date('d/m/Y H:i:s', strtotime($infNFSe->dhProc));
								$dataEmissaoDPS = date('d/m/Y H:i:s', strtotime($infDPS->dhEmi));
								$numeroDPS    = $this->v($infDPS->nDPS);
								$serieDPS     = $this->v($infDPS->serie);

								
								$emitNome     = $this->v($emit->xNome);
								$emitCnpj     = $this->v($emit->CNPJ);
								$emitIM       = $this->v($emit->IM);
								$emitEnd      = $this->v($emit->enderNac->xLgr) . ', ' . $this->v($emit->enderNac->nro) . ', ' . $this->v($emit->enderNac->xBairro);
								$emitMun      = $this->v($emit->enderNac->cMun) . ' - ' . $this->v($emit->enderNac->UF);
								$emitCep      = $this->v($emit->enderNac->CEP);

								
								$tomaNome     = $this->v($toma->xNome);
								$tomaCnpj     = $this->v($toma->CNPJ);
								$tomaIM       = $this->v($toma->IM);
								$tomaEnd      = $this->v($toma->end->xLgr) . ', ' . $this->v($toma->end->nro) . ', ' . $this->v($toma->end->xBairro);
								$tomMun       = $this->v($toma->end->endNac->cMun) . ' - ' . ($this->v($toma->end->endNac->cMun) === '3106200' ? 'MG' : '-'); 
								$tomaCep      = $this->v($toma->end->endNac->CEP);

								
								$descServico  = nl2br($this->v($serv->cServ->xDescServ));
								$codTribNac   = $this->v($serv->cServ->cTribNac);
								$codTribMun   = $this->v($serv->cServ->cTribMun);

								
								$valNFSe = $infNFSe->valores;
								$vBC        = $this->moeda($valNFSe->vBC ?? $valoresDPS->vServPrest->vServ);
								$aliq       = $this->v($valNFSe->pAliqAplic ?? $valoresDPS->trib->tribMun->pAliq) . ' %';
								$vISSQN     = $this->moeda($valNFSe->vISSQN ?? $valoresDPS->trib->vISSQN);
								$retISS     = ((string)($valoresDPS->trib->tribMun->tpRetISSQN ?? '') === '2')
											  ? 'Retido pelo Tomador'
											  : 'Não Retido';

								
								$totTrib = $valoresDPS->trib->totTrib->vTotTrib ?? null;

								$tribFed = $totTrib ? $this->moeda($totTrib->vTotTribFed) : 'R$ 0,00';
								$tribEst = $totTrib ? $this->moeda($totTrib->vTotTribEst) : 'R$ 0,00';
								$tribMunTot = $totTrib ? $this->moeda($totTrib->vTotTribMun) : 'R$ 0,00';

								
								$valorServico = $this->moeda($valoresDPS->vServPrest->vServ);
								$valorLiquido = $this->moeda($infNFSe->valores->vLiq);

								
								$qrUrlConsulta = 'https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave=' . $chaveAcesso;

								$logoNfse = 'data:image/png;base64,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';
								
								$qrImgBase64 = $this->gerarQRCode($qrUrlConsulta);

								
								$hashSha256 = strtoupper(hash('sha256', $chaveAcesso . $emitCnpj . $numeroNFSe));

								
								$html = '
								<style>
								body { font-family: Arial, sans-serif; font-size: 9.5pt; }
								.box { border:1px solid #000; margin-top:6px; }
								.box th { background:#f2f2f2; font-weight:bold; padding:4px; text-align:left; }
								.box td { padding:4px; vertical-align:top; }
								.center { text-align:center; }
								.small { font-size:8.5pt; }
								</style>
								<!-- CABEÇALHO -->
								<table width="100%" class="box">
								<tr>
								<td width="15%" style="text-align:center;">
									<img src="'.$logoNfse.'" style="width:180px;">
								</td>

								<td width="55%">
									<center><b style="font-size:14px;">DANFSe v1.0</b><br>
								   <b style="font-size:14px;">DOCUMENTO AUXILIAR DA NFS-e</b></center><br>   <br>  <br> <br> 
									<b>Chave de Acesso da NFS-e</b><br>
									<span style="font-size:11px;">'.$chaveAcesso.'</span>
								</td>

								<td width="30%" style="text-align:center;">
									<img src="'.$qrImgBase64.'" width="120"><br>
									<span class="small">A autenticidade desta NFS-e pode ser verificada
								pela leitura deste código QR ou pela consulta da
								chave de acesso no portal nacional da NFS-e
								</span>
								</td>
								</tr>
								</table>
								<!-- DADOS DA NFS-e -->
								<table width="100%" class="box">
								<tr><th colspan="4">DADOS DA NFS-e</th></tr>
								<tr>
								<td>Número<br><b>'.$numeroNFSe.'</b></td>
								<td>Competência<br><b>'.$competencia.'</b></td>
								<td>Emissão<br><b>'.$dataEmissaoN.'</b></td>
								<td>DPS<br><b>'.$numeroDPS.'</b></td>
								</tr>
								<tr>
								<td>Série DPS<br><b>'.$serieDPS.'</b></td>
								<td colspan="3">Data/Hora Emissão DPS<br><b>'.$dataEmissaoDPS.'</b></td>
								</tr>
								</table>

								<!-- EMITENTE -->
								<table width="100%" class="box">
								<tr><th colspan="4">EMITENTE DA NFS-e</th></tr>
								<tr>
								<td>'.$emitNome.'</td>
								<td>CNPJ<br>'.$emitCnpj.'</td>
								<td>Inscrição Municipal<br>'.$emitIM.'</td>
								<td>CEP<br>'.$emitCep.'</td>
								</tr>
								<tr>
								<td colspan="4">'.$emitEnd.' - '.$emitMun.'</td>
								</tr>
								</table>

								<!-- TOMADOR -->
								<table width="100%" class="box">
								<tr><th colspan="4">TOMADOR DO SERVIÇO</th></tr>
								<tr>
								<td>'.$tomaNome.'</td>
								<td>CNPJ<br>'.$tomaCnpj.'</td>
								<td>CEP<br>'.$tomaCep.'</td>
								<td>-</td>
								</tr>
								<tr>
								<td colspan="4">'.$tomaEnd.' - '.$tomaMun.'</td>
								</tr>
								</table>

								<!-- INTERMEDIÁRIO -->
								<table width="100%" class="box">
								<tr><th>INTERMEDIÁRIO DO SERVIÇO</th></tr>
								<tr><td>Não identificado na NFS-e</td></tr>
								</table>

								<!-- SERVIÇO -->
								<table width="100%" class="box">
								<tr><th>SERVIÇO PRESTADO</th></tr>
								<tr><td><b>Cód.Nac:</b> '.$codTribNac.'  <b>Cód.Mun:</b> '.$codTribMun.'<br>'.$descServico.'</td></tr>
								</table>

								<!-- TRIBUTAÇÃO MUNICIPAL -->
								<table width="100%" class="box">
								<tr><th colspan="2">TRIBUTAÇÃO MUNICIPAL</th></tr>
								<tr><td>BC ISSQN</td><td>'.$vBC.'</td></tr>
								<tr><td>Alíquota Aplicada</td><td>'.$aliq.'</td></tr>
								<tr><td>Retenção ISSQN</td><td>'.$retISS.'</td></tr>
								<tr><td>ISSQN Apurado</td><td>'.$vISSQN.'</td></tr>
								</table>

								<!-- TRIBUTAÇÃO FEDERAL -->
								<table width="100%" class="box">
								<tr><th colspan="2">TRIBUTAÇÃO FEDERAL</th></tr>
								<tr><td>Federais</td><td>'.$tribFed.'</td></tr>
								<tr><td>Estaduais</td><td>'.$tribEst.'</td></tr>
								<tr><td>Municipais</td><td>'.$tribMunTot.'</td></tr>
								</table>

								<!-- VALORES TOTAIS -->
								<table width="100%" class="box">
								<tr><th colspan="2">VALOR TOTAL DA NFS-e</th></tr>
								<tr><td>Valor do Serviço</td><td>'.$valorServico.'</td></tr>
								<tr><td>Valor Líquido</td><td>'.$valorLiquido.'</td></tr>
								</table>

								<!-- TOTAIS APROXIMADOS -->
								<table width="100%" class="box">
								<tr><th colspan="2">TOTAIS APROXIMADOS DOS TRIBUTOS</th></tr>
								<tr><td>Federais</td><td>'.$tribFed.'</td></tr>
								<tr><td>Estaduais</td><td>'.$tribEst.'</td></tr>
								<tr><td>Municipais</td><td>'.$tribMunTot.'</td></tr>
								</table>

								<!-- INFORMAÇÕES COMPLEMENTARES -->
								<table width="100%" class="box">
								<tr><th>INFORMAÇÕES COMPLEMENTARES</th></tr>
								<tr><td>-</td></tr>
								</table>

								<div class="small" style="margin-top:8px;border-top:1px solid #000;">
								Hash SHA-256: <b>'.$hashSha256.'</b><br>
								Documento emitido conforme padrão nacional da NFS-e.
								</div>
								';

								
								$mpdf = new \Mpdf\Mpdf([
									'format' => 'A4',
									'margin_left' => 10,
									'margin_right' => 10,
									'margin_top' => 10,
									'margin_bottom' => 10,
									'tempDir' => $tempDir
								]);

								
								$danfseDir = $this->sc_temp_varDiretorioArquivo . "/" . $this->sc_temp_varIdTenacidade . "/";

								if (!is_dir($danfseDir)) {
									mkdir($danfseDir, 0777, true);
								}

								$danfseNome = "DANFSe_" . $chave_acesso . ".pdf";
								$danfseFile = $danfseDir . $danfseNome;
								
								$nomePdf = $danfseNome;

								$this->nomereferencia  = $nomePdf;		
								$this->nomearquivo  = $nomePdf;

								$mpdf->WriteHTML($html);
								$mpdf->Output($danfseFile, 'F'); 
								
								$varNotaFiscal = $anoAtual.$numeroNFSe;
								
								$varNotaFiscal = substr_replace($varNotaFiscal, ' / ', 4, 0);
								
								$update_table  = 'notafiscal';     
								$update_where  = "IdNotaFiscal = '$this->idnotafiscal'"; 
								$update_fields = array(   
									"NomeReferencia = '$nomePdf'",
									"NomeArquivo = '$nomePdf'",	
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
                NotaFiscal_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
								if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
		
								
								$texto = "Nota fiscal gerada com sucesso! ".$varNotaFiscal;			
								$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); } if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };					
								
							}
							
						} else {
							
							echo "\n--- ERRO NA DESCOMPACTAÇÃO ---\n";
							echo "Falha ao descompactar o XML. Verifique as funções gzdecode-gzuncompress do PHP.\n";
							
						}

					} else {
					
						echo "\n--- ERRO NA RESPOSTA ---\n";
						echo "HTTP 201, mas a resposta não contém o campo 'nfseXmlGZipB64' esperado para extração do XML.\n";
					}
				} elseif ($httpCode !== 'n/a' && $httpCode >= 400) {
					
					echo "\n--- DETALHES DO ERRO API ---\n";
					$errorData = json_decode($body, true);
					
					
					if (isset($errorData['erros'][0])) {
					$descricaoErro = $errorData['erros'][0]['Descricao'];

					$complementoErro = $errorData['erros'][0]['Complemento'];

					$texto = "**" . $descricaoErro . "**\n\n";
					$texto .= "Detalhe Técnico:\n";
					$texto .= $complementoErro;

					$this->nm_mens_alert[] = $texto; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert($texto); }} else {
					$this->nm_mens_alert[] = "Ocorreu um erro, mas a estrutura de resposta é inesperada."; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Ocorreu um erro, mas a estrutura de resposta é inesperada."); }}
				}				
			} else {
				
				echo "Nenhuma resposta recebida do servidor.\n";
						
			}		

			curl_close($ch);

			echo "Curl verbose log: $curlLogFile\n";
			echo "Fim.\n"; 			
			
		
		} else {
			
			$this->nm_mens_alert[] = "Atenção: rever dados de cadastro do cliente."; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Atenção: rever dados de cadastro do cliente."); }}		
		
	} catch (Exception $e) {
		
		throw $e;
		
	}	
}



if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varDiretorioArquivo)) { $_SESSION['varDiretorioArquivo'] = $this->sc_temp_varDiretorioArquivo;}
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
$modificado_idempresa = $this->idempresa;
$modificado_datacompetencia = $this->datacompetencia;
$modificado_idcliente = $this->idcliente;
$modificado_discriminacao = $this->discriminacao;
$modificado_valornotafiscal = $this->valornotafiscal;
$modificado_valoriss = $this->valoriss;
$modificado_idnotafiscal = $this->idnotafiscal;
$modificado_nomereferenciaxml = $this->nomereferenciaxml;
$modificado_nomearquivoxml = $this->nomearquivoxml;
$modificado_nomereferencia = $this->nomereferencia;
$modificado_nomearquivo = $this->nomearquivo;
$modificado_valorliquido = $this->valorliquido;
$this->nm_formatar_campos('idempresa', 'datacompetencia', 'idcliente', 'discriminacao', 'valornotafiscal', 'valoriss', 'idnotafiscal', 'nomereferenciaxml', 'nomearquivoxml', 'nomereferencia', 'nomearquivo', 'valorliquido');
if ($original_idempresa !== $modificado_idempresa || isset($this->nmgp_cmp_readonly['idempresa']) || (isset($bFlagRead_idempresa) && $bFlagRead_idempresa))
{
    $this->ajax_return_values_idempresa(true);
}
if ($original_datacompetencia !== $modificado_datacompetencia || isset($this->nmgp_cmp_readonly['datacompetencia']) || (isset($bFlagRead_datacompetencia) && $bFlagRead_datacompetencia))
{
    $this->ajax_return_values_datacompetencia(true);
}
if ($original_idcliente !== $modificado_idcliente || isset($this->nmgp_cmp_readonly['idcliente']) || (isset($bFlagRead_idcliente) && $bFlagRead_idcliente))
{
    $this->ajax_return_values_idcliente(true);
}
if ($original_discriminacao !== $modificado_discriminacao || isset($this->nmgp_cmp_readonly['discriminacao']) || (isset($bFlagRead_discriminacao) && $bFlagRead_discriminacao))
{
    $this->ajax_return_values_discriminacao(true);
}
if ($original_valornotafiscal !== $modificado_valornotafiscal || isset($this->nmgp_cmp_readonly['valornotafiscal']) || (isset($bFlagRead_valornotafiscal) && $bFlagRead_valornotafiscal))
{
    $this->ajax_return_values_valornotafiscal(true);
}
if ($original_valoriss !== $modificado_valoriss || isset($this->nmgp_cmp_readonly['valoriss']) || (isset($bFlagRead_valoriss) && $bFlagRead_valoriss))
{
    $this->ajax_return_values_valoriss(true);
}
if ($original_idnotafiscal !== $modificado_idnotafiscal || isset($this->nmgp_cmp_readonly['idnotafiscal']) || (isset($bFlagRead_idnotafiscal) && $bFlagRead_idnotafiscal))
{
    $this->ajax_return_values_idnotafiscal(true);
}
if ($original_nomereferenciaxml !== $modificado_nomereferenciaxml || isset($this->nmgp_cmp_readonly['nomereferenciaxml']) || (isset($bFlagRead_nomereferenciaxml) && $bFlagRead_nomereferenciaxml))
{
    $this->ajax_return_values_nomereferenciaxml(true);
}
if ($original_nomearquivoxml !== $modificado_nomearquivoxml || isset($this->nmgp_cmp_readonly['nomearquivoxml']) || (isset($bFlagRead_nomearquivoxml) && $bFlagRead_nomearquivoxml))
{
    $this->ajax_return_values_nomearquivoxml(true);
}
if ($original_nomereferencia !== $modificado_nomereferencia || isset($this->nmgp_cmp_readonly['nomereferencia']) || (isset($bFlagRead_nomereferencia) && $bFlagRead_nomereferencia))
{
    $this->ajax_return_values_nomereferencia(true);
}
if ($original_nomearquivo !== $modificado_nomearquivo || isset($this->nmgp_cmp_readonly['nomearquivo']) || (isset($bFlagRead_nomearquivo) && $bFlagRead_nomearquivo))
{
    $this->ajax_return_values_nomearquivo(true);
}
if ($original_valorliquido !== $modificado_valorliquido || isset($this->nmgp_cmp_readonly['valorliquido']) || (isset($bFlagRead_valorliquido) && $bFlagRead_valorliquido))
{
    $this->ajax_return_values_valorliquido(true);
}
$this->NM_ajax_info['event_field'] = 'scajaxbutton';
NotaFiscal_Frm_pack_ajax_response();
exit;
}

/*----- END - Scriptcase Locale: Button GerarNota_onClick ------*/


/*----- Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/

function Gravar_Tabela_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
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
                NotaFiscal_Frm_pack_ajax_response();
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
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

function Preparar_LstFrm_OnSrip_OnLoad_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
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
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['idtenacidade'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("idusuarioauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['idusuarioauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("enderecoipauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['enderecoipauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("nomeaplicacaoauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Field_disabled_macro']['nomeaplicacaoauditoria'] = array('I'=>array(),'U'=>array());
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
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/

function somenteNumeros($v)
    {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
        return preg_replace('/\D+/', '', (string)$v);
    
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/


/*----- Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/

function limparTextoEvento($texto)
    {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
        $texto = trim((string)$texto);
        $texto = iconv('UTF-8', 'UTF-8//IGNORE', $texto);
        return htmlspecialchars($texto, ENT_XML1 | ENT_COMPAT, 'UTF-8');
    
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/


/*----- Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/

function extrairChaveAcessoDaTagNFS($idNfse)
    {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
        $idNfse = trim((string)$idNfse);
        return preg_replace('/^NFS/', '', $idNfse);
    
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/


/*----- Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/

function montarDhEvento()
    {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
        return date('Y-m-d\TH:i:sP');
    
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/


/*----- Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/

function montarIdEvento($tpEvento, $idNfse, $nSeqEvento)
    {
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'on';
  
        return 'ID' . $tpEvento . $idNfse . $nSeqEvento;
    
$_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: btn_CancelarNotaPortalNacional ------*/

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
     $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              NotaFiscal_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit'] . "';";
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
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'][$sTmpFile_nomereferencia] = $this->nomereferencia;
   } 
   if ($this->nomereferenciaboleto != "" && $this->nomereferenciaboleto != "none")   
   { 
       $sTmpExtension = pathinfo($this->nomereferenciaboleto, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_nomereferenciaboleto = 'sc_nomereferenciaboleto_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'][$sTmpFile_nomereferenciaboleto] = $this->nomereferenciaboleto;
   } 
   if ($this->nomereferenciaxml != "" && $this->nomereferenciaxml != "none")   
   { 
       $sTmpExtension = pathinfo($this->nomereferenciaxml, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_nomereferenciaxml = 'sc_nomereferenciaxml_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['download_filenames'][$sTmpFile_nomereferenciaxml] = $this->nomereferenciaxml;
   } 
        $this->initFormPages();
    include_once("NotaFiscal_Frm_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idnotafiscal", "idcliente", "idsituacaodocumento", "idempresa", "idlancamentoreceita", "numeronotafiscal", "codigoverificacao", "idusuarioemissao", "valornotafiscal", "valoriss", "valorliquido", "idusuariobaixa", "valorbaixa", "discriminacao", "nomearquivo", "boletos"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['csrf_token'];
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT IdEmpresa, concat_ws(' - ', NomeFantasia, TipoEmpresa)  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT IdEmpresa, ' - '&NomeFantasia&TipoEmpresa  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT IdEmpresa, ' - '||NomeFantasia||TipoEmpresa  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }
   else
   {
       $nm_comando = "SELECT IdEmpresa, ' - '||NomeFantasia||TipoEmpresa  FROM empresa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY NomeFantasia, TipoEmpresa";
   }

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idempresa'][] = $rs->fields[0];
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
   function Form_lookup_idplanoconta()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Tipo = 'A' AND Origem = 'R' and IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Classificador";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idplanoconta'][] = $rs->fields[0];
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
   function Form_lookup_idusuarioemissao()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Nome";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuarioemissao'][] = $rs->fields[0];
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
   function Form_lookup_idsituacaodocumento()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idsituacaodocumento'][] = $rs->fields[0];
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
   function Form_lookup_boletoliberado()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $nmgp_def_dados .= "Sim?#?S?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_idusuariobaixa()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'] = array(); 
    }

   $old_value_datacompetencia = $this->datacompetencia;
   $old_value_idnotafiscal = $this->idnotafiscal;
   $old_value_idcliente = $this->idcliente;
   $old_value_datavencimento = $this->datavencimento;
   $old_value_valornotafiscal = $this->valornotafiscal;
   $old_value_valoriss = $this->valoriss;
   $old_value_valorliquido = $this->valorliquido;
   $old_value_datarecebimento = $this->datarecebimento;
   $old_value_databaixa = $this->databaixa;
   $old_value_valorbaixa = $this->valorbaixa;
   $old_value_idlancamentoreceita = $this->idlancamentoreceita;
   $old_value_numeronotafiscal = $this->numeronotafiscal;
   $old_value_competenciasimples = $this->competenciasimples;
   $old_value_datarecebimentonota = $this->datarecebimentonota;
   $old_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $old_value_idusuariocancelamento = $this->idusuariocancelamento;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_datacompetencia = $this->datacompetencia;
   $unformatted_value_idnotafiscal = $this->idnotafiscal;
   $unformatted_value_idcliente = $this->idcliente;
   $unformatted_value_datavencimento = $this->datavencimento;
   $unformatted_value_valornotafiscal = $this->valornotafiscal;
   $unformatted_value_valoriss = $this->valoriss;
   $unformatted_value_valorliquido = $this->valorliquido;
   $unformatted_value_datarecebimento = $this->datarecebimento;
   $unformatted_value_databaixa = $this->databaixa;
   $unformatted_value_valorbaixa = $this->valorbaixa;
   $unformatted_value_idlancamentoreceita = $this->idlancamentoreceita;
   $unformatted_value_numeronotafiscal = $this->numeronotafiscal;
   $unformatted_value_competenciasimples = $this->competenciasimples;
   $unformatted_value_datarecebimentonota = $this->datarecebimentonota;
   $unformatted_value_datarecebimentonota_hora = $this->datarecebimentonota_hora;
   $unformatted_value_idusuariocancelamento = $this->idusuariocancelamento;

   $nm_comando = "SELECT IdUsuario, Nome  FROM usuario  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Nome";

   $this->datacompetencia = $old_value_datacompetencia;
   $this->idnotafiscal = $old_value_idnotafiscal;
   $this->idcliente = $old_value_idcliente;
   $this->datavencimento = $old_value_datavencimento;
   $this->valornotafiscal = $old_value_valornotafiscal;
   $this->valoriss = $old_value_valoriss;
   $this->valorliquido = $old_value_valorliquido;
   $this->datarecebimento = $old_value_datarecebimento;
   $this->databaixa = $old_value_databaixa;
   $this->valorbaixa = $old_value_valorbaixa;
   $this->idlancamentoreceita = $old_value_idlancamentoreceita;
   $this->numeronotafiscal = $old_value_numeronotafiscal;
   $this->competenciasimples = $old_value_competenciasimples;
   $this->datarecebimentonota = $old_value_datarecebimentonota;
   $this->datarecebimentonota_hora = $old_value_datarecebimentonota_hora;
   $this->idusuariocancelamento = $old_value_idusuariocancelamento;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['Lookup_idusuariobaixa'][] = $rs->fields[0];
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              NotaFiscal_Frm_pack_ajax_response();
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
              $this->SC_monta_condicao($comando, "IdNotaFiscal", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
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
              $data_lookup = $this->SC_lookup_idsituacaodocumento($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdSituacaoDocumento", $arg_search, $data_lookup, "BIGINT", false);
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
              $data_lookup = $this->SC_lookup_idlancamentoreceita($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdLancamentoReceita", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "NumeroNotaFiscal", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "CodigoVerificacao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idusuarioemissao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioEmissao", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorNotaFiscal", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorISS", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorLiquido", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idusuariobaixa($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdUsuarioBaixa", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ValorBaixa", $arg_search, str_replace(",", ".", $data_search), "FLOAT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Discriminacao", $arg_search, $data_search, "TEXT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "NomeArquivo", $arg_search, $data_search, "VARCHAR", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_NotaFiscal_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total'] = $qt_geral_reg_NotaFiscal_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          NotaFiscal_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          NotaFiscal_Frm_pack_ajax_response();
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
      $nm_numeric[] = "idnotafiscal";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idcliente";$nm_numeric[] = "idsituacaodocumento";$nm_numeric[] = "idempresa";$nm_numeric[] = "idlancamentoreceita";$nm_numeric[] = "idplanoconta";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "idusuariocancelamento";$nm_numeric[] = "idusuarioemissao";$nm_numeric[] = "valornotafiscal";$nm_numeric[] = "valoriss";$nm_numeric[] = "valorliquido";$nm_numeric[] = "idusuariobaixa";$nm_numeric[] = "valorbaixa";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['decimal_db'] == ".")
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
      $Nm_datas["datacompetencia"] = "datetime";$Nm_datas["dataemissao"] = "datetime";$Nm_datas["datavencimento"] = "datetime";$Nm_datas["databaixa"] = "datetime";$Nm_datas["datarecebimento"] = "datetime";$Nm_datas["competenciasimples"] = "datetime";$Nm_datas["dataliberacaoboleto"] = "datetime";$Nm_datas["datarecebimentonota"] = "datetime";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['SC_sep_date1'];
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
           $nm_comando = "SELECT Descricao, IdCliente FROM clienteempresa_view WHERE (CAST (IdCliente AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND (IdSituacaoCliente = 1)" ; 
       }
       else
       {
           $nm_comando = "SELECT Descricao, IdCliente FROM clienteempresa_view WHERE (#cmp_iDescricao#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "') AND (IdSituacaoCliente = 1)" ; 
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
           $nm_comando = "SELECT Descricao, IdSituacaoDocumento FROM situacaodocumento WHERE (CAST (IdSituacaoDocumento AS TEXT) LIKE '%$campo%') AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
       }
       else
       {
           $nm_comando = "SELECT Descricao, IdSituacaoDocumento FROM situacaodocumento WHERE (#cmp_iDescricao#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat_ws(' - ',NomeFantasia,TipoEmpresa), IdEmpresa FROM empresa WHERE (#cmp_iconcat_ws(' - ',NomeFantasia,TipoEmpresa)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT ' - '&NomeFantasia&TipoEmpresa, IdEmpresa FROM empresa WHERE (#cmp_i' - '&NomeFantasia&TipoEmpresa#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT ' - '||NomeFantasia||TipoEmpresa, IdEmpresa FROM empresa WHERE (#cmp_i' - '||NomeFantasia||TipoEmpresa#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT ' - '||NomeFantasia||TipoEmpresa, IdEmpresa FROM empresa WHERE (#cmp_i' - '||NomeFantasia||TipoEmpresa#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "')" ; 
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
   function SC_lookup_idlancamentoreceita($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT concat_ws(' ',IdLancamentoReceita,Historico,ValorPrevisao), IdLancamentoReceita FROM lancamentoreceita WHERE (#cmp_iconcat_ws(' ',IdLancamentoReceita,Historico,ValorPrevisao)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
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
   function SC_lookup_idusuarioemissao($condicao, $campo)
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
   function SC_lookup_idusuariobaixa($condicao, $campo)
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
       $nmgp_saida_form = "NotaFiscal_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "NotaFiscal_Frm_fim.php";
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
       NotaFiscal_Frm_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           NotaFiscal_Frm_pack_ajax_response();
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
       NotaFiscal_Frm_pack_ajax_response();
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
    function sc_ajax_alert($sMessage, $params = array())
    {
        if ($this->NM_ajax_flag)
        {
            $this->NM_ajax_info['ajaxAlert']['message'] = NM_charset_to_utf8($sMessage);
            $this->NM_ajax_info['ajaxAlert']['params']  = $this->sc_ajax_alert_params($params);
        }
    } // sc_ajax_alert

    function sc_ajax_alert_params($params)
    {
        $paramList = array();
        foreach ($params as $paramName => $paramValue)
        {
            if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding', 'position')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('background' == $paramName)
            {
                $paramList[$paramName] = $this->sc_ajax_alert_image(NM_charset_to_utf8($paramValue));
            }
        }
        return $paramList;
    } // sc_ajax_alert_params

    function sc_ajax_alert_image($background)
    {
        $image_param = $background;
        preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $background, $matches, PREG_PATTERN_ORDER);
        if (isset($matches[3])) {
            foreach ($matches[3] as $match) {
                if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                    $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                }
            }
        }
        return $image_param;
    } // sc_ajax_alert_image
    function sc_ajax_message($sMessage, $sTitle = '', $sParam = '', $sRedirPar = '')
    {
        if ($this->NM_ajax_flag)
        {
            $this->NM_ajax_info['ajaxMessage'] = array();
            if ('' != $sParam)
            {
                $aParamList = explode('&', $sParam);
                foreach ($aParamList as $sParamItem)
                {
                    $aParamData = explode('=', $sParamItem);
                    if (2 == sizeof($aParamData) &&
                        in_array($aParamData[0], array('modal', 'timeout', 'button', 'button_label', 'top', 'left', 'width', 'height', 'redir', 'redir_target', 'show_close', 'body_icon', 'toast', 'toast_pos', 'type')))
                    {
                        $this->NM_ajax_info['ajaxMessage'][$aParamData[0]] = NM_charset_to_utf8($aParamData[1]);
                    }
                }
            }
            if (isset($this->NM_ajax_info['ajaxMessage']['redir']) && '' != $this->NM_ajax_info['ajaxMessage']['redir'] && '.php' == substr($this->NM_ajax_info['ajaxMessage']['redir'], -4) && 'http' != substr($this->NM_ajax_info['ajaxMessage']['redir'], 0, 4))
            {
                $this->NM_ajax_info['ajaxMessage']['redir'] = $this->Ini->path_link . SC_dir_app_name(substr($this->NM_ajax_info['ajaxMessage']['redir'], 0, -4)) . '/' . $this->NM_ajax_info['ajaxMessage']['redir'];
            }
            if ('' != $sRedirPar)
            {
                $this->NM_ajax_info['ajaxMessage']['redir_par'] = str_replace('=', '?#?', str_replace(';', '?@?', $sRedirPar));
            }
            else
            {
                $this->NM_ajax_info['ajaxMessage']['redir_par'] = '';
            }
            $this->NM_ajax_info['ajaxMessage']['message'] = NM_charset_to_utf8($sMessage);
            $this->NM_ajax_info['ajaxMessage']['title']   = NM_charset_to_utf8($sTitle);
            if (!isset($this->NM_ajax_info['ajaxMessage']['button']))
            {
                $this->NM_ajax_info['ajaxMessage']['button'] = 'Y';
            }
        }
    } // sc_ajax_message
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
        if ('datarecebimentonota' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('dataemissao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('dataliberacaoboleto' == $sField)
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
            case "auditoria":
                return array("sc_Auditoria_top");
                break;
            case "sc_btn_0":
                return array("sc_sc_btn_0_top");
                break;
            case "0":
                return array("sys_separator.sc-unique-btn-5", "sys_separator.sc-unique-btn-7");
                break;
            case "imprimirnotafiscal":
                return array("sc_ImprimirNotaFiscal_top");
                break;
            case "cancelar":
                return array("sc_Cancelar_top");
                break;
            case "copy":
                return array("sc_b_copy_t.sc-unique-btn-6");
                break;
            case "gerarnota":
                return array("sc_GerarNota_top");
                break;
            case "cancelarnotaportalnacional":
                return array("sc_CancelarNotaPortalNacional_top");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-8", "sc_b_sai_t.sc-unique-btn-10", "sc_b_sai_t.sc-unique-btn-9");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " Nota Fiscal"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Nota Fiscal"; } ?></span></td>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['link_info']['compact_mode']) {
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['ordem_ord'] == " desc") {
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
            case "IdNotaFiscal":
                return true;
            case "IdCliente":
                return true;
            case "ValorNotaFiscal":
                return true;
            case "ValorISS":
                return true;
            case "ValorLiquido":
                return true;
            case "ValorBaixa":
                return true;
            case "IdLancamentoReceita":
                return true;
            case "IdUsuarioCancelamento":
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
