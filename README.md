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
# 20250924 현재 12버전 설치됨
# composer create-project laravel/laravel fv-test;
# composer create-project laravel/laravel=12.31.1 fv-test --prefer-dist;


# DB에서 유저, 데이터베이스 세팅
# 쉘에서 실행
mysql -e "create database fvtest;";
mysql -e "create user fvtest@'127.0.0.1' identified by 'fastviewtest1!'";
mysql -e "grant all privileges on fvtest.* to fvtest@'127.0.0.1'";
mysql -e "flush privileges";



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
npm install
php artisan migrate;
php artisan db:seed;
# 완전 초기화 + 시더 실행
# php artisan migrate:fresh --seed
npm run build;
```

```bash

# 업데이트 배포
git pull;
composer install;
npm install
php artisan migrate;
# 필요시
# php artisan db:seed;
npm run build;

```


### 개발 서버 웹페이지 정보

**개발 서버 URL:** [http://fv-test.kpearl.net:8080/](http://fv-test.kpearl.net:8080/)

---

## 테스트 계정

| 이름 / 용도 | 이메일 | 비밀번호 |
|-------------|--------|----------|
| 테스트 계정   | test@example.com | 1234qwer! |
| 테스트 유저 | testUser1@example.com | 1234qwer! |