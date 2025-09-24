## 패스트뷰 라라벨 사전과제


### 환경
Ubuntu 20.04.6 LTS  
nginx version: nginx/1.18.0 (Ubuntu)  
mysql  Ver 15.1 Distrib 10.3.39-MariaDB  
php 8.3.19  
Laravel Framework 12.31.1. 

### 세팅
```bash
# 프로젝트 폴더 생성
# composer create-project laravel/laravel fv-test;


# DB에서 유저, 데이터베이스 세팅
create user fvtest@'127.0.0.1' identified by 'fastviewtest1!';
grant all privileges on fvtest.* to fvtest@'127.0.0.1';
flush privileges;


# 폴더 권한 설정
# chwon -R $webUser $projectDir/storage
chown -R www-data storage;
chown -R www-data bootstrap/cache;
```


### 배포
```bash

# 초기 배포시
git clone https://github.com/honghongk/fv-test;
cd fv-test;
chown -R www-data storage;
chown -R www-data bootstrap/cache;
rm composer.lock;
composer install;
php artisan migrate;
php artisan db:seed;
npm run build;

# 업데이트 배포
git pull;
composer install;
php artisan migrate;
# 필요시
# php artisan db:seed;
npm run build;

```