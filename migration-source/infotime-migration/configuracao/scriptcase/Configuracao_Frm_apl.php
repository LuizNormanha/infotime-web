<?php
//
class Configuracao_Frm_apl
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
   var $idconfiguracao;
   var $idtenacidade;
   var $idcontacaixalancamentoreceitanotafiscal;
   var $idcontacaixalancamentoreceitanotafiscal_1;
   var $idcontacaixaint;
   var $idcontacaixaint_1;
   var $idcontacaixacartao;
   var $idcontacaixacartao_1;
   var $idplanocontalancamentoreceitanotafiscal;
   var $idplanocontalancamentoreceitanotafiscal_1;
   var $idplanocontatransferenciaorigem;
   var $idplanocontatransferenciaorigem_1;
   var $idplanocontatransferenciadestino;
   var $idplanocontatransferenciadestino_1;
   var $idplanocontadinheiroint;
   var $idplanocontadinheiroint_1;
   var $idplanocontaguiaint;
   var $idplanocontaguiaint_1;
   var $idusuarioauditoria;
   var $idplanocontachequeint;
   var $idplanocontachequeint_1;
   var $idplanocontacartaocreditoint;
   var $idplanocontacartaocreditoint_1;
   var $idplanocontacartaodebitoint;
   var $idplanocontacartaodebitoint_1;
   var $idtipoespecielancamentoreceitanotafiscal;
   var $idtipoespecielancamentoreceitanotafiscal_1;
   var $idtipoespecietransferencia;
   var $idtipoespecietransferencia_1;
   var $idtipoespeciecartaocreditoint;
   var $idtipoespeciecartaocreditoint_1;
   var $idtipoespecieguiaint;
   var $idtipoespecieguiaint_1;
   var $idtipoespeciechequeint;
   var $idtipoespeciechequeint_1;
   var $idtipoespeciedinheiroint;
   var $idtipoespeciedinheiroint_1;
   var $idtipoespeciecartaodebitoint;
   var $idtipoespeciecartaodebitoint_1;
   var $idsituacaonovoclienteint;
   var $idsituacaonovoclienteint_1;
   var $idsituacaodocumentopendenteint;
   var $idsituacaodocumentopendenteint_1;
   var $idsituacaodocumentoexcluidoint;
   var $idsituacaodocumentoexcluidoint_1;
   var $idsituacaodocumentobaixadoint;
   var $idsituacaodocumentobaixadoint_1;
   var $servidorsmtp;
   var $usuariosmtp;
   var $senhasmtp;
   var $remetente;
   var $assunto;
   var $msgenviosenha;
   var $usuariosms;
   var $senhasms;
   var $urlsaida;
   var $servidorpdf;
   var $diretoriopdf;
   var $contratolicenca;
   var $clienteconcorrente;
   var $notafiscalobrigatorio;
   var $coletadomiciliar;
   var $diretorioexportacao;
   var $diretorioarquivo;
   var $imagemfoto;
   var $imagemfoto_scfile_name;
   var $imagemfoto_ul_name;
   var $imagemfoto_scfile_type;
   var $imagemfoto_ul_type;
   var $imagemfoto_limpa;
   var $imagemfoto_salva;
   var $out_imagemfoto;
   var $relacaomodulos;
   var $relacaocadastros;
   var $clienteativo;
   var $diasprevisaocartaocreditoint;
   var $diasprevisaocartaodebitoint;
   var $taxaservicocartaocreditoint;
   var $taxaservicocartaodebitoint;
   var $integracaoinfolabativa;
   var $recebeparcelado;
   var $usataxaadiantamento;
   var $anonotafiscal;
   var $sequencialnotafiscal;
   var $gravarauditoria;
   var $gravarauditoria_1;
   var $utilizacentrocusto;
   var $utilizacentrocusto_1;
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
          if (isset($this->NM_ajax_info['param']['assunto']))
          {
              $this->assunto = $this->NM_ajax_info['param']['assunto'];
          }
          if (isset($this->NM_ajax_info['param']['clienteativo']))
          {
              $this->clienteativo = $this->NM_ajax_info['param']['clienteativo'];
          }
          if (isset($this->NM_ajax_info['param']['clienteconcorrente']))
          {
              $this->clienteconcorrente = $this->NM_ajax_info['param']['clienteconcorrente'];
          }
          if (isset($this->NM_ajax_info['param']['coletadomiciliar']))
          {
              $this->coletadomiciliar = $this->NM_ajax_info['param']['coletadomiciliar'];
          }
          if (isset($this->NM_ajax_info['param']['contratolicenca']))
          {
              $this->contratolicenca = $this->NM_ajax_info['param']['contratolicenca'];
          }
          if (isset($this->NM_ajax_info['param']['diasprevisaocartaocreditoint']))
          {
              $this->diasprevisaocartaocreditoint = $this->NM_ajax_info['param']['diasprevisaocartaocreditoint'];
          }
          if (isset($this->NM_ajax_info['param']['diasprevisaocartaodebitoint']))
          {
              $this->diasprevisaocartaodebitoint = $this->NM_ajax_info['param']['diasprevisaocartaodebitoint'];
          }
          if (isset($this->NM_ajax_info['param']['diretorioarquivo']))
          {
              $this->diretorioarquivo = $this->NM_ajax_info['param']['diretorioarquivo'];
          }
          if (isset($this->NM_ajax_info['param']['diretorioexportacao']))
          {
              $this->diretorioexportacao = $this->NM_ajax_info['param']['diretorioexportacao'];
          }
          if (isset($this->NM_ajax_info['param']['diretoriopdf']))
          {
              $this->diretoriopdf = $this->NM_ajax_info['param']['diretoriopdf'];
          }
          if (isset($this->NM_ajax_info['param']['gravarauditoria']))
          {
              $this->gravarauditoria = $this->NM_ajax_info['param']['gravarauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['idconfiguracao']))
          {
              $this->idconfiguracao = $this->NM_ajax_info['param']['idconfiguracao'];
          }
          if (isset($this->NM_ajax_info['param']['idcontacaixacartao']))
          {
              $this->idcontacaixacartao = $this->NM_ajax_info['param']['idcontacaixacartao'];
          }
          if (isset($this->NM_ajax_info['param']['idcontacaixaint']))
          {
              $this->idcontacaixaint = $this->NM_ajax_info['param']['idcontacaixaint'];
          }
          if (isset($this->NM_ajax_info['param']['idcontacaixalancamentoreceitanotafiscal']))
          {
              $this->idcontacaixalancamentoreceitanotafiscal = $this->NM_ajax_info['param']['idcontacaixalancamentoreceitanotafiscal'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontacartaocreditoint']))
          {
              $this->idplanocontacartaocreditoint = $this->NM_ajax_info['param']['idplanocontacartaocreditoint'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontacartaodebitoint']))
          {
              $this->idplanocontacartaodebitoint = $this->NM_ajax_info['param']['idplanocontacartaodebitoint'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontachequeint']))
          {
              $this->idplanocontachequeint = $this->NM_ajax_info['param']['idplanocontachequeint'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontadinheiroint']))
          {
              $this->idplanocontadinheiroint = $this->NM_ajax_info['param']['idplanocontadinheiroint'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontaguiaint']))
          {
              $this->idplanocontaguiaint = $this->NM_ajax_info['param']['idplanocontaguiaint'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontalancamentoreceitanotafiscal']))
          {
              $this->idplanocontalancamentoreceitanotafiscal = $this->NM_ajax_info['param']['idplanocontalancamentoreceitanotafiscal'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontatransferenciadestino']))
          {
              $this->idplanocontatransferenciadestino = $this->NM_ajax_info['param']['idplanocontatransferenciadestino'];
          }
          if (isset($this->NM_ajax_info['param']['idplanocontatransferenciaorigem']))
          {
              $this->idplanocontatransferenciaorigem = $this->NM_ajax_info['param']['idplanocontatransferenciaorigem'];
          }
          if (isset($this->NM_ajax_info['param']['idsituacaodocumentobaixadoint']))
          {
              $this->idsituacaodocumentobaixadoint = $this->NM_ajax_info['param']['idsituacaodocumentobaixadoint'];
          }
          if (isset($this->NM_ajax_info['param']['idsituacaodocumentoexcluidoint']))
          {
              $this->idsituacaodocumentoexcluidoint = $this->NM_ajax_info['param']['idsituacaodocumentoexcluidoint'];
          }
          if (isset($this->NM_ajax_info['param']['idsituacaodocumentopendenteint']))
          {
              $this->idsituacaodocumentopendenteint = $this->NM_ajax_info['param']['idsituacaodocumentopendenteint'];
          }
          if (isset($this->NM_ajax_info['param']['idsituacaonovoclienteint']))
          {
              $this->idsituacaonovoclienteint = $this->NM_ajax_info['param']['idsituacaonovoclienteint'];
          }
          if (isset($this->NM_ajax_info['param']['idtipoespeciecartaocreditoint']))
          {
              $this->idtipoespeciecartaocreditoint = $this->NM_ajax_info['param']['idtipoespeciecartaocreditoint'];
          }
          if (isset($this->NM_ajax_info['param']['idtipoespeciecartaodebitoint']))
          {
              $this->idtipoespeciecartaodebitoint = $this->NM_ajax_info['param']['idtipoespeciecartaodebitoint'];
          }
          if (isset($this->NM_ajax_info['param']['idtipoespeciechequeint']))
          {
              $this->idtipoespeciechequeint = $this->NM_ajax_info['param']['idtipoespeciechequeint'];
          }
          if (isset($this->NM_ajax_info['param']['idtipoespeciedinheiroint']))
          {
              $this->idtipoespeciedinheiroint = $this->NM_ajax_info['param']['idtipoespeciedinheiroint'];
          }
          if (isset($this->NM_ajax_info['param']['idtipoespecieguiaint']))
          {
              $this->idtipoespecieguiaint = $this->NM_ajax_info['param']['idtipoespecieguiaint'];
          }
          if (isset($this->NM_ajax_info['param']['idtipoespecielancamentoreceitanotafiscal']))
          {
              $this->idtipoespecielancamentoreceitanotafiscal = $this->NM_ajax_info['param']['idtipoespecielancamentoreceitanotafiscal'];
          }
          if (isset($this->NM_ajax_info['param']['idtipoespecietransferencia']))
          {
              $this->idtipoespecietransferencia = $this->NM_ajax_info['param']['idtipoespecietransferencia'];
          }
          if (isset($this->NM_ajax_info['param']['imagemfoto']))
          {
              $this->imagemfoto = $this->NM_ajax_info['param']['imagemfoto'];
          }
          if (isset($this->NM_ajax_info['param']['imagemfoto_limpa']))
          {
              $this->imagemfoto_limpa = $this->NM_ajax_info['param']['imagemfoto_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['imagemfoto_ul_name']))
          {
              $this->imagemfoto_ul_name = $this->NM_ajax_info['param']['imagemfoto_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['imagemfoto_ul_type']))
          {
              $this->imagemfoto_ul_type = $this->NM_ajax_info['param']['imagemfoto_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['integracaoinfolabativa']))
          {
              $this->integracaoinfolabativa = $this->NM_ajax_info['param']['integracaoinfolabativa'];
          }
          if (isset($this->NM_ajax_info['param']['msgenviosenha']))
          {
              $this->msgenviosenha = $this->NM_ajax_info['param']['msgenviosenha'];
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
          if (isset($this->NM_ajax_info['param']['notafiscalobrigatorio']))
          {
              $this->notafiscalobrigatorio = $this->NM_ajax_info['param']['notafiscalobrigatorio'];
          }
          if (isset($this->NM_ajax_info['param']['recebeparcelado']))
          {
              $this->recebeparcelado = $this->NM_ajax_info['param']['recebeparcelado'];
          }
          if (isset($this->NM_ajax_info['param']['relacaocadastros']))
          {
              $this->relacaocadastros = $this->NM_ajax_info['param']['relacaocadastros'];
          }
          if (isset($this->NM_ajax_info['param']['relacaomodulos']))
          {
              $this->relacaomodulos = $this->NM_ajax_info['param']['relacaomodulos'];
          }
          if (isset($this->NM_ajax_info['param']['remetente']))
          {
              $this->remetente = $this->NM_ajax_info['param']['remetente'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['senhasms']))
          {
              $this->senhasms = $this->NM_ajax_info['param']['senhasms'];
          }
          if (isset($this->NM_ajax_info['param']['senhasmtp']))
          {
              $this->senhasmtp = $this->NM_ajax_info['param']['senhasmtp'];
          }
          if (isset($this->NM_ajax_info['param']['servidorpdf']))
          {
              $this->servidorpdf = $this->NM_ajax_info['param']['servidorpdf'];
          }
          if (isset($this->NM_ajax_info['param']['servidorsmtp']))
          {
              $this->servidorsmtp = $this->NM_ajax_info['param']['servidorsmtp'];
          }
          if (isset($this->NM_ajax_info['param']['taxaservicocartaocreditoint']))
          {
              $this->taxaservicocartaocreditoint = $this->NM_ajax_info['param']['taxaservicocartaocreditoint'];
          }
          if (isset($this->NM_ajax_info['param']['taxaservicocartaodebitoint']))
          {
              $this->taxaservicocartaodebitoint = $this->NM_ajax_info['param']['taxaservicocartaodebitoint'];
          }
          if (isset($this->NM_ajax_info['param']['urlsaida']))
          {
              $this->urlsaida = $this->NM_ajax_info['param']['urlsaida'];
          }
          if (isset($this->NM_ajax_info['param']['usataxaadiantamento']))
          {
              $this->usataxaadiantamento = $this->NM_ajax_info['param']['usataxaadiantamento'];
          }
          if (isset($this->NM_ajax_info['param']['usuariosms']))
          {
              $this->usuariosms = $this->NM_ajax_info['param']['usuariosms'];
          }
          if (isset($this->NM_ajax_info['param']['usuariosmtp']))
          {
              $this->usuariosmtp = $this->NM_ajax_info['param']['usuariosmtp'];
          }
          if (isset($this->NM_ajax_info['param']['utilizacentrocusto']))
          {
              $this->utilizacentrocusto = $this->NM_ajax_info['param']['utilizacentrocusto'];
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
      if (isset($this->varPrimeiraVez) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
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
      if (isset($_GET["varPrivAdmin"]) && isset($this->varPrivAdmin)) 
      {
          $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
      }
      if (!isset($_GET["varPrivAdmin"]) && isset($_GET["varprivadmin"])) 
      {
          $_SESSION['varPrivAdmin'] = $_GET["varprivadmin"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['embutida_parms']);
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
                 nm_limpa_str_Configuracao_Frm($cadapar[1]);
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
              $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['opc_ant']);
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
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
          if (!isset($this->varPrivAdmin) && isset($this->varprivadmin)) 
          {
              $this->varPrivAdmin = $this->varprivadmin;
          }
          if (isset($this->varPrivAdmin)) 
          {
              $_SESSION['varPrivAdmin'] = $this->varPrivAdmin;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new Configuracao_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
  $this->sc_temp_varPrimeiraVez = "";
$this->sc_temp_varIdTenacidade;
$this->sc_temp_varIdUsuario;
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['Configuracao_Frm']['upload_field_info']['imagemfoto'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'Configuracao_Frm',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/.+$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '0',
          'upload_file_width'  => '0',
          'upload_file_aspect' => 'S',
          'upload_file_type'   => 'I',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Configuracao_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['Configuracao_Frm'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Configuracao_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Configuracao_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('Configuracao_Frm') . "/Configuracao_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['Configuracao_Frm']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Configuração";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "Configuracao_Frm")
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


      $_SESSION['scriptcase']['error_icon']['Configuracao_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['Configuracao_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "Configuracao_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['imagemfoto_ul_name']) && '' != $this->NM_ajax_info['param']['imagemfoto_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_field_ul_name'][$this->imagemfoto_ul_name]))
          {
              $this->NM_ajax_info['param']['imagemfoto_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_field_ul_name'][$this->imagemfoto_ul_name];
          }
          $this->imagemfoto = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['imagemfoto_ul_name'];
          $this->imagemfoto_scfile_name = substr($this->NM_ajax_info['param']['imagemfoto_ul_name'], 12);
          $this->imagemfoto_scfile_type = $this->NM_ajax_info['param']['imagemfoto_ul_type'];
          $this->imagemfoto_ul_name = $this->NM_ajax_info['param']['imagemfoto_ul_name'];
          $this->imagemfoto_ul_type = $this->NM_ajax_info['param']['imagemfoto_ul_type'];
      }
      elseif (isset($this->imagemfoto_ul_name) && '' != $this->imagemfoto_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_field_ul_name'][$this->imagemfoto_ul_name]))
          {
              $this->imagemfoto_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_field_ul_name'][$this->imagemfoto_ul_name];
          }
          $this->imagemfoto = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->imagemfoto_ul_name;
          $this->imagemfoto_scfile_name = substr($this->imagemfoto_ul_name, 12);
          $this->imagemfoto_scfile_type = $this->imagemfoto_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['goto']      = 'on';
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
      $this->nmgp_botoes['Auditoria'] = "on";
      $this->nmgp_botoes['sc_btn_0'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['Configuracao_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['Configuracao_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['Configuracao_Frm'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form'];
          if (!isset($this->idconfiguracao)){$this->idconfiguracao = $this->nmgp_dados_form['idconfiguracao'];} 
          if (!isset($this->idtenacidade)){$this->idtenacidade = $this->nmgp_dados_form['idtenacidade'];} 
          if (!isset($this->idusuarioauditoria)){$this->idusuarioauditoria = $this->nmgp_dados_form['idusuarioauditoria'];} 
          if (!isset($this->anonotafiscal)){$this->anonotafiscal = $this->nmgp_dados_form['anonotafiscal'];} 
          if (!isset($this->sequencialnotafiscal)){$this->sequencialnotafiscal = $this->nmgp_dados_form['sequencialnotafiscal'];} 
          if (!isset($this->enderecoipauditoria)){$this->enderecoipauditoria = $this->nmgp_dados_form['enderecoipauditoria'];} 
          if (!isset($this->nomeaplicacaoauditoria)){$this->nomeaplicacaoauditoria = $this->nmgp_dados_form['nomeaplicacaoauditoria'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("Configuracao_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'Configuracao_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'Configuracao_Frm_help.txt');
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
          require_once($this->Ini->path_embutida . 'Configuracao_Frm/Configuracao_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "Configuracao_Frm_erro.class.php"); 
      }
      $this->Erro      = new Configuracao_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao']))
         { 
             if ($this->idconfiguracao != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['Configuracao_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['Auditoria'] = "off";
          $this->nmgp_botoes['sc_btn_0'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['Auditoria'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['botoes']['Auditoria'];
          $this->nmgp_botoes['sc_btn_0'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['botoes']['sc_btn_0'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form'];
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
      
/*----- Scriptcase Locale: Event onScriptinit ------*/
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varPrivAdmin)) {$this->sc_temp_varPrivAdmin = (isset($_SESSION['varPrivAdmin'])) ? $_SESSION['varPrivAdmin'] : "";}
  if ($this->sc_temp_varPrivAdmin != 1) {
	$this->nmgp_cmp_hidden["gravarauditoria"] = 'off'; $this->NM_ajax_info['fieldDisplay']['gravarauditoria'] = 'off';
}
if (isset($this->sc_temp_varPrivAdmin)) { $_SESSION['varPrivAdmin'] = $this->sc_temp_varPrivAdmin;}
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onScriptinit ------*/
 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['Configuracao_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['Configuracao_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['Configuracao_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['Configuracao_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->idcontacaixalancamentoreceitanotafiscal)) { $this->nm_limpa_alfa($this->idcontacaixalancamentoreceitanotafiscal); }
      if (isset($this->idcontacaixaint)) { $this->nm_limpa_alfa($this->idcontacaixaint); }
      if (isset($this->idcontacaixacartao)) { $this->nm_limpa_alfa($this->idcontacaixacartao); }
      if (isset($this->idplanocontalancamentoreceitanotafiscal)) { $this->nm_limpa_alfa($this->idplanocontalancamentoreceitanotafiscal); }
      if (isset($this->idplanocontatransferenciaorigem)) { $this->nm_limpa_alfa($this->idplanocontatransferenciaorigem); }
      if (isset($this->idplanocontatransferenciadestino)) { $this->nm_limpa_alfa($this->idplanocontatransferenciadestino); }
      if (isset($this->idplanocontadinheiroint)) { $this->nm_limpa_alfa($this->idplanocontadinheiroint); }
      if (isset($this->idplanocontaguiaint)) { $this->nm_limpa_alfa($this->idplanocontaguiaint); }
      if (isset($this->idplanocontachequeint)) { $this->nm_limpa_alfa($this->idplanocontachequeint); }
      if (isset($this->idplanocontacartaocreditoint)) { $this->nm_limpa_alfa($this->idplanocontacartaocreditoint); }
      if (isset($this->idplanocontacartaodebitoint)) { $this->nm_limpa_alfa($this->idplanocontacartaodebitoint); }
      if (isset($this->idtipoespecielancamentoreceitanotafiscal)) { $this->nm_limpa_alfa($this->idtipoespecielancamentoreceitanotafiscal); }
      if (isset($this->idtipoespecietransferencia)) { $this->nm_limpa_alfa($this->idtipoespecietransferencia); }
      if (isset($this->idtipoespeciecartaocreditoint)) { $this->nm_limpa_alfa($this->idtipoespeciecartaocreditoint); }
      if (isset($this->idtipoespecieguiaint)) { $this->nm_limpa_alfa($this->idtipoespecieguiaint); }
      if (isset($this->idtipoespeciechequeint)) { $this->nm_limpa_alfa($this->idtipoespeciechequeint); }
      if (isset($this->idtipoespeciedinheiroint)) { $this->nm_limpa_alfa($this->idtipoespeciedinheiroint); }
      if (isset($this->idtipoespeciecartaodebitoint)) { $this->nm_limpa_alfa($this->idtipoespeciecartaodebitoint); }
      if (isset($this->idsituacaonovoclienteint)) { $this->nm_limpa_alfa($this->idsituacaonovoclienteint); }
      if (isset($this->idsituacaodocumentopendenteint)) { $this->nm_limpa_alfa($this->idsituacaodocumentopendenteint); }
      if (isset($this->idsituacaodocumentoexcluidoint)) { $this->nm_limpa_alfa($this->idsituacaodocumentoexcluidoint); }
      if (isset($this->idsituacaodocumentobaixadoint)) { $this->nm_limpa_alfa($this->idsituacaodocumentobaixadoint); }
      if (isset($this->servidorsmtp)) { $this->nm_limpa_alfa($this->servidorsmtp); }
      if (isset($this->usuariosmtp)) { $this->nm_limpa_alfa($this->usuariosmtp); }
      if (isset($this->senhasmtp)) { $this->nm_limpa_alfa($this->senhasmtp); }
      if (isset($this->remetente)) { $this->nm_limpa_alfa($this->remetente); }
      if (isset($this->assunto)) { $this->nm_limpa_alfa($this->assunto); }
      if (isset($this->msgenviosenha)) { $this->nm_limpa_alfa($this->msgenviosenha); }
      if (isset($this->usuariosms)) { $this->nm_limpa_alfa($this->usuariosms); }
      if (isset($this->senhasms)) { $this->nm_limpa_alfa($this->senhasms); }
      if (isset($this->urlsaida)) { $this->nm_limpa_alfa($this->urlsaida); }
      if (isset($this->servidorpdf)) { $this->nm_limpa_alfa($this->servidorpdf); }
      if (isset($this->diretoriopdf)) { $this->nm_limpa_alfa($this->diretoriopdf); }
      if (isset($this->clienteconcorrente)) { $this->nm_limpa_alfa($this->clienteconcorrente); }
      if (isset($this->notafiscalobrigatorio)) { $this->nm_limpa_alfa($this->notafiscalobrigatorio); }
      if (isset($this->coletadomiciliar)) { $this->nm_limpa_alfa($this->coletadomiciliar); }
      if (isset($this->diretorioexportacao)) { $this->nm_limpa_alfa($this->diretorioexportacao); }
      if (isset($this->diretorioarquivo)) { $this->nm_limpa_alfa($this->diretorioarquivo); }
      if (isset($this->relacaomodulos)) { $this->nm_limpa_alfa($this->relacaomodulos); }
      if (isset($this->relacaocadastros)) { $this->nm_limpa_alfa($this->relacaocadastros); }
      if (isset($this->clienteativo)) { $this->nm_limpa_alfa($this->clienteativo); }
      if (isset($this->diasprevisaocartaocreditoint)) { $this->nm_limpa_alfa($this->diasprevisaocartaocreditoint); }
      if (isset($this->diasprevisaocartaodebitoint)) { $this->nm_limpa_alfa($this->diasprevisaocartaodebitoint); }
      if (isset($this->taxaservicocartaocreditoint)) { $this->nm_limpa_alfa($this->taxaservicocartaocreditoint); }
      if (isset($this->taxaservicocartaodebitoint)) { $this->nm_limpa_alfa($this->taxaservicocartaodebitoint); }
      if (isset($this->integracaoinfolabativa)) { $this->nm_limpa_alfa($this->integracaoinfolabativa); }
      if (isset($this->recebeparcelado)) { $this->nm_limpa_alfa($this->recebeparcelado); }
      if (isset($this->usataxaadiantamento)) { $this->nm_limpa_alfa($this->usataxaadiantamento); }
      if (isset($this->gravarauditoria)) { $this->nm_limpa_alfa($this->gravarauditoria); }
      if (isset($this->utilizacentrocusto)) { $this->nm_limpa_alfa($this->utilizacentrocusto); }
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
          $this->NM_close_db(); 
          exit;
      } 
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "Configuracao_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- diasprevisaocartaocreditoint
      $this->field_config['diasprevisaocartaocreditoint']               = array();
      $this->field_config['diasprevisaocartaocreditoint']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['diasprevisaocartaocreditoint']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['diasprevisaocartaocreditoint']['symbol_dec'] = '';
      $this->field_config['diasprevisaocartaocreditoint']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['diasprevisaocartaocreditoint']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- diasprevisaocartaodebitoint
      $this->field_config['diasprevisaocartaodebitoint']               = array();
      $this->field_config['diasprevisaocartaodebitoint']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['diasprevisaocartaodebitoint']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['diasprevisaocartaodebitoint']['symbol_dec'] = '';
      $this->field_config['diasprevisaocartaodebitoint']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['diasprevisaocartaodebitoint']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- taxaservicocartaocreditoint
      $this->field_config['taxaservicocartaocreditoint']               = array();
      $this->field_config['taxaservicocartaocreditoint']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['taxaservicocartaocreditoint']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['taxaservicocartaocreditoint']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['taxaservicocartaocreditoint']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['taxaservicocartaocreditoint']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- taxaservicocartaodebitoint
      $this->field_config['taxaservicocartaodebitoint']               = array();
      $this->field_config['taxaservicocartaodebitoint']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['taxaservicocartaodebitoint']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['taxaservicocartaodebitoint']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['taxaservicocartaodebitoint']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['taxaservicocartaodebitoint']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idconfiguracao
      $this->field_config['idconfiguracao']               = array();
      $this->field_config['idconfiguracao']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idconfiguracao']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idconfiguracao']['symbol_dec'] = '';
      $this->field_config['idconfiguracao']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idconfiguracao']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- idusuarioauditoria
      $this->field_config['idusuarioauditoria']               = array();
      $this->field_config['idusuarioauditoria']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idusuarioauditoria']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idusuarioauditoria']['symbol_dec'] = '';
      $this->field_config['idusuarioauditoria']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idusuarioauditoria']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- anonotafiscal
      $this->field_config['anonotafiscal']               = array();
      $this->field_config['anonotafiscal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['anonotafiscal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['anonotafiscal']['symbol_dec'] = '';
      $this->field_config['anonotafiscal']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['anonotafiscal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- sequencialnotafiscal
      $this->field_config['sequencialnotafiscal']               = array();
      $this->field_config['sequencialnotafiscal']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['sequencialnotafiscal']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['sequencialnotafiscal']['symbol_dec'] = '';
      $this->field_config['sequencialnotafiscal']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['sequencialnotafiscal']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
          if ('validate_clienteativo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'clienteativo');
          }
          if ('validate_gravarauditoria' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'gravarauditoria');
          }
          if ('validate_integracaoinfolabativa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'integracaoinfolabativa');
          }
          if ('validate_usataxaadiantamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'usataxaadiantamento');
          }
          if ('validate_recebeparcelado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'recebeparcelado');
          }
          if ('validate_utilizacentrocusto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'utilizacentrocusto');
          }
          if ('validate_urlsaida' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'urlsaida');
          }
          if ('validate_clienteconcorrente' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'clienteconcorrente');
          }
          if ('validate_notafiscalobrigatorio' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'notafiscalobrigatorio');
          }
          if ('validate_coletadomiciliar' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'coletadomiciliar');
          }
          if ('validate_diretorioexportacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'diretorioexportacao');
          }
          if ('validate_diretorioarquivo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'diretorioarquivo');
          }
          if ('validate_diasprevisaocartaocreditoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'diasprevisaocartaocreditoint');
          }
          if ('validate_diasprevisaocartaodebitoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'diasprevisaocartaodebitoint');
          }
          if ('validate_taxaservicocartaocreditoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'taxaservicocartaocreditoint');
          }
          if ('validate_taxaservicocartaodebitoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'taxaservicocartaodebitoint');
          }
          if ('validate_relacaocadastros' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'relacaocadastros');
          }
          if ('validate_relacaomodulos' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'relacaomodulos');
          }
          if ('validate_contratolicenca' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'contratolicenca');
          }
          if ('validate_servidorsmtp' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'servidorsmtp');
          }
          if ('validate_usuariosmtp' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'usuariosmtp');
          }
          if ('validate_senhasmtp' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'senhasmtp');
          }
          if ('validate_remetente' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'remetente');
          }
          if ('validate_assunto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'assunto');
          }
          if ('validate_msgenviosenha' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'msgenviosenha');
          }
          if ('validate_usuariosms' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'usuariosms');
          }
          if ('validate_senhasms' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'senhasms');
          }
          if ('validate_servidorpdf' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'servidorpdf');
          }
          if ('validate_diretoriopdf' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'diretoriopdf');
          }
          if ('validate_idplanocontalancamentoreceitanotafiscal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontalancamentoreceitanotafiscal');
          }
          if ('validate_idplanocontatransferenciaorigem' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontatransferenciaorigem');
          }
          if ('validate_idplanocontatransferenciadestino' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontatransferenciadestino');
          }
          if ('validate_idplanocontadinheiroint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontadinheiroint');
          }
          if ('validate_idplanocontaguiaint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontaguiaint');
          }
          if ('validate_idplanocontachequeint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontachequeint');
          }
          if ('validate_idplanocontacartaocreditoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontacartaocreditoint');
          }
          if ('validate_idplanocontacartaodebitoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idplanocontacartaodebitoint');
          }
          if ('validate_idcontacaixalancamentoreceitanotafiscal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcontacaixalancamentoreceitanotafiscal');
          }
          if ('validate_idcontacaixaint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcontacaixaint');
          }
          if ('validate_idcontacaixacartao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcontacaixacartao');
          }
          if ('validate_idsituacaonovoclienteint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idsituacaonovoclienteint');
          }
          if ('validate_idsituacaodocumentopendenteint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idsituacaodocumentopendenteint');
          }
          if ('validate_idsituacaodocumentoexcluidoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idsituacaodocumentoexcluidoint');
          }
          if ('validate_idsituacaodocumentobaixadoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idsituacaodocumentobaixadoint');
          }
          if ('validate_idtipoespecielancamentoreceitanotafiscal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipoespecielancamentoreceitanotafiscal');
          }
          if ('validate_idtipoespecietransferencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipoespecietransferencia');
          }
          if ('validate_idtipoespeciecartaocreditoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipoespeciecartaocreditoint');
          }
          if ('validate_idtipoespecieguiaint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipoespecieguiaint');
          }
          if ('validate_idtipoespeciechequeint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipoespeciechequeint');
          }
          if ('validate_idtipoespeciedinheiroint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipoespeciedinheiroint');
          }
          if ('validate_idtipoespeciecartaodebitoint' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idtipoespeciecartaodebitoint');
          }
          if ('validate_imagemfoto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'imagemfoto');
          }
          Configuracao_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          if (is_array($this->gravarauditoria))
          {
              $x = 0; 
              $this->gravarauditoria_1 = $this->gravarauditoria;
              $this->gravarauditoria = ""; 
              if ($this->gravarauditoria_1 != "") 
              { 
                  foreach ($this->gravarauditoria_1 as $dados_gravarauditoria_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->gravarauditoria .= ";";
                      } 
                      $this->gravarauditoria .= $dados_gravarauditoria_1;
                      $x++ ; 
                  } 
              } 
          } 
          if (is_array($this->utilizacentrocusto))
          {
              $x = 0; 
              $this->utilizacentrocusto_1 = $this->utilizacentrocusto;
              $this->utilizacentrocusto = ""; 
              if ($this->utilizacentrocusto_1 != "") 
              { 
                  foreach ($this->utilizacentrocusto_1 as $dados_utilizacentrocusto_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->utilizacentrocusto .= ";";
                      } 
                      $this->utilizacentrocusto .= $dados_utilizacentrocusto_1;
                      $x++ ; 
                  } 
              } 
          } 
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              Configuracao_Frm_pack_ajax_response();
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
          $_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  Configuracao_Frm_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_redir_atualiz'] == "ok")
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
          Configuracao_Frm_pack_ajax_response();
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
          Configuracao_Frm_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "Configuracao_Frm.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Configuração") ?></TITLE>
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
<form name="Fdown" method="get" action="Configuracao_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="Configuracao_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="Configuracao_Frm.php" target="_self" style="display: none"> 
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
include_once("Configuracao_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idconfiguracao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form']['idconfiguracao']))
          {
              $varloc_btn_php['idconfiguracao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form']['idconfiguracao'];
          }
      }
      $nm_f_saida = "Configuracao_Frm.php";
      nm_limpa_numero($this->diasprevisaocartaocreditoint, $this->field_config['diasprevisaocartaocreditoint']['symbol_grp']) ; 
      nm_limpa_numero($this->diasprevisaocartaodebitoint, $this->field_config['diasprevisaocartaodebitoint']['symbol_grp']) ; 
      if (!empty($this->field_config['taxaservicocartaocreditoint']['symbol_dec']))
      {
          nm_limpa_valor($this->taxaservicocartaocreditoint, $this->field_config['taxaservicocartaocreditoint']['symbol_dec'], $this->field_config['taxaservicocartaocreditoint']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['taxaservicocartaodebitoint']['symbol_dec']))
      {
          nm_limpa_valor($this->taxaservicocartaodebitoint, $this->field_config['taxaservicocartaodebitoint']['symbol_dec'], $this->field_config['taxaservicocartaodebitoint']['symbol_grp']) ; 
      }
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button Auditoria ------*/
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  $posicao = strpos($this->Ini->nm_cod_apl, '_');
$nomeTabela =  strtolower(substr($this->Ini->nm_cod_apl, 0, $posicao));	
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('AuditoriaRegistro_Lst') . "/AuditoriaRegistro_Lst.php", $this->nm_location, "varIdTenacidade?#?" . NM_encode_input($this->sc_temp_varIdTenacidade) . "?@?" . "varNomeTabelaAuditoria?#?" . NM_encode_input($nomeTabela) . "?@?" . "varValorIdChavePrimariaAuditoria?#?" . NM_encode_input($this->idconfiguracao ) . "?@?","_self", '', 440, 630);
 };
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button Auditoria ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idconfiguracao" value="<?php echo $this->form_encode_input($this->idconfiguracao) ?>"/>
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
include_once("Configuracao_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "Configuracao_Frm.php";
      nm_limpa_numero($this->diasprevisaocartaocreditoint, $this->field_config['diasprevisaocartaocreditoint']['symbol_grp']) ; 
      nm_limpa_numero($this->diasprevisaocartaodebitoint, $this->field_config['diasprevisaocartaodebitoint']['symbol_grp']) ; 
      if (!empty($this->field_config['taxaservicocartaocreditoint']['symbol_dec']))
      {
          nm_limpa_valor($this->taxaservicocartaocreditoint, $this->field_config['taxaservicocartaocreditoint']['symbol_dec'], $this->field_config['taxaservicocartaocreditoint']['symbol_grp']) ; 
      }
      if (!empty($this->field_config['taxaservicocartaodebitoint']['symbol_dec']))
      {
          nm_limpa_valor($this->taxaservicocartaodebitoint, $this->field_config['taxaservicocartaodebitoint']['symbol_dec'], $this->field_config['taxaservicocartaodebitoint']['symbol_grp']) ; 
      }
      
/*----- Scriptcase Locale: Button sc_btn_0 ------*/
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
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
   $sErrorIndex = 'geral_Configuracao_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_Configuracao_Frm';
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
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button sc_btn_0 ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idconfiguracao" value="<?php echo $this->form_encode_input($this->idconfiguracao) ?>"/>
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
           case 'clienteativo':
               return "Cliente ativo";
               break;
           case 'gravarauditoria':
               return "Gravar auditoria";
               break;
           case 'integracaoinfolabativa':
               return "Integração InfoLAB";
               break;
           case 'usataxaadiantamento':
               return "Usa Taxa Adiantamento";
               break;
           case 'recebeparcelado':
               return "Recebe Parcelado (CC)";
               break;
           case 'utilizacentrocusto':
               return "Utiliza Centro de custo";
               break;
           case 'urlsaida':
               return "URL de saída ";
               break;
           case 'clienteconcorrente':
               return "Cliente Concorrente";
               break;
           case 'notafiscalobrigatorio':
               return "Nota Fiscal Obrigatório";
               break;
           case 'coletadomiciliar':
               return "Coleta Domiciliar";
               break;
           case 'diretorioexportacao':
               return "Diretorio para exportação";
               break;
           case 'diretorioarquivo':
               return "Diretorio Arquivo";
               break;
           case 'diasprevisaocartaocreditoint':
               return "Qtd. Dias - Cartão de Crédito";
               break;
           case 'diasprevisaocartaodebitoint':
               return "Qtd. Dias - Cartão de Débito";
               break;
           case 'taxaservicocartaocreditoint':
               return "Taxa de Serviço - Cartão de Crédito";
               break;
           case 'taxaservicocartaodebitoint':
               return "Taxa de Serviço - Cartão de Débito";
               break;
           case 'relacaocadastros':
               return "Relação de cadastros";
               break;
           case 'relacaomodulos':
               return "Relação de módulos";
               break;
           case 'contratolicenca':
               return "Contrato de licença de uso";
               break;
           case 'servidorsmtp':
               return "Servidor";
               break;
           case 'usuariosmtp':
               return "Usuário";
               break;
           case 'senhasmtp':
               return "Senha";
               break;
           case 'remetente':
               return "Remetente ";
               break;
           case 'assunto':
               return "Assunto ";
               break;
           case 'msgenviosenha':
               return "Mensagem";
               break;
           case 'usuariosms':
               return "Usuario SMS";
               break;
           case 'senhasms':
               return "Senha SMS";
               break;
           case 'servidorpdf':
               return "Servidor";
               break;
           case 'diretoriopdf':
               return "Diretório";
               break;
           case 'idplanocontalancamentoreceitanotafiscal':
               return "Lançamento Contas a Receber (Receitas)";
               break;
           case 'idplanocontatransferenciaorigem':
               return "Tranferência Origem";
               break;
           case 'idplanocontatransferenciadestino':
               return "Transferência Destino";
               break;
           case 'idplanocontadinheiroint':
               return "Dinheiro";
               break;
           case 'idplanocontaguiaint':
               return "Guia";
               break;
           case 'idplanocontachequeint':
               return "Cheque";
               break;
           case 'idplanocontacartaocreditoint':
               return "Cartão de Crédito";
               break;
           case 'idplanocontacartaodebitoint':
               return "Cartão de Débito";
               break;
           case 'idcontacaixalancamentoreceitanotafiscal':
               return "Lançamento Contas a Receber Nota Fiscal";
               break;
           case 'idcontacaixaint':
               return "Conta Caixa Padrão";
               break;
           case 'idcontacaixacartao':
               return "Conta Caixa Cartões";
               break;
           case 'idsituacaonovoclienteint':
               return "Situação do Novo Cliente";
               break;
           case 'idsituacaodocumentopendenteint':
               return "Pendente";
               break;
           case 'idsituacaodocumentoexcluidoint':
               return "Excluído";
               break;
           case 'idsituacaodocumentobaixadoint':
               return "Baixado";
               break;
           case 'idtipoespecielancamentoreceitanotafiscal':
               return "Receita Nota Fiscal";
               break;
           case 'idtipoespecietransferencia':
               return "Transferência";
               break;
           case 'idtipoespeciecartaocreditoint':
               return "Cartão de Crédito";
               break;
           case 'idtipoespecieguiaint':
               return "Guia";
               break;
           case 'idtipoespeciechequeint':
               return "Cheque";
               break;
           case 'idtipoespeciedinheiroint':
               return "Dinheiro";
               break;
           case 'idtipoespeciecartaodebitoint':
               return "Cartão de Débito";
               break;
           case 'imagemfoto':
               return "Arquivo";
               break;
           case 'idconfiguracao':
               return "Id.";
               break;
           case 'idtenacidade':
               return "Empresa";
               break;
           case 'idusuarioauditoria':
               return "Id Usuario Auditoria";
               break;
           case 'anonotafiscal':
               return "Ano Nota Fiscal";
               break;
           case 'sequencialnotafiscal':
               return "Sequencial Nota Fiscal";
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
      if ((!is_array($filtro) && ('' == $filtro || 'clienteativo' == $filtro)) || (is_array($filtro) && in_array('clienteativo', $filtro)))
        $this->ValidateField_clienteativo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'gravarauditoria' == $filtro)) || (is_array($filtro) && in_array('gravarauditoria', $filtro)))
        $this->ValidateField_gravarauditoria($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'integracaoinfolabativa' == $filtro)) || (is_array($filtro) && in_array('integracaoinfolabativa', $filtro)))
        $this->ValidateField_integracaoinfolabativa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'usataxaadiantamento' == $filtro)) || (is_array($filtro) && in_array('usataxaadiantamento', $filtro)))
        $this->ValidateField_usataxaadiantamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'recebeparcelado' == $filtro)) || (is_array($filtro) && in_array('recebeparcelado', $filtro)))
        $this->ValidateField_recebeparcelado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'utilizacentrocusto' == $filtro)) || (is_array($filtro) && in_array('utilizacentrocusto', $filtro)))
        $this->ValidateField_utilizacentrocusto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'urlsaida' == $filtro)) || (is_array($filtro) && in_array('urlsaida', $filtro)))
        $this->ValidateField_urlsaida($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'clienteconcorrente' == $filtro)) || (is_array($filtro) && in_array('clienteconcorrente', $filtro)))
        $this->ValidateField_clienteconcorrente($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'notafiscalobrigatorio' == $filtro)) || (is_array($filtro) && in_array('notafiscalobrigatorio', $filtro)))
        $this->ValidateField_notafiscalobrigatorio($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'coletadomiciliar' == $filtro)) || (is_array($filtro) && in_array('coletadomiciliar', $filtro)))
        $this->ValidateField_coletadomiciliar($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'diretorioexportacao' == $filtro)) || (is_array($filtro) && in_array('diretorioexportacao', $filtro)))
        $this->ValidateField_diretorioexportacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'diretorioarquivo' == $filtro)) || (is_array($filtro) && in_array('diretorioarquivo', $filtro)))
        $this->ValidateField_diretorioarquivo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'diasprevisaocartaocreditoint' == $filtro)) || (is_array($filtro) && in_array('diasprevisaocartaocreditoint', $filtro)))
        $this->ValidateField_diasprevisaocartaocreditoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'diasprevisaocartaodebitoint' == $filtro)) || (is_array($filtro) && in_array('diasprevisaocartaodebitoint', $filtro)))
        $this->ValidateField_diasprevisaocartaodebitoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'taxaservicocartaocreditoint' == $filtro)) || (is_array($filtro) && in_array('taxaservicocartaocreditoint', $filtro)))
        $this->ValidateField_taxaservicocartaocreditoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'taxaservicocartaodebitoint' == $filtro)) || (is_array($filtro) && in_array('taxaservicocartaodebitoint', $filtro)))
        $this->ValidateField_taxaservicocartaodebitoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'relacaocadastros' == $filtro)) || (is_array($filtro) && in_array('relacaocadastros', $filtro)))
        $this->ValidateField_relacaocadastros($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'relacaomodulos' == $filtro)) || (is_array($filtro) && in_array('relacaomodulos', $filtro)))
        $this->ValidateField_relacaomodulos($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'contratolicenca' == $filtro)) || (is_array($filtro) && in_array('contratolicenca', $filtro)))
        $this->ValidateField_contratolicenca($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'servidorsmtp' == $filtro)) || (is_array($filtro) && in_array('servidorsmtp', $filtro)))
        $this->ValidateField_servidorsmtp($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'usuariosmtp' == $filtro)) || (is_array($filtro) && in_array('usuariosmtp', $filtro)))
        $this->ValidateField_usuariosmtp($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'senhasmtp' == $filtro)) || (is_array($filtro) && in_array('senhasmtp', $filtro)))
        $this->ValidateField_senhasmtp($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'remetente' == $filtro)) || (is_array($filtro) && in_array('remetente', $filtro)))
        $this->ValidateField_remetente($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'assunto' == $filtro)) || (is_array($filtro) && in_array('assunto', $filtro)))
        $this->ValidateField_assunto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'msgenviosenha' == $filtro)) || (is_array($filtro) && in_array('msgenviosenha', $filtro)))
        $this->ValidateField_msgenviosenha($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'usuariosms' == $filtro)) || (is_array($filtro) && in_array('usuariosms', $filtro)))
        $this->ValidateField_usuariosms($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'senhasms' == $filtro)) || (is_array($filtro) && in_array('senhasms', $filtro)))
        $this->ValidateField_senhasms($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'servidorpdf' == $filtro)) || (is_array($filtro) && in_array('servidorpdf', $filtro)))
        $this->ValidateField_servidorpdf($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'diretoriopdf' == $filtro)) || (is_array($filtro) && in_array('diretoriopdf', $filtro)))
        $this->ValidateField_diretoriopdf($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontalancamentoreceitanotafiscal' == $filtro)) || (is_array($filtro) && in_array('idplanocontalancamentoreceitanotafiscal', $filtro)))
        $this->ValidateField_idplanocontalancamentoreceitanotafiscal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontatransferenciaorigem' == $filtro)) || (is_array($filtro) && in_array('idplanocontatransferenciaorigem', $filtro)))
        $this->ValidateField_idplanocontatransferenciaorigem($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontatransferenciadestino' == $filtro)) || (is_array($filtro) && in_array('idplanocontatransferenciadestino', $filtro)))
        $this->ValidateField_idplanocontatransferenciadestino($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontadinheiroint' == $filtro)) || (is_array($filtro) && in_array('idplanocontadinheiroint', $filtro)))
        $this->ValidateField_idplanocontadinheiroint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontaguiaint' == $filtro)) || (is_array($filtro) && in_array('idplanocontaguiaint', $filtro)))
        $this->ValidateField_idplanocontaguiaint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontachequeint' == $filtro)) || (is_array($filtro) && in_array('idplanocontachequeint', $filtro)))
        $this->ValidateField_idplanocontachequeint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontacartaocreditoint' == $filtro)) || (is_array($filtro) && in_array('idplanocontacartaocreditoint', $filtro)))
        $this->ValidateField_idplanocontacartaocreditoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idplanocontacartaodebitoint' == $filtro)) || (is_array($filtro) && in_array('idplanocontacartaodebitoint', $filtro)))
        $this->ValidateField_idplanocontacartaodebitoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcontacaixalancamentoreceitanotafiscal' == $filtro)) || (is_array($filtro) && in_array('idcontacaixalancamentoreceitanotafiscal', $filtro)))
        $this->ValidateField_idcontacaixalancamentoreceitanotafiscal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcontacaixaint' == $filtro)) || (is_array($filtro) && in_array('idcontacaixaint', $filtro)))
        $this->ValidateField_idcontacaixaint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcontacaixacartao' == $filtro)) || (is_array($filtro) && in_array('idcontacaixacartao', $filtro)))
        $this->ValidateField_idcontacaixacartao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idsituacaonovoclienteint' == $filtro)) || (is_array($filtro) && in_array('idsituacaonovoclienteint', $filtro)))
        $this->ValidateField_idsituacaonovoclienteint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idsituacaodocumentopendenteint' == $filtro)) || (is_array($filtro) && in_array('idsituacaodocumentopendenteint', $filtro)))
        $this->ValidateField_idsituacaodocumentopendenteint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idsituacaodocumentoexcluidoint' == $filtro)) || (is_array($filtro) && in_array('idsituacaodocumentoexcluidoint', $filtro)))
        $this->ValidateField_idsituacaodocumentoexcluidoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idsituacaodocumentobaixadoint' == $filtro)) || (is_array($filtro) && in_array('idsituacaodocumentobaixadoint', $filtro)))
        $this->ValidateField_idsituacaodocumentobaixadoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipoespecielancamentoreceitanotafiscal' == $filtro)) || (is_array($filtro) && in_array('idtipoespecielancamentoreceitanotafiscal', $filtro)))
        $this->ValidateField_idtipoespecielancamentoreceitanotafiscal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipoespecietransferencia' == $filtro)) || (is_array($filtro) && in_array('idtipoespecietransferencia', $filtro)))
        $this->ValidateField_idtipoespecietransferencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipoespeciecartaocreditoint' == $filtro)) || (is_array($filtro) && in_array('idtipoespeciecartaocreditoint', $filtro)))
        $this->ValidateField_idtipoespeciecartaocreditoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipoespecieguiaint' == $filtro)) || (is_array($filtro) && in_array('idtipoespecieguiaint', $filtro)))
        $this->ValidateField_idtipoespecieguiaint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipoespeciechequeint' == $filtro)) || (is_array($filtro) && in_array('idtipoespeciechequeint', $filtro)))
        $this->ValidateField_idtipoespeciechequeint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipoespeciedinheiroint' == $filtro)) || (is_array($filtro) && in_array('idtipoespeciedinheiroint', $filtro)))
        $this->ValidateField_idtipoespeciedinheiroint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idtipoespeciecartaodebitoint' == $filtro)) || (is_array($filtro) && in_array('idtipoespeciecartaodebitoint', $filtro)))
        $this->ValidateField_idtipoespeciecartaodebitoint($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'imagemfoto' == $filtro)) || (is_array($filtro) && in_array('imagemfoto', $filtro)))
        $this->ValidateField_imagemfoto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
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

    function ValidateField_clienteativo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['clienteativo'])) {
       return;
   }
      if ($this->clienteativo == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->clienteativo != "" && !in_array("clienteativo", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteativo']) && !in_array($this->clienteativo, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteativo']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['clienteativo']))
              {
                  $Campos_Erros['clienteativo'] = array();
              }
              $Campos_Erros['clienteativo'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['clienteativo']) || !is_array($this->NM_ajax_info['errList']['clienteativo']))
              {
                  $this->NM_ajax_info['errList']['clienteativo'] = array();
              }
              $this->NM_ajax_info['errList']['clienteativo'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'clienteativo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_clienteativo

    function ValidateField_gravarauditoria(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['gravarauditoria'])) {
       return;
   }
      if ($this->gravarauditoria == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      else 
      { 
          if (is_array($this->gravarauditoria))
          {
              $x = 0; 
              $this->gravarauditoria_1 = array(); 
              foreach ($this->gravarauditoria as $ind => $dados_gravarauditoria_1 ) 
              {
                  if ($dados_gravarauditoria_1 != "") 
                  {
                      $this->gravarauditoria_1[] = $dados_gravarauditoria_1;
                  } 
              } 
              $this->gravarauditoria = ""; 
              foreach ($this->gravarauditoria_1 as $dados_gravarauditoria_1 ) 
              { 
                   if ($x != 0)
                   { 
                       $this->gravarauditoria .= ";";
                   } 
                   $this->gravarauditoria .= $dados_gravarauditoria_1;
                   $x++ ; 
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'gravarauditoria';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_gravarauditoria

    function ValidateField_integracaoinfolabativa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['integracaoinfolabativa'])) {
       return;
   }
      if ($this->integracaoinfolabativa == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->integracaoinfolabativa != "" && !in_array("integracaoinfolabativa", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_integracaoinfolabativa']) && !in_array($this->integracaoinfolabativa, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_integracaoinfolabativa']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['integracaoinfolabativa']))
              {
                  $Campos_Erros['integracaoinfolabativa'] = array();
              }
              $Campos_Erros['integracaoinfolabativa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['integracaoinfolabativa']) || !is_array($this->NM_ajax_info['errList']['integracaoinfolabativa']))
              {
                  $this->NM_ajax_info['errList']['integracaoinfolabativa'] = array();
              }
              $this->NM_ajax_info['errList']['integracaoinfolabativa'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'integracaoinfolabativa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_integracaoinfolabativa

    function ValidateField_usataxaadiantamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['usataxaadiantamento'])) {
       return;
   }
      if ($this->usataxaadiantamento == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->usataxaadiantamento != "" && !in_array("usataxaadiantamento", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_usataxaadiantamento']) && !in_array($this->usataxaadiantamento, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_usataxaadiantamento']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['usataxaadiantamento']))
              {
                  $Campos_Erros['usataxaadiantamento'] = array();
              }
              $Campos_Erros['usataxaadiantamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['usataxaadiantamento']) || !is_array($this->NM_ajax_info['errList']['usataxaadiantamento']))
              {
                  $this->NM_ajax_info['errList']['usataxaadiantamento'] = array();
              }
              $this->NM_ajax_info['errList']['usataxaadiantamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'usataxaadiantamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_usataxaadiantamento

    function ValidateField_recebeparcelado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['recebeparcelado'])) {
       return;
   }
      if ($this->recebeparcelado == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->recebeparcelado != "" && !in_array("recebeparcelado", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_recebeparcelado']) && !in_array($this->recebeparcelado, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_recebeparcelado']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['recebeparcelado']))
              {
                  $Campos_Erros['recebeparcelado'] = array();
              }
              $Campos_Erros['recebeparcelado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['recebeparcelado']) || !is_array($this->NM_ajax_info['errList']['recebeparcelado']))
              {
                  $this->NM_ajax_info['errList']['recebeparcelado'] = array();
              }
              $this->NM_ajax_info['errList']['recebeparcelado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'recebeparcelado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_recebeparcelado

    function ValidateField_utilizacentrocusto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['utilizacentrocusto'])) {
       return;
   }
      if ($this->utilizacentrocusto == "" && $this->nmgp_opcao != "excluir")
      { 
          $this->utilizacentrocusto = "N";
      } 
      else 
      { 
          if (is_array($this->utilizacentrocusto))
          {
              $x = 0; 
              $this->utilizacentrocusto_1 = array(); 
              foreach ($this->utilizacentrocusto as $ind => $dados_utilizacentrocusto_1 ) 
              {
                  if ($dados_utilizacentrocusto_1 != "") 
                  {
                      $this->utilizacentrocusto_1[] = $dados_utilizacentrocusto_1;
                  } 
              } 
              $this->utilizacentrocusto = ""; 
              foreach ($this->utilizacentrocusto_1 as $dados_utilizacentrocusto_1 ) 
              { 
                   if ($x != 0)
                   { 
                       $this->utilizacentrocusto .= ";";
                   } 
                   $this->utilizacentrocusto .= $dados_utilizacentrocusto_1;
                   $x++ ; 
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'utilizacentrocusto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_utilizacentrocusto

    function ValidateField_urlsaida(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['urlsaida'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['urlsaida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['urlsaida'] == "on")) 
      { 
          if ($this->urlsaida == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "URL de saída " ; 
              if (!isset($Campos_Erros['urlsaida']))
              {
                  $Campos_Erros['urlsaida'] = array();
              }
              $Campos_Erros['urlsaida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['urlsaida']) || !is_array($this->NM_ajax_info['errList']['urlsaida']))
                  {
                      $this->NM_ajax_info['errList']['urlsaida'] = array();
                  }
                  $this->NM_ajax_info['errList']['urlsaida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->urlsaida) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "URL de saída  " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['urlsaida']))
              {
                  $Campos_Erros['urlsaida'] = array();
              }
              $Campos_Erros['urlsaida'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['urlsaida']) || !is_array($this->NM_ajax_info['errList']['urlsaida']))
              {
                  $this->NM_ajax_info['errList']['urlsaida'] = array();
              }
              $this->NM_ajax_info['errList']['urlsaida'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'urlsaida';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_urlsaida

    function ValidateField_clienteconcorrente(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['clienteconcorrente'])) {
       return;
   }
      if ($this->clienteconcorrente == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->clienteconcorrente != "" && !in_array("clienteconcorrente", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteconcorrente']) && !in_array($this->clienteconcorrente, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteconcorrente']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['clienteconcorrente']))
              {
                  $Campos_Erros['clienteconcorrente'] = array();
              }
              $Campos_Erros['clienteconcorrente'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['clienteconcorrente']) || !is_array($this->NM_ajax_info['errList']['clienteconcorrente']))
              {
                  $this->NM_ajax_info['errList']['clienteconcorrente'] = array();
              }
              $this->NM_ajax_info['errList']['clienteconcorrente'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'clienteconcorrente';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_clienteconcorrente

    function ValidateField_notafiscalobrigatorio(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['notafiscalobrigatorio'])) {
       return;
   }
      if ($this->notafiscalobrigatorio == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->notafiscalobrigatorio != "" && !in_array("notafiscalobrigatorio", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_notafiscalobrigatorio']) && !in_array($this->notafiscalobrigatorio, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_notafiscalobrigatorio']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['notafiscalobrigatorio']))
              {
                  $Campos_Erros['notafiscalobrigatorio'] = array();
              }
              $Campos_Erros['notafiscalobrigatorio'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['notafiscalobrigatorio']) || !is_array($this->NM_ajax_info['errList']['notafiscalobrigatorio']))
              {
                  $this->NM_ajax_info['errList']['notafiscalobrigatorio'] = array();
              }
              $this->NM_ajax_info['errList']['notafiscalobrigatorio'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'notafiscalobrigatorio';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_notafiscalobrigatorio

    function ValidateField_coletadomiciliar(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['coletadomiciliar'])) {
       return;
   }
      if ($this->coletadomiciliar == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->coletadomiciliar != "" && !in_array("coletadomiciliar", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_coletadomiciliar']) && !in_array($this->coletadomiciliar, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_coletadomiciliar']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['coletadomiciliar']))
              {
                  $Campos_Erros['coletadomiciliar'] = array();
              }
              $Campos_Erros['coletadomiciliar'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['coletadomiciliar']) || !is_array($this->NM_ajax_info['errList']['coletadomiciliar']))
              {
                  $this->NM_ajax_info['errList']['coletadomiciliar'] = array();
              }
              $this->NM_ajax_info['errList']['coletadomiciliar'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'coletadomiciliar';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_coletadomiciliar

    function ValidateField_diretorioexportacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['diretorioexportacao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->diretorioexportacao) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Diretorio para exportação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['diretorioexportacao']))
              {
                  $Campos_Erros['diretorioexportacao'] = array();
              }
              $Campos_Erros['diretorioexportacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['diretorioexportacao']) || !is_array($this->NM_ajax_info['errList']['diretorioexportacao']))
              {
                  $this->NM_ajax_info['errList']['diretorioexportacao'] = array();
              }
              $this->NM_ajax_info['errList']['diretorioexportacao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'diretorioexportacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_diretorioexportacao

    function ValidateField_diretorioarquivo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['diretorioarquivo'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->diretorioarquivo) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Diretorio Arquivo " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['diretorioarquivo']))
              {
                  $Campos_Erros['diretorioarquivo'] = array();
              }
              $Campos_Erros['diretorioarquivo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['diretorioarquivo']) || !is_array($this->NM_ajax_info['errList']['diretorioarquivo']))
              {
                  $this->NM_ajax_info['errList']['diretorioarquivo'] = array();
              }
              $this->NM_ajax_info['errList']['diretorioarquivo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'diretorioarquivo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_diretorioarquivo

    function ValidateField_diasprevisaocartaocreditoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['diasprevisaocartaocreditoint'])) {
          nm_limpa_numero($this->diasprevisaocartaocreditoint, $this->field_config['diasprevisaocartaocreditoint']['symbol_grp']) ; 
          return;
      }
      if ($this->diasprevisaocartaocreditoint === "" || is_null($this->diasprevisaocartaocreditoint))  
      { 
          $this->diasprevisaocartaocreditoint = 0;
          $this->sc_force_zero[] = 'diasprevisaocartaocreditoint';
      } 
      nm_limpa_numero($this->diasprevisaocartaocreditoint, $this->field_config['diasprevisaocartaocreditoint']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->diasprevisaocartaocreditoint != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->diasprevisaocartaocreditoint) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. Dias - Cartão de Crédito: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['diasprevisaocartaocreditoint']))
                  {
                      $Campos_Erros['diasprevisaocartaocreditoint'] = array();
                  }
                  $Campos_Erros['diasprevisaocartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['diasprevisaocartaocreditoint']) || !is_array($this->NM_ajax_info['errList']['diasprevisaocartaocreditoint']))
                  {
                      $this->NM_ajax_info['errList']['diasprevisaocartaocreditoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['diasprevisaocartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->diasprevisaocartaocreditoint, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. Dias - Cartão de Crédito; " ; 
                  if (!isset($Campos_Erros['diasprevisaocartaocreditoint']))
                  {
                      $Campos_Erros['diasprevisaocartaocreditoint'] = array();
                  }
                  $Campos_Erros['diasprevisaocartaocreditoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['diasprevisaocartaocreditoint']) || !is_array($this->NM_ajax_info['errList']['diasprevisaocartaocreditoint']))
                  {
                      $this->NM_ajax_info['errList']['diasprevisaocartaocreditoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['diasprevisaocartaocreditoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'diasprevisaocartaocreditoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_diasprevisaocartaocreditoint

    function ValidateField_diasprevisaocartaodebitoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['diasprevisaocartaodebitoint'])) {
          nm_limpa_numero($this->diasprevisaocartaodebitoint, $this->field_config['diasprevisaocartaodebitoint']['symbol_grp']) ; 
          return;
      }
      if ($this->diasprevisaocartaodebitoint === "" || is_null($this->diasprevisaocartaodebitoint))  
      { 
          $this->diasprevisaocartaodebitoint = 0;
          $this->sc_force_zero[] = 'diasprevisaocartaodebitoint';
      } 
      nm_limpa_numero($this->diasprevisaocartaodebitoint, $this->field_config['diasprevisaocartaodebitoint']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->diasprevisaocartaodebitoint != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->diasprevisaocartaodebitoint) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. Dias - Cartão de Débito: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['diasprevisaocartaodebitoint']))
                  {
                      $Campos_Erros['diasprevisaocartaodebitoint'] = array();
                  }
                  $Campos_Erros['diasprevisaocartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['diasprevisaocartaodebitoint']) || !is_array($this->NM_ajax_info['errList']['diasprevisaocartaodebitoint']))
                  {
                      $this->NM_ajax_info['errList']['diasprevisaocartaodebitoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['diasprevisaocartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->diasprevisaocartaodebitoint, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. Dias - Cartão de Débito; " ; 
                  if (!isset($Campos_Erros['diasprevisaocartaodebitoint']))
                  {
                      $Campos_Erros['diasprevisaocartaodebitoint'] = array();
                  }
                  $Campos_Erros['diasprevisaocartaodebitoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['diasprevisaocartaodebitoint']) || !is_array($this->NM_ajax_info['errList']['diasprevisaocartaodebitoint']))
                  {
                      $this->NM_ajax_info['errList']['diasprevisaocartaodebitoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['diasprevisaocartaodebitoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'diasprevisaocartaodebitoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_diasprevisaocartaodebitoint

    function ValidateField_taxaservicocartaocreditoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['taxaservicocartaocreditoint'])) {
          if (!empty($this->field_config['taxaservicocartaocreditoint']['symbol_dec'])) {
              nm_limpa_valor($this->taxaservicocartaocreditoint, $this->field_config['taxaservicocartaocreditoint']['symbol_dec'], $this->field_config['taxaservicocartaocreditoint']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->taxaservicocartaocreditoint === "" || is_null($this->taxaservicocartaocreditoint))  
      { 
          $this->taxaservicocartaocreditoint = 0;
          $this->sc_force_zero[] = 'taxaservicocartaocreditoint';
      } 
      if (!empty($this->field_config['taxaservicocartaocreditoint']['symbol_dec']))
      {
          nm_limpa_valor($this->taxaservicocartaocreditoint, $this->field_config['taxaservicocartaocreditoint']['symbol_dec'], $this->field_config['taxaservicocartaocreditoint']['symbol_grp']) ; 
          if ('.' == substr($this->taxaservicocartaocreditoint, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->taxaservicocartaocreditoint, 1)))
              {
                  $this->taxaservicocartaocreditoint = '';
              }
              else
              {
                  $this->taxaservicocartaocreditoint = '0' . $this->taxaservicocartaocreditoint;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->taxaservicocartaocreditoint != '')  
          { 
              $iTestSize = 13;
              if (strlen($this->taxaservicocartaocreditoint) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Taxa de Serviço - Cartão de Crédito: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['taxaservicocartaocreditoint']))
                  {
                      $Campos_Erros['taxaservicocartaocreditoint'] = array();
                  }
                  $Campos_Erros['taxaservicocartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['taxaservicocartaocreditoint']) || !is_array($this->NM_ajax_info['errList']['taxaservicocartaocreditoint']))
                  {
                      $this->NM_ajax_info['errList']['taxaservicocartaocreditoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['taxaservicocartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->taxaservicocartaocreditoint, 10, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Taxa de Serviço - Cartão de Crédito; " ; 
                  if (!isset($Campos_Erros['taxaservicocartaocreditoint']))
                  {
                      $Campos_Erros['taxaservicocartaocreditoint'] = array();
                  }
                  $Campos_Erros['taxaservicocartaocreditoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['taxaservicocartaocreditoint']) || !is_array($this->NM_ajax_info['errList']['taxaservicocartaocreditoint']))
                  {
                      $this->NM_ajax_info['errList']['taxaservicocartaocreditoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['taxaservicocartaocreditoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'taxaservicocartaocreditoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_taxaservicocartaocreditoint

    function ValidateField_taxaservicocartaodebitoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['taxaservicocartaodebitoint'])) {
          if (!empty($this->field_config['taxaservicocartaodebitoint']['symbol_dec'])) {
              nm_limpa_valor($this->taxaservicocartaodebitoint, $this->field_config['taxaservicocartaodebitoint']['symbol_dec'], $this->field_config['taxaservicocartaodebitoint']['symbol_grp']) ; 
          }
          return;
      }
      if ($this->taxaservicocartaodebitoint === "" || is_null($this->taxaservicocartaodebitoint))  
      { 
          $this->taxaservicocartaodebitoint = 0;
          $this->sc_force_zero[] = 'taxaservicocartaodebitoint';
      } 
      if (!empty($this->field_config['taxaservicocartaodebitoint']['symbol_dec']))
      {
          nm_limpa_valor($this->taxaservicocartaodebitoint, $this->field_config['taxaservicocartaodebitoint']['symbol_dec'], $this->field_config['taxaservicocartaodebitoint']['symbol_grp']) ; 
          if ('.' == substr($this->taxaservicocartaodebitoint, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->taxaservicocartaodebitoint, 1)))
              {
                  $this->taxaservicocartaodebitoint = '';
              }
              else
              {
                  $this->taxaservicocartaodebitoint = '0' . $this->taxaservicocartaodebitoint;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->taxaservicocartaodebitoint != '')  
          { 
              $iTestSize = 13;
              if (strlen($this->taxaservicocartaodebitoint) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Taxa de Serviço - Cartão de Débito: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['taxaservicocartaodebitoint']))
                  {
                      $Campos_Erros['taxaservicocartaodebitoint'] = array();
                  }
                  $Campos_Erros['taxaservicocartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['taxaservicocartaodebitoint']) || !is_array($this->NM_ajax_info['errList']['taxaservicocartaodebitoint']))
                  {
                      $this->NM_ajax_info['errList']['taxaservicocartaodebitoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['taxaservicocartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->taxaservicocartaodebitoint, 10, 2, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Taxa de Serviço - Cartão de Débito; " ; 
                  if (!isset($Campos_Erros['taxaservicocartaodebitoint']))
                  {
                      $Campos_Erros['taxaservicocartaodebitoint'] = array();
                  }
                  $Campos_Erros['taxaservicocartaodebitoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['taxaservicocartaodebitoint']) || !is_array($this->NM_ajax_info['errList']['taxaservicocartaodebitoint']))
                  {
                      $this->NM_ajax_info['errList']['taxaservicocartaodebitoint'] = array();
                  }
                  $this->NM_ajax_info['errList']['taxaservicocartaodebitoint'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'taxaservicocartaodebitoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_taxaservicocartaodebitoint

    function ValidateField_relacaocadastros(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['relacaocadastros'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->relacaocadastros) > 500) 
          { 
              $hasError = true;
              $Campos_Crit .= "Relação de cadastros " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 500 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['relacaocadastros']))
              {
                  $Campos_Erros['relacaocadastros'] = array();
              }
              $Campos_Erros['relacaocadastros'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 500 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['relacaocadastros']) || !is_array($this->NM_ajax_info['errList']['relacaocadastros']))
              {
                  $this->NM_ajax_info['errList']['relacaocadastros'] = array();
              }
              $this->NM_ajax_info['errList']['relacaocadastros'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 500 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'relacaocadastros';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_relacaocadastros

    function ValidateField_relacaomodulos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['relacaomodulos'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->relacaomodulos) > 500) 
          { 
              $hasError = true;
              $Campos_Crit .= "Relação de módulos " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 500 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['relacaomodulos']))
              {
                  $Campos_Erros['relacaomodulos'] = array();
              }
              $Campos_Erros['relacaomodulos'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 500 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['relacaomodulos']) || !is_array($this->NM_ajax_info['errList']['relacaomodulos']))
              {
                  $this->NM_ajax_info['errList']['relacaomodulos'] = array();
              }
              $this->NM_ajax_info['errList']['relacaomodulos'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 500 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'relacaomodulos';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_relacaomodulos

    function ValidateField_contratolicenca(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['contratolicenca'])) {
          return;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($this->contratolicenca))
      {
          $this->contratolicenca = NM_conv_charset($this->contratolicenca, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $this->contratolicenca = sc_html_entity_decode($this->contratolicenca);
      $this->contratolicenca = str_replace("<p>" . chr(160) . "</p>", "<p></p>", $this->contratolicenca);
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->contratolicenca) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'contratolicenca';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_contratolicenca

    function ValidateField_servidorsmtp(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['servidorsmtp'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['servidorsmtp']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['servidorsmtp'] == "on")) 
      { 
          if ($this->servidorsmtp == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Servidor" ; 
              if (!isset($Campos_Erros['servidorsmtp']))
              {
                  $Campos_Erros['servidorsmtp'] = array();
              }
              $Campos_Erros['servidorsmtp'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['servidorsmtp']) || !is_array($this->NM_ajax_info['errList']['servidorsmtp']))
                  {
                      $this->NM_ajax_info['errList']['servidorsmtp'] = array();
                  }
                  $this->NM_ajax_info['errList']['servidorsmtp'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->servidorsmtp) > 60) 
          { 
              $hasError = true;
              $Campos_Crit .= "Servidor " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['servidorsmtp']))
              {
                  $Campos_Erros['servidorsmtp'] = array();
              }
              $Campos_Erros['servidorsmtp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['servidorsmtp']) || !is_array($this->NM_ajax_info['errList']['servidorsmtp']))
              {
                  $this->NM_ajax_info['errList']['servidorsmtp'] = array();
              }
              $this->NM_ajax_info['errList']['servidorsmtp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'servidorsmtp';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_servidorsmtp

    function ValidateField_usuariosmtp(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['usuariosmtp'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['usuariosmtp']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['usuariosmtp'] == "on")) 
      { 
          if ($this->usuariosmtp == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Usuário" ; 
              if (!isset($Campos_Erros['usuariosmtp']))
              {
                  $Campos_Erros['usuariosmtp'] = array();
              }
              $Campos_Erros['usuariosmtp'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['usuariosmtp']) || !is_array($this->NM_ajax_info['errList']['usuariosmtp']))
                  {
                      $this->NM_ajax_info['errList']['usuariosmtp'] = array();
                  }
                  $this->NM_ajax_info['errList']['usuariosmtp'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->usuariosmtp) > 60) 
          { 
              $hasError = true;
              $Campos_Crit .= "Usuário " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['usuariosmtp']))
              {
                  $Campos_Erros['usuariosmtp'] = array();
              }
              $Campos_Erros['usuariosmtp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['usuariosmtp']) || !is_array($this->NM_ajax_info['errList']['usuariosmtp']))
              {
                  $this->NM_ajax_info['errList']['usuariosmtp'] = array();
              }
              $this->NM_ajax_info['errList']['usuariosmtp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'usuariosmtp';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_usuariosmtp

    function ValidateField_senhasmtp(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['senhasmtp'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->senhasmtp) > 60) 
          { 
              $hasError = true;
              $Campos_Crit .= "Senha " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['senhasmtp']))
              {
                  $Campos_Erros['senhasmtp'] = array();
              }
              $Campos_Erros['senhasmtp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['senhasmtp']) || !is_array($this->NM_ajax_info['errList']['senhasmtp']))
              {
                  $this->NM_ajax_info['errList']['senhasmtp'] = array();
              }
              $this->NM_ajax_info['errList']['senhasmtp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'senhasmtp';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_senhasmtp

    function ValidateField_remetente(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['remetente'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['remetente']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['remetente'] == "on")) 
      { 
          if ($this->remetente == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Remetente " ; 
              if (!isset($Campos_Erros['remetente']))
              {
                  $Campos_Erros['remetente'] = array();
              }
              $Campos_Erros['remetente'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['remetente']) || !is_array($this->NM_ajax_info['errList']['remetente']))
                  {
                      $this->NM_ajax_info['errList']['remetente'] = array();
                  }
                  $this->NM_ajax_info['errList']['remetente'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->remetente) > 60) 
          { 
              $hasError = true;
              $Campos_Crit .= "Remetente  " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['remetente']))
              {
                  $Campos_Erros['remetente'] = array();
              }
              $Campos_Erros['remetente'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['remetente']) || !is_array($this->NM_ajax_info['errList']['remetente']))
              {
                  $this->NM_ajax_info['errList']['remetente'] = array();
              }
              $this->NM_ajax_info['errList']['remetente'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'remetente';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_remetente

    function ValidateField_assunto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['assunto'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['assunto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['php_cmp_required']['assunto'] == "on")) 
      { 
          if ($this->assunto == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Assunto " ; 
              if (!isset($Campos_Erros['assunto']))
              {
                  $Campos_Erros['assunto'] = array();
              }
              $Campos_Erros['assunto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['assunto']) || !is_array($this->NM_ajax_info['errList']['assunto']))
                  {
                      $this->NM_ajax_info['errList']['assunto'] = array();
                  }
                  $this->NM_ajax_info['errList']['assunto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->assunto) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Assunto  " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['assunto']))
              {
                  $Campos_Erros['assunto'] = array();
              }
              $Campos_Erros['assunto'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['assunto']) || !is_array($this->NM_ajax_info['errList']['assunto']))
              {
                  $this->NM_ajax_info['errList']['assunto'] = array();
              }
              $this->NM_ajax_info['errList']['assunto'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'assunto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_assunto

    function ValidateField_msgenviosenha(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['msgenviosenha'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->msgenviosenha) > 32767) 
          { 
              $hasError = true;
              $Campos_Crit .= "Mensagem " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['msgenviosenha']))
              {
                  $Campos_Erros['msgenviosenha'] = array();
              }
              $Campos_Erros['msgenviosenha'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['msgenviosenha']) || !is_array($this->NM_ajax_info['errList']['msgenviosenha']))
              {
                  $this->NM_ajax_info['errList']['msgenviosenha'] = array();
              }
              $this->NM_ajax_info['errList']['msgenviosenha'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'msgenviosenha';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_msgenviosenha

    function ValidateField_usuariosms(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['usuariosms'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->usuariosms) > 32) 
          { 
              $hasError = true;
              $Campos_Crit .= "Usuario SMS " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['usuariosms']))
              {
                  $Campos_Erros['usuariosms'] = array();
              }
              $Campos_Erros['usuariosms'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['usuariosms']) || !is_array($this->NM_ajax_info['errList']['usuariosms']))
              {
                  $this->NM_ajax_info['errList']['usuariosms'] = array();
              }
              $this->NM_ajax_info['errList']['usuariosms'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'usuariosms';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_usuariosms

    function ValidateField_senhasms(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['senhasms'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->senhasms) > 32) 
          { 
              $hasError = true;
              $Campos_Crit .= "Senha SMS " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['senhasms']))
              {
                  $Campos_Erros['senhasms'] = array();
              }
              $Campos_Erros['senhasms'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['senhasms']) || !is_array($this->NM_ajax_info['errList']['senhasms']))
              {
                  $this->NM_ajax_info['errList']['senhasms'] = array();
              }
              $this->NM_ajax_info['errList']['senhasms'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'senhasms';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_senhasms

    function ValidateField_servidorpdf(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['servidorpdf'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->servidorpdf) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Servidor " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['servidorpdf']))
              {
                  $Campos_Erros['servidorpdf'] = array();
              }
              $Campos_Erros['servidorpdf'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['servidorpdf']) || !is_array($this->NM_ajax_info['errList']['servidorpdf']))
              {
                  $this->NM_ajax_info['errList']['servidorpdf'] = array();
              }
              $this->NM_ajax_info['errList']['servidorpdf'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'servidorpdf';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_servidorpdf

    function ValidateField_diretoriopdf(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['diretoriopdf'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->diretoriopdf) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Diretório " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['diretoriopdf']))
              {
                  $Campos_Erros['diretoriopdf'] = array();
              }
              $Campos_Erros['diretoriopdf'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['diretoriopdf']) || !is_array($this->NM_ajax_info['errList']['diretoriopdf']))
              {
                  $this->NM_ajax_info['errList']['diretoriopdf'] = array();
              }
              $this->NM_ajax_info['errList']['diretoriopdf'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'diretoriopdf';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_diretoriopdf

    function ValidateField_idplanocontalancamentoreceitanotafiscal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontalancamentoreceitanotafiscal'])) {
       return;
   }
               if (!empty($this->idplanocontalancamentoreceitanotafiscal) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']) && !in_array($this->idplanocontalancamentoreceitanotafiscal, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontalancamentoreceitanotafiscal']))
                   {
                       $Campos_Erros['idplanocontalancamentoreceitanotafiscal'] = array();
                   }
                   $Campos_Erros['idplanocontalancamentoreceitanotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontalancamentoreceitanotafiscal']) || !is_array($this->NM_ajax_info['errList']['idplanocontalancamentoreceitanotafiscal']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontalancamentoreceitanotafiscal'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontalancamentoreceitanotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontalancamentoreceitanotafiscal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontalancamentoreceitanotafiscal

    function ValidateField_idplanocontatransferenciaorigem(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontatransferenciaorigem'])) {
       return;
   }
               if (!empty($this->idplanocontatransferenciaorigem) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']) && !in_array($this->idplanocontatransferenciaorigem, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontatransferenciaorigem']))
                   {
                       $Campos_Erros['idplanocontatransferenciaorigem'] = array();
                   }
                   $Campos_Erros['idplanocontatransferenciaorigem'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontatransferenciaorigem']) || !is_array($this->NM_ajax_info['errList']['idplanocontatransferenciaorigem']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontatransferenciaorigem'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontatransferenciaorigem'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontatransferenciaorigem';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontatransferenciaorigem

    function ValidateField_idplanocontatransferenciadestino(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontatransferenciadestino'])) {
       return;
   }
               if (!empty($this->idplanocontatransferenciadestino) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']) && !in_array($this->idplanocontatransferenciadestino, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontatransferenciadestino']))
                   {
                       $Campos_Erros['idplanocontatransferenciadestino'] = array();
                   }
                   $Campos_Erros['idplanocontatransferenciadestino'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontatransferenciadestino']) || !is_array($this->NM_ajax_info['errList']['idplanocontatransferenciadestino']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontatransferenciadestino'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontatransferenciadestino'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontatransferenciadestino';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontatransferenciadestino

    function ValidateField_idplanocontadinheiroint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontadinheiroint'])) {
       return;
   }
               if (!empty($this->idplanocontadinheiroint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']) && !in_array($this->idplanocontadinheiroint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontadinheiroint']))
                   {
                       $Campos_Erros['idplanocontadinheiroint'] = array();
                   }
                   $Campos_Erros['idplanocontadinheiroint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontadinheiroint']) || !is_array($this->NM_ajax_info['errList']['idplanocontadinheiroint']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontadinheiroint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontadinheiroint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontadinheiroint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontadinheiroint

    function ValidateField_idplanocontaguiaint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontaguiaint'])) {
       return;
   }
               if (!empty($this->idplanocontaguiaint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']) && !in_array($this->idplanocontaguiaint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontaguiaint']))
                   {
                       $Campos_Erros['idplanocontaguiaint'] = array();
                   }
                   $Campos_Erros['idplanocontaguiaint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontaguiaint']) || !is_array($this->NM_ajax_info['errList']['idplanocontaguiaint']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontaguiaint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontaguiaint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontaguiaint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontaguiaint

    function ValidateField_idplanocontachequeint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontachequeint'])) {
       return;
   }
               if (!empty($this->idplanocontachequeint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']) && !in_array($this->idplanocontachequeint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontachequeint']))
                   {
                       $Campos_Erros['idplanocontachequeint'] = array();
                   }
                   $Campos_Erros['idplanocontachequeint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontachequeint']) || !is_array($this->NM_ajax_info['errList']['idplanocontachequeint']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontachequeint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontachequeint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontachequeint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontachequeint

    function ValidateField_idplanocontacartaocreditoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontacartaocreditoint'])) {
       return;
   }
               if (!empty($this->idplanocontacartaocreditoint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']) && !in_array($this->idplanocontacartaocreditoint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontacartaocreditoint']))
                   {
                       $Campos_Erros['idplanocontacartaocreditoint'] = array();
                   }
                   $Campos_Erros['idplanocontacartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontacartaocreditoint']) || !is_array($this->NM_ajax_info['errList']['idplanocontacartaocreditoint']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontacartaocreditoint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontacartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontacartaocreditoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontacartaocreditoint

    function ValidateField_idplanocontacartaodebitoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idplanocontacartaodebitoint'])) {
       return;
   }
               if (!empty($this->idplanocontacartaodebitoint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']) && !in_array($this->idplanocontacartaodebitoint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idplanocontacartaodebitoint']))
                   {
                       $Campos_Erros['idplanocontacartaodebitoint'] = array();
                   }
                   $Campos_Erros['idplanocontacartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idplanocontacartaodebitoint']) || !is_array($this->NM_ajax_info['errList']['idplanocontacartaodebitoint']))
                   {
                       $this->NM_ajax_info['errList']['idplanocontacartaodebitoint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idplanocontacartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idplanocontacartaodebitoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idplanocontacartaodebitoint

    function ValidateField_idcontacaixalancamentoreceitanotafiscal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idcontacaixalancamentoreceitanotafiscal'])) {
       return;
   }
               if (!empty($this->idcontacaixalancamentoreceitanotafiscal) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']) && !in_array($this->idcontacaixalancamentoreceitanotafiscal, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idcontacaixalancamentoreceitanotafiscal']))
                   {
                       $Campos_Erros['idcontacaixalancamentoreceitanotafiscal'] = array();
                   }
                   $Campos_Erros['idcontacaixalancamentoreceitanotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idcontacaixalancamentoreceitanotafiscal']) || !is_array($this->NM_ajax_info['errList']['idcontacaixalancamentoreceitanotafiscal']))
                   {
                       $this->NM_ajax_info['errList']['idcontacaixalancamentoreceitanotafiscal'] = array();
                   }
                   $this->NM_ajax_info['errList']['idcontacaixalancamentoreceitanotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcontacaixalancamentoreceitanotafiscal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcontacaixalancamentoreceitanotafiscal

    function ValidateField_idcontacaixaint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idcontacaixaint'])) {
       return;
   }
               if (!empty($this->idcontacaixaint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']) && !in_array($this->idcontacaixaint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idcontacaixaint']))
                   {
                       $Campos_Erros['idcontacaixaint'] = array();
                   }
                   $Campos_Erros['idcontacaixaint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idcontacaixaint']) || !is_array($this->NM_ajax_info['errList']['idcontacaixaint']))
                   {
                       $this->NM_ajax_info['errList']['idcontacaixaint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idcontacaixaint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcontacaixaint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcontacaixaint

    function ValidateField_idcontacaixacartao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idcontacaixacartao'])) {
       return;
   }
               if (!empty($this->idcontacaixacartao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']) && !in_array($this->idcontacaixacartao, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idcontacaixacartao']))
                   {
                       $Campos_Erros['idcontacaixacartao'] = array();
                   }
                   $Campos_Erros['idcontacaixacartao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idcontacaixacartao']) || !is_array($this->NM_ajax_info['errList']['idcontacaixacartao']))
                   {
                       $this->NM_ajax_info['errList']['idcontacaixacartao'] = array();
                   }
                   $this->NM_ajax_info['errList']['idcontacaixacartao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcontacaixacartao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcontacaixacartao

    function ValidateField_idsituacaonovoclienteint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idsituacaonovoclienteint'])) {
       return;
   }
               if (!empty($this->idsituacaonovoclienteint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']) && !in_array($this->idsituacaonovoclienteint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idsituacaonovoclienteint']))
                   {
                       $Campos_Erros['idsituacaonovoclienteint'] = array();
                   }
                   $Campos_Erros['idsituacaonovoclienteint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idsituacaonovoclienteint']) || !is_array($this->NM_ajax_info['errList']['idsituacaonovoclienteint']))
                   {
                       $this->NM_ajax_info['errList']['idsituacaonovoclienteint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idsituacaonovoclienteint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idsituacaonovoclienteint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idsituacaonovoclienteint

    function ValidateField_idsituacaodocumentopendenteint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idsituacaodocumentopendenteint'])) {
       return;
   }
               if (!empty($this->idsituacaodocumentopendenteint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']) && !in_array($this->idsituacaodocumentopendenteint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idsituacaodocumentopendenteint']))
                   {
                       $Campos_Erros['idsituacaodocumentopendenteint'] = array();
                   }
                   $Campos_Erros['idsituacaodocumentopendenteint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idsituacaodocumentopendenteint']) || !is_array($this->NM_ajax_info['errList']['idsituacaodocumentopendenteint']))
                   {
                       $this->NM_ajax_info['errList']['idsituacaodocumentopendenteint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idsituacaodocumentopendenteint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idsituacaodocumentopendenteint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idsituacaodocumentopendenteint

    function ValidateField_idsituacaodocumentoexcluidoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idsituacaodocumentoexcluidoint'])) {
       return;
   }
               if (!empty($this->idsituacaodocumentoexcluidoint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']) && !in_array($this->idsituacaodocumentoexcluidoint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idsituacaodocumentoexcluidoint']))
                   {
                       $Campos_Erros['idsituacaodocumentoexcluidoint'] = array();
                   }
                   $Campos_Erros['idsituacaodocumentoexcluidoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idsituacaodocumentoexcluidoint']) || !is_array($this->NM_ajax_info['errList']['idsituacaodocumentoexcluidoint']))
                   {
                       $this->NM_ajax_info['errList']['idsituacaodocumentoexcluidoint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idsituacaodocumentoexcluidoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idsituacaodocumentoexcluidoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idsituacaodocumentoexcluidoint

    function ValidateField_idsituacaodocumentobaixadoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idsituacaodocumentobaixadoint'])) {
       return;
   }
               if (!empty($this->idsituacaodocumentobaixadoint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']) && !in_array($this->idsituacaodocumentobaixadoint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idsituacaodocumentobaixadoint']))
                   {
                       $Campos_Erros['idsituacaodocumentobaixadoint'] = array();
                   }
                   $Campos_Erros['idsituacaodocumentobaixadoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idsituacaodocumentobaixadoint']) || !is_array($this->NM_ajax_info['errList']['idsituacaodocumentobaixadoint']))
                   {
                       $this->NM_ajax_info['errList']['idsituacaodocumentobaixadoint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idsituacaodocumentobaixadoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idsituacaodocumentobaixadoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idsituacaodocumentobaixadoint

    function ValidateField_idtipoespecielancamentoreceitanotafiscal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipoespecielancamentoreceitanotafiscal'])) {
       return;
   }
               if (!empty($this->idtipoespecielancamentoreceitanotafiscal) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']) && !in_array($this->idtipoespecielancamentoreceitanotafiscal, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtipoespecielancamentoreceitanotafiscal']))
                   {
                       $Campos_Erros['idtipoespecielancamentoreceitanotafiscal'] = array();
                   }
                   $Campos_Erros['idtipoespecielancamentoreceitanotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtipoespecielancamentoreceitanotafiscal']) || !is_array($this->NM_ajax_info['errList']['idtipoespecielancamentoreceitanotafiscal']))
                   {
                       $this->NM_ajax_info['errList']['idtipoespecielancamentoreceitanotafiscal'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtipoespecielancamentoreceitanotafiscal'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipoespecielancamentoreceitanotafiscal';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipoespecielancamentoreceitanotafiscal

    function ValidateField_idtipoespecietransferencia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipoespecietransferencia'])) {
       return;
   }
               if (!empty($this->idtipoespecietransferencia) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']) && !in_array($this->idtipoespecietransferencia, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtipoespecietransferencia']))
                   {
                       $Campos_Erros['idtipoespecietransferencia'] = array();
                   }
                   $Campos_Erros['idtipoespecietransferencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtipoespecietransferencia']) || !is_array($this->NM_ajax_info['errList']['idtipoespecietransferencia']))
                   {
                       $this->NM_ajax_info['errList']['idtipoespecietransferencia'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtipoespecietransferencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipoespecietransferencia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipoespecietransferencia

    function ValidateField_idtipoespeciecartaocreditoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipoespeciecartaocreditoint'])) {
       return;
   }
               if (!empty($this->idtipoespeciecartaocreditoint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']) && !in_array($this->idtipoespeciecartaocreditoint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtipoespeciecartaocreditoint']))
                   {
                       $Campos_Erros['idtipoespeciecartaocreditoint'] = array();
                   }
                   $Campos_Erros['idtipoespeciecartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtipoespeciecartaocreditoint']) || !is_array($this->NM_ajax_info['errList']['idtipoespeciecartaocreditoint']))
                   {
                       $this->NM_ajax_info['errList']['idtipoespeciecartaocreditoint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtipoespeciecartaocreditoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipoespeciecartaocreditoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipoespeciecartaocreditoint

    function ValidateField_idtipoespecieguiaint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipoespecieguiaint'])) {
       return;
   }
               if (!empty($this->idtipoespecieguiaint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']) && !in_array($this->idtipoespecieguiaint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtipoespecieguiaint']))
                   {
                       $Campos_Erros['idtipoespecieguiaint'] = array();
                   }
                   $Campos_Erros['idtipoespecieguiaint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtipoespecieguiaint']) || !is_array($this->NM_ajax_info['errList']['idtipoespecieguiaint']))
                   {
                       $this->NM_ajax_info['errList']['idtipoespecieguiaint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtipoespecieguiaint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipoespecieguiaint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipoespecieguiaint

    function ValidateField_idtipoespeciechequeint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipoespeciechequeint'])) {
       return;
   }
               if (!empty($this->idtipoespeciechequeint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']) && !in_array($this->idtipoespeciechequeint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtipoespeciechequeint']))
                   {
                       $Campos_Erros['idtipoespeciechequeint'] = array();
                   }
                   $Campos_Erros['idtipoespeciechequeint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtipoespeciechequeint']) || !is_array($this->NM_ajax_info['errList']['idtipoespeciechequeint']))
                   {
                       $this->NM_ajax_info['errList']['idtipoespeciechequeint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtipoespeciechequeint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipoespeciechequeint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipoespeciechequeint

    function ValidateField_idtipoespeciedinheiroint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipoespeciedinheiroint'])) {
       return;
   }
               if (!empty($this->idtipoespeciedinheiroint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']) && !in_array($this->idtipoespeciedinheiroint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtipoespeciedinheiroint']))
                   {
                       $Campos_Erros['idtipoespeciedinheiroint'] = array();
                   }
                   $Campos_Erros['idtipoespeciedinheiroint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtipoespeciedinheiroint']) || !is_array($this->NM_ajax_info['errList']['idtipoespeciedinheiroint']))
                   {
                       $this->NM_ajax_info['errList']['idtipoespeciedinheiroint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtipoespeciedinheiroint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipoespeciedinheiroint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipoespeciedinheiroint

    function ValidateField_idtipoespeciecartaodebitoint(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idtipoespeciecartaodebitoint'])) {
       return;
   }
               if (!empty($this->idtipoespeciecartaodebitoint) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']) && !in_array($this->idtipoespeciecartaodebitoint, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idtipoespeciecartaodebitoint']))
                   {
                       $Campos_Erros['idtipoespeciecartaodebitoint'] = array();
                   }
                   $Campos_Erros['idtipoespeciecartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idtipoespeciecartaodebitoint']) || !is_array($this->NM_ajax_info['errList']['idtipoespeciecartaodebitoint']))
                   {
                       $this->NM_ajax_info['errList']['idtipoespeciecartaodebitoint'] = array();
                   }
                   $this->NM_ajax_info['errList']['idtipoespeciecartaodebitoint'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idtipoespeciecartaodebitoint';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idtipoespeciecartaodebitoint

    function ValidateField_imagemfoto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['imagemfoto'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->imagemfoto;
            if (strpos($this->imagemfoto, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
                if (!isset($Campos_Erros['imagemfoto']))
                {
                    $Campos_Erros['imagemfoto'] = array();
                }
                $Campos_Erros['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
                if (!isset($this->NM_ajax_info['errList']['imagemfoto']) || !is_array($this->NM_ajax_info['errList']['imagemfoto']))
                {
                    $this->NM_ajax_info['errList']['imagemfoto'] = array();
                }
                $this->NM_ajax_info['errList']['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
            }
            if ("" != $this->imagemfoto && "S" != $this->imagemfoto_limpa && !$teste_validade->ArqExtensao($this->imagemfoto, array()))
            {
                $hasError = true;
                $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['imagemfoto']))
                {
                    $Campos_Erros['imagemfoto'] = array();
                }
                $Campos_Erros['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['imagemfoto']) || !is_array($this->NM_ajax_info['errList']['imagemfoto']))
                {
                    $this->NM_ajax_info['errList']['imagemfoto'] = array();
                }
                $this->NM_ajax_info['errList']['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'imagemfoto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_imagemfoto
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
          if ($this->imagemfoto == "none") 
          { 
              $this->imagemfoto = ""; 
          } 
          if ($this->imagemfoto != "") 
          { 
              if (!function_exists('sc_upload_unprotect_chars'))
              {
                  include_once 'Configuracao_Frm_doc_name.php';
              }
              $this->imagemfoto = sc_upload_unprotect_chars($this->imagemfoto, true);
              $this->imagemfoto_scfile_name = sc_upload_unprotect_chars($this->imagemfoto_scfile_name, true);
              if ($nm_browser == "Opera")  
              { 
                  $this->imagemfoto_scfile_type = substr($this->imagemfoto_scfile_type, 0, strpos($this->imagemfoto_scfile_type, ";")) ; 
              } 
              if ($this->imagemfoto_scfile_type == "image/pjpeg" || $this->imagemfoto_scfile_type == "image/jpeg"  || $this->imagemfoto_scfile_type == "image/gif" || 
                  $this->imagemfoto_scfile_type == "image/png"   || $this->imagemfoto_scfile_type == "image/x-png" || $this->imagemfoto_scfile_type == "image/bmp" || 
                  $this->imagemfoto_scfile_type == "image/webp")
              { 
                  if (!is_file($this->imagemfoto) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                      $mbConvertFileName = mb_convert_encoding($this->imagemfoto, $_SESSION['scriptcase']['charset'], 'UTF-8');
                      $mbConvertScFileName = mb_convert_encoding($this->imagemfoto_scfile_name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                      if (is_file($mbConvertFileName)) {
                          $this->imagemfoto = $mbConvertFileName;
                          $this->imagemfoto_scfile_name = $mbConvertScFileName;
                      }
                  }
                  if (is_file($this->imagemfoto))  
                  { 
                      $this->NM_size_docs[$this->imagemfoto_scfile_name] = $this->sc_file_size($this->imagemfoto);
                      $reg_imagemfoto = file_get_contents($this->imagemfoto); 
                      $this->imagemfoto = $reg_imagemfoto; 
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Arquivo " . $this->Ini->Nm_lang['lang_errm_upld']; 
                      $this->imagemfoto = "";
                      if (!isset($Campos_Erros['imagemfoto']))
                      {
                          $Campos_Erros['imagemfoto'] = array();
                      }
                      $Campos_Erros['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                      if (!isset($this->NM_ajax_info['errList']['imagemfoto']) || !is_array($this->NM_ajax_info['errList']['imagemfoto']))
                      {
                          $this->NM_ajax_info['errList']['imagemfoto'] = array();
                      }
                      $this->NM_ajax_info['errList']['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  } 
              } 
              else 
              { 
                  if ($nm_browser == "Konqueror")  
                  { 
                      $this->imagemfoto = "" ; 
                  } 
                  else 
                  { 
                     $Campos_Crit .= "Arquivo " . $this->Ini->Nm_lang['lang_errm_ivtp'];  
                      if (!isset($Campos_Erros['imagemfoto']))
                      {
                          $Campos_Erros['imagemfoto'] = array();
                      }
                      $Campos_Erros['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_ivtp'];
                      if (!isset($this->NM_ajax_info['errList']['imagemfoto']) || !is_array($this->NM_ajax_info['errList']['imagemfoto']))
                      {
                          $this->NM_ajax_info['errList']['imagemfoto'] = array();
                      }
                      $this->NM_ajax_info['errList']['imagemfoto'][] = $this->Ini->Nm_lang['lang_errm_ivtp'];
                  } 
              } 
          } 
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form']['imagemfoto']) && $this->imagemfoto_limpa != "S")
          {
              $this->imagemfoto = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form']['imagemfoto'];
          }
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
    $this->nmgp_dados_form['clienteativo'] = $this->clienteativo;
    $this->nmgp_dados_form['gravarauditoria'] = $this->gravarauditoria;
    $this->nmgp_dados_form['integracaoinfolabativa'] = $this->integracaoinfolabativa;
    $this->nmgp_dados_form['usataxaadiantamento'] = $this->usataxaadiantamento;
    $this->nmgp_dados_form['recebeparcelado'] = $this->recebeparcelado;
    $this->nmgp_dados_form['utilizacentrocusto'] = $this->utilizacentrocusto;
    $this->nmgp_dados_form['urlsaida'] = $this->urlsaida;
    $this->nmgp_dados_form['clienteconcorrente'] = $this->clienteconcorrente;
    $this->nmgp_dados_form['notafiscalobrigatorio'] = $this->notafiscalobrigatorio;
    $this->nmgp_dados_form['coletadomiciliar'] = $this->coletadomiciliar;
    $this->nmgp_dados_form['diretorioexportacao'] = $this->diretorioexportacao;
    $this->nmgp_dados_form['diretorioarquivo'] = $this->diretorioarquivo;
    $this->nmgp_dados_form['diasprevisaocartaocreditoint'] = $this->diasprevisaocartaocreditoint;
    $this->nmgp_dados_form['diasprevisaocartaodebitoint'] = $this->diasprevisaocartaodebitoint;
    $this->nmgp_dados_form['taxaservicocartaocreditoint'] = $this->taxaservicocartaocreditoint;
    $this->nmgp_dados_form['taxaservicocartaodebitoint'] = $this->taxaservicocartaodebitoint;
    $this->nmgp_dados_form['relacaocadastros'] = $this->relacaocadastros;
    $this->nmgp_dados_form['relacaomodulos'] = $this->relacaomodulos;
    $this->nmgp_dados_form['contratolicenca'] = $this->contratolicenca;
    $this->nmgp_dados_form['servidorsmtp'] = $this->servidorsmtp;
    $this->nmgp_dados_form['usuariosmtp'] = $this->usuariosmtp;
    $this->nmgp_dados_form['senhasmtp'] = $this->senhasmtp;
    $this->nmgp_dados_form['remetente'] = $this->remetente;
    $this->nmgp_dados_form['assunto'] = $this->assunto;
    $this->nmgp_dados_form['msgenviosenha'] = $this->msgenviosenha;
    $this->nmgp_dados_form['usuariosms'] = $this->usuariosms;
    $this->nmgp_dados_form['senhasms'] = $this->senhasms;
    $this->nmgp_dados_form['servidorpdf'] = $this->servidorpdf;
    $this->nmgp_dados_form['diretoriopdf'] = $this->diretoriopdf;
    $this->nmgp_dados_form['idplanocontalancamentoreceitanotafiscal'] = $this->idplanocontalancamentoreceitanotafiscal;
    $this->nmgp_dados_form['idplanocontatransferenciaorigem'] = $this->idplanocontatransferenciaorigem;
    $this->nmgp_dados_form['idplanocontatransferenciadestino'] = $this->idplanocontatransferenciadestino;
    $this->nmgp_dados_form['idplanocontadinheiroint'] = $this->idplanocontadinheiroint;
    $this->nmgp_dados_form['idplanocontaguiaint'] = $this->idplanocontaguiaint;
    $this->nmgp_dados_form['idplanocontachequeint'] = $this->idplanocontachequeint;
    $this->nmgp_dados_form['idplanocontacartaocreditoint'] = $this->idplanocontacartaocreditoint;
    $this->nmgp_dados_form['idplanocontacartaodebitoint'] = $this->idplanocontacartaodebitoint;
    $this->nmgp_dados_form['idcontacaixalancamentoreceitanotafiscal'] = $this->idcontacaixalancamentoreceitanotafiscal;
    $this->nmgp_dados_form['idcontacaixaint'] = $this->idcontacaixaint;
    $this->nmgp_dados_form['idcontacaixacartao'] = $this->idcontacaixacartao;
    $this->nmgp_dados_form['idsituacaonovoclienteint'] = $this->idsituacaonovoclienteint;
    $this->nmgp_dados_form['idsituacaodocumentopendenteint'] = $this->idsituacaodocumentopendenteint;
    $this->nmgp_dados_form['idsituacaodocumentoexcluidoint'] = $this->idsituacaodocumentoexcluidoint;
    $this->nmgp_dados_form['idsituacaodocumentobaixadoint'] = $this->idsituacaodocumentobaixadoint;
    $this->nmgp_dados_form['idtipoespecielancamentoreceitanotafiscal'] = $this->idtipoespecielancamentoreceitanotafiscal;
    $this->nmgp_dados_form['idtipoespecietransferencia'] = $this->idtipoespecietransferencia;
    $this->nmgp_dados_form['idtipoespeciecartaocreditoint'] = $this->idtipoespeciecartaocreditoint;
    $this->nmgp_dados_form['idtipoespecieguiaint'] = $this->idtipoespecieguiaint;
    $this->nmgp_dados_form['idtipoespeciechequeint'] = $this->idtipoespeciechequeint;
    $this->nmgp_dados_form['idtipoespeciedinheiroint'] = $this->idtipoespeciedinheiroint;
    $this->nmgp_dados_form['idtipoespeciecartaodebitoint'] = $this->idtipoespeciecartaodebitoint;
    if (empty($this->imagemfoto))
    {
        $this->imagemfoto = $this->nmgp_dados_form['imagemfoto'];
    }
    $this->nmgp_dados_form['imagemfoto'] = $this->imagemfoto;
    $this->nmgp_dados_form['imagemfoto_limpa'] = $this->imagemfoto_limpa;
    $this->nmgp_dados_form['idconfiguracao'] = $this->idconfiguracao;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['anonotafiscal'] = $this->anonotafiscal;
    $this->nmgp_dados_form['sequencialnotafiscal'] = $this->sequencialnotafiscal;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['diasprevisaocartaocreditoint'] = $this->diasprevisaocartaocreditoint;
      nm_limpa_numero($this->diasprevisaocartaocreditoint, $this->field_config['diasprevisaocartaocreditoint']['symbol_grp']) ; 
      $this->Before_unformat['diasprevisaocartaodebitoint'] = $this->diasprevisaocartaodebitoint;
      nm_limpa_numero($this->diasprevisaocartaodebitoint, $this->field_config['diasprevisaocartaodebitoint']['symbol_grp']) ; 
      $this->Before_unformat['taxaservicocartaocreditoint'] = $this->taxaservicocartaocreditoint;
      if (!empty($this->field_config['taxaservicocartaocreditoint']['symbol_dec']))
      {
         nm_limpa_valor($this->taxaservicocartaocreditoint, $this->field_config['taxaservicocartaocreditoint']['symbol_dec'], $this->field_config['taxaservicocartaocreditoint']['symbol_grp']);
      }
      $this->Before_unformat['taxaservicocartaodebitoint'] = $this->taxaservicocartaodebitoint;
      if (!empty($this->field_config['taxaservicocartaodebitoint']['symbol_dec']))
      {
         nm_limpa_valor($this->taxaservicocartaodebitoint, $this->field_config['taxaservicocartaodebitoint']['symbol_dec'], $this->field_config['taxaservicocartaodebitoint']['symbol_grp']);
      }
      $this->Before_unformat['idconfiguracao'] = $this->idconfiguracao;
      nm_limpa_numero($this->idconfiguracao, $this->field_config['idconfiguracao']['symbol_grp']) ; 
      $this->Before_unformat['idusuarioauditoria'] = $this->idusuarioauditoria;
      nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
      $this->Before_unformat['anonotafiscal'] = $this->anonotafiscal;
      nm_limpa_numero($this->anonotafiscal, $this->field_config['anonotafiscal']['symbol_grp']) ; 
      $this->Before_unformat['sequencialnotafiscal'] = $this->sequencialnotafiscal;
      nm_limpa_numero($this->sequencialnotafiscal, $this->field_config['sequencialnotafiscal']['symbol_grp']) ; 
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
      if ($Nome_Campo == "diasprevisaocartaocreditoint")
      {
          nm_limpa_numero($this->diasprevisaocartaocreditoint, $this->field_config['diasprevisaocartaocreditoint']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "diasprevisaocartaodebitoint")
      {
          nm_limpa_numero($this->diasprevisaocartaodebitoint, $this->field_config['diasprevisaocartaodebitoint']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "taxaservicocartaocreditoint")
      {
          if (!empty($this->field_config['taxaservicocartaocreditoint']['symbol_dec']))
          {
             nm_limpa_valor($this->taxaservicocartaocreditoint, $this->field_config['taxaservicocartaocreditoint']['symbol_dec'], $this->field_config['taxaservicocartaocreditoint']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "taxaservicocartaodebitoint")
      {
          if (!empty($this->field_config['taxaservicocartaodebitoint']['symbol_dec']))
          {
             nm_limpa_valor($this->taxaservicocartaodebitoint, $this->field_config['taxaservicocartaodebitoint']['symbol_dec'], $this->field_config['taxaservicocartaodebitoint']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "idconfiguracao")
      {
          nm_limpa_numero($this->idconfiguracao, $this->field_config['idconfiguracao']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idusuarioauditoria")
      {
          nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "anonotafiscal")
      {
          nm_limpa_numero($this->anonotafiscal, $this->field_config['anonotafiscal']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "sequencialnotafiscal")
      {
          nm_limpa_numero($this->sequencialnotafiscal, $this->field_config['sequencialnotafiscal']['symbol_grp']) ; 
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
      if ('' !== $this->diasprevisaocartaocreditoint || (!empty($format_fields) && isset($format_fields['diasprevisaocartaocreditoint'])))
      {
          nmgp_Form_Num_Val($this->diasprevisaocartaocreditoint, $this->field_config['diasprevisaocartaocreditoint']['symbol_grp'], $this->field_config['diasprevisaocartaocreditoint']['symbol_dec'], "0", "S", $this->field_config['diasprevisaocartaocreditoint']['format_neg'], "", "", "-", $this->field_config['diasprevisaocartaocreditoint']['symbol_fmt']) ; 
      }
      if ('' !== $this->diasprevisaocartaodebitoint || (!empty($format_fields) && isset($format_fields['diasprevisaocartaodebitoint'])))
      {
          nmgp_Form_Num_Val($this->diasprevisaocartaodebitoint, $this->field_config['diasprevisaocartaodebitoint']['symbol_grp'], $this->field_config['diasprevisaocartaodebitoint']['symbol_dec'], "0", "S", $this->field_config['diasprevisaocartaodebitoint']['format_neg'], "", "", "-", $this->field_config['diasprevisaocartaodebitoint']['symbol_fmt']) ; 
      }
      if ('' !== $this->taxaservicocartaocreditoint || (!empty($format_fields) && isset($format_fields['taxaservicocartaocreditoint'])))
      {
          nmgp_Form_Num_Val($this->taxaservicocartaocreditoint, $this->field_config['taxaservicocartaocreditoint']['symbol_grp'], $this->field_config['taxaservicocartaocreditoint']['symbol_dec'], "2", "S", $this->field_config['taxaservicocartaocreditoint']['format_neg'], "", "", "-", $this->field_config['taxaservicocartaocreditoint']['symbol_fmt']) ; 
      }
      if ('' !== $this->taxaservicocartaodebitoint || (!empty($format_fields) && isset($format_fields['taxaservicocartaodebitoint'])))
      {
          nmgp_Form_Num_Val($this->taxaservicocartaodebitoint, $this->field_config['taxaservicocartaodebitoint']['symbol_grp'], $this->field_config['taxaservicocartaodebitoint']['symbol_dec'], "2", "S", $this->field_config['taxaservicocartaodebitoint']['format_neg'], "", "", "-", $this->field_config['taxaservicocartaodebitoint']['symbol_fmt']) ; 
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
          $this->ajax_return_values_clienteativo();
          $this->ajax_return_values_gravarauditoria();
          $this->ajax_return_values_integracaoinfolabativa();
          $this->ajax_return_values_usataxaadiantamento();
          $this->ajax_return_values_recebeparcelado();
          $this->ajax_return_values_utilizacentrocusto();
          $this->ajax_return_values_urlsaida();
          $this->ajax_return_values_clienteconcorrente();
          $this->ajax_return_values_notafiscalobrigatorio();
          $this->ajax_return_values_coletadomiciliar();
          $this->ajax_return_values_diretorioexportacao();
          $this->ajax_return_values_diretorioarquivo();
          $this->ajax_return_values_diasprevisaocartaocreditoint();
          $this->ajax_return_values_diasprevisaocartaodebitoint();
          $this->ajax_return_values_taxaservicocartaocreditoint();
          $this->ajax_return_values_taxaservicocartaodebitoint();
          $this->ajax_return_values_relacaocadastros();
          $this->ajax_return_values_relacaomodulos();
          $this->ajax_return_values_contratolicenca();
          $this->ajax_return_values_servidorsmtp();
          $this->ajax_return_values_usuariosmtp();
          $this->ajax_return_values_senhasmtp();
          $this->ajax_return_values_remetente();
          $this->ajax_return_values_assunto();
          $this->ajax_return_values_msgenviosenha();
          $this->ajax_return_values_usuariosms();
          $this->ajax_return_values_senhasms();
          $this->ajax_return_values_servidorpdf();
          $this->ajax_return_values_diretoriopdf();
          $this->ajax_return_values_idplanocontalancamentoreceitanotafiscal();
          $this->ajax_return_values_idplanocontatransferenciaorigem();
          $this->ajax_return_values_idplanocontatransferenciadestino();
          $this->ajax_return_values_idplanocontadinheiroint();
          $this->ajax_return_values_idplanocontaguiaint();
          $this->ajax_return_values_idplanocontachequeint();
          $this->ajax_return_values_idplanocontacartaocreditoint();
          $this->ajax_return_values_idplanocontacartaodebitoint();
          $this->ajax_return_values_idcontacaixalancamentoreceitanotafiscal();
          $this->ajax_return_values_idcontacaixaint();
          $this->ajax_return_values_idcontacaixacartao();
          $this->ajax_return_values_idsituacaonovoclienteint();
          $this->ajax_return_values_idsituacaodocumentopendenteint();
          $this->ajax_return_values_idsituacaodocumentoexcluidoint();
          $this->ajax_return_values_idsituacaodocumentobaixadoint();
          $this->ajax_return_values_idtipoespecielancamentoreceitanotafiscal();
          $this->ajax_return_values_idtipoespecietransferencia();
          $this->ajax_return_values_idtipoespeciecartaocreditoint();
          $this->ajax_return_values_idtipoespecieguiaint();
          $this->ajax_return_values_idtipoespeciechequeint();
          $this->ajax_return_values_idtipoespeciedinheiroint();
          $this->ajax_return_values_idtipoespeciecartaodebitoint();
          $this->ajax_return_values_imagemfoto();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idconfiguracao']['keyVal'] = Configuracao_Frm_pack_protect_string($this->nmgp_dados_form['idconfiguracao']);
          }
   } // ajax_return_values

          //----- clienteativo
   function ajax_return_values_clienteativo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("clienteativo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->clienteativo);
              $aLookup = array();
              $this->_tmp_lookup_clienteativo = $this->clienteativo;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Sim")));
$aLookup[] = array(Configuracao_Frm_pack_protect_string('N') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteativo'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteativo'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['clienteativo']) && !empty($this->NM_ajax_info['select_html']['clienteativo']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['clienteativo']);
          }
          $this->NM_ajax_info['fldList']['clienteativo'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['clienteativo']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['clienteativo']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['clienteativo']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['clienteativo']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['clienteativo']['labList'] = $aLabel;
          }
   }

          //----- gravarauditoria
   function ajax_return_values_gravarauditoria($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("gravarauditoria", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->gravarauditoria);
              $aLookup = array();
              $this->_tmp_lookup_gravarauditoria = $this->gravarauditoria;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_gravarauditoria'][] = 'S';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['gravarauditoria']) && !empty($this->NM_ajax_info['select_html']['gravarauditoria']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['gravarauditoria']);
          }
          $this->NM_ajax_info['fldList']['gravarauditoria'] = array(
                       'row'    => '',
               'type'    => 'checkbox',
               'switch'  => true,
               'valList' => explode(';', $sTmpValue),
               'colNum'  => 1,
               'optComp'  => $sOptComp,
               'optClass' => 'sc-ui-checkbox-gravarauditoria',
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['gravarauditoria']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['gravarauditoria']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['gravarauditoria']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['gravarauditoria']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['gravarauditoria']['labList'] = $aLabel;
          }
   }

          //----- integracaoinfolabativa
   function ajax_return_values_integracaoinfolabativa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("integracaoinfolabativa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->integracaoinfolabativa);
              $aLookup = array();
              $this->_tmp_lookup_integracaoinfolabativa = $this->integracaoinfolabativa;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Ativa")));
$aLookup[] = array(Configuracao_Frm_pack_protect_string('N') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Inativa")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_integracaoinfolabativa'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_integracaoinfolabativa'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['integracaoinfolabativa']) && !empty($this->NM_ajax_info['select_html']['integracaoinfolabativa']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['integracaoinfolabativa']);
          }
          $this->NM_ajax_info['fldList']['integracaoinfolabativa'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['integracaoinfolabativa']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['integracaoinfolabativa']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['integracaoinfolabativa']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['integracaoinfolabativa']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['integracaoinfolabativa']['labList'] = $aLabel;
          }
   }

          //----- usataxaadiantamento
   function ajax_return_values_usataxaadiantamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("usataxaadiantamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->usataxaadiantamento);
              $aLookup = array();
              $this->_tmp_lookup_usataxaadiantamento = $this->usataxaadiantamento;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Sim")));
$aLookup[] = array(Configuracao_Frm_pack_protect_string('N') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_usataxaadiantamento'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_usataxaadiantamento'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['usataxaadiantamento']) && !empty($this->NM_ajax_info['select_html']['usataxaadiantamento']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['usataxaadiantamento']);
          }
          $this->NM_ajax_info['fldList']['usataxaadiantamento'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['usataxaadiantamento']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['usataxaadiantamento']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['usataxaadiantamento']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['usataxaadiantamento']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['usataxaadiantamento']['labList'] = $aLabel;
          }
   }

          //----- recebeparcelado
   function ajax_return_values_recebeparcelado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("recebeparcelado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->recebeparcelado);
              $aLookup = array();
              $this->_tmp_lookup_recebeparcelado = $this->recebeparcelado;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Sim")));
$aLookup[] = array(Configuracao_Frm_pack_protect_string('N') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_recebeparcelado'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_recebeparcelado'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['recebeparcelado']) && !empty($this->NM_ajax_info['select_html']['recebeparcelado']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['recebeparcelado']);
          }
          $this->NM_ajax_info['fldList']['recebeparcelado'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['recebeparcelado']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['recebeparcelado']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['recebeparcelado']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['recebeparcelado']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['recebeparcelado']['labList'] = $aLabel;
          }
   }

          //----- utilizacentrocusto
   function ajax_return_values_utilizacentrocusto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("utilizacentrocusto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->utilizacentrocusto);
              $aLookup = array();
              $this->_tmp_lookup_utilizacentrocusto = $this->utilizacentrocusto;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_utilizacentrocusto'][] = 'S';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['utilizacentrocusto']) && !empty($this->NM_ajax_info['select_html']['utilizacentrocusto']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['utilizacentrocusto']);
          }
          $this->NM_ajax_info['fldList']['utilizacentrocusto'] = array(
                       'row'    => '',
               'type'    => 'checkbox',
               'switch'  => true,
               'valList' => explode(';', $sTmpValue),
               'colNum'  => 1,
               'optComp'  => $sOptComp,
               'optClass' => 'sc-ui-checkbox-utilizacentrocusto',
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['utilizacentrocusto']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['utilizacentrocusto']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['utilizacentrocusto']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['utilizacentrocusto']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['utilizacentrocusto']['labList'] = $aLabel;
          }
   }

          //----- urlsaida
   function ajax_return_values_urlsaida($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("urlsaida", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->urlsaida);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['urlsaida'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- clienteconcorrente
   function ajax_return_values_clienteconcorrente($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("clienteconcorrente", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->clienteconcorrente);
              $aLookup = array();
              $this->_tmp_lookup_clienteconcorrente = $this->clienteconcorrente;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Sim")));
$aLookup[] = array(Configuracao_Frm_pack_protect_string('N') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteconcorrente'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_clienteconcorrente'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['clienteconcorrente']) && !empty($this->NM_ajax_info['select_html']['clienteconcorrente']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['clienteconcorrente']);
          }
          $this->NM_ajax_info['fldList']['clienteconcorrente'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['clienteconcorrente']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['clienteconcorrente']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['clienteconcorrente']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['clienteconcorrente']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['clienteconcorrente']['labList'] = $aLabel;
          }
   }

          //----- notafiscalobrigatorio
   function ajax_return_values_notafiscalobrigatorio($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("notafiscalobrigatorio", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->notafiscalobrigatorio);
              $aLookup = array();
              $this->_tmp_lookup_notafiscalobrigatorio = $this->notafiscalobrigatorio;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Sim")));
$aLookup[] = array(Configuracao_Frm_pack_protect_string('N') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_notafiscalobrigatorio'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_notafiscalobrigatorio'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['notafiscalobrigatorio']) && !empty($this->NM_ajax_info['select_html']['notafiscalobrigatorio']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['notafiscalobrigatorio']);
          }
          $this->NM_ajax_info['fldList']['notafiscalobrigatorio'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['notafiscalobrigatorio']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['notafiscalobrigatorio']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['notafiscalobrigatorio']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['notafiscalobrigatorio']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['notafiscalobrigatorio']['labList'] = $aLabel;
          }
   }

          //----- coletadomiciliar
   function ajax_return_values_coletadomiciliar($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("coletadomiciliar", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->coletadomiciliar);
              $aLookup = array();
              $this->_tmp_lookup_coletadomiciliar = $this->coletadomiciliar;

$aLookup[] = array(Configuracao_Frm_pack_protect_string('S') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Sim")));
$aLookup[] = array(Configuracao_Frm_pack_protect_string('N') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_coletadomiciliar'][] = 'S';
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_coletadomiciliar'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['coletadomiciliar']) && !empty($this->NM_ajax_info['select_html']['coletadomiciliar']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['coletadomiciliar']);
          }
          $this->NM_ajax_info['fldList']['coletadomiciliar'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['coletadomiciliar']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['coletadomiciliar']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['coletadomiciliar']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['coletadomiciliar']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['coletadomiciliar']['labList'] = $aLabel;
          }
   }

          //----- diretorioexportacao
   function ajax_return_values_diretorioexportacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("diretorioexportacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->diretorioexportacao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['diretorioexportacao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- diretorioarquivo
   function ajax_return_values_diretorioarquivo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("diretorioarquivo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->diretorioarquivo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['diretorioarquivo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- diasprevisaocartaocreditoint
   function ajax_return_values_diasprevisaocartaocreditoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("diasprevisaocartaocreditoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->diasprevisaocartaocreditoint);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['diasprevisaocartaocreditoint'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- diasprevisaocartaodebitoint
   function ajax_return_values_diasprevisaocartaodebitoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("diasprevisaocartaodebitoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->diasprevisaocartaodebitoint);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['diasprevisaocartaodebitoint'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- taxaservicocartaocreditoint
   function ajax_return_values_taxaservicocartaocreditoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("taxaservicocartaocreditoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->taxaservicocartaocreditoint);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['taxaservicocartaocreditoint'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- taxaservicocartaodebitoint
   function ajax_return_values_taxaservicocartaodebitoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("taxaservicocartaodebitoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->taxaservicocartaodebitoint);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['taxaservicocartaodebitoint'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- relacaocadastros
   function ajax_return_values_relacaocadastros($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("relacaocadastros", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->relacaocadastros);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['relacaocadastros'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- relacaomodulos
   function ajax_return_values_relacaomodulos($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("relacaomodulos", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->relacaomodulos);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['relacaomodulos'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- contratolicenca
   function ajax_return_values_contratolicenca($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("contratolicenca", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->contratolicenca);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['contratolicenca'] = array(
                       'row'    => '',
               'type'    => 'editor_html',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- servidorsmtp
   function ajax_return_values_servidorsmtp($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("servidorsmtp", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->servidorsmtp);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['servidorsmtp'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- usuariosmtp
   function ajax_return_values_usuariosmtp($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("usuariosmtp", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->usuariosmtp);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['usuariosmtp'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- senhasmtp
   function ajax_return_values_senhasmtp($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("senhasmtp", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->senhasmtp);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['senhasmtp'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array(''),
              );
          }
   }

          //----- remetente
   function ajax_return_values_remetente($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("remetente", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->remetente);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['remetente'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- assunto
   function ajax_return_values_assunto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("assunto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->assunto);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['assunto'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- msgenviosenha
   function ajax_return_values_msgenviosenha($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("msgenviosenha", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->msgenviosenha);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['msgenviosenha'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- usuariosms
   function ajax_return_values_usuariosms($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("usuariosms", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->usuariosms);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['usuariosms'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- senhasms
   function ajax_return_values_senhasms($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("senhasms", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->senhasms);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['senhasms'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array(''),
              );
          }
   }

          //----- servidorpdf
   function ajax_return_values_servidorpdf($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("servidorpdf", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->servidorpdf);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['servidorpdf'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- diretoriopdf
   function ajax_return_values_diretoriopdf($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("diretoriopdf", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->diretoriopdf);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['diretoriopdf'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- idplanocontalancamentoreceitanotafiscal
   function ajax_return_values_idplanocontalancamentoreceitanotafiscal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontalancamentoreceitanotafiscal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontalancamentoreceitanotafiscal);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontalancamentoreceitanotafiscal = $this->idplanocontalancamentoreceitanotafiscal;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'] = array(); 
}
$aLookup[] = array(Configuracao_Frm_pack_protect_string('') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string('Escolha o Plano de Contas')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Origem = 'R' AND IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontalancamentoreceitanotafiscal\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontalancamentoreceitanotafiscal']) && !empty($this->NM_ajax_info['select_html']['idplanocontalancamentoreceitanotafiscal']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontalancamentoreceitanotafiscal']);
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

                  if ($this->idplanocontalancamentoreceitanotafiscal == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontalancamentoreceitanotafiscal = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontalancamentoreceitanotafiscal'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontalancamentoreceitanotafiscal']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontalancamentoreceitanotafiscal']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontalancamentoreceitanotafiscal']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontalancamentoreceitanotafiscal']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontalancamentoreceitanotafiscal']['labList'] = $aLabel;
          }
   }

          //----- idplanocontatransferenciaorigem
   function ajax_return_values_idplanocontatransferenciaorigem($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontatransferenciaorigem", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontatransferenciaorigem);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontatransferenciaorigem = $this->idplanocontatransferenciaorigem;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'] = array(); 
}
$aLookup[] = array(Configuracao_Frm_pack_protect_string('') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string('Escolha o Plano de Contas')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Origem = 'D' AND IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontatransferenciaorigem\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontatransferenciaorigem']) && !empty($this->NM_ajax_info['select_html']['idplanocontatransferenciaorigem']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontatransferenciaorigem']);
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

                  if ($this->idplanocontatransferenciaorigem == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontatransferenciaorigem = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontatransferenciaorigem'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontatransferenciaorigem']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontatransferenciaorigem']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontatransferenciaorigem']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontatransferenciaorigem']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontatransferenciaorigem']['labList'] = $aLabel;
          }
   }

          //----- idplanocontatransferenciadestino
   function ajax_return_values_idplanocontatransferenciadestino($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontatransferenciadestino", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontatransferenciadestino);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontatransferenciadestino = $this->idplanocontatransferenciadestino;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'] = array(); 
}
$aLookup[] = array(Configuracao_Frm_pack_protect_string('') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string('Escolha o Plano de Contas')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Origem = 'R' AND IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontatransferenciadestino\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontatransferenciadestino']) && !empty($this->NM_ajax_info['select_html']['idplanocontatransferenciadestino']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontatransferenciadestino']);
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

                  if ($this->idplanocontatransferenciadestino == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontatransferenciadestino = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontatransferenciadestino'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontatransferenciadestino']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontatransferenciadestino']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontatransferenciadestino']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontatransferenciadestino']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontatransferenciadestino']['labList'] = $aLabel;
          }
   }

          //----- idplanocontadinheiroint
   function ajax_return_values_idplanocontadinheiroint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontadinheiroint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontadinheiroint);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontadinheiroint = $this->idplanocontadinheiroint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontadinheiroint\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontadinheiroint']) && !empty($this->NM_ajax_info['select_html']['idplanocontadinheiroint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontadinheiroint']);
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

                  if ($this->idplanocontadinheiroint == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontadinheiroint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontadinheiroint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontadinheiroint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontadinheiroint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontadinheiroint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontadinheiroint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontadinheiroint']['labList'] = $aLabel;
          }
   }

          //----- idplanocontaguiaint
   function ajax_return_values_idplanocontaguiaint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontaguiaint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontaguiaint);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontaguiaint = $this->idplanocontaguiaint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontaguiaint\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontaguiaint']) && !empty($this->NM_ajax_info['select_html']['idplanocontaguiaint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontaguiaint']);
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

                  if ($this->idplanocontaguiaint == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontaguiaint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontaguiaint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontaguiaint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontaguiaint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontaguiaint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontaguiaint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontaguiaint']['labList'] = $aLabel;
          }
   }

          //----- idplanocontachequeint
   function ajax_return_values_idplanocontachequeint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontachequeint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontachequeint);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontachequeint = $this->idplanocontachequeint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontachequeint\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontachequeint']) && !empty($this->NM_ajax_info['select_html']['idplanocontachequeint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontachequeint']);
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

                  if ($this->idplanocontachequeint == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontachequeint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontachequeint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontachequeint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontachequeint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontachequeint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontachequeint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontachequeint']['labList'] = $aLabel;
          }
   }

          //----- idplanocontacartaocreditoint
   function ajax_return_values_idplanocontacartaocreditoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontacartaocreditoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontacartaocreditoint);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontacartaocreditoint = $this->idplanocontacartaocreditoint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontacartaocreditoint\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontacartaocreditoint']) && !empty($this->NM_ajax_info['select_html']['idplanocontacartaocreditoint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontacartaocreditoint']);
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

                  if ($this->idplanocontacartaocreditoint == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontacartaocreditoint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontacartaocreditoint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontacartaocreditoint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontacartaocreditoint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontacartaocreditoint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontacartaocreditoint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontacartaocreditoint']['labList'] = $aLabel;
          }
   }

          //----- idplanocontacartaodebitoint
   function ajax_return_values_idplanocontacartaodebitoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idplanocontacartaodebitoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idplanocontacartaodebitoint);
              $aLookup = array();
              $this->_tmp_lookup_idplanocontacartaodebitoint = $this->idplanocontacartaodebitoint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idplanocontacartaodebitoint\"";
          if (isset($this->NM_ajax_info['select_html']['idplanocontacartaodebitoint']) && !empty($this->NM_ajax_info['select_html']['idplanocontacartaodebitoint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idplanocontacartaodebitoint']);
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

                  if ($this->idplanocontacartaodebitoint == $sValue)
                  {
                      $this->_tmp_lookup_idplanocontacartaodebitoint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idplanocontacartaodebitoint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idplanocontacartaodebitoint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idplanocontacartaodebitoint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idplanocontacartaodebitoint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idplanocontacartaodebitoint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idplanocontacartaodebitoint']['labList'] = $aLabel;
          }
   }

          //----- idcontacaixalancamentoreceitanotafiscal
   function ajax_return_values_idcontacaixalancamentoreceitanotafiscal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcontacaixalancamentoreceitanotafiscal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcontacaixalancamentoreceitanotafiscal);
              $aLookup = array();
              $this->_tmp_lookup_idcontacaixalancamentoreceitanotafiscal = $this->idcontacaixalancamentoreceitanotafiscal;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'] = array(); 
}
$aLookup[] = array(Configuracao_Frm_pack_protect_string('') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string('Escolha a Conta Caixa')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdContaCaixa, Descricao  FROM contacaixa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idcontacaixalancamentoreceitanotafiscal\"";
          if (isset($this->NM_ajax_info['select_html']['idcontacaixalancamentoreceitanotafiscal']) && !empty($this->NM_ajax_info['select_html']['idcontacaixalancamentoreceitanotafiscal']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idcontacaixalancamentoreceitanotafiscal']);
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

                  if ($this->idcontacaixalancamentoreceitanotafiscal == $sValue)
                  {
                      $this->_tmp_lookup_idcontacaixalancamentoreceitanotafiscal = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idcontacaixalancamentoreceitanotafiscal'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idcontacaixalancamentoreceitanotafiscal']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idcontacaixalancamentoreceitanotafiscal']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcontacaixalancamentoreceitanotafiscal']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcontacaixalancamentoreceitanotafiscal']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcontacaixalancamentoreceitanotafiscal']['labList'] = $aLabel;
          }
   }

          //----- idcontacaixaint
   function ajax_return_values_idcontacaixaint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcontacaixaint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcontacaixaint);
              $aLookup = array();
              $this->_tmp_lookup_idcontacaixaint = $this->idcontacaixaint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdContaCaixa, Descricao  FROM contacaixa  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idcontacaixaint\"";
          if (isset($this->NM_ajax_info['select_html']['idcontacaixaint']) && !empty($this->NM_ajax_info['select_html']['idcontacaixaint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idcontacaixaint']);
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

                  if ($this->idcontacaixaint == $sValue)
                  {
                      $this->_tmp_lookup_idcontacaixaint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idcontacaixaint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idcontacaixaint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idcontacaixaint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcontacaixaint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcontacaixaint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcontacaixaint']['labList'] = $aLabel;
          }
   }

          //----- idcontacaixacartao
   function ajax_return_values_idcontacaixacartao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcontacaixacartao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcontacaixacartao);
              $aLookup = array();
              $this->_tmp_lookup_idcontacaixacartao = $this->idcontacaixacartao;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdContaCaixa, Descricao  FROM contacaixa  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idcontacaixacartao\"";
          if (isset($this->NM_ajax_info['select_html']['idcontacaixacartao']) && !empty($this->NM_ajax_info['select_html']['idcontacaixacartao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idcontacaixacartao']);
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

                  if ($this->idcontacaixacartao == $sValue)
                  {
                      $this->_tmp_lookup_idcontacaixacartao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idcontacaixacartao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idcontacaixacartao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idcontacaixacartao']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcontacaixacartao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcontacaixacartao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcontacaixacartao']['labList'] = $aLabel;
          }
   }

          //----- idsituacaonovoclienteint
   function ajax_return_values_idsituacaonovoclienteint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idsituacaonovoclienteint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idsituacaonovoclienteint);
              $aLookup = array();
              $this->_tmp_lookup_idsituacaonovoclienteint = $this->idsituacaonovoclienteint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoCliente,Descricao  FROM situacaocliente  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idsituacaonovoclienteint\"";
          if (isset($this->NM_ajax_info['select_html']['idsituacaonovoclienteint']) && !empty($this->NM_ajax_info['select_html']['idsituacaonovoclienteint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idsituacaonovoclienteint']);
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

                  if ($this->idsituacaonovoclienteint == $sValue)
                  {
                      $this->_tmp_lookup_idsituacaonovoclienteint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idsituacaonovoclienteint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idsituacaonovoclienteint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idsituacaonovoclienteint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idsituacaonovoclienteint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idsituacaonovoclienteint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idsituacaonovoclienteint']['labList'] = $aLabel;
          }
   }

          //----- idsituacaodocumentopendenteint
   function ajax_return_values_idsituacaodocumentopendenteint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idsituacaodocumentopendenteint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idsituacaodocumentopendenteint);
              $aLookup = array();
              $this->_tmp_lookup_idsituacaodocumentopendenteint = $this->idsituacaodocumentopendenteint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idsituacaodocumentopendenteint\"";
          if (isset($this->NM_ajax_info['select_html']['idsituacaodocumentopendenteint']) && !empty($this->NM_ajax_info['select_html']['idsituacaodocumentopendenteint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idsituacaodocumentopendenteint']);
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

                  if ($this->idsituacaodocumentopendenteint == $sValue)
                  {
                      $this->_tmp_lookup_idsituacaodocumentopendenteint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idsituacaodocumentopendenteint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumentopendenteint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idsituacaodocumentopendenteint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idsituacaodocumentopendenteint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumentopendenteint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idsituacaodocumentopendenteint']['labList'] = $aLabel;
          }
   }

          //----- idsituacaodocumentoexcluidoint
   function ajax_return_values_idsituacaodocumentoexcluidoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idsituacaodocumentoexcluidoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idsituacaodocumentoexcluidoint);
              $aLookup = array();
              $this->_tmp_lookup_idsituacaodocumentoexcluidoint = $this->idsituacaodocumentoexcluidoint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idsituacaodocumentoexcluidoint\"";
          if (isset($this->NM_ajax_info['select_html']['idsituacaodocumentoexcluidoint']) && !empty($this->NM_ajax_info['select_html']['idsituacaodocumentoexcluidoint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idsituacaodocumentoexcluidoint']);
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

                  if ($this->idsituacaodocumentoexcluidoint == $sValue)
                  {
                      $this->_tmp_lookup_idsituacaodocumentoexcluidoint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idsituacaodocumentoexcluidoint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumentoexcluidoint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idsituacaodocumentoexcluidoint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idsituacaodocumentoexcluidoint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumentoexcluidoint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idsituacaodocumentoexcluidoint']['labList'] = $aLabel;
          }
   }

          //----- idsituacaodocumentobaixadoint
   function ajax_return_values_idsituacaodocumentobaixadoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idsituacaodocumentobaixadoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idsituacaodocumentobaixadoint);
              $aLookup = array();
              $this->_tmp_lookup_idsituacaodocumentobaixadoint = $this->idsituacaodocumentobaixadoint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idsituacaodocumentobaixadoint\"";
          if (isset($this->NM_ajax_info['select_html']['idsituacaodocumentobaixadoint']) && !empty($this->NM_ajax_info['select_html']['idsituacaodocumentobaixadoint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idsituacaodocumentobaixadoint']);
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

                  if ($this->idsituacaodocumentobaixadoint == $sValue)
                  {
                      $this->_tmp_lookup_idsituacaodocumentobaixadoint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idsituacaodocumentobaixadoint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumentobaixadoint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idsituacaodocumentobaixadoint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idsituacaodocumentobaixadoint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idsituacaodocumentobaixadoint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idsituacaodocumentobaixadoint']['labList'] = $aLabel;
          }
   }

          //----- idtipoespecielancamentoreceitanotafiscal
   function ajax_return_values_idtipoespecielancamentoreceitanotafiscal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipoespecielancamentoreceitanotafiscal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipoespecielancamentoreceitanotafiscal);
              $aLookup = array();
              $this->_tmp_lookup_idtipoespecielancamentoreceitanotafiscal = $this->idtipoespecielancamentoreceitanotafiscal;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'] = array(); 
}
$aLookup[] = array(Configuracao_Frm_pack_protect_string('') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string('Escolha a Espécie')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipoespecielancamentoreceitanotafiscal\"";
          if (isset($this->NM_ajax_info['select_html']['idtipoespecielancamentoreceitanotafiscal']) && !empty($this->NM_ajax_info['select_html']['idtipoespecielancamentoreceitanotafiscal']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipoespecielancamentoreceitanotafiscal']);
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

                  if ($this->idtipoespecielancamentoreceitanotafiscal == $sValue)
                  {
                      $this->_tmp_lookup_idtipoespecielancamentoreceitanotafiscal = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipoespecielancamentoreceitanotafiscal'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipoespecielancamentoreceitanotafiscal']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipoespecielancamentoreceitanotafiscal']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipoespecielancamentoreceitanotafiscal']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipoespecielancamentoreceitanotafiscal']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipoespecielancamentoreceitanotafiscal']['labList'] = $aLabel;
          }
   }

          //----- idtipoespecietransferencia
   function ajax_return_values_idtipoespecietransferencia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipoespecietransferencia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipoespecietransferencia);
              $aLookup = array();
              $this->_tmp_lookup_idtipoespecietransferencia = $this->idtipoespecietransferencia;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'] = array(); 
}
$aLookup[] = array(Configuracao_Frm_pack_protect_string('') => str_replace('<', '&lt;',Configuracao_Frm_pack_protect_string('Escolha a  Espécie')));
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipoespecietransferencia\"";
          if (isset($this->NM_ajax_info['select_html']['idtipoespecietransferencia']) && !empty($this->NM_ajax_info['select_html']['idtipoespecietransferencia']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipoespecietransferencia']);
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

                  if ($this->idtipoespecietransferencia == $sValue)
                  {
                      $this->_tmp_lookup_idtipoespecietransferencia = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipoespecietransferencia'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipoespecietransferencia']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipoespecietransferencia']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipoespecietransferencia']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipoespecietransferencia']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipoespecietransferencia']['labList'] = $aLabel;
          }
   }

          //----- idtipoespeciecartaocreditoint
   function ajax_return_values_idtipoespeciecartaocreditoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipoespeciecartaocreditoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipoespeciecartaocreditoint);
              $aLookup = array();
              $this->_tmp_lookup_idtipoespeciecartaocreditoint = $this->idtipoespeciecartaocreditoint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipoespeciecartaocreditoint\"";
          if (isset($this->NM_ajax_info['select_html']['idtipoespeciecartaocreditoint']) && !empty($this->NM_ajax_info['select_html']['idtipoespeciecartaocreditoint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipoespeciecartaocreditoint']);
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

                  if ($this->idtipoespeciecartaocreditoint == $sValue)
                  {
                      $this->_tmp_lookup_idtipoespeciecartaocreditoint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipoespeciecartaocreditoint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciecartaocreditoint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipoespeciecartaocreditoint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipoespeciecartaocreditoint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciecartaocreditoint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipoespeciecartaocreditoint']['labList'] = $aLabel;
          }
   }

          //----- idtipoespecieguiaint
   function ajax_return_values_idtipoespecieguiaint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipoespecieguiaint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipoespecieguiaint);
              $aLookup = array();
              $this->_tmp_lookup_idtipoespecieguiaint = $this->idtipoespecieguiaint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipoespecieguiaint\"";
          if (isset($this->NM_ajax_info['select_html']['idtipoespecieguiaint']) && !empty($this->NM_ajax_info['select_html']['idtipoespecieguiaint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipoespecieguiaint']);
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

                  if ($this->idtipoespecieguiaint == $sValue)
                  {
                      $this->_tmp_lookup_idtipoespecieguiaint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipoespecieguiaint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipoespecieguiaint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipoespecieguiaint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipoespecieguiaint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipoespecieguiaint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipoespecieguiaint']['labList'] = $aLabel;
          }
   }

          //----- idtipoespeciechequeint
   function ajax_return_values_idtipoespeciechequeint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipoespeciechequeint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipoespeciechequeint);
              $aLookup = array();
              $this->_tmp_lookup_idtipoespeciechequeint = $this->idtipoespeciechequeint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipoespeciechequeint\"";
          if (isset($this->NM_ajax_info['select_html']['idtipoespeciechequeint']) && !empty($this->NM_ajax_info['select_html']['idtipoespeciechequeint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipoespeciechequeint']);
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

                  if ($this->idtipoespeciechequeint == $sValue)
                  {
                      $this->_tmp_lookup_idtipoespeciechequeint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipoespeciechequeint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciechequeint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipoespeciechequeint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipoespeciechequeint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciechequeint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipoespeciechequeint']['labList'] = $aLabel;
          }
   }

          //----- idtipoespeciedinheiroint
   function ajax_return_values_idtipoespeciedinheiroint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipoespeciedinheiroint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipoespeciedinheiroint);
              $aLookup = array();
              $this->_tmp_lookup_idtipoespeciedinheiroint = $this->idtipoespeciedinheiroint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipoespeciedinheiroint\"";
          if (isset($this->NM_ajax_info['select_html']['idtipoespeciedinheiroint']) && !empty($this->NM_ajax_info['select_html']['idtipoespeciedinheiroint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipoespeciedinheiroint']);
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

                  if ($this->idtipoespeciedinheiroint == $sValue)
                  {
                      $this->_tmp_lookup_idtipoespeciedinheiroint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipoespeciedinheiroint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciedinheiroint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipoespeciedinheiroint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipoespeciedinheiroint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciedinheiroint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipoespeciedinheiroint']['labList'] = $aLabel;
          }
   }

          //----- idtipoespeciecartaodebitoint
   function ajax_return_values_idtipoespeciecartaodebitoint($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idtipoespeciecartaodebitoint", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idtipoespeciecartaodebitoint);
              $aLookup = array();
              $this->_tmp_lookup_idtipoespeciecartaodebitoint = $this->idtipoespeciecartaodebitoint;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', Configuracao_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idtipoespeciecartaodebitoint\"";
          if (isset($this->NM_ajax_info['select_html']['idtipoespeciecartaodebitoint']) && !empty($this->NM_ajax_info['select_html']['idtipoespeciecartaodebitoint']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idtipoespeciecartaodebitoint']);
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

                  if ($this->idtipoespeciecartaodebitoint == $sValue)
                  {
                      $this->_tmp_lookup_idtipoespeciecartaodebitoint = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idtipoespeciecartaodebitoint'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciecartaodebitoint']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idtipoespeciecartaodebitoint']['valList'][$i] = Configuracao_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idtipoespeciecartaodebitoint']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idtipoespeciecartaodebitoint']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idtipoespeciecartaodebitoint']['labList'] = $aLabel;
          }
   }

          //----- imagemfoto
   function ajax_return_values_imagemfoto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("imagemfoto", $this->nmgp_refresh_fields)) || $bForce || in_array("imagemfoto", $this->Upload_refresh_fields))
          {
              $sTmpValue = NM_charset_to_utf8($this->imagemfoto);
              $aLookup = array();
   $out_imagemfoto = '';
   $out1_imagemfoto = '';
   if ($this->imagemfoto != "" && $this->imagemfoto != "none")   
   { 
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
       { 
           $nm_tmp = nm_conv_img_access(substr($this->imagemfoto, 0, 12));
           if (is_string($this->imagemfoto) && substr($this->imagemfoto, 0, 4) != "*nm*" && is_string($nm_tmp) && substr($nm_tmp, 0, 4) == "*nm*") 
           { 
               $this->imagemfoto = nm_conv_img_access($this->imagemfoto);
           } 
       } 
       if (is_string($this->imagemfoto) && substr($this->imagemfoto, 0, 4) == "*nm*") 
       { 
           $this->imagemfoto = substr($this->imagemfoto, 4) ; 
           $this->imagemfoto = base64_decode($this->imagemfoto) ; 
       } 
       $img_pos_bm = (is_string($this->imagemfoto)) ? strpos($this->imagemfoto, "BM") : false; 
       if (!$img_pos_bm === FALSE && $img_pos_bm == 78) 
       { 
           $this->imagemfoto = substr($this->imagemfoto, $img_pos_bm) ; 
       } 
       $Ext_File = $this->scGetImageExtension($this->imagemfoto);
       $out_imagemfoto = $this->Ini->path_imag_temp . "/sc_imagemfoto_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . $Ext_File;  
       $out1_imagemfoto = $out_imagemfoto; 
       $arq_imagemfoto = fopen($this->Ini->root . $out_imagemfoto, "w") ;  
       fwrite($arq_imagemfoto, (string)$this->imagemfoto) ;  
       fclose($arq_imagemfoto) ;  
       $sc_obj_img = new nm_trata_img($this->Ini->root . $out_imagemfoto, true);
       $this->nmgp_return_img['imagemfoto'][0] = $sc_obj_img->getHeight();
       $this->nmgp_return_img['imagemfoto'][1] = $sc_obj_img->getWidth();
       $_SESSION['scriptcase']['sc_num_img']++ ; 
   } 
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['imagemfoto'] = array(
                       'row'    => '',
               'type'    => 'imagem',
               'valList' => array($this->Ini->Nm_lang['lang_othr_show_imgg']),
               'imgFile' => $out_imagemfoto,
               'imgOrig' => $out1_imagemfoto,
               'keepImg' => $sKeepImage,
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
  $this->Preparar_LstFrm_OnSrip_OnLoad_Auditoria($this->Ini->nm_cod_apl, $this->idconfiguracao );

$mensagem  = "Arquivo de configuração geral do sistema";
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
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
      $this->taxaservicocartaocreditoint = str_replace($sc_parm1, $sc_parm2, $this->taxaservicocartaocreditoint); 
      $this->taxaservicocartaodebitoint = str_replace($sc_parm1, $sc_parm2, $this->taxaservicocartaodebitoint); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->taxaservicocartaocreditoint = "'" . $this->taxaservicocartaocreditoint . "'";
      $this->taxaservicocartaodebitoint = "'" . $this->taxaservicocartaodebitoint . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->taxaservicocartaocreditoint = str_replace("'", "", $this->taxaservicocartaocreditoint); 
      $this->taxaservicocartaodebitoint = str_replace("'", "", $this->taxaservicocartaodebitoint); 
   } 
//----------- 

   function controle_navegacao()
   {
      global $sc_where;

          if (false && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']))
          {
               $sc_where_pos = " WHERE ((IdConfiguracao < $this->idconfiguracao))";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total'] = $rsc->fields[0];
               $rsc->Close(); 
               if ('' != $this->idconfiguracao)
               {
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = $rsc->fields[0];
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] < 0)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = 0;
               }
               $rsc->Close(); 
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = 0;
               }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['qt_reg_grid'] = 1;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['final']  = 0;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] = $this->NM_ajax_info['param']['nmgp_opcao'];
          if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'], array('incluir', 'alterar', 'excluir')))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] = '';
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] == 'inicio')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = 0;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] == 'retorna')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = 0 ;
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] == 'avanca' && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total'] > $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['final']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['final'];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] == 'final')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] = 0;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['final'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['qt_reg_grid'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['final'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] = '';

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
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
  if ($this->gravarauditoria  != 'S') {
	$this->gravarauditoria  = 'N';
}
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeInsert ------*/
 
    }
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeUpdate ------*/
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
  if ($this->gravarauditoria  != 'S') {
	$this->gravarauditoria  = 'N';
}
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeUpdate ------*/
 
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
      $NM_val_form['clienteativo'] = $this->clienteativo;
      $NM_val_form['gravarauditoria'] = $this->gravarauditoria;
      $NM_val_form['integracaoinfolabativa'] = $this->integracaoinfolabativa;
      $NM_val_form['usataxaadiantamento'] = $this->usataxaadiantamento;
      $NM_val_form['recebeparcelado'] = $this->recebeparcelado;
      $NM_val_form['utilizacentrocusto'] = $this->utilizacentrocusto;
      $NM_val_form['urlsaida'] = $this->urlsaida;
      $NM_val_form['clienteconcorrente'] = $this->clienteconcorrente;
      $NM_val_form['notafiscalobrigatorio'] = $this->notafiscalobrigatorio;
      $NM_val_form['coletadomiciliar'] = $this->coletadomiciliar;
      $NM_val_form['diretorioexportacao'] = $this->diretorioexportacao;
      $NM_val_form['diretorioarquivo'] = $this->diretorioarquivo;
      $NM_val_form['diasprevisaocartaocreditoint'] = $this->diasprevisaocartaocreditoint;
      $NM_val_form['diasprevisaocartaodebitoint'] = $this->diasprevisaocartaodebitoint;
      $NM_val_form['taxaservicocartaocreditoint'] = $this->taxaservicocartaocreditoint;
      $NM_val_form['taxaservicocartaodebitoint'] = $this->taxaservicocartaodebitoint;
      $NM_val_form['relacaocadastros'] = $this->relacaocadastros;
      $NM_val_form['relacaomodulos'] = $this->relacaomodulos;
      $NM_val_form['contratolicenca'] = $this->contratolicenca;
      $NM_val_form['servidorsmtp'] = $this->servidorsmtp;
      $NM_val_form['usuariosmtp'] = $this->usuariosmtp;
      $NM_val_form['senhasmtp'] = $this->senhasmtp;
      $NM_val_form['remetente'] = $this->remetente;
      $NM_val_form['assunto'] = $this->assunto;
      $NM_val_form['msgenviosenha'] = $this->msgenviosenha;
      $NM_val_form['usuariosms'] = $this->usuariosms;
      $NM_val_form['senhasms'] = $this->senhasms;
      $NM_val_form['servidorpdf'] = $this->servidorpdf;
      $NM_val_form['diretoriopdf'] = $this->diretoriopdf;
      $NM_val_form['idplanocontalancamentoreceitanotafiscal'] = $this->idplanocontalancamentoreceitanotafiscal;
      $NM_val_form['idplanocontatransferenciaorigem'] = $this->idplanocontatransferenciaorigem;
      $NM_val_form['idplanocontatransferenciadestino'] = $this->idplanocontatransferenciadestino;
      $NM_val_form['idplanocontadinheiroint'] = $this->idplanocontadinheiroint;
      $NM_val_form['idplanocontaguiaint'] = $this->idplanocontaguiaint;
      $NM_val_form['idplanocontachequeint'] = $this->idplanocontachequeint;
      $NM_val_form['idplanocontacartaocreditoint'] = $this->idplanocontacartaocreditoint;
      $NM_val_form['idplanocontacartaodebitoint'] = $this->idplanocontacartaodebitoint;
      $NM_val_form['idcontacaixalancamentoreceitanotafiscal'] = $this->idcontacaixalancamentoreceitanotafiscal;
      $NM_val_form['idcontacaixaint'] = $this->idcontacaixaint;
      $NM_val_form['idcontacaixacartao'] = $this->idcontacaixacartao;
      $NM_val_form['idsituacaonovoclienteint'] = $this->idsituacaonovoclienteint;
      $NM_val_form['idsituacaodocumentopendenteint'] = $this->idsituacaodocumentopendenteint;
      $NM_val_form['idsituacaodocumentoexcluidoint'] = $this->idsituacaodocumentoexcluidoint;
      $NM_val_form['idsituacaodocumentobaixadoint'] = $this->idsituacaodocumentobaixadoint;
      $NM_val_form['idtipoespecielancamentoreceitanotafiscal'] = $this->idtipoespecielancamentoreceitanotafiscal;
      $NM_val_form['idtipoespecietransferencia'] = $this->idtipoespecietransferencia;
      $NM_val_form['idtipoespeciecartaocreditoint'] = $this->idtipoespeciecartaocreditoint;
      $NM_val_form['idtipoespecieguiaint'] = $this->idtipoespecieguiaint;
      $NM_val_form['idtipoespeciechequeint'] = $this->idtipoespeciechequeint;
      $NM_val_form['idtipoespeciedinheiroint'] = $this->idtipoespeciedinheiroint;
      $NM_val_form['idtipoespeciecartaodebitoint'] = $this->idtipoespeciecartaodebitoint;
      $NM_val_form['imagemfoto'] = $this->imagemfoto;
      $NM_val_form['idconfiguracao'] = $this->idconfiguracao;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['anonotafiscal'] = $this->anonotafiscal;
      $NM_val_form['sequencialnotafiscal'] = $this->sequencialnotafiscal;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      if ($this->idconfiguracao === "" || is_null($this->idconfiguracao))  
      { 
          $this->idconfiguracao = 0;
      } 
      if ($this->idtenacidade === "" || is_null($this->idtenacidade))  
      { 
          $this->idtenacidade = 0;
          $this->sc_force_zero[] = 'idtenacidade';
      } 
      if ($this->idcontacaixalancamentoreceitanotafiscal === "" || is_null($this->idcontacaixalancamentoreceitanotafiscal))  
      { 
          $this->idcontacaixalancamentoreceitanotafiscal = 0;
          $this->sc_force_zero[] = 'idcontacaixalancamentoreceitanotafiscal';
      } 
      if ($this->idcontacaixaint === "" || is_null($this->idcontacaixaint))  
      { 
          $this->idcontacaixaint = 0;
          $this->sc_force_zero[] = 'idcontacaixaint';
      } 
      if ($this->idcontacaixacartao === "" || is_null($this->idcontacaixacartao))  
      { 
          $this->idcontacaixacartao = 0;
          $this->sc_force_zero[] = 'idcontacaixacartao';
      } 
      if ($this->idplanocontalancamentoreceitanotafiscal === "" || is_null($this->idplanocontalancamentoreceitanotafiscal))  
      { 
          $this->idplanocontalancamentoreceitanotafiscal = 0;
          $this->sc_force_zero[] = 'idplanocontalancamentoreceitanotafiscal';
      } 
      if ($this->idplanocontatransferenciaorigem === "" || is_null($this->idplanocontatransferenciaorigem))  
      { 
          $this->idplanocontatransferenciaorigem = 0;
          $this->sc_force_zero[] = 'idplanocontatransferenciaorigem';
      } 
      if ($this->idplanocontatransferenciadestino === "" || is_null($this->idplanocontatransferenciadestino))  
      { 
          $this->idplanocontatransferenciadestino = 0;
          $this->sc_force_zero[] = 'idplanocontatransferenciadestino';
      } 
      if ($this->idplanocontadinheiroint === "" || is_null($this->idplanocontadinheiroint))  
      { 
          $this->idplanocontadinheiroint = 0;
          $this->sc_force_zero[] = 'idplanocontadinheiroint';
      } 
      if ($this->idplanocontaguiaint === "" || is_null($this->idplanocontaguiaint))  
      { 
          $this->idplanocontaguiaint = 0;
          $this->sc_force_zero[] = 'idplanocontaguiaint';
      } 
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      if ($this->idplanocontachequeint === "" || is_null($this->idplanocontachequeint))  
      { 
          $this->idplanocontachequeint = 0;
          $this->sc_force_zero[] = 'idplanocontachequeint';
      } 
      if ($this->idplanocontacartaocreditoint === "" || is_null($this->idplanocontacartaocreditoint))  
      { 
          $this->idplanocontacartaocreditoint = 0;
          $this->sc_force_zero[] = 'idplanocontacartaocreditoint';
      } 
      if ($this->idplanocontacartaodebitoint === "" || is_null($this->idplanocontacartaodebitoint))  
      { 
          $this->idplanocontacartaodebitoint = 0;
          $this->sc_force_zero[] = 'idplanocontacartaodebitoint';
      } 
      if ($this->idtipoespecielancamentoreceitanotafiscal === "" || is_null($this->idtipoespecielancamentoreceitanotafiscal))  
      { 
          $this->idtipoespecielancamentoreceitanotafiscal = 0;
          $this->sc_force_zero[] = 'idtipoespecielancamentoreceitanotafiscal';
      } 
      if ($this->idtipoespecietransferencia === "" || is_null($this->idtipoespecietransferencia))  
      { 
          $this->idtipoespecietransferencia = 0;
          $this->sc_force_zero[] = 'idtipoespecietransferencia';
      } 
      if ($this->idtipoespeciecartaocreditoint === "" || is_null($this->idtipoespeciecartaocreditoint))  
      { 
          $this->idtipoespeciecartaocreditoint = 0;
          $this->sc_force_zero[] = 'idtipoespeciecartaocreditoint';
      } 
      if ($this->idtipoespecieguiaint === "" || is_null($this->idtipoespecieguiaint))  
      { 
          $this->idtipoespecieguiaint = 0;
          $this->sc_force_zero[] = 'idtipoespecieguiaint';
      } 
      if ($this->idtipoespeciechequeint === "" || is_null($this->idtipoespeciechequeint))  
      { 
          $this->idtipoespeciechequeint = 0;
          $this->sc_force_zero[] = 'idtipoespeciechequeint';
      } 
      if ($this->idtipoespeciedinheiroint === "" || is_null($this->idtipoespeciedinheiroint))  
      { 
          $this->idtipoespeciedinheiroint = 0;
          $this->sc_force_zero[] = 'idtipoespeciedinheiroint';
      } 
      if ($this->idtipoespeciecartaodebitoint === "" || is_null($this->idtipoespeciecartaodebitoint))  
      { 
          $this->idtipoespeciecartaodebitoint = 0;
          $this->sc_force_zero[] = 'idtipoespeciecartaodebitoint';
      } 
      if ($this->idsituacaonovoclienteint === "" || is_null($this->idsituacaonovoclienteint))  
      { 
          $this->idsituacaonovoclienteint = 0;
          $this->sc_force_zero[] = 'idsituacaonovoclienteint';
      } 
      if ($this->idsituacaodocumentopendenteint === "" || is_null($this->idsituacaodocumentopendenteint))  
      { 
          $this->idsituacaodocumentopendenteint = 0;
          $this->sc_force_zero[] = 'idsituacaodocumentopendenteint';
      } 
      if ($this->idsituacaodocumentoexcluidoint === "" || is_null($this->idsituacaodocumentoexcluidoint))  
      { 
          $this->idsituacaodocumentoexcluidoint = 0;
          $this->sc_force_zero[] = 'idsituacaodocumentoexcluidoint';
      } 
      if ($this->idsituacaodocumentobaixadoint === "" || is_null($this->idsituacaodocumentobaixadoint))  
      { 
          $this->idsituacaodocumentobaixadoint = 0;
          $this->sc_force_zero[] = 'idsituacaodocumentobaixadoint';
      } 
      if ($this->diasprevisaocartaocreditoint === "" || is_null($this->diasprevisaocartaocreditoint))  
      { 
          $this->diasprevisaocartaocreditoint = 0;
          $this->sc_force_zero[] = 'diasprevisaocartaocreditoint';
      } 
      if ($this->diasprevisaocartaodebitoint === "" || is_null($this->diasprevisaocartaodebitoint))  
      { 
          $this->diasprevisaocartaodebitoint = 0;
          $this->sc_force_zero[] = 'diasprevisaocartaodebitoint';
      } 
      if ($this->taxaservicocartaocreditoint === "" || is_null($this->taxaservicocartaocreditoint))  
      { 
          $this->taxaservicocartaocreditoint = 0;
          $this->sc_force_zero[] = 'taxaservicocartaocreditoint';
      } 
      if ($this->taxaservicocartaodebitoint === "" || is_null($this->taxaservicocartaodebitoint))  
      { 
          $this->taxaservicocartaodebitoint = 0;
          $this->sc_force_zero[] = 'taxaservicocartaodebitoint';
      } 
      if ($this->anonotafiscal === "" || is_null($this->anonotafiscal))  
      { 
          $this->anonotafiscal = 0;
          $this->sc_force_zero[] = 'anonotafiscal';
      } 
      if ($this->sequencialnotafiscal === "" || is_null($this->sequencialnotafiscal))  
      { 
          $this->sequencialnotafiscal = 0;
          $this->sc_force_zero[] = 'sequencialnotafiscal';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->servidorsmtp_before_qstr = $this->servidorsmtp;
          $this->servidorsmtp = substr($this->Db->qstr($this->servidorsmtp), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->servidorsmtp = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->servidorsmtp);
          }
          if ($this->servidorsmtp == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->servidorsmtp = "null"; 
              $this->NM_val_null[] = "servidorsmtp";
          } 
          $this->usuariosmtp_before_qstr = $this->usuariosmtp;
          $this->usuariosmtp = substr($this->Db->qstr($this->usuariosmtp), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->usuariosmtp = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->usuariosmtp);
          }
          if ($this->usuariosmtp == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->usuariosmtp = "null"; 
              $this->NM_val_null[] = "usuariosmtp";
          } 
          $this->senhasmtp_before_qstr = $this->senhasmtp;
          $this->senhasmtp = substr($this->Db->qstr($this->senhasmtp), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->senhasmtp = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->senhasmtp);
          }
          if ($this->senhasmtp == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->senhasmtp = "null"; 
              $this->NM_val_null[] = "senhasmtp";
          } 
          $this->remetente_before_qstr = $this->remetente;
          $this->remetente = substr($this->Db->qstr($this->remetente), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->remetente = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->remetente);
          }
          if ($this->remetente == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->remetente = "null"; 
              $this->NM_val_null[] = "remetente";
          } 
          $this->assunto_before_qstr = $this->assunto;
          $this->assunto = substr($this->Db->qstr($this->assunto), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->assunto = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->assunto);
          }
          if ($this->assunto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->assunto = "null"; 
              $this->NM_val_null[] = "assunto";
          } 
          $this->msgenviosenha_before_qstr = $this->msgenviosenha;
          $this->msgenviosenha = substr($this->Db->qstr($this->msgenviosenha), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->msgenviosenha = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->msgenviosenha);
          }
          if ($this->msgenviosenha == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->msgenviosenha = "null"; 
              $this->NM_val_null[] = "msgenviosenha";
          } 
          $this->usuariosms_before_qstr = $this->usuariosms;
          $this->usuariosms = substr($this->Db->qstr($this->usuariosms), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->usuariosms = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->usuariosms);
          }
          if ($this->usuariosms == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->usuariosms = "null"; 
              $this->NM_val_null[] = "usuariosms";
          } 
          $this->senhasms_before_qstr = $this->senhasms;
          $this->senhasms = substr($this->Db->qstr($this->senhasms), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->senhasms = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->senhasms);
          }
          if ($this->senhasms == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->senhasms = "null"; 
              $this->NM_val_null[] = "senhasms";
          } 
          $this->urlsaida_before_qstr = $this->urlsaida;
          $this->urlsaida = substr($this->Db->qstr($this->urlsaida), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->urlsaida = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->urlsaida);
          }
          if ($this->urlsaida == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->urlsaida = "null"; 
              $this->NM_val_null[] = "urlsaida";
          } 
          $this->servidorpdf_before_qstr = $this->servidorpdf;
          $this->servidorpdf = substr($this->Db->qstr($this->servidorpdf), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->servidorpdf = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->servidorpdf);
          }
          if ($this->servidorpdf == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->servidorpdf = "null"; 
              $this->NM_val_null[] = "servidorpdf";
          } 
          $this->diretoriopdf_before_qstr = $this->diretoriopdf;
          $this->diretoriopdf = substr($this->Db->qstr($this->diretoriopdf), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->diretoriopdf = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->diretoriopdf);
          }
          if ($this->diretoriopdf == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->diretoriopdf = "null"; 
              $this->NM_val_null[] = "diretoriopdf";
          } 
          $this->contratolicenca_before_qstr = $this->contratolicenca;
          $this->contratolicenca = substr($this->Db->qstr($this->contratolicenca), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contratolicenca = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->contratolicenca);
          }
          if ($this->contratolicenca == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->contratolicenca = "null"; 
              $this->NM_val_null[] = "contratolicenca";
          } 
          $this->clienteconcorrente_before_qstr = $this->clienteconcorrente;
          $this->clienteconcorrente = substr($this->Db->qstr($this->clienteconcorrente), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->clienteconcorrente = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->clienteconcorrente);
          }
          if ($this->clienteconcorrente == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->clienteconcorrente = "null"; 
              $this->NM_val_null[] = "clienteconcorrente";
          } 
          $this->notafiscalobrigatorio_before_qstr = $this->notafiscalobrigatorio;
          $this->notafiscalobrigatorio = substr($this->Db->qstr($this->notafiscalobrigatorio), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->notafiscalobrigatorio = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->notafiscalobrigatorio);
          }
          if ($this->notafiscalobrigatorio == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->notafiscalobrigatorio = "null"; 
              $this->NM_val_null[] = "notafiscalobrigatorio";
          } 
          $this->coletadomiciliar_before_qstr = $this->coletadomiciliar;
          $this->coletadomiciliar = substr($this->Db->qstr($this->coletadomiciliar), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->coletadomiciliar = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->coletadomiciliar);
          }
          if ($this->coletadomiciliar == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->coletadomiciliar = "null"; 
              $this->NM_val_null[] = "coletadomiciliar";
          } 
          $this->diretorioexportacao_before_qstr = $this->diretorioexportacao;
          $this->diretorioexportacao = substr($this->Db->qstr($this->diretorioexportacao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->diretorioexportacao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->diretorioexportacao);
          }
          if ($this->diretorioexportacao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->diretorioexportacao = "null"; 
              $this->NM_val_null[] = "diretorioexportacao";
          } 
          $this->diretorioarquivo_before_qstr = $this->diretorioarquivo;
          $this->diretorioarquivo = substr($this->Db->qstr($this->diretorioarquivo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->diretorioarquivo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->diretorioarquivo);
          }
          if ($this->diretorioarquivo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->diretorioarquivo = "null"; 
              $this->NM_val_null[] = "diretorioarquivo";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $nm_tmp = nm_conv_img_access(substr($this->imagemfoto, 0, 12));
              if (is_string($this->imagemfoto) && substr($this->imagemfoto, 0, 4) != "*nm*" && is_string($nm_tmp) && substr($nm_tmp, 0, 4) == "*nm*") 
              { 
                  $this->imagemfoto = nm_conv_img_access($this->imagemfoto);
              } 
              if (!empty($this->imagemfoto) && $this->imagemfoto != 'null' && substr($this->imagemfoto, 0, 4) != "*nm*") 
              { 
                  $this->imagemfoto = "*nm*" . base64_encode($this->imagemfoto) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { }
          else
          { 
              $this->imagemfoto =  substr($this->Db->qstr($this->imagemfoto), 1, -1);
          } 
          if ($this->imagemfoto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->imagemfoto = "null"; 
              $this->NM_val_null[] = "imagemfoto";
          } 
          $this->relacaomodulos_before_qstr = $this->relacaomodulos;
          $this->relacaomodulos = substr($this->Db->qstr($this->relacaomodulos), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->relacaomodulos = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->relacaomodulos);
          }
          if ($this->relacaomodulos == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->relacaomodulos = "null"; 
              $this->NM_val_null[] = "relacaomodulos";
          } 
          $this->relacaocadastros_before_qstr = $this->relacaocadastros;
          $this->relacaocadastros = substr($this->Db->qstr($this->relacaocadastros), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->relacaocadastros = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->relacaocadastros);
          }
          if ($this->relacaocadastros == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->relacaocadastros = "null"; 
              $this->NM_val_null[] = "relacaocadastros";
          } 
          $this->clienteativo_before_qstr = $this->clienteativo;
          $this->clienteativo = substr($this->Db->qstr($this->clienteativo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->clienteativo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->clienteativo);
          }
          if ($this->clienteativo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->clienteativo = "null"; 
              $this->NM_val_null[] = "clienteativo";
          } 
          $this->integracaoinfolabativa_before_qstr = $this->integracaoinfolabativa;
          $this->integracaoinfolabativa = substr($this->Db->qstr($this->integracaoinfolabativa), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->integracaoinfolabativa = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->integracaoinfolabativa);
          }
          if ($this->integracaoinfolabativa == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->integracaoinfolabativa = "null"; 
              $this->NM_val_null[] = "integracaoinfolabativa";
          } 
          $this->recebeparcelado_before_qstr = $this->recebeparcelado;
          $this->recebeparcelado = substr($this->Db->qstr($this->recebeparcelado), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->recebeparcelado = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->recebeparcelado);
          }
          if ($this->recebeparcelado == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->recebeparcelado = "null"; 
              $this->NM_val_null[] = "recebeparcelado";
          } 
          $this->usataxaadiantamento_before_qstr = $this->usataxaadiantamento;
          $this->usataxaadiantamento = substr($this->Db->qstr($this->usataxaadiantamento), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->usataxaadiantamento = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->usataxaadiantamento);
          }
          if ($this->usataxaadiantamento == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->usataxaadiantamento = "null"; 
              $this->NM_val_null[] = "usataxaadiantamento";
          } 
          $this->gravarauditoria_before_qstr = $this->gravarauditoria;
          $this->gravarauditoria = substr($this->Db->qstr($this->gravarauditoria), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->gravarauditoria = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->gravarauditoria);
          }
          if ($this->gravarauditoria == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->gravarauditoria = "null"; 
              $this->NM_val_null[] = "gravarauditoria";
          } 
          $this->utilizacentrocusto_before_qstr = $this->utilizacentrocusto;
          $this->utilizacentrocusto = substr($this->Db->qstr($this->utilizacentrocusto), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->utilizacentrocusto = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->utilizacentrocusto);
          }
          if ($this->utilizacentrocusto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->utilizacentrocusto = "null"; 
              $this->NM_val_null[] = "utilizacentrocusto";
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 Configuracao_Frm_pack_ajax_response();
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
                  $SC_fields_update[] = "IdContaCaixaLancamentoReceitaNotaFiscal = $this->idcontacaixalancamentoreceitanotafiscal, IdContaCaixaInt = $this->idcontacaixaint, IdContaCaixaCartao = $this->idcontacaixacartao, IdPlanoContaLancamentoReceitaNotaFiscal = $this->idplanocontalancamentoreceitanotafiscal, IdPlanoContaTransferenciaOrigem = $this->idplanocontatransferenciaorigem, IdPlanoContaTransferenciaDestino = $this->idplanocontatransferenciadestino, IdPlanoContaDinheiroInt = $this->idplanocontadinheiroint, IdPlanoContaGuiaInt = $this->idplanocontaguiaint, IdPlanoContaChequeInt = $this->idplanocontachequeint, IdPlanoContaCartaoCreditoInt = $this->idplanocontacartaocreditoint, IdPlanoContaCartaoDebitoInt = $this->idplanocontacartaodebitoint, IdTipoEspecieLancamentoReceitaNotaFiscal = $this->idtipoespecielancamentoreceitanotafiscal, IdTipoEspecieTransferencia = $this->idtipoespecietransferencia, IdTipoEspecieCartaoCreditoInt = $this->idtipoespeciecartaocreditoint, IdTipoEspecieGuiaInt = $this->idtipoespecieguiaint, IdTipoEspecieChequeInt = $this->idtipoespeciechequeint, IdTipoEspecieDinheiroInt = $this->idtipoespeciedinheiroint, IdTipoEspecieCartaoDebitoInt = $this->idtipoespeciecartaodebitoint, IdSituacaoNovoClienteInt = $this->idsituacaonovoclienteint, IdSituacaoDocumentoPendenteInt = $this->idsituacaodocumentopendenteint, IdSituacaoDocumentoExcluidoInt = $this->idsituacaodocumentoexcluidoint, IdSituacaoDocumentoBaixadoInt = $this->idsituacaodocumentobaixadoint, ServidorSMTP = '$this->servidorsmtp', UsuarioSMTP = '$this->usuariosmtp', Remetente = '$this->remetente', Assunto = '$this->assunto', MsgEnvioSenha = '$this->msgenviosenha', UsuarioSMS = '$this->usuariosms', URLSaida = '$this->urlsaida', ServidorPDF = '$this->servidorpdf', DiretorioPDF = '$this->diretoriopdf', ContratoLicenca = '$this->contratolicenca', ClienteConcorrente = '$this->clienteconcorrente', NotaFiscalObrigatorio = '$this->notafiscalobrigatorio', ColetaDomiciliar = '$this->coletadomiciliar', DiretorioExportacao = '$this->diretorioexportacao', DiretorioArquivo = '$this->diretorioarquivo', RelacaoModulos = '$this->relacaomodulos', RelacaoCadastros = '$this->relacaocadastros', ClienteAtivo = '$this->clienteativo', DiasPrevisaoCartaoCreditoInt = $this->diasprevisaocartaocreditoint, DiasPrevisaoCartaoDebitoInt = $this->diasprevisaocartaodebitoint, TaxaServicoCartaoCreditoInt = $this->taxaservicocartaocreditoint, TaxaServicoCartaoDebitoInt = $this->taxaservicocartaodebitoint, IntegracaoInfolabAtiva = '$this->integracaoinfolabativa', RecebeParcelado = '$this->recebeparcelado', UsaTaxaAdiantamento = '$this->usataxaadiantamento', GravarAuditoria = '$this->gravarauditoria', UtilizaCentroCusto = '$this->utilizacentrocusto'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdContaCaixaLancamentoReceitaNotaFiscal = $this->idcontacaixalancamentoreceitanotafiscal, IdContaCaixaInt = $this->idcontacaixaint, IdContaCaixaCartao = $this->idcontacaixacartao, IdPlanoContaLancamentoReceitaNotaFiscal = $this->idplanocontalancamentoreceitanotafiscal, IdPlanoContaTransferenciaOrigem = $this->idplanocontatransferenciaorigem, IdPlanoContaTransferenciaDestino = $this->idplanocontatransferenciadestino, IdPlanoContaDinheiroInt = $this->idplanocontadinheiroint, IdPlanoContaGuiaInt = $this->idplanocontaguiaint, IdPlanoContaChequeInt = $this->idplanocontachequeint, IdPlanoContaCartaoCreditoInt = $this->idplanocontacartaocreditoint, IdPlanoContaCartaoDebitoInt = $this->idplanocontacartaodebitoint, IdTipoEspecieLancamentoReceitaNotaFiscal = $this->idtipoespecielancamentoreceitanotafiscal, IdTipoEspecieTransferencia = $this->idtipoespecietransferencia, IdTipoEspecieCartaoCreditoInt = $this->idtipoespeciecartaocreditoint, IdTipoEspecieGuiaInt = $this->idtipoespecieguiaint, IdTipoEspecieChequeInt = $this->idtipoespeciechequeint, IdTipoEspecieDinheiroInt = $this->idtipoespeciedinheiroint, IdTipoEspecieCartaoDebitoInt = $this->idtipoespeciecartaodebitoint, IdSituacaoNovoClienteInt = $this->idsituacaonovoclienteint, IdSituacaoDocumentoPendenteInt = $this->idsituacaodocumentopendenteint, IdSituacaoDocumentoExcluidoInt = $this->idsituacaodocumentoexcluidoint, IdSituacaoDocumentoBaixadoInt = $this->idsituacaodocumentobaixadoint, ServidorSMTP = '$this->servidorsmtp', UsuarioSMTP = '$this->usuariosmtp', Remetente = '$this->remetente', Assunto = '$this->assunto', MsgEnvioSenha = '$this->msgenviosenha', UsuarioSMS = '$this->usuariosms', URLSaida = '$this->urlsaida', ServidorPDF = '$this->servidorpdf', DiretorioPDF = '$this->diretoriopdf', ContratoLicenca = '$this->contratolicenca', ClienteConcorrente = '$this->clienteconcorrente', NotaFiscalObrigatorio = '$this->notafiscalobrigatorio', ColetaDomiciliar = '$this->coletadomiciliar', DiretorioExportacao = '$this->diretorioexportacao', DiretorioArquivo = '$this->diretorioarquivo', RelacaoModulos = '$this->relacaomodulos', RelacaoCadastros = '$this->relacaocadastros', ClienteAtivo = '$this->clienteativo', DiasPrevisaoCartaoCreditoInt = $this->diasprevisaocartaocreditoint, DiasPrevisaoCartaoDebitoInt = $this->diasprevisaocartaodebitoint, TaxaServicoCartaoCreditoInt = $this->taxaservicocartaocreditoint, TaxaServicoCartaoDebitoInt = $this->taxaservicocartaodebitoint, IntegracaoInfolabAtiva = '$this->integracaoinfolabativa', RecebeParcelado = '$this->recebeparcelado', UsaTaxaAdiantamento = '$this->usataxaadiantamento', GravarAuditoria = '$this->gravarauditoria', UtilizaCentroCusto = '$this->utilizacentrocusto'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdContaCaixaLancamentoReceitaNotaFiscal = $this->idcontacaixalancamentoreceitanotafiscal, IdContaCaixaInt = $this->idcontacaixaint, IdContaCaixaCartao = $this->idcontacaixacartao, IdPlanoContaLancamentoReceitaNotaFiscal = $this->idplanocontalancamentoreceitanotafiscal, IdPlanoContaTransferenciaOrigem = $this->idplanocontatransferenciaorigem, IdPlanoContaTransferenciaDestino = $this->idplanocontatransferenciadestino, IdPlanoContaDinheiroInt = $this->idplanocontadinheiroint, IdPlanoContaGuiaInt = $this->idplanocontaguiaint, IdPlanoContaChequeInt = $this->idplanocontachequeint, IdPlanoContaCartaoCreditoInt = $this->idplanocontacartaocreditoint, IdPlanoContaCartaoDebitoInt = $this->idplanocontacartaodebitoint, IdTipoEspecieLancamentoReceitaNotaFiscal = $this->idtipoespecielancamentoreceitanotafiscal, IdTipoEspecieTransferencia = $this->idtipoespecietransferencia, IdTipoEspecieCartaoCreditoInt = $this->idtipoespeciecartaocreditoint, IdTipoEspecieGuiaInt = $this->idtipoespecieguiaint, IdTipoEspecieChequeInt = $this->idtipoespeciechequeint, IdTipoEspecieDinheiroInt = $this->idtipoespeciedinheiroint, IdTipoEspecieCartaoDebitoInt = $this->idtipoespeciecartaodebitoint, IdSituacaoNovoClienteInt = $this->idsituacaonovoclienteint, IdSituacaoDocumentoPendenteInt = $this->idsituacaodocumentopendenteint, IdSituacaoDocumentoExcluidoInt = $this->idsituacaodocumentoexcluidoint, IdSituacaoDocumentoBaixadoInt = $this->idsituacaodocumentobaixadoint, ServidorSMTP = '$this->servidorsmtp', UsuarioSMTP = '$this->usuariosmtp', Remetente = '$this->remetente', Assunto = '$this->assunto', MsgEnvioSenha = '$this->msgenviosenha', UsuarioSMS = '$this->usuariosms', URLSaida = '$this->urlsaida', ServidorPDF = '$this->servidorpdf', DiretorioPDF = '$this->diretoriopdf', ContratoLicenca = '$this->contratolicenca', ClienteConcorrente = '$this->clienteconcorrente', NotaFiscalObrigatorio = '$this->notafiscalobrigatorio', ColetaDomiciliar = '$this->coletadomiciliar', DiretorioExportacao = '$this->diretorioexportacao', DiretorioArquivo = '$this->diretorioarquivo', RelacaoModulos = '$this->relacaomodulos', RelacaoCadastros = '$this->relacaocadastros', ClienteAtivo = '$this->clienteativo', DiasPrevisaoCartaoCreditoInt = $this->diasprevisaocartaocreditoint, DiasPrevisaoCartaoDebitoInt = $this->diasprevisaocartaodebitoint, TaxaServicoCartaoCreditoInt = $this->taxaservicocartaocreditoint, TaxaServicoCartaoDebitoInt = $this->taxaservicocartaodebitoint, IntegracaoInfolabAtiva = '$this->integracaoinfolabativa', RecebeParcelado = '$this->recebeparcelado', UsaTaxaAdiantamento = '$this->usataxaadiantamento', GravarAuditoria = '$this->gravarauditoria', UtilizaCentroCusto = '$this->utilizacentrocusto'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdContaCaixaLancamentoReceitaNotaFiscal = $this->idcontacaixalancamentoreceitanotafiscal, IdContaCaixaInt = $this->idcontacaixaint, IdContaCaixaCartao = $this->idcontacaixacartao, IdPlanoContaLancamentoReceitaNotaFiscal = $this->idplanocontalancamentoreceitanotafiscal, IdPlanoContaTransferenciaOrigem = $this->idplanocontatransferenciaorigem, IdPlanoContaTransferenciaDestino = $this->idplanocontatransferenciadestino, IdPlanoContaDinheiroInt = $this->idplanocontadinheiroint, IdPlanoContaGuiaInt = $this->idplanocontaguiaint, IdPlanoContaChequeInt = $this->idplanocontachequeint, IdPlanoContaCartaoCreditoInt = $this->idplanocontacartaocreditoint, IdPlanoContaCartaoDebitoInt = $this->idplanocontacartaodebitoint, IdTipoEspecieLancamentoReceitaNotaFiscal = $this->idtipoespecielancamentoreceitanotafiscal, IdTipoEspecieTransferencia = $this->idtipoespecietransferencia, IdTipoEspecieCartaoCreditoInt = $this->idtipoespeciecartaocreditoint, IdTipoEspecieGuiaInt = $this->idtipoespecieguiaint, IdTipoEspecieChequeInt = $this->idtipoespeciechequeint, IdTipoEspecieDinheiroInt = $this->idtipoespeciedinheiroint, IdTipoEspecieCartaoDebitoInt = $this->idtipoespeciecartaodebitoint, IdSituacaoNovoClienteInt = $this->idsituacaonovoclienteint, IdSituacaoDocumentoPendenteInt = $this->idsituacaodocumentopendenteint, IdSituacaoDocumentoExcluidoInt = $this->idsituacaodocumentoexcluidoint, IdSituacaoDocumentoBaixadoInt = $this->idsituacaodocumentobaixadoint, ServidorSMTP = '$this->servidorsmtp', UsuarioSMTP = '$this->usuariosmtp', Remetente = '$this->remetente', Assunto = '$this->assunto', MsgEnvioSenha = '$this->msgenviosenha', UsuarioSMS = '$this->usuariosms', URLSaida = '$this->urlsaida', ServidorPDF = '$this->servidorpdf', DiretorioPDF = '$this->diretoriopdf', ContratoLicenca = '$this->contratolicenca', ClienteConcorrente = '$this->clienteconcorrente', NotaFiscalObrigatorio = '$this->notafiscalobrigatorio', ColetaDomiciliar = '$this->coletadomiciliar', DiretorioExportacao = '$this->diretorioexportacao', DiretorioArquivo = '$this->diretorioarquivo', RelacaoModulos = '$this->relacaomodulos', RelacaoCadastros = '$this->relacaocadastros', ClienteAtivo = '$this->clienteativo', DiasPrevisaoCartaoCreditoInt = $this->diasprevisaocartaocreditoint, DiasPrevisaoCartaoDebitoInt = $this->diasprevisaocartaodebitoint, TaxaServicoCartaoCreditoInt = $this->taxaservicocartaocreditoint, TaxaServicoCartaoDebitoInt = $this->taxaservicocartaodebitoint, IntegracaoInfolabAtiva = '$this->integracaoinfolabativa', RecebeParcelado = '$this->recebeparcelado', UsaTaxaAdiantamento = '$this->usataxaadiantamento', GravarAuditoria = '$this->gravarauditoria', UtilizaCentroCusto = '$this->utilizacentrocusto'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] == "null"  && $this->nmgp_dados_select['idtenacidade'] == "") ? "null" : $this->nmgp_dados_select['idtenacidade'];
              if (isset($NM_val_form['idtenacidade']) && $NM_val_form['idtenacidade'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdTenacidade = $this->idtenacidade"; 
              } 
              $Prep_Tst = (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] == "null"  && $this->nmgp_dados_select['idusuarioauditoria'] == "") ? "null" : $this->nmgp_dados_select['idusuarioauditoria'];
              if (isset($NM_val_form['idusuarioauditoria']) && $NM_val_form['idusuarioauditoria'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "IdUsuarioAuditoria = $this->idusuarioauditoria"; 
              } 
              $Prep_Tst = (isset($NM_val_form['anonotafiscal']) && $NM_val_form['anonotafiscal'] == "null"  && $this->nmgp_dados_select['anonotafiscal'] == "") ? "null" : $this->nmgp_dados_select['anonotafiscal'];
              if (isset($NM_val_form['anonotafiscal']) && $NM_val_form['anonotafiscal'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "AnoNotaFiscal = $this->anonotafiscal"; 
              } 
              $Prep_Tst = (isset($NM_val_form['sequencialnotafiscal']) && $NM_val_form['sequencialnotafiscal'] == "null"  && $this->nmgp_dados_select['sequencialnotafiscal'] == "") ? "null" : $this->nmgp_dados_select['sequencialnotafiscal'];
              if (isset($NM_val_form['sequencialnotafiscal']) && $NM_val_form['sequencialnotafiscal'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "SequencialNotaFiscal = $this->sequencialnotafiscal"; 
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
              if ($this->imagemfoto_limpa == "S")
              {
                  if ($this->imagemfoto != "null")
                  {
                      $this->imagemfoto = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                  }
                  else
                  {
                      $temp_cmd_sql = "ImagemFoto = '" . $this->imagemfoto . "'";
                  }
                  $this->imagemfoto = "";
              }
              else
              {
                  if ($this->imagemfoto != "none" && $this->imagemfoto != "" && $this->imagemfoto != "*nm*")
                  {
                      $NM_conteudo =  $this->imagemfoto;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      }
                      else
                      {
                          $temp_cmd_sql .= " ImagemFoto = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "imagemfoto";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              if ($this->imagemfoto_limpa == "S" || ($this->imagemfoto != "none" && $this->imagemfoto != "" && in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
                  { 
                      $SC_fields_update[] = "ImagemFoto = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql)) 
                  { 
                      $SC_fields_update[] = "ImagemFoto = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
                  { 
                      $SC_fields_update[] = "ImagemFoto = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite)) 
                  { 
                      $SC_fields_update[] = "ImagemFoto = ''"; 
                  } 
                  else 
                  { 
                      $SC_fields_update[] = "ImagemFoto = empty_blob()"; 
                  } 
              } 
             if (isset($this->Ini->nm_bases_oracle) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
             {
             if ($this->senhasmtp != "" && $this->senhasmtp != "null" && $this->senhasmtp != $this->nmgp_dados_select['senhasmtp']) 
             { 
                  $SC_fields_update[] = "SenhaSMTP = '$this->senhasmtp'" ; 
             } 
             if ($this->senhasms != "" && $this->senhasms != "null" && $this->senhasms != $this->nmgp_dados_select['senhasms']) 
             { 
                  $SC_fields_update[] = "SenhaSMS = '$this->senhasms'" ; 
             } 
             } 
             else 
             {
             if ($this->senhasmtp != "" && $this->senhasmtp != "null" && $this->senhasmtp != $this->nmgp_dados_select['senhasmtp']) 
             { 
                  $SC_fields_update[] = "SenhaSMTP = '$this->senhasmtp'" ; 
             } 
             if ($this->senhasms != "" && $this->senhasms != "null" && $this->senhasms != $this->nmgp_dados_select['senhasms']) 
             { 
                  $SC_fields_update[] = "SenhaSMS = '$this->senhasms'" ; 
             } 
             } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE IdConfiguracao = $this->idconfiguracao ";  
              }  
              else  
              {
                  $comando .= " WHERE IdConfiguracao = $this->idconfiguracao ";  
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
                                  Configuracao_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->servidorsmtp = $this->servidorsmtp_before_qstr;
              $this->usuariosmtp = $this->usuariosmtp_before_qstr;
              $this->senhasmtp = $this->senhasmtp_before_qstr;
              $this->remetente = $this->remetente_before_qstr;
              $this->assunto = $this->assunto_before_qstr;
              $this->msgenviosenha = $this->msgenviosenha_before_qstr;
              $this->usuariosms = $this->usuariosms_before_qstr;
              $this->senhasms = $this->senhasms_before_qstr;
              $this->urlsaida = $this->urlsaida_before_qstr;
              $this->servidorpdf = $this->servidorpdf_before_qstr;
              $this->diretoriopdf = $this->diretoriopdf_before_qstr;
              $this->contratolicenca = $this->contratolicenca_before_qstr;
              $this->clienteconcorrente = $this->clienteconcorrente_before_qstr;
              $this->notafiscalobrigatorio = $this->notafiscalobrigatorio_before_qstr;
              $this->coletadomiciliar = $this->coletadomiciliar_before_qstr;
              $this->diretorioexportacao = $this->diretorioexportacao_before_qstr;
              $this->diretorioarquivo = $this->diretorioarquivo_before_qstr;
              $this->relacaomodulos = $this->relacaomodulos_before_qstr;
              $this->relacaocadastros = $this->relacaocadastros_before_qstr;
              $this->clienteativo = $this->clienteativo_before_qstr;
              $this->integracaoinfolabativa = $this->integracaoinfolabativa_before_qstr;
              $this->recebeparcelado = $this->recebeparcelado_before_qstr;
              $this->usataxaadiantamento = $this->usataxaadiantamento_before_qstr;
              $this->gravarauditoria = $this->gravarauditoria_before_qstr;
              $this->utilizacentrocusto = $this->utilizacentrocusto_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if ($this->imagemfoto_limpa == "S" && (!isset($this->Ini->nm_bases_oracle) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) && (!isset($this->Ini->nm_bases_informix) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))) 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ImagemFoto\", \"\",  \"IdConfiguracao = $this->idconfiguracao\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ImagemFoto", "",  "IdConfiguracao = $this->idconfiguracao"); 
                  } 
                  else 
                  { 
                      if ($this->imagemfoto != "none" && $this->imagemfoto != "") 
                      { 
                          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"ImagemFoto\", $this->imagemfoto,  \"IdConfiguracao = $this->idconfiguracao\")"; 
                          $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ImagemFoto", $this->imagemfoto,  "IdConfiguracao = $this->idconfiguracao"); 
                      } 
                  } 
                  if ($rs === false) 
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          Configuracao_Frm_pack_ajax_response();
                      }
                      exit;  
                  }   
              }   
              if ($this->imagemfoto_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['imagemfoto_salva'] = array(
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['imagemfoto_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idcontacaixalancamentoreceitanotafiscal'])) { $this->idcontacaixalancamentoreceitanotafiscal = $NM_val_form['idcontacaixalancamentoreceitanotafiscal']; }
              elseif (isset($this->idcontacaixalancamentoreceitanotafiscal)) { $this->nm_limpa_alfa($this->idcontacaixalancamentoreceitanotafiscal); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcontacaixaint'])) { $this->idcontacaixaint = $NM_val_form['idcontacaixaint']; }
              elseif (isset($this->idcontacaixaint)) { $this->nm_limpa_alfa($this->idcontacaixaint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcontacaixacartao'])) { $this->idcontacaixacartao = $NM_val_form['idcontacaixacartao']; }
              elseif (isset($this->idcontacaixacartao)) { $this->nm_limpa_alfa($this->idcontacaixacartao); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontalancamentoreceitanotafiscal'])) { $this->idplanocontalancamentoreceitanotafiscal = $NM_val_form['idplanocontalancamentoreceitanotafiscal']; }
              elseif (isset($this->idplanocontalancamentoreceitanotafiscal)) { $this->nm_limpa_alfa($this->idplanocontalancamentoreceitanotafiscal); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontatransferenciaorigem'])) { $this->idplanocontatransferenciaorigem = $NM_val_form['idplanocontatransferenciaorigem']; }
              elseif (isset($this->idplanocontatransferenciaorigem)) { $this->nm_limpa_alfa($this->idplanocontatransferenciaorigem); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontatransferenciadestino'])) { $this->idplanocontatransferenciadestino = $NM_val_form['idplanocontatransferenciadestino']; }
              elseif (isset($this->idplanocontatransferenciadestino)) { $this->nm_limpa_alfa($this->idplanocontatransferenciadestino); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontadinheiroint'])) { $this->idplanocontadinheiroint = $NM_val_form['idplanocontadinheiroint']; }
              elseif (isset($this->idplanocontadinheiroint)) { $this->nm_limpa_alfa($this->idplanocontadinheiroint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontaguiaint'])) { $this->idplanocontaguiaint = $NM_val_form['idplanocontaguiaint']; }
              elseif (isset($this->idplanocontaguiaint)) { $this->nm_limpa_alfa($this->idplanocontaguiaint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontachequeint'])) { $this->idplanocontachequeint = $NM_val_form['idplanocontachequeint']; }
              elseif (isset($this->idplanocontachequeint)) { $this->nm_limpa_alfa($this->idplanocontachequeint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontacartaocreditoint'])) { $this->idplanocontacartaocreditoint = $NM_val_form['idplanocontacartaocreditoint']; }
              elseif (isset($this->idplanocontacartaocreditoint)) { $this->nm_limpa_alfa($this->idplanocontacartaocreditoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idplanocontacartaodebitoint'])) { $this->idplanocontacartaodebitoint = $NM_val_form['idplanocontacartaodebitoint']; }
              elseif (isset($this->idplanocontacartaodebitoint)) { $this->nm_limpa_alfa($this->idplanocontacartaodebitoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipoespecielancamentoreceitanotafiscal'])) { $this->idtipoespecielancamentoreceitanotafiscal = $NM_val_form['idtipoespecielancamentoreceitanotafiscal']; }
              elseif (isset($this->idtipoespecielancamentoreceitanotafiscal)) { $this->nm_limpa_alfa($this->idtipoespecielancamentoreceitanotafiscal); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipoespecietransferencia'])) { $this->idtipoespecietransferencia = $NM_val_form['idtipoespecietransferencia']; }
              elseif (isset($this->idtipoespecietransferencia)) { $this->nm_limpa_alfa($this->idtipoespecietransferencia); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipoespeciecartaocreditoint'])) { $this->idtipoespeciecartaocreditoint = $NM_val_form['idtipoespeciecartaocreditoint']; }
              elseif (isset($this->idtipoespeciecartaocreditoint)) { $this->nm_limpa_alfa($this->idtipoespeciecartaocreditoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipoespecieguiaint'])) { $this->idtipoespecieguiaint = $NM_val_form['idtipoespecieguiaint']; }
              elseif (isset($this->idtipoespecieguiaint)) { $this->nm_limpa_alfa($this->idtipoespecieguiaint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipoespeciechequeint'])) { $this->idtipoespeciechequeint = $NM_val_form['idtipoespeciechequeint']; }
              elseif (isset($this->idtipoespeciechequeint)) { $this->nm_limpa_alfa($this->idtipoespeciechequeint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipoespeciedinheiroint'])) { $this->idtipoespeciedinheiroint = $NM_val_form['idtipoespeciedinheiroint']; }
              elseif (isset($this->idtipoespeciedinheiroint)) { $this->nm_limpa_alfa($this->idtipoespeciedinheiroint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtipoespeciecartaodebitoint'])) { $this->idtipoespeciecartaodebitoint = $NM_val_form['idtipoespeciecartaodebitoint']; }
              elseif (isset($this->idtipoespeciecartaodebitoint)) { $this->nm_limpa_alfa($this->idtipoespeciecartaodebitoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idsituacaonovoclienteint'])) { $this->idsituacaonovoclienteint = $NM_val_form['idsituacaonovoclienteint']; }
              elseif (isset($this->idsituacaonovoclienteint)) { $this->nm_limpa_alfa($this->idsituacaonovoclienteint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idsituacaodocumentopendenteint'])) { $this->idsituacaodocumentopendenteint = $NM_val_form['idsituacaodocumentopendenteint']; }
              elseif (isset($this->idsituacaodocumentopendenteint)) { $this->nm_limpa_alfa($this->idsituacaodocumentopendenteint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idsituacaodocumentoexcluidoint'])) { $this->idsituacaodocumentoexcluidoint = $NM_val_form['idsituacaodocumentoexcluidoint']; }
              elseif (isset($this->idsituacaodocumentoexcluidoint)) { $this->nm_limpa_alfa($this->idsituacaodocumentoexcluidoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['idsituacaodocumentobaixadoint'])) { $this->idsituacaodocumentobaixadoint = $NM_val_form['idsituacaodocumentobaixadoint']; }
              elseif (isset($this->idsituacaodocumentobaixadoint)) { $this->nm_limpa_alfa($this->idsituacaodocumentobaixadoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['servidorsmtp'])) { $this->servidorsmtp = $NM_val_form['servidorsmtp']; }
              elseif (isset($this->servidorsmtp)) { $this->nm_limpa_alfa($this->servidorsmtp); }
              if     (isset($NM_val_form) && isset($NM_val_form['usuariosmtp'])) { $this->usuariosmtp = $NM_val_form['usuariosmtp']; }
              elseif (isset($this->usuariosmtp)) { $this->nm_limpa_alfa($this->usuariosmtp); }
              if     (isset($NM_val_form) && isset($NM_val_form['senhasmtp'])) { $this->senhasmtp = $NM_val_form['senhasmtp']; }
              elseif (isset($this->senhasmtp)) { $this->nm_limpa_alfa($this->senhasmtp); }
              if     (isset($NM_val_form) && isset($NM_val_form['remetente'])) { $this->remetente = $NM_val_form['remetente']; }
              elseif (isset($this->remetente)) { $this->nm_limpa_alfa($this->remetente); }
              if     (isset($NM_val_form) && isset($NM_val_form['assunto'])) { $this->assunto = $NM_val_form['assunto']; }
              elseif (isset($this->assunto)) { $this->nm_limpa_alfa($this->assunto); }
              if     (isset($NM_val_form) && isset($NM_val_form['msgenviosenha'])) { $this->msgenviosenha = $NM_val_form['msgenviosenha']; }
              elseif (isset($this->msgenviosenha)) { $this->nm_limpa_alfa($this->msgenviosenha); }
              if     (isset($NM_val_form) && isset($NM_val_form['usuariosms'])) { $this->usuariosms = $NM_val_form['usuariosms']; }
              elseif (isset($this->usuariosms)) { $this->nm_limpa_alfa($this->usuariosms); }
              if     (isset($NM_val_form) && isset($NM_val_form['senhasms'])) { $this->senhasms = $NM_val_form['senhasms']; }
              elseif (isset($this->senhasms)) { $this->nm_limpa_alfa($this->senhasms); }
              if     (isset($NM_val_form) && isset($NM_val_form['urlsaida'])) { $this->urlsaida = $NM_val_form['urlsaida']; }
              elseif (isset($this->urlsaida)) { $this->nm_limpa_alfa($this->urlsaida); }
              if     (isset($NM_val_form) && isset($NM_val_form['servidorpdf'])) { $this->servidorpdf = $NM_val_form['servidorpdf']; }
              elseif (isset($this->servidorpdf)) { $this->nm_limpa_alfa($this->servidorpdf); }
              if     (isset($NM_val_form) && isset($NM_val_form['diretoriopdf'])) { $this->diretoriopdf = $NM_val_form['diretoriopdf']; }
              elseif (isset($this->diretoriopdf)) { $this->nm_limpa_alfa($this->diretoriopdf); }
              if     (isset($NM_val_form) && isset($NM_val_form['clienteconcorrente'])) { $this->clienteconcorrente = $NM_val_form['clienteconcorrente']; }
              elseif (isset($this->clienteconcorrente)) { $this->nm_limpa_alfa($this->clienteconcorrente); }
              if     (isset($NM_val_form) && isset($NM_val_form['notafiscalobrigatorio'])) { $this->notafiscalobrigatorio = $NM_val_form['notafiscalobrigatorio']; }
              elseif (isset($this->notafiscalobrigatorio)) { $this->nm_limpa_alfa($this->notafiscalobrigatorio); }
              if     (isset($NM_val_form) && isset($NM_val_form['coletadomiciliar'])) { $this->coletadomiciliar = $NM_val_form['coletadomiciliar']; }
              elseif (isset($this->coletadomiciliar)) { $this->nm_limpa_alfa($this->coletadomiciliar); }
              if     (isset($NM_val_form) && isset($NM_val_form['diretorioexportacao'])) { $this->diretorioexportacao = $NM_val_form['diretorioexportacao']; }
              elseif (isset($this->diretorioexportacao)) { $this->nm_limpa_alfa($this->diretorioexportacao); }
              if     (isset($NM_val_form) && isset($NM_val_form['diretorioarquivo'])) { $this->diretorioarquivo = $NM_val_form['diretorioarquivo']; }
              elseif (isset($this->diretorioarquivo)) { $this->nm_limpa_alfa($this->diretorioarquivo); }
              if     (isset($NM_val_form) && isset($NM_val_form['relacaomodulos'])) { $this->relacaomodulos = $NM_val_form['relacaomodulos']; }
              elseif (isset($this->relacaomodulos)) { $this->nm_limpa_alfa($this->relacaomodulos); }
              if     (isset($NM_val_form) && isset($NM_val_form['relacaocadastros'])) { $this->relacaocadastros = $NM_val_form['relacaocadastros']; }
              elseif (isset($this->relacaocadastros)) { $this->nm_limpa_alfa($this->relacaocadastros); }
              if     (isset($NM_val_form) && isset($NM_val_form['clienteativo'])) { $this->clienteativo = $NM_val_form['clienteativo']; }
              elseif (isset($this->clienteativo)) { $this->nm_limpa_alfa($this->clienteativo); }
              if     (isset($NM_val_form) && isset($NM_val_form['diasprevisaocartaocreditoint'])) { $this->diasprevisaocartaocreditoint = $NM_val_form['diasprevisaocartaocreditoint']; }
              elseif (isset($this->diasprevisaocartaocreditoint)) { $this->nm_limpa_alfa($this->diasprevisaocartaocreditoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['diasprevisaocartaodebitoint'])) { $this->diasprevisaocartaodebitoint = $NM_val_form['diasprevisaocartaodebitoint']; }
              elseif (isset($this->diasprevisaocartaodebitoint)) { $this->nm_limpa_alfa($this->diasprevisaocartaodebitoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['taxaservicocartaocreditoint'])) { $this->taxaservicocartaocreditoint = $NM_val_form['taxaservicocartaocreditoint']; }
              elseif (isset($this->taxaservicocartaocreditoint)) { $this->nm_limpa_alfa($this->taxaservicocartaocreditoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['taxaservicocartaodebitoint'])) { $this->taxaservicocartaodebitoint = $NM_val_form['taxaservicocartaodebitoint']; }
              elseif (isset($this->taxaservicocartaodebitoint)) { $this->nm_limpa_alfa($this->taxaservicocartaodebitoint); }
              if     (isset($NM_val_form) && isset($NM_val_form['integracaoinfolabativa'])) { $this->integracaoinfolabativa = $NM_val_form['integracaoinfolabativa']; }
              elseif (isset($this->integracaoinfolabativa)) { $this->nm_limpa_alfa($this->integracaoinfolabativa); }
              if     (isset($NM_val_form) && isset($NM_val_form['recebeparcelado'])) { $this->recebeparcelado = $NM_val_form['recebeparcelado']; }
              elseif (isset($this->recebeparcelado)) { $this->nm_limpa_alfa($this->recebeparcelado); }
              if     (isset($NM_val_form) && isset($NM_val_form['usataxaadiantamento'])) { $this->usataxaadiantamento = $NM_val_form['usataxaadiantamento']; }
              elseif (isset($this->usataxaadiantamento)) { $this->nm_limpa_alfa($this->usataxaadiantamento); }
              if     (isset($NM_val_form) && isset($NM_val_form['gravarauditoria'])) { $this->gravarauditoria = $NM_val_form['gravarauditoria']; }
              elseif (isset($this->gravarauditoria)) { $this->nm_limpa_alfa($this->gravarauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['utilizacentrocusto'])) { $this->utilizacentrocusto = $NM_val_form['utilizacentrocusto']; }
              elseif (isset($this->utilizacentrocusto)) { $this->nm_limpa_alfa($this->utilizacentrocusto); }

              $this->nm_formatar_campos();

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('clienteativo', 'gravarauditoria', 'integracaoinfolabativa', 'usataxaadiantamento', 'recebeparcelado', 'utilizacentrocusto', 'urlsaida', 'clienteconcorrente', 'notafiscalobrigatorio', 'coletadomiciliar', 'diretorioexportacao', 'diretorioarquivo', 'diasprevisaocartaocreditoint', 'diasprevisaocartaodebitoint', 'taxaservicocartaocreditoint', 'taxaservicocartaodebitoint', 'relacaocadastros', 'relacaomodulos', 'contratolicenca', 'servidorsmtp', 'usuariosmtp', 'senhasmtp', 'remetente', 'assunto', 'msgenviosenha', 'usuariosms', 'senhasms', 'servidorpdf', 'diretoriopdf', 'idplanocontalancamentoreceitanotafiscal', 'idplanocontatransferenciaorigem', 'idplanocontatransferenciadestino', 'idplanocontadinheiroint', 'idplanocontaguiaint', 'idplanocontachequeint', 'idplanocontacartaocreditoint', 'idplanocontacartaodebitoint', 'idcontacaixalancamentoreceitanotafiscal', 'idcontacaixaint', 'idcontacaixacartao', 'idsituacaonovoclienteint', 'idsituacaodocumentopendenteint', 'idsituacaodocumentoexcluidoint', 'idsituacaodocumentobaixadoint', 'idtipoespecielancamentoreceitanotafiscal', 'idtipoespecietransferencia', 'idtipoespeciecartaocreditoint', 'idtipoespecieguiaint', 'idtipoespeciechequeint', 'idtipoespeciedinheiroint', 'idtipoespeciecartaodebitoint'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "IdConfiguracao, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(IdConfiguracao) from " . $this->Ini->nm_tabela; 
          $comando = "select max(IdConfiguracao) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  Configuracao_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $this->idconfiguracao_before_qstr = $this->idconfiguracao = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      Configuracao_Frm_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $_test_file = $this->fetchUniqueUploadName($this->imagemfoto_scfile_name, $dir_file, "imagemfoto");
              if (trim($this->imagemfoto_scfile_name) != $_test_file)
              {
                  $this->imagemfoto_scfile_name = $_test_file;
                  $this->imagemfoto = $_test_file;
                 $this->nomeaplicacaoauditoria_before_qstr = $this->nomeaplicacaoauditoria;
                 $this->nomeaplicacaoauditoria = substr($this->Db->qstr($this->nomeaplicacaoauditoria), 1, -1); 
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdTenacidade, IdContaCaixaLancamentoReceitaNotaFiscal, IdContaCaixaInt, IdContaCaixaCartao, IdPlanoContaLancamentoReceitaNotaFiscal, IdPlanoContaTransferenciaOrigem, IdPlanoContaTransferenciaDestino, IdPlanoContaDinheiroInt, IdPlanoContaGuiaInt, IdUsuarioAuditoria, IdPlanoContaChequeInt, IdPlanoContaCartaoCreditoInt, IdPlanoContaCartaoDebitoInt, IdTipoEspecieLancamentoReceitaNotaFiscal, IdTipoEspecieTransferencia, IdTipoEspecieCartaoCreditoInt, IdTipoEspecieGuiaInt, IdTipoEspecieChequeInt, IdTipoEspecieDinheiroInt, IdTipoEspecieCartaoDebitoInt, IdSituacaoNovoClienteInt, IdSituacaoDocumentoPendenteInt, IdSituacaoDocumentoExcluidoInt, IdSituacaoDocumentoBaixadoInt, ServidorSMTP, UsuarioSMTP, SenhaSMTP, Remetente, Assunto, MsgEnvioSenha, UsuarioSMS, SenhaSMS, URLSaida, ServidorPDF, DiretorioPDF, ContratoLicenca, ClienteConcorrente, NotaFiscalObrigatorio, ColetaDomiciliar, DiretorioExportacao, DiretorioArquivo, ImagemFoto, RelacaoModulos, RelacaoCadastros, ClienteAtivo, DiasPrevisaoCartaoCreditoInt, DiasPrevisaoCartaoDebitoInt, TaxaServicoCartaoCreditoInt, TaxaServicoCartaoDebitoInt, IntegracaoInfolabAtiva, RecebeParcelado, UsaTaxaAdiantamento, AnoNotaFiscal, SequencialNotaFiscal, GravarAuditoria, UtilizaCentroCusto, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES ($this->idtenacidade, $this->idcontacaixalancamentoreceitanotafiscal, $this->idcontacaixaint, $this->idcontacaixacartao, $this->idplanocontalancamentoreceitanotafiscal, $this->idplanocontatransferenciaorigem, $this->idplanocontatransferenciadestino, $this->idplanocontadinheiroint, $this->idplanocontaguiaint, $this->idusuarioauditoria, $this->idplanocontachequeint, $this->idplanocontacartaocreditoint, $this->idplanocontacartaodebitoint, $this->idtipoespecielancamentoreceitanotafiscal, $this->idtipoespecietransferencia, $this->idtipoespeciecartaocreditoint, $this->idtipoespecieguiaint, $this->idtipoespeciechequeint, $this->idtipoespeciedinheiroint, $this->idtipoespeciecartaodebitoint, $this->idsituacaonovoclienteint, $this->idsituacaodocumentopendenteint, $this->idsituacaodocumentoexcluidoint, $this->idsituacaodocumentobaixadoint, '$this->servidorsmtp', '$this->usuariosmtp', '$this->senhasmtp', '$this->remetente', '$this->assunto', '$this->msgenviosenha', '$this->usuariosms', '$this->senhasms', '$this->urlsaida', '$this->servidorpdf', '$this->diretoriopdf', '$this->contratolicenca', '$this->clienteconcorrente', '$this->notafiscalobrigatorio', '$this->coletadomiciliar', '$this->diretorioexportacao', '$this->diretorioarquivo', '$this->imagemfoto', '$this->relacaomodulos', '$this->relacaocadastros', '$this->clienteativo', $this->diasprevisaocartaocreditoint, $this->diasprevisaocartaodebitoint, $this->taxaservicocartaocreditoint, $this->taxaservicocartaodebitoint, '$this->integracaoinfolabativa', '$this->recebeparcelado', '$this->usataxaadiantamento', $this->anonotafiscal, $this->sequencialnotafiscal, '$this->gravarauditoria', '$this->utilizacentrocusto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdContaCaixaLancamentoReceitaNotaFiscal, IdContaCaixaInt, IdContaCaixaCartao, IdPlanoContaLancamentoReceitaNotaFiscal, IdPlanoContaTransferenciaOrigem, IdPlanoContaTransferenciaDestino, IdPlanoContaDinheiroInt, IdPlanoContaGuiaInt, IdUsuarioAuditoria, IdPlanoContaChequeInt, IdPlanoContaCartaoCreditoInt, IdPlanoContaCartaoDebitoInt, IdTipoEspecieLancamentoReceitaNotaFiscal, IdTipoEspecieTransferencia, IdTipoEspecieCartaoCreditoInt, IdTipoEspecieGuiaInt, IdTipoEspecieChequeInt, IdTipoEspecieDinheiroInt, IdTipoEspecieCartaoDebitoInt, IdSituacaoNovoClienteInt, IdSituacaoDocumentoPendenteInt, IdSituacaoDocumentoExcluidoInt, IdSituacaoDocumentoBaixadoInt, ServidorSMTP, UsuarioSMTP, SenhaSMTP, Remetente, Assunto, MsgEnvioSenha, UsuarioSMS, SenhaSMS, URLSaida, ServidorPDF, DiretorioPDF, ContratoLicenca, ClienteConcorrente, NotaFiscalObrigatorio, ColetaDomiciliar, DiretorioExportacao, DiretorioArquivo, ImagemFoto, RelacaoModulos, RelacaoCadastros, ClienteAtivo, DiasPrevisaoCartaoCreditoInt, DiasPrevisaoCartaoDebitoInt, TaxaServicoCartaoCreditoInt, TaxaServicoCartaoDebitoInt, IntegracaoInfolabAtiva, RecebeParcelado, UsaTaxaAdiantamento, AnoNotaFiscal, SequencialNotaFiscal, GravarAuditoria, UtilizaCentroCusto, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcontacaixalancamentoreceitanotafiscal, $this->idcontacaixaint, $this->idcontacaixacartao, $this->idplanocontalancamentoreceitanotafiscal, $this->idplanocontatransferenciaorigem, $this->idplanocontatransferenciadestino, $this->idplanocontadinheiroint, $this->idplanocontaguiaint, $this->idusuarioauditoria, $this->idplanocontachequeint, $this->idplanocontacartaocreditoint, $this->idplanocontacartaodebitoint, $this->idtipoespecielancamentoreceitanotafiscal, $this->idtipoespecietransferencia, $this->idtipoespeciecartaocreditoint, $this->idtipoespecieguiaint, $this->idtipoespeciechequeint, $this->idtipoespeciedinheiroint, $this->idtipoespeciecartaodebitoint, $this->idsituacaonovoclienteint, $this->idsituacaodocumentopendenteint, $this->idsituacaodocumentoexcluidoint, $this->idsituacaodocumentobaixadoint, '$this->servidorsmtp', '$this->usuariosmtp', '$this->senhasmtp', '$this->remetente', '$this->assunto', '$this->msgenviosenha', '$this->usuariosms', '$this->senhasms', '$this->urlsaida', '$this->servidorpdf', '$this->diretoriopdf', '$this->contratolicenca', '$this->clienteconcorrente', '$this->notafiscalobrigatorio', '$this->coletadomiciliar', '$this->diretorioexportacao', '$this->diretorioarquivo', '', '$this->relacaomodulos', '$this->relacaocadastros', '$this->clienteativo', $this->diasprevisaocartaocreditoint, $this->diasprevisaocartaodebitoint, $this->taxaservicocartaocreditoint, $this->taxaservicocartaodebitoint, '$this->integracaoinfolabativa', '$this->recebeparcelado', '$this->usataxaadiantamento', $this->anonotafiscal, $this->sequencialnotafiscal, '$this->gravarauditoria', '$this->utilizacentrocusto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdContaCaixaLancamentoReceitaNotaFiscal, IdContaCaixaInt, IdContaCaixaCartao, IdPlanoContaLancamentoReceitaNotaFiscal, IdPlanoContaTransferenciaOrigem, IdPlanoContaTransferenciaDestino, IdPlanoContaDinheiroInt, IdPlanoContaGuiaInt, IdUsuarioAuditoria, IdPlanoContaChequeInt, IdPlanoContaCartaoCreditoInt, IdPlanoContaCartaoDebitoInt, IdTipoEspecieLancamentoReceitaNotaFiscal, IdTipoEspecieTransferencia, IdTipoEspecieCartaoCreditoInt, IdTipoEspecieGuiaInt, IdTipoEspecieChequeInt, IdTipoEspecieDinheiroInt, IdTipoEspecieCartaoDebitoInt, IdSituacaoNovoClienteInt, IdSituacaoDocumentoPendenteInt, IdSituacaoDocumentoExcluidoInt, IdSituacaoDocumentoBaixadoInt, ServidorSMTP, UsuarioSMTP, SenhaSMTP, Remetente, Assunto, MsgEnvioSenha, UsuarioSMS, SenhaSMS, URLSaida, ServidorPDF, DiretorioPDF, ContratoLicenca, ClienteConcorrente, NotaFiscalObrigatorio, ColetaDomiciliar, DiretorioExportacao, DiretorioArquivo, ImagemFoto, RelacaoModulos, RelacaoCadastros, ClienteAtivo, DiasPrevisaoCartaoCreditoInt, DiasPrevisaoCartaoDebitoInt, TaxaServicoCartaoCreditoInt, TaxaServicoCartaoDebitoInt, IntegracaoInfolabAtiva, RecebeParcelado, UsaTaxaAdiantamento, AnoNotaFiscal, SequencialNotaFiscal, GravarAuditoria, UtilizaCentroCusto, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcontacaixalancamentoreceitanotafiscal, $this->idcontacaixaint, $this->idcontacaixacartao, $this->idplanocontalancamentoreceitanotafiscal, $this->idplanocontatransferenciaorigem, $this->idplanocontatransferenciadestino, $this->idplanocontadinheiroint, $this->idplanocontaguiaint, $this->idusuarioauditoria, $this->idplanocontachequeint, $this->idplanocontacartaocreditoint, $this->idplanocontacartaodebitoint, $this->idtipoespecielancamentoreceitanotafiscal, $this->idtipoespecietransferencia, $this->idtipoespeciecartaocreditoint, $this->idtipoespecieguiaint, $this->idtipoespeciechequeint, $this->idtipoespeciedinheiroint, $this->idtipoespeciecartaodebitoint, $this->idsituacaonovoclienteint, $this->idsituacaodocumentopendenteint, $this->idsituacaodocumentoexcluidoint, $this->idsituacaodocumentobaixadoint, '$this->servidorsmtp', '$this->usuariosmtp', '$this->senhasmtp', '$this->remetente', '$this->assunto', '$this->msgenviosenha', '$this->usuariosms', '$this->senhasms', '$this->urlsaida', '$this->servidorpdf', '$this->diretoriopdf', '$this->contratolicenca', '$this->clienteconcorrente', '$this->notafiscalobrigatorio', '$this->coletadomiciliar', '$this->diretorioexportacao', '$this->diretorioarquivo', '', '$this->relacaomodulos', '$this->relacaocadastros', '$this->clienteativo', $this->diasprevisaocartaocreditoint, $this->diasprevisaocartaodebitoint, $this->taxaservicocartaocreditoint, $this->taxaservicocartaodebitoint, '$this->integracaoinfolabativa', '$this->recebeparcelado', '$this->usataxaadiantamento', $this->anonotafiscal, $this->sequencialnotafiscal, '$this->gravarauditoria', '$this->utilizacentrocusto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdContaCaixaLancamentoReceitaNotaFiscal, IdContaCaixaInt, IdContaCaixaCartao, IdPlanoContaLancamentoReceitaNotaFiscal, IdPlanoContaTransferenciaOrigem, IdPlanoContaTransferenciaDestino, IdPlanoContaDinheiroInt, IdPlanoContaGuiaInt, IdUsuarioAuditoria, IdPlanoContaChequeInt, IdPlanoContaCartaoCreditoInt, IdPlanoContaCartaoDebitoInt, IdTipoEspecieLancamentoReceitaNotaFiscal, IdTipoEspecieTransferencia, IdTipoEspecieCartaoCreditoInt, IdTipoEspecieGuiaInt, IdTipoEspecieChequeInt, IdTipoEspecieDinheiroInt, IdTipoEspecieCartaoDebitoInt, IdSituacaoNovoClienteInt, IdSituacaoDocumentoPendenteInt, IdSituacaoDocumentoExcluidoInt, IdSituacaoDocumentoBaixadoInt, ServidorSMTP, UsuarioSMTP, SenhaSMTP, Remetente, Assunto, MsgEnvioSenha, UsuarioSMS, SenhaSMS, URLSaida, ServidorPDF, DiretorioPDF, ContratoLicenca, ClienteConcorrente, NotaFiscalObrigatorio, ColetaDomiciliar, DiretorioExportacao, DiretorioArquivo, ImagemFoto, RelacaoModulos, RelacaoCadastros, ClienteAtivo, DiasPrevisaoCartaoCreditoInt, DiasPrevisaoCartaoDebitoInt, TaxaServicoCartaoCreditoInt, TaxaServicoCartaoDebitoInt, IntegracaoInfolabAtiva, RecebeParcelado, UsaTaxaAdiantamento, AnoNotaFiscal, SequencialNotaFiscal, GravarAuditoria, UtilizaCentroCusto, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcontacaixalancamentoreceitanotafiscal, $this->idcontacaixaint, $this->idcontacaixacartao, $this->idplanocontalancamentoreceitanotafiscal, $this->idplanocontatransferenciaorigem, $this->idplanocontatransferenciadestino, $this->idplanocontadinheiroint, $this->idplanocontaguiaint, $this->idusuarioauditoria, $this->idplanocontachequeint, $this->idplanocontacartaocreditoint, $this->idplanocontacartaodebitoint, $this->idtipoespecielancamentoreceitanotafiscal, $this->idtipoespecietransferencia, $this->idtipoespeciecartaocreditoint, $this->idtipoespecieguiaint, $this->idtipoespeciechequeint, $this->idtipoespeciedinheiroint, $this->idtipoespeciecartaodebitoint, $this->idsituacaonovoclienteint, $this->idsituacaodocumentopendenteint, $this->idsituacaodocumentoexcluidoint, $this->idsituacaodocumentobaixadoint, '$this->servidorsmtp', '$this->usuariosmtp', '$this->senhasmtp', '$this->remetente', '$this->assunto', '$this->msgenviosenha', '$this->usuariosms', '$this->senhasms', '$this->urlsaida', '$this->servidorpdf', '$this->diretoriopdf', '$this->contratolicenca', '$this->clienteconcorrente', '$this->notafiscalobrigatorio', '$this->coletadomiciliar', '$this->diretorioexportacao', '$this->diretorioarquivo', '', '$this->relacaomodulos', '$this->relacaocadastros', '$this->clienteativo', $this->diasprevisaocartaocreditoint, $this->diasprevisaocartaodebitoint, $this->taxaservicocartaocreditoint, $this->taxaservicocartaodebitoint, '$this->integracaoinfolabativa', '$this->recebeparcelado', '$this->usataxaadiantamento', $this->anonotafiscal, $this->sequencialnotafiscal, '$this->gravarauditoria', '$this->utilizacentrocusto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdContaCaixaLancamentoReceitaNotaFiscal, IdContaCaixaInt, IdContaCaixaCartao, IdPlanoContaLancamentoReceitaNotaFiscal, IdPlanoContaTransferenciaOrigem, IdPlanoContaTransferenciaDestino, IdPlanoContaDinheiroInt, IdPlanoContaGuiaInt, IdUsuarioAuditoria, IdPlanoContaChequeInt, IdPlanoContaCartaoCreditoInt, IdPlanoContaCartaoDebitoInt, IdTipoEspecieLancamentoReceitaNotaFiscal, IdTipoEspecieTransferencia, IdTipoEspecieCartaoCreditoInt, IdTipoEspecieGuiaInt, IdTipoEspecieChequeInt, IdTipoEspecieDinheiroInt, IdTipoEspecieCartaoDebitoInt, IdSituacaoNovoClienteInt, IdSituacaoDocumentoPendenteInt, IdSituacaoDocumentoExcluidoInt, IdSituacaoDocumentoBaixadoInt, ServidorSMTP, UsuarioSMTP, SenhaSMTP, Remetente, Assunto, MsgEnvioSenha, UsuarioSMS, SenhaSMS, URLSaida, ServidorPDF, DiretorioPDF, ContratoLicenca, ClienteConcorrente, NotaFiscalObrigatorio, ColetaDomiciliar, DiretorioExportacao, DiretorioArquivo, ImagemFoto, RelacaoModulos, RelacaoCadastros, ClienteAtivo, DiasPrevisaoCartaoCreditoInt, DiasPrevisaoCartaoDebitoInt, TaxaServicoCartaoCreditoInt, TaxaServicoCartaoDebitoInt, IntegracaoInfolabAtiva, RecebeParcelado, UsaTaxaAdiantamento, AnoNotaFiscal, SequencialNotaFiscal, GravarAuditoria, UtilizaCentroCusto, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcontacaixalancamentoreceitanotafiscal, $this->idcontacaixaint, $this->idcontacaixacartao, $this->idplanocontalancamentoreceitanotafiscal, $this->idplanocontatransferenciaorigem, $this->idplanocontatransferenciadestino, $this->idplanocontadinheiroint, $this->idplanocontaguiaint, $this->idusuarioauditoria, $this->idplanocontachequeint, $this->idplanocontacartaocreditoint, $this->idplanocontacartaodebitoint, $this->idtipoespecielancamentoreceitanotafiscal, $this->idtipoespecietransferencia, $this->idtipoespeciecartaocreditoint, $this->idtipoespecieguiaint, $this->idtipoespeciechequeint, $this->idtipoespeciedinheiroint, $this->idtipoespeciecartaodebitoint, $this->idsituacaonovoclienteint, $this->idsituacaodocumentopendenteint, $this->idsituacaodocumentoexcluidoint, $this->idsituacaodocumentobaixadoint, '$this->servidorsmtp', '$this->usuariosmtp', '$this->senhasmtp', '$this->remetente', '$this->assunto', '$this->msgenviosenha', '$this->usuariosms', '$this->senhasms', '$this->urlsaida', '$this->servidorpdf', '$this->diretoriopdf', '$this->contratolicenca', '$this->clienteconcorrente', '$this->notafiscalobrigatorio', '$this->coletadomiciliar', '$this->diretorioexportacao', '$this->diretorioarquivo', '$this->imagemfoto', '$this->relacaomodulos', '$this->relacaocadastros', '$this->clienteativo', $this->diasprevisaocartaocreditoint, $this->diasprevisaocartaodebitoint, $this->taxaservicocartaocreditoint, $this->taxaservicocartaodebitoint, '$this->integracaoinfolabativa', '$this->recebeparcelado', '$this->usataxaadiantamento', $this->anonotafiscal, $this->sequencialnotafiscal, '$this->gravarauditoria', '$this->utilizacentrocusto', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
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
                              Configuracao_Frm_pack_ajax_response();
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
                          Configuracao_Frm_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->idconfiguracao =  $rsy->fields[0];
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
                  $this->idconfiguracao = $rsy->fields[0];
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
                  $this->idconfiguracao = $rsy->fields[0];
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
                  $this->idconfiguracao = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->servidorsmtp = $this->servidorsmtp_before_qstr;
              $this->usuariosmtp = $this->usuariosmtp_before_qstr;
              $this->senhasmtp = $this->senhasmtp_before_qstr;
              $this->remetente = $this->remetente_before_qstr;
              $this->assunto = $this->assunto_before_qstr;
              $this->msgenviosenha = $this->msgenviosenha_before_qstr;
              $this->usuariosms = $this->usuariosms_before_qstr;
              $this->senhasms = $this->senhasms_before_qstr;
              $this->urlsaida = $this->urlsaida_before_qstr;
              $this->servidorpdf = $this->servidorpdf_before_qstr;
              $this->diretoriopdf = $this->diretoriopdf_before_qstr;
              $this->contratolicenca = $this->contratolicenca_before_qstr;
              $this->clienteconcorrente = $this->clienteconcorrente_before_qstr;
              $this->notafiscalobrigatorio = $this->notafiscalobrigatorio_before_qstr;
              $this->coletadomiciliar = $this->coletadomiciliar_before_qstr;
              $this->diretorioexportacao = $this->diretorioexportacao_before_qstr;
              $this->diretorioarquivo = $this->diretorioarquivo_before_qstr;
              $this->relacaomodulos = $this->relacaomodulos_before_qstr;
              $this->relacaocadastros = $this->relacaocadastros_before_qstr;
              $this->clienteativo = $this->clienteativo_before_qstr;
              $this->integracaoinfolabativa = $this->integracaoinfolabativa_before_qstr;
              $this->recebeparcelado = $this->recebeparcelado_before_qstr;
              $this->usataxaadiantamento = $this->usataxaadiantamento_before_qstr;
              $this->gravarauditoria = $this->gravarauditoria_before_qstr;
              $this->utilizacentrocusto = $this->utilizacentrocusto_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if (trim($this->imagemfoto ) != "") 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ",  ImagemFoto , $this->imagemfoto,  \"IdConfiguracao = $this->idconfiguracao\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "ImagemFoto", $this->imagemfoto,  "IdConfiguracao = $this->idconfiguracao"); 
                      if ($rs === false)  
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              Configuracao_Frm_pack_ajax_response();
                          }
                          exit; 
                      }  
                  }  
              }  
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->servidorsmtp = $this->servidorsmtp_before_qstr;
              $this->usuariosmtp = $this->usuariosmtp_before_qstr;
              $this->senhasmtp = $this->senhasmtp_before_qstr;
              $this->remetente = $this->remetente_before_qstr;
              $this->assunto = $this->assunto_before_qstr;
              $this->msgenviosenha = $this->msgenviosenha_before_qstr;
              $this->usuariosms = $this->usuariosms_before_qstr;
              $this->senhasms = $this->senhasms_before_qstr;
              $this->urlsaida = $this->urlsaida_before_qstr;
              $this->servidorpdf = $this->servidorpdf_before_qstr;
              $this->diretoriopdf = $this->diretoriopdf_before_qstr;
              $this->contratolicenca = $this->contratolicenca_before_qstr;
              $this->clienteconcorrente = $this->clienteconcorrente_before_qstr;
              $this->notafiscalobrigatorio = $this->notafiscalobrigatorio_before_qstr;
              $this->coletadomiciliar = $this->coletadomiciliar_before_qstr;
              $this->diretorioexportacao = $this->diretorioexportacao_before_qstr;
              $this->diretorioarquivo = $this->diretorioarquivo_before_qstr;
              $this->relacaomodulos = $this->relacaomodulos_before_qstr;
              $this->relacaocadastros = $this->relacaocadastros_before_qstr;
              $this->clienteativo = $this->clienteativo_before_qstr;
              $this->integracaoinfolabativa = $this->integracaoinfolabativa_before_qstr;
              $this->recebeparcelado = $this->recebeparcelado_before_qstr;
              $this->usataxaadiantamento = $this->usataxaadiantamento_before_qstr;
              $this->gravarauditoria = $this->gravarauditoria_before_qstr;
              $this->utilizacentrocusto = $this->utilizacentrocusto_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->idconfiguracao = substr($this->Db->qstr($this->idconfiguracao), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdConfiguracao = $this->idconfiguracao "); 
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
                          Configuracao_Frm_pack_ajax_response();
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']);
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['parms'] = "idconfiguracao?#?$this->idconfiguracao?@?"; 
      }
      $this->nmgp_dados_form['imagemfoto'] = ""; 
      $this->imagemfoto_limpa = ""; 
      $this->imagemfoto_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idconfiguracao = null === $this->idconfiguracao ? null : substr($this->Db->qstr($this->idconfiguracao), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter'] . ")";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdConfiguracao, IdTenacidade, IdContaCaixaLancamentoReceitaNotaFiscal, IdContaCaixaInt, IdContaCaixaCartao, IdPlanoContaLancamentoReceitaNotaFiscal, IdPlanoContaTransferenciaOrigem, IdPlanoContaTransferenciaDestino, IdPlanoContaDinheiroInt, IdPlanoContaGuiaInt, IdUsuarioAuditoria, IdPlanoContaChequeInt, IdPlanoContaCartaoCreditoInt, IdPlanoContaCartaoDebitoInt, IdTipoEspecieLancamentoReceitaNotaFiscal, IdTipoEspecieTransferencia, IdTipoEspecieCartaoCreditoInt, IdTipoEspecieGuiaInt, IdTipoEspecieChequeInt, IdTipoEspecieDinheiroInt, IdTipoEspecieCartaoDebitoInt, IdSituacaoNovoClienteInt, IdSituacaoDocumentoPendenteInt, IdSituacaoDocumentoExcluidoInt, IdSituacaoDocumentoBaixadoInt, ServidorSMTP, UsuarioSMTP, SenhaSMTP, Remetente, Assunto, MsgEnvioSenha, UsuarioSMS, SenhaSMS, URLSaida, ServidorPDF, DiretorioPDF, ContratoLicenca, ClienteConcorrente, NotaFiscalObrigatorio, ColetaDomiciliar, DiretorioExportacao, DiretorioArquivo, ImagemFoto, RelacaoModulos, RelacaoCadastros, ClienteAtivo, DiasPrevisaoCartaoCreditoInt, DiasPrevisaoCartaoDebitoInt, TaxaServicoCartaoCreditoInt, TaxaServicoCartaoDebitoInt, IntegracaoInfolabAtiva, RecebeParcelado, UsaTaxaAdiantamento, AnoNotaFiscal, SequencialNotaFiscal, GravarAuditoria, UtilizaCentroCusto, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "IdConfiguracao = $this->idconfiguracao"; 
              }  
              else  
              {
                  $aWhere[] = "IdConfiguracao = $this->idconfiguracao"; 
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
          $sc_order_by = "IdConfiguracao";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['select'] = ""; 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter']))
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
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter'] = true;
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
              $this->idconfiguracao = $rs->fields[0] ; 
              $this->nmgp_dados_select['idconfiguracao'] = $this->idconfiguracao;
              $this->idtenacidade = $rs->fields[1] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idcontacaixalancamentoreceitanotafiscal = $rs->fields[2] ; 
              $this->nmgp_dados_select['idcontacaixalancamentoreceitanotafiscal'] = $this->idcontacaixalancamentoreceitanotafiscal;
              $this->idcontacaixaint = $rs->fields[3] ; 
              $this->nmgp_dados_select['idcontacaixaint'] = $this->idcontacaixaint;
              $this->idcontacaixacartao = $rs->fields[4] ; 
              $this->nmgp_dados_select['idcontacaixacartao'] = $this->idcontacaixacartao;
              $this->idplanocontalancamentoreceitanotafiscal = $rs->fields[5] ; 
              $this->nmgp_dados_select['idplanocontalancamentoreceitanotafiscal'] = $this->idplanocontalancamentoreceitanotafiscal;
              $this->idplanocontatransferenciaorigem = $rs->fields[6] ; 
              $this->nmgp_dados_select['idplanocontatransferenciaorigem'] = $this->idplanocontatransferenciaorigem;
              $this->idplanocontatransferenciadestino = $rs->fields[7] ; 
              $this->nmgp_dados_select['idplanocontatransferenciadestino'] = $this->idplanocontatransferenciadestino;
              $this->idplanocontadinheiroint = $rs->fields[8] ; 
              $this->nmgp_dados_select['idplanocontadinheiroint'] = $this->idplanocontadinheiroint;
              $this->idplanocontaguiaint = $rs->fields[9] ; 
              $this->nmgp_dados_select['idplanocontaguiaint'] = $this->idplanocontaguiaint;
              $this->idusuarioauditoria = $rs->fields[10] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->idplanocontachequeint = $rs->fields[11] ; 
              $this->nmgp_dados_select['idplanocontachequeint'] = $this->idplanocontachequeint;
              $this->idplanocontacartaocreditoint = $rs->fields[12] ; 
              $this->nmgp_dados_select['idplanocontacartaocreditoint'] = $this->idplanocontacartaocreditoint;
              $this->idplanocontacartaodebitoint = $rs->fields[13] ; 
              $this->nmgp_dados_select['idplanocontacartaodebitoint'] = $this->idplanocontacartaodebitoint;
              $this->idtipoespecielancamentoreceitanotafiscal = $rs->fields[14] ; 
              $this->nmgp_dados_select['idtipoespecielancamentoreceitanotafiscal'] = $this->idtipoespecielancamentoreceitanotafiscal;
              $this->idtipoespecietransferencia = $rs->fields[15] ; 
              $this->nmgp_dados_select['idtipoespecietransferencia'] = $this->idtipoespecietransferencia;
              $this->idtipoespeciecartaocreditoint = $rs->fields[16] ; 
              $this->nmgp_dados_select['idtipoespeciecartaocreditoint'] = $this->idtipoespeciecartaocreditoint;
              $this->idtipoespecieguiaint = $rs->fields[17] ; 
              $this->nmgp_dados_select['idtipoespecieguiaint'] = $this->idtipoespecieguiaint;
              $this->idtipoespeciechequeint = $rs->fields[18] ; 
              $this->nmgp_dados_select['idtipoespeciechequeint'] = $this->idtipoespeciechequeint;
              $this->idtipoespeciedinheiroint = $rs->fields[19] ; 
              $this->nmgp_dados_select['idtipoespeciedinheiroint'] = $this->idtipoespeciedinheiroint;
              $this->idtipoespeciecartaodebitoint = $rs->fields[20] ; 
              $this->nmgp_dados_select['idtipoespeciecartaodebitoint'] = $this->idtipoespeciecartaodebitoint;
              $this->idsituacaonovoclienteint = $rs->fields[21] ; 
              $this->nmgp_dados_select['idsituacaonovoclienteint'] = $this->idsituacaonovoclienteint;
              $this->idsituacaodocumentopendenteint = $rs->fields[22] ; 
              $this->nmgp_dados_select['idsituacaodocumentopendenteint'] = $this->idsituacaodocumentopendenteint;
              $this->idsituacaodocumentoexcluidoint = $rs->fields[23] ; 
              $this->nmgp_dados_select['idsituacaodocumentoexcluidoint'] = $this->idsituacaodocumentoexcluidoint;
              $this->idsituacaodocumentobaixadoint = $rs->fields[24] ; 
              $this->nmgp_dados_select['idsituacaodocumentobaixadoint'] = $this->idsituacaodocumentobaixadoint;
              $this->servidorsmtp = $rs->fields[25] ; 
              $this->nmgp_dados_select['servidorsmtp'] = $this->servidorsmtp;
              $this->usuariosmtp = $rs->fields[26] ; 
              $this->nmgp_dados_select['usuariosmtp'] = $this->usuariosmtp;
              $this->senhasmtp = $rs->fields[27] ; 
              $this->nmgp_dados_select['senhasmtp'] = $this->senhasmtp;
              $this->remetente = $rs->fields[28] ; 
              $this->nmgp_dados_select['remetente'] = $this->remetente;
              $this->assunto = $rs->fields[29] ; 
              $this->nmgp_dados_select['assunto'] = $this->assunto;
              $this->msgenviosenha = $rs->fields[30] ; 
              $this->nmgp_dados_select['msgenviosenha'] = $this->msgenviosenha;
              $this->usuariosms = $rs->fields[31] ; 
              $this->nmgp_dados_select['usuariosms'] = $this->usuariosms;
              $this->senhasms = $rs->fields[32] ; 
              $this->nmgp_dados_select['senhasms'] = $this->senhasms;
              $this->urlsaida = $rs->fields[33] ; 
              $this->nmgp_dados_select['urlsaida'] = $this->urlsaida;
              $this->servidorpdf = $rs->fields[34] ; 
              $this->nmgp_dados_select['servidorpdf'] = $this->servidorpdf;
              $this->diretoriopdf = $rs->fields[35] ; 
              $this->nmgp_dados_select['diretoriopdf'] = $this->diretoriopdf;
              $this->contratolicenca = $rs->fields[36] ; 
              $this->nmgp_dados_select['contratolicenca'] = $this->contratolicenca;
              $this->clienteconcorrente = $rs->fields[37] ; 
              $this->nmgp_dados_select['clienteconcorrente'] = $this->clienteconcorrente;
              $this->notafiscalobrigatorio = $rs->fields[38] ; 
              $this->nmgp_dados_select['notafiscalobrigatorio'] = $this->notafiscalobrigatorio;
              $this->coletadomiciliar = $rs->fields[39] ; 
              $this->nmgp_dados_select['coletadomiciliar'] = $this->coletadomiciliar;
              $this->diretorioexportacao = $rs->fields[40] ; 
              $this->nmgp_dados_select['diretorioexportacao'] = $this->diretorioexportacao;
              $this->diretorioarquivo = $rs->fields[41] ; 
              $this->nmgp_dados_select['diretorioarquivo'] = $this->diretorioarquivo;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $this->imagemfoto = $this->Db->BlobDecode($rs->fields[42]) ; 
              } 
              else
              { 
                  $this->imagemfoto = $rs->fields[42] ; 
              } 
              $this->nmgp_dados_select['imagemfoto'] = $this->imagemfoto;
              $this->relacaomodulos = $rs->fields[43] ; 
              $this->nmgp_dados_select['relacaomodulos'] = $this->relacaomodulos;
              $this->relacaocadastros = $rs->fields[44] ; 
              $this->nmgp_dados_select['relacaocadastros'] = $this->relacaocadastros;
              $this->clienteativo = $rs->fields[45] ; 
              $this->nmgp_dados_select['clienteativo'] = $this->clienteativo;
              $this->diasprevisaocartaocreditoint = $rs->fields[46] ; 
              $this->nmgp_dados_select['diasprevisaocartaocreditoint'] = $this->diasprevisaocartaocreditoint;
              $this->diasprevisaocartaodebitoint = $rs->fields[47] ; 
              $this->nmgp_dados_select['diasprevisaocartaodebitoint'] = $this->diasprevisaocartaodebitoint;
              $this->taxaservicocartaocreditoint = $rs->fields[48] ; 
              $this->nmgp_dados_select['taxaservicocartaocreditoint'] = $this->taxaservicocartaocreditoint;
              $this->taxaservicocartaodebitoint = $rs->fields[49] ; 
              $this->nmgp_dados_select['taxaservicocartaodebitoint'] = $this->taxaservicocartaodebitoint;
              $this->integracaoinfolabativa = $rs->fields[50] ; 
              $this->nmgp_dados_select['integracaoinfolabativa'] = $this->integracaoinfolabativa;
              $this->recebeparcelado = $rs->fields[51] ; 
              $this->nmgp_dados_select['recebeparcelado'] = $this->recebeparcelado;
              $this->usataxaadiantamento = $rs->fields[52] ; 
              $this->nmgp_dados_select['usataxaadiantamento'] = $this->usataxaadiantamento;
              $this->anonotafiscal = $rs->fields[53] ; 
              $this->nmgp_dados_select['anonotafiscal'] = $this->anonotafiscal;
              $this->sequencialnotafiscal = $rs->fields[54] ; 
              $this->nmgp_dados_select['sequencialnotafiscal'] = $this->sequencialnotafiscal;
              $this->gravarauditoria = $rs->fields[55] ; 
              $this->nmgp_dados_select['gravarauditoria'] = $this->gravarauditoria;
              $this->utilizacentrocusto = $rs->fields[56] ; 
              $this->nmgp_dados_select['utilizacentrocusto'] = $this->utilizacentrocusto;
              $this->enderecoipauditoria = $rs->fields[57] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[58] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->idconfiguracao = (string)$this->idconfiguracao; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idcontacaixalancamentoreceitanotafiscal = (string)$this->idcontacaixalancamentoreceitanotafiscal; 
              $this->idcontacaixaint = (string)$this->idcontacaixaint; 
              $this->idcontacaixacartao = (string)$this->idcontacaixacartao; 
              $this->idplanocontalancamentoreceitanotafiscal = (string)$this->idplanocontalancamentoreceitanotafiscal; 
              $this->idplanocontatransferenciaorigem = (string)$this->idplanocontatransferenciaorigem; 
              $this->idplanocontatransferenciadestino = (string)$this->idplanocontatransferenciadestino; 
              $this->idplanocontadinheiroint = (string)$this->idplanocontadinheiroint; 
              $this->idplanocontaguiaint = (string)$this->idplanocontaguiaint; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->idplanocontachequeint = (string)$this->idplanocontachequeint; 
              $this->idplanocontacartaocreditoint = (string)$this->idplanocontacartaocreditoint; 
              $this->idplanocontacartaodebitoint = (string)$this->idplanocontacartaodebitoint; 
              $this->idtipoespecielancamentoreceitanotafiscal = (string)$this->idtipoespecielancamentoreceitanotafiscal; 
              $this->idtipoespecietransferencia = (string)$this->idtipoespecietransferencia; 
              $this->idtipoespeciecartaocreditoint = (string)$this->idtipoespeciecartaocreditoint; 
              $this->idtipoespecieguiaint = (string)$this->idtipoespecieguiaint; 
              $this->idtipoespeciechequeint = (string)$this->idtipoespeciechequeint; 
              $this->idtipoespeciedinheiroint = (string)$this->idtipoespeciedinheiroint; 
              $this->idtipoespeciecartaodebitoint = (string)$this->idtipoespeciecartaodebitoint; 
              $this->idsituacaonovoclienteint = (string)$this->idsituacaonovoclienteint; 
              $this->idsituacaodocumentopendenteint = (string)$this->idsituacaodocumentopendenteint; 
              $this->idsituacaodocumentoexcluidoint = (string)$this->idsituacaodocumentoexcluidoint; 
              $this->idsituacaodocumentobaixadoint = (string)$this->idsituacaodocumentobaixadoint; 
              $this->diasprevisaocartaocreditoint = (string)$this->diasprevisaocartaocreditoint; 
              $this->diasprevisaocartaodebitoint = (string)$this->diasprevisaocartaodebitoint; 
              $this->taxaservicocartaocreditoint = (string)$this->taxaservicocartaocreditoint; 
              $this->taxaservicocartaodebitoint = (string)$this->taxaservicocartaodebitoint; 
              $this->anonotafiscal = (string)$this->anonotafiscal; 
              $this->sequencialnotafiscal = (string)$this->sequencialnotafiscal; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['parms'] = "idconfiguracao?#?$this->idconfiguracao?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sub_dir'][0]  = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_select'] = $this->nmgp_dados_select;
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
              $this->idconfiguracao = "";  
              $this->nmgp_dados_form["idconfiguracao"] = $this->idconfiguracao;
              $this->idtenacidade = "" . $_SESSION['varIdTenacidade'] . "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idcontacaixalancamentoreceitanotafiscal = "";  
              $this->nmgp_dados_form["idcontacaixalancamentoreceitanotafiscal"] = $this->idcontacaixalancamentoreceitanotafiscal;
              $this->idcontacaixaint = "";  
              $this->nmgp_dados_form["idcontacaixaint"] = $this->idcontacaixaint;
              $this->idcontacaixacartao = "";  
              $this->nmgp_dados_form["idcontacaixacartao"] = $this->idcontacaixacartao;
              $this->idplanocontalancamentoreceitanotafiscal = "";  
              $this->nmgp_dados_form["idplanocontalancamentoreceitanotafiscal"] = $this->idplanocontalancamentoreceitanotafiscal;
              $this->idplanocontatransferenciaorigem = "";  
              $this->nmgp_dados_form["idplanocontatransferenciaorigem"] = $this->idplanocontatransferenciaorigem;
              $this->idplanocontatransferenciadestino = "";  
              $this->nmgp_dados_form["idplanocontatransferenciadestino"] = $this->idplanocontatransferenciadestino;
              $this->idplanocontadinheiroint = "";  
              $this->nmgp_dados_form["idplanocontadinheiroint"] = $this->idplanocontadinheiroint;
              $this->idplanocontaguiaint = "";  
              $this->nmgp_dados_form["idplanocontaguiaint"] = $this->idplanocontaguiaint;
              $this->idusuarioauditoria = "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->idplanocontachequeint = "";  
              $this->nmgp_dados_form["idplanocontachequeint"] = $this->idplanocontachequeint;
              $this->idplanocontacartaocreditoint = "";  
              $this->nmgp_dados_form["idplanocontacartaocreditoint"] = $this->idplanocontacartaocreditoint;
              $this->idplanocontacartaodebitoint = "";  
              $this->nmgp_dados_form["idplanocontacartaodebitoint"] = $this->idplanocontacartaodebitoint;
              $this->idtipoespecielancamentoreceitanotafiscal = "";  
              $this->nmgp_dados_form["idtipoespecielancamentoreceitanotafiscal"] = $this->idtipoespecielancamentoreceitanotafiscal;
              $this->idtipoespecietransferencia = "";  
              $this->nmgp_dados_form["idtipoespecietransferencia"] = $this->idtipoespecietransferencia;
              $this->idtipoespeciecartaocreditoint = "";  
              $this->nmgp_dados_form["idtipoespeciecartaocreditoint"] = $this->idtipoespeciecartaocreditoint;
              $this->idtipoespecieguiaint = "";  
              $this->nmgp_dados_form["idtipoespecieguiaint"] = $this->idtipoespecieguiaint;
              $this->idtipoespeciechequeint = "";  
              $this->nmgp_dados_form["idtipoespeciechequeint"] = $this->idtipoespeciechequeint;
              $this->idtipoespeciedinheiroint = "";  
              $this->nmgp_dados_form["idtipoespeciedinheiroint"] = $this->idtipoespeciedinheiroint;
              $this->idtipoespeciecartaodebitoint = "";  
              $this->nmgp_dados_form["idtipoespeciecartaodebitoint"] = $this->idtipoespeciecartaodebitoint;
              $this->idsituacaonovoclienteint = "";  
              $this->nmgp_dados_form["idsituacaonovoclienteint"] = $this->idsituacaonovoclienteint;
              $this->idsituacaodocumentopendenteint = "";  
              $this->nmgp_dados_form["idsituacaodocumentopendenteint"] = $this->idsituacaodocumentopendenteint;
              $this->idsituacaodocumentoexcluidoint = "";  
              $this->nmgp_dados_form["idsituacaodocumentoexcluidoint"] = $this->idsituacaodocumentoexcluidoint;
              $this->idsituacaodocumentobaixadoint = "";  
              $this->nmgp_dados_form["idsituacaodocumentobaixadoint"] = $this->idsituacaodocumentobaixadoint;
              $this->servidorsmtp = "";  
              $this->nmgp_dados_form["servidorsmtp"] = $this->servidorsmtp;
              $this->usuariosmtp = "";  
              $this->nmgp_dados_form["usuariosmtp"] = $this->usuariosmtp;
              $this->senhasmtp = "";  
              $this->nmgp_dados_form["senhasmtp"] = $this->senhasmtp;
              $this->remetente = "";  
              $this->nmgp_dados_form["remetente"] = $this->remetente;
              $this->assunto = "";  
              $this->nmgp_dados_form["assunto"] = $this->assunto;
              $this->msgenviosenha = "";  
              $this->nmgp_dados_form["msgenviosenha"] = $this->msgenviosenha;
              $this->usuariosms = "";  
              $this->nmgp_dados_form["usuariosms"] = $this->usuariosms;
              $this->senhasms = "";  
              $this->nmgp_dados_form["senhasms"] = $this->senhasms;
              $this->urlsaida = "";  
              $this->nmgp_dados_form["urlsaida"] = $this->urlsaida;
              $this->servidorpdf = "";  
              $this->nmgp_dados_form["servidorpdf"] = $this->servidorpdf;
              $this->diretoriopdf = "";  
              $this->nmgp_dados_form["diretoriopdf"] = $this->diretoriopdf;
              $this->contratolicenca = "";  
              $this->nmgp_dados_form["contratolicenca"] = $this->contratolicenca;
              $this->clienteconcorrente = "";  
              $this->nmgp_dados_form["clienteconcorrente"] = $this->clienteconcorrente;
              $this->notafiscalobrigatorio = "S";  
              $this->nmgp_dados_form["notafiscalobrigatorio"] = $this->notafiscalobrigatorio;
              $this->coletadomiciliar = "";  
              $this->nmgp_dados_form["coletadomiciliar"] = $this->coletadomiciliar;
              $this->diretorioexportacao = "";  
              $this->nmgp_dados_form["diretorioexportacao"] = $this->diretorioexportacao;
              $this->diretorioarquivo = "";  
              $this->nmgp_dados_form["diretorioarquivo"] = $this->diretorioarquivo;
              $this->imagemfoto = "";  
              $this->imagemfoto_ul_name = "" ;  
              $this->imagemfoto_ul_type = "" ;  
              $this->nmgp_dados_form["imagemfoto"] = $this->imagemfoto;
              $this->relacaomodulos = "";  
              $this->nmgp_dados_form["relacaomodulos"] = $this->relacaomodulos;
              $this->relacaocadastros = "";  
              $this->nmgp_dados_form["relacaocadastros"] = $this->relacaocadastros;
              $this->clienteativo = "";  
              $this->nmgp_dados_form["clienteativo"] = $this->clienteativo;
              $this->diasprevisaocartaocreditoint = "";  
              $this->nmgp_dados_form["diasprevisaocartaocreditoint"] = $this->diasprevisaocartaocreditoint;
              $this->diasprevisaocartaodebitoint = "";  
              $this->nmgp_dados_form["diasprevisaocartaodebitoint"] = $this->diasprevisaocartaodebitoint;
              $this->taxaservicocartaocreditoint = "";  
              $this->nmgp_dados_form["taxaservicocartaocreditoint"] = $this->taxaservicocartaocreditoint;
              $this->taxaservicocartaodebitoint = "";  
              $this->nmgp_dados_form["taxaservicocartaodebitoint"] = $this->taxaservicocartaodebitoint;
              $this->integracaoinfolabativa = "";  
              $this->nmgp_dados_form["integracaoinfolabativa"] = $this->integracaoinfolabativa;
              $this->recebeparcelado = "";  
              $this->nmgp_dados_form["recebeparcelado"] = $this->recebeparcelado;
              $this->usataxaadiantamento = "";  
              $this->nmgp_dados_form["usataxaadiantamento"] = $this->usataxaadiantamento;
              $this->anonotafiscal = "";  
              $this->nmgp_dados_form["anonotafiscal"] = $this->anonotafiscal;
              $this->sequencialnotafiscal = "";  
              $this->nmgp_dados_form["sequencialnotafiscal"] = $this->sequencialnotafiscal;
              $this->gravarauditoria = "";  
              $this->nmgp_dados_form["gravarauditoria"] = $this->gravarauditoria;
              $this->utilizacentrocusto = "N";  
              $this->nmgp_dados_form["utilizacentrocusto"] = $this->utilizacentrocusto;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

/*----- Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/

function Gravar_Tabela_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
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
                Configuracao_Frm_pack_ajax_response();
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
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

function Preparar_LstFrm_OnSrip_OnLoad_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'on';
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
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Field_disabled_macro']['idtenacidade'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("idusuarioauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Field_disabled_macro']['idusuarioauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("enderecoipauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Field_disabled_macro']['enderecoipauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("nomeaplicacaoauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Field_disabled_macro']['nomeaplicacaoauditoria'] = array('I'=>array(),'U'=>array());
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
$_SESSION['scriptcase']['Configuracao_Frm']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              Configuracao_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
//-- 
   if ($this->nmgp_opcao == "novo")
   { 
       $out_imagemfoto = "";  
   } 
   else 
   { 
       $out_imagemfoto = $this->imagemfoto;  
   } 
   if ($this->imagemfoto != "" && $this->imagemfoto != "none")   
   { 
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
       { 
           $nm_tmp = nm_conv_img_access(substr($this->imagemfoto, 0, 12));
           if (is_string($this->imagemfoto) && substr($this->imagemfoto, 0, 4) != "*nm*" && is_string($nm_tmp) && substr($nm_tmp, 0, 4) == "*nm*") 
           { 
               $this->imagemfoto = nm_conv_img_access($this->imagemfoto);
           } 
       } 
       if (is_string($this->imagemfoto) && substr($this->imagemfoto, 0, 4) == "*nm*") 
       { 
           $this->imagemfoto = substr($this->imagemfoto, 4) ; 
           $this->imagemfoto = base64_decode($this->imagemfoto) ; 
       } 
       $img_pos_bm = (is_string($this->imagemfoto)) ? strpos($this->imagemfoto, "BM") : false; 
       if (!$img_pos_bm === FALSE && $img_pos_bm == 78) 
       { 
           $this->imagemfoto = substr($this->imagemfoto, $img_pos_bm) ; 
       } 
       $Ext_File = $this->scGetImageExtension($this->imagemfoto);
       $out_imagemfoto = $this->Ini->path_imag_temp . "/sc_imagemfoto_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . $Ext_File;  
       $arq_imagemfoto = fopen($this->Ini->root . $out_imagemfoto, "w") ;  
       fwrite($arq_imagemfoto, (string)$this->imagemfoto) ;  
       fclose($arq_imagemfoto) ;  
       $sc_obj_img = new nm_trata_img($this->Ini->root . $out_imagemfoto, true);
       $this->nmgp_return_img['imagemfoto'][0] = $sc_obj_img->getHeight();
       $this->nmgp_return_img['imagemfoto'][1] = $sc_obj_img->getWidth();
       if ($this->Ini->Export_img_zip) {
           $this->Ini->Img_export_zip[] = $this->Ini->root . $out_imagemfoto;
           $out_imagemfoto = str_replace($this->Ini->path_imag_temp . "/", "", $out_imagemfoto);
       } 
       $_SESSION['scriptcase']['sc_num_img']++ ; 
   } 
   if (isset($_POST['nmgp_opcao']) && 'excluir' == $_POST['nmgp_opcao'] && $this->sc_evento != "delete" && (!isset($this->sc_evento_old) || 'delete' != $this->sc_evento_old))
   {
       global $temp_out_imagemfoto;
       if (isset($temp_out_imagemfoto))
       {
           $out_imagemfoto = $temp_out_imagemfoto;
       }
   }
        $this->initFormPages();
    include_once("Configuracao_Frm_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idconfiguracao", "servidorsmtp", "usuariosmtp", "senhasmtp", "remetente", "assunto", "msgenviosenha", "urlsaida", "servidorpdf", "diretoriopdf", "clienteconcorrente", "notafiscalobrigatorio", "coletadomiciliar", "diretorioexportacao", "diretorioqualidade"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

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

   function Form_lookup_clienteativo()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?S?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_gravarauditoria()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "?#?S?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_integracaoinfolabativa()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Ativa?#?S?#?N?@?";
       $nmgp_def_dados .= "Inativa?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_usataxaadiantamento()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?S?#??@?";
       $nmgp_def_dados .= "Não?#?N?#??@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_recebeparcelado()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?S?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_utilizacentrocusto()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "?#?S?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_clienteconcorrente()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?S?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_notafiscalobrigatorio()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?S?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_coletadomiciliar()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?S?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_idplanocontalancamentoreceitanotafiscal()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Origem = 'R' AND IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontalancamentoreceitanotafiscal'][] = $rs->fields[0];
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
   function Form_lookup_idplanocontatransferenciaorigem()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Origem = 'D' AND IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciaorigem'][] = $rs->fields[0];
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
   function Form_lookup_idplanocontatransferenciadestino()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE Origem = 'R' AND IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontatransferenciadestino'][] = $rs->fields[0];
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
   function Form_lookup_idplanocontadinheiroint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontadinheiroint'][] = $rs->fields[0];
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
   function Form_lookup_idplanocontaguiaint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontaguiaint'][] = $rs->fields[0];
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
   function Form_lookup_idplanocontachequeint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontachequeint'][] = $rs->fields[0];
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
   function Form_lookup_idplanocontacartaocreditoint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaocreditoint'][] = $rs->fields[0];
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
   function Form_lookup_idplanocontacartaodebitoint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdPlanoConta, CONCAT(Classificador,\" - \",Descricao) FROM planoconta  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' and origem = 'R' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idplanocontacartaodebitoint'][] = $rs->fields[0];
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
   function Form_lookup_idcontacaixalancamentoreceitanotafiscal()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdContaCaixa, Descricao  FROM contacaixa  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixalancamentoreceitanotafiscal'][] = $rs->fields[0];
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
   function Form_lookup_idcontacaixaint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdContaCaixa, Descricao  FROM contacaixa  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixaint'][] = $rs->fields[0];
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
   function Form_lookup_idcontacaixacartao()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdContaCaixa, Descricao  FROM contacaixa  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idcontacaixacartao'][] = $rs->fields[0];
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
   function Form_lookup_idsituacaonovoclienteint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoCliente,Descricao  FROM situacaocliente  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaonovoclienteint'][] = $rs->fields[0];
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
   function Form_lookup_idsituacaodocumentopendenteint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentopendenteint'][] = $rs->fields[0];
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
   function Form_lookup_idsituacaodocumentoexcluidoint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentoexcluidoint'][] = $rs->fields[0];
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
   function Form_lookup_idsituacaodocumentobaixadoint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdSituacaoDocumento, Descricao  FROM situacaodocumento  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idsituacaodocumentobaixadoint'][] = $rs->fields[0];
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
   function Form_lookup_idtipoespecielancamentoreceitanotafiscal()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecielancamentoreceitanotafiscal'][] = $rs->fields[0];
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
   function Form_lookup_idtipoespecietransferencia()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE     IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "' ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecietransferencia'][] = $rs->fields[0];
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
   function Form_lookup_idtipoespeciecartaocreditoint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaocreditoint'][] = $rs->fields[0];
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
   function Form_lookup_idtipoespecieguiaint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespecieguiaint'][] = $rs->fields[0];
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
   function Form_lookup_idtipoespeciechequeint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciechequeint'][] = $rs->fields[0];
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
   function Form_lookup_idtipoespeciedinheiroint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciedinheiroint'][] = $rs->fields[0];
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
   function Form_lookup_idtipoespeciecartaodebitoint()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'] = array(); 
    }

   $old_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $old_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $old_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $old_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;
   $this->nm_tira_formatacao();


   $unformatted_value_diasprevisaocartaocreditoint = $this->diasprevisaocartaocreditoint;
   $unformatted_value_diasprevisaocartaodebitoint = $this->diasprevisaocartaodebitoint;
   $unformatted_value_taxaservicocartaocreditoint = $this->taxaservicocartaocreditoint;
   $unformatted_value_taxaservicocartaodebitoint = $this->taxaservicocartaodebitoint;

   $nm_comando = "SELECT IdTipoEspecie, Descricao  FROM tipoespecie  WHERE IdTenacidade = '" . $_SESSION['varIdTenacidade'] . "'  ORDER BY Descricao";

   $this->diasprevisaocartaocreditoint = $old_value_diasprevisaocartaocreditoint;
   $this->diasprevisaocartaodebitoint = $old_value_diasprevisaocartaodebitoint;
   $this->taxaservicocartaocreditoint = $old_value_taxaservicocartaocreditoint;
   $this->taxaservicocartaodebitoint = $old_value_taxaservicocartaodebitoint;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['Lookup_idtipoespeciecartaodebitoint'][] = $rs->fields[0];
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              Configuracao_Frm_pack_ajax_response();
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
              $this->SC_monta_condicao($comando, "IdConfiguracao", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ServidorSMTP", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "UsuarioSMTP", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "SenhaSMTP", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Remetente", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Assunto", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "MsgEnvioSenha", $arg_search, $data_search, "TEXT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "URLSaida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "ServidorPDF", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DiretorioPDF", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_clienteconcorrente($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "ClienteConcorrente", $arg_search, $data_lookup, "CHAR", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_notafiscalobrigatorio($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "NotaFiscalObrigatorio", $arg_search, $data_lookup, "CHAR", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_coletadomiciliar($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "ColetaDomiciliar", $arg_search, $data_lookup, "CHAR", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "DiretorioExportacao", $arg_search, $data_search, "VARCHAR", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_Configuracao_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total'] = $qt_geral_reg_Configuracao_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          Configuracao_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          Configuracao_Frm_pack_ajax_response();
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
      $nm_numeric[] = "idconfiguracao";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idcontacaixalancamentoreceitanotafiscal";$nm_numeric[] = "idcontacaixaint";$nm_numeric[] = "idcontacaixacartao";$nm_numeric[] = "idplanocontalancamentoreceitanotafiscal";$nm_numeric[] = "idplanocontatransferenciaorigem";$nm_numeric[] = "idplanocontatransferenciadestino";$nm_numeric[] = "idplanocontadinheiroint";$nm_numeric[] = "idplanocontaguiaint";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "idplanocontachequeint";$nm_numeric[] = "idplanocontacartaocreditoint";$nm_numeric[] = "idplanocontacartaodebitoint";$nm_numeric[] = "idtipoespecielancamentoreceitanotafiscal";$nm_numeric[] = "idtipoespecietransferencia";$nm_numeric[] = "idtipoespeciecartaocreditoint";$nm_numeric[] = "idtipoespecieguiaint";$nm_numeric[] = "idtipoespeciechequeint";$nm_numeric[] = "idtipoespeciedinheiroint";$nm_numeric[] = "idtipoespeciecartaodebitoint";$nm_numeric[] = "idsituacaonovoclienteint";$nm_numeric[] = "idsituacaodocumentopendenteint";$nm_numeric[] = "idsituacaodocumentoexcluidoint";$nm_numeric[] = "idsituacaodocumentobaixadoint";$nm_numeric[] = "diasprevisaocartaocreditoint";$nm_numeric[] = "diasprevisaocartaodebitoint";$nm_numeric[] = "taxaservicocartaocreditoint";$nm_numeric[] = "taxaservicocartaodebitoint";$nm_numeric[] = "anonotafiscal";$nm_numeric[] = "sequencialnotafiscal";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['decimal_db'] == ".")
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
   function SC_lookup_clienteconcorrente($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['S'] = "Sim";
       $data_look['N'] = "Não";
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
   function SC_lookup_notafiscalobrigatorio($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['S'] = "Sim";
       $data_look['N'] = "Não";
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
   function SC_lookup_coletadomiciliar($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['S'] = "Sim";
       $data_look['N'] = "Não";
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
       $nmgp_saida_form = "Configuracao_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "Configuracao_Frm_fim.php";
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
       Configuracao_Frm_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           Configuracao_Frm_pack_ajax_response();
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
       Configuracao_Frm_pack_ajax_response();
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " Configuração"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Configuração"; } ?></span></td>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['link_info']['compact_mode']) {
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['Configuracao_Frm']['ordem_ord'] == " desc") {
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
            case "DiasPrevisaoCartaoCreditoInt":
                return true;
            case "DiasPrevisaoCartaoDebitoInt":
                return true;
            case "TaxaServicoCartaoCreditoInt":
                return true;
            case "TaxaServicoCartaoDebitoInt":
                return true;
            case "IdConfiguracao":
                return true;
            case "IdUsuarioAuditoria":
                return true;
            case "AnoNotaFiscal":
                return true;
            case "SequencialNotaFiscal":
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
