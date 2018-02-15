<?php
/**
 * Created by PhpStorm.
 * User: pejuang
 * Date: 15/02/18
 * Time: 14:04
 */

namespace App;


class LessonFilters extends QueryFilter
{
    public function popular($order = 'desc')
    {
        return $this->builder->orderBy('views', $order);
    }

    public function difficulty($level)
    {
        return $this->builder->where('difficulty', $level);
    }

    public function length($order = 'asc')
    {
        return $this->builder->orderBy('length', $order);
    }

    public function take($count)
    {
        return $this->builder->limit($count);
    }
}