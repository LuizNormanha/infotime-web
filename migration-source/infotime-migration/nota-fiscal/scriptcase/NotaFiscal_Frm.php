<?php
//
   if (!session_id())
   {
   include_once('NotaFiscal_Frm_session.php');
           include_once("../_lib/lib/php/fix.php");
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 0);
   @session_start() ;
       if (!function_exists("sc_check_mobile"))
       {
           include_once("../_lib/lib/php/nm_check_mobile.php");
       }
       $_SESSION['scriptcase']['device_mobile'] = sc_check_mobile();
       $_SESSION['scriptcase']['proc_mobile']   = $_SESSION['scriptcase']['device_mobile'];
       if (!isset($_SESSION['scriptcase']['display_mobile']))
       {
           $_SESSION['scriptcase']['display_mobile'] = true;
       }
       if ($_SESSION['scriptcase']['device_mobile'])
       {
           if ($_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'out' == $_POST['_sc_force_mobile'])
           {
               $_SESSION['scriptcase']['display_mobile'] = false;
           }
           elseif (!$_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'in' == $_POST['_sc_force_mobile'])
           {
               $_SESSION['scriptcase']['display_mobile'] = true;
           }
       }
        if (isset($_GET['_sc_force_mobile'])) {
            $_SESSION['scriptcase']['force_mobile'] = 'Y' == $_GET['_sc_force_mobile'];
        }
        if (isset($_SESSION['scriptcase']['force_mobile'])) {
            if ($_SESSION['scriptcase']['force_mobile']) {
                $_SESSION['scriptcase']['device_mobile'] = true;
            }
            $_SESSION['scriptcase']['display_mobile'] = $_SESSION['scriptcase']['force_mobile'];
        }
       if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
       {
          include_once('NotaFiscal_Frm_mob.php');
          exit;
       }
   }

   $_SESSION['scriptcase']['NotaFiscal_Frm']['error_buffer'] = '';

   $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_perfil']          = "ligasistemas";
   $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_cache']  = "";
   $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_doc']        = "";
   $NM_dir_atual = getcwd();
   if (empty($NM_dir_atual))
   {
       $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
       $str_path_sys  = str_replace("\\", '/', $str_path_sys);
   }
   else
   {
       $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
       $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
   }
   //check publication with the prod
   $str_path_apl_url = $_SERVER['PHP_SELF'];
   $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
   $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
   $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
   $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
   $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
   //check prod
   if(empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_prod']))
   {
           /*check prod*/$_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
   }
   //check img
   if(empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imagens']))
   {
           /*check img*/$_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
   }
   //check tmp
   if(empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp']))
   {
           /*check tmp*/$_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
   }
   //check cache
   if(empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_cache']))
   {
           /*check cache*/$_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
   }
   //check doc
   if(empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_doc']))
   {
           /*check doc*/$_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
   }
   //end check publication with the prod
//
class NotaFiscal_Frm_ini
{
   var $nm_cod_apl;
   var $nm_nome_apl;
   var $nm_seguranca;
   var $nm_grupo;
   var $nm_grupo_versao;
   var $nm_autor;
   var $nm_versao_sc;
   var $nm_tp_lic_sc;
   var $nm_dt_criacao;
   var $nm_hr_criacao;
   var $nm_autor_alt;
   var $nm_dt_ult_alt;
   var $nm_hr_ult_alt;
   var $nm_timestamp;
   var $cor_bg_table;
   var $border_grid;
   var $cor_bg_grid;
   var $cor_cab_grid;
   var $cor_borda;
   var $cor_txt_cab_grid;
   var $cab_fonte_tipo;
   var $cab_fonte_tamanho;
   var $rod_fonte_tipo;
   var $rod_fonte_tamanho;
   var $cor_rod_grid;
   var $cor_txt_rod_grid;
   var $cor_barra_nav;
   var $cor_titulo;
   var $cor_txt_titulo;
   var $titulo_fonte_tipo;
   var $titulo_fonte_tamanho;
   var $cor_grid_impar;
   var $cor_grid_par;
   var $cor_txt_grid;
   var $texto_fonte_tipo;
   var $texto_fonte_tamanho;
   var $cor_lin_grupo;
   var $cor_txt_grupo;
   var $grupo_fonte_tipo;
   var $grupo_fonte_tamanho;
   var $cor_lin_sub_tot;
   var $cor_txt_sub_tot;
   var $sub_tot_fonte_tipo;
   var $sub_tot_fonte_tamanho;
   var $cor_lin_tot;
   var $cor_txt_tot;
   var $tot_fonte_tipo;
   var $tot_fonte_tamanho;
   var $cor_link_cab;
   var $cor_link_dados;
   var $img_fun_pag;
   var $img_fun_cab;
   var $img_fun_rod;
   var $img_fun_tit;
   var $img_fun_gru;
   var $img_fun_tot;
   var $img_fun_sub;
   var $img_fun_imp;
   var $img_fun_par;
   var $root;
   var $server;
   var $sc_protocolo;
   var $path_prod;
   var $path_link;
   var $path_aplicacao;
   var $path_embutida;
   var $path_botoes;
   var $path_img_global;
   var $path_img_modelo;
   var $path_icones;
   var $path_imagens;
   var $path_imag_cab;
   var $path_imag_temp;
   var $path_libs;
   var $path_doc;
   var $str_lang;
   var $str_schema_all;
   var $str_google_fonts;
   var $str_conf_reg;
   var $path_cep;
   var $path_secure;
   var $path_js;
   var $path_adodb;
   var $path_grafico;
   var $path_atual;
   var $Gd_missing;
   var $sc_site_ssl;
   var $link_NotaFiscal_Frm_inline;
   var $nm_cont_lin;
   var $nm_limite_lin;
   var $nm_limite_lin_prt;
   var $nm_falta_var;
   var $nm_falta_var_db;
   var $nm_tpbanco;
   var $nm_servidor;
   var $nm_usuario;
   var $nm_senha;
   var $nm_database_encoding;
   var $nm_arr_db_extra_args = array();
   var $nm_con_db2 = array();
   var $nm_con_persistente;
   var $nm_con_use_schema;
   var $nm_tabela;
   var $nm_col_dinamica   = array();
   var $nm_order_dinamico = array();
   var $nm_hidden_pages   = array();
   var $nm_page_names     = array();
   var $nm_page_blocks    = array();
   var $nm_block_page     = array();
   var $nm_hidden_blocos  = array();
   var $sc_tem_trans_banco;
   var $nm_bases_all;
   var $nm_bases_access;
   var $nm_bases_ibase;
   var $nm_bases_mysql;
   var $nm_bases_postgres;
   var $nm_bases_sqlite;
   var $sc_page;
   var $sc_lig_md5 = array();
   var $sc_lig_target = array();
   var $sc_lig_iframe = array();
   var $force_db_utf8 = true;
//
   function init()
   {
       global
             $nm_url_saida, $nm_apl_dependente, $script_case_init;

      @ini_set('magic_quotes_runtime', 0);
      $this->sc_page = $script_case_init;
      $_SESSION['scriptcase']['sc_num_page'] = $script_case_init;
      $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      $_SESSION['scriptcase']['sc_cnt_sql']  = 0;
      $this->sc_charset['UTF-8'] = 'utf-8';
      $this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
      $this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
      $this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
      $this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
      $this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
      $this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
      $this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
      $this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
      $this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
      $this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
      $this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
      $this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
      $this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
      $this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
      $this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
      $this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
      $this->sc_charset['WINDOWS-1250'] = 'windows-1250';
      $this->sc_charset['WINDOWS-1251'] = 'windows-1251';
      $this->sc_charset['WINDOWS-1252'] = 'windows-1252';
      $this->sc_charset['TIS-620'] = 'tis-620';
      $this->sc_charset['WINDOWS-1253'] = 'windows-1253';
      $this->sc_charset['WINDOWS-1254'] = 'windows-1254';
      $this->sc_charset['WINDOWS-1255'] = 'windows-1255';
      $this->sc_charset['WINDOWS-1256'] = 'windows-1256';
      $this->sc_charset['WINDOWS-1257'] = 'windows-1257';
      $this->sc_charset['KOI8-R'] = 'koi8-r';
      $this->sc_charset['BIG-5'] = 'big5';
      $this->sc_charset['EUC-CN'] = 'EUC-CN';
      $this->sc_charset['GB18030'] = 'GB18030';
      $this->sc_charset['GB2312'] = 'gb2312';
      $this->sc_charset['EUC-JP'] = 'euc-jp';
      $this->sc_charset['SJIS'] = 'shift-jis';
      $this->sc_charset['EUC-KR'] = 'euc-kr';
      $_SESSION['scriptcase']['charset_entities']['UTF-8'] = 'UTF-8';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-1'] = 'ISO-8859-1';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-5'] = 'ISO-8859-5';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-15'] = 'ISO-8859-15';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1251'] = 'cp1251';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1252'] = 'cp1252';
      $_SESSION['scriptcase']['charset_entities']['BIG-5'] = 'BIG5';
      $_SESSION['scriptcase']['charset_entities']['EUC-CN'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['GB2312'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['SJIS'] = 'Shift_JIS';
      $_SESSION['scriptcase']['charset_entities']['EUC-JP'] = 'EUC-JP';
      $_SESSION['scriptcase']['charset_entities']['KOI8-R'] = 'KOI8-R';
      $_SESSION['scriptcase']['trial_version'] = 'N';
      $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['decimal_db'] = "."; 

      $this->nm_cod_apl      = "NotaFiscal_Frm"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "LIGA_InfoTIME"; 
      $this->nm_grupo_versao = "2"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake"; 
      $this->nm_script_type  = "PHP"; 
      $this->nm_versao_sc    = "v9"; 
      $this->nm_tp_lic_sc    = "sb_micro_bronze"; 
      $this->nm_dt_criacao   = "20131016"; 
      $this->nm_hr_criacao   = "180521"; 
      $this->nm_autor_alt    = "nelson"; 
      $this->nm_dt_ult_alt   = "20260319"; 
      $this->nm_hr_ult_alt   = "152722"; 
      list($NM_usec, $NM_sec) = explode(" ", microtime()); 
      $this->nm_timestamp    = (float) $NM_sec; 
      $this->nm_app_version  = "1.0.1"; 
// 
      $this->border_grid           = ""; 
      $this->cor_bg_grid           = ""; 
      $this->cor_bg_table          = ""; 
      $this->cor_borda             = ""; 
      $this->cor_cab_grid          = ""; 
      $this->cor_txt_pag           = ""; 
      $this->cor_link_pag          = ""; 
      $this->pag_fonte_tipo        = ""; 
      $this->pag_fonte_tamanho     = ""; 
      $this->cor_txt_cab_grid      = ""; 
      $this->cab_fonte_tipo        = ""; 
      $this->cab_fonte_tamanho     = ""; 
      $this->rod_fonte_tipo        = ""; 
      $this->rod_fonte_tamanho     = ""; 
      $this->cor_rod_grid          = ""; 
      $this->cor_txt_rod_grid      = ""; 
      $this->cor_barra_nav         = ""; 
      $this->cor_titulo            = ""; 
      $this->cor_txt_titulo        = ""; 
      $this->titulo_fonte_tipo     = ""; 
      $this->titulo_fonte_tamanho  = ""; 
      $this->cor_grid_impar        = ""; 
      $this->cor_grid_par          = ""; 
      $this->cor_txt_grid          = ""; 
      $this->texto_fonte_tipo      = ""; 
      $this->texto_fonte_tamanho   = ""; 
      $this->cor_lin_grupo         = ""; 
      $this->cor_txt_grupo         = ""; 
      $this->grupo_fonte_tipo      = ""; 
      $this->grupo_fonte_tamanho   = ""; 
      $this->cor_lin_sub_tot       = ""; 
      $this->cor_txt_sub_tot       = ""; 
      $this->sub_tot_fonte_tipo    = ""; 
      $this->sub_tot_fonte_tamanho = ""; 
      $this->cor_lin_tot           = ""; 
      $this->cor_txt_tot           = ""; 
      $this->tot_fonte_tipo        = ""; 
      $this->tot_fonte_tamanho     = ""; 
      $this->cor_link_cab          = ""; 
      $this->cor_link_dados        = ""; 
      $this->img_fun_pag           = ""; 
      $this->img_fun_cab           = ""; 
      $this->img_fun_rod           = ""; 
      $this->img_fun_tit           = ""; 
      $this->img_fun_gru           = ""; 
      $this->img_fun_tot           = ""; 
      $this->img_fun_sub           = ""; 
      $this->img_fun_imp           = ""; 
      $this->img_fun_par           = ""; 
// 
      $NM_dir_atual = getcwd();
      if (empty($NM_dir_atual))
      {
          $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
          $str_path_sys          = str_replace("\\", '/', $str_path_sys);
      }
      else
      {
          $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
          $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
      }
      //check publication with the prod
      $str_path_apl_url = $_SERVER['PHP_SELF'];
      $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
      $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
      $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
// 
      $this->sc_site_ssl     = (isset($_SERVER['HTTP_REFERER']) && strtolower(substr($_SERVER['HTTP_REFERER'], 0, 5)) == 'https') ? true : false;
      $this->sc_protocolo    = ($this->sc_site_ssl) ? 'https://' : 'http://';
      $this->path_prod       = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_prod'];
      $this->path_imagens    = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp'];
      $this->path_cache      = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_doc'];
      if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
      {
          $_SESSION['scriptcase']['str_lang'] = "pt_br";
      }
      if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
      {
          $_SESSION['scriptcase']['str_conf_reg'] = "pt_br";
      }
      $this->str_lang        = $_SESSION['scriptcase']['str_lang'];
      $this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
      $this->str_schema_all  = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Liga_Soft_sm/Liga_Soft_sm";
      $this->str_google_fonts  = isset($str_google_fonts)?$str_google_fonts:'';
      $this->server          = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
      if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && !$this->sc_site_ssl )
      {
          $this->server         .= ":" . $_SERVER['SERVER_PORT'];
      }
      $this->server_pdf      = $this->sc_protocolo . $this->server;
      $this->server          = "";
      $this->sc_protocolo    = "";
      $str_path_web          = $_SERVER['PHP_SELF'];
      $str_path_web          = str_replace("\\", '/', $str_path_web);
      $str_path_web          = str_replace('//', '/', $str_path_web);
      $this->root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
      $this->path_aplicacao  = substr($str_path_sys, 0, strrpos($str_path_sys, '/'));
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/NotaFiscal_Frm';
      $this->path_embutida   = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/') + 1);
      $this->path_aplicacao .= '/';
      $this->path_link       = substr($str_path_web, 0, strrpos($str_path_web, '/'));
      $this->path_link       = substr($this->path_link, 0, strrpos($this->path_link, '/')) . '/';
      $this->path_help       = $this->path_link . "_lib/webhelp/";
      $this->path_lang       = "../_lib/lang/";
      $this->path_lang_js    = "../_lib/js/";
      $this->path_botoes     = $this->path_link . "_lib/img";
      $this->path_img_global = $this->path_link . "_lib/img";
      $this->path_img_modelo = $this->path_link . "_lib/img";
      $this->path_icones     = $this->path_link . "_lib/img";
      $this->path_imag_cab   = $this->path_link . "_lib/img";
      $this->path_btn        = $this->root . $this->path_link . "_lib/buttons/";
      $this->path_css        = $this->root . $this->path_link . "_lib/css/";
      $this->path_lib_php    = $this->root . $this->path_link . "_lib/lib/php/";
      $this->url_lib_js      = $this->path_link . "_lib/lib/js/";
      $this->url_lib         = $this->path_link . '/_lib/';
      $this->url_third       = $this->path_prod . '/third/';
      $this->path_cep        = $this->path_prod . "/cep";
      $this->path_cor        = $this->path_prod . "/cor";
      $this->path_js         = $this->path_prod . "/lib/js";
      $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
      $this->path_third      = $this->root . $this->path_prod . "/third";
      $this->path_adodb      = $this->root . $this->path_prod . "/third/adodb";

      include("../_lib/css/" . $this->str_schema_all . "_form.php");
      $temp_Str_btn_form    = trim($str_button);
      include($this->path_btn . $temp_Str_btn_form . '/' . $temp_Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $this->css_help_tooltip_faicon = !isset($css_help_tooltip_faicon) || "" == trim($css_help_tooltip_faicon) ? "fas fa-question-circle" : trim($css_help_tooltip_faicon);
      $this->css_schema_info_tooltiptheme = !isset($css_schema_info_tooltiptheme) || "" == trim($css_schema_info_tooltiptheme) ? "" : trim($css_schema_info_tooltiptheme);
      $this->tippy_themes = [];
      $this->tippy_theme_default = '';
      if ('' != $this->css_schema_info_tooltiptheme) {
          $this->scGetTippyCssTheme($this->tippy_themes, $this->css_schema_info_tooltiptheme);
          $this->tippy_theme_default = $this->css_schema_info_tooltiptheme;
      }

      $_SESSION['scriptcase']['dir_temp'] = $this->root . $this->path_imag_temp;
      if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['NotaFiscal_Frm']['actual_lang']) || $_SESSION['scriptcase']['NotaFiscal_Frm']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['NotaFiscal_Frm']['actual_lang'] = $this->str_lang;
          setcookie('sc_actual_lang_LIGA_InfoTIME',$this->str_lang,'0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
      }
      global $inicial_NotaFiscal_Frm;
      if (isset($_SESSION['scriptcase']['user_logout']))
      {
          foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
          {
              if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
              {
                  $nm_apl_dest = $parms['R'];
                  $dir = explode("/", $nm_apl_dest);
                  if (count($dir) == 1)
                  {
                      $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                      $nm_apl_dest = $this->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
                  }
                  unset($_SESSION['scriptcase']['user_logout'][$ind]);
                  if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag) && $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag)
                  {
                      $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['action']  = $nm_apl_dest;
                      $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['target']  = $parms['T'];
                      $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['metodo']  = "post";
                      $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['script_case_init']  = $this->sc_page;
                      NotaFiscal_Frm_pack_ajax_response();
                      exit;
                  }
?>
                  <!DOCTYPE html>
                  <html>
                  <body>
                  <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
                  </form>
                  <script>
                   document.FRedirect.submit();
                  </script>
                  </body>
                  </html>
<?php
                  exit;
              }
          }
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1); 
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']);
      }
      include($this->path_lang . $this->str_lang . ".lang.php");
      include($this->path_lang . "config_region.php");
      include($this->path_lang . "lang_config_region.php");
      $_SESSION['scriptcase']['charset'] = "UTF-8";
      ini_set('default_charset', $_SESSION['scriptcase']['charset']);
      $_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];

      asort($this->Nm_lang_conf_region);
      foreach ($this->Nm_lang_conf_region as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang_conf_region[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
      {
          $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
      }
      if (!function_exists("mb_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtmb'] . "</font></div>";exit;
      } 
      elseif (!function_exists("sc_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtsc'] . "</font></div>";exit;
      } 
      foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
          {
              $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      }
      $this->Nm_lang['lang_errm_ajax_rqrd'] = $this->Nm_lang['lang_errm_ajax_rqrd'];
      foreach ($this->Nm_lang as $ind => $dados)
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
          {
              $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
              $this->Nm_lang[$ind] = $dados;
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
          {
              $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->Nm_lang[$ind] = str_replace('"', '&quot;',  $this->Nm_lang[$ind]);
      }
      if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir'])) {
          $SS_cod_html  = '<!DOCTYPE html>

';
          $SS_cod_html .= "<HTML>\r\n";
          $SS_cod_html .= " <HEAD>\r\n";
          $SS_cod_html .= "  <TITLE></TITLE>\r\n";
          $SS_cod_html .= "   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\"/>\r\n";
          if ($_SESSION['scriptcase']['proc_mobile']) {
              $SS_cod_html .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>\r\n";
          }
          $SS_cod_html .= "   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n";
          $SS_cod_html .= "    <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n";
          if ($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body>\r\n";
          }
          else {
              $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_form.css\"/>\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body class=\"scFormPage\">\r\n";
              $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div class=\"scFormBorder\">\r\n";
              $SS_cod_html .= "    <table width='100%' cellspacing=0 cellpadding=0><tr><td class=\"scFormDataOdd\" style=\"padding: 15px 30px; text-align: center\">\r\n";
              $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
              $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
              $SS_cod_html .= "           target=\"_self\">\r\n";
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir'] . "');\r\n";
          }
          $SS_cod_html .= "      function sc_session_redir(url_redir)\r\n";
          $SS_cod_html .= "      {\r\n";
          $SS_cod_html .= "         if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "            window.parent.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "         else\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "             if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.close();\r\n";
          $SS_cod_html .= "                 window.opener.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "             else\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.location = url_redir;\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "      }\r\n";
          $SS_cod_html .= "    </script>\r\n";
          $SS_cod_html .= " </body>\r\n";
          $SS_cod_html .= "</HTML>\r\n";
          unset($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']);
          unset($_SESSION['sc_session']);
      }
      if (isset($SS_cod_html) && isset($_GET['nmgp_opcao']) && (substr($_GET['nmgp_opcao'], 0, 14) == "ajax_aut_comp_" || substr($_GET['nmgp_opcao'], 0, 13) == "ajax_autocomp"))
      {
          unset($_SESSION['sc_session']);
          $oJson = new Services_JSON();
          echo $oJson->encode("ss_time_out");
          exit;
      }
      elseif (isset($SS_cod_html) && isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_dyn_refresh_field" || $_POST['nmgp_opcao'] == "ajax_add_dyn_search" || $_POST['nmgp_opcao'] == "ajax_ch_bi_dyn_search"))
      {
          unset($_SESSION['sc_session']);
          $this->Arr_result = array();
          $this->Arr_result['ss_time_out'] = true;
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      elseif (isset($SS_cod_html) && isset($_POST['rs']) && !is_array($_POST['rs']) && 'ajax_' == substr($_POST['rs'], 0, 5) && isset($_POST['rsargs']) && !empty($_POST['rsargs']))
      {
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['action']  = "NotaFiscal_Frm.php";
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['target']  = "_self";
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['metodo']  = "post";
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']['script_case_init']  = $this->sc_page;
          NotaFiscal_Frm_pack_ajax_response();
          exit;
      }
      elseif (isset($SS_cod_html))
      {
          echo $SS_cod_html;
          exit;
      }
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir']))
      {
          unset($_SESSION['sc_session']['SC_parm_violation']);
          echo "<!DOCTYPE html>";
          echo "<html>";
          echo "<body>";
          echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
          echo "<tr>";
          echo "   <td align=\"center\">";
          echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_data'] . "</font>";
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          echo "</body>";
          echo "</html>";
          exit;
      }
      $PHP_ver = str_replace(".", "", phpversion()); 
      if (substr($PHP_ver, 0, 3) < 434)
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_phpv'] . "</font></div>";exit;
      }
      if (file_exists($this->path_libs . "/ver.dat"))
      {
          $SC_ver = file($this->path_libs . "/ver.dat"); 
          $SC_ver = str_replace(".", "", $SC_ver[0]); 
          if (substr($SC_ver, 0, 5) < 40015)
          {
              echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_incp'] . "</font></div>";exit;
          } 
      } 
      if (-1 != version_compare(phpversion(), '5.0.0'))
      {
         $this->path_grafico    = $this->root . $this->path_prod . "/third/jpgraph5/src";
      }
      else
      {
          $this->path_grafico    = $this->root . $this->path_prod . "/third/jpgraph4/src";
      }
      $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['path_doc'] = $this->path_doc; 
      $_SESSION['scriptcase']['nm_path_prod'] = $this->root . $this->path_prod . "/"; 
      $_SESSION['scriptcase']['nm_root_cep']  = $this->root; 
      $_SESSION['scriptcase']['nm_path_cep']  = $this->path_cep; 
      if (empty($this->path_imag_cab))
      {
          $this->path_imag_cab = $this->path_img_global;
      }
      if (!isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu'])) {
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu'] = "";
      }
      if (!isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'])) {
          $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] = "";
      }
      if (!is_dir($this->root . $this->path_prod))
      {
          $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
          $str_message_end = "</body>
</html>";
          $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_cmlb_nfndtitle'], $str_message);
          $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_cmlb_nfnd'], $str_message);
          $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
          echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan']) || $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan'] != 'NotaFiscal_Frm')) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $this->Nm_lang['lang_btns_back'] ?>" title="<?php echo $this->Nm_lang['lang_btns_back_hint'] ?>" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
              else 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_danger" value="<?php echo $this->Nm_lang['lang_btns_exit'] ?>" title="<?php echo $this->Nm_lang['lang_btns_exit_hint'] ?>" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }

      $this->path_atual  = getcwd();
      $opsys = strtolower(php_uname());

      global $under_dashboard, $dashboard_app, $own_widget, $parent_widget, $compact_mode, $remove_margin, $remove_border, $remove_background;
      if (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      $this->link_NotaFiscal_Frm_inline = $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('NotaFiscal_Frm') . "/NotaFiscal_Frm_inline.php";
      if ($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["NotaFiscal_Frm"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["NotaFiscal_Frm"] as $sTmpTargetLink => $sTmpTargetWidget)
              {
                  if (isset($this->sc_lig_target[$sTmpTargetLink]))
                  {
                      if (isset($this->sc_lig_iframe[$this->sc_lig_target[$sTmpTargetLink]]))
                      {
                          $this->sc_lig_iframe[$this->sc_lig_target[$sTmpTargetLink]] = $sTmpTargetWidget;
                      }
                      $this->sc_lig_target[$sTmpTargetLink] = $sTmpTargetWidget;
                  }
              }
          }
      }
        global $link_compact_mode, $link_remove_margin, $link_remove_border, $link_remove_background, $link_margin_top;
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info']['compact_mode'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['link_info']['margin_top'] = $link_margin_top;
        }

      $this->nm_cont_lin       = 0;
      $this->nm_limite_lin     = 0;
      $this->nm_limite_lin_prt = 0;
// 
      include_once($this->path_adodb . "/adodb.inc.php");
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod");
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib");
      if(function_exists('set_php_timezone'))  set_php_timezone('NotaFiscal_Frm'); 
      $this->sc_Include($this->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->sc_Include($this->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $this->sc_Include($this->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      global $bol_api_prod; 
      $bol_api_prod = true; 
      if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'])) 
      { 
          $bol_api_prod = false;
      } 
      $this->sc_Include($this->path_lib_php . "/nm_api.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/fix.php", "", "") ; 
      $this->nm_data = new nm_data("pt_br");
      global $inicial_NotaFiscal_Frm, $NM_run_iframe;
      if ((isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag) && $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag) || (isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['embutida_call']) && $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['embutida_call']) || $NM_run_iframe == 1)
      {
           $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      }
      perfil_lib($this->path_libs);
      if (!isset($_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil']))
      {
          if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($this->path_libs, $this->path_prod);
          $_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil'] = true;
      }
      if (function_exists("nm_check_pdf_server")) $this->server_pdf = nm_check_pdf_server($this->path_libs, $this->server_pdf);
      if (!isset($_SESSION['scriptcase']['sc_num_img']) || empty($_SESSION['scriptcase']['sc_num_img']))
      { 
          $_SESSION['scriptcase']['sc_num_img'] = 1; 
      } 
      $this->Export_img_zip = false;;
      $this->Img_export_zip  = array();
      $this->regionalDefault();
      $this->sc_tem_trans_banco = false;
      $this->nm_bases_access     = array("access", "ado_access", "ace_access");
      $this->nm_bases_ibase      = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
      $this->nm_bases_mysql      = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "pdo_mariadb", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "azure_pdo_mariadb", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "googlecloud_pdo_mariadb", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql", "amazonrds_pdo_mariadb");
      $this->nm_bases_postgres   = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
      $this->nm_bases_sqlite     = array("sqlite", "sqlite3", "pdosqlite");
      $this->nm_bases_all        = array_merge($this->nm_bases_access, $this->nm_bases_ibase, $this->nm_bases_mysql, $this->nm_bases_postgres, $this->nm_bases_sqlite);
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1HQNwH9FGHAN7HQNUDMzGDkFCDWFYHMraHQNwZ1rqD1rwV5JwHgBOHErCV5FaDoJeD9NmH9X7HArYV5FGDMvmVcFKV5BmVoBqD9BsZkFGHAvsD5BOHgvsHArsHEXCHMB/HQNmDQB/HANOHurqDMBOZSrCV5X/VENUHQBqZkFGZ1rYHuJwHgBeDkFeV5B7DoJeHQFYDuFaHAvmVWBqDMBYVcFiV5FYHIXGHQXGH9BODSrYHuB/HgNKDkFeH5FYVoX7D9JKDQX7D1BOV5FGDMzGV9BUHEF/HMJwHQNwZSBOHANOHQBqHgveDkBsV5B7ZuJeHQXODQFUHANOHQBODMzGVcFiV5FYHMFGDcFYZ1FGHABYHQJsHgBODkBsV5FqDoJsHQFYDuBqD1veHQJeDMzGZSrCH5FqDoJeD9JmZ1B/D1NaD5rqHgvsHErsHEXCHMJwHQJKDuFaHAvOV5BqHgrwV9FiV5FYHIBiHQNmVINUDSrYHQraHgvsHEFKV5FqHIXGHQFYDuFaD1vOV5BODMvmZSrCV5FYHIJsDcFYZ1FGD1rKHQF7HgBeDkFeH5FYVoX7D9JKDQX7D1BOV5FGHuzGDkBOH5FqVoJwD9XOZ1F7HABYZMB/DEBeHENiV5XKDoB/D9NmH9X7HArYV5BODMrwDkFCDuX7VEF7D9BiVIJwZ1BeV5XGDEvsHEFiV5FqVoX7HQXGZSX7D1veD5JwHuBYZSrCV5FGVoBqD9BsZ1F7DSrYD5rqDMrYZSJGH5FYDoF7DcXOZSX7HIrKV5JwHuzGDkFCH5XCVoJwD9XOH9FaHAN7ZMBqHgveHArsH5BmDoJeHQBiZ9F7D1NKVWBODMvODkBsDWXCDoJsDcBwH9B/Z1rYHQJwDMvCHEJGHEFqHIXGDcBwDQJsZ1N7HuFGHuvmVcBOHEX7HIBiHQNmZ1rqHAN7HQJwDEBODkFeH5FYVoFGHQJKDQBOZ1rwHQBOHuNODkFCH5XCVoB/HQBsZSB/DSrYD5JeDMBYZSXeDWX7VoX7DcXOZSBiHAN7V5BOHuNOV9FiV5F/VorqD9JmZ1rqHArKHQJwDEBODkFeH5FYVoFGHQJKDQFaHAveD5NUHgNKDkBOV5FYHMBiD9XGZSB/D1rwHQFaHgBYHErCDuJeZuBOD9JKZSFGDSN7HuFGHgvOVcFCDWXCVoX7D9BsZkFGHIBeHuFUDEBeHErCDWF/VoBiDcJUZSX7Z1BYHuFaHuzGDkBODWJeVoJwD9BsZ1B/DSrYD5rqDErKVkXeV5FaDoFUDcJeH9FGHANOV5JwHuNOVIFCHEF/DoraHQJmZ1F7Z1vmD5rqDEBOHArCDWBmDoJeHQBiDQBqHAvmVWJeDMvOVcBUH5B3VoX7HQBqZkFGHArKV5FUDMrYZSXeV5FqHIJsDcBwDQFGHIrwV5JeHgrwDkB/DWF/HMraHQJmH9BqHIrwD5NUDENOHArsDWF/HIrqDcJeH9BiHANOHuFaHuNOZSrCH5FqDoXGHQJmZ1FGHIrwV5JeDMzGZSXeDWFGDoNUHQFYZSX7DSBYV5BqHuBYVcFKDWFYDoXGDcBqZ1FaD1NaD5raDMzGHAFKDWF/HIF7D9XsH9X7HAN7V5JwHuzGVIBOV5FqVoB/D9BiZ1F7DSrYD5rqDMBYHAFKDWF/HMBOD9NmDQJsD1veV5FUDMvmVcFKV5BmVoBqD9BsZkFGHAvsZMJeHgvCDkXKDWBmZura";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['initialize'])  
      { 
      }
   }

   function init2()
   {
      if (isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['initialize'])  
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['NotaFiscal_Frm']['initialize'] = false;
      } 
      $this->conectDB();
      if (!in_array(strtolower($this->nm_tpbanco), $this->nm_bases_all))
      {
          echo "<tr>";
          echo "   <td bgcolor=\"\">";
          echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_nspt'] . "</font>";
          echo "  " . $perfil_trab;
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          if (!$_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan']) || $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan'] != 'NotaFiscal_Frm')) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
                  echo "<a href='" . $_SESSION['scriptcase']['nm_sc_retorno'] . "' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_SoftCloud_sm_bvoltar.gif' title='" . $this->Nm_lang['lang_btns_rtrn_scrp_hint'] . "' align=absmiddle></a> \n" ; 
              } 
              else 
              { 
                  echo "<a href='$nm_url_saida' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_SoftCloud_sm_bsair.gif' title='" . $this->Nm_lang['lang_btns_exit_appl_hint'] . "' align=absmiddle></a> \n" ; 
              } 
          } 
          exit ;
      } 
      $this->Nm_accent_access    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_ibase     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_mysql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_postgres  = array('cmp_i'=>"unaccent(",'cmp_f'=>")",'cmp_apos'=>"",'arg_i'=>"' || unaccent('",'arg_f'=>"') || '",'arg_apos'=>"");
      $this->Nm_accent_sqlite    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");

      $this->Nm_accent_no = array('cmp_i'=>'','cmp_f'=>'','cmp_apos'=>'','arg_i'=>'','arg_f'=>'','arg_apos'=>'');
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access)) {
          $this->Nm_accent_yes = $this->Nm_accent_access;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase)) {
          $this->Nm_accent_yes = $this->Nm_accent_ibase;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mysql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres)) {
          $this->Nm_accent_yes = $this->Nm_accent_postgres;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
          $this->Nm_accent_yes = $this->Nm_accent_sqlite;
      }
      else {
          $this->Nm_accent_yes = $this->Nm_accent_no;
      }
   }

    function scGetTippyCssTheme(&$themeList, $themeName)
    {
        if (isset($themeList[$themeName])) {
            return;
        }

        $themeNameParts = explode('__NM__', $themeName);

        $themeList[$themeName] = [
            'tippy' => $themeNameParts[1],
            'file' => '../_lib/freecss/' . $themeName . '.css'
        ];
    }

   function prep_conect()
   {
      $con_devel             =  (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
      {
          foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
          {
              if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']) && $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_perfil']) && $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']))
      {
          db_conect_devel($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'], $this->root . $this->path_prod, 'LIGA_InfoTIME', 2, $this->force_db_utf8); 
          if (empty($_SESSION['scriptcase']['glo_tpbanco']) && empty($_SESSION['scriptcase']['glo_banco']))
          {
              $nm_crit_perfil = true;
          }
      }
      if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($perfil_trab, $this->path_libs, "S");
          if (empty($_SESSION['scriptcase']['glo_senha_protect']))
          {
              $nm_crit_perfil = true;
          }
      }
      else
      {
          $perfil_trab = $con_devel;
      }
      if (!$_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['embutida_form'] || !$_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['embutida_proc']) 
      {
          if (!isset($_SESSION['varIdTenacidade'])) 
          {
              $this->nm_falta_var .= "varIdTenacidade; ";
          }
          if (!isset($_SESSION['varNotaFiscal_IdCliente'])) 
          {
              $this->nm_falta_var .= "varNotaFiscal_IdCliente; ";
          }
          if (!isset($_SESSION['varPrimeiraVez'])) 
          {
              $this->nm_falta_var .= "varPrimeiraVez; ";
          }
          if (!isset($_SESSION['varIdSituacaoDocumentoPendenteInt'])) 
          {
              $this->nm_falta_var .= "varIdSituacaoDocumentoPendenteInt; ";
          }
          if (!isset($_SESSION['varPrivAdmin'])) 
          {
              $this->nm_falta_var .= "varPrivAdmin; ";
          }
      }
// 
      if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_tpbanco; ";
          }
      }
      else
      {
          $this->nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_servidor']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_servidor; ";
          }
      }
      else
      {
          $this->nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_banco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_banco; ";
          }
      }
      else
      {
          $this->nm_banco = $_SESSION['scriptcase']['glo_banco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_usuario']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_usuario; ";
          }
      }
      else
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_senha']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_senha; ";
          }
      }
      else
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_senha']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_persistent']))
      {
          $this->nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_schema']))
      {
          $this->nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
      }
      $this->nm_arr_db_extra_args = array(); 
      if (isset($_SESSION['scriptcase']['glo_use_ssl']))
      {
          $this->nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_charset']))
      {
          $this->nm_arr_db_extra_args['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_rolename']))
      {
          $this->nm_arr_db_extra_args['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_dialect']))
      {
          $this->nm_arr_db_extra_args['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslmode']))
      {
          $this->nm_arr_db_extra_args['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
      {
          $this->nm_arr_db_extra_args['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslkey']))
      {
          $this->nm_arr_db_extra_args['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslcert']))
      {
          $this->nm_arr_db_extra_args['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
      }
      if (isset($_SESSION['scriptcase']['use_ssh']))
      {
          $this->nm_arr_db_extra_args['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_server']))
      {
          $this->nm_arr_db_extra_args['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_user']))
      {
          $this->nm_arr_db_extra_args['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_port']))
      {
          $this->nm_arr_db_extra_args['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_privatecert']))
      {
          $this->nm_arr_db_extra_args['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localserver']))
      {
          $this->nm_arr_db_extra_args['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localport']))
      {
          $this->nm_arr_db_extra_args['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
      {
          $this->nm_arr_db_extra_args['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
      }
      $this->date_delim  = "'";
      $this->date_delim1 = "'";
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access))
      {
          $this->date_delim  = "#";
          $this->date_delim1 = "#";
      }
      if (isset($_SESSION['scriptcase']['glo_decimal_db']) && !empty($_SESSION['scriptcase']['glo_decimal_db']))
      {
         $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
          {
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date1'];
      }
      if (empty($this->nm_tabela))
      {
          $this->nm_tabela = "notafiscal"; 
      }
// 
      if (!empty($this->nm_falta_var) || !empty($this->nm_falta_var_db) || $nm_crit_perfil)
      {
          $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
          $str_message_end = "</body>
</html>";
          $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_dbcn_create'], $str_message);
          if (empty($this->nm_falta_var_db))
          {
              if (!empty($this->nm_falta_var))
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_glob'] . $this->nm_falta_var, $str_message);
              }
              if ($nm_crit_perfil)
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_nfnd'] . ' ' . $perfil_trab, $str_message);
                  $str_message = str_replace('{v_str_btn_inside}', "<button class='ui button primary' style='font-size: 16px!important;'><a href='" . $this->path_prod . "' style='color: white;text-decoration:none'><i class='icon database' style='float: left;padding-right: .5rem;'></i>". $this->Nm_lang['lang_errm_dbcn_create'] ."</a></button>", $str_message);
              }
          }
          else
          {
              $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_data'], $str_message);
          }
          $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
          echo $str_message;
          if (!$_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['iframe_menu'] && (!isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['sc_outra_jan']) || $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['sc_outra_jan'] != 'NotaFiscal_Frm')) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $this->Nm_lang['lang_btns_back'] ?>" title="<?php echo $this->Nm_lang['lang_btns_back_hint'] ?>" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
              elseif(!empty($nm_url_saida)) 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_danger" value="<?php echo $this->Nm_lang['lang_btns_exit'] ?>" title="<?php echo $this->Nm_lang['lang_btns_exit_hint'] ?>" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
      }
  } 
