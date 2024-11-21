# Method signatures
### Department:
#### *Create*:
```
/api/department/create
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "department_name":          "your_department_name",
    "department_description":   "your_department_description",
    "parent_id":                "your_parent_id"
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
    "department_id":            "your_department_id",
    "department_name":          "your_department_name",
    "department_description":   "your_department_description",
    "parent_id":                "your_parent_id",
}
```
> Out:
```json
{
    "message": "The department has been successfully updated."
}
```
#### *Get all departments*:
```
/api/department/all
```
> In: 
```json
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    
}
```
> Out:
```json
{
    "data": [
            {
                "department_id":          "your_department_id",
                "department_name":        "your_department_name",
                "department_description": "your_department_description",
                "parent_id":              "your_parent_id"
            },
    ]
}

```

#### *Get department by id*:
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
```json
{
    "data": {
                "department_id":            "your_department_id",
                "department_name":          "your_department_name",
                "department_description":   "your_department_description",
                "parent_id":                "your_parent_id"
    }
}
```


### Employee:
#### *Create*:
```
/api/employee/create
```
> In: 
```json
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "first_name":       "your_first_name",
    "middle_name":      "your_middle_name",
    "last_name":        "your_last_name",
    "date_of_birth":    "your_date_of_birth",  
    "email":            "your_email",                  
    "phone":            "your_phone_number",           
    "password":         "your_password"
}
```
> Out:
```json
{
    "message": "The employee was successfully added."
}

```
#### *Delete*:
```
/api/employee/delete/{your_employee_id}
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
    "message": "The employee was successfully deleted."
}
```
#### *Update*:
```
/api/employee/update
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "employee_id":          "your_employee_id",
    "last_name":            "your_last_name",
    "first_name":           "your_first_name",
    "middle_name":          "your_middle_name",
    "date_of_birth":        "your_date_of_birth",
    "email":                "your_email",
    "phone":                "your_phone",
}
```
> Out:
```json
{
    "message": "The employee was successfully updated."
}
```
#### *Get all employees*:
```
/api/employee/all
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
    "data": [
            {
                "employee_id":          "your_employee_id",
                "last_name":            "your_last_name",
                "first_name":           "your_first_name",
                "middle_name":          "your_middle_name",
                "date_of_birth":        "your_date_of_birth",
                "email":                "your_email",
                "phone":                "your_phone",
                "email_verified_at":    "your_email_verified_at",
                "created_at":           "your_created_at",
                "updated_at":           "your_updated_at"
            },  
                # Other employees here..
    ]
}
```
#### *Get employee by id*:
```
/api/employee/{your_employee_id}
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
    "data": {
                "employee_id":          "your_employee_id",
                "last_name":            "your_last_name",
                "first_name":           "your_first_name",
                "middle_name":          "your_middle_name",
                "date_of_birth":        "your_date_of_birth",
                "email":                "your_email",
                "phone":                "your_phone",
                "email_verified_at":    "your_email_verified_at",
                "created_at":           "your_created_at",
                "updated_at":           "your_updated_at"
  }
}
```

### Measurement:
#### *Create*:
```
/api/measurement/create
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "measurement_name":         "your_measurement_name",
    "measurement_description":  "your_measurement_description"
}
```
> Out:
```json
{
    "message": "The measurement was successfully added."
}
```
#### *Delete*:
```
/api/measurement/delete/{your_measurement_id}
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{

}
```
> Out:
```json
{
    "message": "The measurement was successfully deleted."
}
```
#### *Update*:
```
/api/measurement/update
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "measurement_id":           "your_measurement_id",
    "measurement_name":         "your_measurement_name",
    "measurement_description":  "your_measurement_description"
}
```
> Out:
```json
{
    "message": "The measurement was successfully updated."
}
```
#### *Get all measurements*:
```
/api/measurement/all
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{

}
```
> Out:
```json
{
   "data": [
            {
                "measurement_id":           "your_measurement_id",
                "measurement_name":         "your_measurement_name",
                "measurement_description":  "your_measurement_description"
            },
            # Other measurements here...
   ]
}
```
#### *Get measurement by id*:
```
/api/measurement/{your_measurement_id}
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
    "data": {
                "measurement_id":           "your_measurement_id",
                "measurement_name":         "your_measurement_name",
                "measurement_description":  "your_measurement_id"
    }
}
```

