<?php

beforeAll(function () {
    // Thuc hien chay truoc tat ca cac test run va chi chay 1 lan duy nhat
    // Set up 1 cai gi do 1 lan duy nhat
});

beforeEach(function () {
    // Thực hiện code ở đây trước mỗi test run
    $this->char = [
        'class' => 'tan_thu',
        'level' => 1
    ];
});

it('kiem tra tan thu', function () {
    expect($this->char['class'])
        ->toBeString()
        ->not->toBeEmpty()
        ->toBe('tan_thu');
});

it('kiem tra level', function () {
    expect($this->char['level'])->toBe(1);
});

afterEach(function () {
    // Thuong duoc su dung de xoa toan bo du lieu sau khi da chạy all test run
    unset($this->char);
});
