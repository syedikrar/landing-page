<template>
  <div v-if="links.length">
    <ul class="pagination b-pagination  mt-4  d-flex align-items-end justify-content-end">
      <template v-for="(link, k) in links">
      <li class="page-item" :class="{ 'active': link.active }">
        <div v-if="link.url === null"  class="page-link" v-html="link.label" />
        <inertia-link v-else class="  page-link"  :href="link.url" v-html="link.label" />
    </li>
      </template>
    </ul>
  </div>
</template>
  
<script>
export default {
    name: "Pagination",
    props: {
      links: Array,
    },
}
</script> 