// 
  function conectDB()
  {
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'], $this->root . $this->path_prod, 'LIGA_InfoTIME', 1, $this->force_db_utf8); 
      } 
      else 
      { 
         if (!isset($this->nm_con_persistente))
         {
            $this->nm_con_persistente = 'N';
         }
         if (!isset($this->nm_con_db2))
         {
            $this->nm_con_db2 = '';
         }
         if (!isset($this->nm_database_encoding))
         {
            $this->nm_database_encoding = '';
         }
         if ($this->force_db_utf8)
         {
            $this->nm_database_encoding = 'utf8';
         }
         if (!isset($this->nm_arr_db_extra_args))
         {
            $this->nm_arr_db_extra_args = array();
         }
         $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $this->nm_database_encoding, $this->nm_arr_db_extra_args); 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
      } 
  }

  function setConnectionHash() {
    if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'])) {
      list($connectionDbms, $connectionHost, $connectionUser, $connectionPassword, $connectionDatabase) = db_conect_devel($_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_conexao'], $this->root . $this->path_prod, 'LIGA_InfoTIME', 1, $this->force_db_utf8);
    }
    else {
      $connectionDbms     = $this->nm_tpbanco;
      $connectionHost     = $this->nm_servidor;
      $connectionUser     = $this->nm_usuario;
      $connectionPassword = $this->nm_senha;
      $connectionDatabase = $this->nm_banco;
    }

    $this->connectionHash = "{$connectionDbms}_SC_" . md5("{$connectionHost}_SC_{$connectionUser}_SC_{$connectionPassword}_SC_{$connectionDatabase}");
  } // setConnectionHash
