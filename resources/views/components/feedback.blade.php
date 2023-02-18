<div class="m-2">
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @if (session()->has('success_') && session('success_')!=="")
    <div class="alert-success rounded">{{ session('success_') }}</div>
    @endif
    @if (session()->has('warnings_') && session('warnings_')!=="")
    <div class="alert-warning rounded">{{ session('warnings_') }}</div>
    @endif
    @if (session()->has('danger_') && session('danger_')!=="")
    <div class="alert-danger rounded">{{ session('danger_') }}</div>
    @endif
</div>
