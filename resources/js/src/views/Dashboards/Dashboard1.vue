<template>
  <b-container fluid="">
    <b-row>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
                <h6><inertia-link :href="route('client.campaigns.index')">Active Campaigns</inertia-link></h6>
              
              </div>
              <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle iq-card-icon iq-bg-success mr-2"> <i class="ri-question-answer-line"></i></div>
                    <h2>{{ activeCampaigns }}</h2>
                </div>
                <div class="iq-map text-success font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
              </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6><inertia-link :href="route('client.campaigns.index')"> In-Active Campaigns</inertia-link></h6>
              
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-danger mr-2"><i class="ri-question-answer-line"></i></div>
                <h2>{{ inActiveCampaigns }}</h2>
              </div>
              <div class="iq-map text-danger font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6><inertia-link :href="route('client.landing.index')">Active Landing Pages</inertia-link></h6>
              
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-success mr-2"><i class="ri-pages-line"></i></div>
                <h2>{{ activeLandings }}</h2>
              </div>
              <div class="iq-map text-success font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
            </div>
          </template>
        </iq-card>
      </b-col>
      <b-col md="3" sm="6">
        <iq-card>
          <template v-slot:body>
            <div class="d-flex align-items-center justify-content-between">
              <h6><inertia-link :href="route('client.landing.index')">In-Active Landing Pages</inertia-link></h6>
          
            </div>
            <div class="iq-customer-box d-flex align-items-center justify-content-between mt-3">
              <div class="d-flex align-items-center">
                <div class="rounded-circle iq-card-icon iq-bg-danger mr-2"><i class="ri-pages-line"></i></div>
                <h2>{{ inActiveLandings }}</h2>
              </div>
              <div class="iq-map text-danger font-size-32"><i class="ri-bar-chart-grouped-line"></i></div>
            </div>
          </template>
        </iq-card>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
import { integer } from 'vee-validate/dist/rules';
import { core } from '../../config/pluginInit'
import VerticleLayout from "../../layouts/VerticleLayout";

export default {
  name: 'Dashboard1',
  layout: VerticleLayout,

  mounted () {
    core.index()
  },

  props: {
    activeCampaigns: integer,
    inActiveCampaigns: integer,
    activeLandings: integer,
    inActiveLandings: integer,

  }, 

  data () {
    return {
    }
  }
}
</script>


