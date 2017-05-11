# ideaspace - Java project example
This project uses Spring Boot 1.3.5

# Database setup
  create database ideaspaces;
  mysql -u root -p < ideaspaces.sql

## Run the app
    gradle run

Navigate to [http://localhost:8080/user/healthcheck](http://localhost:8080/user/healthcheck), you should see the following in your browser:
    OK
