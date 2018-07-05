<?php

namespace AidynMakhataev\LaravelFilterable;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Scope for applying filters.
     *
     * @param Builder $query
     * @return Builder
     * @throws \Exception
     */
    public function scopeFilter(Builder $query)
    {
        if (! class_exists($this->filters)) {
            throw new \Exception('Filter Class '.$this->filters.' does not exist.');
        }

        return app()->make($this->filters)->apply($query);
    }
}