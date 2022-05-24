<template>
  <div class="iq-sidebar" >
    <div class="iq-sidebar-logo d-flex justify-content-between">
      <inertia-link :href="route('client.home')">
        <img :src="logoSrc" v-if="onlyLogo" class="img-fluid" alt="logo">
        <!---<span v-if="onlyLogoText">{{ appName }}</span> -->
      </inertia-link>
      <div class="iq-menu-bt-sidebar" v-if="toggleButton">
        <div class="iq-menu-bt align-self-center">
          <div class="wrapper-menu" @click="miniSidebar">
            <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
            <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div id="sidebar-scrollbar">
      <nav class="iq-sidebar-menu" :class="horizontal ? 'd-xl-none' : ''">
        <CollapseMenu :items="items" :open="true" :key="this.$page.url" :horizontal="horizontal" :sidebarGroupTitle="sidebarGroupTitle"/>
      </nav>
      <div class="p-3"></div>
    </div>
  </div>
  <!-- TOP Nav Bar -->
</template>

<script>
import CollapseMenu from '../menus/CollapseMenu'
import { APPNAME } from '../../../config/pluginInit'
export default {
  name: 'Sidebar',
  props: {
    homeURL: { type: Object, default: () => ({ name: 'dashboard.home-1' }) },
    items: { type: Array },
    logo: { type: String, default: require('../../../assets/images/logo.png') },
    horizontal: { type: Boolean },
    toggleButton: { type: Boolean, default: true },
    logoShow: { type: Boolean, default: true },
    onlyLogo: { type: Boolean, default: false },
    onlyLogoText: { type: Boolean, default: false },
    sidebarGroupTitle: { type: Boolean, default: true }
  },
  components: {
    CollapseMenu
  },
  mounted () {
    this.getLogo()
  },
  methods: {
    miniSidebar () {
      this.$emit('toggle')
    },
    getLogo(){
      axios.get(this.route('client.get-logo'))
                        .then(response => {
                         this.logoSrc = response.data;
                        });
          
    }
  },
  data () {
    return {
      appName: APPNAME,
      logoSrc: '#'
    }
  }
}
</script>
