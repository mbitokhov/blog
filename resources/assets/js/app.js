import $ from 'jquery'

$("#navbarBurger").click(function () {
  $(this).toggleClass('is-active')
  $("#navbarMenu").toggleClass('is-active')
})

$(".notification > button.delete").each(function () {
  $(this).click(function () {
    $(this).parent().remove()
  })
})
