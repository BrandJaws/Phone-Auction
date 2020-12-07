<!DOCTYPE html>
<html>

<head>
    <title>Mobi Jack's Mobile Phone Repair</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: 'Raleway', sans-serif;
        }

        .container {
            width: 650px;
            margin: 0 auto;
        }
        table.tableBorder, table.tableBorder td, table.tableBorder th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table cellpadding="0px" cellspacing="0px" border="0" style="width: 600px; margin: 0 auto;" class="container">
        <tbody>

            <tr>
                <td>
                    <table border="0" cellpadding="0px" cellspacing="0px"
                        style="width: 100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="http://mobi.retriodev.com/wp-content/uploads/2020/12/email-banner.png" alt="mobiJack" width="600px" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="0" cellpadding="0px" cellspacing="0px"
                        style="width: 100%;">
                        <tbody>
                            <tr>
                            <td style="padding: 20px 0px 10px 0px; color: #000; font-size: 18px;">Greetings <b>{{ $sellOrder->firstName }}</b>,</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="0" cellpadding="0px" cellspacing="0px"
                        style="width: 100%; padding: 0px;">
                        <tbody>
                            <tr>
                                <td style="padding: 10px 0px 10px 0px; color: #000; font-size: 14px;">Smart move - Thank you for your sale!</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0px" cellspacing="0px"
                        style="width: 100%;">
                        <tbody>
                            <tr>
                                <td>
                                    <h3 style="padding:10px 0px; color: #000; font-size: 28px; font-weight: 700;">Sell Order # {{ $sellOrder->id }} Confirmation</h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            @if($sellOrder->drop_location)
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px 20px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px; line-height: 20px;">
                                            <b>Your email:</b> {{ $sellOrder->paymentEmail }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                @else
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px 20px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px; line-height: 20px;">
                                            <b>Your name:</b> {{ $sellOrder->firstName.' '.$sellOrder->lastName }}
                                            <br>
                                            <b>Your address:</b> {{ $sellOrder->address }}
                                            <br>
                                            <b>Want to get paid via:</b> {{ ucfirst(strtolower($sellOrder->paymentMethod)) }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endif
            <tr>
                <td>
                    <table cellpadding="0px" cellspacing="0px" class="tableBorder"
                        style="width: 100%">
                        <tbody>
                            <tr>
                                <th>
                                    <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">Device</p>
                                </th>
                                <th>
                                    <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">Network</p>
                                </th>
                                <th>
                                    <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">State</p>
                                </th>
                                <th>
                                    <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">Value</p>
                                </th>
                            </tr>
                            @foreach($sellOrder->items as $item)
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">{{ $item->selectedDeviceModel->name }}</p>
                                    </td>
                                    <td>
                                        <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">{{ $item->selectedNetworkCarrier->name }}</p>
                                    </td>
                                    <td>
                                        <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">{{ $item->selectedQuote->device_state->condition }}</p>
                                    </td>
                                    <td>
                                        <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px; text-align:left;">${{ $item->selectedQuote->quote_price }}</p>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" align="right">
                                    <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px;">Total: </p>
                                </td>
                                <td>
                                    <p style="color: #000; font-size: 14px; font-weight: 700; padding:5px;"><b>${{ $sellOrder->netTotal }}</b></p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            @if($sellOrder->drop_location)
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px;">
                                            You’ve selected top drop your device at our <strong>{{ $sellOrder->drop_location->name }}</strong> store.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px;">
                                            Please bring this email to the store when you want to drop your device with us.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @else
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px;">
                                            You’ve selected “I only need the shipping label”. It’s the fastest way to send your device(s)!
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px;">Our team is working on preparing your shipping label and will email it to you within the next business hour (if it’s the weekend, please allow 24 hours).
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px;">If you still haven’t received it, please let us know by simply replying to this email or by calling us 1-888-464-6798.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0px" cellspacing="0px"
                            style="width: 100%;padding:10px 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="color: #000; font-size: 14px;">
                                            <b>Once you receive it, simply follow the shipping instructions and send us your device(s).</b>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endif
            {{-- <tr>
                <td>
                    <table cellpadding="0px" cellspacing="0px"
                        style="width: 100%;padding:10px 0px;">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="color: #000; font-size: 14px;"><b>Note:</b> You can also track the progress of your sale by using this order number: <a href="#.">20701</a>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr> --}}
            <tr>
                <td>
                    <table cellpadding="0px" cellspacing="0px"
                        style="width: 100%;padding:10px 0px 50px 0px;">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="color: #000; font-size: 14px;">Kind Regards,</span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
