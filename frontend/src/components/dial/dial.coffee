dialModule = angular.module "ctcrm.components.dial", []

dialModule.directive 'dial', ($http, auth) ->
  restrict: 'E'
  template: '<a href="#"></a>'
  scope:
    number: '='
  replace: true
  link: (scope, element) ->

    element.html scope.number
    return unless auth.currentUser
    if auth.currentUser.dialMethod == 'sip'
      element.attr 'href', "sip:#{scope.number}"
    else
      element.on 'click', ->
        data =
          msn: auth.currentUser.msn
          number: scope.number
        $http.post "rufjemandan", data: data