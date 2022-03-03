<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="display:flex; align-items:center;">
        <h1 style="margin-right: 1em;">General Report</h1>
        <button onclick="javascript:window.print()">print</button>
    </div>
    <div>
        <h4>
            Transactions ({{\App\Models\Transaction::count()}})
        </h4>
        <table border="1" style="width:100vw;">
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Action
                </th>
                <th>
                    Owner
                </th>
            </tr>
            @foreach (\App\Models\Transaction::get() as $item)
                <tr>
                    <td>
                        {{$item->created_at->format('m-d-Y H:i A')}}
                    </td>
                    <td>
                        {{$item->type === \App\Models\Transaction::TYPE_DECRYPT ? 'Decrypt': 'Encrypt'}}
                    </td>
                    <td>
                        {{$item->user->name}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div>
        <h4>
            List of users  ({{\App\Models\User::count()}})
        </h4>
        <table border="1" style="width:100vw;">
            <tr>
                <th>
                    Register_at
                </th>
                <th>
                    Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Mobile #
                </th>
                <th>
                    Address
                </th>
            </tr>
            @foreach (\App\Models\User::get() as $item)
                <tr>
                    <td>
                        {{$item->created_at->format('m-d-Y H:i A')}}
                    </td>
                    <td>
                        {{$item->name}}
                    </td>
                    <td>
                        {{$item->email}}
                    </td>
                    <td>
                        {{$item->phone ?? '---'}}
                    </td>
                    <td>
                        {{$item->address}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div>
        <h4>
            Appointments (Latest - Oldest)  ({{\App\Models\Appointment::count()}})
        </h4>
        <table border="1" style="width:100vw;">
            <tr>
                <th>
                    Requested Date
                </th>
                <th>
                    Appointment Date
                </th>
                <th>
                    Patient
                </th>
                <th>
                    Doctor/Staff
                </th>
                <th>
                    Status
                </th>
            </tr>
            @foreach (\App\Models\Appointment::get() as $item)
                <tr>
                    <td>
                        {{$item->created_at->format('m-d-Y H:i A')}}
                    </td>
                    <td>
                        {{$item->datetime}}
                    </td>
                    <td>
                        {{$item->patient->name}}
                    </td>
                    <td>
                        {{optional($item->doctor)->name ?? '---'}}
                    </td>
                    <td>
                        {{$item->status}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
