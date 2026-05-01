<?php
//
class AlmoxarifadoImportacaoXml_Ctr_apl
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
   var $idfornecedor;
   var $idfornecedor_1;
   var $nomefantasia;
   var $nomereferencia;
   var $nomereferencia_scfile_name;
   var $nomereferencia_ul_name;
   var $nomereferencia_ul_type;
   var $nomereferencia_limpa;
   var $nomereferencia_salva;
   var $codigonota;
   var $chavenota;
   var $numeronota;
   var $versaonota;
   var $naturezanota;
   var $serienota;
   var $dataemissaonota;
   var $dataemissaonota_hora;
   var $cnpjnota;
   var $razaosocialnota;
   var $nomefantasianota;
   var $logradouronota;
   var $numerologradouronota;
   var $complementonota;
   var $bairronota;
   var $cidadenota;
   var $estadonota;
   var $cepnota;
   var $telefonenota;
   var $msgfornecedor;
   var $razaosocial;
   var $cnpj;
   var $logradouro;
   var $numero;
   var $bairro;
   var $cidade;
   var $estado;
   var $cep;
   var $complemento;
   var $telefone;
   var $valortotal;
   var $valordesconto;
   var $valorcofins;
   var $valorpis;
   var $valorliquido;
   var $valoricms;
   var $valorfrete;
   var $observacoes;
   var $idalmoxarifadonota;
   var $idalmoxarifadonota_1;
   var $qtdprodutos;
   var $qtdparcelas;
   var $produtos;
   var $nomearquivo;
   var $numerofaturanota;
   var $parcelas;
   var $descricaoprodutos;
   var $descricaoparcelas;
   var $detprodutos;
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
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['bairro']))
          {
              $this->bairro = $this->NM_ajax_info['param']['bairro'];
          }
          if (isset($this->NM_ajax_info['param']['bairronota']))
          {
              $this->bairronota = $this->NM_ajax_info['param']['bairronota'];
          }
          if (isset($this->NM_ajax_info['param']['cep']))
          {
              $this->cep = $this->NM_ajax_info['param']['cep'];
          }
          if (isset($this->NM_ajax_info['param']['cepnota']))
          {
              $this->cepnota = $this->NM_ajax_info['param']['cepnota'];
          }
          if (isset($this->NM_ajax_info['param']['chavenota']))
          {
              $this->chavenota = $this->NM_ajax_info['param']['chavenota'];
          }
          if (isset($this->NM_ajax_info['param']['cidade']))
          {
              $this->cidade = $this->NM_ajax_info['param']['cidade'];
          }
          if (isset($this->NM_ajax_info['param']['cidadenota']))
          {
              $this->cidadenota = $this->NM_ajax_info['param']['cidadenota'];
          }
          if (isset($this->NM_ajax_info['param']['cnpj']))
          {
              $this->cnpj = $this->NM_ajax_info['param']['cnpj'];
          }
          if (isset($this->NM_ajax_info['param']['cnpjnota']))
          {
              $this->cnpjnota = $this->NM_ajax_info['param']['cnpjnota'];
          }
          if (isset($this->NM_ajax_info['param']['codigonota']))
          {
              $this->codigonota = $this->NM_ajax_info['param']['codigonota'];
          }
          if (isset($this->NM_ajax_info['param']['complemento']))
          {
              $this->complemento = $this->NM_ajax_info['param']['complemento'];
          }
          if (isset($this->NM_ajax_info['param']['complementonota']))
          {
              $this->complementonota = $this->NM_ajax_info['param']['complementonota'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['dataemissaonota']))
          {
              $this->dataemissaonota = $this->NM_ajax_info['param']['dataemissaonota'];
          }
          if (isset($this->NM_ajax_info['param']['descricaoparcelas']))
          {
              $this->descricaoparcelas = $this->NM_ajax_info['param']['descricaoparcelas'];
          }
          if (isset($this->NM_ajax_info['param']['detprodutos']))
          {
              $this->detprodutos = $this->NM_ajax_info['param']['detprodutos'];
          }
          if (isset($this->NM_ajax_info['param']['estado']))
          {
              $this->estado = $this->NM_ajax_info['param']['estado'];
          }
          if (isset($this->NM_ajax_info['param']['estadonota']))
          {
              $this->estadonota = $this->NM_ajax_info['param']['estadonota'];
          }
          if (isset($this->NM_ajax_info['param']['idalmoxarifadonota']))
          {
              $this->idalmoxarifadonota = $this->NM_ajax_info['param']['idalmoxarifadonota'];
          }
          if (isset($this->NM_ajax_info['param']['idfornecedor']))
          {
              $this->idfornecedor = $this->NM_ajax_info['param']['idfornecedor'];
          }
          if (isset($this->NM_ajax_info['param']['logradouro']))
          {
              $this->logradouro = $this->NM_ajax_info['param']['logradouro'];
          }
          if (isset($this->NM_ajax_info['param']['logradouronota']))
          {
              $this->logradouronota = $this->NM_ajax_info['param']['logradouronota'];
          }
          if (isset($this->NM_ajax_info['param']['msgfornecedor']))
          {
              $this->msgfornecedor = $this->NM_ajax_info['param']['msgfornecedor'];
          }
          if (isset($this->NM_ajax_info['param']['naturezanota']))
          {
              $this->naturezanota = $this->NM_ajax_info['param']['naturezanota'];
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
          if (isset($this->NM_ajax_info['param']['nomefantasia']))
          {
              $this->nomefantasia = $this->NM_ajax_info['param']['nomefantasia'];
          }
          if (isset($this->NM_ajax_info['param']['nomefantasianota']))
          {
              $this->nomefantasianota = $this->NM_ajax_info['param']['nomefantasianota'];
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
          if (isset($this->NM_ajax_info['param']['numero']))
          {
              $this->numero = $this->NM_ajax_info['param']['numero'];
          }
          if (isset($this->NM_ajax_info['param']['numerofaturanota']))
          {
              $this->numerofaturanota = $this->NM_ajax_info['param']['numerofaturanota'];
          }
          if (isset($this->NM_ajax_info['param']['numerologradouronota']))
          {
              $this->numerologradouronota = $this->NM_ajax_info['param']['numerologradouronota'];
          }
          if (isset($this->NM_ajax_info['param']['numeronota']))
          {
              $this->numeronota = $this->NM_ajax_info['param']['numeronota'];
          }
          if (isset($this->NM_ajax_info['param']['observacoes']))
          {
              $this->observacoes = $this->NM_ajax_info['param']['observacoes'];
          }
          if (isset($this->NM_ajax_info['param']['parcelas']))
          {
              $this->parcelas = $this->NM_ajax_info['param']['parcelas'];
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
          if (isset($this->NM_ajax_info['param']['razaosocialnota']))
          {
              $this->razaosocialnota = $this->NM_ajax_info['param']['razaosocialnota'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['serienota']))
          {
              $this->serienota = $this->NM_ajax_info['param']['serienota'];
          }
          if (isset($this->NM_ajax_info['param']['telefone']))
          {
              $this->telefone = $this->NM_ajax_info['param']['telefone'];
          }
          if (isset($this->NM_ajax_info['param']['telefonenota']))
          {
              $this->telefonenota = $this->NM_ajax_info['param']['telefonenota'];
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
          if (isset($this->NM_ajax_info['param']['versaonota']))
          {
              $this->versaonota = $this->NM_ajax_info['param']['versaonota'];
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
      if (isset($this->varIdAlmoxarifadoNota) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdAlmoxarifadoNota'] = $this->varIdAlmoxarifadoNota;
      }
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varIdUnico) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUnico'] = $this->varIdUnico;
      }
      if (isset($this->varVetProdutos) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varVetProdutos'] = $this->varVetProdutos;
      }
      if (isset($this->varImportar) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varImportar'] = $this->varImportar;
      }
      if (isset($this->varMsgErroNota) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varMsgErroNota'] = $this->varMsgErroNota;
      }
      if (isset($this->varMsgErroParcelas) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varMsgErroParcelas'] = $this->varMsgErroParcelas;
      }
      if (isset($this->varMsgErroProdutos) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varMsgErroProdutos'] = $this->varMsgErroProdutos;
      }
      if (isset($_POST["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
      }
      if (isset($_POST["varIdAlmoxarifadoNota"]) && isset($this->varIdAlmoxarifadoNota)) 
      {
          $_SESSION['varIdAlmoxarifadoNota'] = $this->varIdAlmoxarifadoNota;
      }
      if (!isset($_POST["varIdAlmoxarifadoNota"]) && isset($_POST["varidalmoxarifadonota"])) 
      {
          $_SESSION['varIdAlmoxarifadoNota'] = $_POST["varidalmoxarifadonota"];
      }
      if (isset($_POST["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_POST["varIdUsuario"]) && isset($_POST["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_POST["varidusuario"];
      }
      if (isset($_POST["varIdUnico"]) && isset($this->varIdUnico)) 
      {
          $_SESSION['varIdUnico'] = $this->varIdUnico;
      }
      if (!isset($_POST["varIdUnico"]) && isset($_POST["varidunico"])) 
      {
          $_SESSION['varIdUnico'] = $_POST["varidunico"];
      }
      if (isset($_POST["varVetProdutos"]) && isset($this->varVetProdutos)) 
      {
          $_SESSION['varVetProdutos'] = $this->varVetProdutos;
      }
      if (!isset($_POST["varVetProdutos"]) && isset($_POST["varvetprodutos"])) 
      {
          $_SESSION['varVetProdutos'] = $_POST["varvetprodutos"];
      }
      if (isset($_POST["varImportar"]) && isset($this->varImportar)) 
      {
          $_SESSION['varImportar'] = $this->varImportar;
      }
      if (!isset($_POST["varImportar"]) && isset($_POST["varimportar"])) 
      {
          $_SESSION['varImportar'] = $_POST["varimportar"];
      }
      if (isset($_POST["varMsgErroNota"]) && isset($this->varMsgErroNota)) 
      {
          $_SESSION['varMsgErroNota'] = $this->varMsgErroNota;
      }
      if (!isset($_POST["varMsgErroNota"]) && isset($_POST["varmsgerronota"])) 
      {
          $_SESSION['varMsgErroNota'] = $_POST["varmsgerronota"];
      }
      if (isset($_POST["varMsgErroParcelas"]) && isset($this->varMsgErroParcelas)) 
      {
          $_SESSION['varMsgErroParcelas'] = $this->varMsgErroParcelas;
      }
      if (!isset($_POST["varMsgErroParcelas"]) && isset($_POST["varmsgerroparcelas"])) 
      {
          $_SESSION['varMsgErroParcelas'] = $_POST["varmsgerroparcelas"];
      }
      if (isset($_POST["varMsgErroProdutos"]) && isset($this->varMsgErroProdutos)) 
      {
          $_SESSION['varMsgErroProdutos'] = $this->varMsgErroProdutos;
      }
      if (!isset($_POST["varMsgErroProdutos"]) && isset($_POST["varmsgerroprodutos"])) 
      {
          $_SESSION['varMsgErroProdutos'] = $_POST["varmsgerroprodutos"];
      }
      if (isset($_GET["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
      }
      if (isset($_GET["varIdAlmoxarifadoNota"]) && isset($this->varIdAlmoxarifadoNota)) 
      {
          $_SESSION['varIdAlmoxarifadoNota'] = $this->varIdAlmoxarifadoNota;
      }
      if (!isset($_GET["varIdAlmoxarifadoNota"]) && isset($_GET["varidalmoxarifadonota"])) 
      {
          $_SESSION['varIdAlmoxarifadoNota'] = $_GET["varidalmoxarifadonota"];
      }
      if (isset($_GET["varIdUsuario"]) && isset($this->varIdUsuario)) 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (!isset($_GET["varIdUsuario"]) && isset($_GET["varidusuario"])) 
      {
          $_SESSION['varIdUsuario'] = $_GET["varidusuario"];
      }
      if (isset($_GET["varIdUnico"]) && isset($this->varIdUnico)) 
      {
          $_SESSION['varIdUnico'] = $this->varIdUnico;
      }
      if (!isset($_GET["varIdUnico"]) && isset($_GET["varidunico"])) 
      {
          $_SESSION['varIdUnico'] = $_GET["varidunico"];
      }
      if (isset($_GET["varVetProdutos"]) && isset($this->varVetProdutos)) 
      {
          $_SESSION['varVetProdutos'] = $this->varVetProdutos;
      }
      if (!isset($_GET["varVetProdutos"]) && isset($_GET["varvetprodutos"])) 
      {
          $_SESSION['varVetProdutos'] = $_GET["varvetprodutos"];
      }
      if (isset($_GET["varImportar"]) && isset($this->varImportar)) 
      {
          $_SESSION['varImportar'] = $this->varImportar;
      }
      if (!isset($_GET["varImportar"]) && isset($_GET["varimportar"])) 
      {
          $_SESSION['varImportar'] = $_GET["varimportar"];
      }
      if (isset($_GET["varMsgErroNota"]) && isset($this->varMsgErroNota)) 
      {
          $_SESSION['varMsgErroNota'] = $this->varMsgErroNota;
      }
      if (!isset($_GET["varMsgErroNota"]) && isset($_GET["varmsgerronota"])) 
      {
          $_SESSION['varMsgErroNota'] = $_GET["varmsgerronota"];
      }
      if (isset($_GET["varMsgErroParcelas"]) && isset($this->varMsgErroParcelas)) 
      {
          $_SESSION['varMsgErroParcelas'] = $this->varMsgErroParcelas;
      }
      if (!isset($_GET["varMsgErroParcelas"]) && isset($_GET["varmsgerroparcelas"])) 
      {
          $_SESSION['varMsgErroParcelas'] = $_GET["varmsgerroparcelas"];
      }
      if (isset($_GET["varMsgErroProdutos"]) && isset($this->varMsgErroProdutos)) 
      {
          $_SESSION['varMsgErroProdutos'] = $this->varMsgErroProdutos;
      }
      if (!isset($_GET["varMsgErroProdutos"]) && isset($_GET["varmsgerroprodutos"])) 
      {
          $_SESSION['varMsgErroProdutos'] = $_GET["varmsgerroprodutos"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['embutida_parms']);
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
                 nm_limpa_str_AlmoxarifadoImportacaoXml_Ctr($cadapar[1]);
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
          if (!isset($this->varIdAlmoxarifadoNota) && isset($this->varidalmoxarifadonota)) 
          {
              $this->varIdAlmoxarifadoNota = $this->varidalmoxarifadonota;
          }
          if (isset($this->varIdAlmoxarifadoNota)) 
          {
              $_SESSION['varIdAlmoxarifadoNota'] = $this->varIdAlmoxarifadoNota;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varIdUnico) && isset($this->varidunico)) 
          {
              $this->varIdUnico = $this->varidunico;
          }
          if (isset($this->varIdUnico)) 
          {
              $_SESSION['varIdUnico'] = $this->varIdUnico;
          }
          if (!isset($this->varVetProdutos) && isset($this->varvetprodutos)) 
          {
              $this->varVetProdutos = $this->varvetprodutos;
          }
          if (isset($this->varVetProdutos)) 
          {
              $_SESSION['varVetProdutos'] = $this->varVetProdutos;
          }
          if (!isset($this->varImportar) && isset($this->varimportar)) 
          {
              $this->varImportar = $this->varimportar;
          }
          if (isset($this->varImportar)) 
          {
              $_SESSION['varImportar'] = $this->varImportar;
          }
          if (!isset($this->varMsgErroNota) && isset($this->varmsgerronota)) 
          {
              $this->varMsgErroNota = $this->varmsgerronota;
          }
          if (isset($this->varMsgErroNota)) 
          {
              $_SESSION['varMsgErroNota'] = $this->varMsgErroNota;
          }
          if (!isset($this->varMsgErroParcelas) && isset($this->varmsgerroparcelas)) 
          {
              $this->varMsgErroParcelas = $this->varmsgerroparcelas;
          }
          if (isset($this->varMsgErroParcelas)) 
          {
              $_SESSION['varMsgErroParcelas'] = $this->varMsgErroParcelas;
          }
          if (!isset($this->varMsgErroProdutos) && isset($this->varmsgerroprodutos)) 
          {
              $this->varMsgErroProdutos = $this->varmsgerroprodutos;
          }
          if (isset($this->varMsgErroProdutos)) 
          {
              $_SESSION['varMsgErroProdutos'] = $this->varMsgErroProdutos;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['opc_ant']);
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varIdAlmoxarifadoNota) && isset($this->varidalmoxarifadonota)) 
          {
              $this->varIdAlmoxarifadoNota = $this->varidalmoxarifadonota;
          }
          if (isset($this->varIdAlmoxarifadoNota)) 
          {
              $_SESSION['varIdAlmoxarifadoNota'] = $this->varIdAlmoxarifadoNota;
          }
          if (!isset($this->varIdUsuario) && isset($this->varidusuario)) 
          {
              $this->varIdUsuario = $this->varidusuario;
          }
          if (isset($this->varIdUsuario)) 
          {
              $_SESSION['varIdUsuario'] = $this->varIdUsuario;
          }
          if (!isset($this->varIdUnico) && isset($this->varidunico)) 
          {
              $this->varIdUnico = $this->varidunico;
          }
          if (isset($this->varIdUnico)) 
          {
              $_SESSION['varIdUnico'] = $this->varIdUnico;
          }
          if (!isset($this->varVetProdutos) && isset($this->varvetprodutos)) 
          {
              $this->varVetProdutos = $this->varvetprodutos;
          }
          if (isset($this->varVetProdutos)) 
          {
              $_SESSION['varVetProdutos'] = $this->varVetProdutos;
          }
          if (!isset($this->varImportar) && isset($this->varimportar)) 
          {
              $this->varImportar = $this->varimportar;
          }
          if (isset($this->varImportar)) 
          {
              $_SESSION['varImportar'] = $this->varImportar;
          }
          if (!isset($this->varMsgErroNota) && isset($this->varmsgerronota)) 
          {
              $this->varMsgErroNota = $this->varmsgerronota;
          }
          if (isset($this->varMsgErroNota)) 
          {
              $_SESSION['varMsgErroNota'] = $this->varMsgErroNota;
          }
          if (!isset($this->varMsgErroParcelas) && isset($this->varmsgerroparcelas)) 
          {
              $this->varMsgErroParcelas = $this->varmsgerroparcelas;
          }
          if (isset($this->varMsgErroParcelas)) 
          {
              $_SESSION['varMsgErroParcelas'] = $this->varMsgErroParcelas;
          }
          if (!isset($this->varMsgErroProdutos) && isset($this->varmsgerroprodutos)) 
          {
              $this->varMsgErroProdutos = $this->varmsgerroprodutos;
          }
          if (isset($this->varMsgErroProdutos)) 
          {
              $_SESSION['varMsgErroProdutos'] = $this->varMsgErroProdutos;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['nm_run_menu'] = 1;
      } 
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->dataemissaonota);
          $this->dataemissaonota      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->dataemissaonota_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new AlmoxarifadoImportacaoXml_Ctr_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varImportar)) {$this->sc_temp_varImportar = (isset($_SESSION['varImportar'])) ? $_SESSION['varImportar'] : "";}
  $this->sc_temp_varImportar = 'N';
if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['AlmoxarifadoImportacaoXml_Ctr']['upload_field_info']['nomereferencia'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'AlmoxarifadoImportacaoXml_Ctr',
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

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['AlmoxarifadoImportacaoXml_Ctr']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['AlmoxarifadoImportacaoXml_Ctr'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoImportacaoXml_Ctr']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoImportacaoXml_Ctr']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('AlmoxarifadoImportacaoXml_Ctr') . "/AlmoxarifadoImportacaoXml_Ctr.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['AlmoxarifadoImportacaoXml_Ctr']['label'] = "Importação Nota Fiscal XML";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "AlmoxarifadoImportacaoXml_Ctr")
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
      if ($this->NM_ajax_flag && (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'] || 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9)))
      {
      $this->Db->debug = false;
      }
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



      $_SESSION['scriptcase']['error_icon']['AlmoxarifadoImportacaoXml_Ctr']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['AlmoxarifadoImportacaoXml_Ctr'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "AlmoxarifadoImportacaoXml_Ctr.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['nomereferencia_ul_name']) && '' != $this->NM_ajax_info['param']['nomereferencia_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->NM_ajax_info['param']['nomereferencia_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_scfile_name = substr($this->NM_ajax_info['param']['nomereferencia_ul_name'], 12);
          $this->nomereferencia_scfile_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
          $this->nomereferencia_ul_name = $this->NM_ajax_info['param']['nomereferencia_ul_name'];
          $this->nomereferencia_ul_type = $this->NM_ajax_info['param']['nomereferencia_ul_type'];
      }
      elseif (isset($this->nomereferencia_ul_name) && '' != $this->nomereferencia_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_field_ul_name'][$this->nomereferencia_ul_name]))
          {
              $this->nomereferencia_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_field_ul_name'][$this->nomereferencia_ul_name];
          }
          $this->nomereferencia = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->nomereferencia_ul_name;
          $this->nomereferencia_scfile_name = substr($this->nomereferencia_ul_name, 12);
          $this->nomereferencia_scfile_type = $this->nomereferencia_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['goto']      = 'on';
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['AlmoxarifadoImportacaoXml_Ctr']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['AlmoxarifadoImportacaoXml_Ctr'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['AlmoxarifadoImportacaoXml_Ctr'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form'];
          if (!isset($this->produtos)){$this->produtos = $this->nmgp_dados_form['produtos'];} 
          if (!isset($this->descricaoprodutos)){$this->descricaoprodutos = $this->nmgp_dados_form['descricaoprodutos'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("AlmoxarifadoImportacaoXml_Ctr", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'AlmoxarifadoImportacaoXml_Ctr_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'AlmoxarifadoImportacaoXml_Ctr_help.txt');
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
          require_once($this->Ini->path_embutida . 'AlmoxarifadoImportacaoXml_Ctr/AlmoxarifadoImportacaoXml_Ctr_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "AlmoxarifadoImportacaoXml_Ctr_erro.class.php"); 
      }
      $this->Erro      = new AlmoxarifadoImportacaoXml_Ctr_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['AlmoxarifadoImportacaoXml_Ctr']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form'];
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
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
  if (empty($this->nomereferencia )) {
	;
	$this->Ini->nm_hidden_blocos[1] = 'off'; $this->NM_ajax_info['blockDisplay']['1'] = 'off';
	$this->Ini->nm_hidden_blocos[2] = 'off'; $this->NM_ajax_info['blockDisplay']['2'] = 'off';
	$this->Ini->nm_hidden_blocos[3] = 'off'; $this->NM_ajax_info['blockDisplay']['3'] = 'off';  
	$this->Ini->nm_hidden_blocos[4] = 'off'; $this->NM_ajax_info['blockDisplay']['4'] = 'off';  
	$this->Ini->nm_hidden_blocos[5] = 'off'; $this->NM_ajax_info['blockDisplay']['5'] = 'off';  
	$this->Ini->nm_hidden_blocos[6] = 'off'; $this->NM_ajax_info['blockDisplay']['6'] = 'off';  
	$this->Ini->nm_hidden_blocos[7] = 'off'; $this->NM_ajax_info['blockDisplay']['7'] = 'off';  
	$this->Ini->nm_hidden_blocos[8] = 'off'; $this->NM_ajax_info['blockDisplay']['8'] = 'off';  
	$this->nmgp_cmp_hidden["codigonota"] = 'off'; $this->NM_ajax_info['fieldDisplay']['codigonota'] = 'off';
	$this->nmgp_cmp_hidden["chavenota"] = 'off'; $this->NM_ajax_info['fieldDisplay']['chavenota'] = 'off';
	$this->nmgp_cmp_hidden["numeronota"] = 'off'; $this->NM_ajax_info['fieldDisplay']['numeronota'] = 'off';
	$this->nmgp_cmp_hidden["versaonota"] = 'off'; $this->NM_ajax_info['fieldDisplay']['versaonota'] = 'off';
	$this->nmgp_cmp_hidden["naturezanota"] = 'off'; $this->NM_ajax_info['fieldDisplay']['naturezanota'] = 'off';
	$this->nmgp_cmp_hidden["serienota"] = 'off'; $this->NM_ajax_info['fieldDisplay']['serienota'] = 'off';
	$this->nmgp_cmp_hidden["dataemissaonota"] = 'off'; $this->NM_ajax_info['fieldDisplay']['dataemissaonota'] = 'off';
	$this->nmgp_cmp_hidden["qtdprodutos"] = 'off'; $this->NM_ajax_info['fieldDisplay']['qtdprodutos'] = 'off';
	$this->nmgp_cmp_hidden["qtdparcelas"] = 'off'; $this->NM_ajax_info['fieldDisplay']['qtdparcelas'] = 'off';
} else {
	$this->sc_field_readonly("razaosocialnota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['razaosocialnota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("nomefantasianota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['nomefantasianota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("cnpjnota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['cnpjnota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("logradouronota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['logradouronota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("numerologradouronota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['numerologradouronota'] = array('I'=>array(),'U'=>array());
;	
	$this->sc_field_readonly("complementonota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['complementonota'] = array('I'=>array(),'U'=>array());
;	
	$this->sc_field_readonly("bairronota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['bairronota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("cidadenota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['cidadenota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("estadonota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['estadonota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("cepnota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['cepnota'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("telefonenota", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['telefonenota'] = array('I'=>array(),'U'=>array());
;

	$this->sc_field_readonly("razaosocial", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['razaosocial'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("nomefantasia", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['nomefantasia'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("cnpj", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['cnpj'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("logradouro", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['logradouro'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("numero", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['numero'] = array('I'=>array(),'U'=>array());
;	
	$this->sc_field_readonly("complemento", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['complemento'] = array('I'=>array(),'U'=>array());
;	
	$this->sc_field_readonly("bairro", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['bairro'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("cidade", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['cidade'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("estado", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['estado'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("cep", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['cep'] = array('I'=>array(),'U'=>array());
;
	$this->sc_field_readonly("telefone", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['telefone'] = array('I'=>array(),'U'=>array());
;
	$this->sc_btn_label('ok', 'Validar XML');
	$this->nmgp_cmp_hidden["idfornecedor"] = 'off'; $this->NM_ajax_info['fieldDisplay']['idfornecedor'] = 'off';		
}

if (empty($this->idalmoxarifadonota )) {
	
	$this->nmgp_cmp_hidden["nomereferencia"] = 'off'; $this->NM_ajax_info['fieldDisplay']['nomereferencia'] = 'off';
	
}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onScriptinit ------*/
 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "AlmoxarifadoImportacaoXml_Ctr.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- dataemissaonota
      $this->field_config['dataemissaonota']                 = array();
      $this->field_config['dataemissaonota']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dataemissaonota']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dataemissaonota']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dataemissaonota']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'dataemissaonota');
      //-- qtdprodutos
      $this->field_config['qtdprodutos']               = array();
      $this->field_config['qtdprodutos']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qtdprodutos']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qtdprodutos']['symbol_dec'] = '';
      $this->field_config['qtdprodutos']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qtdprodutos']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- qtdparcelas
      $this->field_config['qtdparcelas']               = array();
      $this->field_config['qtdparcelas']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qtdparcelas']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qtdparcelas']['symbol_dec'] = '';
      $this->field_config['qtdparcelas']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qtdparcelas']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
      //-- valordesconto
      $this->field_config['valordesconto']               = array();
      $this->field_config['valordesconto']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valordesconto']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valordesconto']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valordesconto']['symbol_mon'] = '';
      $this->field_config['valordesconto']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valordesconto']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- valorliquido
      $this->field_config['valorliquido']               = array();
      $this->field_config['valorliquido']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['valorliquido']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['valorliquido']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['valorliquido']['symbol_mon'] = '';
      $this->field_config['valorliquido']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['valorliquido']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
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
         $this->numerofaturanota = "";
         $this->msgfornecedor = "";
         $this->cnpj = "";
         $this->razaosocial = "";
         $this->nomefantasia = "";
         $this->logradouro = "";
         $this->numero = "";
         $this->complemento = "";
         $this->bairro = "";
         $this->cidade = "";
         $this->estado = "";
         $this->cep = "";
         $this->telefone = "";
         $this->descricaoparcelas = "";
         $this->descricaoprodutos = "";
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_idalmoxarifadonota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idalmoxarifadonota');
          }
          if ('validate_codigonota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'codigonota');
          }
          if ('validate_numeronota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'numeronota');
          }
          if ('validate_serienota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'serienota');
          }
          if ('validate_dataemissaonota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dataemissaonota');
          }
          if ('validate_qtdprodutos' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qtdprodutos');
          }
          if ('validate_qtdparcelas' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'qtdparcelas');
          }
          if ('validate_nomereferencia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomereferencia');
          }
          if ('validate_nomearquivo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomearquivo');
          }
          if ('validate_chavenota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'chavenota');
          }
          if ('validate_versaonota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'versaonota');
          }
          if ('validate_naturezanota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'naturezanota');
          }
          if ('validate_idfornecedor' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idfornecedor');
          }
          if ('validate_cnpjnota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cnpjnota');
          }
          if ('validate_razaosocialnota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'razaosocialnota');
          }
          if ('validate_nomefantasianota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nomefantasianota');
          }
          if ('validate_logradouronota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'logradouronota');
          }
          if ('validate_numerologradouronota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'numerologradouronota');
          }
          if ('validate_complementonota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'complementonota');
          }
          if ('validate_cidadenota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cidadenota');
          }
          if ('validate_bairronota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bairronota');
          }
          if ('validate_estadonota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'estadonota');
          }
          if ('validate_cepnota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cepnota');
          }
          if ('validate_telefonenota' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'telefonenota');
          }
          if ('validate_detprodutos' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'detprodutos');
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
          if ('validate_valordesconto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valordesconto');
          }
          if ('validate_valorliquido' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'valorliquido');
          }
          if ('validate_parcelas' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'parcelas');
          }
          if ('validate_observacoes' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'observacoes');
          }
          AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_idalmoxarifadonota_onchange' == $this->NM_ajax_opcao)
          {
              $this->IdAlmoxarifadoNota_onChange();
          }
          AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
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
          $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
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
          $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
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
          $this->idfornecedor = "" ;  
          $this->nomefantasia = "" ;  
          $this->nomereferencia = "" ;  
          $this->codigonota = "" ;  
          $this->chavenota = "" ;  
          $this->numeronota = "" ;  
          $this->versaonota = "" ;  
          $this->naturezanota = "" ;  
          $this->serienota = "" ;  
          $this->dataemissaonota = "" ;  
          $this->cnpjnota = "" ;  
          $this->razaosocialnota = "" ;  
          $this->nomefantasianota = "" ;  
          $this->logradouronota = "" ;  
          $this->numerologradouronota = "" ;  
          $this->complementonota = "" ;  
          $this->bairronota = "" ;  
          $this->cidadenota = "" ;  
          $this->estadonota = "" ;  
          $this->cepnota = "" ;  
          $this->telefonenota = "" ;  
          $this->msgfornecedor = "" ;  
          $this->razaosocial = "" ;  
          $this->cnpj = "" ;  
          $this->logradouro = "" ;  
          $this->numero = "" ;  
          $this->bairro = "" ;  
          $this->cidade = "" ;  
          $this->estado = "" ;  
          $this->cep = "" ;  
          $this->complemento = "" ;  
          $this->telefone = "" ;  
          $this->valortotal = "" ;  
          $this->valordesconto = "" ;  
          $this->valorcofins = "" ;  
          $this->valorpis = "" ;  
          $this->valorliquido = "" ;  
          $this->valoricms = "" ;  
          $this->valorfrete = "" ;  
          $this->observacoes = "" ;  
          $this->idalmoxarifadonota = "" ;  
          $this->qtdprodutos = "" ;  
          $this->qtdparcelas = "" ;  
          $this->produtos = "" ;  
          $this->nomearquivo = "" ;  
          $this->numerofaturanota = "" ;  
          $this->parcelas = "" ;  
          $this->descricaoprodutos = "" ;  
          $this->descricaoparcelas = "" ;  
          $this->detprodutos = "" ;  
          $this->numerofaturanota = "";
          $this->msgfornecedor = "";
          $this->cnpj = "";
          $this->razaosocial = "";
          $this->nomefantasia = "";
          $this->logradouro = "";
          $this->numero = "";
          $this->complemento = "";
          $this->bairro = "";
          $this->cidade = "";
          $this->estado = "";
          $this->cep = "";
          $this->telefone = "";
          $this->descricaoparcelas = "";
          $this->descricaoprodutos = "";
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form'] as $NM_campo => $NM_valor)
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos']))
              { 
                  $idalmoxarifadonota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][0]; 
                  $codigonota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][1]; 
                  $numeronota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][2]; 
                  $serienota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][3]; 
                  $dataemissaonota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][4]; 
                  $qtdprodutos = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][5]; 
                  $qtdparcelas = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][6]; 
                  $nomereferencia = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][7]; 
                  $nomearquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][8]; 
                  $numerofaturanota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][9]; 
                  $chavenota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][10]; 
                  $versaonota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][11]; 
                  $naturezanota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][12]; 
                  $idfornecedor = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][13]; 
                  $msgfornecedor = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][14]; 
                  $cnpjnota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][15]; 
                  $razaosocialnota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][16]; 
                  $nomefantasianota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][17]; 
                  $logradouronota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][18]; 
                  $numerologradouronota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][19]; 
                  $complementonota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][20]; 
                  $cidadenota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][21]; 
                  $bairronota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][22]; 
                  $estadonota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][23]; 
                  $cepnota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][24]; 
                  $telefonenota = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][25]; 
                  $cnpj = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][26]; 
                  $razaosocial = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][27]; 
                  $nomefantasia = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][28]; 
                  $logradouro = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][29]; 
                  $numero = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][30]; 
                  $complemento = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][31]; 
                  $bairro = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][32]; 
                  $cidade = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][33]; 
                  $estado = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][34]; 
                  $cep = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][35]; 
                  $telefone = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][36]; 
                  $detprodutos = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][37]; 
                  $valorcofins = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][38]; 
                  $valorpis = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][39]; 
                  $valoricms = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][40]; 
                  $valorfrete = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][41]; 
                  $valortotal = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][42]; 
                  $valordesconto = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][43]; 
                  $valorliquido = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][44]; 
                  $parcelas = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][45]; 
                  $descricaoparcelas = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][46]; 
                  $observacoes = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][47]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][0] = $this->idalmoxarifadonota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][1] = $this->codigonota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][2] = $this->numeronota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][3] = $this->serienota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][4] = $this->dataemissaonota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][5] = $this->qtdprodutos; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][6] = $this->qtdparcelas; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][7] = $this->nomereferencia; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][8] = $this->nomearquivo; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][9] = $this->numerofaturanota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][10] = $this->chavenota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][11] = $this->versaonota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][12] = $this->naturezanota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][13] = $this->idfornecedor; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][14] = $this->msgfornecedor; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][15] = $this->cnpjnota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][16] = $this->razaosocialnota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][17] = $this->nomefantasianota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][18] = $this->logradouronota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][19] = $this->numerologradouronota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][20] = $this->complementonota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][21] = $this->cidadenota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][22] = $this->bairronota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][23] = $this->estadonota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][24] = $this->cepnota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][25] = $this->telefonenota; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][26] = $this->cnpj; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][27] = $this->razaosocial; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][28] = $this->nomefantasia; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][29] = $this->logradouro; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][30] = $this->numero; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][31] = $this->complemento; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][32] = $this->bairro; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][33] = $this->cidade; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][34] = $this->estado; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][35] = $this->cep; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][36] = $this->telefone; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][37] = $this->detprodutos; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][38] = $this->valorcofins; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][39] = $this->valorpis; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][40] = $this->valoricms; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][41] = $this->valorfrete; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][42] = $this->valortotal; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][43] = $this->valordesconto; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][44] = $this->valorliquido; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][45] = $this->parcelas; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][46] = $this->descricaoparcelas; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['campos'][47] = $this->observacoes; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['redir'] == "redir")
          {
              $this->nmgp_redireciona(); 
          }
          else
          {
              $contr_menu = "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['iframe_menu'])
              {
                  $contr_menu = "glo_menu";
              }
              if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("AlmoxarifadoImportacaoXml_Ctr", $_SESSION['scriptcase']['sc_ult_apl_menu']))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona_form("AlmoxarifadoImportacaoXml_Ctr_fim.php", $this->nm_location, $contr_menu); 
              }
              else
              {
                  $this->nm_gera_html();
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['embutida_proc'])
                  { 
                      $this->NM_close_db(); 
                  } 
              }
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "AlmoxarifadoImportacaoXml_Ctr.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Importação Nota Fiscal XML") ?></TITLE>
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
<form name="Fdown" method="get" action="AlmoxarifadoImportacaoXml_Ctr_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="AlmoxarifadoImportacaoXml_Ctr"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="AlmoxarifadoImportacaoXml_Ctr.php" target="_self" style="display: none"> 
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
           case 'idalmoxarifadonota':
               return "Almoxarifado <span class=\"scFormRequiredMarkOdd\">*</span>";
               break;
           case 'codigonota':
               return "Código";
               break;
           case 'numeronota':
               return "Nº nota fiscal";
               break;
           case 'serienota':
               return "Série";
               break;
           case 'dataemissaonota':
               return "Emitida em";
               break;
           case 'qtdprodutos':
               return "Qtd. produtos";
               break;
           case 'qtdparcelas':
               return "Qtd. parcelas";
               break;
           case 'nomereferencia':
               return "Arquivo XML";
               break;
           case 'nomearquivo':
               return "NomeArquivo";
               break;
           case 'numerofaturanota':
               return "Nº fatura";
               break;
           case 'chavenota':
               return "Chave";
               break;
           case 'versaonota':
               return "Versão";
               break;
           case 'naturezanota':
               return "Natureza";
               break;
           case 'idfornecedor':
               return "Fornecedor*";
               break;
           case 'msgfornecedor':
               return "MsgFornecedor";
               break;
           case 'cnpjnota':
               return "CNPJ";
               break;
           case 'razaosocialnota':
               return "Razão social";
               break;
           case 'nomefantasianota':
               return "Nome fantasia";
               break;
           case 'logradouronota':
               return "Logradouro";
               break;
           case 'numerologradouronota':
               return "Número";
               break;
           case 'complementonota':
               return "Complemento";
               break;
           case 'cidadenota':
               return "Cidade";
               break;
           case 'bairronota':
               return "Bairro";
               break;
           case 'estadonota':
               return "Estado";
               break;
           case 'cepnota':
               return "CEP";
               break;
           case 'telefonenota':
               return "Telefone";
               break;
           case 'cnpj':
               return "CNPJ";
               break;
           case 'razaosocial':
               return "Razão social";
               break;
           case 'nomefantasia':
               return "Nome fantasia";
               break;
           case 'logradouro':
               return "Logradouro";
               break;
           case 'numero':
               return "Número";
               break;
           case 'complemento':
               return "Complemento";
               break;
           case 'bairro':
               return "Bairro";
               break;
           case 'cidade':
               return "Cidade";
               break;
           case 'estado':
               return "Estado";
               break;
           case 'cep':
               return "CEP";
               break;
           case 'telefone':
               return "Telefone";
               break;
           case 'detprodutos':
               return "<span style=\"display:inline-block;width:10px;height:10px;border-radius:50%;background:#e74c3c;margin-right:3px;\"></span> Produtos não cadastrados devem ter os campos obrigatórios preenchidos. Clique no botão <i class=\"icon_fa fas fa-edit\"></i> para editar";
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
           case 'valordesconto':
               return "Valor desconto";
               break;
           case 'valorliquido':
               return "Valor líquido";
               break;
           case 'parcelas':
               return "Parcelas";
               break;
           case 'descricaoparcelas':
               return "DescricaoParcelas";
               break;
           case 'observacoes':
               return "Observações";
               break;
           case 'produtos':
               return "Produtos";
               break;
           case 'descricaoprodutos':
               return "DescricaoProdutos";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_AlmoxarifadoImportacaoXml_Ctr']) || !is_array($this->NM_ajax_info['errList']['geral_AlmoxarifadoImportacaoXml_Ctr']))
              {
                  $this->NM_ajax_info['errList']['geral_AlmoxarifadoImportacaoXml_Ctr'] = array();
              }
              $this->NM_ajax_info['errList']['geral_AlmoxarifadoImportacaoXml_Ctr'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'idalmoxarifadonota' == $filtro)) || (is_array($filtro) && in_array('idalmoxarifadonota', $filtro)))
        $this->ValidateField_idalmoxarifadonota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'codigonota' == $filtro)) || (is_array($filtro) && in_array('codigonota', $filtro)))
        $this->ValidateField_codigonota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'numeronota' == $filtro)) || (is_array($filtro) && in_array('numeronota', $filtro)))
        $this->ValidateField_numeronota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'serienota' == $filtro)) || (is_array($filtro) && in_array('serienota', $filtro)))
        $this->ValidateField_serienota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dataemissaonota' == $filtro)) || (is_array($filtro) && in_array('dataemissaonota', $filtro)))
        $this->ValidateField_dataemissaonota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'qtdprodutos' == $filtro)) || (is_array($filtro) && in_array('qtdprodutos', $filtro)))
        $this->ValidateField_qtdprodutos($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'qtdparcelas' == $filtro)) || (is_array($filtro) && in_array('qtdparcelas', $filtro)))
        $this->ValidateField_qtdparcelas($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomereferencia' == $filtro)) || (is_array($filtro) && in_array('nomereferencia', $filtro)))
        $this->ValidateField_nomereferencia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomearquivo' == $filtro)) || (is_array($filtro) && in_array('nomearquivo', $filtro)))
        $this->ValidateField_nomearquivo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'chavenota' == $filtro)) || (is_array($filtro) && in_array('chavenota', $filtro)))
        $this->ValidateField_chavenota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'versaonota' == $filtro)) || (is_array($filtro) && in_array('versaonota', $filtro)))
        $this->ValidateField_versaonota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'naturezanota' == $filtro)) || (is_array($filtro) && in_array('naturezanota', $filtro)))
        $this->ValidateField_naturezanota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idfornecedor' == $filtro)) || (is_array($filtro) && in_array('idfornecedor', $filtro)))
        $this->ValidateField_idfornecedor($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'cnpjnota' == $filtro)) || (is_array($filtro) && in_array('cnpjnota', $filtro)))
        $this->ValidateField_cnpjnota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'razaosocialnota' == $filtro)) || (is_array($filtro) && in_array('razaosocialnota', $filtro)))
        $this->ValidateField_razaosocialnota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nomefantasianota' == $filtro)) || (is_array($filtro) && in_array('nomefantasianota', $filtro)))
        $this->ValidateField_nomefantasianota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'logradouronota' == $filtro)) || (is_array($filtro) && in_array('logradouronota', $filtro)))
        $this->ValidateField_logradouronota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'numerologradouronota' == $filtro)) || (is_array($filtro) && in_array('numerologradouronota', $filtro)))
        $this->ValidateField_numerologradouronota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'complementonota' == $filtro)) || (is_array($filtro) && in_array('complementonota', $filtro)))
        $this->ValidateField_complementonota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'cidadenota' == $filtro)) || (is_array($filtro) && in_array('cidadenota', $filtro)))
        $this->ValidateField_cidadenota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bairronota' == $filtro)) || (is_array($filtro) && in_array('bairronota', $filtro)))
        $this->ValidateField_bairronota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'estadonota' == $filtro)) || (is_array($filtro) && in_array('estadonota', $filtro)))
        $this->ValidateField_estadonota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'cepnota' == $filtro)) || (is_array($filtro) && in_array('cepnota', $filtro)))
        $this->ValidateField_cepnota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'telefonenota' == $filtro)) || (is_array($filtro) && in_array('telefonenota', $filtro)))
        $this->ValidateField_telefonenota($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'detprodutos' == $filtro)) || (is_array($filtro) && in_array('detprodutos', $filtro)))
        $this->ValidateField_detprodutos($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorcofins' == $filtro)) || (is_array($filtro) && in_array('valorcofins', $filtro)))
        $this->ValidateField_valorcofins($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorpis' == $filtro)) || (is_array($filtro) && in_array('valorpis', $filtro)))
        $this->ValidateField_valorpis($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valoricms' == $filtro)) || (is_array($filtro) && in_array('valoricms', $filtro)))
        $this->ValidateField_valoricms($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorfrete' == $filtro)) || (is_array($filtro) && in_array('valorfrete', $filtro)))
        $this->ValidateField_valorfrete($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valortotal' == $filtro)) || (is_array($filtro) && in_array('valortotal', $filtro)))
        $this->ValidateField_valortotal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valordesconto' == $filtro)) || (is_array($filtro) && in_array('valordesconto', $filtro)))
        $this->ValidateField_valordesconto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'valorliquido' == $filtro)) || (is_array($filtro) && in_array('valorliquido', $filtro)))
        $this->ValidateField_valorliquido($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'parcelas' == $filtro)) || (is_array($filtro) && in_array('parcelas', $filtro)))
        $this->ValidateField_parcelas($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'observacoes' == $filtro)) || (is_array($filtro) && in_array('observacoes', $filtro)))
        $this->ValidateField_observacoes($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---

      if (empty($Campos_Crit) && empty($Campos_Falta))
      {
      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      
/*----- Scriptcase Locale: Event onValidate ------*/
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varImportar)) {$this->sc_temp_varImportar = (isset($_SESSION['varImportar'])) ? $_SESSION['varImportar'] : "";}
  if (empty($this->idalmoxarifadonota ) && $this->sc_temp_varImportar == 'S') {
	$this->sc_temp_varImportar = 'N';
	$this->verificarCamposFornecedor();
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Almoxarifado: Campo obrigatório.<br>';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Almoxarifado: Campo obrigatório.<br>';
 }
