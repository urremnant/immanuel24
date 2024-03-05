<?
require_once ABSPATH . 'wp-admin/includes/plugin.php'; 
$activate_plugins = array("ninjafirewall","loginlockdown","two-factor","disable-xml-rpc-api");
 
for($i = 0; $i < count($activate_plugins); $i++){
    $activefile = WP_PLUGIN_DIR .'/' .$activate_plugins[$i] .'/activated';
    $pluginfile = $activate_plugins[$i] .'/' .$activate_plugins[$i] .'.php';
    $is_active = is_plugin_active($pluginfile);
    activate_plugin($pluginfile);
}

define('ACTIVEPF', WP_PLUGIN_DIR.'/activate_plugins.php');
if (file_exists(ACTIVEPF)) { unlink(ACTIVEPF); }
?>
