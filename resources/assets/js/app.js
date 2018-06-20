window.$ = require('jquery')
// window._ = require('lodash')

require('./register_vue.js')

$("#navbarBurger").click(function () {
  $(this).toggleClass('is-active')
  $("#navbarMenu").toggleClass('is-active')
})

$(".notification > button.delete").each(function () {
  $(this).click(function () {
    $(this).parent().remove()
  })
})


