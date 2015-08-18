angular.module "ctcrm.components.stateButton", []

.directive "stateButton", ->
  restrict: "A"
  scope:
    item: "=stateButton"
    callback: "&"
  link: (scope, element) ->
    stateClasses = ['btn-danger', 'btn-warning', 'btn-success']

    element.addClass stateClasses[0]

    element.on 'click', ->
      element.removeClass stateClasses[scope.item.state]

      scope.item.state = parseInt(scope.item.state) + 1
      element.addClass stateClasses[scope.item.state]

      scope.callback()

