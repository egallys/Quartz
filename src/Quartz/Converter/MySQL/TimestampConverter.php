<?php

namespace Quartz\Converter\MySQL;

/**
 * Description of TimestampConverter
 *
 * @author paul
 */
class TimestampConverter implements \Quartz\Converter\ConverterInterface
{

    public function fromDb($data, $type = null)
    {
        if ($data === 'NULL' || $data === 'null' || $data === null || $data === '')
        {
            return null;
        }
        if( !is_null($type) )
        {
            return new \DateTime(preg_replace('#^\'(.*?)\'$#', '$1', $data));
        }
        return new \DateTime($data);
    }

    public function toDb($data, $type = null)
    {
        if( is_null($data) )
        {
            return 'NULL';
        }
        if (!$data instanceof \DateTime)
        {
            if(is_numeric($data))
            {
                $data = new \DateTime('@' . $data);
            }
            else
            {
                $data = new \DateTime($data);
            }
        }

        return sprintf("'%s'", $data->format('Y-m-d H:i:s'));
    }

    public function translate($type)
    {
        return "DATETIME";
    }

}

?>
