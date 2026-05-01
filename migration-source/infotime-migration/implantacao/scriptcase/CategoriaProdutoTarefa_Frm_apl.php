<?php
//
class CategoriaProdutoTarefa_Frm_apl
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
   var $idcategoriaprodutotarefa;
   var $idcategoriaproduto;
   var $idcategoriaproduto_1;
   var $idtenacidade;
   var $idusuarioauditoria;
   var $classificador;
   var $codigotarefa;
   var $tipo;
   var $descricao;
   var $niveltarefa;
   var $prazohoras;
   var $notas;
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
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['classificador']))
          {
              $this->classificador = $this->NM_ajax_info['param']['classificador'];
          }
          if (isset($this->NM_ajax_info['param']['codigotarefa']))
          {
              $this->codigotarefa = $this->NM_ajax_info['param']['codigotarefa'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['descricao']))
          {
              $this->descricao = $this->NM_ajax_info['param']['descricao'];
          }
          if (isset($this->NM_ajax_info['param']['enderecoipauditoria']))
          {
              $this->enderecoipauditoria = $this->NM_ajax_info['param']['enderecoipauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['idcategoriaproduto']))
          {
              $this->idcategoriaproduto = $this->NM_ajax_info['param']['idcategoriaproduto'];
          }
          if (isset($this->NM_ajax_info['param']['idcategoriaprodutotarefa']))
          {
              $this->idcategoriaprodutotarefa = $this->NM_ajax_info['param']['idcategoriaprodutotarefa'];
          }
          if (isset($this->NM_ajax_info['param']['idtenacidade']))
          {
              $this->idtenacidade = $this->NM_ajax_info['param']['idtenacidade'];
          }
          if (isset($this->NM_ajax_info['param']['idusuarioauditoria']))
          {
              $this->idusuarioauditoria = $this->NM_ajax_info['param']['idusuarioauditoria'];
          }
          if (isset($this->NM_ajax_info['param']['niveltarefa']))
          {
              $this->niveltarefa = $this->NM_ajax_info['param']['niveltarefa'];
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
          if (isset($this->NM_ajax_info['param']['notas']))
          {
              $this->notas = $this->NM_ajax_info['param']['notas'];
          }
          if (isset($this->NM_ajax_info['param']['prazohoras']))
          {
              $this->prazohoras = $this->NM_ajax_info['param']['prazohoras'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['tipo']))
          {
              $this->tipo = $this->NM_ajax_info['param']['tipo'];
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
      if (isset($this->varIdUsuario) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varIdUsuario'] = $this->varIdUsuario;
      }
      if (isset($this->varPrimeiraVez) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
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
      if (isset($_POST["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_POST["varPrimeiraVez"]) && isset($_POST["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_POST["varprimeiravez"];
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
      if (isset($_GET["varPrimeiraVez"]) && isset($this->varPrimeiraVez)) 
      {
          $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
      }
      if (!isset($_GET["varPrimeiraVez"]) && isset($_GET["varprimeiravez"])) 
      {
          $_SESSION['varPrimeiraVez'] = $_GET["varprimeiravez"];
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['embutida_parms']);
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
                 nm_limpa_str_CategoriaProdutoTarefa_Frm($cadapar[1]);
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
              $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['opc_ant']);
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
          if (!isset($this->varPrimeiraVez) && isset($this->varprimeiravez)) 
          {
              $this->varPrimeiraVez = $this->varprimeiravez;
          }
          if (isset($this->varPrimeiraVez)) 
          {
              $_SESSION['varPrimeiraVez'] = $this->varPrimeiraVez;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new CategoriaProdutoTarefa_Frm_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['initialize'])
          {
              
/*----- Scriptcase Locale: Event onApplicationInit ------*/
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'on';
if (!isset($this->sc_temp_varIdUsuario)) {$this->sc_temp_varIdUsuario = (isset($_SESSION['varIdUsuario'])) ? $_SESSION['varIdUsuario'] : "";}
if (!isset($this->sc_temp_varIdTenacidade)) {$this->sc_temp_varIdTenacidade = (isset($_SESSION['varIdTenacidade'])) ? $_SESSION['varIdTenacidade'] : "";}
if (!isset($this->sc_temp_varPrimeiraVez)) {$this->sc_temp_varPrimeiraVez = (isset($_SESSION['varPrimeiraVez'])) ? $_SESSION['varPrimeiraVez'] : "";}
  $this->sc_temp_varPrimeiraVez = "";
$this->sc_temp_varIdTenacidade;
$this->sc_temp_varIdUsuario;
if (isset($this->sc_temp_varPrimeiraVez)) { $_SESSION['varPrimeiraVez'] = $this->sc_temp_varPrimeiraVez;}
if (isset($this->sc_temp_varIdTenacidade)) { $_SESSION['varIdTenacidade'] = $this->sc_temp_varIdTenacidade;}
if (isset($this->sc_temp_varIdUsuario)) { $_SESSION['varIdUsuario'] = $this->sc_temp_varIdUsuario;}
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'off';
/*----- END - Scriptcase Locale: Event onApplicationInit ------*/

          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['CategoriaProdutoTarefa_Frm']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['CategoriaProdutoTarefa_Frm']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['CategoriaProdutoTarefa_Frm'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['CategoriaProdutoTarefa_Frm']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['CategoriaProdutoTarefa_Frm']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('CategoriaProdutoTarefa_Frm') . "/CategoriaProdutoTarefa_Frm.php";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['CategoriaProdutoTarefa_Frm']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Tarefas";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "CategoriaProdutoTarefa_Frm")
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



      $_SESSION['scriptcase']['error_icon']['CategoriaProdutoTarefa_Frm']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['CategoriaProdutoTarefa_Frm'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "CategoriaProdutoTarefa_Frm.php"; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['goto']      = 'on';
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['CategoriaProdutoTarefa_Frm']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['CategoriaProdutoTarefa_Frm'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['CategoriaProdutoTarefa_Frm'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("CategoriaProdutoTarefa_Frm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'CategoriaProdutoTarefa_Frm_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'CategoriaProdutoTarefa_Frm_help.txt');
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
          require_once($this->Ini->path_embutida . 'CategoriaProdutoTarefa_Frm/CategoriaProdutoTarefa_Frm_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "CategoriaProdutoTarefa_Frm_erro.class.php"); 
      }
      $this->Erro      = new CategoriaProdutoTarefa_Frm_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao']))
         { 
             if ($this->idcategoriaprodutotarefa != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['CategoriaProdutoTarefa_Frm']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_form'];
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
                 if (isset($_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->idcategoriaprodutotarefa)) { $this->nm_limpa_alfa($this->idcategoriaprodutotarefa); }
      if (isset($this->idcategoriaproduto)) { $this->nm_limpa_alfa($this->idcategoriaproduto); }
      if (isset($this->idtenacidade)) { $this->nm_limpa_alfa($this->idtenacidade); }
      if (isset($this->idusuarioauditoria)) { $this->nm_limpa_alfa($this->idusuarioauditoria); }
      if (isset($this->classificador)) { $this->nm_limpa_alfa($this->classificador); }
      if (isset($this->codigotarefa)) { $this->nm_limpa_alfa($this->codigotarefa); }
      if (isset($this->tipo)) { $this->nm_limpa_alfa($this->tipo); }
      if (isset($this->descricao)) { $this->nm_limpa_alfa($this->descricao); }
      if (isset($this->niveltarefa)) { $this->nm_limpa_alfa($this->niveltarefa); }
      if (isset($this->prazohoras)) { $this->nm_limpa_alfa($this->prazohoras); }
      if (isset($this->enderecoipauditoria)) { $this->nm_limpa_alfa($this->enderecoipauditoria); }
      if (isset($this->nomeaplicacaoauditoria)) { $this->nm_limpa_alfa($this->nomeaplicacaoauditoria); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz . "CategoriaProdutoTarefa_Frm.php"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- idcategoriaprodutotarefa
      $this->field_config['idcategoriaprodutotarefa']               = array();
      $this->field_config['idcategoriaprodutotarefa']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['idcategoriaprodutotarefa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['idcategoriaprodutotarefa']['symbol_dec'] = '';
      $this->field_config['idcategoriaprodutotarefa']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['idcategoriaprodutotarefa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- classificador
      $this->field_config['classificador']               = array();
      $this->field_config['classificador']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['classificador']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['classificador']['symbol_dec'] = '';
      $this->field_config['classificador']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['classificador']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- niveltarefa
      $this->field_config['niveltarefa']               = array();
      $this->field_config['niveltarefa']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['niveltarefa']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['niveltarefa']['symbol_dec'] = '';
      $this->field_config['niveltarefa']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['niveltarefa']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- prazohoras
      $this->field_config['prazohoras']               = array();
      $this->field_config['prazohoras']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['prazohoras']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['prazohoras']['symbol_dec'] = '';
      $this->field_config['prazohoras']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['prazohoras']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
          if ('validate_idcategoriaproduto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcategoriaproduto');
          }
          if ('validate_descricao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'descricao');
          }
          if ('validate_idcategoriaprodutotarefa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'idcategoriaprodutotarefa');
          }
          if ('validate_classificador' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'classificador');
          }
          if ('validate_codigotarefa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'codigotarefa');
          }
          if ('validate_tipo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tipo');
          }
          if ('validate_niveltarefa' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'niveltarefa');
          }
          if ('validate_prazohoras' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'prazohoras');
          }
          if ('validate_notas' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'notas');
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
          CategoriaProdutoTarefa_Frm_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
          $_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_redir_atualiz'] == "ok")
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
          CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
          CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "CategoriaProdutoTarefa_Frm.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Tarefas") ?></TITLE>
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
<form name="Fdown" method="get" action="CategoriaProdutoTarefa_Frm_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="CategoriaProdutoTarefa_Frm"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="CategoriaProdutoTarefa_Frm.php" target="_self" style="display: none"> 
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
           case 'idcategoriaproduto':
               return "Produto";
               break;
           case 'descricao':
               return "Descrição";
               break;
           case 'idcategoriaprodutotarefa':
               return "Id.";
               break;
           case 'classificador':
               return "Classificador";
               break;
           case 'codigotarefa':
               return "Código";
               break;
           case 'tipo':
               return "Tipo";
               break;
           case 'niveltarefa':
               return "Nível";
               break;
           case 'prazohoras':
               return "Prazo (horas)";
               break;
           case 'notas':
               return "Notas";
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
               return "Nome aplicação";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_CategoriaProdutoTarefa_Frm']) || !is_array($this->NM_ajax_info['errList']['geral_CategoriaProdutoTarefa_Frm']))
              {
                  $this->NM_ajax_info['errList']['geral_CategoriaProdutoTarefa_Frm'] = array();
              }
              $this->NM_ajax_info['errList']['geral_CategoriaProdutoTarefa_Frm'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'idcategoriaproduto' == $filtro)) || (is_array($filtro) && in_array('idcategoriaproduto', $filtro)))
        $this->ValidateField_idcategoriaproduto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idcategoriaproduto";

      if ((!is_array($filtro) && ('' == $filtro || 'descricao' == $filtro)) || (is_array($filtro) && in_array('descricao', $filtro)))
        $this->ValidateField_descricao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "descricao";

      if ((!is_array($filtro) && ('' == $filtro || 'idcategoriaprodutotarefa' == $filtro)) || (is_array($filtro) && in_array('idcategoriaprodutotarefa', $filtro)))
        $this->ValidateField_idcategoriaprodutotarefa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "idcategoriaprodutotarefa";

      if ((!is_array($filtro) && ('' == $filtro || 'classificador' == $filtro)) || (is_array($filtro) && in_array('classificador', $filtro)))
        $this->ValidateField_classificador($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "classificador";

      if ((!is_array($filtro) && ('' == $filtro || 'codigotarefa' == $filtro)) || (is_array($filtro) && in_array('codigotarefa', $filtro)))
        $this->ValidateField_codigotarefa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "codigotarefa";

      if ((!is_array($filtro) && ('' == $filtro || 'tipo' == $filtro)) || (is_array($filtro) && in_array('tipo', $filtro)))
        $this->ValidateField_tipo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tipo";

      if ((!is_array($filtro) && ('' == $filtro || 'niveltarefa' == $filtro)) || (is_array($filtro) && in_array('niveltarefa', $filtro)))
        $this->ValidateField_niveltarefa($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "niveltarefa";

      if ((!is_array($filtro) && ('' == $filtro || 'prazohoras' == $filtro)) || (is_array($filtro) && in_array('prazohoras', $filtro)))
        $this->ValidateField_prazohoras($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "prazohoras";

      if ((!is_array($filtro) && ('' == $filtro || 'notas' == $filtro)) || (is_array($filtro) && in_array('notas', $filtro)))
        $this->ValidateField_notas($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName) && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "notas";

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

    function ValidateField_idcategoriaproduto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['idcategoriaproduto'])) {
       return;
   }
      if ($this->idcategoriaproduto == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['php_cmp_required']['idcategoriaproduto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['php_cmp_required']['idcategoriaproduto'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Produto" ; 
          if (!isset($Campos_Erros['idcategoriaproduto']))
          {
              $Campos_Erros['idcategoriaproduto'] = array();
          }
          $Campos_Erros['idcategoriaproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['idcategoriaproduto']) || !is_array($this->NM_ajax_info['errList']['idcategoriaproduto']))
          {
              $this->NM_ajax_info['errList']['idcategoriaproduto'] = array();
          }
          $this->NM_ajax_info['errList']['idcategoriaproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->idcategoriaproduto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']) && !in_array($this->idcategoriaproduto, $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['idcategoriaproduto']))
              {
                  $Campos_Erros['idcategoriaproduto'] = array();
              }
              $Campos_Erros['idcategoriaproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['idcategoriaproduto']) || !is_array($this->NM_ajax_info['errList']['idcategoriaproduto']))
              {
                  $this->NM_ajax_info['errList']['idcategoriaproduto'] = array();
              }
              $this->NM_ajax_info['errList']['idcategoriaproduto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcategoriaproduto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcategoriaproduto

    function ValidateField_descricao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['descricao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['php_cmp_required']['descricao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['php_cmp_required']['descricao'] == "on")) 
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

    function ValidateField_idcategoriaprodutotarefa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['idcategoriaprodutotarefa'])) {
          nm_limpa_numero($this->idcategoriaprodutotarefa, $this->field_config['idcategoriaprodutotarefa']['symbol_grp']) ; 
          return;
      }
      if ($this->idcategoriaprodutotarefa === "" || is_null($this->idcategoriaprodutotarefa))  
      { 
          $this->idcategoriaprodutotarefa = 0;
      } 
      nm_limpa_numero($this->idcategoriaprodutotarefa, $this->field_config['idcategoriaprodutotarefa']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_idcategoriaprodutotarefa' == $this->NM_ajax_opcao)
      { 
          if ($this->idcategoriaprodutotarefa != '')  
          { 
              $iTestSize = 19;
              if (strlen($this->idcategoriaprodutotarefa) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['idcategoriaprodutotarefa']))
                  {
                      $Campos_Erros['idcategoriaprodutotarefa'] = array();
                  }
                  $Campos_Erros['idcategoriaprodutotarefa'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['idcategoriaprodutotarefa']) || !is_array($this->NM_ajax_info['errList']['idcategoriaprodutotarefa']))
                  {
                      $this->NM_ajax_info['errList']['idcategoriaprodutotarefa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcategoriaprodutotarefa'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->idcategoriaprodutotarefa, 19, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id.; " ; 
                  if (!isset($Campos_Erros['idcategoriaprodutotarefa']))
                  {
                      $Campos_Erros['idcategoriaprodutotarefa'] = array();
                  }
                  $Campos_Erros['idcategoriaprodutotarefa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['idcategoriaprodutotarefa']) || !is_array($this->NM_ajax_info['errList']['idcategoriaprodutotarefa']))
                  {
                      $this->NM_ajax_info['errList']['idcategoriaprodutotarefa'] = array();
                  }
                  $this->NM_ajax_info['errList']['idcategoriaprodutotarefa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'idcategoriaprodutotarefa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_idcategoriaprodutotarefa

    function ValidateField_classificador(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['classificador'])) {
          nm_limpa_numero($this->classificador, $this->field_config['classificador']['symbol_grp']) ; 
          return;
      }
      if ($this->classificador === "" || is_null($this->classificador))  
      { 
          $this->classificador = 0;
          $this->sc_force_zero[] = 'classificador';
      } 
      nm_limpa_numero($this->classificador, $this->field_config['classificador']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->classificador != '')  
          { 
              $iTestSize = 10;
              if (strlen($this->classificador) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Classificador: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['classificador']))
                  {
                      $Campos_Erros['classificador'] = array();
                  }
                  $Campos_Erros['classificador'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['classificador']) || !is_array($this->NM_ajax_info['errList']['classificador']))
                  {
                      $this->NM_ajax_info['errList']['classificador'] = array();
                  }
                  $this->NM_ajax_info['errList']['classificador'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->classificador, 10, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Classificador; " ; 
                  if (!isset($Campos_Erros['classificador']))
                  {
                      $Campos_Erros['classificador'] = array();
                  }
                  $Campos_Erros['classificador'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['classificador']) || !is_array($this->NM_ajax_info['errList']['classificador']))
                  {
                      $this->NM_ajax_info['errList']['classificador'] = array();
                  }
                  $this->NM_ajax_info['errList']['classificador'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'classificador';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_classificador

    function ValidateField_codigotarefa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['codigotarefa'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->codigotarefa) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Código " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['codigotarefa']))
              {
                  $Campos_Erros['codigotarefa'] = array();
              }
              $Campos_Erros['codigotarefa'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['codigotarefa']) || !is_array($this->NM_ajax_info['errList']['codigotarefa']))
              {
                  $this->NM_ajax_info['errList']['codigotarefa'] = array();
              }
              $this->NM_ajax_info['errList']['codigotarefa'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'codigotarefa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_codigotarefa

    function ValidateField_tipo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['tipo'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tipo) > 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Tipo " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tipo']))
              {
                  $Campos_Erros['tipo'] = array();
              }
              $Campos_Erros['tipo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tipo']) || !is_array($this->NM_ajax_info['errList']['tipo']))
              {
                  $this->NM_ajax_info['errList']['tipo'] = array();
              }
              $this->NM_ajax_info['errList']['tipo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'tipo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_tipo

    function ValidateField_niveltarefa(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['niveltarefa'])) {
          nm_limpa_numero($this->niveltarefa, $this->field_config['niveltarefa']['symbol_grp']) ; 
          return;
      }
      if ($this->niveltarefa === "" || is_null($this->niveltarefa))  
      { 
          $this->niveltarefa = 0;
          $this->sc_force_zero[] = 'niveltarefa';
      } 
      nm_limpa_numero($this->niveltarefa, $this->field_config['niveltarefa']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->niveltarefa != '')  
          { 
              $iTestSize = 10;
              if (strlen($this->niveltarefa) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nível: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['niveltarefa']))
                  {
                      $Campos_Erros['niveltarefa'] = array();
                  }
                  $Campos_Erros['niveltarefa'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['niveltarefa']) || !is_array($this->NM_ajax_info['errList']['niveltarefa']))
                  {
                      $this->NM_ajax_info['errList']['niveltarefa'] = array();
                  }
                  $this->NM_ajax_info['errList']['niveltarefa'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->niveltarefa, 10, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Nível; " ; 
                  if (!isset($Campos_Erros['niveltarefa']))
                  {
                      $Campos_Erros['niveltarefa'] = array();
                  }
                  $Campos_Erros['niveltarefa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['niveltarefa']) || !is_array($this->NM_ajax_info['errList']['niveltarefa']))
                  {
                      $this->NM_ajax_info['errList']['niveltarefa'] = array();
                  }
                  $this->NM_ajax_info['errList']['niveltarefa'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'niveltarefa';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_niveltarefa

    function ValidateField_prazohoras(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['prazohoras'])) {
          nm_limpa_numero($this->prazohoras, $this->field_config['prazohoras']['symbol_grp']) ; 
          return;
      }
      if ($this->prazohoras === "" || is_null($this->prazohoras))  
      { 
          $this->prazohoras = 0;
          $this->sc_force_zero[] = 'prazohoras';
      } 
      nm_limpa_numero($this->prazohoras, $this->field_config['prazohoras']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->prazohoras != '')  
          { 
              $iTestSize = 10;
              if (strlen($this->prazohoras) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Prazo (horas): " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['prazohoras']))
                  {
                      $Campos_Erros['prazohoras'] = array();
                  }
                  $Campos_Erros['prazohoras'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['prazohoras']) || !is_array($this->NM_ajax_info['errList']['prazohoras']))
                  {
                      $this->NM_ajax_info['errList']['prazohoras'] = array();
                  }
                  $this->NM_ajax_info['errList']['prazohoras'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->prazohoras, 10, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Prazo (horas); " ; 
                  if (!isset($Campos_Erros['prazohoras']))
                  {
                      $Campos_Erros['prazohoras'] = array();
                  }
                  $Campos_Erros['prazohoras'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['prazohoras']) || !is_array($this->NM_ajax_info['errList']['prazohoras']))
                  {
                      $this->NM_ajax_info['errList']['prazohoras'] = array();
                  }
                  $this->NM_ajax_info['errList']['prazohoras'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'prazohoras';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_prazohoras

    function ValidateField_notas(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['notas'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->notas) > 32767) 
          { 
              $hasError = true;
              $Campos_Crit .= "Notas " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['notas']))
              {
                  $Campos_Erros['notas'] = array();
              }
              $Campos_Erros['notas'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['notas']) || !is_array($this->NM_ajax_info['errList']['notas']))
              {
                  $this->NM_ajax_info['errList']['notas'] = array();
              }
              $this->NM_ajax_info['errList']['notas'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'notas';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_notas

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
      if ($this->nmgp_opcao != "excluir") 
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
      if ($this->nmgp_opcao != "excluir") 
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
      if ($this->nmgp_opcao != "excluir") 
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
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->nomeaplicacaoauditoria) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nome aplicação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
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
    $this->nmgp_dados_form['idcategoriaproduto'] = $this->idcategoriaproduto;
    $this->nmgp_dados_form['descricao'] = $this->descricao;
    $this->nmgp_dados_form['idcategoriaprodutotarefa'] = $this->idcategoriaprodutotarefa;
    $this->nmgp_dados_form['classificador'] = $this->classificador;
    $this->nmgp_dados_form['codigotarefa'] = $this->codigotarefa;
    $this->nmgp_dados_form['tipo'] = $this->tipo;
    $this->nmgp_dados_form['niveltarefa'] = $this->niveltarefa;
    $this->nmgp_dados_form['prazohoras'] = $this->prazohoras;
    $this->nmgp_dados_form['notas'] = $this->notas;
    $this->nmgp_dados_form['idtenacidade'] = $this->idtenacidade;
    $this->nmgp_dados_form['idusuarioauditoria'] = $this->idusuarioauditoria;
    $this->nmgp_dados_form['enderecoipauditoria'] = $this->enderecoipauditoria;
    $this->nmgp_dados_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
    $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['idcategoriaprodutotarefa'] = $this->idcategoriaprodutotarefa;
      nm_limpa_numero($this->idcategoriaprodutotarefa, $this->field_config['idcategoriaprodutotarefa']['symbol_grp']) ; 
      $this->Before_unformat['classificador'] = $this->classificador;
      nm_limpa_numero($this->classificador, $this->field_config['classificador']['symbol_grp']) ; 
      $this->Before_unformat['niveltarefa'] = $this->niveltarefa;
      nm_limpa_numero($this->niveltarefa, $this->field_config['niveltarefa']['symbol_grp']) ; 
      $this->Before_unformat['prazohoras'] = $this->prazohoras;
      nm_limpa_numero($this->prazohoras, $this->field_config['prazohoras']['symbol_grp']) ; 
      $this->Before_unformat['idtenacidade'] = $this->idtenacidade;
      nm_limpa_numero($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp']) ; 
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
      if ($Nome_Campo == "idcategoriaprodutotarefa")
      {
          nm_limpa_numero($this->idcategoriaprodutotarefa, $this->field_config['idcategoriaprodutotarefa']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "classificador")
      {
          nm_limpa_numero($this->classificador, $this->field_config['classificador']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "niveltarefa")
      {
          nm_limpa_numero($this->niveltarefa, $this->field_config['niveltarefa']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "prazohoras")
      {
          nm_limpa_numero($this->prazohoras, $this->field_config['prazohoras']['symbol_grp']) ; 
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
      if ('' !== $this->idcategoriaprodutotarefa || (!empty($format_fields) && isset($format_fields['idcategoriaprodutotarefa'])))
      {
          nmgp_Form_Num_Val($this->idcategoriaprodutotarefa, $this->field_config['idcategoriaprodutotarefa']['symbol_grp'], $this->field_config['idcategoriaprodutotarefa']['symbol_dec'], "0", "S", $this->field_config['idcategoriaprodutotarefa']['format_neg'], "", "", "-", $this->field_config['idcategoriaprodutotarefa']['symbol_fmt']) ; 
      }
      if ('' !== $this->classificador || (!empty($format_fields) && isset($format_fields['classificador'])))
      {
          nmgp_Form_Num_Val($this->classificador, $this->field_config['classificador']['symbol_grp'], $this->field_config['classificador']['symbol_dec'], "0", "S", $this->field_config['classificador']['format_neg'], "", "", "-", $this->field_config['classificador']['symbol_fmt']) ; 
      }
      if ('' !== $this->niveltarefa || (!empty($format_fields) && isset($format_fields['niveltarefa'])))
      {
          nmgp_Form_Num_Val($this->niveltarefa, $this->field_config['niveltarefa']['symbol_grp'], $this->field_config['niveltarefa']['symbol_dec'], "0", "S", $this->field_config['niveltarefa']['format_neg'], "", "", "-", $this->field_config['niveltarefa']['symbol_fmt']) ; 
      }
      if ('' !== $this->prazohoras || (!empty($format_fields) && isset($format_fields['prazohoras'])))
      {
          nmgp_Form_Num_Val($this->prazohoras, $this->field_config['prazohoras']['symbol_grp'], $this->field_config['prazohoras']['symbol_dec'], "0", "S", $this->field_config['prazohoras']['format_neg'], "", "", "-", $this->field_config['prazohoras']['symbol_fmt']) ; 
      }
      if ('' !== $this->idtenacidade || (!empty($format_fields) && isset($format_fields['idtenacidade'])))
      {
          nmgp_Form_Num_Val($this->idtenacidade, $this->field_config['idtenacidade']['symbol_grp'], $this->field_config['idtenacidade']['symbol_dec'], "0", "S", $this->field_config['idtenacidade']['format_neg'], "", "", "-", $this->field_config['idtenacidade']['symbol_fmt']) ; 
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
          $this->ajax_return_values_idcategoriaproduto();
          $this->ajax_return_values_descricao();
          $this->ajax_return_values_idcategoriaprodutotarefa();
          $this->ajax_return_values_classificador();
          $this->ajax_return_values_codigotarefa();
          $this->ajax_return_values_tipo();
          $this->ajax_return_values_niveltarefa();
          $this->ajax_return_values_prazohoras();
          $this->ajax_return_values_notas();
          $this->ajax_return_values_idtenacidade();
          $this->ajax_return_values_idusuarioauditoria();
          $this->ajax_return_values_enderecoipauditoria();
          $this->ajax_return_values_nomeaplicacaoauditoria();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['idcategoriaprodutotarefa']['keyVal'] = CategoriaProdutoTarefa_Frm_pack_protect_string($this->nmgp_dados_form['idcategoriaprodutotarefa']);
          }
   } // ajax_return_values

          //----- idcategoriaproduto
   function ajax_return_values_idcategoriaproduto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcategoriaproduto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcategoriaproduto);
              $aLookup = array();
              $this->_tmp_lookup_idcategoriaproduto = $this->idcategoriaproduto;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'] = array(); 
}
$aLookup[] = array(CategoriaProdutoTarefa_Frm_pack_protect_string('') => str_replace('<', '&lt;',CategoriaProdutoTarefa_Frm_pack_protect_string('Selecione...')));
$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_idcategoriaprodutotarefa = $this->idcategoriaprodutotarefa;
   $old_value_classificador = $this->classificador;
   $old_value_niveltarefa = $this->niveltarefa;
   $old_value_prazohoras = $this->prazohoras;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();


   $unformatted_value_idcategoriaprodutotarefa = $this->idcategoriaprodutotarefa;
   $unformatted_value_classificador = $this->classificador;
   $unformatted_value_niveltarefa = $this->niveltarefa;
   $unformatted_value_prazohoras = $this->prazohoras;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT IdProduto, Descricao  FROM produto  ORDER BY Descricao";

   $this->idcategoriaprodutotarefa = $old_value_idcategoriaprodutotarefa;
   $this->classificador = $old_value_classificador;
   $this->niveltarefa = $old_value_niveltarefa;
   $this->prazohoras = $old_value_prazohoras;
   $this->idtenacidade = $old_value_idtenacidade;
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
              $aLookup[] = array(CategoriaProdutoTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', CategoriaProdutoTarefa_Frm_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'][] = $rs->fields[0];
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
          $sSelComp = "name=\"idcategoriaproduto\"";
          if (isset($this->NM_ajax_info['select_html']['idcategoriaproduto']) && !empty($this->NM_ajax_info['select_html']['idcategoriaproduto']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['idcategoriaproduto']);
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

                  if ($this->idcategoriaproduto == $sValue)
                  {
                      $this->_tmp_lookup_idcategoriaproduto = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['idcategoriaproduto'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['idcategoriaproduto']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['idcategoriaproduto']['valList'][$i] = CategoriaProdutoTarefa_Frm_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['idcategoriaproduto']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['idcategoriaproduto']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['idcategoriaproduto']['labList'] = $aLabel;
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

          //----- idcategoriaprodutotarefa
   function ajax_return_values_idcategoriaprodutotarefa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("idcategoriaprodutotarefa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->idcategoriaprodutotarefa);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['idcategoriaprodutotarefa'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("idcategoriaprodutotarefa", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- classificador
   function ajax_return_values_classificador($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("classificador", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->classificador);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['classificador'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- codigotarefa
   function ajax_return_values_codigotarefa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("codigotarefa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->codigotarefa);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['codigotarefa'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tipo
   function ajax_return_values_tipo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tipo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tipo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tipo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- niveltarefa
   function ajax_return_values_niveltarefa($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("niveltarefa", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->niveltarefa);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['niveltarefa'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- prazohoras
   function ajax_return_values_prazohoras($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("prazohoras", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->prazohoras);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['prazohoras'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- notas
   function ajax_return_values_notas($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("notas", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->notas);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['notas'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
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
               'type'    => 'text',
               'valList' => array($sTmpValue),
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
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      
/*----- Scriptcase Locale: Event onLoad ------*/
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'on';
  $this->Preparar_LstFrm_OnSrip_OnLoad_Auditoria($this->Ini->nm_cod_apl, $this->idcategoriaprodutotarefa );
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'off';
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
//----------- 

   function controle_navegacao()
   {
      global $sc_where;

          if (false && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']))
          {
               $sc_where_pos = " WHERE ((IdCategoriaProdutoTarefa < $this->idcategoriaprodutotarefa))";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total'] = $rsc->fields[0];
               $rsc->Close(); 
               if ('' != $this->idcategoriaprodutotarefa)
               {
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = $rsc->fields[0];
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] < 0)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = 0;
               }
               $rsc->Close(); 
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = 0;
               }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['qt_reg_grid'] = 1;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['final']  = 0;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] = $this->NM_ajax_info['param']['nmgp_opcao'];
          if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'], array('incluir', 'alterar', 'excluir')))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] = '';
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] == 'inicio')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = 0;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] == 'retorna')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = 0 ;
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] == 'avanca' && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']) || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total'] > $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['final']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['final'];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] == 'final')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] = 0;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['final'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['qt_reg_grid'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['final'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opcao'] = '';

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
      $NM_val_form['idcategoriaproduto'] = $this->idcategoriaproduto;
      $NM_val_form['descricao'] = $this->descricao;
      $NM_val_form['idcategoriaprodutotarefa'] = $this->idcategoriaprodutotarefa;
      $NM_val_form['classificador'] = $this->classificador;
      $NM_val_form['codigotarefa'] = $this->codigotarefa;
      $NM_val_form['tipo'] = $this->tipo;
      $NM_val_form['niveltarefa'] = $this->niveltarefa;
      $NM_val_form['prazohoras'] = $this->prazohoras;
      $NM_val_form['notas'] = $this->notas;
      $NM_val_form['idtenacidade'] = $this->idtenacidade;
      $NM_val_form['idusuarioauditoria'] = $this->idusuarioauditoria;
      $NM_val_form['enderecoipauditoria'] = $this->enderecoipauditoria;
      $NM_val_form['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
      if ($this->idcategoriaprodutotarefa === "" || is_null($this->idcategoriaprodutotarefa))  
      { 
          $this->idcategoriaprodutotarefa = 0;
      } 
      if ($this->idcategoriaproduto === "" || is_null($this->idcategoriaproduto))  
      { 
          $this->idcategoriaproduto = 0;
          $this->sc_force_zero[] = 'idcategoriaproduto';
      } 
      if ($this->idtenacidade === "" || is_null($this->idtenacidade))  
      { 
          $this->idtenacidade = 0;
          $this->sc_force_zero[] = 'idtenacidade';
      } 
      if ($this->idusuarioauditoria === "" || is_null($this->idusuarioauditoria))  
      { 
          $this->idusuarioauditoria = 0;
          $this->sc_force_zero[] = 'idusuarioauditoria';
      } 
      if ($this->classificador === "" || is_null($this->classificador))  
      { 
          $this->classificador = 0;
          $this->sc_force_zero[] = 'classificador';
      } 
      if ($this->niveltarefa === "" || is_null($this->niveltarefa))  
      { 
          $this->niveltarefa = 0;
          $this->sc_force_zero[] = 'niveltarefa';
      } 
      if ($this->prazohoras === "" || is_null($this->prazohoras))  
      { 
          $this->prazohoras = 0;
          $this->sc_force_zero[] = 'prazohoras';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_ibase, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite);
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->codigotarefa_before_qstr = $this->codigotarefa;
          $this->codigotarefa = substr($this->Db->qstr($this->codigotarefa), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->codigotarefa = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->codigotarefa);
          }
          if ($this->codigotarefa == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->codigotarefa = "null"; 
              $this->NM_val_null[] = "codigotarefa";
          } 
          $this->tipo_before_qstr = $this->tipo;
          $this->tipo = substr($this->Db->qstr($this->tipo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tipo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->tipo);
          }
          if ($this->tipo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tipo = "null"; 
              $this->NM_val_null[] = "tipo";
          } 
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
          $this->notas_before_qstr = $this->notas;
          $this->notas = substr($this->Db->qstr($this->notas), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->notas = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->notas);
          }
          if ($this->notas == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->notas = "null"; 
              $this->NM_val_null[] = "notas";
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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
                  $SC_fields_update[] = "IdCategoriaProduto = $this->idcategoriaproduto, IdTenacidade = $this->idtenacidade, IdUsuarioAuditoria = $this->idusuarioauditoria, Classificador = $this->classificador, CodigoTarefa = '$this->codigotarefa', Tipo = '$this->tipo', Descricao = '$this->descricao', NivelTarefa = $this->niveltarefa, PrazoHoras = $this->prazohoras, Notas = '$this->notas', EnderecoIpAuditoria = '$this->enderecoipauditoria', NomeAplicacaoAuditoria = '$this->nomeaplicacaoauditoria'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCategoriaProduto = $this->idcategoriaproduto, IdTenacidade = $this->idtenacidade, IdUsuarioAuditoria = $this->idusuarioauditoria, Classificador = $this->classificador, CodigoTarefa = '$this->codigotarefa', Tipo = '$this->tipo', Descricao = '$this->descricao', NivelTarefa = $this->niveltarefa, PrazoHoras = $this->prazohoras, Notas = '$this->notas', EnderecoIpAuditoria = '$this->enderecoipauditoria', NomeAplicacaoAuditoria = '$this->nomeaplicacaoauditoria'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCategoriaProduto = $this->idcategoriaproduto, IdTenacidade = $this->idtenacidade, IdUsuarioAuditoria = $this->idusuarioauditoria, Classificador = $this->classificador, CodigoTarefa = '$this->codigotarefa', Tipo = '$this->tipo', Descricao = '$this->descricao', NivelTarefa = $this->niveltarefa, PrazoHoras = $this->prazohoras, Notas = '$this->notas', EnderecoIpAuditoria = '$this->enderecoipauditoria', NomeAplicacaoAuditoria = '$this->nomeaplicacaoauditoria'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "IdCategoriaProduto = $this->idcategoriaproduto, IdTenacidade = $this->idtenacidade, IdUsuarioAuditoria = $this->idusuarioauditoria, Classificador = $this->classificador, CodigoTarefa = '$this->codigotarefa', Tipo = '$this->tipo', Descricao = '$this->descricao', NivelTarefa = $this->niveltarefa, PrazoHoras = $this->prazohoras, Notas = '$this->notas', EnderecoIpAuditoria = '$this->enderecoipauditoria', NomeAplicacaoAuditoria = '$this->nomeaplicacaoauditoria'"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa ";  
              }  
              else  
              {
                  $comando .= " WHERE IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa ";  
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
                                  CategoriaProdutoTarefa_Frm_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->codigotarefa = $this->codigotarefa_before_qstr;
              $this->tipo = $this->tipo_before_qstr;
              $this->descricao = $this->descricao_before_qstr;
              $this->notas = $this->notas_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['idcategoriaprodutotarefa'])) { $this->idcategoriaprodutotarefa = $NM_val_form['idcategoriaprodutotarefa']; }
              elseif (isset($this->idcategoriaprodutotarefa)) { $this->nm_limpa_alfa($this->idcategoriaprodutotarefa); }
              if     (isset($NM_val_form) && isset($NM_val_form['idcategoriaproduto'])) { $this->idcategoriaproduto = $NM_val_form['idcategoriaproduto']; }
              elseif (isset($this->idcategoriaproduto)) { $this->nm_limpa_alfa($this->idcategoriaproduto); }
              if     (isset($NM_val_form) && isset($NM_val_form['idtenacidade'])) { $this->idtenacidade = $NM_val_form['idtenacidade']; }
              elseif (isset($this->idtenacidade)) { $this->nm_limpa_alfa($this->idtenacidade); }
              if     (isset($NM_val_form) && isset($NM_val_form['idusuarioauditoria'])) { $this->idusuarioauditoria = $NM_val_form['idusuarioauditoria']; }
              elseif (isset($this->idusuarioauditoria)) { $this->nm_limpa_alfa($this->idusuarioauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['classificador'])) { $this->classificador = $NM_val_form['classificador']; }
              elseif (isset($this->classificador)) { $this->nm_limpa_alfa($this->classificador); }
              if     (isset($NM_val_form) && isset($NM_val_form['codigotarefa'])) { $this->codigotarefa = $NM_val_form['codigotarefa']; }
              elseif (isset($this->codigotarefa)) { $this->nm_limpa_alfa($this->codigotarefa); }
              if     (isset($NM_val_form) && isset($NM_val_form['tipo'])) { $this->tipo = $NM_val_form['tipo']; }
              elseif (isset($this->tipo)) { $this->nm_limpa_alfa($this->tipo); }
              if     (isset($NM_val_form) && isset($NM_val_form['descricao'])) { $this->descricao = $NM_val_form['descricao']; }
              elseif (isset($this->descricao)) { $this->nm_limpa_alfa($this->descricao); }
              if     (isset($NM_val_form) && isset($NM_val_form['niveltarefa'])) { $this->niveltarefa = $NM_val_form['niveltarefa']; }
              elseif (isset($this->niveltarefa)) { $this->nm_limpa_alfa($this->niveltarefa); }
              if     (isset($NM_val_form) && isset($NM_val_form['prazohoras'])) { $this->prazohoras = $NM_val_form['prazohoras']; }
              elseif (isset($this->prazohoras)) { $this->nm_limpa_alfa($this->prazohoras); }
              if     (isset($NM_val_form) && isset($NM_val_form['enderecoipauditoria'])) { $this->enderecoipauditoria = $NM_val_form['enderecoipauditoria']; }
              elseif (isset($this->enderecoipauditoria)) { $this->nm_limpa_alfa($this->enderecoipauditoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['nomeaplicacaoauditoria'])) { $this->nomeaplicacaoauditoria = $NM_val_form['nomeaplicacaoauditoria']; }
              elseif (isset($this->nomeaplicacaoauditoria)) { $this->nm_limpa_alfa($this->nomeaplicacaoauditoria); }

              $this->nm_formatar_campos();

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('idcategoriaproduto', 'descricao', 'idcategoriaprodutotarefa', 'classificador', 'codigotarefa', 'tipo', 'niveltarefa', 'prazohoras', 'notas', 'idtenacidade', 'idusuarioauditoria', 'enderecoipauditoria', 'nomeaplicacaoauditoria'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
              $NM_cmp_auto = "IdCategoriaProdutoTarefa, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(IdCategoriaProdutoTarefa) from " . $this->Ini->nm_tabela; 
          $comando = "select max(IdCategoriaProdutoTarefa) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  CategoriaProdutoTarefa_Frm_pack_ajax_response();
              }
              exit; 
          }  
          $this->idcategoriaprodutotarefa_before_qstr = $this->idcategoriaprodutotarefa = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      CategoriaProdutoTarefa_Frm_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (IdCategoriaProduto, IdTenacidade, IdUsuarioAuditoria, Classificador, CodigoTarefa, Tipo, Descricao, NivelTarefa, PrazoHoras, Notas, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES ($this->idcategoriaproduto, $this->idtenacidade, $this->idusuarioauditoria, $this->classificador, '$this->codigotarefa', '$this->tipo', '$this->descricao', $this->niveltarefa, $this->prazohoras, '$this->notas', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdCategoriaProduto, IdTenacidade, IdUsuarioAuditoria, Classificador, CodigoTarefa, Tipo, Descricao, NivelTarefa, PrazoHoras, Notas, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idcategoriaproduto, $this->idtenacidade, $this->idusuarioauditoria, $this->classificador, '$this->codigotarefa', '$this->tipo', '$this->descricao', $this->niveltarefa, $this->prazohoras, '$this->notas', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdCategoriaProduto, IdTenacidade, IdUsuarioAuditoria, Classificador, CodigoTarefa, Tipo, Descricao, NivelTarefa, PrazoHoras, Notas, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idcategoriaproduto, $this->idtenacidade, $this->idusuarioauditoria, $this->classificador, '$this->codigotarefa', '$this->tipo', '$this->descricao', $this->niveltarefa, $this->prazohoras, '$this->notas', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "IdCategoriaProduto, IdTenacidade, IdUsuarioAuditoria, Classificador, CodigoTarefa, Tipo, Descricao, NivelTarefa, PrazoHoras, Notas, EnderecoIpAuditoria, NomeAplicacaoAuditoria) VALUES (" . $NM_seq_auto . "$this->idcategoriaproduto, $this->idtenacidade, $this->idusuarioauditoria, $this->classificador, '$this->codigotarefa', '$this->tipo', '$this->descricao', $this->niveltarefa, $this->prazohoras, '$this->notas', '$this->enderecoipauditoria', '$this->nomeaplicacaoauditoria')"; 
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
                              CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
                          CategoriaProdutoTarefa_Frm_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->idcategoriaprodutotarefa =  $rsy->fields[0];
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
                  $this->idcategoriaprodutotarefa = $rsy->fields[0];
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
                  $this->idcategoriaprodutotarefa = $rsy->fields[0];
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
                  $this->idcategoriaprodutotarefa = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->codigotarefa = $this->codigotarefa_before_qstr;
              $this->tipo = $this->tipo_before_qstr;
              $this->descricao = $this->descricao_before_qstr;
              $this->notas = $this->notas_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->codigotarefa = $this->codigotarefa_before_qstr;
              $this->tipo = $this->tipo_before_qstr;
              $this->descricao = $this->descricao_before_qstr;
              $this->notas = $this->notas_before_qstr;
              $this->enderecoipauditoria = $this->enderecoipauditoria_before_qstr;
              $this->nomeaplicacaoauditoria = $this->nomeaplicacaoauditoria_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['return_edit'] = "new";
              } 
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
          $this->idcategoriaprodutotarefa = substr($this->Db->qstr($this->idcategoriaprodutotarefa), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa "); 
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
                          CategoriaProdutoTarefa_Frm_pack_ajax_response();
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']);
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['parms'] = "idcategoriaprodutotarefa?#?$this->idcategoriaprodutotarefa?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->idcategoriaprodutotarefa = null === $this->idcategoriaprodutotarefa ? null : substr($this->Db->qstr($this->idcategoriaprodutotarefa), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter'] . ")";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          $nmgp_select = "SELECT IdCategoriaProdutoTarefa, IdCategoriaProduto, IdTenacidade, IdUsuarioAuditoria, Classificador, CodigoTarefa, Tipo, Descricao, NivelTarefa, PrazoHoras, Notas, EnderecoIpAuditoria, NomeAplicacaoAuditoria from " . $this->Ini->nm_tabela ; 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa"; 
              }  
              else  
              {
                  $aWhere[] = "IdCategoriaProdutoTarefa = $this->idcategoriaprodutotarefa"; 
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
          $sc_order_by = "IdCategoriaProdutoTarefa";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['select'] = ""; 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter'] = true;
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
              $this->idcategoriaprodutotarefa = $rs->fields[0] ; 
              $this->nmgp_dados_select['idcategoriaprodutotarefa'] = $this->idcategoriaprodutotarefa;
              $this->idcategoriaproduto = $rs->fields[1] ; 
              $this->nmgp_dados_select['idcategoriaproduto'] = $this->idcategoriaproduto;
              $this->idtenacidade = $rs->fields[2] ; 
              $this->nmgp_dados_select['idtenacidade'] = $this->idtenacidade;
              $this->idusuarioauditoria = $rs->fields[3] ; 
              $this->nmgp_dados_select['idusuarioauditoria'] = $this->idusuarioauditoria;
              $this->classificador = $rs->fields[4] ; 
              $this->nmgp_dados_select['classificador'] = $this->classificador;
              $this->codigotarefa = $rs->fields[5] ; 
              $this->nmgp_dados_select['codigotarefa'] = $this->codigotarefa;
              $this->tipo = $rs->fields[6] ; 
              $this->nmgp_dados_select['tipo'] = $this->tipo;
              $this->descricao = $rs->fields[7] ; 
              $this->nmgp_dados_select['descricao'] = $this->descricao;
              $this->niveltarefa = $rs->fields[8] ; 
              $this->nmgp_dados_select['niveltarefa'] = $this->niveltarefa;
              $this->prazohoras = $rs->fields[9] ; 
              $this->nmgp_dados_select['prazohoras'] = $this->prazohoras;
              $this->notas = $rs->fields[10] ; 
              $this->nmgp_dados_select['notas'] = $this->notas;
              $this->enderecoipauditoria = $rs->fields[11] ; 
              $this->nmgp_dados_select['enderecoipauditoria'] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = $rs->fields[12] ; 
              $this->nmgp_dados_select['nomeaplicacaoauditoria'] = $this->nomeaplicacaoauditoria;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->idcategoriaprodutotarefa = (string)$this->idcategoriaprodutotarefa; 
              $this->idcategoriaproduto = (string)$this->idcategoriaproduto; 
              $this->idtenacidade = (string)$this->idtenacidade; 
              $this->idusuarioauditoria = (string)$this->idusuarioauditoria; 
              $this->classificador = (string)$this->classificador; 
              $this->niveltarefa = (string)$this->niveltarefa; 
              $this->prazohoras = (string)$this->prazohoras; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['parms'] = "idcategoriaprodutotarefa?#?$this->idcategoriaprodutotarefa?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_select'] = $this->nmgp_dados_select;
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
              $this->idcategoriaprodutotarefa = "";  
              $this->nmgp_dados_form["idcategoriaprodutotarefa"] = $this->idcategoriaprodutotarefa;
              $this->idcategoriaproduto = "";  
              $this->nmgp_dados_form["idcategoriaproduto"] = $this->idcategoriaproduto;
              $this->idtenacidade = "" . $_SESSION['varIdTenacidade'] . "";  
              $this->nmgp_dados_form["idtenacidade"] = $this->idtenacidade;
              $this->idusuarioauditoria = "" . $_SESSION['varIdUsuario'] . "";  
              $this->nmgp_dados_form["idusuarioauditoria"] = $this->idusuarioauditoria;
              $this->classificador = "";  
              $this->nmgp_dados_form["classificador"] = $this->classificador;
              $this->codigotarefa = "";  
              $this->nmgp_dados_form["codigotarefa"] = $this->codigotarefa;
              $this->tipo = "";  
              $this->nmgp_dados_form["tipo"] = $this->tipo;
              $this->descricao = "";  
              $this->nmgp_dados_form["descricao"] = $this->descricao;
              $this->niveltarefa = "";  
              $this->nmgp_dados_form["niveltarefa"] = $this->niveltarefa;
              $this->prazohoras = "";  
              $this->nmgp_dados_form["prazohoras"] = $this->prazohoras;
              $this->notas = "";  
              $this->nmgp_dados_form["notas"] = $this->notas;
              $this->enderecoipauditoria = "";  
              $this->nmgp_dados_form["enderecoipauditoria"] = $this->enderecoipauditoria;
              $this->nomeaplicacaoauditoria = "";  
              $this->nmgp_dados_form["nomeaplicacaoauditoria"] = $this->nomeaplicacaoauditoria;
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['foreign_key'] as $sFKName => $sFKValue)
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

/*----- Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/

function Gravar_Tabela_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'on';
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
                CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'off';
}

/*----- END - Scriptcase Locale: Internal Lib: Gravar_Tabela_Auditoria.php ------*/


/*----- Scriptcase Locale: Internal Lib: Preparar_LstFrm_OnSrip_OnLoad_Auditoria.php ------*/

function Preparar_LstFrm_OnSrip_OnLoad_Auditoria($parNomeAplicacao, $parValorIdChavePrimaria = NULL) {
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'on';
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
$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Field_disabled_macro']['idtenacidade'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("idusuarioauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Field_disabled_macro']['idusuarioauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("enderecoipauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Field_disabled_macro']['enderecoipauditoria'] = array('I'=>array(),'U'=>array());
;
			$this->sc_field_readonly("nomeaplicacaoauditoria", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Field_disabled_macro']['nomeaplicacaoauditoria'] = array('I'=>array(),'U'=>array());
;

			if ($this->sc_temp_varPrivAdmin != 1) {
				if ($this->sc_temp_varAcessoAuditoria != "S") {
					$this->NM_ajax_info['buttonDisplay']['Auditoria'] = $this->nmgp_botoes["Auditoria"] = 'off';;
				}
				if ($this->sc_temp_varAcessoAutorizacoes != "S") {
					$this->NM_ajax_info['buttonDisplay']['Autorizações'] = $this->nmgp_botoes["Autorizações"] = 'off';;
				}
				$this->Ini->nm_hidden_blocos[3] = 'off'; $this->NM_ajax_info['blockDisplay']['3'] = 'off';
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
$_SESSION['scriptcase']['CategoriaProdutoTarefa_Frm']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              CategoriaProdutoTarefa_Frm_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("CategoriaProdutoTarefa_Frm_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("idcategoriaprodutotarefa", "idcategoriaproduto", "idtenacidade", "idusuarioauditoria", "classificador", "codigotarefa", "tipo", "descricao", "niveltarefa", "prazohoras", "notas", "enderecoipauditoria", "nomeaplicacaoauditoria"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['csrf_token'];
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

   function Form_lookup_idcategoriaproduto()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'] = array(); 
    }

   $old_value_idcategoriaprodutotarefa = $this->idcategoriaprodutotarefa;
   $old_value_classificador = $this->classificador;
   $old_value_niveltarefa = $this->niveltarefa;
   $old_value_prazohoras = $this->prazohoras;
   $old_value_idtenacidade = $this->idtenacidade;
   $old_value_idusuarioauditoria = $this->idusuarioauditoria;
   $this->nm_tira_formatacao();


   $unformatted_value_idcategoriaprodutotarefa = $this->idcategoriaprodutotarefa;
   $unformatted_value_classificador = $this->classificador;
   $unformatted_value_niveltarefa = $this->niveltarefa;
   $unformatted_value_prazohoras = $this->prazohoras;
   $unformatted_value_idtenacidade = $this->idtenacidade;
   $unformatted_value_idusuarioauditoria = $this->idusuarioauditoria;

   $nm_comando = "SELECT IdProduto, Descricao  FROM produto  ORDER BY Descricao";

   $this->idcategoriaprodutotarefa = $old_value_idcategoriaprodutotarefa;
   $this->classificador = $old_value_classificador;
   $this->niveltarefa = $old_value_niveltarefa;
   $this->prazohoras = $old_value_prazohoras;
   $this->idtenacidade = $old_value_idtenacidade;
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['Lookup_idcategoriaproduto'][] = $rs->fields[0];
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
              $this->SC_monta_condicao($comando, "IdCategoriaProdutoTarefa", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $data_lookup = $this->SC_lookup_idcategoriaproduto($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "IdCategoriaProduto", $arg_search, $data_lookup, "BIGINT", false);
              }
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "IdTenacidade", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "IdUsuarioAuditoria", $arg_search, str_replace(",", ".", $data_search), "BIGINT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Classificador", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "CodigoTarefa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Tipo", $arg_search, $data_search, "CHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Descricao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "NivelTarefa", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "PrazoHoras", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp") 
          {
              $this->SC_monta_condicao($comando, "Notas", $arg_search, $data_search, "MEDIUMTEXT", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_CategoriaProdutoTarefa_Frm = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total'] = $qt_geral_reg_CategoriaProdutoTarefa_Frm;
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          CategoriaProdutoTarefa_Frm_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
      $nm_numeric[] = "idcategoriaprodutotarefa";$nm_numeric[] = "idcategoriaproduto";$nm_numeric[] = "idtenacidade";$nm_numeric[] = "idusuarioauditoria";$nm_numeric[] = "classificador";$nm_numeric[] = "niveltarefa";$nm_numeric[] = "prazohoras";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['decimal_db'] == ".")
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
   function SC_lookup_idcategoriaproduto($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT Descricao, IdProduto FROM produto WHERE (#lowerI##cmp_iDescricao#cmp_f)#cmp_apos LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "LIKE #lowerI#'#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "NOT LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", ">= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "< #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
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
       $nmgp_saida_form = "CategoriaProdutoTarefa_Frm_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['nm_run_menu'] = 2;
       $nmgp_saida_form = "CategoriaProdutoTarefa_Frm_fim.php";
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
       CategoriaProdutoTarefa_Frm_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['masterValue']);
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['link_info']['compact_mode']) {
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
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " Tarefas"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " Tarefas"; } ?></span></td>
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
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['CategoriaProdutoTarefa_Frm']['ordem_ord'] == " desc") {
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
            case "IdCategoriaProdutoTarefa":
                return true;
            case "Classificador":
                return true;
            case "NivelTarefa":
                return true;
            case "PrazoHoras":
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

}
?>
