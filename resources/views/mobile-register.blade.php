<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('sweetalert::alert')
    <form action="/mobile-register" class="space-y-4 px-4 mt-4" method="POST">
        @csrf
        <div>
            <label for="">
                Given Name *
            </label>
            <input name="first_name" required type="text" class="w-full border p-4 rounded-xl" />
        </div>

        <div>
            <label for="">
                Last Name *
            </label>
            <input name="last_name" required type="text" class="w-full border p-4 rounded-xl" />
        </div>

        <div>
            <label for="">
                Middle Name
            </label>
            <input name="middle_name" type="text" class="w-full border p-4 rounded-xl" />
        </div>

        <div>
            <label for="">
                Phone *
            </label>
            <input name="phone" required type="text" class="w-full border p-4 rounded-xl" />
        </div>

        <div>
            <label for="">
                Employee No. *
            </label>
            <input name="employee_no" required type="text" class="w-full border p-4 rounded-xl" />
        </div>


        <div>
            <label for="">
                Department *
            </label>
            <input name="department" required type="text" class="w-full border p-4 rounded-xl" />
        </div>

        <div>
            <label for="">
                Email *
            </label>
            <input name="email" required type="email" class="w-full border p-4 rounded-xl" />
        </div>

        <div>
            <label for="">
                Password *
            </label>
            <input name="password" required class="w-full border p-4 rounded-xl" />
        </div>

        <button class="w-full bg-blue-900 text-white p-4 rounded-full">
            REGISTER
        </button>

    </form>
</body>
</html>
