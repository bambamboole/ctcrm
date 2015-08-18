editInPlaceModule = angular.module "ctcrm.components.editInPlace", []

editInPlaceModule.directive 'editInPlace', ($timeout, auth) ->

  restrict: 'E'
  templateUrl: 'components/editInPlace/editInPlace.tpl.html'
  scope:
    ngModel: '='
    callback: '&'
  require: 'ngModel'
  link: (scope, element, attributes,ngModelCtrl) ->
    scope.editInPlace =
      edit: false

    scope.toggle = ->
      scope.editInPlace.edit = !scope.editInPlace.edit
      $timeout ->
        input = element.find('input')
        input[0].focus()
        input.on 'blur', ->
          scope.editInPlace.edit = false
          scope.callback()



    if auth.isAllowed('admin')
      element.on 'mouseover', ->
        element.find('i').eq(0).removeClass 'hide'

      element.on 'mouseout', ->
        element.find('i').eq(0).addClass 'hide'

