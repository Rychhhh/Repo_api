<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <form method="post" action="{{ route('users.update', $user['id']) }}" >
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nama_depan" class="form-label">First Name</label>
            <input type="text" name="nama_depan" class="form-control @error('firstName') is-invalid @enderror"
                id="nama_depan" value="{{ old('nama_depan', $user['firstName']) }}">

            @error('firstName')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nama_belakang" class="form-label">Last Name</label>
            <input type="text" name="nama_belakang" class="form-control @error('lastName') is-invalid @enderror"
                id="nama_belakang" aria-describedby="emailHelp" value="{{ old('nama_belakang', $user['lastName']) }}">

            @error('lastName')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <small>(Forbidden to Update)</small></label>

            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                aria-describedby="emailHelp" value="{{ old('email', $user['email']) }}" disabled>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-dark" href="{{ url('users') }}">Back</a>
    </form>
</body>
</html>


