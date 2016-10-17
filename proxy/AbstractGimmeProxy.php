<?php
namespace proxy;

use proxy\Configurate;


abstract class AbstractGimmeProxy
{
    private $url = 'http://gimmeproxy.com/api/getProxy';


    /**
     * AbstractGimmeProxy constructor.
     * @param null $api_key
     * @param int $port
     * @param string $country
     * @param string $protocol
     * @param int $maxCheckPeriod
     */
    public function __construct($api_key = null, $port = 8080, $country = 'RU', $protocol = Configurate::HTTP, $maxCheckPeriod = 3600)
    {

        foreach (new Configurate($api_key, $port, $country, $protocol, $maxCheckPeriod) as $key => $value) {
            if (is_null($value)) continue;

            $value = $this->boolToString($value);

            if ($key == 'user_agent') {
                $key = 'user-agent';
            }

            $temp[] = sprintf("%s=%s", $key, $value);
        }


        $this->query = implode('&', $temp);
    }


    /**
     * @param int $count
     * @param string $type
     * @return array|object|string
     */
    public function get($count = 1, $type = 'json')
    {
        /**
         * FIXME: for use curl
         */
        $url = $this->url . '?' . $this->query;
        $temp = [];

        for ($i = 0; $i < $count; $i++) {
            $response = trim(file_get_contents($url));
            $temp[$i] = json_decode($response, true);

            if (isset($temp[$i]['error'])) {

                // write to error log
                $this->log($temp[$i]['error']);

                unset($temp[$i]);

                break;
            }
        }

        switch (strtolower($type)) {
            case 'object':
                return (object)$temp;
                break;

            case 'array':
                return (array)$temp;
                break;

            case 'json':
                return json_encode($temp);
                break;
        }
    }


    /**
     * @param $value
     * @return string
     */
    private function boolToString($value)
    {
        if (is_bool($value)) {
            return ($value) ? "true" : "false";
        }

        return $value;
    }

    /**
     * @param $message
     * @return void
     */
    abstract function log($message);
}

	
