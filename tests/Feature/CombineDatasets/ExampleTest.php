<?php

dataset('days_of_the_week', [
    'Saturday',
    'Sunday',
]);

test('business is closed on day', function(string $business, string $day) {
//    expect($business)->isClosed($day)->toBeTrue();
    expect($business)->not->toBeEmpty();
})->with([
    'office',
    'bank',
    'school'
])->with('days_of_the_week');
