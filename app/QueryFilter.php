<?php
/**
 * Created by PhpStorm.
 * User: pejuang
 * Date: 15/02/18
 * Time: 14:14
 */

namespace App;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)){
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}