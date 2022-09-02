<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Received a new order - Storak.qa</title>

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
                                            <tr style="background-color: #0F3557; color: #ffffff ; text-align: center;">
                                                <td style="">
                                                    <h2>Storak.qa</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 25px">
                                                    <h2>Congrats! You have received a new order</h2>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 0;">
                                                    <h3><strong>Order :</strong><a href="" style="color: black">
{{--                                                            {{ $package_details->orderDetail->order_no }}--}}
                                                        </a> <br>

                                                    </h3>
                                                    <p>Order Date:
{{--                                                        {{ \Carbon\Carbon::parse($package_details->created_at)->format('d-m-Y') }}--}}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img
                                                        src="https://img.icons8.com/cute-clipart/96/000000/shopping-cart.png" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="font-size: 14px; line-height: 18px; color: #666666; padding-top: 35px">
                                                    <h3>Buyer details</h3>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size: 14px; line-height: 18px; color: #000000;">
                                                    Name: <b> {{ $package_details->orderDetail->user->name }}</b> |
                                                    Phone: <b> {{ $package_details->orderDetail->user->mobile }}</b> |
                                                    Email:
                                                    <b> {{ $package_details->orderDetail->user->email }}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <br>
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

                                            {{-- complete address --}}
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 12px; line-height: 18px; color: #666666; padding-right: 40px; width: 50%">
                                                    {{ $package_details->orderDetail->billingAddress->user_address}}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 12px; line-height: 18px; color: #666666; padding-left: 20px ;  width: 50%">
                                                    {{ $package_details->orderDetail->shippingAddress->user_address ?? 'N/A'}}
                                                </td>
                                            </tr>

                                            {{-- city-country address --}}
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 12px; line-height: 18px; color: #666666; padding-bottom: 10px;padding-right: 40px;">
                                                    {{ $package_details->orderDetail->billingAddress->cityDetail->name }},
                                                    {{ $package_details->orderDetail->billingAddress->countryDetail->name }}
                                                </td>
                                                <td
                                                    style="width: 45%; font-size: 12px; line-height: 18px; color: #666666; padding-bottom: 10px; padding-left: 20px">
                                                    {{ $package_details->orderDetail->shippingAddress->cityDetail->name ?? 'N/A' }},
                                                    {{ $package_details->orderDetail->shippingAddress->countryDetail->name ?? 'N/A' }}
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

                                        <tbody>
                                            <tr>
                                                <td
                                                    style="width: 55%; font-size: 14px; font-weight: bold; color: #000000; padding-bottom: 5px; line-height: 24px">
                                                    Order Details
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                    Store :
                                                    <strong>{{ $package_details->storeDetail->store_name }}</strong>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                    Fulfillment Type:
                                                    <strong
                                                        style="text-transform: capitalize">{{ $package_details->fulfillmentDetail->name }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                    Fulfillment Charges: <strong style="">QAR
                                                        {{ $package_details->fulfillment_charges }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="560" align="center" cellspacing="0" border="1"
                                                        class="devicewidthinner"
                                                        style="border: 0px solid #a7a5a5; border-collapse: collapse">
                                                        <thead style="background-color: #E6E6E6">

                                                            <tr>
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                    <strong>SKU </strong>
                                                                </th>
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                    <strong>Product Description</strong>
                                                                </th>
                                                                <th
                                                                    style="font-size: 12px; line-height: 16px; color: #1b1313; ">
                                                                    <strong>Unit Price</strong>
                                                                </th>

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
                                                            @foreach ($package_details->packageItems as $item)
                                                                <tr>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575; width:10%">
                                                                        {{ $item->productDetail->firstVariant->seller_sku }}
                                                                    </th>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575;width:40% ;text-align: left; padding-left: 10px">
                                                                        {{ $item->productDetail->name }}
                                                                    </th>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575; width:15%">
                                                                        <strong> {{ $item->price / $item->quantity }}
                                                                    </th>
                                                                    <th
                                                                        style="font-size: 11px; line-height: 16px; color: #757575; width:10%">
                                                                        <strong>{{ $item->quantity }}</strong>
                                                                    </th>
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

                                            {{-- <td colspan="2"
                                                style="font-size: 12px; line-height: 45px; color: #000000; text-align: right">
                                                <strong>Package Bill:</strong> {{ $package_details->package_bill }}
                                                <hr>
                                            </td> --}}
                            </tr>

                            <!-- End product Section -->
                            <!-- Start payment method Section -->
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
                                                    style="font-size: 14px; font-weight: bold; line-height: 18px; color: #000000; padding-top: 10px; text-align: right;">
                                                    QAR {{ $package_details->package_bill }}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
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
                                    <p>Have a great day! Thank you for business on <a href="#">https://storak.qa/</a>
                                    </p>
                                    <!-- Start payment method Section -->
                                </td>
                            </tr>
                            <!-- End payment method Section -->
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
