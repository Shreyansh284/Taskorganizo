<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">

    <title>TaskOrganizo</title>

		<link rel="stylesheet" href="/signin/css/style.css">
	</head>

	<body>
        <a wire:navigate href="{{ URL::to('/') }}/"  class="brand fontbrown">
            <i class="bi  bi-calendar2-check-fill" style="padding-right:10px"> </i> <span class="text" style="padding-top: 10px">TaskOrganizo</span>
        </a>
        @yield('formMaster')
	</body>
    </html>
