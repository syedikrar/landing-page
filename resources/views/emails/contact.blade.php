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


<div class="row package-infromation">
    <div class="col-lg-12 border-data">
        <div class="package-name">
            <h3>Name: <small> {{ $entry['name'] }}</small></h3>
        </div>
        <hr>
        <div class="package-name">
            <h3>Emil: <small> {{ $entry['email']}}</small></h3>
        </div>
        <hr>
        <div class="package-name">
            <h3>Phone: <small> {{ $entry['phone']}}</small></h3>
        </div>
        <hr>
        <div class="package-name">
            <h3>Subject: <small> {{ $entry['subject'] }}</small></h3>
        </div>
        <hr>
        <div class="package-name">
            <h3>Message: <small> {{ $entry['message'] }}</small></h3>
        </div>
    </div>
</div>
<br>


Thanks,<br>
{{ config('app.name') }}


@endcomponent
