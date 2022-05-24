<template>
  <div>
    <Loader />
    <div class="wrapper">
      <!-- Sidebar  -->
      <!-- <SmallSidebar  @toggle="sidebarMini" /> -->
      <Sidebar :logo="logo" :onlyLogo="onlyLogo" :onlyLogoText="onlyLogoText" @toggle="sidebarMini" :sidebarGroupTitle="sidebarGroupTitle" />
      <!-- TOP Nav Bar -->
      <DefaultNavBar title="Dashboard" :homeURL="{ name: 'dashboard.home-2' }" :sidebarGroupTitle="sidebarGroupTitle" @toggle="sidebarMini" :logo="logo">
 
        <template slot="right">
        
          <ul class="navbar-list">
            <li class="" v-nav-toggle>
              <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                <img :src="userProfile" class="img-fluid rounded mr-2" alt="user">
                <div class="caption" style="width: 120px;">
                  <h6 class="mb-0 line-height text-white"> {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}</h6>
                  <h6 class="mb-0 line-height text-white plan">{{ $page.props.auth.user.plan }} Plan</h6>
                </div>
              </a>
              <div class="iq-sub-dropdown iq-user-dropdown">
                <div class="iq-card shadow-none m-0">
                  <div class="iq-card-body p-0 ">
                    <div class="bg-primary p-3">
                      <h5 class="mb-0 text-white line-height">Hello {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}</h5>
                      
                    </div>
                    <inertia-link :href="route('client.profile.index')" class="iq-sub-card iq-bg-primary-hover">
                      <div class="media align-items-center">
                        <div class="rounded iq-card-icon iq-bg-primary">
                          <i class="ri-file-user-line"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0 ">My Profile</h6>
                          <p class="mb-0 font-size-12">View personal profile details.</p>
                        </div>
                      </div>
                    </inertia-link>
                    <inertia-link  v-if="checkUserPermissions('view_subscriptions')" :href="route('client.subscriptions.index')" class="iq-sub-card iq-bg-primary-hover">
                      <div class="media align-items-center">
                        <div class="rounded iq-card-icon iq-bg-primary">
                          <i class="ri-price-tag-2-line"></i>
                        </div>
                        <div class="media-body ml-3">
                          <h6 class="mb-0 ">Subscriptions</h6>
                          <p class="mb-0 font-size-12">View your subscribed plan.</p>
                        </div>
                      </div>
                    </inertia-link>
                  
                    <div class="d-inline-block w-100 text-center p-3">
                      <inertia-link class="bg-primary iq-sign-btn" href="/logout" method="post" as="button" type="button" role="button">Sign Out<i class="ri-login-box-line ml-2"></i></inertia-link>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </template>
      </DefaultNavBar>
      <!-- TOP Nav Bar END -->
      <div id="content-page" class="content-page">
        <b-container fluid="" v-if="!notBookmarkRouts.includes('home-2')">
          <b-row>
            <!-- <BreadCrumb /> -->
          </b-row>

          <slot />
        </b-container>
        <transition name="router-anim" :enter-active-class="`animated ${animated.enter}`" mode="out-in"
                    :leave-active-class="`animated ${animated.exit}`">
          <!-- <router-view/> -->
        </transition>
      </div>
    </div>
    <LayoutFooter />
  </div>
</template>
<script>
// const core = () => import('../config/pluginInit')
import { core } from '../config/pluginInit'
import { Users } from '../FackApi/api/chat'
import { mapActions, mapGetters } from 'vuex'
import Loader from '../components/core/loader/Loader'
import Sidebar from '../components/core/sidebars/Sidebar'
import DefaultNavBar from '../components/core/navbars/DefaultNavBar'
import SideBarItems from '../FackApi/json/SideBar'
import profile from '../assets/images/user/avatar.png'
import loader from '../assets/images/logo.png'
import Lottie from '../components/core/lottie/Lottie'
import LayoutFixRightSide from './Components/LayoutFixRightSide'
import WhiteLogo from '../assets/images/logo.png'
import SmallSidebar from '../components/core/sidebars/SmallSidebar'
import BreadCrumb from '../components/core/breadcrumbs/BreadCrumb'
// import LayoutFooter from './Components/LayoutFooter'
const LayoutFooter = () => import('./Components/LayoutFooter')

