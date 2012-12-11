<?php

namespace Blog;

\Autoloader::namespaces(array(
    'Blog\\Models' => \Bundle::path('blog') . 'models'
));


\Validator::register('date', function($attribute, $value, $parameters)
{
    $regex = '/^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$/';
    return preg_match($regex, $value);
});


\Validator::register('time', function($attribute, $value, $parameters)
{
    $regex = '/^(20|21|22|23|[01]\d|\d)(([:.][0-5]\d){1,2})$/';
    return preg_match($regex, $value);
});
