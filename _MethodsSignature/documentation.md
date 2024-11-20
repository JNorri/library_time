# Method signatures
### Department:
#### *Add*:
```
/api/department/add
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "department_name": "your_department_name",
    "department_description": "your_department_description",
    "parent_id": "your_parent_id"
}
```
> Out:
```json
{
    "message": "The department was successfully added."
}
```
#### *Delete*:
```
/api/department/delete/{your_department_id}
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here
```
> Out:
```json
{
    "message": "The department was successfully deleted."
}
```
#### *Update*:
```
/api/department/update
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "department_id":"your_department_id",
    "department_name":"your_department_name",
    "department_description":"your_department_description",
    "parent_id":"your_parent_id",
}
```
> Out:
```json
{
    "message": "The department has been successfully updated."
}
```
#### *Get all objects*:
```
/api/department/all
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    
}
```
> Out:
```json
{
    
}

```

#### *Get object by id*:
```
/api/department/{your_department_id}
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

```
> Out:
```
{
    
}
```


### Employee:
#### *Add*:
```
/api/employee/add
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "first_name": "your_first_name",
    "middle_name": "your_middle_name",
    "last_name": "your_last_name",
    "date_of_birth": "your_date_of_birth",  # example: 1999-01-01
    "email": "your_email",                  # example: example@example.ru
    "phone": "your_phone_number",           # example: 79995556644
    "password": "your_password"
}
```
> Out:
```json
{
    "message": "
}

```
#### *Delete*:
```
/api/employee/delete/{your_object_id}
```
> In: 
```

```
> Out:
```

```
#### *Update*:
```
/api/employee/update
```
> In: 
```

```
> Out:
```

```
#### *Get*:
```
/api/employee/all
```
> In: 
```

```
> Out:
```

```

```
/api/employee/{идентификатор объекта}
```
> In: 
```

```
> Out:
```

```

### Measurement:
#### *Add*:
```
/api/measurement/add
```
> In: 
```

```
> Out:
```

```
#### *Delete*:
```
/api/measurement/delete/{идентификатор объекта}
```
> In: 
```

```
> Out:
```

```
#### *Update*:
```
/api/measurement/update
```
> In: 
```

```
> Out:
```

```
#### *Get*:
```
/api/measurement/all
```
> In: 
```

```
> Out:
```

```

```
/api/measurement/{идентификатор объекта}
```
> In: 
```

```
> Out:
```

```

### Process:
#### *Add*:
```
/api/process/add
```
> In: 
```

```
> Out:
```

```
#### *Delete*:
```
/api/process/delete/{идентификатор объекта}
```
> In: 
```

```
> Out:
```

```
#### *Update*:
```
/api/process/update
```
> In: 
```

```
> Out:
```

```
#### *Get*:
```
/api/process/all
```
> In: 
```

```
> Out:
```

```

```
/api/process/{идентификатор объекта}
```
> In: 
```

```
> Out:
```

```
