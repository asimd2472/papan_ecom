<!DOCTYPE html>
<html lang="en" style="width: 100%; padding: 0; margin: 0;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- fab -->
    <link rel="icon" type="image/ico" sizes="32x32" href="images/favicon.ico">
    <!-- fab -->
    <title>Drago</title>
</head>

<body style="padding: 0; margin: 0; font-family: 'Poppins', sans-serif;">
    <table
        style="max-width: 800px; width: 100%; background: #fff; padding: 0; margin: 50px auto 0; border-spacing: 0px; border-collapse: collapse;">
        <thead>
            <tr style="margin: 30px auto;">
                <th style="padding: 50px 0 0 0;">
                    <a href="#" style="display: inline-block; text-decoration: none; padding: 0; margin: 0;">
                        <img style="width: 120px;" src="{{ Vite::asset('resources/front/images/logopng.png')}}"
                            alt="">
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">
                    <h4 style="padding: 0; margin: 40px 0 20px 0; font-size: 25px; color: #000; text-align: center;">
                        Welcome to Our Newsletter!</h4>
                    <p>User: {{$email}},</p>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    @php
                        $date = date('Y-m-d');
                    @endphp
                    <p style="padding: 0; margin: 0px; font-size: 14px; color: #000; text-align: center;">{{date('l, j F Y', strtotime($date))}}</p>

                    <p style="padding: 0; margin: 30px 0 10px 0; font-size: 14px; color: #000; text-align: center;">
                        Sincerely,</p>
                    <p style="padding: 0; margin: 0px; font-size: 14px; color: #000; text-align: center;">The {{env('APP_NAME')}} team</p>
                </td>
            </tr>
        </tfoot>
    </table>

    <table
        style="max-width: 800px; width: 100%; background: #fff; padding: 0; margin: 0 auto 50px; border-spacing: 0px; border-collapse: collapse;">

    </table>

</body>

</html>
