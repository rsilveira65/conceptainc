# conceptainc

![](https://i.imgur.com/VxQQJJt.png)


## PHP and React Developer Test
You will need to create a WordPress plugin. Using a shortcode, this plugin will render a React app, also created by you (you can use
https://github.com/facebook/create-react-app to create the app). The React App needs to do an ajax call to your plugin (You should create an
endpoint in your plugin) that will call another API (Service API) (described below) then render a list with the follow items (code, destination, name
and all photos with type “s”). Feel free to list it the way you want. We expect you to also pay attention to the layout.

Purpose of Code Test
- Code Organization
- Best Practices / Standards
- Problem Solving
- Familiarity with REST APIs and the respective programming language.

Delivery
• API - Public your code so we can see it online.
• Code - Zip all project files and send to leo@conceptsol.com
To get the data you need to show, make POST to [http://travellogix.api.test.conceptsol.com/api/Ticket/Search](http://travellogix.api.test.conceptsol.com/api/Ticket/Search) using the payload below:
```json
{
    "Language": "ENG",
    "Currency": "USD",
    "destination": "MCO",
    "DateFrom": "11/26/2016",
    "DateTO": "11/29/2016",
    "Occupancy": {
    "AdultCount": "1",
    "ChildCount": "1",
    "ChildAges": ["10"]
  }
}
```

Don't forget to add the application/json as the Content-Type in the request headers.
Another required parameter in the request header is an Authorization token. The Service API is protected by login, so before the first call you
will need to ensure that you are authorized to that.
The token is valid for 24 hours after created
```
Request Header Example:
Content-Type: application/json
Authorization: Bearer
xf5XWHv01N5CDRFBCzC9bUc5fb-a4-wiTxQHzjhJyMi4jt5ZzqbXZw0TCOIVjT59yReLdV-BXm
WlnvAvjd_ny_brH2PA6E7BF6fHeAj0PMkALN8ncEbgbZB3Vw5NssaM0nnlacjZuPTh2Wdn_8IE
sPeYTQx1_8pTU_vw3pUOtLedJY87BifhWa_2A3zLYOt3uboDVTN-peO5yAF_x5uRFyJbUZN_c2
Hosk7Qmfn7NSCN47Gbb4FacTodIlmpmjYjjI98rpQeaSM8b5_foJrjAFmiob-P-V1cJij2AG1T
7FsTzz4FbXGuoSbrdq2LqOft9W25A7IjVZBKqz-UBL_Fltnlc1f_fiMvOfszNLWbO87PYaqW7o
va8fdj2p5KyHDo2jB6F2trLPLBalKKN-5OuMHUp_v-lPXk6b64F3vMwINDgpzSQa-80_wln_1b
lE2MChwb3nbSfA2_9dR1XKDFtehWLWP03lxwGIiM2vS_MuU

```

To get this Authorization token, make a POST request to: http://travellogix.api.test.conceptsol.com/Token passing this RAW data (no headers
needed):

grant_type=password&username=test1%40test2.com&password=Aa234567%21
Notice the token_type in response, this will be joined with the access_token to form the Authorization parameters in the header of the next
requests. (edited)

```json
{
    "access_token":
    "xf5XWHv01N5CDRFBCzC9bUc5fb-a4-wiTxQHzjhJyMi4jt5ZzqbXZw0TCOIVjT59yReLdV-BX
    mWlnvAvjd_ny_brH2PA6E7BF6fHeAj0PMkALN8ncEbgbZB3Vw5NssaM0nnlacjZuPTh2Wdn_8I
    EsPeYTQx1_8pTU_vw3pUOtLedJY87BifhWa_2A3zLYOt3uboDVTN-peO5yAF_x5uRFyJbUZN_c
    2Hosk7Qmfn7NSCN47Gbb4FacTodIlmpmjYjjI98rpQeaSM8b5_foJrjAFmiob-P-V1cJij2AG1
    T7FsTzz4FbXGuoSbrdq2LqOft9W25A7IjVZBKqz-UBL_Fltnlc1f_fiMvOfszNLWbO87PYaqW7
    ova8fdj2p5KyHDo2jB6F2trLPLBalKKN-5OuMHUp_v-lPXk6b64F3vMwINDgpzSQa-80_wln_1
    blE2MChwb3nbSfA2_9dR1XKDFtehWLWP03lxwGIiM2vS_MuU",
    "token_type": "bearer",
    "expires_in": 86399,
    "userName": "test@test.com",
    ".issued": "Mon, 02 Feb 2015 23:19:05 GMT",
    ".expires": "Tue, 03 Feb 2015 23:19:05 GMT"
}

```


## 1. Project Setup

### 1.1 Make sure you have Docker installed
https://docs.docker.com/engine/installation/linux/

### 1.2 Create .env file
```bash
$ cp .env_dist .env
```

### 1.3 Run the following command
```bash
$ docker-compose up -d
```

### 1.4 Setup database
```bash
$ docker exec -it conceptainc-database bash
$ mysql -uconceptainc -pconceptainc conceptainc < dumps/conceptainc.sql

```

### 1.5 Open your browser on
http://localhost


# 2. React build and copy files

```bash
$ make copy-bundle
```

[Download the POSTMAN Collection](https://www.getpostman.com/collections/b3dfa014d86371640238)


