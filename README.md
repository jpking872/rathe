# rathe

Project is running on bootstrap 4.0. 

JS and CSS files are included from cloudflare and Google CDN.

Login and registration are found here ./public/{login.php}, {signup.php}

./public/index.php verifies user's email and account. 

Authenticated users are redirected to ./public/dashboard/

First time users are required to complete account setup located ./public/dashboard/start.php

Users can add new titles here ./public/dashboard/new_title.php

Titles are modified here ./public/dashboard/view_titles

Forms are single page multi-steps hence the bool(true : false)

