loginModule = angular.module "ctcrm.login", []

loginModule.config ($stateProvider) ->
  $stateProvider.state "login",
    url: "/login"
    controller: 'LoginCtrl'
    templateUrl: "login/login.tpl.html"

  $stateProvider.state "logout",
    url: "/logout"
    onEnter: ($timeout, auth) ->
      $timeout ->
        auth.logout()

loginModule.controller 'LoginCtrl', ($scope, auth) ->
  $scope.login = ->
    auth.login $scope.userName, $scope.password

  $scope.$watch ->
    auth.loginError
  , ->
    $scope.loginError = auth.loginError
