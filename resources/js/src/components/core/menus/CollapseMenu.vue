<template>
    <b-collapse tag="ul" :class="className" :visible="open" :id="idName" :accordion="accordianName">
      <li class="p-0" :class="{'active': route().current('client.home')}">
        <inertia-link :href="route('client.home')" class="iq-waves-effect">
          <i class="ri-home-4-line"/>
          <span>Dashboard</span>
        </inertia-link>
      </li>
      <li v-if="checkUserPermissions('view_campaigns')" class="p-0" :class="{'active': route().current('client.campaigns.*')}">
        <inertia-link :href="route('client.campaigns.index')" class="iq-waves-effect">
          <i class="ri-question-answer-line"/>
          <span>Campaigns </span>
        </inertia-link>
      </li>
      <li v-if="checkUserPermissions('view_landings')" class="p-0" :class="{'active': route().current('client.landing.*')|| route().current('client.forms.*') }">
        <inertia-link :href="route('client.landing.index')" class="iq-waves-effect">
          <i class="ri-pages-line"/>
          <span>Landings</span>
        </inertia-link>
      </li>
      <li v-if="checkUserPermissions('view_subscriptions')" class="p-0" :class="{'active': route().current('client.subscription.*') }">
        <inertia-link :href="route('client.subscriptions.index')" class="iq-waves-effect">
          <i class="ri-price-tag-2-line"/>
          <span>Subscriptions</span>
        </inertia-link>
      </li>
      <li v-if="checkUserPermissions('view_cards')" class="p-0" :class="{'active': route().current('client.cards.*') }">
        <inertia-link :href="route('client.cards.index')" class="iq-waves-effect">
          <i class="fa fa-credit-card"/>
          <span>Card Information</span>
        </inertia-link>
      </li>
      <li v-if="checkUserPermissions('view_landings')" class="p-0" :class="{'active': route().current('client.report.*') }">
        <inertia-link :href="route('client.report.index')" class="iq-waves-effect">
          <i class="fas fa-chart-area"></i>
          <span>Reports</span>
        </inertia-link>
      </li>
    </b-collapse>
</template>
<script>
import List from './CollapseMenu'
import { core } from '../../../config/pluginInit'
export default {
  name: 'List',
  props: {
    items: Array,
    className: { type: String, default: 'iq-menu' },
    open: { type: Boolean, default: false },
    idName: { type: String, default: 'sidebar' },
    accordianName: { type: String, default: 'sidebar' },
    sidebarGroupTitle: { type: Boolean, default: true }
  },
  components: {
    List
  },
  data() {
    return {
      permissionsArray: this.$page.props.auth.user.permissions
    }
  },
  computed: {
    hideListMenuTitle () {
      return this.sidebarGroupTitle
    }
  },
  mounted () {
  },
  methods: {
    checkUserPermissions(value) {
        return this.permissionsArray.includes(value);
    }
  }
}
</script>
