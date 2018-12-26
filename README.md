# laravelQL
Send query to your API

## Getting Started
LaravelQL let you send the exact query that you need to your API.\
It uses the most popular Laravel query methods.
### Example
```js
axios.get("products",{
    params: {
        select: ["name","slug"],
        where:{
            price: 1000
        },
        with: "translations",
        ...
    }
})
```
### Installation
```
composer install Shpontex\LaravelQL
```

### Parameters
* result: String | Array\
 Default : get\
 values: (count, max, min, avg, sum) https://laravel.com/docs/5.7/queries#aggregates\
 methods: (get, first, pluck)
```js
{
    // Get One result
    result: "first"

    // Pluck result
    result: ["pluck",["name","slug"]]

    // Get count
    result: "count"

    // Get max
    result: ["max","price"]
}
```
* select: String | Array, https://laravel.com/docs/5.7/queries#selects\
values: ["Column_name"]
```js
{
    select: "name",
    select: ["name","slug"]
}
```
* where clauses: Object | Array, https://laravel.com/docs/5.7/queries#where-clauses
```js
{
    where:{
        item_id: 30
    }

    where:[
        ["item_id", 30],
        ["price",">=",1500]
    ],

    orWhere:["item_id",20],

    whereNull: "created_at",

    whereNotNull: "price",

    whereColumn:["created_at","updated_at"],

    whereBetween:["price",[2000,2500]],

    whereNotBetween:["price",[1000,1500]],

    whereIn:["id",[1,4,5]]
}
```
* orWhere: Array

