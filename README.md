## RDM Docker 

Docker container running RDM (Rapor Digital Madrasah) 


## Prerequistes

* MySQL (mysql_old_password MUST be enabled for MySQL 8+)


## Enviroment Variables

Configuration is done via the following Environment Variables. 

``DB_SERVER`` : MySQL server address (and port if not 3306) 

``DB_USERNAME``: MySQL username

``DB_PASSWORD``: MySQL password

``DB_DATABASE``: MySQL Database Name

## How to use

``` docker run --name rdm --rm -p 8000:80 -e DB_SERVER="host.docker.internal:3336" -e DB_USERNAME=root -e DB_PASSWORD=pwd -e DB_DATABASE=rdm  geschool/rdm ```

Open Browser to http://localhost:8000 to view

**Note:**

Remove `/var/www/html/config.php` if database is not yet created 

``docker exec -t rdm rm /var/www/html/config.php``



### Sample docker-compose
```version: '3.1'

services:

  rdm:
    image: geschool/rm
    restart: always
    environment:
      DB_SERVER: host:docker:internal:3336
      DB_USERNAME: root 
      DB_PASSWORD: pwd 
      DB_DATABASE: rdm  
```      
      
   
### Sample k8s yaml
```
apiVersion: apps/v1
kind: Deployment
metadata:
  name: web
  labels:
    tier: web
spec:
  replicas: 1
  selector:
    matchLabels:
      app: web
      tier: web
  template:
    metadata:
      labels:
        app: web
        tier: web
    spec:
      containers:
      - name: rdm
        image: geschool/rdm
        env:
        - name: DB_SERVER
          value: "host.docker.internal:3336"
        - name: DB_USER
          value: "user"
        - name: DB_PWD
          value: "pwd"
        - name: DB_DATABASE
          value: "rdm"
        resources:
          requests:
            cpu: "10m"

```


# How to build

```
docker build . -t geschool/rdm

```


## Push to docker hub

```

docker push geschool/rdm

```
