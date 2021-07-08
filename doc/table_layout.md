# Ticket System data Model Design 



## Reporting 

|  column name   |     type     |     commit     |
| :------------: | :----------: | :------------: |
|       id       |     int      | auto_increment |
|  report_title  | varchar(50)  |    回報標題    |
|  report_type   |     int      |    回報類別    |
| report_states  |     int      |  問題解決狀況  |
| report_severity  |     int      |  問題嚴重狀況  |
| report_priority  |     int      |  問題優先狀況  |
| report_summary | varchar(100) |    問題概述    |
|  report_desc   |     text     |    問題詳細    |
|  created_user  |     int      |   建立使用者   |
|  updated_user  |     int      |   修改使用者   |
|   created_at   |   datetime   |                |
|   updated_at   |   datetime   |                |




## Reply 

| column name |   type   |     commit     |
| :---------: | :------: | :------------: |
|     id      |   int    | auto_increment |
|  report_id  |   int    |     回報ID     |
| reply_desc  |   text   |    回覆內容    |
| reply_user  |   int    |  回覆的使用者  |
| created_at  | datetime |                |
| updated_at  | datetime |                |

## Report Type

|   column name    |    type     |     commit     |
| :--------------: | :---------: | :------------: |
|        id        |     int     | auto_increment |
| report_type_name | varchar(30) |    回報類別    |
|    created_at    |  datatime   |                |
|    updated_at    |  datetime   |                |

## User

| column name  |     type     |     commit     |
| :----------: | :----------: | :------------: |
|      id      |     int      | auto_increment |
| user_account | varchar(20)  |   使用者帳號   |
|  user_email  | varchar(200) | 使用者電子郵件 |
|   user_pwd   | varchar(100) |   使用者密碼   |
|  user_role   |     int      |   使用者權限   |
|  created_at  |   datetime   |                |
|  updated_at  |   datetime   |                |

## User Role

|  column name   |    type     |     commit     |
| :------------: | :---------: | :------------: |
|       id       |     int     | auto_increment |
| user_role_name | varchar(20) | 使用者權限類別 |
|   created_at   |  datetime   |                |
|   updated_at   |  datetime   |                |
