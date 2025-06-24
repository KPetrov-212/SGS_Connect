# SGS_Connect – Контейнеризиран PHP + MySQL проект

## Как се стартира
docker-compose up --build

## Компоненти
web: използва php:8.2-apache + mysqli
db: MySQL 5.7, зарежда dump при старт

## Комуникации
Уеб сървърът се свързва с базата чрез db:3306
!!!! Ползва се mysqli, а не PDO !!!!

## Build
docker login
docker build -t ТВОЕТО_ПОТРЕБИТЕЛСКО_ИМЕ/sgs_web ./web
docker-compose up --build
http://localhost:8080/pages/login.php



hjdm yqrf exbm ikay 