<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@800&family=Roboto+Mono:ital,wght@0,400;0,500;1,600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    roboto: ['Roboto Mono'],
                }
            }
    }
    </script>
</head>
<body class="bg-no-repeat bg-cover" style="background-image: url('https://cdn.dribbble.com/users/8106/screenshots/17662327/media/7cbb24071afb0c1ce6d0a68dfc52e78d.png?compress=1&resize=1200x900&vertical=top')">
    

    <div class="min-h-screen w-full flex items-center justify-center flex-col">

        <div class="title font-serif mb-10 pt-10">
            <h1 class="text-5xl font-bold bg-gradient-to-r from-gray-100 bg-clip-text text-transparent">Users</h1>
        </div>

        <a class="py-2 mb-5 text-white bg-green-500 rounded-xl px-3" href="{{ url('users/create') }}">Add</a>

        @if (session()->has('message'))
            <div class=" show bg-red-500 text-white w-25 p-8 mb-5 text-center" role="alert">
                {{ session('message') }}
                <a href="{{ url('users') }}" class="text-sky-500">X</a>
            </div>
        @endif

        <div class="table flex-wrap font-roboto">
            <table class="px-10 bg-slate-50 border border-slate-300">
                <thead class="border bg-sky-300 text-slate-500 text-xl font-semibold border-b-slate-300">
                    <tr>
                        <td class="pr-10 py-5 pl-5 text-center">No</td>
                        <td class="pr-10 text-center">First Name</td>
                        <td class="pr-10 text-center">Last Name</td>
                        <td class="pr-10 text-center">Action</td>
                    </tr>
                </thead>
                <tbody class="text-center text-sm font-semibold bg-sky-100 divide-y divide-dashed">
                    @forelse ($users['data'] as $users)
                    <tr class="hover:bg-sky-200">
                            <td class="py-9 pr-10  ">{{ $loop->iteration }}</td>
                       
                        
                            <td class="py-9 pr-10">{{ $users['firstName'] }}</td>
                       
                        
                            <td class="py-9 pr-10">{{ $users['lastName'] }}</td>
                       
                        
                            <td class="py-9 pr-10">
                                <a href="{{ route('users.edit', $users['id']) }}" class="p-2 mr-2 bg-sky-500 text-white rounded-xl shadow-xl hover:bg-sky-700">Edit</a>
                                <form method="POST" action="{{ route('users.destroy', $users['id']) }}" class="d-inline block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="p-2 bg-red-500 text-white rounded-xl shadow-xl hover:bg-red-700 mt-5"
                                        onClick="return confirm('Are you sure to delete this user?');"><i
                                            class="fa fa-fw fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="bg-gradient-to-l from-sky-500 bg-clip-text text-transparent">No Record( S ) Data</td></tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
        
    </div>


</body>
</html>