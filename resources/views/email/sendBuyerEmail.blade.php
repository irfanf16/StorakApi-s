<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Order is placed - Storak.qa</title>

    <!-- Start Common CSS -->
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            font-family: Helvetica, arial, sans-serif;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        .main-temp table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            font-family: Helvetica, arial, sans-serif;
        }

        .main-temp table td {
            border-collapse: collapse;
        }

    </style>
    <!-- End Common CSS -->
</head>



<body>

    {{-- {{ dd($order_details->billingAddress->user_address) }} --}}

    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp"
        style="background-color: #d5d5d5;">
        <tbody>
            <tr>
                <td>
                    <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth"
                        style="background-color: #ffffff;">
                        <tbody>
                            <!-- Start header Section -->
                            <tr>
                                <td style="padding-top: 30px;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner"
                                        style="border-bottom: 1px solid #eeeeee; text-align: center; ">
                                        <tbody>
                                            <tr style="background-color: #0F3557; color: #ffffff ;padding-bottom: 15px">
                                                <td style="padding-bottom: 10px;">
                                                    <h2>Storak.qa</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2>Thank You! Your order is placed</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img
                                                        src="https://img.icons8.com/clouds/130/000000/online-shop.png" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;">
                                                    Order Number: <strong
                                                        style="color: #000000">{{ $order_details->order_no }}</strong>
                                                    |
                                                    Order Date:
                                                    <strong
                                                        style="color: #000000">{{ \Carbon\Carbon::parse($order_details->created_at)->format('d-m-Y') }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End header Section -->

                            <!-- Start address Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; font-weight: bold; color: #000000; padding-bottom: 5px; ">
                                                    Billing Adderss
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 14px; font-weight: bold; color: #000000; padding-bottom: 5px; padding-left: 20px">
                                                    Delivery Address
                                                </td>
                                            </tr>
                                            {{-- Complete Address --}}
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 12px; line-height: 18px; color: #666666; padding-right: 40px; width: 50%">
                                                    {{ $order_details->billingAddress->user_address }}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 12px; line-height: 18px; color: #666666; padding-left: 20px ; width: 50%">
                                                    {{ $order_details->shippingAddress->user_address ?? 'N/A' }}
                                                </td>
                                            </tr>
                                            {{-- city,country address --}}
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 12px; line-height: 18px; color: #666666; padding-bottom: 10px;padding-right: 40px;">
                                                    {{ $order_details->billingAddress->cityDetail->name }},
                                                    {{ $order_details->billingAddress->countryDetail->name }}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 12px; line-height: 18px; color: #666666; padding-bottom: 10px; padding-left: 20px">
                                                    {{ $order_details->shippingAddress->cityDetail->name ?? 'N/A' }},
                                                    {{ $order_details->shippingAddress->countryDetail->name ?? 'N/A' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- End address Section -->

                            <!-- Start product Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                        <tr>
                                            {{-- <td rowspan="4" style="padding-right: 10px; padding-bottom: 10px;">
                                                    <img style="height: 80px;" src="images/product-1.jpg"
                                                        alt="Product Image" />
                                                </td> --}}
                                            <td
                                                style="width: 55%; font-size: 14px; font-weight: bold; color: #000000; padding-bottom: 5px; line-height: 24px">
                                                Order Details
                                            </td>
                                        </tr>
                                        @foreach ($order_details->orderPackages as $order_package)
                                            <tr>
                                                {{-- <td style="font-size: 12px; line-height: 16px; color: #1b1313;">
                                                    Package ID: <strong> #{{ $order_package->order_id }}</strong>
                                                </td> --}}
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                    Store :
                                                    <strong>{{ $order_package->storeDetail->store_name }}</strong>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                    Fulfillment Charges : <strong style="">QAR
                                                        {{ $order_package->fulfillment_charges }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="560" align="center" cellspacing="0" border="1"
                                                        class="devicewidthinner" style="border: 2px solid #8b8989;">
                                                        <thead style="background-color: #dadada">
                                                            <tr>
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                    <strong>Item ID </strong>
                                                                </th>
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                    <strong>Product Description</strong>
                                                                </th>
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                    <strong>Unit Price</strong>
                                                                </th>
                                                                {{-- <th
                                                                        style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                        <strong>Discount</strong>
                                                                    </th> --}}
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                    <strong>QTY</strong>
                                                                </th>
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; width: 25% ">
                                                                    <strong>Total</strong>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order_package->packageItems as $item)
                                                                {{-- {{dd($item->productDetail->firstVariant)}} --}}
                                                                <tr>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575; width:10%">
                                                                        #{{ $item->productDetail->firstVariant->seller_sku }}
                                                                    </th>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575;width:40% ;text-align: left; padding-left: 10px">
                                                                        {{ $item->productDetail->name }}

                                                                    </th>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575; width:15%">
                                                                        <strong>
                                                                            {{ $item->price / $item->quantity }}
                                                                        </strong>
                                                                    </th>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575; width:10%">
                                                                        <strong>{{ $item->quantity }}</strong>
                                                                    </th>
                                                                    {{-- <th
                                                                            style="font-size: 11px; line-height: 16px; color: #757575; width:10%">
                                                                            <strong>7</strong>
                                                                        </th> --}}
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575; width:10%">
                                                                        <strong>{{ $item->price }}</strong>
                                                                    </th>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"
                                                    style="font-size: 12px; line-height: 45px; color: #0c0c0c; text-align: right">
                                                    <strong>Sub Total:</strong>
                                                    QAR {{ $order_package->package_bill }}
                                                    <hr>
                                                </td>
                                            </tr>
                                        @endforeach
                                </td>
                            </tr>
                            <!-- End product Section -->

                            <!-- Start calculation Section -->
                            <tr>
                                <td style="padding-top: 0;">
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                        class="devicewidthinner"
                                        style="border-bottom: 1px solid #bbbbbb; margin-top: -5px;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #000000; padding-top: 10px;">
                                                    Grand Total
                                                </td>
                                                <td
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #020202; padding-top: 10px; text-align: right;">
                                                    QAR {{ $order_details->packages_bill }}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <!-- End calculation Section -->
                            <tr class="font-10" style="color: #666666; padding-left: 10 ; font-size: 11px">
                                <td>
                                    <p>
                                        <strong style="color: red">*</strong> Total charges for this shipment
                                        includes prepaid custom duties and other taxes
                                        as
                                        applicable for the
                                        merchandise to be delivered to the address in the country specified by the
                                        customer .
                                    </p>
                                    <p>For return policy , please visit at <a href="#">
                                            https://www.storak.qa/contact-us/</a></p>
                                    <p>Have a great day! Thank you for shopping on <a href="#">https://storak.qa/</a>
                                    </p>
                                    <!-- Start payment method Section -->
                                </td>
                            </tr>
                            {{-- <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                        style="max-width: 600px;">
                                        <tr>
                                            <td align="center"
                                                style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px; background-color: #288CFF">
                                                <h2
                                                    style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">
                                                    Need more help?
                                                </h2>
                                                <p style="margin: 0;"><a href="#" target="_blank"
                                                        style="color:rgb(255, 255, 255);">We&rsquo;re here
                                                        to help you out</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr> --}}
                            <!-- End payment method Section -->
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
