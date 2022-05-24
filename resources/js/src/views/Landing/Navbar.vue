<template>
    <iq-card body-class="p-0">
        <ul id="myTab" class="iq-edit-profile d-flex nav nav-pills">
            <li class="col-md-2 p-0 nav-item">
                <inertia-link id="myTab" data-toggle="tab" :href="route('client.landing.edit', landing.id)"
                    role="tab" aria-controls="tabpanel" class="nav-link" :class="route().current('client.landing.edit') ? 'nav-link active' : 'nav-link'">
                   1. Information
                </inertia-link>
            </li>
            <li class="col-md-2 p-0 nav-item">
                <inertia-link id="myTab" data-toggle="tab"
                    :href="route('client.landing.select_template', landing.id)" role="tab"
                    aria-controls="tabpanel" :class="route().current('client.landing.select_template') ? 'nav-link active' : 'nav-link'">
                    2. Template
                </inertia-link>
            </li>
            <li :class="landing.template_id ? 'col-md-2 p-0 nav-item' : 'col-md-2 p-0 nav-item nav-disabled' ">
                <inertia-link id="myTab" data-toggle="tab"
                    :href="route('client.forms.show', landing.form_id)" role="tab"
                    aria-controls="tabpanel" :class="route().current('client.forms.show', landing.form_id) ? 'nav-link active' : 'nav-link'">
                    3. Form
                </inertia-link>
            </li>
            
            <li :class="landing.template_id ? 'col-md-2 p-0 nav-item' : 'col-md-2 p-0 nav-item nav-disabled' ">
                <inertia-link id="myTab" data-toggle="tab"
                    :href="route('client.landing.tracking', landing.id)" role="tab"
                    aria-controls="tabpanel" :class="route().current('client.landing.tracking') ? 'nav-link active' : 'nav-link'">
                    4. Tracking
                </inertia-link>
            </li>
            <li :class="landing.template_id ? 'col-md-2 p-0 nav-item' : 'col-md-2 p-0 nav-item nav-disabled' ">
                <inertia-link id="myTab" data-toggle="tab"
                    :href="route('client.landing.domain', landing.id)" role="tab"
                    aria-controls="tabpanel" :class="route().current('client.landing.domain') ? 'nav-link active' : 'nav-link'">
                    5. Domain
                </inertia-link>
            </li>
            <li :class="'col-md-2 p-0 nav-item'">
                <inertia-link id="myTab" data-toggle="tab"
                    :href="route('client.landing.publish', landing.id)" role="tab"
                    aria-controls="tabpanel" :class="route().current('client.landing.publish') ? 'nav-link active' : 'nav-link'">
                    6. Publish
                </inertia-link>
            </li>
            
        </ul>
    </iq-card>
</template>

<script>
    export default {
        name: "Navbar",
        props: {
            landing: Object
        }
    }
</script>