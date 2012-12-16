<?php


Route::post('mdparse', function()
{
    return MdParser\Markdown(Input::get('content'));
});
