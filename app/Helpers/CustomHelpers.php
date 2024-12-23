<?php


use Illuminate\Support\Facades\Cache;

if (!function_exists('discountPercentage')) {
    function discountPercentage($price, $discount)
    {
        $discountAmount = $price - $discount;
        return round(($discountAmount / $price) * 100);
    }

}

if(!function_exists('formatCurrency'))
{
    function formatCurrency($amount)
    {
        $config = Cache::get('config_data');

        // Use the currency symbol from the config if available, otherwise default to '$'
        $currencySymbol = isset($config['currency_symbol']) ? $config['currency_symbol'] : '$';

        return $currencySymbol . round($amount);
    }
}
if(!function_exists('truncate'))
{
    function truncate($string, $length, $dots = "...") {
        return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
    }
}

if(!function_exists('hexToRgb'))
{
     function hexToRgb($hex)
    {
   // Remove '#' if present
   $hex = str_replace('#', '', $hex);

   // Convert hexadecimal to RGB
   $r = hexdec(substr($hex, 0, 2));
   $g = hexdec(substr($hex, 2, 2));
   $b = hexdec(substr($hex, 4, 2));

   // Return RGB string
   return "$r $g $b";
    }
}



if (!function_exists('settingHelper')) {
    /**
     * Retrieve a setting value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function settingHelper($key, $default = null)
    {
        // Fetch the setting from the database, cache, or config.
        return \App\Models\Setting::getValue($key, $default);
    }
}
