<?php

$sorting = $_GET["sort"];
switch ($sorting) {
  case 'price-asc':
    $sorting = 'price ASC';
    $sort_name = 'Сначала дешевле';
    break;

  case 'price-desc':
    $sorting = 'price DESC';
    $sort_name = 'Сначала дороже';
    break;

  case 'popular':
    $sorting = 'count DESC';
    $sort_name = 'Популярные';
    break;

  case 'availability':
    $sorting = 'availability DESC';
    $sort_name = 'По наличию';
    break;

  case 'new':
    $sorting = 'datetime DESC';
    $sort_name = 'По новизне';
    break;

  case 'from-a-to-z':
    $sorting = 'brand.brand ASC';
    $sort_name = 'От А до Я';
    break;

  case 'from-z-to-a':
    $sorting = 'brand.brand DESC';
    $sort_name = 'От Я до А';
    break;

  case 'without-sorting':
    $sorting = 'products_id DESC';
    $sort_name = 'Без сортировки';
    break;

  default:
    $sorting = 'products_id DESC';
    $sort_name = 'Без сортировки';
    break;
}
