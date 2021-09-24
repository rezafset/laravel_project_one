<div class="card-header text-center">
    <img src="{{ asset('Upload/Users/'.Auth::user()->user_photo) }}" class="img-fluid" height="70" width="70" alt="...">
    <h5 class="card-title mb-0 mt-2"> {{ Auth::user()->name }} </h5>
</div>
<div class="card-body">
    <h5 class="card-text"> <a  href="{{ route('customer.profile') }}">Customer Profile</a> </h5>
    <h5 class="card-text"> <a  href="{{ route('customer.edit') }}">Edit Profile</a> </h5>
    <h5 class="card-text"> <a  href="{{ route('customer.password') }}">Change Password</a> </h5>
    <h5 class="card-text"> <a  href="{{ route('logout') }}">Logout</a> </h5>

</div>
