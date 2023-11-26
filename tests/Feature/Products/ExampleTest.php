<?php

namespace Products;

it('has products', function (string $product) {
    expect($product)->not->toBeEmpty();
})->with('products');
