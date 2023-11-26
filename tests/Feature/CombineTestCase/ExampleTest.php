<?php

dataset('days_of_the_week', [
    'Saturday',
    'Sunday',
]);

test('business is closed on day', function(string $business, string $day) {
    expect(new $business)->isClosed($day)->toBeTrue();
})->with([
    Office::class,
    Bank::class,
    School::class
])->with('days_of_the_week');
