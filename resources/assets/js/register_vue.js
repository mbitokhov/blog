window.Vue = require('vue')

Vue.filter('round', function (v) {
  return Math.round(v)
})
Vue.component('nutrition-calculator', require('./components/NutritionCalculator.vue'))
Vue.component('calorie-calculator', require('./components/CalorieCalculator.vue'))

const app = new Vue({
  el: "#app"
})
