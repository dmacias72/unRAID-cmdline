<?php
require_once '/usr/local/emhttp/plugins/cmdline/include/cmdline_config.php';

$sb_service = isset($cmdline_cfg['SERVICE']) ? htmlspecialchars($cmdline_cfg['SERVICE']) : 'disable';
$cmdline_screen      = isset($cmdline_cfg['SCREEN'])  ? htmlspecialchars($cmdline_cfg['SCREEN'])  : 'disable';
$cmdline_backup      = isset($cmdline_cfg['BACKUP'])  ? htmlspecialchars($cmdline_cfg['BACKUP'])  : 'disable';
$sb_runas   = isset($cmdline_cfg['RUNAS'])   ? htmlspecialchars($cmdline_cfg['RUNAS'])   : 'nobody';
$sb_cert    = isset($cmdline_cfg['CERT'])    ? htmlspecialchars($cmdline_cfg['CERT'])    :  'certificate.pem';
$sb_version = '2.20';//shell_exec( "/usr/sbin/shellinaboxd --version 2>&1 | grep ShellInABox | sed -e 's/^ShellInABox version //;s/(.*//'" );
$sb_port_status = ($sb_running) ?
    "<a target='_blank' href='".$sb_http."://".$sb_host.":".$sb_port."' title='Click on link then accept security, then /Tools/CommandLineTools will work'><b><font color='green'>$sb_port</font></b></a>":
    "<b><font color='orange';'>$sb_port</font></b>";
exec("awk -F':' '{ if ( $3 >= 1000 ) print $1}' /etc/passwd", $sb_users); // get array of group users
?>