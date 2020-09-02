# Distance calculator
#### This project is based on https://github.com/slimphp/Slim-Skeleton
- RESTful web service that calculates the sum of two distances expressed on meters or yards 

### Approach
- Find a framework that help to keep into account assignment advises (slim4)
- Fix local environment in order to have a container with xdebug on   
- Clean up slim from example code
- Define a distance domain 
- Implement methods to convert yards to meters and meters to yards 
- Implement method to sum it
- Add a Post endpoint to do the calculation

### Docker
#### Doker-compose start

```docker-compose up --abort-on-container-exit```
#### Doker-compose stop
```docker-compose down```

#### Doker-compose restart
``` docker-compose down && docker-compose build && docker-compose up --abort-on-container-exit```

#### Doker-compose exec php ash
#### run tests
``` docker-compose exec php ash ```
``` 08c9dee51c5c:/var/www# phpunit ```
#### expected results
``` PHPUnit 8.5.8 by Sebastian Bergmann and contributors.
   
   ......                                                              6 / 6 (100%)
   
   Time: 9.09 seconds, Memory: 6.00 MB 
```



### Local environment
- Basic url:
```http://localhost:8080/```
```Hello world!```
### Distance EndPoint
* url: ```http://localhost:8080/distance/```
* method: ```POST```
* body:
```{
     "sum": [
       {
         "type": "meters",
         "value": 1.11
       },
       {
         "type": "meters",
         "value": 1.33
       }
     ],
     "result": {
       "type": "yards"
     }
   }
```
### Improvements
- add unit test for all public methods
- improve exceptions and test it
- add action tests
- polish distance class storing only meters and using unit of measure as parameter
