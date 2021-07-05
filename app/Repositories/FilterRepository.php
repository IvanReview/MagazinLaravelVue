<?php


namespace App\Repositories;


class FilterRepository
{
    protected $builder;
    protected $request;

    public function __construct($builder, $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }


    /**
     * пробегаем по всем фильтрам и смотрим есть ли такой метод в данном объекте, если есть вызываем метод и передаем значение
     *
     * @return mixed
     */
    public function apply()
    {
        foreach ($this->filters() as $filter_name => $value){
            if (method_exists($this, $filter_name) && $value !== null){
                $this->$filter_name($value);
            }
        }
        return $this->builder;
    }

    

    //получить все параметры фильтров из реквеста
    public function filters()
    {
        return $this->request->all();
    }

    //---ФИЛЬТРЫ---

    //фильтр по низу цены
    public function price_from($price_from)
    {
        $this->builder->where('price','>=', $price_from);
    }


    //фильтр по верху цены
    public function price_to($price_to)
    {
        $this->builder->where('price','<=', $price_to);
    }


    //сортировка по категориям
    public function category_id($categoryId)
    {
        $this->builder->where('category_id', $categoryId);
    }

    //сортировка по имени и воз/убыв цены
    public function sort_param($sortParam)
    {
        switch ($sortParam) {
            case 0:
                $this->builder->orderBy('created_at', 'DESC');
                break;
            case 1:
                $this->builder->orderBy('name', 'ASC');
                break;
            case 2:
                $this->builder->orderBy('name', 'DESC');
                break;
            case 3:
                $this->builder->orderBy('price', 'ASC');
                break;
            case 4:
                $this->builder->orderBy('price', 'DESC');
                break;
        }

    }

    //поиск по имени
    public function search_pattern($searchPattern)
    {
        $this->builder->where('name', 'like', "%$searchPattern%");
    }





}