// 

   function regionalDefault($sConfReg = '')
   {
      if ('' == $sConfReg)
      {
         $sConfReg = $this->str_conf_reg;
      }

      $_SESSION['scriptcase']['reg_conf']['date_format']           = (isset($this->Nm_conf_reg[$sConfReg]['data_format']))              ?  $this->Nm_conf_reg[$sConfReg]['data_format']                  : "ddmmyyyy";
      $_SESSION['scriptcase']['reg_conf']['date_sep']              = (isset($this->Nm_conf_reg[$sConfReg]['data_sep']))                 ?  $this->Nm_conf_reg[$sConfReg]['data_sep']                     : "/";
      $_SESSION['scriptcase']['reg_conf']['date_week_ini']         = (isset($this->Nm_conf_reg[$sConfReg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$sConfReg]['prim_dia_sema']                : "SU";
      $_SESSION['scriptcase']['reg_conf']['time_format']           = (isset($this->Nm_conf_reg[$sConfReg]['hora_format']))              ?  $this->Nm_conf_reg[$sConfReg]['hora_format']                  : "hhiiss";
      $_SESSION['scriptcase']['reg_conf']['time_sep']              = (isset($this->Nm_conf_reg[$sConfReg]['hora_sep']))                 ?  $this->Nm_conf_reg[$sConfReg]['hora_sep']                     : ":";
      $_SESSION['scriptcase']['reg_conf']['time_pos_ampm']         = (isset($this->Nm_conf_reg[$sConfReg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$sConfReg]['hora_pos_ampm']                : "right_without_space";
      $_SESSION['scriptcase']['reg_conf']['time_simb_am']          = (isset($this->Nm_conf_reg[$sConfReg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$sConfReg]['hora_simbolo_am']              : "am";
      $_SESSION['scriptcase']['reg_conf']['time_simb_pm']          = (isset($this->Nm_conf_reg[$sConfReg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$sConfReg]['hora_simbolo_pm']              : "pm";
      $_SESSION['scriptcase']['reg_conf']['simb_neg']              = (isset($this->Nm_conf_reg[$sConfReg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$sConfReg]['num_sinal_neg']                : "-";
      $_SESSION['scriptcase']['reg_conf']['grup_num']              = (isset($this->Nm_conf_reg[$sConfReg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$sConfReg]['num_sep_agr']                  : ".";
      $_SESSION['scriptcase']['reg_conf']['dec_num']               = (isset($this->Nm_conf_reg[$sConfReg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$sConfReg]['num_sep_dec']                  : ",";
      $_SESSION['scriptcase']['reg_conf']['neg_num']               = (isset($this->Nm_conf_reg[$sConfReg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$sConfReg]['num_format_num_neg']           : 2;
      $_SESSION['scriptcase']['reg_conf']['monet_simb']            = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_simbolo']            : "R$";
      $_SESSION['scriptcase']['reg_conf']['monet_f_pos']           = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_pos']     : 3;
      $_SESSION['scriptcase']['reg_conf']['monet_f_neg']           = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_neg']     : 13;
      $_SESSION['scriptcase']['reg_conf']['grup_val']              = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_sep_agr']            : ".";
      $_SESSION['scriptcase']['reg_conf']['dec_val']               = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_sep_dec']            : ",";
      $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$sConfReg]['num_group_digit']))          ?  $this->Nm_conf_reg[$sConfReg]['num_group_digit']              : "1";
      $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_group_digit']))    ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_group_digit']        : "1";
      $_SESSION['scriptcase']['reg_conf']['html_dir']              = (isset($this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl'] . "'" : "";
      $_SESSION['scriptcase']['reg_conf']['css_dir']               = (isset($this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl'] : "LTR";
      if ('' == $_SESSION['scriptcase']['reg_conf']['num_group_digit'])
      {
          $_SESSION['scriptcase']['reg_conf']['num_group_digit'] = '1';
      }
      if ('' == $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'])
      {
          $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = '1';
      }
   }
   function sc_Include($path, $tp, $name)
   {
       if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
       {
           include_once($path);
       }
   } // sc_Include
   function sc_Sql_Protect($var, $tp, $conex="")
   {
       if (empty($conex) || $conex == "ligasistemas")
       {
           $TP_banco = $_SESSION['scriptcase']['glo_tpbanco'];
       }
       else
       {
           eval ("\$TP_banco = \$this->nm_con_" . $conex . "['tpbanco'];");
       }
       if ($tp == "date")
       {
           $delim  = "'";
           $delim1 = "'";
           if (in_array(strtolower($TP_banco), $this->nm_bases_access))
           {
               $delim  = "#";
               $delim1 = "#";
           }
           if (isset($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['NotaFiscal_Frm']['SC_sep_date1'];
           }
           return $delim . $var . $delim1;
       }
       else
       {
           return $var;
       }
   } // sc_Sql_Protect
}
//===============================================================================
class NotaFiscal_Frm_edit
{
    var $contr_NotaFiscal_Frm;
    function inicializa()
    {
        global $nm_opc_lookup, $nm_opc_php, $script_case_init;
        require_once("NotaFiscal_Frm_apl.php");
        $this->contr_NotaFiscal_Frm = new NotaFiscal_Frm_apl();
    }
}
if (!function_exists("NM_is_utf8"))
{
    include_once("../_lib/lib/php/nm_utf8.php");
}
ob_start();
//
//----------------  
//
    $_SESSION['scriptcase']['NotaFiscal_Frm']['contr_erro'] = 'off';
    if (!function_exists("NM_is_utf8"))
    {
        include_once("../_lib/lib/php/nm_utf8.php");
    }
    if (!function_exists("SC_dir_app_ini"))
    {
        include_once("../_lib/lib/php/nm_ctrl_app_name.php");
    }
    SC_dir_app_ini('LIGA_InfoTIME');
    $sc_conv_var = array();
    if (!empty($_FILES))
    {
        foreach ($_FILES as $nmgp_campo => $nmgp_valores)
        {
             if (isset($sc_conv_var[$nmgp_campo]))
             {
                 $nmgp_campo = $sc_conv_var[$nmgp_campo];
             }
             elseif (isset($sc_conv_var[strtolower($nmgp_campo)]))
             {
                 $nmgp_campo = $sc_conv_var[strtolower($nmgp_campo)];
             }
             $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
             $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
             $$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
             $$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
             $$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
        }
    }
    $Sc_lig_md5 = false;
    $Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
    $_SESSION['scriptcase']['sem_session'] = false;
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
             if (isset($sc_conv_var[$nmgp_var]))
             {
                 $nmgp_var = $sc_conv_var[$nmgp_var];
             }
             elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
             {
                 $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
             }
             nm_limpa_str_NotaFiscal_Frm($nmgp_val);
             $nmgp_val = NM_decode_input($nmgp_val);
             $$nmgp_var = $nmgp_val;
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
             if (isset($sc_conv_var[$nmgp_var]))
             {
                 $nmgp_var = $sc_conv_var[$nmgp_var];
             }
             elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
             {
                 $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
             }
             nm_limpa_str_NotaFiscal_Frm($nmgp_val);
             $nmgp_val = NM_decode_input($nmgp_val);
             $$nmgp_var = $nmgp_val;
        }
    }
    if (!isset($_SERVER['HTTP_REFERER']) || (!isset($nmgp_parms) && !isset($script_case_init) && !isset($_POST['rs']) && !isset($nmgp_start) ))
    {
        $Sem_Session = false;
    }
    $NM_dir_atual = getcwd();
    if (empty($NM_dir_atual)) {
        $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
        $str_path_sys  = str_replace("\\", '/', $str_path_sys);
    }
    else {
        $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
        $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
    }
    $str_path_web    = $_SERVER['PHP_SELF'];
    $str_path_web    = str_replace("\\", '/', $str_path_web);
    $str_path_web    = str_replace('//', '/', $str_path_web);
    $path_aplicacao  = substr($str_path_web, 0, strrpos($str_path_web, '/'));
    $path_aplicacao  = substr($path_aplicacao, 0, strrpos($path_aplicacao, '/'));
    $root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
    if ($Sem_Session && (!isset($nmgp_start) || $nmgp_start != "SC")) {
        if (isset($_COOKIE['sc_apl_default_LIGA_InfoTIME'])) {
            $apl_def = explode(",", $_COOKIE['sc_apl_default_LIGA_InfoTIME']);
        }
        elseif (is_file($root . $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp'] . "/sc_apl_default_LIGA_InfoTIME.txt")) {
            $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['NotaFiscal_Frm']['glo_nm_path_imag_temp'] . "/sc_apl_default_LIGA_InfoTIME.txt"));
        }
        if (isset($apl_def)) {
            if ($apl_def[0] != "NotaFiscal_Frm") {
                $_SESSION['scriptcase']['sem_session'] = true;
                if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                    $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir'] = $apl_def[0];
                }
                else {
                    $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
                }
                $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
                $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir_tp'] = $Redir_tp;
            }
            if (isset($_COOKIE['sc_actual_lang_LIGA_InfoTIME'])) {
                $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_LIGA_InfoTIME'];
            }
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
    if (isset($SC_where_pdf) && !empty($SC_where_pdf))
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['where_filter'] = $SC_where_pdf;
    }
    if (isset($nmgp_start) && $nmgp_start == "SC")
    {
        $nmgp_outra_jan = "";
    }

    if (isset($_POST['rs']) && !is_array($_POST['rs']) && 'ajax_' == substr($_POST['rs'], 0, 5) && isset($_POST['rsargs']) && !empty($_POST['rsargs']) && !isset($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir']))
    {
        if ('ajax_NotaFiscal_Frm_validate_datacompetencia' == $_POST['rs'])
        {
            $datacompetencia = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idempresa' == $_POST['rs'])
        {
            $idempresa = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idnotafiscal' == $_POST['rs'])
        {
            $idnotafiscal = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idcliente' == $_POST['rs'])
        {
            $idcliente = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idplanoconta' == $_POST['rs'])
        {
            $idplanoconta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_datavencimento' == $_POST['rs'])
        {
            $datavencimento = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_valornotafiscal' == $_POST['rs'])
        {
            $valornotafiscal = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_valoriss' == $_POST['rs'])
        {
            $valoriss = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_valorliquido' == $_POST['rs'])
        {
            $valorliquido = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idusuarioemissao' == $_POST['rs'])
        {
            $idusuarioemissao = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idsituacaodocumento' == $_POST['rs'])
        {
            $idsituacaodocumento = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_boletoliberado' == $_POST['rs'])
        {
            $boletoliberado = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_datarecebimento' == $_POST['rs'])
        {
            $datarecebimento = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_databaixa' == $_POST['rs'])
        {
            $databaixa = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idusuariobaixa' == $_POST['rs'])
        {
            $idusuariobaixa = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_valorbaixa' == $_POST['rs'])
        {
            $valorbaixa = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idlancamentoreceita' == $_POST['rs'])
        {
            $idlancamentoreceita = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_numeronotafiscal' == $_POST['rs'])
        {
            $numeronotafiscal = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_numeronotafiscalcompleto' == $_POST['rs'])
        {
            $numeronotafiscalcompleto = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_competenciasimples' == $_POST['rs'])
        {
            $competenciasimples = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_codigoverificacao' == $_POST['rs'])
        {
            $codigoverificacao = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_datarecebimentonota' == $_POST['rs'])
        {
            $datarecebimentonota = NM_utf8_urldecode($_POST['rsargs'][0]);
            $datarecebimentonota_hora = NM_utf8_urldecode($_POST['rsargs'][1]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][2]);
        }
        if ('ajax_NotaFiscal_Frm_validate_numerolote' == $_POST['rs'])
        {
            $numerolote = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_protocolo' == $_POST['rs'])
        {
            $protocolo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_idusuariocancelamento' == $_POST['rs'])
        {
            $idusuariocancelamento = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_discriminacao' == $_POST['rs'])
        {
            $discriminacao = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_nomereferencia' == $_POST['rs'])
        {
            $nomereferencia = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_nomearquivo' == $_POST['rs'])
        {
            $nomearquivo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_nomereferenciaboleto' == $_POST['rs'])
        {
            $nomereferenciaboleto = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_nomearquivoboleto' == $_POST['rs'])
        {
            $nomearquivoboleto = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_nomereferenciaxml' == $_POST['rs'])
        {
            $nomereferenciaxml = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_validate_nomearquivoxml' == $_POST['rs'])
        {
            $nomearquivoxml = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_NotaFiscal_Frm_event_databaixa_onchange' == $_POST['rs'])
        {
            $databaixa = NM_utf8_urldecode($_POST['rsargs'][0]);
            $idsituacaodocumento = NM_utf8_urldecode($_POST['rsargs'][1]);
            $idusuariobaixa = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_NotaFiscal_Frm_event_idsituacaodocumento_onchange' == $_POST['rs'])
        {
            $idsituacaodocumento = NM_utf8_urldecode($_POST['rsargs'][0]);
            $databaixa = NM_utf8_urldecode($_POST['rsargs'][1]);
            $idusuariobaixa = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_NotaFiscal_Frm_event_valoriss_onchange' == $_POST['rs'])
        {
            $valoriss = NM_utf8_urldecode($_POST['rsargs'][0]);
            $valorliquido = NM_utf8_urldecode($_POST['rsargs'][1]);
            $valornotafiscal = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_NotaFiscal_Frm_event_scajaxbutton_cancelar_onclick' == $_POST['rs'])
        {
            $idempresa = NM_utf8_urldecode($_POST['rsargs'][0]);
            $idnotafiscal = NM_utf8_urldecode($_POST['rsargs'][1]);
            $numeronotafiscalcompleto = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_NotaFiscal_Frm_event_scajaxbutton_gerarnota_onclick' == $_POST['rs'])
        {
            $idempresa = NM_utf8_urldecode($_POST['rsargs'][0]);
            $datacompetencia = NM_utf8_urldecode($_POST['rsargs'][1]);
            $idcliente = NM_utf8_urldecode($_POST['rsargs'][2]);
            $discriminacao = NM_utf8_urldecode($_POST['rsargs'][3]);
            $valornotafiscal = NM_utf8_urldecode($_POST['rsargs'][4]);
            $valoriss = NM_utf8_urldecode($_POST['rsargs'][5]);
            $idnotafiscal = NM_utf8_urldecode($_POST['rsargs'][6]);
            $nomereferenciaxml = NM_utf8_urldecode($_POST['rsargs'][7]);
            $nomearquivoxml = NM_utf8_urldecode($_POST['rsargs'][8]);
            $nomereferencia = NM_utf8_urldecode($_POST['rsargs'][9]);
            $nomearquivo = NM_utf8_urldecode($_POST['rsargs'][10]);
            $valorliquido = NM_utf8_urldecode($_POST['rsargs'][11]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][12]);
        }
        if ('ajax_NotaFiscal_Frm_autocomp_idcliente' == $_POST['rs'])
        {
            $idcliente = NM_utf8_urldecode($_POST['rsargs'][0]);
        }
        if ('ajax_NotaFiscal_Frm_autocomp_idlancamentoreceita' == $_POST['rs'])
        {
            $idlancamentoreceita = NM_utf8_urldecode($_POST['rsargs'][0]);
        }
        if ('ajax_NotaFiscal_Frm_submit_form' == $_POST['rs'])
        {
            $datacompetencia = NM_utf8_urldecode($_POST['rsargs'][0]);
            $idempresa = NM_utf8_urldecode($_POST['rsargs'][1]);
            $idnotafiscal = NM_utf8_urldecode($_POST['rsargs'][2]);
            $idcliente = NM_utf8_urldecode($_POST['rsargs'][3]);
            $idplanoconta = NM_utf8_urldecode($_POST['rsargs'][4]);
            $datavencimento = NM_utf8_urldecode($_POST['rsargs'][5]);
            $valornotafiscal = NM_utf8_urldecode($_POST['rsargs'][6]);
            $valoriss = NM_utf8_urldecode($_POST['rsargs'][7]);
            $valorliquido = NM_utf8_urldecode($_POST['rsargs'][8]);
            $idusuarioemissao = NM_utf8_urldecode($_POST['rsargs'][9]);
            $idsituacaodocumento = NM_utf8_urldecode($_POST['rsargs'][10]);
            $boletoliberado = NM_utf8_urldecode($_POST['rsargs'][11]);
            $datarecebimento = NM_utf8_urldecode($_POST['rsargs'][12]);
            $databaixa = NM_utf8_urldecode($_POST['rsargs'][13]);
            $idusuariobaixa = NM_utf8_urldecode($_POST['rsargs'][14]);
            $valorbaixa = NM_utf8_urldecode($_POST['rsargs'][15]);
            $idlancamentoreceita = NM_utf8_urldecode($_POST['rsargs'][16]);
            $numeronotafiscal = NM_utf8_urldecode($_POST['rsargs'][17]);
            $numeronotafiscalcompleto = NM_utf8_urldecode($_POST['rsargs'][18]);
            $competenciasimples = NM_utf8_urldecode($_POST['rsargs'][19]);
            $codigoverificacao = NM_utf8_urldecode($_POST['rsargs'][20]);
            $datarecebimentonota = NM_utf8_urldecode($_POST['rsargs'][21]);
            $datarecebimentonota_hora = NM_utf8_urldecode($_POST['rsargs'][22]);
            $numerolote = NM_utf8_urldecode($_POST['rsargs'][23]);
            $protocolo = NM_utf8_urldecode($_POST['rsargs'][24]);
            $idusuariocancelamento = NM_utf8_urldecode($_POST['rsargs'][25]);
            $discriminacao = NM_utf8_urldecode($_POST['rsargs'][26]);
            $nomereferencia = NM_utf8_urldecode($_POST['rsargs'][27]);
            $nomearquivo = NM_utf8_urldecode($_POST['rsargs'][28]);
            $nomereferenciaboleto = NM_utf8_urldecode($_POST['rsargs'][29]);
            $nomearquivoboleto = NM_utf8_urldecode($_POST['rsargs'][30]);
            $nomereferenciaxml = NM_utf8_urldecode($_POST['rsargs'][31]);
            $nomearquivoxml = NM_utf8_urldecode($_POST['rsargs'][32]);
            $nomereferencia_ul_name = NM_utf8_urldecode($_POST['rsargs'][33]);
            $nomereferencia_ul_type = NM_utf8_urldecode($_POST['rsargs'][34]);
            $nomereferenciaboleto_ul_name = NM_utf8_urldecode($_POST['rsargs'][35]);
            $nomereferenciaboleto_ul_type = NM_utf8_urldecode($_POST['rsargs'][36]);
            $nomereferenciaxml_ul_name = NM_utf8_urldecode($_POST['rsargs'][37]);
            $nomereferenciaxml_ul_type = NM_utf8_urldecode($_POST['rsargs'][38]);
            $nomereferencia_salva = NM_utf8_urldecode($_POST['rsargs'][39]);
            $nomereferencia_limpa = NM_utf8_urldecode($_POST['rsargs'][40]);
            $nomereferenciaboleto_salva = NM_utf8_urldecode($_POST['rsargs'][41]);
            $nomereferenciaboleto_limpa = NM_utf8_urldecode($_POST['rsargs'][42]);
            $nomereferenciaxml_salva = NM_utf8_urldecode($_POST['rsargs'][43]);
            $nomereferenciaxml_limpa = NM_utf8_urldecode($_POST['rsargs'][44]);
            $nm_form_submit = NM_utf8_urldecode($_POST['rsargs'][45]);
            $nmgp_url_saida = NM_utf8_urldecode($_POST['rsargs'][46]);
            $nmgp_opcao = NM_utf8_urldecode($_POST['rsargs'][47]);
            $nmgp_ancora = NM_utf8_urldecode($_POST['rsargs'][48]);
            $nmgp_num_form = NM_utf8_urldecode($_POST['rsargs'][49]);
            $nmgp_parms = NM_utf8_urldecode($_POST['rsargs'][50]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][51]);
            $csrf_token = NM_utf8_urldecode($_POST['rsargs'][52]);
        }
        if ('ajax_NotaFiscal_Frm_navigate_form' == $_POST['rs'])
        {
            $idnotafiscal = NM_utf8_urldecode($_POST['rsargs'][0]);
            $nm_form_submit = NM_utf8_urldecode($_POST['rsargs'][1]);
            $nmgp_opcao = NM_utf8_urldecode($_POST['rsargs'][2]);
            $nmgp_ordem = NM_utf8_urldecode($_POST['rsargs'][3]);
            $nmgp_arg_dyn_search = NM_utf8_urldecode($_POST['rsargs'][4]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][5]);
        }
    }

    if (!empty($glo_perfil))  
    { 
        $_SESSION['scriptcase']['glo_perfil'] = $glo_perfil;
    }   
    if (isset($glo_servidor)) 
    {
        $_SESSION['scriptcase']['glo_servidor'] = $glo_servidor;
    }
    if (isset($glo_banco)) 
    {
        $_SESSION['scriptcase']['glo_banco'] = $glo_banco;
    }
    if (isset($glo_tpbanco)) 
    {
        $_SESSION['scriptcase']['glo_tpbanco'] = $glo_tpbanco;
    }
    if (isset($glo_usuario)) 
    {
        $_SESSION['scriptcase']['glo_usuario'] = $glo_usuario;
    }
    if (isset($glo_senha)) 
    {
        $_SESSION['scriptcase']['glo_senha'] = $glo_senha;
    }
    if (isset($glo_senha_protect)) 
    {
        $_SESSION['scriptcase']['glo_senha_protect'] = $glo_senha_protect;
    }
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup']     = false;
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup_cb']  = '';
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['lig_edit_lookup_row'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_call']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_call'] = false;
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_proc']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_proc'] = false;
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_insert']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_insert'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_update']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_update'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_delete']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_delete'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_btn_nav']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_form_btn_nav'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_grid_edit']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_grid_edit'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_grid_edit_link']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_grid_edit_link'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_qtd_reg']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_qtd_reg'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_tp_pag']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_liga_tp_pag'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_modal']))
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_modal'] = isset($_GET['nmgp_url_saida']) && 'modal' == $_GET['nmgp_url_saida'];
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_proc'])
    {
        return;
    }
    if (isset($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_parms']))
    { 
        $tmp_nmgp_parms = '';
        if (isset($nmgp_parms) && '' != $nmgp_parms)
        {
            $tmp_nmgp_parms = $nmgp_parms . '?@?';
        }
        $nmgp_parms = $tmp_nmgp_parms . $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_parms'];
        unset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_parms']);
    } 
    if (isset($nmgp_parms) && !empty($nmgp_parms) && !is_array($nmgp_parms)) 
    { 
        if (isset($_SESSION['nm_aba_bg_color'])) 
        { 
            unset($_SESSION['nm_aba_bg_color']);
        }   
        $nmgp_parms = NM_decode_input($nmgp_parms);
        $nmgp_parms = str_replace("@aspass@", "'", $nmgp_parms);
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
               nm_limpa_str_NotaFiscal_Frm($cadapar[1]);
               if (isset($sc_conv_var[$cadapar[0]]))
               {
                   $cadapar[0] = $sc_conv_var[$cadapar[0]];
               }
               elseif (isset($sc_conv_var[strtolower($cadapar[0])]))
               {
                   $cadapar[0] = $sc_conv_var[strtolower($cadapar[0])];
               }
               if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
               $Tmp_par   = $cadapar[0];
               $$Tmp_par = $cadapar[1];
           }
           $ix++;
        }
        if (!isset($varIdTenacidade) && isset($varidtenacidade)) 
        {
            $varIdTenacidade = $varidtenacidade;
        }
        if (isset($varIdTenacidade)) 
        {
            $_SESSION['varIdTenacidade'] = $varIdTenacidade;
        }
        if (!isset($varNotaFiscal_IdCliente) && isset($varnotafiscal_idcliente)) 
        {
            $varNotaFiscal_IdCliente = $varnotafiscal_idcliente;
        }
        if (isset($varNotaFiscal_IdCliente)) 
        {
            $_SESSION['varNotaFiscal_IdCliente'] = $varNotaFiscal_IdCliente;
        }
        if (!isset($varIdUsuario) && isset($varidusuario)) 
        {
            $varIdUsuario = $varidusuario;
        }
        if (isset($varIdUsuario)) 
        {
            $_SESSION['varIdUsuario'] = $varIdUsuario;
        }
        if (!isset($varDiretorioArquivo) && isset($vardiretorioarquivo)) 
        {
            $varDiretorioArquivo = $vardiretorioarquivo;
        }
        if (isset($varDiretorioArquivo)) 
        {
            $_SESSION['varDiretorioArquivo'] = $varDiretorioArquivo;
        }
        if (!isset($varIdLancamentoReceita) && isset($varidlancamentoreceita)) 
        {
            $varIdLancamentoReceita = $varidlancamentoreceita;
        }
        if (isset($varIdLancamentoReceita)) 
        {
            $_SESSION['varIdLancamentoReceita'] = $varIdLancamentoReceita;
        }
        if (!isset($varPrimeiraVez) && isset($varprimeiravez)) 
        {
            $varPrimeiraVez = $varprimeiravez;
        }
        if (isset($varPrimeiraVez)) 
        {
            $_SESSION['varPrimeiraVez'] = $varPrimeiraVez;
        }
        if (!isset($varIdSituacaoDocumentoPendenteInt) && isset($varidsituacaodocumentopendenteint)) 
        {
            $varIdSituacaoDocumentoPendenteInt = $varidsituacaodocumentopendenteint;
        }
        if (isset($varIdSituacaoDocumentoPendenteInt)) 
        {
            $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $varIdSituacaoDocumentoPendenteInt;
        }
        if (!isset($varNomeReferencia) && isset($varnomereferencia)) 
        {
            $varNomeReferencia = $varnomereferencia;
        }
        if (isset($varNomeReferencia)) 
        {
            $_SESSION['varNomeReferencia'] = $varNomeReferencia;
        }
        if (!isset($varNomeReferenciaBoleto) && isset($varnomereferenciaboleto)) 
        {
            $varNomeReferenciaBoleto = $varnomereferenciaboleto;
        }
        if (isset($varNomeReferenciaBoleto)) 
        {
            $_SESSION['varNomeReferenciaBoleto'] = $varNomeReferenciaBoleto;
        }
        if (!isset($varPrivAdmin) && isset($varprivadmin)) 
        {
            $varPrivAdmin = $varprivadmin;
        }
        if (isset($varPrivAdmin)) 
        {
            $_SESSION['varPrivAdmin'] = $varPrivAdmin;
        }
    } 
    elseif (isset($script_case_init) && !empty($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['parms']))
    {
        if (!isset($nmgp_opcao) || ($nmgp_opcao != "incluir" && $nmgp_opcao != "novo" && $nmgp_opcao != "recarga" && $nmgp_opcao != "muda_form"))
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
               $Tmp_par   = $cadapar[0];
               $$Tmp_par = $cadapar[1];
               $ix++;
            }
        }
    } 
    if (isset($script_case_init) && $script_case_init != preg_replace('/[^0-9.-]/', '', $script_case_init))
    {
        unset($script_case_init);
    }
    if (!isset($script_case_init) || empty($script_case_init) || is_array($script_case_init))
    {
        $script_case_init = rand(2, 10000);
    }
    $salva_run = "N";
    $salva_iframe = false;
    if (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu']))
    {
        $salva_iframe = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu'];
        unset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu']);
    }
    if (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe']))
    {
        $salva_run = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'];
        unset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe']);
    }
    if (isset($nm_run_menu) && $nm_run_menu == 1)
    {
        if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && isset($_SESSION['scriptcase']['sc_apl_menu_atual']))
        {
            foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
            {
                if ($aba == $_SESSION['scriptcase']['sc_apl_menu_atual'])
                {
                    unset($_SESSION['scriptcase']['sc_aba_iframe'][$aba]);
                    break;
                }
            }
        }
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "NotaFiscal_Frm";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'NotaFiscal_Frm' || $achou)
                {
                    unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                    if (!empty($_SESSION['sc_session'][$script_case_init][$nome_apl]))
                    {
                        $achou = true;
                    }
                }
            }
            if (!$achou && isset($nm_apl_menu))
            {
                foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
                {
                    if ($nome_apl == $nm_apl_menu || $achou)
                    {
                        $achou = true;
                        if ($nome_apl != $nm_apl_menu)
                        {
                            unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                        }
                    }
                }
            }
        }
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu']  = true;
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['mostra_cab']   = "S";
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe']   = "N";
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['retorno_edit'] = "";
    }
    else
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe']  = $salva_run;
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['iframe_menu'] = $salva_iframe;
    }

    if (!isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['db_changed']))
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['db_changed'] = false;
    }
    if (isset($_GET['nmgp_outra_jan']) && 'true' == $_GET['nmgp_outra_jan'] && isset($_GET['nmgp_url_saida']) && 'modal' == $_GET['nmgp_url_saida'])
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['db_changed'] = false;
    }

    if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'NotaFiscal_Frm')
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan'] = true;
         unset($_SESSION['scriptcase']['sc_outra_jan']);
    }
    if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
    {
        if (isset($nmgp_url_saida) && $nmgp_url_saida == "modal")
        {
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_modal'] = true;
            $nm_url_saida = "NotaFiscal_Frm_fim.php"; 
        }
        $nm_apl_dependente = 0;
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan'] = true;
    }
    if (!isset($nm_apl_dependente)) {
        $nm_apl_dependente = 0;
    }
    $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "pt_br";
    if (isset($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['lang'])) {
        $STR_lang = $_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['lang'];
    }
      $STR_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Liga_Soft_sm/Liga_Soft_sm";
    $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
    $Nm_lang = array();
    if (is_file($NM_arq_lang))
    {
        $Lixo = file($NM_arq_lang);
        foreach ($Lixo as $Cada_lin) 
        {
            if (strpos($Cada_lin, "array()") === false && (trim($Cada_lin) != "<?php")  && (trim($Cada_lin) != "?" . ">"))
            {
                eval (str_replace("\$this->", "\$", $Cada_lin));
            }
        }
    }
    $_SESSION['scriptcase']['charset'] = "UTF-8";
    ini_set('default_charset', $_SESSION['scriptcase']['charset']);
    foreach ($Nm_lang as $ind => $dados)
    {
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
       {
           $Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
    }

    if (!isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['initialize']))
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['initialize'] = true;
    }
    elseif (!isset($_SERVER['HTTP_REFERER']))
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['initialize'] = false;
    }
    elseif (false === strpos($_SERVER['HTTP_REFERER'], '.php'))
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['initialize'] = true;
    }
    else
    {
        $sReferer = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], '.php'));
        $sReferer = substr($sReferer, strrpos($sReferer, '/') + 1);
        if ('NotaFiscal_Frm' == $sReferer || 'NotaFiscal_Frm_' == substr($sReferer, 0, 15))
        {
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['initialize'] = false;
        }
        else
        {
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['initialize'] = true;
        }
    }

    if (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['first_time']))
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['first_time'] = false;
    }
    else
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['first_time'] = true;
    }

    $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['menu_desenv'] = false;   
    if (!defined("SC_ERROR_HANDLER"))
    {
        define("SC_ERROR_HANDLER", 1);
    }
    include_once(dirname(__FILE__) . "/NotaFiscal_Frm_erro.php");
    $nm_browser = strpos($_SERVER['HTTP_USER_AGENT'], "Konqueror") ;
    if (is_int($nm_browser))   
    {
        $nm_browser = "Konqueror"; 
    } 
    else  
    {
        $nm_browser = strpos($_SERVER['HTTP_USER_AGENT'], "Opera") ;
        if (is_int($nm_browser))   
        {
            $nm_browser = "Opera"; 
        }
    } 
    $_SESSION['scriptcase']['change_regional_old'] = '';
    $_SESSION['scriptcase']['change_regional_new'] = '';
    if (!empty($nmgp_opcao) && ($nmgp_opcao == "change_lang_t" || $nmgp_opcao == "change_lang_b" || $nmgp_opcao == "change_lang_f" || $nmgp_opcao == "force_lang"))  
    {
        $Temp_lang = $nmgp_opcao == "force_lang" ? explode(";" , $nmgp_idioma) : explode(";" , $nmgp_idioma_novo);  
        if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
        { 
            $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
        } 
        if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
        { 
            $_SESSION['scriptcase']['change_regional_old'] = (isset($_SESSION['scriptcase']['str_conf_reg']) && !empty($_SESSION['scriptcase']['str_conf_reg'])) ? $_SESSION['scriptcase']['str_conf_reg'] : "pt_br";
            $_SESSION['scriptcase']['str_conf_reg']        = $Temp_lang[1];
            $_SESSION['scriptcase']['change_regional_new'] = $_SESSION['scriptcase']['str_conf_reg'];
        } 
        $nmgp_opcao = $nmgp_opcao == "force_lang" ? "inicio" : "igual";
    } 
    if (!empty($nmgp_opcao) && ($nmgp_opcao == "change_schema_t" || $nmgp_opcao == "change_schema_b" || $nmgp_opcao == "change_schema_f"))  
    {
        if ($nmgp_opcao == "change_schema_t")  
        {
            $nmgp_schema = $nmgp_schema_t . "/" . $nmgp_schema_t;  
        } 
        elseif ($nmgp_opcao == "change_schema_b")  
        {
            $nmgp_schema = $nmgp_schema_b . "/" . $nmgp_schema_b;  
        } 
        else 
        {
            $nmgp_schema = $nmgp_schema_f . "/" . $nmgp_schema_f;  
        } 
        $_SESSION['scriptcase']['str_schema_all'] = $nmgp_schema;
        $nmgp_opcao = "recarga";  
    } 
    if (!empty($nmgp_opcao) && $nmgp_opcao == "lookup")  
    {
        $nm_opc_lookup = $nmgp_opcao;
    }
    elseif (!empty($nmgp_opcao) && $nmgp_opcao == "formphp")  
    {
        $nm_opc_form_php = $nmgp_opcao;
    }
    else
    {
        if (!empty($nmgp_opcao))  
        {
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['opcao'] = $nmgp_opcao ; 
        }
        if (isset($_POST["varIdTenacidade"])) 
        {
            $_SESSION['varIdTenacidade'] = $_POST["varIdTenacidade"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdTenacidade']);
        }
        if (!isset($_POST["varIdTenacidade"]) && isset($_POST["varidtenacidade"])) 
        {
            $_SESSION['varIdTenacidade'] = $_POST["varidtenacidade"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdTenacidade']);
        }
        if (isset($_GET["varIdTenacidade"])) 
        {
            $_SESSION['varIdTenacidade'] = $_GET["varIdTenacidade"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdTenacidade']);
        }
        if (!isset($_GET["varIdTenacidade"]) && isset($_GET["varidtenacidade"])) 
        {
            $_SESSION['varIdTenacidade'] = $_GET["varidtenacidade"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdTenacidade']);
        }
        if (isset($_POST["varNotaFiscal_IdCliente"])) 
        {
            $_SESSION['varNotaFiscal_IdCliente'] = $_POST["varNotaFiscal_IdCliente"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNotaFiscal_IdCliente']);
        }
        if (!isset($_POST["varNotaFiscal_IdCliente"]) && isset($_POST["varnotafiscal_idcliente"])) 
        {
            $_SESSION['varNotaFiscal_IdCliente'] = $_POST["varnotafiscal_idcliente"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNotaFiscal_IdCliente']);
        }
        if (isset($_GET["varNotaFiscal_IdCliente"])) 
        {
            $_SESSION['varNotaFiscal_IdCliente'] = $_GET["varNotaFiscal_IdCliente"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNotaFiscal_IdCliente']);
        }
        if (!isset($_GET["varNotaFiscal_IdCliente"]) && isset($_GET["varnotafiscal_idcliente"])) 
        {
            $_SESSION['varNotaFiscal_IdCliente'] = $_GET["varnotafiscal_idcliente"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNotaFiscal_IdCliente']);
        }
        if (isset($_POST["varIdUsuario"])) 
        {
            $_SESSION['varIdUsuario'] = $_POST["varIdUsuario"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdUsuario']);
        }
        if (!isset($_POST["varIdUsuario"]) && isset($_POST["varidusuario"])) 
        {
            $_SESSION['varIdUsuario'] = $_POST["varidusuario"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdUsuario']);
        }
        if (isset($_GET["varIdUsuario"])) 
        {
            $_SESSION['varIdUsuario'] = $_GET["varIdUsuario"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdUsuario']);
        }
        if (!isset($_GET["varIdUsuario"]) && isset($_GET["varidusuario"])) 
        {
            $_SESSION['varIdUsuario'] = $_GET["varidusuario"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdUsuario']);
        }
        if (isset($_POST["varDiretorioArquivo"])) 
        {
            $_SESSION['varDiretorioArquivo'] = $_POST["varDiretorioArquivo"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varDiretorioArquivo']);
        }
        if (!isset($_POST["varDiretorioArquivo"]) && isset($_POST["vardiretorioarquivo"])) 
        {
            $_SESSION['varDiretorioArquivo'] = $_POST["vardiretorioarquivo"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varDiretorioArquivo']);
        }
        if (isset($_GET["varDiretorioArquivo"])) 
        {
            $_SESSION['varDiretorioArquivo'] = $_GET["varDiretorioArquivo"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varDiretorioArquivo']);
        }
        if (!isset($_GET["varDiretorioArquivo"]) && isset($_GET["vardiretorioarquivo"])) 
        {
            $_SESSION['varDiretorioArquivo'] = $_GET["vardiretorioarquivo"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varDiretorioArquivo']);
        }
        if (isset($_POST["varIdLancamentoReceita"])) 
        {
            $_SESSION['varIdLancamentoReceita'] = $_POST["varIdLancamentoReceita"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdLancamentoReceita']);
        }
        if (!isset($_POST["varIdLancamentoReceita"]) && isset($_POST["varidlancamentoreceita"])) 
        {
            $_SESSION['varIdLancamentoReceita'] = $_POST["varidlancamentoreceita"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdLancamentoReceita']);
        }
        if (isset($_GET["varIdLancamentoReceita"])) 
        {
            $_SESSION['varIdLancamentoReceita'] = $_GET["varIdLancamentoReceita"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdLancamentoReceita']);
        }
        if (!isset($_GET["varIdLancamentoReceita"]) && isset($_GET["varidlancamentoreceita"])) 
        {
            $_SESSION['varIdLancamentoReceita'] = $_GET["varidlancamentoreceita"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdLancamentoReceita']);
        }
        if (isset($_POST["varPrimeiraVez"])) 
        {
            $_SESSION['varPrimeiraVez'] = $_POST["varPrimeiraVez"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrimeiraVez']);
        }
        if (!isset($_POST["varPrimeiraVez"]) && isset($_POST["varprimeiravez"])) 
        {
            $_SESSION['varPrimeiraVez'] = $_POST["varprimeiravez"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrimeiraVez']);
        }
        if (isset($_GET["varPrimeiraVez"])) 
        {
            $_SESSION['varPrimeiraVez'] = $_GET["varPrimeiraVez"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrimeiraVez']);
        }
        if (!isset($_GET["varPrimeiraVez"]) && isset($_GET["varprimeiravez"])) 
        {
            $_SESSION['varPrimeiraVez'] = $_GET["varprimeiravez"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrimeiraVez']);
        }
        if (isset($_POST["varIdSituacaoDocumentoPendenteInt"])) 
        {
            $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_POST["varIdSituacaoDocumentoPendenteInt"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdSituacaoDocumentoPendenteInt']);
        }
        if (!isset($_POST["varIdSituacaoDocumentoPendenteInt"]) && isset($_POST["varidsituacaodocumentopendenteint"])) 
        {
            $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_POST["varidsituacaodocumentopendenteint"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdSituacaoDocumentoPendenteInt']);
        }
        if (isset($_GET["varIdSituacaoDocumentoPendenteInt"])) 
        {
            $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_GET["varIdSituacaoDocumentoPendenteInt"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdSituacaoDocumentoPendenteInt']);
        }
        if (!isset($_GET["varIdSituacaoDocumentoPendenteInt"]) && isset($_GET["varidsituacaodocumentopendenteint"])) 
        {
            $_SESSION['varIdSituacaoDocumentoPendenteInt'] = $_GET["varidsituacaodocumentopendenteint"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varIdSituacaoDocumentoPendenteInt']);
        }
        if (isset($_POST["varNomeReferencia"])) 
        {
            $_SESSION['varNomeReferencia'] = $_POST["varNomeReferencia"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferencia']);
        }
        if (!isset($_POST["varNomeReferencia"]) && isset($_POST["varnomereferencia"])) 
        {
            $_SESSION['varNomeReferencia'] = $_POST["varnomereferencia"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferencia']);
        }
        if (isset($_GET["varNomeReferencia"])) 
        {
            $_SESSION['varNomeReferencia'] = $_GET["varNomeReferencia"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferencia']);
        }
        if (!isset($_GET["varNomeReferencia"]) && isset($_GET["varnomereferencia"])) 
        {
            $_SESSION['varNomeReferencia'] = $_GET["varnomereferencia"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferencia']);
        }
        if (isset($_POST["varNomeReferenciaBoleto"])) 
        {
            $_SESSION['varNomeReferenciaBoleto'] = $_POST["varNomeReferenciaBoleto"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferenciaBoleto']);
        }
        if (!isset($_POST["varNomeReferenciaBoleto"]) && isset($_POST["varnomereferenciaboleto"])) 
        {
            $_SESSION['varNomeReferenciaBoleto'] = $_POST["varnomereferenciaboleto"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferenciaBoleto']);
        }
        if (isset($_GET["varNomeReferenciaBoleto"])) 
        {
            $_SESSION['varNomeReferenciaBoleto'] = $_GET["varNomeReferenciaBoleto"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferenciaBoleto']);
        }
        if (!isset($_GET["varNomeReferenciaBoleto"]) && isset($_GET["varnomereferenciaboleto"])) 
        {
            $_SESSION['varNomeReferenciaBoleto'] = $_GET["varnomereferenciaboleto"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varNomeReferenciaBoleto']);
        }
        if (isset($_POST["varPrivAdmin"])) 
        {
            $_SESSION['varPrivAdmin'] = $_POST["varPrivAdmin"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrivAdmin']);
        }
        if (!isset($_POST["varPrivAdmin"]) && isset($_POST["varprivadmin"])) 
        {
            $_SESSION['varPrivAdmin'] = $_POST["varprivadmin"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrivAdmin']);
        }
        if (isset($_GET["varPrivAdmin"])) 
        {
            $_SESSION['varPrivAdmin'] = $_GET["varPrivAdmin"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrivAdmin']);
        }
        if (!isset($_GET["varPrivAdmin"]) && isset($_GET["varprivadmin"])) 
        {
            $_SESSION['varPrivAdmin'] = $_GET["varprivadmin"];
            nm_limpa_str_NotaFiscal_Frm($_SESSION['varPrivAdmin']);
        }
        if (!empty($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_redirect_apl']))
        {
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_redirect_apl']; 
            $nm_apl_dependente = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_redirect_tp']; 
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_redirect_apl'] = "";
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_redirect_tp'] = "";
            $nm_url_saida = "NotaFiscal_Frm_fim.php"; 
        }
        elseif (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan'] == 'true')
        {
               $nm_url_saida = "NotaFiscal_Frm_fim.php"; 
        }
        elseif ($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "R")
        {
            $trab_path             = explode("/", $_SERVER['PHP_SELF']);
            $trab_count_path       = count($trab_path);
            $path_retorno_aplicacao  = "";
            for ($ix = 0; $ix + 2 < $trab_count_path; $ix++)
            {
                 $path_retorno_aplicacao .=  $trab_path[$ix] . "/";
            }
            $path_retorno_aplicacao .=  "" . SC_dir_app_name('NotaFiscal_Lst') . "/NotaFiscal_Lst.php";
            $nm_url_saida = $path_retorno_aplicacao;
            $nm_apl_dependente = 1; 
            $nm_saida_global = $nm_url_saida;
            if ($nm_apl_dependente != 1) 
            { 
                $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] = "N"; 
            } 
            if ($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "R" && (!isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_call']) || !$_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['embutida_call']))
            { 
                $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida; 
                $nm_url_saida = "NotaFiscal_Frm_fim.php"; 
                $_SESSION['scriptcase']['sc_tp_saida'] = "P"; 
                if ($nm_apl_dependente == 1) 
                { 
                    $_SESSION['scriptcase']['sc_tp_saida'] = "D"; 
                } 
            } 
        }
        if (empty($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_tp']) && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "R")
        {
            if (!isset($nm_saida_global)) {
                $nm_saida_global = $nm_url_saida;
            }
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_php'] = $nm_url_saida;
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_apl'] = $nm_saida_global;
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_ss']  = (isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init])) ? $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] : "";
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_dep'] = (isset($nm_apl_dependente)) ? $nm_apl_dependente : "";
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_tp']  = (isset($_SESSION['scriptcase']['sc_tp_saida'])) ? $_SESSION['scriptcase']['sc_tp_saida'] : "";
        }
        $nm_url_saida      = (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_php'])) ? $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_php'] : "";
        $nm_apl_dependente = (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_dep'])) ? $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_dep'] : "";
        $nm_saida_global   = $nm_url_saida;
        if ($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "R" && !empty($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_ss'])) 
        { 
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_ss'];
            $_SESSION['scriptcase']['sc_tp_saida']  = $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['volta_tp'];
        } 
        if ($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] == "F" || $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] == "R") 
        { 
            if (!empty($nmgp_url_saida) && empty($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['retorno_edit'])) 
            {
                $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['retorno_edit'] = $nmgp_url_saida . "?script_case_init=" . $script_case_init; 
            } 
        } 
        if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['run_iframe'] != "R") 
        { 
            $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['menu_desenv'] = true;   
        } 
    }
    if (isset($nmgp_redir)) 
    { 
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['redir'] = $nmgp_redir;   
    } 
    if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
    {
        $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan'] = true;
         if (isset($nmgp_url_saida) && $nmgp_url_saida == "modal")
         {
             $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_modal'] = true;
             $nm_url_saida = "NotaFiscal_Frm_fim.php"; 
         }
    }
    if (isset($_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['NotaFiscal_Frm']['sc_outra_jan'])
    {
        $nm_apl_dependente = 0;
    }
    $GLOBALS["NM_ERRO_IBASE"] = 0;  
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['NotaFiscal_Frm'] = "on";
    } 
    if (!isset($_SESSION['scriptcase']['NotaFiscal_Frm']['session_timeout']['redir']) && (!isset($_SESSION['scriptcase']['sc_apl_seg']['NotaFiscal_Frm']) || $_SESSION['scriptcase']['sc_apl_seg']['NotaFiscal_Frm'] != "on"))
    { 
        $NM_Mens_Erro = $Nm_lang['lang_errm_unth_user'];
        $nm_botao_ok = true;
        if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
        {
            foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
            {
                if (in_array("NotaFiscal_Frm", $apls_aba))
                {
                    $nm_botao_ok = false;
                     break;
                }
            }
        }
      $str_schema_app = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Liga_Soft_sm/Liga_Soft_sm";
       $str_button_app = trim($str_button);
    header("X-XSS-Protection: 1; mode=block");
    header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE html>

        <HTML>
         <HEAD>
          <TITLE></TITLE>
          <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

        if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
        {
?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
        }

?>
          <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
          <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
          <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
          <META http-equiv="Pragma" content="no-cache" />
          <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>          <META http-equiv="Pragma" content="no-cache"/>
          <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
          <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $str_schema_app ?>_form.css" />
          <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $str_schema_app ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
          <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $str_button_app . '/' . $str_button_app ?>.css" />
         </HEAD>
         <body class="scFormPage">
          <div class="scFormBorder">
          <table align="center" style="width: 100%" class="scFormTable"><tr><td class="scFormDataOdd" style="padding: 15px 30px; text-align: center">
           <?php echo $NM_Mens_Erro; ?>
<?php
        if ($nm_botao_ok)
        {
            $trab_path             = explode("/", $_SERVER['PHP_SELF']);
            $trab_count_path       = count($trab_path);
            $path_retorno_aplicacao  = "";
            for ($ix = 0; $ix + 2 < $trab_count_path; $ix++)
            {
                 $path_retorno_aplicacao .=  $trab_path[$ix] . "/";
            }
            $path_retorno_aplicacao .=  "" . SC_dir_app_name('Login_Ctr') . "/Login_Ctr.php";
            $nm_redirect = $path_retorno_aplicacao;
?>
          <br />
          <form name="Fseg" method="post" 
                              action="<?php echo $nm_redirect; ?>" 
                              target="_self"> 
           <input type="hidden" name="script_case_init" value="<?php echo $script_case_init; ?>"/> 
           <input type="submit" name="sc_sai_seg" value="OK" class="" > 
          </form> 
          <script type="text/javascript">
            function nm_move()
            { }
            function nm_atualiza()
            { }
          </script> 
<?php
        }
?>
          </td></tr></table>
          </div>
<?php
       if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']))
       {
?>
<br /><br /><br />
<div class="scFormBorder">
 <table align="center" style="width: 450px" class="scFormTable">
  <tr>
   <td class="scFormDataOdd" style="padding: 15px 30px">
    <?php echo $Nm_lang['lang_errm_unth_hwto']; ?>
   </td>
  </tr>
 </table>
</div>
<?php
       }
?>
         </body>
        </HTML>
<?php
        exit;
    } 
    $inicial_NotaFiscal_Frm = new NotaFiscal_Frm_edit();
    $inicial_NotaFiscal_Frm->inicializa();

    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['select_html'] = array();
    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['select_html']['idempresa'] = "class=\"sc-js-input scFormObjectOdd css_idempresa_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_idempresa\" name=\"idempresa\" size=\"1\" alt=\"{type: 'select', enterTab: false}\"";
    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['select_html']['idplanoconta'] = "class=\"sc-js-input scFormObjectOdd css_idplanoconta_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_idplanoconta\" name=\"idplanoconta\" size=\"1\" alt=\"{type: 'select', enterTab: false}\"";
    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['select_html']['idusuarioemissao'] = "class=\"sc-js-input scFormObjectOdd css_idusuarioemissao_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_idusuarioemissao\" name=\"idusuarioemissao\" size=\"1\" alt=\"{type: 'select', enterTab: false}\"";
    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['select_html']['idsituacaodocumento'] = "class=\"sc-js-input scFormObjectOdd css_idsituacaodocumento_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_idsituacaodocumento\" name=\"idsituacaodocumento\" size=\"1\" alt=\"{type: 'select', enterTab: false}\"";
    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['select_html']['boletoliberado'] = " onClick=\"\" ";
    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['select_html']['idusuariobaixa'] = "class=\"sc-js-input scFormObjectOdd css_idusuariobaixa_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_idusuariobaixa\" name=\"idusuariobaixa\" size=\"1\" alt=\"{type: 'select', enterTab: false}\"";

    if (!defined('SC_SAJAX_LOADED'))
    {
        include_once(dirname(__FILE__) . '/NotaFiscal_Frm_sajax.php');
        define('SC_SAJAX_LOADED', 'YES');
    }
    if (!class_exists('Services_JSON'))
    {
        include_once(dirname(__FILE__) . '/NotaFiscal_Frm_json.php');
    }
    $sajax_request_type = "POST";
    sajax_init();
    //$sajax_debug_mode = 1;
    sajax_export("ajax_NotaFiscal_Frm_validate_datacompetencia");
    sajax_export("ajax_NotaFiscal_Frm_validate_idempresa");
    sajax_export("ajax_NotaFiscal_Frm_validate_idnotafiscal");
    sajax_export("ajax_NotaFiscal_Frm_validate_idcliente");
    sajax_export("ajax_NotaFiscal_Frm_validate_idplanoconta");
    sajax_export("ajax_NotaFiscal_Frm_validate_datavencimento");
    sajax_export("ajax_NotaFiscal_Frm_validate_valornotafiscal");
    sajax_export("ajax_NotaFiscal_Frm_validate_valoriss");
    sajax_export("ajax_NotaFiscal_Frm_validate_valorliquido");
    sajax_export("ajax_NotaFiscal_Frm_validate_idusuarioemissao");
    sajax_export("ajax_NotaFiscal_Frm_validate_idsituacaodocumento");
    sajax_export("ajax_NotaFiscal_Frm_validate_boletoliberado");
    sajax_export("ajax_NotaFiscal_Frm_validate_datarecebimento");
    sajax_export("ajax_NotaFiscal_Frm_validate_databaixa");
    sajax_export("ajax_NotaFiscal_Frm_validate_idusuariobaixa");
    sajax_export("ajax_NotaFiscal_Frm_validate_valorbaixa");
    sajax_export("ajax_NotaFiscal_Frm_validate_idlancamentoreceita");
    sajax_export("ajax_NotaFiscal_Frm_validate_numeronotafiscal");
    sajax_export("ajax_NotaFiscal_Frm_validate_numeronotafiscalcompleto");
    sajax_export("ajax_NotaFiscal_Frm_validate_competenciasimples");
    sajax_export("ajax_NotaFiscal_Frm_validate_codigoverificacao");
    sajax_export("ajax_NotaFiscal_Frm_validate_datarecebimentonota");
    sajax_export("ajax_NotaFiscal_Frm_validate_numerolote");
    sajax_export("ajax_NotaFiscal_Frm_validate_protocolo");
    sajax_export("ajax_NotaFiscal_Frm_validate_idusuariocancelamento");
    sajax_export("ajax_NotaFiscal_Frm_validate_discriminacao");
    sajax_export("ajax_NotaFiscal_Frm_validate_nomereferencia");
    sajax_export("ajax_NotaFiscal_Frm_validate_nomearquivo");
    sajax_export("ajax_NotaFiscal_Frm_validate_nomereferenciaboleto");
    sajax_export("ajax_NotaFiscal_Frm_validate_nomearquivoboleto");
    sajax_export("ajax_NotaFiscal_Frm_validate_nomereferenciaxml");
    sajax_export("ajax_NotaFiscal_Frm_validate_nomearquivoxml");
    sajax_export("ajax_NotaFiscal_Frm_event_databaixa_onchange");
    sajax_export("ajax_NotaFiscal_Frm_event_idsituacaodocumento_onchange");
    sajax_export("ajax_NotaFiscal_Frm_event_valoriss_onchange");
    sajax_export("ajax_NotaFiscal_Frm_event_scajaxbutton_cancelar_onclick");
    sajax_export("ajax_NotaFiscal_Frm_event_scajaxbutton_gerarnota_onclick");
    sajax_export("ajax_NotaFiscal_Frm_autocomp_idcliente");
    sajax_export("ajax_NotaFiscal_Frm_autocomp_idlancamentoreceita");
    sajax_export("ajax_NotaFiscal_Frm_submit_form");
    sajax_export("ajax_NotaFiscal_Frm_navigate_form");
    sajax_handle_client_request();

    if (isset($_POST['wizard_action']) && 'change_step' == $_POST['wizard_action']) {
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'] = true;
        ob_start();
    }

    $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
//
    function nm_limpa_str_NotaFiscal_Frm(&$str)
    {
    }

    function ajax_NotaFiscal_Frm_validate_datacompetencia($datacompetencia, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_datacompetencia';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'datacompetencia' => NM_utf8_urldecode($datacompetencia),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_datacompetencia

    function ajax_NotaFiscal_Frm_validate_idempresa($idempresa, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idempresa';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idempresa' => NM_utf8_urldecode($idempresa),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idempresa

    function ajax_NotaFiscal_Frm_validate_idnotafiscal($idnotafiscal, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idnotafiscal';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idnotafiscal' => NM_utf8_urldecode($idnotafiscal),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idnotafiscal

    function ajax_NotaFiscal_Frm_validate_idcliente($idcliente, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idcliente';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idcliente' => NM_utf8_urldecode($idcliente),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idcliente

    function ajax_NotaFiscal_Frm_validate_idplanoconta($idplanoconta, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idplanoconta';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idplanoconta' => NM_utf8_urldecode($idplanoconta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idplanoconta

    function ajax_NotaFiscal_Frm_validate_datavencimento($datavencimento, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_datavencimento';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'datavencimento' => NM_utf8_urldecode($datavencimento),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_datavencimento

    function ajax_NotaFiscal_Frm_validate_valornotafiscal($valornotafiscal, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_valornotafiscal';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'valornotafiscal' => NM_utf8_urldecode($valornotafiscal),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_valornotafiscal

    function ajax_NotaFiscal_Frm_validate_valoriss($valoriss, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_valoriss';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'valoriss' => NM_utf8_urldecode($valoriss),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_valoriss

    function ajax_NotaFiscal_Frm_validate_valorliquido($valorliquido, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_valorliquido';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'valorliquido' => NM_utf8_urldecode($valorliquido),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_valorliquido

    function ajax_NotaFiscal_Frm_validate_idusuarioemissao($idusuarioemissao, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idusuarioemissao';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idusuarioemissao' => NM_utf8_urldecode($idusuarioemissao),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idusuarioemissao

    function ajax_NotaFiscal_Frm_validate_idsituacaodocumento($idsituacaodocumento, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idsituacaodocumento';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idsituacaodocumento' => NM_utf8_urldecode($idsituacaodocumento),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idsituacaodocumento

    function ajax_NotaFiscal_Frm_validate_boletoliberado($boletoliberado, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_boletoliberado';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'boletoliberado' => NM_utf8_urldecode($boletoliberado),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_boletoliberado

    function ajax_NotaFiscal_Frm_validate_datarecebimento($datarecebimento, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_datarecebimento';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'datarecebimento' => NM_utf8_urldecode($datarecebimento),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_datarecebimento

    function ajax_NotaFiscal_Frm_validate_databaixa($databaixa, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_databaixa';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'databaixa' => NM_utf8_urldecode($databaixa),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_databaixa

    function ajax_NotaFiscal_Frm_validate_idusuariobaixa($idusuariobaixa, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idusuariobaixa';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idusuariobaixa' => NM_utf8_urldecode($idusuariobaixa),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idusuariobaixa

    function ajax_NotaFiscal_Frm_validate_valorbaixa($valorbaixa, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_valorbaixa';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'valorbaixa' => NM_utf8_urldecode($valorbaixa),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_valorbaixa

    function ajax_NotaFiscal_Frm_validate_idlancamentoreceita($idlancamentoreceita, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idlancamentoreceita';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idlancamentoreceita' => NM_utf8_urldecode($idlancamentoreceita),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idlancamentoreceita

    function ajax_NotaFiscal_Frm_validate_numeronotafiscal($numeronotafiscal, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_numeronotafiscal';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'numeronotafiscal' => NM_utf8_urldecode($numeronotafiscal),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_numeronotafiscal

    function ajax_NotaFiscal_Frm_validate_numeronotafiscalcompleto($numeronotafiscalcompleto, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_numeronotafiscalcompleto';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'numeronotafiscalcompleto' => NM_utf8_urldecode($numeronotafiscalcompleto),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_numeronotafiscalcompleto

    function ajax_NotaFiscal_Frm_validate_competenciasimples($competenciasimples, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_competenciasimples';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'competenciasimples' => NM_utf8_urldecode($competenciasimples),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_competenciasimples

    function ajax_NotaFiscal_Frm_validate_codigoverificacao($codigoverificacao, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_codigoverificacao';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'codigoverificacao' => NM_utf8_urldecode($codigoverificacao),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_codigoverificacao

    function ajax_NotaFiscal_Frm_validate_datarecebimentonota($datarecebimentonota, $datarecebimentonota_hora, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_datarecebimentonota';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'datarecebimentonota' => NM_utf8_urldecode($datarecebimentonota),
                  'datarecebimentonota_hora' => NM_utf8_urldecode($datarecebimentonota_hora),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_datarecebimentonota

    function ajax_NotaFiscal_Frm_validate_numerolote($numerolote, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_numerolote';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'numerolote' => NM_utf8_urldecode($numerolote),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_numerolote

    function ajax_NotaFiscal_Frm_validate_protocolo($protocolo, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_protocolo';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'protocolo' => NM_utf8_urldecode($protocolo),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_protocolo

    function ajax_NotaFiscal_Frm_validate_idusuariocancelamento($idusuariocancelamento, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_idusuariocancelamento';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idusuariocancelamento' => NM_utf8_urldecode($idusuariocancelamento),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_idusuariocancelamento

    function ajax_NotaFiscal_Frm_validate_discriminacao($discriminacao, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_discriminacao';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'discriminacao' => NM_utf8_urldecode($discriminacao),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_discriminacao

    function ajax_NotaFiscal_Frm_validate_nomereferencia($nomereferencia, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_nomereferencia';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'nomereferencia' => NM_utf8_urldecode($nomereferencia),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_nomereferencia

    function ajax_NotaFiscal_Frm_validate_nomearquivo($nomearquivo, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_nomearquivo';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'nomearquivo' => NM_utf8_urldecode($nomearquivo),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_nomearquivo

    function ajax_NotaFiscal_Frm_validate_nomereferenciaboleto($nomereferenciaboleto, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_nomereferenciaboleto';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'nomereferenciaboleto' => NM_utf8_urldecode($nomereferenciaboleto),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_nomereferenciaboleto

    function ajax_NotaFiscal_Frm_validate_nomearquivoboleto($nomearquivoboleto, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_nomearquivoboleto';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'nomearquivoboleto' => NM_utf8_urldecode($nomearquivoboleto),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_nomearquivoboleto

    function ajax_NotaFiscal_Frm_validate_nomereferenciaxml($nomereferenciaxml, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_nomereferenciaxml';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'nomereferenciaxml' => NM_utf8_urldecode($nomereferenciaxml),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_nomereferenciaxml

    function ajax_NotaFiscal_Frm_validate_nomearquivoxml($nomearquivoxml, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'validate_nomearquivoxml';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'nomearquivoxml' => NM_utf8_urldecode($nomearquivoxml),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_validate_nomearquivoxml

    function ajax_NotaFiscal_Frm_event_databaixa_onchange($databaixa, $idsituacaodocumento, $idusuariobaixa, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'event_databaixa_onchange';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'databaixa' => NM_utf8_urldecode($databaixa),
                  'idsituacaodocumento' => NM_utf8_urldecode($idsituacaodocumento),
                  'idusuariobaixa' => NM_utf8_urldecode($idusuariobaixa),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_event_databaixa_onchange

    function ajax_NotaFiscal_Frm_event_idsituacaodocumento_onchange($idsituacaodocumento, $databaixa, $idusuariobaixa, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'event_idsituacaodocumento_onchange';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idsituacaodocumento' => NM_utf8_urldecode($idsituacaodocumento),
                  'databaixa' => NM_utf8_urldecode($databaixa),
                  'idusuariobaixa' => NM_utf8_urldecode($idusuariobaixa),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_event_idsituacaodocumento_onchange

    function ajax_NotaFiscal_Frm_event_valoriss_onchange($valoriss, $valorliquido, $valornotafiscal, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'event_valoriss_onchange';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'valoriss' => NM_utf8_urldecode($valoriss),
                  'valorliquido' => NM_utf8_urldecode($valorliquido),
                  'valornotafiscal' => NM_utf8_urldecode($valornotafiscal),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_event_valoriss_onchange

    function ajax_NotaFiscal_Frm_event_scajaxbutton_cancelar_onclick($idempresa, $idnotafiscal, $numeronotafiscalcompleto, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'event_scajaxbutton_cancelar_onclick';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idempresa' => NM_utf8_urldecode($idempresa),
                  'idnotafiscal' => NM_utf8_urldecode($idnotafiscal),
                  'numeronotafiscalcompleto' => NM_utf8_urldecode($numeronotafiscalcompleto),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_event_scajaxbutton_cancelar_onclick

    function ajax_NotaFiscal_Frm_event_scajaxbutton_gerarnota_onclick($idempresa, $datacompetencia, $idcliente, $discriminacao, $valornotafiscal, $valoriss, $idnotafiscal, $nomereferenciaxml, $nomearquivoxml, $nomereferencia, $nomearquivo, $valorliquido, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'event_scajaxbutton_gerarnota_onclick';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idempresa' => NM_utf8_urldecode($idempresa),
                  'datacompetencia' => NM_utf8_urldecode($datacompetencia),
                  'idcliente' => NM_utf8_urldecode($idcliente),
                  'discriminacao' => NM_utf8_urldecode($discriminacao),
                  'valornotafiscal' => NM_utf8_urldecode($valornotafiscal),
                  'valoriss' => NM_utf8_urldecode($valoriss),
                  'idnotafiscal' => NM_utf8_urldecode($idnotafiscal),
                  'nomereferenciaxml' => NM_utf8_urldecode($nomereferenciaxml),
                  'nomearquivoxml' => NM_utf8_urldecode($nomearquivoxml),
                  'nomereferencia' => NM_utf8_urldecode($nomereferencia),
                  'nomearquivo' => NM_utf8_urldecode($nomearquivo),
                  'valorliquido' => NM_utf8_urldecode($valorliquido),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_event_scajaxbutton_gerarnota_onclick

    function ajax_NotaFiscal_Frm_autocomp_idcliente($idcliente)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'autocomp_idcliente';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idcliente' => NM_utf8_urldecode($idcliente),
                  'buffer_output' => true,
                 );
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['idcliente'] = NM_utf8_decode(urldecode($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['idcliente']));
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_autocomp_idcliente

    function ajax_NotaFiscal_Frm_autocomp_idlancamentoreceita($idlancamentoreceita)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'autocomp_idlancamentoreceita';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idlancamentoreceita' => NM_utf8_urldecode($idlancamentoreceita),
                  'buffer_output' => true,
                 );
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['idlancamentoreceita'] = NM_utf8_decode(urldecode($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['idlancamentoreceita']));
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_autocomp_idlancamentoreceita

    function ajax_NotaFiscal_Frm_submit_form($datacompetencia, $idempresa, $idnotafiscal, $idcliente, $idplanoconta, $datavencimento, $valornotafiscal, $valoriss, $valorliquido, $idusuarioemissao, $idsituacaodocumento, $boletoliberado, $datarecebimento, $databaixa, $idusuariobaixa, $valorbaixa, $idlancamentoreceita, $numeronotafiscal, $numeronotafiscalcompleto, $competenciasimples, $codigoverificacao, $datarecebimentonota, $datarecebimentonota_hora, $numerolote, $protocolo, $idusuariocancelamento, $discriminacao, $nomereferencia, $nomearquivo, $nomereferenciaboleto, $nomearquivoboleto, $nomereferenciaxml, $nomearquivoxml, $nomereferencia_ul_name, $nomereferencia_ul_type, $nomereferenciaboleto_ul_name, $nomereferenciaboleto_ul_type, $nomereferenciaxml_ul_name, $nomereferenciaxml_ul_type, $nomereferencia_salva, $nomereferencia_limpa, $nomereferenciaboleto_salva, $nomereferenciaboleto_limpa, $nomereferenciaxml_salva, $nomereferenciaxml_limpa, $nm_form_submit, $nmgp_url_saida, $nmgp_opcao, $nmgp_ancora, $nmgp_num_form, $nmgp_parms, $script_case_init, $csrf_token)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'submit_form';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'datacompetencia' => NM_utf8_urldecode($datacompetencia),
                  'idempresa' => NM_utf8_urldecode($idempresa),
                  'idnotafiscal' => NM_utf8_urldecode($idnotafiscal),
                  'idcliente' => NM_utf8_urldecode($idcliente),
                  'idplanoconta' => NM_utf8_urldecode($idplanoconta),
                  'datavencimento' => NM_utf8_urldecode($datavencimento),
                  'valornotafiscal' => NM_utf8_urldecode($valornotafiscal),
                  'valoriss' => NM_utf8_urldecode($valoriss),
                  'valorliquido' => NM_utf8_urldecode($valorliquido),
                  'idusuarioemissao' => NM_utf8_urldecode($idusuarioemissao),
                  'idsituacaodocumento' => NM_utf8_urldecode($idsituacaodocumento),
                  'boletoliberado' => NM_utf8_urldecode($boletoliberado),
                  'datarecebimento' => NM_utf8_urldecode($datarecebimento),
                  'databaixa' => NM_utf8_urldecode($databaixa),
                  'idusuariobaixa' => NM_utf8_urldecode($idusuariobaixa),
                  'valorbaixa' => NM_utf8_urldecode($valorbaixa),
                  'idlancamentoreceita' => NM_utf8_urldecode($idlancamentoreceita),
                  'numeronotafiscal' => NM_utf8_urldecode($numeronotafiscal),
                  'numeronotafiscalcompleto' => NM_utf8_urldecode($numeronotafiscalcompleto),
                  'competenciasimples' => NM_utf8_urldecode($competenciasimples),
                  'codigoverificacao' => NM_utf8_urldecode($codigoverificacao),
                  'datarecebimentonota' => NM_utf8_urldecode($datarecebimentonota),
                  'datarecebimentonota_hora' => NM_utf8_urldecode($datarecebimentonota_hora),
                  'numerolote' => NM_utf8_urldecode($numerolote),
                  'protocolo' => NM_utf8_urldecode($protocolo),
                  'idusuariocancelamento' => NM_utf8_urldecode($idusuariocancelamento),
                  'discriminacao' => NM_utf8_urldecode($discriminacao),
                  'nomereferencia' => NM_utf8_urldecode($nomereferencia),
                  'nomearquivo' => NM_utf8_urldecode($nomearquivo),
                  'nomereferenciaboleto' => NM_utf8_urldecode($nomereferenciaboleto),
                  'nomearquivoboleto' => NM_utf8_urldecode($nomearquivoboleto),
                  'nomereferenciaxml' => NM_utf8_urldecode($nomereferenciaxml),
                  'nomearquivoxml' => NM_utf8_urldecode($nomearquivoxml),
                  'nomereferencia_ul_name' => NM_utf8_urldecode($nomereferencia_ul_name),
                  'nomereferencia_ul_type' => NM_utf8_urldecode($nomereferencia_ul_type),
                  'nomereferenciaboleto_ul_name' => NM_utf8_urldecode($nomereferenciaboleto_ul_name),
                  'nomereferenciaboleto_ul_type' => NM_utf8_urldecode($nomereferenciaboleto_ul_type),
                  'nomereferenciaxml_ul_name' => NM_utf8_urldecode($nomereferenciaxml_ul_name),
                  'nomereferenciaxml_ul_type' => NM_utf8_urldecode($nomereferenciaxml_ul_type),
                  'nomereferencia_salva' => NM_utf8_urldecode($nomereferencia_salva),
                  'nomereferencia_limpa' => NM_utf8_urldecode($nomereferencia_limpa),
                  'nomereferenciaboleto_salva' => NM_utf8_urldecode($nomereferenciaboleto_salva),
                  'nomereferenciaboleto_limpa' => NM_utf8_urldecode($nomereferenciaboleto_limpa),
                  'nomereferenciaxml_salva' => NM_utf8_urldecode($nomereferenciaxml_salva),
                  'nomereferenciaxml_limpa' => NM_utf8_urldecode($nomereferenciaxml_limpa),
                  'nm_form_submit' => NM_utf8_urldecode($nm_form_submit),
                  'nmgp_url_saida' => NM_utf8_urldecode($nmgp_url_saida),
                  'nmgp_opcao' => NM_utf8_urldecode($nmgp_opcao),
                  'nmgp_ancora' => NM_utf8_urldecode($nmgp_ancora),
                  'nmgp_num_form' => NM_utf8_urldecode($nmgp_num_form),
                  'nmgp_parms' => NM_utf8_urldecode($nmgp_parms),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'csrf_token' => NM_utf8_urldecode($csrf_token),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_submit_form

    function ajax_NotaFiscal_Frm_navigate_form($idnotafiscal, $nm_form_submit, $nmgp_opcao, $nmgp_ordem, $nmgp_arg_dyn_search, $script_case_init)
    {
        global $inicial_NotaFiscal_Frm;
        //register_shutdown_function("NotaFiscal_Frm_pack_ajax_response");
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_flag          = true;
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao         = 'navigate_form';
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param'] = array(
                  'idnotafiscal' => NM_utf8_urldecode($idnotafiscal),
                  'nm_form_submit' => NM_utf8_urldecode($nm_form_submit),
                  'nmgp_opcao' => NM_utf8_urldecode($nmgp_opcao),
                  'nmgp_ordem' => NM_utf8_urldecode($nmgp_ordem),
                  'nmgp_arg_dyn_search' => NM_utf8_urldecode($nmgp_arg_dyn_search),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->controle();
        exit;
    } // ajax_navigate_form


   function NotaFiscal_Frm_pack_ajax_response()
   {
      global $inicial_NotaFiscal_Frm;
      $aResp = array();

      if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['wizard']))
      {
          $aResp['wizard'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['wizard'];
      }
      if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['empty_filter']))
      {
          $aResp['empty_filter'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['empty_filter'];
      }
      if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['dyn_search']['NM_Dynamic_Search']))
      {
          $aResp['dyn_search']['NM_Dynamic_Search'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['dyn_search']['NM_Dynamic_Search'];
      }
      if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['dyn_search']['id_dyn_search_cmd_str']))
      {
          $aResp['dyn_search']['id_dyn_search_cmd_str'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['dyn_search']['id_dyn_search_cmd_str'];
      }
      if ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['calendarReload'])
      {
         $aResp['result'] = 'CALENDARRELOAD';
      }
      elseif ('' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['autoComp'])
      {
         $aResp['result'] = 'AUTOCOMP';
      }
//mestre_detalhe
      elseif (!empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['newline']))
      {
         $aResp['result'] = 'NEWLINE';
         ob_end_clean();
      }
      elseif (!empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['tableRefresh']))
      {
         $aResp['result'] = 'TABLEREFRESH';
      }
//-----
      elseif (!empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['errList']))
      {
         $aResp['result'] = 'ERROR';
      }
      elseif (!empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fldList']))
      {
         $aResp['result'] = 'SET';
      }
      else
      {
         $aResp['result'] = 'OK';
      }
      if ('AUTOCOMP' == $aResp['result'])
      {
         $aResp = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['autoComp'];
      }
//mestre_detalhe
      elseif ('NEWLINE' == $aResp['result'])
      {
         $aResp = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['newline'];
      }
      else
//-----
      {
         $aResp['ajaxRequest'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_opcao;
         if ('CALENDARRELOAD' == $aResp['result'])
         {
            NotaFiscal_Frm_pack_calendar_reload($aResp);
         }
         elseif ('ERROR' == $aResp['result'])
         {
            NotaFiscal_Frm_pack_ajax_errors($aResp);
         }
         elseif ('SET' == $aResp['result'])
         {
            NotaFiscal_Frm_pack_ajax_set_fields($aResp);
         }
         elseif ('TABLEREFRESH' == $aResp['result'])
         {
            NotaFiscal_Frm_pack_ajax_set_fields($aResp);
            $aResp['tableRefresh'] = NotaFiscal_Frm_pack_protect_string($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['tableRefresh']);
         }
         if ('OK' == $aResp['result'] || 'SET' == $aResp['result'])
         {
            NotaFiscal_Frm_pack_ajax_ok($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['focus']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['focus'])
         {
            $aResp['setFocus'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['focus'];
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['closeLine']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['closeLine'])
         {
            $aResp['closeLine'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['closeLine'];
         }
         else
         {
            $aResp['closeLine'] = 'N';
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['clearUpload']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['clearUpload'])
         {
            $aResp['clearUpload'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['clearUpload'];
         }
         else
         {
            $aResp['clearUpload'] = 'N';
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnDisabled']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnDisabled'])
         {
            NotaFiscal_Frm_pack_btn_disabled($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnLabel']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnLabel'])
         {
            NotaFiscal_Frm_pack_btn_label($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['varList']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['varList']))
         {
            NotaFiscal_Frm_pack_var_list($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['masterValue']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['masterValue'])
         {
            NotaFiscal_Frm_pack_master_value($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert'])
         {
            NotaFiscal_Frm_pack_ajax_alert($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage'])
         {
            NotaFiscal_Frm_pack_ajax_message($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxJavascript']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxJavascript'])
         {
            NotaFiscal_Frm_pack_ajax_javascript($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir']))
         {
            NotaFiscal_Frm_pack_ajax_redir($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redirExit']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redirExit']))
         {
            NotaFiscal_Frm_pack_ajax_redir_exit($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['blockDisplay']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['blockDisplay']))
         {
            NotaFiscal_Frm_pack_ajax_block_display($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fieldDisplay']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fieldDisplay']))
         {
            NotaFiscal_Frm_pack_ajax_field_display($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['buttonDisplay']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['buttonDisplay']))
         {
/* mantis 0021191 */            $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['buttonDisplay'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->nmgp_botoes;
            NotaFiscal_Frm_pack_ajax_button_display($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['buttonDisplayVert']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['buttonDisplayVert']))
         {
            NotaFiscal_Frm_pack_ajax_button_display_vert($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fieldLabel']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fieldLabel']))
         {
            NotaFiscal_Frm_pack_ajax_field_label($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['readOnly']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['readOnly']))
         {
            NotaFiscal_Frm_pack_ajax_readonly($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']))
         {
            NotaFiscal_Frm_pack_ajax_nav_status($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navSummary']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navSummary']))
         {
            NotaFiscal_Frm_pack_ajax_nav_Summary($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navPage']))
         {
            NotaFiscal_Frm_pack_ajax_navPage($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnVars']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnVars']))
         {
            NotaFiscal_Frm_pack_ajax_btn_vars($aResp);
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['quickSearchRes']) && $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['quickSearchRes'])
         {
            $aResp['quickSearchRes'] = 'Y';
         }
         else
         {
            $aResp['quickSearchRes'] = 'N';
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['dyn_search']) && !empty($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['dyn_search']))
         {
            $aResp['dyn_search'] = array();
            foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['dyn_search'] as $Tag => $Val) {
                $aResp['dyn_search'][$Tag] = $Val;
            }
         }
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['event_field']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['event_field'])
         {
            $aResp['eventField'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['event_field'];
         }
         else
         {
            $aResp['eventField'] = '__SC_NO_FIELD';
         }
         $aResp['htmOutput'] = '';
                   ob_end_clean();
      }
      if (is_array($aResp))
      {
          if (isset($aResp['wizard'])) {
              echo json_encode($aResp);
          }
          else {
              $oJson = new Services_JSON();
              echo "var res = " . trim(sajax_get_js_repr($oJson->encode($aResp))) . "; res;";
          }
      }
      else
      {
          echo "var res = " . trim(sajax_get_js_repr($aResp)) . "; res;";
      }
      exit;
   } // NotaFiscal_Frm_pack_ajax_response

   function NotaFiscal_Frm_pack_calendar_reload(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['calendarReload'] = 'OK';
   } // NotaFiscal_Frm_pack_calendar_reload

   function NotaFiscal_Frm_pack_ajax_errors(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['errList'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['errList'] as $sField => $aMsg)
      {
         if ('geral_NotaFiscal_Frm' == $sField)
         {
             $aMsg = NotaFiscal_Frm_pack_ajax_remove_erros($aMsg);
         }
         foreach ($aMsg as $sMsg)
         {
            $iNumLinha = (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['nmgp_refresh_row']) && 'geral_NotaFiscal_Frm' != $sField)
                       ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['nmgp_refresh_row'] : "";
            $aResp['errList'][] = array('fldName'  => $sField,
                                        'msgText'  => NotaFiscal_Frm_pack_protect_string(NM_charset_to_utf8($sMsg)),
                                        'numLinha' => $iNumLinha);
         }
      }
   } // NotaFiscal_Frm_pack_ajax_errors

   function NotaFiscal_Frm_pack_ajax_remove_erros($aErrors)
   {
       $aNewErrors = array();
       if (!empty($aErrors))
       {
           $sErrorMsgs = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), implode('<br />', $aErrors));
           $aErrorMsgs = explode('<BR>', $sErrorMsgs);
           foreach ($aErrorMsgs as $sErrorMsg)
           {
               $sErrorMsg = trim($sErrorMsg);
               if ('' != $sErrorMsg && !in_array($sErrorMsg, $aNewErrors))
               {
                   $aNewErrors[] = $sErrorMsg;
               }
           }
       }
       return $aNewErrors;
   } // NotaFiscal_Frm_pack_ajax_remove_erros

   function NotaFiscal_Frm_pack_ajax_ok(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $iNumLinha = (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['nmgp_refresh_row']))
                 ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['nmgp_refresh_row'] : "";
      $aResp['msgDisplay'] = array('msgText'  => NotaFiscal_Frm_pack_protect_string($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['msgDisplay']),
                                   'numLinha' => $iNumLinha);
   } // NotaFiscal_Frm_pack_ajax_ok

   function NotaFiscal_Frm_pack_ajax_set_fields(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $iNumLinha = (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['nmgp_refresh_row']))
                 ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['param']['nmgp_refresh_row'] : "";
      if ('' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['rsSize'])
      {
         $aResp['rsSize'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['rsSize'];
      }
      $aResp['fldList'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fldList'] as $sField => $aData)
      {
         $aField = array();
         if (isset($aData['colNum']))
         {
            $aField['colNum'] = $aData['colNum'];
         }
         if (isset($aData['row']))
         {
            $aField['row'] = $aData['row'];
         }
         if (isset($aData['imgFile']))
         {
            $aField['imgFile'] = NotaFiscal_Frm_pack_protect_string($aData['imgFile']);
         }
         if (isset($aData['imgOrig']))
         {
            $aField['imgOrig'] = NotaFiscal_Frm_pack_protect_string($aData['imgOrig']);
         }
         if (isset($aData['imgLink']))
         {
            $aField['imgLink'] = NotaFiscal_Frm_pack_protect_string($aData['imgLink']);
         }
         if (isset($aData['keepImg']))
         {
            $aField['keepImg'] = $aData['keepImg'];
         }
         if (isset($aData['hideName']))
         {
            $aField['hideName'] = $aData['hideName'];
         }
         if (isset($aData['docLink']))
         {
            $aField['docLink'] = NotaFiscal_Frm_pack_protect_string($aData['docLink']);
         }
         if (isset($aData['docIcon']))
         {
            $aField['docIcon'] = NotaFiscal_Frm_pack_protect_string($aData['docIcon']);
         }
         if (isset($aData['docReadonly']))
         {
            $aField['docReadonly'] = NotaFiscal_Frm_pack_protect_string($aData['docReadonly']);
         }
         if (isset($aData['keyVal']))
         {
            $aField['keyVal'] = $aData['keyVal'];
         }
         if (isset($aData['optComp']))
         {
            $aField['optComp'] = $aData['optComp'];
         }
         if (isset($aData['optClass']))
         {
            $aField['optClass'] = $aData['optClass'];
         }
         if (isset($aData['optMulti']))
         {
            $aField['optMulti'] = $aData['optMulti'];
         }
         if (isset($aData['switch']))
         {
            $aField['switch'] = $aData['switch'];
         }
         if (isset($aData['lookupCons']))
         {
            $aField['lookupCons'] = $aData['lookupCons'];
         }
         if (isset($aData['imgHtml']))
         {
            $aField['imgHtml'] = NotaFiscal_Frm_pack_protect_string($aData['imgHtml']);
         }
         if (isset($aData['mulHtml']))
         {
            $aField['mulHtml'] = NotaFiscal_Frm_pack_protect_string($aData['mulHtml']);
         }
         if (isset($aData['updInnerHtml']))
         {
            $aField['updInnerHtml'] = $aData['updInnerHtml'];
         }
         if (isset($aData['htmComp']))
         {
            $aField['htmComp'] = str_replace("'", '__AS__', str_replace('"', '__AD__', $aData['htmComp']));
         }
         $aField['fldName']  = $sField;
         $aField['fldType']  = $aData['type'];
         $aField['numLinha'] = $iNumLinha;
         $aField['valList']  = array();
         foreach ($aData['valList'] as $iIndex => $sValue)
         {
            $aValue = array();
            if (isset($aData['labList'][$iIndex]))
            {
               $aValue['label'] = NotaFiscal_Frm_pack_protect_string($aData['labList'][$iIndex]);
            }
            $aValue['value']     = ('_autocomp' != substr($sField, -9)) ? NotaFiscal_Frm_pack_protect_string($sValue) : $sValue;
            $aField['valList'][] = $aValue;
         }
         foreach ($aField['valList'] as $iIndex => $aFieldData)
         {
             if ("null" == $aFieldData['value'])
             {
                 $aField['valList'][$iIndex]['value'] = '';
             }
         }
         if (isset($aData['optList']) && false !== $aData['optList'])
         {
            if (is_array($aData['optList']))
            {
               $aField['optList'] = array();
               foreach ($aData['optList'] as $aOptList)
               {
                  foreach ($aOptList as $sValue => $sLabel)
                  {
                     $sOpt = ($sValue !== $sLabel) ? $sValue : $sLabel;
                     $aField['optList'][] = array('value' => NotaFiscal_Frm_pack_protect_string($sOpt),
                                                  'label' => NotaFiscal_Frm_pack_protect_string($sLabel));
                  }
               }
            }
            else
            {
               $aField['optList'] = $aData['optList'];
            }
         }
         $aResp['fldList'][] = $aField;
      }
   } // NotaFiscal_Frm_pack_ajax_set_fields

   function NotaFiscal_Frm_pack_ajax_redir(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;

      $aInfo              = array('metodo', 'action', 'target', 'nmgp_parms', 'nmgp_outra_jan', 'nmgp_url_saida', 'script_case_init', 'h_modal', 'w_modal');

      $aResp['redirInfo'] = array();
      foreach ($aInfo as $sTag)
      {
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir'][$sTag]))
         {
            $aResp['redirInfo'][$sTag] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redir'][$sTag];
         }
      }
   } // NotaFiscal_Frm_pack_ajax_redir

   function NotaFiscal_Frm_pack_ajax_redir_exit(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;

      $aInfo                  = array('metodo', 'action', 'target', 'nmgp_parms', 'nmgp_outra_jan', 'nmgp_url_saida', 'script_case_init');

      $aResp['redirExitInfo'] = array();
      foreach ($aInfo as $sTag)
      {
         if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redirExit'][$sTag]))
         {
            $aResp['redirExitInfo'][$sTag] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['redirExit'][$sTag];
         }
      }
   } // NotaFiscal_Frm_pack_ajax_redir_exit

   function NotaFiscal_Frm_pack_var_list(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['varList'] as $varData)
      {
         $aResp['varList'][] = array('index' => key($varData),
                                      'value' => current($varData));
      }
   } // NotaFiscal_Frm_pack_var_list

   function NotaFiscal_Frm_pack_master_value(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['masterValue'] as $sIndex => $sValue)
      {
         $aResp['masterValue'][] = array('index' => $sIndex,
                                         'value' => $sValue);
      }
   } // NotaFiscal_Frm_pack_master_value

   function NotaFiscal_Frm_pack_btn_disabled(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['btnDisabled'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnDisabled'] as $btnName => $btnStatus) {
        $aResp['btnDisabled'][$btnName] = $btnStatus;
      }
   } // NotaFiscal_Frm_pack_ajax_alert

   function NotaFiscal_Frm_pack_btn_label(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['btnLabel'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnLabel'] as $btnName => $btnLabel) {
        $aResp['btnLabel'][$btnName] = $btnLabel;
      }
   } // NotaFiscal_Frm_pack_ajax_alert

   function NotaFiscal_Frm_pack_ajax_alert(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
// PHP 8.0
      if (!isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert']['message'])) {
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert']['message'] = '';
      }
      if (!isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert']['params'])) {
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert']['params'] = '';
      }
//---
      $aResp['ajaxAlert'] = array('message' => $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert']['message'], 'params' =>  $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxAlert']['params']);
   } // NotaFiscal_Frm_pack_ajax_alert

   function NotaFiscal_Frm_pack_ajax_message(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
// PHP 8.0
      if (!isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['message'])) {
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['message'] = '';
      }
      if (!isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['title'])) {
          $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['title'] = '';
      }
//---
      $aResp['ajaxMessage'] = array('message'      => NotaFiscal_Frm_pack_protect_string($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['message']),
                                    'title'        => NotaFiscal_Frm_pack_protect_string($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['title']),
                                    'modal'        => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['modal'])        ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['modal']        : 'N',
                                    'timeout'      => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['timeout'])      ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['timeout']      : '',
                                    'button'       => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['button'])       ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['button']       : '',
                                    'button_label' => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['button_label']) ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['button_label'] : 'Ok',
                                    'top'          => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['top'])          ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['top']          : '',
                                    'left'         => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['left'])         ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['left']         : '',
                                    'width'        => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['width'])        ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['width']        : '',
                                    'height'       => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['height'])       ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['height']       : '',
                                    'redir'        => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['redir'])        ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['redir']        : '',
                                    'show_close'   => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['show_close'])   ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['show_close']   : 'Y',
                                    'body_icon'    => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['body_icon'])    ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['body_icon']    : 'Y',
                                    'toast'        => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['toast'])        ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['toast']        : 'N',
                                    'toast_pos'    => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['toast_pos'])    ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['toast_pos']    : '',
                                    'type'         => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['type'])         ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['type']         : '',
                                    'redir_target' => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['redir_target']) ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['redir_target'] : '',
                                    'redir_par'    => isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['redir_par'])    ? $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxMessage']['redir_par']    : '');
   } // NotaFiscal_Frm_pack_ajax_message

   function NotaFiscal_Frm_pack_ajax_javascript(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['ajaxJavascript'] as $aJsFunc)
      {
         $aResp['ajaxJavascript'][] = $aJsFunc;
      }
   } // NotaFiscal_Frm_pack_ajax_javascript

   function NotaFiscal_Frm_pack_ajax_block_display(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['blockDisplay'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['blockDisplay'] as $sBlockName => $sBlockStatus)
      {
        $aResp['blockDisplay'][] = array($sBlockName, $sBlockStatus);
      }
   } // NotaFiscal_Frm_pack_ajax_block_display

   function NotaFiscal_Frm_pack_ajax_field_display(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['fieldDisplay'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fieldDisplay'] as $sFieldName => $sFieldStatus)
      {
        $aResp['fieldDisplay'][] = array($sFieldName, $sFieldStatus);
      }
   } // NotaFiscal_Frm_pack_ajax_field_display

   function NotaFiscal_Frm_pack_ajax_button_display(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['buttonDisplay'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['buttonDisplay'] as $sButtonName => $sButtonStatus)
      {
        $aResp['buttonDisplay'][] = array($sButtonName, $sButtonStatus);
      }
   } // NotaFiscal_Frm_pack_ajax_button_display

   function NotaFiscal_Frm_pack_ajax_button_display_vert(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['buttonDisplayVert'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['buttonDisplayVert'] as $aButtonData)
      {
        $aResp['buttonDisplayVert'][] = $aButtonData;
      }
   } // NotaFiscal_Frm_pack_ajax_button_display

   function NotaFiscal_Frm_pack_ajax_field_label(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['fieldLabel'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['fieldLabel'] as $sFieldName => $sFieldLabel)
      {
        $aResp['fieldLabel'][] = array($sFieldName, NotaFiscal_Frm_pack_protect_string($sFieldLabel));
      }
   } // NotaFiscal_Frm_pack_ajax_field_label

   function NotaFiscal_Frm_pack_ajax_readonly(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['readOnly'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['readOnly'] as $sFieldName => $sFieldStatus)
      {
        $aResp['readOnly'][] = array($sFieldName, $sFieldStatus);
      }
   } // NotaFiscal_Frm_pack_ajax_readonly

   function NotaFiscal_Frm_pack_ajax_nav_status(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['navStatus'] = array();
      if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']['ret']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']['ret'])
      {
         $aResp['navStatus']['ret'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']['ret'];
      }
      if (isset($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']['ava']) && '' != $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']['ava'])
      {
         $aResp['navStatus']['ava'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navStatus']['ava'];
      }
   } // NotaFiscal_Frm_pack_ajax_nav_status

   function NotaFiscal_Frm_pack_ajax_nav_Summary(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['navSummary'] = array();
      $aResp['navSummary']['reg_ini'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navSummary']['reg_ini'];
      $aResp['navSummary']['reg_qtd'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navSummary']['reg_qtd'];
      $aResp['navSummary']['reg_tot'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navSummary']['reg_tot'];
      $aResp['navSummary']['summary_line'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['summary_line'];
   } // NotaFiscal_Frm_pack_ajax_nav_Summary

   function NotaFiscal_Frm_pack_ajax_navPage(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['navPage'] = $inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['navPage'];
   } // NotaFiscal_Frm_pack_ajax_navPage


   function NotaFiscal_Frm_pack_ajax_btn_vars(&$aResp)
   {
      global $inicial_NotaFiscal_Frm;
      $aResp['btnVars'] = array();
      foreach ($inicial_NotaFiscal_Frm->contr_NotaFiscal_Frm->NM_ajax_info['btnVars'] as $sBtnName => $sBtnValue)
      {
        $aResp['btnVars'][] = array($sBtnName, NotaFiscal_Frm_pack_protect_string($sBtnValue));
      }
   } // NotaFiscal_Frm_pack_ajax_btn_vars

   function NotaFiscal_Frm_pack_protect_string($sString)
   {
      $sString = (string) $sString;

      if (!empty($sString))
      {
         if (function_exists('NM_is_utf8') && NM_is_utf8($sString))
         {
             return $sString;
         }
         else
         {
/*             return htmlentities($sString, ENT_COMPAT, $_SESSION['scriptcase']['charset']); */
             return sc_htmlentities($sString);
         }
      }
      elseif ('0' === $sString || 0 === $sString)
      {
         return '0';
      }
      else
      {
         return '';
      }
   } // NotaFiscal_Frm_pack_protect_string
?>