export default {
  name: 'VerticleLayout',
  components: {
    LayoutFooter,
    LayoutFixRightSide,
    Lottie,
    Loader,
    Sidebar,
    DefaultNavBar,
    SmallSidebar,
    BreadCrumb
  },
  mounted () {
    this.layoutSetting('dashboard.home-2')
  },
  computed: {
    ...mapGetters({
      cartCount: 'Ecommerce/cartCountState',
      cartItems: 'Ecommerce/cartState',
      selectedLang: 'Setting/langState',
      langsOptions: 'Setting/langOptionState',
      rtlMode: 'Setting/rtlModeState',
      colors: 'Setting/colorState'
    }),
    toggleSideIcon () {
      let show = true
      switch ('dashboard.home-2') {
        case 'dashboard.home-3':
        case 'dashboard.home-4':
        case 'dashboard.home-5':
        case 'dashboard.home-6':
          show = false
          break
      }
      return show
    }
  },
  watch: {
    $route: function (to, from) {
      this.layoutSetting(to.name)
    }
  },
  // sidebarTicket
  data () {
    return {
      permissionsArray: this.$page.props.auth.user.permissions,
      animated: { enter: 'fadeInUp', exit: 'fadeOut' },
      verticalMenu: SideBarItems,
      userProfile: profile,
      onlyLogo: false,
      onlyLogoText: false,
      sidebarGroupTitle: true,
      logo: loader,
      usersList: Users,
      rtl: false,
      SmallSidebarLogo: WhiteLogo,
      message: [
        { image: require('../assets/images/user/user-01.jpg'), name: 'Nik Emma Watson', date: '13 jan' },
        { image: require('../assets/images/user/user-02.jpg'), name: 'Greta Life', date: '14 Jun' },
        { image: require('../assets/images/user/user-03.jpg'), name: 'Barb Ackue', date: '16 Aug' },
        { image: require('../assets/images/user/user-04.jpg'), name: 'Anna Sthesia', date: '21 Sept' },
        { image: require('../assets/images/user/user-05.jpg'), name: 'Bob Frapples', date: '29 Sept' }
      ],
      notification: [
        { image: require('../assets/images/user/user-01.jpg'), name: 'Nik Emma Watson', date: '23 hour ago', description: 'Enjoy smart access to videos, games' },
        { image: require('../assets/images/user/user-02.jpg'), name: 'Greta Life', date: '14 hour ago', description: 'Google Chromecast: Enjoy a world of entertainment' },
        { image: require('../assets/images/user/user-03.jpg'), name: 'Barb Ackue', date: '16 hour ago', description: 'Dell Inspiron Laptop: Get speed and performance from' },
        { image: require('../assets/images/user/user-04.jpg'), name: 'Anna Sthesia', date: '21 hour ago', description: 'Deliver your favorite playlist anywhere in your home ' },
        { image: require('../assets/images/user/user-05.jpg'), name: 'Bob Frapples', date: '11 hour ago', description: 'MacBook Air features up to 8GB of memory, a fifth-generation' }
      ],
      notBookmarkRouts: [
        'dashboard.home-1',
        'dashboard.home-2',
        'dashboard.home-3',
        'dashboard.home-4',
        'dashboard.home-5',
        'dashboard.home-6'
      ]
    }
  },
  methods: {
    checkUserPermissions(value) {
        return this.permissionsArray.includes(value);
    },
    layoutSetting (routeName) {
      this.onlyLogo = true
      this.onlyLogoText = true
      this.sidebarGroupTitle = true
      switch (routeName) {
        case 'dashboard.home-5':
          this.onlyLogoText = true
          this.onlyLogo = false
          break
        case 'dashboard.home-6':
          this.logo = WhiteLogo
          this.onlyLogo = true
          this.onlyLogoText = false
          this.sidebarGroupTitle = false
          break
        default:
        this.logo = loader
          
          break
      }
    },
    changeLogo (e) {
      this.logo = e
    },
    sidebarMini () {
      core.triggerSet()
      this.$store.dispatch('Setting/miniSidebarAction')
    },
    logout () {
      // localStorage.removeItem('user')
      // localStorage.removeItem('access_token')
      // this.$router.push({ name: 'auth1.sign-in1' })
    },
    langChange (lang) {
     
    },
    routerAnimationChange (e) {
      this.animated = e
    },
    ...mapActions({
      removeToCart: 'Ecommerce/removeToCartAction',
      langChangeState: 'Setting/setLangAction',
      rtlAdd: 'Setting/setRtlAction',
      rtlRemove: 'Setting/removeRtlAction',
    })
  }
}
</script>