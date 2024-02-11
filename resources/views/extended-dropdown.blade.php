<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Document</title>
    <script data-navigate-once >
        document.addEventListener('livewire:initialized',()=>{
            @this.on('closesecond',(event)=>{
                var mymodal=document.querySelector('#second')
                var modal=bootstrap.Modal.getOrCreateInstance(mymodal)
                modal.hide();
            })
        })
</script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li  class="nav-item">
                    <a  wire:navigate class="nav-link active"
                     href="{{ URL::to('/') }}/extended-dropdown" >home</a>
                  </li>
                <li  class="nav-item">
                <a wire:navigate class="nav-link active"  href="{{ URL::to('/') }}/first">First</a>
              </li>
              <li  class="nav-item">
                <a wire:navigate class="nav-link active"  href="{{ URL::to('/') }}/second">Second</a>
              </li>
              <li  class="nav-item">
                <a class="nav-link active" data-bs-toggle="modal" data-bs-target="#addTask" >add</a>
              </li>
            </ul>
          </div>

        </div>
      </nav>
      @yield('extended-dropdown')
      @livewire('layout')
      <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
