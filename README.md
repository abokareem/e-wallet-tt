INSTALLATION
------------

**Init**
-
- clone project from repository `git clone https://github.com/faraabdullaev/e-wallet-tt.git`
- navigate into project `cd e-wallet-tt`
- navigate into common configs folder `cd config`
- update DB component in `db.php`

*to use docker copy:*
```$xslt
return [
   'class' => 'yii\db\Connection',
   'dsn' => 'mysql:host=mysql;dbname=e-wallet-tt',
   'username' => 'root',
   'password' => 'MY_PASSWORD',
   'charset' => 'utf8',
],
```

**Using Docker**
-

*Build:*
- navigate into `cd docker`
- open a DOCKER terminal 
- `sudo vi /etc/hosts`
- add or replace IP with your docker IP: `127.0.0.1	e-wallet.tt`
- in docker terminal, type: `docker-compose build`
- in docker terminal, type: `docker-compose up -d`

*Run:*
- browse into `cd docker`
- in docker terminal, type: `docker-compose up`
- open your browser and go to: `http://e-wallet.tt/`

**API Documentation**
-

*Documentation:*
https://documenter.getpostman.com/view/4397643/S17wPSWH

*Postman Collection:* 
https://www.getpostman.com/collections/80873b099699f76597d9

*JSON Example:*

```
[
  ["USD","1"  ],
  ["EUR","1.12"  ],
  ["GBP","1.3"  ],
  ["JPY","0.009"  ],
  ["CHF","1.004"  ],
  ["CAD","0.74"  ],
  ["AUD","0.71"  ],
  ["RUB","0.015"  ]
]
```

*CSV Example:*

```
USD;1
EUR;1,12
GBP;1,3
JPY;0,009
CHF;1,004
CAD;0,74
AUD;0,71
RUB;0,015
```