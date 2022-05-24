<template>
  <div>
    <Loader />
    <section class="sign-in-page">
      <b-container class="bg-white mt-5 p-0">
        <div class="row no-gutters">
          <div class="col-sm-6 align-self-center">
            <div class="sign-in-from">
              <slot />
            </div>
          </div>
          <div class="col-sm-6 text-center">
            <div class="sign-in-detail text-white" :style="'background: url('+bgImageURL+') no-repeat 0 0; background-size: cover;'">
              <a class="sign-in-logo mb-3 text-white" style="font-size:30px" href="#">TheLandyng</a>
              <Swiper :options="options">
                <SwiperSlide class="item">
                  <img :src="require('../../assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo">
                  <h4 class="mb-1 text-white">Manage your campaigns</h4>
                  <p>Create campagins with TheLandyng and get more leads.</p>
                </SwiperSlide>
                <SwiperSlide class="item">
                  <img :src="require('../../assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo">
                  <h4 class="mb-1 text-white">Manage your campaigns</h4>
                  <p>Create campagins with TheLandyng and get more leads.</p>
                </SwiperSlide>
                <SwiperSlide class="item">
                  <img :src="require('../../assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo">
                  <h4 class="mb-1 text-white">Manage your campaigns</h4>
                  <p>Create campagins with TheLandyng and get more leads.</p>
                </SwiperSlide>
              </Swiper>
            </div>
          </div>
        </div>
      </b-container>
    </section>
  </div>
</template>
<script>
import Loader from '../../components/core/loader/Loader'
import logo from '../../assets/images/logo-white.png'
import { core } from '../../config/pluginInit'
import bgImage from '../../assets/images/login/login-2.jpg'
import Swiper from '../../components/core/slider/Swiper'
import SwiperSlide from '../../components/core/slider/SwiperSlide'
export default {
  name: 'AuthLayout',
  components: {
    Loader,
    Swiper,
    SwiperSlide
  },
  mounted () {
    core.index()
  },
  data () {
    return {
      options: {
        slidesPerView: 1,
        loop: true
      },
      logo: logo,
      bgImageURL: bgImage
    }
  }
}
</script>
