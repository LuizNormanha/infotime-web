<?php
//
class ColaboradorTarefa_Frm_apl
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
   var $idcolaboradortarefa;
   var $idtenacidade;
   var $idcolaborador;
   var $idcolaborador_1;
   var $idcontrato;
   var $idcontrato_1;
   var $idusuarioauditoria;
   var $descricao;
   var $datainicio;
   var $datainicio_hora;
   var $dataprevisao;
   var $dataprevisao_hora;
   var $dataprevisaoinicial;
   var $dataprevisaoinicial_hora;
   var $dataconclusao;
   var $dataconclusao_hora;
   var $prioridade;
   var $prioridade_1;
   var $situacao;
   var $situacao_1;
   var $qtdalteracaodata;
   var $observacoes;
   var $enderecoipauditoria;
   var $nomeaplicacaoauditoria;
   var $motivoprorrogacao;
   var $motivoprorrogacao_1;
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
          if (isset($this->NM_ajax_info['param']['dataconclusao']))
          {
              $this->dataconclusao = $this->NM_ajax_info['param']['dataconclusao'];
          }
          if (isset($this->NM_ajax_info['param']['datainicio']))
          {
              $this->datainicio = $this->NM_ajax_info['param']['datainicio'];
          }
          if (isset($this->NM_ajax_info['param']['dataprevisao']))
          {
              $this->dataprevisao = $this->NM_ajax_info['param']['dataprevisao'];
          }
          if (isset($this->NM_ajax_info['param']['descricao']))
          {
              $this->descricao = $this->NM_ajax_info['param']['descricao'];
          }
          if (isset($this->NM_ajax_info['param']['idcolaborador']))
          {
              $this->idcolaborador = $this->NM_ajax_info['param']['idcolaborador'];
          }
          if (isset($this->NM_ajax_info['param']['idcolaboradortarefa']))
          {
              $this->idcolaboradortarefa = $this->NM_ajax_info['param']['idcolaboradortarefa'];
          }
          if (isset($this->NM_ajax_info['param']['idcontrato']))
          {
              $this->idcontrato = $this->NM_ajax_info['param']['idcontrato'];
          }
          if (isset($this->NM_ajax_info['param']['motivoprorrogacao']))
          {
              $this->motivoprorrogacao = $this->NM_ajax_info['param']['motivoprorrogacao'];
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
          if (isset($this->NM_ajax_info['param']['observacoes']))
          {
              $this->observacoes = $this->NM_ajax_info['param']['observacoes'];
          }
          if (isset($this->NM_ajax_info['param']['prioridade']))
          {
              $this->prioridade = $this->NM_ajax_info['param']['prioridade'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['situacao']))
          {
              $this->situacao = $this->NM_ajax_info['param']['situacao'];
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
      if (isset($this->varIdColaboradorSel) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdColaboradorSel'] = $this->varIdColaboradorSel;
      }
      if (isset($this->varPrimeiraVez) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varIdContratoSel) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdContratoSel'] = $this->varIdContratoSel;
      }
      if (isset($this->varIdUsuarioColaborador) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
      }
      if (isset($_POST["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
      }
      if (isset($_POST["varIdColaboradorSel"]) && isset($this->varIdColaboradorSel)) 
      {
          $_SESSION['varIdColaboradorSel'] = $this->varIdColaboradorSel;
      }
      if (!isset($_POST["varIdColaboradorSel"]) && isset($_POST["varidcolaboradorsel"])) 
      {
          $_SESSION['varIdColaboradorSel'] = $_POST["varidcolaboradorsel"];
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
      if (isset($_POST["varIdContratoSel"]) && isset($this->varIdContratoSel)) 
      {
          $_SESSION['varIdContratoSel'] = $this->varIdContratoSel;
      }
      if (!isset($_POST["varIdContratoSel"]) && isset($_POST["varidcontratosel"])) 
      {
          $_SESSION['varIdContratoSel'] = $_POST["varidcontratosel"];
      }
      if (isset($_POST["varIdUsuarioColaborador"]) && isset($this->varIdUsuarioColaborador)) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
      }
      if (!isset($_POST["varIdUsuarioColaborador"]) && isset($_POST["varidusuariocolaborador"])) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $_POST["varidusuariocolaborador"];
      }
      if (isset($_GET["varIdTenacidade"]) && isset($this->varIdTenacidade)) 
      {
          $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
      }
      if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
      {
          $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
      }
      if (isset($_GET["varIdColaboradorSel"]) && isset($this->varIdColaboradorSel)) 
      {
          $_SESSION['varIdColaboradorSel'] = $this->varIdColaboradorSel;
      }
      if (!isset($_GET["varIdColaboradorSel"]) && isset($_GET["varidcolaboradorsel"])) 
      {
          $_SESSION['varIdColaboradorSel'] = $_GET["varidcolaboradorsel"];
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
      if (isset($_GET["varIdContratoSel"]) && isset($this->varIdContratoSel)) 
      {
          $_SESSION['varIdContratoSel'] = $this->varIdContratoSel;
      }
      if (!isset($_GET["varIdContratoSel"]) && isset($_GET["varidcontratosel"])) 
      {
          $_SESSION['varIdContratoSel'] = $_GET["varidcontratosel"];
      }
      if (isset($_GET["varIdUsuarioColaborador"]) && isset($this->varIdUsuarioColaborador)) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
      }
      if (!isset($_GET["varIdUsuarioColaborador"]) && isset($_GET["varidusuariocolaborador"])) 
      {
          $_SESSION['varIdUsuarioColaborador'] = $_GET["varidusuariocolaborador"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['embutida_parms']);
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
                 nm_limpa_str_ColaboradorTarefa_Frm($cadapar[1]);
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
          if (!isset($this->varIdColaboradorSel) && isset($this->varidcolaboradorsel)) 
          {
              $this->varIdColaboradorSel = $this->varidcolaboradorsel;
          }
          if (isset($this->varIdColaboradorSel)) 
          {
              $_SESSION['varIdColaboradorSel'] = $this->varIdColaboradorSel;
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
          if (!isset($this->varIdContratoSel) && isset($this->varidcontratosel)) 
          {
              $this->varIdContratoSel = $this->varidcontratosel;
          }
          if (isset($this->varIdContratoSel)) 
          {
              $_SESSION['varIdContratoSel'] = $this->varIdContratoSel;
          }
          if (!isset($this->varIdUsuarioColaborador) && isset($this->varidusuariocolaborador)) 
          {
              $this->varIdUsuarioColaborador = $this->varidusuariocolaborador;
          }
          if (isset($this->varIdUsuarioColaborador)) 
          {
              $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['opc_ant']);
          }
          if (!isset($this->varIdTenacidade) && isset($this->varidtenacidade)) 
          {
              $this->varIdTenacidade = $this->varidtenacidade;
          }
          if (isset($this->varIdTenacidade)) 
          {
              $_SESSION['varIdTenacidade'] = $this->varIdTenacidade;
          }
          if (!isset($this->varIdColaboradorSel) && isset($this->varidcolaboradorsel)) 
          {
              $this->varIdColaboradorSel = $this->varidcolaboradorsel;
          }
          if (isset($this->varIdColaboradorSel)) 
          {
              $_SESSION['varIdColaboradorSel'] = $this->varIdColaboradorSel;
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
          if (!isset($this->varIdContratoSel) && isset($this->varidcontratosel)) 
          {
              $this->varIdContratoSel = $this->varidcontratosel;
          }
          if (isset($this->varIdContratoSel)) 
          {
              $_SESSION['varIdContratoSel'] = $this->varIdContratoSel;
          }
          if (!isset($this->varIdUsuarioColaborador) && isset($this->varidusuariocolaborador)) 
          {
              $this->varIdUsuarioColaborador = $this->varidusuariocolaborador;
          }
          if (isset($this->varIdUsuarioColaborador)) 
          {
              $_SESSION['varIdUsuarioColaborador'] = $this->varIdUsuarioColaborador;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['nm_run_menu'] = 1;
      } 
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->datainicio);
          $this->datainicio      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->datainicio_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->dataprevisao);
          $this->dataprevisao      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->dataprevisao_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao) || (isset($this->nmgp_opcao) && $this->nmgp_opcao == "igual"))
      { }
      else
      {
          $aDtParts = explode(' ', $this->dataconclusao);
          $this->dataconclusao      = (isset($aDtParts[0])) ? $aDtParts[0] : "";
          $this->dataconclusao_hora = (isset($aDtParts[1])) ? $aDtParts[1] : "";
      }
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new ColaboradorTarefa_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
  $this->sc_temp_varPrimeiraVez = "";