;
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
    $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
    return;
}
}
if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onValidate ------*/
 
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
              
/*----- Scriptcase Locale: Event onValidateSuccess ------*/
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varMsgErroNota)) {$this->sc_temp_varMsgErroNota = (isset($_SESSION['varMsgErroNota'])) ? $_SESSION['varMsgErroNota'] : "";}
if (!isset($this->sc_temp_varMsgErroProdutos)) {$this->sc_temp_varMsgErroProdutos = (isset($_SESSION['varMsgErroProdutos'])) ? $_SESSION['varMsgErroProdutos'] : "";}
if (!isset($this->sc_temp_varImportar)) {$this->sc_temp_varImportar = (isset($_SESSION['varImportar'])) ? $_SESSION['varImportar'] : "";}
  if (!isset($this->sc_temp_varImportar) || $this->sc_temp_varImportar != 'S') 
{
	$this->decodificarXML();
	$this->verificarCamposFornecedor();
} 
else 
{
	if (!$this->validarProdutos())
	{
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->sc_temp_varMsgErroProdutos;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $this->sc_temp_varMsgErroProdutos;
 }
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
 if (isset($this->sc_temp_varMsgErroProdutos)) { $_SESSION['varMsgErroProdutos'] = $this->sc_temp_varMsgErroProdutos;}
 if (isset($this->sc_temp_varMsgErroNota)) { $_SESSION['varMsgErroNota'] = $this->sc_temp_varMsgErroNota;}
    $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
    return;
}
}

	$idAlmoxarifadoEntradaNota = $this->incluirNotaEntrada($this->idfornecedor );

	if ($idAlmoxarifadoEntradaNota === false)
	{
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->sc_temp_varMsgErroNota;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $this->sc_temp_varMsgErroNota;
 }
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
 if (isset($this->sc_temp_varMsgErroProdutos)) { $_SESSION['varMsgErroProdutos'] = $this->sc_temp_varMsgErroProdutos;}
 if (isset($this->sc_temp_varMsgErroNota)) { $_SESSION['varMsgErroNota'] = $this->sc_temp_varMsgErroNota;}
    $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
    return;
}
}

	 if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
 if (isset($this->sc_temp_varMsgErroProdutos)) { $_SESSION['varMsgErroProdutos'] = $this->sc_temp_varMsgErroProdutos;}
 if (isset($this->sc_temp_varMsgErroNota)) { $_SESSION['varMsgErroNota'] = $this->sc_temp_varMsgErroNota;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('AlmoxarifadoEntrada_Lst') . "/AlmoxarifadoEntrada_Lst.php", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
}
if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
if (isset($this->sc_temp_varMsgErroProdutos)) { $_SESSION['varMsgErroProdutos'] = $this->sc_temp_varMsgErroProdutos;}
if (isset($this->sc_temp_varMsgErroNota)) { $_SESSION['varMsgErroNota'] = $this->sc_temp_varMsgErroNota;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onValidateSuccess ------*/
 
          }
      }
   }

    function ValidateField_idalmoxarifadonota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idalmoxarifadonota'])) {
       return;
   }
               if (!empty($this->idalmoxarifadonota) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']) && !in_array($this->idalmoxarifadonota, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['idalmoxarifadonota']))
                   {
                       $Campos_Erros['idalmoxarifadonota'] = array();
                   }
                   $Campos_Erros['idalmoxarifadonota'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['idalmoxarifadonota']) || !is_array($this->NM_ajax_info['errList']['idalmoxarifadonota']))
                   {
                       $this->NM_ajax_info['errList']['idalmoxarifadonota'] = array();
                   }
                   $this->NM_ajax_info['errList']['idalmoxarifadonota'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idalmoxarifadonota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idalmoxarifadonota

    function ValidateField_codigonota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['codigonota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->codigonota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Código " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['codigonota']))
              {
                  $Campos_Erros['codigonota'] = array();
              }
              $Campos_Erros['codigonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['codigonota']) || !is_array($this->NM_ajax_info['errList']['codigonota']))
              {
                  $this->NM_ajax_info['errList']['codigonota'] = array();
              }
              $this->NM_ajax_info['errList']['codigonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'codigonota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_codigonota

    function ValidateField_numeronota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['numeronota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->numeronota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nº nota fiscal " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['numeronota']))
              {
                  $Campos_Erros['numeronota'] = array();
              }
              $Campos_Erros['numeronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['numeronota']) || !is_array($this->NM_ajax_info['errList']['numeronota']))
              {
                  $this->NM_ajax_info['errList']['numeronota'] = array();
              }
              $this->NM_ajax_info['errList']['numeronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
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

    function ValidateField_serienota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['serienota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->serienota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Série " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['serienota']))
              {
                  $Campos_Erros['serienota'] = array();
              }
              $Campos_Erros['serienota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['serienota']) || !is_array($this->NM_ajax_info['errList']['serienota']))
              {
                  $this->NM_ajax_info['errList']['serienota'] = array();
              }
              $this->NM_ajax_info['errList']['serienota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'serienota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_serienota

    function ValidateField_dataemissaonota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dataemissaonota, $this->field_config['dataemissaonota']['date_sep']) ; 
      nm_limpa_hora($this->dataemissaonota_hora, $this->field_config['dataemissaonota_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dataemissaonota'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao == "incluir" || 'validate_dataemissaonota' == $this->NM_ajax_opcao)
      { 
          $guarda_datahora = $this->field_config['dataemissaonota']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dataemissaonota']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dataemissaonota']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dataemissaonota']['date_sep']) ; 
          $Format_Hora = $this->field_config['dataemissaonota_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dataemissaonota_hora']['time_sep']) ; 
          if (trim($this->dataemissaonota) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->dataemissaonota, $Format_Data, $this->dataemissaonota_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->dataemissaonota_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->dataemissaonota, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->dataemissaonota, $Format_Data, $this->dataemissaonota_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->dataemissaonota_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->dataemissaonota, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Emitida em; " ; 
                  if (!isset($Campos_Erros['dataemissaonota']))
                  {
                      $Campos_Erros['dataemissaonota'] = array();
                  }
                  $Campos_Erros['dataemissaonota'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dataemissaonota']) || !is_array($this->NM_ajax_info['errList']['dataemissaonota']))
                  {
                      $this->NM_ajax_info['errList']['dataemissaonota'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataemissaonota'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['dataemissaonota']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dataemissaonota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->dataemissaonota_hora, $this->field_config['dataemissaonota_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dataemissaonota_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao == "incluir")
      {
          $Format_Hora = $this->field_config['dataemissaonota_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dataemissaonota_hora']['time_sep']) ; 
          if (trim($this->dataemissaonota_hora) != "")  
          { 
              if ($teste_validade->Hora($this->dataemissaonota_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Emitida em; " ; 
                  if (!isset($Campos_Erros['dataemissaonota_hora']))
                  {
                      $Campos_Erros['dataemissaonota_hora'] = array();
                  }
                  $Campos_Erros['dataemissaonota_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dataemissaonota']) || !is_array($this->NM_ajax_info['errList']['dataemissaonota']))
                  {
                      $this->NM_ajax_info['errList']['dataemissaonota'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataemissaonota'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
      if (isset($Campos_Erros['dataemissaonota']) && isset($Campos_Erros['dataemissaonota_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['dataemissaonota'], $Campos_Erros['dataemissaonota_hora']);
          if (empty($Campos_Erros['dataemissaonota_hora']))
          {
              unset($Campos_Erros['dataemissaonota_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['dataemissaonota']))
          {
              $this->NM_ajax_info['errList']['dataemissaonota'] = array_unique($this->NM_ajax_info['errList']['dataemissaonota']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dataemissaonota_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dataemissaonota_hora

    function ValidateField_qtdprodutos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['qtdprodutos'])) {
          nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
          return;
      }
      if ($this->qtdprodutos === "" || is_null($this->qtdprodutos))  
      { 
          $this->qtdprodutos = 0;
          $this->sc_force_zero[] = 'qtdprodutos';
      } 
      nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_qtdprodutos' == $this->NM_ajax_opcao)
      { 
          if ($this->qtdprodutos != '')  
          { 
              $iTestSize = 20;
              if ('-' == substr($this->qtdprodutos, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->qtdprodutos, -1))
              {
                  $iTestSize++;
                  $this->qtdprodutos = '-' . substr($this->qtdprodutos, 0, -1);
              }
              if (strlen($this->qtdprodutos) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. produtos: " . $this->Ini->Nm_lang['lang_errm_size']; 
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
              if ($teste_validade->Valor($this->qtdprodutos, 20, 0, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. produtos; " ; 
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
      if ($this->nmgp_opcao == "incluir" || 'validate_qtdparcelas' == $this->NM_ajax_opcao)
      { 
          if ($this->qtdparcelas != '')  
          { 
              $iTestSize = 20;
              if ('-' == substr($this->qtdparcelas, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->qtdparcelas, -1))
              {
                  $iTestSize++;
                  $this->qtdparcelas = '-' . substr($this->qtdparcelas, 0, -1);
              }
              if (strlen($this->qtdparcelas) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. parcelas: " . $this->Ini->Nm_lang['lang_errm_size']; 
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
              if ($teste_validade->Valor($this->qtdparcelas, 20, 0, 0, 0, "S") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. parcelas; " ; 
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

    function ValidateField_nomereferencia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomereferencia'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['php_cmp_required']['nomereferencia']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['php_cmp_required']['nomereferencia'] == "on")) 
      { 
          if (($this->nomereferencia == "" && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_select']['nomereferencia'] == "") || "S" == $this->nomereferencia_limpa)
          { 
              $hasError = true;
              $Campos_Falta[] =  "Arquivo XML" ; 
              if (!isset($Campos_Erros['nomereferencia']))
              {
                  $Campos_Erros['nomereferencia'] = array();
              }
              $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                  {
                      $this->NM_ajax_info['errList']['nomereferencia'] = array();
                  }
                  $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->nomereferencia;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'AlmoxarifadoImportacaoXml_Ctr_doc_name.php';
            }
            $this->nomereferencia = sc_upload_unprotect_chars($this->nomereferencia, true);
            $this->nomereferencia_scfile_name = sc_upload_unprotect_chars($this->nomereferencia_scfile_name, true);
            if (strpos($this->nomereferencia, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Arquivo XML: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
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
                $Campos_Crit .= "Arquivo XML: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
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
                    include_once 'AlmoxarifadoImportacaoXml_Ctr_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ($hasError) {
                    $Campos_Crit .= "Arquivo XML: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
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
              $Campos_Crit .= "NomeArquivo " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
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

    function ValidateField_chavenota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['chavenota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->chavenota) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Chave " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['chavenota']))
              {
                  $Campos_Erros['chavenota'] = array();
              }
              $Campos_Erros['chavenota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['chavenota']) || !is_array($this->NM_ajax_info['errList']['chavenota']))
              {
                  $this->NM_ajax_info['errList']['chavenota'] = array();
              }
              $this->NM_ajax_info['errList']['chavenota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'chavenota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_chavenota

    function ValidateField_versaonota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['versaonota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->versaonota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Versão " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['versaonota']))
              {
                  $Campos_Erros['versaonota'] = array();
              }
              $Campos_Erros['versaonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['versaonota']) || !is_array($this->NM_ajax_info['errList']['versaonota']))
              {
                  $this->NM_ajax_info['errList']['versaonota'] = array();
              }
              $this->NM_ajax_info['errList']['versaonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'versaonota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_versaonota

    function ValidateField_naturezanota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['naturezanota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->naturezanota) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Natureza " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['naturezanota']))
              {
                  $Campos_Erros['naturezanota'] = array();
              }
              $Campos_Erros['naturezanota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['naturezanota']) || !is_array($this->NM_ajax_info['errList']['naturezanota']))
              {
                  $this->NM_ajax_info['errList']['naturezanota'] = array();
              }
              $this->NM_ajax_info['errList']['naturezanota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'naturezanota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_naturezanota

    function ValidateField_idfornecedor(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idfornecedor'])) {
       return;
   }
   if ($this->nmgp_opcao == "incluir")
   {
               if (!empty($this->idfornecedor) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']) && !in_array($this->idfornecedor, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']))
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

    function ValidateField_cnpjnota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cnpjnota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->cnpjnota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "CNPJ " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['cnpjnota']))
              {
                  $Campos_Erros['cnpjnota'] = array();
              }
              $Campos_Erros['cnpjnota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['cnpjnota']) || !is_array($this->NM_ajax_info['errList']['cnpjnota']))
              {
                  $this->NM_ajax_info['errList']['cnpjnota'] = array();
              }
              $this->NM_ajax_info['errList']['cnpjnota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cnpjnota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cnpjnota

    function ValidateField_razaosocialnota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['razaosocialnota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->razaosocialnota) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Razão social " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['razaosocialnota']))
              {
                  $Campos_Erros['razaosocialnota'] = array();
              }
              $Campos_Erros['razaosocialnota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['razaosocialnota']) || !is_array($this->NM_ajax_info['errList']['razaosocialnota']))
              {
                  $this->NM_ajax_info['errList']['razaosocialnota'] = array();
              }
              $this->NM_ajax_info['errList']['razaosocialnota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'razaosocialnota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_razaosocialnota

    function ValidateField_nomefantasianota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nomefantasianota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->nomefantasianota) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nome fantasia " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['nomefantasianota']))
              {
                  $Campos_Erros['nomefantasianota'] = array();
              }
              $Campos_Erros['nomefantasianota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['nomefantasianota']) || !is_array($this->NM_ajax_info['errList']['nomefantasianota']))
              {
                  $this->NM_ajax_info['errList']['nomefantasianota'] = array();
              }
              $this->NM_ajax_info['errList']['nomefantasianota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nomefantasianota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nomefantasianota

    function ValidateField_logradouronota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['logradouronota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->logradouronota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Logradouro " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['logradouronota']))
              {
                  $Campos_Erros['logradouronota'] = array();
              }
              $Campos_Erros['logradouronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['logradouronota']) || !is_array($this->NM_ajax_info['errList']['logradouronota']))
              {
                  $this->NM_ajax_info['errList']['logradouronota'] = array();
              }
              $this->NM_ajax_info['errList']['logradouronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'logradouronota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_logradouronota

    function ValidateField_numerologradouronota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['numerologradouronota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->numerologradouronota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Número " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['numerologradouronota']))
              {
                  $Campos_Erros['numerologradouronota'] = array();
              }
              $Campos_Erros['numerologradouronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['numerologradouronota']) || !is_array($this->NM_ajax_info['errList']['numerologradouronota']))
              {
                  $this->NM_ajax_info['errList']['numerologradouronota'] = array();
              }
              $this->NM_ajax_info['errList']['numerologradouronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'numerologradouronota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_numerologradouronota

    function ValidateField_complementonota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['complementonota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->complementonota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Complemento " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['complementonota']))
              {
                  $Campos_Erros['complementonota'] = array();
              }
              $Campos_Erros['complementonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['complementonota']) || !is_array($this->NM_ajax_info['errList']['complementonota']))
              {
                  $this->NM_ajax_info['errList']['complementonota'] = array();
              }
              $this->NM_ajax_info['errList']['complementonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'complementonota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_complementonota

    function ValidateField_cidadenota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cidadenota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->cidadenota) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Cidade " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['cidadenota']))
              {
                  $Campos_Erros['cidadenota'] = array();
              }
              $Campos_Erros['cidadenota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['cidadenota']) || !is_array($this->NM_ajax_info['errList']['cidadenota']))
              {
                  $this->NM_ajax_info['errList']['cidadenota'] = array();
              }
              $this->NM_ajax_info['errList']['cidadenota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cidadenota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cidadenota

    function ValidateField_bairronota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bairronota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->bairronota) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Bairro " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['bairronota']))
              {
                  $Campos_Erros['bairronota'] = array();
              }
              $Campos_Erros['bairronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['bairronota']) || !is_array($this->NM_ajax_info['errList']['bairronota']))
              {
                  $this->NM_ajax_info['errList']['bairronota'] = array();
              }
              $this->NM_ajax_info['errList']['bairronota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bairronota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bairronota

    function ValidateField_estadonota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['estadonota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->estadonota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Estado " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['estadonota']))
              {
                  $Campos_Erros['estadonota'] = array();
              }
              $Campos_Erros['estadonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['estadonota']) || !is_array($this->NM_ajax_info['errList']['estadonota']))
              {
                  $this->NM_ajax_info['errList']['estadonota'] = array();
              }
              $this->NM_ajax_info['errList']['estadonota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'estadonota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_estadonota

    function ValidateField_cepnota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cepnota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->cepnota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "CEP " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['cepnota']))
              {
                  $Campos_Erros['cepnota'] = array();
              }
              $Campos_Erros['cepnota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['cepnota']) || !is_array($this->NM_ajax_info['errList']['cepnota']))
              {
                  $this->NM_ajax_info['errList']['cepnota'] = array();
              }
              $this->NM_ajax_info['errList']['cepnota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cepnota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cepnota

    function ValidateField_telefonenota(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['telefonenota'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->telefonenota) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Telefone " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['telefonenota']))
              {
                  $Campos_Erros['telefonenota'] = array();
              }
              $Campos_Erros['telefonenota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['telefonenota']) || !is_array($this->NM_ajax_info['errList']['telefonenota']))
              {
                  $this->NM_ajax_info['errList']['telefonenota'] = array();
              }
              $this->NM_ajax_info['errList']['telefonenota'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'telefonenota';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_telefonenota

    function ValidateField_detprodutos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['detprodutos'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->detprodutos) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'detprodutos';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_detprodutos

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
      if ($this->valorcofins === "" || is_null($this->valorcofins))  
      { 
          $this->valorcofins = 0;
          $this->sc_force_zero[] = 'valorcofins';
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
              $iTestSize = 21;
              if ('-' == substr($this->valorcofins, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valorcofins, -1))
              {
                  $iTestSize++;
                  $this->valorcofins = '-' . substr($this->valorcofins, 0, -1);
              }
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
              if ($teste_validade->Valor($this->valorcofins, 18, 2, 0, 0, "S") == false)  
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
      if ($this->valorpis === "" || is_null($this->valorpis))  
      { 
          $this->valorpis = 0;
          $this->sc_force_zero[] = 'valorpis';
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
              $iTestSize = 21;
              if ('-' == substr($this->valorpis, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valorpis, -1))
              {
                  $iTestSize++;
                  $this->valorpis = '-' . substr($this->valorpis, 0, -1);
              }
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
              if ($teste_validade->Valor($this->valorpis, 18, 2, 0, 0, "S") == false)  
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
      if ($this->valoricms === "" || is_null($this->valoricms))  
      { 
          $this->valoricms = 0;
          $this->sc_force_zero[] = 'valoricms';
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
              $iTestSize = 21;
              if ('-' == substr($this->valoricms, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valoricms, -1))
              {
                  $iTestSize++;
                  $this->valoricms = '-' . substr($this->valoricms, 0, -1);
              }
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
              if ($teste_validade->Valor($this->valoricms, 18, 2, 0, 0, "S") == false)  
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
      if ($this->valorfrete === "" || is_null($this->valorfrete))  
      { 
          $this->valorfrete = 0;
          $this->sc_force_zero[] = 'valorfrete';
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
              $iTestSize = 21;
              if ('-' == substr($this->valorfrete, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valorfrete, -1))
              {
                  $iTestSize++;
                  $this->valorfrete = '-' . substr($this->valorfrete, 0, -1);
              }
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
              if ($teste_validade->Valor($this->valorfrete, 18, 2, 0, 0, "S") == false)  
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
      if ($this->valortotal === "" || is_null($this->valortotal))  
      { 
          $this->valortotal = 0;
          $this->sc_force_zero[] = 'valortotal';
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
              $iTestSize = 21;
              if ('-' == substr($this->valortotal, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valortotal, -1))
              {
                  $iTestSize++;
                  $this->valortotal = '-' . substr($this->valortotal, 0, -1);
              }
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
              if ($teste_validade->Valor($this->valortotal, 18, 2, 0, 0, "S") == false)  
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
      if ($this->valordesconto === "" || is_null($this->valordesconto))  
      { 
          $this->valordesconto = 0;
          $this->sc_force_zero[] = 'valordesconto';
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
              $iTestSize = 21;
              if ('-' == substr($this->valordesconto, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valordesconto, -1))
              {
                  $iTestSize++;
                  $this->valordesconto = '-' . substr($this->valordesconto, 0, -1);
              }
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
              if ($teste_validade->Valor($this->valordesconto, 18, 2, 0, 0, "S") == false)  
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
      if ($this->valorliquido === "" || is_null($this->valorliquido))  
      { 
          $this->valorliquido = 0;
          $this->sc_force_zero[] = 'valorliquido';
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
              $iTestSize = 21;
              if ('-' == substr($this->valorliquido, 0, 1))
              {
                  $iTestSize++;
              }
              elseif ('-' == substr($this->valorliquido, -1))
              {
                  $iTestSize++;
                  $this->valorliquido = '-' . substr($this->valorliquido, 0, -1);
              }
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
              if ($teste_validade->Valor($this->valorliquido, 18, 2, 0, 0, "S") == false)  
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

    function ValidateField_parcelas(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['parcelas'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->parcelas) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Parcelas " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['parcelas']))
              {
                  $Campos_Erros['parcelas'] = array();
              }
              $Campos_Erros['parcelas'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['parcelas']) || !is_array($this->NM_ajax_info['errList']['parcelas']))
              {
                  $this->NM_ajax_info['errList']['parcelas'] = array();
              }
              $this->NM_ajax_info['errList']['parcelas'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'parcelas';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_parcelas

    function ValidateField_observacoes(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['observacoes'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->observacoes) > 1024) 
          { 
              $hasError = true;
              $Campos_Crit .= "Observações " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 1024 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['observacoes']))
              {
                  $Campos_Erros['observacoes'] = array();
              }
              $Campos_Erros['observacoes'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1024 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['observacoes']) || !is_array($this->NM_ajax_info['errList']['observacoes']))
              {
                  $this->NM_ajax_info['errList']['observacoes'] = array();
              }
              $this->NM_ajax_info['errList']['observacoes'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1024 " . $this->Ini->Nm_lang['lang_errm_nchr'];
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
          if ($this->nmgp_opcao == "incluir" && ($this->nomereferencia == "none" || ($this->nomereferencia == "" && $this->nomereferencia_salva == "")) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['php_cmp_required']['nomereferencia']) || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['php_cmp_required']['nomereferencia'] == "on")) 
          { 
              $Campos_Falta[] = "Arquivo XML" ; 
              if (!isset($Campos_Erros['nomereferencia']))
              {
                  $Campos_Erros['nomereferencia'] = array();
              }
              $Campos_Erros['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['nomereferencia']) || !is_array($this->NM_ajax_info['errList']['nomereferencia']))
                  {
                      $this->NM_ajax_info['errList']['nomereferencia'] = array();
                  }
                  $this->NM_ajax_info['errList']['nomereferencia'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
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
                      $Campos_Crit .= "Arquivo XML: " . $this->Ini->Nm_lang['lang_errm_nfdr']; 
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
                  $Campos_Crit .= "Arquivo XML " . $this->Ini->Nm_lang['lang_errm_upld']; 
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
    $this->nmgp_dados_form['idalmoxarifadonota'] = $this->idalmoxarifadonota;
    $this->nmgp_dados_form['codigonota'] = $this->codigonota;
    $this->nmgp_dados_form['numeronota'] = $this->numeronota;
    $this->nmgp_dados_form['serienota'] = $this->serienota;
    $this->nmgp_dados_form['dataemissaonota'] = (strlen(trim($this->dataemissaonota)) > 19) ? str_replace(".", ":", $this->dataemissaonota) : trim($this->dataemissaonota);
    $this->nmgp_dados_form['qtdprodutos'] = $this->qtdprodutos;
    $this->nmgp_dados_form['qtdparcelas'] = $this->qtdparcelas;
    if (empty($this->nomereferencia))
    {
        $this->nomereferencia = $this->nmgp_dados_form['nomereferencia'];
    }
    $this->nmgp_dados_form['nomereferencia'] = $this->nomereferencia;
    $this->nmgp_dados_form['nomereferencia_limpa'] = $this->nomereferencia_limpa;
    $this->nmgp_dados_form['nomearquivo'] = $this->nomearquivo;
    $this->nmgp_dados_form['numerofaturanota'] = $this->numerofaturanota;
    $this->nmgp_dados_form['chavenota'] = $this->chavenota;
    $this->nmgp_dados_form['versaonota'] = $this->versaonota;
    $this->nmgp_dados_form['naturezanota'] = $this->naturezanota;
    $this->nmgp_dados_form['idfornecedor'] = $this->idfornecedor;
    $this->nmgp_dados_form['msgfornecedor'] = $this->msgfornecedor;
    $this->nmgp_dados_form['cnpjnota'] = $this->cnpjnota;
    $this->nmgp_dados_form['razaosocialnota'] = $this->razaosocialnota;
    $this->nmgp_dados_form['nomefantasianota'] = $this->nomefantasianota;
    $this->nmgp_dados_form['logradouronota'] = $this->logradouronota;
    $this->nmgp_dados_form['numerologradouronota'] = $this->numerologradouronota;
    $this->nmgp_dados_form['complementonota'] = $this->complementonota;
    $this->nmgp_dados_form['cidadenota'] = $this->cidadenota;
    $this->nmgp_dados_form['bairronota'] = $this->bairronota;
    $this->nmgp_dados_form['estadonota'] = $this->estadonota;
    $this->nmgp_dados_form['cepnota'] = $this->cepnota;
    $this->nmgp_dados_form['telefonenota'] = $this->telefonenota;
    $this->nmgp_dados_form['cnpj'] = $this->cnpj;
    $this->nmgp_dados_form['razaosocial'] = $this->razaosocial;
    $this->nmgp_dados_form['nomefantasia'] = $this->nomefantasia;
    $this->nmgp_dados_form['logradouro'] = $this->logradouro;
    $this->nmgp_dados_form['numero'] = $this->numero;
    $this->nmgp_dados_form['complemento'] = $this->complemento;
    $this->nmgp_dados_form['bairro'] = $this->bairro;
    $this->nmgp_dados_form['cidade'] = $this->cidade;
    $this->nmgp_dados_form['estado'] = $this->estado;
    $this->nmgp_dados_form['cep'] = $this->cep;
    $this->nmgp_dados_form['telefone'] = $this->telefone;
    $this->nmgp_dados_form['detprodutos'] = $this->detprodutos;
    $this->nmgp_dados_form['valorcofins'] = $this->valorcofins;
    $this->nmgp_dados_form['valorpis'] = $this->valorpis;
    $this->nmgp_dados_form['valoricms'] = $this->valoricms;
    $this->nmgp_dados_form['valorfrete'] = $this->valorfrete;
    $this->nmgp_dados_form['valortotal'] = $this->valortotal;
    $this->nmgp_dados_form['valordesconto'] = $this->valordesconto;
    $this->nmgp_dados_form['valorliquido'] = $this->valorliquido;
    $this->nmgp_dados_form['parcelas'] = $this->parcelas;
    $this->nmgp_dados_form['descricaoparcelas'] = $this->descricaoparcelas;
    $this->nmgp_dados_form['observacoes'] = $this->observacoes;
    $this->nmgp_dados_form['produtos'] = $this->produtos;
    $this->nmgp_dados_form['descricaoprodutos'] = $this->descricaoprodutos;
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['dataemissaonota'] = $this->dataemissaonota;
      $this->Before_unformat['dataemissaonota_hora'] = $this->dataemissaonota_hora;
      nm_limpa_data($this->dataemissaonota, $this->field_config['dataemissaonota']['date_sep']) ; 
      nm_limpa_hora($this->dataemissaonota_hora, $this->field_config['dataemissaonota']['time_sep']) ; 
      $this->Before_unformat['qtdprodutos'] = $this->qtdprodutos;
      nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
      $this->Before_unformat['qtdparcelas'] = $this->qtdparcelas;
      nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
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
      $this->Before_unformat['valordesconto'] = $this->valordesconto;
      if (!empty($this->field_config['valordesconto']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_mon']);
         nm_limpa_valor($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp']);
      }
      $this->Before_unformat['valorliquido'] = $this->valorliquido;
      if (!empty($this->field_config['valorliquido']['symbol_dec']))
      {
         $this->sc_remove_currency($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_mon']);
         nm_limpa_valor($this->valorliquido, $this->field_config['valorliquido']['symbol_dec'], $this->field_config['valorliquido']['symbol_grp']);
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
      if ($Nome_Campo == "qtdprodutos")
      {
          nm_limpa_numero($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "qtdparcelas")
      {
          nm_limpa_numero($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp']) ; 
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
      if ($Nome_Campo == "valordesconto")
      {
          if (!empty($this->field_config['valordesconto']['symbol_dec']))
          {
             $this->sc_remove_currency($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_mon']);
             nm_limpa_valor($this->valordesconto, $this->field_config['valordesconto']['symbol_dec'], $this->field_config['valordesconto']['symbol_grp']);
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
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if ((!empty($this->dataemissaonota) && 'null' != $this->dataemissaonota) || (!empty($format_fields) && isset($format_fields['dataemissaonota'])))
      {
          $nm_separa_data = strpos($this->field_config['dataemissaonota']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['dataemissaonota']['date_format'];
          $this->field_config['dataemissaonota']['date_format'] = substr($this->field_config['dataemissaonota']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->dataemissaonota, " ") ; 
          $this->dataemissaonota_hora = substr($this->dataemissaonota, $separador + 1) ; 
          $this->dataemissaonota = substr($this->dataemissaonota, 0, $separador) ; 
          nm_volta_data($this->dataemissaonota, $this->field_config['dataemissaonota']['date_format']) ; 
          nmgp_Form_Datas($this->dataemissaonota, $this->field_config['dataemissaonota']['date_format'], $this->field_config['dataemissaonota']['date_sep']) ;  
          $this->field_config['dataemissaonota']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->dataemissaonota_hora, $this->field_config['dataemissaonota']['date_format']) ; 
          nmgp_Form_Hora($this->dataemissaonota_hora, $this->field_config['dataemissaonota']['date_format'], $this->field_config['dataemissaonota']['time_sep']) ;  
          $this->field_config['dataemissaonota']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->dataemissaonota || '' == $this->dataemissaonota)
      {
          $this->dataemissaonota_hora = '';
          $this->dataemissaonota = '';
      }
      if ('' !== $this->qtdprodutos || (!empty($format_fields) && isset($format_fields['qtdprodutos'])))
      {
          nmgp_Form_Num_Val($this->qtdprodutos, $this->field_config['qtdprodutos']['symbol_grp'], $this->field_config['qtdprodutos']['symbol_dec'], "0", "S", $this->field_config['qtdprodutos']['format_neg'], "", "", "-", $this->field_config['qtdprodutos']['symbol_fmt']) ; 
      }
      if ('' !== $this->qtdparcelas || (!empty($format_fields) && isset($format_fields['qtdparcelas'])))
      {
          nmgp_Form_Num_Val($this->qtdparcelas, $this->field_config['qtdparcelas']['symbol_grp'], $this->field_config['qtdparcelas']['symbol_dec'], "0", "S", $this->field_config['qtdparcelas']['format_neg'], "", "", "-", $this->field_config['qtdparcelas']['symbol_fmt']) ; 
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
      if ('' !== $this->valordesconto || (!empty($format_fields) && isset($format_fields['valordesconto'])))
      {
          nmgp_Form_Num_Val($this->valordesconto, $this->field_config['valordesconto']['symbol_grp'], $this->field_config['valordesconto']['symbol_dec'], "2", "S", $this->field_config['valordesconto']['format_neg'], "", "", "-", $this->field_config['valordesconto']['symbol_fmt']) ; 
      }
      if ('' !== $this->valorliquido || (!empty($format_fields) && isset($format_fields['valorliquido'])))
      {
          nmgp_Form_Num_Val($this->valorliquido, $this->field_config['valorliquido']['symbol_grp'], $this->field_config['valorliquido']['symbol_dec'], "2", "S", $this->field_config['valorliquido']['format_neg'], "", "", "-", $this->field_config['valorliquido']['symbol_fmt']) ; 
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
      if ($this->dataemissaonota != "")  
      {
              $this->dataemissaonota .= $this->dataemissaonota_hora ; 
     nm_conv_form_data_hora($this->dataemissaonota, $this->field_config['dataemissaonota']['date_format'], "AAAAMMDD HH:II:SS", array($this->field_config['dataemissaonota']['date_sep'], $this->field_config['dataemissaonota']['time_sep'])) ;  
      }
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

   function ajax_return_values()
   {
          $this->ajax_return_values_idalmoxarifadonota();
          $this->ajax_return_values_codigonota();
          $this->ajax_return_values_numeronota();
          $this->ajax_return_values_serienota();
          $this->ajax_return_values_dataemissaonota();
          $this->ajax_return_values_qtdprodutos();
          $this->ajax_return_values_qtdparcelas();
          $this->ajax_return_values_nomereferencia();
          $this->ajax_return_values_nomearquivo();
          $this->ajax_return_values_numerofaturanota();
          $this->ajax_return_values_chavenota();
          $this->ajax_return_values_versaonota();
          $this->ajax_return_values_naturezanota();
          $this->ajax_return_values_idfornecedor();
          $this->ajax_return_values_msgfornecedor();
          $this->ajax_return_values_cnpjnota();
          $this->ajax_return_values_razaosocialnota();
          $this->ajax_return_values_nomefantasianota();
          $this->ajax_return_values_logradouronota();
          $this->ajax_return_values_numerologradouronota();
          $this->ajax_return_values_complementonota();
          $this->ajax_return_values_cidadenota();
          $this->ajax_return_values_bairronota();
          $this->ajax_return_values_estadonota();
          $this->ajax_return_values_cepnota();
          $this->ajax_return_values_telefonenota();
          $this->ajax_return_values_cnpj();
          $this->ajax_return_values_razaosocial();
          $this->ajax_return_values_nomefantasia();
          $this->ajax_return_values_logradouro();
          $this->ajax_return_values_numero();
          $this->ajax_return_values_complemento();
          $this->ajax_return_values_bairro();
          $this->ajax_return_values_cidade();
          $this->ajax_return_values_estado();
          $this->ajax_return_values_cep();
          $this->ajax_return_values_telefone();
          $this->ajax_return_values_detprodutos();
          $this->ajax_return_values_valorcofins();
          $this->ajax_return_values_valorpis();
          $this->ajax_return_values_valoricms();
          $this->ajax_return_values_valorfrete();
          $this->ajax_return_values_valortotal();
          $this->ajax_return_values_valordesconto();
          $this->ajax_return_values_valorliquido();
          $this->ajax_return_values_parcelas();
          $this->ajax_return_values_descricaoparcelas();
          $this->ajax_return_values_observacoes();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- idalmoxarifadonota
   function ajax_return_values_idalmoxarifadonota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idalmoxarifadonota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idalmoxarifadonota);
              $aLookup = array();
              $this->_tmp_lookup_idalmoxarifadonota = $this->idalmoxarifadonota;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'] = array(); 
}
$aLookup[] = array(AlmoxarifadoImportacaoXml_Ctr_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoImportacaoXml_Ctr_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_dataemissaonota = $this->dataemissaonota;
   $old_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_valorliquido = $this->valorliquido;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_dataemissaonota = $this->dataemissaonota;
   $unformatted_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_valorliquido = $this->valorliquido;

   $nm_comando = "SELECT IdAlmoxarifado, CONCAT(Sigla, ' - ', Descricao)  FROM almoxarifado WHERE IdTenacidade = " . $_SESSION['varIdTenacidade'] . " AND PermiteEntrada = 'S'";

   $this->dataemissaonota = $old_value_dataemissaonota;
   $this->dataemissaonota_hora = $old_value_dataemissaonota_hora;
   $this->qtdprodutos = $old_value_qtdprodutos;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valordesconto = $old_value_valordesconto;
   $this->valorliquido = $old_value_valorliquido;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoImportacaoXml_Ctr_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoImportacaoXml_Ctr_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idalmoxarifadonota\"";
          if (isset($this->NM_ajax_info['select_html']['idalmoxarifadonota']) && !empty($this->NM_ajax_info['select_html']['idalmoxarifadonota']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idalmoxarifadonota']);
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

                  if ($this->idalmoxarifadonota == $sValue)
                  {
                      $this->_tmp_lookup_idalmoxarifadonota = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idalmoxarifadonota'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadonota']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idalmoxarifadonota']['valList'][$i] = AlmoxarifadoImportacaoXml_Ctr_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idalmoxarifadonota']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idalmoxarifadonota']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idalmoxarifadonota']['labList'] = $aLabel;
          }
   }

          //----- codigonota
   function ajax_return_values_codigonota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("codigonota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->codigonota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['codigonota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("codigonota", $this->form_encode_input($sTmpValue))),
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

          //----- serienota
   function ajax_return_values_serienota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("serienota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->serienota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['serienota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("serienota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- dataemissaonota
   function ajax_return_values_dataemissaonota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dataemissaonota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dataemissaonota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dataemissaonota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->dataemissaonota . ' ' . $this->dataemissaonota_hora),
               'labList' => array($this->form_format_readonly("dataemissaonota", $this->form_encode_input($sTmpValue))),
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
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['download_filenames'][$sTmpFile] = $this->nomereferencia;
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
               'docLink' => "<a href=\"javascript:nm_mostra_doc('0', '" . $sTmpFile . "', 'AlmoxarifadoImportacaoXml_Ctr')\">" . $tmp_file_nomereferencia . "</a>",
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
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- numerofaturanota
   function ajax_return_values_numerofaturanota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numerofaturanota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numerofaturanota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numerofaturanota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- chavenota
   function ajax_return_values_chavenota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("chavenota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->chavenota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['chavenota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("chavenota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- versaonota
   function ajax_return_values_versaonota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("versaonota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->versaonota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['versaonota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("versaonota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- naturezanota
   function ajax_return_values_naturezanota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("naturezanota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->naturezanota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['naturezanota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("naturezanota", $this->form_encode_input($sTmpValue))),
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

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'] = array(); 
}
$aLookup[] = array(AlmoxarifadoImportacaoXml_Ctr_pack_protect_string('') => str_replace('<', '&lt;',AlmoxarifadoImportacaoXml_Ctr_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_dataemissaonota = $this->dataemissaonota;
   $old_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_valorliquido = $this->valorliquido;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_dataemissaonota = $this->dataemissaonota;
   $unformatted_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_valorliquido = $this->valorliquido;

   $nm_comando = "SELECT IdFornecedor, NomeFantasia  FROM fornecedor  WHERE IdTenacidade = " . $_SESSION['varIdTenacidade'] . " ORDER BY NomeFantasia";

   $this->dataemissaonota = $old_value_dataemissaonota;
   $this->dataemissaonota_hora = $old_value_dataemissaonota_hora;
   $this->qtdprodutos = $old_value_qtdprodutos;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valordesconto = $old_value_valordesconto;
   $this->valorliquido = $old_value_valorliquido;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(AlmoxarifadoImportacaoXml_Ctr_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', AlmoxarifadoImportacaoXml_Ctr_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'][] = $rs->fields[0];
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
              $this->NM_ajax_info['fldList']['idfornecedor']['valList'][$i] = AlmoxarifadoImportacaoXml_Ctr_pack_protect_string($v);
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

          //----- msgfornecedor
   function ajax_return_values_msgfornecedor($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("msgfornecedor", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->msgfornecedor);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['msgfornecedor'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- cnpjnota
   function ajax_return_values_cnpjnota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cnpjnota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cnpjnota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cnpjnota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("cnpjnota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- razaosocialnota
   function ajax_return_values_razaosocialnota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("razaosocialnota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->razaosocialnota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['razaosocialnota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("razaosocialnota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- nomefantasianota
   function ajax_return_values_nomefantasianota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nomefantasianota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->nomefantasianota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['nomefantasianota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("nomefantasianota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- logradouronota
   function ajax_return_values_logradouronota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("logradouronota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->logradouronota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['logradouronota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("logradouronota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- numerologradouronota
   function ajax_return_values_numerologradouronota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numerologradouronota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numerologradouronota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numerologradouronota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("numerologradouronota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- complementonota
   function ajax_return_values_complementonota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("complementonota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->complementonota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['complementonota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("complementonota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- cidadenota
   function ajax_return_values_cidadenota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cidadenota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cidadenota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cidadenota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("cidadenota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- bairronota
   function ajax_return_values_bairronota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bairronota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bairronota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bairronota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("bairronota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- estadonota
   function ajax_return_values_estadonota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("estadonota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->estadonota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['estadonota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("estadonota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- cepnota
   function ajax_return_values_cepnota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cepnota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cepnota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cepnota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("cepnota", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- telefonenota
   function ajax_return_values_telefonenota($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("telefonenota", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->telefonenota);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['telefonenota'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("telefonenota", $this->form_encode_input($sTmpValue))),
              );
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

          //----- logradouro
   function ajax_return_values_logradouro($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("logradouro", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->logradouro);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['logradouro'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- numero
   function ajax_return_values_numero($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("numero", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->numero);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['numero'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- complemento
   function ajax_return_values_complemento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("complemento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->complemento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['complemento'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bairro
   function ajax_return_values_bairro($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bairro", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bairro);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bairro'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- cidade
   function ajax_return_values_cidade($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cidade", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cidade);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cidade'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- estado
   function ajax_return_values_estado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("estado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->estado);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['estado'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- cep
   function ajax_return_values_cep($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cep", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cep);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cep'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- telefone
   function ajax_return_values_telefone($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("telefone", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->telefone);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['telefone'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- detprodutos
   function ajax_return_values_detprodutos($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("detprodutos", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->detprodutos);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['detprodutos'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
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

          //----- parcelas
   function ajax_return_values_parcelas($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("parcelas", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->parcelas);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['parcelas'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
               'labList' => array($this->form_format_readonly("parcelas", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- descricaoparcelas
   function ajax_return_values_descricaoparcelas($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("descricaoparcelas", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->descricaoparcelas);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['descricaoparcelas'] = array(
                       'row'    => '',
               'type'    => 'label',
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['upload_dir'][$fieldName][] = $newName;
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

/*----- Scriptcase Locale: Ajax Event IdAlmoxarifadoNota_onChange ------*/

function IdAlmoxarifadoNota_onChange()
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdAlmoxarifadoNota)) {$this->sc_temp_varIdAlmoxarifadoNota = (isset($_SESSION['varIdAlmoxarifadoNota'])) ? $_SESSION['varIdAlmoxarifadoNota'] : "";}
  
$original_idalmoxarifadonota = $this->idalmoxarifadonota;
$original_nomereferencia = $this->nomereferencia;

$this->sc_temp_varIdAlmoxarifadoNota = $this->idalmoxarifadonota ;
$this->nmgp_cmp_hidden["nomereferencia"] = 'on'; $this->NM_ajax_info['fieldDisplay']['nomereferencia'] = 'on';


if (isset($this->sc_temp_varIdAlmoxarifadoNota)) { $_SESSION['varIdAlmoxarifadoNota'] = $this->sc_temp_varIdAlmoxarifadoNota;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
$modificado_idalmoxarifadonota = $this->idalmoxarifadonota;
$modificado_nomereferencia = $this->nomereferencia;
$this->nm_formatar_campos('idalmoxarifadonota', 'nomereferencia');
if ($original_idalmoxarifadonota !== $modificado_idalmoxarifadonota || isset($this->nmgp_cmp_readonly['idalmoxarifadonota']) || (isset($bFlagRead_idalmoxarifadonota) && $bFlagRead_idalmoxarifadonota))
{
    $this->ajax_return_values_idalmoxarifadonota(true);
}
if ($original_nomereferencia !== $modificado_nomereferencia || isset($this->nmgp_cmp_readonly['nomereferencia']) || (isset($bFlagRead_nomereferencia) && $bFlagRead_nomereferencia))
{
    $this->ajax_return_values_nomereferencia(true);
}
$this->NM_ajax_info['event_field'] = 'IdAlmoxarifadoNota';
AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
exit;
}

/*----- END - Scriptcase Locale: Ajax Event IdAlmoxarifadoNota_onChange ------*/


/*----- Scriptcase Locale: PHP Method: criarFornecedor ------*/

function criarFornecedor(&$parFornecedorNovo)
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$enderecoIpAuditoria = $_SERVER['REMOTE_ADDR'];
$nomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;

$check_sql = "SELECT IdFornecedor"
   . " FROM fornecedor"
   . " WHERE IdTenacidade = '$this->sc_temp_varIdTenacidade' AND Cnpj = '$this->cnpjnota'";
 
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
    $this->idfornecedor  = $this->rs[0][0];
} else {
	$insert_table  = 'fornecedor';
	$insert_fields = array(
		 'IdTenacidade' 			=> "'$this->sc_temp_varIdTenacidade'",
		 'IdSituacaoFornecedor' 	=> "'1'",
		 'IdUsuarioAuditoria' 		=> "'$this->sc_temp_varIdUsuario'",
		 'TipoPessoa' 				=> "'J'",
		 'RazaoSocial' 				=> "'$this->razaosocialnota'",
		 'NomeFantasia' 			=> "'$this->nomefantasianota'",
		 'Cnpj' 					=> "'$this->cnpjnota'",
		 'Cep' 						=> "'$this->cepnota'",
		 'TipoLogradouro' 			=> "''",
		 'Logradouro' 				=> "'$this->logradouronota'",
		 'Numero' 					=> "'$this->numerologradouronota'",
		 'Complemento' 				=> "'$this->complementonota'",
		 'Bairro' 					=> "'$this->bairronota'",
		 'Cidade' 					=> "'$this->cidadenota'",
		 'Estado' 					=> "'$this->estadonota'",
		 'Telefone' 				=> "'$this->telefonenota'",
		 'EnderecoIpAuditoria' 		=> "'$enderecoIpAuditoria'",
		 'NomeAplicacaoAuditoria' 	=> "'$nomeAplicacaoAuditoria'",
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
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      	
	
	$check_sql = "SELECT LAST_INSERT_ID()";

	 
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
		$this->idfornecedor  = $this->rs[0][0];
	} else {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Identificador do Fornecedor não recuperado.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Identificador do Fornecedor não recuperado.";
 }
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
    $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
    return;
}
}
}

return;
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: criarFornecedor ------*/


/*----- Scriptcase Locale: PHP Method: criarObterProduto ------*/

function criarObterProduto($parDadosProduto)
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUnico)) {$this->sc_temp_varIdUnico = (isset($_SESSION['varIdUnico'])) ? $_SESSION['varIdUnico'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$enderecoIpAuditoria = $_SERVER['REMOTE_ADDR'];
$nomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;

$dadosProduto 	= explode('</>', $parDadosProduto);
$codigo	 		= $dadosProduto[0];
$nome	 		= $dadosProduto[1];
$volume		 	= $dadosProduto[2];
$quantidade	 	= $dadosProduto[3];
$valorUnitario	= $dadosProduto[4];
$valorTotal	 	= $dadosProduto[5];
$lote	 		= $dadosProduto[6];
$dataFabricacao	= $dadosProduto[7];
$dataValidade	= $dadosProduto[8];
$codigoBarras	= $dadosProduto[9];

$idAlmoxarifadoProdutoVolume = $this->criarObterVolume($volume);

$check_sql = "SELECT IdAlmoxarifadoProduto"
   . " FROM almoxarifadoproduto"
   . " WHERE IdTenacidade = '$this->sc_temp_varIdTenacidade' AND Codigo = '$codigo'";
 
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
    $idAlmoxarifadoProdutoReferencia = $this->rs[0][0];
} else {
	$idAlmoxarifadoProdutoReferencia = "NULL";
	$insert_table  = '_almoxarifadoproduto';
	$insert_fields = array(
		 'IdTenacidade' 						=> "'$this->sc_temp_varIdTenacidade'",
		 'IdAlmoxarifadoProdutoClassificacao' 	=> "NULL",
		 'IdAlmoxarifadoProdutoGrupo' 			=> "NULL",
		 'IdAlmoxarifadoProdutoVolume' 			=> "$idAlmoxarifadoProdutoVolume",
		 'IdAlmoxarifadoProdutoReferencia'		=> "$idAlmoxarifadoProdutoReferencia",
		 'IdUsuarioAuditoria' 					=> "'$this->sc_temp_varIdUsuario'",
		 'IdUnico' 								=> "'$this->sc_temp_varIdUnico'",
		 'Sigla' 								=> "'$codigo'",
		 'Codigo' 								=> "'$codigo'",
		 'Descricao' 							=> "'$nome'",
		 'CodigoExterno' 						=> "NULL",
		 'CodigoBarras' 						=> "'$codigoBarras'",
		 'EstoqueMinimo' 						=> "NULL",
		 'EstoqueMaximo' 						=> "NULL",
		 'ValorPontoPedido' 					=> "NULL",
		 'TipoPontoPedido' 						=> "NULL",
		 'Quantidade' 							=> "$quantidade",
		 'ValorUnitario' 						=> "$valorUnitario",
		 'Observacoes' 							=> "NULL",
		 'Ativo' 								=> "'S'",
		 'EnderecoIpAuditoria' 					=> "'$enderecoIpAuditoria'",
		 'NomeAplicacaoAuditoria' 				=> "'$nomeAplicacaoAuditoria'",
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
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	
}

return;
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varIdUnico)) { $_SESSION['varIdUnico'] = $this->sc_temp_varIdUnico;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: criarObterProduto ------*/


/*----- Scriptcase Locale: PHP Method: criarObterVolume ------*/

function criarObterVolume($parVolume)
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$enderecoIpAuditoria = $_SERVER['REMOTE_ADDR'];
$nomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;

$check_sql = "SELECT IdAlmoxarifadoProdutoVolume"
   . " FROM almoxarifadoprodutovolume"
   . " WHERE Sigla = '" . $parVolume . "'";
 
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
    $idAlmoxarifadoProdutoVolume = $this->rs[0][0];
} else {
	$insert_table  = 'almoxarifadoprodutovolume';
	$insert_fields = array(
		 'IdTenacidade' 			=> "'$this->sc_temp_varIdTenacidade'",
		 'IdUsuarioAuditoria' 		=> "'$this->sc_temp_varIdUsuario'",
		 'Sigla' 					=> "'$parVolume'",
		 'Descricao' 				=> "'$parVolume'",
		 'Ativo' 					=> "'S'",
		 'EnderecoIpAuditoria' 		=> "'$enderecoIpAuditoria'",
		 'NomeAplicacaoAuditoria' 	=> "'$nomeAplicacaoAuditoria'",
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
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

	$check_sql = "SELECT LAST_INSERT_ID()";

	 
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
		$idAlmoxarifadoProdutoVolume = $this->rs[0][0];
	} else {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Identificador do Fornecedor não recuperado.";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Identificador do Fornecedor não recuperado.";
 }
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
    $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
    return;
}
}
}

return $idAlmoxarifadoProdutoVolume;
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: criarObterVolume ------*/


/*----- Scriptcase Locale: PHP Method: criarTabelaParcelas ------*/

function criarTabelaParcelas()
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
  
$html = '<table border="0" style="width:100%">' .
		'<tr>
			<th align="center">Nº</td>
			<th align="center">Vencimento</td>
			<th align="right">Valor</td>
		</tr>';

$vetParcelas = explode('<@>', $this->parcelas );
foreach ($vetParcelas as $vetDadosParcela) {
	$dadosParcela 		= explode('</>', $vetDadosParcela);
	$parcela	 		= $dadosParcela[0];
	$dataVencimento		= $this->nm_conv_data_db($dadosParcela[1],"aaaammdd","dd/mm/aaaa");
	$valor				= $dadosParcela[2];
	nmgp_Form_Num_Val($valor, '.', ',', 2, 'S', '1', '');

	$html = $html .
    '<tr>' .
        '<td align="center">' . $parcela			. '</td>' .
        '<td align="center">' . $dataVencimento   	. '</td>' .
        '<td align="right">'  . $valor  			. '</td>' .
    '</tr>';
}

$html = $html . '</table>';

$this->descricaoparcelas  = $html;
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: criarTabelaParcelas ------*/


/*----- Scriptcase Locale: PHP Method: criarTabelaProdutos ------*/

function criarTabelaProdutos()
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varVetProdutos)) {$this->sc_temp_varVetProdutos = (isset($_SESSION['varVetProdutos'])) ? $_SESSION['varVetProdutos'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdUnico)) {$this->sc_temp_varIdUnico = (isset($_SESSION['varIdUnico'])) ? $_SESSION['varIdUnico'] : "";}
  

$this->sc_temp_varIdUnico = $this->sc_temp_varIdUsuario . '-' . uniqid('', true);
$vetProdutos = explode('<@>', $this->sc_temp_varVetProdutos);
foreach ($vetProdutos as $vetDadosProduto) {
	$this->criarObterProduto($vetDadosProduto);
}
$this->detprodutos  	= '<iframe id="frameProdutos"'
				.		' src= "../_AlmoxarifadoProduto_Lst/_AlmoxarifadoProduto_Lst.php"'
				. 		' style="background-color: #FFFFFF; border: none; width: 100%; height: 840px" border: none;">'
				.  '</iframe>';

if (isset($this->sc_temp_varIdUnico)) { $_SESSION['varIdUnico'] = $this->sc_temp_varIdUnico;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varVetProdutos)) { $_SESSION['varVetProdutos'] = $this->sc_temp_varVetProdutos;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: criarTabelaProdutos ------*/


/*----- Scriptcase Locale: PHP Method: decodificarXML ------*/

function decodificarXML()
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varImportar)) {$this->sc_temp_varImportar = (isset($_SESSION['varImportar'])) ? $_SESSION['varImportar'] : "";}
if (!isset($this->sc_temp_varVetProdutos)) {$this->sc_temp_varVetProdutos = (isset($_SESSION['varVetProdutos'])) ? $_SESSION['varVetProdutos'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$arquivo_obj = fopen($this->Ini->path_doc."/". $this->nomereferencia , "r");

$docxml = file_get_contents($this->Ini->path_doc."/".$this->sc_temp_varIdTenacidade."/".$this->nomereferencia );

echo "oi".$this->Ini->path_doc."/".$this->sc_temp_varIdTenacidade."/".$this->nomereferencia ;
die("aqui");

$doc = new DOMDocument();
$doc->preservWhiteSpace = FALSE;
$doc->formatOutput = FALSE;
$doc = simplexml_load_string($docxml);

$this->versaonota  			= (string)$doc->NFe[0]->infNFe[0]['versao'];
$this->chavenota  			= (string)$doc->NFe[0]->infNFe[0]['Id'];
$this->codigonota  			= (string)$doc->NFe[0]->infNFe[0]->ide->cNF;
$this->numeronota  			= (string)$doc->NFe[0]->infNFe[0]->ide->nNF;
$this->naturezanota  			= (string)$doc->NFe[0]->infNFe[0]->ide->natOp;
$naturezafatura  		= (string)$doc->NFe[0]->infNFe[0]->ide->natOp;
$this->serienota  			= (string)$doc->NFe[0]->infNFe[0]->ide->serie;
$varDataEmissaoNF 		= (string)$doc->NFe[0]->infNFe[0]->ide->dhEmi;
$varDataEmissaoNF 		= new DateTime($varDataEmissaoNF);
$this->dataemissaonota  		= $varDataEmissaoNF->format('Y-m-d H:i:s');
$this->qtdprodutos  			= (int)$doc->NFe[0]->infNFe[0]->det->count();	
$this->qtdparcelas 			= (int)$doc->NFe[0]->infNFe[0]->cobr[0]->dup->count();
$numerofatura  			= (string)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->nFat;
$this->valortotal  			= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->vOrig;
$this->valordesconto 			= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->vDesc;
$this->valorcofins 			= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->vCOFINS_cofins_ST;
$this->valorpis 				= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->vPIS;
$this->valorliquido 			= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->vLiq;
$this->valoricms 				= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->vICMS_ttlnfe;
$this->valorfrete 			= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->fat->vFrete_ttlnfe;
$this->observacoes  			= (string)$doc->NFe[0]->infNFe[0]->infAdic->infCpl;

$this->cnpjnota  				= (string)$doc->NFe[0]->infNFe[0]->emit->CNPJ;
$this->idfornecedor 			= $this->obterFornecedor($this->cnpjnota );

$this->razaosocialnota  		= (string)$doc->NFe[0]->infNFe[0]->emit->xNome;
$this->nomefantasianota  		= (string)$doc->NFe[0]->infNFe[0]->emit->xFant;
$this->logradouronota  		= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->xLgr;
$this->numerologradouronota  	= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->nro;
$this->complementonota  		= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->xCpl;
$this->bairronota  			= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->xBairro;
$codigocidadenota 	 	= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->cMun;
$this->cidadenota  			= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->xMun;
$this->estadonota 			= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->UF;
$this->cepnota 				= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->CEP;
$this->telefonenota 			= (string)$doc->NFe[0]->infNFe[0]->emit->enderEmit->fone;

$qtdProduto 			= (int)$doc->NFe[0]->infNFe[0]->det->count();	

$vetProdutos = array();
$this->descricaoparcelas  = '';
for ($i=0; $i<$qtdProduto; $i++) {
	$codigo 			= (string)$doc->NFe[0]->infNFe[0]->det[$i]->prod->cProd;
	$nome 				= (string)$doc->NFe[0]->infNFe[0]->det[$i]->prod->xProd;
	$volume 			= (string)$doc->NFe[0]->infNFe[0]->det[$i]->prod->uCom;
	$quantidade 		= (int)$doc->NFe[0]->infNFe[0]->det[$i]->prod->qCom;
	$valorUnitario 		= (float)$doc->NFe[0]->infNFe[0]->det[$i]->prod->vUnCom;
	$valorTotal 		= (float)$doc->NFe[0]->infNFe[0]->det[$i]->prod->vProd;
	$lote 				= (string)$doc->NFe[0]->infNFe[0]->det[$i]->prod->rastro->nLote;
	$dataFabricacao 	= $doc->NFe[0]->infNFe[0]->det[$i]->prod->rastro->dFab;
	$dataValidade 		= $doc->NFe[0]->infNFe[0]->det[$i]->prod->rastro->dVal;
	$codigoBarras 		= (string)$doc->NFe[0]->infNFe[0]->det[$i]->prod->cEAN;
	if (!is_numeric($codigoBarras)) {
		$codigoBarras = null;
	}
	
	$numeroProduto = $i + 1;

	$vetProdutos[$i] = $codigo . '</>' . $nome . '</>' . $volume . '</>' . $quantidade . '</>' . $valorUnitario . '</>' 
						 . $valorTotal . '</>' . $lote . '</>' . $dataFabricacao . '</>' . $dataValidade. '</>' . $codigoBarras;
}
$this->sc_temp_varVetProdutos = implode('<@>', $vetProdutos);
$this->criarTabelaProdutos();

$qtdParcelas 			= (int)$doc->NFe[0]->infNFe[0]->cobr[0]->dup->count();
$vetParcelas = array();
for ($i=0; $i<$qtdParcelas; $i++) {
	$parcela 			= (int)$doc->NFe[0]->infNFe[0]->cobr[0]->dup[$i]->nDup;
	$dataVencimento 	= (string)$doc->NFe[0]->infNFe[0]->cobr[0]->dup[$i]->dVenc;
	$valor 				= (float)$doc->NFe[0]->infNFe[0]->cobr[0]->dup[$i]->vDup;

	$vetParcelas[$i] = $parcela . '</>' . $dataVencimento . '</>' . $valor;
}
$this->parcelas  = implode('<@>', $vetParcelas);
$this->criarTabelaParcelas();

$codigo	= $doc->NFe[0]->infNFe[0]->ide->cNF;
$check_sql = "SELECT IdAlmoxarifadoEntrada"
   . " FROM almoxarifadoentrada"
   . " WHERE Codigo = '$codigo' AND IdTenacidade = $this->sc_temp_varIdTenacidade";
 
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

$varDataEmissaoNF 		= (string)$doc->NFe[0]->infNFe[0]->ide->dhEmi;
$varDataEmissaoNF 		= new DateTime($varDataEmissaoNF);
$this->dataemissaonota  		= $varDataEmissaoNF->format('Y-m-d H:i:s');

if (isset($this->rs[0][0])) {
	$this->sc_temp_varImportar = 'N';
	$this->sc_field_readonly("nomereferencia", 'off');
unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['nomereferencia']);
;
	$this->sc_btn_label('ok', 'Verificar XML');
	$idAlmoxarifadoEntradaNota 	= $this->rs[0][0];
	$this->NM_ajax_info['buttonDisplay']['Importar'] = $this->nmgp_botoes["Importar"] = 'off';;
	$this->verificarCamposFornecedor();
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Nota Fiscal '$codigo' já foi importada anteriormente ($idAlmoxarifadoEntradaNota)";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_AlmoxarifadoImportacaoXml_Ctr';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Nota Fiscal '$codigo' já foi importada anteriormente ($idAlmoxarifadoEntradaNota)";
 }
;
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (isset($this->sc_temp_varVetProdutos)) { $_SESSION['varVetProdutos'] = $this->sc_temp_varVetProdutos;}
 if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
    $_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
    return;
}
} else {
	$this->sc_temp_varImportar = 'S';
}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varVetProdutos)) { $_SESSION['varVetProdutos'] = $this->sc_temp_varVetProdutos;}
if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: decodificarXML ------*/


/*----- Scriptcase Locale: PHP Method: formatarDados ------*/

function formatarDados($parValor, $parMascara)
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
  
$Formatado = '';
$k = 0;
for($i = 0; $i<=strlen($parMascara)-1; $i++) {
	if($parMascara[$i] == '#') {
		if(isset($parValor[$k]))
			$Formatado .= $parValor[$k++];
	}
	else { 
		if(isset($parMascara[$i]))
			$Formatado .= $parMascara[$i];
	}
}
return $Formatado;

$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: formatarDados ------*/


/*----- Scriptcase Locale: PHP Method: incluirNotaEntrada ------*/

function incluirNotaEntrada()
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUnico)) {$this->sc_temp_varIdUnico = (isset($_SESSION['varIdUnico'])) ? $_SESSION['varIdUnico'] : "";}
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varMsgErroProdutos)) {$this->sc_temp_varMsgErroProdutos = (isset($_SESSION['varMsgErroProdutos'])) ? $_SESSION['varMsgErroProdutos'] : "";}
if (!isset($this->sc_temp_varMsgErroParcelas)) {$this->sc_temp_varMsgErroParcelas = (isset($_SESSION['varMsgErroParcelas'])) ? $_SESSION['varMsgErroParcelas'] : "";}
if (!isset($this->sc_temp_varMsgErroNota)) {$this->sc_temp_varMsgErroNota = (isset($_SESSION['varMsgErroNota'])) ? $_SESSION['varMsgErroNota'] : "";}
  
$this->sc_temp_varMsgErroNota = '';
$this->sc_temp_varMsgErroParcelas = '';
$this->sc_temp_varMsgErroProdutos = '';

$esc = function($s) {
    return str_replace("'", "''", (string)$s);
};

if ((!isset($this->Ini->nm_bases_access) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) && !$this->Ini->sc_tem_trans_banco)
{
    $this->Ini->sc_tem_trans_banco = $this->Db->BeginTrans();
}


$check_sql = "SELECT IdAlmoxarifadoEntrada, Codigo
                FROM almoxarifadoentrada
               WHERE Codigo = '" . $this->codigonota  . "'
                 AND IdTenacidade = " . (int)$this->sc_temp_varIdTenacidade;

 
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
    if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->RollbackTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

    $this->sc_temp_varMsgErroNota = "Nota Fiscal '" . $this->rs[0][1] . "' já foi importada anteriormente (" . $this->rs[0][0] . ").";
    return false;
}

$enderecoIpAuditoria    = $_SERVER['REMOTE_ADDR'];
$nomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;

$dataHoraInclusao = date('Y-m-d H:i:s');
$dataEmissao      = $this->nm_conv_data_db(substr($this->dataemissaonota , 0, 8), "aaaammdd", "db_format");
$dataHoraEmissao  = $dataEmissao . substr($this->dataemissaonota , 8, 6) . ':00';

$this->criarFornecedor($fornecedornovo );

$check_sql = "SELECT IdEmpresa
                FROM almoxarifado
               WHERE IdAlmoxarifado = '" . $this->idalmoxarifadonota  . "'";
 
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


$idEmpresa = (isset($this->rs[0][0])) ? $this->rs[0][0] : NULL;

$insert_table  = 'almoxarifadoentrada';
$insert_fields = array(
    'IdTenacidade'            => "'$this->sc_temp_varIdTenacidade'",
    'IdFornecedor'            => "'$this->idfornecedor'",
    'IdAlmoxarifado'          => "'$this->idalmoxarifadonota'",
    'IdUsuarioAuditoria'      => "'$this->sc_temp_varIdUsuario'",
    'Cnpj'                    => "'$this->cnpjnota'",
    'RazaoSocial'             => "'$this->razaosocialnota'",
    'NomeFantasia'            => "'$this->nomefantasianota'",
    'Versao'                  => "'$this->versaonota'",
    'Chave'                   => "'$this->chavenota'",
    'Codigo'                  => "'$this->codigonota'",
    'NumeroNota'              => "'$this->numeronota'",
    'NumeroFatura'            => "'$numerofatura'",
    'Natureza'                => "'$this->naturezanota'",
    'Serie'                   => "'$this->serienota'",
    'DataHoraEmissao'         => "'$dataHoraEmissao'",
    'ValorTotal'              => "'$this->valortotal'",
    'ValorDesconto'           => "'$this->valordesconto'",
    'ValorLiquido'            => "'$this->valorliquido'",
    'ValorCofins'             => "'$this->valorcofins'",
    'ValorPis'                => "'$this->valorpis'",
    'ValorIcms'               => "'$this->valoricms'",
    'ValorFrete'              => "'$this->valorfrete'",
    'QtdProdutos'             => "'$this->qtdprodutos'",
    'QtdParcelas'             => "'$this->qtdparcelas'",
    'NomeArquivo'             => "'$this->nomearquivo'",
    'NomeReferencia'          => "'$this->nomereferencia'",
    'Observacoes'             => "'$this->observacoes'",
    'DataHoraInclusao'        => "'$dataHoraInclusao'",
    'EnderecoIpAuditoria'     => "'$enderecoIpAuditoria'",
    'NomeAplicacaoAuditoria'  => "'$nomeAplicacaoAuditoria'",
);

$insert_sql = 'INSERT INTO ' . $insert_table
    . ' (' . implode(', ', array_keys($insert_fields)) . ')'
    . ' VALUES (' . implode(', ', array_values($insert_fields)) . ')';


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
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

 
      $nm_select = "SELECT LAST_INSERT_ID()"; 
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

if (!isset($this->rs[0][0]) || $this->rs[0][0] <= 0) {
    if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->RollbackTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

    $this->sc_temp_varMsgErroNota = "Identificador da Nota Fiscal não recuperado.";
    return false;
}

$idAlmoxarifadoEntrada = $this->rs[0][0];

if (!$this->incluirParcelas($idAlmoxarifadoEntrada, $idEmpresa)) {
    if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->RollbackTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

    $this->sc_temp_varMsgErroNota = $this->sc_temp_varMsgErroParcelas;
    return false;
}

if (!$this->incluirProdutos($idAlmoxarifadoEntrada, $idEmpresa)) {
    if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->RollbackTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

    $this->sc_temp_varMsgErroNota = $this->sc_temp_varMsgErroProdutos;
    return false;
}

$del_sql = "DELETE FROM _almoxarifadoproduto
            WHERE IdTenacidade = " . (int)$this->sc_temp_varIdTenacidade . "
              AND IdUnico = '" . $esc($this->sc_temp_varIdUnico) . "'";

     $nm_select = $del_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

return $idAlmoxarifadoEntrada;
if (isset($this->sc_temp_varMsgErroNota)) { $_SESSION['varMsgErroNota'] = $this->sc_temp_varMsgErroNota;}
if (isset($this->sc_temp_varMsgErroParcelas)) { $_SESSION['varMsgErroParcelas'] = $this->sc_temp_varMsgErroParcelas;}
if (isset($this->sc_temp_varMsgErroProdutos)) { $_SESSION['varMsgErroProdutos'] = $this->sc_temp_varMsgErroProdutos;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
if (isset($this->sc_temp_varIdUnico)) { $_SESSION['varIdUnico'] = $this->sc_temp_varIdUnico;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: incluirNotaEntrada ------*/


/*----- Scriptcase Locale: PHP Method: incluirParcelas ------*/

function incluirParcelas($parIdAlmoxarifadoEntrada, $parIdEmpresa)
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varMsgErroParcelas)) {$this->sc_temp_varMsgErroParcelas = (isset($_SESSION['varMsgErroParcelas'])) ? $_SESSION['varMsgErroParcelas'] : "";}
  
$this->sc_temp_varMsgErroParcelas = '';

if (trim($this->parcelas ) === '') {
	return true; 
}

$enderecoIpAuditoria    = $_SERVER['REMOTE_ADDR'];
$nomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;

$idPlanoConta = 'NULL';
$insert_table = 'almoxarifadoentradaparcela';

$vetParcelas = explode('<@>', $this->parcelas );

foreach ($vetParcelas as $vetDadosParcela) {

	if (trim($vetDadosParcela) === '') {
		continue;
	}

	$dadosParcela = explode('</>', $vetDadosParcela);

	if (count($dadosParcela) < 3) {
		$this->sc_temp_varMsgErroParcelas = "Formato inválido em Parcelas.";
		return false;
	}

	$parcela         = $dadosParcela[0];
	$dataVenciamento = $dadosParcela[1];
	$valor           = $dadosParcela[2];

	$insert_fields = array(
		'IdTenacidade'           => "'$this->sc_temp_varIdTenacidade'",
		'IdAlmoxarifadoEntrada'  => "'$parIdAlmoxarifadoEntrada'",
		'IdPlanoConta'           => "$idPlanoConta",
		'IdEmpresa'              => ($parIdEmpresa === NULL ? "NULL" : "'$parIdEmpresa'"),
		'IdUsuarioAuditoria'     => "'$this->sc_temp_varIdUsuario'",
		'Parcela'                => "'$parcela'",
		'dataVencimento'         => "'$dataVenciamento'",
		'Valor'                  => "'$valor'",
		'EnderecoIpAuditoria'    => "'$enderecoIpAuditoria'",
		'NomeAplicacaoAuditoria' => "'$nomeAplicacaoAuditoria'",
	);

	$insert_sql = 'INSERT INTO ' . $insert_table
		. ' (' . implode(', ', array_keys($insert_fields)) . ')'
		. ' VALUES (' . implode(', ', array_values($insert_fields)) . ')';

	
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
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
}

return true;
if (isset($this->sc_temp_varMsgErroParcelas)) { $_SESSION['varMsgErroParcelas'] = $this->sc_temp_varMsgErroParcelas;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: incluirParcelas ------*/


/*----- Scriptcase Locale: PHP Method: incluirProdutos ------*/

function incluirProdutos($parIdAlmoxarifadoEntrada, $parIdEmpresa)
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdUnico)) {$this->sc_temp_varIdUnico = (isset($_SESSION['varIdUnico'])) ? $_SESSION['varIdUnico'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varMsgErroProdutos)) {$this->sc_temp_varMsgErroProdutos = (isset($_SESSION['varMsgErroProdutos'])) ? $_SESSION['varMsgErroProdutos'] : "";}
  
$this->sc_temp_varMsgErroProdutos = '';

$esc = function($s) {
	return str_replace("'", "''", (string)$s);
};

$num = function($v) {
	if (is_null($v)) return null;
	$v = trim((string)$v);
	if ($v === '') return null;
	$v = str_replace('.', '', $v);      
	$v = str_replace(',', '.', $v);     
	return $v;
};

$enderecoIpAuditoria    = $_SERVER['REMOTE_ADDR'];
$nomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;

$temperaturaRecebimento = 'NULL';
$temperaturaTransporte  = 'NULL';
$temperaturaPadrao      = 'NULL';

$check_sql =
	"SELECT
		IdAlmoxarifadoProdutoGrupo,
		IdAlmoxarifadoProdutoClassificacao,
		IdAlmoxarifadoProdutoVolume,
		IdFornecedor,
		IdAlmoxarifadoProdutoLocalArmazenamento,
		IdAlmoxarifadoProdutoReferencia,
		Sigla,
		Codigo,
		Descricao,
		CodigoExterno,
		CodigoBarras,
		EstoqueMinimo,
		EstoqueMaximo,
		ValorPontoPedido,
		TipoPontoPedido,
		Quantidade,
		ValorUnitario,
		Ativo,
		EnderecoIpAuditoria,
		NomeAplicacaoAuditoria
	 FROM _almoxarifadoproduto
	 WHERE IdTenacidade = " . (int)$this->sc_temp_varIdTenacidade . "
	   AND IdUnico = '" . $esc($this->sc_temp_varIdUnico) . "'";

 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rsp = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsp = false;
          $this->rsp_erro = $this->Db->ErrorMsg();
      } 


if (false == $this->rsp ) {
	$this->sc_temp_varMsgErroProdutos = 'Erro ao buscar produtos na tabela temporária (_almoxarifadoproduto).';
	return false;
}

if ($this->rsp->EOF) {
	$this->rsp->Close();
	$this->sc_temp_varMsgErroProdutos = 'Nenhum produto encontrado na tabela temporária para inclusão.';
	return false;
}

$obrigatorios = [
	0  => 'Grupo',                      
	1  => 'Classificação',              
	2  => 'Volume',                     
	4  => 'Local de armazenamento',     
	6  => 'Sigla',                      
	7  => 'Código',                     
	8  => 'Descrição',                  
	11 => 'Estoque mínimo',             
	12 => 'Estoque máximo',             
	13 => 'Valor ponto de pedido',      
	14 => 'Tipo ponto de pedido',       
	15 => 'Quantidade',                 
	16 => 'Valor unitário',             

];

$erros = [];

while (!$this->rsp->EOF) {

	$idGrupo   = $this->rsp->fields[0];
	$idClass   = $this->rsp->fields[1];
	$idVolume  = $this->rsp->fields[2];
	$idFornec  = $this->rsp->fields[3];
	$idLocal   = $this->rsp->fields[4];
	$idRef     = $this->rsp->fields[5];

	$sigla     = $this->rsp->fields[6];
	$codigo    = $this->rsp->fields[7];
	$desc      = $this->rsp->fields[8];
	$codExt    = $this->rsp->fields[9];
	$codBarras = $this->rsp->fields[10];

	$estMin    = $this->rsp->fields[11];
	$estMax    = $this->rsp->fields[12];
	$vlPonto   = $this->rsp->fields[13];
	$tpPonto   = $this->rsp->fields[14];

	$quantidade    = $num($this->rsp->fields[15]);
	$valorUnitario = $num($this->rsp->fields[16]);

	$ativo     = $this->rsp->fields[17];
	$ipAud     = $this->rsp->fields[18];
	$appAud    = $this->rsp->fields[19];	
	
	$varIdProdutoSubstituto = $this->rsp->fields[20];

	$faltando = [];

	foreach ($obrigatorios as $idx => $nomeCampo) {
		$v = $this->rsp->fields[$idx];

		if (is_null($v)) {
			$faltando[] = $nomeCampo;
			continue;
		}

		if (is_string($v) && trim($v) === '') {
			$faltando[] = $nomeCampo;
			continue;
		}
	}

	if ($quantidade === null || (float)$quantidade <= 0) {
		if (!in_array('Quantidade', $faltando)) $faltando[] = 'Quantidade';
	}
	if ($valorUnitario === null || (float)$valorUnitario <= 0) {
		if (!in_array('Valor unitário', $faltando)) $faltando[] = 'Valor unitário';
	}

	if (!empty($faltando)) {
		$erros[] = "Produto <b>" . $codigo . "</b> (" . $desc . ") - faltando: " . implode(', ', $faltando) . ".";
		$this->rsp->MoveNext();
		continue;
	}

	$idProdutoDef = (int)$idRef;

	if ($idProdutoDef <= 0) {

		$insert_sql =
			"INSERT INTO almoxarifadoproduto
			 (IdTenacidade,
			  IdAlmoxarifadoProdutoGrupo,
			  IdAlmoxarifadoProdutoClassificacao,
			  IdAlmoxarifadoProdutoVolume,
			  IdFornecedor,
			  IdAlmoxarifadoProdutoLocalArmazenamento,
			  Sigla,
			  Codigo,
			  Descricao,
			  CodigoExterno,
			  CodigoBarras,
			  EstoqueMinimo,
			  EstoqueMaximo,
			  ValorPontoPedido,
			  TipoPontoPedido,
			  Ativo,
			  IdUsuarioAuditoria,
			  EnderecoIpAuditoria,
			  NomeAplicacaoAuditoria)
			 VALUES
			 (" . (int)$this->sc_temp_varIdTenacidade . ",
			  " . (int)$idGrupo . ",
			  " . (int)$idClass . ",
			  " . (int)$idVolume . ",
			  " . (int)$idFornec . ",
			  " . (int)$idLocal . ",
			  '" . $esc($sigla) . "',
			  '" . $esc($codigo) . "',
			  '" . $esc($desc) . "',
			  " . (empty($codExt) ? "NULL" : "'" . $esc($codExt) . "'") . ",
			  " . (empty($codBarras) ? "NULL" : "'" . $esc($codBarras) . "'") . ",
			  " . (is_null($estMin) ? "NULL" : "'" . $esc($estMin) . "'") . ",
			  " . (is_null($estMax) ? "NULL" : "'" . $esc($estMax) . "'") . ",
			  " . (is_null($vlPonto) ? "NULL" : "'" . $esc($vlPonto) . "'") . ",
			  '" . $esc($tpPonto) . "',
			  '" . $esc($ativo) . "',
			  " . (int)$this->sc_temp_varIdUsuario . ",
			  '" . $esc($enderecoIpAuditoria) . "',
			  '" . $esc($nomeAplicacaoAuditoria) . "')";

		
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
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

		 
      $nm_select = "SELECT LAST_INSERT_ID()"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsId = array();
      $this->rsid = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsId[$SCy] [$SCx] = $SCrx->fields[$SCx];
                      $this->rsid[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsId = false;
          $this->rsId_erro = $this->Db->ErrorMsg();
          $this->rsid = false;
          $this->rsid_erro = $this->Db->ErrorMsg();
      } 

		if (!isset($this->rsid[0][0]) || $this->rsid[0][0] <= 0) {
			$erros[] = "Produto <b>" . $codigo . "</b> (" . $desc . ") - falha ao recuperar ID do produto criado.";
			$this->rsp->MoveNext();
			continue;
		}

		$idProdutoDef = (int)$this->rsid[0][0];
	}

	$lote          = NULL;
	$dataValidade  = NULL;
	$dataFabricacao= NULL;

	$tipoValidade = (empty($dataValidade) ? 'I' : 'S');

	$valorTotal = (float)$quantidade * (float)$valorUnitario;

	$idEmpresaSql = (is_null($parIdEmpresa) || $parIdEmpresa === '' ? "NULL" : "'" . (int)$parIdEmpresa . "'");

	$insert_table  = 'almoxarifadoentradaproduto';
	$insert_fields = array(
		'IdTenacidade'                 				=> "'$this->sc_temp_varIdTenacidade'",
		'IdAlmoxarifadoEntrada'         			=> "'$parIdAlmoxarifadoEntrada'",
		'IdAlmoxarifadoProduto'        				=> "'$idProdutoDef'",
		'IdAlmoxarifadoProdutoVolume'  				=> "'$idVolume'",
		'IdAlmoxarifadoProdutoLocalArmazenamento' 	=> "$idLocal",
		'IdEmpresa'                     			=> $idEmpresaSql,
		'IdUsuarioAuditoria'            			=> "'$this->sc_temp_varIdUsuario'",
		'Codigo'                        			=> "'" . $esc($codigo) . "'",
		'Nome'                         				=> "'" . $esc($desc) . "'",
		'Volume'                       				=> "$idVolume",
		'Quantidade'                    			=> "'" . $esc($quantidade) . "'",
		'ValorUnitario'                 			=> "'" . $esc($valorUnitario) . "'",
		'ValorTotal'                    			=> "'" . $esc($valorTotal) . "'",
		'TipoValidade'                 				=> "'" . $esc($tipoValidade) . "'",
		'DataValidade'                  			=> (empty($dataValidade) ? "NULL" : "'" . $esc($dataValidade) . "'"),
		'DataFabricacao'                			=> (empty($dataFabricacao) ? "NULL" : "'" . $esc($dataFabricacao) . "'"),
		'Lote'                          			=> (empty($lote) ? "NULL" : "'" . $esc($lote) . "'"),
		'EstoqueMinimo'                				=> (is_null($estMin) ? "NULL" : "'" . $esc($estMin) . "'"),
		'EstoqueMaximo'               				=> (is_null($estMax) ? "NULL" : "'" . $esc($estMax) . "'"),
		'ValorPontoPedido'             				=> (is_null($vlPonto) ? "NULL" : "'" . $esc($vlPonto) . "'"),
		'TipoPontoPedido'              				=> "'" . $esc($tpPonto) . "'",
		'TemperaturaRecebimento'        			=> "$temperaturaRecebimento",
		'TemperaturaTransporte'         			=> "$temperaturaTransporte",
		'TemperaturaPadrao'             			=> "$temperaturaPadrao",
		'CodigoBarras'                  			=> (empty($codBarras) ? "NULL" : "'" . $esc($codBarras) . "'"),
		'EnderecoIpAuditoria'           			=> "'" . $esc($enderecoIpAuditoria) . "'",
		'NomeAplicacaoAuditoria'        			=> "'" . $esc($nomeAplicacaoAuditoria) . "'",
			  
	);

	$insert_sql = 'INSERT INTO ' . $insert_table
		. ' (' . implode(', ', array_keys($insert_fields)) . ')'
		. ' VALUES (' . implode(', ', array_values($insert_fields)) . ')';

	
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
                AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

	$this->rsp->MoveNext();
}

$this->rsp->Close();

if (!empty($erros)) {
	$this->sc_temp_varMsgErroProdutos = implode('<br>', $erros);
	return false;
}

return true;
if (isset($this->sc_temp_varMsgErroProdutos)) { $_SESSION['varMsgErroProdutos'] = $this->sc_temp_varMsgErroProdutos;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUnico)) { $_SESSION['varIdUnico'] = $this->sc_temp_varIdUnico;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: incluirProdutos ------*/


/*----- Scriptcase Locale: PHP Method: obterFornecedor ------*/

function obterFornecedor($parCnpj)
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  
$enderecoIpAuditoria = $_SERVER['REMOTE_ADDR'];
$nomeAplicacaoAuditoria = $this->Ini->nm_cod_apl;

$idFornecedor = NULL;
$check_sql = "SELECT IdFornecedor, RazaoSocial, NomeFantasia, Cnpj, Cep, "
 	             . " TipoLogradouro, Logradouro, Numero, Complemento, Bairro, Cidade, Estado, Telefone"
   		   . " FROM fornecedor"
   		   . " WHERE IdTenacidade = '$this->sc_temp_varIdTenacidade' AND Cnpj = '$parCnpj'";
 
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
    $idFornecedor 		= $this->rs[0][0];
    $this->razaosocial  		= $this->rs[0][1];
    $this->nomefantasia  		= $this->rs[0][2];
	$this->cnpj  				= $this->rs[0][3];
    $this->cep  				= $this->rs[0][4];
    $tipologradouro  	= $this->rs[0][5];
    $this->logradouro  		= $this->rs[0][6];
    $this->numero  			= $this->rs[0][7];
    $this->complemento  		= $this->rs[0][8];
    $this->bairro  			= $this->rs[0][9];
    $this->cidade  			= $this->rs[0][10];
    $this->estado  			= $this->rs[0][11];
    $this->telefone  			= $this->rs[0][12];
}

return $idFornecedor;
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: obterFornecedor ------*/


/*----- Scriptcase Locale: PHP Method: validarProdutos ------*/

function validarProdutos()
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUnico)) {$this->sc_temp_varIdUnico = (isset($_SESSION['varIdUnico'])) ? $_SESSION['varIdUnico'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varMsgErroProdutos)) {$this->sc_temp_varMsgErroProdutos = (isset($_SESSION['varMsgErroProdutos'])) ? $_SESSION['varMsgErroProdutos'] : "";}
  
$this->sc_temp_varMsgErroProdutos = '';

$check_sql =
	"SELECT
		IdAlmoxarifadoProdutoClassificacao,
		IdAlmoxarifadoProdutoGrupo,
		IdAlmoxarifadoProdutoVolume,
		IdFornecedor,
		IdAlmoxarifadoProdutoLocalArmazenamento,
		IdAlmoxarifadoProdutoReferencia,
		Sigla,
		Codigo,
		Descricao,
		CodigoExterno,
		CodigoBarras,
		EstoqueMinimo,
		EstoqueMaximo,
		ValorPontoPedido,
		TipoPontoPedido,
		Ativo,
		EnderecoIpAuditoria,
		NomeAplicacaoAuditoria
	 FROM _almoxarifadoproduto
	 WHERE IdTenacidade = " . (int)$this->sc_temp_varIdTenacidade . "
	   AND IdUnico = '" . $this->sc_temp_varIdUnico . "'";

 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 


if (false == $this->rs) {
	$this->sc_temp_varMsgErroProdutos = 'Erro de acesso à tabela temporária de produtos.';
	return false;
}

if ($this->rs->EOF) {
	$this->sc_temp_varMsgErroProdutos = 'Produto(s) não encontrado(s).';
	$this->rs->Close();
	return false;
}

$camposObrig = [
	0  => 'Classificação',
	1  => 'Grupo',
	2  => 'Volume',
	4  => 'Local de armazenamento',
	6  => 'Sigla',
	7  => 'Código',
	8  => 'Descrição',
	11 => 'Estoque mínimo',
	12 => 'Estoque máximo',
	13 => 'Valor ponto de pedido',
	14 => 'Tipo ponto de pedido',
];

$erros = [];

while (!$this->rs->EOF) {

	$codigo    = $this->rs->fields[7];
	$descricao = $this->rs->fields[8];

	$faltando = [];

	foreach ($camposObrig as $idx => $nome) {
		$v = $this->rs->fields[$idx];

		if (is_null($v)) {
			$faltando[] = $nome;
			continue;
		}

		if (is_string($v) && trim($v) === '') {
			$faltando[] = $nome;
			continue;
		}
	}

	if (!empty($faltando)) {
		$erros[] = "O produto <b>" . $codigo . "</b> (" . $descricao . ") possui campos obrigatórios a preencher: "
				 . implode(', ', $faltando) . ".";
	}

	$this->rs->MoveNext();
}

$this->rs->Close();

if (!empty($erros)) {
	$this->sc_temp_varMsgErroProdutos = implode('<br>', $erros); 
	return false;
}

return true;
if (isset($this->sc_temp_varMsgErroProdutos)) { $_SESSION['varMsgErroProdutos'] = $this->sc_temp_varMsgErroProdutos;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUnico)) { $_SESSION['varIdUnico'] = $this->sc_temp_varIdUnico;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: validarProdutos ------*/


/*----- Scriptcase Locale: PHP Method: verificarCamposFornecedor ------*/

function verificarCamposFornecedor()
{
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
  


$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: PHP Method: verificarCamposFornecedor ------*/

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
     $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
     $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['sub_dir'][0]  = "/" . $_SESSION['varIdTenacidade'];
//-- 
   if ($this->nomereferencia != "" && $this->nomereferencia != "none")   
   { 
       $sTmpExtension = pathinfo($this->nomereferencia, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_nomereferencia = 'sc_nomereferencia_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['download_filenames'][$sTmpFile_nomereferencia] = $this->nomereferencia;
   } 
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_saida_global = $_SESSION['scriptcase']['nm_sc_retorno']; 
      } 
    if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
    
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varImportar)) {$this->sc_temp_varImportar = (isset($_SESSION['varImportar'])) ? $_SESSION['varImportar'] : "";}
  if (!empty($this->nomereferencia )) {
	if (empty($this->idfornecedor )) {
		$this->msgfornecedor  = '<font color="#FF0000"> Fornecedor NÃO cadastrado. </font>';
	} else {
		$this->sc_field_readonly("idfornecedor", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Field_disabled_macro']['idfornecedor'] = array('I'=>array(),'U'=>array());
;
		$this->msgfornecedor  = '<font color="#00CC00"> Fornecedor cadastrado (' . $this->idfornecedor  . ')</font>';
	}
	if ($this->sc_temp_varImportar != 'S') {
		$this->decodificarXML();
		$this->verificarCamposFornecedor();
		$this->sc_set_focus('IdAlmoxarifadoNota');
	}
}
if (isset($this->sc_temp_varImportar)) { $_SESSION['varImportar'] = $this->sc_temp_varImportar;}
$_SESSION['scriptcase']['AlmoxarifadoImportacaoXml_Ctr']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onLoad ------*/
 
    }
    if (!empty($this->Campos_Mens_erro)) 
    {
        $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
    }
    $this->nm_guardar_campos();
    $this->nm_formatar_campos();
        $this->initFormPages();
    include_once("AlmoxarifadoImportacaoXml_Ctr_form0.php");
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['csrf_token'];
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

   function Form_lookup_idalmoxarifadonota()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'] = array(); 
    }

   $old_value_dataemissaonota = $this->dataemissaonota;
   $old_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_valorliquido = $this->valorliquido;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_dataemissaonota = $this->dataemissaonota;
   $unformatted_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_valorliquido = $this->valorliquido;

   $nm_comando = "SELECT IdAlmoxarifado, CONCAT(Sigla, ' - ', Descricao)  FROM almoxarifado WHERE IdTenacidade = " . $_SESSION['varIdTenacidade'] . " AND PermiteEntrada = 'S'";

   $this->dataemissaonota = $old_value_dataemissaonota;
   $this->dataemissaonota_hora = $old_value_dataemissaonota_hora;
   $this->qtdprodutos = $old_value_qtdprodutos;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valordesconto = $old_value_valordesconto;
   $this->valorliquido = $old_value_valorliquido;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idalmoxarifadonota'][] = $rs->fields[0];
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
   function Form_lookup_idfornecedor()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'] = array(); 
    }

   $old_value_dataemissaonota = $this->dataemissaonota;
   $old_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $old_value_qtdprodutos = $this->qtdprodutos;
   $old_value_qtdparcelas = $this->qtdparcelas;
   $old_value_valorcofins = $this->valorcofins;
   $old_value_valorpis = $this->valorpis;
   $old_value_valoricms = $this->valoricms;
   $old_value_valorfrete = $this->valorfrete;
   $old_value_valortotal = $this->valortotal;
   $old_value_valordesconto = $this->valordesconto;
   $old_value_valorliquido = $this->valorliquido;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_dataemissaonota = $this->dataemissaonota;
   $unformatted_value_dataemissaonota_hora = $this->dataemissaonota_hora;
   $unformatted_value_qtdprodutos = $this->qtdprodutos;
   $unformatted_value_qtdparcelas = $this->qtdparcelas;
   $unformatted_value_valorcofins = $this->valorcofins;
   $unformatted_value_valorpis = $this->valorpis;
   $unformatted_value_valoricms = $this->valoricms;
   $unformatted_value_valorfrete = $this->valorfrete;
   $unformatted_value_valortotal = $this->valortotal;
   $unformatted_value_valordesconto = $this->valordesconto;
   $unformatted_value_valorliquido = $this->valorliquido;

   $nm_comando = "SELECT IdFornecedor, NomeFantasia  FROM fornecedor  WHERE IdTenacidade = " . $_SESSION['varIdTenacidade'] . " ORDER BY NomeFantasia";

   $this->dataemissaonota = $old_value_dataemissaonota;
   $this->dataemissaonota_hora = $old_value_dataemissaonota_hora;
   $this->qtdprodutos = $old_value_qtdprodutos;
   $this->qtdparcelas = $old_value_qtdparcelas;
   $this->valorcofins = $old_value_valorcofins;
   $this->valorpis = $old_value_valorpis;
   $this->valoricms = $old_value_valoricms;
   $this->valorfrete = $old_value_valorfrete;
   $this->valortotal = $old_value_valortotal;
   $this->valordesconto = $old_value_valordesconto;
   $this->valorliquido = $old_value_valorliquido;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['Lookup_idfornecedor'][] = $rs->fields[0];
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
       $nmgp_saida_form = "AlmoxarifadoImportacaoXml_Ctr_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['nm_run_menu'] = 2;
       $nmgp_saida_form = "AlmoxarifadoImportacaoXml_Ctr_fim.php";
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
       AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
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
       AlmoxarifadoImportacaoXml_Ctr_pack_ajax_response();
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
                        'idalmoxarifadonota' => 'idalmoxarifadonota',
                        'codigonota' => 'codigonota',
                        'numeronota' => 'numeronota',
                        'serienota' => 'serienota',
                        'dataemissaonota' => 'dataemissaonota',
                        'qtdprodutos' => 'qtdprodutos',
                        'qtdparcelas' => 'qtdparcelas',
                        'nomereferencia' => 'nomereferencia',
                        'nomearquivo' => 'nomearquivo',
                        'numerofaturanota' => 'numerofaturanota',
                        'chavenota' => 'chavenota',
                        'versaonota' => 'versaonota',
                        'naturezanota' => 'naturezanota',
                        'idfornecedor' => 'idfornecedor',
                        'msgfornecedor' => 'msgfornecedor',
                        'cnpjnota' => 'cnpjnota',
                        'razaosocialnota' => 'razaosocialnota',
                        'nomefantasianota' => 'nomefantasianota',
                        'logradouronota' => 'logradouronota',
                        'numerologradouronota' => 'numerologradouronota',
                        'complementonota' => 'complementonota',
                        'cidadenota' => 'cidadenota',
                        'bairronota' => 'bairronota',
                        'estadonota' => 'estadonota',
                        'cepnota' => 'cepnota',
                        'telefonenota' => 'telefonenota',
                        'cnpj' => 'cnpj',
                        'razaosocial' => 'razaosocial',
                        'nomefantasia' => 'nomefantasia',
                        'logradouro' => 'logradouro',
                        'numero' => 'numero',
                        'complemento' => 'complemento',
                        'bairro' => 'bairro',
                        'cidade' => 'cidade',
                        'estado' => 'estado',
                        'cep' => 'cep',
                        'telefone' => 'telefone',
                        'detprodutos' => 'detprodutos',
                        'valorcofins' => 'valorcofins',
                        'valorpis' => 'valorpis',
                        'valoricms' => 'valoricms',
                        'valorfrete' => 'valorfrete',
                        'valortotal' => 'valortotal',
                        'valordesconto' => 'valordesconto',
                        'valorliquido' => 'valorliquido',
                        'parcelas' => 'parcelas',
                        'descricaoparcelas' => 'descricaoparcelas',
                        'observacoes' => 'observacoes',
                       );
        if (isset($aFocus[$sFieldName]))
        {
            $this->NM_ajax_info['focus'] = $aFocus[$sFieldName];
        }
    } // sc_set_focus
    function sc_field_readonly($sField, $sStatus, $iSeq = '')
    {
        if ('on' != $sStatus && 'off' != $sStatus)
        {
            return;
        }

        $sFieldDateTime = '';
        if ('dataemissaonota' == $sField)
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
    function sc_btn_label($buttonName, $buttonLabel)
    {
        $buttonName = strtolower($buttonName);
        $buttonList = $this->getButtonIds($buttonName);
        foreach ($buttonList as $buttonId) {
            $this->NM_ajax_info['btnLabel'][$buttonId] = $buttonLabel;
        }
        $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['btn_label'][$buttonName] = $buttonLabel;
    } // sc_btn_label

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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "Importação Nota Fiscal XML"; } else { echo "Importação Nota Fiscal XML"; } ?></span></td>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['link_info']['compact_mode']) {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['AlmoxarifadoImportacaoXml_Ctr']['ordem_ord'] == " desc") {
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
            case "":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "":
                return true;
            case "":
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
