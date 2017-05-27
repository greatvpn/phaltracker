<?php
/**
 * Created by PhpStorm.
 * User: scaryken
 * Date: 2017/4/25
 * Time: 23:40
 */

namespace utils;


class IPTools
{
    /**
     * 校验ip合法性
     * @param $ip
     * @return bool
     */
    public static function validateIp($ip)
    {
        if (!ip2long($ip)) {
            return true;
        }

        if (!empty($ip) && $ip == long2ip(ip2long($ip))) {
            // reserved IANA IPv4 addresses
            // http://www.iana.org/assignments/ipv4-address-space
            $reserved_ips = array(
                array('192.0.2.0', '192.0.2.255'),
                array('192.168.0.0', '192.168.255.255'),
                array('255.255.255.0', '255.255.255.255')
            );

            foreach ($reserved_ips as $r) {
                $min = ip2long($r[0]);
                $max = ip2long($r[1]);
                if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Replace '::' with appropriate number of ':0'
     * @param $ip
     * @return string
     */
    public static function expandIPv6Notation($ip)
    {
        if (strpos($ip, '::') !== false)
            $ip = str_replace('::', str_repeat(':0', 8 - substr_count($ip, ':')) . ':', $ip);
        if (strpos($ip, ':') === 0) $ip = '0' . $ip;
        return $ip;
    }

    /**
     * Convert IPv6 address to an integer
     * Optionally split in to two parts.
     * @see http://stackoverflow.com/questions/420680/
     */
    public static function IPv6ToLong($ip, $DatabaseParts = 2)
    {
        $ip = preg_replace('/[.]/', ':', $ip);
        $ip = ExpandIPv6Notation($ip);
        $Parts = explode(':', $ip);
        $ip = array('', '');
        for ($i = 0; $i < 8; $i++) $ip[$i] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT);
        if ($DatabaseParts == 2)
            return array(base_convert($ip[0], 2, 10), base_convert($ip[1], 2, 10), base_convert($ip[2], 2, 10), base_convert($ip[3], 2, 10), base_convert($ip[4], 2, 10), base_convert($ip[5], 2, 10), base_convert($ip[6], 2, 10), base_convert($ip[7], 2, 10));
        else    return base_convert($ip[0], 2, 10) + base_convert($ip[1], 2, 10) + base_convert($ip[2], 2, 10) + base_convert($ip[3], 2, 10) + base_convert($ip[4], 2, 10) + base_convert($ip[5], 2, 10) + base_convert($ip[6], 2, 10) + base_convert($ip[7], 2, 10);
    }

    /**
     * @param $ip
     * @return string
     */
    public static function longToIPv6($ip)
    {

        $IP1 = dechex($ip[0]);
        $IP2 = dechex($ip[1]);
        $IP3 = dechex($ip[2]);
        $IP4 = dechex($ip[3]);
        $IP5 = dechex($ip[4]);
        $IP6 = dechex($ip[5]);
        $IP7 = dechex($ip[6]);
        $IP8 = dechex($ip[7]);
        $ip = $IP1 . ':' . $IP2 . ':' . $IP3 . ':' . $IP4 . ':' . $IP5 . ':' . $IP6 . ':' . $IP7 . ':' . $IP8;
        return $ip;
    }

    /**
     * @return mixed
     */
    public static function getIp()
    {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && validip($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && validip($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR') && validip(getenv('HTTP_X_FORWARDED_FOR'))) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP') && validip(getenv('HTTP_CLIENT_IP'))) {
                $ip = getenv('HTTP_CLIENT_IP');
            } else {
                $ip = getenv('REMOTE_ADDR');
            }
        }

        return $ip;
    }
    /**
     * literally from the ABNF in rfc3986 (thanks to 'WCP')
     * @param $IP
     * @return mixed
     */
    public static function validateIPv6($IP)
    {
        return preg_match('/\A
(?:
(?:
(?:[a-f0-9]{1,4}:){6}
|
::(?:[a-f0-9]{1,4}:){5}
|
(?:[a-f0-9]{1,4})?::(?:[a-f0-9]{1,4}:){4}
|
(?:(?:[a-f0-9]{1,4}:){0,1}[a-f0-9]{1,4})?::(?:[a-f0-9]{1,4}:){3}
|
(?:(?:[a-f0-9]{1,4}:){0,2}[a-f0-9]{1,4})?::(?:[a-f0-9]{1,4}:){2}
|
(?:(?:[a-f0-9]{1,4}:){0,3}[a-f0-9]{1,4})?::[a-f0-9]{1,4}:
|
(?:(?:[a-f0-9]{1,4}:){0,4}[a-f0-9]{1,4})?::
)
(?:
[a-f0-9]{1,4}:[a-f0-9]{1,4}
|
(?:(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\.){3}
(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])
)
|
(?:
(?:(?:[a-f0-9]{1,4}:){0,5}[a-f0-9]{1,4})?::[a-f0-9]{1,4}
|
(?:(?:[a-f0-9]{1,4}:){0,6}[a-f0-9]{1,4})?::
)
)\Z/ix',
            $IP
        );
    }
}