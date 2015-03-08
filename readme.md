
=========
MVC in PHP that will never exceed 1 MB memory usage, including PHP memory usage (256 kb).
The idea is avoiding data carry by using techniques like late binding, callbacks and querying. 
And of course no globals (except DOCROOT), no constants, no recursions, no reserved magic words usage.
Classes do also avoid constants and unnecessary class-global variables (which should live in memory).
Almost all memory usage is caused by requiring and creating new objects.

Front-end development is a completely separated project. Front-end files do not receive bunch of data. 
Instead they have access to the $model object to query.
Like 
$model->query("page", "title");
$tree = $model->query("navigation", "header");
Here is a sample page.
https://github.com/Webist/frontend/blob/master/public_html/metronic_v3.6.2/theme/templates/frontend/head.php

Enjoy

