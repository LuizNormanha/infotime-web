<?php

include_once('IndicadorFinanceiro_Cor_session.php');
@ini_set('session.cookie_httponly', 1);
@ini_set('session.use_only_cookies', 1);
@ini_set('session.cookie_secure', 0);
@session_start();

$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_perfil']          = "ligasistemas";
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_prod']       = "";
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imagens']    = "";
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imag_temp']  = "";
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_doc']        = "";
//check publication with the prod
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $str_path_sys = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $str_path_sys = str_replace("\\", '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
    $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$str_path_apl_url = $_SERVER['PHP_SELF'];
$str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
$str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
$str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
$str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
$str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
//check prod
if(empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_prod']))
{
    /*check prod*/$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
}
//check img
if(empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imagens']))
{
    /*check img*/$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
}
//check tmp
if(empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imag_temp']))
{
    /*check tmp*/$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
}
//check doc
if(empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_doc']))
{
    /*check doc*/$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
}
//end check publication with the prod
if (!function_exists("SC_dir_app_ini"))
{
    include_once("../_lib/lib/php/nm_ctrl_app_name.php");
}
SC_dir_app_ini('LIGA_InfoTIME');
if (!function_exists("NM_is_utf8"))
{
    include_once("../_lib/lib/php/nm_utf8.php");
}

$Sc_lig_md5 = false;
$Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
$_SESSION['scriptcase']['sem_session'] = false;
if (!isset($_SERVER['HTTP_REFERER']) || (!isset($_POST['nmgp_opcao']) && !isset($_POST['script_case_init']) && !isset($_POST['nmgp_start']) && !isset($_GET['nmgp_opcao']) && !isset($_GET['script_case_init']) && !isset($_GET['nmgp_start'])))
{
    $Sem_Session = false;
}
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
        nm_limpa_str_IndicadorFinanceiro_Cor($nmgp_val);
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
        nm_limpa_str_IndicadorFinanceiro_Cor($nmgp_val);
        $nmgp_val = NM_decode_input($nmgp_val);
        $$nmgp_var = $nmgp_val;
    }
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
    elseif (is_file($root . $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imag_temp'] . "/sc_apl_default_LIGA_InfoTIME.txt")) {
        $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imag_temp'] . "/sc_apl_default_LIGA_InfoTIME.txt"));
    }
    if (isset($apl_def)) {
        if ($apl_def[0] != "IndicadorFinanceiro_Cor") {
            $_SESSION['scriptcase']['sem_session'] = true;
            if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir'] = $apl_def[0];
            }
            else {
                $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
            }
            $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
            $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir_tp'] = $Redir_tp;
        }
        if (isset($_COOKIE['sc_actual_lang_LIGA_InfoTIME'])) {
            $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_LIGA_InfoTIME'];
        }
    }
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
           nm_limpa_str_IndicadorFinanceiro_Cor($cadapar[1]);
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
}
elseif (isset($script_case_init) && !empty($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['IndicadorFinanceiro_Cor']['parms']))
{
    if (!isset($nmgp_opcao) || ($nmgp_opcao != "incluir" && $nmgp_opcao != "novo" && $nmgp_opcao != "recarga" && $nmgp_opcao != "muda_form"))
    {
        $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['IndicadorFinanceiro_Cor']['parms']);
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
if ((isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang") || (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "force_lang"))
{
    if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'])
    {
        $nmgp_opcao  = $_POST['nmgp_opcao'];
        $nmgp_idioma = $_POST['nmgp_idioma'];
    }
    else
    {
        $nmgp_opcao  = $_GET['nmgp_opcao'];
        $nmgp_idioma = $_GET['nmgp_idioma'];
    }
    $Temp_lang = explode(";" , $nmgp_idioma);
    if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))
    {
        $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
    }
    if (isset($Temp_lang[1]) && !empty($Temp_lang[1]))
    {
        $_SESSION['scriptcase']['str_conf_reg']        = $Temp_lang[1];
    }
}

$IndicadorFinanceiro_Cor_control = new IndicadorFinanceiro_Cor_control();
$IndicadorFinanceiro_Cor_control->control();

class IndicadorFinanceiro_Cor_ini {

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
    var $sc_site_ssl;
    var $sc_protocolo;
    var $path_prod;
    var $path_imagens;
    var $path_imag_temp;
    var $path_doc;
    var $server;
    var $root;
    var $path_aplicacao;
    var $path_embutida;
    var $path_link;
    var $path_libs;
    var $path_help;
    var $path_lang;
    var $path_lang_js;
    var $path_botoes;
    var $path_img_global;
    var $path_img_modelo;
    var $path_icones;
    var $path_imag_cab;
    var $path_adodb;
    var $url_lib;
    var $url_third;
    var $sc_page;
    var $str_lang;
    var $str_conf_reg;
    var $Nm_lang;
    var $Nm_lang_conf_region;
    var $display_as_mobile;
    var $force_db_utf8 = true;
    var $unauthorized;
    var $path_lib_php;
    var $path_btn;
    var $url_lib_js;
    var $sc_charset;
    var $nm_data;
    var $str_schema_all;
    var $Str_btn_form;
    var $field_config;
    var $Nm_conf_reg;
    var $nm_bases_access ;
    var $nm_bases_db2 ;
    var $nm_bases_ibase ;
    var $nm_bases_informix ;
    var $nm_bases_mssql ;
    var $nm_bases_mysql ;
    var $nm_bases_postgres ;
    var $nm_bases_oracle ;
    var $nm_bases_sqlite ;
    var $nm_bases_sybase ;
    var $nm_bases_vfp ;
    var $nm_bases_odbc ;
    var $nm_bases_progress ;
    var $nm_falta_var ;
    var $nm_falta_var_db ;
    var $nm_tpbanco ;
    var $nm_servidor ;
    var $nm_banco ;
    var $nm_usuario ;
    var $nm_senha ;
    var $nm_database_encoding ;
    var $nm_con_persistente ;
    var $nm_con_use_schema ;
    var $nm_arr_db_extra_args ;
    var $date_delim ;
    var $date_delim1 ;
    var $Db ;
    var $nm_con_db2 ;

    function init()
    {
        @ini_set('magic_quotes_runtime', 0);

        $this->sc_page = rand(2, 10000);
        if(isset($_POST['script_case_init']))
        {
            $this->sc_page = filter_input(INPUT_POST, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
        }
        elseif(isset($_GET['script_case_init']))
        {
            $this->sc_page = filter_input(INPUT_GET, 'script_case_init', FILTER_SANITIZE_NUMBER_INT);
        }
        $_SESSION['scriptcase']['sc_num_page'] = $this->sc_page;
        if (!isset($_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor'])) {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor'] = array();
        }
        if (!isset($_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['embutida_form'])) {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['embutida_form'] = false;
        }
        if (!isset($_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['embutida_proc'])) {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['embutida_proc'] = false;
        }
        if (!isset($_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['iframe_menu'])) {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['iframe_menu'] = false;
        }

        $this->nm_cod_apl      = "IndicadorFinanceiro_Cor";
        $this->nm_nome_apl     = "";
        $this->nm_seguranca    = "";
        $this->nm_grupo        = "LIGA_InfoTIME";
        $this->nm_grupo_versao = "2";
        $this->nm_autor        = "admin";
        $this->nm_versao_sc    = "v9";
        $this->nm_tp_lic_sc    = "sb_micro_bronze";
        $this->nm_dt_criacao   = "20131103";
        $this->nm_hr_criacao   = "141439";
        $this->nm_autor_alt    = "nelson";
        $this->nm_dt_ult_alt   = "20260225";
        $this->nm_hr_ult_alt   = "093834";
        list($NM_usec, $NM_sec) = explode(" ", microtime());
        $this->nm_timestamp  = (float) $NM_sec;

        if (!isset($_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['initialize'])) {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['initialize'] = true;
        } elseif (!isset($_SERVER['HTTP_REFERER'])) {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['initialize'] = false;
        } elseif (false === strpos($_SERVER['HTTP_REFERER'], '/IndicadorFinanceiro_Cor/')) {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['initialize'] = true;
        } else {
            $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['initialize'] = false;
        }

        $NM_dir_atual = getcwd();
        if (empty($NM_dir_atual))
        {
            $str_path_sys = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
            $str_path_sys = str_replace("\\", '/', $str_path_sys);
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

        $this->sc_site_ssl    = (isset($_SERVER['HTTP_REFERER']) && strtolower(substr($_SERVER['HTTP_REFERER'], 0, 5)) == 'https') ? true : false;
        $this->sc_protocolo   = ($this->sc_site_ssl) ? 'https://' : 'http://';
        $this->sc_protocolo   = "";
        $this->path_prod      = $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_prod'];
        $this->path_imagens   = $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imagens'];
        $this->path_imag_temp = $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_imag_temp'];
        $this->path_doc       = $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_path_doc'];

        $this->server = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
        if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && !$this->sc_site_ssl )
        {
            $this->server .= ":" . $_SERVER['SERVER_PORT'];
        }
        $this->server = "";

        $str_path_web          = $_SERVER['PHP_SELF'];
        $str_path_web          = str_replace("\\", '/', $str_path_web);
        $str_path_web          = str_replace('//', '/', $str_path_web);
        $this->root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
        $this->path_aplicacao  = substr($str_path_sys, 0, strrpos($str_path_sys, '/'));
        $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/IndicadorFinanceiro_Cor';
        $this->path_embutida   = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/') + 1);
        $this->path_aplicacao .= '/';
        $this->path_link       = substr($str_path_web, 0, strrpos($str_path_web, '/'));
        $this->path_link       = substr($this->path_link, 0, strrpos($this->path_link, '/')) . '/';
        $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
        $this->path_lib_php    = $this->root . $this->path_link . "_lib/lib/php/";
        $this->url_lib_js      = $this->path_link . "_lib/lib/js/";
        $this->path_help       = $this->path_link . "_lib/webhelp/";
        $this->path_lang       = "../_lib/lang/";
        $this->path_lang_js    = "../_lib/js/";
        $this->path_botoes     = $this->path_link . "_lib/img";
        $this->path_img_global = $this->path_link . "_lib/img";
        $this->path_img_modelo = $this->path_link . "_lib/img";
        $this->path_icones     = $this->path_link . "_lib/img";
        $this->path_imag_cab   = $this->path_link . "_lib/img";
        $this->path_btn        = $this->root . $this->path_link . "_lib/buttons/";
        $this->path_adodb      = $this->root . $this->path_prod . "/third/adodb";

        $_SESSION['scriptcase']['dir_temp'] = $this->root . $this->path_imag_temp;
        $this->url_lib   = $this->path_link . '/_lib/';
        $this->url_third = $this->path_prod . '/third/';

        $this->str_lang     = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "pt_br";
        $this->str_conf_reg = (isset($_SESSION['scriptcase']['str_conf_reg']) && !empty($_SESSION['scriptcase']['str_conf_reg'])) ? $_SESSION['scriptcase']['str_conf_reg'] : "pt_br";
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

        if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['lang'])) {
            $this->str_lang = $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['lang'];
        }
        elseif (!isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['actual_lang']) || $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['actual_lang'] != $this->str_lang) {
            $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['actual_lang'] = $this->str_lang;
            setcookie('sc_actual_lang_LIGA_InfoTIME',$this->str_lang,'0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
        }
        include($this->path_lang . $this->str_lang . ".lang.php");
        include($this->path_lang . "config_region.php");
        include($this->path_lang . "lang_config_region.php");

        $this->sc_Include($this->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado");
        $this->sc_Include($this->path_lib_php . "/nm_data.class.php", "C", "nm_data");
        $this->nm_data = new nm_data($this->str_lang);

        $_SESSION['scriptcase']['charset'] = "UTF-8";
        ini_set('default_charset', $_SESSION['scriptcase']['charset']);
        $_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
        asort($this->Nm_lang_conf_region);
        foreach ($this->Nm_lang_conf_region as $ind => $dados)
        {
           if (isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
           {
               $this->Nm_lang_conf_region[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
           }
        }

        foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
        {
            if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->isUtf8($dados))
            {
                $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
            }
        }
        foreach ($this->Nm_lang as $ind => $dados)
        {
            if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->isUtf8($ind))
            {
                $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
                $this->Nm_lang[$ind] = $dados;
            }
            if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->isUtf8($dados))
            {
                $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
            }
            $this->Nm_lang[$ind] = str_replace('"', '&quot;',  $this->Nm_lang[$ind]);
        }
        $_SESSION['scriptcase']['reg_conf']['html_dir'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'])) ? " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
        if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir'])) {
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
            if ($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir_tp'] == "R") {
                $SS_cod_html .= "  </HEAD>\r\n";
                $SS_cod_html .= "   <body>\r\n";
            }
            else {
                $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
                $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
                $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
                $SS_cod_html .= "           target=\"_self\">\r\n";
                $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir'] . "');\">\r\n";
                $SS_cod_html .= "     </form>\r\n";
                $SS_cod_html .= "    </td></tr></table>\r\n";
                $SS_cod_html .= "    </div></td></tr></table>\r\n";
            }
            $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
            if ($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir_tp'] == "R") {
                $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir'] . "');\r\n";
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
            unset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']);
            unset($_SESSION['sc_session']);
        }
        if (isset($SS_cod_html))
        {
            echo $SS_cod_html;
            exit;
        }
        if (isset($_SESSION['sc_session']['SC_parm_violation']))
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

        if (!function_exists("mb_convert_encoding"))
        {
            echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtmb'] . "</font></div>";exit;
        }
        elseif (!function_exists("sc_convert_encoding"))
        {
            echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtsc'] . "</font></div>";exit;
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

        $this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Liga_Soft/Liga_Soft";
        include("../_lib/css/" . $this->str_schema_all . "_form.php");
        $this->Str_btn_form = trim($str_button);

        $this->regionalDefault();
        $this->loadFieldConfig();
        include_once($this->path_adodb . "/adodb.inc.php");
        $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod");
        $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib");
        perfil_lib($this->path_libs);
        if (!isset($_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil']))
        {
            if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($this->path_libs, $this->path_prod);
            $_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil'] = true;
        }
        $this->nm_bases_access     = array("access", "ado_access", "ace_access");
        $this->nm_bases_ibase      = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
        $this->nm_bases_mysql      = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "pdo_mariadb", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "azure_pdo_mariadb", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "googlecloud_pdo_mariadb", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql", "amazonrds_pdo_mariadb");
        $this->nm_bases_postgres   = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
        $this->nm_bases_sqlite     = array("sqlite", "sqlite3", "pdosqlite");
        $this->prep_conect();
        $this->conectDB();
    } // init
   function prep_conect()
   {
      $con_devel             =  (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
      {
          foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
          {
              if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao']) && $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_perfil']) && $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao']))
      {
          db_conect_devel($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'], $this->root . $this->path_prod, 'LIGA_InfoTIME', 2, $this->force_db_utf8); 
          if (empty($_SESSION['scriptcase']['glo_tpbanco']) && empty($_SESSION['scriptcase']['glo_banco']))
          {
              $nm_crit_perfil = true;
          }
      }
      if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_perfil'];
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
         $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
          {
              $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['SC_sep_date1'];
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
          if (!$_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['iframe_menu'] && (!isset($_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['sc_outra_jan']) || $_SESSION['sc_session'][$this->sc_page]['IndicadorFinanceiro_Cor']['sc_outra_jan'] != 'IndicadorFinanceiro_Cor')) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
?>
                  <a id="sai" href="javascript: window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''"></a>

<?php
              } 
              elseif(!empty($nm_url_saida)) 
              { 
?>
                  <a id="sai" href="javascript: window.location='<?php echo $nm_url_saida ?>'" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''"></a>

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
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'], $this->root . $this->path_prod, 'LIGA_InfoTIME', 1, $this->force_db_utf8); 
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
    if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'])) {
      list($connectionDbms, $connectionHost, $connectionUser, $connectionPassword, $connectionDatabase) = db_conect_devel($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'], $this->root . $this->path_prod, 'LIGA_InfoTIME', 1, $this->force_db_utf8);
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

    function sc_Include($path, $tp, $name)
    {
        if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
        {
             include_once($path);
        }
    } // sc_Include
    function isUtf8($sStr)
    {
        $c=0; $b=0;
        $bits=0;
        $len=strlen($sStr);
        for($i=0; $i<$len; $i++){
            $c=ord($sStr[$i]);
            if($c > 128){
                if(($c >= 254)) return false;
                elseif($c >= 252) $bits=6;
                elseif($c >= 248) $bits=5;
                elseif($c >= 240) $bits=4;
                elseif($c >= 224) $bits=3;
                elseif($c >= 192) $bits=2;
                else return false;
                if(($i+$bits) > $len) return false;
                while($bits > 1){
                    $i++;
                    $b=ord($sStr[$i]);
                    if($b < 128 || $b > 191) return false;
                    $bits--;
                }
            }
        }
        return true;
    } // isUtf8
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
    } // regionalDefault

    function loadFieldConfig() {
        $this->field_config = array(
            'widget1_metric' => array(
                'symbol_grp' => $_SESSION['scriptcase']['reg_conf']['grup_num'],
                'symbol_fmt' => $_SESSION['scriptcase']['reg_conf']['num_group_digit'],
                'symbol_dec' => $_SESSION['scriptcase']['reg_conf']['dec_num'],
                'symbol_mon' => '',
                'symbol_neg' => $_SESSION['scriptcase']['reg_conf']['simb_neg'],
                'format_pos' => '',
                'format_neg' => $_SESSION['scriptcase']['reg_conf']['neg_num'],
                'newfmt_neg' => '',
            ),
            'widget4_metric' => array(
                'symbol_grp' => $_SESSION['scriptcase']['reg_conf']['grup_num'],
                'symbol_fmt' => $_SESSION['scriptcase']['reg_conf']['num_group_digit'],
                'symbol_dec' => $_SESSION['scriptcase']['reg_conf']['dec_num'],
                'symbol_mon' => '',
                'symbol_neg' => $_SESSION['scriptcase']['reg_conf']['simb_neg'],
                'format_pos' => '',
                'format_neg' => $_SESSION['scriptcase']['reg_conf']['neg_num'],
                'newfmt_neg' => '',
            ),
            'widget7_metric' => array(
                'symbol_grp' => $_SESSION['scriptcase']['reg_conf']['grup_num'],
                'symbol_fmt' => $_SESSION['scriptcase']['reg_conf']['num_group_digit'],
                'symbol_dec' => $_SESSION['scriptcase']['reg_conf']['dec_num'],
                'symbol_mon' => '',
                'symbol_neg' => $_SESSION['scriptcase']['reg_conf']['simb_neg'],
                'format_pos' => '',
                'format_neg' => $_SESSION['scriptcase']['reg_conf']['neg_num'],
                'newfmt_neg' => '',
            ),
        );
    } // loadFieldConfig

} // IndicadorFinanceiro_Cor_ini

class IndicadorFinanceiro_Cor_control {

    var $Ini;
    var $runningWidgetId = '';
    var $runningWidgetType = '';
    var $widgetInfo = [];
    var $widgetOptions = [];
    var $widgetParams = [];
    var $indexData = [];
    var $bufferContent = '';
    var $Db;
    var $nm_data;
    var $arr_buttons;
    var $Change_Menu;
    var $display_as_mobile;
    var $Widget_max;
    var $Widget_rest;
    var $index_icon_pos;
    var $index_icon_neg;
    var $index_icon_neu;
    var $index_title_color;
    var $sc_init_menu ;

    function restartFlushBuffer()
    {
        ob_flush();
        ob_start();
    }

    function restartGetBuffer()
    {
        $this->bufferContent .= ob_get_clean();
        ob_start();
    }

    function executeApplicationInit()
    {
        $this->restartFlushBuffer();
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['contr_erro'] = 'on';
 
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['contr_erro'] = 'off';
        $this->restartGetBuffer();
    }
    function executeScriptInit()
    {
        $this->restartFlushBuffer();
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['contr_erro'] = 'on';
 
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['contr_erro'] = 'off';
        $this->restartGetBuffer();
    }
    function executeWidgetLoad()
    {
        $this->restartFlushBuffer();
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['contr_erro'] = 'on';
 
$_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['contr_erro'] = 'off';
        $this->restartGetBuffer();
    }

    function sc_widget_name()
    {
        return $this->runningWidgetId;
    }

    function sc_widget_type()
    {
        return $this->runningWidgetType;
    }

    function sc_widget_config($paramList)
    {
        $allowedParams = [
            'title',
            'subtitle',
            'legend',
            'background-color',
            'border-color',
        ];

        foreach ($paramList as $paramName => $paramValue) {
            if (in_array($paramName, $allowedParams)) {
                $this->widgetOptions[$paramName] = $paramValue;
            }
        }
    }

    function sc_widget_data($paramName)
    {
        $allowedParams = [
            'value' => 'new_metric',
            'period' => 'new_dimension',
            'last_value' => 'old_metric',
            'last_period' => 'old_dimension',
            'difference' => 'difference',
            'variation' => 'percentage',
        ];

        if (isset($allowedParams[$paramName]) && isset($this->indexData[$allowedParams[$paramName]])) {
            return $this->indexData[$allowedParams[$paramName]];
        } else {
            return null;
        }
    }

    function getStyleChanges($widgetName, $widgetType)
    {
        if ('link' == $widgetType) {
            $widgetTypeClass = 'Link';
        } elseif ('divider' == $widgetType) {
            $widgetTypeClass = 'Divider';
        } else {
            $widgetTypeClass = 'Index';
        }
        $newRules = [
            ".scContainer{$widgetTypeClass}Moldura_{$widgetName}" => [],
        ];
        if (isset($this->widgetOptions['background-color'])) {
            $newRules[".scContainer{$widgetTypeClass}Moldura_{$widgetName}"][] = "background-color: {$this->widgetOptions['background-color']}";
        }
        if (isset($this->widgetOptions['border-color'])) {
            $newRules[".scContainer{$widgetTypeClass}Moldura_{$widgetName}"][] = "border-color: {$this->widgetOptions['border-color']}";
        }
        $newStyles = [];
        foreach ($newRules as $selector => $rules) {
            if (!empty($rules)) {
                $newStyles[] = "$selector { " . implode('; ', $rules) . " }";
            }
        }
        if (empty($newStyles)) {
            return '';
        }
        return "<style>\r\n" . implode("\r\n", $newStyles) . "</style>\r\n";
    }

    function control()
    {
        $this->init();
        include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
        if (!function_exists("nmButtonOutput")) {
            include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
        }
        $this->Db = $this->Ini->Db;
        $this->checkSecurity();
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['IndicadorFinanceiro_Cor']['initialize']) {
            $this->executeApplicationInit();
            $_SESSION['sc_session'][$this->Ini->sc_page]['IndicadorFinanceiro_Cor']['initialize'] = false;
        }
        $this->executeScriptInit();
        if (isset($_GET['blank']) && 'Y' == $_GET['blank'])
        {
            $this->displayBlankPage();
        }
        else
        {
            $this->displayContainer();
        }
    } // control

    function init()
    {
        if (!$this->Ini)
        {
            $this->Ini = new IndicadorFinanceiro_Cor_ini();
            $this->Ini->init();
        }

        $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_data.class.php", "C", "nm_data");
        $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
        $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_functions.php", "", "");
        global $bol_api_prod; 
        $bol_api_prod = true; 
        if (isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['glo_nm_conexao'])) 
        { 
            $bol_api_prod = false;
        } 
        $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_api.php", "", "");
        $this->Ini->sc_Include($this->Ini->path_lib_php . "/fix.php", "", "");
        $this->nm_data = new nm_data($this->Ini->str_lang);

        $_SESSION['scriptcase']['sc_aba_iframe']['IndicadorFinanceiro_Cor'] = array(
        );

        $_SESSION['scriptcase']['dashboard_targets']['IndicadorFinanceiro_Cor'] = array();


        $_SESSION['scriptcase']['dashboard_scinit']['IndicadorFinanceiro_Cor'] = array();

        $_SESSION['scriptcase']['dashboard_scinit']['IndicadorFinanceiro_Cor']['dbifrm_widget1'] = rand(2, 10000);
        $_SESSION['scriptcase']['dashboard_scinit']['IndicadorFinanceiro_Cor']['dbifrm_widget4'] = rand(2, 10000);
        $_SESSION['scriptcase']['dashboard_scinit']['IndicadorFinanceiro_Cor']['dbifrm_widget7'] = rand(2, 10000);

        $_SESSION['scriptcase']['dashboard_toolbar']['IndicadorFinanceiro_Cor'] = array();

        $_SESSION['scriptcase']['dashboard_toolbar']['IndicadorFinanceiro_Cor']['ReceitaDespesa_Cog'] = array(
            'form_update'     => false,
            'form_insert'     => false,
            'form_delete'     => false,
            'form_copy'       => false,
            'form_navigate'   => false,
            'form_navpage'    => false,
            'form_goto'       => false,
            'form_lineqty'    => false,
            'form_summary'    => false,
            'form_qsearch'    => false,
            'form_dynsearch'  => false,
            'form_reload'     => false,
            'grid_navigate'   => false,
            'grid_summary'    => false,
            'grid_qsearch'    => false,
            'grid_dynsearch'  => false,
            'grid_filter'     => false,
            'grid_sel_col'    => false,
            'grid_sort_col'   => false,
            'grid_goto'       => false,
            'grid_lineqty'    => false,
            'grid_navpage'    => false,
            'grid_pdf'        => false,
            'grid_xls'        => false,
            'grid_xml'        => false,
            'grid_csv'        => false,
            'grid_rtf'        => false,
            'grid_word'       => false,
            'grid_print'      => false,
            'grid_new'        => false,
            'grid_reload'     => false,
            'grid_rows'       => false,
            'chart_sort'      => false,
            'chart_custom'    => false,
            'chart_bar'       => false,
            'chart_line'      => false,
            'chart_area'      => false,
            'chart_pizza'     => false,
            'chart_stack'     => false,
            'chart_combo'     => false,
            'chart_type'      => false,
            'chart_summary'   => false,
            'chart_pdf'       => false,
            'chart_print'     => false,
            'chart_word'      => false,
            'chart_xls'       => false,
            'chart_xml'       => false,
            'chart_csv'       => false,
            'chart_rtf'       => false,
            'chart_reload'    => false,
            'chart_imagem'    => false,
            'chart_dynsearch' => false,
            'chart_filter'    => false,
            'chart_conf'      => false,
            'chart_settings'  => false,
            'sel_groupby'     => false,
            'chart_detail'    => false,
        );
        $_SESSION['scriptcase']['dashboard_toolbar']['IndicadorFinanceiro_Cor']['DespesasMesAtual_Cog'] = array(
            'form_update'     => false,
            'form_insert'     => false,
            'form_delete'     => false,
            'form_copy'       => false,
            'form_navigate'   => false,
            'form_navpage'    => false,
            'form_goto'       => false,
            'form_lineqty'    => false,
            'form_summary'    => false,
            'form_qsearch'    => false,
            'form_dynsearch'  => false,
            'form_reload'     => false,
            'grid_navigate'   => false,
            'grid_summary'    => false,
            'grid_qsearch'    => false,
            'grid_dynsearch'  => false,
            'grid_filter'     => false,
            'grid_sel_col'    => false,
            'grid_sort_col'   => false,
            'grid_goto'       => false,
            'grid_lineqty'    => false,
            'grid_navpage'    => false,
            'grid_pdf'        => false,
            'grid_xls'        => false,
            'grid_xml'        => false,
            'grid_csv'        => false,
            'grid_rtf'        => false,
            'grid_word'       => false,
            'grid_print'      => false,
            'grid_new'        => false,
            'grid_reload'     => false,
            'grid_rows'       => false,
            'chart_sort'      => false,
            'chart_custom'    => false,
            'chart_bar'       => false,
            'chart_line'      => false,
            'chart_area'      => false,
            'chart_pizza'     => false,
            'chart_stack'     => false,
            'chart_combo'     => false,
            'chart_type'      => false,
            'chart_summary'   => false,
            'chart_pdf'       => false,
            'chart_print'     => false,
            'chart_word'      => false,
            'chart_xls'       => false,
            'chart_xml'       => false,
            'chart_csv'       => false,
            'chart_rtf'       => false,
            'chart_reload'    => false,
            'chart_imagem'    => false,
            'chart_dynsearch' => false,
            'chart_filter'    => false,
            'chart_conf'      => false,
            'chart_settings'  => false,
            'sel_groupby'     => false,
            'chart_detail'    => false,
        );
        $_SESSION['scriptcase']['dashboard_toolbar']['IndicadorFinanceiro_Cor']['PrevistoRealizado_Cog'] = array(
            'form_update'     => false,
            'form_insert'     => false,
            'form_delete'     => false,
            'form_copy'       => false,
            'form_navigate'   => false,
            'form_navpage'    => false,
            'form_goto'       => false,
            'form_lineqty'    => false,
            'form_summary'    => false,
            'form_qsearch'    => false,
            'form_dynsearch'  => false,
            'form_reload'     => false,
            'grid_navigate'   => false,
            'grid_summary'    => false,
            'grid_qsearch'    => false,
            'grid_dynsearch'  => false,
            'grid_filter'     => false,
            'grid_sel_col'    => false,
            'grid_sort_col'   => false,
            'grid_goto'       => false,
            'grid_lineqty'    => false,
            'grid_navpage'    => false,
            'grid_pdf'        => false,
            'grid_xls'        => false,
            'grid_xml'        => false,
            'grid_csv'        => false,
            'grid_rtf'        => false,
            'grid_word'       => false,
            'grid_print'      => false,
            'grid_new'        => false,
            'grid_reload'     => false,
            'grid_rows'       => false,
            'chart_sort'      => false,
            'chart_custom'    => false,
            'chart_bar'       => false,
            'chart_line'      => false,
            'chart_area'      => false,
            'chart_pizza'     => false,
            'chart_stack'     => false,
            'chart_combo'     => false,
            'chart_type'      => false,
            'chart_summary'   => false,
            'chart_pdf'       => false,
            'chart_print'     => false,
            'chart_word'      => false,
            'chart_xls'       => false,
            'chart_xml'       => false,
            'chart_csv'       => false,
            'chart_rtf'       => false,
            'chart_reload'    => false,
            'chart_imagem'    => false,
            'chart_dynsearch' => false,
            'chart_filter'    => false,
            'chart_conf'      => false,
            'chart_settings'  => false,
            'sel_groupby'     => false,
            'chart_detail'    => false,
        );
        $this->Change_Menu = false;
        if (isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['IndicadorFinanceiro_Cor']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['IndicadorFinanceiro_Cor']['sc_outra_jan']))
        {
            $this->sc_init_menu = "x";
            if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['IndicadorFinanceiro_Cor']))
            {
                $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['IndicadorFinanceiro_Cor'];
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
            if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['IndicadorFinanceiro_Cor']))
            {
                 $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['IndicadorFinanceiro_Cor']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('IndicadorFinanceiro_Cor') . "/IndicadorFinanceiro_Cor.php";
                 $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['IndicadorFinanceiro_Cor']['label'] = "IndicadorFinanceiro_Cor";
                 $this->Change_Menu = true;
            }
            elseif ($this->Ini->sc_page == $this->sc_init_menu)
            {
                $achou = false;
                foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
                {
                    if ($apl == "IndicadorFinanceiro_Cor")
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
    } // init

    function checkSecurity()
    {
        if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")
        {
            $_SESSION['scriptcase']['sc_apl_seg']['IndicadorFinanceiro_Cor'] = "on";
        }

        if (!isset($_SESSION['scriptcase']['IndicadorFinanceiro_Cor']['session_timeout']['redir']) && (!isset($_SESSION['scriptcase']['sc_apl_seg']['IndicadorFinanceiro_Cor']) || $_SESSION['scriptcase']['sc_apl_seg']['IndicadorFinanceiro_Cor'] != "on"))
        {
            $this->displayAccessError();
        }
    } // checkSecurity

    function displayBlankPage()
    {
?>
<?php
        header("X-XSS-Protection: 1; mode=block");
        header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>" />
 <title></title>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Pragma" content="no-cache" />
<?php
        if (!function_exists("sc_check_mobile"))
        {
            include_once("../_lib/lib/php/nm_check_mobile.php");
        }
        $this->display_as_mobile = sc_check_mobile();
        if($this->display_as_mobile)
        {
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
        }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>font-awesome/6/css/all.min.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>jquery_plugin/inettuts/sc_inettuts.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>bootstrap/css/bootstrap.min.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>gridstack.js-master/dist/gridstack.min.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_container.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_container<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
<style>
.grid-stack-item, .grid-stack>.grid-stack-item>.grid-stack-item-content {
<?php
        if ($this->display_as_mobile) {
?>
    overflow: hidden !important;
    -webkit-overflow-scrolling: touch !important;
    display: flex; flex-direction: column; height: 100%;
<?php
        } else {
?>
    overflow-y: hidden;
    display: flex; flex-direction: column; height: 100%;
<?php
        }
?>
}
</style>
 <link rel="stylesheet" type="text/css" href="IndicadorFinanceiro_Cor_container_index.css" />
<?php
        global $str_widget_max, $str_widget_rest, $index_class_pos, $index_class_neg, $index_class_neu, $index_title_color;
        include_once "../_lib/css/" . $this->Ini->str_schema_all . "_container.php";
        $this->Widget_max = $str_widget_max;
        $this->Widget_rest = $str_widget_rest;
        $this->index_icon_pos = $index_class_pos;
        $this->index_icon_neg = $index_class_neg;
        $this->index_icon_neu = $index_class_neu;
        $this->index_title_color = $index_title_color;
?>
<script type="text/javascript">
function sc_session_redir(url_redir)
{
    if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
    {
        window.parent.sc_session_redir(url_redir);
    }
    else
    {
        if (window.opener && typeof window.opener.sc_session_redir === 'function')
        {
            window.close();
            window.opener.sc_session_redir(url_redir);
        }
        else
        {
            window.location = url_redir;
        }
    }
}
var scIframeSCInit = {};
<?php
        foreach ($_SESSION['scriptcase']['dashboard_scinit']['IndicadorFinanceiro_Cor'] as $sIframe => $iSCInit) {
?>
scIframeSCInit["<?php echo $sIframe; ?>"] = "<?php echo $iSCInit; ?>";
<?php
        }
?>
</script>
</head>
<body class="scContainerPage">



</body>
</html>
<?php
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
    } // displayBlankPage

    function displayContainer()
    {
?>
<?php
        header("X-XSS-Protection: 1; mode=block");
        header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>" />
 <title></title>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Pragma" content="no-cache" />
<?php
        if (!function_exists("sc_check_mobile"))
        {
            include_once("../_lib/lib/php/nm_check_mobile.php");
        }
        $this->display_as_mobile = sc_check_mobile();
        if($this->display_as_mobile)
        {
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
        }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>font-awesome/6/css/all.min.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>jquery_plugin/inettuts/sc_inettuts.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>bootstrap/css/bootstrap.min.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>gridstack.js-master/dist/gridstack.min.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_container.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_container<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
<style>
.grid-stack-item, .grid-stack>.grid-stack-item>.grid-stack-item-content {
<?php
        if ($this->display_as_mobile) {
?>
    overflow: hidden !important;
    -webkit-overflow-scrolling: touch !important;
    display: flex; flex-direction: column; height: 100%;
<?php
        } else {
?>
    overflow-y: hidden;
    display: flex; flex-direction: column; height: 100%;
<?php
        }
?>
}
</style>
 <link rel="stylesheet" type="text/css" href="IndicadorFinanceiro_Cor_container_index.css" />
<?php
        global $str_widget_max, $str_widget_rest, $index_class_pos, $index_class_neg, $index_class_neu, $index_title_color;
        include_once "../_lib/css/" . $this->Ini->str_schema_all . "_container.php";
        $this->Widget_max = $str_widget_max;
        $this->Widget_rest = $str_widget_rest;
        $this->index_icon_pos = $index_class_pos;
        $this->index_icon_neg = $index_class_neg;
        $this->index_icon_neu = $index_class_neu;
        $this->index_title_color = $index_title_color;
?>

<script type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_third; ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_third; ?>lodash/lodash.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_third; ?>gridstack.js-master/dist/gridstack.all.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {

        var options = {
            float: false,
            cellHeight: 60,
        };
        $('.grid-stack').gridstack(options);
    });

    var_widget_maximized = "";
    var_widget_old_height = "";
    function maximizeWidget(str_widget_id)
    {
        var_widget_maximized = str_widget_id;
        var widgetIframe = $("#id-div-" + var_widget_maximized).find("iframe");
        if (widgetIframe.length > 0) {
            var srcTag = widgetIframe[0].contentWindow.location.href;
        }

        $("#id-div-" + var_widget_maximized).detach().appendTo('.modal-content');

        var_widget_old_height = $("#id-div-" + var_widget_maximized).css('height');
        $("#id-div-" + var_widget_maximized).css('height', 'calc(100% - 15px)');

        $("#id-div-" + var_widget_maximized + " .collapse").toggle();
        $("#id-div-" + var_widget_maximized + " .maximize").toggle();
        $("#id-div-" + var_widget_maximized + " .remove").toggle();
        $("#id-div-" + var_widget_maximized + " .removeModal").show();

        widgetIframe = $("#id-div-" + var_widget_maximized).find("iframe");
        if (widgetIframe.length) {
            srcTag = addUrlParam(srcTag, "maximized", "1", $(widgetIframe[0]).attr("name"));
            $(widgetIframe[0]).attr("src", srcTag);
        }

        $('.modal').modal('show');
    }
    function minimizeWidget()
    {
        var widgetIframe = $("#id-div-" + var_widget_maximized).find("iframe");
        if (widgetIframe.length > 0) {
            var srcTag = widgetIframe[0].contentWindow.location.href;
        }

        $("#id-div-" + var_widget_maximized).detach().appendTo("#id-father-" + var_widget_maximized);

        $("#id-div-" + var_widget_maximized).css('height', '100%');

        $("#id-div-" + var_widget_maximized + " .collapse").toggle();
        $("#id-div-" + var_widget_maximized + " .maximize").toggle();
        $("#id-div-" + var_widget_maximized + " .remove").toggle();
        $("#id-div-" + var_widget_maximized + " .removeModal").hide();

        widgetIframe = $("#id-div-" + var_widget_maximized).find("iframe");
        if (widgetIframe.length) {
            srcTag = addUrlParam(srcTag, "maximized", "0", $(widgetIframe[0]).attr("name"));
            $(widgetIframe[0]).attr("src", srcTag);
        }

        $('.modal').modal('hide');
    }
    function addUrlParam(sUrl, sParam, sValue, sName) {
        var baseUrl, urlParams = [], objParams = {}, tmp, i;
        tmp = sUrl.split("?");
        baseUrl = tmp[0];
        if (tmp[1]) {
            urlParams = tmp[1].split("&");
        }
        for (i = 0; i < urlParams.length; i++) {
            tmp = urlParams[i].split("=");
            objParams[ tmp[0] ] = tmp[1] ? tmp[1] : "";
        }
        objParams["script_case_init"] = scIframeSCInit[sName];
        objParams[sParam] = sValue;
        urlParams = [];
        for (tmp in objParams) {
            urlParams.push(tmp + "=" + objParams[tmp]);
        }
        return baseUrl + "?" + urlParams.join("&");
    }

    function hideDebugWindow()
    {
        $("#id_debug_text").html("");
        $("#id_debug_window").hide();
    }

    function showDebugWindow(debugMessage)
    {
        let newDebug = "";
        if ("" != debugMessage) {
            newDebug += debugMessage;
        }
        if ("" != $("#id_debug_text").html()) {
            newDebug += "<br />" + $("#id_debug_text").html();
        }
        $("#id_debug_text").html(newDebug);
        $("#id_debug_window").show();
    }

    $(function() {
        $( ".collapse" ).click(function() {
            $(this).parent().parent().toggleClass( "collapsed" );
            if ($(this).parent().parent().hasClass("collapsed")) {
                var barHeight = $(this).parent().parent().parent().find(".widget-head").height();
                if (barHeight) {
                    $(this).parent().parent().parent().css({
                        height: 0,
                        minHeight: (barHeight + 2) + "px"
                    });
                }
            }
            else {
                $(this).parent().parent().parent().css({
                    height: "",
                    minHeight: ""
                });
            }
        });

        $( ".remove" ).not(".removeModal").click(function() {
            if (confirm("<?php echo $this->Ini->Nm_lang['lang_remove_container'] ?>")) {
                $('.grid-stack').data('gridstack').removeWidget($(this).parent().parent().parent());
            }
        });

        $('.modal').on('hidden.bs.modal', function () {
            minimizeWidget();
        });

        $( ".removeModal" ).click(function() {
            $('.modal').modal('hide');
        });
    });
</script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod . '/third/fusioncharts-suite-xt/js/fusioncharts.js' ?>"></script>
 <script type="text/javascript">
 var _0x2a9c6f=_0x1dca;function _0x1dca(_0xe4377e,_0x1b81e2){var _0x5b52f4=_0x5b52();return _0x1dca=function(_0x1dca71,_0x2a923f){_0x1dca71=_0x1dca71-0x1c7;var _0x141613=_0x5b52f4[_0x1dca71];return _0x141613;},_0x1dca(_0xe4377e,_0x1b81e2);}function _0x5b52(){var _0x2f555f=['667805zEUTHi','2537110AnXgKT','9908390zHctCU','8968kYpBKO','4xIkojs','3cNIlPu','license','159962VsDImE','5018772jBJBQw','7rNiKXc','1067788GrVIGD','2700mLIdJZ'];_0x5b52=function(){return _0x2f555f;};return _0x5b52();}(function(_0x4cefc0,_0x430fb3){var _0x10ab7a=_0x1dca,_0x50734d=_0x4cefc0();while(!![]){try{var _0x9fcd02=-parseInt(_0x10ab7a(0x1ce))/0x1+parseInt(_0x10ab7a(0x1cc))/0x2*(parseInt(_0x10ab7a(0x1c7))/0x3)+parseInt(_0x10ab7a(0x1d2))/0x4*(parseInt(_0x10ab7a(0x1cf))/0x5)+-parseInt(_0x10ab7a(0x1ca))/0x6*(parseInt(_0x10ab7a(0x1cb))/0x7)+parseInt(_0x10ab7a(0x1d1))/0x8*(parseInt(_0x10ab7a(0x1cd))/0x9)+parseInt(_0x10ab7a(0x1d0))/0xa+parseInt(_0x10ab7a(0x1c9))/0xb;if(_0x9fcd02===_0x430fb3)break;else _0x50734d['push'](_0x50734d['shift']());}catch(_0x5b5696){_0x50734d['push'](_0x50734d['shift']());}}}(_0x5b52,0xd688a),FusionCharts['options'][_0x2a9c6f(0x1c8)]({'key':'YcC1orx'+'B1D8B1D3F3'+'C2D2F1C2B4A7B6'+'C4C-9ni1C2C5i'+'qC-13avH2I2es'+'lE2D6E2C3E3'+'G3I3B7A4E2'+'F4B2E3D4F3H3B'+'-22ffF4E2'+'D3nD2G'+'1B6cfqB2'+'E3C1C-7yhB1E'+'4B1suwA33A8B'+'14C5D7'+'A2D5G2H4B3B2'+'hbbA3C4IA2'+'rveA4D4E2'+'C-11oF1I'+'1F2C2'+'eevE6E1G4F2A1'+'C3B1'+'E6E2A2C5F1'+'D1F2l==','creditLabel':![]}));
 </script>
<script type="text/javascript">
$( document ).ready(function() {
    $('.sc-iframe-widget').each(function() {
        if ($(this).attr('alt')) {
            var wId  = $(this).attr('id'),
            wSrc = $(this).attr('src'),
            wRef = parseInt($(this).attr('alt')) * 1000;
            setTimeout(function() { refreshWidget(wId, wSrc, wRef); }, wRef);
        }
    });
});
function refreshWidget(wId, wSrc, wRef)
{
     document.getElementById(wId).contentWindow.location = wSrc;
     setTimeout(function() { refreshWidget(wId, wSrc, wRef); }, wRef);
}
</script>
<script type="text/javascript">
function sc_session_redir(url_redir)
{
    if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
    {
        window.parent.sc_session_redir(url_redir);
    }
    else
    {
        if (window.opener && typeof window.opener.sc_session_redir === 'function')
        {
            window.close();
            window.opener.sc_session_redir(url_redir);
        }
        else
        {
            window.location = url_redir;
        }
    }
}
var scIframeSCInit = {};
<?php
        foreach ($_SESSION['scriptcase']['dashboard_scinit']['IndicadorFinanceiro_Cor'] as $sIframe => $iSCInit) {
?>
scIframeSCInit["<?php echo $sIframe; ?>"] = "<?php echo $iSCInit; ?>";
<?php
        }
?>
</script>
</head>
<body class="scContainerPage">


<div class='grid-stack'>
<?php
$this->startUpWidget_widget1();
$this->getWidgetContent_widget1();
echo $this->getStyleChanges('widget1', 'link');
?>
                <div  class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="4" data-gs-height="10"  data-gs-no-resize="1" data-gs-no-move="1" id="id-father-0">
                    <div  class="grid-stack-item-content scContainerLinkMoldura_widget1 scContainerWidget" id="id-div-0">
                        <div class="widget-head" style="display:none">
                            <h3 class="scContainerTitle"><?php echo $this->widgetParams['title'] ?></h3>
                            <a href="#" class="remove removeModal" style="display:none">CLOSE</a>
                        </div>
                        <div class='widget-content widget-content-title-none' id="id-div-iframe-0"><iframe id="id-iframe-0" name="dbifrm_widget1" class="sc-iframe-widget" style="height: 100%; width: 100%; border: 0px" src="<?php echo $this->Ini->path_link . SC_dir_app_name('ReceitaDespesa_Cog'); ?>/ReceitaDespesa_Cog.php?script_case_init=<?php echo $_SESSION["scriptcase"]["dashboard_scinit"]["IndicadorFinanceiro_Cor"]["dbifrm_widget1"] ?>&under_dashboard=1&dashboard_app=IndicadorFinanceiro_Cor&own_widget=dbifrm_widget1&compact_mode=0&remove_margin=0&remove_border=0"></iframe></div>
                    </div>
                </div>
<?php
$this->startUpWidget_widget4();
$this->getWidgetContent_widget4();
echo $this->getStyleChanges('widget4', 'link');
?>
                <div  class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="4" data-gs-height="10"  data-gs-no-resize="1" data-gs-no-move="1" id="id-father-1">
                    <div  class="grid-stack-item-content scContainerLinkMoldura_widget4 scContainerWidget" id="id-div-1">
                        <div class="widget-head" style="display:none">
                            <h3 class="scContainerTitle"><?php echo $this->widgetParams['title'] ?></h3>
                            <a href="#" class="remove removeModal" style="display:none">CLOSE</a>
                        </div>
                        <div class='widget-content widget-content-title-none' id="id-div-iframe-1"><iframe id="id-iframe-1" name="dbifrm_widget4" class="sc-iframe-widget" style="height: 100%; width: 100%; border: 0px" src="<?php echo $this->Ini->path_link . SC_dir_app_name('DespesasMesAtual_Cog'); ?>/DespesasMesAtual_Cog.php?script_case_init=<?php echo $_SESSION["scriptcase"]["dashboard_scinit"]["IndicadorFinanceiro_Cor"]["dbifrm_widget4"] ?>&under_dashboard=1&dashboard_app=IndicadorFinanceiro_Cor&own_widget=dbifrm_widget4&compact_mode=0&remove_margin=0&remove_border=0"></iframe></div>
                    </div>
                </div>
<?php
$this->startUpWidget_widget7();
$this->getWidgetContent_widget7();
echo $this->getStyleChanges('widget7', 'link');
?>
                <div  class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="4" data-gs-height="10"  data-gs-no-resize="1" data-gs-no-move="1" id="id-father-2">
                    <div  class="grid-stack-item-content scContainerLinkMoldura_widget7 scContainerWidget" id="id-div-2">
                        <div class="widget-head" style="display:none">
                            <h3 class="scContainerTitle"><?php echo $this->widgetParams['title'] ?></h3>
                            <a href="#" class="remove removeModal" style="display:none">CLOSE</a>
                        </div>
                        <div class='widget-content widget-content-title-none' id="id-div-iframe-2"><iframe id="id-iframe-2" name="dbifrm_widget7" class="sc-iframe-widget" style="height: 100%; width: 100%; border: 0px" src="<?php echo $this->Ini->path_link . SC_dir_app_name('PrevistoRealizado_Cog'); ?>/PrevistoRealizado_Cog.php?script_case_init=<?php echo $_SESSION["scriptcase"]["dashboard_scinit"]["IndicadorFinanceiro_Cor"]["dbifrm_widget7"] ?>&under_dashboard=1&dashboard_app=IndicadorFinanceiro_Cor&own_widget=dbifrm_widget7&compact_mode=0&remove_margin=0&remove_border=0"></iframe></div>
                    </div>
                </div></div>
<div id="myModal" class="modal fade" role="dialog" style="margin:0px !important; padding:5px !important;">
    <div class="modal-dialog" style="width: 100%; height: 100%; margin:0px !important; padding:10px !important;">
        <div class="modal-content" style="width: 100%; padding:2px; height: 100%;">
        </div>
    </div>
</div>

<?php
$debugDisplay = '' == $this->bufferContent ? 'display: none;' : '';
?>
<div id="id_debug_window" style="<?php echo $debugDisplay ?>" class="scContainerDebugWindow">
    <table class="scContainerDebugTable">
        <tr>
            <td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "hideDebugWindow()", "hideDebugWindow()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</td>
        </tr>
        <tr>
            <td class="scContainerDebugMessage" style="padding: 0px; vertical-align: top">
                <div style="padding: 2px; height: 250px; width: 400px; overflow: auto" id="id_debug_text">
                    <?php echo $this->bufferContent ?>
                </div>
            </td>
        </tr>
    </table>
</div>


<script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>

</body>
</html>
<?php
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
    } // displayContainer

    function NM_encode_input($str)
    {
        $aRep = array(
                      '&#059;' => ';',
                      '&lt;' => '<',
                      '&gt;' => '>',
                      '&quot;' => '"',
                      '&#039;' => "'",
                      '&#040;' => '(',
                      '&#041;' => ')',
                     );
        $str = str_replace('<br>', '__SC_BREAK_LINE__', $str);
        $str = str_replace('<br />', '__SC_BREAK_LINE__', $str);
        $str = str_replace('&nbsp;', '__SC_SPACE_CHAR__', $str);
        $str = str_replace('&', '__SC_AMP_CHAR__', $str);
        $str = str_replace(array_values($aRep), array_keys($aRep), $str);
        $str = str_replace('__SC_AMP_CHAR__', '&amp;', $str);
        $str = str_replace('__SC_BREAK_LINE__', '<br />', $str);
        $str = str_replace('__SC_SPACE_CHAR__', '&nbsp;', $str);
        return $str;
    }
    function displayPassword()
    {
        global $nm_parms_senha, $script_case_init;
    header("X-XSS-Protection: 1; mode=block");
    header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE html>


<HTML>
    <HEAD>
        <TITLE></TITLE>
        <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />

        <?php
        if (isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
        {
        ?>
           <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php
        }
        ?>
        <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
        <META http-equiv="Pragma" content="no-cache" />
        <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico" />
        <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
<META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
<META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
<META http-equiv="Pragma" content="no-cache" />

        <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
        <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_form; ?>/<?php echo $this->Ini->Str_btn_form; ?>.css" />
        <?php
        if(isset($_SESSION['scriptcase']['str_google_fonts']) && !empty($_SESSION['scriptcase']['str_google_fonts']))
        {
        ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['str_google_fonts']; ?>" />
        <?php
        }
        ?>
    </HEAD>
    <body class="scGridPage">
        <form name="Fsenha" method="post" action="IndicadorFinanceiro_Cor.php">
            <div style="text-align:center;">
                <div class="scFormBorder" style="display:inline-block; padding:1px;">
                    <div  class='scFormTable' style='display: flex'>
                        <div class='scFormLabelOdd'  style='display: inline-block'>
                            <?php echo $this->Ini->Nm_lang['lang_errm_type_pswd']; ?>
                        </div>
                        <div class='scFormDataOdd'  style='display: inline-block'>
                            <?php
                            foreach ($nm_parms_senha as $nm_nome_parm => $nm_val_parm)
                            {
                            ?>
                               <input type="hidden"   name="<?php echo $nm_nome_parm ?>" value="<?php echo NM_encode_input($nm_val_parm) ?>"/>
                            <?php
                            }
                            ?>
                           <input type="hidden"   name="script_case_init" value="<?php echo NM_encode_input($script_case_init) ?>"/>
                           <input type="hidden"   name="script_case_ref" value="<?php echo isset($_SERVER['HTTP_REFERER']) ? NM_encode_input($_SERVER['HTTP_REFERER']) : ""; ?>"/>
                           <input type="password" name="script_case_senha" value="" class="scFormObjectOdd" size=32 required />
                        </div>
                    </div>
                    <div class='scFormToolbar'>
                        <input type="submit" class="scButton_default" name="sc_sai_senha" value="OK">
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            document.Fsenha.script_case_senha.focus();
        </script>
    </body>
</html><?php
        exit;
    } // displayPassword

    function displayAccessError()
    {
?>
<?php
        header("X-XSS-Protection: 1; mode=block");
        header("X-Frame-Options: SAMEORIGIN");
?>
<!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>" />
 <title></title>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Pragma" content="no-cache" />
<?php
        if (!function_exists("sc_check_mobile"))
        {
            include_once("../_lib/lib/php/nm_check_mobile.php");
        }
        $this->display_as_mobile = sc_check_mobile();
        if($this->display_as_mobile)
        {
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
        }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>font-awesome/6/css/all.min.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>jquery_plugin/inettuts/sc_inettuts.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>bootstrap/css/bootstrap.min.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->url_third; ?>gridstack.js-master/dist/gridstack.min.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_container.css" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_container<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
<style>
.grid-stack-item, .grid-stack>.grid-stack-item>.grid-stack-item-content {
<?php
        if ($this->display_as_mobile) {
?>
    overflow: hidden !important;
    -webkit-overflow-scrolling: touch !important;
    display: flex; flex-direction: column; height: 100%;
<?php
        } else {
?>
    overflow-y: hidden;
    display: flex; flex-direction: column; height: 100%;
<?php
        }
?>
}
</style>
 <link rel="stylesheet" type="text/css" href="IndicadorFinanceiro_Cor_container_index.css" />
<?php
        global $str_widget_max, $str_widget_rest, $index_class_pos, $index_class_neg, $index_class_neu, $index_title_color;
        include_once "../_lib/css/" . $this->Ini->str_schema_all . "_container.php";
        $this->Widget_max = $str_widget_max;
        $this->Widget_rest = $str_widget_rest;
        $this->index_icon_pos = $index_class_pos;
        $this->index_icon_neg = $index_class_neg;
        $this->index_icon_neu = $index_class_neu;
        $this->index_title_color = $index_title_color;
?>
<script type="text/javascript">
function sc_session_redir(url_redir)
{
    if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
    {
        window.parent.sc_session_redir(url_redir);
    }
    else
    {
        if (window.opener && typeof window.opener.sc_session_redir === 'function')
        {
            window.close();
            window.opener.sc_session_redir(url_redir);
        }
        else
        {
            window.location = url_redir;
        }
    }
}
var scIframeSCInit = {};
<?php
        foreach ($_SESSION['scriptcase']['dashboard_scinit']['IndicadorFinanceiro_Cor'] as $sIframe => $iSCInit) {
?>
scIframeSCInit["<?php echo $sIframe; ?>"] = "<?php echo $iSCInit; ?>";
<?php
        }
?>
</script>
</head>
<body class="scContainerPage">

<br />
<table align="center" class="scGridBorder"><tr><td style="padding: 0">
 <table style="width: 100%" class="scGridTabela">
  <tr class="scGridFieldOdd">
   <td class="scGridFieldOddFont" style="padding: 15px 30px">
    <?php echo $this->Ini->Nm_lang['lang_errm_unth_user']; ?>
   </td>
  </tr>
 </table>
</td></tr></table>
<?php
        if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']))
        {
?>
<br /><br /><br />
<table align="center" class="scGridBorder" style="width: 450px"><tr><td style="padding: 0">
 <table style="width: 100%" class="scGridTabela">
  <tr class="scGridFieldOdd">
   <td class="scGridFieldOddFont" style="padding: 15px 30px">
    <?php echo $this->Ini->Nm_lang['lang_errm_unth_hwto']; ?>
   </td>
  </tr>
 </table>
</td></tr></table>
<?php
        }
?>

</body>
</html>
<?php
        exit;
    } // displayAccessError

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

    function startUpWidget_widget1()
    {
        $this->runningWidgetId = "widget1";
        $this->runningWidgetType = "link";

        $this->widgetInfo = [
            'get_data_result' => true,
            'get_data_error' => '',
            'output' => '',
        ];
        $this->widgetOptions = [];
        $this->widgetParams = [
            'title' => "Receitas x Despesas (R$)",
        ];
        $this->indexData = [
            'chart_data' => []
        ];
    }

    function getWidgetContent_widget1()
    {
        $this->executeWidgetLoad();

        foreach ($this->widgetOptions as $optionIndex => $optionValue) {
            $this->widgetParams[$optionIndex] = $optionValue;
        }
    }

    function getWidgetOutput_widget1()
    {
        return $this->widgetInfo['output'];
    }

    function startUpWidget_widget4()
    {
        $this->runningWidgetId = "widget4";
        $this->runningWidgetType = "link";

        $this->widgetInfo = [
            'get_data_result' => true,
            'get_data_error' => '',
            'output' => '',
        ];
        $this->widgetOptions = [];
        $this->widgetParams = [
            'title' => "Despesas do Mês (%)",
        ];
        $this->indexData = [
            'chart_data' => []
        ];
    }

    function getWidgetContent_widget4()
    {
        $this->executeWidgetLoad();

        foreach ($this->widgetOptions as $optionIndex => $optionValue) {
            $this->widgetParams[$optionIndex] = $optionValue;
        }
    }

    function getWidgetOutput_widget4()
    {
        return $this->widgetInfo['output'];
    }

    function startUpWidget_widget7()
    {
        $this->runningWidgetId = "widget7";
        $this->runningWidgetType = "link";

        $this->widgetInfo = [
            'get_data_result' => true,
            'get_data_error' => '',
            'output' => '',
        ];
        $this->widgetOptions = [];
        $this->widgetParams = [
            'title' => "Previsto x Realizado (R$)",
        ];
        $this->indexData = [
            'chart_data' => []
        ];
    }

    function getWidgetContent_widget7()
    {
        $this->executeWidgetLoad();

        foreach ($this->widgetOptions as $optionIndex => $optionValue) {
            $this->widgetParams[$optionIndex] = $optionValue;
        }
    }

    function getWidgetOutput_widget7()
    {
        return $this->widgetInfo['output'];
    }

    function scaleValue(&$value, &$suffix) {
        if (1000 <= $value) {
            $value /= 1000;
            $suffix = ' K';
        }

        if (1000 <= $value) {
            $value /= 1000;
            $suffix = ' M';
        }

        if (1000 <= $value) {
            $value /= 1000;
            $suffix = ' B';
        }
    } // scaleValue

} // IndicadorFinanceiro_Cor_control

function nm_limpa_str_IndicadorFinanceiro_Cor(&$str)
{
}

?>
