<?php

test('the application redirects the root url to posts', function () {
    $this->get('/')
        ->assertRedirect('/posts');
});