$this->sc_temp_varIdTenacidade;
$this->sc_temp_varIdUsuario;
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['ColaboradorTarefa_Frm']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['ColaboradorTarefa_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['ColaboradorTarefa_Frm'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['ColaboradorTarefa_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['ColaboradorTarefa_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('ColaboradorTarefa_Frm') . "/ColaboradorTarefa_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['ColaboradorTarefa_Frm']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Tarefa";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "ColaboradorTarefa_Frm")
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


      $_SESSION['scriptcase']['error_icon']['ColaboradorTarefa_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['ColaboradorTarefa_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "ColaboradorTarefa_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
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
      $this->nmgp_botoes['Auditoria'] = "on";
      $this->nmgp_botoes['sc_btn_0'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['ColaboradorTarefa_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['ColaboradorTarefa_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['ColaboradorTarefa_Frm'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form'];
          if (!isset($this->idtenacidade)){$this->idtenacidade = $this->nmgp_dados_form['idtenacidade'];} 
          if (!isset($this->idusuarioauditoria)){$this->idusuarioauditoria = $this->nmgp_dados_form['idusuarioauditoria'];} 
          if (!isset($this->dataprevisaoinicial)){$this->dataprevisaoinicial = $this->nmgp_dados_form['dataprevisaoinicial'];} 
          if (!isset($this->qtdalteracaodata)){$this->qtdalteracaodata = $this->nmgp_dados_form['qtdalteracaodata'];} 
          if (!isset($this->enderecoipauditoria)){$this->enderecoipauditoria = $this->nmgp_dados_form['enderecoipauditoria'];} 
          if (!isset($this->nomeaplicacaoauditoria)){$this->nomeaplicacaoauditoria = $this->nmgp_dados_form['nomeaplicacaoauditoria'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("ColaboradorTarefa_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'ColaboradorTarefa_Frm/ColaboradorTarefa_Frm_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'ColaboradorTarefa_Frm_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'ColaboradorTarefa_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'ColaboradorTarefa_Frm_help.txt');
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
          require_once($this->Ini->path_embutida . 'ColaboradorTarefa_Frm/ColaboradorTarefa_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "ColaboradorTarefa_Frm_erro.class.php"); 
      }
      $this->Erro      = new ColaboradorTarefa_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao']))
         { 
             if ($this->idcolaboradortarefa != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['ColaboradorTarefa_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['Auditoria'] = "off";
          $this->nmgp_botoes['sc_btn_0'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['Auditoria'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['botoes']['Auditoria'];
          $this->nmgp_botoes['sc_btn_0'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['botoes']['sc_btn_0'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form'];
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
                 if (isset($_SESSION['scriptcase']['ColaboradorTarefa_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['ColaboradorTarefa_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['ColaboradorTarefa_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['ColaboradorTarefa_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->idcolaboradortarefa)) { $this->nm_limpa_alfa($this->idcolaboradortarefa); }
      if (isset($this->idcolaborador)) { $this->nm_limpa_alfa($this->idcolaborador); }
      if (isset($this->idcontrato)) { $this->nm_limpa_alfa($this->idcontrato); }
      if (isset($this->descricao)) { $this->nm_limpa_alfa($this->descricao); }
      if (isset($this->prioridade)) { $this->nm_limpa_alfa($this->prioridade); }
      if (isset($this->situacao)) { $this->nm_limpa_alfa($this->situacao); }
      if (isset($this->observacoes)) { $this->nm_limpa_alfa($this->observacoes); }
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "ColaboradorTarefa_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- idcolaboradortarefa
      $this->field_config['idcolaboradortarefa']               = array();
      $this->field_config['idcolaboradortarefa']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcolaboradortarefa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcolaboradortarefa']['symbol_dec'] = '';
      $this->field_config['idcolaboradortarefa']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcolaboradortarefa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- datainicio
      $this->field_config['datainicio']                 = array();
      $this->field_config['datainicio']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['datainicio']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['datainicio']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['datainicio']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'datainicio');
      //-- dataprevisao
      $this->field_config['dataprevisao']                 = array();
      $this->field_config['dataprevisao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dataprevisao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dataprevisao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dataprevisao']['date_display'] = "ddmmaaaa;hhii";
      $this->new_date_format('DH', 'dataprevisao');
      //-- dataconclusao
      $this->field_config['dataconclusao']                 = array();
      $this->field_config['dataconclusao']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dataconclusao']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dataconclusao']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dataconclusao']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DH', 'dataconclusao');
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
      //-- dataprevisaoinicial
      $this->field_config['dataprevisaoinicial']                 = array();
      $this->field_config['dataprevisaoinicial']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['dataprevisaoinicial']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['dataprevisaoinicial']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['dataprevisaoinicial']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'dataprevisaoinicial');
      //-- qtdalteracaodata
      $this->field_config['qtdalteracaodata']               = array();
      $this->field_config['qtdalteracaodata']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['qtdalteracaodata']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['qtdalteracaodata']['symbol_dec'] = '';
      $this->field_config['qtdalteracaodata']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['qtdalteracaodata']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
          if ('validate_idcontrato' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcontrato');
          }
          if ('validate_idcolaboradortarefa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcolaboradortarefa');
          }
          if ('validate_descricao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'descricao');
          }
          if ('validate_idcolaborador' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcolaborador');
          }
          if ('validate_datainicio' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'datainicio');
          }
          if ('validate_dataprevisao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dataprevisao');
          }
          if ('validate_motivoprorrogacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'motivoprorrogacao');
          }
          if ('validate_dataconclusao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'dataconclusao');
          }
          if ('validate_prioridade' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'prioridade');
          }
          if ('validate_situacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'situacao');
          }
          if ('validate_observacoes' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'observacoes');
          }
          ColaboradorTarefa_Frm_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_dataprevisao_onchange' == $this->NM_ajax_opcao)
          {
              $this->DataPrevisao_onChange();
          }
          ColaboradorTarefa_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              ColaboradorTarefa_Frm_pack_ajax_response();
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
          $_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  ColaboradorTarefa_Frm_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_redir_atualiz'] == "ok")
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
          ColaboradorTarefa_Frm_pack_ajax_response();
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
          ColaboradorTarefa_Frm_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "ColaboradorTarefa_Frm.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Tarefa") ?></TITLE>
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
<form name="Fdown" method="get" action="ColaboradorTarefa_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="ColaboradorTarefa_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="ColaboradorTarefa_Frm.php" target="_self" style="display: none"> 
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
include_once("ColaboradorTarefa_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->idcolaboradortarefa) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form']['idcolaboradortarefa']))
          {
              $varloc_btn_php['idcolaboradortarefa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form']['idcolaboradortarefa'];
          }
      }
      $nm_f_saida = "ColaboradorTarefa_Frm.php";
      nm_limpa_numero($this->idcolaboradortarefa, $this->field_config['idcolaboradortarefa']['symbol_grp']) ; 
      nm_limpa_data($this->datainicio, $this->field_config['datainicio']['date_sep']) ; 
      nm_limpa_hora($this->datainicio_hora, $this->field_config['datainicio']['time_sep']) ; 
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      nm_limpa_hora($this->dataprevisao_hora, $this->field_config['dataprevisao']['time_sep']) ; 
      nm_limpa_data($this->dataconclusao, $this->field_config['dataconclusao']['date_sep']) ; 
      nm_limpa_hora($this->dataconclusao_hora, $this->field_config['dataconclusao']['time_sep']) ; 
      $this->nm_converte_datas();
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      
/*----- Scriptcase Locale: Button Auditoria ------*/
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
  $posicao = strpos($this->Ini->nm_cod_apl, '_');
$nomeTabela =  strtolower(substr($this->Ini->nm_cod_apl, 0, $posicao));	
 if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('AuditoriaRegistro_Lst') . "/AuditoriaRegistro_Lst.php", $this->nm_location, "varIdTenacidade?#?" . NM_encode_input($this->sc_temp_varIdTenacidade) . "?@?" . "varNomeTabelaAuditoria?#?" . NM_encode_input($nomeTabela) . "?@?" . "varValorIdChavePrimariaAuditoria?#?" . NM_encode_input($this->idcolaboradortarefa ) . "?@?","_self", '', 440, 630);
 };
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button Auditoria ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idcolaboradortarefa" value="<?php echo $this->form_encode_input($this->idcolaboradortarefa) ?>"/>
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
include_once("ColaboradorTarefa_Frm_sajax_js.php");
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "ColaboradorTarefa_Frm.php";
      nm_limpa_numero($this->idcolaboradortarefa, $this->field_config['idcolaboradortarefa']['symbol_grp']) ; 
      nm_limpa_data($this->datainicio, $this->field_config['datainicio']['date_sep']) ; 
      nm_limpa_hora($this->datainicio_hora, $this->field_config['datainicio']['time_sep']) ; 
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      nm_limpa_hora($this->dataprevisao_hora, $this->field_config['dataprevisao']['time_sep']) ; 
      nm_limpa_data($this->dataconclusao, $this->field_config['dataconclusao']['date_sep']) ; 
      nm_limpa_hora($this->dataconclusao_hora, $this->field_config['dataconclusao']['time_sep']) ; 
      $this->nm_converte_datas();
      
/*----- Scriptcase Locale: Button sc_btn_0 ------*/
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
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
   $sErrorIndex = 'geral_ColaboradorTarefa_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_ColaboradorTarefa_Frm';
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
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Button sc_btn_0 ------*/
 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="idcolaboradortarefa" value="<?php echo $this->form_encode_input($this->idcolaboradortarefa) ?>"/>
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
           case 'idcontrato':
               return "Projeto";
               break;
           case 'idcolaboradortarefa':
               return "Id.";
               break;
           case 'descricao':
               return "Descrição";
               break;
           case 'idcolaborador':
               return "Responsável";
               break;
           case 'datainicio':
               return "Data de Início";
               break;
           case 'dataprevisao':
               return "Data da Previsão";
               break;
           case 'motivoprorrogacao':
               return "Motivo Alteração Data *";
               break;
           case 'dataconclusao':
               return "Data da Conclusão";
               break;
           case 'prioridade':
               return "Prioridade";
               break;
           case 'situacao':
               return "Situação";
               break;
           case 'observacoes':
               return "Texto";
               break;
           case 'idtenacidade':
               return "Id Tenacidade";
               break;
           case 'idusuarioauditoria':
               return "Id Usuario Auditoria";
               break;
           case 'dataprevisaoinicial':
               return "Data Previsao Inicial";
               break;
           case 'qtdalteracaodata':
               return "Qtd Alteracao Data";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_ColaboradorTarefa_Frm']) || !is_array($this->NM_ajax_info['errList']['geral_ColaboradorTarefa_Frm']))
              {
                  $this->NM_ajax_info['errList']['geral_ColaboradorTarefa_Frm'] = array();
              }
              $this->NM_ajax_info['errList']['geral_ColaboradorTarefa_Frm'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'idcontrato' == $filtro)) || (is_array($filtro) && in_array('idcontrato', $filtro)))
        $this->ValidateField_idcontrato($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcolaboradortarefa' == $filtro)) || (is_array($filtro) && in_array('idcolaboradortarefa', $filtro)))
        $this->ValidateField_idcolaboradortarefa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'descricao' == $filtro)) || (is_array($filtro) && in_array('descricao', $filtro)))
        $this->ValidateField_descricao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'idcolaborador' == $filtro)) || (is_array($filtro) && in_array('idcolaborador', $filtro)))
        $this->ValidateField_idcolaborador($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'datainicio' == $filtro)) || (is_array($filtro) && in_array('datainicio', $filtro)))
        $this->ValidateField_datainicio($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dataprevisao' == $filtro)) || (is_array($filtro) && in_array('dataprevisao', $filtro)))
        $this->ValidateField_dataprevisao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'motivoprorrogacao' == $filtro)) || (is_array($filtro) && in_array('motivoprorrogacao', $filtro)))
        $this->ValidateField_motivoprorrogacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'dataconclusao' == $filtro)) || (is_array($filtro) && in_array('dataconclusao', $filtro)))
        $this->ValidateField_dataconclusao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'prioridade' == $filtro)) || (is_array($filtro) && in_array('prioridade', $filtro)))
        $this->ValidateField_prioridade($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'situacao' == $filtro)) || (is_array($filtro) && in_array('situacao', $filtro)))
        $this->ValidateField_situacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'observacoes' == $filtro)) || (is_array($filtro) && in_array('observacoes', $filtro)))
        $this->ValidateField_observacoes($Campos_Crit, $Campos_Falta, $Campos_Erros);
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
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
  if (($this->situacao  != 'P') && (empty($this->dataconclusao ) || $this->dataconclusao  == "null")) {
	
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Data Conclusão: &nbsp&nbsp&nbsp&nbsp&nbspDado obrigatório';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_ColaboradorTarefa_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_ColaboradorTarefa_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Data Conclusão: &nbsp&nbsp&nbsp&nbsp&nbspDado obrigatório';
 }
