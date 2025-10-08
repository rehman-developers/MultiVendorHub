<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Student</title>
</head>
<body>
    <div class="container bg-gray-100">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight">Add New Student</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="{{ route('addStudent')}}" method="POST" class="space-y-6">
        @csrf
          <div>
        <label for="name" class="block text-sm/6 font-medium ">Name</label>
        <div class="mt-2">
          <input id="name" type="text" name="stname" required autocomplete="name" class="block w-full rounded-md border px-3 py-1.5 " />
        </div>
      </div>
      <div>
        <label for="email" class="block text-sm/6 font-medium ">Email</label>
        <div class="mt-2">
          <input id="email" type="email" name="stemail" required autocomplete="email" class="block w-full rounded-md border  px-3 py-1.5   " />
        </div>
      </div>

         <div>
        <label for="age" class="block text-sm/6 font-medium">Age</label>
        <div class="mt-2">
          <input id="age" type="number" name="stage" required class="block w-full rounded-md border px-3 py-1.5 text-base " />
        </div>
      </div>
        <div>
        <label for="city" class="block text-sm/6 font-medium">City</label>
        <div class="mt-2">
          <input id="city" type="text" name="stcity" required class="block w-full rounded-md border px-3 py-1.5 text-base  " />
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-blue-900 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Add Student</button>
      </div>
    </form>

  
  </div>
</div>
    </div>
</body>
</html>