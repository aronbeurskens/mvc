MVC
===
A PHP low memory basic MVC with promise to never exceed 1 MB memory usage, including with PHP memory usage (256 kb).
The idea is avoiding data carry by using techniques like late static binding, callbacks, querying. 
And of course no pre-defined of globals (except DOCROOT), no constants, no recursions, no reserved magic words.
Classes do also avoid constants and unnecessary class-global variables (which would live in memory).
Almost all memory usage is caused by requiring and creating new objects only.

Front-end development is a completely separated project. Front-end files do not receive bunch of data. 
Instead they have access to the $model object to query it.

For example 
`$model->query("title", "page");`  
`$tree = $model->query("header", "navigation");`  
Here is a sample page.
https://github.com/Webist/frontend/blob/master/public_html/metronic_v3.7/theme/templates/frontend/head.php

Load your huge html or html including php file and enable $test->results() under /public/index.php. 
It should not exceed 800 kb. 

Check the controllers to see how a model is created.

Enjoy

