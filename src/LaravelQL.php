<?php

namespace Shpontex\LaravelQL;

class laravelQL
{
    private $query;

    private function hasArguments($type, $transform = false)
    {
        $args = request($type);
        if ($transform) {
            $args = $this->transformToarray($args);
        }
        if ($args) {
            call_user_func_array([$this->query, $type], $args);
        }
    }

    private function transformToarray($value)
    {
        if (gettype($value) == 'string') {
            return [$value];
        }
        if (gettype($value) == 'array') {
            return $value;
        }
        return [];
    }

    private function getResult($result)
    {
        if (gettype($result) == 'array') {
            return $result[0];
        }
        return $result;
    }

    private function getArgs($result)
    {
        if (gettype($result) == 'array') {
            if (gettype($result[1]) == 'array') {
                return $result[1];
            }
            return [$result[1]];
        } else {
            return [];
        }
    }

    public function parse($query)
    {
        $this->query = $query;
        $select = request()->select;
        $orderBy = request()->orderBy;
        $orderByDesc = request()->orderByDesc;
        $result = request()->result ?? 'get';
        $latest = request()->latest;
        $oldest = request()->oldest;
        $inRandomOrder = request()->inRandomOrder;
        $skip = request()->skip;
        $take = request()->take;
        $limit = request()->limit;
        $offset = request()->offset;
        $has = request()->has;
        $doesntHave = request()->doesntHave;
        $withCount = request()->withCount;
        $with = request()->with;
        $where = request()->where;
        $orWhere = request()->orWhere;
        $whereNull = request()->whereNull;
        $whereNotNull = request()->whereNotNull;
        $whereColumn = request()->whereColumn;

        try {
            if ($where) {
                $query->where($where);
            }
            if ($orWhere) {
                // no multiple arrays
                $query->orWhere($orWhere);
            }
            if ($whereNull) {
                $query->whereNull($whereNull);
            }
            if ($whereNotNull) {
                $query->whereNotNull($whereNotNull);
            }
            if ($whereColumn) {
                $query->whereColumn($whereColumn);
            }
            $this->hasArguments('whereNotBetween');
            $this->hasArguments('whereBetween');
            $this->hasArguments('whereIn');
            $this->hasArguments('whereNotIn');
            $this->hasArguments('whereDate');
            $this->hasArguments('whereDay');
            $this->hasArguments('whereMonth');
            $this->hasArguments('whereYear');
            $this->hasArguments('whereTime');

            if ($select) {
                call_user_func_array([$query, 'select'], $this->transformToarray($select));
            }
            if ($orderBy) {
                $query->orderBy($orderBy);
            }
            if ($orderByDesc) {
                $query->orderBy($orderByDesc, 'desc');
            }
            if ($latest) {
                call_user_func_array([$query, 'latest'], $this->transformToarray($latest));
            }
            if ($oldest) {
                call_user_func_array([$query, 'oldest'], $this->transformToarray($oldest));
            }
            if ($inRandomOrder) {
                $query->inRandomOrder();
            }
            if ($skip) {
                $query->skip($skip);
            }
            if ($take) {
                $query->take($take);
            }
            if ($limit) {
                $query->limit($limit);
            }
            if ($offset) {
                $query->offset($offset);
            }
            if ($has) {
                $this->hasArguments('has', true);
            }
            if ($doesntHave) {
                $query->doesntHave($doesntHave);
            }
            //If you're combining withCount with a select statement, ensure that you call withCount after the select method:
            if ($withCount) {
                $query->withCount($withCount);
            }
            if ($with) {
                $query->with($with);
            }
            //If you're combining Pluck with a select statement, it will be error
            return call_user_func_array([$query, $this->getResult($result)], $this->getArgs($result));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
