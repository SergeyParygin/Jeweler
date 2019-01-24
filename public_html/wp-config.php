<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'parsek_1');

/** Имя пользователя MySQL */
define('DB_USER', 'parsek_1');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'parsek_1');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AiB|hw-(>^d13v=%Pkz]]%Kl/oZ`*!w%B+$R>p280CjO*l@p6j|SlgMh&1Mrn(#G');
define('SECURE_AUTH_KEY',  'H<gsifF)I0J-BSa>11F(js,8OP<D,iC{66f zppB&QCdjR@TL#O=qIe4#O=_m)1 ');
define('LOGGED_IN_KEY',    'fP/ai12x|W8ppXATtOp471|czC9FFvi]1N`0,g#f^4H$v4=8JJt|z$&!Xb17^T}A');
define('NONCE_KEY',        '9#+-vre-4Gnd8fCD#dj}Rr 5|=A>^!*!P{j*Of~fS{#1E)B3O]&VJ=sM,tZHxpPG');
define('AUTH_SALT',        'Wl+_2cnvB*HW,zyj@I#9a59Qg&0S63cF(4S}JTp_w}!V#m+U[@Sd%bPyBAtpwoRf');
define('SECURE_AUTH_SALT', '@sL:x]=l}Kb0bNghN$Bu|8P2_R7m<&*1?c!=s4oMzxAT.:?;*0![C lSg2|<`^XN');
define('LOGGED_IN_SALT',   'TsnbQ>a|>RP~]+EcNoraOjI+$_Zq{MjMXrCjz6Nv5*TU:BB%OmY-oG}_:#r1cUT<');
define('NONCE_SALT',       'HMQzhjrBR|b3{Y)CAnDhm|o=e/(-?r+7q[o|-n*xt_/G~< r$g_(vomWpR]A&|9M');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
