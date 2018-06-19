window.Vue = require('vue')

Vue.component('nutrition-calculator', require('./components/NutritionCalculator.vue'))

const app = new Vue({
  el: "#app"
})
