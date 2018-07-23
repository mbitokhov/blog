import $ from 'cash-dom'

require('./register_vue.js')

$("#navbarBurger").on('click', function () {
  $(this).toggleClass('is-active')
  $("#navbarMenu").toggleClass('is-active')
})

$(".notification > button.delete").each(function () {
  $(this).on('click', function () {
    $(this).parent().remove()
  })
})
