import axios from 'axios'

let token = document.head.querySelector('meta[name="csrf-token"]') || ''

export default axios.create({
  baseURL: process.env.MIX_APP_URL,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': token
  }
})