;
	
}
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onValidateSuccess ------*/
 
          }
      }
   }

    function ValidateField_idcontrato(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idcontrato'])) {
       return;
   }
      if ($this->idcontrato == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['idcontrato']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['idcontrato'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Projeto" ; 
          if (!isset($Campos_Erros['idcontrato']))
          {
              $Campos_Erros['idcontrato'] = array();
          }
          $Campos_Erros['idcontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idcontrato']) || !is_array($this->NM_ajax_info['errList']['idcontrato']))
          {
              $this->NM_ajax_info['errList']['idcontrato'] = array();
          }
          $this->NM_ajax_info['errList']['idcontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idcontrato) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']) && !in_array($this->idcontrato, $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idcontrato']))
              {
                  $Campos_Erros['idcontrato'] = array();
              }
              $Campos_Erros['idcontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idcontrato']) || !is_array($this->NM_ajax_info['errList']['idcontrato']))
              {
                  $this->NM_ajax_info['errList']['idcontrato'] = array();
              }
              $this->NM_ajax_info['errList']['idcontrato'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
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

    function ValidateField_idcolaboradortarefa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idcolaboradortarefa'])) {
          nm_limpa_numero($this->idcolaboradortarefa, $this->field_config['idcolaboradortarefa']['symbol_grp']) ; 
          return;
      }
      if ($this->idcolaboradortarefa === "" || is_null($this->idcolaboradortarefa))  
      { 
          $this->idcolaboradortarefa = 0;
      } 
      nm_limpa_numero($this->idcolaboradortarefa, $this->field_config['idcolaboradortarefa']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idcolaboradortarefa' == $this->NM_ajax_opcao)
      { 
          if ($this->idcolaboradortarefa != '')  
          { 
              $iTestSize = 20;
              if (strlen($this->idcolaboradortarefa) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idcolaboradortarefa']))
                  {
                      $Campos_Erros['idcolaboradortarefa'] = array();
                  }
                  $Campos_Erros['idcolaboradortarefa'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idcolaboradortarefa']) || !is_array($this->NM_ajax_info['errList']['idcolaboradortarefa']))
                  {
                      $this->NM_ajax_info['errList']['idcolaboradortarefa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcolaboradortarefa'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idcolaboradortarefa, 20, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.; " ; 
                  if (!isset($Campos_Erros['idcolaboradortarefa']))
                  {
                      $Campos_Erros['idcolaboradortarefa'] = array();
                  }
                  $Campos_Erros['idcolaboradortarefa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idcolaboradortarefa']) || !is_array($this->NM_ajax_info['errList']['idcolaboradortarefa']))
                  {
                      $this->NM_ajax_info['errList']['idcolaboradortarefa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcolaboradortarefa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcolaboradortarefa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcolaboradortarefa

    function ValidateField_descricao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['descricao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['descricao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['descricao'] == "on")) 
      { 
          if ($this->descricao == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Descrição" ; 
              if (!isset($Campos_Erros['descricao']))
              {
                  $Campos_Erros['descricao'] = array();
              }
              $Campos_Erros['descricao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['descricao']) || !is_array($this->NM_ajax_info['errList']['descricao']))
                  {
                      $this->NM_ajax_info['errList']['descricao'] = array();
                  }
                  $this->NM_ajax_info['errList']['descricao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->descricao) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Descrição " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['descricao']))
              {
                  $Campos_Erros['descricao'] = array();
              }
              $Campos_Erros['descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['descricao']) || !is_array($this->NM_ajax_info['errList']['descricao']))
              {
                  $this->NM_ajax_info['errList']['descricao'] = array();
              }
              $this->NM_ajax_info['errList']['descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'descricao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_descricao

    function ValidateField_idcolaborador(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idcolaborador'])) {
       return;
   }
      if ($this->idcolaborador == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['idcolaborador']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['idcolaborador'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Responsável" ; 
          if (!isset($Campos_Erros['idcolaborador']))
          {
              $Campos_Erros['idcolaborador'] = array();
          }
          $Campos_Erros['idcolaborador'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idcolaborador']) || !is_array($this->NM_ajax_info['errList']['idcolaborador']))
          {
              $this->NM_ajax_info['errList']['idcolaborador'] = array();
          }
          $this->NM_ajax_info['errList']['idcolaborador'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idcolaborador) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']) && !in_array($this->idcolaborador, $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idcolaborador']))
              {
                  $Campos_Erros['idcolaborador'] = array();
              }
              $Campos_Erros['idcolaborador'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idcolaborador']) || !is_array($this->NM_ajax_info['errList']['idcolaborador']))
              {
                  $this->NM_ajax_info['errList']['idcolaborador'] = array();
              }
              $this->NM_ajax_info['errList']['idcolaborador'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
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

    function ValidateField_datainicio(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->datainicio, $this->field_config['datainicio']['date_sep']) ; 
      nm_limpa_hora($this->datainicio_hora, $this->field_config['datainicio_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datainicio'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['datainicio']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['datainicio']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['datainicio']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['datainicio']['date_sep']) ; 
          $Format_Hora = $this->field_config['datainicio_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datainicio_hora']['time_sep']) ; 
          if (trim($this->datainicio) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->datainicio, $Format_Data, $this->datainicio_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->datainicio_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->datainicio, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->datainicio, $Format_Data, $this->datainicio_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->datainicio_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->datainicio, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data de Início; " ; 
                  if (!isset($Campos_Erros['datainicio']))
                  {
                      $Campos_Erros['datainicio'] = array();
                  }
                  $Campos_Erros['datainicio'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datainicio']) || !is_array($this->NM_ajax_info['errList']['datainicio']))
                  {
                      $this->NM_ajax_info['errList']['datainicio'] = array();
                  }
                  $this->NM_ajax_info['errList']['datainicio'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['datainicio']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['datainicio'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Data de Início" ; 
              if (!isset($Campos_Erros['datainicio']))
              {
                  $Campos_Erros['datainicio'] = array();
              }
              $Campos_Erros['datainicio'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['datainicio']) || !is_array($this->NM_ajax_info['errList']['datainicio']))
                  {
                      $this->NM_ajax_info['errList']['datainicio'] = array();
                  }
                  $this->NM_ajax_info['errList']['datainicio'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['datainicio']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datainicio';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->datainicio_hora, $this->field_config['datainicio_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['datainicio_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['datainicio_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['datainicio_hora']['time_sep']) ; 
          if (trim($this->datainicio_hora) != "")  
          { 
              if ($teste_validade->Hora($this->datainicio_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data de Início; " ; 
                  if (!isset($Campos_Erros['datainicio_hora']))
                  {
                      $Campos_Erros['datainicio_hora'] = array();
                  }
                  $Campos_Erros['datainicio_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['datainicio']) || !is_array($this->NM_ajax_info['errList']['datainicio']))
                  {
                      $this->NM_ajax_info['errList']['datainicio'] = array();
                  }
                  $this->NM_ajax_info['errList']['datainicio'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['datainicio_hora']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['datainicio_hora'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Data de Início" ; 
              if (!isset($Campos_Erros['datainicio_hora']))
              {
                  $Campos_Erros['datainicio_hora'] = array();
              }
              $Campos_Erros['datainicio_hora'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['datainicio']) || !is_array($this->NM_ajax_info['errList']['datainicio']))
                  {
                      $this->NM_ajax_info['errList']['datainicio'] = array();
                  }
                  $this->NM_ajax_info['errList']['datainicio'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
      if (isset($Campos_Erros['datainicio']) && isset($Campos_Erros['datainicio_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['datainicio'], $Campos_Erros['datainicio_hora']);
          if (empty($Campos_Erros['datainicio_hora']))
          {
              unset($Campos_Erros['datainicio_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['datainicio']))
          {
              $this->NM_ajax_info['errList']['datainicio'] = array_unique($this->NM_ajax_info['errList']['datainicio']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'datainicio_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_datainicio_hora

    function ValidateField_dataprevisao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      nm_limpa_hora($this->dataprevisao_hora, $this->field_config['dataprevisao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dataprevisao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['dataprevisao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dataprevisao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dataprevisao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dataprevisao']['date_sep']) ; 
          $Format_Hora = $this->field_config['dataprevisao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dataprevisao_hora']['time_sep']) ; 
          if (trim($this->dataprevisao) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->dataprevisao, $Format_Data, $this->dataprevisao_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->dataprevisao_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->dataprevisao, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->dataprevisao, $Format_Data, $this->dataprevisao_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->dataprevisao_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->dataprevisao, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data da Previsão; " ; 
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
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['dataprevisao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['dataprevisao'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Data da Previsão" ; 
              if (!isset($Campos_Erros['dataprevisao']))
              {
                  $Campos_Erros['dataprevisao'] = array();
              }
              $Campos_Erros['dataprevisao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['dataprevisao']) || !is_array($this->NM_ajax_info['errList']['dataprevisao']))
                  {
                      $this->NM_ajax_info['errList']['dataprevisao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataprevisao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
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
      nm_limpa_hora($this->dataprevisao_hora, $this->field_config['dataprevisao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dataprevisao_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['dataprevisao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dataprevisao_hora']['time_sep']) ; 
          if (trim($this->dataprevisao_hora) != "")  
          { 
              if ($teste_validade->Hora($this->dataprevisao_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data da Previsão; " ; 
                  if (!isset($Campos_Erros['dataprevisao_hora']))
                  {
                      $Campos_Erros['dataprevisao_hora'] = array();
                  }
                  $Campos_Erros['dataprevisao_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dataprevisao']) || !is_array($this->NM_ajax_info['errList']['dataprevisao']))
                  {
                      $this->NM_ajax_info['errList']['dataprevisao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataprevisao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['dataprevisao_hora']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['dataprevisao_hora'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Data da Previsão" ; 
              if (!isset($Campos_Erros['dataprevisao_hora']))
              {
                  $Campos_Erros['dataprevisao_hora'] = array();
              }
              $Campos_Erros['dataprevisao_hora'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['dataprevisao']) || !is_array($this->NM_ajax_info['errList']['dataprevisao']))
                  {
                      $this->NM_ajax_info['errList']['dataprevisao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataprevisao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
      if (isset($Campos_Erros['dataprevisao']) && isset($Campos_Erros['dataprevisao_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['dataprevisao'], $Campos_Erros['dataprevisao_hora']);
          if (empty($Campos_Erros['dataprevisao_hora']))
          {
              unset($Campos_Erros['dataprevisao_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['dataprevisao']))
          {
              $this->NM_ajax_info['errList']['dataprevisao'] = array_unique($this->NM_ajax_info['errList']['dataprevisao']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dataprevisao_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dataprevisao_hora

    function ValidateField_motivoprorrogacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['motivoprorrogacao'])) {
       return;
   }
               if (!empty($this->motivoprorrogacao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']) && !in_array($this->motivoprorrogacao, $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['motivoprorrogacao']))
                   {
                       $Campos_Erros['motivoprorrogacao'] = array();
                   }
                   $Campos_Erros['motivoprorrogacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['motivoprorrogacao']) || !is_array($this->NM_ajax_info['errList']['motivoprorrogacao']))
                   {
                       $this->NM_ajax_info['errList']['motivoprorrogacao'] = array();
                   }
                   $this->NM_ajax_info['errList']['motivoprorrogacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'motivoprorrogacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_motivoprorrogacao

    function ValidateField_dataconclusao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->dataconclusao, $this->field_config['dataconclusao']['date_sep']) ; 
      nm_limpa_hora($this->dataconclusao_hora, $this->field_config['dataconclusao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dataconclusao'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['dataconclusao']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['dataconclusao']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['dataconclusao']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['dataconclusao']['date_sep']) ; 
          $Format_Hora = $this->field_config['dataconclusao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dataconclusao_hora']['time_sep']) ; 
          if (trim($this->dataconclusao) != "")  
          { 
              $validateTest = true;
              if ('' != $trab_dt_min && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->DataHora($this->dataconclusao, $Format_Data, $this->dataconclusao_hora, $Format_Hora, $trab_dt_min, '', $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_hr_min) {
                  $validateTest = $teste_validade->Hora($this->dataconclusao_hora, $Format_Hora, $trab_hr_min, '');
              } elseif ($validateTest && '' != $trab_dt_min) {
                  $validateTest = $teste_validade->Data($this->dataconclusao, $Format_Data, $trab_dt_min, '');
              }
              if ($validateTest && '' != $trab_dt_max && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->DataHora($this->dataconclusao, $Format_Data, $this->dataconclusao_hora, $Format_Hora, '', $trab_dt_max, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_hr_max) {
                  $validateTest = $teste_validade->Hora($this->dataconclusao_hora, $Format_Hora, '', $trab_hr_max);
              } elseif ($validateTest && '' != $trab_dt_max) {
                  $validateTest = $teste_validade->Data($this->dataconclusao, $Format_Data, '', $trab_dt_max);
              }
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data da Conclusão; " ; 
                  if (!isset($Campos_Erros['dataconclusao']))
                  {
                      $Campos_Erros['dataconclusao'] = array();
                  }
                  $Campos_Erros['dataconclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dataconclusao']) || !is_array($this->NM_ajax_info['errList']['dataconclusao']))
                  {
                      $this->NM_ajax_info['errList']['dataconclusao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataconclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['dataconclusao']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dataconclusao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
      nm_limpa_hora($this->dataconclusao_hora, $this->field_config['dataconclusao_hora']['time_sep']) ; 
      if (isset($this->Field_no_validate['dataconclusao_hora'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['dataconclusao_hora']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['dataconclusao_hora']['time_sep']) ; 
          if (trim($this->dataconclusao_hora) != "")  
          { 
              if ($teste_validade->Hora($this->dataconclusao_hora, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data da Conclusão; " ; 
                  if (!isset($Campos_Erros['dataconclusao_hora']))
                  {
                      $Campos_Erros['dataconclusao_hora'] = array();
                  }
                  $Campos_Erros['dataconclusao_hora'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['dataconclusao']) || !is_array($this->NM_ajax_info['errList']['dataconclusao']))
                  {
                      $this->NM_ajax_info['errList']['dataconclusao'] = array();
                  }
                  $this->NM_ajax_info['errList']['dataconclusao'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
      if (isset($Campos_Erros['dataconclusao']) && isset($Campos_Erros['dataconclusao_hora']))
      {
          $this->removeDuplicateDttmError($Campos_Erros['dataconclusao'], $Campos_Erros['dataconclusao_hora']);
          if (empty($Campos_Erros['dataconclusao_hora']))
          {
              unset($Campos_Erros['dataconclusao_hora']);
          }
          if (isset($this->NM_ajax_info['errList']['dataconclusao']))
          {
              $this->NM_ajax_info['errList']['dataconclusao'] = array_unique($this->NM_ajax_info['errList']['dataconclusao']);
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'dataconclusao_hora';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_dataconclusao_hora

    function ValidateField_prioridade(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['prioridade'])) {
       return;
   }
      if ($this->prioridade == "" && $this->nmgp_opcao != "excluir")
      { 
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['prioridade']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['prioridade'] == "on")
        { 
          $hasError = true;
          $Campos_Falta[] = "Prioridade" ;
          if (!isset($Campos_Erros['prioridade']))
          {
              $Campos_Erros['prioridade'] = array();
          }
          $Campos_Erros['prioridade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['prioridade']) || !is_array($this->NM_ajax_info['errList']['prioridade']))
                  {
                      $this->NM_ajax_info['errList']['prioridade'] = array();
                  }
                  $this->NM_ajax_info['errList']['prioridade'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
        } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'prioridade';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_prioridade

    function ValidateField_situacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['situacao'])) {
       return;
   }
      if ($this->situacao == "" && $this->nmgp_opcao != "excluir")
      { 
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['situacao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['php_cmp_required']['situacao'] == "on")
        { 
          $hasError = true;
          $Campos_Falta[] = "Situação" ;
          if (!isset($Campos_Erros['situacao']))
          {
              $Campos_Erros['situacao'] = array();
          }
          $Campos_Erros['situacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['situacao']) || !is_array($this->NM_ajax_info['errList']['situacao']))
                  {
                      $this->NM_ajax_info['errList']['situacao'] = array();
                  }
                  $this->NM_ajax_info['errList']['situacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
        } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'situacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_situacao

    function ValidateField_observacoes(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['observacoes'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->observacoes) > 32767) 
          { 
              $hasError = true;
              $Campos_Crit .= "Texto " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
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
    $this->nmgp_dados_form['idcontrato'] = $this->idcontrato;
    $this->nmgp_dados_form['idcolaboradortarefa'] = $this->idcolaboradortarefa;
    $this->nmgp_dados_form['descricao'] = $this->descricao;
    $this->nmgp_dados_form['idcolaborador'] = $this->idcolaborador;
    $this->nmgp_dados_form['datainicio'] = (strlen(trim($this->datainicio)) > 19) ? str_replace(".", ":", $this->datainicio) : trim($this->datainicio);
    $this->nmgp_dados_form['dataprevisao'] = (strlen(trim($this->dataprevisao)) > 19) ? str_replace(".", ":", $this->dataprevisao) : trim($this->dataprevisao);
    $this->nmgp_dados_form['motivoprorrogacao'] = $this->motivoprorrogacao;
    $this->nmgp_dados_form['dataconclusao'] = (strlen(trim($this->dataconclusao)) > 19) ? str_replace(".", ":", $this->dataconclusao) : trim($this->dataconclusao);
    $this->nmgp_dados_form['prioridade'] = $this->prioridade;
    $this->nmgp_dados_form['situacao'] = $this->situacao;
    $this->nmgp_dados_form['observacoes'] = $this->observacoes;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['dataprevisaoinicial'] = $this->dataprevisaoinicial;
    $this->nmgp_dados_form['qtdalteracaodata'] = $this->qtdalteracaodata;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['idcolaboradortarefa'] = $this->idcolaboradortarefa;
      nm_limpa_numero($this->idcolaboradortarefa, $this->field_config['idcolaboradortarefa']['symbol_grp']) ; 
      $this->Before_unformat['datainicio'] = $this->datainicio;
      $this->Before_unformat['datainicio_hora'] = $this->datainicio_hora;
      nm_limpa_data($this->datainicio, $this->field_config['datainicio']['date_sep']) ; 
      nm_limpa_hora($this->datainicio_hora, $this->field_config['datainicio']['time_sep']) ; 
      $this->Before_unformat['dataprevisao'] = $this->dataprevisao;
      $this->Before_unformat['dataprevisao_hora'] = $this->dataprevisao_hora;
      nm_limpa_data($this->dataprevisao, $this->field_config['dataprevisao']['date_sep']) ; 
      nm_limpa_hora($this->dataprevisao_hora, $this->field_config['dataprevisao']['time_sep']) ; 
      $this->Before_unformat['dataconclusao'] = $this->dataconclusao;
      $this->Before_unformat['dataconclusao_hora'] = $this->dataconclusao_hora;
      nm_limpa_data($this->dataconclusao, $this->field_config['dataconclusao']['date_sep']) ; 
      nm_limpa_hora($this->dataconclusao_hora, $this->field_config['dataconclusao']['time_sep']) ; 
      $this->Before_unformat['idtenacidade'] = $this->idtenacidade;
      nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
      $this->Before_unformat['idusuarioauditoria'] = $this->idusuarioauditoria;
      nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
      $this->Before_unformat['dataprevisaoinicial'] = $this->dataprevisaoinicial;
      $this->Before_unformat['dataprevisaoinicial_hora'] = $this->dataprevisaoinicial_hora;
      nm_limpa_data($this->dataprevisaoinicial, $this->field_config['dataprevisaoinicial']['date_sep']) ; 
      nm_limpa_hora($this->dataprevisaoinicial_hora, $this->field_config['dataprevisaoinicial']['time_sep']) ; 
      $this->Before_unformat['qtdalteracaodata'] = $this->qtdalteracaodata;
      nm_limpa_numero($this->qtdalteracaodata, $this->field_config['qtdalteracaodata']['symbol_grp']) ; 
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
      if ($Nome_Campo == "idcolaboradortarefa")
      {
          nm_limpa_numero($this->idcolaboradortarefa, $this->field_config['idcolaboradortarefa']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idtenacidade")
      {
          nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "idusuarioauditoria")
      {
          nm_limpa_numero($this->idusuarioauditoria, $this->field_config['idusuarioauditoria']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "qtdalteracaodata")
      {
          nm_limpa_numero($this->qtdalteracaodata, $this->field_config['qtdalteracaodata']['symbol_grp']) ; 
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
      if ('' !== $this->idcolaboradortarefa || (!empty($format_fields) && isset($format_fields['idcolaboradortarefa'])))
      {
          nmgp_Form_Num_Val($this->idcolaboradortarefa, $this->field_config['idcolaboradortarefa']['symbol_grp'], $this->field_config['idcolaboradortarefa']['symbol_dec'], "0", "S", $this->field_config['idcolaboradortarefa']['format_neg'], "", "", "-", $this->field_config['idcolaboradortarefa']['symbol_fmt']) ; 
      }
      if ((!empty($this->datainicio) && 'null' != $this->datainicio) || (!empty($format_fields) && isset($format_fields['datainicio'])))
      {
          $nm_separa_data = strpos($this->field_config['datainicio']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['datainicio']['date_format'];
          $this->field_config['datainicio']['date_format'] = substr($this->field_config['datainicio']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->datainicio, " ") ; 
          $this->datainicio_hora = substr($this->datainicio, $separador + 1) ; 
          $this->datainicio = substr($this->datainicio, 0, $separador) ; 
          nm_volta_data($this->datainicio, $this->field_config['datainicio']['date_format']) ; 
          nmgp_Form_Datas($this->datainicio, $this->field_config['datainicio']['date_format'], $this->field_config['datainicio']['date_sep']) ;  
          $this->field_config['datainicio']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->datainicio_hora, $this->field_config['datainicio']['date_format']) ; 
          nmgp_Form_Hora($this->datainicio_hora, $this->field_config['datainicio']['date_format'], $this->field_config['datainicio']['time_sep']) ;  
          $this->field_config['datainicio']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->datainicio || '' == $this->datainicio)
      {
          $this->datainicio_hora = '';
          $this->datainicio = '';
      }
      if ((!empty($this->dataprevisao) && 'null' != $this->dataprevisao) || (!empty($format_fields) && isset($format_fields['dataprevisao'])))
      {
          $nm_separa_data = strpos($this->field_config['dataprevisao']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['dataprevisao']['date_format'];
          $this->field_config['dataprevisao']['date_format'] = substr($this->field_config['dataprevisao']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->dataprevisao, " ") ; 
          $this->dataprevisao_hora = substr($this->dataprevisao, $separador + 1) ; 
          $this->dataprevisao = substr($this->dataprevisao, 0, $separador) ; 
          nm_volta_data($this->dataprevisao, $this->field_config['dataprevisao']['date_format']) ; 
          nmgp_Form_Datas($this->dataprevisao, $this->field_config['dataprevisao']['date_format'], $this->field_config['dataprevisao']['date_sep']) ;  
          $this->field_config['dataprevisao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->dataprevisao_hora, $this->field_config['dataprevisao']['date_format']) ; 
          nmgp_Form_Hora($this->dataprevisao_hora, $this->field_config['dataprevisao']['date_format'], $this->field_config['dataprevisao']['time_sep']) ;  
          $this->field_config['dataprevisao']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->dataprevisao || '' == $this->dataprevisao)
      {
          $this->dataprevisao_hora = '';
          $this->dataprevisao = '';
      }
      if ((!empty($this->dataconclusao) && 'null' != $this->dataconclusao) || (!empty($format_fields) && isset($format_fields['dataconclusao'])))
      {
          $nm_separa_data = strpos($this->field_config['dataconclusao']['date_format'], ";") ;
          $guarda_format_hora = $this->field_config['dataconclusao']['date_format'];
          $this->field_config['dataconclusao']['date_format'] = substr($this->field_config['dataconclusao']['date_format'], 0, $nm_separa_data) ;
          $separador = strpos($this->dataconclusao, " ") ; 
          $this->dataconclusao_hora = substr($this->dataconclusao, $separador + 1) ; 
          $this->dataconclusao = substr($this->dataconclusao, 0, $separador) ; 
          nm_volta_data($this->dataconclusao, $this->field_config['dataconclusao']['date_format']) ; 
          nmgp_Form_Datas($this->dataconclusao, $this->field_config['dataconclusao']['date_format'], $this->field_config['dataconclusao']['date_sep']) ;  
          $this->field_config['dataconclusao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_volta_hora($this->dataconclusao_hora, $this->field_config['dataconclusao']['date_format']) ; 
          nmgp_Form_Hora($this->dataconclusao_hora, $this->field_config['dataconclusao']['date_format'], $this->field_config['dataconclusao']['time_sep']) ;  
          $this->field_config['dataconclusao']['date_format'] = $guarda_format_hora ;
      }
      elseif ('null' == $this->dataconclusao || '' == $this->dataconclusao)
      {
          $this->dataconclusao_hora = '';
          $this->dataconclusao = '';
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
      $guarda_format_hora = $this->field_config['datainicio']['date_format'];
      if ($this->datainicio != "")  
      { 
          $nm_separa_data = strpos($this->field_config['datainicio']['date_format'], ";") ;
          $this->field_config['datainicio']['date_format'] = substr($this->field_config['datainicio']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->datainicio, $this->field_config['datainicio']['date_format']) ; 
          $this->field_config['datainicio']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->datainicio_hora, $this->field_config['datainicio']['date_format']) ; 
          if ($this->datainicio_hora == "" )  
          { 
              $this->datainicio_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->datainicio_hora = substr($this->datainicio_hora, 0, -4) . "." . substr($this->datainicio_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->datainicio_hora = substr($this->datainicio_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->datainicio_hora = substr($this->datainicio_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->datainicio_hora = substr($this->datainicio_hora, 0, -4);
          }
          if ($this->datainicio != "")  
          { 
              $this->datainicio .= " " . $this->datainicio_hora ; 
          }
      } 
      if ($this->datainicio == "" && $use_null)  
      { 
          $this->datainicio = "null" ; 
      } 
      $this->field_config['datainicio']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['dataprevisao']['date_format'];
      if ($this->dataprevisao != "")  
      { 
          $nm_separa_data = strpos($this->field_config['dataprevisao']['date_format'], ";") ;
          $this->field_config['dataprevisao']['date_format'] = substr($this->field_config['dataprevisao']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->dataprevisao, $this->field_config['dataprevisao']['date_format']) ; 
          $this->field_config['dataprevisao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->dataprevisao_hora, $this->field_config['dataprevisao']['date_format']) ; 
          if ($this->dataprevisao_hora == "" )  
          { 
              $this->dataprevisao_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->dataprevisao_hora = substr($this->dataprevisao_hora, 0, -4) . "." . substr($this->dataprevisao_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
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
          if ($this->dataprevisao != "")  
          { 
              $this->dataprevisao .= " " . $this->dataprevisao_hora ; 
          }
      } 
      if ($this->dataprevisao == "" && $use_null)  
      { 
          $this->dataprevisao = "null" ; 
      } 
      $this->field_config['dataprevisao']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['dataconclusao']['date_format'];
      if ($this->dataconclusao != "")  
      { 
          $nm_separa_data = strpos($this->field_config['dataconclusao']['date_format'], ";") ;
          $this->field_config['dataconclusao']['date_format'] = substr($this->field_config['dataconclusao']['date_format'], 0, $nm_separa_data) ;
          nm_conv_data($this->dataconclusao, $this->field_config['dataconclusao']['date_format']) ; 
          $this->field_config['dataconclusao']['date_format'] = substr($guarda_format_hora, $nm_separa_data + 1) ;
          nm_conv_hora($this->dataconclusao_hora, $this->field_config['dataconclusao']['date_format']) ; 
          if ($this->dataconclusao_hora == "" )  
          { 
              $this->dataconclusao_hora = "00:00:00:000" ; 
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          {
              $this->dataconclusao_hora = substr($this->dataconclusao_hora, 0, -4) . "." . substr($this->dataconclusao_hora, -3);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->dataconclusao_hora = substr($this->dataconclusao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->dataconclusao_hora = substr($this->dataconclusao_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->dataconclusao_hora = substr($this->dataconclusao_hora, 0, -4);
          }
          if ($this->dataconclusao != "")  
          { 
              $this->dataconclusao .= " " . $this->dataconclusao_hora ; 
          }
      } 
      if ($this->dataconclusao == "" && $use_null)  
      { 
          $this->dataconclusao = "null" ; 
      } 
      $this->field_config['dataconclusao']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_idcontrato();
          $this->ajax_return_values_idcolaboradortarefa();
          $this->ajax_return_values_descricao();
          $this->ajax_return_values_idcolaborador();
          $this->ajax_return_values_datainicio();
          $this->ajax_return_values_dataprevisao();
          $this->ajax_return_values_motivoprorrogacao();
          $this->ajax_return_values_dataconclusao();
          $this->ajax_return_values_prioridade();
          $this->ajax_return_values_situacao();
          $this->ajax_return_values_observacoes();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idcolaboradortarefa']['keyVal'] = ColaboradorTarefa_Frm_pack_protect_string($this->nmgp_dados_form['idcolaboradortarefa']);
          }
   } // ajax_return_values

          //----- idcontrato
   function ajax_return_values_idcontrato($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcontrato", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcontrato);
              $aLookup = array();
              $this->_tmp_lookup_idcontrato = $this->idcontrato;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'] = array(); 
}
$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $old_value_datainicio = $this->datainicio;
   $old_value_datainicio_hora = $this->datainicio_hora;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_dataprevisao_hora = $this->dataprevisao_hora;
   $old_value_dataconclusao = $this->dataconclusao;
   $old_value_dataconclusao_hora = $this->dataconclusao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $unformatted_value_datainicio = $this->datainicio;
   $unformatted_value_datainicio_hora = $this->datainicio_hora;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_dataprevisao_hora = $this->dataprevisao_hora;
   $unformatted_value_dataconclusao = $this->dataconclusao;
   $unformatted_value_dataconclusao_hora = $this->dataconclusao_hora;

   $nm_comando = "SELECT c.IdContrato, cl.NomeFantasia  FROM contrato c  INNER JOIN cliente cl ON (cl.IdCliente = c.IdCliente) WHERE c.IdTenacidade = " . $_SESSION['varIdTenacidade'] . " AND c.SituacaoContrato = 'A' AND c.DataFimImplantacao IS NULL ORDER BY c.IdCliente";

   $this->idcolaboradortarefa = $old_value_idcolaboradortarefa;
   $this->datainicio = $old_value_datainicio;
   $this->datainicio_hora = $old_value_datainicio_hora;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->dataprevisao_hora = $old_value_dataprevisao_hora;
   $this->dataconclusao = $old_value_dataconclusao;
   $this->dataconclusao_hora = $old_value_dataconclusao_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', ColaboradorTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0] . " - " . $rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idcontrato\"";
          if (isset($this->NM_ajax_info['select_html']['idcontrato']) && !empty($this->NM_ajax_info['select_html']['idcontrato']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idcontrato']);
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

                  if ($this->idcontrato == $sValue)
                  {
                      $this->_tmp_lookup_idcontrato = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idcontrato'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idcontrato']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idcontrato']['valList'][$i] = ColaboradorTarefa_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcontrato']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcontrato']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcontrato']['labList'] = $aLabel;
          }
   }

          //----- idcolaboradortarefa
   function ajax_return_values_idcolaboradortarefa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcolaboradortarefa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcolaboradortarefa);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idcolaboradortarefa'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idcolaboradortarefa", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- descricao
   function ajax_return_values_descricao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("descricao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->descricao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['descricao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
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

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'] = array(); 
}
$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string('Escolha o responsável')));
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $old_value_datainicio = $this->datainicio;
   $old_value_datainicio_hora = $this->datainicio_hora;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_dataprevisao_hora = $this->dataprevisao_hora;
   $old_value_dataconclusao = $this->dataconclusao;
   $old_value_dataconclusao_hora = $this->dataconclusao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $unformatted_value_datainicio = $this->datainicio;
   $unformatted_value_datainicio_hora = $this->datainicio_hora;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_dataprevisao_hora = $this->dataprevisao_hora;
   $unformatted_value_dataconclusao = $this->dataconclusao;
   $unformatted_value_dataconclusao_hora = $this->dataconclusao_hora;

   $nm_comando = "SELECT IdColaborador, Nome  FROM colaborador  WHERE     IdTenacidade = " . $_SESSION['varIdTenacidade'] . " AND Implanta = 'S' AND IdSituacaoColaborador = 1 ORDER BY Nome";

   $this->idcolaboradortarefa = $old_value_idcolaboradortarefa;
   $this->datainicio = $old_value_datainicio;
   $this->datainicio_hora = $old_value_datainicio_hora;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->dataprevisao_hora = $old_value_dataprevisao_hora;
   $this->dataconclusao = $old_value_dataconclusao;
   $this->dataconclusao_hora = $old_value_dataconclusao_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', ColaboradorTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idcolaborador\"";
          if (isset($this->NM_ajax_info['select_html']['idcolaborador']) && !empty($this->NM_ajax_info['select_html']['idcolaborador']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idcolaborador']);
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

                  if ($this->idcolaborador == $sValue)
                  {
                      $this->_tmp_lookup_idcolaborador = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idcolaborador'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idcolaborador']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idcolaborador']['valList'][$i] = ColaboradorTarefa_Frm_pack_protect_string($v);
          }
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
          }
   }

          //----- datainicio
   function ajax_return_values_datainicio($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("datainicio", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->datainicio);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['datainicio'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->datainicio . ' ' . $this->datainicio_hora),
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
               'type'    => 'text',
               'valList' => array($this->dataprevisao . ' ' . $this->dataprevisao_hora),
              );
          }
   }

          //----- motivoprorrogacao
   function ajax_return_values_motivoprorrogacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("motivoprorrogacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->motivoprorrogacao);
              $aLookup = array();
              $this->_tmp_lookup_motivoprorrogacao = $this->motivoprorrogacao;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'] = array(); 
}
$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $old_value_datainicio = $this->datainicio;
   $old_value_datainicio_hora = $this->datainicio_hora;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_dataprevisao_hora = $this->dataprevisao_hora;
   $old_value_dataconclusao = $this->dataconclusao;
   $old_value_dataconclusao_hora = $this->dataconclusao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $unformatted_value_datainicio = $this->datainicio;
   $unformatted_value_datainicio_hora = $this->datainicio_hora;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_dataprevisao_hora = $this->dataprevisao_hora;
   $unformatted_value_dataconclusao = $this->dataconclusao;
   $unformatted_value_dataconclusao_hora = $this->dataconclusao_hora;

   $nm_comando = "SELECT IdColaboradorTarefaMotivoProrrogacao, Nome  FROM colaboradortarefamotivoprorrogacao  WHERE IdTenacidade = " . $_SESSION['varIdTenacidade'] . " ORDER BY Nome";

   $this->idcolaboradortarefa = $old_value_idcolaboradortarefa;
   $this->datainicio = $old_value_datainicio;
   $this->datainicio_hora = $old_value_datainicio_hora;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->dataprevisao_hora = $old_value_dataprevisao_hora;
   $this->dataconclusao = $old_value_dataconclusao;
   $this->dataconclusao_hora = $old_value_dataconclusao_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', ColaboradorTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'][] = $rs->fields[0];
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
          $sSelComp = "name=\"motivoprorrogacao\"";
          if (isset($this->NM_ajax_info['select_html']['motivoprorrogacao']) && !empty($this->NM_ajax_info['select_html']['motivoprorrogacao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['motivoprorrogacao']);
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

                  if ($this->motivoprorrogacao == $sValue)
                  {
                      $this->_tmp_lookup_motivoprorrogacao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['motivoprorrogacao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['motivoprorrogacao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['motivoprorrogacao']['valList'][$i] = ColaboradorTarefa_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['motivoprorrogacao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['motivoprorrogacao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['motivoprorrogacao']['labList'] = $aLabel;
          }
   }

          //----- dataconclusao
   function ajax_return_values_dataconclusao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("dataconclusao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->dataconclusao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['dataconclusao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->dataconclusao . ' ' . $this->dataconclusao_hora),
              );
          }
   }

          //----- prioridade
   function ajax_return_values_prioridade($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("prioridade", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->prioridade);
              $aLookup = array();
              $this->_tmp_lookup_prioridade = $this->prioridade;

$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('A') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string("Alta")));
$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('M') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string("Média")));
$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('B') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string("Baixa")));
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_prioridade'][] = 'A';
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_prioridade'][] = 'M';
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_prioridade'][] = 'B';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"prioridade\"";
          if (isset($this->NM_ajax_info['select_html']['prioridade']) && !empty($this->NM_ajax_info['select_html']['prioridade']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['prioridade']);
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

                  if ($this->prioridade == $sValue)
                  {
                      $this->_tmp_lookup_prioridade = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['prioridade'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['prioridade']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['prioridade']['valList'][$i] = ColaboradorTarefa_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['prioridade']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['prioridade']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['prioridade']['labList'] = $aLabel;
          }
   }

          //----- situacao
   function ajax_return_values_situacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("situacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->situacao);
              $aLookup = array();
              $this->_tmp_lookup_situacao = $this->situacao;

$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('P') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string("Pendente")));
$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('C') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string("Concluída")));
$aLookup[] = array(ColaboradorTarefa_Frm_pack_protect_string('X') => str_replace('<', '&lt;',ColaboradorTarefa_Frm_pack_protect_string("Cancelada")));
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_situacao'][] = 'P';
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_situacao'][] = 'C';
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_situacao'][] = 'X';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"situacao\"";
          if (isset($this->NM_ajax_info['select_html']['situacao']) && !empty($this->NM_ajax_info['select_html']['situacao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['situacao']);
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

                  if ($this->situacao == $sValue)
                  {
                      $this->_tmp_lookup_situacao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['situacao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['situacao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['situacao']['valList'][$i] = ColaboradorTarefa_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['situacao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['situacao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['situacao']['labList'] = $aLabel;
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdColaboradorSel)) {$this->sc_temp_varIdColaboradorSel = (isset($_SESSION['varIdColaboradorSel'])) ? $_SESSION['varIdColaboradorSel'] : "";}
if (!isset($this->sc_temp_varIdContratoSel)) {$this->sc_temp_varIdContratoSel = (isset($_SESSION['varIdContratoSel'])) ? $_SESSION['varIdContratoSel'] : "";}
  $this->Preparar_LstFrm_OnSrip_OnLoad_Auditoria($this->Ini->nm_cod_apl, $this->idcolaboradortarefa );


if (!empty($this->sc_temp_varIdContratoSel)) {
	
	$this->idcontrato  = $this->sc_temp_varIdContratoSel;
	$this->idcolaborador  = $this->sc_temp_varIdColaboradorSel;
	
}

if ($this->situacao  == 'C') {
	
	$this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = 'off';;
	
}

$this->nmgp_cmp_hidden["motivoprorrogacao"] = 'off'; $this->NM_ajax_info['fieldDisplay']['motivoprorrogacao'] = 'off';
if (isset($this->sc_temp_varIdContratoSel)) { $_SESSION['varIdContratoSel'] = $this->sc_temp_varIdContratoSel;}
if (isset($this->sc_temp_varIdColaboradorSel)) { $_SESSION['varIdColaboradorSel'] = $this->sc_temp_varIdColaboradorSel;}
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onLoad ------*/
 
      }
      if (empty($this->datainicio))
      {
          $this->datainicio_hora = $this->datainicio;
      }
      if (empty($this->dataprevisao))
      {
          $this->dataprevisao_hora = $this->dataprevisao;
      }
      if (empty($this->dataconclusao))
      {
          $this->dataconclusao_hora = $this->dataconclusao;
      }
      if (empty($this->dataprevisaoinicial))
      {
          $this->dataprevisaoinicial_hora = $this->dataprevisaoinicial;
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
//----------- 

   function controle_navegacao()
   {
      global $sc_where;

          if (false && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']))
          {
               $sc_where_pos = " WHERE ((IdColaboradorTarefa < $this->idcolaboradortarefa))";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total'] = $rsc->fields[0];
               $rsc->Close(); 
               if ('' != $this->idcolaboradortarefa)
               {
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = $rsc->fields[0];
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] < 0)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = 0;
               }
               $rsc->Close(); 
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = 0;
               }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['qt_reg_grid'] = 1;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['final']  = 0;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] = $this->NM_ajax_info['param']['nmgp_opcao'];
          if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'], array('incluir', 'alterar', 'excluir')))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] = '';
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] == 'inicio')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = 0;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] == 'retorna')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = 0 ;
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] == 'avanca' && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total'] > $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['final']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['final'];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] == 'final')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] = 0;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['final'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['qt_reg_grid'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['final'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] = '';

   }
   function return_after_insert()
   {
      global $sc_where;
      $this->restore_zeros_null();
      $sc_where_pos = " WHERE ((IdColaboradorTarefa < $this->idcolaboradortarefa))";
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
      if ('' != $this->idcolaboradortarefa)
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['reg_start'] = $rsc->fields[0];
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
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
  $this->dataprevisaoinicial  = $this->dataprevisao ;
$this->qtdalteracaodata  = 0;
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onBeforeInsert ------*/
 
    }
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      
/*----- Scriptcase Locale: Event onBeforeUpdate ------*/
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuarioColaborador)) {$this->sc_temp_varIdUsuarioColaborador = (isset($_SESSION['varIdUsuarioColaborador'])) ? $_SESSION['varIdUsuarioColaborador'] : "";}
  if ($this->dataprevisao  != $this->dataprevisaoinicial  && ($this->situacao  == 'P')) {
	
	if (empty($this->motivoprorrogacao )) {
		
		$this->dataprevisao  = $this->dataprevisaoinicial ;		
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Motivo prorrogação obrigatório.".$motivoprorogacao ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_ColaboradorTarefa_Frm';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_ColaboradorTarefa_Frm';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Motivo prorrogação obrigatório.".$motivoprorogacao ;
 }
;		
		
	} else {
		
		$date = new DateTime();	
		$varDataHora = $date->format('Y-m-d H:i:s');
		
		$this->qtdalteracaodata  = $this->qtdalteracaodata  + 1;

		$insert_table  = 'colaboradortarefahistorico';      
		$insert_fields = array(   
			 'IdColaboradorTarefa' => "$this->idcolaboradortarefa ",
			 'IdColaboradorTarefaMotivoProrrogacao' => "$this->motivoprorrogacao ",
			 'IdUsuario' => "$this->sc_temp_varIdUsuarioColaborador",
			 'DataHora' => "'$varDataHora'",
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
                ColaboradorTarefa_Frm_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      		
		
	}		
}
if (isset($this->sc_temp_varIdUsuarioColaborador)) { $_SESSION['varIdUsuarioColaborador'] = $this->sc_temp_varIdUsuarioColaborador;}
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
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
      $NM_val_form['idcontrato'] = $this->idcontrato;
      $NM_val_form['idcolaboradortarefa'] = $this->idcolaboradortarefa;
      $NM_val_form['descricao'] = $this->descricao;
      $NM_val_form['idcolaborador'] = $this->idcolaborador;
      $NM_val_form['datainicio'] = $this->datainicio;
      $NM_val_form['dataprevisao'] = $this->dataprevisao;
      $NM_val_form['motivoprorrogacao'] = $this->motivoprorrogacao;
      $NM_val_form['dataconclusao'] = $this->dataconclusao;
      $NM_val_form['prioridade'] = $this->prioridade;
      $NM_val_form['situacao'] = $this->situacao;
      $NM_val_form['observacoes'] = $this->observacoes;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['dataprevisaoinicial'] = $this->dataprevisaoinicial;
      $NM_val_form['qtdalteracaodata'] = $this->qtdalteracaodata;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      if ($this->idcolaboradortarefa === "" || is_null($this->idcolaboradortarefa))  
      { 
          $this->idcolaboradortarefa = 0;
      } 
      if ($this->idtenacidade === "" || is_null($this->idtenacidade))  
      { 
          $this->idtenacidade = 0;
          $this->sc_force_zero[] = 'idtenacidade';
      } 
      if ($this->idcolaborador === "" || is_null($this->idcolaborador))  
      { 
          $this->idcolaborador = 0;
          $this->sc_force_zero[] = 'idcolaborador';
      } 
      if ($this->idcontrato === "" || is_null($this->idcontrato))  
      { 
          $this->idcontrato = 0;
          $this->sc_force_zero[] = 'idcontrato';
      } 
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      if ($this->qtdalteracaodata === "" || is_null($this->qtdalteracaodata))  
      { 
          $this->qtdalteracaodata = 0;
          $this->sc_force_zero[] = 'qtdalteracaodata';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->descricao_before_qstr = $this->descricao;
          $this->descricao = substr($this->Db->qstr($this->descricao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->descricao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->descricao);
          }
          if ($this->descricao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->descricao = "null"; 
              $this->NM_val_null[] = "descricao";
          } 
          if ($this->datainicio == "")  
          { 
              $this->datainicio = "null"; 
              $this->NM_val_null[] = "datainicio";
          } 
          if ($this->dataprevisao == "")  
          { 
              $this->dataprevisao = "null"; 
              $this->NM_val_null[] = "dataprevisao";
          } 
          if ($this->dataprevisaoinicial == "")  
          { 
              $this->dataprevisaoinicial = "null"; 
              $this->NM_val_null[] = "dataprevisaoinicial";
          } 
          if ($this->dataconclusao == "")  
          { 
              $this->dataconclusao = "null"; 
              $this->NM_val_null[] = "dataconclusao";
          } 
          $this->prioridade_before_qstr = $this->prioridade;
          $this->prioridade = substr($this->Db->qstr($this->prioridade), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->prioridade = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->prioridade);
          }
          if ($this->prioridade == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->prioridade = "null"; 
              $this->NM_val_null[] = "prioridade";
          } 
          $this->situacao_before_qstr = $this->situacao;
          $this->situacao = substr($this->Db->qstr($this->situacao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->situacao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->situacao);
          }
          if ($this->situacao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->situacao = "null"; 
              $this->NM_val_null[] = "situacao";
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 ColaboradorTarefa_Frm_pack_ajax_response();
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
                  $SC_fields_update[] = "IdColaborador = $this->idcolaborador, IdContrato = $this->idcontrato, Descricao = '$this->descricao', DataInicio = #$this->datainicio#, DataPrevisao = #$this->dataprevisao#, DataConclusao = #$this->dataconclusao#, Prioridade = '$this->prioridade', Situacao = '$this->situacao', Observacoes = '$this->observacoes'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdColaborador = $this->idcolaborador, IdContrato = $this->idcontrato, Descricao = '$this->descricao', DataInicio = " . $this->Ini->date_delim . $this->datainicio . $this->Ini->date_delim1 . ", DataPrevisao = " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", DataConclusao = " . $this->Ini->date_delim . $this->dataconclusao . $this->Ini->date_delim1 . ", Prioridade = '$this->prioridade', Situacao = '$this->situacao', Observacoes = '$this->observacoes'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdColaborador = $this->idcolaborador, IdContrato = $this->idcontrato, Descricao = '$this->descricao', DataInicio = " . $this->Ini->date_delim . $this->datainicio . $this->Ini->date_delim1 . ", DataPrevisao = " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", DataConclusao = " . $this->Ini->date_delim . $this->dataconclusao . $this->Ini->date_delim1 . ", Prioridade = '$this->prioridade', Situacao = '$this->situacao', Observacoes = '$this->observacoes'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdColaborador = $this->idcolaborador, IdContrato = $this->idcontrato, Descricao = '$this->descricao', DataInicio = " . $this->Ini->date_delim . $this->datainicio . $this->Ini->date_delim1 . ", DataPrevisao = " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", DataConclusao = " . $this->Ini->date_delim . $this->dataconclusao . $this->Ini->date_delim1 . ", Prioridade = '$this->prioridade', Situacao = '$this->situacao', Observacoes = '$this->observacoes'"; 
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
              $Prep_Tst = (isset($NM_val_form['dataprevisaoinicial']) && $NM_val_form['dataprevisaoinicial'] == "null"  && $this->nmgp_dados_select['dataprevisaoinicial'] == "") ? "null" : $this->nmgp_dados_select['dataprevisaoinicial'];
              if (isset($NM_val_form['dataprevisaoinicial']) && $NM_val_form['dataprevisaoinicial'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "DataPrevisaoInicial = #$this->dataprevisaoinicial#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "DataPrevisaoInicial = " . $this->Ini->date_delim . $this->dataprevisaoinicial . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['qtdalteracaodata']) && $NM_val_form['qtdalteracaodata'] == "null"  && $this->nmgp_dados_select['qtdalteracaodata'] == "") ? "null" : $this->nmgp_dados_select['qtdalteracaodata'];
              if (isset($NM_val_form['qtdalteracaodata']) && $NM_val_form['qtdalteracaodata'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "QtdAlteracaoData = $this->qtdalteracaodata"; 
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
                  $comando .= " WHERE IdColaboradorTarefa = $this->idcolaboradortarefa ";  
              }  
              else  
              {
                  $comando .= " WHERE IdColaboradorTarefa = $this->idcolaboradortarefa ";  
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
                                  ColaboradorTarefa_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->descricao = $this->descricao_before_qstr;
              $this->prioridade = $this->prioridade_before_qstr;
              $this->situacao = $this->situacao_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idcolaboradortarefa'])) { $this->idcolaboradortarefa = $NM_val_form['idcolaboradortarefa']; }
              elseif (isset($this->idcolaboradortarefa)) { $this->nm_limpa_alfa($this->idcolaboradortarefa); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcolaborador'])) { $this->idcolaborador = $NM_val_form['idcolaborador']; }
              elseif (isset($this->idcolaborador)) { $this->nm_limpa_alfa($this->idcolaborador); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcontrato'])) { $this->idcontrato = $NM_val_form['idcontrato']; }
              elseif (isset($this->idcontrato)) { $this->nm_limpa_alfa($this->idcontrato); }
              if     (isset($NM_val_form) && isset($NM_val_form['descricao'])) { $this->descricao = $NM_val_form['descricao']; }
              elseif (isset($this->descricao)) { $this->nm_limpa_alfa($this->descricao); }
              if     (isset($NM_val_form) && isset($NM_val_form['prioridade'])) { $this->prioridade = $NM_val_form['prioridade']; }
              elseif (isset($this->prioridade)) { $this->nm_limpa_alfa($this->prioridade); }
              if     (isset($NM_val_form) && isset($NM_val_form['situacao'])) { $this->situacao = $NM_val_form['situacao']; }
              elseif (isset($this->situacao)) { $this->nm_limpa_alfa($this->situacao); }
              if     (isset($NM_val_form) && isset($NM_val_form['observacoes'])) { $this->observacoes = $NM_val_form['observacoes']; }
              elseif (isset($this->observacoes)) { $this->nm_limpa_alfa($this->observacoes); }

              $this->nm_formatar_campos();

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('idcontrato', 'idcolaboradortarefa', 'descricao', 'idcolaborador', 'datainicio', 'dataprevisao', 'motivoprorrogacao', 'dataconclusao', 'prioridade', 'situacao', 'observacoes'), $aDoNotUpdate);
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "IdColaboradorTarefa, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(IdColaboradorTarefa) from " . $this->Ini->nm_tabela; 
          $comando = "select max(IdColaboradorTarefa) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  ColaboradorTarefa_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $this->idcolaboradortarefa_before_qstr = $this->idcolaboradortarefa = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      ColaboradorTarefa_Frm_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdTenacidade, IdColaborador, IdContrato, IdUsuarioAuditoria, Descricao, DataInicio, DataPrevisao, DataPrevisaoInicial, DataConclusao, Prioridade, Situacao, QtdAlteracaoData, Observacoes, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES ($this->idtenacidade, $this->idcolaborador, $this->idcontrato, $this->idusuarioauditoria, '$this->descricao', #$this->datainicio#, #$this->dataprevisao#, #$this->dataprevisaoinicial#, #$this->dataconclusao#, '$this->prioridade', '$this->situacao', $this->qtdalteracaodata, '$this->observacoes', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdColaborador, IdContrato, IdUsuarioAuditoria, Descricao, DataInicio, DataPrevisao, DataPrevisaoInicial, DataConclusao, Prioridade, Situacao, QtdAlteracaoData, Observacoes, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcolaborador, $this->idcontrato, $this->idusuarioauditoria, '$this->descricao', " . $this->Ini->date_delim . $this->datainicio . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisaoinicial . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataconclusao . $this->Ini->date_delim1 . ", '$this->prioridade', '$this->situacao', $this->qtdalteracaodata, '$this->observacoes', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdColaborador, IdContrato, IdUsuarioAuditoria, Descricao, DataInicio, DataPrevisao, DataPrevisaoInicial, DataConclusao, Prioridade, Situacao, QtdAlteracaoData, Observacoes, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcolaborador, $this->idcontrato, $this->idusuarioauditoria, '$this->descricao', " . $this->Ini->date_delim . $this->datainicio . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisaoinicial . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataconclusao . $this->Ini->date_delim1 . ", '$this->prioridade', '$this->situacao', $this->qtdalteracaodata, '$this->observacoes', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdTenacidade, IdColaborador, IdContrato, IdUsuarioAuditoria, Descricao, DataInicio, DataPrevisao, DataPrevisaoInicial, DataConclusao, Prioridade, Situacao, QtdAlteracaoData, Observacoes, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idtenacidade, $this->idcolaborador, $this->idcontrato, $this->idusuarioauditoria, '$this->descricao', " . $this->Ini->date_delim . $this->datainicio . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisao . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataprevisaoinicial . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->dataconclusao . $this->Ini->date_delim1 . ", '$this->prioridade', '$this->situacao', $this->qtdalteracaodata, '$this->observacoes', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
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
                              ColaboradorTarefa_Frm_pack_ajax_response();
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
                          ColaboradorTarefa_Frm_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->idcolaboradortarefa =  $rsy->fields[0];
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
                  $this->idcolaboradortarefa = $rsy->fields[0];
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
                  $this->idcolaboradortarefa = $rsy->fields[0];
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
                  $this->idcolaboradortarefa = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->descricao = $this->descricao_before_qstr;
              $this->prioridade = $this->prioridade_before_qstr;
              $this->situacao = $this->situacao_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->descricao = $this->descricao_before_qstr;
              $this->prioridade = $this->prioridade_before_qstr;
              $this->situacao = $this->situacao_before_qstr;
              $this->observacoes = $this->observacoes_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->nmgp_botoes['Auditoria'] = "on";
              $this->nmgp_botoes['sc_btn_0'] = "on";
              $this->return_after_insert();
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->idcolaboradortarefa = substr($this->Db->qstr($this->idcolaboradortarefa), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdColaboradorTarefa = $this->idcolaboradortarefa "); 
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
                          ColaboradorTarefa_Frm_pack_ajax_response();
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']);
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['parms'] = "idcolaboradortarefa?#?$this->idcolaboradortarefa?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idcolaboradortarefa = null === $this->idcolaboradortarefa ? null : substr($this->Db->qstr($this->idcolaboradortarefa), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter'] . ")";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdColaboradorTarefa, IdTenacidade, IdColaborador, IdContrato, IdUsuarioAuditoria, Descricao, DataInicio, DataPrevisao, DataPrevisaoInicial, DataConclusao, Prioridade, Situacao, QtdAlteracaoData, Observacoes, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "IdColaboradorTarefa = $this->idcolaboradortarefa"; 
              }  
              else  
              {
                  $aWhere[] = "IdColaboradorTarefa = $this->idcolaboradortarefa"; 
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
          $sc_order_by = "IdColaboradorTarefa";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "insert" || $this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['select'] = ""; 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter']))
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
                  $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter'] = true;
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
              $this->idcolaboradortarefa = $rs->fields[0] ; 
              $this->nmgp_dados_select['idcolaboradortarefa'] = $this->idcolaboradortarefa;
              $this->idtenacidade = $rs->fields[1] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idcolaborador = $rs->fields[2] ; 
              $this->nmgp_dados_select['idcolaborador'] = $this->idcolaborador;
              $this->idcontrato = $rs->fields[3] ; 
              $this->nmgp_dados_select['idcontrato'] = $this->idcontrato;
              $this->idusuarioauditoria = $rs->fields[4] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->descricao = $rs->fields[5] ; 
              $this->nmgp_dados_select['descricao'] = $this->descricao;
              $this->datainicio = $rs->fields[6] ; 
              if (substr($this->datainicio, 10, 1) == "-") 
              { 
                 $this->datainicio = substr($this->datainicio, 0, 10) . " " . substr($this->datainicio, 11);
              } 
              if (substr($this->datainicio, 13, 1) == ".") 
              { 
                 $this->datainicio = substr($this->datainicio, 0, 13) . ":" . substr($this->datainicio, 14, 2) . ":" . substr($this->datainicio, 17);
              } 
              $this->nmgp_dados_select['datainicio'] = $this->datainicio;
              $this->dataprevisao = $rs->fields[7] ; 
              if (substr($this->dataprevisao, 10, 1) == "-") 
              { 
                 $this->dataprevisao = substr($this->dataprevisao, 0, 10) . " " . substr($this->dataprevisao, 11);
              } 
              if (substr($this->dataprevisao, 13, 1) == ".") 
              { 
                 $this->dataprevisao = substr($this->dataprevisao, 0, 13) . ":" . substr($this->dataprevisao, 14, 2) . ":" . substr($this->dataprevisao, 17);
              } 
              $this->nmgp_dados_select['dataprevisao'] = $this->dataprevisao;
              $this->dataprevisaoinicial = $rs->fields[8] ; 
              if (substr($this->dataprevisaoinicial, 10, 1) == "-") 
              { 
                 $this->dataprevisaoinicial = substr($this->dataprevisaoinicial, 0, 10) . " " . substr($this->dataprevisaoinicial, 11);
              } 
              if (substr($this->dataprevisaoinicial, 13, 1) == ".") 
              { 
                 $this->dataprevisaoinicial = substr($this->dataprevisaoinicial, 0, 13) . ":" . substr($this->dataprevisaoinicial, 14, 2) . ":" . substr($this->dataprevisaoinicial, 17);
              } 
              $this->nmgp_dados_select['dataprevisaoinicial'] = $this->dataprevisaoinicial;
              $this->dataconclusao = $rs->fields[9] ; 
              if (substr($this->dataconclusao, 10, 1) == "-") 
              { 
                 $this->dataconclusao = substr($this->dataconclusao, 0, 10) . " " . substr($this->dataconclusao, 11);
              } 
              if (substr($this->dataconclusao, 13, 1) == ".") 
              { 
                 $this->dataconclusao = substr($this->dataconclusao, 0, 13) . ":" . substr($this->dataconclusao, 14, 2) . ":" . substr($this->dataconclusao, 17);
              } 
              $this->nmgp_dados_select['dataconclusao'] = $this->dataconclusao;
              $this->prioridade = $rs->fields[10] ; 
              $this->nmgp_dados_select['prioridade'] = $this->prioridade;
              $this->situacao = $rs->fields[11] ; 
              $this->nmgp_dados_select['situacao'] = $this->situacao;
              $this->qtdalteracaodata = $rs->fields[12] ; 
              $this->nmgp_dados_select['qtdalteracaodata'] = $this->qtdalteracaodata;
              $this->observacoes = $rs->fields[13] ; 
              $this->nmgp_dados_select['observacoes'] = $this->observacoes;
              $this->enderecoipauditoria = $rs->fields[14] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[15] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->idcolaboradortarefa = (string)$this->idcolaboradortarefa; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idcolaborador = (string)$this->idcolaborador; 
              $this->idcontrato = (string)$this->idcontrato; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->qtdalteracaodata = (string)$this->qtdalteracaodata; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['parms'] = "idcolaboradortarefa?#?$this->idcolaboradortarefa?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_select'] = $this->nmgp_dados_select;
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
              $this->idcolaboradortarefa = "";  
              $this->nmgp_dados_form["idcolaboradortarefa"] = $this->idcolaboradortarefa;
              $this->idtenacidade = "" . $_SESSION['varIdTenacidade'] . "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idcolaborador = "" . $_SESSION['varIdColaboradorSel'] . "";  
              $this->nmgp_dados_form["idcolaborador"] = $this->idcolaborador;
              $this->idcontrato = "";  
              $this->nmgp_dados_form["idcontrato"] = $this->idcontrato;
              $this->idusuarioauditoria = "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->descricao = "";  
              $this->nmgp_dados_form["descricao"] = $this->descricao;
              $this->datainicio =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->datainicio_hora =  date('H') . ":" . date('i') . ":" . date('s');
              $this->nmgp_dados_form["datainicio"] = $this->datainicio;
              $this->dataprevisao = "";  
              $this->dataprevisao_hora = "" ;  
              $this->nmgp_dados_form["dataprevisao"] = $this->dataprevisao;
              $this->dataprevisaoinicial = "";  
              $this->dataprevisaoinicial_hora = "" ;  
              $this->nmgp_dados_form["dataprevisaoinicial"] = $this->dataprevisaoinicial;
              $this->dataconclusao = "";  
              $this->dataconclusao_hora = "" ;  
              $this->nmgp_dados_form["dataconclusao"] = $this->dataconclusao;
              $this->prioridade = "";  
              $this->nmgp_dados_form["prioridade"] = $this->prioridade;
              $this->situacao = "P";  
              $this->nmgp_dados_form["situacao"] = $this->situacao;
              $this->qtdalteracaodata = "";  
              $this->nmgp_dados_form["qtdalteracaodata"] = $this->qtdalteracaodata;
              $this->observacoes = "";  
              $this->nmgp_dados_form["observacoes"] = $this->observacoes;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $this->motivoprorrogacao = "";  
              $this->nmgp_dados_form["motivoprorrogacao"] = $this->motivoprorrogacao;
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

/*----- Scriptcase Locale: Ajax Event DataPrevisao_onChange ------*/

function DataPrevisao_onChange()
{
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
  
$original_dataprevisao = $this->dataprevisao;
$original_motivoprorrogacao = $this->motivoprorrogacao;

if ($this->dataprevisao  != $this->dataprevisaoinicial ) {

	$this->nmgp_cmp_hidden["motivoprorrogacao"] = 'on'; $this->NM_ajax_info['fieldDisplay']['motivoprorrogacao'] = 'on';
		
}	

$modificado_dataprevisao = $this->dataprevisao;
$modificado_motivoprorrogacao = $this->motivoprorrogacao;
$this->nm_formatar_campos('dataprevisao', 'motivoprorrogacao');
if ($original_dataprevisao !== $modificado_dataprevisao || isset($this->nmgp_cmp_readonly['dataprevisao']) || (isset($bFlagRead_dataprevisao) && $bFlagRead_dataprevisao))
{
    $this->ajax_return_values_dataprevisao(true);
}
if ($original_motivoprorrogacao !== $modificado_motivoprorrogacao || isset($this->nmgp_cmp_readonly['motivoprorrogacao']) || (isset($bFlagRead_motivoprorrogacao) && $bFlagRead_motivoprorrogacao))
{
    $this->ajax_return_values_motivoprorrogacao(true);
}
$this->NM_ajax_info['event_field'] = 'DataPrevisao';
ColaboradorTarefa_Frm_pack_ajax_response();
exit;
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Ajax Event DataPrevisao_onChange ------*/


/*----- Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/

function Gravar_Tabela_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
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
                ColaboradorTarefa_Frm_pack_ajax_response();
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
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

function Preparar_LstFrm_OnSrip_OnLoad_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'on';
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
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Field_disabled_macro']['idtenacidade'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("idusuarioauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Field_disabled_macro']['idusuarioauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("enderecoipauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Field_disabled_macro']['enderecoipauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("nomeaplicacaoauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Field_disabled_macro']['nomeaplicacaoauditoria'] = array('I'=>array(),'U'=>array());
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
$_SESSION['scriptcase']['ColaboradorTarefa_Frm']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              ColaboradorTarefa_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("ColaboradorTarefa_Frm_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idcolaboradortarefa", "idcolaborador", "descricao", "situacao", "observacoes"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['csrf_token'];
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

   function Form_lookup_idcontrato()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'] = array(); 
    }

   $old_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $old_value_datainicio = $this->datainicio;
   $old_value_datainicio_hora = $this->datainicio_hora;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_dataprevisao_hora = $this->dataprevisao_hora;
   $old_value_dataconclusao = $this->dataconclusao;
   $old_value_dataconclusao_hora = $this->dataconclusao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $unformatted_value_datainicio = $this->datainicio;
   $unformatted_value_datainicio_hora = $this->datainicio_hora;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_dataprevisao_hora = $this->dataprevisao_hora;
   $unformatted_value_dataconclusao = $this->dataconclusao;
   $unformatted_value_dataconclusao_hora = $this->dataconclusao_hora;

   $nm_comando = "SELECT c.IdContrato, cl.NomeFantasia  FROM contrato c  INNER JOIN cliente cl ON (cl.IdCliente = c.IdCliente) WHERE c.IdTenacidade = " . $_SESSION['varIdTenacidade'] . " AND c.SituacaoContrato = 'A' AND c.DataFimImplantacao IS NULL ORDER BY c.IdCliente";

   $this->idcolaboradortarefa = $old_value_idcolaboradortarefa;
   $this->datainicio = $old_value_datainicio;
   $this->datainicio_hora = $old_value_datainicio_hora;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->dataprevisao_hora = $old_value_dataprevisao_hora;
   $this->dataconclusao = $old_value_dataconclusao;
   $this->dataconclusao_hora = $old_value_dataconclusao_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcontrato'][] = $rs->fields[0];
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
   function Form_lookup_idcolaborador()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'] = array(); 
    }

   $old_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $old_value_datainicio = $this->datainicio;
   $old_value_datainicio_hora = $this->datainicio_hora;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_dataprevisao_hora = $this->dataprevisao_hora;
   $old_value_dataconclusao = $this->dataconclusao;
   $old_value_dataconclusao_hora = $this->dataconclusao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $unformatted_value_datainicio = $this->datainicio;
   $unformatted_value_datainicio_hora = $this->datainicio_hora;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_dataprevisao_hora = $this->dataprevisao_hora;
   $unformatted_value_dataconclusao = $this->dataconclusao;
   $unformatted_value_dataconclusao_hora = $this->dataconclusao_hora;

   $nm_comando = "SELECT IdColaborador, Nome  FROM colaborador  WHERE     IdTenacidade = " . $_SESSION['varIdTenacidade'] . " AND Implanta = 'S' AND IdSituacaoColaborador = 1 ORDER BY Nome";

   $this->idcolaboradortarefa = $old_value_idcolaboradortarefa;
   $this->datainicio = $old_value_datainicio;
   $this->datainicio_hora = $old_value_datainicio_hora;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->dataprevisao_hora = $old_value_dataprevisao_hora;
   $this->dataconclusao = $old_value_dataconclusao;
   $this->dataconclusao_hora = $old_value_dataconclusao_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_idcolaborador'][] = $rs->fields[0];
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
   function Form_lookup_motivoprorrogacao()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'] = array(); 
    }

   $old_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $old_value_datainicio = $this->datainicio;
   $old_value_datainicio_hora = $this->datainicio_hora;
   $old_value_dataprevisao = $this->dataprevisao;
   $old_value_dataprevisao_hora = $this->dataprevisao_hora;
   $old_value_dataconclusao = $this->dataconclusao;
   $old_value_dataconclusao_hora = $this->dataconclusao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_idcolaboradortarefa = $this->idcolaboradortarefa;
   $unformatted_value_datainicio = $this->datainicio;
   $unformatted_value_datainicio_hora = $this->datainicio_hora;
   $unformatted_value_dataprevisao = $this->dataprevisao;
   $unformatted_value_dataprevisao_hora = $this->dataprevisao_hora;
   $unformatted_value_dataconclusao = $this->dataconclusao;
   $unformatted_value_dataconclusao_hora = $this->dataconclusao_hora;

   $nm_comando = "SELECT IdColaboradorTarefaMotivoProrrogacao, Nome  FROM colaboradortarefamotivoprorrogacao  WHERE IdTenacidade = " . $_SESSION['varIdTenacidade'] . " ORDER BY Nome";

   $this->idcolaboradortarefa = $old_value_idcolaboradortarefa;
   $this->datainicio = $old_value_datainicio;
   $this->datainicio_hora = $old_value_datainicio_hora;
   $this->dataprevisao = $old_value_dataprevisao;
   $this->dataprevisao_hora = $old_value_dataprevisao_hora;
   $this->dataconclusao = $old_value_dataconclusao;
   $this->dataconclusao_hora = $old_value_dataconclusao_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['Lookup_motivoprorrogacao'][] = $rs->fields[0];
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
   function Form_lookup_prioridade()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Alta?#?A?#?N?@?";
       $nmgp_def_dados .= "Média?#?M?#?N?@?";
       $nmgp_def_dados .= "Baixa?#?B?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_situacao()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Pendente?#?P?#?N?@?";
       $nmgp_def_dados .= "Concluída?#?C?#?N?@?";
       $nmgp_def_dados .= "Cancelada?#?X?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              ColaboradorTarefa_Frm_pack_ajax_response();
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
              $this->SC_monta_condicao($comando, "IdColaboradorTarefa", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idcolaborador($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdColaborador", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Descricao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_situacao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "Situacao", $arg_search, $data_lookup, "CHAR", false);
              }
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_ColaboradorTarefa_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total'] = $qt_geral_reg_ColaboradorTarefa_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          ColaboradorTarefa_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          ColaboradorTarefa_Frm_pack_ajax_response();
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
      $nm_numeric[] = "idcolaboradortarefa";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idcolaborador";$nm_numeric[] = "idcontrato";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "qtdalteracaodata";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['decimal_db'] == ".")
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
      $Nm_datas["datainicio"] = "datetime";$Nm_datas["dataprevisao"] = "datetime";$Nm_datas["dataprevisaoinicial"] = "datetime";$Nm_datas["dataconclusao"] = "datetime";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['SC_sep_date1'];
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
   function SC_lookup_idcolaborador($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       if (isset($this->Ini->nm_bases_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "eq" || $condicao == "qp" || $condicao == "np" || $condicao == "ii" || $condicao == "df"))
       {
           $nm_comando = "SELECT Nome, IdColaborador FROM colaborador WHERE (CAST (IdColaborador AS TEXT) LIKE '%$campo%') AND (IdTenacidade = " . $_SESSION['varIdTenacidade'] . ") AND (Implanta = 'S') AND (IdSituacaoColaborador = 1)" ; 
       }
       else
       {
           $nm_comando = "SELECT Nome, IdColaborador FROM colaborador WHERE (#cmp_iNome#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (IdTenacidade = " . $_SESSION['varIdTenacidade'] . ") AND (Implanta = 'S') AND (IdSituacaoColaborador = 1)" ; 
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
   function SC_lookup_situacao($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['P'] = "Pendente";
       $data_look['C'] = "Concluída";
       $data_look['X'] = "Cancelada";
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
       $nmgp_saida_form = "ColaboradorTarefa_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "ColaboradorTarefa_Frm_fim.php";
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
       ColaboradorTarefa_Frm_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           ColaboradorTarefa_Frm_pack_ajax_response();
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
       ColaboradorTarefa_Frm_pack_ajax_response();
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
        if ('datainicio' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('dataprevisao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('dataconclusao' == $sField)
        {
            $sFieldDateTime = $sField . '_hora';
        }
        if ('dataprevisaoinicial' == $sField)
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
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-4", "sc_b_sai_t.sc-unique-btn-6", "sc_b_sai_t.sc-unique-btn-5");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " Tarefa"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " Tarefa"; } ?></span></td>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['link_info']['compact_mode']) {
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['ColaboradorTarefa_Frm']['ordem_ord'] == " desc") {
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
            case "IdColaboradorTarefa":
                return true;
            case "IdTenacidade":
                return true;
            case "IdUsuarioAuditoria":
                return true;
            case "QtdAlteracaoData":
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
