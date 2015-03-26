<?php

/**
 * Project name: MVC
 * @/webist/mvc
 * @name Response.php
 * @author Webist
 * Created at : Feb 8, 2015 5:39:17 PM
 * UTF-8
 *
 * Use Response from Symfony.They are lean services and solved most known problems.g
 */
//@todo call response like this: return new Response($content, $status)->header('Content-Type', $value);
class Response
{

    /**
     * Constructor.
     *
     * @param string $data
     * @param string $format
     */
    public static function create($data, $format)
    {
        switch ($format) {
            case 'application/json':
            default:
                $obj = new ResponseJson($data);
                break;
        }
        return $obj;
    }

}

class ResponseJson
{
    /**
     * Response data.
     *
     * @var string
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param string $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Render the response as JSON.
     *
     * @return string
     */
    public function render()
    {
        header('Content-Type: application/json');
        return json_encode($this->data);
    }

}