# laravelQL
Send query to your API

## Getting Started
LaravelQL let you send the exact query that you need to your API.\
It uses the most popular Laravel query methods.
### Example
```
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

### Methods
* result: String | Array, Default : get
```
{
// Get One result
    result: "first"
// Pluck result
    result: ["pluck]
}
```
* select: String | Array
* where: Object | Array
* orWhere: Array

