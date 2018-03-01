<?php
/**
 * Created by PhpStorm.
 * User: englicky
 * Date: 28.02.2018
 * Time: 21:41
 */

namespace NextrasOrmTools;


class TableDefinition
{
    protected $name;

    protected $columns;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }


}