### Process:
#### *Create*:
```
/api/process/create
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "process_name":         "your_process_name",
    "measurement_id":       "your_measurement_id",
    "is_daily":             "your_is_daily",
    "require_description":  "your_require_description",
    "department_id":        "your_department_id",
    "process_duration":     "your_process_duration"
}
```
> Out:
```json
{
    "message": "The process was successfully added."
}
```
#### *Delete*:
```
/api/process/delete/{your_process_id}
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
    "message": "The process was successfully deleted."
}
```
#### *Update*:
```
/api/process/update
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "process_id":           "your_process_id",
    "process_name":         "your_process_name",
    "measurement_id":       "your_measurement_id",
    "is_daily":             "your_is_daily",
    "require_description":  "your_require_description",
    "department_id":        "your_department_id",
    "process_duration":     "your_process_duration"
}
```
> Out:
```json
{
    "message": "The process was successfully updated."
}
```
#### *Get all processes*:
```
/api/process/all
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{

}

```
> Out:
```json
{
    "data": [
        {
          "process_id": "your_process_id",
          "process_name": "your_process_name",
          "measurement_id": {
                                "measurement_id": "your_measurement_id",
                                "measurement_name": "your_measurement_name",
                                "measurement_description":  "your_measurement_description"
                            },
          "is_daily": "your_is_daily",
          "require_description": "your_require_description", 
          "department_id": {
                                "department_id": "your_department_id",
                                "department_name": "your_department_name",
                                "department_description":   "your_department_description",
                                "parent_id": "your_parent_id"
                            },
          "process_duration": "your_process_duration",   
        },
          # Other processes here...
    ]
}
```
#### *Get process by id*:

```
/api/process/{your_process_id}
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
    "data": {
          "process_id": "your_process_id",
          "process_name": "your_process_name",
          "measurement_id": {
                                "measurement_id": "your_measurement_id",
                                "measurement_name": "your_measurement_name",
                                "measurement_description":  "your_measurement_description"
                            },
          "is_daily": "your_is_daily",
          "require_description": "your_require_description", 
          "department_id": {
                                "department_id": "your_department_id",
                                "department_name": "your_department_name",
                                "department_description":   "your_department_description",
                                "parent_id": "your_parent_id"
                            },
          "process_duration": "your_process_duration",   
    }  
}
```

### Role:
#### *Create*:
```
/api/role/create
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "role_id":              "your_role_id",
    "role_name":            "your_role_name",
    "slug":                 "your_slug",
    "role_description":     "your_role_description"
}
```
> Out:
```json
{
    "message": "The role was successfully added."
}
```
#### *Delete*:
```
/api/role/delete/{your_role_id}
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
    "message": "The role was successfully deleted."
}
```
#### *Update*:
```
/api/role/update
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "role_id":              "your_role_id",
    "role_name":            "your_role_name",
    "slug":                 "your_slug",
    "role_description":     "your_role_description"  
}
```
> Out:
```json
{
    "message": "The role was successfully updated."
}
```
#### *Get all roles*:
```
/api/role/all
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{

}
```
> Out:
```json
{
   "data":[ 
            {
                "role_id":          "your_role_id",
                "role_name":        "your_role_name",
                "slug":             "your_slug",
                "role_description": "your_role_description"
            },
            # Other roles here...
   ]
}
```
#### *Get role by id*:

```
/api/role/{your_role_id}
```
> In: 
```

```
> Out:
```json
{
    "data": {
                "role_id":          "your_role_id",
                "role_name":        "your_role_name",
                "slug":             "your_slug",
                "role_description": "your_role_description"
     }
}
```


### Permission:
#### *Create*:
```
/api/permission/create
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "your_permission_id":           "your_permission_id",
    "your_permission_name":         "your_permission_name",
    "your_slug":                    "your_slug",
    "your_permission_description":  "your_permission_description"
}
```
> Out:
```json
{
    "message": "The permission was successfully added."
}
```
#### *Delete*:
```
/api/permission/delete/{your_permission_id}
```
> In: 
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{

}
```
> Out:
```json
{
    "message": "The permission was successfully deleted."
}
```
#### *Update*:
```
/api/permission/update
```
> In: 
```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer your_access_token_here

{
    "your_permission_id":           "your_permission_id",
    "your_permission_name":         "your_permission_name",
    "your_slug":                    "your_slug",
    "your_permission_description":  "your_permission_description"
}
```
> Out:
```json
{
    "message": "The permission was successfully updated."
}
```
#### *Get all permissions*:
```
/api/permission/all
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
    "data": [
            {
                "your_permission_id":           "your_permission_id",
                "your_permission_name":         "your_permission_name",
                "your_slug":                    "your_slug",
                "your_permission_description":  "your_permission_description"
            },
            # Other permissions here...
    ]
}
```
#### *Get permission by id*:

```
/api/permission/{your_permission_id}
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
    "data": {
                "your_permission_id":           "your_permission_id",
                "your_permission_name":         "your_permission_name",
                "your_slug":                    "your_slug",
                "your_permission_description":  "your_permission_description"
    }
}
```
