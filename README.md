  
// composer install  
`
docker run --rm -it -v $PWD:/app composer install --ignore-platform-reqs
`  

// into php  
`
docker run --rm -it -v $PWD:/var/www -w /var/www/src php:7.2-fpm /bin/bash
`