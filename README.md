# Cartthrob Popularity Filter for Low Search

![](https://img.shields.io/badge/ExpressionEngine-5-3784B0.svg)

This filter gives Low Search the ability to order CartThrob products based off the amount previously sold (popularity).

## Install
Copy the 'cartthrob_sort' folder into `/system/user/addons/low_search/filters`.

## Use
Now that the filter is installed, you can make use of the 'ct_popularity' parameter within your Low Search Results tag as seen below.

```html
{exp:low_search:results collection="products" ct_popularity="desc"}
```

## Options
- ct_popularity="asc"
- ct_popularity="desc"
