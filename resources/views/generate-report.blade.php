<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.9/tailwind.min.css' integrity='sha512-SvJR34InARUfJb279ipE/gjQqX11MDKaly9MNb0vevuWQJmZ23UH7F/65ScEsvLI+myKGbdfA1En82wVSCHQ8A==' crossorigin='anonymous'/>
</head>
<body>
    <h1 class="text-center text-2xl">Reports</h1>
    <div class="flex justify-center mt-4">
        <form action="{{url()->current()}}">
            <input type="date" name="from" class="border-2 p-2" required>
            <input type="date" name="to" class="border-2 p-2" required>
            <button class="p-2 border-2 bg-purple-600 text-white border-purple-900 uppercase">Generate</button>
        </form>
    </div>
    <div class="overflow-x-auto p-4">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left border">
                        Date
                    </th>
                    <th class="text-left border">
                        Patient
                    </th>
                    <th class="text-left border">
                        Remarks
                    </th>
                    <th class="text-left border">
                        Total Amount
                    </th>
                    <th class="text-left border">
                        Amount Paid
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>
                        {{$record->created_at->format('m/d/y H:i A')}}
                    </td>
                    <td>
                        {{$record->user->name}}
                    </td>
                    <td>
                        {{$record->notes}}
                    </td>
                    <td>
                        {{$record->total_amount}}
                    </td>
                    <td>
                        {{$record->amount_paid}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
