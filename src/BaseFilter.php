<?php

namespace AidynMakhataev\LaravelFilterable;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


abstract class BaseFilter
{
    /**
     * Eloquent Builder.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * Http Request.
     *
     * @var Request
     */
    protected $request;


    /**
     * BaseFilter Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return Builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * Get all filters from request.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }
    
}