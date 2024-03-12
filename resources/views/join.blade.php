<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Invitation</title>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 20px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(83, 83, 83, 0.429);
        }


        h3 {
            color: #8b1d13;
            /* Brown */
            margin-bottom: 10px;
        }

        h5 {
            color: #333;
            margin-bottom: 15px;
        }

        a {
            text-decoration: none;
        }

        button {
            display: inline-block;
            padding: 8px 16px;
            /* Adjusted padding for smaller size */
            background-color: #8b1d13;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5d1109;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            color: #777;
            font-size: 12px;
        }

        .logo {
            width: 10vw;
            height: 10vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="favicon.svg" alt="Logo" class="logo" data-aos="zoom-in">
        <h3>Team Details</h3>
        <p>Team Name : {{ $teamName }}</p>
        <p>Team Admin Name : {{ $teamAdminName }}</p>


        <h3>Do You Want To Join This Team ?</h3>
        <a href="http://127.0.0.1:8000/user/{{ $userId }}/team/{{ $teamId }}">
            <button>Yes</button>
        </a>
        <a href="http://127.0.0.1:8000/login">
            <button>No</button>
        </a>

        <div class="footer">
            <p>Any Queries ? Contact {{ $teamAdminEmail }}</p>
            <p>Thank you for using TaskOrganizo!</p>
        </div>
    </div>

    <h1> @error('error')
            {{ $message }}
        @enderror
    </h1>
</body>

</html>
