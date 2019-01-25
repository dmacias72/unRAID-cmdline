<?
$cmdline_cfg = parse_ini_file('/boot/config/plugins/cmdline/cmdline.cfg');

$sb_ipaddr   = isset($cmdline_cfg['IPADDR']) ? htmlspecialchars($cmdline_cfg['IPADDR']) : 'disable';

$sb_ssl      = isset($cmdline_cfg['SSL'])    ? htmlspecialchars($cmdline_cfg['SSL'])    : 'disable';

$sb_port     = (isset($cmdline_cfg['PORT']) && is_numeric($cmdline_cfg['PORT']) && $cmdline_cfg['PORT'] > 0 && $cmdline_cfg['PORT'] < 65535 ) ? intval($cmdline_cfg['PORT']) : 4200;

if($var['version'] >= "6.4"){
    //$sb_http   = $_SERVER['REQUEST_SCHEME'];

    if($var['USE_SSL'] == 'no'){
        if($sb_ipaddr == 'disable')
            $sb_host = ($sb_ipaddr == 'disable') ? $var['NAME'] : $_SERVER['SERVER_ADDR'];
    }else{
        $sb_host_arr = explode(':', $_SERVER['HTTP_HOST']);
        $sb_host = $sb_host_arr[0];
    }

}else{
    $sb_hostip = isset($var['IPADDR'])  ? $var['IPADDR'] : $eth0['IPADDR:0'];
    $sb_host = ($sb_ipaddr == 'disable') ? $var['NAME'] : $sb_hostip;
}

$sb_http   = ($sb_ssl == 'disable') ? 'http' : 'https';

$sb_running = (intval(trim(shell_exec( "[ -f /proc/`cat /var/run/shellinaboxd.pid 2> /dev/null`/exe ] && echo 1 || echo 0 2> /dev/null" ))) === 1);
$status_running      = '<span class="green">Running</span>';
$status_stopped      = '<span class="orange">Stopped</span>';
$sb_status  = ($sb_running) ? $status_running : $status_stopped;
?>