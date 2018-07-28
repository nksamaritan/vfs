<!DOCTYPE html>
<html>
    <head>
        <title>{{__('app.app_name')}} : User Login Information</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body style="margin: 0;padding: 0;width: 100%;display: table;font-weight: 100;height: 100%;">
        <div style="text-align: center;display: table-cell;vertical-align: middle;">
            <div style="width: 450px;margin: 0 auto;">
                <div style="text-align: center; border-bottom: 1px lightgrey solid;">
                    <span>
                        <a href="{{url('/dashboard')}}"><img src="{{url('img/logo.png')}}"/></a>
                    </span>
                </div>
                <div style="text-align: center;border-bottom: 1px lightgrey solid;">
                    <h2><strong>User Login Information</strong></h2>
                </div>
                <div style=" text-align: center;display: inline-block;border-bottom: 1px lightgrey solid;">
                    <p>Hello {{$user_data['first_name']}} {{$user_data['last_name']}},</p>
                    <p>Welcome to {{__('app.app_name')}}. Please find your login details below.</p>
                    <p><b>Username:</b> {{$user_data['email']}}</p>
                    <p><b>Password:</b> {{$user_data['password']}}</p>
            </div>
                <p>Thanks,</p>
                <p>{{__('app.app_name')}}</p>
        </div>
        </div>
    </body>
</html>