@if (session()->has('success'))
<div wire:ignore.self class="custom-alert alert alert-success alert-dismissible fade show" id="successAlert">
    <span class="alert-text">{{session('success')}}</span>
    <i class="bi text-light closeAlert bi-x-circle" data-bs-dismiss="alert"></i>
</div>
@endif
@script
<script>
    document.addEventListener('livewire:navigated', function () {
    setTimeout(function () {
        document.getElementById('successAlert').style.display = 'none';
    }, 4000);
});
</script>
@endscript
