<div class="px-5 pt-5">
    <div class="row d-flex flex-wrap pt-3">

    <div id="account-details" class=" col-xl-6 col-lg-6 col-sm-8">
        <h3 class="fw-semibold fontbrown"  >Account Details</h3 >
        <div   class=" user-info mt-5 fontbrown">
            <form class="col" wire:submit.prevent="updateProfile" >
                <div class="mb-3">
                   <h6><label for="exampleInput1" class="form-label">Name</label></h6>
                    <input type="name" placeholder="Name" wire:model="user_name" style="background: rgba(214, 214, 214, 0.377)" class="form-control"
                        id="exampleInput1" >
                        <span>
                            @error('user_name')
                                {{ $message     }}
                            @enderror
                        </span>
                </div>
                <div class="mb-3 mt-4">
                    <h6><label for="exampleInputEmail1" class="form-label">Email address</label></h6>
                    <input type="email" placeholder="Email"  wire:model="user_email" class="form-control text-body-secondary "
                        style="background: rgba(214, 214, 214, 0.377)" id="exampleInputEmail1" disabled>
                </div>
                <button type="submit" class="btn color">Submit</button>
            </form>
        </div>
        <div class="mb-3">
         </div>

    </div>
    <div id="account-details" class=" col-xl-6 col-lg-6  col-sm-8 ">
        <h3 class="fw-semibold fontbrown" >Change Password</h3 >
        <div  class=" user-info mt-5 fontbrown">
            <form class="col" wire:submit.prevent='changePassword'>
                <div class="">
                   <h6><label for="exampleInput1" class="form-label">Current Password</label></h6>
                    <input wire:model='current_password' type="password" placeholder=" Current Password" style="background: rgba(214, 214, 214, 0.377)" class="form-control"
                        id="exampleInput1">
                        <span>
                            @error('current_password')
                                {{ $message     }}
                            @enderror
                        </span>
                </div>
                <div class=" mt-4">
                   <h6><label for="exampleInput1" class="form-label">New Password</label></h6>
                    <input wire:model='password' type="password" placeholder=" New Password" style="background: rgba(214, 214, 214, 0.377)" class="form-control"
                        id="exampleInput1">
                        <span>
                            @error('password')
                                {{ $message     }}
                            @enderror
                        </span>
                </div>
                <div class=" mb-3 mt-4">
                   <h6><label for="exampleInput1" class="form-label">Confirm Password</label></h6>
                    <input  wire:model='password_confirmation'type="password" placeholder=" Confirm Password" style="background: rgba(214, 214, 214, 0.377)" class="form-control"
                        id="exampleInput1">
                        <span>
                            @error('password_confirmation')
                                {{ $message     }}
                            @enderror
                        </span>
                </div>
                <button type="submit" class="btn color">Submit</button>
            </form>
        </div>
        <div class="mb-3">
         </div>

    </div>
    </div>
    <div class="col-md-12 col-sm-4 mt-5 ">
        <p class="fontbrown" >!! This will immediately delete all of your data including tasks, projects, comments, and more. This can’t be undone !!</p>
        <button class="btn color mt-2"> Delete Account</button>
    </div>
    <x-notify::notify />
   </div>
