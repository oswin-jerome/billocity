<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            height: 100vh;
            background-color: rebeccapurple;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .o-card{
            max-width: 600px !important;
            min-width: 400px;
            background-color: #fff;
            padding: 15px;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <form method="POST" action="login" class="o-card">
        {{ csrf_field() }}
        <h3 class="text-center">Login</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input required type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input required type="text" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>