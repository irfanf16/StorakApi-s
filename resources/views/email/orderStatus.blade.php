<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

    </style>
</head>
@php

@endphp
{{-- {{dd($package_details->fulfillmentDetail->charges)}} --}}

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div
        style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="background-color: {{ $package_details->orderStatusDetail->background_color }}">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center"
                style="padding: 0px 10px 0px 10px; background-color: {{ $package_details->orderStatusDetail->background_color }}"
                class="___class_+?0___">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"
                            style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 2px; line-height: 48px; ">
                            <h1 style="font-size: 30px; font-weight: 350; "> Hey
                                {{ $package_details->user->name }}!</h1>
                            <img src="{{ $package_details->orderStatusDetail->icon }}" width="100" height="100"
                                style="display: block; border: 0px;" />
                            <h4 style="font-size:30px; margin-top:0px; margin-bottom:10px;">
                                {{ $package_details->orderStatusDetail->message }}
                            </h4>
                            <p
                                style="padding: 0px 20px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 400; line-height: 25px; text-align:left; margin:0px;">
                                {{ $package_details->orderStatusDetail->description }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        {{-- Order Details Row --}}
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="text-align: left; font-family: 'Lato', Helvetica, Arial, sans-serif;">
                                <tr>
                                    <td style="padding: 20px; background-color:white; text-align:center;">

                                        <ul style="text-align: left; margin:0px; padding:0px; margin-bottom:15px;">
                                            <h3 style="text-align: left; margin-bottom:5px; margin-left:15px">
                                                Order Details
                                            </h3>
                                            <li style="list-style: none">
                                                <div
                                                    style="width:30%; float:left; padding:10px; background-color:#11315017;">
                                                    Order Id
                                                </div>
                                                <div
                                                    style="width:60%; float:left; padding:10px; background-color:#0000000a;">
                                                    {{ $package_details->orderDetail->order_no }}
                                                </div>
                                            </li>
                                            <li style="list-style: none">
                                                <div
                                                    style="width:30%; float:left; padding:10px; background-color:#11315017;">
                                                    Store Name
                                                </div>
                                                <div
                                                    style="width:60%; float:left; padding:10px; background-color:#0000000a;">
                                                    {{ $package_details->storeDetail->store_name }}
                                                </div>
                                            </li>
                                            <li style="list-style: none">
                                                <div
                                                    style="width:30%; float:left; padding:10px; background-color:#11315017;">
                                                    Order Bill
                                                </div>
                                                <div
                                                    style="width:60%; float:left; padding:10px; background-color:#0000000a;">
                                                    QAR {{ $package_details->orderDetail->packages_bill }}
                                                </div>
                                            </li>
                                            <li style="list-style: none">
                                                <div
                                                    style="width:30%; float:left; padding:10px; background-color:#11315017;">
                                                    Fulfilment Charges
                                                </div>
                                                <div
                                                    style="width:60%; float:left; padding:10px; background-color:#0000000a;">
                                                    QAR {{ $package_details->fulfillmentDetail->charges }}
                                                </div>
                                            </li>
                                        </ul>
                                        <a href="https://react.storak.qa/" target="_blank"
                                            style="font-size: 15px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 5px; border: 1px solid; display: inline-block; background-color: #113150; margin:15px;">View
                                            Order Complete Details</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Thank you for your business, your trust, and your
                                confidence. It is our pleasure to work with you.
                                Please let us know If you're facing any trouble ,just click
                                the below link or visit our site :<br><a
                                    href="https://react.storak.qa/">www.storak.qa</a> </p>

                            <p style="margin: 0;">If you have any Questions, just reply to this
                                Email - We're always happy
                                to help out.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Cheers,<br>Storak Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center"
                            style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px; background-color: #288CFF">
                            <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">
                                Need more help?
                            </h2>
                            <p style="margin: 0;"><a href="#" target="_blank"
                                    style="color:rgb(255, 255, 255);">We&rsquo;re
                                    here
                                    to help you out</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="left"
                            style="padding: 0px 30px 30px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;">
                            <br>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
