<?php

beforeEach(function () {
    // Thực hiện code ở đây trước mỗi test run
    $this->char = 'tan_thu';
});

it('kiem tra tan thu', function () {
    expect($this->char)
        ->toBeString()
        ->not->toBeEmpty();
});
