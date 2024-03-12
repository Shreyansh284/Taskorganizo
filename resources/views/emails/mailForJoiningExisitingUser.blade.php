<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Invitation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ddd9d9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #8b1d13; /* Brown */
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #8b1d13; /* Brown */
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Team Invitation , {{$data['team_name']}}</h3>

        <p>You have received a team invitation from {{$data['adminName']}}, {{$data['adminEmail']}}.</p>

        <a href="http://127.0.0.1:8000/join/?team={{$data['team_name']}}&team_id={{$data['team_id']}}&adminName={{$data['adminName']}}&adminEmail={{$data['adminEmail']}}&userEmail={{$data['email']}}">
            <button>Join Now</button>
        </a>

        <div class="footer">
            <p>Thank you for using TaskOrganizo!</p>
        </div>
    </div>
</body>
</html>
