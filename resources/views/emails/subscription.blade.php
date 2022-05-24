<style>
    .package-infromation {
        margin-left: 20px;
        border-style: solid;
        border-width: 1px;
    }
    small {
        margin-left: 10px;
    }
    .border-data {
        margin: 20px 20px 0px 20px;
    }
</style>
@component('mail::message')
# Hi, {{ $user->first_name }}

{{ $message }}

<div class="row package-infromation">
    <div class="col-lg-12 border-data">
        <div class="package-name">
            <h3>Package Name: <small> {{ $package_name }}</small></h3>
        </div>
        <hr>
        <div class="package-name">
            <h3>Allowed Active campaigns: <small> {{ $active_campaigns}}</small></h3>
        </div>
        <hr>
        <div class="package-name">
            <h3>Allowed Active Landing Pages: <small> {{ $active_landings }}</small></h3>
        </div>
        <hr>
        <div class="package-name"><h3>Package Price: <small> ${{ $price }}</small></h3></div>
    </div>
</div>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
