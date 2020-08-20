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