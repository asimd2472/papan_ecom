<!DOCTYPE html>
<html lang="en" style="width: 100%; padding: 0; margin: 0;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- fab -->
    <link rel="icon" type="image/ico" sizes="32x32" href="images/favicon.ico">
    <!-- fab -->
    <title></title>
    <!-- Google font  Poppins-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body style="padding: 0; margin: 0; font-family: 'Poppins', sans-serif;">
    <table style="max-width: 800px; width: 100%; background: #fff; padding: 0; margin: 30px auto 0; border-spacing: 0px; border-collapse: collapse;">
        <tr>
            <td style="padding: 10px;">
                <table style="width: 100%; padding: 0; margin: 0; border-spacing: 0px; border-collapse: collapse;">
                    <thead>
                        {{-- <tr style="margin: 20px auto;">
                            <th>
                                <a href="#" style="display: inline-block; text-decoration: none; padding: 0; margin: 0;">
                                    <img style="width: 250px;" src="{{asset('storage/images/'.$setting->site_logo)}}" alt="">
                                </a>
                            </th>
                        </tr> --}}
                        <tr>
                            <td>
                                <p style="padding: 0; margin: 10px 0 0 0; font-size: 16px; color: #000; text-align: left;">Hi, {{$user_name}}</p>
                                <p style="padding: 0; margin: 0; font-size: 16px; color: #000; text-align: left;">Your new password is <b>{{$new_password}}</b></p>
                            </td>
                        </tr>

                    </thead>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table style="width: 100%; background: #fff; padding: 0; margin: 0 auto 50px; border-spacing: 0px; border-collapse: collapse;">

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
